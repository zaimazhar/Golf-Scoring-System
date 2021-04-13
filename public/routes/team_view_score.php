<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$cid = $_GET['cid'];
$vid = $_GET['vid'];
$tid = $_GET['tid'];

$team_data = $auth->find("team", $tid)->get();
$datas = $auth->select("score", ["hole", "par", "sf_point"], ["team_id" => $tid], "hole")->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./components/admin_head.php") ?>
    <title>Team Score - <?= $team_data['team_name'] ?></title>
</head>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Team: <?= $team_data['team_name'] ?></h4>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card-box">
                            <h3 class="page-title mb-3">Score</h3>
                            <table class="table text-center">
                                <thead>
                                    <th scope="col">Hole</th>
                                    <th scope="col">Par</th>
                                    <th scope="col">Stableford Point</th>
                                </thead>
                                <tbody>
                                <?php foreach($datas as $data) { ?>
                                    <tr>
                                        <td><?= $data['hole'] ?></td>
                                        <td><?= $data['par'] ?></td>
                                        <td><?= $data['sf_point'] ?></td>
                                    </tr>
                                <?php } ?>                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>