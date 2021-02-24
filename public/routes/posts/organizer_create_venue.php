<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;
$venue = [];

$auth->check();
$auth->checkPrivilege("superadmin");

if(Helper::checkRequest("GET")) {
    Helper::denyAccess();
}

// for($i = 0; $i < count($_POST['venue']); $i++) {
//     array_push($venue, [Helper::SanitizeNumber($_POST['cid']), Helper::SanitizeString($_POST['venue'][$i]), "DEFAULT", "DEFAULT", "DEFAULT"]);
// }

$cid = $_POST['cid'];

$auth->createMultiple("", [], []);