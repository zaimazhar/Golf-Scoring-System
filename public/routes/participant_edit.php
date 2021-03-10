<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$vid = $_GET['vid'];
$pid = $_GET['pid'];
$hole = $_GET['hole'];
$venue_type = "";

$postEdit = Helper::route("posts.admins_edit_participant");


$checkFormat = $auth->select("venue", ["venue_type"], ["id" => $vid])->get();
$stableford = $auth->select("stableford", null, ["venue_id" => $vid], "par")->getAll();

$player_data = $auth->select("score", ["par", "sf_point", "player_id"], ["player_id" => $pid, "hole" => $hole, "venue_id" => $vid])->get();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Score</title>
    <?php include_once("./components/head.php"); ?>
</head>
<body>
    <?php foreach($stableford as $ref) { ?>
        <p><span>Par <?= $ref['par'] ?></span>: <span><?= $ref['point'] ?></span></p>
    <?php } ?>
    <form action="<?= $postEdit ?>" method="post">
        <label for="par">Editing Hole <?= $hole ?></label><br>
        <input type="hidden" name="venue" value="<?= $vid ?>">
        <input type="hidden" name="hole" value="<?= $hole ?>">
        <input type="number" id="par" name="par" value="<?= $player_data['par'] ?>">
        <?php if($checkFormat === "stroke") { ?>
            <span><?= $player_data['sf_point'] ?></span>
        <?php } ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>