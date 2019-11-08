<?php $this->load->view('admin/common/header'); ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <?php
//        if ($this->session->userdata('user_role') == "Admin") {
            if (strpos($this->session->userdata('modules'), 'EMP') !== false) {
                ?>
                <li><a class="app-menu__item <?php if ($page_code === "users") { ?>active<?php } ?>" href="<?php echo base_url() . 'admin/User/' ?>" data-toggle=""><i class="app-menu__icon fa fa-shopping-bag cust-fa-1x font-size18"></i></i><span class="app-menu__label "> Employee</span></a></li>
            <?php } if (strpos($this->session->userdata('modules'), 'ROLE') !== false) { ?>
                <li><a class="app-menu__item <?php if ($page_code === "role") { ?>active<?php } ?>" href="<?php echo base_url() . 'admin/Role' ?>" data-toggle=""><i class="app-menu__icon fa fa-clone cust-fa-1x "></i><span class="app-menu__label"> Roles</span></a></li>
            <?php } if (strpos($this->session->userdata('modules'), 'DEPT') !== false) { ?>
                <li><a class="app-menu__item <?php if ($page_code === "category") { ?>active<?php } ?>" href="<?php echo base_url() . 'admin/Category' ?>" data-toggle=""><i class="app-menu__icon fa fa-cart-arrow-down cust-fa-1x"></i><span class="app-menu__label"> Departments</span></a></li>
                <?php
            }
//        }
        ?>
    </ul>
</aside> 
<div class="modal fade" id="logOut" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="admin_id" name="admin_id"/>
                <input type="hidden" id='current_page' name="current_page"/>

                <h4 class="modal-title"><span class="">Logout</span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>  Are you sure want to Logout?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-info" href="<?php echo base_url() . 'auth/logout' ?>"><i class="fa fa-fw fa-lg fa-check-circle"></i>Yes</a>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>No</button>
            </div>
        </div>
    </div>
</div>