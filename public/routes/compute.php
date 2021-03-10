<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

if($auth->user()) {
    echo $auth->id();
}

$competitionRoute = Helper::route("competition_venue");
$allCompetition = $auth->all("competition")->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/head.php" ?>
</head>
<body>
    <?php include_once "./components/navbar.php" ?><br>
    <?php foreach($allCompetition as $competition) { ?>
        <a href="<?= "$competitionRoute?cid=" . $competition['id'] ?>"><?= $competition['competition_name'] ?></a><br>
    <?php } ?>
</body>
</html>