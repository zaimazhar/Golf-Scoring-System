<?php

include "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Competition;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$competition = new Competition;

$comp_id = Helper::route("public_competition");

Sessions::old("expired");
Sessions::old("get");
Sessions::old("error");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Home | Golf Scoring System</title>
</head>
<body>
    <?php include_once 'components/navbar.php'?>
    <main>
        <h2>Welcome to Golf Scoring System</h2>
        <h4>homepage</h4>
        <table>
            <tr>
                <th>Competition</th>
            </tr>
            <?php foreach($competition->showAllCompetition() as $data) { ?>
            <tr>
                <td><a href="<?= "$comp_id?cid=" . $data['id'] ?>"><?= $data['competition_name']; ?></a></td>
            </tr>
            <?php } ?>
        </table>

    </main>
</body>
</html>