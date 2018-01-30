<?

class start extends mvc_app_controller {

	function __construct() {

		parent::__construct();

	}



	function default() {

			// set vars
			$data['domain'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[SERVER_NAME]";

			$this->load_view('wrappers/wrapper_start');
			$this->load_view('start', $data);
			$this->load_view('wrappers/wrapper_end');

		}

}