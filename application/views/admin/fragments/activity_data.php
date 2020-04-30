<body>
<br/>
<table id="example" class="table table-striped table-bordered">
<thead>
      <tr>
      <th>ORDER ID</th>
      <th>WRITER</th>
      <th>DATE POSTED</th>
      <th>TIME DUE</th>
	  <th>STATUS</th>
	  <th>PRICE</th>
	  <th>File</th>
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
				foreach ($mydata as $row) {
				?>
					<tr>
						<td><?= $row->order_id; ?></td>
						<td><?= $row->handler_name; ?></td>
						<td><?= $row->date_uploaded; ?></td>
						<td><?= $row->date_due; ?></td>
						<td><?= $row->order_status; ?></td>
						<td><?= $row->tot_order_price; ?></td>
						<td><a href="javascript:set_id('<?= $row->order_id; ?>')">Download files</a></td>
            		</tr>  
				<?php	
			}
		}
?>         
</tbody>
</table>
<aside class="side_div_for_files" style="display:none;width:35%;padding:10px;margin-top:69px;background:#1a9;height:auto;position:absolute;right:0;top:0;">
      <div><h2 id="btn_close_side_div" style="cursor:pointer;">&times;</h2></div>
      <h4>Click on a file to download</h4>
    <div id="file_holder"></div>
</aside>
