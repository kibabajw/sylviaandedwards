<h3>Orders started</h3>
<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>ORDER ID</th>
        <th>WRITER</th>
        <th>DATE POSTED</th>
        <th>TIME DUE</th>
        <th>STATUS</th>
        <th>PRICE</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if($mydata == false){
        ?>
            <div class="alert alert-info" role="alert">No orders have been started</div>
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
                        </tr>  
                    <?php	
                }
            }
    ?>         
    </tbody>
    </table>