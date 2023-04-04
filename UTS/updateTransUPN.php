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
          $id_trans_upn_update = $_GET['id'];
          $query = "SELECT * FROM trans_upn WHERE id_trans_upn = $id_trans_upn_update";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_trans_upn_update = $_GET['id'];
      $id_kondektur = $_POST['id_kondektur'];
      $id_bus = $_POST['id_bus'];
      $id_driver = $_POST['id_driver'];
      $jumlah_km = $_POST['jumlah_km'];
      $tanggal = $_POST['tanggal'];
      //query SQL
      $query = "UPDATE trans_upn SET id_kondektur = '$id_kondektur',id_bus = '$id_bus',id_driver = '$id_driver',jumlah_km = '$jumlah_km',tanggal = '$tanggal' WHERE id_trans_upn = $id_trans_upn_update";

      //eksekusi query
      $result = mysqli_query(connection(),$query);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: trans.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>UTS | ADD TRANS</title>
    <link href="style.css" rel="stylesheet">
  </head>

  <body>
    <div class="wrapper">

      
      <nav class="navbar">
        <h1>M. Fihris Aldama</h1>
          <ul>
            <li class="nav-item">
              <a class="nav-link" href="trans.php">Kembali</a>
            </li>
          </ul>
      </nav>
      <div class="container">
          <main role="main" class="main">
            <h2>Update Trans UPN</h2>
            <form action="" method="POST">
              <?php while($data = mysqli_fetch_assoc($result)): ?>
                <?php
                $query_kondektur = "SELECT * FROM kondektur";
                $data_id_kondektur = mysqli_query(connection(),$query_kondektur);
                ?>
                <div class="form">
                  <label>Id Kondektur</label>
                  <select class="input_text" name="id_kondektur" id="id_kondektur">
                    <option value="">Pilih</option>
                    <?php while($data_kondektur = mysqli_fetch_array($data_id_kondektur)): ?>
                      <option value="<?= $data_kondektur['id_kondektur']; ?>" <?= $data_kondektur['id_kondektur' ]== $data['id_kondektur'] ? "selected" : "" ?>><?php echo $data_kondektur['nama']; ?></option>
                    <?php endwhile;?>
                  </select>
                </div>

                <?php
                $query_bus = "SELECT * FROM bus";
                $data_id_bus = mysqli_query(connection(),$query_bus);
                ?>
                <div class="form">
                  <label>Id bus</label>
                  <select class="input_text" name="id_bus" id="id_bus">
                    <option value="">Pilih</option>
                    <?php while($data_bus = mysqli_fetch_array($data_id_bus)): ?>
                      <option value="<?php echo $data['id_bus']; ?>" <?= $data_bus['id_bus' ]== $data['id_bus'] ? "selected" : "" ?>><?php echo $data_bus['plat']; ?></option>
                    <?php endwhile;?>
                  </select>
                </div>

                <?php
                $query_driver = "SELECT * FROM driver";
                $data_id_driver = mysqli_query(connection(),$query_driver);
                ?>
                <div class="form">
                  <label>Id driver</label>
                  <select class="input_text" name="id_driver" id="id_driver">
                    <option value="">Pilih</option>
                    <?php while($data_driver = mysqli_fetch_array($data_id_driver)): ?>
                      <option value="<?php echo $data['id_driver']; ?>" <?= $data_driver['id_driver' ]== $data['id_driver'] ? "selected" : "" ?>><?php echo $data_driver['nama']; ?></option>
                    <?php endwhile;?>
                  </select>
                </div>

                <div class="form">
                  <label>Total KM</label>
                  <input type="number" class="input_text" name="jumlah_km" id="jumlah_km" value="<?= $data['jumlah_km'] ?>">
                </div>

                <div class="form">
                  <label>Tanggal</label>
                  <input type="date" class="input_text" name="tanggal" id="tanggal" value="<?= $data['tanggal'] ?>" >
                </div>
              <?php endwhile; ?>
              <button type="submit" class="button tambah">Simpan</button>
            </form>
          </main>
      </div>
    </div>
  </body>
</html>
