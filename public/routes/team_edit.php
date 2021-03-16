<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$tid = $_GET['tid'];

$getTeam = $auth->find("team", $tid)->get();
$getAllPlayerTeam = $auth->select("participant", null, ["team_id" => $tid])->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Team - <?= $getTeam['team_name'] ?></title>
    <?php include_once("./components/admin_head.php") ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Team: <?= $getTeam['team_name'] ?></h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <table class="table table-bordered">
                            <thead>
                                <th></th>
                                <th></th>
                            </thead>
                            <!-- Iterate all users here -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>