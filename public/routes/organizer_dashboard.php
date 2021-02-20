<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("superadmin");

$registeradmin = Helper::route("posts.organizer_register_admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/head.php" ?>
</head>
<body>
    <?php include_once "./components/navbar.php" ?>
    <section><br><br>
        <form action="<?= $registeradmin ?>" method="post">
            <label style="margin-right: 20px;" for="email">Email</label>
            <input type="email" name="admin_email" id="email"><br><br>
            <label style="margin-right: 20px;" for="name">Name</label>
            <input type="text" name="admin_name" id="name"><br><br>
            <label style="margin-right: 20px;" for="password">Password</label>
            <input type="password" name="admin_password" id="password"><br><br>
            <button name="button" type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
