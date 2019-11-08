var Host = $('#base_url').val();
var ManageLogin = function () {
    $.validator.addMethod("pwcheck", function (value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /[A-Z]/.test(value) // has a Uppercase letter
                && /\d/.test(value) // has a digit
    });
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please");
    jQuery.validator.addMethod("lettersonly", function (value, element)
    {
        return this.optional(element) || /^[a-z,"'"," "]+$/i.test(value);
    }, "Letters and spaces only please");
    jQuery.validator.addMethod("alphSpace", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");
    jQuery.validator.addMethod("usPhone", function (value, element) {
        return this.optional(element) || /^[0-9\-]+$/i.test(value);
    }, "Only digits and  - allowed");
    jQuery.validator.addMethod("roles", function (value, elem, param) {
        if ($(".roles:checkbox:checked").length > 0) {
            return true;
        } else {
            return false;
        }
    }, "You must select at least one!");
    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value == '' || value.trim().length != 0;
    }, "No space please and don't leave it empty");
    var handleLogin = function () {
        $('#manage_user_form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                first_name: {
                    required: true,
                    lettersonly: true,
                    noSpace: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: Host + "admin/user/check_email",
                        type: "POST",
                        data: {user_id: $('#user_id').val(), email: function () {
                                return $('#email').val();
                            }}
                    }
                },
                role_id: {
                    required: true,
                },
                last_name: {
                    required: true,
                    lettersonly: true,
                    noSpace: true
                },
                mobile_no: {
                    required: true,
                    usPhone: true,
                    minlength: '12',
                    maxlength: '12',
                },
                office_number: {
                    usPhone: true,
                    minlength: '12',
                    maxlength: '12',
                },
                password: {
                    required: true,
                    pwcheck: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                address_one: {
                    required: true,
                },
                state_id: {
                    required: true,
                },
                city_id: {
                    required: true,
                },
                zipcode: {
                    required: true,
                    digits: true,
                    minlength: '5',
                    maxlength: '5'
                },
            }, messages: {
                confirm_password: {
                    required: "Confirm Password is required",
                    equalTo: "Confirm Password should be same as Password"
                },
                password: {
                    required: "Password is required",
                    pwcheck: "Password must have at least 8 characters, 1 uppercase letter, 1 number, 1 special character",
                    minlength: "Password must be at least 8 characters long."
                },
                mobile_no: {
                    required: "Mobile number can not be left blank",
                    usPhone: "Entered Mobile number is invalid",
                    minlength: "Mobile number should be of 10 digits",
                    maxlength: "Mobile number should be of 10 digits"
                },
                office_number: {
                    usPhone: "Entered Phone number is invalid",
                    minlength: "Mobile number should be of 10 digits",
                    maxlength: "Mobile number should be of 10 digits"
                },
                first_name: {
                    required: "First Name is required",
                    lettersonly: "Letters only required",
                    noSpace: "First name can not be space only"
                },
                display_name: {
                    required: "Display Name is required",
                    lettersonly: "Letters only required"
                },
                last_name: {
                    required: "Last Name is required",
                    lettersonly: "Letters only required",
                    noSpace: "Last name can not be space only"
                }, zipcode: {
                    required: "Zip Code can not be left blank",
                    digits: "Entered Zip Code is invalid",
                    minlength: "Zip Code should be of 5 digits",
                    maxlength: "Zip Code should be of 5 digits"
                },
                email: {
                    required: "Email is required",
                    email: "Email is not valid",
                    remote: "Email already exists"
                },
                role_id: {
                    required: "Role is required",
                },
                address_one: {
                    required: "Address1 is required",
                },
                state_id: {
                    required: "State is required",
                },
                city_id: {
                    required: "City is required",
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
    var handleCustomer = function () {
        $('#manage_customer_form').validate({
            errorElement: 'label', //default input error message container
            errorClass: 'error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                password: {
                    required: true,
                    pwcheck: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            }, messages: {
                confirm_password: {
                    required: "Confirm Password is required",
                    equalTo: "Confirm Password should be same as Password"
                },
                password: {
                    required: "Password is required",
                    pwcheck: "Password must be contain at least 1 number and be at least 8 characters long.",
                    minlength: "Password must be at least 8 characters long."
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
            handleCustomer();
        }
    };
}();
function sortTable(elem, columnName) {
    var colName = $("#colname").val();
    var col = $(elem).parent().children().index($(elem));
    var sort = $("#sort").val();
    if (colName != columnName)
    {
        $("#sort").val('asc');
    } else {
        if (sort == 'asc')
            $("#sort").val("desc");
        else
            $("#sort").val('asc');
    }
    $("#colname").val(columnName);
    $("#col").val(col);
    loadDataByPage(1);
}
function loadTabData(page) {
    var sort = $("#sort").val();
    var colname = $("#colname").val();
    var col = $("#col").val();
    $('.sorting').attr('id', '');
    $.ajax({
        type: 'POST',
        url: Host + "admin/user/my_order",
        data: "page=" + page + "&sort=" + sort + "&colname=" + colname + "&show_records=" + $('#show_records').val() + "&status=" + $('#module_status').val() + "&search_keyword=" + $('#search_keyword').val() + "&user_id=" + $('#customer_id').val(),
        success: function (data) {
            $('#store_detail_div').hide();
            $('#contentDiv').html(data);
            $('#contentDiv').show();
            if (sort == 'asc')
            {
                $("table thead tr:eq(0) th:eq(" + col + ")").attr('id', 'arrow-up');
            } else {
                $("table thead tr:eq(0) th:eq(" + col + ")").attr('id', 'arrow-down');
            }
        }
    });
}
$('#search_keyword').on('keypress', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        loadDataByPage(1);
    }
});
function getCityList(state_id) {
    $.ajax({
        type: 'POST',
        url: Host + "Auth/get_state_city_list",
        data: "state_id=" + state_id,
        success: function (data) {
            $('#city_id').html(data);
        }
    });
}
function showStoreList(roleId) {
    if (roleId != 1 && roleId != "") {
        $('#storeList').show();
    } else {
        $('#storeList').hide();
    }
}

