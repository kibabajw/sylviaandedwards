<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Writer_Dashboard_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->helper('date');
        $this->load->database();
        $this->load->library(array('session','form_validation','upload'));
        $this->load->model('writer/Writer_Dashboard_Model');
        $this->load->model('File-downloader/File_Model');
    }
    public function index() {
        if ($this->session->userdata('sess_member_id')) {            
            //send data to view
            $data['records'] = $this->Writer_Dashboard_Model->get_writer_info();
            $this->load->view('writer/dashboard', $data);
        } else {
            $this->load->view('writer/restricted');
        }
    }
    public function calculate_time_remaining(){
        $get_time['time_got'] = $this->Writer_Dashboard_Model->get_current_order_time();
        $due_time = $get_time['time_got'];
        
        if($get_time['time_got']):
            $list = $due_time;
                $imploded = implode( ", ", $list );
                // out-put remaining time
                echo "( ";
                echo $imploded;
                echo " ) ";
                echo $this->dateDiff("now", "$imploded");
        elseif(!$get_time['time_got']):        
            echo "No accepted order";
        endif;
    }
    public function update(){
        $this->form_validation->set_rules('changeName', 'Name', 'required');
        $this->form_validation->set_rules('changeEmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('changeWriteraddress', 'Writeraddress', 'required');
        $this->form_validation->set_rules('changePhone', 'Phone', 'required');
        $this->form_validation->set_rules('changeAcademicinfo', 'Academicinfo', 'required');
        $this->form_validation->set_rules('changePassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
                echo "All fields are required";
        } else {
            $data = array(
                'writer_name' => $this->input->post('changeName'),
                'writer_email' => $this->input->post('changeEmail'),
                'writer_address' => $this->input->post('changeWriteraddress'),
                'writer_phone_number' => $this->input->post('changePhone'),
                'writer_academic_info' => $this->input->post('changeAcademicinfo'),
                'writer_password' => password_hash($this->input->post('changePassword'), PASSWORD_BCRYPT)
            );
            $admin_id = $this->session->userdata('sess_member_id');
            if($this->Writer_Dashboard_Model->update($data,$admin_id)){
                echo "Details updated";
            }
        }
    }
    public function workspace_data(){
        //fetch unread notifications
        // $notify['datum'] = $this->Writer_Dashboard_Model->get_files();
        // $notify['notify'] = $this->Writer_Dashboard_Model->get_notifications();
        // $this->load->view('writer/notify_data', $notify);

        $notify['notify'] = $this->Writer_Dashboard_Model->get_my_workspace_data();
        $this->load->view('writer/notify_data', $notify);
        
    }
    public function notifications(){
        $notify['notify'] = $this->Writer_Dashboard_Model->get_my_notifications();
        $this->load->view('writer/notifications', $notify);
        
    }
    public function logout(){
        //delete online token
        $data = array('writer_online' => '');
        $this->db->where('writer_id', $this->session->userdata('sess_member_id'));
        $this->db->update('tbl_members', $data);
        
        $this->session->unset_userdata('sess_member_id');
        $this->session->unset_userdata('sess_member_name');
        $this->session->sess_destroy();
        redirect('writer/Auth_Writer_Controller');
    }
    public function get_my_orders(){
        $data['mydata'] = $this->Writer_Dashboard_Model->my_orders();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('writer/my_orders_data', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function writer_accept_order(){
        $id =  $_POST['orderId'];
        $data = array(
            'order_status' => 'ACCEPTED'
        );
        if ($this->Writer_Dashboard_Model->accept_order($data, $id)) {
            echo "You have accepted the order";
        } else{
            echo "Could not accept order, try again";
        }
    }
    public function download_order_files($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');            
            //get file info from database
            $fileInfo = $this->File_Model->getRows(array('id' => $id));
            //file path
            $file = base_url().'orders_folder/'.$fileInfo['order_file_name'];            
            $fileContents = file_get_contents(base_url('orders_folder/'.$fileInfo['order_file_name']));
            //download file from directory
            force_download($fileInfo['order_file_name'], $fileContents);
        }
    }
    public function submit_order(){
        if ($this->form_validation->run() == FALSE){
            $id = $this->input->post('completed_order_id');
            //add data to update order's status to completed
            $data = array(
                'order_status' => 'COMPLETED'                
            );
            
            //pass insert data to model for db insert
            if($this->Writer_Dashboard_Model->complete_order($data, $id)){
                
                echo '
                    <div class="alert alert-info" role="alert">
                    Order submitted
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
            } else {
                echo '
                    <div class="alert alert-warning" role="alert">
                        Error occured while submitting order
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
            }
          
            
        } else {
            echo '
                    <div class="alert alert-warning" role="alert">
                      Please input all the fields
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                 ';
            
            
        }
    }
    public function my_memo(){
        $memo['memo'] = $this->Writer_Dashboard_Model->my_memo();
        ?>
        <table class="table table-striped table-bordered">
        <?php
            if($memo['memo'] == false){
            ?>
                <div class="alert alert-info" role="alert">No new memo</div>
            <?php
                    } else{
                        $no = 1;					
                        foreach ($memo['memo'] as $row) {
                        ?>
                            <tr>
                            <td>
                                <font class="text-primary"><?= $row->memo_time; ?></font>   
                            </tr>
                            <tr>    
                                <td><h4><?= $row->memo_content; ?></h4></td>
                            </tr>  
                        <?php	
                    }
                }
        ?>     
        </table>    
    <?php
    }
    public function upload_profile_picture(){
        $id = $this->session->userdata('sess_member_id');
        if ($this->Writer_Dashboard_Model->upload_profile_picture($id)) {
            redirect('writer/Writer_Dashboard_Controller');
        } else{
            $this->session->set_flashdata('profile_picture_upload_msg', 'Could not update picture, try again.');
            $this->load->view('writer/dashboard');
        }
    }
    public function get_files(){
        $id_set = $_POST['id_set'];
        $result['datum'] = $this->Writer_Dashboard_Model->get_files($id_set);
        ?>
        <table class="table table-striped table-bordered">
        <?php
            
                        					
        foreach ($result['datum'] as $row) {
            ?>
                <tr>
                <td>
                    <b><?= $row->file_order_id; ?></b>                    
                </tr>
                <tr>    
                    <td><h4>
                    <a href="<?php echo base_url() ?>index.php/writer/Writer_Dashboard_Controller/download_order_files/<?=  $row->id;  ?>"><?= $row->order_file_name; ?></a>
                    </h4></td>
                </tr>  
            <?php	
        }
                
        ?>     
        </table>    
    <?php
    }   
    public function hide_notification(){
        $not_id_to = $_POST['not_id'];
        if($this->Writer_Dashboard_Model->hide_my_notification($not_id_to)){
            echo "Notification hidden";
        } else{
            echo "Could not hide notification";
        }
    }
    public function order_ids_to_submit(){
        $order_ids['ids'] = $this->Writer_Dashboard_Model->get_order_ids();
        ?>
        <select class="form-control" name="completed_order_id" id="completed_order_id">
            <?php				
            	foreach ($order_ids['ids'] as $row) {
            	?>
            	<option><?= $row->order_id; ?></option>
            	<?php	
            	}
            ?>
        </select>
        <?php
    }
     // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  public function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
        break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {
          $interval .= "s";
        }
        // Add value and interval to times array
        $times[] = $value . " " . $interval;
        $count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
  }
  public function cal_my_orders(){
    $data = $this->Writer_Dashboard_Model->get_writer_order_cost_info();
    print_r($data);
  }
}