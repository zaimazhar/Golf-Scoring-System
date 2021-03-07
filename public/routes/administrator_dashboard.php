<?php

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

include_once "../ServiceProvider.php";

$auth = new Auth;
$gen_link = "";

$auth->check();
$auth->checkPrivilege(["admin"]);

$getCompetition = $auth->all("competition")->getAll();
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
    <title>Administrator - Dashboard</title>
</head>
<body>
    <?php include_once "./components/navbar.php" ?>
    <?php Sessions::old("created_venue"); ?>
    <?php Sessions::old("error_venue"); ?>
    <br>
    <br>
    <br>
    <?= $gen_link ?>
</body>
</html>