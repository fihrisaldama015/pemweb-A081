<?php

function connectDB(){
    $db_config = parse_ini_file('.env');

    $dbhost = "localhost";
    $dbuser = "root";
    $db_password = $db_config["DB_PASSWORD"];
    $db_name = "classicmodels";
    $conn = mysqli_connect($dbhost, $dbuser, $db_password);
    
    if(! $conn) {
        die('Koneksi gagal: ' . mysqli_error());
    }
    mysqli_select_db($conn, $db_name);
    return $conn;
}    