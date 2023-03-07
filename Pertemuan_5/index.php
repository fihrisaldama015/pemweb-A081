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
    <h1>Employees</h1>
    <table border=1>
        <thead>
            <tr>
                <td>No.</td>
                <td>Full Name</td>
                <td>Email</td>
                <td>Office Code</td>
                <td>Job Title</td>
            </tr>
        </thead>
        <tbody>
        <?php  while($data = mysqli_fetch_array($responseEmployees)): ?>
            <tr>
                <td><?= $data["employeeNumber"]; ?></td>
                <td><?= $data["firstName"]." ".$data["lastName"]; ?></td>
                <td><?= $data["email"]; ?></td>
                <td><?= $data["officeCode"]; ?></td>
                <td><?= $data["jobTitle"]; ?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
    <h1>Product Lines</h1>
    <table border=1>
        <thead>
            <tr>
                <td>Product Line</td>
                <td>Text Description</td>
            </tr>
        </thead>
        <tbody>
        <?php  while($data = mysqli_fetch_array($responseProductLines)): ?>
            <tr>
                <td><?= $data["productLine"] ?></td>
                <td><?= $data["textDescription"] ?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</body>
</html>