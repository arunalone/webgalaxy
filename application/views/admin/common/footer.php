<div class="footer">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="span12"> &copy; <?php echo date('Y'); ?> <a href="#"><?php echo DISPLAY_FOOTER_ADMIN_NAME; ?></a>. </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #fade { 
        display: none; /* Hidden as default */
        background: #000;
        position: fixed; left: 0; top: 0;
        width: 100%; height: 100%;
        filter: alpha(opacity=50);
        opacity: .50;
        z-index: 9999;
    }
    .alertBlock{
        color:#FF0000;
        font-size:14px;
        margin-top:10px;
        display: none;
        margin-bottom: 0px;
    }
</style> 
<div id="loader" class="loader_class" style="position: fixed; top: 50%; left: 50%; z-index: 999999; display:none;">
    <img src="<?php echo base_url() ?>assets/img/ajax-loader.gif" alt="#" />
</div>
<div id="fade"></div>
<script type="text/javascript">
    function showloader()
    {
        $('#fade').show();
        $('#loader').fadeIn();
        var popuptopmargin = ($('#loader').height() + 10) / 2;
        var popupleftmargin = ($('#loader').width() + 10) / 2;
        $('#loader').css({
            'margin-top': -popuptopmargin,
            'margin-left': -popupleftmargin
        });
    }
    function hideloader()
    {
        $('#fade').fadeOut();
        $('#loader').fadeOut();
    }
</script>
</body>
</html>