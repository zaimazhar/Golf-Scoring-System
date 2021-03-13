<?php

include_once "../ServiceProvider.php";

use php\logic\Auth;
use php\misc\Helper;

$auth = new Auth;

$post = Helper::route("posts.user_login");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "components/head.php" ?>
    <title>Home | Golf Scoring System</title>
</head>
<body>
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
                    <header class="major">
						<h2>Login</h2>
					</header>
					<div class="features">
                    <form action="<?= $post ?>" method="post">
                        <label for="email">Email</label><br>
                        <input type="text" name="user_email" id="email"><br>
                        <label for="">Password</label><br>
                        <input type="password" name="user_password" id="password"><br><br>
                        <button type="submit">Login</button>
                    </form>
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
    <?php include_once("./components/footer.php") ?>
</body>
</html>