<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $stud, $stff, $mydb, $hlth, $activ, $grdn;

	if( isset( $_SESSION['mwh_s_rl'] ) && isset( $_POST['studentID'] ) ){

		
		$studentID = $_POST['studentID'];

		if ( $stud->is_student( $studentID ) ){

			$student = $stud->get_student( $studentID );

			$response['names'] = $student->name.' '.$student->surname;

			$response['classID'] = $student->classID;

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