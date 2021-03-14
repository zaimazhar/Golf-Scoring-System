<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;

$auth->check();
$auth->checkPrivilege(["superadmin"]);

$id = $_GET['id'];
$cid = $_GET['cid'];

$getStableford = $auth->find("stableford", $id)->get();

if(isset($_POST['submit'])) {
    $check = $auth->update("stableford", ["point" => $_POST['point']], ["id" => $id]);
    if($check) {
        Sessions::setSession("sf_update", "Successfully updated stableford");
        Helper::redirect("competition?cid=$cid");
    } else {
        Sessions::setSession("sf_update", "Failed to update stableford");
        Helper::redirect("competition?cid=$cid");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Stableford</title>
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
                            <h4 class="page-title">Editing Stableford</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-box">
                            <h4 class="header-title mb-3">Editing Stableford for Par <?= $getStableford['par'] ?></h4>
                            <form method="post">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label" for="venue_name">Point</label>
                                    <input class="col-8 form-control" name="point" type="number" value="<?= $getStableford['point'] ?>">
                                </div>
                                <button class="btn btn-success" name="submit" type="submit">Update</button>
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