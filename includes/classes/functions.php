<?php

	function gen_password(){

		$password = substr(str_shuffle(str_repeat("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ", 2)), 0, 4);

		return $password;
	
	}
	
	function message( $msg = "", $msgtype = "" ) {

		if( !empty( $msg ) ) {
 
			// then this is "set message"
			// make sure you understand why $this->message=$msg wouldn't work
			$_SESSION['message'] = $msg;
			$_SESSION['msgtype'] = $msgtype;

		} else {

			// then this is "get message"
			return $msg;
		}
	
	}

	function check_message(){
	
		if( isset( $_SESSION['message'] ) ){

			if( isset( $_SESSION['msgtype'] ) ){

				if ($_SESSION['msgtype'] == "info"){

	 				echo  '<div class="alert alert-info">'. $_SESSION['message'] . '</div>';
	 				 
				}elseif($_SESSION['msgtype'] == "error"){

					echo  '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
									
				}elseif($_SESSION['msgtype'] == "success"){

					echo  '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';

				}	
				unset($_SESSION['message']);
	 			unset($_SESSION['msgtype']);
	   		}
  
		}	

	}


	/*
	* is user tries to perform any action when session is not activw
	* just terminate the script and return
	*/
	function terminate_action(){

		echo '<script type="text/javascript" language="javascript">
                    window.history.back();
                </script>';

		exit();
	}


	function get_setting( $setting = "" ){

		global $mydb;

		$queryStr = "SELECT * FROM `settings`";
		$queryStr .= " WHERE `setting` ='". $setting ."'";

		$mydb->setQuery( $queryStr );

		$cur = $mydb->loadSingleResult();

		if( !empty( $cur ) )
			
			return $cur->value;

		return 'not set';

	}


	/*
	* get and set api key 
	* 
	*/
	function get_api_key(){

		global $mydb;

		$mydb->setQuery("SELECT * FROM `settings` WHERE `setting` ='api key'");

		$cur = $mydb->loadSingleResult();

		if( !empty( $cur ) )
			
			return $cur->value;

		return 'not set';


	}

	function set_api_key( $key ){

		global $mydb;

		$sql = "DELETE FROM `settings`";
		$sql .= " WHERE setting = 'api key'";
		$sql .= " LIMIT 1 ";

		$mydb->setQuery($sql);

		if( !$mydb->executeQuery() ) {

			$sql = "INSERT INTO `settings` ";
			$sql .= "( setting, value )";
			$sql .= " VALUES ";
			$sql .= "('api key', '".$key."')";

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) 

		 		return false;

		 	return true;

		} else {

			return false;
		}

	}




	/*
	* get and set api url 
	* 
	*/
	function get_api_url(){

		global $mydb;

		$mydb->setQuery("SELECT * FROM `settings` WHERE `setting` ='api url'");

		$cur = $mydb->loadSingleResult();

		if( !empty( $cur ) )
			return $cur->value;

		return 'Not set';


	}

	function set_api_url( $url ){

		global $mydb;

		$sql = "DELETE FROM `settings`";
		$sql .= " WHERE setting = 'api url'";
		$sql .= " LIMIT 1 ";

		$mydb->setQuery($sql);

		if( !$mydb->executeQuery() ) {

			$sql = "INSERT INTO `settings` ";
			$sql .= "( setting, value )";
			$sql .= " VALUES ";
			$sql .= "('api url', '".$url."')";

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) 

		 		return false;

		 	return true;

		} else {

			return false;
		}

	}

	/*
	* get and set paginated values
	* 
	*/
	function get_paginate_count(){

		global $mydb;

		$mydb->setQuery("SELECT * FROM `settings` WHERE `setting` ='paginate'");

		$cur = $mydb->loadSingleResult();

		if( !empty( $cur ) )
			return $cur->value;

		return 0;


	}

	function set_paginate_count( $paginate ){

		global $mydb;

		$sql = "DELETE FROM `settings`";
		$sql .= " WHERE setting = 'paginate'";

		$mydb->setQuery($sql);

		if( $mydb->executeQuery() ) {

			$sql = "INSERT INTO `settings` ( `setting`, `value` )  VALUES ('paginate', '$paginate')";

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) 

		 		return false;

		 	return true;

		} else {

			return false;
		}

	}

	/*
	* get host domain
	* 
	*/
	function get_host_domain(){

		global $mydb;

		$mydb->setQuery("SELECT * FROM `settings` WHERE `setting` = 'host domain'");

		$cur = $mydb->loadSingleResult();

		if( !empty( $cur ) )
			
			return $cur->value;

		return '';


	}

	/*
	*
	*
	*/
	function getBrowser() { 
		
		$u_agent = $_SERVER['HTTP_USER_AGENT'];

		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {

			$platform = 'Linux';

		}elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {

			$platform = 'Mac';

		}elseif (preg_match('/windows|win32/i', $u_agent)) {

			$platform = 'Windows';

		}elseif (preg_match('/android/i', $u_agent)) {

			$platform = 'Android';

		}elseif (preg_match('/apple/i', $u_agent)) {

			$platform = 'IOS';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){

			$bname = 'Internet Explorer';
			$ub = "MSIE";

		}elseif(preg_match('/Firefox/i',$u_agent)){

			$bname = 'Mozilla Firefox';
			$ub = "Firefox";

		}elseif(preg_match('/OPR/i',$u_agent)){

			$bname = 'Opera';
			$ub = "Opera";

		}elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){

			$bname = 'Google Chrome';
			$ub = "Chrome";

		}elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){

			$bname = 'Apple Safari';
			$ub = "Safari";

		}elseif(preg_match('/Netscape/i',$u_agent)){

			$bname = 'Netscape';
			$ub = "Netscape";

		}elseif(preg_match('/Edge/i',$u_agent)){

			$bname = 'Edge';
			$ub = "Edge";

		}elseif(preg_match('/Trident/i',$u_agent)){

			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}

		// finally get the correct version number
		$known = array('Version', $ub, 'other');

		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

		if (!preg_match_all($pattern, $u_agent, $matches)) {

			// we have no matching number just continue
		}


		// see how many we have
		$i = count( $matches['browser'] );

		if ($i != 1) {

			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){

			    $version= $matches['version'][0];

			}else {

			    $version= $matches['version'];
			}

		}else {

			$version= $matches['version'][0];
		}

		// check if we have a number
		if ($version == null || $version == "") {$version = "?"; }

		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	
	}


	/*
	* Popovers html generator
	*
	*/
	function get_date_filter_content(){

		$html  = '<div class="col-md-12 hover-div">

					<a class="col-lg-12 hove-inner-btn btn-danger small" href="index.php?view=support&action=manage-queries&date=today">
						Today
					</a>

					<a class="col-sm-12 hove-inner-btn btn-danger small" href="index.php?view=support&action=manage-queries&date=yesterday">
						Yesterday
					</a>

					<a class="col-md-12 hove-inner-btn btn btn-danger small" href="index.php?view=support&action=manage-queries&date=last 7 days">
						Last 7 days
					</a>

					<a class="col-md-12 hove-inner-btn btn btn-danger small" href="index.php?view=support&action=manage-queries&date=last 30 days">
						Last 30 days
					</a>

					<a class="col-md-12 hove-inner-btn btn btn-danger small" href="index.php?view=support&action=manage-queries&date=this month">
						This month
					</a>

					<a class="col-md-12 hove-inner-btn btn btn-danger small" href="index.php?view=support&action=manage-queries&date=last month">
						Last Month
					</a>

					<a class="col-md-12 hove-inner-btn btn btn-danger small" href="index.php?view=support&action=manage-queries&date=this year">
						This year
					</a>

					<a href="#" class="col-md-12 hove-inner-btn btn btn-danger small" id="custom-range-btn">
						Custom range

					</a>

				</div>';


		return $html;
	
	}


?>