<?php
include("connect.php");
$edit_id=$_GET["edit_id"]; //รับค่า ID บรรทัดที่จะแก้ไข จากลิ้ง ใช้ GET
$sql = "SELECT customer_id, customer_name, phone_number, customer_type, credit_limit, pack_quantity, pack_price, total_amount FROM customer where
customer_id=$edit_id"; // เขียน SQL ดึงข้อมูลบรรทัดที่จะแก้ไข
$result = mysqli_query($conn, $sql); // run SQL
$row = mysqli_fetch_assoc($result); // ดึงข้อมูลใส่ Array
// เอาข้อมูลจาก Array เก็บไว้ในตัวแปร ไว้ก่อน
$edt_id = $row["customer_id"];
$edt_name = $row["customer_name"];
$edt_phone = $row["phone_number"];
$edt_type = $row["customer_type"];
$edt_credit = $row["credit_limit"];
$edt_pack_qty = $row["pack_quantity"];
$edt_pack_price = $row["pack_price"];
$edt_total_amount = $row["total_amount"];
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
<a class="btn btn-primary" href="showalldata_customer.php" role="button">HOME</a>
<a class="btn btn-primary" href="/database/Login_MasterFile/login.php" role="button">LOGIN</a>
<div class="text-center mt-4 mb-4 h3 alert alert-success" role="alert">
แก้ไขข้อมูลลูกค้า
</div>
<!—เอาข้อมูลจากตัวแปร ใส่ในฟอร์มแก้ไข -->
<form action="edit_sql_data.php" method="post">
<label for="">ID</label>
<input type="text" name="customer_id" id="" class="form-control" placeholder="...ชื่อ"
value="<?php echo $edt_id;?>" readonly> <br> <!—ไอดี อ่านได้อย่างเดียว -->
<label for="">ชื่อ</label>
<input type="text" name="customer_name" id="" class="form-control" placeholder="...ชื่อ"
value="<?php echo $edt_name;?>" required> <br> <!— required บังคับต้องป้อนข้อมูล -->
<label for="">หมายเลขโทรศัพท์</label>
<input type="text" name="phone_number" id="" class="form-control" placeholder="...หมายเลขโทรศัพท์"
value="<?php echo $edt_phone;?>" required> <br>
<label for="">ประเภทลูกค้า</label>
<input type="text" name="customer_type" id="" class="form-control" placeholder="...ประเภทลูกค้า"
value="<?php echo $edt_type;?>" required> <br>
<label for="">วงเงินเครดิต</label>
<input type="text" name="credit_limit" id="" class="form-control" placeholder="...วงเงินเครดิต"
value="<?php echo $edt_credit;?>" required> <br>
<label for="">จำนวนแพ็ก</label>
<input type="text" name="pack_quantity" id="" class="form-control" placeholder="...จำนวนแพ็ก"
value="<?php echo $edt_pack_qty;?>" required> <br>
<label for="">ราคาแพ็ก</label>
<input type="text" name="pack_price" id="" class="form-control" placeholder="...ราคาแพ็ก"
value="<?php echo $edt_pack_price;?>" required> <br>
<label for="">ยอดรวม</label>
<input type="text" name="total_amount" id="" class="form-control" placeholder="...ยอดรวม"
value="<?php echo $edt_total_amount;?>" required> <br>
<input type="submit" value="Submit" class="btn btn-success">
<a class="btn btn-primary" href="showalldata_customer.php" role="button">Cancle</a>
</form>
</div></div>
</div>
</body>
</html>