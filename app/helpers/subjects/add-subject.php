<?php
	
	session_start();

	// error_reporting(0);

	require_once '../../../includes/config.php';

	global $mail, $subj, $mydb;

	if( isset( $_SESSION['mwh_s_rl'] ) && $_SESSION['mwh_s_rl'] == 'admin' ){


				
		$subj->name 			= isset( $_POST['name'] ) ? $_POST['name'] : '';
		$subj->teacherID 		= isset( $_POST['teacherID'] ) ? $_POST['teacherID'] : '';
		$subj->classID 			= isset( $_POST['classID'] ) ? $_POST['classID'] : '';
		$subj->order_app 		= isset( $_POST['order'] ) ? $_POST['order'] : 0;


		if ( $subj->create() ){

			$id =  $mydb->insert_id();


			message( 'New Subject Added: <a href="index.php?view=subjects&action=view-subject&subject='.$id.'"><strong>'. $_POST['name'] .'</strong></a>!', 'success');

			echo '<script type="text/javascript" language="javascript">
	                location.href = "../../../index.php?view=subjects&action=create-subject";
	            </script>';

		}else {

			message( 'Error creating subject!', 'error' );

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