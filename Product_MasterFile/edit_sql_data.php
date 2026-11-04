<?php
include("connect.php");
// รับค่าจากฟอร์ม edit
$product_id = $_POST["product_id"];
$product_name = $_POST["product_name"];
$product_price = $_POST["product_price"];
$product_stock = $_POST["product_stock"];
$product_pro = $_POST["product_pro"];
// น าค่าที่แก้ไข ไปบันทึก ลงในฐานข้อมูล
$sql = "UPDATE product SET product_name='$product_name', product_price='$product_price', product_stock='$product_stock', product_pro='$product_pro' WHERE product_id=$product_id";
if (mysqli_query($conn, $sql)) { // run sql และ เปรียบเทียบผล ถ้าท างานส าเร็จ จะให้ผลเป็นจริง
//echo "New record created successfully";
echo "<script> window.alert('บันทึกข้อมูลสำเร็จok'); </script>";
echo "<script> window.location.assign('showalldata_product.php'); </script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
echo "<script> window.alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
echo "<script> window.location='showalldata_product.php'; </script>";
}
mysqli_close($conn);
?>