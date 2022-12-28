<?php
	/*
	*	Author: JK Molapo
	*
	* 	www.jkmolapo.space
	*
	*/

	// Load Required Support Scripts
	require_once 'config.php';
	require_once 'classes/config/views-config.php';


	$_SESSION['csp_s_tkn']   	= 1;
 	$_SESSION['csp_s_usn']      = 'lotesm';
 	$_SESSION['csp_s_nms']      = 'Kamoho';
 	$_SESSION['csp_s_sn']      	= 'Molapo';
 	$_SESSION['csp_s_rl'] 		= 'admin';

	// set up Page Header and styles
	MainViewHelper::_render_view ( 'header' );



	// Start Page Body
	echo '<body class="hold-transition skin-blue sidebar-mini" id="body-container">';

	// check if session is set and load view appropriate
	isset( $_SESSION['csp_s_tkn'] ) ? 

		InitHelper::_load_container_view ('main-container') : 


			InitHelper::_load_container_view ('validate');


	// load the scripts
	MainViewHelper::_render_view ('footer');
	
	//And finally close the page
	echo '	</body>
		</html>';

	// Once page is rendered kill the script
	//exit();
?>