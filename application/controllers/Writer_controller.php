<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Writer_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('writer/Writer_Model');
    }
    public function index(){
        
    }
    public function load_register_form(){
        $this->load->view('writer/writer_register_form');
    }
    public function load_login_form(){
        $this->load->view('writer/writer_login_form');
    }
    public function register(){
        if ($this->form_validation->run() == FALSE){
            $this->load->view('writer/writer_register_form');
        } else {
            //add user input data-set to array
            $data = array(
                'member_name' => $this->input->post('reg_member_name'),
                'member_phone_number' => $this->input->post('reg_member_phone_number'),
                'member_email' => $this->input->post('reg_member_email'),
                'member_password' => password_hash($this->input->post('reg_admin_password'), PASSWORD_BCRYPT)
                
            );
            //pass insert data to model for db insert
            $this->Writer_Model->register($data);
            $data['records'] = 'Member created succesfully';
            $this->load->view('writer/writer_success', $data);

            $result = $this->Writer_Model->check_email_phone($data);
            if ($result) {
                $data['err_msg'] = "Registration complete";
                $this->load->view('writer/writer_register_form');
            } else {
                $data['err_msg'] = "The email entered is in use";
                $this->load->view('writer/writer_register_form');
            }
        }
    }
    public function check_email(){
        $email = $this->input->post('reg_member_email');
        if($this->Writer_Model->check_email_phone($email)){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_email', 'Email in use, enter a different email-address');
            return FALSE;
        }
        
    }
    public function login(){
        
    }
    public function lost_password(){
        
    }
    public function logout(){
        
    }
}