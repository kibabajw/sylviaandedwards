$(document).ready(function(){     
    $("#next-1").click(function(e){
          e.preventDefault();
          $("#nameError").html('');
          $("#emailError").html('');
          if ($("#name").val() == '') {
              $("#nameError").html('*Enter your name');
              return false;
          } else if ($("#email").val() == '') {
              $("#emailError").html('*Enter your email-address');
              return false;
          } else if(!validateEmail($("#email").val())){
              $("#emailError").html('*Email is not valid');
              return false;
          } else{
          $("#second").show();
          $("#first").hide();
          $("#progressBar").css("width", "60%");
          $("#progressText").html("Step - 2");
          }
              function validateEmail($email){
                  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                  return emailReg.test($email);
              }
    });
    // second form
    $("#next-2").click(function(e){
          e.preventDefault();
          $("#phoneError").html('');
          if ($("#phone").val() == '') {
              $("#phoneError").html('*Enter your phone-number');
              return false
          } else if (isNaN($("#phone").val())) {
              $("#phoneError").html('*Phone-number must be digits');
              return false
          } else if($("#phone").val().length < 10){
              $("#phoneError").html('*Phone-number is in-complete');
              return false
          } else{
          $("#third").show();
          $("#second").hide();
          $("#progressBar").css("width", "100%");
          $("#progressText").html("Final Step");
          }
    });
    // prev button in step 2
    $("#prev-2").click(function(e){
          e.preventDefault();
          $("#second").hide();
          $("#first").show();
          $("#progressBar").css("width", "20%");
          $("#progressText").html("Step - 1");
    });
    // prev button in step 3
    $("#prev-3").click(function(e){
          e.preventDefault();
          $("#second").show();
          $("#third").hide();
          $("#progressBar").css("width", "60%");
          $("#progressText").html("Step - 2");
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
              url:'<?php echo base_url() ?>index.php/writer/writer_controller/register',
              method: 'post',
              data:$("#form-data").serialize()
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