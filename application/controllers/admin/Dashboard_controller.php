<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->library(array('session','form_validation','upload'));
        $this->load->model('admin/Dashboard_Model');
        $this->load->helper('date');
    }
    public function index(){
        if ($this->session->userdata('sess_admin_id')) {
            $data['records'] = $this->Dashboard_Model->get_admin_info();            
            $data['title'] = 'Admin dashboard';            
            //get now_date and now_time
            $data['time_now'] = date(DATE_RFC850, time());
            //send data to view
            $this->load->view('admin/fragments/head', $data);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/fragments/footer');
        } else {
            $this->load->view('admin_login_form');
        }
    }
    public function fetch_all_active_members(){
        $data['members'] = $this->Dashboard_Model->fetch_all_active_members();
    }
    public function logout(){
        //delete online token
        $data = array('admin_online' => '');
        $this->db->where('admin_id', $this->session->userdata('sess_admin_id'));
        $this->db->update('tbl_admin', $data);
        
        $this->session->unset_userdata('sess_admin_id');
        $this->session->sess_destroy();
        redirect('admin/admin_controller/admin_login_view');
    }
    public function show_date_time(){
        $datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
        $time = time();
        $data['time_now'] = mdate($datestring, $time);
    }
    public function load_main_content(){
        $admin_id = $this->session->userdata('sess_admin_id');
        $data['notify_data'] = $this->Dashboard_Model->get_admin_notifications();
        $this->load->view('admin/fragments/dashboard_main_content', $data);
    }
    public function load_page(){
        $data['price_rate'] = $this->Dashboard_Model->price_rates();
        $data['members'] = $this->Dashboard_Model->view();
        $this->load->view('admin/fragments/new_task_head');
        $this->load->view('admin/fragments/new_task', $data);
    }
    public function load_new_draft(){
        $data['price_rate'] = $this->Dashboard_Model->price_rates();
        $this->load->view('admin/fragments/new_draft_view', $data);
    }
    public function draft_orders(){
        $data['drafts'] = $this->Dashboard_Model->ord_draft();
        $data['members'] = $this->Dashboard_Model->view();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/drafts', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function new_revision(){
        $data['revision_id'] = $this->Dashboard_Model->ids_for_revision();
        $this->load->view('admin/fragments/new_revision', $data);
    }
    public function load_members(){
        $data['mydata'] = $this->Dashboard_Model->all_writers();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/members', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function load_applications(){
        $data['mydata'] = $this->Dashboard_Model->applications();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/applications', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function load_memo(){
        $this->load->view('admin/fragments/memo');
    }
    public function load_activity(){
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/activity');
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function load_chat(){
        $this->load->view('admin/fragments/chat');
    }
    public function load_stats(){
        //get month name
        $monthString = '%M';
        //get year name
        $yearString = '%Y';
        $time = time();
        $ThisMonth = mdate($monthString, $time);
        $ThisYear  = mdate($yearString, $time);
        $data['mydata'] = $this->Dashboard_Model->stats_orders_completed($ThisMonth, $ThisYear);
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/stats', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function load_messages(){
        $messages['messages'] = $this->Dashboard_Model->contact_us_msgs();
        $this->load->view('admin/fragments/messages', $messages);
    }
    public function load_profile(){
        $data['records'] = $this->Dashboard_Model->get_admin_info(); 
        $this->load->view('admin/profile', $data);
    }
    public function load_assist(){
        $data['mydata'] = $this->Dashboard_Model->all_admins();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/assist', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function load_rates(){
        $this->load->view('admin/fragments/rates');
    }
    //new task creation by Admin
    public function create_new_task(){
        if ($this->form_validation->run() == FALSE){
            $new_order_id = $this->input->post('new_task_id');
            $handler = $this->input->post('new_task_handler');
            $time_order_due = $this->input->post('new_task_due_time');
            //get day name
            $dayString = '%D';
            //get month name
            $monthString = '%M';
            //get year name
            $yearString = '%Y';
            $time = time();
            // $ThisMonth = mdate($monthString, $time);
            $day_today = date('d');;
            $ThisMonth = date('F');
            $ThisYear  = mdate($yearString, $time);
            //calculate tot price for order
            $order_rate = $this->input->post('new_task_price_rate');
            $tot_price = $this->input->post('new_order_pages') * $order_rate;
            //add user input data-set to array
            $data = array(
                'order_id'              => $new_order_id,
                'handler_name'          => $handler,
                'date_due'              => $time_order_due,
                'order_day'             => $day_today,
                'num_of_pages'          => $this->input->post('new_order_pages'),
                'order_instructions'    => $this->input->post('new_task_instructions'),
                'order_month'           => $ThisMonth,
                'order_year'            => $ThisYear,
                'order_status'          => 'POSTED',
                'order_price_rate'      => $order_rate,
                'tot_order_price'       => $tot_price,
                'client_price'          => $this->input->post('clientsprice')
                
            );
            //save new order id to be used for files upload
            $sess_new_order_data = array(
                'sess_new_order_id' => $new_order_id
            );
            $this->session->set_userdata($sess_new_order_data);

            //check if array data is not empty
            if(count(array_filter($data)) == count($data)) {
                 //pass insert data to model for db insert
                if($this->Dashboard_Model->new_task($data)){  
                    if($this->send_new_order_email($handler, $new_order_id, $time_order_due)){
                        echo "order created";
                    }                                              
                } else {
                        echo '
                                <div class="alert alert-warning" role="alert">
                                  Error occured while creating order
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                             ';
                    }
            } else {
                //$data has empty keys
                  echo '
                    <div class="alert alert-warning" role="alert">
                      Input all the fields
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
    public function upload_task_files(){
        if ($this->Dashboard_Model->add_task_files($this->session->userdata('sess_new_order_id'))) {
            $this->session->unset_userdata('sess_new_order_id');
            echo 'Files have been added.';
        } else{
            echo 'Could not add files.';
        }
    }
    public function send_new_order_email($handler, $new_order_id, $time_order_due){
        // fetch the writer's email first
        $this->db->select(array('writer_email'));
        $this->db->from('tbl_members');
        $this->db->where(array('writer_name'=>$handler));
        $query = $this->db->get();
        $user = $query->row();
        $send_email = $user->writer_email;
        // then send email
        $this->load->library('email');
        $this->email->set_mailtype("html");
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($send_email);
		$this->email->subject('ASSIGNMENT OF ORDER');
		$this->email->message('New order ' ."<b>".$new_order_id."</b>". ' has been assigned to you which is due by ' .$time_order_due. ' please login to your account to read further instructions. Follow the link below to login http://sylviaandedwards.com/index.php?/writer/Auth_Writer_Controller/load_login_form');
        if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    public function create_new_memo(){
        $data = array(
            'memo_author'    => $this->session->userdata('sess_admin_id'),
            'memo_audience' => $this->input->post('new_memo_audience'),
            'memo_content'   => $this->input->post('txt_memo')
        ); 
        //check if memo $data is not empty
        if (count(array_filter($data)) == count($data)) {
            //send data[] to model
            if ($this->Dashboard_Model->new_memo($data)) {
                echo '
                  <div class="alert alert-info" role="alert">
                    Memo created successfully
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  ';
                return true;
            } else {
                echo '
                  <div class="alert alert-danger" role="alert">
                    Memo could not be created
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  ';
                return FALSE;
            }
        } else {
            //memo cannot be empty
            echo '
                  <div class="alert alert-danger" role="alert">
                    Memo message cannot be empty
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  ';
        }
       
    }
    //end new memo function
    //orders functions begin here
    public function orders_posted(){
        $data['posted'] = $this->Dashboard_Model->md_orders_posted();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/posted_orders', $data);
        $this->load->view('admin/fragments/data_tables_footer'); 
    }
    public function orders_started(){
        $data['mydata'] = $this->Dashboard_Model->md_orders_started();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/started_orders', $data);
        $this->load->view('admin/fragments/data_tables_footer'); 
    }
    public function orders_completed(){
        $completed_ord_data['completed'] = $this->Dashboard_Model->md_orders_completed();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/completed_orders', $completed_ord_data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function orders_revision(){
        $revision_ord_data['revision'] = $this->Dashboard_Model->md_orders_revision();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/revision_orders', $revision_ord_data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function orders_approved(){
        $approved_data['approved'] = $this->Dashboard_Model->md_orders_approved();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/approved_orders', $approved_data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    //orders functions end here
    
    //function to update Admin's details
    public function update_admin(){  
        $this->form_validation->set_rules('changeName', 'Name', 'required');
        $this->form_validation->set_rules('changeEmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('changePhone', 'Phone', 'required');
        $this->form_validation->set_rules('changePassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
                echo "All fields are required";
        } else {
            $data = array(
                'admin_name' => $this->input->post('changeName'),
                'admin_email' => $this->input->post('changeEmail'),
                'admin_phone_number' => $this->input->post('changePhone'),
                'admin_password' => password_hash($this->input->post('changePassword'), PASSWORD_BCRYPT)
            );        
            
            $admin_id = $this->session->userdata('sess_admin_id');
            if($this->Dashboard_Model->md_update_admin($data,$admin_id)){
                echo "Details updated";
            } else{
                echo "Could not update your details";
            }
        }               

    }
    //activate writer
    public function activate_writer() {
        $profselect =  $_POST['dataId'];
        $data = array(
            'writer_active' => 1
        );
        if($this->Dashboard_Model->activate_writer($data, $profselect)){
            if($this->writer_activation_email($profselect)){
                echo "Writer $profselect has been activated";
            } else {
                echo "Could not send email";
            }
        } else{
            echo "Could not activate writer";
        }
    }
    public function writer_activation_email($profselect){
        $this->load->library('email');
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($profselect);
		$this->email->subject('Recruitment');
		$this->email->message('Your application has been accepted, to join Sylvia and Edwards Ressearch Consultancy. Attached are guidelines to be used for your training, please familiarise yourself with them.');
        $this->email->attach(base_url().'email-attachment/Guidingsamplesandtools.zip');
		if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    //delete writer 
    public function delete_writer(){
        $id =  $_POST['writerId'];
        if ($this->Dashboard_Model->md_delete_writer($id)) {
            echo "Writer has been deleted";
        } else{
            echo "writer not deleted";
        }
    }
    //pull admin's notifications
    public function admin_notifications(){
        $data['notify'] = $this->Dashboard_Model->get_admin_notifications();        
        foreach($data as $key => $value) {
            print_r($value[0]->admin_not_message);
        }
    }
    
    public function delete_notification(){
        $id =  $_POST['notificationId'];
        $data = array(
            'admin_not_status' => 1
        );
        if ($this->Dashboard_Model->md_delete_notification($data, $id)) {
            echo "Notification deleted";
        } else{
            echo "Could not delete";
        }
    }
    public function admin_calendar(){
                //calendar logic
                $prefs['template'] = '            
                {table_open}<table border="0" cellpadding="0" cellspacing="0" class="table_calendar">{/table_open}
                    
                {heading_row_start}<tr>{/heading_row_start}
                    
                {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
                {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
                {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
                    
                {heading_row_end}</tr>{/heading_row_end}
                    
                {week_row_start}<tr>{/week_row_start}
                {week_day_cell}<td>{week_day}</td>{/week_day_cell}
                {week_row_end}</tr>{/week_row_end}
                    
                {cal_row_start}<tr>{/cal_row_start}
                {cal_cell_start}<td>{/cal_cell_start}
                {cal_cell_start_today}<td>{/cal_cell_start_today}
                {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}
                    
                {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
                {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
                    
                {cal_cell_no_content}{day}{/cal_cell_no_content}
                {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
                    
                {cal_cell_blank}&nbsp;{/cal_cell_blank}
                    
                {cal_cell_other}{day}{/cal_cel_other}
                    
                {cal_cell_end}</td>{/cal_cell_end}
                {cal_cell_end_today}</td>{/cal_cell_end_today}
                {cal_cell_end_other}</td>{/cal_cell_end_other}
                {cal_row_end}</tr>{/cal_row_end}
                    
                {table_close}</table>{/table_close}';
                
                $this->load->library('calendar', $prefs);
                echo $this->calendar->generate();
    }
    public function activate_admin(){
        $profselect =  $_POST['dataId'];
        $data = array(
            'admin_status' => 1
        );
        if($this->Dashboard_Model->activate_admin($data, $profselect)){
            echo "Admin $profselect has been activated";
        } else{
            echo "Could not activate admin";
        }
    }
    public function delete_admin(){
        $id =  $_POST['adminId'];
        if($this->Dashboard_Model->delete_admin($id)){
            echo "Admin has been deleted";
        } else{
            echo "Could not delete admin";
        }
    }
    public function data(){
        $data = $this->Dashboard_Model->admin_info(); 
        $data['complete'] = $this->Dashboard_Model->ord_completed();
        $data['new_members'] = $this->Dashboard_Model->new_members();
        $data['online_writers'] = $this->Dashboard_Model->online_writers();

        $outp = "[";
        $outp .= '{"name":"'.$data["ord_id"].'","phone":["'.$data["admin_not_message"].'"],"notifications_count":"'.$data["notifications_count"].'","completed_orders":"'.$data['complete']['completed'].'","applications":"'.$data['new_members']['applications'].'","online_count":"'.$data['online_writers']['count_online_writers'].'"}';
        $outp .="]";

        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($outp));               
    }
    public function writers_dist(){
        $online_writers['mydata'] = $this->Dashboard_Model->per_writer_orders();
        ?>
            <?php
                if($online_writers['mydata'] == false){
                ?>
                    <div class="alert alert-info" role="alert">No data to display</div>
                <?php
                        } else{
                            $no = 1;					
                            foreach ($online_writers['mydata'] as $row) {
                            ?>
                                <div class="box-body"><?= $row->writer_name; ?><span style="float: right;"><?= $row->writer_completed_orders; ?></span></div>  
                            <?php	
                        }
                    }
            ?>         
        <?php
    }
    public function orders_distribution(){
        $orders_dist['orders'] = $this->Dashboard_Model->per_order_status();
        ?>
        <?php
            if($orders_dist['orders'] == false){
            ?>
                <div class="alert alert-info" role="alert">No data to display</div>
            <?php
                    } else{
                        $no = 1;					
                        foreach ($orders_dist['orders'] as $row) {
                        ?>
                            <div class="box-body"><?= $row->order_group; ?><span style="float: right;"><?= $row->tot_status; ?></span></div>  
                        <?php	
                    }
                }
        ?>         
    <?php
    }
    public function notify_admin(){
        $orders_dist['orders'] = $this->Dashboard_Model->notify_admin();
        ?>      
        <?php
            if($orders_dist['orders'] == false){
            ?>
                <div class="alert alert-info" role="alert">No new notifications</div>
            <?php
                    } else{
                        $no = 1;					
                        foreach ($orders_dist['orders'] as $row) {
                        ?>
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete notification">
                                <div class="box-body"><a href="javascript:del_notification(<?= $row->id; ?>)"><b><?= $row->admin_not_message; ?></b></a></div>
                            </span>
                        <?php	
                    }
                }
        ?>          
    <?php
    }
    public function delete_msg(){
        $id =  $_POST['msgId'];
        if($this->Dashboard_Model->delete_message($id)){
            echo "Message Deleted";
        } else{
            echo "Could not delete message";
        }
    }
    public function download_completed_order($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');            
            //get file info from database
            $fileInfo = $this->Dashboard_Model->completedOrder(array('id' => $id));
            //file path
            $file = base_url().'orders_folder/completed_orders/'.$fileInfo['completed_order_file'];            
            $fileContents = file_get_contents(base_url('orders_folder/'.$fileInfo['completed_order_file']));
            //download file from directory
            force_download($fileInfo['completed_order_file'], $fileContents);
        }
    }
    public function get_all_memo(){
        $memo['memo'] = $this->Dashboard_Model->get_all_memo();
        ?>
        <table class="table table-striped table-bordered">
        <?php
            if($memo['memo'] == false){
            ?>
                <div class="alert alert-info" role="alert">No memo created today</div>
            <?php
                    } else{
                        $no = 1;					
                        foreach ($memo['memo'] as $row) {
                        ?>
                            <tr>
                            <td>
                                <font class="text-primary"><?= $row->memo_time; ?></font>  
                                <span style="float:right;">
                                <a href="javascript:delete_memo('<?php echo $row->memo_id; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                </span> 
                            </td>    
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
    public function delete_memo(){
        $id =  $_POST['memoId'];
        if($this->Dashboard_Model->delete_memo($id)){
            echo "Memo Deleted";
        } else{
            echo "Could not delete memo";
        }
    }
    public function load_price_rates(){
        $data['price_rate'] = $this->Dashboard_Model->price_rates();
        $this->load->view('admin/fragments/rates', $data);
    }
    public function update_price_rates(){
        $data = array(
            'probation_writer'   => $this->input->post('revise_probation_writer_rate'),
            'lower_writer' => $this->input->post('revise_lower_writer_rate'),
            'seniour_writer' => $this->input->post('revise_seniour_writer_rate'),
            'expert_writer' => $this->input->post('revise_expert_writer_rate')
        );
        if($this->Dashboard_Model->revise_rates($data)){
            echo "Rates have been revised";
        } else{
            echo "Could not revise rates";
        }
    }
    public function upload_profile_picture(){
        $id = $this->session->userdata('sess_admin_id');
        if ($this->Dashboard_Model->upload_profile_picture($id)) {
            $this->index();
        } else{
            $this->session->set_flashdata('profile_picture_upload_msg', 'Could not update picture, try again.');
            $this->index();
        }
    }
    public function download_id_card($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');            
            //get file info from database
            $fileInfo = $this->Dashboard_Model->get_id_card(array('writer_id' => $id));
            //file path
            $file = base_url().'id_card_and_resume/'.$fileInfo['writer_id_card'];            
            $fileContents = file_get_contents(base_url('id_card_and_resume/'.$fileInfo['writer_id_card']));
            //download file from directory
            force_download($fileInfo['writer_id_card'], $fileContents);
        }
    }
    public function download_resume($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');            
            //get file info from database
            $fileInfo = $this->Dashboard_Model->get_resume(array('writer_id' => $id));
            //file path
            $file = base_url().'id_card_and_resume/'.$fileInfo['writer_resume'];            
            $fileContents = file_get_contents(base_url('id_card_and_resume/'.$fileInfo['writer_resume']));
            //download file from directory
            force_download($fileInfo['writer_resume'], $fileContents);
        }
    }
    public function test(){
        $data['records'] = $this->Dashboard_Model->test();
        ?>  
        <table> 
            <tr>
                <th>SENDER</th>
                <th>RECIPIENT</th>
                <th>MESSAGE</th>
            </tr>   
        <?php
            if($data['records'] == false){
            ?>
                <div class="alert alert-info" role="alert">No new notifications</div>
            <?php
                    } else{
                        $no = 1;					
                        foreach ($data['records'] as $row) {
                        ?>
                            <tr>
                                <td><?= $row->sender_id ?></td>
                                <td><?= $row->recipient_id ?></td>
                                <td><?= $row->message ?></td>
                            </tr>
                        <?php	
                    }
                }
        ?>   
        </table>       
    <?php
    }
    public function edit_writer(){
        $writer_to_edit = $_POST['writer_to_edit'];
        $writer_level = $_POST['writer_level'];
        $writer_position = $_POST['writer_position'];
        
        $edit_writer_data = array(
            'writer_level' => $writer_level,
            'writer_position' => $writer_position
        );
        
          //check if all fields are set
          if (count(array_filter($edit_writer_data)) == count($edit_writer_data)){
            if($this->Dashboard_Model->edit_writer($edit_writer_data, $writer_to_edit)){
               echo "Writer updated successfully";
            } else{
               echo "Could not update details, try again.";
            }
        } else{
            echo "Please enter all the fields.";
        }
    }
    public function recall_order_view(){
        $result['recall_order'] = $this->Dashboard_Model->recall_order_view();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/recall_order', $result);
        $this->load->view('admin/fragments/data_tables_footer');
    }    
    public function recall_order(){
        $to_delete_id = $_POST['to_recall_order_id'];
        if($this->Dashboard_Model->recall_order($to_delete_id)){
            echo "Order " .$to_delete_id. " has been recalled";
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function delete_order(){
        $to_delete_id = $_POST['to_delete_order_id'];
        if($this->Dashboard_Model->delete_order($to_delete_id)){
            echo "Order " .$to_delete_id. " has been deleted";
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function get_completed_files(){
        $files['completed_files'] = $this->Dashboard_Model->get_completed_files();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/completed_order_files', $files);
        $this->load->view('admin/fragments/data_tables_footer');
    } 
    public function trash_orders_view(){
        $data['trash'] = $this->Dashboard_Model->md_trash_orders();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/trash', $data);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function approve_order(){
        $app_id = $_POST['app_id'];
        
        if ($this->Dashboard_Model->approve_order($app_id)) {
            echo "Order " .$app_id. " has been approved";
        } else{
            echo "Could not approve order number ".$app_id;
        }
    }
    public function send_to_revision(){
        $app_id = $_POST['app_id'];
        
        if ($this->Dashboard_Model->send_to_revision($app_id)) {
            if($this->send_revision_email($app_id)){
                echo "Order " .$app_id. " has been sent to revision";
            }
        } else{
            echo "Could not send order number ".$app_id. " to revision";
        }
    }
    public function send_revision_email($app_id){
        // get writer's name first using order id
        $this->db->select(array('handler_name'));
        $this->db->from('tbl_orders');
        $this->db->where(array('order_id'=>$app_id));
        $ord_query = $this->db->get();
        $writer_user = $ord_query->row();
        $send_to_name = $writer_user->handler_name;
        // fetch the writer's email first
        $this->db->select(array('writer_email'));
        $this->db->from('tbl_members');
        $this->db->where(array('writer_name'=>$send_to_name));
        $query = $this->db->get();
        $user = $query->row();
        $send_email = $user->writer_email;
        // then send email
        $this->load->library('email');
        $this->email->set_mailtype("html");
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($send_email);
		$this->email->subject('CALL FOR REVISION OF ORDER ' .$app_id);
		$this->email->message('REVISION REQUEST FOR ORDER ' .$app_id);
        if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    public function tot_orders_price(){
        $data_sum['sum_of_orders'] = $this->Dashboard_Model->tot_orders_price();
        foreach ($data_sum['sum_of_orders'] as $row) {
            echo $row->total_sum ." ". $row->total_ids. " ORDERS APPROVED";	
        }
    }
    public function load_finances(){
        $data_finances['finances'] = $this->Dashboard_Model->financial_report();
        $this->load->view('admin/fragments/data_tables_head');
        $this->load->view('admin/fragments/finances', $data_finances);
        $this->load->view('admin/fragments/data_tables_footer');
    }
    public function create_new_revision(){
        if ($this->form_validation->run() == TRUE){
            //add user input data-set to array
            $new_revision_data = array(
                'order_id'              => $this->input->post('new_revision_id'),
                'date_due'              => $this->input->post('new_revision_time'),
                'order_instructions'    => $this->input->post('new_revision_instructions'),
                'order_status'          => 'REVISION'
                
            );
            
            //check if array data is not empty
            if(count(array_filter($new_revision_data)) == count($new_revision_data)) {
                 //pass insert data to model for db insert
                if($this->Dashboard_Model->create_new_revision($new_revision_data)){  
                    if($this->send_revision_email($new_revision_data['order_id'])){
                        echo '
                                <div class="alert alert-primary" role="alert">
                                    Revision send
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                             ';
                    }                                              
                } else {
                        echo '
                                <div class="alert alert-warning" role="alert">
                                  Error occured while creating order
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                             ';
                    }
            } else {
                //$data has empty keys
                  echo '
                    <div class="alert alert-warning" role="alert">
                      Input all the fields
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
      //new task creation by Admin
      public function create_new_draft(){
        if ($this->form_validation->run() == FALSE){
            $new_order_id = $this->input->post('new_draft_id');
            $time_order_due = $this->input->post('new_draft_due_time');
            //get day name
            $dayString = '%D';
            //get month name
            $monthString = '%M';
            //get year name
            $yearString = '%Y';
            $time = time();
            // $ThisMonth = mdate($monthString, $time);
            $day_today = date('d');;
            $ThisMonth = date('F');
            $ThisYear  = mdate($yearString, $time);
            //calculate tot price for order
            $order_rate = $this->input->post('new_draft_price_rate');
            $tot_price = $this->input->post('new_draft_pages') * $order_rate;
            //add user input data-set to array
            $data = array(
                'order_id'              => $new_order_id,
                'date_due'              => $time_order_due,
                'order_day'             => $day_today,
                'num_of_pages'          => $this->input->post('new_draft_pages'),
                'order_instructions'    => $this->input->post('new_draft_instructions'),
                'order_month'           => $ThisMonth,
                'order_year'            => $ThisYear,
                'order_status'          => 'DRAFT',
                'order_price_rate'      => $order_rate,
                'tot_order_price'       => $tot_price,
                'client_price'          => $this->input->post('clientsprice')
                
            );
            
            //save new order id to be used for files upload
            $sess_new_order_data = array(
                'sess_new_order_id' => $new_order_id
            );
            $this->session->set_userdata($sess_new_order_data);

            //check if array data is not empty
            if(count(array_filter($data)) == count($data)) {
                 //pass insert data to model for db insert
                if($this->Dashboard_Model->new_draft($data)){  
                    echo 'Data saved, continue to next step.';                                        
                } else {
                    echo '
                        <div class="alert alert-warning" role="alert">
                            Error occured while creating draft
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ';
                }
            } else {
                //$data has empty keys
                  echo '
                    <div class="alert alert-warning" role="alert">
                      Input all the fields
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

    public function upload_draft_files(){
        if ($this->Dashboard_Model->add_task_files($this->session->userdata('sess_new_order_id'))) {
            $this->session->unset_userdata('sess_new_order_id');
                echo 'Draft saved';
        } else{
            echo 'Error adding files';
        }
    }
    public function assign_draft(){
        $draft_id = $this->input->post('new_task_id');
        $assign_draft_data = array(
            'handler_name' => $this->input->post('new_task_handler'),
            'order_status' => 'POSTED'
        );
        if ($this->Dashboard_Model->assign_draft($draft_id ,$assign_draft_data)) {
                echo 'Draft has been assigned';
        } else{
            echo 'Error assigning draft';
        }
    }
}
