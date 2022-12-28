<?php

	class Activities {
		
		protected static  $activ = "mural_activities";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$activ);

		}


		function listhealt(){

			global $mydb;

			$queryStr = "SELECT * FROM  ".self::$activ;
			$queryStr .= " ORDER BY `mural_activities`.`created` DESC";


			$mydb->setQuery( $queryStr );
			
			$cur = $mydb->loadResultList();

			return $cur;
		
		}

		 
		function get_activity( $studentID = 0 ){

			global $mydb;

			$queryStr = "SELECT * FROM  ".self::$activ;
			$queryStr .= " WHERE studentID = ".$studentID;

			$mydb->setQuery( $queryStr );

			$cur = $mydb->loadSingleResult();

			if( $cur )

				return $cur->activity;

			return '';
		
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

			$sql = "INSERT INTO ".self::$activ." (";
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

			foreach( $attributes as $key => $value) {

			  $attribute_pairs[] = "{$key}='{$value}'";

			}

			$sql = "UPDATE ".self::$activ." SET ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " WHERE studentID = ". $studentID;

		  	$mydb->setQuery($sql);

		 	if( !$mydb->executeQuery() ) return false; 

		 	return true;	
			
		}

		public function delete( $studentID = 0 ) {

			global $mydb;

			  $sql = "DELETE FROM ".self::$activ;
			  $sql .= " WHERE studentID=". $studentID;
			  $sql .= " LIMIT 1 ";

			  $mydb->setQuery($sql);
			  
			if( !$mydb->executeQuery() ) return false; 	
		
		}


	}

	$activ = New Activities();
?>