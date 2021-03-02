<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin"]);

if(Helper::checkRequest("GET")) {
    Helper::denyAccess();
} else {
    $createUser = $auth->create("users", [
        "user_email" => Helper::SanitizeEmail($_POST['admin_email']),
        "user_name" => Helper::SanitizeString($_POST['admin_name']),
        "user_password" => password_hash($_POST['admin_password'], PASSWORD_BCRYPT),
    ]);
}