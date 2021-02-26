<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege("superadmin");

$cid = $_GET['cid'];

// $url = parse_url($_SERVER['REQUEST_URI']);
// parse_str($url['query'], $queries);

// foreach($queries as $key => $query) {
//     $$key = $key;
//     $$key = $query;
//     echo $cid;
// }

$venuePost = Helper::route("posts.organizer_create_venue");
$venueLink = Helper::route("venue_format");

$competition_data = $auth->find("competition", $cid)->get();
$venue = $auth->select("venue", null, ["competition_id" => $cid]);
$venue_count = $venue->count();

if($venue_count > 0) {
    $venue_get = $venue->getAll();
    $checkCount = $competition_data['num_of_venue'] - $venue_count;
    $generateForm = "";
    $generateVenueLink = "";
    $count = 1;
    
    foreach($venue_get as $venue_click) {
        $vid = $venue_click['id'];
        $generateVenueLink .= "<a href='$venueLink?cid=$cid&vid=$vid'>" . $venue_click['venue_name'] . "</a><br>";
    }
    
    for($i = 0; $i < $checkCount; $i++) {
        $generateForm .= "Venue " . $count . ": <input type='text' name='venue[]'><select name='venue_type[]'><option value='solo' selected>Solo</option><option value='team'>Team</option></select><br>";
        $count++;
    }
} else {

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
    <?php Sessions::old("error_venue"); ?>
    <?php if($venue_count > 0) { ?>
    <?= $generateVenueLink ?>
    <?php if($checkCount !== 0) { ?>
    <form action="<?= $venuePost ?>" method="post">
        <input type="hidden" name="cid" value="<?= $cid ?>">
        <?= $generateForm ?>
        <button type="submit">Submit</button>
    </form>
        <?php } ?>
    <?php } else {?>
        <p>There is no venue.</p>
    <?php } ?>
</body>
</html>