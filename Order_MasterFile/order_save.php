<?php
include("connect.php");

$customer_id = $_POST['customer_id'];
$product_id  = $_POST['product_id'];
$order_qty   = $_POST['order_qty'];
$order_date  = date("Y-m-d H:i:s");

// เช็คสต็อกก่อนบันทึก
$sql_check = "SELECT product_stock, product_price FROM product WHERE product_id = '$product_id'";
$res_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_assoc($res_check);

if ($row_check && $row_check['product_stock'] >= $order_qty) {
    $pack_price = $row_check['product_price'];
    $total_amount = $order_qty * $pack_price;

    $sql_insert = "INSERT INTO `order`
                    (customer_id, product_id, order_qty, pack_quantity, pack_price, total_amount, order_date)
                    VALUES ('$customer_id', '$product_id', '$order_qty', '$order_qty', '$pack_price', '$total_amount', '$order_date')";

    if (mysqli_query($conn, $sql_insert)) {
        // ตัดสต็อกสินค้า
        $sql_update_stock = "UPDATE product
                              SET product_stock = product_stock - '$order_qty'
                              WHERE product_id = '$product_id'";
        mysqli_query($conn, $sql_update_stock);

        echo "<script>alert('บันทึกคำสั่งซื้อสำเร็จ'); window.location.href='order_page.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "'); window.location.href='order_page.php';</script>";
    }

} else {
    echo "<script>alert('สินค้าคงเหลือไม่เพียงพอ'); window.location.href='order_page.php';</script>";
}

mysqli_close($conn);
?>