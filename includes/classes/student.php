<?php
	
	require_once 'student/student-health.php';
	require_once 'student/student-activities.php';
	require_once 'student/student-guardian.php';
	
	class Student {
		
		protected static  $tblstudent = "tblstudents";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tblstudent);

		}


		function liststudents( $start = 0, $end = 10 ){

			global $mydb;

			$search = '';
			$class 	= '';


			if( isset( $_GET['search'] ) )

				$search = $mydb->escape_value( $_GET['search'] );


			if( isset( $_GET['class'] ) )

				$class = $mydb->escape_value( $_GET['class'] );


			$queryStr = "SELECT * FROM  ".self::$tblstudent;

			if( isset( $_GET['search'] ) )

				$queryStr .= " WHERE `surname` like '%".$search."%'";


			if( isset( $_GET['class'] ) )

				$queryStr .= " WHERE `classID` = '".$class."'";


			if( isset( $_GET['class'] ) || isset( $_GET['search'] ) ){

				$queryStr .= " ORDER BY `tblstudents`.`surname` ASC";

			}else{

				$queryStr .= " ORDER BY `tblstudents`.`created` DESC";

			}
			$queryStr .= " LIMIT ".$start.", ".$end;


			$mydb->setQuery( $queryStr );
			
			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		function studentcount(){

			global $mydb;

			$search = '';
			$class 	= '';


			if( isset( $_GET['search'] ) )

				$search = $mydb->escape_value( $_GET['search'] );


			if( isset( $_GET['class'] ) )

				$class = $mydb->escape_value( $_GET['class'] );


			$queryStr = "SELECT * FROM  ".self::$tblstudent;


			if( isset( $_GET['search'] ) )

				$queryStr .= " WHERE `surname` like '%".$search."%'";

			if( isset( $_GET['class'] ) )

				$queryStr .= " WHERE `classID` = '".$class."'";

			$mydb->setQuery( $queryStr );
			
			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows($cur);

			return $row_count;
		
		}
		
		function is_student( $studentID = 0 ){

			global $mydb;

			$studentID = $mydb->escape_value( $studentID );

			$queryStr = "SELECT * FROM  ".self::$tblstudent;
			$queryStr .= " WHERE studentID = ".$studentID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();


			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ( $row_count == 1 )

			   	return true;

			return false;
		
		}
		 
		function get_student( $studentID = 0 ){

			global $mydb;

			$queryStr = "SELECT * FROM  ".self::$tblstudent;
			$queryStr .= " WHERE studentID = ".$studentID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			return $cur;
		
		}

		function is_stud_exist( $stdnumber = "" ){

			global $mydb;

			$stdnumber = $mydb->escape_value( $stdnumber );

			$queryStr = "SELECT * FROM  ".self::$tblstudent;
			$queryStr .= " WHERE stdnumber = '".$stdnumber."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ( $row_count == 1 )

			   	return true;

			return false;
		
		}

		function is_stud_valid( $stdnumber = "", $classID = 0 ){

			global $mydb;

			$stdnumber = $mydb->escape_value( $stdnumber );

			$queryStr = "SELECT * FROM  ".self::$tblstudent;
			$queryStr .= " WHERE stdnumber = '".$stdnumber."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows( $cur );//get the number of count

			if ( $row_count == 1 ){

				$student = $this->get_stud_w_stdnum( $stdnumber );

				if( $student->classID == $classID )

					return true;
				
			}

			return false;
		
		}

		function get_stud_w_stdnum( $stdnumber = "" ){

			global $mydb;

			$stdnumber = $mydb->escape_value( $stdnumber );

			$queryStr = "SELECT * FROM  ".self::$tblstudent;
			$queryStr .= " WHERE stdnumber = '".$stdnumber."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			return $cur;
		
		}


		/*---Instantiation of Object dynamically---*/
		static function instantiate($record) {
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

			// Don't forget your SQL syntax and good habits:
			// - INSERT INTO table (key, key) VALUES ('value', 'value')
			// - single-quotes around all values
			// - escape all values to prevent SQL injection

			$attributes = $this->sanitized_attributes();

			$sql = "INSERT INTO ".self::$tblstudent." (";
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

		public function update( $studentID = 0 ) {
		  	global $mydb;

			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();

			foreach($attributes as $key => $value) {

			  $attribute_pairs[] = "{$key}='{$value}'";

			}

			$sql = "UPDATE ".self::$tblstudent." SET ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " WHERE studentID = ". $studentID;

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) return false; 

		 	return true;	
			
		}


	}

	$stud = New Student();
?>