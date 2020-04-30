<body class="hold-transition skin-blue">
  <!-- Content Wrapper. Contains page content -->
  <div style="margin-top:20px;">

    <!-- Main content -->
    <section class="">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img src="<?php echo base_url(); ?>profile_pictures/admin/<?= $records['admin_picture'] ?>" class="profile-user-img img-responsive img-circle" alt="User Avatar">

              <h3 class="profile-username text-center"><?= $records['admin_name'] ?></h3>

              <p class="text-muted text-center"><?= $records['privilege_name'] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= $records['admin_email']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?= $records['admin_phone_number']; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Messages</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                  <!-- this is activity tab -->
                  <?= $this->session->flashdata('profile_picture_upload_msg'); ?>
                  <?php echo form_open_multipart('admin/Dashboard_controller/upload_profile_picture', 'class="ui form" id="form-id-card"'); ?>    
                  <!-- second form -->
                  <div id="form-div-id-card">
                      <h4 class="text-center bg-light p-1 rounded text-secondary"></h4>
                      <div class="form-group">
                          <label for="multipleFiles">Upload your profile-picture</label>
                          <input type="file" name="profilePicture[]" id="profilePicture" accept="image/*" required />
                          <b class="form-text text-danger" id="profilepictureError"></b>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-danger" id="btn-picture-upload">Upload</a>
                      </div>
                  </div> 
                  <?php echo form_close(); ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="settings">
              	<div class="row">
              		<?php echo form_open('admin/Dashboard_controller/update_admin', 'id="form-update-admin-details"'); ?>
              		    <div class="col-sm-10">
                      	 <div class="form-group">
                           <h4 style="color:red;" id="update_admin_msg"></h4>
                          </div>
                      </div>
                      <div class="col-sm-10">
                      	 <div class="form-group">
                           <label for="changeName">
                           	<h4 class="ui header">Change name</h4>
                           </label>
                           <input type="text" class="form-control" name="changeName" id="changeName" placeholder="Change name" value="<?= $records['admin_name'] ?>" autocomplete="off">
                         </div>
                      </div>
                       <div class="col-sm-10">
                      	 <div class="form-group">
                           <label for="changeEmail">
                           	<h4 class="ui header">Change emaill-address</h4>
                           </label>
                           <input type="text" class="form-control" name="changeEmail" id="changeEmail" placeholder="Change email-address" value="<?= $records['admin_email'] ?>" autocomplete="off">
                         </div>
                      </div>
                       <div class="col-sm-10">
                      	 <div class="form-group">
                           <label for="changePhone">
                           	<h4 class="ui header">Change phone-number</h4>
                           </label>
                           <input type="text" class="form-control" name="changePhone" id="changePhone" placeholder="Change phone-number" value="<?= $records['admin_phone_number'] ?>" autocomplete="off">
                         </div>
                      </div>
                      <div class="col-sm-10">
                      	 <div class="form-group">
                           <label for="changePassword">
                           	<h4 class="ui header">Change password</h4>
                           </label>
                           <input type="text" class="form-control" name="changePassword" id="changePassword" placeholder="Change password" autocomplete="off" required>
                         </div>
                      </div>
                    <div class="form-group">
                    	<div class="col-sm-6 col-sm-10">
                      		<button type="submit" class="btn btn-danger" id="btn_update_admin_details">Submit</button>
                    	</div>
                  	</div>
                  	<?php echo form_close(); ?>
              	</div>
              	</div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<script>
      //update admin's details
      $("#btn_update_admin_details").click(function(e){
      e.preventDefault();
      $.ajax({
            url:'<?php echo base_url() ?>index.php/admin/Dashboard_controller/update_admin',
            method: 'post',
            data: new FormData($('#form-update-admin-details')[0]), // The form with the file inputs.
            processData: false,
            contentType: false 
        }).done(function(response){
            $("#update_admin_msg").text(response);
        }).fail(function(response){
            $("#update_admin_msg").html("An error occured, please try again.");
        }); 
  });   
</script>  
</body>
