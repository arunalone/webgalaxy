var Host = $('#base_url').val();
var ManageLogin = function () {
    var handleLogin = function () {
        $('#manage_role_form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                role_name: {
                    required: true,
                    remote: {
                        url: Host + "admin/Role/check_duplicate",
                        type: "POST",
                        data: {role_id: $('#role_id').val(), role_name: function () {
                                return $('#role_name').val();
                            }}
                    }
                }
            }, messages: {
                role_name: {
                    required: "Role name is required",
                    remote: "Role already exists",
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
                form.submit();
            }
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            handleLogin();
        }
    };
}();

/* Ends the Function for rememember me functionality*/