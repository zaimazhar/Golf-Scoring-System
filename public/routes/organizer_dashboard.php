<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$gen_link = "";

$auth->check();
$auth->checkPrivilege("superadmin");

$getCompetition = $auth->all("competition")->getAll();

$registeradmin = Helper::route("posts.organizer_register_admin");
$createcompetition = Helper::route("posts.organizer_create_competition");
$getIntoCompetition = Helper::route("competition");

foreach($getCompetition as $competition) {
    $id = $competition['id'];
    $comp_name = $competition['competition_name'];
    $href = "$getIntoCompetition?cid=$id";
    $gen_link .= "<a href='$href'>$comp_name</a>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/head.php" ?>
</head>
<body>
    <?php include_once "./components/navbar.php" ?>
    <section><br><br>
        <?php Sessions::old("created_venue"); ?>
        <?php Sessions::old("error_venue"); ?>
        <h2>Create Admin</h2><br>
        <form action="<?= $registeradmin ?>" method="post">
            <label style="margin-right: 20px;" for="email">Email</label>
            <input type="email" name="admin_email" id="email"><br><br>
            <label style="margin-right: 20px;" for="name">Name</label>
            <input type="text" name="admin_name" id="name"><br><br>
            <label style="margin-right: 20px;" for="password">Password</label>
            <input type="password" name="admin_password" id="password"><br><br>
            <button name="button" type="submit">Submit</button>
        </form><br><br>

        <h2>Create Competition</h2><br>
        <form action="<?= $createcompetition ?>" method="post">
            <label style="margin-right: 20px;" for="comp_name">Competition Name</label>
            <input type="text" name="comp_name" id="comp_name"><br><br>
            <label style="margin-right: 20px;" for="comp_venue">No. of Venue</label>
            <input type="number" name="no_of_venue" id="comp_venue"><br><br>
            <button name="button" type="submit">Submit</button>
        </form>

        <br><br>

        <?php 
            echo $gen_link;    
        ?>
        <br><br>
    </section>
</body>
</html>
