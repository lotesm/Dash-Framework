<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $stud, $mydb, $hlth, $activ, $grdn;;

	if( isset( $_SESSION['mwh_s_rl'] ) && isset( $_POST['studentID'] ) ){

		$studentID 			= isset( $_POST['studentID'] ) ? $_POST['studentID'] : 0;

		$stud->name 		= isset( $_POST['name'] ) ? $_POST['name'] : '';
		$stud->surname 		= isset( $_POST['surname'] ) ? $_POST['surname'] : '';
		$stud->initials 	= isset( $_POST['initials'] ) ? $_POST['initials'] : '';
		$stud->gender 		= isset( $_POST['gender'] ) ? $_POST['gender'] : '';
		$stud->dob 			= isset( $_POST['birth'] ) ? $_POST['birth'] : '';
		$stud->p_status 	= isset( $_POST['pstatus'] ) ? $_POST['pstatus'] : '';
		$stud->s_type 		= isset( $_POST['stype'] ) ? $_POST['stype'] : '';
		$stud->religion 	= isset( $_POST['religion'] ) ? $_POST['religion'] : '';
		$stud->e_year 		= isset( $_POST['year'] ) ? $_POST['year'] : date('Y');
		$stud->classID 		= isset( $_POST['classID'] ) ? $_POST['classID'] : 0;

		if ( $stud->update( $studentID ) ){

			/*
			* Health Status
			*
			*/
			$hlth->studentID    = $studentID;
			$hlth->health 		= isset( $_POST['health'] ) ? $_POST['health'] : '';

			// $hlth->update( $studentID );
			$hlth->delete( $studentID );
			$hlth->create();


			/*
			* Extra Mural Activities
			*
			*/
			$activ->studentID    = $studentID;
			$activ->activity 	= isset( $_POST['activity'] ) ? $_POST['activity'] : '';

			// $activ->update( $studentID );
			$activ->delete( $studentID );
			$activ->create();

			/*
			* Guardian Info
			*
			*/
			$grdn->studentID    = $studentID;
			$grdn->name 		= isset( $_POST['gname'] ) ? $_POST['gname'] : '';
			$grdn->surname 		= isset( $_POST['gsurname'] ) ? $_POST['gsurname'] : '';
			$grdn->tel 			= isset( $_POST['gmobile'] ) ? $_POST['gmobile'] : '';
			$grdn->work 		= isset( $_POST['gwork'] ) ? $_POST['gwork'] : '';
			$grdn->address 		= isset( $_POST['gaddress'] ) ? $_POST['gaddress'] : '';

			// $grdn->update( $studentID );
			$grdn->delete( $studentID );
			$grdn->create();


			message( 'Student Updated', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=students&action=view-student&student='.$studentID.'";
	            </script>';

			// echo '<script type="text/javascript" language="javascript">
	  //               location.href = "../../../index.php?view=students";
	  //           </script>';

		}else {

			message( 'Error updating student!', 'error' );

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