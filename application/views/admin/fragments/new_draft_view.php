<body class="container">  
	<h2>New draft:</h2>
      <span style="color:red;" id="response"><?= $this->session->flashdata('item_upl_order_files'); ?></span>
   <!-- Form for new task -->  
   <?= form_open('admin/Dashboard_controller/create_new_draft', 'class="form_new_draft"') ?> 

  <div class="row">
      <div class="col-sm-3">
      	 <div class="form-group">
           <label for="exampleInputEmail1">
           	<h3 class="ui header">Draft Id</h3>
           </label>
           <input type="text" class="form-control" name="new_draft_id" id="new_draft_id" placeholder="Order given Code" autocomplete="off">
         </div>
      </div>
      <div class="col-sm-3">
      	 <div class="form-group">
           <label for="exampleInputEmail1">
           	<h3 class="ui header">Slides</h3>
           </label><br/>
           <input type="number" name="new_draft_slides" id="new_draft_slides" value="0" />
         </div>
      </div>
       <div class="col-sm-3">
      	 <div class="form-group">
           <label for="exampleInputEmail1">
           		<h3 class="ui header">Due Time</h3>
           </label>
           <input type="text" class="form-control" name="new_draft_due_time" id="datetimepicker" placeholder="Time due" autocomplete="off">
         </div>
      </div>
    </div>
<div class="row" style="margin-top: 30px;">
  <div class="col-sm-3">
  	 <div class="form-group">
          <label for="new_order_pages">
    	     <h3 class="ui header">Draft pages</h3>
          </label>
          <input type="number" name="new_draft_pages" id="new_draft_pages" />
     </div>
  </div>
  <div class="col-sm-3">
  	 <div class="form-group">
          <label for="new_order_pages">
    	     <h3 class="ui header">Draft price rate</h3>
          </label>
              <select class="form-control" name="new_draft_price_rate" id="new_draft_price_rate">   
                <?php				
            	   foreach ($price_rate as $row) {
            	   ?>
                   <option><?= $row->probation_writer; ?></option>
                   <option><?= $row->lower_writer; ?></option>
                   <option><?= $row->seniour_writer; ?></option>
                   <option><?= $row->expert_writer; ?></option>
            	   <?php	
            	   }
                ?>
              </select>  
     </div>
  </div>
  <div class="col-sm-3">
      	 <div class="form-group">
           <label for="clientsprice">
           	<h3 class="ui header">Client's price</h3>
           </label>
           <input type="number" class="form-control" name="clientsprice" id="clientsprice" placeholder="Price" autocomplete="off">
         </div>
      </div>
</div>

  <div class="row" style="margin-top: 30px;">
    <div class="col-sm-9">
      <div class="form-group">
            <label for="task_instructions">
            <h3 class="ui header">Draft instructions</h3>
            </label>
            <textarea name="new_draft_instructions" id="new_draft_instructions"  class="tinymce" />
      </div>
    </div>
  </div>

    <div class="row" style="margin-top: 30px;">
      <div class="col-sm-8">
        <div class="form-group">
        <button type="submit" class="btn btn-primary" id="btn_submit">Next step</button>
      </div>
      </div>
    </div>  

    <?= form_close() ?>  

    <?= form_open_multipart('admin/Dashboard_controller/upload_task_files', 'class="form_new_draft_files" style="display:none;"') ?>
    <div class="row" style="margin-top: 30px;">
      <div class="col-sm-8">
      <div id="container">
      <div id="body">
        <div class="row" style="margin:0px;padding:20px 0px;font-size:18px;background-color:#e3e3e3;text-align:center;">
          <div class="col-xs-12 col-sm-12 col-md12 col-lg-12">
              <h3>Click on ADD file button to add more files</h3>
          </div>
        </div>      
      <div class="row" style="margin:0px;padding:20px 0px;text-align:center;">
        <div class="col-xs-12 col-sm-12 col-md12 col-lg-12">
            <button id="addfile" class="btn btn-danger">Add file</button>
        </div>
      </div>      
      <div class="row" style="margin:0px;padding:20px 0px;text-align:center;">
      <div class="col-xs-12 col-sm-12 col-md12 col-lg-12">
          <div id="uploadFileContainer"></div>
          <div id="submit" style="display:none;">
              <input type="submit" name="submit" value="Submit files" id="btn_submit_files" class="btn btn-primary"/>
          </div>
      </div>
      </div>
    </div>
    </div>
    </div>  
  </div>  
    <?= form_close() ?> 
    
<!--jQuery logic to handle new oder creation-->
<script src="<?php echo base_url(); ?>js/jQuery-min-3.3.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#btn_next").click(function(){
        $(".form_one").hide();
        $(".form_two").slideUp().show();
    });

	 	$('#new_task_due_time').timepicker({
	        timeFormat: 'h:mm p',
	        startTime: '10:00',
	        scrollbar: true
	    });

      // start logic for multiple files
      $("#addfile").click(function(){
          event.preventDefault();
          addFileInput();
          $("#submit").css("display", "block");
        });
        function addFileInput(){
            var html = '';
            html += '<div class="alert alert-info">';
            html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            html += '<strong>Upload file</strong>';
            html += '<input type="file" name="multipleFiles[]" id="userfile">';
            html += '</div>';

            $("#uploadFileContainer").append(html);
        }
      // end multiple files	    
        $('#userfile').on('change', function(){
                var data = $('#userfile').val();
                var goodFiles = ["zip","docx","pdf","ppt","pptx","xls","xlsx","png","jpg","webp"];
                fileExtension = data.replace(/^.*\./, '');    
                if( $.inArray(fileExtension, goodFiles) != -1){
                    $('#btn_submit').show();
               } else {
                   alert('Please choose a valid file');
                   $('#userfile').val('');
                   $('#btn_submit').hide();
               }            		               	
        });
        
        $(".form_new_draft").submit(function(e){        
                event.preventDefault();
                $.ajax({
                url: '<?php echo base_url() ?>index.php/admin/Dashboard_controller/create_new_draft', 
                type: 'POST',
                data: new FormData($('.form_new_draft')[0]), // The form with the file inputs.
                processData: false,
                contentType: false                    // Using FormData, no need to process data.
           }).done(function(html){
           	 	$(".form_new_draft").trigger("reset");
             	$('#response').html(html);
               $(".form_new_draft").hide();
               $(".form_new_draft_files").show();
           }).fail(function(html){
             $("#response").html("An error occured");
           });      
        });

    $(".form_new_draft_files").submit(function(e){        
          event.preventDefault();
          $.ajax({
          url: '<?php echo base_url() ?>index.php/admin/Dashboard_controller/upload_draft_files', 
          type: 'POST',
          data: new FormData($('.form_new_draft_files')[0]), // The form with the file inputs.
          processData: false,
          contentType: false                    // Using FormData, no need to process data.
      }).done(function(html){
         $(".form_new_draft_files").trigger("reset");
         alert(html);
         load_new_draft();
      }).fail(function(html){
         // $("#response").html("an error occured");
         alert('an error occured');
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