<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_Model extends CI_Model {
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
        $query = $this->db->select(array(`writer_id`, `writer_name`, `member_online`))
        ->where('writer_active', 1)
        ->get('tbl_members');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $contacts[] = $data;
            }
            return $contacts;
        }
    }

    public function md_get_my_msg($to_who){
        $name = $this->session->userdata('sess_admin_name');
        $query = $this->db->query("SELECT * FROM `sae_tbl_chat` 
        WHERE sender_id = '$to_who' AND recipient_id = '$name' 
        OR sender_id = '$name' AND recipient_id = '$to_who'");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $contacts[] = $data;
            }
            return $contacts;
        }
    }
    public function md_other_msg($from_who){
        $query = $this->db->select(array('message', 'timestamp', 'writer_name'))
        ->join('tbl_members', 'sae_tbl_chat.sender_id = tbl_members.writer_name')
        ->where('sender_id', $from_who)
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