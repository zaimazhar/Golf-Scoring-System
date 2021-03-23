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

$new_handicap = $_POST['handicap'];
$pid = $_GET['pid'];
$cid = $_GET['cid'];
$vid = $_GET['vid'];

$check = $auth->update("participant", ["handicap" => $new_handicap], ["id" => $pid]);

if($check) {
    Sessions::setSession("handicap", "Successfully Updated Handicap");
    Helper::redirect("venue?cid=$cid&vid=$vid");
} else {
    Sessions::setSession("handicap", "Failed to Update Handicap");
    Helper::redirect("venue?cid=$cid&vid=$vid");
}

?>