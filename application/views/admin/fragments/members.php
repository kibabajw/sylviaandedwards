<body class="container">
<div id="dialog-confirm" title="Delete writer" style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:2px 12px 20px 0;"></span>This writer will be deleted</p>
</div>
<h1>Team:</h1>
<div id="center"></div>
<!-- bootstrap datatables -->
<table id="example" class="table table-striped table-bordered">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-pencil" aria-hidden="true"></i>
 Edit researcher</button><br/><br/>
<thead>
    <tr>
		<th>ID</th>
		<th>EDIT</th>
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
			    if ($row->writer_online == '') {
			        $online = "";
			    } elseif ($row->writer_online !== ''){
			        $online = '<i class="fa fa-circle text-success"></i>';
			    } 
			    //check if writer is active
			    if ($row->writer_active == 0) {
			        $active = 'activate_writer';
			        $btn_disabled = "";
			    } else if($row->writer_active == 1){
			        $active = 'deactivate_writer';
			        $btn_disabled = "disabled";
			    }
				?>
					 <tr>
						<td><?= $row->writer_id; ?></td>
						<td>
							<input type="radio" onclick="edit_writer('<?php echo $row->writer_name; ?>')"/>
						</td>
						<td><?= $row->writer_name; ?></td>
						<td><?= $row->writer_email; ?></td>
						<td><?= $row->writer_phone_number; ?></td>
						<td style="text-align: center;"><?= $online; ?></td>
						<td>
							<a href="javascript:chk('<?php echo $row->writer_email; ?>')" id="id_category" class="btn btn-primary <?php echo $btn_disabled; ?>"><?php echo $row->status_name; ?></a> 
						</td>
           				<td>
                            <a href="javascript:delete_writer('<?php echo $row->writer_id; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>   
                        </td>
           			 </tr>  
				<?php	
			}
		}
	?>              
</tbody>
</table>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="exampleModalLabel">Edit <span id="edit_who"></span>&nbsp;&nbsp;
			<span id="writer_edit_result" style="color:red;"></span>
		</h4>
      </div>
      <div class="modal-body">
        <form class="form-edit-writer">
			<!-- dropdown start -->
			<select name="writer_level_dropdown" class="writer_level_dropdown">
				<option value="Probation writer">Probation writer</option>
				<option value="Regular writer">Regular writer</option>
				<option value="Seniour writer">Seniour writer</option>
			</select>
			<!-- dropdown end -->
          <div class="form-group">
            <label for="recipient-name" class="control-label">Reseacher's level:</label>
            <input type="text" name="update-writer-level" class="form-control" id="update-writer-level" required>
		  </div>
		  	<!-- dropdown start -->
			<select name="writer_position_dropdown" class="writer_position_dropdown">
				<option value="Director">Director</option>
				<option value="General Manager">General Manager</option>
				<option value="Assistant General manager">Assistant General manager</option>
				<option value="Head of Human Resource">Head of Human Resource</option>
				<option value="Assistant Head of Human Resource">Assistant Head of Human Resource</option>
				<option value="Head of Finance">Head of Finance</option>
				<option value="Head of Welfare">Head of Welfare</option>
				<option value="Researcher">Researcher</option>
			</select>
			<!-- dropdown end -->
          <div class="form-group">
            <label for="message-text" class="control-label">Researcher's position:</label>
            <input type="text" name="update-writer-position" class="form-control" id="update-writer-position" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="btn_edit_writer" class="btn btn-primary">Update Researher</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function chk(dataId){
	var dataString = 'dataId='+dataId;      
  	$.ajax({
		type:"POST",
		url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/activate_writer",
		data:dataString,
		cache:false,
		success:function(html){
			$("#center").html(html);
		}
	});
	return false;	
}
function edit_writer(writer_name){
	$("#edit_who").text(writer_name);
}
$(".writer_level_dropdown").change(function () {
        var level = this.value;
        $("#update-writer-level").val(level);
});
$(".writer_position_dropdown").change(function () {
        var level = this.value;
        $("#update-writer-position").val(level);
});

// edit writer logic
$("#btn_edit_writer").click(function(){
	var writer_to_edit = $("#edit_who").html(); 
	var writer_level = $("#update-writer-level").val();
	var writer_position = $("#update-writer-position").val();
	
	$.ajax({
                url:'<?php echo base_url() ?>index.php/admin/Dashboard_controller/edit_writer',
                method: 'post',
                // data: new FormData($('.form-edit-writer')[0]),
				data: {writer_to_edit: writer_to_edit, writer_level: writer_level, writer_position: writer_position}
            }).done(function(html){
                 $("#writer_edit_result").html(html);
                 $("form").trigger("reset");
           }).fail(function(html){
                 $("#writer_edit_result").html("An error occured, please try again.");
           });
          
});
</script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript">
function delete_writer(writerId){
	var dataString = 'writerId='+writerId;
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
	    		url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/delete_writer",
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
</body>	
</html>	