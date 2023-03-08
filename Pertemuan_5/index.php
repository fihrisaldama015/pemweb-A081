<?php
    include('conn.php');
    $queryEmployees = "SELECT * FROM employees";
    $responseEmployees = mysqli_query(connectDB(),$queryEmployees);
    $queryProductLines = "SELECT * FROM productlines";
    $responseProductLines = mysqli_query(connectDB(),$queryProductLines);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Employees</h1>
    <table border=1 align="center">
        <thead>
            <tr>
                <td>Employee Number</td>
                <td>Full Name</td>
                <td>Extension</td>
                <td>Email</td>
                <td>Office Code</td>
                <td>Reports To</td>
                <td>Job Title</td>
            </tr>
        </thead>
        <tbody>
        <?php  while($data = mysqli_fetch_array($responseEmployees)): ?>
            <tr>
                <td><?= $data["employeeNumber"]; ?></td>
                <td><?= $data["firstName"]." ".$data["lastName"]; ?></td>
                <td><?= $data["extension"]; ?></td>
                <td><?= $data["email"]; ?></td>
                <td><?= $data["officeCode"]; ?></td>
                <td><?= $data["reportsTo"]; ?></td>
                <td><?= $data["jobTitle"]; ?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
    <h1 align="center">Product Lines</h1>
    <table border=1 align="center">
        <thead>
            <tr>
                <td>Product Line</td>
                <td>Text Description</td>
                <td>HTML Description</td>
                <td>Image</td>
            </tr>
        </thead>
        <tbody>
        <?php  while($data = mysqli_fetch_array($responseProductLines)): ?>
            <tr>
                <td><?= $data["productLine"] ?></td>
                <td><?= $data["textDescription"] ?></td>
                <td><?= $data["htmlDescription"] ?></td>
                <td><?= $data["image"] ?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</body>
</html>