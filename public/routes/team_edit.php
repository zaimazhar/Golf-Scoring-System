<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$tid = $_GET['tid'];
$vid = $_GET['vid'];
$cid = $_GET['cid'];

$player_add = Helper::route("posts.team_edit");
$score_add = Helper::route("team_score");

$venue = $auth->select("venue", ["venue_holes"], ["id" => $vid])->get();
$getTeam = $auth->find("team", $tid)->get();
$getAllPlayerTeam = $auth->select("participant", null, ["team_id" => $tid])->getAll();
$getAllPlayer = $auth->rawSQL("SELECT * FROM participant WHERE venue_id=? AND team_id IS NULL", [$vid])->getAll();
$venue_holes = range(1, $venue["venue_holes"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Team - <?= $getTeam['team_name'] ?></title>
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
                            <h4 class="page-title">Team: <?= $getTeam['team_name'] ?></h4>
                        </div>
                    </div>
                </div>
                <h4><?php Sessions::old("insert_team") ?></h4><br>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card-box">
                            <h3 class="page-title mb-3">Add Score</h3>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>Hole</th>
                                </thead>
                                <tbody>
                                    <?php foreach($venue_holes as $hole) { ?>
                                    <tr>
                                        <td><a class="h2 btn btn-primary btn-block" href="<?= "$score_add?hole=$hole&vid=$vid&tid=$tid&cid=$cid" ?>"><?= $hole ?></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card-box">
                            <h3 class="page-title mb-3">Add Player</h3>
                            <form action="<?= $player_add ?>" method="post">
                                <input type="hidden" name="team_id" value="<?= $tid ?>">
                                <input type="hidden" name="venue_id" value="<?= $vid ?>">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label" for="addplayer">Venue</label>
                                    <select multiple class="col-6 form-control text-center" name="add_player[]" id="addplayer">
                                        <?php foreach($getAllPlayer as $player) { ?>
                                            <option value="<?= $player['id'] ?>"><?= $player['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-2"></div>
                                    <button class="btn btn-success col-6" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card-box text-center">
                            <h3 class="page-title mb-3">Current Team Player</h3>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>Name</th>
                                </thead>
                                <tbody>
                                    <?php foreach($getAllPlayerTeam as $team_player) { ?>
                                        <tr>
                                            <td><h5><?= $team_player['name'] ?></h5></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>