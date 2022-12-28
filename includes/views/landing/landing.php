<?php
	

	if( isset( $_REQUEST['action'] ) ){

		$sh = new DataHelper( 'landing-views' );

		if ( in_array( $_REQUEST['action'], $sh->get_composer() ) ){

			require_once $_REQUEST['action'].'.php';

		} else {

			// header("Location: 404.html");

			// echo '<script type="text/javascript" language="javascript">
   //                  location.href = "404.html";
   //              </script>';

		}


	} else {
		
		// echo '<script type="text/javascript" language="javascript">
  //                   location.href = "404.html";
  //               </script>';

	}


?>
