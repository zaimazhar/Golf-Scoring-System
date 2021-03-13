<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$cid = $_GET['cid'];

$compute = Helper::route("posts.compute_venue");

$comp_name = $auth->find("competition", $cid)->get();
$venue_data = $auth->select("venue", ["id", "venue_name"], ["competition_id" => $cid])->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $comp_name['competition_name'] ?></title>
    <?php include_once("./components/admin_head.php") ?>
</head>
<body>
    <div id="id">
        <?php include_once("./components/navbar_admin.php") ?><br>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <?php if($venue_data) { ?>
                            <form action="<?= $compute ?>" method="post">
                            <?php foreach($venue_data as $venue) { ?>
                                <label for="<?= $venue['id'] ?>"><?= $venue['venue_name'] ?></label><input type="checkbox" name="" value="<?= $venue['id'] ?>" id="<?= $venue['id'] ?>">
                                <br>
                            <?php } ?>
                                <button type="submit">Compute</button>
                            </form>
                            <?php } else { ?>
                                <h4>This competition has no venue.</h4>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>