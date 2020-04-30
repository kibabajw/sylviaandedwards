<h4>Completed order files</h4> 
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
    <th>ID</th>
    <th>ORDER ID</th>
    <th>COMPLETED FILE</th>
    <th>STATUS</th>
    </tr>
</thead>
<tbody>
<?php
    if($completed_files == false){
    ?>
        <div class="alert alert-info" role="alert">No completed orders</div>
    <?php
            } else{
                $no = 1;					
                foreach ($completed_files as $row) {
                ?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->file_order_id; ?></td>
                        <td><a href="<?php echo base_url() ?>index.php/writer/Writer_Dashboard_Controller/download_order_files/<?=  $row->id;  ?>"><?= $row->order_file_name; ?></a></td>
                        <td><?= $row->order_file_status; ?></td>
                    </tr>  
                <?php	
            }
        }
?>         
</tbody>
</table>