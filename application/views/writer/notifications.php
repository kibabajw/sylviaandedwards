<?php
foreach ($notify as $row){

?>
<table class="table table-hover">
  <tbody>
       <tr>
      		<td colspan="2" class="text-primary">
      			<p><?= $row['notification_time'] ?></p>
      		</td>
      		 <td scope="col" style="text-align: right;">
              	<span class="time text-primary">
                <a href="javascript:hide_notification('<?= $row['id'] ?>')"><i class="fa fa-toggle-on"></i>&nbsp;Hide</a>
                </span>
              </td>
    	</tr>
    	<tr id="<?= $row['id'] ?>">
      		<td colspan="2">
      			<?= $row['notification_message'] ?><br>
            </td>
    	</tr> 
  </tbody>
</table>  
<?php 
}

?>
