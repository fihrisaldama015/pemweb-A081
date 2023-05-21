<?php
  $status = isset($_GET['status']) ? $_GET['status'] : '' ;
  $filename = "data.txt";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Perpustakaan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <nav class="navbar">
      <h1>M. Fihris Aldama</h1>
      <ul>
        <li>
          <a class="active" href="index.php">Data Buku</a>
        </li>
        <li>
          <a href="tambah.php">Tambah Buku</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <main role="main" class="main">
        <?php 
          if ($status=='ok') {
            echo '<br><div class="alert alert-success" role="alert">Data Buku berhasil diupdate</div>';
          }
          elseif($status=='deleted'){
            echo '<br><div class="alert alert-success" role="alert">Data Buku berhasil dihapus</div>';
          }
          elseif($status=='err'){
            echo '<br><div class="alert alert-danger" role="alert">Data Buku gagal diupdate</div>';
          }
          
        ?>
        <h2>Data Buku</h2>
        <a href="tambah.php"><button type="button" class="button tambah">TAMBAH BUKU</button></a>
        <div class="table">
          <table>
            <thead>
              <tr>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun terbit</th>
                <th>Cover</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach(file($filename) as $line) : 
              $data = explode("--", $line);
              ?>
              <tr>
                <td><?= $data[0]; ?></td>
                <td><?= $data[1]; ?></td>
                <td><?= $data[2]; ?></td>
                <td><?= $data[3]; ?></td>
                <td><?= $data[4]; ?></td>
                <td><img src="./<?= $data[5]; ?>" width="100" alt="gambar" class="cover_img" /></td>
                <td>
                  <div class="action">
                    <a href="<?php echo "update.php?id=".$data[0]; ?>" class="button update"> Update</a>
                    <a href="<?php echo "delete.php?id=".$data[0]; ?>" class="button delete"> Delete</a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</body>
</html>