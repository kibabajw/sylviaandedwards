<div id="dialog-confirm" title="Delete admin" style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:2px 12px 20px 0;"></span>This admin will be deleted</p>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <h4>Create new admin</h4>
        <?php echo form_open('admin/admin_controller/register', 'class="ui form" id="form-data"  style="margin-left: auto;margin-right: auto;"'); ?>
                <span id="admin_register_msg" style="color:red;">&nbsp;<?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="name">New admin name</label>
                  <input type="text" class="form-control" name="reg_admin_name" id="reg_admin_name" placeholder="New admin name" value="<?php echo set_value('reg_admin_name', FALSE, TRUE); ?>">
                  <b class="form-text text-danger" id="nameError"><?= form_error('writer_login_name') ?></b>  
                </div>
                <div class="form-group">
                  <label for="name">New admin email</label>
                  <input type="email" class="form-control" name="reg_admin_email" id="reg_admin_email" placeholder="New admin email" value="<?php echo set_value('reg_admin_email', FALSE, TRUE); ?>">
                  <b class="form-text text-danger" id="emailError"><?= form_error('reg_admin_email') ?></b>  
                </div>
                  <div class="form-group">
                  <label for="phone">New admin Password</label>
                  <input type="password" class="form-control" name="reg_admin_password" id="reg_admin_password" placeholder="New admin Password" value="<?php echo set_value('reg_admin_password', FALSE, TRUE); ?>">
                  <b class="form-text text-danger" id="passError"><?= form_error('reg_admin_password') ?></b>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="new_admin_btn">Create</button>
                </div>
            
        <?php echo form_close(); ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <h4>Activate admin</h4>
        <span id="center" style="color:red;"></span>
        <!-- bootstrap datatables -->
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>PHONE</th>
        <th style="text-align: center;">ONLINE</th>
        <th>STATUS</th>
        <th>DELETE</th>
    </tr>
</thead>
<tbody>
	<?php
		if($mydata == false){
		?>
		<div class="alert alert-info" role="alert">No data to display</div>
		<?php
		} else{
			$no = 1;
			$online = '';		
			$active = '';
			$toggle_writer = '';
			foreach ($mydata as $row) {
			    if ($row->admin_online == '') {
			        $online = "";
			    } elseif ($row->admin_online !== ''){
			        $online = '<i class="fa fa-circle text-success"></i>';
			    } 
			    //check if writer is active
			    if ($row->admin_status == 0) {
			        $active = 'activate_admin';
			        $btn_disabled = "";
			    } else if($row->admin_status == 1){
			        $active = 'deactivate_admin';
			        $btn_disabled = "disabled";
			    }
				?>
					 <tr>
						<td><?= $row->admin_id; ?></td>
                        <td><?= $row->admin_name; ?></td>
						<td><?= $row->admin_email; ?></td>
						<td><?= $row->admin_phone_number; ?></td>
						<td style="text-align: center;"><?= $online; ?></td>
						<td>
							<a href="javascript:activate_admin('<?php echo $row->admin_id; ?>')" id="id_category" class="btn btn-primary <?php echo $btn_disabled; ?>"><?php echo $row->status_name; ?></a> 
						</td>
           				<td>
                            <a href="javascript:delete_admin('<?php echo $row->admin_id; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>   
                        </td>
           			 </tr>  
				<?php	
			}
		}
	?>              
</tbody>
</table>
    </div>
</div>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){     
    $("#new_admin_btn").click(function(e){
        e.preventDefault();
        $("#nameError").html('');
        $("#emailError").html('');
        $("#passError").html('');
          if ($("#reg_admin_name").val() == '') {
              $("#nameError").html('*Enter your name');
              return false;
          } else if ($("#reg_admin_email").val() == '') {
              $("#emailError").html('*Enter your email-address');
              return false;
          } else if(!validateEmail($("#reg_admin_email").val())){
              $("#emailError").html('*Email is not valid');
              return false;
          } else{
            $.ajax({
              url:'<?php echo base_url() ?>index.php/admin/admin_controller/register',
              method: 'post',
              data:$("#form-data").serialize()
            }).done(function(html){
                 $("#admin_register_msg").html(html);
                 $("form").trigger("reset");
           }).fail(function(html){
                 $("#admin_register_msg").html("An error occured, please try again.");
           }); 
          }
          function validateEmail($email){
              var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
              return emailReg.test($email);
          }
    });
});    
//acticate admin
function activate_admin(dataId){
	var dataString = 'dataId='+dataId;      
  	$.ajax({
		type:"POST",
		url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/activate_admin",
		data:dataString,
		cache:false,
		success:function(html){
			$("#center").html(html);
		}
	});
	return false;	
}
//delete admin
function delete_admin(adminId){
	var dataString = 'adminId='+adminId;
	$( "#dialog-confirm").dialog({
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Yes": function() {
	        $(this).dialog("close");
	      	$.ajax({
	    		type:"POST",
	    		url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/delete_admin",
	    		data:dataString,
	    		cache:false,
	    		success:function(html){
	    			$("#center").html(html);
	    		}
	    	});
	    	return false;
	        },
	        Cancel: function() {
	          $(this).dialog("close");
	        }
	      }
	    });
}
</script>          