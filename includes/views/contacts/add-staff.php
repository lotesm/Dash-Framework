<?php

	if( $_SESSION['mwh_s_rl'] != 'admin' ){

		message('Invalid view request', 'error');

		echo '<script type="text/javascript" language="javascript">
                location.href = "../../../index.php";
            </script>';

        exit();
	}

?>
<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">Add Staff</h2>
        
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=staff"> Staff</a></li>
            	<li class="active">Add Staff</li>
            </ul>
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
                        
                        <form class="form-horizontal" id="staff-form" method="post" action="app/helpers/staff/add-staff.php">

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" class="form-control" id="surname" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Contacts:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="contact" class="form-control" id="contact" maxlength="8" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Role:</label>
                                <div class="col-sm-10">
                                    <select name="role" class="form-control select2" id="role" required>
                                        <option value="">-- Select --</option>
                                        <option value="admin">Admin</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="treasurer">Treasurer</option>                            
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary" id="">Add</button>
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