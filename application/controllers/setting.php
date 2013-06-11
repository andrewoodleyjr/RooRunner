<?php

//this is where all the user setting information goes
require_once('check.php');
class setting extends check{
    
    
    public $_menu = '<li ><a href="/manage/" style="color:">Home</a></li>
              <li class="active" ><a href="/setting/">Settings</a></li>
              <li><a href="/manage/faq">Help</a></li>
              <li><a href="/main/logout">Sign Out</a></li>';
    
    public $session_data;
    
    public function __construct() {
        parent::__construct();
    }

    
    public function index(){
        
        try{
            
            $post = $this->input->post();
                         $userArray = array();

         if(!isset($post['submitprofile']) && !isset($post['submitpass']) && !isset($post['submitweb'])):
             
			 $userArray['tab1'] = 'active';
             $userArray['tab2'] = '';
			 $userArray['tab3'] = '';
             $userArray['div1'] = 'active';
             $userArray['div2'] = '';
			 $userArray['div3'] = '';
			 
             elseif(isset($post['submitprofile'])):
                $this->load->model('model_users');
                $this->model_users->updateUserProfile($this->session_data);
             $userArray['tab1'] = 'active y';
             $userArray['tab2'] = '';
			 $userArray['tab3'] = '';
             $userArray['div1'] = 'active';
             $userArray['div2'] = '';
            $userArray['userprofileerror'] = "<div class='alert alert-success pull-left'>You have successfully updated your profile.</div>"; 

             elseif(isset($post['submitpass'])):
                 
                $this->load->model('model_users');
                $this->model_users->updatepassword($this->session_data);
             $userArray['tab1'] = '';
             $userArray['tab2'] = 'active z';
			 $userArray['tab3'] = '';
             $userArray['div1'] = '';
             $userArray['div2'] = 'active';
             $userArray['div3'] = '';
             $userArray['userpassworderror'] = "<div class='alert alert-success pull-left'>You have successfully updated your password.</div>"; 
             
             elseif(isset($post['submitweb'])):
                
                  $this->load->model('model_users');
                $this->model_users->updatewebsite($this->session_data);
            
			 $userArray['tab1'] = '';
             $userArray['tab2'] = '';
			 $userArray['tab3'] = 'active z';
             $userArray['div1'] = '';
             $userArray['div2'] = '';
             $userArray['div3'] = 'active';
             
             $userArray['userwebsite'] = "<div class='alert alert-success pull-left'>You have successfully updated your website.</div>"; 
             
                 
         endif;
         
            $userid = $this->session_data['userid'];
            $this->load->model('model_users');



             
             $user = $this->model_users->getCustomerUserInformation($this->session_data['userid']);

             $userArray['firstname'] = $user->first_name;
             $userArray['lastname'] = $user->last_name;
             $userArray['phone'] = $user->phone;
             $userArray['email'] = $user->email;
			 $userArray['website'] = $user->web_ext;
			 
             $menu = array();
             $menu['menu'] = $this->_menu;
             $header = array();
             //$header['stylesheets'] = '<link href="/scripts/css/setting.css" rel="stylesheet" media="all" type="text/css" />';
             $header['title'] = "User Setting";
			 $footer = array();
			 $header['stylesheets'] = '';
			 
             $this->load->view('header', $header);
             $this->load->view('menu', $menu);
             $this->load->view('setting/users', $userArray);
             $this->load->view('footer', $footer);
             return;
           
           }
           catch(Exception $e){
             
             $userid = $this->session_data['userid'];
             $this->load->model('model_users');
             $user = $this->model_users->getCustomerUserInformation($userid);
             
             $userArray = array();
             if(strpos($e->getMessage(), "1: ") > -1):
                 
                $error = str_replace("1:", "", $e->getMessage());
             $userArray['tab1'] = 'active';
             $userArray['tab2'] = '';
             $userArray['div1'] = 'active';
             $userArray['div2'] = '';
             $userArray['userprofileerror'] = "<div class='alert alert-danger pull-left'> {$error}</div>"; 
             elseif(strpos($e->getMessage(), "2:") > -1):
             $error = str_replace("2:", "", $e->getMessage());
             $userArray['tab1'] = '';
             $userArray['tab2'] = 'active';
             $userArray['div1'] = '';
             $userArray['div2'] = 'active';
             $userArray['userpassworderror'] = "<div class='alert alert-danger pull-left'> {$error}</div>"; 
             else:
             $userArray['tab1'] = 'active';
             $userArray['tab2'] = '';
             $userArray['div1'] = 'active';
             $userArray['div2'] = '';
             $userArray['userprofileerror'] = "<div class='alert alert-danger pull-left'> {$e->getMessage()}</div>"; 
             endif;
             
             $userArray['firstname'] = $user->first_name;
             $userArray['lastname'] = $user->last_name;
             $userArray['mobile'] = $user->phone;
             $userArray['email'] = $user->email;
             $menu = array();
             $menu['menu'] = $this->_menu;
             $header = array();
             $header['stylesheets'] = '<link href="/scripts/css/setting.css" rel="stylesheet" media="all" type="text/css" />';
             $header['title'] = "User Setting";
             $footer = array();
			 $header['stylesheets'] = '<script>
	   								var hash = window.location.hash;
									
									document.getElementById(hash).className = "active";
									 document.getElementById("tab2").className =""; 
									 //alert(hash);
	   						  </script>';
			 
             $this->load->view('header', $header);
             $this->load->view('menu', $menu);
             $this->load->view('setting/users', $userArray);
             $this->load->view('footer', $footer);
           }
        
    }
}

?>
