<?php
include("connect.php");
$product_name= $_POST["customer_name"];
$product_price = $_POST["phone_number"];
$product_stock = $_POST["customer_type"];
$product_pro = $_POST["credit_limit"];
$product_pack_qty = $_POST["pack_quantity"];
$product_pack_price = $_POST["pack_price"];
$product_total_amount = $_POST["total_amount"];
$sql = "INSERT INTO customer(customer_name,phone_number,customer_type,credit_limit,pack_quantity,pack_price,total_amount)
VALUES('$product_name','$product_price','$product_stock','$product_pro','$product_pack_qty','$product_pack_price','$product_total_amount') ";
if (mysqli_query($conn, $sql)) {
//echo "New record created successfully";
echo "<script> window.alert('บันทึกข้อมูลส าเร็จ ok'); </script>";
echo "<script> window.location.assign('showalldata_customer.php'); </script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
echo "<script> window.alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
echo "<script> window.location='showalldata_customer.php'; </script>";
}
mysqli_close($conn);
?>