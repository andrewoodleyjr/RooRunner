<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of check
 *
 * @author GOI LLC
 */
abstract class check extends CI_Controller {
    
    public $session_data;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('general_library');
        $gl = new general_library();
        $this->load->library('session');
        //$this->session->unset_userdata('checkout');
        $session = $gl->isLoggedInCustomer();
        if($session != false):
            $this->session_data = $session;
        else:
            $this->load->helper('url');
            redirect("/logout/", 'refresh');
        endif;
    }
    
    protected function error($message){
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
