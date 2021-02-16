<?php

include_once "../ServiceProvider.php";

use php\logic\Sessions;

Sessions::old("get");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
</head>
<body>
    <form action="./posts/organizer_register_admin.php" method="post">
        <label for="email">Email</label><br>
        <input type="text" name="user_email" id="email"><br>
        <label for="">Password</label><br>
        <input type="password" name="user_password" id="password"><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>