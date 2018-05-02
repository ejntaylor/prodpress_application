<?

	
	class email extends pp_app_helper {

		function __construct() {
			parent::__construct();
		}


		/**
		 * Returns the Email Header
		 *
		 * @param $header
		 *
		 * @return string
		 */

		function header($header) {
			
			$header_path = ABSPATH . 'wp-content/mvc_app/views/' . $header . '.php';
			
			
			ob_start();
			include($header_path);
			$html = ob_get_clean();
			
			return $html;
		
		}



		/**
		 * Returns the Email Body
		 *
		 * @param $body
		 * @param null $data
		 *
		 * @return string
		 */
		
		function body($body, $data = NULL) {
			
			if (isset($data)) {
				extract($data);
			}
			
			$body_path = ABSPATH . 'wp-content/mvc_app/views/' . $body . '.php';
			
			ob_start();
			include($body_path);
			$html = ob_get_clean();
						
			return $html;
		
		}



		/**
		 * Returns the Email Footer
		 *
		 * @param $footer
		 *
		 * @return string
		 */

		function footer($footer) {
			
			$footer_path = ABSPATH . 'wp-content/mvc_app/views/' . $footer . '.php';
			
			ob_start();
			include($footer_path);
			$html = ob_get_clean();
						
			return $html;
		
		}


		/**
		 * General Use Emailer Function
		 * Wraps around the WordPress wp_mail function and includes the header/footer so a blank file can be placed within.
		 *
		 * @param $subject
		 * @param $message_file
		 * @param null $data
		 * @param null $to
		 */

		function email_sender($subject, $message_file, $data = null, $to = null) {

			// get email if not provided
			if(!$to) {
				$current_user = wp_get_current_user();
				$to = $current_user->user_email;
			}

			// create message
			$message = $this->header('email/header');
			$message .= $this->body('email/' . $message_file , $data);
			$message .= $this->footer('email/footer');

			// headers
			$headers = "MIME-Version: 1.0";
			$headers .= "Content-Type: text/html; charset=UTF-8";

			//send the message
			wp_mail( $to, $subject, $message, $headers );
		}







	}