<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Writer_Dashboard_Model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_writer_info(){  
        $query = $this->db->select('COUNT(tbl_orders.id) AS my_orders, SUM(tbl_orders.num_of_pages) AS my_pages,tbl_members.writer_id, writer_name, writer_email, writer_phone_number, writer_active,writer_academic_info,writer_address,member_picture,writer_position,writer_level, SUM(tot_order_price) AS my_tot_price')
        ->join('tbl_user_privileges', 'tbl_members.writer_id = tbl_user_privileges.user_id')
        ->join('tbl_privileges', 'tbl_user_privileges.privilege_id = tbl_privileges.privilege_id')
        ->join('tbl_orders', 'tbl_orders.handler_id = tbl_members.writer_id')
        ->where('order_status', 'COMPLETED')
        ->where('tbl_members.writer_id', $this->session->userdata('sess_member_id'))
        ->limit(1)
        ->get('tbl_members');
        
        return $query->row_array();
    }
    public function get_current_order_time(){
        $query = $this->db->select('date_due')
        ->where('order_status', 'ACCEPTED')
        ->where('tbl_orders.handler_name', $this->session->userdata('sess_member_name'))
        ->limit(1)
        ->get('tbl_orders');
        
        return $query->row_array();
    }
    //function for writer's details update
    public function update($data,$writer_id){
        $this->db->set($data);
        $this->db->where("writer_id", $writer_id);
        $this->db->update("tbl_members", $data);
        return TRUE;
    }
    public function get_my_workspace_data(){
        $query = $this->db->select('tbl_orders.id, tbl_orders_files.id AS id_for_file, order_id, order_instructions, date_due, date_uploaded , order_status, order_file_name')
        ->join('tbl_orders_files', 'tbl_orders.order_id = tbl_orders_files.file_order_id')
        ->where('handler_name', $this->session->userdata('sess_member_name'))
        ->group_by('tbl_orders.id')
        ->get('tbl_orders');
        
        return $query->result_array();
    }
    public function get_my_notifications(){
        $query = $this->db->select('id, notification_message, notification_time, notification_status')
        ->where('my_id', $this->session->userdata('sess_member_id'))
        ->where('notification_status', 0)
        ->get('tbl_notifications');
        
        return $query->result_array();
    }
    public function get_files($id_set){
        $files = $this->db->select('id, file_order_id, order_file_name')
        ->where('file_order_id', $id_set)
        ->get('tbl_orders_files');
        if ($files->num_rows() > 0) {
            foreach ($files->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function my_orders(){
        $ambil = $this->db->select(array(`order_id`, `order_file_name`, `date_uploaded`, `date_due`, `order_status`))
        ->where('handler_name', $this->session->userdata('sess_member_name'))
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function accept_order($data, $id){
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        //get orders's id from db
        $this->db->select(array('order_id'));
        $this->db->from('tbl_orders');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $user = $query->row();
        //data for notification to be sent to admin
        $admin_not_data = array(
            'not_order_id' => $user->order_id,
            'admin_not_message' => 'Order id '.$user->order_id.' has been accepted'
        );
        if ($this->order_notify_admin($admin_not_data)) {
            return TRUE;
        }
        return FALSE;
    }
    public function order_notify_admin($admin_not_data){
        if ($this->db->insert('tbl_admin_notifications', $admin_not_data)) {
                return TRUE;           
        } else{
        return FALSE;
        }
    }
    public function complete_order($data, $id){        
        $this->db->set($data);
        $this->db->where("order_id", $id);
        $this->db->update("tbl_orders", $data);
        
        if($this->upload_complete_file($id)){
            //data for notification to be sent to admin
            $admin_not_data = array(
                'not_order_id' => $id,
                'admin_not_message' => 'Order id '.$id.' has been completed'
            );
            if ($this->order_notify_admin($admin_not_data)) {
                return TRUE;
            }
        } else{
            return FALSE;
        }
    }
    
    //upload completed order file    
    public function upload_complete_file($id_order_complete){
            // count number of files
              $number_of_files = count($_FILES['multipleFiles']['name']);
              // store global files to local variable
              $files = $_FILES;
              // make sure upload folder exists
              if (!is_dir('./orders_folder/completed_orders')) {
                  mkdir('./orders_folder/completed_orders', 0777, true);
              }
              // upload files one by one
              for($i=0; $i < $number_of_files; $i++){
                  $_FILES['multipleFiles']['name'] 		= $files['multipleFiles']['name'][$i];
                  $_FILES['multipleFiles']['type'] 		= $files['multipleFiles']['type'][$i];
                  $_FILES['multipleFiles']['tmp_name'] 	= $files['multipleFiles']['tmp_name'][$i];
                  $_FILES['multipleFiles']['error'] 		= $files['multipleFiles']['error'][$i];
                  $_FILES['multipleFiles']['size'] 		= $files['multipleFiles']['size'][$i];
      
                  $config['upload_path'] 		= './orders_folder/completed_orders';
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
                      $insert[$i]['file_order_id'] = $id_order_complete;
                      $insert[$i]['order_file_name'] = $data['file_name'];
                      $insert[$i]['order_file_status'] = "COMPLETED";
                  }
                  }
                  if($this->db->insert_batch('tbl_orders_files', $insert)){
                      return true;
                  } else{
                      return false;
                  }
                      //end of for loop 
       
    }
    public function my_memo(){
        //get writer's position from db
          $this->db->select(array('writer_position'));
          $this->db->from('tbl_members');
          $this->db->where('writer_id', $this->session->userdata('sess_member_id'));
          $query = $this->db->get();
          $user = $query->row();
        // now fetch memos
        $ambil = $this->db->select(array(`memo_id`, `memo_content`, `memo_time`))
        ->where('memo_audience', $user->writer_position)
        ->get('tbl_memo');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
     
    //upload completed order file    
    public function upload_profile_picture($id){
        // count number of files
        $number_of_files = count($_FILES['profilePicture']['name']);
        // store global files to local variable
        $files = $_FILES;
        // make sure upload folder exists
        if (!is_dir('./profile_pictures')) {
            mkdir('./profile_pictures', 0777, true);
        }
        // upload files one by one
        for($i=0; $i < $number_of_files; $i++){
            $_FILES['profilePicture']['name'] 		= $files['profilePicture']['name'][$i];
            $_FILES['profilePicture']['type'] 		= $files['profilePicture']['type'][$i];
            $_FILES['profilePicture']['tmp_name'] 	= $files['profilePicture']['tmp_name'][$i];
            $_FILES['profilePicture']['error'] 		= $files['profilePicture']['error'][$i];
            $_FILES['profilePicture']['size'] 		= $files['profilePicture']['size'][$i];
            
            $config['upload_path'] 		= './profile_pictures';
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
                    'member_picture' => $new_name
                );
                if($this->db->set($data_two)->where("writer_id", $id)->update("tbl_members", $data_two)){
                    return TRUE;
                }
            }
        }
    }
    //end file upload for loop

    public function file_names(){
        $ambil = $this->db->select(array('order_id'))
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    // hide notification
    public function hide_my_notification($not_id_to){
        $upd_data = array(
            'notification_status' => 1
        );
        if($this->db->set($upd_data)->where("id", $not_id_to)->update("tbl_notifications", $upd_data)){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function get_order_ids(){
        $ambil = $this->db->select(array('order_id'))
        ->where('handler_name', $this->session->userdata('sess_member_name'))
        ->where('order_status', 'ACCEPTED')
        ->or_where('order_status', 'REVISION')
        ->get('tbl_orders');
        if ($ambil->num_rows() > 0) {
            foreach ($ambil->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function md_cal_my_orders(){
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $my_name = $this->session->userdata('sess_member_name');

        $sql = $this->db->query("SELECT COUNT(tbl_orders.id) AS my_orders, SUM(tbl_orders.num_of_pages) AS my_pages, SUM(tot_order_price) AS my_tot_price
        FROM `tbl_orders`
        WHERE order_month = '$last_month' AND order_day >= '$month_start_day' 
        OR order_month = '$this_month' AND order_day < '$month_end_day'
        AND order_status = 'APPROVED'");
              
        return $sql->row_array();
    }

    public function get_writer_order_cost_info(){
           
        $last_month = date('F', (time()-(60*60*24*30)));
        $this_month = date('F');
        $month_start_day = 15;
        $month_end_day = 17;
        $my_name = $this->session->userdata('sess_member_name');
        $my_id = $this->session->userdata('sess_member_id');

        $writer_data = $this->db->query("SELECT COUNT(tbl_orders.id) AS my_orders, SUM(tbl_orders.num_of_pages) AS my_pages,tbl_members.writer_id, writer_name, writer_email, writer_phone_number, writer_active,writer_academic_info,writer_address,member_picture,writer_position,writer_level, SUM(tot_order_price) AS my_tot_price
        FROM `tbl_members`
        JOIN tbl_orders
        ON tbl_members.writer_name = tbl_orders.handler_name
        WHERE
        tbl_orders.handler_name = '$my_name'
        AND
        tbl_members.writer_id = '$my_id'
        AND
        order_month = '$last_month' 
        AND 
        order_day >= '$month_start_day' 
        OR
        order_month = '$this_month' 
        AND 
        order_day < '$month_end_day'
        AND 
        order_status = 'APPROVED'");

        return $writer_data->row_array();
    }
}