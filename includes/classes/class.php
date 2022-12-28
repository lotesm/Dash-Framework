<?php
	

	class Level {

		protected static  $tblclass = "tblclasses";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tblclass);

		}


		function listclasses(){

			global $mydb;

			$querystr = "SELECT * FROM ".self::$tblclass;


			$mydb->setQuery($querystr);

			$cur = $mydb->loadResultList();

			return $cur;
			
		}


		function is_class( $classID = 0 ){
			
			global $mydb;

			$classID = $mydb->escape_value( $classID );

			$queryStr = "SELECT * FROM ".self::$tblclass;
			$queryStr .= " WHERE classID = '".$classID."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows($cur);

			if( $row_count > 0 )

				return true;

			return false;
		
		}

		 
		function get_class( $classID = 0 ){

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tblclass;
			$queryStr .= " WHERE classID = '".$classID."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			return $cur;
		
		}

		function get_class_leading(){

			global $mydb;

			$teacherID = $_SESSION['mwh_s_tkn'];

			$queryStr = "SELECT * FROM `tblclassteachers`";
			$queryStr .= " WHERE teacherID = '".$teacherID."'";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			if( $cur )

				return $cur->classID;

			return 0;
		}


		function get_roll( $classID = 0 ){

			global $mydb;

			$queryStr = "SELECT COUNT(classID) AS total FROM `tblstudents`";
			$queryStr .= " WHERE `classID` = ".$classID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			return $cur->total;

		}

		function get_class_list( $classID = 0 ){

			global $mydb;

			if( isset( $_GET['class'] ) && $_SESSION['mwh_s_rl'] == 'admin' ){

				$classID = $mydb->escape_value( $_GET['class'] );
			}

			$queryStr = "SELECT * FROM  `tblstudents`";
			$queryStr .= " WHERE `classID` = ".$classID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadResultList();

			return $cur;

		}

		function get_classteacher( $classID = 0 ){

			global $mydb, $stff;

			$queryStr = "SELECT * FROM `tblclassteachers`";
			$queryStr .= " WHERE `classID` = ".$classID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			if( $cur ){

				$teacher = $stff->get_staff( $cur->teacherID );

				return $teacher->name.' '.$teacher->surname;
			}

			return 'None';
		
		}

		function get_classteacher_ID( $classID = 0 ){

			global $mydb, $stff;

			$queryStr = "SELECT * FROM `tblclassteachers`";
			$queryStr .= " WHERE `classID` = ".$classID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			if( $cur )

				return $cur->teacherID;

			return '';
		
		}

		function set_classteacher( $classID = 0, $teacherID = 0 ){

			global $mydb, $stff;


			/*
			* remove class from list of classes with class teachers
			*/
			$queryStr = "DELETE FROM `tblclassteachers`";
			$queryStr .= " WHERE `classID` = ".$classID;

			$mydb->setQuery( $queryStr );

			$mydb->executeQuery();



			/*
			* remove teacher from list of class teachers
			*/
			$queryStr = "DELETE FROM `tblclassteachers`";
			$queryStr .= " WHERE `teacherID` = ".$teacherID;

			$mydb->setQuery( $queryStr );

			$mydb->executeQuery();


			/*
			* New lets set a new recors of class teacher
			*/
			$queryStr = "INSERT INTO `tblclassteachers`";
			$queryStr .= " ( classID, teacherID )";
			$queryStr .= " VALUES (".$classID.", ".$teacherID." )";

			$mydb->setQuery( $queryStr );

			$mydb->executeQuery();
		
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
			$sql = "INSERT INTO ".self::$tblclass." (";
			$sql .= join(", ", array_keys($attributes));
			$sql .= ") VALUES ('";
			$sql .= join("', '", array_values($attributes));
			$sql .= "')";

			$mydb->setQuery( $sql );

			if( $mydb->executeQuery() ) {

				$this->id = $mydb->insert_id();

				return true;

			} else {

				return false;
			}
		}

		public function update( $classID = 0 ) {
			
		  	global $mydb;

			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();

			foreach($attributes as $key => $value) {

			  	$attribute_pairs[] = "{$key}='{$value}'";
			}

			$sql = "UPDATE ".self::$tblclass." SET ";
			$sql .= join(", ", $attribute_pairs);
			
			$sql .= " WHERE classID = ". $classID;

		  	$mydb->setQuery($sql);

		 	if( $mydb->executeQuery() ) 

		 		return true;

		 	return false;	
			
		}	


	}

	$clss = new Level();
?>