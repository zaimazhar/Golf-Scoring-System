<?php

include_once("../ServiceProvider.php");

use php\logic\Competition;
use php\misc\Helper;

$competition = new Competition;

$cid = $_GET['cid'];

$comp_data = $competition->find("competition", (int) $cid)->get();
$venue_data = $competition->select("venue", null, ["competition_id" => $cid])->getAll();
$pick_venue = Helper::route("public_competition_venue");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $comp_data['competition_name'] ?></title>
    <?php include_once("../routes/components/head.php") ?>
</head>
<body>
    <h1><?= $comp_data['competition_name'] ?></h1>
    <br>
    <h2>Pick Venue</h2>
    <?php foreach($venue_data as $venue) { ?>
        <a href="<?= $pick_venue ?>?cid=<?= $cid ?>&vid=<?= $venue['id'] ?>"><?=  $venue['venue_name'] ?></a>
    <?php } ?>
</body>
</html>