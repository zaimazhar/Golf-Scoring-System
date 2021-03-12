
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
        <span class="logo-lg">
            <h1>Alhamdulillah</h1>
            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
        </span>
        <span class="logo-sm">
            <h1>Subhanallah</h1>
        </span>
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
    <li class="d-none d-sm-block">
        <form class="app-search">
            <div class="app-search-box">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </li>
    </ul>
</div>