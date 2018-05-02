<?php


class bs_modal_login extends pp_app_controller {

	// function that run by default when methods in this class are called

	function __construct() {

		parent::__construct();

		$this->load_helper( 'session' );
		$this->load_helper( 'security' );
	}


	function example() {

		get_header();
		$this->display_login_modal();
		// $this->display_reset_pass_modal();
		$this->load_view('buttons');
		get_footer();
	}

	function buttons() {
		// display the modal
		$this->load_view('buttons');
	}


	function display_login_modal() {

		// get nonce
		$data['nonce_login'] = wp_create_nonce('ajax-login-nonce');
		$data['nonce_password'] = wp_create_nonce('ajax-password-nonce');

		// display the modal
		$this->load_view('modals/modal_login', $data);

	}

	function display_reset_pass_modal() {

		// load user model
		$this->load_model('users_model');

		// vars
		$key = $data['key'] = $_GET['key'];
		$username = $data['username'] = $_GET['username'];

		// this check on the link key and user login/username
		$data['error_message'] = $this->users_model->verify_reset_pass($key, $username);

		// get user data
		$data['user'] = check_password_reset_key($key, $username);

		// display the modal
		$this->load_view('modals/modal_resetpass', $data);

	}


	function login_callback() {


		// First check the nonce, if it fails the function will break
		//check_ajax_referer( 'ajax-login-nonce', 'security-nonce' );

		// Nonce is checked, get the POST data and sign user on
		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['remember'] = true;

		// login user
		$user_signon = wp_signon( $info, false );

		// return json
		if ( is_wp_error($user_signon) ){
			echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.'), 'arr' => $info));
		} else {
			echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
		}

		die();
	}


}

?>