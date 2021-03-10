<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

if(Helper::checkRequest("GET"))
    Helper::denyAccess();

$getStablefordPoint = $auth->select("stableford", ["point"], ["venue_id" => $_POST['venue'], "par" => $_POST['par']])->get();

$checkUpdate = $auth->update("score", ["par" => $_POST['par'], "sf_point" => $getStablefordPoint['point'] ?? 0],["venue_id" => $_POST['venue'], "hole" => $_POST['hole']]);

if($checkUpdate) {
    echo "Berjaya";
} else {
    echo "Gagal";
}

?>