<?php

include_once("../ServiceProvider.php");

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$cid = $_GET['cid'];

$compute = Helper::route("posts.compute_venue");

$comp_name = $auth->find("competition", $cid)->get();
$venue_data = $auth->select("venue", ["id", "venue_name"], ["competition_id" => $cid])->getAll();

if(isset($_POST['button'])) {
    if(!isset($_POST['compute']))
        Helper::redirect("competition_venue?cid=$cid");

    $datas = $_POST['compute'];
    $store_score = [];
    $store_venue = [];
    $var = "";

    foreach($datas as $data) {
        $table_content = "";
        $venue = $auth->find("venue", $data)->get();

        if($venue['venue_type'] === "team") {
            if($venue['venue_format'] === "stableford") {
                $venue_scores = $auth->rawSQL("SELECT t.team_name, t.handicap, s.team_id, sum(s.sf_point) FROM score s INNER JOIN team t ON t.id=s.team_id where s.venue_id=? group by s.team_id, t.team_name, t.handicap order by sum desc limit 3", [$data])->getAll();
            } else {
                $venue_scores = $auth->rawSQL("SELECT t.team_name, t.handicap, s.team_id, sum(s.par) FROM score s INNER JOIN team t ON t.id=s.team_id where s.venue_id=? group by s.team_id, t.team_name, t.handicap order by sum asc limit 3", [$data])->getAll();
            }
        } else {
            if($venue['venue_format'] === "stableford") {
                $venue_scores = $auth->rawSQL("SELECT p.name, p.handicap, s.player_id, sum(s.sf_point) FROM score s INNER JOIN participant p ON p.id=s.player_id where s.venue_id=? group by s.player_id, p.name, p.handicap order by sum desc limit 3", [$data])->getAll();
            } else {
                $venue_scores = $auth->rawSQL("SELECT p.name, p.handicap, s.player_id, sum(s.par) FROM score s INNER JOIN participant p ON p.id=s.player_id where s.venue_id=? group by s.player_id, p.name, p.handicap order by sum asc limit 3", [$data])->getAll();
            }
        }

        foreach($venue_scores as $score) {
            if($venue['venue_format'] === "stableford") {
                if($venue['venue_type'] === "team") {
                    $table_content .= '
                    <tr>
                        <td>' . $score['team_name'] . '</td>
                        <td>' . ($score['sum'] + 4) . '</td>
                    </tr>';
                } else {
                    $table_content .= '
                    <tr>
                        <td>' . $score['name'] . '</td>
                        <td>' . ($score['sum'] + 4) . '</td>
                    </tr>';
                }
            } else if($venue['venue_format'] === "stroke") {
                if($venue['venue_type'] === "team") {
                    $table_content .= '
                    <tr>
                        <td>' . $score['team_name'] . '</td>
                        <td>' . $score['sum'] . '</td>
                    </tr>';
                } else if($venue['venue_type'] === "solo_handicap") {
                    $table_content .= '
                    <tr>
                        <td>' . $score['name'] . ' (Handicap: '.$score['handicap'].')</td>
                        <td>' . ($score['sum'] - $score['handicap']) . '</td>
                    </tr>';
                } else {
                    $table_content .= '
                    <tr>
                        <td>' . $score['name'] . '</td>
                        <td>' . $score['sum'] . '</td>
                    </tr>';
                }
            }
        }
    
            $table = '
                <table class="table table-bordered">
                    '. $table_content .'
                </table>';
    
            $var .= '
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">
                            <h3>' . $venue['venue_name'] . ' ('.ucwords($venue['venue_format']).')</h3>
                            ' . $table . '
                        </div>
                    </div>
                </div>';
        }
}

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
    <div id="wrapper">
        <?php include_once("./components/navbar_admin.php") ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Pick Competition to Compute</h4>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card-box">
                                <?php if($venue_data) { ?>
                                <form method="post">
                                <?php foreach($venue_data as $venue) { ?>
                                    <input type="checkbox" name="compute[]" value="<?= $venue['id'] ?>" id="<?= $venue['id'] ?>">
                                    <label for="<?= $venue['id'] ?>"><?= $venue['venue_name'] ?></label>
                                    <br>
                                <?php } ?>
                                    <button class="btn btn-success" name="button" type="submit">Compute</button>
                                </form>
                                <?php } else { ?>
                                    <h4>This competition has no venue.</h4>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card-box">
                                <h3>Winners</h3>
                                <?= $var ?? '' ?>
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