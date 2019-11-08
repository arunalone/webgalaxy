<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Coupon Marjuana :: Login</title>
        <link rel="icon" type="<?php echo base_url() . WEB_IMAGES ?>png" sizes="16x16" href="<?php echo base_url() . WEB_IMAGES ?>apple-icon.png">
        <link rel="icon" type="<?php echo base_url() . WEB_IMAGES ?>ico" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.ico' ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/<?php echo base_url() . WEB_CSS ?>all.css" crossorigin="anonymous">
        <link href="<?php echo base_url() . WEB_CSS ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() . WEB_CSS ?>style.css" rel="stylesheet">
        <link href="<?php echo base_url() . WEB_PLUGINS ?>toastr-master/toastr.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <style>
            .carousel-caption {
                position: absolute;
                right: 0;
                top: 20%;
                left: 0;
                z-index: 10;
                padding-top: 20px;
                padding-bottom: 20px;
                color: #fff;
                text-align: left;
            }
        </style>
    </head>

    <body>
        <header class="header-upper style-two affix">
            <div id="app" class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-faded" style="width:100%;"> <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url() . WEB_IMAGES ?>logo.png"/></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div id="navbarNavDropdown" class="navbar-collapse collapse cust-nav" style="justify-content:flex-end;">
                    </div>
                </nav>
            </div>
        </header>
        <main role="main">
            <section class="about-us-two sp-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="consultation-form-two with-shadow ">
                                <div class="default-form-area">
                                    <h2 style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #ececec;">Reset your password</h2>
                                    <form id="reset_customer_form" name="" class="contact-form style-two reset_customer_form" method="post">
                                        <input type="hidden" value="<?php echo $usr_id; ?>" name="usr_id" />
                                        <div class="row clearfix">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group style-two">
                                                    <input type="password" placeholder="New Password" class="login password-field inputfield" id="usr_password" name="usr_password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group style-two">
                                                    <input type="password" placeholder="Confirm Password" class="login password-field inputfield" id="usr_confirm_password" name="usr_confirm_password"  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contact-section-btn">
                                            <div class="form-group style-two">
                                                <input id="form_botcheck" name="form_botcheck" class="form-control" value="" type="hidden">
                                                <button class="theme-btn btn-style-two" type="submit" data-loading-text="Please wait...">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </section>
        </main>
        <script src="<?php echo base_url() . WEB_JS ?>jquery-1.9.1.min.js"></script> 
        <script src="<?php echo base_url() . WEB_PLUGINS ?>toastr-master/toastr.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url() . WEB_JS ?>jquery-slim.min.js"><\/script>')</script> 
        <script src="<?php echo base_url() . WEB_JS ?>popper.min.js"></script> 
        <script src="<?php echo base_url() . WEB_JS ?>bootstrap.min.js"></script> 
        <script src="<?php echo base_url() . WEB_JS ?>holder.min.js"></script>
        <script src="<?php echo base_url() . PLUGINS_FOLDER_PATH . 'jquery.validate.js'; ?>"></script>
    </body>
</html>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" >
<script src="<?php echo base_url() . VALIDATIONS_FOLDER_PATH . 'login_validations.js'; ?>"></script>
<script>
            $(document).ready(function () {
                var Host = '<?php echo base_url(); ?>';
                toastr.options = {
                    closeButton: true,
                    timeOut: 5000,
                    "positionClass": "toast-top-right",
                };

                jQuery(function ($) {
                    // /////
                    // CLEARABLE INPUT
                    function tog(v) {
                        return v ? 'addClass' : 'removeClass';
                    }
                    $(document).on('input', '.clearable', function () {
                        $(this)[tog(this.value)]('x');
                    }).on('mousemove', '.x', function (e) {
                        $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
                    }).on('touchstart click', '.onX', function (ev) {
                        ev.preventDefault();
                        $(this).removeClass('x onX').val('').change();
                    });
                });

                ManageLogin.init();
            });
</script>