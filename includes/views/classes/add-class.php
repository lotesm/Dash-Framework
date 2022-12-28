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
            <h2 class="title">Add Class</h2>
        
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=classes"> Classes</a></li>
            	<li class="active">Add Class</li>
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
                            <h5>Class Info</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">
                        
                        <form class="form-horizontal" id="class-form" method="post" action="app/helpers/classes/add-class.php">

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required>
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
        $("#class-form").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Class name is required"
            }

        });

    });

</script>