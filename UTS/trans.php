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
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Data BUS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="driver.php">Data DRIVER</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kondektur.php">Data Kondektur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="trans.php">Data Trans UPN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pendapatanDriver.php">Pendapatan Driver</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pendapatanKondektur.php">Pendapatan Kondektur</a>
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
                  echo '<br><br><div class="alert alert-success" role="alert">Data Trans UPN berhasil di-update</div>';
                }
                elseif($status=='err'){
                  echo '<br><br><div class="alert alert-danger" role="alert">Data Trans UPN gagal di-update</div>';
                }

              }
            ?>
            <h2>Trans UPN</h2>
            <a href="tambahTransUPN.php"><button type="button" class="button tambah">TAMBAH TRANS UPN</button></a>
            <div class="table">
              <table>
                <thead>
                  <tr>
                    <th>Id Trans UPN</th>
                    <th>Id Kondektur</th>
                    <th>Id Bus</th>
                    <th>Id Driver</th>
                    <th>Jumlah KM</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    //proses menampilkan data dari database:
                    //siapkan query SQL
                    $query = "SELECT * FROM trans_upn";
                    $result = mysqli_query(connection(),$query);
                  ?>

                  <?php while($data = mysqli_fetch_array($result)): ?>
                    <tr>
                      <td><?php echo $data['id_trans_upn'];  ?></td>
                      <td><?php echo $data['id_kondektur'];  ?></td>
                      <td><?php echo $data['id_bus'];  ?></td>
                      <td><?php echo $data['id_driver'];  ?></td>
                      <td><?php echo $data['jumlah_km'];  ?></td>
                      <td><?php echo $data['tanggal'];  ?></td>
                      <td>
                        <a href="<?php echo "updateTransUPN.php?id=".$data['id_trans_upn']; ?>" class="button update"> Update</a>
                        &nbsp;&nbsp;
                        <a href="<?php echo "deleteTransUPN.php?id=".$data['id_trans_upn']; ?>" class="button delete"> Delete</a>
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

