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
          $productCode_update = $_GET['id'];
          $query = "SELECT * FROM products WHERE productCode = '$productCode_update'";

          //eksekusi query
          $result = $conn->query($query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productCode = $_POST['productCode'];
      $productName = $_POST['productName'];
      $productLine = $_POST['productLine'];
      $productScale = $_POST['productScale'];
      $productVendor = $_POST['productVendor'];
      $productDescription = $_POST['productDescription'];
      $quantityInStock = $_POST['quantityInStock'];
      $buyPrice = $_POST['buyPrice'];
      $MSRP = $_POST['MSRP'];
      //query SQL
      $sql = "UPDATE products SET productName='$productName', productLine='$productLine', productScale='$productScale',productVendor='$productVendor',productDescription='$productDescription',quantityInStock='$quantityInStock', buyPrice='$buyPrice',MSRP='$MSRP' WHERE productCode='$productCode'";

      //eksekusi query
      if ($conn->query($sql)) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: product.php?status='.$status);
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


          <h2 style="margin: 30px 0 30px 0;">Update Data Customer</h2>
          <form action="updateProduct.php" method="POST">
          <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
            <div class="form-group">
              <label>Product Code</label>
              <input type="text" class="form-control" placeholder="Product Code" value="<?= $data['productCode'] ?>" name="productCode" required="required">
            </div>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="Product Name" value="<?= $data['productName'] ?>" name="productName" required="required">
            </div>
            <!-- SELECT -->
            <?php 
                  $queryLine = "SELECT productLine FROM productlines";
                  $resultLine = $conn->query($queryLine);
                 ?>
             <div class="form-group">
              <label>Product Line</label>
              <select class="custom-select" name="productLine" required="required">
                <option value="">Pilih Salah Satu</option>
                <?php while($dataLine = $resultLine->fetch(PDO::FETCH_ASSOC) ): ?>
                  <option value="<?= $dataLine['productLine'] ?>" <?= $dataLine['productLine'] == $data['productLine'] ? "selected" : "" ?>><?= $dataLine['productLine'] ?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label>Product Scale</label>
              <input type="text" class="form-control" placeholder="Product Scale" value="<?= $data['productScale'] ?>" name="productScale" required="required">
            </div>
            <div class="form-group">
              <label>Product Vendor</label>
              <input type="text" class="form-control" placeholder="Product Vendor" value="<?= $data['productVendor'] ?>" name="productVendor" required="required">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <input type="text" class="form-control" placeholder="Product Description" value="<?= $data['productDescription'] ?>" name="productDescription" required="required">
            </div>
            <div class="form-group">
              <label>Quantity In Stock</label>
              <input type="text" class="form-control" placeholder="Quantity In Stock" value="<?= $data['quantityInStock'] ?>" name="quantityInStock" required="required">
            </div>
            <div class="form-group">
              <label>Buy Price</label>
              <input type="text" class="form-control" placeholder="Buy Price" value="<?= $data['buyPrice'] ?>" name="buyPrice" required="required">
            </div>
            <div class="form-group">
              <label>MSRP</label>
              <input type="text" class="form-control" placeholder="MSRP" value="<?= $data['MSRP'] ?>" name="MSRP" required="required">
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
