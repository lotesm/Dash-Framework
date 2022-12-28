<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $subj, $clss;

	if( isset( $_SESSION['mwh_s_rl'] ) && isset( $_POST['subject'] ) ){

		
		$_SESSION['subject'] = $_POST['subject'];

		$subject = $subj->get_subject( $_POST['subject'] );

		$class = $clss->get_class( $subject->classID );

		$_SESSION['subject_name'] = $subject->name.' ('.$class->name.')';

		message('Working Subject set', 'success');

	}else{

		
		message('Access Error', 'error');

	}

	echo '<script type="text/javascript" language="javascript">
            window.history.back();
        </script>';

	exit();
?>