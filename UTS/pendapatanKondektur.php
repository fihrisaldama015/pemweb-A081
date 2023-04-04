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
            <a href="driver.php">Data DRIVER</a>
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
            <a class="active" href="pendapatanKondektur.php">Pendapatan Kondektur</a>
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
                echo '<br><br><div class="alert alert-success" role="alert">Data Product berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Product gagal di-update</div>';
              }

            }
          ?>
          <h2>Pendapatan Kondektur</h2>
          <?php
          if(isset($_GET['bulan'])){
            $nama_bulan = $_GET['bulan'];
          }else{
            $nama_bulan = 'Semua';
          }
          ?>
          <h5>Bulan = <?= $nama_bulan?></h5>
          <p>Filter</p>
          <form action="" method="GET">
            <select name="bulan" id="bulan" class="select_filter" required>
              <option value="">Pilih</option>
              <option value="january">January</option>
              <option value="february">February</option>
              <option value="march">March</option>
              <option value="april">April</option>
              <option value="may">May</option>
              <option value="june">June</option>
              <option value="july">July</option>
              <option value="august">August</option>
              <option value="september">September</option>
              <option value="october">October</option>
              <option value="november">November</option>
              <option value="december">December</option>
            </select>
            <button type="submit" class="button filter">Tampilkan</button>
            <a href="pendapatanKondektur.php"><button type="button" class="button reset">Reset</button></a>
          </form>
          <div class="table">
          <table>
              <thead>
                <tr>
                  <th>Id Kondektur</th>
                  <th>Nama Driver</th>
                  <th>Total KM</th>
                  <th>Gaji per KM</th>
                  <th>Total Gaji</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT id_kondektur, nama FROM kondektur ORDER BY id_kondektur ASC";
                  $result = mysqli_query(connection(),$query);
                  ?>

                <?php while($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <td><?php echo $data['id_kondektur'];  ?></td>
                    <td><?php echo $data['nama'];  ?></td>
                    <?php
                    if(isset($_GET['bulan'])){
                      $queryKmKondektur = "SELECT SUM(jumlah_km) AS total_km FROM trans_upn WHERE id_kondektur = $data[id_kondektur] AND monthname(tanggal) = '$nama_bulan' GROUP BY id_kondektur";
                    }else{
                      $queryKmKondektur = "SELECT SUM(jumlah_km) AS total_km FROM trans_upn WHERE id_kondektur = $data[id_kondektur] GROUP BY id_kondektur";
                    }
                    $result_km = mysqli_query(connection(),$queryKmKondektur);
                    $data_km_kondektur = mysqli_fetch_assoc($result_km);
                    if($data_km_kondektur === NULL){
                      $total_km = 0;
                    }else{
                      $total_km = $data_km_kondektur['total_km'];
                    }
                    $GAJI_KONDEKTUR_PER_KM = 1500;
                    $gaji_kondektur = $total_km * $GAJI_KONDEKTUR_PER_KM;
                    ?>
                    <td><?php echo $total_km; ?></td>
                    <td><?php echo $GAJI_KONDEKTUR_PER_KM;  ?></td>
                    <td><?php echo $gaji_kondektur;  ?></td>
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

