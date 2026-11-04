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

        /* ===== กราฟแท่งแนวตั้ง แบบแท่งชิดกัน ===== */
        .vertical-chart-container {
    display: flex;
    justify-content: flex-start;   /* หรือ flex-start ถ้าอยากชิดซ้าย */
    align-items: flex-end;
    gap: 8px;                    /* ระยะห่างระหว่างแท่ง = 0 คือชิดกันสนิท ปรับเป็น 2px,4px ได้ถ้าอยากให้ห่างนิดหน่อย */
    margin-top: 20px;
    padding: 0;
}
.vertical-chart-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 60px;           /* เท่าความกว้างแท่งเดิม */
    flex: 0 0 auto;         /* ห้ามยืด/หด */
    text-align: center;
    color: var(--text-color);
    font-size: 12px;
}
.vertical-chart-value {
    font-size: 11px;
    margin-bottom: 4px;
    color: var(--text-color);
    white-space: nowrap;
}
.vertical-chart-bar {
    width: 60px;             /* คงเดิม ไม่เปลี่ยน */
    background: linear-gradient(180deg, #a78bfa 0%, #8b5cf6 100%);  /* สีเดิม ไม่แตะ */
    border-radius: 6px 6px 0 0;
    min-height: 2px;
    box-shadow: none;
}
.vertical-chart-label {
    margin-top: 6px;
    font-size: 11px;
    color: var(--text-color);
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
      </div>
    </div>
  </div>

</nav>
  <div class="text-center mt-4 mb-4 h3 alert alert-success" role="alert">
ยอดซื้อรวมต่อลูกค้าเว็บเติมเกม
</div>
<?php
include("connect.php");

$sql = "SELECT customer.customer_id, customer.customer_name, SUM(`order`.total_amount) AS sumcost
        FROM `order`
        INNER JOIN customer ON `order`.customer_id = customer.customer_id
        GROUP BY customer.customer_id, customer.customer_name
        ORDER BY sumcost DESC";

$result = mysqli_query($conn, $sql);
$rows = [];
$max_cost = 0;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
        $row_cost = (float) $row['sumcost'];
        if ($row_cost > $max_cost) {
            $max_cost = $row_cost;
        }
    }
}
?>
<!-- แสดงรายชื่อลูกค้าที่ซื้อมากที่สุด -->
    <table class="table table-striped">
    <tr>
        <th class="text-center">อันดับ</th>
        <th>รหัสลูกค้า</th>
        <th>ชื่อลูกค้า</th>
        <th>ยอดซื้อรวม</th>
    </tr>
    <?php
    if (count($rows) > 0) {
        $top = 1;
        foreach ($rows as $row) {
            echo "<tr>
                    <td align='center'>" . $top . "</td>
                    <td>" . $row["customer_id"] . "</td>
                    <td>" . $row["customer_name"] . "</td>
                    <td align='right'>" . number_format($row["sumcost"], 2) . " บาท</td>
                </tr>";
            $top++;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>0 results</td></tr>";
    }

    mysqli_close($conn);
    ?>
    </table>

<?php
include("connect.php");

$sql = "SELECT customer.customer_id, customer.customer_name, SUM(`order`.total_amount) AS sumcost
        FROM `order`
        INNER JOIN customer ON `order`.customer_id = customer.customer_id
        GROUP BY customer.customer_id, customer.customer_name
        ORDER BY sumcost DESC LIMIT 10";

$result = mysqli_query($conn, $sql);
$chart_rows = [];
$chart_max = 0;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $chart_rows[] = $row;
        if ((float) $row['sumcost'] > $chart_max) {
            $chart_max = (float) $row['sumcost'];
        }
    }
}
?>

<div class="mt-5">
    
    <div class="vertical-chart-container">
        <?php
        if (count($chart_rows) > 0) {
            $chart_rank = 1;
            foreach ($chart_rows as $row) {
                $height = $chart_max > 0 ? (int) ((float) $row['sumcost'] / $chart_max * 200) : 0;
                if ($height < 2) $height = 2;
                echo "<div class='vertical-chart-col'>
                        <div class='vertical-chart-value'>" . number_format($row['sumcost'], 0) . "</div>
                        <div style='height: " . $height . "px;' class='vertical-chart-bar'></div>
                        <div class='vertical-chart-label'>" . $row['customer_id'] . "</div>
                        <div class='vertical-chart-label'>#" . $chart_rank . "</div>
                      </div>";
                $chart_rank++;
            }
        } else {
            echo "<div class='text-center'>0 results</div>";
        }
        ?>
    </div>
</div>
<!-- end container -->
</body>
</html>