<?php

    global $subj, $clss, $stud, $mydb, $sett;

    $students = array();


    if( isset( $_GET['class'] ) && $clss->is_class( $_GET['class'] ) ){

    	$s_count   	= $stud->studentcount();
    	$students   = $stud->liststudents(0, $s_count);

    	$_SESSION['classID'] = $_GET['class'];

    }

    $terms 		= $sett->list_terms();
    $subjects 	= $subj->listMySubject();

?>
<style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }

  * {box-sizing: border-box;}

   /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
      }

  /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
        width: 600px;
    }

  /* Add styles to the form container */
    .form-container {
        max-width: 600px;
        padding: 10px;
        background-color: #b6b6f7;
    }

  /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

  /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

  /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 14px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }
</style>

<div class="main-page">
	<div class="container-fluid">
	    <div class="row page-title-div">
	        <div class="col-md-6">
	            <h2 class="title">Manage Students Marks</h2>
	        </div>
	        
	        <!-- /.col-md-6 text-right -->
	    </div>
	    <!-- /.row -->
	    <div class="row breadcrumb-div">
	        <div class="col-md-6">
	            <ul class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
	                <li> <a href="index.php?view=mark-sheet">Mark Sheet</a></li>
					<li class="active">Manage Student Marks</li>
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

	                    <div class="panel-heading">
		                        
	                        <div class="panel-title col-md-4">
	                            <select name="class" class="form-control select2" id="select-class" onchange="filterClass()">
	                                <option value="">-- Select Class --</option>

	                                <?php 

	                                	foreach ( $subjects as $sub ) { 

	                                		$class = $clss->get_class($sub->classID);
	                                ?>

	                                	<option value="<?= $sub->classID ?>"><?= $class->name ?></option>

	                                <?php } ?>
	                            </select>
	                        
	                        </div>

	                    </div>

	                    <div class="panel-body p-20">

	                        <?php 

	                        	if( isset( $_GET['class'] ) ) {

	                        		$classID = $mydb->escape_value( $_GET['class'] );

	                        		$class = $clss->get_class( $classID );

	                        ?>
	                        <div class="col-md-12 mt-5">
                                <center>
                                    <h4>Showing: <?= @$class->name ?></h4>
                                </center>
                            </div>

                                <a href="app/helpers/students/export-students.php?class=<?= $_GET['class'] ?>" class="btn btn-primary pull-right" target="_blank"> <span class="fa fa-download"></span> Export Class</a>

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
		                                                <button class="btn btn-primary" id="myBtn" onclick="addMarks(<?= $student->studentID;?>)"><span class="fa fa-plus"></span> Add</button>
		                                                 <button class="btn btn-primary" id="myBtn" onclick="editMarks(<?= $student->studentID;?>)"><span class="fa fa-edit"></span> Edit</button>
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

<!-- Add Marks Modal -->
<div class="modal fade" id="add-marks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


<!-- Edit Marks Modal -->
<div class="modal fade" id="edit-marks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Marks</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-container" method="POST" id="edit-marks-form">

		            <div class="row">
		                <div class="col-md-3">
		                  <h6 style="margin-top: 7px;">Student Name:</h6>
		                </div>
		                <div class="col-md-9">
		                  <h6 style="margin-top: 7px;" id="e-sm-name">Student Name</h6>
		                </div>
		            </div>

		            <input type="number" name="studentID" class="form-control hidden" value="" id="e-studentID" required>

		            <input type="text" name="classID" class="form-control hidden" value="" required id="e-classID">


		            <div class="form-group">
			            <label for="email"><b>Term:</b></label>
			            <select name="m-term" required class="form-control" id="e-m-term">
			                <option value="<?= get_term() ?>"><?= get_term() ?></option>
			                
			            </select>
			        </div>

			        <div class="form-group">
			            <label for="psw"><b>Marks:</b></label>
			            <input type="number" placeholder="Enter Marks" name="marks" required class="form-control" min="0" max="100" id="e-marks">
			        </div>

			        <div class="form-group">
			            <label for="psw"><b>Remarks:</b></label>
			            <input type="text" placeholder="Enter Remarks" name="r-marks" required class="form-control" maxlength="150" id="e-r-marks">
			        </div>

			        <dfn class="" id="edit-marks-msg"></dfn>

		            <button type="submit" class="btn" id="btn-edit-marks">Edit</button>
		            
		        </form>
            
            </div>
            
            <div class="modal-footer"> 
                <button class="btn btn-danger" type="button" onclick="reload()">Close</button>
            </div>
        </div>
    </div>

</div>


<?php require_once 'app/resources/modals/session-modals.php' ?>


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