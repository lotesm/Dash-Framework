<?php
    
    session_start();


    require_once '../../../includes/config.php';


	global $stud, $mydb, $clss;

    /*
    * if visitor has right to view and id is set
    */
	if ( $_SESSION['mwh_s_rl'] != 'teacher' ){

		message( "Permission error, redirected to default location 0", "error" );

    	terminate_action();
    
    }


    if ( !isset( $_GET['class'] ) || !$clss->is_class( $_GET['class'] ) ){

        message( "Permission error, redirected to default location 1", "error" );

        terminate_action();

    }

    $class      = $clss->get_class( $_GET['class'] );
    
    $s_count    = $stud->studentcount();
    $students   = $stud->liststudents( 0, $s_count );


    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$class->name.'-list.csv');
    
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    fputcsv($output,  array( 'Student Number', 'Student Surname', 'Student Name', 'Marks', 'Remarks' ));

    
    foreach ( $students as $student ){ 

        fputcsv( $output,  array( $student->stdnumber, $student->surname, $student->name, '', '' ) );

    }

?>

