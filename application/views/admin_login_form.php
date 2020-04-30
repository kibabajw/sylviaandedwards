<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_lte/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css" />
<style type="text/css">
.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    cursor:pointer;
    /*background-color: #4d90fe; */
    background-color: #1a9bcb;
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(104, 145, 162);
    color:#ffffff;
}
</style>
</head>
<body class="container">
  <div class="row">
  <div class="col-md-6 bg-light card" style="display: block;margin-left:auto;margin-right:auto;">
  <h2>Admin Login</h2>
  <span id="admin_login_msg"><?= $this->session->flashdata('admin_login'); ?></span>
  <?= form_open('admin/admin_controller/login', 'class="form-signin"', 'id="form-admin-login"'); ?>
          <div class="form-group">
              <label for="adm_login_name">Admin Name or Email</label>
              <input type="text" class="form-control" name="adm_login_name" id="adm_login_name" placeholder="Admin name or email" value="<?php echo set_value('adm_login_name', FALSE, TRUE); ?>" autocomplete="off">
              <b class="form-text text-danger" id="nameError"><?= form_error('adm_login_name') ?></b>  
          </div>
          <div class="form-group">
              <label for="adm_login_password">Admin Password</label>
              <input type="password" class="form-control" name="adm_login_password" placeholder="Admin Password" value="<?php echo set_value('adm_login_password', FALSE, TRUE); ?>">
              <b class="form-text text-danger" id="nameError"><?= form_error('adm_login_password') ?></b>        	
          </div>
          <div class="form-group">
          <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="admin_login_btn">login</button>
          </div>
          <div class="form-group">
             <p>
               <?= anchor('admin/admin_controller/lost_password', 'Lost password'); ?>
               &nbsp;&nbsp;|&nbsp;&nbsp;
                <?php echo anchor('Home', 'Home'); ?> 
              </p>  
          </div>
  <?= form_close(); ?>
  </div>  
  </div>
<!-- jQuery-min 3.3.1 -->
<script type="text/javascript" src="<?php echo base_url(); ?>admin_lte/js/jQuery-min-3.3.1.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>