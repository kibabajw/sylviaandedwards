<div class="row">
	<?php echo form_open('writer/Writer_Dashboard_Controller/update', 'id="form-update-writer-details"'); ?>
	 <div class="col-sm-10">
      	 <div class="form-group">
           	<h4 style="color:red;" id="update_writer_msg"></h4>
          </div>
         <div class="form-group">
           <label for="changeName">
           	<h4 class="ui header">Change name</h4>
           </label>
           <input type="text" class="form-control" name="changeName" id="changeName" placeholder="Change name" value="<?= $records['writer_name'] ?>" autocomplete="off">
         </div>
      </div>
       <div class="col-sm-10">
      	 <div class="form-group">
           <label for="changeEmail">
           	<h4 class="ui header">Change emaill-address</h4>
           </label>
           <input type="text" class="form-control" name="changeEmail" id="changeEmail" placeholder="Change email-address" value="<?= $records['writer_email'] ?>" autocomplete="off">
         </div>
      </div>
       <div class="col-sm-10">
      	 <div class="form-group">
           <label for="changePhone">
           	<h4 class="ui header">Change phone-number</h4>
           </label>
           <input type="text" class="form-control" name="changePhone" id="changePhone" placeholder="Change phone-number" value="<?= $records['writer_phone_number'] ?>" autocomplete="off">
         </div>
      </div>
         <div class="col-sm-10">
      	 <div class="form-group">
           <label for="changePhone">
           	<h4 class="ui header">Address info</h4>
           </label>
           <input type="text" class="form-control" name="changeWriteraddress" id="changeWriteraddress" placeholder="Update address info" value="<?= $records['writer_address'] ?>" autocomplete="off">
         </div>
      </div>
       <div class="col-sm-10">
      	 <div class="form-group">
           <label for="changePhone">
           	<h4 class="ui header">Academic info</h4>
           </label>
           <textarea class="form-control" rows="3" name="changeAcademicinfo" id="changeAcademicinfo"><?= $records['writer_academic_info'] ?></textarea>
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
      		<button type="submit" class="btn btn-danger" id="btn_update_writer_details">Submit</button>
    	</div>
    </div>
  	<?php echo form_close(); ?>
</div>