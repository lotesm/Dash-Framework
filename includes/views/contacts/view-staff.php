<?php

	global $mydb, $stff;

    if( !isset( $_GET['staff'] ) || !$stff->is_staff( $_GET['staff'] ) ){

        message('Ivalid View Request', 'error');

        echo '<script type="text/javascript" language="javascript">
                location.href = "index.php?view=staff";
            </script>';

        exit();
    }

	if( $_SESSION['mwh_s_rl'] != 'admin' ){

		message('Invalid view request', 'error');

		echo '<script type="text/javascript" language="javascript">
                location.href = "../../../index.php";
            </script>';

        exit();
	}

	$staffID 	= $mydb->escape_value( $_GET['staff'] );

	$staff 		= $stff->get_staff( $staffID );



?>
<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">View Staff</h2>
        
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=staff"> Staff</a></li>
            	<li class="active">View Staff</li>
            </ul>
        </div>
        <div class="col-md-6" style="margin-top: 10px;">
            <button class="btn btn-success btn-labeled pull-right"><i class="fa fa-hand-o-left" onclick="goBack()"></i> Back</button>
        </div>
     
    </div>
    <!-- /.row -->
</div>

<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>View Staff Info</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">
                        
                        <form class="form-horizontal" id="staff-form" method="post" action="app/helpers/staff/edit-staff.php">

                        	<div class="form-group">
                                <div class="col-sm-10">
                                    <input type="number" name="staffID" class="form-control hidden" id="staffID" required value="<?= $staff->staffID ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Username:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" required value="<?= $staff->username ?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required value="<?= $staff->name ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" class="form-control" id="surname" required value="<?= $staff->surname ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Contacts:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="contact" class="form-control" id="contact" maxlength="8" required  value="<?= $staff->contact ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Role:</label>
                                <div class="col-sm-10">
                                    <select name="role" class="form-control select2" id="role" required>
                                        <option value="">-- Select --</option>

                                        <option value="admin" <?php if( $staff->role == 'admin') echo 'selected' ?> >Admin</option>

                                        <option value="teacher" <?php if( $staff->role == 'teacher') echo 'selected' ?> >Teacher</option>

                                        <option value="treasurer" <?php if( $staff->role == 'treasurer') echo 'selected' ?> >Treasurer</option> 

                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary" id="">Edit</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

    // $.validator.setDefaults({
    //     submitHandler: function() {
    //         alert("submitted!");
    //     }
    // });

    $().ready(function() {
        // validate the comment form when it is submitted
        // $("#login-form").validate();

        // validate signup form on keyup and submit
        $("#staff-form").validate({
            rules: {
                name: "required",
                surname: "required",
                contact: {
                    required: true,
                    lesMobile5: true,
                    rangelength: [8,8]
                },
                role: "required"
            },
            messages: {
                name: "Name is required",
                surname: "surname is required",
                contact: {
                    equired: "Mobile number is required",
                    rangelength: "Your mobile number must be a Lesotho valid number 4"
                },
                role: "Role is required"
            }

        });

        jQuery.validator.addMethod("lesMobile5", function(value, element) {
          // allow any non-whitespace characters as the host part
          return this.optional( element ) || iscontact56( value ) ;
        }, 'Your mobile number must be a Lesotho valid number');


    });

    function iscontact56( value ){

        if( value.indexOf("5") == 0 )
            
            return true

        if( value.indexOf("6") == 0 )

            return true


        return false
    }

</script>