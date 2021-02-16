<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

if($_SERVER['REQUEST_METHOD'] === "GET") {
    Sessions::setSession("get", "Restricted location!");
    $auth->Attempt();
    // Helper::home();
} else {
}