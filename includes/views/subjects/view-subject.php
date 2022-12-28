<?php

	global $mydb, $stff, $subj, $clss;

    if( !isset( $_GET['subject'] ) || !$subj->is_subject( $_GET['subject'] ) ){

        message('Ivalid View Request', 'error');

        echo '<script type="text/javascript" language="javascript">
                location.href = "index.php?view=subjects";
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

	$subjectID 	= $mydb->escape_value( $_GET['subject'] );

	$subject 	= $subj->get_subject( $subjectID );

	$classes    = $clss->listclasses();

	$s_count    = $stff->staffcount();
    $staff      = $stff->liststaff( 0, $s_count);



?>
<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">View Subject</h2>
        
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=subjects"> Subjects</a></li>
            	<li class="active">View Subject</li>
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
                            <h5>View Subject Info</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">
                        
                        <form class="form-horizontal" id="subject-form" method="post" action="app/helpers/subjects/edit-subject.php">

                        	<input type="number" name="subjectID" class="form-control hidden" id="subjectID" required value="<?= $subject->subjectID ?>">

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required value="<?= $subject->name ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class:</label>
                                <div class="col-sm-10">
                                    <select name="classID" class="form-control select2" id="classID" required>
                                        <option value="">-- Select Class--</option>

                                        <?php foreach( $classes as $class){   ?>

                                            <option value="<?= $class->classID; ?>" <?php if( $class->classID == $subject->classID ) echo 'selected' ?> >
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

                                            <option value="<?= $teacher->staffID; ?>" <?php if( $teacher->staffID == $subject->teacherID ) echo 'selected' ?> >
                                                <?php echo hsc($teacher->name.' '.$teacher->surname); ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Order Appearence:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="order" class="form-control" id="order" required  value="<?= $subject->order_app ?>">
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
