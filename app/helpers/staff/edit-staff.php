<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $mail, $stff, $mydb;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] != 'teacher' ){

				
		$staffID 			= isset( $_POST['staffID'] ) ? $_POST['staffID'] : '';

		$stff->role 		= isset( $_POST['role'] ) ? $_POST['role'] : '';
		$stff->name 		= isset( $_POST['name'] ) ? $_POST['name'] : '';
		$stff->surname 		= isset( $_POST['surname'] ) ? $_POST['surname'] : '';
		$stff->contact 		= isset( $_POST['contact'] ) ? $_POST['contact'] : '';;


		if ( $stff->update( $staffID ) ){

			// $mail->admin_reg( $_POST['email'], $_POST['name'], $password );

			message( 'Staff Updates', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=staff&action=view-staff&staff='.$staffID.'";
	            </script>';

		}else {

			message( 'Error Updating!', 'error' );

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