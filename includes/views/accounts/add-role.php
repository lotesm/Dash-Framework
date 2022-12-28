<?php

	global $clss;

    $classes = $clss->listclasses();

?>
<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">Add Students</h2>
        
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=students"> Students</a></li>
            	<li class="active">Add Student</li>
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
                        
                        <form class="form-horizontal" id="student-form" method="post" action="app/helpers/students/add-student.php">

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required autofocus="on">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="surname" class="form-control" id="surname" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Initials:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="initials" class="form-control" id="initials" maxlength="5" required >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Gender:</label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control select2" id="gender" required>
                                        <option value="">-- Select --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>                            
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Birth:</label>
                                <div class="col-sm-10">
                                    <input type="date" name="birth" class="form-control" id="birth" required >
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class:</label>
                                <div class="col-sm-10">
                                    <select name="classID" class="form-control select2" id="class-name" required>
                                        <option value="">-- Select Class--</option>

                                        <?php foreach( $classes as $class){   ?>

                                            <option value="<?= $class->classID; ?>">
                                                <?php echo htmlentities($class->name); ?>
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
                                        <option value="Not an Orphan">Not Orphan</option>
                                        <option value="Single Father Orphan">Single Father</option>
                                        <option value="Single Mother Orphan">Single Mother</option>
                                        <option value="Double Orphan">Double Orphan</option>
                                        <option value="Adopted">Adopted</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Status:</label>
                                <div class="col-sm-10">
                                    <select name="stype" class="form-control select2" id="status" required>
                                        <option value="">-- Select --</option>
                                        <option value="Boarding">Boarding</option>
                                        <option value="Not Boarding">Not Boarding</option>                            
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Religion:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="religion" class="form-control" id="religion" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Enrolling Year:</label>
                                <div class="col-sm-10">
                                    <select name="year" class="form-control select2" id="year" required>
                                        <option value="">-- Select --</option>
                                        <?php
                                            $year = date('Y');

                                            for($i = $year; $i > 2009; $i--) {
                                        ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                        
                                        <?php }?>

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
                                    <input type="text" name="activity" class="form-control" id="activity" required>
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
                                    <input type="text" name="health" class="form-control" id="health" required >
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
                                    <input type="text" name="gname" class="form-control" id="gname" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Surname:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gsurname" class="form-control" id="gsurname" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Mobile:</label>
                                <div class="col-sm-10">
                                    <input type="tel" name="gmobile" class="form-control" id="gmobile" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Work:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gwork" class="form-control" id="gwork" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Address:</label>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" name="gaddress" class="form-control" id="gaddress" required >
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
        $("#student-form").validate();       
    });

</script>