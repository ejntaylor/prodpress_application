<div class="modal fade in" id="modalResetPass" tabindex="-1" role="dialog" aria-labelledby="resetpassModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header-transparent pt-3 pr-3">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body pt-0">

				<div id="resetPassword">

					<div class="status alert alert-warning <?php if (!$error_message) echo 'd-none'; ?>" role="alert"><?php echo $error_message; ?></div>


					<?php
					// Display form if no errors
					if(!$error_message) : ?>


						<form id="resetPasswordForm" method="post" autocomplete="off">
							<?php
							// this prevent automated script for unwanted spam
							if ( function_exists( 'wp_nonce_field' ) )
								wp_nonce_field( 'rs_user_reset_password_action', 'rs_user_reset_password_nonce' );
							?>

							<input type="hidden" name="type" id="type" value="reset-password" autocomplete="off" />
							<input type="hidden" name="user_key" id="user_key" value="<?php echo esc_attr( $_GET['key'] ); ?>" autocomplete="off" />
							<input type="hidden" name="user_login" id="user_login" value="<?php echo esc_attr( $_GET['username'] ); ?>" autocomplete="off" />
							<?php wp_nonce_field( 'ajax-login-nonce', 'security_reset_login' ); ?>


							<div class="row">
								<div class="col-6 form-group">
									<label for="pass1"><?php _e('New password') ?><br />
										<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" /></label>
								</div>
								<div class="col-6 form-group">
									<label for="pass2"><?php _e('Confirm new password') ?><br />
										<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
								</div>
							</div>

							<p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ &amp; ).'); ?></p>

							<br class="clear" />

							<?php
							/**
							 * Fires following the 'Strength indicator' meter in the user password reset form.
							 *
							 * @since 3.9.0
							 *
							 * @param WP_User $user User object of the user whose password is being reset.
							 */
							do_action( 'resetpass_form', $user );
							?>
							<input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php esc_attr_e('Reset Password'); ?>" />

						</form>

					<?php endif; ?>

				</div>


			</div>
		</div>
	</div>
</div>