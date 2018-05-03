<div id="app-modal-login">



	<!-- Modal - Register -->
	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header-transparent pt-3 pr-3">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-0">

					<div class="reg-panel-1">

						<h3>Join</h3>

						<form id="ajaxregister" action="" method="post" class="login-form col-10 offset-1">

							<div class="status alert alert-warning d-none" role="alert"></div>

							<div class="row form-group">
								<div class="col-6">
									<input type="text" class="form-control" name="fname" value="" placeholder="First Name">
								</div>

								<div class="col-6">
									<input type="text" class="form-control" name="lname" value="" placeholder="Surname">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-12">
									<input class="form-control" type="email" name="username" value="" placeholder="Email Address">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-12">
									<input class="form-control" type="password" name="password" value="" placeholder="Password">
									<span class="pwd-messages"></span>
								</div>
							</div>

							<div class="row form-group" id="pwd-container">
								<div class="col-6">Password Strength:</div>
								<div class="col-6"><span class="pwstrength_viewport_progress"></span></div>
								<div class="col-12">Use upper and lower case letters, numbers and punctation</div>
							</div>

						<input type="hidden" id="security-login" name="security-login" value="<?= $nonce_login ?>">

							<div class="text-center">
								<button class="btn btn-primary" name="submit" type="submit" value="Register">Join</button>
							</div>

						</form>
					</div>

				</div>

			</div>
		</div>
	</div>

	<!-- Modal - Login -->

	<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header-transparent pt-3 pr-3">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body pt-0">

					<h3 class="modal-title pb-3" id="">Log in</h3>

					<form id="ajaxlogin" class="login-form col-10 offset-1">

						<div class="status alert alert-warning d-none" role="alert"></div>

						<div class="row form-group">
							<div class="col-12">
								<input v-model="username" class="form-control" id="username-login" name="username" type="text" placeholder="Email Address">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-12">
								<input v-model="password" class="form-control" id="password" name="password" type="password" placeholder="Password">
							</div>
						</div>

						<div class="text-center">
							<button v-on:click="login" type="submit" class="btn btn-primary" value="<?php _e('Login', 'bs_modal_login') ?>"><?php _e('Log in', 'bs_modal_login') ?></button>
						</div>

						<input type="hidden" id="security-register" name="security-login" value="<?= $nonce_login ?>">


					</form>


					<div class="text-center p-3">Don't have an account?<a href="javascript:void(0)" class="btn-register" data-toggle="modal" data-target="#modalRegister" data-dismiss="modal"><?php _e('Join! Its free!', 'bs_modal_login'); ?></a></div>
					<a class="lost small" href="javascript:void(0)" class="btn-register" data-toggle="modal" data-target="#modalForgottenPass" data-dismiss="modal"><?php _e('Lost your password?' , 'bs_modal_login'); ?></a>

				</div>
			</div>
		</div>
	</div>

	<!-- Modal - Lost Password -->

	<div class="modal fade" id="modalForgottenPass" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header-transparent pt-3 pr-3">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body pt-0">

					<h3 class="modal-title pb-3" id="">Forgotten Password?</h3>

					<form id="ajaxforgottenpass" action="forgottenpass" method="post" class="password-form col-10 offset-1">

						<div class="status alert alert-warning d-none" role="alert"></div>

						<div class="row form-group">
							<div class="col-12">
								<input class="form-control" name="user_login" type="text" placeholder="Email Address">
							</div>
						</div>

						<div class="text-center">
							<button type="submit" class="btn btn-primary" value="<?php _e('Recover', 'bs_modal_login') ?>"><?php _e('Recover', 'bs_modal_login') ?></button>
						</div>

						<input type="hidden" id="ajax-password-nonce" name="ajax-password-nonce" value="<?= $nonce_password ?>">

					</form>


					<div class="text-center">Don't have an account?<a href="javascript:void(0)" class="btn-register" data-toggle="modal" data-target="#modalRegister" data-dismiss="modal"><?php _e('Join here.', 'bs_modal_login'); ?></a></div>
					<a class="lost small" href="javascript:void(0)" class="btn-register" data-toggle="modal" data-target="#modalLogin" data-dismiss="modal"><?php _e('Login instead?' , 'bs_modal_login'); ?></a>

				</div>
			</div>
		</div>
	</div>

</div>

