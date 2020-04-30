<h3>Order Price rates</h3>
<div class="row">
    <?php echo form_open('admin/Dashboard_controller/update_price_rates', 'id="form-revise-rates"'); ?>
    <?php
        if($price_rate == false){
    ?>
        <div class="alert alert-info" role="alert">Price rates not set</div>
    <?php
            } else{
                $no = 1;					
                foreach ($price_rate as $row) {
                ?>
                    <div class="col-sm-10">
                    <div class="form-group">
                    <span>
                        <h4 id="revise_rate_msg" style="color:red;"></h4>
                    </span>
                    </div>
                    </div>
                    <div class="col-sm-10">
                    <div class="form-group">
                    <label for="changeName">
                    <h4 class="ui header">Probation writer</h4>
                    </label>
                    <input type="text" class="form-control" name="revise_probation_writer_rate" id="revise_probation_writer_rate" placeholder="Revise rate" value="<?= $row->probation_writer; ?>" autocomplete="off">
                    </div>
                    </div>
                    <div class="col-sm-10">
                    <div class="form-group">
                    <label for="changeEmail">
                    <h4 class="ui header">Regular writer</h4>
                    </label>
                    <input type="text" class="form-control" name="revise_lower_writer_rate" id="revise_lower_writer_rate" placeholder="Revise rate" value="<?= $row->lower_writer; ?>" autocomplete="off">
                    </div>
                    </div>
                    <div class="col-sm-10">
                    <div class="form-group">
                    <label for="changeEmail">
                    <h4 class="ui header">Seniour writer</h4>
                    </label>
                    <input type="text" class="form-control" name="revise_seniour_writer_rate" id="revise_seniour_writer_rate" placeholder="Revise rate" value="<?= $row->seniour_writer; ?>" autocomplete="off">
                    </div>
                    </div>
                    <div class="col-sm-10">
                    <div class="form-group">
                    <label for="changeEmail">
                    <h4 class="ui header">Expert writer</h4>
                    </label>
                    <input type="text" class="form-control" name="revise_expert_writer_rate" id="revise_expert_writer_rate" placeholder="Revise rate" value="<?= $row->expert_writer; ?>" autocomplete="off">
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-6 col-sm-10">
                    <button type="submit" class="btn btn-danger" id="btn_revise_rates">Revise rates</button>
                    </div>
                    </div>  
                <?php	
            }
        }
?> 
<?php echo form_close(); ?>
</div>
<script>
      //revise price rates
  $("#btn_revise_rates").click(function(e){
      e.preventDefault();
      $.ajax({
            url:'<?php echo base_url() ?>index.php/admin/Dashboard_controller/update_price_rates',
            method: 'post',
            data: new FormData($('#form-revise-rates')[0]), // The form with the file inputs.
            processData: false,
            contentType: false 
        }).done(function(response){
            $("#revise_rate_msg").text(response);
        }).fail(function(response){
                $("#revise_rate_msg").html("An error occured, please try again.");
        }); 
  }); 
</script>  