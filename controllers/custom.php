<?


class custom extends mvc_app_controller {

	// function that run by default when methods in this class are called

	function __construct() {

		parent::__construct();


	}



	//  default method
	function default() {

			// load the view
			get_header();
			$this->load_view('wrappers/wrapper_start');
			$this->load_view('custom');
			$this->load_view('wrappers/wrapper_end');
			get_footer();

		}


}