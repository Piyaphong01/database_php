<?php
// 1. เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล (แก้ไข path ให้ตรงกับโฟลเดอร์ของคุณ)
include("../Customer_MasterFile/connect.php");

// 2. รับค่าจากฟอร์ม
$phone_number = $_POST["phone_number"];
$password = $_POST["password"];

// 3. คำสั่ง SQL เช็คเบอร์โทรศัพท์ และ รหัสผ่าน
$sql = "SELECT customer_id, customer_name FROM customer 
        WHERE phone_number = '$phone_number' AND password = '$password'";

$result = mysqli_query($conn, $sql);

// 4. ตรวจสอบผลลัพธ์
if (mysqli_num_rows($result) == 1) {
    // กรณี: ล็อกอินสำเร็จ (ดึงข้อมูลรหัสลูกค้ามาเพื่อส่งต่อไปหน้า profile)
    $row = mysqli_fetch_array($result);
    $user_id = $row['customer_id'];
    
    echo "<script> window.alert('เข้าสู่ระบบสำเร็จ! ยินดีต้อนรับ'); </script>";
    // ส่งผู้ใช้ไปหน้า Profile พร้อมแนบ id ไปด้วย
    echo "<script> window.location.assign('../Customer_MasterFile/profile_page.php?id=" . urlencode($user_id) . "'); </script>";
} else {
    // กรณี: เบอร์โทรหรือรหัสผ่านผิด
    echo "<script> window.alert('เบอร์โทรศัพท์ หรือ รหัสผ่านไม่ถูกต้อง'); </script>";
    echo "<script> window.location='login.php'; </script>";
}

mysqli_close($conn);
?>