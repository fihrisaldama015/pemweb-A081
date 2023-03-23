<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .merah{
            background-color:red;
        }
        .biru{
            color:blue;
        }
    </style>
</head>
<body>
    <?php 
    $mahasiswa = array(
        array(
            "nama"=>"Mahasiswa 1",
            "npm"=>21081010110,
            "ipk"=>2.0
        ),
        array(
            "nama"=>"Mahasiswa 2",
            "npm"=>21081010112,
            "ipk"=>2.2
        ),
        array(
            "nama"=>"Mahasiswa 3",
            "npm"=>21081010114,
            "ipk"=>2.4
        ),
        array(
            "nama"=>"Mahasiswa 4",
            "npm"=>21081010116,
            "ipk"=>2.6
        ),
        array(
            "nama"=>"Mahasiswa 5",
            "npm"=>21081010118,
            "ipk"=>2.8
        ),
    );
    ?>
    <h1>Tabel Mahasiswa</h1>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>IPK</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($mahasiswa as $mhs):?>
            <tr class=<?= $mhs['ipk'] <= 2 ? 'merah': 'biru'?>>
                <td><?= $mhs['npm'] ?></td>
                <td><?= $mhs['nama'] ?></td>
                <td><?= $mhs['ipk'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>