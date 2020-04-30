<?php $this->load->view('homepage/head') ?>
<body>
    <!--content starts here -->
<div class="body_wrapper" style="position:absolute;margin-top:80px;">
	<div class="container">
		<div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12"></div>
      <div class="col-lg-4 col-md-4 col-sm-12">
      <h3>Reset password</h3>
      <?php echo form_open('admin/Admin_controller/reset_password', 'class="ui form" id="form-data"  style="margin-left: auto;margin-right: auto;"'); ?>
                
                <div class="form-group">
                  <span style="color:#ff0000;"><?= $this->session->flashdata('admin_reset_pass'); ?></span><br/>
                  <label for="admin_reset_email">Enter your email</label>
                  <input type="email" class="form-control" name="admin_reset_email" id="admin_reset_email" placeholder="Enter your email" value="<?php echo set_value('admin_reset_email', FALSE, TRUE); ?>">
                  <b class="form-text text-danger" style="color: red;"><?= form_error('admin_reset_email') ?></b>  
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="admin_login_btn">Reset</button>
                </div>

                 <div class="form-group">
                  <?php echo anchor('admin/admin_controller/admin_login_view', 'Login'); ?>
                  &nbsp;&nbsp;|&nbsp;&nbsp;
                  <?php echo anchor('Home', 'Home'); ?>
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



