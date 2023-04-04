<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_kondektur = $_POST['id_kondektur'];
      $id_bus = $_POST['id_bus'];
      $id_driver = $_POST['id_driver'];
      $jumlah_km = $_POST['jumlah_km'];
      $tanggal = $_POST['tanggal'];
      //query SQL
      $query = "INSERT INTO trans_upn (id_kondektur,id_bus,id_driver,jumlah_km,tanggal) VALUES('$id_kondektur','$id_bus','$id_driver','$jumlah_km','$tanggal')";

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
              <a href="trans.php">Kembali</a>
            </li>
          </ul>
      </nav>

    <div class="container">
        <main role="main" class="main">
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Trans UPN berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Trans UPN gagal disimpan</div>';
              }
           ?>

          <h2>TAMBAH TRANS UPN</h2>
          <form action="" method="POST">
            <?php
            $query_kondektur = "SELECT * FROM kondektur";
            $data_id_kondektur = mysqli_query(connection(),$query_kondektur);
            ?>
            <div class="form">
              <label>Id Kondektur</label>
              <select class="input_text" name="id_kondektur" id="id_kondektur">
                <option value="">Pilih</option>
                <?php while($data = mysqli_fetch_array($data_id_kondektur)): ?>
                  <option value="<?php echo $data['id_kondektur']; ?>"><?php echo $data['nama']; ?></option>
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
                <?php while($data = mysqli_fetch_array($data_id_bus)): ?>
                  <option value="<?php echo $data['id_bus']; ?>"><?php echo $data['plat']; ?></option>
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
                <?php while($data = mysqli_fetch_array($data_id_driver)): ?>
                  <option value="<?php echo $data['id_driver']; ?>"><?php echo $data['nama']; ?></option>
                <?php endwhile;?>
              </select>
            </div>

            <div class="form">
              <label>Total KM</label>
              <input type="number" class="input_text" name="jumlah_km" id="jumlah_km">
            </div>

            <div class="form">
              <label>Tanggal</label>
              <input type="date" class="input_text" name="tanggal" id="tanggal">
            </div>
            <button type="submit" class="button tambah">Simpan</button>
          </form>
        </main>
    </div>
    </div>
  </body>
</html>