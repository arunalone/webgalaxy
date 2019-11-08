var Host = $('#base_url').val();
var ManageLogin = function () {
    $.validator.addMethod("pwcheck", function (value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /[A-Z]/.test(value) // has a Uppercase letter
                && /\d/.test(value) // has a digit
    });
    var handleLogin = function () {
        $('.login-form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                usr_email: {
                    required: true,
                    email: true
                },
                usr_password: {
                    required: true,
//                    pwcheck: true,
//                    minlength: 8
                }
            }, messages: {
                usr_email: {
                    required: "Email field is empty. Please try again.",
                    email: "Enter Email is invalid",
                },
                usr_password: {
                    required: "Password field is empty. Please try again.",
                    minlength: "Password must be at least 8 characters long.",
                    pwcheck: "Password must have at least 8 characters, 1 uppercase letter, 1 number, 1 special character",
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.inputfield').addClass('error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.inputfield').addClass('success');
                label.remove();
            },
            errorPlacement: function (error, element) {
                /* $('.login-box').css('min-height','430px'); */
                error.addClass('help-small no-left-padding').insertAfter(element.closest('.inputfield'));
            },
            submitHandler: function (form) {
                $('#btn_login_spin').show();
                $('#btn_login').hide();
                $.ajax({
                    type: 'POST',
                    url: Host + "Auth/check_login",
                    data: $('#login-form').serialize(),
                    success: function (msg) {
                        if (msg == "admin") {
                            location.href = Host + "admin/user";
                        } else {
                            $('#btn_login_spin').hide();
                            $('#btn_login').show();
                            showToastMsg('error', msg);
                        }
                    }
                });
            }
        });
        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('#btn_login_spin').show();
                    $('#btn_login').hide();
                    $.ajax({
                        type: 'POST',
                        url: Host + "Auth/check_login",
                        data: $('#login-form').serialize(),
                        success: function (msg) {
                            if (msg == "admin") {
                                location.href = Host + "admin/user";
                            } else {
                                $('#btn_login_spin').hide();
                                $('#btn_login').show();
                                showToastMsg('error', msg);
                            }
                        }
                    });
                }
                return false;
            }
        });
    }
    var handleForgot = function () {
        $('.forget-form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                forgot_email: {
                    required: true,
                    email: true
                }
            }, messages: {
                forgot_email: {
                    required: "Email ID field is empty. Please try again",
                    email: "Enter Email ID is invalid",
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.inputfield').addClass('error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.inputfield').addClass('success');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.addClass('help-small no-left-padding').insertAfter(element.closest('.inputfield'));
            },
            submitHandler: function (form) {
                $.ajax({
                    type: 'POST',
                    url: Host + "Auth/forgot_password",
                    data: $('#forget-form').serialize(),
                    success: function (msg) {
                        if (msg == "success") {
                            $('#forgot_email').val();
                            showToastMsg("success", "Reset password  link is sent to your Email ID.");
                            $('#forgot_email').val("");
                        } else if (msg == "inactive") {
                            showToastMsg("error", "Your profile is in-active");
                            return false;
                        } else if (msg == "not_exists") {
                            showToastMsg("error", "Email ID is not registered with us");
                            return false;
                        } else {
                            showToastMsg("error", "Some unknown error, Please try again!! ");
                            return false;
                        }
                    }
                });
            }
        });
        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $.ajax({
                        type: 'POST',
                        url: Host + "Auth/forgot_password",
                        data: $('#forget-form').serialize(),
                        success: function (msg) {
                            if (msg != "success") {
                                showToastMsg("error", "Some unknown error, Please try again!! ");
                                return false;
                            } else if (msg == "inactive") {
                                showToastMsg("error", "Your profile is in-active");
                                return false;
                            } else if (msg == "not_exists") {
                                showToastMsg("error", "Email ID is not registered with us");
                                return false;
                            } else {
                                $('#forgot_email').val();
                                showToastMsg("success", "Reset password  link is sent to your Email ID.");
                            }
                        }
                    });
                }
                return false;
            }
        });
    }
    var handleReset = function () {
        $('.reset_form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                usr_password: {
                    required: true,
                    pwcheck: true,
                    minlength: 8
                },
                usr_confirm_password: {
                    required: true,
                    equalTo: '#usr_password'
                }
            }, messages: {
                usr_password: {
                    required: "Password field is empty. Please try again.",
                    minlength: "Password must be at least 8 characters long.",
                    pwcheck: "Password must have at least 8 characters, 1 uppercase letter, 1 number, 1 special character",
                }, usr_confirm_password: {
                    required: "Password field is empty. Please try again.",
                    equalTo: "Password and confirm password field does not match, Please try again"
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.inputfield').addClass('error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.inputfield').addClass('success');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.addClass('help-small no-left-padding').insertAfter(element.closest('.inputfield'));
            },
            submitHandler: function (form) {
                $.ajax({
                    type: 'POST',
                    url: Host + "Auth/updatepassword",
                    data: $('#reset_form').serialize(),
                    success: function (msg) {
                        if (msg == "success") {
                            alert("Password has been updated successfully");
                            setTimeout(function () {
                                location.href = Host;
                            }, 1000);
                        }
                    }
                });
            }
        });
        $('.reset_form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.reset_form').validate().form()) {
                    $.ajax({
                        type: 'POST',
                        url: Host + "Auth/updatepassword",
                        data: $('#reset_form').serialize(),
                        success: function (msg) {
                            if (msg == "success") {
                                showToastMsg("success", "Password has been updated successfully");
                                setTimeout(function () {
                                    location.href = Host;
                                }, 1000);
                            }
                        }
                    });
                }
                return false;
            }
        });
    }
    var handleCustomerReset = function () {
        $('.reset_customer_form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                usr_password: {
                    required: true,
                    pwcheck: true,
                    minlength: 8
                },
                usr_confirm_password: {
                    required: true,
                    equalTo: '#usr_password'
                }
            }, messages: {
                usr_password: {
                    required: "Password field is empty. Please try again.",
                    minlength: "Password must be at least 8 characters long.",
                    pwcheck: "Password must contain atleast 1 digit and atleast 8 characters",
                }, usr_confirm_password: {
                    required: "Password field is empty. Please try again.",
                    equalTo: "Password and confirm password field does not match, Please try again"
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.inputfield').addClass('error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.inputfield').addClass('success');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.addClass('help-small no-left-padding').insertAfter(element.closest('.inputfield'));
            },
            submitHandler: function (form) {
                $.ajax({
                    type: 'POST',
                    url: Host + "Auth/updateCustomerpassword",
                    data: $('#reset_customer_form').serialize(),
                    success: function (msg) {
                        if (msg == "success") {
                            showToastMsg("success", "Password has been updated successfully");
                            setTimeout(function () {
                                location.href = Host;
                            }, 1000);
                        }
                    }
                });
            }
        });
        $('.reset_customer_form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.reset_customer_form').validate().form()) {
                    $.ajax({
                        type: 'POST',
                        url: Host + "Auth/updateCustomerpassword",
                        data: $('#reset_customer_form').serialize(),
                        success: function (msg) {
                            if (msg == "success") {
                                showToastMsg("success", "Password has been updated successfully");
                                setTimeout(function () {
                                    location.href = Host;
                                }, 1000);
                            }
                        }
                    });
                }
                return false;
            }
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            handleLogin();
            handleForgot();
            handleReset();
            handleCustomerReset();
        }

    };
}();
/* Starts the Function for rememember me functionality Arun*/
/* Ends the Function for rememember me functionality*/