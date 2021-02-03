<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Seeder;
use php\misc\Csrf;

Auth::start();
Auth::check();
(new Seeder)->seed()->staticTry();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Test</title>
</head>
<body>
    <?php include_once "components/navbar.php"; ?>
    <h1>I am fine to go anywhere</h1>
</body>
</html>