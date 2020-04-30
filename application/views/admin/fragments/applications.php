<body class="container">
<div id="dialog-confirm" title="Delete writer" style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:2px 12px 20px 0;"></span>This writer will be deleted</p>
</div>
<h1>Applications:</h1>
<div id="center"></div>
<!-- bootstrap datatables -->
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>PHONE</th>
        <th>ID CARD</th>
        <th>CV/RESUME</th>
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
						<td><?= $row->writer_name; ?></td>
						<td><?= $row->writer_email; ?></td>
						<td><?= $row->writer_phone_number; ?></td>
                        <td><a href="<?php echo base_url() ?>index.php/admin/dashboard_controller/download_id_card/<?php echo $row->writer_id; ?>"><?= $row->writer_id_card; ?></a></td>
                        <td><a href="<?php echo base_url() ?>index.php/admin/dashboard_controller/download_resume/<?php echo $row->writer_id; ?>"><?= $row->writer_resume; ?></a></td>
           			 </tr>  
				<?php	
			}
		}
	?>              
</tbody>
</table>
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