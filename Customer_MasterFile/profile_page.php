<?php
include("connect.php");

if (!isset($_GET['id'])) {
    echo "<script> window.alert('ไม่พบข้อมูลลูกค้า'); window.location='../Login_MasterFile/login.php'; </script>";
    exit();
}
$customer_id = $_GET['id'];

$sql_customer = "SELECT * FROM `customer` WHERE customer_id = '$customer_id'";
$result_customer = mysqli_query($conn, $sql_customer);
$customer = mysqli_fetch_array($result_customer);

if (!$customer) {
    echo "<script> window.alert('ไม่พบข้อมูลลูกค้านี้ในระบบ'); window.location='../Login_MasterFile/login.php'; </script>";
    exit();
}

$sql_order = "SELECT o.order_id, o.order_date, p.product_name, o.order_qty, o.total_amount 
              FROM `order` o 
              LEFT JOIN `product` p ON o.product_id = p.product_id 
              WHERE o.customer_id = '$customer_id' 
              ORDER BY o.order_id DESC";
$result_order = mysqli_query($conn, $sql_order);
?>
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
                <a class="btn btn-danger btn-sm" href="/database/Login_MasterFile/logout.php" role="button">LOGOUT</a>
        
      </div>
    </div>
  </div>
</nav>

<!-- ส่วนที่เพิ่มเข้าไปสำหรับหน้า Profile (ใช้ Bootstrap class เพื่อให้เข้ากับธีม) -->
<div class="container">
    <div class="card mt-4" style="background-color: var(--card-bg); border-color: var(--border-color);">
        <div class="card-body">
            <h3 class="mb-4 text-center" style="color: var(--accent-color);">ข้อมูลโปรไฟล์ลูกค้า</h3>
            
            <div class="row mb-4" style="color: var(--text-color);">
                <div class="col-md-6">
                    <p><strong>รหัสลูกค้า:</strong> <?php echo $customer['customer_id']; ?></p>
                    <p><strong>ชื่อ-นามสกุล:</strong> <?php echo $customer['customer_name']; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>เบอร์โทรศัพท์:</strong> <?php echo $customer['phone_number']; ?></p>
                    <p><strong>ประเภทสมาชิก:</strong> <span class="badge bg-primary"><?php echo $customer['customer_type']; ?></span></p>
                </div>
            </div>

            <h4 class="mt-5 mb-3" style="color: #93c5fd;">ประวัติการสั่งซื้อ</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-2">
                    <thead>
                        <tr>
                            <th>รหัสคำสั่งซื้อ</th>
                            <th>วันที่สั่งซื้อ</th>
                            <th>ชื่อสินค้า (เกม)</th>
                            <th>จำนวน</th>
                            <th>ยอดรวม (บาท)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result_order) > 0) {
                            while ($row = mysqli_fetch_array($result_order)) {
                                echo "<tr>";
                                echo "<td>" . $row['order_id'] . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['order_qty'] . "</td>";
                                echo "<td>" . number_format($row['total_amount'], 2) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>ยังไม่มีประวัติการสั่งซื้อ</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php mysqli_close($conn); ?>