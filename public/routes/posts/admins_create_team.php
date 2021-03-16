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

$cid = $_GET['cid'];
$vid = $_GET['vid'];
$dataForm = [];

for($i = 0; $i < count($_POST['team']); $i++) {
    if(!empty($_POST['team'][$i]) && !empty($_POST['handicap'])) {
        array_push($dataForm, [$_POST['team'][$i], $_POST['handicap'][$i], $vid]);
    }
}
    
$query = $auth->createMultiple("team", ["team_name", "handicap", "venue_id"], $dataForm);

if($query) {
    Sessions::setSession("team_insert", "Successfully Created Team");
    Helper::redirect("venue?cid=$cid&vid=$vid");
} else {
    Sessions::setSession("team_insert", "Failed to Create Team");
    Helper::redirect("venue?cid=$cid&vid=$vid");
}

?>