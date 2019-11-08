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
    var sort = $("#sort").val();
    var colname = $("#colname").val();
    var col = $("#col").val();
    $('.sorting').attr('id', '');
    $.ajax({
        type: 'POST',
        url: Host + "admin/category/category_list",
        data: "page=" + page + "&sort=" + sort + "&colname=" + colname + "&show_records=" + $('#show_records').val() + "&status=" + $('#module_status').val() + "&search_keyword=" + $('#search_keyword').val(),
        success: function (data) {
            $('#contentDiv').html(data);
            if (sort == 'asc')
            {
                $("table thead tr:eq(0) th:eq(" + col + ")").attr('id', 'arrow-up');
            } else {
                $("table thead tr:eq(0) th:eq(" + col + ")").attr('id', 'arrow-down');
            }
            hideloader();
        }
    });
}


$('#search_keyword').on('keypress', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        loadDataByPage(1);
    }
});

function show_popup(id, current_page, actionType)
{
    $("#module_id").val(id);
    $("#current_page").val(current_page);
    $(".actionType").html(actionType);
    $('#myModal').modal('show');

}
function deleteUser() {
    $('#myModal').modal('hide');
    $.ajax({
        type: 'POST',
        url: Host + "/admin/category/delete_category",
        data: "module_id=" + $("#module_id").val(),
        success: function (data) {
            if (data == "session_timeout") {
                hideloader();
                $("#session_timeout_model").modal("show");
            } else {
                hideloader();
                if (data == "success") {
                    loadDataByPage(1);
                    showToastMsg('success', "Record deleted successfully");
                } else {
                    showToastMsg('error', data);
                }
            }
        }
    });
}
