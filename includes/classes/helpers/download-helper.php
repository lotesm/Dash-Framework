<?php

	// error_reporting(0);
	/**
	 * 
	 */
	class DownloadHelper {
		
		private $extentsions = array('pdf', 'jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', '.mp4', '.avi');

		private $ftp_server 	= 'ftp.jkmolapo.space';
		private $ftp_user 		= 'jkspace@jkspace.xyz';
		private $ftp_pass 		= 'zuGP(%S(OD=0';

		private $ftp_conn;

		private $login;

		function __construct() {

			// $this->ftp_conn = ftp_connect( $this->ftp_server) or die('<div class="alert alert-danger">Error: Could not connect </div>');

			// $this->login 	 = ftp_login( $this->ftp_conn, $this->ftp_user, $this->ftp_pass );
		}


		function remote_file_exist( $file, $type ){

			$r_file = $file . '.' . $type;

			$file_size 	= ceil( ftp_size( $this->ftp_conn, $r_file ) );

			while ( $file_size > 0 ){

				$pass = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxzy", 6)), 0, 6);

				$r_file = $file . '_' . $pass . '.' . $type;

				$file_size = ceil( ftp_size($this->ftp_conn, $file) );

			}

			return $r_file;

		}


		function upload_answer ( $dir = '', $subjectID = 0 ){

			if( $dir != ''){

				$dir = substr($dir, 0, strrpos($dir, '/') );

				$file = $dir.'/submissions/'.$this->gen_file_name();

			}else{

				$file = $this->make_ass_dir( $subjectID ).'/'.$this->gen_file_name();
			}

			

			// This is the entire file that was uploaded to a temp location.
			$l_file = $_FILES["file"]["tmp_name"];

			$file_parts = pathinfo( $_FILES["file"]["name"] );
			$type 	= $file_parts['extension'];


			$r_file = $this->remote_file_exist( $file, $type );

			ftp_pasv( $this->ftp_conn, true );

			// upload a file
			$upload = ftp_put( $this->ftp_conn, $r_file, $l_file, FTP_BINARY );

			// close the connection
			ftp_close( $this->ftp_conn );


			if ( $upload )

				return $r_file;

			return '';

		}


		function download_file( $file ){

			$user = $_SESSION['s_t_s_sn'];

			$tfile = substr( $file, 0, strrpos( $file, "/") + 1);

			$lfile 	= '../../resources/files/'.$user.'/'.$file;
			$ldir 	= '../../resources/files/'.$user.'/'.$tfile;

			if( !is_dir ( $ldir ) )

				mkdir( $ldir, 0755, true);


			if ( file_exists( $lfile) ) {

			    return 0;

			} else {

				$handle = fopen( $lfile, 'w');

				ftp_pasv( $this->ftp_conn, true );

			    // try to download $server_file and save to $local_file
				if( ftp_fget( $this->ftp_conn, $handle, $file, FTP_BINARY, 0 ) ) {

				    // echo "Successfully written to $lfile\n".$lfile;

				}else {

				   return '<div class="alert alert-danger">Error: Could not connect </div>';

				}

				// close the connection
				ftp_close( $this->ftp_conn) ;
			
			}

			return 1;

		}


		function lesson_file_view( $file = "", $type = "" ){

			$view = '';

			/*
			* File can be empty, id that's the case then return empty view
			*/
			if( $file == '' )

				return $view;



			$user = $_SESSION['s_t_s_sn'];

			$file = 'app/resources/files/'.$user.'/'.$file;

			$view = '<div class="alert alert-danger">Error: Unknow file </div>';



			if( $type === 'jpg' || $type === 'png')

				$view = '<img src="'.$file.'" alt="If image does not show after 5 seconds reload page" width="100%">';

			
			if($type === 'mp4' || $type === 'avi')

				$view = '<video width="100%" controls>
							<source src="'.$file.'" type="video/'.$type.'">
							<div class="alert alert-danger">Error: Your browser does not support the video try use <b>Google Chrome</b></div>
						</video>';


			if($type === 'wma' || $type === 'mp3' || $type === 'm4a')

				$view = '<audio controls>
						<source src="'.$file.'" type="audio/'.$type.'">
						<div class="alert alert-danger">Error: Your browser does not support the video try use <b>Google Chrome<b/></div>
						</audio>';



			return $view;
		
		}

		function get_ass_file_view( $file ){

			$user = $_SESSION['s_t_s_sn'];

			$file = 'app/resources/files/'.$user.'/'.$file;


			$view = '<div class="alert alert-danger">Error: Unknow file </div>';

			$type = substr($file, strpos($file, '.') + 1, strlen($file));

			if( $type === 'jpg' || $type === 'png')

				$view = '<img src="'.$file.'" alt="If image does not show after 5 seconds reload page" width="100%">';


			if($type === 'pdf')

				$view = '<center>
							<a href="'.$file.'" target="_blank" class="btn btn-primary"> View File</a>
						</center>';


			return $view;
		
		}

		function get_aswer_file_view( $file ){

			$user = $_SESSION['s_t_s_sn'];

			$file = 'app/resources/files/'.$user.'/'.$file;


			$view = '<div class="alert alert-danger">Error: Unknow file </div>';

			$type = substr($file, strpos($file, '.') + 1, strlen($file));

			if( $type === 'jpg' || $type === 'png' || $type === 'jpeg')

				$view = '<img src="'.$file.'" alt="If image does not show after 5 seconds reload page" width="100%">';


			return $view;
		
		}

		function get_feedback_file_view( $file ){

			$user = $_SESSION['s_t_s_sn'];

			$file = 'app/resources/files/'.$user.'/'.$file;


			$view = '<div class="alert alert-danger">Error: Unknown file </div>';

			$type = substr($file, strpos($file, '.') + 1, strlen($file));

			if( $type === 'jpg' || $type === 'png' || $type === 'jpeg')

				$view = '<img src="'.$file.'" alt="If image does not show after 5 seconds reload page" width="100%">';


			return $view;
		
		}


		function gen_file_name(){

			$name = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxzy", 36)), 0, 36);

			return $name;
		
		}


		function make_ass_dir( $subjectID = 0 ){

			ftp_pasv( $this->ftp_conn, true );

			$assID 	= date('Ymd-His');


			$assDir = 'assignments/'.$subjectID.'/'.date('Y').'/'.$assID.'/submissions';


			/*
			* Array of folder to be created
			*/
			$folders = array('assignments', $subjectID, date('Y'), $assID, 'submissions' );

			/*
			* Temp Variable to contain remote ftp Directory tree
			*/
			$xstDir  = '';

			/*
			* Temp variable to build ftp directory to be created
			*/
			$crtDir  = '';


			/*
			* Loop through array of folders to check if the exists in 
			* remote ftp server
			*/
			for ( $i = 0; $i < count($folders); $i++ ) { 
				
				$crtDir = $folders[$i];


				/*
				* if the folder does not exist in remote ftp create a new
				* folder
				*/
				if( !in_array( $crtDir, ftp_nlist( $this->ftp_conn, $xstDir ) ) ) {

					$xstDir .= '/'.$crtDir;

				    if( ftp_mkdir($this->ftp_conn, $xstDir) ) {

				    	if( $crtDir === 'submissions' ){

				    		$fbDir = substr($xstDir, 0, strrpos($xstDir, '/') ).'/feedbacks';

				    		ftp_mkdir( $this->ftp_conn, $fbDir );
				    	}

					} else {

						echo '<div class="alert alert-danger"><b>Error: Could not create assignment directory</b> try re-uploading</div>';

						exit();

					}
					
				}else{

					$xstDir .= '/'.$crtDir;
				}

			}

			return $assDir;
		
		}


		function get_file_name( $type ){

			$tname = 'unknown';

			if( $type === 'jpg' || $type === 'png')

				$tname = 'images';

			
			if($type === 'mp4' || $type === 'avi')

				$tname = 'videos';


			if($type === 'wma' || $type === 'mp3' || $type === 'm4a')

				$tname = 'audios';


			if($type === 'pdf')

				$view = 'PDFs';


			return $tname;
		
		}

		function dump(){

			ftp_pasv( $this->ftp_conn, true );

			// get contents of the current directory
			$contents = ftp_nlist($this->ftp_conn, "assignments");

			// output $contents
			var_dump($contents);
		
		}

	}

?>