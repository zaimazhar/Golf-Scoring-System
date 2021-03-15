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
                            <h4 class="page-title">Venue: <?= $data['venue_name'] ?></h4>
                        </div>
                    </div>
                </div>
                <h3><?php Sessions::old("venue_update"); ?></h3><br>
                <div class="row">
                    <?php if( $data )  { ?>
                    <div class="col-4 order-12">
                        <div class="card-box">
                            <h3 class="page-title mb-3">Update <?= $data['venue_name'] ?></h3>
                            <form action="<?= $editVenue ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="venue_name">Venue</label>
                                    <input type="text" id="venue_name" name="venue_name" class="col-8 form-control" value="<?= $data['venue_name'] ?>">
                                </div>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="venue_type">Venue Type</label>
                                    <select class="form-control col-8" name="venue_type">
                                        <?php if($data['venue_type'] == "solo") { ?>
                                            <option value="solo" selected>Solo</option>
                                            <option value="solo_handicap">Solo (Handicap)</option>
                                            <option value="team">Team Play</option>
                                        <?php } else if($data['venue_type'] == "solo_handicap") { ?>
                                            <option value="solo_handicap" selected>Solo (Handicap)</option>
                                            <option value="team">Team Play</option>
                                            <option value="solo">Solo</option>
                                        <?php } else {?>
                                            <option value="team" selected>Team Play</option>
                                            <option value="solo_handicap">Solo (Handicap)</option>
                                            <option value="solo">Solo</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="venue_format">Venue Format</label>
                                    <select class="col-8 form-control" name="venue_format">
                                        <?php if($data['venue_format'] == "stroke") { ?>
                                            <option value="stroke" selected>Stroke Play</option>
                                            <option value="stableford">Stableford (Points)</option>
                                        <?php } else { ?>
                                            <option value="stableford" selected>Stableford (Points)</option>
                                            <option value="stroke">Stroke Play</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label" for="venue_holes">Venue Holes</label>
                                    <input class="col-8 form-control" type="number" name="venue_holes" value="<?= $data['venue_holes'] ?>">
                                </div>
                                <button class="btn btn-block btn-success" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                    <?php } else { ?>
                        <p>No data found for the requested venue.</p>
                    <?php } ?>
                    <div class="col-4 order-1">
                        <div class="card-box">
                            <h3 class="page-title">Add New Participant (<?php echo $data['venue_type'] == "solo_handicap" ? "Solo Handicap" : ucwords($data['venue_type']) ?>)</h3>
                            <form id="form_venue" action="<?= $addPlayer ?>" method="post">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input class="form-control mt-3 mr-3" type="text" name="player_name[]" placeholder="Name">
                                        <input class="form-control mt-3 mr-3" type="number" name="player_handicap[]" placeholder="Handicap">
                                    </div>
                                </div>
                            </form>
                            <div class="my-3">
                                <button class="btn btn-success" type="submit" form="form_venue">Submit</button>
                                <button class="btn btn-primary" onclick="addColumn()">Add Columns</button>
                            </div>
                        </div>
                    </div>
                    <?php if($data['venue_type'] === "team") { ?>
                    <div class="col-4 order-1">
                        <div class="card-box">
                            <h3 class="page-title">Add New Team (<?= ucwords($data['venue_type']) ?>)</h3>
                            <form id="form_venue" action="<?= $addPlayer ?>" method="post">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input class="form-control mt-3 mr-3" type="text" name="player_name[]" placeholder="Name">
                                        <input class="form-control mt-3 mr-3" type="number" name="player_handicap[]" placeholder="Handicap">
                                    </div>
                                </div>
                            </form>
                            <div class="my-3">
                                <button class="btn btn-success" type="submit" form="form_venue">Submit</button>
                                <button class="btn btn-primary" id="column">Add Columns</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php if($data['venue_type'] === "team") { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h3 class="page-title">Teams</h3>
                            <form action="" id="form_team" method="post">
                                <input type="text" class="form-control mt-3 mr-3" name="teams[]" placeholder="Team">
                            </form>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h3 class="page-title">Participants</h3>
                            <table class="table table-bordered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($participants as $participant) { ?>
                                        <tr>
                                            <td>
                                                <h5><?= $participant['name'] ?></h5>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="<?= Helper::route("participant?cid=$cid&vid=$vid&pid=" . $participant['id'] ) ?>">View</a>
                                                <button class="btn btn-danger" onclick="participantDeleteConfirmation('<?= $participant['name'] ?>',<?= $participant['id'] ?>)">Delete</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php"); ?>
</body>
</html>