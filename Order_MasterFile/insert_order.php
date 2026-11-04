<?php
// 1. เชื่อมต่อฐานข้อมูล
include("connect.php");

// 2. รับค่าที่ส่งมาจากฟอร์มด้วยวิธี POST
$customer_id = $_POST["customer_id"];
$product_id = $_POST["product_id"];
$order_qty = $_POST["order_qty"];

// สร้างวันที่ปัจจุบัน
$order_date = date("Y-m-d");

// 3. ดึงราคาของสินค้าจากตาราง product เพื่อนำมาคำนวณยอดรวม
$sql_price = "SELECT product_price FROM `product` WHERE product_id = '$product_id'";
$result_price = mysqli_query($conn, $sql_price);
$row_price = mysqli_fetch_array($result_price);

if ($row_price) {
    // คำนวณยอดเงิน
    $pack_price = $row_price['product_price'];
    $total_amount = $order_qty * $pack_price;
    $pack_quantity = $order_qty; // เก็บข้อมูลจำนวนแพ็คให้สอดคล้องกับตารางของคุณ

    // 4. คำสั่ง SQL สำหรับเพิ่มข้อมูลลงตาราง order (ต้องใส่ ` ` ครอบคำว่า order เพราะเป็นคำสงวน)
    $sql_insert = "INSERT INTO `order` (customer_id, product_id, order_qty, order_date, pack_quantity, pack_price, total_amount) 
                   VALUES ('$customer_id', '$product_id', '$order_qty', '$order_date', '$pack_quantity', '$pack_price', '$total_amount')";

    // 5. ตรวจสอบการบันทึกข้อมูล
    if (mysqli_query($conn, $sql_insert)) {
        
        // 6. ถ้าบันทึกออเดอร์สำเร็จ ให้ไปหักลบจำนวนสต็อกสินค้าในตาราง product ทันที
        $sql_update = "UPDATE `product` 
                       SET product_stock = product_stock - $order_qty 
                       WHERE product_id = '$product_id'";
        mysqli_query($conn, $sql_update);

        // แจ้งเตือนสำเร็จและ Redirect กลับไปหน้าเดิม 
        // (หากหน้าเว็บหลักของคุณไม่ได้ชื่อ seller_page.php ให้เปลี่ยนชื่อไฟล์ตรงนี้ให้ถูกต้อง)
        echo "<script> window.alert('บันทึกรายการสั่งซื้อ และตัดสต็อกสินค้าเรียบร้อยแล้ว'); </script>";
        echo "<script> window.location.assign('seller_page.php'); </script>";
        
    } else {
        // กรณีบันทึกไม่สำเร็จ
        // echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn); // เปิดบรรทัดนี้ไว้ดู Error หากระบบมีปัญหา
        echo "<script> window.alert('เกิดข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้'); </script>";
        echo "<script> window.location='seller_page.php'; </script>";
    }
} else {
    // กรณีพิมพ์รหัสสินค้าที่ไม่มีในระบบ
    echo "<script> window.alert('ไม่พบสินค้านี้ในระบบ กรุณาตรวจสอบรหัสสินค้าอีกครั้ง'); </script>";
    echo "<script> window.location='seller_page.php'; </script>";
}

// 7. ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>