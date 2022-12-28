<?php
	
	class ViewsHelper{

		private $composer_data = '';

		function __construct( ) {

			// Get the contents of the JSON file
	    	$this->composer_data = file_get_contents('includes/data/views/main-views.json');
	        

	    }


	    

	    public function get_views(){

	    	return json_decode( $this->composer_data, true );
	    }

	    

	    public function load_view( $view ){

	    	include_once views_root.$view.'/'.$view.'.php';

	    }



	}


?>