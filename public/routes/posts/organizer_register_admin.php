<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

if($_SERVER['REQUEST_METHOD'] === "GET") {
    Sessions::setSession("get", "Restricted location!");
    Helper::home();
} else {
    $auth->startTransaction();
    $createUser = $auth->create("new_user", [
        "user_email" => filter_var(strip_tags($_POST['admin_email']), FILTER_SANITIZE_EMAIL),
        "user_name" => filter_var(strip_tags($_POST['admin_name']), FILTER_SANITIZE_STRING),
        "user_password" => password_hash($_POST['admin_password'], PASSWORD_BCRYPT),
    ]);
    $auth->endTransaction();

    if($createUser) {
        echo "Created";
    } else {
        Helper::home();
    }
}