<?php

//this is where all the user setting information goes
require_once('check.php');
class process extends check{
    
    
    public $_menu = '<li ><a href="/manage/" style="color:">Home</a></li>
              <li><a href="/setting/">Settings</a></li>
              <li><a href="/manage/faq">Help</a></li>
              <li><a href="/logout">Sign Out</a></li>';
    
    public $session_data;

    public function __construct(){
        parent::__construct();
        $this->load->library('general_library');
        $gl = new general_library();
        $session = $gl->isLoggedInCustomer();
        if($session == false):
            $this->load->helper('url');
            redirect('/manage/', 'refresh');
            return true;
		else:
			$this->App_ID = $gl->getUserAppID($this->session_data);
        endif;
        
    }

    
    public function index(){
        
        try{
            
            $post = $this->input->post();
                         $userArray = array();

         if(!isset($post['submitprofile']) && !isset($post['submitpass']) && !isset($post['submitpush'])):
             $userArray['tab1'] = 'active x';
             $userArray['tab2'] = '';
             $userArray['div1'] = 'active';
             $userArray['div2'] = '';
             elseif(isset($post['submitprofile'])):
                $this->load->model('model_app_process');
                $this->model_app_process->updateUserProfile($this->session_data);
             $userArray['tab1'] = 'active y';
             $userArray['tab2'] = '';
             $userArray['div1'] = 'active';
             $userArray['div2'] = '';
            $userArray['userprofileerror'] = "<div class='alert alert-success pull-left'>You have successfully updated your profile.</div>"; 

             elseif(isset($post['submitpass'])):
                 
                $this->load->model('model_app_process');
                $this->model_app_process->updatepassword($this->session_data);
             $userArray['tab1'] = '';
             $userArray['tab2'] = 'active z';
             $userArray['div1'] = '';
             $userArray['div2'] = 'active';
             $userArray['userpassworderror'] = "<div class='alert alert-success pull-left'>You have successfully updated your password.</div>"; 
             
             elseif(isset($post['pushpass'])):
                
                  $this->load->model('model_app_process');
                $this->model_app_process->updatePushPassword();
            
             $userArray['tab3'] = 'active';
             $userArray['div3'] = 'active';
             
             $userArray['userupdatepush'] = "<div class='alert alert-success pull-left'>You have successfully updated your password.</div>"; 
             
                 
         endif;
         
            $userid = $this->session_data['userid'];
            $this->load->model('model_app_process');
			$user = $this->model_app_process->getCustomerUserInformation($this->session_data['userid']);
			$appstoreinfo = $this->model_app_process->getAppInformation($this->session_data['userid']);
			$inappinfo = $this->model_app_process->getInAppInformation($appstoreinfo->App_ID);
			
			$profile = $this->model_app_process->getApplicationProfile($appstoreinfo->App_ID);
			//echo 'Hello WOrld asdfjlasdgfnvkjasdgnkjansgabav';
			
			
			foreach ($profile as $p)
			{
				if ($p->name == 'facebook')
				{
					$userArray['facebook'] = $p->value;
				}
				
				else if ($p->name == 'twitter')
				{
					$userArray['twitter'] = $p->value;
				}
				
				else if ($p->name == 'youtube')
				{
					$userArray['youtube'] = $p->value;
				}
				
				else if ($p->name == 'instagram')
				{
					$userArray['instagram'] = $p->value;
				}
			}
			
			
			$userArray['app_name'] = $appstoreinfo->app_name;
			$userArray['app_nickname'] = $appstoreinfo->app_nickname;
			$userArray['keywords'] = $appstoreinfo->keywords;
            $userArray['user_id'] = $this->session_data['userid'];
			
			 $userArray['about'] = $inappinfo->about;
			 $userArray['website'] = $inappinfo->website;
			 $userArray['phone'] = $inappinfo->phone;
			 $userArray['email'] = $inappinfo->email;
			
             
			 $userArray['firstname'] = $user->first_name;
            
             //$userArray['phone'] = $profile->phone;
             //$userArray['email'] = $profile->email;
			 
             $menu = array();
             $menu['menu'] = $this->_menu;
             
$header = array();
	     $header['stylesheets'] = '<link href="/scripts/css/manage_entertainment.css" rel="stylesheet" media="all" type="text/css" /><link href="/scripts/datepicker/css/datepicker.css" rel="stylesheet"><link href="js/google-code-prettify/prettify.css" rel="stylesheet" /><link type="text/css" href="/scripts/timepicker/compiled/timepicker.css" rel="stylesheet" media="all"/><link href="/scripts/colorpicker/css/colorpicker.css" rel="stylesheet" media="all" type="text/css" />';
            
            $footer = array();
            $footer['js'] = '<script src="/scripts/datepicker/js/bootstrap-datepicker.js" ></script>
                            <script src="/scripts/timepicker/js/bootstrap-timepicker.js" ></script>
                            </script><script src="/scripts/colorpicker/js/bootstrap-colorpicker.js"></script>
                            <script src="/scripts/js/jquery.tablednd.js"></script> 
                            <script src="/scripts/js/entertainment_app.js"></script>';
             //$header['stylesheets'] = '<link href="/scripts/css/setting.css" rel="stylesheet" media="all" type="text/css" />';
             $header['title'] = "User Setting";
             $this->load->view('header', $header);
             $this->load->view('menu', $menu);
             $this->load->view('process/create', $userArray);
             $this->load->view('footer', $footer);
             return;
           
           }
           catch(Exception $e){
             
			 echo $e->getMessage();
			 
             $userid = $this->session_data['userid'];
             $this->load->model('model_app_process');
             $user = $this->model_app_process->getCustomerUserInformation($userid);
             
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
	     $header['stylesheets'] = '<link href="/scripts/css/manage_entertainment.css" rel="stylesheet" media="all" type="text/css" /><link href="/scripts/datepicker/css/datepicker.css" rel="stylesheet"><link href="js/google-code-prettify/prettify.css" rel="stylesheet" /><link type="text/css" href="/scripts/timepicker/compiled/timepicker.css" rel="stylesheet" media="all"/><link href="/scripts/colorpicker/css/colorpicker.css" rel="stylesheet" media="all" type="text/css" />';
            
            $footer = array();
            $footer['js'] = '<script src="/scripts/datepicker/js/bootstrap-datepicker.js" ></script>
                            <script src="/scripts/timepicker/js/bootstrap-timepicker.js" ></script>
                            </script><script src="/scripts/colorpicker/js/bootstrap-colorpicker.js"></script>
                            <script src="/scripts/js/jquery.tablednd.js"></script> 
                            <script src="/scripts/js/entertainment_app.js"></script>';

             $header['title'] = "Create App";
             $this->load->view('header', $header);
             $this->load->view('menu', $menu);
             $this->load->view('process/create', $userArray);
             $this->load->view('footer', $footer);
           }
        					
    }
	
	public $App_ID;

    public function skip_process($id){
		
		$data = array("submitted" => "2");
		
		$this->db->update("applications", $data , "artist_id = $id");
		
		
		 if(!$this->db->update('applications', $data, "artist_id = $id")):
            throw new Exception("Error updating user, please contact admin.");
        else:
			$this->load->helper('url');
            redirect('/manage/', 'refresh');
		endif;
		
	}
	
	 public function change_to_submit($App_ID){
		
		//var_dump($this->session_data['userid']);
		
		//Check for correct App ID
		//$this->App_ID = $gl->getUserAppID($this->session_data);
		if($this->App_ID === $App_ID):
			$data = array("approved" => "0");
		
			if(!$this->db->update('applications', $data, "artist_id ={$this->session_data['userid']}")):
				throw new Exception("Error updating user, please contact admin.");
			else:
			
				$this->load->helper('url');
				redirect('/app/', 'refresh');
			endif;
		else:
			$this->load->helper('url');
            redirect('/app/', 'refresh');
		
		endif;
		
		/*$data = array("approved" => "0");
		
		 if(!$this->db->update('applications', $data, "artist_id = $_Session")):
            throw new Exception("Error updating user, please contact admin.");
        else:
		
			//$this->load->helper('url');
            //redirect('/app/', 'refresh');
		endif;
		*/
		
	}
}

?>
