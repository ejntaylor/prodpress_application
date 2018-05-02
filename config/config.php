<?

/**
 * Define App Route
 */
define('PP_SLUG', 'app');


/**
 * Custom Routing
 */

function pp_api_custom_routes() {

	// set custom urls to controller method
	$custom_routes = array(
			'custom' => 'examples/custom',
			'vue'=> 'examples/vue',
			'prodpress-welcome'	=> 'examples',
			'test'		=> 'examples/test'
	);

	// setup custom routes
	pp_api_custom_routes_process($custom_routes);

}

add_action( 'init', 'pp_api_custom_routes', 5 );




/**
 * Enqueue JS
 * @return null
 */


function pp_enqueue_scripts() {

	// set debug version
	if (true == WP_DEBUG) {
		$date = new DateTime();
		$enqueue_ver = $date->getTimestamp();
		$script = 'pp_scripts';
	} else {
		$enqueue_ver = wp_get_theme()->get( 'Version' );
		$script = 'pp_scripts.min';
	}

	wp_enqueue_script('prodpress-js', content_url() . '/pp_app/resources/js/' . $script . '.js', array (), $enqueue_ver , false );
}

add_action( 'wp_enqueue_scripts', 'pp_enqueue_scripts' );
