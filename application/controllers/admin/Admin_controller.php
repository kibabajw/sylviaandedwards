<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('admin/Admin_Model');
    }
    
    public function index() {
        if ($this->session->userdata('sess_admin_id')) {
            //send data to view
            redirect('admin/dashboard_controller');
        } else {
            $this->admin_login_view();
        }
    }
    public function register() {
        if ($this->form_validation->run() == FALSE){
            // $this->load->view('admin_register_form');
        } else {     
            //add user input data-set to array
            $data = array(
                'admin_name' => $this->input->post('reg_admin_name'),
                'admin_email' => $this->input->post('reg_admin_email'),
                'admin_password' => password_hash($this->input->post('reg_admin_password'), PASSWORD_BCRYPT)
                
            );
            //check if data is complete
            if(count(array_filter($data)) == count($data)) {
                 //pass insert data to model for db insert
                if($this->Admin_Model->insert($data)){
                    echo 'New admin created succesfully';
                } else {
                    echo 'Could not create new admin';
                }
            } else{
                echo 'Please enter all the fields';
            }
            
        }
    }
    
    public function admin_login_view(){
        $this->load->view('admin_login_form');
    }
    
    public function login(){        
        //validate user-input
        if ($this->form_validation->run() == FALSE){
                $this->load->view('admin_login_form');
            } else {
                if ($this->Admin_Model->can_login() && $this->session->userdata('sess_admin_id')) {                    
                        redirect('admin/dashboard_controller');                    
                } else {
                    $this->session->set_flashdata('admin_login', 'Cannot login.');
                    $this->load->view('admin_login_form');
                }
            }
    }
    
    public function dashboard(){
        if ($this->session->userdata('sess_admin_id')) {
            $data['records'] = $this->Admin_Model->get_admin_info();
            $data['title'] = 'Admin dashboard';
            //send data to view
            $this->load->view('admin/dashboard', $data);
        } else {
            $this->load->view('admin/restricted');
        }
    }
    public function lost_password(){
        $data['title'] = 'Admin lost password';
        $this->load->view('admin/fragments/lost_password', $data);
    }
    public function reset_password(){
        if ($this->form_validation->run() == FALSE){
            $data['title'] = 'Admin lost password';
            $this->load->view('admin/fragments/lost_password', $data);
        } else {
            $admin_email = $this->input->post('admin_reset_email');
            // generate random string to send to writer for reset
            $keyLen = 5;
            $str = "1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
            $reset_code = substr(str_shuffle($str), 0, $keyLen);
            //send reset code to db first
            $check_code = $this->Admin_Model->upload_reset_code($admin_email, $reset_code);
            if ($check_code == 'CODE_INSERTED') {
                 //save email and resetcode to session
                 $data = array(
                    'sess_adm_reset_email' => $admin_email,
                    'sess_adm_reset_code'  => $reset_code
                );
                $this->session->set_userdata($data);
                if ($this->send_reset_code_email($admin_email, $reset_code)) {
                    $this->session->set_flashdata('admin_confirm_code', 'Enter the code sent to '.$admin_email);
                    $this->session->set_flashdata('res_code', $reset_code);
                    $this->session->set_flashdata('res_email', $admin_email);
                    $this->confirm_code_view();
                } else{
                    $this->session->set_flashdata('admin_reset_email', 'Eror sending email');
                    $data['title'] = 'Admin lost password';
                    $this->load->view('admin/fragments/lost_password', $data);
                }
            } else if($check_code == 'NOT_INSERTED'){
                $this->session->set_flashdata('admin_reset_email', 'An error occured, try again.');
                $data['title'] = 'Admin lost password';
                $this->load->view('admin/fragments/lost_password', $data);
            } else if($check_code == 'EMAIL_NOT_EXIST'){
                $this->session->set_flashdata('admin_reset_email', 'That email does not exist');
                $data['title'] = 'Admin lost password';
                $this->load->view('admin/fragments/lost_password', $data);
            }
        }
    }
    public function confirm_code_view(){
        $data['title'] = "Confirm reset code";
        $this->load->view('admin/fragments/confirm_reset_code', $data);
    }
    public function confirm_reset_code(){  
        $code_data = array(
            'adm_reset_email' => $this->session->userdata('sess_adm_reset_email'),
            'admin_reset_code'  => $this->input->post('admin_reset_code')
        );   
    
        if($this->Admin_Model->confirm_code($code_data)){
            $data['title'] = "Admin New password";
            $this->load->view('admin/fragments/new_password', $data);
        }  else{
            $this->session->set_flashdata('admin_confirm_code', 'Incorrect reset code');
            $data['title'] = "Confirm reset code";
            $this->load->view('admin/fragments/confirm_reset_code', $data);
        }

    }
    public function new_password(){
        $new_pass = array(
            'admin_password' => password_hash($this->input->post('admin_new_pass'), PASSWORD_BCRYPT)
        );

        if ($this->Admin_Model->new_password($new_pass)) {
            $this->session->unset_userdata('sess_adm_reset_email');
            $this->session->unset_userdata('sess_adm_reset_code');
            $this->session->sess_destroy();
            $this->session->set_flashdata('adm_new_pass', 'Password has been changed    '." ".anchor('admin/admin_controller/admin_login_view', 'Login to your account', 'class="text-primary"'));
            $data['title'] = "Complete";
            $this->load->view('admin/fragments/new_password', $data);
        } else{
            $this->session->set_flashdata('adm_new_pass', 'Could not reset password, try again');
            $data['title'] = "Complete";
            $this->load->view('admin/fragments/new_password', $data);
        }
    }
    public function send_reset_code_email($admin_email, $reset_code){
        $this->load->library('email');
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($admin_email);
		$this->email->subject('Email reset code');
		$this->email->message('Enter this reset code to reset your password ' .$reset_code.' the code shall be deleted after 24 hours.');
        if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    public function logout(){
        $this->session->unset_userdata('sess_admin_id');
        $this->session->sess_destroy();
        redirect('admin/admin_controller/admin_login_view');
    }
    
    
}