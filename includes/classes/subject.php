<?php

	
	class Subject {

		protected static  $tblsubjects = "tblsubjects";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tblsubjects);

		}


		function listStudSubject(){

			global $mydb, $level, $schl;

			$queryStr = "SELECT * FROM `tblsubjects`";

			$mydb->setQuery( $queryStr );

	        $cur = $mydb->loadResultList();

	        return $cur;
		
		}

		function listMySubject(){

			global $mydb, $level, $schl;

			$queryStr = "SELECT * FROM `tblsubjects`";
			$queryStr .= " WHERE `teacherID` = ".$_SESSION['mwh_s_tkn'];

			$mydb->setQuery( $queryStr );

	        $cur = $mydb->loadResultList();

	        return $cur;
		
		}

		function get_subject_teacher( $subjectID = "" ){

			$teacher = New User();
			
			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblsubjects." 
				WHERE subjectID = '{$subjectID}'");

			$cur = $mydb->loadSingleResult();

			$teacher = $teacher->single_user_names( $cur->teacherID );

			return $teacher;
		
		}


		function is_subject( $subjectID ){

			global $mydb;

			$subjectID = $mydb->escape_value( $subjectID );

			$queryStr = "SELECT * FROM ".self::$tblsubjects;
			$queryStr .= " WHERE subjectID = '$subjectID' LIMIT 1";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			$num_rows = $mydb->num_rows( $cur );//get the number of count

			if( $num_rows > 0)

				return true;

			return false;

		}


		 
		function get_subject( $subjectID = 0 ){

			global $mydb;


			$subjectID = $mydb->escape_value( $subjectID );

			$queryStr = "SELECT * FROM ".self::$tblsubjects." 
				WHERE subjectID = ".$subjectID;

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
			$sql = "INSERT INTO ".self::$tblsubjects." (";
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

		public function update( $id=0 ) {
		  	global $mydb;

			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();

			foreach($attributes as $key => $value) {

			  	$attribute_pairs[] = "{$key}='{$value}'";
			}

			$sql = "UPDATE ".self::$tblsubjects." SET ";
			$sql .= join(", ", $attribute_pairs);
			
			$sql .= " WHERE subjectID=". $id;

		  	$mydb->setQuery($sql);

		 	if( $mydb->executeQuery() ) 

				return true;

			return false;; 	
			
		}	


	}

	$subj = New Subject();

?>