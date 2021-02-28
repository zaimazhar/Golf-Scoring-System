<?php

use php\logic\Auth;

include_once("../../ServiceProvider.php");

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("superadmin");

echo $_GET['vid'];