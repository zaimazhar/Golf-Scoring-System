<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$pid = $_GET['pid'];
$vid = $_GET['vid'];

$postScore = Helper::route("posts.score_insert?vid=$vid&pid=$pid");

$venue_max_hole = $auth->select("venue", ["venue_holes"], ["id" => $vid])->get();
$participant = $auth->select("participant", ["name"], ["id" => $pid])->get();
$score = $auth->select("score", ["hole", "par"], ["venue_id" => $vid, "player_id" => $pid]);

$holes = $score->getAll();
$hole_filled = $score->count();
$unfilled_hole = $venue_max_hole['venue_holes'] - $hole_filled++;
echo $unfilled_hole . "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $participant['name'] ?></title>
</head>
<body>
    <?php foreach($holes as $hole) { ?>
        <?= "Hole " . $hole['hole'] . " with par of " . $hole['par'] . "<br>" ?>
    <?php } ?>
    <br><br>
    <?php if($unfilled_hole > 0) { ?>
    <form action="<?= $postScore ?>" method="post">
        <?php for($initial = 0; $initial < $unfilled_hole; $initial++, $hole_filled++) { ?>
            <input type="hidden" name="hole[]" value="<?= $hole_filled ?>">
            <label for="hole<?= $hole_filled ?>">Hole <?= $hole_filled ?></label><input type="number" style="margin-left: 20px;" placeholder="Par" id="hole<?= $hole_filled ?>" name="par[]"><br>
        <?php } ?>
        <button type="submit">Submit</button>
    <?php } ?>
    </form>
</body>
</html>