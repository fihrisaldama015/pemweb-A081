<?php 
// method 1
$filename = fopen("data.txt","a+");
// method 2
// $filename = "data.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];

    $data = '';
    $data .= $npm.",";
    $data .= $nama."\n";

    // method 1
    $saved = fwrite($filename, $data);
    if($saved == false){
        echo "<script>alert('gagal menyimpan !')</script>";
    }else{
        echo "<script>alert('berhasil menyimpan !')</script>";
    }
    
    // method 2
    // $saved = file_put_contents($filename, $data, FILE_APPEND);
    // if($saved > 0){
    //    echo "<script>alert('berhasil menyimpan !')</script>";
    // }else{
    //    echo "<script>alert('gagal menyimpan !')</script>";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input</title>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    <label for="npm">NPM</label>
                </td>
                <td>
                    <input type="text" id="npm" placeholder="NPM..." name="npm">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nama">Nama</label>
                </td>
                <td>
                    <input type="text" id="nama" placeholder="Nama..." name="nama">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Simpan</button>
                </td>
            </tr>
    </table>
    </form>

    <h2>Data Mahasiswa</h2>
    <table border="1">
        <thead>
            <tr>
                <th>
                    No.
                </th>
                <th>
                    NPM
                </th>
                <th>
                    Nama
                </th>
            </tr>
        </thead>
        <tbody>
    <?php 
    // method 1
    // $filename = fopen("data.txt","a+");
    // $i = 1;
    // while ($line = fgets($filename)) {
    //     echo $i.'. '.$line."<br>";
    //     $i++;
    // }
    // fclose($filename);

    // method 2
    // $read = file_get_contents("data.txt");
    // echo $read;

    //method 3
    $file = file("data.txt");
    $i = 1;
    foreach($file as $line):?>
    <?php $data = explode('-', $line);?>
        <tr>
            <td>
                <?= $i;?>
            </td>
            <td>
                <?php echo $data[0];?>
            </td>
            <td>
                <?php echo $data[1];?>
            </td>
        </tr>
    <?php 
        $i++;
        endforeach;
    ?>
        </tbody>
    </table>

</body>
</html>