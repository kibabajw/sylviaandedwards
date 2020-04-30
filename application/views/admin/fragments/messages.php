<h3>Contact-us messages</h3>

        <table class="table table-striped table-bordered">
      
        <?php
            if($messages == false){
            ?>
                <div class="alert alert-info" role="alert">No new messages</div>
            <?php
                    } else{
                        $no = 1;					
                        foreach ($messages as $row) {
                        ?>      
                        <tr>
                        <th>Sender's name</th>
                        <th>Sender's email</th>
                        <th>Sender's mobile number</th>
                        </tr>
                        <tr>
                               <td>
                               <a href="javascript:delete_message('<?php echo $row->id; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                   <?= $row->sender_name; ?></td>
                                <td><?= $row->sender_email; ?></td>
                                <td><?= $row->sender_phone; ?></td>
                        </tr> 
                        <tr><td colspan="3"><?= $row->sender_message; ?></td></tr> 
                        <?php	
                    }
                }
            ?>    
        </table>     
        <script type="text/javascript">
        function delete_message(data){
            var dataString = 'msgId='+data;    
            $.ajax({
                type:"POST",
                url: "<?php echo base_url() ?>index.php/admin/Dashboard_controller/delete_msg",
                data:dataString,
                cache:false,
                success:function(html){
                    alert(html);
                }
            });
            return false;	
        }
    </script>