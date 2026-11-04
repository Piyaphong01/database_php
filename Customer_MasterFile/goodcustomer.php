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
        .bar-chart {
            position: relative;
            width: 100%;
            height: 24px;
            background-color: var(--card-bg);
            border-radius: 4px;
            overflow: hidden;
        }
        .bar-chart-fill {
            height: 100%;
            background-color: var(--accent-color);
            border-radius: 4px;
        }
        .bar-chart-percent {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.75);
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .bar-chart:hover .bar-chart-percent {
            opacity: 1;
        }
    </style>
</head>
<body>
    <img clsss="banner" src="../banner.jpg" alt="Zenith banner" class="img-fluid w-100 h-100" style="max-height: auto px; object-fit: cover;">
<br><br>
<div class="container">
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
      </div>
    </div>
  </div>
</nav>

<div class="text-center mt-4 mb-4 h3 alert alert-success" role="alert">
ลูกค้าชั้นดีของเว็บเติมเกม
</div>
<?php
include("connect.php");

// ดึงยอดขายรวมต่อลูกค้า เรียงจากมากไปน้อย
$sql = "SELECT customer.customer_id, customer_name, SUM(`order`.total_amount) AS sumcost
FROM `order`
INNER JOIN customer ON `order`.customer_id = customer.customer_id
GROUP BY customer.customer_id, customer_name
ORDER BY SUM(`order`.total_amount) DESC";
$result = mysqli_query($conn, $sql);

// หายอดสูงสุดไว้ก่อน เพื่อใช้คำนวณสัดส่วนแท่งกราฟ (ไม่ให้ยาวทะลุจอ)
$rows = [];
$max_cost = 0;
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
        if ($row['sumcost'] > $max_cost) {
            $max_cost = $row['sumcost'];
        }
    }
}
?>

<table class="table table-striped">
<tr>
    <th class="text-center">รายการที่</th>
    <th>ลูกค้า</th>
    <th>ยอดซื้อรวม</th>
    <th class="text-center">กราฟยอดขาย</th>
</tr>
<?php
if (count($rows) > 0) {
    $top = 1;
    foreach ($rows as $row) {
        // คำนวณความกว้างแท่งกราฟเป็นเปอร์เซ็นต์ โดยยอดสูงสุดกว้าง 100%
        $bar_width = $max_cost > 0 ? round(($row["sumcost"] / $max_cost) * 100, 2) : 0;
        echo "<tr>
                <td align='center'>" . $top . "</td>
                <td>" . $row["customer_name"] . "</td>
                <td align='right'>" . number_format($row["sumcost"], 2) . " บาท</td>
                <td class='text-center'>
                                    <div class='bar-chart'>
                                        <div class='bar-chart-fill' style='width:" . $bar_width . "%;'></div>
                                        <span class='bar-chart-percent'>" . $bar_width . "%</span>
                                    </div>
                </td>
              </tr>";
        $top++;
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>0 results</td></tr>";
}
mysqli_close($conn);
?>
</table>
<!-- end container -->
</body>
</html>