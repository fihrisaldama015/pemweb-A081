<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nama = $_POST['nama'];
      //query SQL
      $query = "INSERT INTO kondektur (nama) VALUES('$nama')";

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
    <title>TAMBAH KONDEKTUR | Pemweb A081</title>
    <link rel="stylesheet" href="style.css">

  </head>

  <body>
    <div class="wrapper">

      
      <nav class="navbar">
        <h1>M. Fihris Aldama</h1>
          <ul>
            <li>
              <a href="kondektur.php">Kembali</a>
            </li>
          </ul>
      </nav>

      <div class="container">
        <main role="main" class="main">
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Kondektur berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Kondektur gagal disimpan</div>';
              }
          ?>

          <h2>TAMBAH KONDEKTUR</h2>
          <form action="" method="POST">
            <div class="form">
              <label>Nama</label>
              <input type="text" class="input_text" name="nama" required>
            </div>

            <button type="submit" class="button tambah">Simpan</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>