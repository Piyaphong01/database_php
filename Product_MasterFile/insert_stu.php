<?php
include("connect.php");
$product_name= $_POST["product_name"];
$product_price = $_POST["product_price"];
$product_stock = $_POST["product_stock"];
$product_pro = $_POST["product_pro"];
$sql = "INSERT INTO product(product_name,product_price,product_stock,product_pro)
VALUES('$product_name','$product_price','$product_stock','$product_pro') ";
if (mysqli_query($conn, $sql)) {
//echo "New record created successfully";
echo "<script> window.alert('บันทึกข้อมูลส าเร็จ ok'); </script>";
echo "<script> window.location.assign('showalldata_product.php'); </script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
echo "<script> window.alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
echo "<script> window.location='showalldata_product.php'; </script>";
}
mysqli_close($conn);
?>