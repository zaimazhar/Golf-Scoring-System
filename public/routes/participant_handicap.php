<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$pid = $_GET['pid'];
$cid = $_GET['cid'];
$vid = $_GET['vid'];

$participant = $auth->find("participant", $pid)->get();

$handicap_post = Helper::route("posts.participant_handicap");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Handicap</title>
    <?php include_once("./components/admin_head.php") ?>
</head>
<body>
    <div id="wrapper">
        <?= include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Edit Handicap: <?= $participant['name'] ?></h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card-box">
                            <form action="<?= "$handicap_post?cid=$cid&pid=$pid&vid=$vid" ?>" method="post">
                                <label for="handicap" class="h4">Handicap</label>
                                <input type="number" class="form-control" value="<?= $participant['handicap'] ?>" name="handicap" id="handicap">
                                <button type="submit" class="btn btn-warning mt-3">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= include_once("./components/admin_footer.php") ?>
</body>
</html>