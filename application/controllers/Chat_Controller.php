<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('Chat_Model');
    }
	public function index(){
	
    }
    public function insert_msg(){
        $send_to = $_POST['recipient'];
        $message = $_POST['message'];

        $message_data  = array(
            'sender_id' => 'admin',
            'recipient_id' => $send_to,
            'message' => $message 
        );
        
        if($this->Chat_Model->md_insert_msg($message_data)){
            
        }
    }
    public function contacts(){
        $contacts['conts'] = $this->Chat_Model->md_contacts();
        ?>  
        <table id="example" class="table table-striped table-bordered">    
        <?php 
                if ($contacts['conts'] == false) {
                    // echo "Start conversation";
                } else{	
                        $no = 1;					
                        foreach ($contacts['conts'] as $row) {
                        ?>
                            <tr>
                                <td>
                                    <a href="javascript:set_recipient('<?= $row->writer_name; ?>')"><b><?= $row->writer_name; ?></a>
                                </td>
                            </tr>
                        <?php	
                    }
                }
        ?>          
        </table>
    <?php
    }
    public function get_my_msg(){
        $to_who = $_POST['to_who'];
        $getmessages['msg'] = $this->Chat_Model->md_get_my_msg($to_who);
        ?>    
        <?php 
             if ($getmessages['msg'] == false) {
                // echo "Start conversation";
            } else{		
                $msg_color = '';
                $font_color = '';			
            foreach ($getmessages['msg'] as $row) {
                if($row->sender_id == 'admin'){
                    $msg_color = '#1a9bcb';
                    $font_color = '#ffffff';
                } else{
                    $msg_color = '#1a9';
                    $font_color = '#ffffff';
                }
            ?>
                   <div class="col-md-10 col-xs-10" style="margin-top:5px;">
                        <div class="messages msg_sent" style="background-color:<?= $msg_color; ?>;color:<?= $font_color; ?>;">
                            <p><?= $row->message; ?></p>
                            <time datetime="2009-11-13T20:00" style="color:<?= $font_color; ?>;"><?= $row->sender_id; ?> • <?= $row->timestamp; ?></time>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-2 avatar" style="margin-top:5px;">
                        <img src="<?php echo base_url(); ?>chat/Avatar-1.jpg" class=" img-responsive ">
                    </div>
            <?php	
        }
        }       
        ?>          
    <?php
    }
    public function get_other_msg(){
        $from_who = $_POST['sender'];
        $getmessages['msg'] = $this->Chat_Model->md_other_msg($from_who);
        ?>    
        <?php 
            if ($getmessages['msg'] == false) {
                // echo "Start conversation";
            } else{				
            foreach ($getmessages['msg'] as $row) {
            ?>
                <div class="col-md-2 col-xs-2 avatar">
                    <img src="<?php echo base_url(); ?>chat/Avatar-1.jpg" class=" img-responsive ">
                </div>
                <div class="col-md-10 col-xs-10">
                    <div class="messages msg_receive">
                    <p><?= $row->message; ?></p>
                    <time datetime="2009-11-13T20:00"><?= $row->writer_name; ?> • <?= $row->timestamp; ?></time>
                </div>
                </div>
            <?php	
            }
        }       
        ?>          
    <?php
    }
}