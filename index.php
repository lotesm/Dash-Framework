<?php


	// Start a session
	session_start();


	/*
	*
	* Define Root paths
	*
	*/
	defined('cont_root') ? null : define ('cont_root', 'app/containers/');

	defined('views_root') ? null : define ('views_root', 'includes/views/');

	defined('views_data') ? null : define ('views_data', 'includes/data/views-data/');

	defined('JS_ROOT') ? null : define ('JS_ROOT', $_SERVER['DOCUMENT_ROOT'].'/custom-pos/js');



	// Initialize the App
  	require_once 'includes/initialize.php';






