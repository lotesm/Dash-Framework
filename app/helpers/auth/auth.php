<?php

	session_start();

	// error_reporting(0);

	$response = "Access Error";

	if( isset( $_POST['username'] ) && isset( $_POST['password'] ) ){

		require_once '../../../includes/config.php';

		global $stff, $val, $mail, $mydb;


		/*
		*
		* Clean user inputs first
		*
		*/
		$username = $mydb->escape_value( $_POST['username'] );


		if( $stff->can_login( $username ) && $val->not_blaclisted( $username ) ){


			$auth = $stff->userAuthentication( $username, $_POST['password'] );

			$f_admin = $stff->get_staff_with_username( $username );

			if( $auth ){
				

				Validation::reset_user_blaclist( $username );

				// sent email notification
				// $mail->login_notification( $f_admin->NAME, $username );

				$response = 'auth';

			} else {

				$login_trials = Validation::update_remainig_trials( $username );

                if ( $login_trials == 0){

                	// notify user
                	// $mail->acc_logout_notification( $username, $f_admin->NAME );

                    $response = $username.': 3 wrong consecutive login attempts, your account has been suspended';

                } else {

                	$response = 'The password you entered is wrong, '.$login_trials.' trials reminaing';
					
                }

			}
		
		} else {

			if( !$stff->can_login( $username ) ){

				$response =  'Username or email is invalid';

			} else {

				if( $val->get_next_login_time( $username ) == 'suspended' ){

	                $response = '<b>Account Suspended!</b><br>Call system administrator';


	            } else if ( $val->get_next_login_time( $username ) > 0 ){

	                $response = 'Account Suspended due to 3 Bad login attempts, your next login is in: '.$val->get_next_login_time( $username ).' minutes';

	            }

			}

		
		}
		

	}

	echo $response;

    exit();


?>