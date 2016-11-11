<?php

class Home extends CI_Controller {
    
    public function __construct(){
        
        parent::__construct();
        $this->load->library(array('form_validation','session','Layout'));
        $this->load->helper(array('form','url'));
        $this->load->database();
       
    }
    
    function index($page=0)
    {
        if($this->session->userdata('logged_in')==TRUE)
        {
            $data=array('role' =>$this->session->userdata('role'));
            
            if($data['role']=='user'){
                $id=$this->session->userdata('id');
                $query=$this->db->select('completed,description,id')->where('user',$id)->get('task');
                $len=$query->num_rows();
                $pages=(int)($len/10);
                if($query->num_rows()%10!=0) {$pages=$pages+1;}
                if($page>$pages-1 || $page<0){ $page=0;}
                
                $data['tasks']=$query->result_array();
                $data['tasks']=array_slice($data['tasks'],10*$page,10);
                $data['pages']=$pages;
                $data['page']=$page;
            
                
                }
            else if($data['role']=='admin')
            {
                $query=$this->db->select('completed,description,user,username,id')->get('task');
                $len=$query->num_rows();
                $pages=(int)($len/10);
                if($query->num_rows()%10!=0) {$pages=$pages+1;}
                if($page>$pages-1 || $page<0){ $page=0;}
                
                $data['tasks']=$query->result_array();
                $data['pages']=$pages;
                $data['page']=$page;
                
                $data['tasks']=array_slice($data['tasks'],10*$page,10);
                
 
            }
            $this->layout->view('home',$data);
        }
        else{
            redirect('/account/login');
        }
        
    }
    
    function check_completed(){
        if($this->session->userdata('role')!="user")
        {
            $this->layout->view('home');
        }
        else
        {
            foreach( $this->input->post("completed") as $check)
            {
                $this->db->set('completed',1);
                $this->db->where('id',$check);
                $this->db->update('task');
                
            }
                
            redirect("/home/index/".$this->input->post('page'));
        }
    }
    
    
    function create(){
        if($this->session->userdata('role')!="admin")
        {
            $this->layout->view('home');
        }
        else
        {
            $data['pages']=$this->input->get('pages');
            $this->layout->view('create',$data);
        }
    }

    function new_task(){
        if($this->session->userdata('role')=="admin")
        {
            $this->db->set('description',$this->input->post('description'));
            $this->db->insert('task');
            $page=$this->input->post('pages')-1;
            redirect("/home/index/".$page);
        }
    }

    function delete(){
        if($this->session->userdata('role')=="admin")
        {
         $id=$this->input->get('id');
         $this->db->where('id',$id)->delete('task');
         redirect("/home/index/".$this->input->get('page'));

        }
    }

    function edit(){
        if($this->session->userdata('role')=="admin")
        {
        $id=$this->input->get('id');
       
        $description=$this->db->where('id',$id)->select('description')->get('task')->result_array();
        $data=array('description' =>$description[0]['description'],'id'=>$id,'page'=>$this->input->get('page'));
        $this->layout->view('edit',$data);
        }
    }

    function update_task(){
        if($this->session->userdata('role')=="admin")
        {
            $this->db->set('description',$this->input->post('description'));
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('task');
            redirect("/home/index/".$this->input->post('page'));
        }

    }
    function assign(){

        if($this->session->userdata('role')=="admin")
        {
            $id=$this->input->get('id');
            
            $description=$this->db->select('description')->where('id',$id)->get('task')->result_array();
            $data['id']=$id;
            $data['page']=$this->input->get('page');
            $data['description']=$description[0]['description']; 
            $this->layout->view('assign',$data);
        }
    }

    function add_assignment(){
        if($this->session->userdata('role')=="admin")
        {
        $username=$this->input->post('username');
        $this->form_validation->set_rules('username','username',"callback_find_user[$username]");

        if($this->form_validation->run()==FALSE)
        {
            $data['id']=$this->input->post('id');
            $data['description']=$this->input->post('description');
            $data['page']=$this->input->post('page');
            $this->layout->view("assign",$data);
        }
        else
        {
            $id=$this->db->select('id')->where('username',$username)->get('users')->result_array()[0]['id'];

            $this->db->set('user',$id);
            $this->db->set('completed',0);
            $this->db->set('username',$username);
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('task');
            redirect("/home/index/".$this->input->post('page'));
        }


        }
    }

    function find_user($username){
        if($this->session->userdata('role')=="admin")
        {
            $found=$this->db->where('username',$username)->where('role','user')->get("users");
            if($found->num_rows()==0)
            {
                $this->form_validation->set_message('find_user','Cannot find user with that username!');
                return FALSE;
            }

            return TRUE;

        }
    }
        
    
    function logout(){
        $this->session->sess_destroy();
        redirect('/account/index');
    }
}
