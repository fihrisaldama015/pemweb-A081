<?php 
  $status = '';
  $data_update = array();
  $file_name = "data.txt";
  
  function getData($file_name){
    if (isset($_GET['id'])) {
      $kode_buku = $_GET['id'];
      $file = file($file_name);
      foreach ($file as $line) {
        $array_of_data = explode("--", $line);
        if($array_of_data[0] == $kode_buku) {
          return $array_of_data;
          break;
        }
      }
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data_update = getData($file_name);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_buku = $_POST['kode_buku'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang_buku = $_POST['pengarang_buku'];
    $penerbit_buku = $_POST['penerbit_buku'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $directory_upload = "cover/";
    
    if(!empty($_FILES['cover_buku']['name'])){
      $old_cover = str_replace("\r\n","",$_POST['old_cover']);
      if(file_exists($old_cover)){
        unlink($old_cover);
      }
      $cover_buku = $_FILES['cover_buku'];
      $nama_file = $kode_buku.'_'.$cover_buku['name'];
      $tmp = $cover_buku['tmp_name'];
      $img_dir = $directory_upload.$nama_file;
      $upload_file = move_uploaded_file($tmp, $img_dir);
      if (!$upload_file) echo "<script>alert('gagal menyimpan gambar cover!')</script>";
    }else{
      $nama_file = explode("\n",$_POST['old_cover']);
      $img_dir = $nama_file[0];
    }

    $file_to_update = file("data.txt");
    $tmp_data = array();
    foreach($file_to_update as $line) {
      $val = explode("--",$line);
      if ($val[0] == $kode_buku) {
        $data = '';
        $data .= $kode_buku."--";
        $data .= $judul_buku."--";
        $data .= $pengarang_buku."--";
        $data .= $penerbit_buku."--";
        $data .= $tahun_terbit."--";
        $data .= $img_dir."\n";
        $line = $data;
      }
      $tmp_data[] = $line;
    }

    $new_data = implode("", $tmp_data);

    $save_data = file_put_contents($file_name , $new_data);

    if($save_data == false) $status = 'err';
    else {
      $data_update = getData($file_name);
      $status = 'ok';
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>UPDATE BUKU | Pemweb A081</title>
    <link rel="stylesheet" href="style.css">
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
                echo '<div class="alert alert-success" role="alert">Data Buku berhasil diupdate</div>';
              }
              elseif($status=='err'){
                echo '<div class="alert alert-danger" role="alert">Data Buku gagal diupdate</div>';
              }
           ?>

          <h2>UPDATE BUKU</h2>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
              <label for="kode_buku">Kode Buku</label>
              <input type="text" class="input_text" name="kode_buku" id="kode_buku" placeholder="Kode Buku..." value="<?= $data_update[0];?>" readonly>
            </div>
            <div class="form">
              <label for="judul_buku">Judul</label>
              <input type="text" class="input_text" name="judul_buku" id="judul_buku" placeholder="Judul Buku..." value="<?= $data_update[1];?>" required>
            </div>
            <div class="form">
              <label for="pengarang_buku">Pengarang</label>
              <input type="text" class="input_text" name="pengarang_buku" id="pengarang_buku" placeholder="Pengarang..." value="<?= $data_update[2];?>" required>
            </div>
            <div class="form">
              <label for="penerbit_buku">Penerbit</label>
              <input type="text" class="input_text" name="penerbit_buku" id="penerbit_buku" placeholder="Penerbit..." value="<?= $data_update[3];?>" required>
            </div>
            <div class="form">
              <label for="tahub_terbit">Tahun Terbit</label>
              <input type="number" class="input_text" name="tahun_terbit" id="tahun_terbit" placeholder="Tahun Terbit..." value="<?= $data_update[4];?>" required>
            </div>
            <div class="form">
              <label for="cover_buku">Cover Buku</label>
              <input type="hidden" name="old_cover" value="<?= $data_update[5];?>">
              <img src="<?= $data_update[5];?>" width="200" alt="gambar" class="cover_lama"/>
              <input type="file" class="input_text" name="cover_buku" id="cover_buku">
            </div>
            <button type="submit" class="button tambah">Simpan</button>
          </form>
        </main>
    </div>
    </div>
  </body>
</html>