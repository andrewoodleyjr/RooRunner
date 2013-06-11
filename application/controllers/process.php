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

    
    public function start($pagename = 'home'){
        
        try{
           	$this->load->model('model_page_entertainment');
            $this->model_page_entertainment->initialize($this->App_ID);
			
			$page_array = array();
			$page_array = $this->model_page_entertainment->getPageInfo();
			//var_dump($page_array);
            $page_array['App_ID'] = $this->App_ID;
            $page_array['tab_' . $pagename] = 'active in';
			$this->load->model('model_apps');
			$page_array['edit'] = $this->model_apps->getEditInfo($this->App_ID);

             $menu = array();
             $menu['menu'] = $this->_menu;
             
$header = array();
	     $header['stylesheets'] = '<link href="/scripts/css/manage_entertainment.css" rel="stylesheet" media="all" type="text/css" /><link href="/scripts/datepicker/css/datepicker.css" rel="stylesheet"><link href="js/google-code-prettify/prettify.css" rel="stylesheet" /><link type="text/css" href="/scripts/timepicker/compiled/timepicker.css" rel="stylesheet" media="all"/><link href="/scripts/colorpicker/css/colorpicker.css" rel="stylesheet" media="all" type="text/css" />';
            
            $footer = array();
            $footer['js'] = '<script src="/scripts/datepicker/js/bootstrap-datepicker.js" ></script>
                            <script src="/scripts/timepicker/js/bootstrap-timepicker.js" ></script>
                            </script><script src="/scripts/colorpicker/js/bootstrap-colorpicker.js"></script>
                            <script src="/scripts/js/jquery.tablednd.js"></script> 
                            <script src="/scripts/js/entertainment_app2.js"></script>';
             //$header['stylesheets'] = '<link href="/scripts/css/setting.css" rel="stylesheet" media="all" type="text/css" />';
             $header['title'] = "User Setting";
             $this->load->view('header', $header);
             $this->load->view('menu', $menu);
             $this->load->view('process/create', $page_array);
             $this->load->view('footer', $footer);
             return;
           
           }
           catch(Exception $e){
			 echo $e->getMessage();
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
	
	 public function submit($id){
		
		//Change the approved number to skip number and then go to payments section
		$data = array("approved" => "4");
		
		 if(!$this->db->update('applications', $data, "artist_id = $id")):
            throw new Exception("Error updating user, please contact admin.");
        else:
			$this->load->helper('url');
            redirect('/manage/', 'refresh');
		endif;
		
	}
	
	 public function submit2($id){
		
		//Change the approved number to skip number and then go to payments section
		$data = array("approved" => "4");
		
		$this->db->update('applications', $data, "App_ID = $id");
		if(!$this->db->update('applications', $data, "App_ID = $id")):
            throw new Exception("Error updating user, please contact admin.");
        else:
			$this->load->helper('url');
			redirect('/manage/', 'refresh');
            //redirect('/checkout/app');
		endif;
		
	}
	
	 public function change_to_submit($App_ID){
		
		//var_dump($this->session_data['userid']);
		
		//Check for correct App ID
		//$this->App_ID = $gl->getUserAppID($this->session_data);
		
		if($this->App_ID === $App_ID):
			$data = array("approved" => "3");
		
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
