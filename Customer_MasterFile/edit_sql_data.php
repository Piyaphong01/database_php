<?php
include("connect.php");
// รับค่าจากฟอร์ม edit
$customer_id = $_POST["customer_id"];
$customer_name = $_POST["customer_name"];
$phone_number = $_POST["phone_number"];
$customer_type = $_POST["customer_type"];
$credit_limit = $_POST["credit_limit"];
$pack_quantity = $_POST["pack_quantity"];
$pack_price = $_POST["pack_price"];
$total_amount = $_POST["total_amount"];

// น าค่าที่แก้ไข ไปบันทึก ลงในฐานข้อมูล
$sql = "UPDATE customer SET customer_name='$customer_name', phone_number='$phone_number', customer_type='$customer_type', credit_limit='$credit_limit', pack_quantity='$pack_quantity', pack_price='$pack_price', total_amount='$total_amount' WHERE customer_id=$customer_id";
if (mysqli_query($conn, $sql)) { // run sql และ เปรียบเทียบผล ถ้าท างานส าเร็จ จะให้ผลเป็นจริง
//echo "New record created successfully";
echo "<script> window.alert('บันทึกข้อมูลสำเร็จok'); </script>";
echo "<script> window.location.assign('showalldata_customer.php'); </script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
echo "<script> window.alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
echo "<script> window.location='showalldata_customer.php'; </script>";
}
mysqli_close($conn);
?>