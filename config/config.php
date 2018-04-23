<?

/**
 * Define App Route
 */
define('PP_SLUG', 'app');


/**
 * Routing
 */

function pp_api_routes() {

	//explode the url
	$slugs = explode('/', $_SERVER['REQUEST_URI']);


	//   /home

	if ($slugs[1] == 'custom') {

		// load the events controller
		pp_app('examples/custom');

		exit();
	}

	//   /home

	if ($slugs[1] == 'prodpress-welcome') {

		// load the events controller
		pp_app('examples');

		exit();
	}



}
add_action( 'init', 'pp_api_routes' );




/**
 * Enqueue JS
 * @return null
 */


function pp_enqueue_scripts() {

	// set debug version
	if (true == WP_DEBUG) {
		$date = new DateTime();
		$enqueue_ver = $date->getTimestamp();
		$script = 'prodpress_scripts';
	} else {
		$enqueue_ver = wp_get_theme()->get( 'Version' );
		$script = 'prodpress_scripts.min';

	}

	wp_enqueue_script('prodpress-js', content_url() . '/pp_app/resources/js/' . $script . '.js', array (), $enqueue_ver , false );
}

add_action( 'wp_enqueue_scripts', 'pp_enqueue_scripts' );
