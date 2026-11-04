<?php
include("connect.php");
// รับค่าจากฟอร์ม edit
$order_id = $_POST["order_id"];
$customer_id = $_POST["customer_id"];
$product_id = $_POST["product_id"];
$order_qty = $_POST["order_qty"];
$order_date = $_POST["order_date"];
// น าค่าที่แก้ไข ไปบันทึก ลงในฐานข้อมูล
$sql = "UPDATE `order` SET customer_id='$customer_id', product_id='$product_id', order_qty='$order_qty', order_date='$order_date' WHERE order_id=$order_id";
if (mysqli_query($conn, $sql)) { // run sql และ เปรียบเทียบผล ถ้าท างานส าเร็จ จะให้ผลเป็นจริง
//echo "New record created successfully";
echo "<script> window.alert('บันทึกข้อมูลสำเร็จok'); </script>";
echo "<script> window.location.assign('showalldata_order.php'); </script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
echo "<script> window.alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
echo "<script> window.location='showalldata_order.php'; </script>";
}
mysqli_close($conn);
?>