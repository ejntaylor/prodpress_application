jQuery(function($) {

    console.log('BS Module JS Loaded');

    var init = function() {

        initAjax();

    }


    // start stuff
    $(document).ready(function(){
        init();
    });


    // Ajax


    var initAjax = function() {

        var submittingmessage = 'Submitting...';
        var loadingmessage = 'Loading...';
        var redirecturl = '/';

        // Ajax Function for Logging In

        function login(reg, form) {

            // remove status
            var status = $("#modalLogin .status");
            status.removeClass('d-none').html(loadingmessage);

            // set vars
            var username = $(form+' input[name=username]').val(),
                password = $(form+' input[name=password]').val(),
                security = $(form+' input[name=security-login]').val();

            login_ajax(username, password, security);

        }

        function login_ajax(username, password, security) {

            // debug
            if(password) {
                var password_boolean = true;
            } else {
                var password_boolean = false;
            }

            // debug output
            console.group('login js');
            console.log('username:' + username);
            console.log('password:' + password_boolean);
            console.log('security:' + security);
            console.groupEnd();


            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/bs_modal_login/profile/login_callback',
                data: {
                    'username': username,
                    'password': password,
                    'security-nonce': security
                },

                success: function(data){

                    console.group('successful login');
                    console.dir(data);
                    console.groupEnd();

                    // amend status
                    var status = $("#modalLogin .status");

                    status.html(data.message);

                    // redirect
                    if (data.loggedin == true){
                        document.location.href = data.redirecturl;
                    }
                },

                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.log(jqXHR);
                    console.log(textStatus);
                }

            });

        }




        // Modal - Login
        $('form#ajaxlogin').on('submit', function(e) {
            e.preventDefault();

            // vars
            var form = '#ajaxlogin';
            var reg = false;
            login(reg, form);
        });



        // Validate PW for jQuery Validate
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
        });








        // Modal - Register - Validation
        $("form#ajaxregister").validate({

            // Specify validation rules
            rules: {
                fname: "required",
                lname: "required",
                username: {
                    required: true,
                    email: true
                },
            },


            // Specify validation error messages
            messages: {
                fname: "Please enter your firstname",
                lname: "Please enter your lastname",
                username: "Please enter a valid email address"
            },



            submitHandler: function(form) {

                // vars
                var status = $('#modalRegister .status');


                // submit via ajax
                status.removeClass('d-none').html(submittingmessage);

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/bs_modal_login/profile/register_callback',
                    data: {
                        'email': $('form#ajaxregister input[name=username]').val(),
                        'password': $('form#ajaxregister input[name=password]').val(),
                        'fname': $('form#ajaxregister input[name=fname]').val(),
                        'lname': $('form#ajaxregister input[name=lname]').val()
                    },

                    success: function(data){

                        console.dir(data);

                        // Display Status Message
                        status.removeClass('d-none').html(data.message);

                        // if no errors login
                        if(!data.error) {
                            // Login User
                            var reg = true,
                                form = '#ajaxregister';

                            login(reg, form);

                        }

                    },

                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                });



            }
        });




        // Modal - Register - Password Meter

        var options = {};
        options.ui = {
            bootstrap4: true,
            container: "#pwd-container",
            viewports: {
                progress: ".pwstrength_viewport_progress"
            },
            showVerdictsInsideProgressBar: true
        };

        options.rules = {
            activated: {
                wordTwoCharacterClasses: true,
                wordRepetitions: true
            }
        };

        options.common = {
            debug: false,
            minChar: 5,

            onLoad: function () {
            },
            onKeyUp: function (evt, data) {
                if (data.score > 35) {
                    $("span.pwd-messages").text("");
                    $('#ajaxregister button[name=submit]').prop("disabled",false);
                } else {
                    $("span.pwd-messages").text("Password not strong enough");
                    $('#ajaxregister button[name=submit]').prop("disabled",true);
                }
            },
            onScore: function (options, word, totalScoreCalculated) {
                // If my word meets a specific scenario, I want the min score to
                // be the level 1 score, for example.
                if (word.length === 20 && totalScoreCalculated < options.ui.scores[1]) {
                    // Score doesn't meet the score[1]. So we will return the min
                    // numbers of points to get that score instead.
                    return options.ui.score[1]
                }
                // Fall back to the score that was calculated by the rules engine.
                // Must pass back the score to set the total score variable.
                return totalScoreCalculated;
            }


        };

        $('form#ajaxregister input[name=password]').pwstrength(options);







        // Forgotten Password

        // Load if displayed
        $('#modalResetPass').modal('show');

        // Forgotten Password Form

        $("form#ajaxforgottenpass").validate({

            // Specify validation rules
            rules: {
                username: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                }
            },


            // Specify validation error messages
            messages: {
                username: "Please enter a valid email address"
            },



            submitHandler: function(form) {

                // vars
                var form = $("#ajaxforgottenpass"),
                    status	= $('#modalForgottenPass .status');


                // submit via ajax
                status.removeClass('d-none').html(submittingmessage);

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/bs_modal_login/profile/ajax_forgotten_password',
                    data: {
                        'username': $('form#ajaxforgottenpass input[name=user_login]').val(),
                        'nonce': $('form#ajaxforgottenpass input[name=ajax-password-nonce]').val()
                    },

                    success: function(data){

                        console.log('success: submit pass');
                        console.dir(data);

                        status.removeClass('d-none').html(data.response);



                    },

                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        console.dir(jqXHR);
                        console.dir(textStatus);

                    }
                });



            }
        });






        // Reset Pass


        // for reset password
        $("form#resetPasswordForm").on('submit', function(e){

            e.preventDefault();

            var submit = $("div#resetPassword #submit"),
                preloader = $("div#resetPassword #preloader"),
                status	= $("div#resetPassword .status"),
                security = this.security_reset_login.value,
                user_login = this.user_login.value,
                password1 = this.pass1.value,
                data = {
                    nonce: 		this.rs_user_reset_password_nonce.value,
                    pass1:		password1,
                    pass2:		this.pass2.value,
                    user_key:	this.user_key.value,
                    type:	    this.type.value,
                    user_login:	user_login
                };

            // disable button onsubmit to avoid double submision
            submit.attr("disabled", "disabled").addClass('disabled');


            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/bs_modal_login/profile/reset_pass_callback',
                data: data,

                success: function(data, loginvar, pass1var){

                    console.group('success: reset pass')
                    console.log('login: '+ user_login);
                    console.dir(data);
                    console.groupEnd();

                    // amend form elements
                    submit.removeAttr("disabled").removeClass('disabled');
                    status.removeClass('d-none');
                    status.html(data.response);

                    // on success hide form and login
                    if (true == data.success) {

                        // hide form
                        $('form#resetPasswordForm').hide();

                        // login
                        login_ajax(user_login, password1, security);

                    }

                },

                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.dir(jqXHR);
                    console.dir(textStatus);
                }
            });

            return false;



        });




    } // Close init Ajax




});
