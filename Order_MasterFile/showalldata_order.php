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
      </ul>
      <div class="d-flex gap-2">
        <a class="btn btn-secondary btn-sm" href="/database/aboutme.html" role="button">HOME</a>
        <a class="btn btn-primary btn-sm" href="/database/Login_MasterFile/login.php" role="button">LOGIN</a>
       
      </div>
    </div>
  </div>
</nav>

<div class="container">
</div>

<?php
include("connect.php"); //ติดต่อ Server
?>
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-striped">
          <tr class="table-info">
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Product ID</th>
                    <th>จำนวนแพ็คเกจ</th>
                    <th>ราคาแพ็คเกจ</th>
                    <th>รวมทั้งหมด</th>
                    <th>Order Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
              </tr>
              <tbody>
                <?php
                $sql = "SELECT order_id, customer_id, product_id, pack_quantity, pack_price, total_amount, order_date
                  FROM `order`
                  ORDER BY order_id DESC";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $del_id = $row["order_id"];
                        echo "<tr>
                                <td>" . $row["order_id"] . "</td>
                                <td>" . $row["customer_id"] . "</td>
                                <td>" . $row["product_id"] . "</td>
                                <td>" . $row["pack_quantity"] . "</td>
                                <td>" . number_format($row["pack_price"], 2) . " บาท</td>
                                <td>" . number_format($row["total_amount"], 2) . " บาท</td>
                                <td>" . $row["order_date"] . "</td>
                                <td><a class='btn btn-warning btn-sm' href='edit_form_data.php?edit_id=" . $row['order_id'] . "' role='button'>Edit</a></td>
                                <td><a class='btn btn-danger btn-sm' href='delete.php?del_id=" . $row['order_id'] . "' role='button' onclick=\"return confirm('คุณต้องการลบคำสั่งซื้อ ID=" . $del_id . "?');\">Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>0 results</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>