<?php $this->load->view('homepage/head') ?>
<body>
<header>
<nav class="navbar navbar-default navbar-fixed-top" id="topNavbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">Write Bright</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav navbar-right">
        <li><?php echo anchor('Home', 'Home'); ?></li>
        <li><?php echo anchor('Home/about_us', 'About Us'); ?></li>
        <li><?php echo anchor('Home/our_services', 'Our Services'); ?></li>
        <li><a href="">Our team</a></li>
        <li><a href="#about_services_contact">Contact us</a></li>
        <li><a href="">Client</a></li>
        <li><?php echo anchor('writer/Auth_Writer_Controller/load_login_form', 'Writer'); ?></li>
      </ul>
    </div>
  </div>
</nav>
</header>
<!-- body content starts here -->
<div class="body_wrapper" style="position:absolute;margin-top:80px;">
	<div class="container">
		<div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12"></div>
      <div class="col-lg-4 col-md-4 col-sm-12">
      <h3>Confirm reset code</h3>
      <?php echo form_open('writer/Auth_Writer_Controller/confirm_reset_code', 'class="ui form" id="form-data"  style="margin-left: auto;margin-right: auto;"'); ?>
                
                <div class="form-group">
                  <span style="color:#ff0000;"><?= $this->session->flashdata('confirm_code'); ?></span><br/>
                  <input type="text" class="form-control" name="writer_reset_code" id="writer_reset_code" placeholder="Enter reset code" value="<?php echo set_value('writer_reset_code', FALSE, TRUE); ?>">
                  <b class="form-text text-danger" style="color: red;"><?= form_error('writer_reset_code') ?></b>  
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="writer_login_btn">Confirm code</button>
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



