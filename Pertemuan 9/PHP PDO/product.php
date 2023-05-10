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
                <a class="nav-link" href="index.php">Data Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="product.php">Data Products</a>
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
                echo '<br><br><div class="alert alert-success" role="alert">Data Product berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Product gagal di-update</div>';
              }

            }
           ?>
          <h2 style="margin: 30px 0 30px 0;">Products</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Product Line</th>
                  <th>Product Scale</th>
                  <th>Product Vendor</th>
                  <th>Product Description</th>
                  <th>Quantity In Stock</th>
                  <th>Buy Price</th>
                  <th>MSRP</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM products";
                  $result = $conn->query($query);
                 ?>

                 <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                  <tr>
                    <td><?php echo $data['productCode'];  ?></td>
                    <td><?php echo $data['productName'];  ?></td>
                    <td><?php echo $data['productLine'];  ?></td>
                    <td><?php echo $data['productScale']; ?></td>
                    <td><?php echo $data['productVendor']; ?></td>
                    <td><?php echo $data['productDescription']; ?></td>
                    <td><?php echo $data['quantityInStock']; ?></td>
                    <td><?php echo $data['buyPrice']; ?></td>
                    <td><?php echo $data['MSRP']; ?></td>
                    <td>
                      <a href="<?php echo "updateProduct.php?id=".$data['productCode']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "deleteProduct.php?id=".$data['productCode']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
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

