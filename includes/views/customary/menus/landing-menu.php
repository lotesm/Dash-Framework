<header id="nav2-3">
                
    <nav class="navbar navbar-fixed-top bg-transparent cta-header" id="main-navbar">
        
        <div class="container">
            <!-- Menu Button for Mobile Devices -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Image Logo -->
                <!-- note:
                    recommended sizes
                        width: 150px;
                        height: 35px;
                -->
                <!-- Image Logo For Background Transparent -->
                <a href="index.php" class="navbar-brand logo-black smooth-scroll">
                    <img src="images/logo-blue.png" alt="logo" width="100"></a>

                <a href="index.php" class="navbar-brand logo-white smooth-scroll">

                    <img src="public/images/logo-blue.png" alt="logo" width="100"></a> 
            </div><!-- /End Navbar Header -->

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <!-- Menu Links -->
                <ul class="nav navbar-nav navbar-right">

                    <li><a href="index.php#about" class="smooth-scroll">About</a></li>

                    <li><a href="index.php#courses" class="smooth-scroll">Courses</a></li>

                    <li><a href="index.php#features" class="smooth-scroll">Features</a></li>

                    <li><a href="index.php#pricing" class="smooth-scroll">Pricing</a></li>

                    <li><a href="index.php?view=forums" class="smooth-scroll">Forum</a></li>
                    
                    <?php if ( isset( $_SESSION['stdID'] )) { ?>

                    <li><a href="index.php?view=profile" class="btn-nav btn-grey btn-login">Student Portal</a></li>

                <?php } else if (isset( $_SESSION['adminID'] ) ) {?>

                    <li class="active"><a href="index.php/admin" class="btn-nav btn-blue smooth-scroll">Dashboard</a></li>

                 <?php } else { ?>

                    <li><a href="login.php" class="btn-nav btn-grey btn-login">Login</a></li>
                    <li class="active"><a href="register.php" class="btn-nav btn-blue btn-green smooth-scroll">Get Started</a></li>

                <?php } ?>
                </ul><!-- /End Menu Links -->
            </div><!-- /End Navbar Collapse -->

        </div><!-- /End Container -->
    
    </nav><!-- /End Navbar -->
</header>