<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

Sessions::old("get");

$post = Helper::route("posts.user_login");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
</head>
<body>
    <?php include_once "./components/navbar.php" ?>
    <form action="<?= $post ?>" method="post">
        <label for="email">Email</label><br>
        <input type="text" name="user_email" id="email"><br>
        <label for="">Password</label><br>
        <input type="password" name="user_password" id="password"><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>