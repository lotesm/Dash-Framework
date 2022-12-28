<?php

	require_once 'helpers/download-helper.php';

	class Lesson {


		protected static  $tbllesson = "tbllesson";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tbllesson);

		}

		function lessoncount( $subjectID ){

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tbllesson;
			$queryStr .= " WHERE subjectID = ".$subjectID;
			$queryStr .= " AND download = 0";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			return  $mydb->num_rows( $cur );//get the number of count

		}

		function listlessons( $subjectID = 0, $start = 0, $end = 20 ){

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tbllesson;
			$queryStr .= " WHERE subjectID = ".$subjectID;
			$queryStr .= " AND download = 0";
			$queryStr .= " LIMIT ".$start. ", ".$end;


			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		function downloadcount( $subjectID ){

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tbllesson;
			$queryStr .= " WHERE subjectID = ".$subjectID;
			$queryStr .= " AND download = 1";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			return  $mydb->num_rows( $cur );//get the number of count

		}

		function listdownloads( $subjectID = 0, $start = 0, $end = 20 ){

			global $mydb;

			$queryStr = "SELECT * FROM ".self::$tbllesson;
			$queryStr .= " WHERE subjectID = ".$subjectID;
			$queryStr .= " AND download = 1";
			$queryStr .= " LIMIT ".$start. ", ".$end;


			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadResultList();

			return $cur;
		
		}




		function is_lesson( $lessonID ){

			global $mydb;

			$lessonID = $mydb->escape_value( $lessonID );

			$queryStr = "SELECT * FROM ".self::$tbllesson;
			$queryStr .= " WHERE lessonID = '$lessonID' LIMIT 1";

			$mydb->setQuery( $queryStr );

			$cur = $mydb->executeQuery();

			$num_rows = $mydb->num_rows( $cur );//get the number of count

			if( $num_rows > 0)

				return true;

			return false;

		}

		 
		function get_lesson( $lessonID = 0 ){

				global $mydb;

				$setQuery = "SELECT * FROM ".self::$tbllesson." 
					WHERE lessonID = ".$lessonID;

				$mydb->setQuery( $setQuery );

				$cur = $mydb->loadSingleResult();
				
				return $cur;
		}

		function is_viewed( $lessonID ){

			global $mydb;

			$querystr = "SELECT * FROM lesson_views";
			$querystr .= " WHERE lessonID = ".$lessonID;
			$querystr .= " AND studentID = ".$_SESSION['s_m_s_i'];

			$mydb->setQuery( $querystr );

			$cur = $mydb->executeQuery();

			$num_rows = $mydb->num_rows( $cur );//get the number of count

			if( $num_rows > 0)

				return true;

			return false;
		
		}

		function set_viewed( $lessonID ){

			global $mydb;

			if( !$this->is_viewed( $lessonID ) ){

				$querystr = "INSERT INTO leson_views";
				$querystr .= " (lessonID, studentID)";
				$querystr .= " VALUES (".$lessonID.", ".$_SESSION['s_m_s_i'].")";

				$mydb->setQuery( $querystr );

				$mydb->executeQuery();
			}
		
		}

		function set_viewed_btn( $lessonID, $type ){

			if( $this->is_viewed( $lessonID ) ) 

				return '<a href="index.php?view='.$type.'s&action=view-'.$type.'&'.$type.'='.$lessonID.'" class="col-md-12 btn btn-outline-primary"><dfn>View Lesson</dfn></a>';

			return '<a href="index.php?view='.$type.'s&action=view-'.$type.'&'.$type.'='.$lessonID.'" class="col-md-12 btn btn-primary"><dfn>View Lesson</dfn></a>';

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


	}

	$lssn = new Lesson();

?>