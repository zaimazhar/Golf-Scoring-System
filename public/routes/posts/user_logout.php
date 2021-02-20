<?php

include_once "../../ServiceProvider.php";

use php\logic\Auth;

$auth = new Auth;

if(isset($_POST['logout'])) {
    $auth->logout();
}