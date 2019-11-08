<?php
$this->load->view('admin/common/header_menu');
?>

<main class="app-content">
    <div class="app-title" style="margin:-30px 0px 30px">
        <div>
            <h1><i class="icon fa fa-briefcase" style="font-size: 20px !important;"></i>&nbsp;&nbsp;<?php echo $page_title ?></h1>
        </div>
        <a class="btn btn-info btn-addon" style="float: right;padding-right: 10px" href="<?php echo base_url() . 'admin/Role/manage_role' ?>"><i class="fa fa-plus" aria-hidden="true" style="font-size:19px"></i> Add</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile orderlistheader" style="justify-content:center;">
                <div class="col-sm-6 pl-0">
                    <div class="form-group">Search
                        <input class="app-search__input form-control" style="border: 2px solid #ced4da; border-radius: 4px;margin-right: 6px;" type="text" placeholder="Search by Role Name" id="search_keyword" name="search_keyword">
                    </div>
                </div>
                <div class="col-sm-5 pl-0">
                    <div class="form-group">Status
                        <select class="form-control" id="module_status" name="module_status" onchange="loadDataByPage(1)">
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
                    <input type="hidden" id="module_id" name="module_id"/>
                    <input type="hidden" id='current_page' name="current_page"/>
                    <h4 class="modal-title"><span class="">Delete Role</span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="deleteModalText">
                    Are you sure want to <span class="">delete this record</span>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" onclick="deleteUser()"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yes</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>No</button>
                </div>
            </div>
        </div>
    </div>

    <input type='hidden' id='sort' value="<?php echo isset($sort) ? $sort : 'asc'; ?>">
    <input type='hidden' id='colname' value="<?php echo isset($colname) ? $colname : "role_id"; ?>">
    <input type='hidden' id='col' value='0'>


    <div class="main" id="contentDiv">
    </div>
</main>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'popper.min.js' ?>"></script>
<?php $this->load->view('admin/common/script'); ?>
<script src="<?php echo base_url() . VALIDATIONS_FOLDER_PATH . 'role_pagi.js'; ?>"></script>
<script>
                        $(document).ready(function () {
                            loadDataByPage(1);
                        });
</script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'main.js' ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'plugins/pace.min.js' ?>"></script>
<?php $this->load->view('admin/common/footer'); ?>
