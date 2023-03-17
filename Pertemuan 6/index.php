<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Pertemuan 6 | Pemweb A081</title>
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
          <?php 
            //mengecek apakah proses update dan delete sukses/gagal
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal di-update</div>';
              }

            }
           ?>
          <h2 style="margin: 30px 0 30px 0;">Customers</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Customer No.</th>
                  <th>Name</th>
                  <th>Contact Last Name</th>
                  <th>Contact First Name</th>
                  <th>Phone</th>
                  <th>Address 1</th>
                  <th>Address 2</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Postal Code</th>
                  <th>Country</th>
                  <th>SalesRepEmployeeNumber</th>
                  <th>Credit Limit</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM customers";
                  $result = mysqli_query(connection(),$query);
                 ?>

                 <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <td><?php echo $data['customerNumber'];  ?></td>
                    <td><?php echo $data['customerName'];  ?></td>
                    <td><?php echo $data['contactLastName'];  ?></td>
                    <td><?php echo $data['contactFirstName'];  ?></td>
                    <td><?php echo $data['phone'];  ?></td>
                    <td><?php echo $data['addressLine1'];  ?></td>
                    <td><?php echo $data['addressLine2'];  ?></td>
                    <td><?php echo $data['city'];  ?></td>
                    <td><?php echo $data['state'];  ?></td>
                    <td><?php echo $data['postalCode'];  ?></td>
                    <td><?php echo $data['country'];  ?></td>
                    <td><?php echo $data['salesRepEmployeeNumber'];  ?></td>
                    <td><?php echo $data['creditLimit'];  ?></td>
                    <td>
                      <a href="<?php echo "update.php?id=".$data['customerNumber']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "delete.php?id=".$data['customerNumber']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                    </td>
                  </tr>
                 <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>

