<?php

    session_start();

    set_time_limit(0);

    require_once '../../../includes/config.php';

    if( isset( $_SESSION['mwh_s_rl'] ) ){

        global $stud, $mydb, $ms;

        $return = '';

        $filename = $_FILES["file"]["tmp_name"];

        if( $_FILES["file"]["size"] > 0 ){

            $file = fopen( $filename, "r" );

            $data = fgetcsv( $file );


            $subjectID  = isset( $_POST['subjectID'] ) ? $_POST['subjectID'] : 0;
            $classID    = isset( $_POST['classID'] ) ? $_POST['classID'] : 0;
            $term       = isset( $_POST['term'] ) ? $_POST['term'] : 0;
            $year       = isset( $_POST['year'] ) ? $_POST['year'] : date(Y);

            while ( ( $getData = fgetcsv( $file, 10000, ",") ) !== FALSE ){

                $stdnumber   = isset( $getData[0] ) ? $getData[0] : 0;

                if( $stud->is_stud_valid( $stdnumber, $classID ) ){

                    $student = $stud->get_stud_w_stdnum( $stdnumber );

                    if(!$ms->marks_exist( $student->studentID, $subjectID, $term, $year)){

                        $ms->studentID  = $student->studentID;
                        $ms->teacherID  = $_SESSION['mwh_s_tkn'];
                        $ms->classID    = $classID;
                        $ms->subjectID  = $subjectID;
                        $ms->term       = $term;
                        $ms->year       = $year;
                        $ms->marks      = isset( $getData[3] ) ? ceil( $getData[3] ) : 0;
                        $ms->remarks    = isset( $getData[4] ) ? $getData[4] : '';

                        if( $ms->create() ){

                            $return .= '<span class="text-success">Student: '.$student->surname.' '.$student->name.' ('.$stdnumber.') Marks recorded -> '.$ms->marks.'</span><br>';

                        }else{

                            $return .= '<span class="text-danger">Student: '.$student->surname.' '.$student->name.' ('.$stdnumber.') '.$ms->marks.' '.$subjectID.' Marks not recorded! Error</span><br>';
                        
                        }

                    }else{

                        $return .= '<span class="text-danger">Student: '.$student->surname.' '.$student->name.' ('.$stdnumber.') Marks Already Exist! try editing.</span><br>';
                    }


                }else{

                    $return .= '<span class="text-danger">Student: '.@$getData[1].' '.@$getData[2].' ('.$stdnumber.') Does not Exist</span><br>';

                }
                
            }

            fclose($file);

            echo $return;
        
        }
     
    }else {

        $error = "Access Error";

        message( $error, 'error');

        echo '<script type="text/javascript" language="javascript">
                window.history.back();
            </script>';    
    }

    exit();
    
 ?>                     
    
