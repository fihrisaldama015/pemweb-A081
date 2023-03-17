<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 

  $status = '';
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
      $query = "INSERT INTO customers VALUES('$customerNumber','$customerName','$contactLastName','$contactFirstName','$phone','$addressLine1','$addressLine2','$city','$state','$postalCode','$country','$salesRepEmployeeNumber','$creditLimit')"; 

      //eksekusi query
      $result = mysqli_query(connection(),$query);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add Customer | Pemweb A081</title>
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
                <a class="nav-link" href="index.php">Data Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="product.php">Data Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="form.php">Tambah Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="formProduct.php">Tambah Data Product</a>
              </li>
            </ul>
            
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customers gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Form Customer</h2>
          <form action="form.php" method="POST">
            
            <div class="form-group">
              <label>Customer Number</label>
              <input type="text" class="form-control" placeholder="> 497" name="customerNumber" required="required">
            </div>
            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" class="form-control" placeholder="Name..." name="customerName" required="required">
            </div>
            <div class="form-group">
              <label>Contact Last Name</label>
              <input type="text" class="form-control" placeholder="Last Name..." name="contactLastName" required="required">
            </div>
            <div class="form-group">
              <label>Contact First Name</label>
              <input type="text" class="form-control" placeholder="First Name..." name="contactFirstName" required="required">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" placeholder="085*****9426" name="phone" required="required">
            </div>
            <div class="form-group">
              <label>Address Line 1</label>
              <input type="text" class="form-control" placeholder="Jl Street..." name="addressLine1" required="required">
            </div>
            <div class="form-group">
              <label>Address Line 2</label>
              <input type="text" class="form-control" placeholder="Address Details" name="addressLine2" >
            </div>
            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" placeholder="Surabaya..." name="city" required="required">
            </div>
            <div class="form-group">
              <label>State</label>
              <input type="text" class="form-control" placeholder="Jawa Timur..." name="state" required="required">
            </div>
            <div class="form-group">
              <label>Postal Code</label>
              <input type="text" class="form-control" placeholder="614..." name="postalCode" required="required">
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" class="form-control" placeholder="Indonesia..." name="country" required="required">
            </div>
             <!-- SELECT -->
             <?php 
                  $query = "SELECT employeeNumber FROM employees";
                  $result = mysqli_query(connection(),$query);
                 ?>
             <div class="form-group">
              <label>Sales Rep Employee Number</label>
              <select class="custom-select" name="salesRepEmployeeNumber" required="required">
                <option value="">Pilih Salah Satu</option>
                <?php while($data = mysqli_fetch_array($result)): ?>
                  <option value="<?= $data['employeeNumber'] ?>"><?= $data['employeeNumber'] ?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label>Credit Limit</label>
              <input type="text" class="form-control" placeholder="100000..." name="creditLimit" required="required">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>