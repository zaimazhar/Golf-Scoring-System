<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

if(Helper::checkRequest("GET"))
    Helper::denyAccess();

$scores = $_POST['score'];
$cid = $_GET['cid'];
$vid = $_GET['vid'];
$hole = $_GET['hole'];
$tid = $_GET['tid'];
$total = 0;

for($i = 0; $i < count($scores); $i++) {
    if($total == 0)
        $total = $scores[$i];
    else if($total > $scores[$i])
        $total = $scores[$i];
}

$sf_point = $auth->select("stableford", ["point"], ["competition_id" => $cid, "par" => $total])->get();
$check = $auth->create("score", ["venue_id" => $vid, "hole" => $hole, "par" => $total, "venue_id" => $vid, "sf_point" => $sf_point['point'] ?? 0, "team_id" => $tid]);

if($check) {
    Sessions::setSession("insert_team", "Successfully Updated Score for Team");
    Helper::redirect("team_edit?cid=$cid&vid=$vid&tid=$tid");
} else {
    Sessions::setSession("insert_team", "Failed to Update Score for Team");
    Helper::redirect("team_edit?cid=$cid&vid=$vid&tid=$tid");
}

?>