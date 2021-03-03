<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;
$score = [];

$vid = $_GET['vid'];
$pid = $_GET['pid'];

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

if(Helper::checkRequest("GET"))
    Helper::denyAccess();

for($i = 0; $i < count($_POST['hole']); $i++) {
    if(!empty($_POST['hole'][$i] && !empty($_POST['par'][$i]))) {
        array_push($score, [$vid, $pid, $_POST['hole'][$i], $_POST['par'][$i]]);
    }
}

$inserScore = $auth->createMultiple("score", ["venue_id", "player_id", "hole", "par"], $score);

if($inserScore) {
    echo "Berjaya";
} else {
    echo "Error";
}

?>