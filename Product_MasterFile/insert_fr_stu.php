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
เพิ่มรายการสินค้า
</div>
<form action="insert_stu.php" method="post"> <!- เมื่อกดปุ่ ม submit จะไปท างานที่ไฟล์ที่ก าหนดไว้ใน action ->
<label for="">productname</label>
<input type="text" name="product_name" id="" class="form-control" placeholder="...ชื่อ" required> <br>

<label for="">productprice</label>
<input type="text" name="product_price" id="" class="form-control" placeholder="...ราคา" required> <br>

<label for="">productstock</label>
<input type="text" name="product_stock" id="" class="form-control" placeholder="...จำนวน" required> <br>
<label for="">productpro</label>
<input type="text" name="product_pro" id="" class="form-control" placeholder="...โปรโมชั่น" required> <br>

<input type="submit" value="Submit" class="btn btn-success">
<input type="reset" value="Clear" class="btn btn-warning">
</form>
</div></div>
</div>
</body>
</html>