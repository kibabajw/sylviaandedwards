<h1>Memo:</h1>
<?= form_open('', 'id="get-data-form"') ?> 
<div id="response" style="width:30%;"></div>
<div class="row" style="margin-top: 30px;">
  <div class="col-sm-9">
  	 <div class="form-group">
    	<select class="form-control" name="new_memo_audience" id="new_memo_audience">
    		<option>select recipients</option>
    		<option>Writers</option>
    		<option>Directors</option>
    		<option>Human resource</option>
    	</select>
     </div>
  </div>
</div> 
<div class="row" style="margin-top: 30px;">
  <div class="col-sm-9">
  	 <div class="form-group">
          <textarea name="txt_memo" id="txt_memo" class="tinymce"></textarea>
     </div>
  </div>
</div>
<div class="row" style="margin-top: 30px;">
  <div class="col-sm-8">
  	 <div class="form-group">
    <button type="submit" class="btn btn-primary">Post Memo</button>
  </div>
  </div>
</div> 
<?= form_close() ?>
<div class="memos">
  <h3>Memo</h3>
  <div id="admin_memo_body"></div>
</div>
 <!-- Include external JS libs for jquery and tiny-mce. -->
<script src="<?php echo base_url(); ?>js/jQuery-min-3.3.1.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

 	$("#get-data-form").submit(function(e){
 		event.preventDefault();
 		 var dataString = $('#get-data-form').serialize();
         $.ajax({
             type: "POST",
             url:  "<?php echo base_url() ?>index.php/admin/Dashboard_controller/create_new_memo",
             data: dataString,
             cache: true,
             success: function(html){
            	 $("form").trigger("reset");
                 $('#response').html(html);
             },
             error: function(html){
                 $("#response").html("an error occured");
             }
         });
         return false;
 	});
    var memo_func = {}
    memo_func.fetch_memo = function(){
        var memo_url = '<?php echo base_url(); ?>index.php/admin/Dashboard_controller/get_all_memo';
        $.get(memo_url, function(response){
            $("#admin_memo_body").html(response);
        });
    }   
    memo_func.interval = setInterval(memo_func.fetch_memo, 2000);
    memo_func.fetch_memo();

 });
function delete_memo(memoId){
      var dataString = 'memoId='+memoId;    
      $.ajax({
          type:"POST",
          url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/delete_memo",
          data:dataString,
          cache:false,
          success:function(html){
              alert(html);
          }
      });
      return false;	
}  
</script> 
<script type="text/javascript" src="<?php echo base_url(); ?>tinymce/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>tinymce/plugin/tinymce/init-tinymce.js"></script>