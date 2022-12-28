<?php

    global $subj, $clss;


    $subjects = $subj->listMySubject();

?>
<style>
    .progress-wrapper {
        width:100%;
    }
    .progress-wrapper .progress {
        background-color: #3c8dbc;
        width:0%;
        height: 30px;
        padding-top: 5px;
        color: #fff;
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
</style>
<div class="main-page">

 	<div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h2 class="title">Upload Marks</h2>
            
            </div>
            
            <!-- /.col-md-6 text-right -->
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li> <a href="index.php?view=mark-sheet">Mark Sheet</a></li>
                    <li class="active">Upload Marks</li>
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
                            <h5>Upload Information</h5>
                        </div>
                        <div class="alert" id="upload-feedback"></div>
                    </div>

                    <?php check_message() ; ?>
	           
		            <form class="form-horizontal" method="post" id="upload-marks-form" enctype="multipart/form-data">
	                   
	                    <!-- Class -->
	                    <div class="form-group">

	                        <label for="default" class="col-sm-2 control-label">Class</label>
	                        <div class="col-sm-10">
	                            <select name="classID" id="classID" class="form-control select2" required>
	                                <option value="">-- Select Class --</option>

	                                <?php 

	                                	foreach ( $subjects as $subject ) {  

	                                		$class = $clss->get_class($subject->classID);
	                                ?>

	                                	<option value="<?= $class->classID ?>"><?= $class->name ?></option>

	                            	<?php } ?>
	                                
	                            </select>

	                        </div>

	                    </div>

	                    <!-- Subject -->
	                    <div class="form-group">

	                        <label for="default" class="col-sm-2 control-label">Subject</label>
	                        <div class="col-sm-10">
	                            <select name="subjectID" id="subjectID" class="form-control select2" required>
	                                <option value="">-- Select Subject --</option>

	                                <?php 

	                                	foreach ( $subjects as $subject ) {  

	                                		$class = $clss->get_class($subject->classID);
	                                ?>

	                                	<option value="<?= $subject->subjectID ?>"><?= $subject->name.' ('.$class->name.')' ?></option>

	                            	<?php } ?>
	                                
	                            </select>

	                        </div>
	                    
	                    </div>

	                    <div class="form-group" style="">
	                        <label for="date" class="col-sm-2 control-label ">Term</label>
	                        <div class="col-sm-10">
	                            <select name="term" id="term" class="form-control select2" required>
	                                <option value="">-- Select Term --</option>
	                                <option value="5">First Session (June Exam)</option>
	                                <option value="9">Final Session (Final Exam)</option>
	                                <option value="10">First Term (Monthly tests)</option><option value="11">Second Term (Monthly tests)</option>
	                            </select>
	                        </div>
	                    
	                    </div>

	                    <div class="form-group">
                            <label for="default" class="col-sm-2 control-label">Year:</label>
                            <div class="col-sm-10">
                                <select name="year" id="year" class="form-control select2" id="year" required>
                                    <option value="">-- Select Years--</option>
                                    <?php
                                        $year = date('Y');

                                        for($i = $year; $i > 2009; $i--) {
                                    ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                    
                                    <?php }?>

                                </select>
                            </div>

                        </div>
	                    
	                    <div class="form-group" style="">
	                        <label for="date" class="col-sm-2 control-label">Select CSV File</label>
	                        <div class="col-sm-10">
	                            <input type="file" name="marks-file" id="marks-file" class="form-control input-large" accept=".csv" required>
	                        </div>
	                    </div>

	                    <div class="col-md-12">

	                    	<center>
	                    		<dfn id="upload-msg"></dfn>
	                    	</center>
	                    	
	                    </div>

	                    <div class = "col-md-12">
                            <div class="progress-wrapper">
                                <div id="progress-bar" class="progress"></div>
                            </div>
                        </div>
	                    
	                    <div class="form-group">
	                        <div class="col-sm-offset-2 col-sm-10">
	                            <button type="submit" name="submit" id="submit-btn" class="btn btn-primary" >Upload</button>
	                        </div>
	                    </div>
		            
		            </form>

	            </div>

	        </div>
	    </div>

    </div>

</div>

