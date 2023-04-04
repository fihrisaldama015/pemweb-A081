<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
  if (isset($_GET['status'])){
    $status = $_GET['status'];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>UTS | Pemweb A081</title>
    <link href="style.css" rel="stylesheet">
    <style>
      .status_aktif{
        background-color: #16a34a;
        color: white;
        padding: .25rem 1rem;
        border-radius: .5rem;
      }
      
      .status_rusak{
        background-color: #ef4444;
        color: white;
        padding: .25rem 1rem;
        border-radius: .5rem;
      }
      
      .status_cadangan{
        background-color: #facc15;
        padding: .25rem 1rem;
        border-radius: .5rem;
      }
    </style>
  </head>

  <body>
    <div class="wrapper">
      <nav class="navbar">
        <h1>M. Fihris Aldama</h1>
        <ul>
          <li>
            <a class="active" href="index.php">Data BUS</a>
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
            <a href="pendapatanKondektur.php">Pendapatan Kondektur</a>
          </li>
        </ul>
      </nav>

      <div class="container">
          <main role="main" class="main">
            <?php 
              //mengecek apakah proses update dan delete sukses/gagal
              if (@$_GET['status_state']!==NULL) {
                $status_state = $_GET['status_state'];
                if ($status_state=='ok') {
                  echo '<br><br><div class="alert alert-success" role="alert">Data Bus berhasil di-update</div>';
                }
                elseif($status_state=='err'){
                  echo '<br><br><div class="alert alert-danger" role="alert">Data Bus gagal di-update</div>';
                }

              }
            ?>
            <h2>BUS</h2>
            <a href="tambahBus.php"><button type="button" class="button tambah">TAMBAH BUS</button></a>
            <?php
            if(isset($_GET['status'])){
              $nama_status = $_GET['status'] == 1 ? 'Active' : ($_GET['status'] == 2 ? 'Cadangan': 'Rusak');
            }else{
              $nama_status = 'Active';
            }
            ?>
            <h5>Status = <?= $nama_status?></h5>
            <p>Filter</p>
            <form action="" method="GET">
              <select class="select_filter" name="status" id="status_bus" required>
                <option value="">Pilih</option>
                <option value="1">Active</option>
                <option value="2">Cadangan</option>
                <option value="0">Rusak</option>
              </select>
              <button type="submit" class="button filter">Filter</button>
              <a href="index.php"><button type="button" class="button reset">Reset</button></a>
            </form>
            <div class="table">
              <table>
                <thead>
                  <tr>
                    <th>Id Bus</th>
                    <th>Plat</th>
                    <th>Total KM</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    //proses menampilkan data dari database:
                    //siapkan query SQL
                    if(isset($_GET['status'])){
                      $query = "SELECT * FROM bus WHERE status = $status";
                    }else{
                      $query = "SELECT * FROM bus";
                    }
                    $result = mysqli_query(connection(),$query);
                  ?>

                  <?php while($data = mysqli_fetch_array($result)): ?>
                    <tr>
                      <td><?php echo $data['id_bus'];  ?></td>
                      <td><?php echo $data['plat'];  ?></td>
                      <?php
                      $queryKmBus = "SELECT SUM(jumlah_km) AS total_km FROM trans_upn WHERE id_bus = $data[id_bus] GROUP BY id_bus";
                      $result_km = mysqli_query(connection(),$queryKmBus);
                      $data_km_bus = mysqli_fetch_assoc($result_km);
                      if($data_km_bus === null){
                        $total_km = 0;
                      }else{
                        $total_km = $data_km_bus['total_km'];
                      }
                      ?>
                      <td><?= $total_km;?></td>
                      <?php
                      $informasi_status = $data['status'] == 1 ? 'aktif' : ($data['status'] == 2 ? 'cadangan': 'rusak');
                      ?>
                      <td><span class="status_<?= $informasi_status?>"><?= $informasi_status; ?></span></td>
                      <td>
                        <a href="<?php echo "updateBus.php?id=".$data['id_bus']; ?>" class="button update"> Update</a>
                        &nbsp;&nbsp;
                        <a href="<?php echo "deleteBus.php?id=".$data['id_bus']; ?>" class="button delete"> Delete</a>
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

