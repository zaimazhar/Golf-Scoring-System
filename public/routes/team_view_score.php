<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$cid = $_GET['cid'];
$vid = $_GET['vid'];
$tid = $_GET['tid'];

$team = $auth->rawSQL("SELECT t.team_name, s.hole, s.par, s.sf_point FROM team t INNER JOIN score s ON t.id=s.team_id WHERE s.team_id = ?", [$tid])->getAll();
// $team = $auth->select("score", ["hole", "par", "sf_point"], ["team_id" => $tid])->getAll();

foreach($team as $data) {
    echo $data['team_name'] . " - " . $data['hole'] . "<br>";
}
exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Team: <?= $getTeam['team_name'] ?></h4>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <a href="<?= Helper::route('team_view_score') . "?cid=$cid&vid=$vid&tid=$tid" ?>" class="btn btn-primary">View Score</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>