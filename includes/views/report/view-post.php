
<?php 

	global $clss, $mydb, $control, $lssn, $subj, $stud;

	/*
	* check if user viewed is valid user
	*
	*/
	if( !isset( $_GET['lesson'] ) || !$lssn->is_lesson( ceil( $_GET['lesson'] ) ) ){

		message('Lesson view Error: Redirected to previous view', 'error');

		terminate_action();
	}

	
	$lessonID 	= $mydb->escape_value( $_GET['lesson'] );

	$lesson 	= $lssn->get_lesson( $lessonID );

	$subject	= $subj->get_subject( $lesson->subjectID ); 


	check_message(); 



?>
<div class="row">
	<div class = "col-md-12">

		<button class = "btn btn-primary pull-right btn-sm" onclick="goBack()"><span class = "fa fa-hand-point-left"></span> Back</button>
	</div>

	<div class = "col-md-12 mt-2">
		<center>
			<h4>View Lesson: <b><?= $lesson->title.' ('.$lesson->chapter.')' ?></b></h4></h3>
		</center>
		
	</div>
</div>


<div class="container">

    <div class = "col-md-12 mt-5">

		<div class="row">

			<div class="form-group col-md-4">
				<label>Subject</label>
				<label class="form-control"><?= $subject->subject ?></label>
			
			</div>

			<div class = "form-group col-md-4">
				<label>Chapter</label>
				<label class="form-control"><?= $lesson->chapter ?></label>
			</div>

			<div class = "form-group col-md-4">
				<label>Lesson Topic</label>
				<label class="form-control"><?= $lesson->title ?></label>
			</div>

			<div class = "form-group col-md-12">
				<label>Lesson</label>
				<p class="">
					<?= $lesson->briefing ?>
				</p>
				
			</div>


			<div class = "col-md-12">

				<center>
					<!-- <button type="submit" class="btn btn-primary"><span class = "fa fa-check"></span> Save</button> -->
				</center>

			</div>

		</div>
	
    </div>

</div>

<?php $lssn->set_viewed( $lessonID ); ?>

