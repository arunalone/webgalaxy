<?php
if ($this->session->userdata('admin_user_id') > 0) {
    $this->load->view('admin/common/header_menu');
} else {
    $this->load->view('admin/common/user_header_menu');
}
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="error-container">
                <h1>404</h1>
                <h2>Who! bad trip man. No more pixesl for you.</h2>
                <div class="error-details">
                    Sorry, an error has occured! Why not try going back to the <a href="i<?php echo base_url(); ?>">home page</a> or perhaps try following!
                </div> <!-- /error-details -->
                <div class="error-actions">
                    <a href="<?php echo base_url(); ?>" class="btn btn-large btn-primary">
                        <i class="icon-chevron-left"></i>
                        &nbsp;
                        Back to Dashboard						
                    </a>
                </div> <!-- /error-actions -->
            </div> <!-- /error-container -->			
        </div> <!-- /span12 -->
    </div> <!-- /row -->
</div> 
<?php
$this->load->view('admin/common/script');
if ($this->session->userdata('admin_user_id') > 0) {
    $this->load->view('admin/common/footer');
} else {
    $this->load->view('admin/common/user_footer');
}
?>
</body>
</html>