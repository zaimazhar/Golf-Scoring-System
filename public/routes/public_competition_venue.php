<?php


include_once("../ServiceProvider.php");

use php\logic\Competition;

$cid = $_GET['cid'];
$vid = $_GET['vid'];

$venue = new Competition;

$venue_data = $venue->find("venue", $vid)->get();
$venue_players = $venue->getAllVenuePlayer($vid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $venue_data['venue_name'] ?></title>
</head>
<body>
    <table>
        <tr>
            <th>Participant Name</th>
            <th>Participant Score</th>
            <th></th>
        </tr>
        <?php foreach($venue_players as $data) { ?>
            <tr>
                <td><?= $data['name'] ?></td>
                <td><?= $data['sum'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>