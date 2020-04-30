<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>NEW ADMIN</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/semantic.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>admin_lte/<?php echo base_url(); ?>js/jQuery-min-3.3.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>admin_lte/<?php echo base_url(); ?>js/semantic.min.js"></script>
</head>
<body class="ui container center aligned">

<div class="ui stackable grid center aligned" style="margin-top:90px;">
  
  <div class="five wide column ui card left aligned" style="padding:22px;">
  <h2>New Admin</h2>
  <span id="admin_register_msg">&nbsp;<?php echo validation_errors(); ?></span>
 <?php echo form_open('admin/admin_controller/register', 'class="ui form"'); ?>
  <div class="field">
    <label>Choose a name</label>
        <div class="ui left icon input">
            <input type="text" placeholder="New Admin Name" name="reg_admin_name" value="<?php echo set_value('reg_admin_name', FALSE, TRUE); ?>">
            <i class="user secret icon"></i>
        </div>	
  </div>
  <div class="field">
    <label>Your email-address</label>
        <div class="ui left icon input">
            <input type="email" placeholder="Your email" name="reg_admin_email" value="<?php echo set_value('reg_admin_email', FALSE, TRUE); ?>">
            <i class="at icon"></i>
        </div>	
  </div>
  <div class="field">
    <label>Create a Password</label>
        <div class="ui left icon input">
            <input type="password" placeholder="New Admin Password" name="reg_admin_password" value="<?php echo set_value('reg_admin_password', FALSE, TRUE); ?>">
            <i class="key icon"></i>
        </div>	
  </div>
  <div class="field">
  <button class="ui primary button" type="submit" style="width:100%;">Register</button>
  </div>
  <?php echo form_close(); ?>
  <div class="field" style="margin-top: 10px">
   <p><?php echo anchor('admin/admin_controller/admin_login_view', 'Login'); ?></p>  
  </div>
  </div>
  
</div>

</body>
</html>