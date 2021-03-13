<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$vid = $_GET['vid'];
$pid = $_GET['pid'];
$hole = $_GET['hole'];
$venue_type = "";

$postEdit = Helper::route("posts.admins_edit_participant");


$checkFormat = $auth->select("venue", ["venue_type"], ["id" => $vid])->get();
$stableford = $auth->select("stableford", null, ["venue_id" => $vid], "par")->getAll();

$player_data = $auth->select("score", ["par", "sf_point", "player_id"], ["player_id" => $pid, "hole" => $hole, "venue_id" => $vid])->get();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Score</title>
    <?php include_once("./components/admin_head.php"); ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Editing hole <?= $hole ?></h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title mb-3">Hole 1</h4>
                            <?php foreach($stableford as $ref) { ?>
                                <p><span>Par <?= $ref['par'] ?></span>: <span><?= $ref['point'] ?></span></p>
                            <?php } ?>
                            <form action="<?= $postEdit ?>" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="player" value="<?= $pid ?>">
                                    <input type="hidden" name="venue" value="<?= $vid ?>">
                                    <input type="hidden" name="hole" value="<?= $hole ?>">
                                    <input type="number" class="form-control" id="par" name="par" value="<?= $player_data['par'] ?>">
                                    <?php if($checkFormat === "stroke") { ?>
                                        <span><?= $player_data['sf_point'] ?></span>
                                    <?php } ?>
                                    <button class="btn btn-block mt-3 btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>