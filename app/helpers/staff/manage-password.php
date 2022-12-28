<?php
	
	session_start();

	error_reporting(0);

	require_once '../../../includes/config.php';

	global $mail, $usr, $mydb;

	if( isset( $_SESSION['s_a_s_rl'] ) ){

				
		$adminID 				= $_POST['userID'];

		$usr->NAME 				= $_POST['name'];
		$usr->SURNAME 			= $_POST['lastname'];
		$usr->CONTACT			= $_POST['contact'];
		$usr->TYPE				= $_POST['role'];
		$usr->BIO				= $_POST['bio'];
		$usr->QUALIFICATION		= $_POST['qualification'];


		if ( $usr->update( $adminID) ){

			// $mail->admin_reg( $_POST['email'], $_POST['name'], $password );

			message( 'User Updates', 'success');

			echo '<script type="text/javascript" language="javascript">
                    window.history.back();
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