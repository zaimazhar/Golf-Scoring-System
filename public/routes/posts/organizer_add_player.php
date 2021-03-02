<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$dataForm = [];

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

if(Helper::checkRequest("GET")) {
    Helper::denyAccess();
}

for($i = 0; $i < count($_POST['player_name']); $i++) {
    if(!empty($_POST['player_name'][$i]) && !empty($_POST['player_handicap'])) {
        array_push($dataForm, [$_POST['player_name'][$i], $_POST['player_handicap'][$i], $_GET['vid']]);
    }
}

$check_type = $auth->find("venue", $_GET['vid'])->get();

if($check_type['venue_type'] === "solo") {
    $query = $auth->createMultiple("players", ["player_name", "player_handicap", "venue_id"], $dataForm);
} else {
    $query = $auth->createMultiple("teams", ["team_name", "team_handicap", "venue_id"], $dataForm);
}

if($query) {
    $vname = $check_type['venue_name'];
    Sessions::setSession("participant_added", "Successfully added participants into <b>$vname</b>");
    Helper::redirect("venue?cid=" . $_GET['cid'] . "&vid=" . $_GET['vid']);
} else {
    Sessions::setSession("participant_added", "Fail to add participants into <b>$vname</b>");
    Helper::redirect("venue?cid=" . $_GET['cid'] . "&vid=" . $_GET['vid']);
}