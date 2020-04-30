<?= $this->session->flashdata('profile_picture_upload_msg'); ?>
<?php echo form_open_multipart('writer/Writer_Dashboard_Controller/upload_profile_picture', 'class="ui form" id="form-id-card"'); ?>    
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