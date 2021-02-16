<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;

$auth = new Auth;

$auth->start();
$auth->check();

// foreach($data->getUser() as $data_sql) {
//     echo "Name is <b>" . $data_sql['name'] . "</b> - Email is <b>" . $data_sql['email'] . "</b> - Gender is <b>" . $data_sql['gender'] . "</b><br>";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard</title>
</head>
<body>
    <section><br><br>
        <form action="/posts/organizer_register_admin.php" method="post">
            <label style="margin-right: 20px;" for="nama">NAMA</label>
            <input type="text" name="nama" id="nama"><br><br>
            <label style="margin-right: 20px;" for="email">EMAIL</label>
            <input type="email" name="email" id="email"><br><br>
            <label style="margin-right: 20px;">Gender</label>
            <label for="male">MALE</label><input type="radio" name="gender" id="male" value="MALE"><label for="female">FEMALE</label><input type="radio" name="gender" id="female" value="FEMALE"><br><br>
            <button name="button" type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
