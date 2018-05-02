<?

	
	class security extends pp_app_helper {

		function __construct() {
			
			parent::__construct();
				
		}


		// checked logged in

		function user_logged_in() {

			if (is_user_logged_in()) {
				return TRUE;
			} else {
				get_header();
				$this->load_view('wrapper_start');
				echo "<h1>Oops!  It looks like you are not logged in.</h1>";
				$this->load_view('wrapper_end');
				get_footer();
				die();
			}
		}
		
	}