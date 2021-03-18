<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Competition;
use php\misc\Helper;

$competition = new Competition;
$auth = new Auth;

$cid = $_GET['cid'];

$comp_data = $competition->find("competition", (int) $cid)->get();
$venue_data = $competition->select("venue", null, ["competition_id" => $cid])->getAll();
$pick_venue = Helper::route("public_competition_venue");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $comp_data['competition_name'] ?></title>
    <?php include_once("../routes/components/head.php") ?>
</head>
<body class="is-preload">
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <?php include_once("./components/public_header.php") ?>
                <section>
                        <div class="row">
                            <div class="col-12">
                                <h1><?= $comp_data['competition_name'] ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="box">
                                    <?php foreach($venue_data as $venue) { ?>
                                        <a class="button primary" href="<?= $pick_venue ?>?cid=<?= $cid ?>&vid=<?= $venue['id'] ?>"><?=  $venue['venue_name'] ?></a>
                                    <?php } ?>
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