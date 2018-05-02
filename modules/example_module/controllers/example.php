<?php


class example extends pp_app_controller {

	function __construct() {
		parent::__construct();
	}


	function example() {

		get_header();
		$this->load_view('view_example');
		get_footer();
	}


}

?>