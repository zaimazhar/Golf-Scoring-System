<?php

include("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$cid = $_GET['cid'];
$vid = $_GET['vid'];
$venue_name = $_POST['venue_name'];

$update = $auth->update("venue", ["id" => $vid, "venue_type" => Helper::SanitizeString($_POST['venue_type']), "venue_format" => Helper::SanitizeString($_POST['venue_format']), "venue_holes" => Helper::SanitizeNumber($_POST['venue_holes']), "venue_name" => Helper::SanitizeString($venue_name)]);

if($update)
    Sessions::setSession("venue_update", "Successfully updated $venue_name");
else
    Sessions::setSession("venue_update", "Failed to update $venue_name");

Helper::redirect("venue?cid=$cid&vid=$vid");

?>