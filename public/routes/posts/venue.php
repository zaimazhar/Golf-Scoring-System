<?php

include_once("../../ServiceProvider.php");

use php\misc\Helper;

if(Helper::checkRequest("GET")) {
    Helper::denyAccess();
}

?>