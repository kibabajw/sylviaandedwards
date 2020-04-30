<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function index(){

    }

    public function login($name_email, $password){
        $this->db->select('adm_name_email', 'adm_password');
        $this->db->from('tbl_admin');
    }
}