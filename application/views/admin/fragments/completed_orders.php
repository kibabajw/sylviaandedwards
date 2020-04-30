<h3>Completed orders</h3>
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
    <th>ORDER ID</th>
    <th>WRITER</th>
    <th>DATE POSTED</th>
    <th>TIME DUE</th>
    <th>STATUS</th>
    <th>PRICE</th>
    <th>REVISION</th>
    <th>APPROVAL</th>
    </tr>
</thead>
<tbody>
<?php
    if($completed == false){
    ?>
        <div class="alert alert-info" role="alert">No completed orders</div>
    <?php
        } else{
                $no = 1;					
                foreach ($completed as $row) {
                ?>
                    <tr>
                        <td><?= $row->order_id; ?></td>
                        <td><?= $row->handler_name; ?></td>
                        <td><?= $row->date_uploaded; ?></td>
                        <td><?= $row->date_due; ?></td>
                        <td><?= $row->order_status; ?></td>
                        <td><?= $row->tot_order_price; ?></td>
                        <td><a href="javascript:send_to_revision('<?= $row->order_id; ?>')" class="btn btn-warning">SEND TO REVISION</a></td>
                        <td><a href="javascript:approve_order('<?= $row->order_id; ?>')" class="btn btn-primary">APPROVE ORDER</a></td>
                    </tr>  
                <?php	
            }
        }
?>         
</tbody>
</table>
<script>
    function send_to_revision(app_id){
        var dataString = 'app_id='+app_id;
            $.ajax({
                type:"POST",
                url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/send_to_revision",
                data:dataString,
                cache:false,
            success:function(html){
                alert(html);
                load_completed_orders();
            }
            });
    }
    function approve_order(app_id){
        var dataString = 'app_id='+app_id;
            $.ajax({
                type:"POST",
                url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/approve_order",
                data:dataString,
                cache:false,
            success:function(html){
                alert(html);
                load_completed_orders();
            }
            });
    }
</script>