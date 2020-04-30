<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
    public function get_admin_info(){
        $query = $this->db->select(array('tbl_admin.admin_id', 'admin_name', 'admin_email', 'admin_phone_number', 'admin_status', 'privilege_name','admin_picture'))
        ->join('tbl_admin_privileges', 'tbl_admin.admin_id = tbl_admin_privileges.admin_id')
        ->join('tbl_privileges', 'tbl_admin_privileges.privilege_id = tbl_privileges.privilege_id')
        ->where('tbl_admin.admin_id', $this->session->userdata('sess_admin_id'))
        ->limit(1)
        ->get('tbl_admin');
        
        return $query->row_array();
    }
    public function fetch_all_active_members(){
        //get all activated members
        $query = $this->db->select(array('writer_id', 'writer_name', 'writer_active', 'writer_online', 'member_picture'))
        ->where('writer_active', 1)
        ->get('tbl_members');
        
        return $query->row_array();
    }
    //fetch data of all users to display on datatables
    public function view(){
        $ambil = $this->db->select(array(`writer_id`, `writer_name`, `writer_phone_number`, `writer_email`, `writer_active`, `member_online`, `member_picture`, `status_name`))
        ->join('tbl_status', 'tbl_members.writer_active = tbl_status.status_id')
        ->where('writer_active', 1)
        ->get('tbl_members');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    //fetch data of all users to display on datatables
    public function all_writers(){
        $ambil = $this->db->select(array(`writer_id`, `writer_name`, `writer_phone_number`, `writer_email`, `writer_active`, `member_online`, `member_picture`, `status_name`))
        ->join('tbl_status', 'tbl_members.writer_active = tbl_status.status_id')
        ->get('tbl_members');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function check_if_order_exist($id_name){
        $this->db->select(array(`order_id`, `handler_name`));
        $this->db->where('order_id', $id_name['order_id']);
        $this->db->or_where('handler_name', $id_name['handler_name']);
               
        $query = $this->db->get('tbl_orders');
                
        if ($query->num_rows() > 1) {
            // order already in db
            return TRUE;
        } else{
            // order not in db , continue to add new
            return FALSE;
        }
    }
    public function new_task($data){
            if ($this->db->insert('tbl_orders', $data)) {            
                //get writer's id using name
                $this->db->select(array('writer_id'));
                $this->db->from('tbl_members');
                $this->db->where(array('writer_name'=>$data['handler_name']));
                $query = $this->db->get();
                $user = $query->row();            
                //get data from $data
                $order_id = $data['order_id'];
                $handler =  $data['handler_name'];
                $due_time = $data['date_due'];
                $my_id = $user->writer_id;
                $order_pages = $data['num_of_pages'];
                
                if($this->create_notification($handler, $order_id, $due_time, $my_id, $order_pages)) {
                    return TRUE;
                }           
                
            } else{
                return FALSE;
            }
    }
    public function add_task_files($sess_new_order_id){
        // count number of files
        $number_of_files = count($_FILES['multipleFiles']['name']);
        // store global files to local variable
        $files = $_FILES;
        // make sure upload folder exists
        if (!is_dir('orders_folder')) {
            mkdir('./orders_folder', 0777, true);
        }
        // upload files one by one
        for($i=0; $i < $number_of_files; $i++){
            $_FILES['multipleFiles']['name'] 		= $files['multipleFiles']['name'][$i];
            $_FILES['multipleFiles']['type'] 		= $files['multipleFiles']['type'][$i];
            $_FILES['multipleFiles']['tmp_name'] 	= $files['multipleFiles']['tmp_name'][$i];
            $_FILES['multipleFiles']['error'] 		= $files['multipleFiles']['error'][$i];
            $_FILES['multipleFiles']['size'] 		= $files['multipleFiles']['size'][$i];

            $config['upload_path'] 		= './orders_folder/';
            $config['allowed_types'] 	= 'zip|docx|pdf|ppt|pptx|xls|xlsx|png|jpg|webp';
            $config['max_size'] 			= 0;
            $config['overwrite'] 			= FALSE;
            $config['remove_spaces'] 	= TRUE;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('multipleFiles')) {
                    $error = array('error' => $this->upload->display_errors());
                    return false;
            } else{
                // $data = array('upload_data' => $this->upload->data());
                $data = $this->upload->data();
                
                $new_file_name = pathinfo($_FILES['multipleFiles']['name'], PATHINFO_FILENAME);
                $ext = pathinfo($_FILES['multipleFiles']['name'], PATHINFO_EXTENSION);
                
                $new_name = $new_file_name.".".$ext;

                $ret = implode(",", (array)$new_name);
                
                $file_names = array(
                    'file_order_id' => 101010,
                    'order_file_name' => $new_name
                );
                $insert[$i]['file_order_id'] = $sess_new_order_id;
                $insert[$i]['order_file_name'] = $data['file_name'];
            }
            }
            if($this->db->insert_batch('tbl_orders_files', $insert)){
                return true;
            } else{
                return false;
            }
                //end of for loop       
    }
    public function update_file_names($file_names){
        $i = 0;
        foreach ($file_names['order_id'] as $order_id) {
            $record = array(
                'order_id' => $order_id,
                'order_file_name' => $file_names['order_file_name']
            );
        }
        
        $this->db->insert_batch('tbl_orders_files', $record);
        $i++;
    }
    public function upload_task_files($order_id, $handler_id){
        // count number of files
        $number_of_files = count($_FILES['multipleFiles']['name']);
        // store global files to local variable
        $files = $_FILES;
        // make sure upload folder exists
        if (!is_dir('orders_folder')) {
            mkdir('./orders_folder', 0777, true);
        }
        // upload files one by one
        for($i=0; $i < $number_of_files; $i++){
            $_FILES['multipleFiles']['name'] 		= $files['multipleFiles']['name'][$i];
            $_FILES['multipleFiles']['type'] 		= $files['multipleFiles']['type'][$i];
            $_FILES['multipleFiles']['tmp_name'] 	= $files['multipleFiles']['tmp_name'][$i];
            $_FILES['multipleFiles']['error'] 		= $files['multipleFiles']['error'][$i];
            $_FILES['multipleFiles']['size'] 		= $files['multipleFiles']['size'][$i];

            $config['upload_path'] 		= './orders_folder/';
            $config['allowed_types'] 	= 'zip|docx|pdf|ppt|pptx|xls|xlsx|png|jpg|webp';
            $config['max_size'] 			= 0;
            $config['overwrite'] 			= FALSE;
            $config['remove_spaces'] 	= TRUE;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('multipleFiles')) {
                    $error = array('error' => $this->upload->display_errors());
            } else{
                $data = array('upload_data' => $this->upload->data());
                
                $data_two = array(
                    'order_id' => $order_id,
                    'order_file_name' => $_FILES['multipleFiles']['name']
                );
              
                if ($this->db->insert('tbl_orders_files', $data_two)) {
                    return TRUE;
                }
            }
    }
        //end of for loop
        
    }
    
    public function new_memo($data){
        if ($this->db->insert('tbl_memo', $data)) {
            return TRUE;
        }
        return FALSE;
    }
    //     end new memo function model
    
    //orders functions begin
    //fetch all posted orders
    public function md_orders_posted(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $posted_orders_query = $this->db->query("SELECT order_id, handler_name, date_uploaded, date_due, order_status, tot_order_price 
        FROM tbl_orders 
        WHERE order_status = 'POSTED' AND order_day >= '$month_start_day' AND order_month = '$last_month'
        OR
        order_status = 'POSTED' AND order_day < '$month_end_day' AND order_month = '$this_month';");

        if ($posted_orders_query->num_rows() > 0) {
            foreach ($posted_orders_query->result() as $posted_data) {
                $returned_posted[] = $posted_data;
            }
            return $returned_posted;
        }
    }
    public function md_orders_started(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $accepted_orders_query = $this->db->query("SELECT order_id, handler_name, date_uploaded, date_due, order_status, tot_order_price 
        FROM tbl_orders 
        WHERE order_status = 'ACCEPTED' AND order_day >= '$month_start_day' AND order_month = '$last_month'
        OR
        order_status = 'ACCEPTED' AND order_day < '$month_end_day' AND order_month = '$this_month';");

        if ($accepted_orders_query->num_rows() > 0) {
            foreach ($accepted_orders_query->result() as $accepted_data) {
                $returned_accepted[] = $accepted_data;
            }
            return $returned_accepted;
        }
    }
    public function md_orders_completed(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $completed_orders_query = $this->db->query("SELECT order_id, handler_name, date_uploaded, num_of_pages, order_month, order_status, date_due, tot_order_price 
        FROM tbl_orders 
        WHERE order_status = 'COMPLETED' AND order_day >= '$month_start_day' AND order_month = '$last_month'
        OR
        order_status = 'COMPLETED' AND order_day < '$month_end_day' AND order_month = '$this_month';");

        if ($completed_orders_query->num_rows() > 0) {
            foreach ($completed_orders_query->result() as $compl_data) {
                $compl_hasil[] = $compl_data;
            }
            return $compl_hasil;
        }
    }
    public function md_orders_approved(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;

        $approved_query = $this->db->query("SELECT order_id, handler_name, date_uploaded, num_of_pages, order_month, order_status, date_due, tot_order_price
            FROM `tbl_orders`
            WHERE
            order_month = '$last_month' 
            AND 
            order_day >= '$month_start_day' 
            OR
            order_month = '$this_month' 
            AND
            order_status = 'APPROVED'
            AND
            order_day < '$month_end_day'"); 
        if ($approved_query->num_rows() > 0) {
            foreach ($approved_query->result() as $aprv_data) {
                $apr_hasil[] = $aprv_data;
            }
            return $apr_hasil;
        }
    }

    public function md_orders_revision(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;

        $approved_query = $this->db->query("SELECT order_id, handler_name, date_uploaded, num_of_pages, order_month, order_status, date_due, tot_order_price
            FROM `tbl_orders`
            WHERE
            order_month = '$last_month' 
            AND 
            order_day >= '$month_start_day' 
            OR
            order_month = '$this_month' 
            AND
            order_status = 'REVISION'
            AND
            order_day < '$month_end_day'"); 
        if ($approved_query->num_rows() > 0) {
            foreach ($approved_query->result() as $aprv_data) {
                $apr_hasil[] = $aprv_data;
            }
            return $apr_hasil;
        }
    }
    //orders functions end
    
    //function for Admin's details update
    public function md_update_admin($data,$admin_id){
        $this->db->set($data);
        $this->db->where("admin_id", $admin_id);
        $this->db->update("tbl_admin", $data);
        return TRUE;
    }
    //activate writer
    public function activate_writer($data,$writer_email){
        $this->db->set($data);
        $this->db->where("writer_email", $writer_email);
        $this->db->update("tbl_members", $data);
        return TRUE;
    }
    //create notification for writer
    public function create_notification($handler, $order_id, $due_time, $my_id, $order_pages){
        $data = array(
            'my_id' => $my_id,
            'notification_message' => 'NEW S&E ORDER '.$order_id.' Kindly read instructions and accept within the next 30 minutes. Check email for more details'
        );
        if ($this->db->insert('tbl_notifications', $data)) {
            return TRUE;
        }
        return FALSE;
    }
    //delete writer from active system
    public function md_delete_writer($id){
        if($this->db->delete('tbl_members', array('writer_id' => $id))){
            return TRUE;
        }
        return FALSE;
    }
    //pull admin's notifications
    public function get_admin_notifications(){
        $query = $this->db->select('COUNT(tbl_orders.id) AS completed_orders, COUNT(tbl_admin_notifications.id) AS notifications_count,
                 tbl_admin_notifications.id AS ord_id, admin_not_message')
                ->join('tbl_orders', 'tbl_admin_notifications.not_order_id = tbl_orders.order_id')
                ->where('admin_not_status', 0)
                ->where('order_status', 'COMPLETED')
                ->get('tbl_admin_notifications');
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
        
    }
    public function stats_orders_completed($ThisMonth, $ThisYear){
        $ambil = $this->db->select('DISTINCT(handler_name) AS Writer,COUNT(id) AS Orders, order_month AS Month,
                                     order_year AS Year, SUM(num_of_pages) AS Pages,
                                     order_status AS Status, SUM(tot_order_price) AS my_price')
                                     ->where('order_status','APPROVED')
                                     ->where('order_month', $ThisMonth)
                                     ->where('order_year', $ThisYear)
                                     ->group_by('handler_name')
                                     ->get('tbl_orders');
                                     
                                     if ($ambil->num_rows() > 0) {
                                         foreach ($ambil->result() as $data) {
                                             $hasil[] = $data;
                                         }
                                         return $hasil;
                                     }
    }
    
    public function md_delete_notification($data, $id){
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("tbl_admin_notifications", $data);
        return TRUE;
    }


    public function admin_info(){
        $query = $this->db->select('COUNT(tbl_orders.id) AS completed_orders, COUNT(tbl_admin_notifications.id) AS notifications_count,
        tbl_admin_notifications.id AS ord_id, admin_not_message')
       ->join('tbl_orders', 'tbl_admin_notifications.not_order_id = tbl_orders.order_id')
       ->where('admin_not_status', 0)
    //    ->where('order_status', 'COMPLETED')
       ->get('tbl_admin_notifications');
        return $query->row_array();        
    }
      //fetch data of all users to display on datatables
      public function all_admins(){
        $ambil = $this->db->select(array(`admin_id`, `admin_name`, `admin_email`, `admin_phone_number`, `admin_status`, `admin_online`,`status_name`))
            ->where_not_in('admin_id', 1)
            ->join('tbl_status', 'tbl_admin.admin_status = tbl_status.status_id')
            ->get('tbl_admin');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    //activate writer
    public function activate_admin($data,$admin_id){
        $this->db->set($data);
        $this->db->where("admin_id", $admin_id);
        $this->db->update("tbl_admin", $data);
        return TRUE;
    }
    //delete admin from active system
    public function delete_admin($id){
        if($this->db->delete('tbl_admin', array('admin_id' => $id))){
            return TRUE;
        }
        return FALSE;
    }
    public function new_members(){
        //get all activated members
        $query = $this->db->select('COUNT(writer_id) AS applications')
        ->where('writer_active', 0)
        ->get('tbl_members');
        
        return $query->row_array();
    }
    public function ord_completed(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $num_of_approved_orders = $this->db->query("SELECT COUNT(order_id) completed 
        FROM tbl_orders 
        WHERE order_status = 'COMPLETED' AND order_day >= '$month_start_day' AND order_month = '$last_month'
        OR
        order_status = 'COMPLETED' AND order_day < '$month_end_day' AND order_month = '$this_month'");


        return $num_of_approved_orders->row_array();      
    }
    public function online_writers(){
        $query = $this->db->select('COUNT(writer_id) count_online_writers')
        ->where('writer_active', 1)
        ->where_not_in('writer_online', ' ')
        ->get('tbl_members');

        return $query->row_array();
    }
    public function per_writer_orders(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $writers_dist = $this->db->query("SELECT DISTINCT(handler_name) AS writer_name,COUNT(order_id) AS writer_completed_orders 
        FROM tbl_orders 
        WHERE order_status = 'APPROVED' AND order_day >= '$month_start_day' AND order_month = '$last_month'
        OR
        order_status = 'APPROVED' AND order_day < '$month_end_day' AND order_month = '$this_month'
        GROUP BY 'handler_name'
        ORDER BY 'writer_completed_orders'");
        
        if ($writers_dist->num_rows() > 0) {
            foreach ($writers_dist->result() as $writers_dist_data) {
                $returned_writers_dist_data[] = $writers_dist_data;
            }
            return $returned_writers_dist_data;
        }
    }
    public function per_order_status(){
        $query = $this->db->select('DISTINCT(order_status) AS order_group, COUNT(id) AS tot_status')
        ->group_by('order_status')
        ->order_by('tot_status', 'DESC')
        ->get('tbl_orders');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function notify_admin(){
        $query = $this->db->select('id, admin_not_message')
        ->where('admin_not_status', 0)
        ->get('tbl_admin_notifications');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function contact_us_msgs(){
        $query = $this->db->select(array('id', 'sender_name', 'sender_email', 'sender_phone', 'sender_message'))
            ->get('tbl_contact_us');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
                return $hasil;
            }
    }
    public function delete_message($id){
        if($this->db->delete('tbl_contact_us', array('id' => $id))){
            return TRUE;
        }
        return FALSE;
    }
    function completedOrder($params = array()){
        $this->db->select(array('id','completed_order_file'));
        $this->db->from('tbl_orders');
        $this->db->order_by('id','desc');
        if(array_key_exists('id',$params) && !empty($params['id'])){
            $this->db->where('id',$params['id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }
    public function get_all_memo(){
        $ambil = $this->db->select(array(`memo_id`, `memo_content`, `memo_time`))
        ->get('tbl_memo');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function delete_memo($id){
        if($this->db->delete('tbl_memo', array('memo_id' => $id))){
            return TRUE;
        }
        return FALSE;
    }
    public function price_rates(){
        $ambil = $this->db->select(array(`probation_writer`, `lower_writer`, `seniour_writer`, `expert_writer`))
        ->get('tbl_rates');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function revise_rates($data){
        if($this->db->set($data)->update("tbl_rates", $data)){
            return TRUE;
        } else{
            return false;
        }
    }
     //upload completed order file    
     public function upload_profile_picture($id){
        // count number of files
        $number_of_files = count($_FILES['profilePicture']['name']);
        // store global files to local variable
        $files = $_FILES;
        // make sure upload folder exists
        if (!is_dir('./profile_pictures/admin')) {
            mkdir('./profile_pictures/admin', 0777, true);
        }
        // upload files one by one
        for($i=0; $i < $number_of_files; $i++){
            $_FILES['profilePicture']['name'] 		= $files['profilePicture']['name'][$i];
            $_FILES['profilePicture']['type'] 		= $files['profilePicture']['type'][$i];
            $_FILES['profilePicture']['tmp_name'] 	= $files['profilePicture']['tmp_name'][$i];
            $_FILES['profilePicture']['error'] 		= $files['profilePicture']['error'][$i];
            $_FILES['profilePicture']['size'] 		= $files['profilePicture']['size'][$i];
            
            $config['upload_path'] 		= './profile_pictures/admin';
            $config['allowed_types'] 	= 'png|jpg|webp';
            $config['max_size'] 		= 0;
            $config['overwrite'] 		= FALSE;
            $config['remove_spaces'] 	= TRUE;
            //create new name for file
            
            $new_file_name = pathinfo($_FILES['profilePicture']['name'], PATHINFO_FILENAME);
            $ext = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
            
            $new_name = $id.".".$ext;
            $new_name = preg_replace('/[,]+/', '_', trim($new_name));
            //rename file to new name created
            $_FILES['profilePicture']['name'] = $new_name;
            //move file to folder
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('profilePicture')) {
                $error = array('error' => $this->upload->display_errors());
                return FALSE;
            } else{
                $data = array('upload_data' => $this->upload->data());
                //assign filename global variable to a new variable
                $order_file_name = $_FILES['profilePicture']['name'];
                //upload completed order filename
                $data_two = array(
                    'admin_picture' => $new_name
                );
                if($this->db->set($data_two)->where("admin_id", $id)->update("tbl_admin", $data_two)){
                    return TRUE;
                }
            }
        }
    }
    //end file upload for loop
     //fetch data of all users to display on datatables
     public function applications(){
        $ambil = $this->db->select(array(`writer_id`, `writer_name`, `writer_phone_number`, `writer_email`, `writer_id_card`, `writer_resume`))
        ->where('writer_active', 0)
        ->get('tbl_members');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    //download id-card
    function get_id_card($params = array()){
        $this->db->select(array('writer_id','writer_id_card'));
        $this->db->from('tbl_members');
        $this->db->order_by('writer_id','desc');
        if(array_key_exists('writer_id',$params) && !empty($params['writer_id'])){
            $this->db->where('writer_id',$params['writer_id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }
    //download resume
    function get_resume($params = array()){
        $this->db->select(array('writer_id','writer_resume'));
        $this->db->from('tbl_members');
        $this->db->order_by('writer_id','desc');
        if(array_key_exists('writer_id',$params) && !empty($params['writer_id'])){
            $this->db->where('writer_id',$params['writer_id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }
    //end download resume
    public function test(){
        $ambil = $this->db->select(array(`message_id`, `sender_id`, `recipient_id`, `message`))
        ->where(array('sender_id' => 'kibaba', 'recipient_id' => 'admin'))
        ->or_where(array('recipient_id' => 'admin', 'recipient_id' => 'kibaba'))
        ->get('sae_tbl_chat');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function edit_writer($edit_writer_data, $writer_to_edit){
        if($this->db->set($edit_writer_data)->where("writer_name", $writer_to_edit)->update("tbl_members", $edit_writer_data)){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function recall_order_view(){
        $ambil = $this->db->select(array(`order_id`, `handler_name`, `date_uploaded`, `date_due`, `order_status`))
        ->where('order_status', 'POSTED')
        ->or_where('order_status', 'ACCEPTED')
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function recall_order($to_delete_order_id){
        //get writer's details
        $query = $this->db->select(array('writer_id', 'writer_email'))
        ->join('tbl_orders', 'tbl_members.writer_name = tbl_orders.handler_name')
        ->where('order_id', $to_delete_order_id)
        ->get('tbl_members');
        $user = $query->row();
        $send_email = $user->writer_email;
        $send_to_id = $user->writer_id;
        // end get handler details

        $recalled_order_data = array(
            'handler_name' => '',
            'order_status' => 'DRAFT'
        );
        if($this->db->set($recalled_order_data)->where("order_id", $to_delete_order_id)->update("tbl_orders", $recalled_order_data)){
            if($this->send_recall_notification($send_to_id, $to_delete_order_id)){
                if($this->send_recall_order_email($send_email, $to_delete_order_id)){
                    return TRUE;
                }
            }
        } 

        return FALSE;
    }
    public function delete_order($to_delete_order_id){
        $delete_order_status = array(
            'order_status' => 'TRASH'
        );
        if($this->db->set($delete_order_status)->where("order_id", $to_delete_order_id)->update("tbl_orders", $delete_order_status)){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function send_recall_notification($send_to_id, $to_delete_order_id){
        $data = array(
            'my_id' => $send_to_id,
            'notification_message' => 'Order number '.$to_delete_order_id.' has been recalled.'
        );
        if ($this->db->insert('tbl_notifications', $data)) {
            return TRUE;
        }
        return FALSE;
    }

    public function send_recall_order_email($send_to_who, $to_delete_order_id){
        $this->load->library('email');
        $this->email->set_mailtype("html");
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($send_to_who);
		$this->email->subject('ORDER RECALLED');
		$this->email->message('Order ' ."<b>".$to_delete_order_id."</b>". ' has been recalled.');
        if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    public function get_completed_files(){
        $files = $this->db->select('id, file_order_id, order_file_name, order_file_status')
        ->where('order_file_status', 'COMPLETED')
        ->or_where('order_file_status', 'APPROVED')
        ->get('tbl_orders_files');
        if ($files->num_rows() > 0) {
            foreach ($files->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function approve_order($app_id){
        $new_order_status = array(
            'order_status' => 'APPROVED'
        );

        $file_appr_status = array(
            'order_file_status' => 'APPROVED'
        );
        
        if($this->db->set($new_order_status)->where("order_id", $app_id)->update("tbl_orders", $new_order_status)){
            if($this->notify_writer_order_approved($app_id)){
                if($this->db->set($file_appr_status)->where(array('file_order_id' => $app_id, 'order_file_status' => 'COMPLETED'))->update("tbl_orders_files", $file_appr_status)){
                    return TRUE;
                } else{
                    return FALSE;
                }
                
            } else{
                return false;
            }
        } else{
            return FALSE;
        }
    }
    public function notify_writer_order_approved($app_id){
           //get writer's details
           $query = $this->db->select(array('writer_id'))
           ->join('tbl_orders', 'tbl_members.writer_name = tbl_orders.handler_name')
           ->where('order_id', $app_id)
           ->get('tbl_members');
           $user = $query->row();
           
           $notify_writer_id = $user->writer_id;

        $not_message = "Order " .$app_id. " has been approved";
        $approved_notify_data = array(
            'my_id' => $notify_writer_id,
            'notification_message' => $not_message,
            'notification_status' => 0
        );
        // insert notification message to db
        if ($this->db->insert('tbl_notifications', $approved_notify_data)) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function md_trash_orders(){
        $ambil = $this->db->select(array(`order_id`, `handler_name`, `date_uploaded`, `num_of_pages`, `order_month`, `order_status`))
        ->where('order_status', 'TRASH')
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    // functions below will send order to revision and notify writer
    public function send_to_revision($app_id){
        $new_order_status = array(
            'order_status' => 'REVISION'
        );

        $file_appr_status = array(
            'order_file_status' => 'REVISION'
        );
        
        if($this->db->set($new_order_status)->where("order_id", $app_id)->update("tbl_orders", $new_order_status)){
            if($this->notify_writer_order_needs_revision($app_id)){
                if($this->db->set($file_appr_status)->where(array('file_order_id' => $app_id, 'order_file_status' => 'COMPLETED'))->update("tbl_orders_files", $file_appr_status)){
                    return TRUE;
                } else{
                    return FALSE;
                }
                
            } else{
                return false;
            }
        } else{
            return FALSE;
        }
    }
    public function notify_writer_order_needs_revision($app_id){
           //get writer's details
           $query = $this->db->select(array('writer_id'))
           ->join('tbl_orders', 'tbl_members.writer_name = tbl_orders.handler_name')
           ->where('order_id', $app_id)
           ->get('tbl_members');
           $user = $query->row();
           
           $notify_writer_id = $user->writer_id;

        $not_message = "REVISION REQUEST FOR ORDER " .$app_id;
        $approved_notify_data = array(
            'my_id' => $notify_writer_id,
            'notification_message' => $not_message,
            'notification_status' => 0
        );
        // insert notification message to db
        if ($this->db->insert('tbl_notifications', $approved_notify_data)) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function tot_orders_price(){
        $ambil = $this->db->select('SUM(tot_order_price) AS total_sum, COUNT(id) AS total_ids')
        ->where('order_status', 'APPROVED')
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }       
    }
    public function financial_report(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $financial_report_query = $this->db->query("SELECT order_id, handler_name, num_of_pages, client_price, tot_order_price, (client_price) - (tot_order_price) AS companies_cut 
        FROM tbl_orders 
        WHERE order_status = 'APPROVED' AND order_day >= '$month_start_day' AND order_month = '$last_month'
        OR
        order_status = 'APPROVED' AND order_day < '$month_end_day' AND order_month = '$this_month'");

        if ($financial_report_query->num_rows() > 0) {
            foreach ($financial_report_query->result() as $financial_data) {
                $returned_financial[] = $financial_data;
            }
            return $returned_financial;
        }       
    }
    public function ids_for_revision(){
        $ambil = $this->db->select(array(`order_id`))
        ->where('order_status', 'COMPLETED')
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function create_new_revision($order_for_revision_data){
        if($this->db->set($order_for_revision_data)->where("order_id", $order_for_revision_data['order_id'])->update("tbl_orders", $order_for_revision_data)){
            if ($this->notify_writer_order_needs_revision($order_for_revision_data['order_id'])) {
                return TRUE;   
            }
        } else{
            return FALSE;
        }
    }

    public function new_draft($data){
        if ($this->db->insert('tbl_orders', $data)) {            
            return TRUE;   
        } else{
            return FALSE;
        }
    }
    public function ord_draft(){
         $ambil = $this->db->select('order_id, handler_name, date_uploaded, num_of_pages, order_month, order_status, date_due, tot_order_price ')
        ->where('order_status', 'DRAFT')
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }     
    }

    public function assign_draft($draft_id ,$assign_draft_data){
        if($this->db->set($assign_draft_data)->where("order_id", $draft_id)->update("tbl_orders", $assign_draft_data)){
            if ($this->draft_assign_notification($draft_id ,$assign_draft_data)) {
                return TRUE;   
            }
        } else{
            return FALSE;
        }
    }

    //create notification for writer
    public function draft_assign_notification($draft_id ,$assign_draft_data){
         //get writer's details
         $query = $this->db->select(array('writer_id'))
         ->join('tbl_orders', 'tbl_members.writer_name = tbl_orders.handler_name')
         ->where('order_id', $draft_id)
         ->get('tbl_members');
         $my_id = $query->row();
         $the_id = $my_id->writer_id;

        $data = array(
            'my_id' => $the_id,
            'notification_message' => 'NEW S&E ORDER '.$draft_id.' Kindly read instructions and accept within the next 30 minutes. Check email for more details'
        );
        if ($this->db->insert('tbl_notifications', $data)) {
            if($this->draft_assign_email($draft_id)){
                return TRUE;
            }
        }
        return FALSE;
    }

    public function draft_assign_email($draft_id){
         // fetch the handler's name first
         $this->db->select(array('handler_name', 'date_due'));
         $this->db->from('tbl_orders');
         $this->db->where(array('order_id'=>$draft_id));
         $query = $this->db->get();
         $name_data = $query->row();
         $res_handler_name = $name_data->handler_name;
         $time_order_due = $name_data->date_due;
        // fetch the writer's email first
        $this->db->select(array('writer_email'));
        $this->db->from('tbl_members');
        $this->db->where(array('writer_name'=>$res_handler_name));
        $query = $this->db->get();
        $email_data = $query->row();
        $res_email = $email_data->writer_email;
        // then send email
        $this->load->library('email');
        $this->email->set_mailtype("html");
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($res_email);
		$this->email->subject('ASSIGNMENT OF ORDER');
		$this->email->message('New order ' ."<b>".$draft_id."</b>". ' has been assigned to you which is due by ' .$time_order_due. ' please login to your account to read further instructions. Follow the link below to login http://sylviaandedwards.com/index.php?/writer/Auth_Writer_Controller/load_login_form');
        if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
}