<?php 

class Admin_Model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function insert($data){
        if ($this->db->insert('tbl_admin', $data)) {
            $insert_id = $this->db->insert_id();
            //give new admin privileges
            $data_two = array(
                'admin_id' => $insert_id,
                'privilege_id' => 1
            );
            if ($this->db->insert('tbl_admin_privileges', $data_two)) {
                return TRUE; 
            }
        }
        return FALSE;
    }
    
    public function can_login() {
        $this->db->select(array(`admin_id`, `admin_name`, `admin_password`));
        $this->db->where('admin_name', $this->input->post('adm_login_name'));
        $this->db->or_where('admin_email', $this->input->post('adm_login_name'));
        $this->db->where_not_in('admin_status', 0);
        $this->db->limit(1);
        
        $query = $this->db->get('tbl_admin');
        $row = $query->row();
        
        if ($query->num_rows() === 1) {
            if (password_verify($this->input->post('adm_login_password'), $row->admin_password)) {
                    $data = array(
                        'sess_admin_id' => $row->admin_id,
                        'sess_admin_name' => $row->admin_name,
                        'logged_id' => TRUE
                    );
                    $this->session->set_userdata($data);
                    
                    //set online token
                    $online_token = array(
                        'admin_online' => md5($row->admin_id)
                    );
                    $this->db->set($online_token);
                    $this->db->where("admin_id", $row->admin_id);
                    $this->db->update("tbl_admin", $online_token);
                                        
                    return TRUE;
            }
        } else {
            return FALSE;
        }
    }
        //set reset code to database
        public function upload_reset_code($admin_email, $reset_code){
            //check if email exists
            $this->db->where('admin_email', $admin_email);
            $this->db->limit(1);        
            $query = $this->db->get('tbl_admin');
            
            if ($query->num_rows() == 1) {
                 //insert resetcode
                $data = array(
                    'admin_pass_reset_code' => $reset_code
                );
                $this->db->set($data);
                $this->db->where('admin_email', $admin_email);
                $this->db->update('tbl_admin', $data);
                
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
        $this->db->where('admin_email', $code_data['adm_reset_email']);
        $this->db->where('admin_pass_reset_code',   $code_data['admin_reset_code']);
          
        $query = $this->db->get('tbl_admin');
        $row = $query->row();
       
        if ($query->num_rows() === 1) {
            return TRUE;
        } else{
            return FALSE;
        }    
        
    }
    public function new_password($new_pass){
        $this->db->set($new_pass);
        $this->db->where('admin_email', $this->session->userdata('sess_adm_reset_email'));
        $this->db->update('tbl_admin', $new_pass);
        
        if($this->db->affected_rows() >=0){
            return TRUE;
        }else{
            return FALSE;
        }       
    }
    public function get_admin_info(){
        $query = $this->db->select(array('admin_name','admin_email','admin_password'))
        ->where('admin_id', $this->session->userdata('sess_admin_id'))
        ->limit(1)
        ->get('tbl_admin');
        //return data from db
        return $query->row_array();
    }
    
}