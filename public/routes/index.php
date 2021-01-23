<?php

include_once "../ServiceProvider.php";

$services = new ServiceProvider;
$services->auth()->start();
$services->session()->old('error');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Golf Scoring System</title>
</head>
<body>
    <?php include_once 'components/navbar.php'; $name = "Scoreboard"; ?>
    <main>
        <h2>Welcome to Golf Scoring System</h2>
        <h4>homepage</h4>
        <h3><?= $name ?></h3>
        <table>
            <tr>
                <th>OKAY</th>
            </tr>
            <tr>
                <td>ALRIGHT</td>
            </tr>
        </table>
    </main>
</body>
</html>