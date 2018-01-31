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

		// set variables
		$data['variable_one'] = 1;
		$data['variable_two'] = 2;
		$data['welcome_message'] = 'Welcome to the MVC vue.js application';
		$data['welcome_description'] = 'You can use a variable direct from the data object too.';


		//load the view
		get_header();
		$this->load_view('wrappers/wrapper_start');
		$this->load_view('vue', $data);
		$this->load_view('wrappers/wrapper_end');
		get_footer();


	}

}