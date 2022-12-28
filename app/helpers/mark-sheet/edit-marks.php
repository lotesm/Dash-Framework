<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $stff, $mydb, $ms, $sett;

	if( isset( $_SESSION['mwh_s_rl'] ) && $sett->sess_set() ){

		$studentID 	= isset( $_POST['studentID'] ) ? $_POST['studentID'] : 0;
		$subjectID 	= $_SESSION['subject'];
		$term 		= $_SESSION['session'];
		$year 		= $_SESSION['year'];

		if( $ms->get_marks_sheet( $studentID, $subjectID, $term, $year ) ){

			$ms->marks 		= isset( $_POST['marks'] ) ? $_POST['marks'] : 0;
			$ms->remarks 	= isset( $_POST['r-marks'] ) ? $_POST['r-marks'] : '';


			if ( $ms->update( $studentID, $subjectID, $term, $year ) ){

				echo 'done';

			}else {

				echo 'Error! close and try again';
			
			}

		}else{

			echo 'Marks Already Exist! try editing.';
		}

	}else{

		message( 'Access Error', 'error' );

		echo 'Access Error';


	}


?>