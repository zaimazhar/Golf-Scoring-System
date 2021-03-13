<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin", "admin"]);

$competitionRoute = Helper::route("competition_venue");
$allCompetition = $auth->all("competition")->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/admin_head.php" ?>
    <title>Compute Score</title>
</head>
<body>
    <div id="wrapper">
        <?php include_once "./components/navbar_admin.php" ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Pick Competition to Compute</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <table class="table table-bordered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Competition</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($allCompetition as $competition) { ?>
                                            <tr>
                                                <td>
                                                    <a href="<?= $competitionRoute . "?cid=" . $competition['id'] ?>"><?= $competition['competition_name'] ?></a>
                                                </td>
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

    </div>
    <?php include_once("./components/admin_footer.php") ?>
</body>
</html>