<?php
	

	if( isset( $_REQUEST['action'] ) ){

		$sh = new DataHelper( 'report-views' );

		if ( in_array( $_REQUEST['action'], $sh->get_composer() ) ){

			require_once $_REQUEST['action'].'.php';

		} else {

			message( 'Invalid view request! default view loaded', 'error');

			require_once 'dashboard.php';

		}


	} else {
		
		require_once 'dashboard.php';

	}


?>
