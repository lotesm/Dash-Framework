<?php

	class Category {

		protected static  $tblcategory = "categories";

		function dbfields () {
			global $mydb;
			return $mydb->getfieldsononetable(self::$tblcategory);

		}
		
		function listofcategories(){

			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblcategory);

			$cur = $mydb->loadResultList();

			return $cur;
		}

		function listofarticletags( $articleID ){
			global $mydb;

			$mydb->setQuery("SELECT * FROM articles_category 
				WHERE articleID = '{$articleID}'");

			$cur = $mydb->executeQuery();

			return $cur;
		}

		function category_name( $categoryID = 0){
			global $mydb;

			$mydb->setQuery("SELECT * FROM ".self::$tblcategory." 
				WHERE categoryID = '{$categoryID}'");

			$cur = $mydb->loadSingleResult();

			return $cur->category;
		}

		function find_category( $name = "" ){

			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblcategory." 
				WHERE category = '{$name}'");
			$cur = $mydb->executeQuery();

			$row_count = $mydb->num_rows($cur);

			return $row_count;
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

	$cat = new Category();
?>