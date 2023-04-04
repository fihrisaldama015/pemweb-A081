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
          $id_bus_update = $_GET['id'];
          $query = "SELECT * FROM bus WHERE id_bus = $id_bus_update";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bus_update = $_GET['id'];
      $plat = $_POST['plat'];
      $status = $_POST['status'];
      //query SQL
      $query = "UPDATE bus SET plat = '$plat', status = '$status' WHERE id_bus = $id_bus_update";


      //eksekusi query
      $result = mysqli_query(connection(),$query);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: index.php?status_state='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Example</title>
    <link href="style.css" rel="stylesheet">
  </head>

  <body>

    <div class="wrapper">
      <nav class="navbar">
        <h1>M. Fihris Aldama</h1>
        <ul>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Kembali</a>
          </li>
        </ul>
      </nav>

      <div class="container">
          <main role="main" class="main">
            <h2>Update Bus</h2>
            <form action="" method="POST">
              <?php while($data = mysqli_fetch_assoc($result)): ?>
              <div class="form">
                <label>Plat</label>
                <input type="text" class="input_text" name="plat" value="<?php echo $data['plat'] ?>" required>
              </div>

              <div class="form">
                <label>Status</label>
                <select class="input_text" name="status" id="status" required>
                  <option value="">Pilih Status</option>
                  <option value="1" <?= $data['status']=='1' ? "selected" : "" ?>>Active</option>
                  <option value="2" <?= $data['status']=='2' ? "selected" : "" ?>>Cadangan</option>
                  <option value="0" <?= $data['status']=='0' ? "selected" : "" ?>>Rusak</option>
                </select>
              </div>
              <?php endwhile; ?>
              <button type="submit" class="button tambah">Simpan</button>
            </form>
          </main>
      </div>
    </div>
  </body>
</html>
