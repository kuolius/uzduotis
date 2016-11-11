<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    
    public function __construct(){
        
        parent::__construct();
        $this->load->library(array('form_validation','session','Layout'));
        $this->load->helper(array('url','form'));
        $this->load->model('User_model');
        
    }
    
    public function index()
    {
        if($this->session->userdata('logged_in')==TRUE)
        {
            redirect("/home/index");
        }
        if($this->User_model->logged_in()===TRUE)
        {
            $this->home(TRUE);
        
        }
        else{
            
       
        $this->layout->view('login');
        }

    }
    
    function home($condition=FALSE)
    {
        if($condition===TRUE OR $this->User_model->logged_in()===TRUE)
        {
            redirect('/home/index');
        }
        else{
            redirect('/account/index');
        }
        
    }
    
    function login(){
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[12]|callback_password_check');
        $this->_username=$this->input->post('username');
        $this->_password=sha1($this->input->post('password'));
        
        if($this->session->userdata('logged_in')==TRUE)
        {
            redirect('/home/index');
        }
        
        if($this->form_validation->run()==FALSE)
        {
            $this->layout->view('login');
        }
        else
        {
            $this->User_model->login();
            redirect('/home/index');
        }
    }
    
    function password_check(){
        
        $this->db->where('username',$this->_username);
        $query=$this->db->get('users');
        
        $result=$query->row_array();
        
        if($query->num_rows()==0)
        {
            $this->form_validation->set_message('password_check','No such account exist!');
           
            return FALSE;
        }
        
        if($result['password'] == $this->_password){
            return TRUE;
            
        }
        else
        {
            $this->form_validation->set_message('password_check','Invalid password!');
            
            return FALSE;
        }
        
        
    }
    
    function register()
    {
        $_username=$this->input->post('username');
        $this->form_validation->set_rules('username','Username',"required|callback_user_exist[$_username]");
        $this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('password_conf','Password Confirmation','required|matches[password]');
        if($this->form_validation->run()==FALSE)
        {
            $this->layout->view('register');
        }
        else
        {
            $data['username']=$this->input->post('username');
            $data['password']=sha1($this->input->post('password'));
            $data['role']="user";
            
            if($this->User_model->create($data)===TRUE)
            {
                redirect("/account/index");
            }
            else
            {
                $this->layout->view('errors/index');
            }
        }
    }
    
    function user_exist($user){
        
        $user_match=$this->db->get_where('users',array('username'=>$user));
        
        if($user_match->num_rows()>0){
            $this->form_validation->set_message('user_exist','The %s is in use.');
            return FALSE;
            
        }
        
        $user_match->free_result();
        return TRUE;
    }
    
    
}
