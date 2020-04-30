<body class="container">
<div id="dialog-confirm" title="Recall order" style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:2px 12px 20px 0;"></span>
    Are you sure you want to recall this order ?
    </p>
</div>
<div id="dialog-confirm-delete" title="Delete order" style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:2px 12px 20px 0;"></span>
    Are you sure you want to delete this order ?
    </p>
</div>
<h3>Workspace: Recall or Delete order</h3>
<small>Recalled orders shall be available in drafts for new assigning while deleted orders shall be moved to the trash</small>
<h4 id="center" style="color:red;"></h4>
<!-- bootstrap datatables -->
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
		<th>ORDER ID</th>
		<th>HANDLER</th>
        <th>DATE UPLOADED</th>
        <th>DATE DUE</th>
        <th>ORDER STATUS</th>
        <th>RECALL</th>
        <th>DELETE</th>
    </tr>
</thead>
<tbody>
	<?php
		if($recall_order == false){
		?>
		<div class="alert alert-info" role="alert">No data to display</div>
		<?php
		} else{
			foreach ($recall_order as $row) {
				?>
					 <tr>
						<td><?= $row->order_id; ?></td>
						<td><?= $row->handler_name; ?></td>
						<td><?= $row->date_uploaded; ?></td>
                        <td><?= $row->date_due; ?></td>
                        <td><?= $row->order_status; ?></td>
                        <td>
                        <a href="javascript:recall_order('<?php echo $row->order_id; ?>')"><i class="fa fa-recycle" aria-hidden="true"></i>&nbsp;Recall</a> 
												</td>
												<td>
                        <a href="javascript:delete_order('<?php echo $row->order_id; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete</a> 
                        </td>
           			 </tr>  
				<?php	
			}
		}
	?>              
</tbody>
</table>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script>
    function recall_order(to_recall_order_id){
        var dataString = 'to_recall_order_id='+to_recall_order_id;  
        $( "#dialog-confirm").dialog({
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Yes": function() {
	        $(this).dialog("close");
            $.ajax({
            url:'<?php echo base_url() ?>index.php/admin/Dashboard_controller/recall_order',
            method: 'post',
            // data: new FormData($('.form-edit-writer')[0]),
            data: {to_recall_order_id: to_recall_order_id}
            }).done(function(html){
                $("#center").html(html);
            }).fail(function(html){
                $("#center").html("An error occured, please try again.");
            });
	    	return false;
	        },
	        Cancel: function() {
	          $(this).dialog("close");
	        }
	      }
	    });       
    }
// this function deletes an order from the db
		function delete_order(to_delete_order_id){
        var dataString = 'to_delete_order_id='+to_delete_order_id;  
        $( "#dialog-confirm-delete").dialog({
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Yes": function() {
	        $(this).dialog("close");
            $.ajax({
            url:'<?php echo base_url() ?>index.php/admin/Dashboard_controller/delete_order',
            method: 'post',
            // data: new FormData($('.form-edit-writer')[0]),
            data: {to_delete_order_id: to_delete_order_id}
            }).done(function(html){
                $("#center").html(html);
								recall_order();
            }).fail(function(html){
                $("#center").html("An error occured, please try again.");
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