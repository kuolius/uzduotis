<?php

class User_model extends CI_Model {
    function __construct(){
        
        parent::__construct();
        $this->load->database();
    }
    
    function create($data){
        
        if($this->db->insert('users',$data))
        {
            return TRUE;
        }
        
        return FALSE;
            
    }
    
    function login()
    {
        $username=$this->input->post('username');
        $role=$this->db->select('role')->where('username',$username)->get('users')->result_array();
        $id=$this->db->select('id')->where('username',$username)->get('users')->result_array();
        $data=array(
            'username'=>$username,
            'logged_in'=>TRUE,
            'role'=>$role[0]['role'],
            'id'=>$id[0]['id']
            );
        $this->session->set_userdata($data);
    }
    
    function logged_in()
    {
        if($this->session->userdata('logged_in')==TRUE)
        {
            return TRUE;
        }
        return FALSE;
    }
    
}
