<?php
	
	class MainView{

		function __construct( ) {

	        

	    }


		public static function _render_view ( $view ){

			require 'includes/views/customary/'. $view . '-view.php';

		}


	}


?>