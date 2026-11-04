<?php
include("connect.php");
$edit_id=$_GET["edit_id"]; //รับค่า ID บรรทัดที่จะแก้ไข จากลิ้ง ใช้ GET
$sql = "SELECT product_id, product_name, product_price, product_stock, product_pro FROM product where
product_id=$edit_id"; // เขียน SQL ดึงข้อมูลบรรทัดที่จะแก้ไข
$result = mysqli_query($conn, $sql); // run SQL
$row = mysqli_fetch_assoc($result); // ดึงข้อมูลใส่ Array
// เอาข้อมูลจาก Array เก็บไว้ในตัวแปร ไว้ก่อน
$edt_id = $row["product_id"];
$edt_name = $row["product_name"];
$edt_price = $row["product_price"];
$edt_stock = $row["product_stock"];
$edt_pro = $row["product_pro"];
?>
<!-- เขียนหน้าเวป แก้ไขชื่อนักศึกษา -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" >
<style>
    :root {
        --bg-color: #0f172a;
        --card-bg: #1e293b;
        --accent-color: #8b5cf6;
        --text-color: #f8fafc;
        --text-muted: #94a3b8;
        --border-color: #334155;
    }

    body {
        background-color: var(--bg-color);
        color: var(--text-color);
        line-height: 1.6;
        padding: 40px 20px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-6 ">
<br><br>
<a class="btn btn-primary" href="showalldata_product.php" role="button">HOME</a>
<a class="btn btn-primary" href="/database/Login_MasterFile/login.php" role="button">LOGIN</a>
<div class="text-center mt-4 mb-4 h3 alert alert-success" role="alert">
แก้ไขข้อมูลสินค้า
</div>
<!—เอาข้อมูลจากตัวแปร ใส่ในฟอร์มแก้ไข -->
<form action="edit_sql_data.php" method="post">
<label for="">ID</label>
<input type="text" name="product_id" id="" class="form-control" placeholder="...ชื่อ"
value="<?php echo $edt_id;?>" readonly> <br> <!—ไอดี อ่านได้อย่างเดียว -->
<label for="">ชื่อ</label>
<input type="text" name="product_name" id="" class="form-control" placeholder="...ชื่อ"
value="<?php echo $edt_name;?>" required> <br> <!— required บังคับต้องป้อนข้อมูล -->
<label for="">ราคา</label>
<input type="text" name="product_price" id="" class="form-control" placeholder="...ราคา"
value="<?php echo $edt_price;?>" required> <br>
<label for="">สต๊อก</label>
<input type="text" name="product_stock" id="" class="form-control" placeholder="...สต๊อก"
value="<?php echo $edt_stock;?>" required> <br>
<label for="">โปรโมชั่น</label>
<input type="text" name="product_pro" id="" class="form-control" placeholder="...โปรโมชั่น"
value="<?php echo $edt_pro;?>" required> <br>
<input type="submit" value="Submit" class="btn btn-success">
<a class="btn btn-primary" href="showalldata_product.php" role="button">Cancle</a>
</form>
</div></div>
</div>
</body>
</html>