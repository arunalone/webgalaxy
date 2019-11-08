var Host = $('#base_url').val();

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
function loadDataByPage(page) {
    showloader();
    var user_status = $('#user_status option:selected').val();
    var user_type = $('#user_type option:selected').val();
    var dept_id = $('#dept_id option:selected').val();
    var sort = $("#sort").val();
    var colname = $("#colname").val();
    var col = $("#col").val();
    $('.sorting').attr('id', '');
    $.ajax({
        type: 'POST',
        url: Host + "admin/user/user_list",
        data: "page=" + page + "&user_status=" + user_status + "&dept_id=" + dept_id + "&user_type=" + user_type + "&sort=" + sort + "&colname=" + colname + "&search_val=" + $('#search_val').val() + "&show_records=" + $('#show_records').val(),
        success: function (data) {
            if (data == "session_timeout") {
                hideloader();
                $("#session_timeout_model").modal("show");
            } else {
                $('#contentDiv').html(data);
                if (sort == 'asc')
                {
                    $("table thead tr:eq(0) th:eq(" + col + ")").attr('id', 'arrow-up');
                } else {
                    $("table thead tr:eq(0) th:eq(" + col + ")").attr('id', 'arrow-down');
                }
                hideloader();
            }
        }
    });
}
var Host = $('#base_url').val();
var ManageLogin = function () {
    $.validator.addMethod("pwcheck", function (value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[A-Za-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
    });
    var handleCustomer = function () {
        $('#manage_reset_password').validate({
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
            handleCustomer();
        }
    };
}();
