<?php


include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Competition;
use php\misc\Helper;

$cid = $_GET['cid'];
$vid = $_GET['vid'];

$auth = new Auth;
$venue = new Competition;

$venue_data = $venue->find("venue", $vid)->get();

if(!$venue_data)
    Helper::redirect("public_competition?cid=$cid");

$type = $venue_data['venue_type'];
$venue_players = $venue->getAllVenuePlayer($type, $vid, $venue_data['venue_holes']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $venue_data['venue_name'] ?></title>
    <?php include_once("./components/head.php") ?>
</head>
<body class="is-preload">
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <?php include_once("./components/public_header.php") ?>
                <section>
                    <div class="row">
                        <div class="col-12">
                            <h2><?= $venue_data['venue_name'] ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Participant Name</th>
                                            <th>Participant Score (Par)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($venue_players as $data) { ?>
                                            <tr>
                                                <?php if($type === "team") { ?>
                                                    <td><?= $data['team_name'] ?></td>
                                                <?php } else { ?>
                                                    <td><?= $data['name'] ?></td>
                                                <?php } ?>
                                                <td><?= $data['sum'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php include_once("./components/public_sidebar.php") ?>
    </div>
    <?php include_once("./components/footer.php") ?>
</body>
</html>