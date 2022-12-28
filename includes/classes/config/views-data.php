<?php
	
	class ViewsDataHelper{

		private $composer_data = '';

		function __construct( ) {

			// Get the contents of the JSON file
	    	$this->composer_data = file_get_contents('includes/data/composer.json');
	        

	    }


	    

	    public function get_composer(){

	    	return json_decode( $this->composer_data, true );
	    }

	    /*
		*
		* View will depend whether  we have active
		* session or not and the type of view requested...
		*
		* This is to help get appropriate action
		*/
	    public function get_view( $view ){

	    	/*
			*
			* User may request URL containing view validation on active session
			*
			* This will prevent validation view being initialized 
			*/
	    	if( isset( $_SESSION['csp_s_tkn'] ) && $view == 'validation' )

	    		$view = 'dashboard';




	    	/*
			*
			* User may request URL containing session protected view with
			* no active session
			*
			* This will prevent session protected view being initialized 
			*/
	    	if( !isset( $_SESSION['csp_s_tkn'] ) && $view != 'validation' )

	    		$view = 'validation';



	    	/*
			*
			* lastly return view
			*
			* correct view might be initialized on correct session status
			* That will not change the state of view and will return as is.
			*/
	    	return $view;

	    }



	    /*
		*
		* Default view will depend whether  we have active
		* session or not...
		*
		*/
	    public function get_default_view(){

	    	if( isset( $_SESSION['csp_s_tkn'] ) )

	    		return 'dashboard';

	    	return 'validation';

	    }



	}

	$vdh = new ViewsDataHelper();


?>