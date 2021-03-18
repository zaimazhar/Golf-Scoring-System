<?php

include "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Competition;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$competition = new Competition;

$comp_id = Helper::route("public_competition");

?>

<DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Home | Golf Scoring System</title>
</head>
<body class="is-preload">
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <?php include_once("./components/public_header.php") ?>
                <section>
                        <?php Sessions::old("expired"); ?>
                        <?php Sessions::old("get"); ?>
                        <?php Sessions::old("error"); ?>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <h2>Competition</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="box">
                                    <?php foreach($competition->showAllCompetition() as $data) { ?>
                                        <tr>
                                            <td><a class="button primary" href="<?= "$comp_id?cid=" . $data['id'] ?>"><?= $data['competition_name']; ?></a></td>
                                        </tr>
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