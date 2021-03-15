<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

if(Helper::checkRequest("GET"))
    Helper::denyAccess();

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);


if(Helper::checkRequest("POST")) {
    if(isset($_POST['id'])) {
        echo $_POST['cname'];
        $auth->delete("stableford", $_POST['id']);
    }
}