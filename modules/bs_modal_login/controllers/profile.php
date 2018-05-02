<?

	
	class profile extends pp_app_controller {

		// function that run by default when methods in this class are called

		function __construct() {
			parent::__construct();
		}

	

		// forgotten password - ajax

		function ajax_forgotten_password() {
			global $wpdb, $wp_hasher;

			// vars
			$nonce = $_POST['nonce'];
			$user_login = $_POST['username'];

			// load user model
			$this->load_model('users_model');

			// verify nonce
			$this->users_model->verify_nonce($nonce);

			//We shall SQL escape all inputs to avoid sql injection.

			$errors = new WP_Error();

			if ( empty( $user_login ) ) {
				$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
			} else if ( strpos( $user_login, '@' ) ) {
				$user_data = get_user_by( 'email', trim( $user_login ) );
				if ( empty( $user_data ) )
					$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
			} else {
				$login = trim( $user_login );
				$user_data = get_user_by('login', $login);
			}

			/**
			 * Fires before errors are returned from a password reset request.
			 *
			 * @since 2.1.0
			 * @since 4.4.0 Added the `$errors` parameter.
			 *
			 * @param WP_Error $errors A WP_Error object containing any errors generated
			 *                         by using invalid credentials.
			 */
			do_action( 'lostpassword_post', $errors );

			if ( $errors->get_error_code() )
				return $errors;

			if ( !$user_data ) {
				$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
				return $errors;
			}

			// Redefining user_login ensures we return the right case in the email.
			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;
			$key = get_password_reset_key( $user_data );

			if ( is_wp_error( $key ) ) {
				return $key;
			}

			// send email to new speaker
			$this->load_helper('email');

			$data['reset_link'] = site_url() . "/?action=rp&key=" . $key . "&username=" . rawurlencode($user_login);

			$message = $this->email->header('email/header');
			$message .= $this->email->body('email/forgotten_password', $data);
			$message .= $this->email->footer('email/footer');



			if ( is_multisite() )
				$blogname = $GLOBALS['current_site']->site_name;
			else
				/*
				 * The blogname option is escaped with esc_html on the way into the database
				 * in sanitize_option we want to reverse this for the plain text arena of emails.
				 */
				$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

			$title = sprintf( __('[%s] Password Reset'), $blogname );

			/**
			 * Filter the subject of the password reset email.
			 *
			 * @since 2.8.0
			 * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
			 *
			 * @param string  $title      Default email title.
			 * @param string  $user_login The username for the user.
			 * @param WP_User $user_data  WP_User object.
			 */
			$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

			/**
			 * Filter the message body of the password reset mail.
			 *
			 * @since 2.8.0
			 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
			 *
			 * @param string  $message    Default mail message.
			 * @param string  $key        The activation key.
			 * @param string  $user_login The username for the user.
			 * @param WP_User $user_data  WP_User object.
			 */
			$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

			if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
				$errors->add('confirm', __('Check your e-mail for the confirmation link.'), 'message');

			else
				$errors->add('could_not_sent', __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'), 'message');


			// display error message
			if ( $errors->get_error_code() )
				//echo '<p class="error">'. $errors->get_error_message( $errors->get_error_code() ) .'</p>';
				echo json_encode(array('response'=>$errors->get_error_message( $errors->get_error_code())));


			// return proper result
			die();


		}




		/*
		 *	@desc	Process reset password - from the resetpass modal
		 */
		function reset_pass_callback() {

			// verify nonce
			$nonce = $_POST['nonce'];
			$this->load_model('users_model');
			$this->users_model->verify_nonce($nonce);

			// vars
			$errors = new WP_Error();
			$pass1 	= $_POST['pass1'];
			$pass2 	= $_POST['pass2'];
			$key 	= $_POST['user_key'];
			$login 	= $_POST['user_login'];
			$type 	= $_POST['type'];

			// get user from reset key
			$user = check_password_reset_key( $key, $login );

			// check password forerrors
			$errors = $this->users_model->check_pass_errors($errors, $pass1,$pass2);

			// Fires before the password reset procedure is validated.
			do_action( 'validate_password_reset', $errors, $user );

			if ( ( ! $errors->get_error_code() ) && isset( $pass1 ) && !empty( $pass1 ) ) {

				// reset the password
				reset_password($user, $pass1);

				// output message
				if('speaker' == $type) {
					$errors->add( 'password_reset', __( 'You can now login to your account with this password.' ) );
				} else {
					$errors->add( 'password_reset', __( 'Your password has been reset.' ) );
				}
				$success = true;
			} else {
				$success = false;
			}

			// display error message
			if ( $errors->get_error_code() )
				echo json_encode(array('response'=>$errors->get_error_message( $errors->get_error_code()), 'success'=>$success));

			// return proper result
			die();
		}





		function login_callback() {

			// First check the nonce, if it fails the function will break
			//check_ajax_referer( 'ajax-login-nonce', 'security-nonce' );

			// Nonce is checked, get the POST data and sign user on
			$info = array();
			$info['user_login'] = $_POST['username'] ?? '';
			$info['user_password'] = $_POST['password'] ?? '';
			$info['remember'] = true;

			// login user
			$user_signon = $this->wp_signon( $info, false );

			// output error
			echo $user_signon;

			die();
		}









		// ajax - register user

		function register_callback() {

			// sanitize user form input
			global $password, $email, $first_name, $last_name;
			$password   =   esc_attr( $_POST['password'] );
			$email      =   sanitize_email( $_POST['email'] );
			$first_name =   sanitize_text_field( $_POST['fname'] );
			$last_name  =   sanitize_text_field( $_POST['lname'] );
			$role       =   'subscriber';

			$random = mt_rand(100, 999);
			$username = $first_name.$last_name.$random;


			// set user data vars
			$userdata = array(
				'user_login'    =>   $username,
				'user_email'    =>   $email,
				'user_pass'     =>   $password,
				'first_name'    =>   $first_name,
				'last_name'     =>   $last_name,
				'role'          =>   $role
			);

			// create user
			$user = wp_insert_user( $userdata );


			// On success.
			if ( is_wp_error( $user ) ) {
				echo wp_send_json(array('error' => true, 'message' => $user->get_error_message()));
			} else {

				// send pending email
				$this->load_helper('email');

				// email vars
				$data['email_fname'] = $first_name;
				$subject = 'Welcome';
				$message_file = 'register';
				$to = $email;

				// Send Email
				$this->email->email_sender($subject, $message_file, $data, $to);

				// output message
				echo wp_send_json(array('error' => false, 'message'=> __('Register successful, logging you in.', 'mtp')));

			}


		}







		// ajax - modal loggedin update profile

		function update_profile_callback() {

			$arr = array('mtp_job_title','mtp_company','mtp_join_reason');

			// loop through the user_meta items and update
			foreach ($arr as $a) {
				if (isset($_POST[$a])) {
					update_user_meta( get_current_user_id(), $a, sanitize_text_field($_POST[$a]) );
				}
			}

		}



		function account_man_form() {

			// check submit value
			if('delete' == $_POST['submit']) {
				$this->delete_profile();
			} else {
				$this->deactivate_profile();
			}


		}



		// deactivate a user profile

		function deactivate_profile() {

			// check logged in
			$this->load_helper('security');
			$this->security->user_logged_in();

			// vars
			$mc_ids = $_POST['mc_ids'];

			// Load modal
			$this->load_model('profile_model');

			// Check privs
			$this->profile_model->profile_edit_check_privs();

			// 1. Unsubscribe from all email newsletters
			$this->profile_model->profile_edit_mailchimp_unsubscribe($mc_ids);

			// 2. Add user role: deactivated
			$this->profile_model->profile_edit_deactivate_role();

			// display complete page
			$this->load_view('wrapper_start');
			$this->load_view('profile/deactivate_complete');
			$this->load_view('wrapper_end');

		}



		// delete profile

		function delete_profile() {

			// check logged in
			$this->load_helper('security');
			$this->security->user_logged_in();

			// vars
			$mc_ids = $_POST['mc_ids'];

			// Load modal
			$this->load_model('profile_model');

			// Check privs
			$this->profile_model->profile_edit_check_privs();

			// 1. Unsubscribe from all email newsletters
			$this->profile_model->profile_edit_mailchimp_unsubscribe($mc_ids);

			// 2. Add user role: deactivated
			$this->profile_model->profile_edit_delete_role();

			// 3. Email Admin


			// Load Email Helper
			$this->load_helper('email');

			// Load Users Model
			$this->load_model('users_model');

			// Email RSVP Confirm - Vars
			$user = $this->users_model->get_user_by_id();
			$data['ID'] = $user['ID'];
			$data['name'] = $user['name'];
			$data['email'] = $user['email'];

			$subject = 'ADMIN: Delete Account Request';
			$message_file = 'account_delete';
			$to = 'feedback@mindtheproduct.com';

			// Send Email
			$this->email->email_sender($subject, $message_file, $data, $to);

			// Log user out
			$this->users_model->wp_logout();


			// display complete page
			$this->load_view('wrapper_start');
			$this->load_view('profile/delete_complete');
			$this->load_view('wrapper_end');

		}

			/**
		 * Signs a user into the site
		 *
		 * @param $credentials
		 * @param $secure_cookie
		 *
		 * @return mixed
		 */

		function wp_signon( $credentials, $secure_cookie ) {

			// get user object from login
			$user = get_user_by( 'login', $credentials['user_login'] );

			// check not deleted role
			if ( ! empty( $user->roles ) && is_array( $user->roles ) && in_array( 'deleted', $user->roles ) ) {
				$user = new WP_Error( 'deleted', __( "This account has been deleted", "mtp" ) );
			} else {
				// sign user in
				$user = wp_signon( $credentials, false );
			}

			// error checking - return json
			if ( is_wp_error( $user ) ) {

				// amend login error message
				if ( isset( $user->errors['invalid_username'] ) ) {
					$user->errors['invalid_username'][0] = 'Invalid username or password';
				}

//				$error_message = $user->get_error_message();
				$error_message = 'Invalid credentials';

				return json_encode( array(
					'loggedin' => false,
					'message'  => __( $error_message ),
					'arr'      => $credentials
				) );
			} else {
				return json_encode( array(
					'loggedin' => true,
					'message'  => __( 'Login successful, redirecting...' ),
					'redirecturl' => '/'
				) );
			}

		}





}