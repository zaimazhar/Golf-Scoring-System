<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$cid = $_GET['cid'];
$vid = $_GET['vid'];

$editVenue = Helper::route("posts.organizer_edit_venue?cid=$cid&vid=$vid");
$addPlayer = Helper::route("posts.organizer_add_player?cid=$cid&vid=$vid");

$data = $auth->select("venue", null, ["id" => $vid, "competition_id" => $cid])->get();
$participants = $auth->select("participant", ["id", "name"], ["venue_id" => $vid])->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue</title>
</head>
<body>
    <?php Sessions::old("venue_update"); ?>
    <?php if( $data )  { ?>
    <form action="<?= $editVenue ?>" method="post">
        <input type="text" name="venue_name" value="<?= $data['venue_name'] ?>">
        <select name="venue_type">
            <?php if($data['venue_type'] == "solo") { ?>
                <option value="solo" selected>Solo</option>
                <option value="team">Team Play</option>
            <?php } else { ?>
                <option value="team" selected>Team Play</option>
                <option value="solo">Solo</option>
            <?php } ?>
        </select>
        <select name="venue_format">
            <?php if($data['venue_format'] == "stroke") { ?>
                <option value="stroke" selected>Stroke Play</option>
                <option value="stableford">Stableford (Points)</option>
            <?php } else { ?>
                <option value="stableford" selected>Stableford (Points)</option>
                <option value="stroke">Stroke Play</option>
            <?php } ?>
        </select>
        <input type="number" name="venue_holes" value="<?= $data['venue_holes'] ?>">
        <button type="submit">Update</button>
    </form>
    <?php } else { ?>
        <p>No data found for the requested venue.</p>
    <?php } ?>
    <br><br>
    <h2>Add New Participant</h2>
    <form id="form_venue" action="<?= $addPlayer ?>" method="post">
        <div>
            <input type="text" name="player_name[]" placeholder="Name">
            <input type="number" name="player_handicap[]" placeholder="Handicap">
        </div>
    </form>
    <button type="submit" form="form_venue">Submit</button>
    <button id="column">Add Columns</button>
    <br><br>
    <?php foreach($participants as $participant) { ?>
        <a href="<?= Helper::route("participant?vid=$vid&pid=" . $participant['id'] ) ?>"><?= $participant['name'] ?></a>
    <?php } ?>
    <?php include_once("./components/footer.php"); ?>
</body>
</html>