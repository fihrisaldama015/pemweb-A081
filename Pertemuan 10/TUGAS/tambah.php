<?php 
  $status = '';
  $filename = fopen("data.txt","a+");
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_buku = $_POST['kode_buku'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang_buku = $_POST['pengarang_buku'];
    $penerbit_buku = $_POST['penerbit_buku'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $cover_buku = $_FILES['cover_buku'];

    $nama_file = $kode_buku.'_'.$cover_buku['name'];
    $tmp = $cover_buku['tmp_name'];

    $directory_upload = "cover/";

    $upload_file = move_uploaded_file($tmp, $directory_upload.$nama_file);
    if (!$upload_file) echo "<script>alert('gagal menyimpan gambar cover!')</script>";

    $data = '';
    $data .= $kode_buku."--";
    $data .= $judul_buku."--";
    $data .= $pengarang_buku."--";
    $data .= $penerbit_buku."--";
    $data .= $tahun_terbit."--";
    $data .= $directory_upload.$nama_file."\n";

    $saved = fwrite($filename, $data);

    if($saved == false) $status = 'err';
    else $status = 'ok';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TAMBAH BUKU | Pemweb A081</title>
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
                echo '<br><br><div class="alert alert-success" role="alert">Data Buku berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Buku gagal disimpan</div>';
              }
           ?>

          <h2>TAMBAH BUKU</h2>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
              <label for="kode_buku">Kode Buku</label>
              <input type="text" class="input_text" name="kode_buku" id="kode_buku" placeholder="Kode Buku..." required>
            </div>
            <div class="form">
              <label for="judul_buku">Judul</label>
              <input type="text" class="input_text" name="judul_buku" id="judul_buku" placeholder="Judul Buku..." required>
            </div>
            <div class="form">
              <label for="pengarang_buku">Pengarang</label>
              <input type="text" class="input_text" name="pengarang_buku" id="pengarang_buku" placeholder="Pengarang..." required>
            </div>
            <div class="form">
              <label for="penerbit_buku">Penerbit</label>
              <input type="text" class="input_text" name="penerbit_buku" id="penerbit_buku" placeholder="Penerbit..." required>
            </div>
            <div class="form">
              <label for="tahub_terbit">Tahun Terbit</label>
              <input type="number" class="input_text" name="tahun_terbit" id="tahun_terbit" placeholder="Tahun Terbit..." required>
            </div>
            <div class="form">
              <label for="cover_buku">Cover Buku</label>
              <input type="file" class="input_text" name="cover_buku" id="cover_buku" required>
            </div>
            <button type="submit" class="button tambah">Simpan</button>
          </form>
        </main>
    </div>
    </div>
  </body>
</html>