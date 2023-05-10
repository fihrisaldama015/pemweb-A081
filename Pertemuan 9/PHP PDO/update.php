<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          //query SQL
          $customerNumber_update = $_GET['id'];
          $query = "SELECT * FROM customers WHERE customerNumber = $customerNumber_update";

          //eksekusi query
          $result = $conn->query($query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $customerNumber = $_POST['customerNumber'];
      $customerName = $_POST['customerName'];
      $contactLastName = $_POST['contactLastName'];
      $contactFirstName = $_POST['contactFirstName'];
      $phone = $_POST['phone'];
      $addressLine1 = $_POST['addressLine1'];
      $addressLine2 = $_POST['addressLine2'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $postalCode = $_POST['postalCode'];
      $country = $_POST['country'];
      $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
      $creditLimit = $_POST['creditLimit'];
      //query SQL
      $sql = "UPDATE customers SET customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName', phone='$phone',addressLine1='$addressLine1',addressLine2='$addressLine2',city='$city',state='$state',postalCode='$postalCode',country='$country',salesRepEmployeeNumber='$salesRepEmployeeNumber',creditLimit='$creditLimit' WHERE customerNumber=$customerNumber";

      //eksekusi query
      if ($conn->query($sql)) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: index.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Example</title>
    <!-- load css boostrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">M. Fihris Aldama</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Data Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="product.php">Data Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="form.php">Tambah Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="formProduct.php">Tambah Data Product</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


          <h2 style="margin: 30px 0 30px 0;">Update Data Customer</h2>
          <form action="update.php" method="POST">
            <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
              <div class="form-group">
              <label>Customer Number</label>
              <input type="text" class="form-control" placeholder="> 497" value="<?= $data['customerNumber'] ?>" name="customerNumber" readonly>
            </div>
            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" class="form-control" placeholder="Name..." value="<?= $data['customerName'] ?>" name="customerName" required="required">
            </div>
            <div class="form-group">
              <label>Contact Last Name</label>
              <input type="text" class="form-control" placeholder="Last Name..." value="<?= $data['contactLastName'] ?>" name="contactLastName" required="required">
            </div>
            <div class="form-group">
              <label>Contact First Name</label>
              <input type="text" class="form-control" placeholder="First Name..." value="<?= $data['contactFirstName'] ?>" name="contactFirstName" required="required">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" placeholder="085*****9426" value="<?= $data['phone'] ?>" name="phone" required="required">
            </div>
            <div class="form-group">
              <label>Address Line 1</label>
              <input type="text" class="form-control" placeholder="Jl Street..." value="<?= $data['addressLine1'] ?>" name="addressLine1" required="required">
            </div>
            <div class="form-group">
              <label>Address Line 2</label>
              <input type="text" class="form-control" placeholder="Address Details" value="<?= $data['addressLine2'] ?>" name="addressLine2" >
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" placeholder="Surabaya..." value="<?= $data['city'] ?>" name="city" required="required">
            </div>
            <div class="form-group">
              <label>State</label>
              <input type="text" class="form-control" placeholder="Jawa Timur..." value="<?= $data['state'] ?>" name="state">
            </div>
            <div class="form-group">
              <label>Postal Code</label>
              <input type="text" class="form-control" placeholder="614..." value="<?= $data['postalCode'] ?>" name="postalCode" required="required">
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" class="form-control" placeholder="Indonesia..." value="<?= $data['country'] ?>" name="country" required="required">
            </div>
            <?php 
                  $querySalesRep = "SELECT employeeNumber FROM employees";
                  $resultSalesRep = $conn->query($querySalesRep);
            ?>
            <div class="form-group">
              <label>Sales Rep Employee Number</label>
              <select class="custom-select" name="salesRepEmployeeNumber" required="required">
                <option value="">Pilih Salah Satu</option>
                <?php while($dataSalesRep = $resultSalesRep->fetch(PDO::FETCH_ASSOC) ): ?>
                  <option value="<?= $dataSalesRep['employeeNumber'] ?>" <?= $dataSalesRep['employeeNumber'] == $data['salesRepEmployeeNumber'] ? "selected" : "" ?>><?= $dataSalesRep['employeeNumber'] ?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label>Credit Limit</label>
              <input type="text" class="form-control" placeholder="100000..." value="<?= $data['creditLimit'] ?>" name="creditLimit" required="required">
            </div>
            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
