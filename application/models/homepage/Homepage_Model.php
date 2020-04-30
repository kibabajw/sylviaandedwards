<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_Model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function index(){

    }
    public function send_message($data_contact_us){
        if ($this->db->insert('tbl_contact_us', $data_contact_us)) {             
                return TRUE;                 
        } else{
                return FALSE;
        }
    }
}