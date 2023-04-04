<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>UTS | Pemweb A081</title>
    <link href="style.css" rel="stylesheet">
  </head>

  <body>
    <div class="wrapper">
      <nav class="navbar">
        <h1>M. Fihris Aldama</h1>
        <ul>
          <li>
            <a href="index.php">Data BUS</a>
          </li>
          <li>
            <a class="active" href="driver.php">Data DRIVER</a>
          </li>
          <li>
            <a href="kondektur.php">Data Kondektur</a>
          </li>
          <li>
            <a href="trans.php">Data Trans UPN</a>
          </li>
          <li>
            <a href="pendapatanDriver.php">Pendapatan Driver</a>
          </li>
          <li>
            <a href="pendapatanKondektur.php">Pendapatan Kondektur</a>
          </li>
        </ul>
      </nav>

      <div class="container">
        <main role="main" class="main">
          <?php 
            //mengecek apakah proses update dan delete sukses/gagal
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Driver berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Driver gagal di-update</div>';
              }

            }
          ?>
          <h2>Driver</h2>
          <a href="tambahDriver.php"><button type="button" class="button tambah">TAMBAH DRIVER</button></a>
          <div class="table">
            <table>
              <thead>
                <tr>
                  <th>Id Driver</th>
                  <th>Nama</th>
                  <th>No SIM</th>
                  <th>Alamat</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM driver";
                  $result = mysqli_query(connection(),$query);
                ?>

                <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <td><?php echo $data['id_driver'];  ?></td>
                    <td><?php echo $data['nama'];  ?></td>
                    <td><?php echo $data['no_sim'];  ?></td>
                    <td><?php echo $data['alamat'];  ?></td>
                    <td>
                      <a href="<?php echo "updateDriver.php?id=".$data['id_driver']; ?>" class="button update"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "deleteDriver.php?id=".$data['id_driver']; ?>" class="button delete"> Delete</a>
                    </td>
                  </tr>
                <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>

