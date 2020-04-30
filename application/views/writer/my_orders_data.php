<br/>
<table id="example" class="table table-striped table-bordered">
<thead>
      <tr>
      <th>ORDER ID</th>
      <th>DATE POSTED</th>
      <th>TIME DUE</th>
      <th>STATUS</th>
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
						<td><?= $row->date_uploaded; ?></td>
						<td><?= $row->date_due; ?></td>
						<td><?= $row->order_status; ?></td>
            		</tr>  
				<?php	
			}
		}
?>         
</tbody>
</table>
</body>
</html>