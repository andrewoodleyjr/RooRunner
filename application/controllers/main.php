<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author GOI LLC
 */
class main extends CI_Controller{

    private $form_errors = '';
    
public $_menu = '<li ><a href="/" style="color:">Sign In</a></li>';
    

    public function __construct(){
        parent::__construct();
        $this->load->library('general_library');
        $gl = new general_library();
        $session = $gl->isLoggedInCustomer();
        if($session !== false):
            $this->load->helper('url');
            redirect('/manage/', 'refresh');
            return true;
        endif;
        
    }
    
        public function forgetpassword(){
        try{
		
            $login = array();
            $header = array();
            $header['title'] = 'Forgot Password &middot; Shwcase';
            $post = $this->input->post();
            if (isset($post['submit'])):


                $this->load->library('form_validation');
                $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
                if ($this->form_validation->run() == false):
                    
                    $header['stylesheets'] = '<link href="/scripts/css/main2.css" rel="stylesheet" media="all" type="text/css" />';
                    $this->load->view('header', $header);
                    $this->load->view('menu');
                    $this->load->view('main/forgetpassword');
                    $this->load->view('footer');
                    return;
                endif;

                $this->load->model('model_users');
                $Success = $this->model_users->forgetPassword();
                if (!$Success)://return to the form if email and password are not valid
                    $login['message'] = "<div class=\"alert alert-error\">No Email Matched Your Record.</div>";
                else:
                    $login['message'] = "<div class=\"alert alert-success\">A new password as been sent to your email.</div>";
                endif;


                $header['stylesheets'] = '<link href="/scripts/css/main2.css" rel="stylesheet" media="all" type="text/css" />';
                $this->load->view('header', $header);
                $this->load->view('menu');
                $this->load->view('main/forgetpassword', $login);
                $this->load->view('footer');
                return;


            else:
                $header = array();
                $header['stylesheets'] = '<link href="/scripts/css/main2.css" rel="stylesheet" media="all" type="text/css" />';
                $this->load->view('header', $header);
                $this->load->view('menu');
                $this->load->view('main/forgetpassword');
                $this->load->view('footer');
            endif;

           }
           catch(Exception $e){
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
    
    public function confirm($user, $random){
         try{
         $this->load->model('model_users');
         $mu = new model_users();
         $mu->confirm_registration($user, $random);
        $this->showThankPage("You have successfully been confirmed.");
         }
         catch(Exception $e)
         {
             $this->error($e->getMessage());
         }
    }
    
    
    
    public function index(){
           $this->showLogin();
    }
    
    private function showRegister(){
             $header = array();
              $errors = $this->form_errors;
              if($errors != ''):
                  $errors = "<div class='alert alert-danger'>". $this->form_errors . "</div>";
              endif;
              $footer = array();
              $footer['js'] = "<script src='/scripts/js/manage_createApp.js' type='text/javascript' ></script>";
              $header['stylesheets'] = '<link href="/scripts/css/main2.css" rel="stylesheet" media="all" type="text/css" />';

              $menu = array();
             $menu['menu'] = $this->_menu;
              $login = array('error' => $errors);
              $this->load->view('header', $header);
              $this->load->view('menu', $menu);
              $this->load->view('main/register', $login);
              $this->load->view('footer', $footer);

    }
    
    private function showThankPage($message){
              $header = array();
              $thankyou = array('message' => $message);
              $header['stylesheets'] = '<link href="/scripts/css/main2.css" rel="stylesheet" media="all" type="text/css" />';
              $this->load->view('header', $header);
              $this->load->view('menu');
              $this->load->view('thankyou', $thankyou);
              $this->load->view('footer');
    }
    
    
    private function showLogin(){
              $header = array();
              $errors = $this->form_errors;
              if($errors != ''):
                  $errors = "<div class='alert alert-danger'>". $this->form_errors . "</div>";
              endif;
              $login = array('error' => $errors);
              $header['stylesheets'] = '<link href="/scripts/css/main2.css" rel="stylesheet" media="all" type="text/css" />';
              $this->load->view('header', $header);
              $this->load->view('menu');
              $this->load->view('main/login', $login);
              $this->load->view('footer');
    }
	
    public function register(){
     try
       {
         $post = $this->input->post();
         if(isset($post['submit'])):
             $this->load->model('model_users');
             $mu = new model_users();
             $check_form = $mu->check_register_form();
                if($check_form == 'True'):
                    $isRegister = $mu->register();
                    if($isRegister):
                        
						//$this->showThankPage("Thank you for registering, you should recieve an email in the next few minutes.");
						//Replaced above code with an automatic login method so they no longer need to confirm their email.
						//They go in an start creating their app immediately!
						$this->login();
                        return true;
                    else:
                        $this->error("There was an error in register you, please contact support.");
                        return false;
                    endif;
                    else:
                    $this->error($check_form);
                    return false;
                endif;
             else:
             $this->showRegister();
             return true;
         endif;
       }
       catch(Exception $e)
       {
            $this->error($e->getMessage());
       }   
    }
    
    
    public function login()
    {
       try
       {
           $post = $this->input->post();
           if(isset($post['submit'])):
               if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)):
                   $this->form_errors = "Please enter a valid email address.";
                   $this->showLogin();
                   return false;
                   else:
                   $this->load->model('model_users');
                   $valid = $this->model_users->validateUser();
                   
				   //Checks is user information is valid
                   if($valid):
	
					   $this->load->helper('url');
                       redirect('/manage/', 'refresh');
                       return false;
                       else:
                           $this->form_errors = "Email and password does not match";
                           $this->showLogin();
                           return false;
					
                   endif;
               endif;
               else:
               $this->showLogin();
               return true;
           endif;
       }
       catch(Exception $e)
       {
            $this->error($e->getMessage());
       }
    }
    
   public function logout(){
     
    }
    
    public function forgetpass()
    {
     
     try
       {

       }
       catch(Exception $e)
       {
            $this->error($e->getMessage());
       } 
    }
    

    
}

?>