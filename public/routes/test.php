<?php

include_once "../ServiceProvider.php";

$services = new ServiceProvider;
$services->auth()->start();
$services->auth()->check();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <?php include_once "components/navbar.php"; ?>
    <h1>I am fine to go anywhere</h1>
</body>
</html>