<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
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
        .order-card {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.3);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.25);
        }
        .table-card {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.3);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.2);
        }
        .table thead th {
            background-color: #e0f2fe;
            color: #0f172a;
            font-weight: 700;
        }
        .recent-orders-scroll {
          max-height: 290px;
          overflow-y: auto;
        }
        .recent-orders-scroll thead th {
          position: sticky;
          top: 0;
          z-index: 1;
        }
    </style>
  <img src="../banner.jpg" alt="Zenith banner" class="banner img-fluid w-100 h-100" style="max-height: auto px; object-fit: cover;">
<br><br>
<nav class="navbar navbar-expand-lg navbar-custom mb-4">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="/database/7.jpg">Zenith</a>
    <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/database/Product_MasterFile/showalldata_product.php">Product</a>
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
        <a class="btn btn-primary btn-sm" href="/database/Login_MasterFile/login.php" role="button">LOGIN</a>
        <a class="btn btn-secondary btn-sm" href="/database/aboutme.html" role="button">HOME</a>
       
      </div>
    </div>
  </div>
</nav>
<div class="text-center mt-4 mb-4 h3 alert alert-success" role="alert">
การสั่งซื้อสินค้าเว็บเติมเกม
</div>

<div class="container">
  <div class="row g-4 align-items-start">
    <div class="col-lg-5">
      <div class="order-card">
        <!-- ส่งข้อมูลไปยังไฟล์ประมวลผล order_save.php ของ Order -->
        <form action="order_save.php" method="post">
          <label for="" class="fw-bold mb-2">เลือกชื่อลูกค้า</label>
          <select name="customer_id" class="form-control mb-3" required>
              <option value="">-- กรุณาเลือกลูกค้า --</option>
              <?php
              include("connect.php"); // เชื่อมต่อฐานข้อมูล
              // ดึงรหัสและชื่อลูกค้ามาสร้างตัวเลือก
              $sql_cust = "SELECT customer_id, customer_name FROM customer";
              $res_cust = mysqli_query($conn, $sql_cust);
              while($row_cust = mysqli_fetch_assoc($res_cust)) {
                  echo "<option value='".$row_cust['customer_id']."'>".$row_cust['customer_id']." - ".$row_cust['customer_name']."</option>";
              }
              ?>
          </select>

          <label for="" class="fw-bold mb-2">เลือกรายการสินค้า/เกม</label>
          <select name="product_id" id="productSelect" class="form-control mb-3" required>
              <option value="">-- กรุณาเลือกสินค้า --</option>
              <?php
              // ดึงรหัส ชื่อสินค้า และจำนวนสต็อกจากตาราง product
              $sql_prod = "SELECT product_id, product_name, product_stock FROM product ORDER BY product_id ASC";
              $res_prod = mysqli_query($conn, $sql_prod);
              while($row_prod = mysqli_fetch_assoc($res_prod)) {
                  echo "<option value='".$row_prod['product_id']."' data-stock='".$row_prod['product_stock']."'>".$row_prod['product_id']." - ".$row_prod['product_name']."</option>";
              }
              ?>
          </select>

          <label for="" class="fw-bold mb-2">จำนวนสต็อกสินค้า</label>
          <input type="number" id="order_amount" name="order_qty" class="form-control mb-3" min="1" placeholder="เลือกสินค้าก่อน" required>

          <div class="d-flex justify-content-between align-items-center gap-2 mt-3">
            <div class="d-flex gap-2">
              <input type="submit" value="บันทึก" class="btn btn-success">
              <input type="reset" value="เคลียร์" class="btn btn-warning">
            </div>
            <a href="showalldata_order.php" class="btn btn-info">สรุป</a>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="table-card">
        <h5 class="mb-3 text-white">รายการคำสั่งซื้อ</h5>
        <div class="table-responsive recent-orders-scroll">
          <table class="table table-striped table-hover mb-0">
            <thead>
              <tr>
                <th>รายการที่</th>
                <th>รหัสลูกค้า-ชื่อลูกค้า</th>
                <th>รหัสสินค้า-ชื่อสินค้า</th>
                <th>จำนวนแพ็คเกจ</th>
                <th>ราคาแพ็คเกจ</th>
                <th>รวม</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // แก้ไขคำสั่ง SQL ให้ INNER JOIN เชื่อมโยง 3 ตารางของระบบเติมเกม
                    $sql = "SELECT `order`.order_id, `order`.customer_id, `customer`.customer_name,
                       `order`.product_id, `product`.product_name,
                       `order`.pack_quantity, `order`.pack_price, `order`.total_amount
                      FROM `order`
                      INNER JOIN `customer` ON `order`.customer_id = `customer`.customer_id
                      INNER JOIN `product` ON `order`.product_id = `product`.product_id
                      ORDER BY order_id DESC LIMIT 10";

              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      echo "<tr><td>" . $row["order_id"] .
                           "</td><td>" . $row["customer_id"] . " " . $row["customer_name"] .
                           "</td><td>" . $row["product_id"] . " " . $row["product_name"] .
                           "</td><td>" . $row["pack_quantity"] .
                           "</td><td>" . number_format($row["pack_price"], 2) . " บาท" .
                           "</td><td>" . number_format($row["total_amount"], 2) . " บาท</td></tr>";
                  }
              } else {
                  echo "<tr><td colspan='6' class='text-center'>0 results</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4 mt-2">
    <div class="col-lg-6">
      <div class="table-card">
        <h5 class="mb-3 text-white">สินค้าในระบบ</h5>
        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0">
            <thead>
              <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>สต็อก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql_product = "SELECT product_id, product_name, product_price, product_stock FROM product ORDER BY product_id ASC LIMIT 10";
              $result_product = mysqli_query($conn, $sql_product);

              if (mysqli_num_rows($result_product) > 0) {
                  while($row_product = mysqli_fetch_assoc($result_product)) {
                      echo "<tr>
                              <td>" . $row_product['product_id'] . "</td>
                              <td>" . $row_product['product_name'] . "</td>
                              <td>" . number_format($row_product['product_price'], 2) . "</td>
                              <td>" . $row_product['product_stock'] . "</td>
                            </tr>";
                  }
              } else {
                  echo "<tr><td colspan='4' class='text-center'>0 results</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="table-card">
        <h5 class="mb-3 text-white">ลูกค้าในระบบ</h5>
        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0">
            <thead>
              <tr>
                <th>รหัสลูกค้า</th>
                <th>ชื่อลูกค้า</th>
                <th>อีเมล</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql_customer = "SELECT customer_id, customer_name, phone_number FROM customer ORDER BY customer_id ASC LIMIT 10";
              $result_customer = mysqli_query($conn, $sql_customer);

              if (mysqli_num_rows($result_customer) > 0) {
                  while($row_customer = mysqli_fetch_assoc($result_customer)) {
                      echo "<tr>
                              <td>" . $row_customer['customer_id'] . "</td>
                              <td>" . $row_customer['customer_name'] . "</td>
                              <td>" . $row_customer['phone_number'] . "</td>
                            </tr>";
                  }
              } else {
                  echo "<tr><td colspan='3' class='text-center'>0 results</td></tr>";
              }
              mysqli_close($conn);
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const productSelect = document.getElementById('productSelect');
  const orderAmount = document.getElementById('order_amount');

  if (productSelect && orderAmount) {
    const updateStockInput = () => {
      const selectedOption = productSelect.options[productSelect.selectedIndex];
      const stock = Number(selectedOption?.dataset.stock || 0);

      orderAmount.value = '';
      orderAmount.min = '1';
      orderAmount.max = stock > 0 ? stock : 1;
      orderAmount.placeholder = stock > 0 ? 'เลือก 1 - ' + stock : 'เลือกสินค้าก่อน';
      orderAmount.setAttribute('data-max-stock', String(stock));

      if (!selectedOption || !selectedOption.value) {
        orderAmount.value = '';
        orderAmount.disabled = true;
      } else {
        orderAmount.disabled = false;
      }
    };

    productSelect.addEventListener('change', updateStockInput);

    orderAmount.disabled = true;
    orderAmount.addEventListener('input', function () {
      const maxStock = Number(this.getAttribute('data-max-stock') || 0);
      if (maxStock > 0 && Number(this.value) > maxStock) {
        this.value = maxStock;
      }
      if (Number(this.value) < 1) {
        this.value = 1;
      }
    });

    updateStockInput();
  }
</script>
</body>
</html>