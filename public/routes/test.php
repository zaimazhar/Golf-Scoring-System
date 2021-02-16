<?php

include "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Seeder;

$auth = new Auth;

$auth->start();
$auth->check();
// (new Seeder)->SeedAdmin();

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