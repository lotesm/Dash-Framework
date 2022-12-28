<?php

	/**
	 * 
	 */
	class Settings {
		
		/**
		 * Manage setting for two-factor Auth
		 */
		function set_2_factor_auth ($username, $status){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `auth` WHERE `username` = '$username'");

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );

			if( $row_count > 0 ){

				//echo 'found it';

				$sql = "UPDATE `auth` SET `status`= '$status' WHERE `username` = '$username'";

			  	$mydb->setQuery($sql);

			 	if( !$mydb->executeQuery() ) 
			 		return false;

			 	return true;

			} else {
				//echo 'not found';

				$sql = "INSERT INTO `auth` ( `username`, `status` )  VALUES ('$username', '$status')";

			  	$mydb->setQuery($sql);

			 	if( !$mydb->executeQuery() ) 

			 		return false;

			 	return true;

			}


		}

		function get_admin_auth( $username ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `auth` WHERE `username` = '". $username ."'");

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );

			if( $row_count > 0 ){

				$cur = $mydb->loadSingleResult();

			 	return $cur->status;

			} 

			return 'off';
		
		}

		/**
		 * 
		 */
		function set_session_duration( $username, $duration ){

			global $mydb;

			$sql = "UPDATE `logins` SET `session_length`= '$duration' WHERE `username` = '$username'";

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) 
		 		return false;

		 	return true;

		}

		function get_session_duration( $username ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `logins` WHERE `username` = '$username'");

		  	$cur = $mydb->loadSingleResult();

		  	if ($cur->session_length != '' ){

		  		$minutes = ceil($cur->session_length) / 60000;

		  	} else {

		  		$minutes = 5;
		  	}

		 	return $minutes;
		 	
		}


		/**
		 * Manage setting for two-factor Auth
		 */
		function set_notification ($username, $setting, $status){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `notifications` WHERE `username` = '$username' AND `setting` = '$setting'");

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );

			if( $row_count > 0 ){


				$sql = "UPDATE `notifications` SET `status`= '$status' WHERE `username` = '$username' AND `setting` = '$setting'";

			  	$mydb->setQuery($sql);

			 	if( !$mydb->executeQuery() ) 
			 		return false;

			 	return true;

			} else {

				$sql = "INSERT INTO `notifications` ( `username`, `setting`, `status` )  VALUES ('$username', '$setting', '$status')";

			  	$mydb->setQuery($sql);

			 	if( !$mydb->executeQuery() ) 

			 		return false;

			 	return true;

			}

		}

		function get_notification( $username, $setting ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `notifications` WHERE `username` = '". $username ."'  AND `setting` = '".$setting."'");

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );

			if( $row_count > 0 ){

				$cur = $mydb->loadSingleResult();

			 	return $cur->status;

			} 

			return 'off';
		
		}




	}

	$sett = new Settings();


?>