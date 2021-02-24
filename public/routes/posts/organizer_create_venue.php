<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$venue = [];

$auth->check();
$auth->checkPrivilege("superadmin");

if(Helper::checkRequest("GET")) {
    Helper::denyAccess();
}

for($i = 0; $i < count($_POST['venue']); $i++) {
    array_push($venue, [Helper::SanitizeNumber($_POST['cid']), Helper::SanitizeString($_POST['venue'][$i])]);
}

if($auth->createMultiple("venue", ["competition_id", "venue_name"], $venue)) {
    $venue = implode(", ", $_POST['venue']);
    Sessions::setSession("created_venue", "Successfully created venue for $venue");
    Helper::redirect("organizer_dashboard");
} else {
    Sessions::setSession("error_venue", "Unable to insert venue");
    Helper::redirect("competition");
}