<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>favicon.ico">
  <link rel="icon" type="image/ico" sizes="96x96" href="<?php echo base_url(); ?>favicon.ico">
  <title>New Researcher</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css" />
<!-- bootstrap -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style type="text/css">
  #div-form-resume,#third,#result,#form-div-id-card,#div-form-password{
    display: none;
  }
</style>
</head>
<body>  
  <span id="email_error"></span>
  <span id="admin_register_msg">&nbsp;<?php echo validation_errors(); ?></span>
  <div class="container">
  <div class="row justify-content-center">
      <div class="col-md-6 bg-light p-4 rounded mt-5 card">
        <div class="page-header">
          <h2>New Researcher</h2>
          <p class="small">Be sure to have a softcopy of your resume/CV and ID for application.</p>
        </div>
        <span id="result" style="color:red;margin-bottom:20px;"></span><br>
         
            <?php echo form_open('writer/Auth_Writer_Controller/reg_name_email_phone', 'class="ui form" id="form-data"'); ?>
                <div id="first">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="reg_writer_name" id="name" class="form-control" placeholder="Full name" />
                      <b class="form-text text-danger" id="nameError"></b>  
                    </div>
                      <div class="form-group">
                      <label for="phone">Email-address</label>
                      <input type="email" name="reg_writer_email" id="email" class="form-control" placeholder="Email-address" />
                      <b class="form-text text-danger" id="emailError"></b>
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone-number</label>
                      <input type="tel" name="reg_writer_phone_number" id="phone" class="form-control" placeholder="Phone-number" />
                      <b class="form-text text-danger" id="phoneError"></b>
                    </div>
                    <div class="form-group">
                      <a href="#" class="btn btn-danger" id="next-to-form-resume">Next</a>
                    </div>

                     <div class="form-group">
                      <?php echo anchor('writer/Auth_Writer_Controller/load_login_form', 'Login'); ?>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                      <?php echo anchor('Home', 'Home'); ?>
                    </div>
                </div> 
            <?php echo form_close(); ?>
            <?php echo form_open_multipart('writer/Auth_Writer_Controller/reg_resume', 'class="ui form" id="form-resume"'); ?>    
                <!-- second form -->
                <div id="div-form-resume">
                  <h4 class="text-center bg-light p-1 rounded text-secondary">Resume/CV upload</h4>
                    <div class="form-group">
                      <label for="multipleFiles">Upload your CV/Resume</label>
                      <input type="file" name="multipleFiles[]" id="file_resume"/>
                      <b class="form-text text-danger" id="resumeError"></b>
                    </div>
                    <div class="form-group">
                      <a href="#" class="btn btn-danger" id="next-to-form-id-card">Next</a>
                    </div>
                </div> 
            <?php echo form_close(); ?>
            <?php echo form_open_multipart('writer/Auth_Writer_Controller/reg_id_card', 'class="ui form" id="form-id-card"'); ?>    
                <!-- second form -->
                <div id="form-div-id-card">
                  <h4 class="text-center bg-light p-1 rounded text-secondary">Identification card</h4>
                    <div class="form-group">
                      <label for="multipleFiles">Upload your identity-card</label>
                      <input type="file" name="idcardFile[]" id="file_id_card" accept="image/*"/>
                      <b class="form-text text-danger" id="idcardError"></b>
                    </div>
                    <div class="form-group">
                      <a href="#" class="btn btn-danger" id="next-to-form-password">Next</a>
                    </div>
                </div> 
            <?php echo form_close(); ?>
            <?php echo form_open('writer/Auth_Writer_Controller/register', 'class="ui form" id="form-password"'); ?> 
              <!-- password form -->
              <div id="div-form-password">
                   <h4 class="text-center bg-light p-1 rounded text-secondary">Choose a good password</h4>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="reg_writer_password" id="password" class="form-control" placeholder="Password" autocomplete="off" />
                      <b class="form-text text-danger" id="passError"></b>
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Confirm Password" autocomplete="off" />
                      <b class="form-text text-danger" id="cpassError"></b>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-success">
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
      </div>
  </div>
 
<!-- javascript -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jQuery-min-3.3.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){     
    $("#next-to-form-resume").click(function(e){
          e.preventDefault();
          $("#nameError").html('');
          $("#emailError").html('');
          $("#phoneError").html('');
          if ($("#name").val() == '') {
              $("#nameError").html('*Enter your name');
              return false;
          } else if ($("#email").val() == '') {
              $("#emailError").html('*Enter your email-address');
              return false;
          } else if(!validateEmail($("#email").val())){
              $("#emailError").html('*Email is not valid');
              return false;
          } else if ($("#phone").val() == '') {
              $("#phoneError").html('*Enter your phone-number');
              return false
          } else if (isNaN($("#phone").val())) {
              $("#phoneError").html('*Phone-number must be digits');
              return false
          } else if($("#phone").val().length < 10){
              $("#phoneError").html('*Phone-number is in-complete');
              return false
          }else{
            $.ajax({
                url:'<?php echo base_url() ?>index.php/writer/Auth_Writer_Controller/reg_name_email_phone',
                method: 'post',
                data: new FormData($('#form-data')[0]), // The form with the file inputs.
                processData: false,
                contentType: false 
            }).done(function(html){
            	 $("#result").show();
                 $("#result").html(html);
                 $("form").trigger("reset");
           }).fail(function(html){
        	     $("#result").show();
                 $("#result").html("An error occured, please try again.");
           });
        //    commented out for active writers only
          $("#div-form-resume").show();
          $("#first").hide();
          }
          function validateEmail($email){
              var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
              return emailReg.test($email);
          }
    });
    // form upload resume
    $("#next-to-form-id-card").click(function(e){
          e.preventDefault();          
          if ($("#file_resume").val() == '') {
              $("#resumeError").html('*Select your CV/Resume');
              return false
          }  else{
            $.ajax({
                url:'<?php echo base_url() ?>index.php/writer/Auth_Writer_Controller/reg_resume',
                method: 'post',
                data: new FormData($('#form-resume')[0]), // The form with the file inputs.
                processData: false,
                contentType: false 
            }).done(function(html){
            	 $("#result").show();
                 $("#result").html(html);
                 $("form").trigger("reset");
           }).fail(function(html){
        	     $("#result").show();
                 $("#result").html("An error occured, please try again.");
           });
          $("#form-div-id-card").show();
          $("#div-form-resume").hide();
          }
    });
     // upload id-card form
     $("#next-to-form-password").click(function(e){
          e.preventDefault();          
          if ($("#file_id_card").val() == '') {
              $("#idcardError").html('*Select your id-card file');
              return false
          }  else{
            $.ajax({
                url:'<?php echo base_url() ?>index.php/writer/Auth_Writer_Controller/reg_id_card',
                method: 'post',
                data: new FormData($('#form-id-card')[0]), // The form with the file inputs.
                processData: false,
                contentType: false 
            }).done(function(html){
            	 $("#result").show();
                 $("#result").html(html);
                 $("form").trigger("reset");
           }).fail(function(html){
        	     $("#result").show();
                 $("#result").html("An error occured, please try again.");
           });
          $("#div-form-password").show();
          $("#form-div-id-card").hide();
          }
    });
    //button submit
    $("#submit").click(function(e){
          e.preventDefault();
          $("#passError").html('');
          $("#cpassError").html('');
          if ($("#password").val() == '') {
              $("#passError").html('*Password is required');
              return false;
          } else if ($("#cpass").val() == '') {
              $("#cpassError").html('*Confirm your password');
              return false;
          } else if ($("#password").val() != $("#cpass").val()) {
              $("#cpassError").html('*Passwords do not match');
              return false;
          } else{
            $.ajax({
                url:'<?php echo base_url() ?>index.php/writer/Auth_Writer_Controller/register',
                method: 'post',
                data: new FormData($('#form-password')[0]), // The form with the file inputs.
                processData: false,
                contentType: false 
            }).done(function(html){
            	 $("#result").show();
                 $("#result").html(html);
                 $("form").trigger("reset");
           }).fail(function(html){
        	     $("#result").show();
                 $("#result").html("An error occured, please try again.");
           }); 
          }
    });
});
</script>
</body>
</html>