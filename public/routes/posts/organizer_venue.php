<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

if(Helper::checkRequest("GET") || !$auth->user()) {
    Helper::denyAccess();
}

$venue = $auth->create("venue", [
    "competition_id" => Helper::SanitizeNumber($_POST['cid']),
    "venue_name" => Helper::SanitizeString($_POST['venue_name']),
    "venue_type" => Helper::SanitizeString($_POST['venue_type']),
    "venue_format" => Helper::SanitizeString($_POST['venue_format']),
    "venue_holes" => Helper::SanitizeNumber($_POST['venue_holes'])
]);

