<?php 


	class ActionHelper{

		private $composer_data = '';

		function __construct( $action ) {

			// Get the contents of the JSON file
	    	$this->composer_data = file_get_contents( views_data. $action .'.json' );
	        

	    }


	    

	    public function get_actions(){

	    	return json_decode( $this->composer_data, true );

	    }



	}


?>