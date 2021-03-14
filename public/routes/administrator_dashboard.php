<?php

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

include_once "../ServiceProvider.php";

$auth = new Auth;
$gen_link = "";

$auth->check();
$auth->checkPrivilege(["admin"]);

$getCompetition = $auth->all("competition")->getAll();
$getIntoCompetition = Helper::route("competition");

foreach($getCompetition as $competition) {
    $id = $competition['id'];
    $comp_name = $competition['competition_name'];
    $href = "$getIntoCompetition?cid=$id";
    $gen_link .= "<a href='$href'>$comp_name</a>";
}

// include_once "./components/navbar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "./components/admin_head.php" ?>
    <title>Administrator - Dashboard</title>
</head>
<style>
    .darkmode-layer, .darkmode-toggle {
        z-index: 500;
    }
</style>
<body>
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <br>
                <?php Sessions::old("created_venue"); ?>
                <?php Sessions::old("error_venue"); ?>
                <br>
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end row -->
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
                    <!-- end row -->
                </div> <!-- end container-fluid -->
            </div>
        </div>
    </div>
    <?php include_once("./components/admin_footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script>
    function addDarkmodeWidget() {
        new Darkmode().showWidget();
    }
    window.addEventListener('load', addDarkmodeWidget);
    </script>

</body>
</html>