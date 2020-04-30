<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Writer_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        
    }
    public function reg_name_email_phone($data){
        if ($this->db->insert('tbl_members', $data)) {
            $insert_id = $this->db->insert_id();
            //get applicant's name from array
            $name = $data['writer_name'];
            //give new admin privileges
            $data_two = array(
                'user_id' => $insert_id,
                'privilege_id' => 1
            );
            if ($this->db->insert('tbl_user_privileges', $data_two)) {                
                    return TRUE;                 
            }
        } else{
            return FALSE;
        }
    }
    public function register($data, $email){
        if($this->db->set($data)->where("writer_email", $email)->update("tbl_members", $data)){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    public function register_upload_resume($name, $email){           
        // count number of files
        $number_of_files = count($_FILES['multipleFiles']['name']);
        // store global files to local variable
        $files = $_FILES;
        // make sure upload folder exists
        if (!is_dir('id_card_and_resume')) {
            mkdir('./id_card_and_resume', 0777, true);
        }
        // upload files one by one
        for($i=0; $i < $number_of_files; $i++){
            $_FILES['multipleFiles']['name'] 		= $files['multipleFiles']['name'][$i];
            $_FILES['multipleFiles']['type'] 		= $files['multipleFiles']['type'][$i];
            $_FILES['multipleFiles']['tmp_name'] 	= $files['multipleFiles']['tmp_name'][$i];
            $_FILES['multipleFiles']['error'] 		= $files['multipleFiles']['error'][$i];
            $_FILES['multipleFiles']['size'] 		= $files['multipleFiles']['size'][$i];
            
            $config['upload_path'] 		= './id_card_and_resume/';
            $config['allowed_types'] 	= 'zip|docx|pdf|ppt|pptx|xls|xlsx|png|jpg|webp';
            $config['max_size'] 		= 0;
            $config['overwrite'] 		= FALSE;
            $config['remove_spaces'] 	= TRUE;
            //create new name for file
           //  $new_file_name = pathinfo($_FILES['multipleFiles']['name'], PATHINFO_FILENAME);
            $ext = pathinfo($_FILES['multipleFiles']['name'], PATHINFO_EXTENSION);
            $resume = "_resume";
            $new_name = $name.$resume.".".$ext;
           //  $new_name = preg_replace('/[,]+/', '-', trim($new_name));
            //rename file to new name created
            $_FILES['multipleFiles']['name'] = $new_name;
            //move file to folder
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('multipleFiles')) {
                $error = array('error' => $this->upload->display_errors());
                return FALSE;
            } else{
                $data = array('upload_data' => $this->upload->data());
                //assign filename global variable to a new variable
                $order_file_name = $_FILES['multipleFiles']['name'];
                //upload order's file's name
                $data_two = array(
                   'writer_resume' => $new_name
               );
               if($this->db->set($data_two)->where("writer_email", $email)->update("tbl_members", $data_two)){
                   return TRUE;
               }
            }
        }
        //end of for loop
   }
    public function register_upload_id_card($name, $email){           
         // count number of files
         $number_of_files = count($_FILES['idcardFile']['name']);
         // store global files to local variable
         $files = $_FILES;
         // make sure upload folder exists
         if (!is_dir('id_card_and_resume')) {
             mkdir('./id_card_and_resume', 0777, true);
         }
         // upload files one by one
         for($i=0; $i < $number_of_files; $i++){
             $_FILES['idcardFile']['name'] 		= $files['idcardFile']['name'][$i];
             $_FILES['idcardFile']['type'] 		= $files['idcardFile']['type'][$i];
             $_FILES['idcardFile']['tmp_name'] 	= $files['idcardFile']['tmp_name'][$i];
             $_FILES['idcardFile']['error'] 		= $files['idcardFile']['error'][$i];
             $_FILES['idcardFile']['size'] 		= $files['idcardFile']['size'][$i];
             
             $config['upload_path'] 		= './id_card_and_resume/';
             $config['allowed_types'] 	= 'zip|docx|pdf|ppt|pptx|xls|xlsx|png|jpg|webp';
             $config['max_size'] 		= 0;
             $config['overwrite'] 		= FALSE;
             $config['remove_spaces'] 	= TRUE;
             //create new name for file
            //  $new_file_name = pathinfo($_FILES['multipleFiles']['name'], PATHINFO_FILENAME);
             $ext = pathinfo($_FILES['idcardFile']['name'], PATHINFO_EXTENSION);
             $resume = "_id_card";
             $new_name = $name.$resume.".".$ext;
            //  $new_name = preg_replace('/[,]+/', '-', trim($new_name));
             //rename file to new name created
             $_FILES['idcardFile']['name'] = $new_name;
             //move file to folder
             $this->upload->initialize($config);
             if (!$this->upload->do_upload('idcardFile')) {
                 $error = array('error' => $this->upload->display_errors());
                 return FALSE;
             } else{
                 $data = array('upload_data' => $this->upload->data());
                 //assign filename global variable to a new variable
                 $order_file_name = $_FILES['idcardFile']['name'];
                 //upload order's file's name
                 $data_two = array(
                    'writer_id_card' => $new_name
                );
                if($this->db->set($data_two)->where("writer_email", $email)->update("tbl_members", $data_two)){
                    return TRUE;
                }
             }
         }
         //end of for loop
    }
    public function check_email_phone($email){
        $this->db->where('writer_email', $email);       
        $query = $this->db->get('tbl_members');
        $row = $query->row();   
        
        if ($query->num_rows() === 1) {
           return FALSE;
        } else {
            return TRUE;
        }
    }
    public function can_login(){
        $this->db->select(array(`writer_id`, `writer_name`, `writer_phone_number`, `writer_email`, `writer_password`));
        $this->db->where('writer_name', $this->input->post('writer_login_name'));
        $this->db->or_where('writer_email', $this->input->post('writer_login_name'));
        $this->db->limit(1);
        
        $query = $this->db->get('tbl_members');
        $row = $query->row();
        
        if ($query->num_rows() === 1 && $row->writer_active == 1) {
                if (password_verify($this->input->post('writer_login_password'), $row->writer_password)) {
                    $data = array(
                        'sess_member_id' => $row->writer_id,
                        'sess_member_name' => $row->writer_name,
                        'logged_id' => TRUE
                    );
                    $this->session->set_userdata($data);
                    //set online token
                    $online_token = array(
                        'writer_online' => md5($row->writer_id)
                    );
                    $this->db->set($online_token);
                    $this->db->where("writer_id", $row->writer_id);
                    $this->db->update("tbl_members", $online_token);
                    
                    return "CAN_LOG_IN";
                } else if (!password_verify($this->input->post('writer_login_password'), $row->writer_password)) {
                    return "PASSWORD_ERROR";
                }
        } else  if ($query->num_rows() === 0){
            return "NULL_WRITER";
        } else if ($query->num_rows() === 1 && $row->writer_active == 0){
            return "CANNOT_LOG_IN";
        }
    }
    public function is_user_active($params) {
        $this->db->where('writer_name', $params['name']);
        $this->db->limit(1);        
        $query = $this->db->get('tbl_members');
        $row = $query->row();
        
        if ($query->num_rows() == 1) {
            if (password_verify($params['password'], $row->writer_password)) {
                if ($row->writer_active == 1) {
                    return TRUE;
                } else if($row->writer_active == 0){
                    return FALSE;
                }
            }
        }
    }
    //set reset code to database
    public function upload_reset_code($writer_email, $reset_code){
        //check if email exists
        $this->db->where('writer_email', $writer_email);
        $this->db->limit(1);        
        $query = $this->db->get('tbl_members');
        
        if ($query->num_rows() == 1) {
             //insert resetcode
            $data = array(
                'reset_code' => $reset_code
            );
            $this->db->set($data);
            $this->db->where('writer_email', $writer_email);
            $this->db->update('tbl_members', $data);
            
            if($this->db->affected_rows() >=0){
                return "CODE_INSERTED";
            }else{
                return "NOT_INSERTED";
            }
        } else{
            return "EMAIL_NOT_EXIST";
        }
       
          
    }
    public function confirm_code($code_data){   
                
        $this->db->where('writer_email', $code_data['email']);
        $this->db->where('reset_code',   $code_data['code']);
          
        $query = $this->db->get('tbl_members');
        $row = $query->row();
       
        if ($query->num_rows() === 1) {
            return TRUE;
        } else{
            return FALSE;
        }    
        
    }
    public function new_password($new_pass){
        $this->db->set($new_pass);
        $this->db->where('writer_email', $this->session->userdata('email'));
        $this->db->update('tbl_members', $new_pass);
        
        if($this->db->affected_rows() >=0){
            return TRUE;
        }else{
            return FALSE;
        }       
    }
    
}