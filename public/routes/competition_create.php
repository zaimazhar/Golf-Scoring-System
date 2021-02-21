<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("superadmin");

$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url['query'], $queries);

foreach($queries as $key => $query) {
    $$key = $key;
    $$key = $query;
    echo $cid;
}

?>
