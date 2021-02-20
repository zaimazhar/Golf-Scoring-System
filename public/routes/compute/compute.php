<?php

include_once "../../ServiceProvider.php";

use php\logic\Auth;

$auth = new Auth;

if($auth->user()) {
    echo $auth->id();
}

echo "Compute....";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../components/head.php" ?>
</head>
<body>
    <?php include_once "../components/navbar.php" ?>
</body>
</html>