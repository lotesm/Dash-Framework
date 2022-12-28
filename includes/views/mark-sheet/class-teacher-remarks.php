<?php

    global $subj, $clss, $stud, $mydb, $sett;

    $students = array();


	$classID   	= $clss->get_class_leading();
	$students   = $clss->get_class_list( $classID );

    $classes    = $clss->listclasses();

    $terms      = $sett->list_terms();
    $subjects   = $subj->listMySubject();


?>

<div class="main-page">
	<div class="container-fluid">
	    <div class="row page-title-div">
	        <div class="col-md-6">
	            <h2 class="title">Class Teacher Remarks</h2>
	        </div>
	        
	        <!-- /.col-md-6 text-right -->
	    </div>
	    <!-- /.row -->
	    <div class="row breadcrumb-div">
	        <div class="col-md-6">
	            <ul class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
	                <li> <a href="index.php?view=mark-sheet">Mark Sheet</a></li>
					<li class="active">Class Teacher Remarks</li>
				</ul>
	        </div>
            <div class="col-md-6">
                <ul class="breadcrumb pull-right">
                    <li>
                        <button class="btn small" id="subject" data-toggle="modal" data-target="#subject-modal"><?= get_subject() ?></button>
                    </li>
                    <li>
                        <button class="btn small" id="term" data-toggle="modal" data-target="#term-modal"><?= get_term() ?></button>
                    </li>
                    <li>
                        <button class="btn small" id="year" data-toggle="modal" data-target="#year-modal"><?= get_year() ?></button>
                    </li>
                </ul>
            </div>
	    
        </div>
	    <!-- /.row -->
	</div>
	
	<div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="panel">

                	<div class="panel-heading">
                        <div class="panel-title">
                            <h5>Class List</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <?php if( $_SESSION['mwh_s_rl'] == 'admin' ) { ?>

                        <div class="panel-heading">
                                
                            <div class="panel-title col-md-4">
                                <select name="class" class="form-control select2" id="select-class" onchange="remarksClassFilter()">
                                    <option value="">-- Select Class --</option>

                                    <?php foreach ( $classes as $class ) { ?>

                                        <option value="<?= $class->classID ?>"><?= $class->name ?></option>

                                    <?php } ?>
                                </select>
                            
                            </div>

                        </div>

                    <?php } ?>
                    <div class="panel-body p-20">

                        <?php 

                        	if( isset( $_GET['class']) ) {

                        		$classID = $mydb->escape_value( $_GET['class'] );

                        		$class = $clss->get_class( $classID );

                        ?>
                        <div class="col-md-12 mt-5">
                            <center>
                                <h4>Showing: <?= $class->name ?></h4>
                            </center>
                        </div>

                            <button class="btn btn-primary pull-right" id="export-class"> <span class="fa fa-download"></span> Export Class</button>

                        <?php } ?>

                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Id</th>
                                    <th>Student Name</th>
                                    <th>Student Surname</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Student Id</th>
                                    <th>Student Name</th>
                                    <th>Student Surname</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
	                                $cnt=1;

                                    foreach( $students as $student ){   ?>
                                        
                                        <tr>
                                            <td><?= hsc($cnt);?></td>
                                            <td><?= hsc($student->stdnumber);?></td>
                                            <td><?= hsc($student->name);?></td>
                                            <td><?= hsc($student->surname);?></td> 
                                            <td>
                                                <center>
	                                                <button class="btn btn-primary" id="myBtn" onclick="remarks(<?= $student->studentID ;?>)"><span class="fa fa-edit"></span> Manage Remarks</button>
                                                </center>
                                            </td>
                                        
                                        </tr>
                                
                                <?php 
                                        $cnt++;
                                    }

                                ?>
                                                                                               
                            
                            </tbody>
                        </table>

                    </div>
                
                </div>

            </div>
        <!-- /.col-md-6 -->                        
        </div>
	    <!-- /.col-md-12 -->
	</div>
	
</div>

<!-- Add Remarks Modal -->
<div class="modal fade" id="add-remarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Marks</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-container" method="POST" id="add-marks-form">

                    <div class="row">
                        <div class="col-md-3">
                          <h6 style="margin-top: 7px;">Student Name:</h6>
                        </div>
                        <div class="col-md-9">
                          <h6 style="margin-top: 7px;" id="sm-name">Student Name</h6>
                        </div>
                    </div>

                    <input type="number" name="studentID" class="form-control hidden" value="" id="studentID" required>

                    <input type="text" name="classID" class="form-control hidden" value="" required id="classID">


                    <div class="form-group">
                        <label for="email"><b>Term:</b></label>
                        <select name="m-term" required class="form-control" id="m-term">
                            <option value="<?= get_term() ?>"><?= get_term() ?></option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="psw"><b>Marks:</b></label>
                        <input type="number" placeholder="Enter Marks" name="marks" required class="form-control" min="0" max="100" id="marks">
                    </div>

                    <div class="form-group">
                        <label for="psw"><b>Remarks:</b></label>
                        <input type="text" placeholder="Enter Remarks" name="r-marks" required class="form-control" maxlength="150" id="r-marks">
                    </div>

                    <dfn class="" id="add-marks-msg"></dfn>

                    <button type="submit" class="btn" id="btn-save-marks">Save</button>
                    
                </form>
            
            </div>
            
            <div class="modal-footer"> 
                <button class="btn btn-danger" type="button" onclick="reload()">Close</button>
            </div>
        </div>
    </div>

</div>

<!-- 404 error -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <dfn class="alert text-danger">Record not found</dfn>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>

</div>

<?php require_once 'app/resources/modals/session-modals.php' ?>