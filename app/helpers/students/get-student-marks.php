<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $stud, $stff, $mydb, $hlth, $activ, $grdn;

	if( isset( $_SESSION['mwh_s_rl'] ) && isset( $_POST['studentID'] ) ){

		
		$studentID 	= isset( $_POST['studentID'] ) ? $_POST['studentID'] : 0;
		$subjectID 	= @$_SESSION['subject'];
		$term 		= @$_SESSION['session'];
		$year 		= @$_SESSION['year'];

		$marks 		= $ms->get_marks_sheet( $studentID, $subjectID, $term, $year );

		if ( $marks ){

			$student = $stud->get_student( $studentID );

			$response['names'] 		= $student->name.' '.$student->surname;
			$response['classID'] 	= $student->classID;
			$response['marks'] 		= $marks->marks;
			$response['remarks'] 	= $marks->remarks;

			$response['msg'] = 'found';
			
		}else {

			$response['msg'] = 'Student not Found '.$studentID;
		
		}

	}else{

		
		$response['msg'] = 'Access Error';

	}

	echo json_encode( $response );

	exit();
?>