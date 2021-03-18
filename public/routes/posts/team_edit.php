<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

if(Helper::checkRequest("GET"))
    Helper::denyAccess();

$players = $_POST['add_player'];
$tid = $_POST['team_id'];
$vid = $_POST['venue_id'];
$cid = $_POST['competition_id'];

for($i = 0; $i < count($players); $i++) {
    $auth->update("participant", ["team_id" => $_POST['team_id']], ["id" => $players[$i]]);
}

Helper::redirect("team_edit?vid=$vid&tid=$tid&cid=$cid");

?>
