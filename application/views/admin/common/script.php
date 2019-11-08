<input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'jquery-2.2.4.min.js'; ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'app.js'; ?>"></script>
<script src="<?php echo base_url() . PLUGINS_FOLDER_PATH . 'jquery.validate.js'; ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'jquery-ui.min.js' ?>"></script>
<script src="<?php echo base_url() . JS_FOLDER_PATH . 'toastr.min.js'; ?>"></script>
<script>
    toastr.options = {
        closeButton: true,
        timeOut: 5000,
        "positionClass": "toast-top-right",
    };
    function showToastMsg(typ, msg) {

        toastr.remove();
        if (typ == "warning") {
            toastr.warning(msg);
        } else if (typ == "error") {
            toastr.error(msg);
        } else {
            toastr.success(msg);
        }
    }
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
</script>