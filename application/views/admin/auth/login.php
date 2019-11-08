<?php $this->load->view('admin/common/header'); ?>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <!--<h1><img src="<?php echo base_url() . DEFAULT_PLACEHOLDER_IMAGE ?>"  width="200px;"/></h1>-->
    </div>
    <div class="login-box">
        <form class="login-form" method="post" id="login-form">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control inputfield" type="text" id="usr_email" name="usr_email" placeholder="Email" autofocus value="<?php
                if (isset($_COOKIE["user"])) {
                    echo $_COOKIE["user"];
                }
                ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control inputfield" type="password" id="usr_password" name="usr_password" placeholder="Password" value="<?php
                if (isset($_COOKIE["password"])) {
                    echo $_COOKIE["password"];
                }
                ?>">
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input id="remember_me" name="remember_me" type="checkbox"><span class="label-text">Stay Signed in</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2"><a href="#" title="Forgot Password" data-toggle="flip">Forgot Password ?</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
        <form class="forget-form" method="post" id="forget-form">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input name="forgot_email" id="forgot_email" class="form-control inputfield" type="text" placeholder="Email">
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
            </div>
        </form>
    </div>
</section>
<div class="login-extra">
    <center><h5><?php echo "Office Systems"; ?></h5></center>
</div>
<?php $this->load->view('admin/common/script'); ?>

<script src="<?php echo base_url() . JS_FOLDER_PATH ?>popper.min.js"></script>

<script src="<?php echo base_url() . JS_FOLDER_PATH ?>main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?php echo base_url() . JS_FOLDER_PATH ?>plugins/pace.min.js"></script>
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function () {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
<script src="<?php echo base_url() . VALIDATIONS_FOLDER_PATH . 'login_validations.js'; ?>"></script>
<script>
    $(document).ready(function () {
        App.init();
        ManageLogin.init();
    });
</script>
</body>
</html>