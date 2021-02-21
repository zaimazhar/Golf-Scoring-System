<?php

include_once("../../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

if(Helper::checkRequest("GET")) {
    Helper::denyAccess();
} else {
    $auth->startTransaction();
    $createCompetition = $auth->create("competition", [
        "competition_name" => Helper::SanitizeString($_POST['comp_name']),
        "num_of_venue" => Helper::SanitizeNumber($_POST['no_of_venue']),
    ]);
    $auth->endTransaction();
}