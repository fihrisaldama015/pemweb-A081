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
          $employeeNumber_update = $_GET['id'];
          $query = "SELECT * FROM employees WHERE employeeNumber = $employeeNumber_update";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $employeeNumber = $_POST['employeeNumber'];
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $jobTitle = $_POST['jobTitle'];
      $email = $_POST['email'];
      $officeCode = $_POST['officeCode'];
      //query SQL
      $sql = "UPDATE employees SET firstName='$firstName', lastName='$lastName', jobTitle='$jobTitle', officeCode='$officeCode' WHERE employeeNumber=$employeeNumber";

      //eksekusi query
      $result = mysqli_query(connection(),$sql);
      if ($result) {
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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Pemrograman Web</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "index.php"; ?>">Data Employees</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "product.php"; ?>">Data Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Data</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


          <h2 style="margin: 30px 0 30px 0;">Update Data Employee</h2>
          <form action="update.php" method="POST">
            <?php while($data = mysqli_fetch_array($result)): ?>
            <div class="form-group">
              <label>Employee Number</label>
              <input type="text" class="form-control" placeholder="Employee Number" name="employeeNumber" value="<?php echo $data['employeeNumber'];  ?>" required="required" readonly>
            </div>
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" placeholder="First Name" name="firstName" value="<?php echo $data['firstName'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="<?php echo $data['lastName'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="name@example.com" name="email" value="<?php echo $data['email'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Job Title</label>
              <select class="custom-select" name="jobTitle" required="required">
                <option value="">Pilih Salah Satu</option>
                <option value="President" <?php echo $data['jobTitle']=='President' ? "selected" : "" ?>>President</option>
                <option value="VP Sales" <?php echo $data['jobTitle']=='VP Sales' ? "selected" : "" ?>>VP Sales</option>
                <option value="Sales Manager (APAC)" <?php echo $data['jobTitle']=='Sales Manager (APAC)' ? "selected" : "" ?>>Sales Manager (APAC)</option>
                <option value="Sale Manager (EMEA)" <?php echo $data['jobTitle']=='Sale Manager (EMEA)' ? "selected" : "" ?>>Sale Manager (EMEA)</option>
                <option value="Sales Manager (NA)" <?php echo $data['jobTitle']=='Sales Manager (NA)' ? "selected" : "" ?>>Sales Manager (NA)</option>
                <option value="Sales Rep" <?php echo $data['jobTitle']=='Sales Rep' ? "selected" : "" ?>>Sales Rep</option>
              </select>
            </div>
            <div class="form-group">
              <label>Office Code</label>
              <input type="text" class="form-control" placeholder="Office Code" name="officeCode" value="<?php echo $data['officeCode'];  ?>" required="required">
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
