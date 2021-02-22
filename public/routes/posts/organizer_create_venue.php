<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

if(Helper::checkRequest("GET") || !$auth->user()) {
    Helper::denyAccess();
}

$venue = $auth->create("venue", [
    "competition_id" => $
])


