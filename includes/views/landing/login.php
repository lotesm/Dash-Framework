<!-- Preloader -->
<div class="loader bg-blue" style="display: none;">
    <div class="loader-inner ball-scale-ripple-multiple vh-center" style="display: none;">
        <div></div>
        <div></div>
        <div></div>
    </div>

</div>



<div class="main-container" id="page">
    <!-- =========================
        HEADER 
    ============================== -->
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

                        <img src="images/logo-blue.png" alt="logo" width="100"></a> 
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
    <!-- /End Header -->

    <!-- =========================
        REGISTRATION
    ============================== -->
    <section id="cta5-1" class="p-y-lg content-align-md center-md bg-edit bg-white">
        <div class="container">
            <div class="row y-middle">
                <div class="col-md-10 m-b wow zoomIn text-blue" style="visibility: hidden; animation-name: none;">
                    <?php check_message(); ?>
                    <h2 class="title">Student Login</h2>
                    <form method="POST">

                        <div class="from-group col-md-6">
                            <label class="control-label" for="basicinput">Email</label>
                            <div class="controls">
                                <input data-title="A tooltip for the input" type="email" name="user_email" placeholder="Student Email" data-original-title="" class="form-control form-control-sm" required="required" >
                            </div>
                        </div>

                        <div class="from-group col-md-6">
                            <label class="control-label" for="basicinput">Password</label>
                            <div class="controls">
                                <input data-title="A tooltip for the input" type="password" name="user_pass" placeholder="Password" data-original-title="" class="form-control form-control-sm" required="required" >
                            </div>
                        </div>

                        <div class="col-sm-12" style="height: 20px"></div>
                        <div class="from-group col-sm-12">
                            <center>
                                <button class="btn btn--radius btn--green btn-blue" type="submit" name="btnLogin">Submit</button>
                                <a class="text-blue small" href="password-reset.php">Forgot Password?</a>
                            </center>
                            
                        </div>
                        <div class="col-sm-12" style="height: 40px"></div>
                        <div class="from-group col-sm-12">
                            <center>
                                <a class="text-blue" href="register.php">Not Enrolled? Register here</a>
                            </center>
                            
                        </div>
                        <div class="col-sm-12" style="height: 20px"></div>
                        <div class="from-group col-sm-12">
                            <center>
                                <a class="text-blue" href="admin/" style="color: #053961;">Not a student?</a>
                            </center>
                            
                        </div>
                    </form>
                </div>
            </div><!-- /End Row -->
        </div><!-- /End Container -->
    
    </section>
    <!-- /End Cta Section -->
    

   <!-- =========================
         FOOTER
    ============================== -->
    <footer id="footer5-2" class="p-y-md footer f5 bg-blue">
        <div class="container"> 
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="m-t-md">
                        <p class="text-white"><small>
                            © Copyright <?php echo date('Y')?> Smart Mosotho - All Rights Reserved</small>
                        </p>    
                    </div>
                </div>
            </div>
        </div><!-- /End Container -->
    </footer>
    <!-- /End Footer Section -->


</div><!-- /End Main Container -->

    
<!-- Back to Top Button -->
<a href="index.php" class="top" style="background-color:#053961; color: #fff;">Top</a>
