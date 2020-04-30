<?php
$btn_class = "btn btn-primary";
$btn_text = "Accept order";
$btn_gylph = '<i class="fa fa-trophy" aria-hidden="true"></i>';
foreach ($notify as $row){
    if ($row['order_status'] == "POSTED") {
        $btn_class = "btn btn-primary";
        $btn_text = "Accept order";
        $btn_gylph = '<i class="fa fa-check" aria-hidden="true"></i>';
    } else if($row['order_status'] == "COMPLETED"){
        $btn_class = "btn btn-success disabled";
        $btn_text = "Order completed";
        $btn_gylph = '<i class="fa fa-trophy" aria-hidden="true"></i>';
    } else if($row['order_status'] == "ACCEPTED"){
        $btn_class = "btn btn-primary disabled";
        $btn_text = "In progress";
        $btn_gylph = '<i class="fa fa-hourglass-start" aria-hidden="true"></i>';
    } else if($row['order_status'] == "APPROVED"){
        $btn_class = "btn btn-success disabled";
        $btn_text = "Approved";
        $btn_gylph = '<i class="fa fa-money" aria-hidden="true"></i>';
    }
?>
<table class="table table-hover">
  <tbody>
       <tr>
      		<td colspan="2" class="text-primary">
      			<a href="javascript:order_instructions('#<?= $row['id'] ?>')"><h5 id="order_id_to_use"><?= $row['order_id'] ?></h5></a>
      		</td>
      		 <td scope="col" style="text-align: right;">
              	 <span class="time text-primary">
                <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?= $row['date_uploaded'] ?>
                </span>
              </td>
    	</tr>
    	<tr id="<?= $row['id'] ?>">
      		<td colspan="2">
      			<?= $row['order_instructions'] ?><br>
                <a href="javascript:set_id('<?= $row['order_id'] ?>')"><i class="fa fa-folder text-primary" aria-hidden="true"></i>&nbsp;Download files</a>
                <div id="<?= $row['order_id'] ?>"></div>
            </td>
      		<td scope="col" style="text-align: right;">
              	 <span class="time text-primary">
                	<a href="javascript:accept_order('<?= $row['id'] ?>')" class="<?= $btn_class ?>" id="btn_accept_order"><?= $btn_gylph ?>&nbsp;<?= $btn_text ?></a>
                </span>
            </td>
    	</tr> 
  </tbody>
</table>  
<?php 
}

?>
