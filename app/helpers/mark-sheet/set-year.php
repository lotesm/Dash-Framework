<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';


	if( isset( $_SESSION['mwh_s_rl'] ) && isset( $_POST['year'] ) ){

		
		$_SESSION['year'] = $_POST['year'];

		message('Working Year set', 'success');

	}else{

		
		message('Access Error', 'error');

	}

	echo '<script type="text/javascript" language="javascript">
            window.history.back();
        </script>';

	exit();
?>