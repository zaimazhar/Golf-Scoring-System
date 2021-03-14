<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin"]);

if(Helper::checkRequest("GET"))
    Helper::denyAccess();

$cid = $_GET['cid'];
$dataForm = [];

for($i = 0; $i < count($_POST['point']); $i++) {
    if((strlen($_POST['par'][$i]) > 0) && !empty($_POST['point'][$i])) {
        array_push($dataForm, [$_POST['par'][$i], $_POST['point'][$i], $cid]);
    }
}

$check = $auth->createMultiple("stableford", ["par", "point", "competition_id"], $dataForm);

if($check) {
    Sessions::setSession("sf_insert", "Successfully Inserted Stableford Points");
    Helper::redirect("competition?cid=$cid");
} else {
    Sessions::setSession("sf_insert", "Failed to Insert Stableford Points");
    Helper::redirect("competition?cid=$cid");
}

?>