<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Writer_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','form_validation','upload'));
        $this->load->model('writer/Auth_Writer_Model');
        $this->load->helper('date');
    }
    public function index(){
        if ($this->session->userdata('sess_member_id')) {
            //send data to view
            $this->load->view('writer/dashboard');
        } else {
            $this->load_login_form();
        }
    }
    public function load_register_form(){
        $this->load->view('writer/writer_register_form');
    }
    public function load_login_form(){
        $this->load->view('writer/writer_login_form');
    }
    public function reg_name_email_phone(){
        if ($this->form_validation->run() == FALSE){
            //store user data in session for use
            $data = array(
                'sess_writer_reg_name' => $this->input->post('reg_writer_name'),
                'sess_writer_reg_email' => $this->input->post('reg_writer_email'),
                'logged_id' => TRUE
            );
            $this->session->set_userdata($data);

            //add user input data-set to array
            $data = array(
                'writer_name' => $this->input->post('reg_writer_name'),
                'writer_phone_number' => $this->input->post('reg_writer_phone_number'),
                'writer_email' => $this->input->post('reg_writer_email')                
            );
            //pass insert data to model for db insert
            if ($this->Auth_Writer_Model->reg_name_email_phone($data)) {
                return true;
            } else {
                return false;
            }
            
        } else {
            echo "Fill all the fields";
        }
    }
    public function reg_resume(){
        $sess_name = $this->session->userdata('sess_writer_reg_name');
        $sess_email = $this->session->userdata('sess_writer_reg_email');
        if ($this->Auth_Writer_Model->register_upload_resume($sess_name, $sess_email)) {
            return true;
        } else {
            return false;
        }   
    }
    public function reg_id_card(){
        $sess_name = $this->session->userdata('sess_writer_reg_name');
        $sess_email = $this->session->userdata('sess_writer_reg_email');
        if ($this->Auth_Writer_Model->register_upload_id_card($sess_name, $sess_email)) {
            return true;
        } else {
            return false;
        }   
    }
    public function register(){
        if ($this->form_validation->run() == FALSE){
            //add user input data-set to array
            $data = array(
                'writer_password' => password_hash($this->input->post('reg_writer_password'), PASSWORD_BCRYPT)
                
            );
            //pass insert data to model for db insert
           $result =  $this->Auth_Writer_Model->register($data, $this->session->userdata('sess_writer_reg_email'));
            if ($result) {
                if ($this->send_acknowledgement_mail()) {
                    $this->session->unset_userdata('sess_writer_reg_name');
                    $this->session->unset_userdata('sess_writer_reg_email');
                    $this->session->sess_destroy();
                    echo "Registration complete, we shall communicate through the email-address you used  ".anchor('Home', 'back home', 'class="text-primary"');
                } 
            } else {
                echo "An error occured";
            }
        } else {
            echo "Fill all the fields";
        }
    }
    public function send_acknowledgement_mail(){
        $this->load->library('email');
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($this->session->userdata('sess_writer_reg_email'));
		$this->email->subject('Application acknowledgment');
		$this->email->message('Thank you for your interest to work for Sylvia & Edwards Research Consultancy, our team shall get back to you after going through your application.');

		if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    public function check_email(){
        $email = $this->input->post('reg_member_email');
        if($this->Auth_Writer_Model->check_email_phone($email)){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_email', 'Email in use, enter a different email-address');
            return FALSE;
        }
        
    }
    public function login(){
        if ($this->form_validation->run() == FALSE){
            $this->load->view('writer/writer_login_form');
        } else {
            $result = $this->Auth_Writer_Model->can_login();            
            if($result == 'CAN_LOG_IN'){
                echo "can log in";
                //redirect user to profile page
                $this->load_writer_dashboard();
                
                //this below shows message for success
//                 return $this->output
//                      ->set_content_type('application/json')
//                      ->set_status_header(200)
//                      ->set_output(json_encode(array(
//                                  'text' => 'Cleared to login',
//                                  'code' => 1
//                 )));
                     
            } else if($result == 'NULL_WRITER'){               
                $this->session->set_flashdata('item', 'User does not exist.');
                $this->load->view('writer/writer_login_form');
                
                //this below shows message for incorrect message
//                 return $this->output
//                 ->set_content_type('application/json')
//                 ->set_status_header(201)
//                 ->set_output(json_encode(array(
//                     'text' => 'User does not exist.',
//                     'code' => 0
//                 )));
                
            } else if($result == 'PASSWORD_ERROR'){
                $this->session->set_flashdata('item', 'Incorrect credentials given.');                
                $this->load->view('writer/writer_login_form');
                
                //this below shows message for incorrect message
//                 return $this->output
//                 ->set_content_type('application/json')
//                 ->set_status_header(201)
//                 ->set_output(json_encode(array(
//                     'text' => 'Incorrect credentials given.',
//                     'code' => 1
//                 )));
                
            } else if($result == 'CANNOT_LOG_IN'){
                $this->session->set_flashdata('item', 'Your application is under consideration.');                
                $this->load->view('writer/writer_login_form');
                
                //this below shows message for inactive writer
//                 return $this->output
//                        ->set_content_type('application/json')
//                        ->set_status_header(201)
//                        ->set_output(json_encode(array(
//                                     'text' => 'Your application is under consideration.',
//                                     'code' => 0
//                  )));
                       
            }
            
        }
    }
    public function load_writer_dashboard(){
        redirect('writer/Writer_Dashboard_Controller');
    }
    public function check_if_active($str){
         $query = "select * from tbl_members where writer_name = ?";
         $arg = array($str);
         $exec = $this->db->query($query, $arg) or die(mysql_error());
         $row = $exec->row();
         
         if ($exec->num_rows() > 0){
             $this->form_validation->set_message('check_if_active', 'You are in');
             return TRUE;
         }
     }
     public function load_lost_password(){
        $data['title'] = "Reset password";
        $this->load->view('writer/lost_password', $data);
    }
    public function reset_password(){
        if ($this->form_validation->run() == FALSE){
            $data['title'] = "Reset password";
            $this->load->view('writer/lost_password', $data);
        } else {
            $writer_email = $this->input->post('writer_reset_email');
            // generate random string to send to writer for reset
            $keyLen = 5;
            $str = "1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
            $reset_code = substr(str_shuffle($str), 0, $keyLen);
            //send reset code to db first
            $check_code = $this->Auth_Writer_Model->upload_reset_code($writer_email, $reset_code);
            if ($check_code == 'CODE_INSERTED') {
                 //save email and resetcode to session
                 $data = array(
                    'email' => $writer_email,
                    'code'  => $reset_code
                );
                $this->session->set_userdata($data);
                if ($this->send_reset_code_email($writer_email, $reset_code)) {
                    $this->session->set_flashdata('confirm_code', 'Enter the code sent to '.$writer_email);
                    $this->session->set_flashdata('res_code', $reset_code);
                    $this->session->set_flashdata('res_email', $writer_email);
                    $this->confirm_code_view();

                   
                } else{
                    $this->session->set_flashdata('reset_pass', 'Error sending email');
                    $data['title'] = "Reset password";
                    $this->load->view('writer/lost_password', $data);
                }
            } else if($check_code == 'NOT_INSERTED'){
                $this->session->set_flashdata('reset_pass', 'An error occured, try again.');
                $data['title'] = "Reset password";
                $this->load->view('writer/lost_password', $data);
            } else if($check_code == 'EMAIL_NOT_EXIST'){
                $this->session->set_flashdata('reset_pass', 'That email does not exist');
                $data['title'] = "Reset password";
                $this->load->view('writer/lost_password', $data);
            }
        }
    }
    public function send_reset_code_email($writer_email, $reset_code){
        $this->load->library('email');

		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to($writer_email);
		$this->email->subject('Email reset code');
		$this->email->message('Enter this reset code to reset your password ' .$reset_code);

		if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
    public function confirm_code_view(){
        $data['title'] = "Confirm reset code";
        $this->load->view('writer/confirm_reset_code', $data);
    }
    public function confirm_reset_code(){    

            $code_data = array(
                'email' => $this->session->userdata('email'),
                'code'  => $this->input->post('writer_reset_code')
            );   
        
            if($this->Auth_Writer_Model->confirm_code($code_data)){
                $data['title'] = "New password";
                $this->load->view('writer/new_password', $data);
            }  else{
                $this->session->set_flashdata('confirm_code', 'Incorrect reset code');
                $data['title'] = "Confirm reset code";
                $this->load->view('writer/confirm_reset_code', $data);
            }

    }
    public function new_password(){
        $new_pass = array(
            'writer_password' => password_hash($this->input->post('writer_new_pass'), PASSWORD_BCRYPT)
        );

        if ($this->Auth_Writer_Model->new_password($new_pass)) {
            $this->session->unset_userdata('email');
            $this->session->sess_destroy();
            $this->session->set_flashdata('new_pass', 'Password has been changed    '." ".anchor('writer/Auth_Writer_Controller/load_login_form', 'Login to your account', 'class="text-primary"'));
            $data['title'] = "Complete";
            $this->load->view('writer/new_password', $data);
        } else{
            $this->session->set_flashdata('new_pass', 'Could not reset password, try again');
            $data['title'] = "Complete";
            $this->load->view('writer/new_password', $data);
        }
    }
  
}