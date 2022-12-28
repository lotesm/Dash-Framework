<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $sett;

	if( isset( $_SESSION['mwh_s_rl'] ) && isset( $_POST['session'] ) ){

		
		$_SESSION['session'] = $_POST['session'];

		$term = $sett->get_term( $_POST['session'] );

		$_SESSION['session_name'] = $term->name;

		message('Working Session set', 'success');

	}else{

		
		message('Access Error', 'error');

	}

	echo '<script type="text/javascript" language="javascript">
            window.history.back();
        </script>';

	exit();
?>