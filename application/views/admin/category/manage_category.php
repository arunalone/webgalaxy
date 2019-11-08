<?php
$this->load->view('admin/common/header_menu');
if (!empty($row)) {
    $category_name = $row->dept_name;
    $category_id = $row->dept_id;
    $status = $row->status;
} else {
    $status = $category_id = $category_name = "";
}
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="icon fa fa-sort-alpha-desc"></i>&nbsp;&nbsp;<?php echo $page_title ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url() . 'admin/setting/category' ?>">Role</a></li>
        </ul>
    </div>
    <form class="form-horizontal" method="post" id="manage_category_form" name="manage_category_form" action="<?php echo base_url() ?>admin/Category/update_data">
        <div class="row">
            <div class="col-md-12">
                <div class="tile orderlistheader">
                    <div class="col">
                        <div class="tile-body">
                            <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id ?>"/>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Category Name<label style="color: red">*</label></label>
                                <div class="col-md-8">
                                    <input class="form-control inputfield" type="text" placeholder="Category name" id="category_name" name="category_name" value="<?php echo $category_name ?>">
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
                </div>
                <hr>
                <div class="col">
                    <div class="col-md-8 col-md-offset-3">
                        <?php if ($this->session->userdata('user_role') == "Admin" || $this->session->userdata('dept_id') == $category_id) { ?>
                            <button class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;
                        <?php } ?>
                        <a class="btn btn-secondary" href="<?php echo base_url() . 'admin/Category' ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </div>
            </div>				
        </div>
    </form>
</main>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'popper.min.js' ?>"></script>
<?php $this->load->view('admin/common/script'); ?>
<script src="<?php echo base_url() . VALIDATIONS_FOLDER_PATH . 'manage_category.js'; ?>"></script>
<script>
    $(document).ready(function () {
        App.init();
        ManageLogin.init();
    });
</script>