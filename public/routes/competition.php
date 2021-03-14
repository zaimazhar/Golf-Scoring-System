<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$cid = $_GET['cid'];

// $url = parse_url($_SERVER['REQUEST_URI']);
// parse_str($url['query'], $queries);

// foreach($queries as $key => $query) {
//     $$key = $key;
//     $$key = $query;
//     echo $cid;
// }

$venuePost = Helper::route("posts.admins_create_venue");
$venueLink = Helper::route("venue");
$venueDelete = Helper::route("posts.venue_delete");
$stablefordUpdate = Helper::route("stableford_update");

$competition_data = $auth->find("competition", $cid)->get();
$venue = $auth->select("venue", null, ["competition_id" => $cid]);
$venue_count = $venue->count();

$venue_get = $venue->getAll();
$checkCount = $competition_data['num_of_venue'] - $venue_count;
$count = 1;
$sf_point = $auth->select("stableford", ["id", "par", "point"], ["competition_id" => $cid], "par")->getAll();
$sfLink = Helper::route("posts.stableford_insert");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Formats</title>
    <?php include_once("./components/admin_head.php") ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title"><?= $competition_data['competition_name'] ?></h4>
                        </div>
                    </div>
                </div>
                    <?= Sessions::old("sf_insert") ?>
                    <?= Sessions::old("sf_update") ?>
                <br> 
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title mb-3">Venues</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($venue_count >= 0) { ?>
                                    <?php foreach($venue_get as $venue_click) { ?>
                                    <?php $vid = $venue_click['id']; $vname = $venue_click['venue_name']; ?>
                                    <tr>
                                        <th class="text-muted"><?= $vname ?></th>
                                        <td>
                                            <a class="btn btn-primary" href=" <?= "$venueLink?cid=$cid&vid=$vid" ?>">View</a>
                                            <button class="btn btn-danger" onclick="venueDeleteConfirmation('<?= $vname ?>',<?= $vid ?>)">Delete</button>
                                        </td>
                                    </tr>                
                                    <?php } ?>
                                    <?php if($checkCount !== 0) { ?>
                                    <form id="venue_form" action="<?= $venuePost ?>" method="post">
                                    <?php for($i = 0; $i < $checkCount; $i++) { ?>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="venue_name">Venue Name</label>
                                                <input type='text' name='venue[]' class="form-control" id="venue_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="venue_type">Venue Type</label>
                                                <select class="form-control" name="venue_type[]" id="venue_type">
                                                    <option value="solo">Solo</option>
                                                    <option value="team">Team</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <input type="hidden" name="cid" value="<?= $cid ?>">
                                    </form>
                                    <?php } ?>
                                        <?php } else {?>
                                            <p>Error getting all the venues.</p>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php if($checkCount !== 0) { ?>
                                        <button type="submit" form="venue_form" class="btn btn-success mt-3">Submit</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div><!-- end col-->
                        <div class="col-xl-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Stableford</h4>
                                    <form id="sf" action="<?= "$sfLink?cid=$cid" ?>" method="post">
                                        <div class="form-inline row">
                                            <label class="col-3 col-form-label">Par</label>
                                            <label class="col-4 col-form-label">Point</label>
                                        </div>
                                            <?php if(count($sf_point) > 0) { ?>
                                                <?php foreach($sf_point as $point) { ?>
                                                <div class="form-inline">
                                                    <input disabled type="number" placeholder="Par" class="form-control mt-3 mr-3"  value="<?= $point['par'] ?>">
                                                    <input disabled type="number" placeholder="Point" class="form-control mt-3 mr-3" value="<?= $point['point'] ?>">
                                                    <a href="<?= "$stablefordUpdate?cid=$cid&id=" . $point['id'] ?>">Edit</a>
                                                </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="form-inline">
                                                    <input type="text" placeholder="Par" class="form-control mt-3 mr-3" name="par[]">
                                                    <input type="text" placeholder="Point" class="form-control mt-3 mr-3" name="point[]">
                                                </div>
                                            <?php } ?>                                        
                                    </form>
                                <div class="my-3">
                                    <button class="btn btn-primary" onclick="stableford()">Add Column</button>
                                    <button class="btn btn-success" type="submit" form="sf">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php"); ?>
</body>
</html>