<?php
$this->load->view('admin/common/header_menu');
if (!empty($row)) {
    $first_name = $row->first_name;
    $last_name = $row->last_name;
    $mobile_no = $row->mobile_no;
    $email = $row->email_id;
    $role_id = $row->role_id;
    $dept_id = $row->dept_id;
    $status = $row->status;
    $access_level = $row->access_level;
    $modules = $row->modules;
} else {
    $display_name = $status = $role_id = $first_name = $last_name = $mobile_no = $email = $dept_id = $access_level = $modules = "";
}
?>
<link rel="stylesheet" href="<?php echo base_url() . PLUGINS_FOLDER_PATH ?>select2.min.css">
<main class="app-content">
    <div class="app-title" style="margin:-30px 0px 30px;">
        <div>
            <h1><i class="fa fa-user-circle"></i>&nbsp;&nbsp;<?php echo $page_title ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url() . 'admin/user' ?>">Users</a></li>
        </ul>
    </div>
    <form class="form-horizontal" method="post" id="manage_user_form" name="manage_user_form" action="<?php echo base_url() ?>admin/User/update_data">
        <div class="row">
            <div class="col-md-12">
                <div class="tile orderlistheader">
                    <div class="col">
                        <div class="tile-body">
                            <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emp_id ?>"/>
                            <input type="hidden" name="cur_page" id="cur_page" value="<?php echo $cur_page ?>"/>
                            <div class="form-group row">
                                <label class="control-label col-md-4">First Name<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input class="form-control inputfield" type="text" placeholder="First name" id="first_name" name="first_name" value="<?php echo $first_name ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Role<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <select class="form-control inputfield" id="role_id" name="role_id">
                                        <option value="" >--Select--</option>
                                        <?php foreach ($all_roles as $key => $value) { ?>
                                            <option value="<?php echo $value->role_id ?>" <?php if ($value->role_id == $role_id) { ?>selected=""<?php } ?>><?php echo $value->role_name ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Mobile Number<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input data-masked-input="999-999-9999" maxlength="12" class="form-control inputfield" type="text" placeholder="Mobile Number"  id="mobile_no" name="mobile_no" value="<?php echo $mobile_no ?>">
                                </div>
                            </div>
                            <div class="form-group row" <?php if ($emp_id > 0) { ?>style="display: none;"<?php } ?> id="passwordDiv">
                                <label class="control-label col-md-4">Password<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input class="form-control inputfield" type="password" placeholder="Password"  name="password" id="password" >
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Modules<label style="color: red">*</label></label>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="modules[]" type="checkbox" value="EMP" <?php if (strpos($modules, 'EMP') !== false) { ?>
                                                           checked=""
                                                       <?php }
                                                       ?>>EMP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="modules[]" type="checkbox" checked="checked" value="DEPT" <?php if (strpos($modules, 'DEPT') !== false) { ?>
                                                           checked=""
                                                       <?php }
                                                       ?>>DEPT
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="modules[]" type="checkbox"  value="ROLE" <?php if (strpos($modules, 'ROLE') !== false) { ?>
                                                           checked=""
                                                       <?php }
                                                       ?>>Role
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Access<label style="color: red">*</label></label>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="access_level" type="radio" value="ALL" <?php if ($access_level == "ALL") { ?>checked=""<?php } ?>>ALL
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="access_level" type="radio" value="READ" <?php if ($access_level == "READ") { ?>checked=""<?php } ?>>READ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="access_level" type="radio" value="WRITE" <?php if ($access_level == "WRITE") { ?>checked=""<?php } ?>>WRITE
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="access_level" type="radio" value="EXECUTE" <?php if ($access_level == "EXECUTE") { ?>checked=""<?php } ?>>EXECUTE
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Status<label style="color: red">*</label></label>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="status" type="radio"checked="checked" value="ACTIVE">Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check" style="display:inline-block">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="status" type="radio" value="INACTIVE" <?php if ($status == "INACTIVE") { ?>checked=""<?php } ?>>Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="tile-body">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Last Name<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input class="form-control inputfield" type="text" placeholder="Last Name"  id="last_name" name="last_name" value="<?php echo $last_name ?>">
                                </div>
                            </div>
                            <div class="form-group row" id="storeList">
                                <label class="control-label col-md-4">Department</label>
                                <div class="col-md-8">
                                    <select class="form-control inputfield " id="dept_id" name="dept_id" required="">
                                        <option value="" >--Select--</option>
                                        <?php
                                        if ($dept_list) {
                                            foreach ($dept_list as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value->dept_id ?>" <?php if ($value->dept_id === $dept_id) { ?>selected=""<?php } ?>><?php echo $value->dept_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Email<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input class="form-control inputfield" <?php if ($emp_id == 0) { ?> name="email" required="" <?php } else { ?>readonly=""<?php } ?>  type="text" placeholder="Email"  id="email" value="<?php echo $email ?>">
                                </div>
                            </div>
                            <div class="form-group row" <?php if ($emp_id > 0) { ?>style="display: none;margin-top: 27px;"<?php } ?> id="passwordDiv1" >
                                <label class="control-label col-md-4">Confirm Password<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input class="form-control inputfield" type="password" placeholder="Confirm Password"  name="confirm_password" id="confirm_password" >
                                </div>
                            </div>
                            <?php if ($emp_id > 0) { ?>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label onclick="$('#passwordDiv,#passwordDiv1').toggle();" class="control-label red" style="color: blue;text-align: center;text-decoration: underline;cursor: pointer;">Change Password? </label>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="form-group row" style="margin-top: 35px;"> 
                                    <label class="control-label col-md-4"></label>
                                    <div class="col-md-8">

                                    </div>
                                </div>
                            <?php } ?>
                            <br>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="col">
                    <div class="col-md-8 col-md-offset-3">
                        <button class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="javascript:window.history.go(-1)"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </div>
            </div>				
        </div>
    </form>
</main>

<script src="<?php echo base_url() . JS_FOLDER_PATH . 'popper.min.js' ?>"></script>
<?php $this->load->view('admin/common/script'); ?>
<script src="<?php echo base_url() . VALIDATIONS_FOLDER_PATH . 'manage_user.js'; ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'plugins/pace.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . JS_FOLDER_PATH . 'input-Mask-jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . PLUGINS_FOLDER_PATH . 'select2.min.js' ?>"></script>    
<script>
                                            $(document).ready(function () {
                                                App.init();
                                                ManageLogin.init();
                                            });
                                            $('.select2').select2();
</script>