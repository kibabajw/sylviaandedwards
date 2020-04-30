<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Writer_Chat_Model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function index(){

    }
    public function md_insert_msg($message_data){
        if ($this->db->insert('sae_tbl_chat', $message_data)) {
            return TRUE;
        }
        return FALSE;
    }
    public function md_contacts(){
        $query = $this->db->select(array(`admin_id`, `admin_name`, `admin_online`))
        ->where('admin_status', 1)
        ->get('tbl_admin');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $contacts[] = $data;
            }
            return $contacts;
        }
    }

    public function writer_contacts(){
        $query = $this->db->select(array(`writer_id`, `writer_name`))
        ->where('writer_active', 1)
        ->get('tbl_members');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $contacts[] = $data;
            }
            return $contacts;
        }
    }

    public function md_get_my_msg($from_who){
        $name = $this->session->userdata('sess_member_name');
        $sql = $this->db->query("SELECT * FROM `sae_tbl_chat` 
                WHERE sender_id = '$from_who' AND recipient_id = '$name' 
                OR sender_id = '$name' AND recipient_id = '$from_who'");
        if($sql->num_rows() > 0){
            foreach ($sql->result() as $data) {
                $messages[] = $data;
            }
            return $messages;
        }
    }
    public function md_send_msg(){
        $query = $this->db->select(array('message', 'timestamp', 'writer_name'))
        ->join('tbl_members', 'sae_tbl_chat.user_id = tbl_members.writer_id')
        ->where('user_id', $this->session->userdata('sess_member_id'))
        ->where('recipient_id', 'admin')
        ->get('sae_tbl_chat');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $contacts[] = $data;
            }
            return $contacts;
        }
    }
}