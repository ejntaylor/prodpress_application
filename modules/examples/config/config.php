<?php


function mvc_api_routes_examples_module() {

	//explode the url
	$slugs = explode('/', $_SERVER['REQUEST_URI']);


	//   /home

	if ($slugs[1] == 'custom') {

		// load the events controller
		mvc_app('examples/examples/custom');

		exit();
	}

	//   /home

	if ($slugs[1] == 'mvc-welcome') {

		// load the events controller
		mvc_app('examples/examples/default');

		exit();
	}



}
add_action( 'init', 'mvc_api_routes_examples_module' );

