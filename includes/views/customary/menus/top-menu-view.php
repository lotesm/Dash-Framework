
<header class="main-header">
    <!-- Logo -->
    <a href="index.php?view=dashboard" class="logo">

        <span class="logo-mini"><b>M</b>HS</span>

        <span class="logo-lg"><b><?= get_setting( 'app name' ) ?></span>
    </a>


    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="index.php?view=dashboard" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="public/images/user.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">
                            <?= $_SESSION['csp_s_nms'].' '.$_SESSION['csp_s_sn'] ?>
                        </span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="public/images/user.png" class="img-circle" alt="User Image">

                            <p><?= $_SESSION['csp_s_usn'] ?>
                                <small><?= $_SESSION['csp_s_rl'] ?></small>
                            </p>
                        </li>
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="index.php?view=admin&action=profile" class="btn btn-default btn-flat">Profile</a>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-default"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
              </li>
            </ul>
        </div>
    </nav>
</header>