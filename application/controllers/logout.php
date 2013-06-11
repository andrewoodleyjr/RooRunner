<?php

class logout extends CI_Controller{
    
    public function index(){
        try
       {
        $this->load->library('session');
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('/', 'refresh');
       }
       catch(Exception $e)
       {
            $this->error($e->getMessage());
       } 
    }
        private function error($message){
            $login = array();
            $header = array();
            $header['title'] = 'error';
            $login['message'] = $message;
            $header['stylesheets'] = '<link href="/scripts/css/main.css" rel="stylesheet" media="all" type="text/css" />';
            $this->load->view('header', $header);
            $this->load->view('menu');
            $this->load->view('thankyou', $login);
            $this->load->view('footer');
    }
}


?>
