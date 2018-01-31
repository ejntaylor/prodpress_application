<?

// constants

define("APP_ROOT", "/mvc/");



// routes

function mvc_api_routes() {

	//explode the url
	$slugs = explode('/', $_SERVER['REQUEST_URI']);


	//   /home

	if ($slugs[1] == 'custom') {

		// load the events controller
		mvc_app('custom');

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




// enqueue mvc script

function mvc_enqueue_scripts() {

	// set debug version
	if (true == WP_DEBUG) {
		$date = new DateTime();
		$enqueue_ver = $date->getTimestamp();
	} else {
		$enqueue_ver = wp_get_theme()->get( 'Version' );
	}

	// enqueue script
	wp_enqueue_script('mvc-js', content_url() . '/mvc_app/js/mvc_scripts.js', array (), $enqueue_ver , false );
}

add_action( 'wp_enqueue_scripts', 'mvc_enqueue_scripts' );
