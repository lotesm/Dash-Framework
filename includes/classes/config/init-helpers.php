<?php

	class InitHelper{

		function __construct( ) {

	        

	    }



	    public static function _load_container_view ( $view ){

	    	include_once 'app/containers/' . $view . '.php';

	    }

	    

	    public static function _load_view ( $view ){

	    	include_once 'app/views/' . $view . '.php';

	    }



	}

	$ih = new InitHelper();


?>