<?php
$this->load->view('admin/common/header_menu');
?>
<main class="app-content">
    <div class="app-title" style="margin:-30px 0px 30px">
        <div>
            <h1><i class="fa fa-users "></i>&nbsp;&nbsp;Users</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url() . 'admin/User' ?>">Users</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile orderlistheader" style="justify-content:center;">
                <div class="col-sm-5 pl-0">
                    <div class="form-group">Search
                        <input class="app-search__input form-control" style="border: 2px solid #ced4da; border-radius: 4px;margin-right: 6px;" type="search" placeholder="Search by Emp Name / Dept Name / Role Name" id="search_val" name="search_val">
                    </div>
                </div>
                <div class="col-sm-3 pl-0">
                    <div class="form-group">Department
                        <select class="form-control" id="dept_id" name="dept_id" onchange="loadDataByPage(1)">
                            <option value="">All</option>
                            <?php
                            if ($dept_list) {
                                foreach ($dept_list as $key => $val) {
                                    ?>
                                    <option value="<?php echo $val->dept_id; ?>" ><?php echo $val->dept_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 pl-0">
                    <div class="form-group">Status
                        <select class="form-control" id="user_status" name="user_status" onchange="loadDataByPage(1)">
                            <option value="">All</option>
                            <option value="ACTIVE" >Active</option>
                            <option value="INACTIVE">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="pl-0" style="margin-top: 15px;">
                    <button class="btn btn-info btn-addon mt-2" onclick="loadDataByPage(1)" ><i style="font-size:23px" class="fa fa-search mr-0" aria-hidden="true"></i></button>
                </div>
            </div>				
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="admin_id" name="admin_id"/>
                    <input type="hidden" id='current_page' name="current_page"/>

                    <h4 class="modal-title"><span class="">Delete User</span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>  Are you sure want to <span class=""></span>delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" onclick="deleteCustomer()"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yes</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>No</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resetPasswordDiv" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="<?php echo base_url() . 'admin/User/update_password' ?>" name="manage_reset_password" id="manage_reset_password">
                    <div class="modal-header">
                        <h4 class="modal-title">Reset Password<span class=""></span></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id" value="0">
                        <div class="col-md-7">
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label >Password<label style="color: red">*</label></label>
                                    <div class="">
                                        <input class="form-control inputfield" type="password" placeholder="Password" id="password" name="password" style="width: 380px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label >Confirm Password<label style="color: red">*</label></label>
                                    <div class="">
                                        <input class="form-control inputfield" type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" style="width: 380px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type='hidden' id='sort' value="<?php echo isset($sort) ? $sort : 'asc'; ?>">
    <input type='hidden' id='colname' value="<?php echo isset($colname) ? $colname : "first_name"; ?>">
    <input type='hidden' id='col' value='0'>

    <div class="bg-light lter b-b wrapper-md">
        <div class="row" style="padding: 20px">
            <div class="col-sm-6">
                <h1 class="m-n font-thin h3"><?php echo $page_title; ?></h1>
            </div>
            <div style="float: right;" class="right">
                <a style="padding: 10px" class="btn-success" href="<?php echo base_url() . 'admin/user/profile/0' ?>"> Add </a>
            </div>
        </div>
    </div>
    <div class="main" id="contentDiv">

    </div>
</main>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'popper.min.js' ?>"></script>
<?php $this->load->view('admin/common/script'); ?>
<script src="<?php echo base_url() . VALIDATIONS_FOLDER_PATH . 'user_pagi.js'; ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'main.js' ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'plugins/pace.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . JS_FOLDER_PATH . 'plugins/select2.min.js' ?>"></script>
<script type="text/javascript">
                        $(document).ready(function () {
                            loadDataByPage(1);
                            App.init();
                            ManageLogin.init();
                        });
                        $('#demoSelect').select2();
                        $('#search_val').on('keypress', function (e) {
                            var code = e.keyCode || e.which;
                            if (code == 13) {
                                loadDataByPage(1);
                            }
                        });
                        function show_cust_popup(id)
                        {
                            $("#admin_id").val(id);
                            $('#myModal').modal('show');
                        }
                        function reset_password(user_id) {
                            $("label.error").hide();
                            $(".error").removeClass("error");
                            $('#manage_term_form').trigger("reset");
                            $('#user_id').val(user_id);
                            $('#resetPasswordDiv').modal('show');
                        }
                        function deleteCustomer() {
                            var admin_id = parseInt(jQuery("#admin_id").val());
                            $('#myModal').modal('hide');
                            $.ajax({
                                type: 'POST',
                                url: Host + "/admin/user/delete_customer",
                                data: "user_id=" + admin_id,
                                success: function (data) {
                                    if (data == "success") {
                                        loadDataByPage(1);
                                        showToastMsg('success', "Record deleted successfully");
                                    } else {
                                        showToastMsg('error', data);
                                    }
                                }
                            });
                        }
</script>
<?php $this->load->view('admin/common/footer'); ?>
</body>
</html>