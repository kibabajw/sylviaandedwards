<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->database();
    }
    
    public function index() {
        $data['title'] = "S&E | Home";
        $this->load->view('homepage/home', $data);
    }
    
    public function about_us() {
        $data['title'] = "About Us";
        $this->load->view('homepage/about-us', $data);
    }
    public function our_services() {
        $data['title'] = "Our Services";
        $this->load->view('homepage/our-services', $data);
    }
    public function careers() {
        $data['title'] = "Careers";
        $this->load->view('homepage/careers', $data);
    }
    public function our_team() {
        $data['title'] = "Our-team";
        $this->load->view('homepage/our-team', $data);
    }
    public function contact_us() {
        $data['title'] = "Contact-us";
        $this->load->view('homepage/contact-us', $data);
    }
    public function contact_us_logic(){
        //get data from contact-us form
        $full_name = $this->input->post('sender_name');
        $data_contact_us = array(
            'sender_name' => $full_name,
            'sender_email' => $this->input->post('sender_email'),
            'sender_phone' => $this->input->post('sender_phone'),
            'sender_message' => $this->input->post('sender_message')
        );
        $this->load->model('homepage/Homepage_Model');
        if($this->Homepage_Model->send_message($data_contact_us)){
            if($this->send_contact_us_email($data_contact_us)){
                $this->session->set_flashdata('item_contact_us', 'Thank you for your message, you shall hear from us soon.');
                $data['title'] = "Contact-us";
                $this->load->view('homepage/contact-us', $data);
            }
        } else{
            $this->session->set_flashdata('item_contact_us', 'Error contacting us, try again.');
            $data['title'] = "Contact-us";
            $this->load->view('homepage/contact-us', $data);
        }
        
    }
    public function send_contact_us_email($data_contact_us){
        $this->load->library('email');
		$this->email->from('info@sylviaandedwards.com', 'Sylvia & Edwards');
		$this->email->to('abiero.charles44@gmail.com');
		$this->email->subject('Message from contact-us form');
		$this->email->message($data_contact_us['sender_message']. ' my name is ' .$data_contact_us['sender_name']. ' my email is ' .$data_contact_us['sender_email']. ' and my phone number is ' .$data_contact_us['sender_phone']);
		if ($this->email->send()) {
			return true;
		} else{
			return false;
		}
    }
}