<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $clss, $mydb;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] == 'admin' ){


		$clss->name 		= isset( $_POST['name'] ) ? $_POST['name'] : '';
		$clss->year 		= date('Y');


		if ( $clss->create() ){

			$classID =  $mydb->insert_id();

			message( 'New Class: <a href="index.php?view=classes&action=view-class&class='.$classID.'"><b>'. $_POST['name'].'</b></a> created successfully!<br>', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=classes&action=add-class";
	            </script>';

		}else {

			message( 'Error creating class!', 'error' );

			echo '<script type="text/javascript" language="javascript">
                    window.history.back();
                </script>';
		
		}

	}else{

		message( 'Access Error', 'error' );

		echo '<script type="text/javascript" language="javascript">
                location.href = "../../../index.php";
            </script>';


	}


?>