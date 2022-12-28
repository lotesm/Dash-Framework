<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $stff, $mydb;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] != 'teacher' ){

		
		$username 	= gen_staff_num();

		$password 	= gen_password();

		$hash 		= $stff->hashSSHA( $password );

		$h_password = $hash["encrypted"];
		$salt 		= $hash["salt"];
		
		$stff->username 	= $username;
		$stff->role 		= isset( $_POST['role'] ) ? $_POST['role'] : '';
		$stff->name 		= isset( $_POST['name'] ) ? $_POST['name'] : '';
		$stff->surname 		= isset( $_POST['surname'] ) ? $_POST['surname'] : '';
		$stff->contact 		= isset( $_POST['contact'] ) ? $_POST['contact'] : '';
		$stff->password 	= $h_password;
		$stff->salt 		= $salt;


		if ( $stff->create() ){

			$staffID =  $mydb->insert_id();

			$staffd = 'Username: '.$username.'<br>Password: '.$password;

			message( 'New Staff Member Added: <a href="index.php?view=staff&action=view-staff&staff='.$staffID.'"><b>'. $_POST['name'].' '.$_POST['surname'] .'</b></a> created successfully!<br>'.$staffd, 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=staff&action=add-staff";
	            </script>';

		}else {

			message( 'Error creating staff!', 'error' );

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