<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$pid = $_GET['pid'];
$vid = $_GET['vid'];
$cid = $_GET['cid'];
$keep_get_score = [];

$postScore = Helper::route("posts.score_insert?vid=$vid&pid=$pid&cid=$cid");
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

$unfilled_hole = $venue['venue_holes'] - $hole_filled;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./components/admin_head.php") ?>
    <title><?= $participant['name'] ?></title>
</head>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Participant: <?= $participant['name'] ?></h4>
                        </div>
                    </div>
                </div>
                <h4 class="mb-4"><?php Sessions::old("par_insert") ?></h4>
                <h4 class="mb-4"><?php Sessions::old("par_edit") ?></h4>
                <div class="row">
                    <div class="col-6">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Filled Holes</h4>
                            <table class="text-center font-weight-bold table table-bordered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Hole</th>
                                        <th>Par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($holes as $hole) { ?>
                                        <tr>
                                            <td><?= $hole['hole'] ?></td>
                                            <td><?= $hole['par'] ?></td>
                                            <td><a class="btn btn-primary" href="<?= $editScore . "?vid=$vid&cid=$cid&pid=$pid&hole=" . $hole['hole'] ?>">Edit</a></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>    
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Unfilled Holes</h4>
                            <table class=" text-center table table-bordered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Unfilled Hole</th>
                                        <th>Par</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($unfilled_hole > 0) { ?>
                                    <form id="par" action="<?= $postScore ?>" method="post">
                                        <?php foreach($hole_diff as $diff) { ?>
                                            <tr>
                                                <td>
                                                    <?= $diff ?>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="hole[]" value="<?= $diff ?>">
                                                        <input type="number" class="form-control" placeholder="Par" id="hole<?= $diff ?>" name="par[]">
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </form>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if($unfilled_hole != 0) { ?>
                            <button type="submit" form="par" class="btn btn-success mt-3">Submit</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>