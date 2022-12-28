
<?php

	class Validation{


		function isadminvalidated( $username, $password ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `asas_admin` WHERE `username` = '". $username ."'");


		 	$user_found = $mydb->loadSingleResult();

		 	$encrypted_password 	= $user_found->password;
        	$salt 					= $user_found->salt;

        	$hash = Admin::checkhashSSHA($salt, $password);

        	if ( $encrypted_password == $hash ) 

			   	return true;

			return false;
		
		}

		function not_blaclisted( $username ){

			//Clear user from blackist if time served
	        $this->remove_user_from_blaclts( $username );

	        global $mydb;

			$mydb->setQuery("SELECT * FROM logins WHERE username = '{$username}' ");

			$cur = $mydb->loadSingleResult();

	        if( $cur->can_login == 1 )
	        	
	        	return true;

	        return false;
	        
		}

		function remove_user_from_blaclts( $username ){

			global $mydb;

			if( $this->get_next_login_time( $username ) < 0 &&  $this->get_remaining_trials( $username ) == 0 ){

				$sql = "UPDATE `logins` SET `can_login` = '1', `login_trials` = '3', `next_login` = '' WHERE `username` = '$username'";

			  	$mydb->setQuery($sql);

			 	$mydb->executeQuery(); 

			}

		}

		static function reset_user_blaclist( $username ){

			global $mydb;

			$sql = "UPDATE `logins` SET `can_login` = '1', `login_trials` = '3', `next_login` = '' WHERE `username` = '$username'";

		  	$mydb->setQuery($sql);

		 	$mydb->executeQuery();

		}

		function get_next_login_time( $username ){

			$current_time = time();

			global $mydb;

			$mydb->setQuery("SELECT * FROM logins WHERE username = '{$username}'");

			$cur = $mydb->loadSingleResult();
	        
			if( $cur->next_login == 'suspended')

	        	return $cur->next_login;

	        $time_remianig = ( intval( $cur->next_login ) - $current_time ) / 60;

	        return  round( $time_remianig );
		
		}


		function get_remaining_trials( $username ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM logins WHERE username = '{$username}'");

			$cur = $mydb->loadSingleResult();


	        return  $cur->login_trials;

		}

		function decrement_remaining_trials ( $username, $remiaing_trials ){

			$remiaing_trials--;

			global $mydb;

			$sql = "UPDATE `logins` SET `login_trials` = '$remiaing_trials' WHERE `username` = '$username'";

		  	$mydb->setQuery($sql);

		 	$mydb->executeQuery();

			return $remiaing_trials;

		}

		static function update_remainig_trials( $username ){

			$validate = new Validation();

			$remiaing_trials = $validate->get_remaining_trials( $username );

			// if trials remaining is 0 return else decrement
			if( $remiaing_trials == 1)

				$validate->black_mail_user ( $username );

			// Decrement number of trials remainig
			$remiaing_trials = $validate->decrement_remaining_trials ( $username, $remiaing_trials );

			return $remiaing_trials;

		}

		function black_mail_user ( $username, $next_login_time = '' ){

			if( $next_login_time == '')
				
				$next_login_time = time() + 1800;

			global $mydb;

			$sql = "UPDATE `logins` SET `can_login` = '0', `next_login` = '$next_login_time' WHERE `username` = '$username'";

		  	$mydb->setQuery($sql);

		 	$mydb->executeQuery();

		
		}


		function manage_signatory_status( $username, $action ){


			if( $action == 'active' ){

				$this->reset_user_blaclist( $username );

			} else {

				$this->black_mail_user ( $username, 'suspended' );

			}

		}

		function get_signatory_status ( $username ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM logins WHERE username = '{$username}'");

			$cur = $mydb->loadSingleResult();


	        return  $cur->next_login;

		} 


		function create_login ( $username ){

			global $mydb;

			$sql = "INSERT INTO `logins` (username) VALUES ('$username')";

			echo $mydb->setQuery($sql);

			$mydb->executeQuery();

		}

	}

	$val = new Validation();

?>