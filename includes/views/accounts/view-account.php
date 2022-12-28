<?php
    
    global $clss, $mydb, $stud, $hlth, $activ, $grdn;

    if( !isset( $_GET['student'] ) || !$stud->is_student( $_GET['student'] ) ){

        message('Ivalid View Request', 'error');

        echo '<script type="text/javascript" language="javascript">
                location.href = "index.php?view=students";
            </script>';

        exit();
    }


    if( $_SESSION['mwh_s_rl'] != 'admin'){

        message('Ivalid View Request', 'error');

        echo '<script type="text/javascript" language="javascript">
                location.href = "index.php?view=students";
            </script>';

        exit();
    }

    $studentID  = $mydb->escape_value( $_GET['student'] );

    $student    = $stud->get_student( $studentID );

    $health     = $hlth->get_health( $studentID );
    $activity   = $activ->get_activity( $studentID );
    $guardian   = $grdn->get_guardian( $studentID );
    
    $classes    = $clss->listclasses();

?>

<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">View Student</h2>
        
        </div>
        <div class="col-md-6" style="margin-top: 10px;">
            <button class="btn btn-success btn-labeled pull-right" onclick="goBack()"><i class="fa fa-hand-o-left"></i> Back</button>
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=students"> Students</a></li>
                <li class="active">View Student</li>
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
                            <h5>View Student Info</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">

                        <form class="form-horizontal" id="student-form" method="post" action="app/helpers/students/edit-student.php">

                            <div class="form-group hidden">
                                <div class="col-sm-10">
                                    <input type="number" name="studentID" class="form-control"  required value="<?= $studentID?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Student Number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="stdnumber" class="form-control" id="stdnumber" required value="<?= $student->stdnumber ?>" disabled>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required value="<?= $student->name ?>">
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" class="form-control" id="surname" required value="<?= $student->surname ?>">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Initials:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="initials" class="form-control" id="initials" maxlength="5" required value="<?= $student->initials ?>">
                                </div>

                            </div>
                            
                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Gender:</label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control select2" id="gender" required>
                                        <option value="">-- Select --</option>
                                        <option value="male" <?php if( $student->gender == 'male' ) echo 'selected' ?> >Male</option>
                                        <option value="female" <?php if( $student->gender == 'female' ) echo 'selected' ?> >Female</option>                            
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Birth:</label>
                                <div class="col-sm-10">
                                    <input type="date" name="birth" class="form-control" id="birth" required value="<?= $student->dob ?>">
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class:</label>
                                <div class="col-sm-10">
                                    <select name="classID" class="form-control select2" id="classID" required>
                                        <option value="">-- Select Class--</option>

                                        <?php foreach( $classes as $class){   ?>

                                            <option value="<?= $class->classID; ?>" <?php if( $student->classID == $class->classID ) echo 'selected' ?> >
                                                <?= htmlentities($class->name); ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="date" class="col-sm-2 control-label">Parental Status:</label>
                                <div class="col-sm-10">
                                    <select name="pstatus" class="form-control select2" id="pstatus" required>
                                        <option value="">-- Select --</option>
                                        <option value="Not an Orphan" <?php if( $student->p_status == 'Not an Orphan' ) echo 'selected' ?> >Not Orphan</option>

                                        <option value="Single Father Orphan" <?php if( $student->p_status == 'Single Father Orphan' ) echo 'selected' ?> >Single Father</option>

                                        <option value="Single Mother Orphan" <?php if( $student->p_status == 'Single Mother Orphan' ) echo 'selected' ?> >Single Mother</option>

                                        <option value="Double Orphan" <?php if( $student->p_status == 'Double Orphan' ) echo 'selected' ?>>Double Orphan</option>

                                        <option value="Adopted" <?php if( $student->p_status == 'Adopted' ) echo 'selected' ?>>Adopted</option>
                                        
                                    </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Student Type:</label>
                                <div class="col-sm-10">
                                    <select name="stype" class="form-control select2" id="stype" required>
                                        <option value="">-- Select --</option>
                                        <option value="Boarding" <?php if( $student->s_type == 'Boarding' ) echo 'selected' ?>>Boarding</option>
                                        <option value="Not Boarding" <?php if( $student->s_type == 'Not Boarding' ) echo 'selected' ?>>Not Boarding</option>                            
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Religion:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="religion" class="form-control" id="religion" required value="<?= $student->religion ?>">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Enrolling Year:</label>
                                <div class="col-sm-10">
                                    <select name="year" class="form-control select2" id="year" required>
                                        <option value="">-- Select Year--</option>
                                        <?php

                                            $y = date('Y');

                                            for( $i = $y; $i > 2009; $i-- ) {
                                        ?>
                                                <option value="<?=$i?>" <?php if( $student->e_year == $i ) echo 'selected' ?>><?=$i?></option>

                                        <?php

                                            }
                                        ?>
                                    </select>
                                </div>
                            
                            </div>

                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h5>Fill Extra Mural Activities</h5>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Activity:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="activity" class="form-control" id="activity" required value="<?= $activity ?>">
                                </div>

                            </div>

                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h5>Fill Extra Health Status</h5>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Health Status:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="health" class="form-control" id="health" required value="<?= $health ?>">
                                </div>
                            
                            </div>


                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h5>Fill the Guardian Info</h5>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gname" class="form-control" id="gname" required value="<?= @$guardian->name ?>">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Surname:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gsurname" class="form-control" id="gsurname" required value="<?= @$guardian->surname ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Mobile:</label>
                                <div class="col-sm-10">
                                    <input type="tel" name="gmobile" class="form-control" id="gmobile" required value="<?= @$guardian->tel ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Work:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gwork" class="form-control" id="gwork" required value="<?= @$guardian->work ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gaddress" class="form-control" id="gaddress" required value="<?= @$guardian->address ?>">
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
        $("#student-form").validate();       
    });

</script>

