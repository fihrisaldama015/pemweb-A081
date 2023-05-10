<?php 

  include ('conn.php'); 

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          //query SQL
          $productCode = $_GET['id'];
          $query = $conn->prepare("DELETE FROM products WHERE productCode = :productCode ");
          //binding data
          $query->bindParam(':productCode',$productCode);
          //eksekusi query
          if ($query->execute()) {
            $status = 'ok';
          }
          else{
            $status = 'err';
          }

          //redirect ke halaman lain
          header('Location: product.php?status='.$status);
      }  
  }