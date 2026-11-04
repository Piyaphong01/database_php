<?php
include("connect.php");
$customer_id = $_POST["customer_id"];
$product_id = $_POST["product_id"];
$order_qty = $_POST["order_qty"];
$order_date = $_POST["order_date"];
$sql = "INSERT INTO `order`(customer_id, product_id, order_qty, order_date)
VALUES('$customer_id','$product_id','$order_qty','$order_date') ";
if (mysqli_query($conn, $sql)) {
//echo "New record created successfully";
echo "<script> window.alert('บันทึกข้อมูลส าเร็จ ok'); </script>";
echo "<script> window.location.assign('showalldata_order.php'); </script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
echo "<script> window.alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
echo "<script> window.location='showalldata_order.php'; </script>";
}
mysqli_close($conn);
?>