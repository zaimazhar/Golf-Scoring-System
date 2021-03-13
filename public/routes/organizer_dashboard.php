<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$gen_link = "";

$auth->check();
$auth->checkPrivilege(["superadmin"]);

$getCompetition = $auth->all("competition")->getAll();

$registeradmin = Helper::route("posts.organizer_register_admin");
$createcompetition = Helper::route("posts.organizer_create_competition");
$getIntoCompetition = Helper::route("competition");

foreach($getCompetition as $competition) {
    $id = $competition['id'];
    $comp_name = $competition['competition_name'];
    $href = "$getIntoCompetition?cid=$id";
    $gen_link .= "<a href='$href'>$comp_name</a>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/admin_head.php" ?>
    <title>Organizer - Dashboard</title>
</head>
<body>
    <div id="wrapper">
        <?php include_once "./components/navbar_admin.php" ?>
        <div class="content-page">
            <div class="content">
                    <?php Sessions::old("created_venue"); ?>
                    <?php Sessions::old("error_venue"); ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Tournament</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getCompetition as $competition) { ?>
                                                <tr>
                                                    <th class="text-muted">
                                                    <a href="competition?cid=<?= $competition['id'] ?>"><?= $competition['competition_name'] ?></a>    
                                                    </th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card-box">
                                <h2>Create Admin</h2><br>
                                <form action="<?= $registeradmin ?>" method="post">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="email">Email</label>
                                        <input class="col-6 form-control" type="email" name="admin_email" id="email">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="name">Name</label>
                                        <input class="col-6 form-control" type="text" name="admin_name" id="name">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="password">Password</label>
                                        <input class="col-6 form-control" type="password" name="admin_password" id="password">
                                    </div>
                                    <button class="btn btn-success" name="button" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-box">
                                <h2>Create Competition</h2><br>
                                <form action="<?= $createcompetition ?>" method="post">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="comp_name">Competition Name</label>
                                            <input class="col-6 form-control" type="text" name="comp_name" id="comp_name">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="comp_venue">No. of Venue</label>
                                            <input class="col-6 form-control" type="number" name="no_of_venue" id="comp_venue">
                                        </div>
                                    <button class="btn btn-success" name="button" type="submit">Submit</button>
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
