<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 

  $status = '';
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
      $query = "INSERT INTO products VALUES('$productCode','$productName','$productLine','$productScale','$productVendor','$productDescription','$quantityInStock','$buyPrice','$MSRP')"; 

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
    <title>Add Product | Pemweb A081</title>
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
                <a class="nav-link" href="form.php">Tambah Data Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="formProduct.php">Tambah Data Product</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Product berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Product gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Form Products</h2>
          <form action="formProduct.php" method="POST">
            <div class="form-group">
              <label>Product Code</label>
              <input type="text" class="form-control" placeholder="Product Code" name="productCode" required="required">
            </div>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="Product Name" name="productName" required="required">
            </div>
            <!-- SELECT -->
            <?php 
                  $query = "SELECT productLine FROM productlines";
                  $result = mysqli_query(connection(),$query);
                 ?>
             <div class="form-group">
              <label>Product Line</label>
              <select class="custom-select" name="productLine" required="required">
                <option value="">Pilih Salah Satu</option>
                <?php while($data = mysqli_fetch_array($result)): ?>
                  <option value="<?= $data['productLine'] ?>"><?= $data['productLine'] ?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label>Product Scale</label>
              <input type="text" class="form-control" placeholder="Product Scale" name="productScale" required="required">
            </div>
            <div class="form-group">
              <label>Product Vendor</label>
              <input type="text" class="form-control" placeholder="Product Vendor" name="productVendor" required="required">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <input type="text" class="form-control" placeholder="Product Description" name="productDescription" required="required">
            </div>
            <div class="form-group">
              <label>Quantity In Stock</label>
              <input type="text" class="form-control" placeholder="Quantity In Stock" name="quantityInStock" required="required">
            </div>
            <div class="form-group">
              <label>Buy Price</label>
              <input type="text" class="form-control" placeholder="Buy Price" name="buyPrice" required="required">
            </div>
            <div class="form-group">
              <label>MSRP</label>
              <input type="text" class="form-control" placeholder="MSRP" name="MSRP" required="required">
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