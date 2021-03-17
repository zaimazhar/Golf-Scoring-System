<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$tid = $_GET['tid'];
$hole = $_GET['hole'];
$cid = $_GET['cid'];
$vid = $_GET['vid'];

$insertTeamScore = Helper::route("posts.teamscore");
$editTeamScore = Helper::route("posts.team_edit_score");
$getScore = $auth->select("score", ["par"], ["team_id" => $tid, "venue_id" => $vid, "hole" => $hole])->get();

$getTeamPlayer = $auth->select("participant", null, ["team_id" => $tid])->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Team Score</title>
    <?php include_once("./components/admin_head.php") ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Editing Team Score</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="card-box">
                            <?php if(isset($getScore['par'])) { ?>
                                <h3>Edit Score</h3><br>
                                <form id="team_score" action="<?= "$editTeamScore?tid=$tid&hole=$hole&vid=$vid&cid=$cid" ?>" method="post">
                                <?php foreach($getTeamPlayer as $player) { ?>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="player<?= $player['id'] ?>"><?= $player['name'] ?></label>
                                    <input class="col-4 form-control" type="number" name="score[]" id="player<?= $player['id'] ?>">
                                </div>
                                <?php } ?>
                                <div class="form-group row">
                                    <div class="col-4"></div>
                                    <button class="col-4 btn btn-info" type="submit">Edit</button>
                                </div>
                                </form>
                            <?php } else { ?>
                                <h3>Insert Score</h3><br>
                                <form id="team_score" action="<?= "$insertTeamScore?tid=$tid&hole=$hole&vid=$vid&cid=$cid" ?>" method="post">
                                <?php foreach($getTeamPlayer as $player) { ?>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="player<?= $player['id'] ?>"><?= $player['name'] ?></label>
                                    <input class="col-4 form-control" type="number" name="score[]" id="player<?= $player['id'] ?>">
                                </div>
                                <?php } ?>
                                <div class="form-group row">
                                    <div class="col-4"></div>
                                    <button class="col-4 btn btn-success" type="submit">Submit</button>
                                </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card-box">
                            <h4>Current Score for Hole <?= $hole ?></h4>
                            <h2 class="text-center">Par: <?= $getScore['par'] ?? 'Not Filled' ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>