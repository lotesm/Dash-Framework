<?php


	class School {

		protected static  $tblschools = "tblschools";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tblschools);
		}
		
		function listofschools(){

			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblschools);

			$cur = $mydb->loadResultList();

			return $cur;
		}

		function listofschoolswithoutpri(){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `tblschools` WHERE ID NOT IN( SELECT school_principals.schoolID FROM school_principals )");

			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		function listofschoolswithoutopr(){

			global $mydb;

			$queriStr = "SELECT * FROM `tblschools` WHERE ID NOT IN( SELECT school_operators.schoolID FROM school_operators )";

			if( $_SESSION['TYPE'] == 'principal' )

				$queriStr = "SELECT * FROM `tblschools` 
							WHERE tblschools.ID IN( SELECT school_principals.schoolID FROM school_principals WHERE school_principals.userID = '$_SESSION[adminID]' ) 
							AND tblschools.ID NOT IN( SELECT school_operators.schoolID FROM school_operators )";

			$mydb->setQuery( $queriStr );

			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		function listofschoolswithoutteachers(){

			global $mydb;

			$queristr = "SELECT * FROM `tblschools` WHERE ID NOT IN( SELECT school_operators.schoolID FROM school_operators )";

			if( $_SESSION['TYPE'] == 'principal' )

				$queristr = "SELECT * FROM `tblschools` 
							WHERE tblschools.ID IN( SELECT school_principals.schoolID FROM school_principals WHERE school_principals.userID = '$_SESSION[adminID]' )";

			if( $_SESSION['TYPE'] == 'operator' )

				$queristr = "SELECT * FROM `tblschools` 
							WHERE tblschools.ID IN( SELECT school_operators.schoolID FROM school_operators WHERE school_operators.userID = '$_SESSION[adminID]' ) ";


			$mydb->setQuery( $queristr );

			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		function find_school( $id = "" ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblschools." 
				WHERE ID = {$id}");

			$cur = $mydb->executeQuery();

			if( $cur == false ){

				die(mysql_error());
			}

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ($row_count == 1)

			   	return true;

			return false;
		
		}

		function get_school( $schoolID = 0 ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblschools." 
				Where schoolID = '{$schoolID}' LIMIT 1");

			$cur = $mydb->loadSingleResult();

			return $cur;
		
		}

		function get_student_school( $studentID = 0 ){

			global $mydb;

			$queryStr = "SELECT * FROM  `school_students`";
			$queryStr .= " WHERE studentID = ".$studentID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			return $this->get_school( $cur->schoolID );
		
		}

		/*
		*
		*Should not be used when Session is owned by admin
		*
		*/
		function findSchoolBySession(){

			global $mydb;


			if( $_SESSION['TYPE'] == 'principal' ){

				$chema = 'school_principals';


			}else if( $_SESSION['TYPE'] == 'operator' ){

				$chema = 'school_operators';

			}else {

				$chema = 'school_tearchers';

			}

			$query = "SELECT * FROM ".$chema." WHERE userID = '".$_SESSION['adminID']."' LIMIT 1";

			$mydb->setQuery( $query );
			

			$cur = $mydb->loadSingleResult();

			return $cur->schoolID;


		}


		function single_school_contacts( $id="" ){
			
				global $mydb;

				$mydb->setQuery("SELECT * FROM ".self::$tblschools." 
					Where ID = '{$id}' LIMIT 1");

				$cur = $mydb->loadSingleResult();

				return $cur->contact;
		
		}

		function single_applicant( $id = "" ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM schools_applications 
				Where ID= '{$id}' LIMIT 1");

			$cur = $mydb->loadSingleResult();

			return $cur;
		
		}

		function is_applicant( $id = "" ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM schools_applications 
				Where ID= '{$id}' LIMIT 1");

			$cur = $mydb->executeQuery();

			if( $cur == false ){

				die(mysql_error());
			}

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ($row_count == 1)

			   	return true;

			return false;
		
		}

		function approve_applicant( $id = "" ){
			global $mydb;

			$sql = "DELETE FROM school_applications";
			$sql .= " WHERE ID=". $id;
			$sql .= " LIMIT 1 ";
			$mydb->setQuery($sql);

			if(!$mydb->executeQuery()) return false; 
		
		}

		// check if school name exist
		static function schoolNameExists( $name ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `tblschools` WHERE `name` = '". $name ."'");

			$cur = $mydb->executeQuery();

			if( $cur == false ){

				die(mysql_error());
			}

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ($row_count == 1)

			   	return true;

			return false;
			
		}

		// check if school email exist
		static function schoolEmailExists( $email ){

			global $mydb;

			$mydb->setQuery("SELECT * FROM `tblschools` WHERE `email` = '". $email ."'");

			$cur = $mydb->executeQuery();

			if( $cur == false ){

				die(mysql_error());
			}

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ($row_count == 1)

			   	return true;

			return false;
			
		}

		function register_student_school( $schoolID, $studentID ){

			global $mydb;
			

			$sql = "INSERT INTO `school_students`";
			$sql .= " (`studentID`, `schoolID` )";
			$sql .= " VALUES ('$studentID', '$schoolID')";

			echo $mydb->setQuery( $sql );

			$mydb->executeQuery();

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
		  return array_key_exists($attribute, $this->attributes());
		}

		protected function attributes() { 
			// return an array of attribute names and their values
			global $mydb;
			$attributes = array();
			foreach($this->dbfields() as $field) {
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
			
			$attributes = $this->sanitized_attributes();

			$sql = "INSERT INTO ".self::$tblschools." (";
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

		public function update( $schoolID = 0 ) {
		  	global $mydb;

			$attributes = $this->sanitized_attributes();

			$attribute_pairs = array();

			foreach($attributes as $key => $value) {

			  $attribute_pairs[] = "{$key}='{$value}'";

			}

			$sql = "UPDATE ".self::$tblschools." SET ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " WHERE schoolID = ". $schoolID;

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) return false; 	

		 	return true;
			
		}

		public function delete( $schoolID = 0 ) {

			global $mydb;
			  $sql = "DELETE FROM ".self::$tblschools;
			  $sql .= " WHERE schoolID =". $schoolID;
			  $sql .= " LIMIT 1 ";
			  $mydb->setQuery($sql);
			  
				if(!$mydb->executeQuery()) return false; 	
		
		}	


	}

	$schl = new School();
?>