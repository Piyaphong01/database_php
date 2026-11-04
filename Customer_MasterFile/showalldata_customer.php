<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>listStudent</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" >
<style>
  :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --accent-color: #8b5cf6;
            --text-color: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #f1f5fa;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 40px 20px;
        }
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .banner {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border-color);
        }
        .navbar-custom {
            background-color: #111827;
            border-radius: 10px;
            padding: 10px 20px;
        }
        .navbar-custom .nav-link {
            color: white;
            margin-right: 8px;
        }
        .navbar-custom .nav-link:hover {
            color: #93c5fd;
        }
    </style>
</head>

<body>
  <img src="../banner.jpg" alt="Zenith banner" class="banner img-fluid w-100 h-100" style="max-height: auto px; object-fit: cover;">
<br><br>
<nav class="navbar navbar-expand-lg navbar-custom mb-4">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="/database/7.jpg">Zenith</a>
    <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
          <a class="nav-link" href="/database/Product_MasterFile/showalldata_product.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/database/Customer_MasterFile/showalldata_customer.php">Customer</a>
        </li>
          <li class="nav-item">
          <a class="nav-link" href="/database/Order_MasterFile/order_page.php">Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/database/Customer_MasterFile/goodcustomer.php">Good Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/database/Order_MasterFile/Best_seller.php">Best Seller</a>
        </li>
      </ul>
      <div class="d-flex gap-2">
        <a class="btn btn-secondary btn-sm" href="/database/aboutme.html" role="button">HOME</a>
        <a class="btn btn-primary btn-sm" href="/database/Login_MasterFile/login.php" role="button">LOGIN</a>
        <a class="btn btn-success btn-sm" href="insert_fr_stu.php">Add+</a>
      </div>
    </div>
  </div>
</nav>
<div class="text-center mt-4 mb-4 h3 alert alert-success" role="alert">
ข้อมูลลูกค้าเว็บเติมเกม
</div>
<div class="container">
</div>

<?php
include("connect.php"); //ติดต่อ Server
?>
<table class="table table-striped">
<tr class="table-info">
<th>Customer ID</th> <th>Customer Name</th> <th>Phone Number</th> <th>Customer Type</th> <th>Credit Limit</th> <th>Pack Quantity</th> <th>Pack Price</th> <th>Total Amount</th>
<th>Edit</th>
<th>Delete</th>
</tr>
<?php
$sql = "SELECT customer_id, customer_name, phone_number, customer_type, credit_limit, pack_quantity, pack_price, total_amount FROM customer";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
echo "<tr><td>" . $row["customer_id"].
"</td><td>" . $row["customer_name"].
"</td><td>" . $row["phone_number"].
"</td><td>" . $row["customer_type"].
"</td><td>" . $row["credit_limit"]. 
"</td><td>" . $row["pack_quantity"].
"</td><td>" . $row["pack_price"].
"</td><td>" . $row["total_amount"]."</td>";
$del_id = $row["customer_id"];
?>
<td><a class="btn btn-warning" href="edit_form_data.php?edit_id=<?php echo
$row['customer_id']; ?>" role="button">Edit</a></td>
<td><a class="btn btn-danger" href="delete.php?del_id=<?php echo
$row['customer_id']; ?>" role="button"
onclick="return confirm('คุณต้องการลบลูกค้า ID=<?php echo $del_id; ?>?');">
Delete</a></td>
</tr>
<?php
}
} else {
echo "0 results";
}
mysqli_close($conn);
?>

</table>
</div>
</body>
</html>
