<?php  

class users_model extends pp_app_model {

		function __construct() {

			parent::__construct();

		}

		/*
		 * Check if user Logged In
		 *
		 * @return boolean
		 */
		function logged_in() {
			if (!is_user_logged_in()) {
				return true;
			}
		}

		/**
		 * Checks the reset password
		 *
		 * @param $key
		 * @param $username
		 *
		 * @return string error message
		 */

		function verify_reset_pass( $key, $username ) {
			$errors = new WP_Error();
			$user   = check_password_reset_key( $key, $username );

			if ( is_wp_error( $user ) ) {
				if ( $user->get_error_code() === 'expired_key' ) {
					$errors->add( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
				} else {
					$errors->add( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
				}
			}

			// display error message
			if ( $errors->get_error_code() ) {
				$error_message = $errors->get_error_message( $errors->get_error_code() );
			} else {
				$error_message = null;
			}

			return $error_message;

		}

		/*
		 * Verifys the nonce
		 *
		 * @return boolean
		 */
		function verify_nonce( $nonce ) {
			if ( ! wp_verify_nonce( $nonce, 'ajax-password-nonce' ) ) {
				return false;
			} else {
				return true;
			}

		}

}

?>