<body class="container">  
<h3>Send order to revision</h3>
      <span style="color:red;"><?= $this->session->flashdata('item_upl_order_files'); ?></span>
   <!-- Form for new task -->  
   <?= form_open('admin/Dashboard_controller/create_new_revision', 'class="form_new_revision"') ?> 
  <div class="row" style="margin-top: 0px;">
  	   <div class="col-sm-5">
			<span id="response"><?php echo validation_errors(); ?></span>      	
       </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
      	 <div class="form-group">
           <label for="exampleInputEmail1">
           	<h3 class="ui header">Select order ID</h3>
           </label>
         		<select class="form-control" name="new_revision_id" id="new_revision_id">
            	  <?php				
            	   foreach ($revision_id as $row) {
            	   ?>
            	     <option><?= $row->order_id; ?></option>
            	   <?php	
            	   }
            	  ?>
                </select>
         </div>
      </div>
       <div class="col-sm-3">
      	 <div class="form-group">
           <label for="exampleInputEmail1">
           		<h3 class="ui header">Due Time</h3>
           </label>
           <input type="text" class="form-control" name="new_revision_time" id="datetimepicker" placeholder="Time due" autocomplete="off">
         </div>
      </div>
    </div>

  <div class="row" style="margin-top: 30px;">
    <div class="col-sm-9">
      <div class="form-group">
            <label for="task_instructions">
            <h3 class="ui header">Revision instructions</h3>
            </label>
            <textarea name="new_revision_instructions" id="new_revision_instructions"  class="tinymce" />
      </div>
    </div>
  </div>

    <div class="row" style="margin-top: 30px;">
      <div class="col-sm-8">
        <div class="form-group">
        <button type="submit" class="btn btn-primary" id="btn_submit_revision">Send to revision</button>
      </div>
      </div>
    </div>  

    <?= form_close() ?>     
<!--jQuery logic to handle new oder creation-->
<script src="<?php echo base_url(); ?>js/jQuery-min-3.3.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   	$('#new_task_due_time').timepicker({
        timeFormat: 'h:mm p',
        startTime: '10:00',
        scrollbar: true
    });
        
    $(".form_new_revision").submit(function(e){        
            event.preventDefault();
            $.ajax({
            url: '<?php echo base_url() ?>index.php/admin/Dashboard_controller/create_new_revision', 
            type: 'POST',
            data: new FormData($('.form_new_revision')[0]), // The form with the file inputs.
            processData: false,
            contentType: false                    // Using FormData, no need to process data.
        }).done(function(html){
            $(".form_new_revision").trigger("reset");
            $('#response').html(html);
        }).fail(function(html){
            $("#response").html("An error occured");
        });      
    });

    // date and time picker
    //DatePicker Example
	$('#datetimepicker').datetimepicker();
});
</script>
<!-- Include external JS libs for jquery and tiny-mce. -->
<script type="text/javascript" src="<?php echo base_url(); ?>tinymce/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>tinymce/plugin/tinymce/init-tinymce.js"></script>  
 <script src="<?php echo base_url() ?>time_picker/jquery.timepicker.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>datetimepicker/jquery.datetimepicker.min.css"/>
 <script src="<?php echo base_url() ?>datetimepicker/jquery.datetimepicker.js"></script>  
</body>
</html>