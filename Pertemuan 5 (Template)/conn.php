<?php 

function connection() {
   // membuat konekesi ke database system
   $db_config = parse_ini_file('.env');
   $dbServer = 'localhost';
   $dbUser = 'root';
   $dbPass = $db_config["DB_PASSWORD"];
   $dbName = "classicmodels";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(! $conn) {
      die('Koneksi gagal: ' . mysqli_error());
   }
   //memilih database yang akan dipakai
   mysqli_select_db($conn,$dbName);
	
   return $conn;
}
