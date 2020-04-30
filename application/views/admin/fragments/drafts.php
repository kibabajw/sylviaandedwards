<h3>Drafts</h3>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
<table id="example" class="table table-striped table-bordered">
<thead>
    <tr>
    <th>ORDER ID</th>
    <th>WRITER</th>
    <th>DATE POSTED</th>
    <th>TIME DUE</th>
    <th>STATUS</th>
    <th>PRICE</th>
    <th>ASSIGN</th>
    </tr>
</thead>
<tbody>
<?php
    if($drafts == false){
    ?>
        <div class="alert alert-info" role="alert">No drafts</div>
    <?php
        } else{
                $no = 1;					
                foreach ($drafts as $row) {
                ?>
                    <tr>
                        <td><?= $row->order_id; ?></td>
                        <td><?= $row->handler_name; ?></td>
                        <td><?= $row->date_uploaded; ?></td>
                        <td><?= $row->date_due; ?></td>
                        <td><?= $row->order_status; ?></td>
                        <td><?= $row->tot_order_price; ?></td>
                        <td><a href="javascript:assign_draft('<?= $row->order_id; ?>')" class="btn btn-primary">ASSIGN ORDER</a></td>
                    </tr>  
                <?php	
            }
        }
?>         
</tbody>
</table>
</div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <h4>Assign order to:</h4>
        <?= form_open('admin/Dashboard_controller/assign_draft', 'class="form_assign_draft"') ?> 
        <div class="row" style="margin-top: 0px;">
            <div class="col-sm-12">
                    <span id="response" style="color:red;font-size:18px;"><?php echo validation_errors(); ?></span>      	
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                <label for="exampleInputEmail1">
                    <h3 class="ui header">Order Id</h3>
                </label>
                <input type="text" class="form-control" name="new_task_id" id="new_task_id" placeholder="Draft Id" autocomplete="off" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                <label for="exampleInputEmail1">
                    <h3 class="ui header">Writer</h3>
                </label>
                        <select class="form-control" name="new_task_handler" id="new_task_handler" required>
                        <?php				
                        foreach ($members as $row) {
                        ?>
                            <option><?= $row->writer_name; ?></option>
                        <?php	
                        }
                        ?>
                        </select>
                </div>
            </div>
            </div>

            <div class="row" style="margin-top: 30px;">
            <div class="col-sm-8">
                <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_assign_draft">Assign draft</button>
            </div>
            </div>
            </div>  

    <?= form_close() ?>  
    </div>
</div>
<script>
    function assign_draft(draft_id){
        $("#new_task_id").val(draft_id);
    }
    $(document).ready(function(){
        $(".form_assign_draft").submit(function(e){        
                event.preventDefault();
                $.ajax({
                url: '<?php echo base_url() ?>index.php/admin/Dashboard_controller/assign_draft', 
                type: 'POST',
                data: new FormData($('.form_assign_draft')[0]), // The form with the file inputs.
                processData: false,
                contentType: false                    // Using FormData, no need to process data.
            }).done(function(html){
                $(".form_assign_draft").trigger("reset");
                alert(html);
                load_draft_orders();
            }).fail(function(html){
                alert("An error occured");
            });      
        });
    });
</script>