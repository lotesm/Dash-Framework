<?php
	

	class Admin {

		protected static  $tblstaff = "tblstaff";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tblstaff);
		}
		
		function liststaff( $start = 0, $end = 10 ){

			global $mydb;

			$queryStr = "SELECT * FROM  ".self::$tblstaff;
			$queryStr .= " WHERE role NOT IN ('admin')";
			$queryStr .= " LIMIT ".$start.", ".$end;


			$mydb->setQuery( $queryStr );
			
			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		function staffcount(){

			global $mydb;

			$queryStr = "SELECT * FROM  ".self::$tblstaff;
			$queryStr .= " WHERE role NOT IN ('admin')";

			$mydb->setQuery( $queryStr );
			
			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows($cur);

			return $row_count;
		
		}

		function listnonclassteachers(){

			global $mydb;

			$queryStr = "SELECT * FROM  ".self::$tblstaff;
			$queryStr .= " WHERE staffID NOT IN";
			$queryStr .= " (SELECT tblclassteachers.teacherID FROM tblclassteachers )";
			$queryStr .= " AND tblstaff.role = 'teacher'";


			$mydb->setQuery( $queryStr );
			
			$cur = $mydb->loadResultList();

			return $cur;

		}

		function is_staff( $staffID = 0) {

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tblstaff;
			$queryStr .= " WHERE `staffID` = ".$staffID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();


			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ( $row_count == 1 )

			   	return true;

			return false;
		
		}

		function is_username( $username = "") {

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tblstaff;
			$queryStr .= " WHERE `username` = '".$username."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ( $row_count == 1 )

			   	return true;

			return false;
		
		}

		function get_staff( $staffID = 0 ){

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tblstaff;
			$queryStr .= " WHERE `staffID` = ".$staffID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();
			
			return $cur;
		
		}

		function get_staff_with_username( $username = "" ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblstaff." 
				WHERE username = '{$username}'");

			$cur = $mydb->loadSingleResult();
			
			return $cur;
		
		}

		function classleading( $staffID = 0){

			global $mydb, $clss;

			$queryStr = "SELECT classID FROM tblclassteachers";
			$queryStr .= " WHERE `teacherID` = ".$staffID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			if( $cur ){

				$class = $clss->get_class( $cur->classID );

				return $class->name;
			}

			return 'None';
		}


		/*
		* check if username can login i.e. activated
		*/
		function can_login( $username ){


			global $mydb;

			$mydb->setQuery("SELECT * FROM `logins` WHERE `username` = '{$username}'");

			$cur = $mydb->executeQuery();


			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ( $row_count == 1 )

			   	return true;

			return false;

		}


		// user authetication
		static function userAuthentication( $username, $password ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `tblstaff` WHERE `username` = '". $username ."'");

		 	$f_user = $mydb->loadSingleResult();
		 	

		 	$e_password 	= $f_user->password;
        	$salt 			= $f_user->salt;

        	$hash = Admin::checkhashSSHA($salt, $password);

        	if ( $e_password == $hash ) {

			 	$_SESSION['mwh_s_tkn']   	= $f_user->staffID;
			 	$_SESSION['mwh_s_nms']      = $f_user->name;
			 	$_SESSION['mwh_s_sn']      	= $f_user->surname;
			 	$_SESSION['mwh_s_usn']      = $f_user->username;
			 	$_SESSION['mwh_s_rl'] 		= $f_user->role;


			   	return true;

			} 


			return false;

		}

		/**
		* Encrypting password
		* @param password
		* returns salt and encrypted password
		*/
		function hashSSHA($password) {

			$salt = sha1(rand() );
			$salt = substr($salt, 0, 10);

			$encrypted = base64_encode( sha1($password . $salt, true ) . $salt);

			$hash = array("salt" => $salt, "encrypted" => $encrypted);

			return $hash;
		
		}

		/**
		* Decrypting password
		* @param salt, password
		* returns hash string
		*/
		static function checkhashSSHA($salt, $password) {

			$hash = base64_encode(sha1($password . $salt, true) . $salt);

			return $hash;
		
		}

		/*---Instantiation of Object dynamically---*/
		static function instantiate( $record ) {
			$object = new self;

			foreach($record as $attribute=>$value){

			  if($object->has_attribute($attribute)) {

			    $object->$attribute = $value;

			  }

			} 

			return $object;
		
		}
		
		
		/*--Cleaning the raw data before submitting to Database--*/
		private function has_attribute($attribute) {

		  // We don't care about the value, we just want to know if the key exists
		  // Will return true or false
		  return array_key_exists( $attribute, $this->attributes() );

		}

		protected function attributes() { 
			// return an array of attribute names and their values
			global $mydb;

			$attributes = array();

			foreach( $this->dbfields() as $field ) {

				if(property_exists($this, $field)) {

					$attributes[$field] = $this->$field;

				}
			}

			return $attributes;
		
		}
		
		protected function sanitized_attributes() {

			global $mydb;
			$clean_attributes = array();

			// sanitize the values before submitting
			// Note: does not alter the actual value of each attribute
			foreach($this->attributes() as $key => $value){

				$clean_attributes[$key] = $mydb->escape_value($value);

			}

			return $clean_attributes;
		
		}
		
		
		/*--Create,Update and Delete methods--*/
		public function save() {

		  // A new record won't have an id yet.
		  	return isset($this->id) ? $this->update() : $this->create();
		}
		
		public function create() {

			global $mydb;

			// Don't forget your SQL syntax and good habits:
			// - INSERT INTO table (key, key) VALUES ('value', 'value')
			// - single-quotes around all values
			// - escape all values to prevent SQL injection

			$attributes = $this->sanitized_attributes();

			$sql = "INSERT INTO ".self::$tblstaff." (";
			$sql .= join(", ", array_keys($attributes));
			$sql .= ") VALUES ('";
			$sql .= join("', '", array_values($attributes));
			$sql .= "')";

			echo $mydb->setQuery($sql);

			if($mydb->executeQuery()) {

				$this->id = $mydb->insert_id();
				return true;

			} else {

				return false;

			}

		}

		public function update( $staffID = 0 ) {

		  	global $mydb;

			$attributes = $this->sanitized_attributes();

			$attribute_pairs = array();

			foreach($attributes as $key => $value) {

			  $attribute_pairs[] = "{$key}='{$value}'";

			}

			$sql = "UPDATE ".self::$tblstaff." SET ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " WHERE staffID = ". $staffID;

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) 
		 		return false;

		 	return true;
			
		}

		public function delete( $staffID = 0 ) {

			global $mydb;

			  $sql = "DELETE FROM ".self::$tblstaff;
			  $sql .= " WHERE staffID=". $id;
			  $sql .= " LIMIT 1 ";

			  $mydb->setQuery($sql);
			  
			if( !$mydb->executeQuery() ) return false; 	
		
		}	


	}


	$stff = new Admin();

?>