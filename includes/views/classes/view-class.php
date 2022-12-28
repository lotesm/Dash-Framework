<?php

	global $mydb, $stff, $clss;

    if( !isset( $_GET['class'] ) || !$clss->is_class( $_GET['class'] ) ){

        message('Ivalid View Request', 'error');

        echo '<script type="text/javascript" language="javascript">
                location.href = "index.php?view=classes";
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

	$classID 	= $mydb->escape_value( $_GET['class'] );

	$class 		= $clss->get_class( $classID );

	$s_count    = $stff->staffcount();
    $staff      = $stff->liststaff( 0, $s_count);

	$clsstid 	= $clss->get_classteacher_ID( $classID );



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
                        
                        <form class="form-horizontal" id="class-form" method="post" action="app/helpers/classes/edit-class.php">

                            <input type="number" name="classID" class="form-control hidden" id="classID" required value="<?= hsc($classID) ?>">

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required value="<?= hsc($class->name) ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class Teacher:</label>
                                <div class="col-sm-10">
                                    <select name="teacherID" class="form-control select2" id="teacherID" required>
                                        <option value="">-- Select Class Teacher--</option>

                                        <?php foreach( $staff as $teacher){  ?>

                                            <option value="<?= $teacher->staffID; ?>" <?php if( $clsstid == $teacher->staffID ) echo 'selected'?> >
                                                <?php echo hsc($teacher->name.' '.$teacher->surname); ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class Roll:</label>
                                <div class="col-sm-10">
                                   <label for="default" class="control-label"><?= $clss->get_roll( $class->classID) ?> Students! <a href="index.php?view=students&class=<?= $class->classID ?>">List All</a></label>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary" id="">Update</button>
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
                name: "required",
                teacherID: "required"
            },
            messages: {
                name: "Class name is required",
                teacherID: "Select Class Teacher"
            }

        });

    });

</script>
