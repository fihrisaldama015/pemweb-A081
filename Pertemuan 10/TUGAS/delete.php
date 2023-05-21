<?php
$status = '';
$result = '';
$file_name = "data.txt";
$data_delete = array();

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
  if (isset($_GET['id'])) {
    $kode_buku = $_GET['id'];

    $data_delete = getData($file_name);
    $img_dir = str_replace("\n","",$data_delete[5]);
    if(file_exists($img_dir)){
      unlink($img_dir);
    }

    $file_to_update = file("data.txt");
    $tmp_data = array();
    foreach($file_to_update as $line) {
      $val = explode("--",$line);
      if ($val[0] !== $kode_buku) {
        array_push($tmp_data, $line);
      }
    }

    $new_data = implode("",$tmp_data);
    $save_data = file_put_contents($file_name,$new_data);

    if($save_data == false) $status = 'err';
    else $status = 'deleted';
    
    header('Location: index.php?status='.$status);
  }  
}
?>