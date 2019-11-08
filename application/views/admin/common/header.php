<?php
$this->load->view('admin/common/header_start');
$this->load->view('admin/common/style');
?>

<div class="modal fade" id="session_timeout_model" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Your session is Timeout, please login again</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location = '<?php echo base_url() ?>admin';" />OK</button>
            </div>
        </div>
    </div>
</div>
<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php if ($this->session->userdata('is_user_logged_in') > 0) { ?>
        <header class="app-header"><a class="app-header__logo" href="<?php echo base_url() . 'admin/user' ?>" style="padding-top: 7px;"><img src="<?php echo base_url() . DEFAULT_PLACEHOLDER_USER_IMAGE ?>" ></a>
            <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" id="sidetoggle" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <!-- Navbar Right Menu-->
            <ul class="app-nav">
                <!-- User Menu-->
                <li class="dropdown"><a class="app-nav__item" href="<?php echo base_url() . 'admin/user/profile/' . $this->session->userdata('emp_id') ?>" data-toggle="dropdown" aria-label="Open Profile Menu" aria-expanded="false"><?php echo $this->session->userdata('full_name') ?><i class="fa fa-user fa-lg" style="margin-left: 6px;"></i><i class="fa fa-down"></i></a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(43px, 50px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <!--<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>-->
                        <li><a class="dropdown-item" href="<?php echo base_url() . 'admin/user/profile/' . $this->session->userdata('user_id') ?>"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#logOut" style="cursor: pointer;"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </header>
    <?php }
    ?>