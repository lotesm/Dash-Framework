<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $clss, $mydb;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] == 'admin' ){


		$classID 		= isset( $_POST['classID'] ) ? $_POST['classID'] : 0;
		$teacherID 		= isset( $_POST['teacherID'] ) ? $_POST['teacherID'] : 0;
		
		$clss->name 	= isset( $_POST['name'] ) ? $_POST['name'] : '';


		if ( $clss->update( $classID ) ){

			$clss->set_classteacher( $classID, $teacherID );

			message( 'Class Updated successfully!<br>', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=classes&action=view-class&class='.$classID.'";
	            </script>';

		}else {

			message( 'Error updating class!', 'error' );

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