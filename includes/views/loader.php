<?php
	
	/*
	* 	Create Main views object
	*
	*	And get an array of registered main views
	*/
	global $vdh;

	$main_views = $vdh->get_composer();


	/*
	*
	* Get passed values of the view and action to be taken
	*/
	$view 	= isset( $_GET['view'] ) ? 

		$vdh->get_view( $_GET['view'] ) : $vdh->get_default_view();

		// echo 'View is -> '.$view;

	$action = isset( $_GET['action'] ) ? $_GET['action'] : 'login';


		// echo '<br>Action is -> '.$action;

	/*
	*
	* before everything lets validate the found view 
	* we validate by checking in views data if view is present
	*
	*/
	if ( !in_array( $view, $main_views ) )

		$view = $vdh->get_default_view();



	/*
	*  	now the we have a view loaded let's
	* 		
	*
	* 	Get actions class object for pass view
	*	the class is located in loaded views-data.php file
	*/
	$ah = new ActionHelper( $view );


	// load all available actions for that view
	$act_arry = $ah->get_actions();

	// print_r( $act_arry );


	if ( in_array( $action, $act_arry ) ){

		/*
		* 	Everything has worked fine 
		*	action found and loaded for the view
		*/
		require_once $view. '/' .$action.'.php';


	} else {


		/*
		* 	Not what we hoped for
		*	action was not found in registered actions of the view
		*	therefore we will load the default action instead
		*/
		require_once $view. '/' .$act_arry['default'].'.php';

	}



?>
