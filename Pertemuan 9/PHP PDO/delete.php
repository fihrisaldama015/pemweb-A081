<?php 

  include ('conn.php'); 

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          //query SQL
          $customerNumber = $_GET['id'];
          $query = $conn->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber ");
          //binding data
          $query->bindParam(':customerNumber',$customerNumber);
          //eksekusi query
          if ($query->execute()) {
            $status = 'ok';
          }
          else{
            $status = 'err';
          }

          //redirect ke halaman lain
          header('Location: index.php?status='.$status);
      }  
  }