<?php
include("connect.php"); // ติดต่อฐานข้อมูล
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seller System - ระบบซื้อขาย</title>
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
        * {
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
        /* เพิ่ม CSS สำหรับการ์ดสินค้าที่คลิกได้ */
        .product-card {
            background-color: #2d3748;
            border: 1px solid #4a5568;
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: transform 0.2s, border-color 0.2s;
            text-align: center;
        }
        .product-card:hover {
            transform: scale(1.05);
            border-color: var(--accent-color);
        }
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #1a202c;
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

<div class="container">
    <div class="text-center mt-4 mb-4 h3 alert" style="background-color: var(--card-bg); color: var(--accent-color); border: 1px solid var(--accent-color);" role="alert">
        ระบบซื้อ-ขาย เว็บเติมเกม (Seller)
    </div>

    <div class="row">
        <!-- ฝั่งซ้าย: ฟอร์มป้อนรายการซื้อขาย -->
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: var(--card-bg); border-color: var(--border-color);">
                <div class="card-body">
                    <h5 class="card-title text-info border-bottom border-secondary pb-2">ป้อนรายการซื้อ-ขาย</h5>
                    <form action="insert_order.php" method="post">
                        <div class="mb-3 mt-3">
                            <label>รหัสลูกค้า</label>
                            <input type="text" name="customer_id" class="form-control" placeholder="กรอกรหัสลูกค้า" required>
                        </div>
                        <div class="mb-3">
                            <label>รหัสสินค้า <span class="text-warning text-sm">(คลิกรูปสินค้าขวามือ)</span></label>
                            <!-- ช่องรหัสสินค้าที่จะถูกเติมอัตโนมัติเมื่อคลิกรูป -->
                            <input type="text" name="product_id" id="selected_product_id" class="form-control" placeholder="เลือกรหัสสินค้า" readonly required>
                        </div>
                        <div class="mb-3">
                            <label>จำนวนที่ซื้อ</label>
                            <input type="number" name="order_qty" class="form-control" placeholder="ใส่จำนวน" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mb-2">บันทึกรายการซื้อ (Submit)</button>
                        <button type="reset" class="btn btn-warning w-100" onclick="document.getElementById('selected_product_id').value = '';">ล้างข้อมูล (Clear)</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ฝั่งขวา: รายการสินค้าในร้าน (คลิกได้) -->
        <div class="col-md-8">
            <div class="card" style="background-color: var(--card-bg); border-color: var(--border-color);">
                <div class="card-body">
                    <h5 class="card-title text-warning border-bottom border-secondary pb-2">รายการสินค้าในร้าน (คลิกเพื่อเลือก)</h5>
                    <div class="row mt-3">
                        <?php
                        $sql = "SELECT * FROM product";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                // ดึงค่าจากตาราง product เพื่อแสดงผล
                                $p_id = $row["product_id"];
                                $p_name = $row["product_name"];
                                $p_price = $row["product_price"];
                                $p_stock = $row["product_stock"];
                                
                                $image_file = null;
                                $image_names = array(
                                    trim($p_name),
                                    preg_replace('/\s+/', '', trim($p_name))
                                );
                                foreach ($image_names as $image_name) {
                                    foreach (array(".jpg", ".jpeg", ".png") as $extension) {
                                        $candidate_file = $image_name . $extension;
                                        if (file_exists(__DIR__ . "/../" . $candidate_file)) {
                                            $image_file = $candidate_file;
                                            break 2;
                                        }
                                    }
                                }
                                $image_src = $image_file !== null
                                    ? "../" . rawurlencode($image_file)
                                    : "https://via.placeholder.com/80/1e293b/FFFFFF?text=NO+IMG";

                                echo "
                                <div class='col-sm-4 col-6 mb-3'>
                                    <div class='product-card' onclick='selectProduct($p_id)'>
                                        <div class='text-secondary small'>รหัส: $p_id</div>
                                        <img src='$image_src' alt='รูปเกม $p_name' class='product-img'>
                                        <div class='fw-bold text-white text-truncate' title='$p_name'>$p_name</div>
                                        <div class='text-success small mt-1'>ราคา: $p_price บาท</div>
                                        <div class='text-muted small'>คงเหลือ: $p_stock</div>
                                    </div>
                                </div>
                                ";
                            }
                        } else {
                            echo "<div class='col-12'><p>ไม่มีสินค้าในระบบ</p></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <hr class="border-secondary mt-5">

    <!-- ส่วนแสดงประวัติล่าสุด 10 รายการ -->
    <h4 class="mt-4 mb-3 text-info">แสดงรายการซื้อ-ขาย ล่าสุด 10 รายการ</h4>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>รายการที่ (Order ID)</th>
                    <th>ผู้ซื้อ (ลูกค้า)</th>
                    <th>สินค้าที่ซื้อ</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวนที่ซื้อ</th>
                    <th>ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ใช้ INNER JOIN ดึงข้อมูล 10 รายการล่าสุด
                $sql_history = "SELECT o.order_id, c.customer_name, p.product_name, p.product_price, o.order_qty 
                                FROM `order` o 
                                INNER JOIN `product` p ON o.product_id = p.product_id 
                                INNER JOIN `customer` c ON o.customer_id = c.customer_id 
                                ORDER BY o.order_id DESC LIMIT 10";
                
                $result_history = mysqli_query($conn, $sql_history);
                $total_all_10 = 0; // ตัวแปรเก็บยอดรวมทั้งหมด

                if (mysqli_num_rows($result_history) > 0) {
                    while($row = mysqli_fetch_assoc($result_history)) {
                        $line_total = $row["product_price"] * $row["order_qty"];
                        $total_all_10 += $line_total;

                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . number_format($row["product_price"], 2) . "</td>";
                        echo "<td>" . $row["order_qty"] . "</td>";
                        echo "<td class='text-success fw-bold'>" . number_format($line_total, 2) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>ยังไม่มีประวัติการซื้อขาย</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-end h5 text-warning mt-3">
            รวมจำนวนเงินในการซื้อ-ขาย 10 รายการล่าสุด = <?php echo number_format($total_all_10, 2); ?> บาท
        </div>
    </div>

</div>

<!-- JavaScript สำหรับการคลิกการ์ดสินค้าแล้วเติมรหัสในฟอร์ม -->
<script>
function selectProduct(productId) {
    // นำค่า ID สินค้าที่รับมา ไปใส่ในช่อง input ที่มี id="selected_product_id"
    document.getElementById('selected_product_id').value = productId;
    
    // ไฮไลต์ช่องเบาๆ เพื่อให้รู้ว่าข้อมูลเข้าแล้ว
    let inputField = document.getElementById('selected_product_id');
    inputField.style.backgroundColor = '#d1fae5'; // สีเขียวอ่อน
    inputField.style.color = '#065f46';
    setTimeout(() => {
        inputField.style.backgroundColor = '';
        inputField.style.color = '';
    }, 500);
}
</script>

</body>
</html>
<?php mysqli_close($conn); ?>