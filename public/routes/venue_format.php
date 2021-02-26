<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("superadmin");

$cid = $_GET['cid'];
$vid = $_GET['vid'];

$auth->select("venue", null, ["id" => $vid, "competition_id" => $cid]);
$auth->update("venue", ["id" => $cid, "competition_id" => $vid, "type" => "team"]);