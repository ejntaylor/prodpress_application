<?

// constants

//define("APP_ROOT", "/mvc/");



// routes
//
//function mvc_api_routes() {
//
//	//explode the url
//	$slugs = explode('/', $_SERVER['REQUEST_URI']);
//
//
//	//   /home
//
//	if ($slugs[1] == 'custom') {
//
//		// load the events controller
//		mvc_app('examples/custom');
//
//		exit();
//	}
//
//	//   /home
//
//	if ($slugs[1] == 'mvc-welcome') {
//
//		// load the events controller
//		mvc_app('examples');
//
//		exit();
//	}
//
//
//
//}
//add_action( 'init', 'mvc_api_routes' );


/**
 * Modules
 */

include( ABSPATH . 'wp-content/mvc_app/modules/examples/config/config.php');


/**
 * Enqueue mvc script
 */

function mvc_enqueue_scripts() {

	// set debug version
	if (true == WP_DEBUG) {
		$date = new DateTime();
		$enqueue_ver = $date->getTimestamp();
		$script = 'mvc_scripts';
	} else {
		$enqueue_ver = wp_get_theme()->get( 'Version' );
		$script = 'mvc_scripts.min';

	}

	// enqueue script
	wp_enqueue_script('mvc-js', content_url() . '/mvc_app/resources/js/' . $script . '.js', array (), $enqueue_ver , false );
}

add_action( 'wp_enqueue_scripts', 'mvc_enqueue_scripts' );
