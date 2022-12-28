<?php
	
	session_start();

	require_once('../../../includes/config.php');

	global $usr, $mail, $mydb, $val;

	$response = "Access Error";

	if( isset( $_POST['username'] ) ){

		$email 	= $mydb->escape_value( $_POST['username'] );


		if ( $usr->userEmailExists( $email ) ){

			$user = $usr->single_user_by_email( $email );

			$password 	= gen_password();

			$hash 		= $val->hashSSHA( $password );

            $e_password = $hash["encrypted"];
            $salt 		= $hash["salt"];

            $usr->PASS  = $e_password;
            $usr->salt  = $salt;

			if( $usr->update( $user->adminID ) ){

				// $mail->pass_res( $email, $user->NAME, $password );

				$response = 'auth';


			}else{

				$response = 'System Fatal Error: cannot update password tray again.';

			}

		}else {

			$response = 'Email not found';
		}

	}

	echo $response;

    exit();



?>