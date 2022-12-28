<?php
	
	class MainViewHelper{

		function __construct( ) {

	        

	    }


		public static function _render_view ( $view ){

			require views_root . 'customary/' . $view . '-view.php';

		}


	}

	$mvh = new MainViewHelper();

?>