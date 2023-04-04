<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $plat = $_POST['plat'];
      $status = $_POST['status'];
      //query SQL
      $query = "INSERT INTO bus (plat, status) VALUES('$plat','$status')"; 

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
    <title>TAMBAH BUS | Pemweb A081</title>
    <link href="style.css" rel="stylesheet">
  </head>

  <body>
    <div class="wrapper">

      <nav class="navbar">
        <h1>M. Fihris Aldama</h1>
          <ul>
            <li>
              <a href="index.php">Kembali</a>
            </li>
          </ul>
      </nav>

      <div class="container">
        <main role="main" class="main">
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customers gagal disimpan</div>';
              }
          ?>

          <h2>TAMBAH BUS</h2>
          <form action="" method="POST">
            <div class="form">
              <label>Plat</label>
              <input type="text" class="input_text" name="plat" required>
            </div>

            <div class="form">
              <select class="input_text" name="status" id="status" required>
                <option value="">Pilih Status</option>
                <option value="1">Active</option>
                <option value="2">Cadangan</option>
                <option value="0">Rusak</option>
              </select>
            </div>
            
            <button type="submit" class="button tambah">Simpan</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>