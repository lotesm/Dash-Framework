<?php

        global $stud;

        $student = $stud->get_student( $_SESSION['s_m_s_i'] );

?>

<link href="public/css/profile.css" rel="stylesheet">

<style type="text/css">
	.small-nav-handle, .navbar-toggle, .fa-ellipsis-v{
		display: none;
	}
</style>

<section id="blog" class="blog">

	<div class="container">

	    <div class="row profile">

			<div class="col-md-3">

				<div class="profile-sidebar">
					

					<div class="profile-userpic">
						<img src="public/images/user.png" class="img-responsive" alt="">
					</div>
					
					<div class="profile-usertitle">

						<div class="profile-usertitle-name">
							<?= $student->stdname.' '.$student->stdsurname ?>
						</div>

						<div class="profile-usertitle-job">
							<?= $student->stdnumber ?>
						</div>
					
					</div>
					
					<div class="profile-usermenu">
						<ul class="nav">
							<li>
								<a class="nav-item nav-link" href="index.php">
									<i class="bi bi-person-circle"></i>
									Overview 
								</a>
							</li>

							<li>
								<a class="nav-item nav-link" href="index.php?view=dashboard&action=reports">
									<i class="bi bi-book"></i>
									Reports 
								</a>
							</li>

							<li>
								<a class="nav-item nav-link" href="index.php?view=dashboard&action=membership">
									<i class="bi bi-person-badge"></i>
									Membership 
								</a>
							</li>

	                        <li class="active">
	                            <a class="nav-item nav-link" href="index.php?view=dashboard&action=manage-password">
		                            <i class="bi bi-shield-lock"></i>
		                            Manage Password 
		                        </a>
	                        </li>
						</ul>
					
					</div>
					<!-- END MENU -->
				
				</div>

			</div>

			<div class="col-md-9">

	            <div class="profile-content">

				   <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

						<!-- Overview -->
						<div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
							<h5>Manage Password</h5>

						  	<center><?php check_message(); ?></center>

	                        <br />

	                        <form class="form-horizontal row-fluid" method="POST" id="change-pass-form">

	                            <div class="form-group">
	                                <label class="control-label" for="basicinput">Current Password</label>
	                                <div class="controls">
	                                    <input type="password" class="form-control form-control-sm" name="c-pass" id="c-pass" placeholder="Current Password"  required>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="control-label" for="basicinput">New Password</label>
	                                <div class="controls">
	                                    <input type="password" class="form-control form-control-sm" name="n-pass" id="n-pass" placeholder="New Password" required>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="control-label" for="basicinput">Confirm Password</label>
	                                <div class="controls">
	                                    <input type="password" class="form-control form-control-sm" name="r-pass" id="r-pass" placeholder="Confirm Password" required >
	                                </div>
	                            </div>

	                            <div class="form-group">

	                            	<button type="submit" class="btn btn-primary pull-right" name="change-pass">Change</button>
	                            	
	                            </div>

	                        </form>
							
						</div>

					</div>
	            
	            </div>
			
			</div>
		
		</div>

	</div>

</section>

