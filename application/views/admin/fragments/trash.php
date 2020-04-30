<h3>Trash orders</h3>
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
    <th>ORDER ID</th>
    <th>WRITER</th>
    <th>DATE POSTED</th>
    <th>TIME DUE</th>
    <th>STATUS</th>
    </tr>
</thead>
<tbody>
<?php
    if($trash == false){
    ?>
        <div class="alert alert-info" role="alert">No deleted orders</div>
    <?php
            } else{
                $no = 1;					
                foreach ($trash as $row) {
                ?>
                    <tr>
                        <td><?= $row->order_id; ?></td>
                        <td><?= $row->handler_name; ?></td>
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