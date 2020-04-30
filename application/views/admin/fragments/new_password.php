<?php $this->load->view('homepage/head') ?>
<body>
<!-- body content starts here -->
<div class="body_wrapper" style="position:absolute;margin-top:80px;">
	<div class="container">
		<div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12"></div>
      <div class="col-lg-4 col-md-4 col-sm-12">
      <h3>Choose a new password</h3>
      <?php echo form_open('admin/Admin_controller/new_password', 'class="ui form" id="form-data"  style="margin-left: auto;margin-right: auto;"'); ?>
                
                <div class="form-group">
                  <span style="color:#111;">Choose a new password</span><br/>
                  <span style="color:#ff0000;"><?= $this->session->flashdata('adm_new_pass'); ?></span><br/>
                  <input type="password" class="form-control" name="admin_new_pass" id="admin_new_pass" placeholder="Choose a new password" value="<?php echo set_value('admin_new_pass', FALSE, TRUE); ?>" required>
                  <b class="form-text text-danger" style="color: red;"><?= form_error('admin_new_pass') ?></b>  
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">Finish</button>
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



