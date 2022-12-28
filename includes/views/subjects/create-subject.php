<?php

	if( $_SESSION['mwh_s_rl'] != 'admin' ){

		message('Invalid view request', 'error');

		echo '<script type="text/javascript" language="javascript">
                location.href = "../../../index.php";
            </script>';

        exit();
	}

    global $clss, $stff;

    $classes    = $clss->listclasses();

    $s_count    = $stff->staffcount();
    $staff      = $stff->liststaff( 0, $s_count);

?>
<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">Add Subject</h2>
        
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=subjects"> Subjects</a></li>
            	<li class="active">Add Subject</li>
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
                            <h5>Subject Info</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">
                        
                        <form class="form-horizontal" id="subject-form" method="post" action="app/helpers/subjects/add-subject.php">

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class:</label>
                                <div class="col-sm-10">
                                    <select name="classID" class="form-control select2" id="classID" required>
                                        <option value="">-- Select Class--</option>

                                        <?php foreach( $classes as $class){   ?>

                                            <option value="<?= $class->classID; ?>">
                                                <?php echo hsc($class->name); ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Teacher:</label>
                                <div class="col-sm-10">
                                    <select name="teacherID" class="form-control select2" id="teacherID" required>
                                        <option value="">-- Select Teacher--</option>

                                        <?php foreach( $staff as $teacher){   ?>

                                            <option value="<?= $teacher->staffID; ?>">
                                                <?php echo hsc($teacher->name.' '.$teacher->surname); ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Order Appearence:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="order" class="form-control" id="order" required>
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
        $("#subject-form").validate({
            rules: {
                name: "required",
                classID: "required",
                teacherID: "required",
                order: "required"
            },
            messages: {
                name: "Subject name is required",
                classID: "Select Class",
                teacherID: "Select Teacher",
                order: "Select position in which the subject will appear in report"
            }

        });

    });

</script>