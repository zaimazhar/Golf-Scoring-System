<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Register</title>
</head>
<body>
    <form action="" method="POST">
        <label for="user_name">Username</label><br>
        <input type="text" name="user_name" id="user_name"><br>
        <label for="user_email">Email</label><br>
        <input type="text" name="user_email" id="user_email"><br>
        <label for="user_password">Password</label><br>
        <input type="password" name="user_password" id="user_password">
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>