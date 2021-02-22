<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("superadmin");

$cid = $_GET['cid'];
echo $cid;
// $url = parse_url($_SERVER['REQUEST_URI']);
// parse_str($url['query'], $queries);

// foreach($queries as $key => $query) {
//     $$key = $key;
//     $$key = $query;
//     echo $cid;
// }

$competition_data = $auth->find("competition", $cid)->get();
$venue_count = $auth->find("venue", $cid)->count();
$checkCount = $competition_data['num_of_venue'] - $venue_count;
$generateForm = "";

for($i = 0; $i < $checkCount; $i++) {
    $generateForm .= "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Formats</title>
</head>
<body>
    
</body>
</html>