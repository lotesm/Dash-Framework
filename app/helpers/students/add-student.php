<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $stud, $stff, $mydb, $hlth, $activ, $grdn;;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] != 'teacher' ){

		$stdnumber 	= gen_stud_num();

		$password 	= gen_password();

		$hash 		= $stff->hashSSHA( $password );

		$h_password = $hash["encrypted"];
		$salt 		= $hash["salt"];
				
		$stud->stdnumber 	= $stdnumber;
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
		$stud->password 	= $h_password;
		$stud->salt 		= $salt;


		if ( $stud->create() ){

			$studentID =  $mydb->insert_id();

			/*
			* Health Status
			*
			*/
			$hlth->studentID 	= $studentID;
			$hlth->health 		= isset( $_POST['health'] ) ? $_POST['health'] : '';

			$hlth->create();


			/*
			* Extra Mural Activities
			*
			*/
			$activ->studentID 	= $studentID;
			$activ->activity 	= isset( $_POST['activity'] ) ? $_POST['activity'] : '';

			$activ->create();

			/*
			* Guardian Info
			*
			*/
			$grdn->studentID 	= $studentID;
			$grdn->name 		= isset( $_POST['gname'] ) ? $_POST['gname'] : '';
			$grdn->surname 		= isset( $_POST['gsurname'] ) ? $_POST['gsurname'] : '';
			$grdn->tel 			= isset( $_POST['gmobile'] ) ? $_POST['gmobile'] : '';
			$grdn->work 		= isset( $_POST['gwork'] ) ? $_POST['gwork'] : '';
			$grdn->address 		= isset( $_POST['gaddress'] ) ? $_POST['gaddress'] : '';

			$grdn->create();


			message( 'New Student Added: <a href="index.php?view=students&action=view-student&student='.$studentID.'"><b>'. $_POST['name'].' '.$_POST['surname'] .'</b></a> created successfully!', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=students&action=add-student";
	            </script>';

		}else {

			message( 'Error creating student!', 'error' );

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

	exit();
?>