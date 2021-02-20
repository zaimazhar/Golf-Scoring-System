<?php

use php\logic\Auth;

include_once "../ServiceProvider.php";

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/head.php" ?>
    <title>Administrator - Dashboard</title>
</head>
<body>
    <?php include_once "./components/navbar.php" ?>
</body>
</html>