<?php

class Layout {
    
    private $CI;
    
    public function __construct() {
        $this->CI=&get_instance();
    }
    
    
    
    public function view($middle,$data=array())
    {
        
        $template['middle']=$this->CI->load->view($middle,$data,true);
        $this->CI->load->view('layout/index',$template);
    }
}
