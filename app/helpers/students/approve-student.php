<?php
	
	session_start();

	error_reporting(0);

	require_once '../../../includes/config.php';

	global $stud, $val, $lvl, $mydb, $schl, $mail, $studw;

	if( isset( $_SESSION['s_a_s_rl'] ) && $_SESSION['s_a_s_rl'] != 'teacher' ){


		if ( !$stud->studentEmailExists( $_POST['email'] ) ){

			$stdnumber 	= $stud->create_studentnumber();

			$password 	= gen_password();

			$hash 		= $val->hashSSHA( $password );

			$h_password = $hash["encrypted"];
			$salt 		= $hash["salt"];
					
			$stud->stdnumber 			= $stdnumber;
			$stud->stdname 				= $_POST['name'];
			$stud->stdsurname 			= $_POST['surname'];
			$stud->stdmobile 			= $_POST['contact'];
			$stud->parentmobile 		= $_POST['parentcontact'];
			$stud->stdemail 			= $_POST['email'];
			$stud->address 				= $_POST['address'];
			$stud->stdpassword 			= $h_password;
			$stud->salt 				= $salt;


			if ( $stud->create() ){

				$id =  $mydb->insert_id();

				$schl->register_student_school( @$_POST['schoolID'], $id );

				$lvl->register_student_class( $_POST['levelID'], $id);

				$mail->student_reg( $_POST['email'], $stdnumber, $_POST['name'], $password );

				$studw->remove_application( $_POST['studwID'] );

				message( 'New Student Added: <a href="index.php?view=students&action=view-student&studentID='.$id.'"><strong>'. $_POST['name'] .'</strong></a> created successfully!', 'success');

				echo '<script type="text/javascript" language="javascript">
		                location.href = "../../../index.php?view=students";
		            </script>';

			}else {

				message( 'Error creating student!', 'error' );

				echo '<script type="text/javascript" language="javascript">
	                    window.history.back();
	                </script>';
			
			}

		}else{

			message( 'Email <b>'.$_POST['email'].'</b> already exixts', 'error' );

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