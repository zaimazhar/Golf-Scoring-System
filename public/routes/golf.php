<?php

include "../ServiceProvider.php";

use php\logic\Auth;
use php\logic\Competition;
use php\logic\Sessions;
use php\misc\Helper;

$auth = new Auth;
$competition = new Competition;

$comp_id = Helper::route("public_competition");

?>

<DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Home | Golf Scoring System</title>
</head>
<body class="is-preload">
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <header id="header">
					<a href="index.html" class="logo"><strong>Editorial</strong> by UniMAP DMDC</a>
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
						<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
					</ul>
				</header>
                <section>
					<div class="features">
                        <?php Sessions::old("expired"); ?>
                        <?php Sessions::old("get"); ?>
                        <?php Sessions::old("error"); ?>
                        <br>
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
					</div>
				</section>
            </div>
        </div>
        <div id="sidebar">
            <div class="inner">
                <nav id="menu">
                    <header class="major">
                        <h2>Menu</h2>
                    </header>
                    <ul>
						<li><a href="/">Sukan UniMAP</a></li>
						<li><a href="/golf.php">Home</a></li>
						<?php $auth->LoginHome() ?>
					</ul>
                </nav>
            </div>
            <a href="#sidebar" class="toggle"></a>
        </div>
    </div>
        <main>
            <h2>Welcome to Golf Scoring System</h2>
            <h4>homepage</h4>
            
        </main>
    <?php include_once("./components/footer.php") ?>
</body>
</html>