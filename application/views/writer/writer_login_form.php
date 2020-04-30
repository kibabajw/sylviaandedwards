<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Writer Login</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css" />
<style type="text/css">
/*
 * Specific styles of signin component
 */
/*
 * General styles
 */

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

/*
 * Card component
 */
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
    /*background-color: #4d90fe; */
    background-color: #1a9bcb;
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
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
<body>
<div class="container">
  <div class="row">
 	<div class="col-md-6 bg-light card" style="display: block;margin-left:auto;margin-right:auto;">
        
          <h3>Writer Login</h3> <span id="admin_register_msg"><?= $this->session->flashdata('item'); ?></span>
  				<?php echo form_open('writer/Auth_Writer_Controller/login', 'class="ui form" id="form-data"  style="margin-left: auto;margin-right: auto;"'); ?>
                
                    <div class="form-group">
                      <label for="name">Name or Email</label>
                      <input type="text" class="form-control" name="writer_login_name" id="writer_login_name" placeholder="Your name or email" value="<?php echo set_value('writer_login_name', FALSE, TRUE); ?>">
                      <b class="form-text text-danger" id="nameError"><?= form_error('writer_login_name') ?></b>  
                    </div>
                      <div class="form-group">
                      <label for="phone">Password</label>
                      <input type="password" class="form-control" name="writer_login_password" id="writer_login_password" placeholder="Your Password" value="<?php echo set_value('writer_login_password', FALSE, TRUE); ?>">
                      <b class="form-text text-danger" id="passError"><?= form_error('writer_login_password') ?></b>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="writer_login_btn">login</button>
                    </div>

                     <div class="form-group">
                      <?php echo anchor('writer/Auth_Writer_Controller/load_register_form', 'New Writer'); ?>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                      <?php echo anchor('writer/Auth_Writer_Controller/load_lost_password', 'Lost password ?'); ?>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                      <?php echo anchor('Home', 'Home'); ?>
                    </div>
                
            <?php echo form_close(); ?>
        
  </div>
</div>
</div>


<!-- javascript script -->
<!-- jquery -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jQuery-min-3.3.1.js"></script>
</body>
</html>