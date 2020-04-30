<?php $this->load->view('homepage/head') ?>
<body>
<!-- body content starts here -->
<div class="body_wrapper" style="position:absolute;margin-top:80px;">
	<div class="container">
		<div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12"></div>
      <div class="col-lg-4 col-md-4 col-sm-12">
      <h3>Confirm reset code</h3>
      <?php echo form_open('admin/Admin_controller/confirm_reset_code', 'class="ui form" id="form-data"  style="margin-left: auto;margin-right: auto;"'); ?>
                
                <div class="form-group">
                  <span style="color:#ff0000;"><?= $this->session->flashdata('admin_confirm_code'); ?></span><br/>
                  <input type="text" class="form-control" name="admin_reset_code" id="admin_reset_code" placeholder="Enter reset code" value="<?php echo set_value('admin_reset_code', FALSE, TRUE); ?>" required>
                  <b class="form-text text-danger" style="color: red;"><?= form_error('admin_reset_code') ?></b>  
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="admin_login_btn">Confirm code</button>
                </div>
            
        <?php echo form_close(); ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12"></div>
    </div>
	</div>
</div>
<!-- body content ends here -->
<!-- javascript scripts are in the footer view -->
<?php $this->load->view('homepage/footer') ?>



