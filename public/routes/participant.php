<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$pid = $_GET['pid'];
$vid = $_GET['vid'];
$keep_get_score = [];

$postScore = Helper::route("posts.score_insert?vid=$vid&pid=$pid");
$editScore = Helper::route("participant_edit");

$venue = $auth->select("venue", ["venue_holes"], ["id" => $vid])->get();
$participant = $auth->select("participant", ["name"], ["id" => $pid])->get();
$score = $auth->select("score", ["hole", "par"], ["venue_id" => $vid, "player_id" => $pid], 'hole');

$venue_hole = range(1, $venue['venue_holes']);
$holes = $score->getAll();
$hole_filled = $score->count();

foreach($holes as $get_score) {
    array_push($keep_get_score, $get_score['hole']);
}

$hole_diff = array_diff($venue_hole, $keep_get_score);

$unfilled_hole = $venue['venue_holes'] - $hole_filled++;
echo "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./components/head.php") ?>
    <title><?= $participant['name'] ?></title>
</head>
<body>
    <?php foreach($holes as $hole) { ?>
        <span>Hole <?= $hole['hole'] ?> with par of <?= $hole['par'] ?> </span><a href="<?= $editScore . "?vid=$vid&pid=$pid&hole=" . $hole['hole'] ?>">Edit</a><br>
    <?php } ?>
    <br><br>
    <?php if($unfilled_hole > 0) { ?>
    <form action="<?= $postScore ?>" method="post">
        <?php foreach($hole_diff as $diff) { ?>
            <input type="hidden" name="hole[]" value="<?= $diff ?>">
            <label for="hole<?= $diff ?>">Hole <?= $diff?></label><input type="number" style="margin-left: 20px;" placeholder="Par" id="hole<?= $diff ?>" name="par[]"><br>
        <?php } ?>
        <button type="submit">Submit</button>
    <?php } ?>
    </form>
</body>
</html>