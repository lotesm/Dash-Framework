<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $subj, $mydb;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] == 'admin' ){


		$subjectID 		= isset( $_POST['subjectID'] ) ? $_POST['subjectID'] : 0;

		$subj->name 		= isset( $_POST['name'] ) ? $_POST['name'] : '';
		$subj->classID 		= isset( $_POST['classID'] ) ? $_POST['classID'] : 0;
		$subj->teacherID 	= isset( $_POST['teacherID'] ) ? $_POST['teacherID'] : 0;


		if ( $subj->update( $subjectID ) ){

			message( 'Subject Updated successfully!<br>', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=subjects&action=view-subject&subject='.$subjectID.'";
	            </script>';

		}else {

			message( 'Error updating subject!', 'error' );

			echo '<script type="text/javascript" language="javascript">
                    window.history.back();
                </script>';
		
		}

	}else{

		message( 'Access Error', 'error' );

		echo '<script type="text/javascript" language="javascript">
                location.href = "../../../index.php";
            </script>';


	}


?>