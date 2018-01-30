<?

// constants

define("APP_ROOT", "/mvc");



// routes

function mvc_api_routes() {

	//explode the url
	$slugs = explode('/', $_SERVER['REQUEST_URI']);


	//   /home

	if ($slugs[1] == 'welcome') {

		// load the events controller
		mvc_app('welcome');

		exit();
	}

	//   /home

	if ($slugs[1] == 'api-test') {

		// load the events controller
		mvc_app('welcome/vue');

		exit();
	}



}
add_action( 'init', 'mvc_api_routes' );