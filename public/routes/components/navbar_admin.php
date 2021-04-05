
<div class="navbar-custom">
	<ul class="list-unstyled topnav-menu float-right mb-0">
		<li class="dropdown notification-list">
			<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
				<span class="d-none d-sm-inline-block ml-1 font-weight-medium"><?= $_SESSION['name'] ?></span>
				<i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
				<form method='post' action='./posts/user_logout.php'><button class="btn btn-danger btn-block waves-effect waves-light" name='logout' type='submit'>Logout</button></form>
			</div>
		</li>
	</ul>

	<!-- LOGO -->
	<div class="logo-box">
	<a href="index.html" class="logo text-center logo-dark">

	</a>

	<a href="index.html" class="logo text-center logo-light">
		<span class="logo-lg">
			<img src="assets/images/logo-light.png" alt="" height="22">
			<!-- <span class="logo-lg-text-dark">Uplon</span> -->
		</span>
		<span class="logo-sm">
			<!-- <span class="logo-lg-text-dark">U</span> -->
			<img src="assets/images/logo-sm-light.png" alt="" height="24">
		</span>
	</a>
	</div>

	<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
	<li>
		<button class="button-menu-mobile waves-effect waves-light">
			<i class="mdi mdi-menu"></i>
		</button>
	</li>
	</ul>
</div>
<div class="left-side-menu">
	<div class="slimScrollDiv mm-active" style="position: relative; overflow: hidden; width: auto; height: 445px;">
		<div class="slimscroll-menu mm-show" style="overflow: hidden; width: auto; height: 445px;">
			<!--- Sidemenu -->
			<div id="sidebar-menu">
				<ul class="metismenu mm-show" id="side-menu">
					<li class="menu-title">Navigation</li>
					<li>
						<a href="
						<?php if(isset($_GET['cid'])) { echo "competition?cid=$cid"; } else { echo "javascript:history.go(-1)"; } 
						?>">
							<i class="mdi mdi-keyboard-backspace"></i>
							<span>Back to Venue</span>
						</a>	
					</li>
					<li>
						<a href="/">
						<i class="mdi mdi-home-circle-outline"></i>
						<span>Sukan UniMAP</span>
					</a>
				</li>
				<li>
					<?php if($_SESSION['permission'] === "superadmin") { ?>
						<a href="/organizer_dashboard">
						<i class="mdi mdi-view-dashboard"></i>
						<span> Dashboard </span>
					</a>
					<?php } else { ?>
						<a href="administrator_dashboard">
							<i class="mdi mdi-view-dashboard"></i>
							<span> Dashboard </span>
						</a>
						<?php } ?>
				</li>
					<li>
						<a href="/compute.php">
							<i class="mdi mdi-calculator"></i>
							<span>Compute Score</span>
						</a>
					</li>
				</ul>
			</div>
			<!-- End Sidebar -->
		<div class="clearfix"></div>
		</div>
		<div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 5px; position: absolute; top: -392px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 254.858px;"></div>
		<div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
	</div>
</div>