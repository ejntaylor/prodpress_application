<?

	
	class session extends pp_app_helper {

		function __construct() {
			
			parent::__construct();
				
		}

		function get_variable($variable_name) {
			
			return $_SESSION[$variable_name];
		
		}
		
		function set_variable($variable_name, $value) {
		
			$_SESSION[$variable_name] = $value;
		
		}
	}