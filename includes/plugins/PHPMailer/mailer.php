<?php
	
	/*
	* Import PHPMailer classes into the global namespace
	* These must be at the top of your script, not inside a function
	*/
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;



	/*
	* include email support classes
	* all classes are PHPMailer
	*/
	require 'src/Exception.php';
	require 'src/PHPMailer.php';
	require 'src/SMTP.php';


?>