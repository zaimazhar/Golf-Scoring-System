<?php

include_once "../ServiceProvider.php";


Auth::start();
Sessions::old('error');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Home | Golf Scoring System</title>
</head>
<body>
    <?php include_once 'components/navbar.php'?>
    <main>
        <h2>Welcome to Golf Scoring System</h2>
        <h4>homepage</h4>
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