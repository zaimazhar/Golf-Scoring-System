<?php

use php\logic\Auth;
use php\misc\Helper;

include_once("../../ServiceProvider.php");

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin"]);

if(Helper::checkRequest("POST")) {
    if(isset($_POST['id'])) {
        echo json_encode($auth->find("venue", $_POST['id'])->get());
        $auth->delete("venue", $_POST['id']);
    }
}