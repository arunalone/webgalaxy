var Host = $('#base_url').val();
jQuery.validator.addMethod("alphSpace", function (value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters are allowed");
var ManageLogin = function () {
    var handleLogin = function () {
        $('#manage_category_form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                category_name: {
                    required: true,
                    alphSpace:true,
                    remote: {
                        url: Host + "admin/Category/check_duplicate",
                        type: "POST",
                        data: {category_id: $('#category_id').val(), category_name: function () {
                                return $('#category_name').val();
                            }}
                    }
                }
            }, messages: {
                category_name: {
                    required: "Category name is required",
                    remote: "Category already exists",
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