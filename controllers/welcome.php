<?


class welcome extends mvc_app_controller {

	// function that run by default when methods in this class are called

	function __construct() {

		parent::__construct();


	}



	//  default method



	function default() {

			// set vars
			$data['domain'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			// load the view
			get_header();
			$this->load_view('wrappers/wrapper_start');
			$this->load_view('welcome', $data);
			$this->load_view('wrappers/wrapper_end');
			get_footer();

		}


	function test() {

		echo 'Test Function';

	}


	function vue() {

		//load the view
		get_header();
		$this->load_view('wrappers/wrapper_start');
		$this->load_view('vue');
		$this->load_view('wrappers/wrapper_end');
		get_footer();


	}

}