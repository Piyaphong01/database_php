<?php
include("connect.php"); // เชื่อมต่อฐานข้อมูล

// ⚠️ รับค่าไอดีจากปุ่ม Delete (ใช้ $_GET ไม่ใช่ $_POST)
$del_id = $_GET["del_id"]; 

// ภาษา SQL สำหรับ "ลบข้อมูล" 
$sql = "DELETE FROM customer WHERE customer_id = $del_id"; 

if (mysqli_query($conn, $sql)) {
    echo "<script> window.alert('ลบข้อมูลสำเร็จ OK'); </script>";
    echo "<script> window.location.assign('showalldata_customer.php'); </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<script> window.alert('ไม่สามารถลบข้อมูลได้'); </script>";
    echo "<script> window.location='showalldata_customer.php'; </script>";
}
mysqli_close($conn);
?>
