<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manage
 *
 * @author GOI LLC
 */
require_once ('check.php');
require_once ('application/config/stripe.php');
class manage extends check{

    private $form_errors = '';
	private $message = '';
	
    public function __construct() {
        parent::__construct();
    }
	
	public function sendfeedmessage($id, $type, $tasknum){
		
		    
        try{
			
			  //We need to get who the user information to send to the proper place. 
			  $this->load->model('model_users');
			  $user = $this->model_users->getUserInformation($id);
              
			  $this->load->library('twilio');
			  
			  if($type == '1'):
			  
			  				$link = "http://www.roorunner.com/main/survey/2/".$id."/".$tasknum."";
			  elseif($type == '0'):
			  				$link = "http://www.roorunner.com/main/survey/1/".$id."/".$tasknum."";
			  endif;
							//Our Number 
							$from = '6158618612';
							
							//The Runner Number
							$to = $user->phone;
							$message = 'Hey '.$user->name.'. Your task, has ended tell us about your experience and rate your RooRunner.'.$link.'';
					
					
							$response1 = $this->twilio->sms($from, $to, $message);
					   
						
							$this->load->library('email_library');
						
							
							
							
							$message = 'Hey '.$user->name.'. Your task, has ended tell us about your experience and rate your RooRunner.'.$link.'';
					
							$response2 = $this->email_library->sendEmail('Completed Task', $message , $user->name.'<'.$user->email.'>');
							
						if($response1 && $response2):
							return true;
						else:
							return false;
						endif;
				
				
				
				
				
					
					
					
			  
			  
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
   }
    
	public function showpage($view_or_array_of_views_and_data,$data=NULL){
			$this->load->view('header');
			$this->load->view('main/menu');
		
			switch (gettype($view_or_array_of_views_and_data)) {
				case 'array':
					foreach ($view_or_array_of_views_and_data as $key=>$val):
						if (is_numeric($key)):
							// Numeric keys indicate views without data being passed to them
							$this->load->view($val);
						else:
							$this->load->view($key,$val);
						endif;
					endforeach;
					break;
				case 'string':
					if (is_null($data)):
						$this->load->view($view_or_array_of_views_and_data);
					else:
						$this->load->view($view_or_array_of_views_and_data, $data);
					endif;
					break;
				default:
					break;
			}

			$this->load->view('footer');
	}

    public function faq(){
        
        try{
        
           $menuArray = array('usertype' => $this->session_data['usertype']);
           $menu = $this->session_data;
		   var_dump($this->session_data);
           /*$menuArray['menu'] = $menu;
           $header = array();
              $header['stylesheets'] = '<link href="/scripts/css/faq.css" rel="stylesheet" media="all" type="text/css" />';
              $header['title'] = 'RooRunner &middot; FAQs';
              $this->load->model('model_faq');
           $this->load->view('header', $header);
           $this->load->view('main/menu', $menuArray);
           $this->load->view('main/faq', $this->model_faq->getYoutubePlayList());
           $this->load->view('footer');
		   */
           
        }
        catch(Exception $e){
            $this->error($e->getMessage());
        }
    }   
	
	public function sendmessage($id){	
	
			
			  $post = $this->input->post();
			  $this->load->model('model_page_entertainment');
			  $taskinfo = $this->model_page_entertainment->getRawDetails($id, $this->session_data);
			  
			  if($taskinfo[0]->user_id == $this->session_data['userid']):
			  		$reciever_id = $taskinfo[0]->reciever_id;
			  elseif($taskinfo[0]->reciever_id == $this->session_data['userid']):
			  		$reciever_id = $taskinfo[0]->user_id;
			  endif;
			  
			  $this->load->model('model_users');
			  $user = $this->model_users->getUserInformation($reciever_id);
					   
					   
					   $this->load->library('twilio');
					   
							//Our Number 
							$from = '6158618612';
							
							//The Runner Number
							$to = $user->phone;
							$message = 'Hey '.$user->name.'. Your task, "'.$taskinfo[0]->title.'" message: '.$post['message'].'';
					
							$response1 = $this->twilio->sms($from, $to, $message);
					   
						
						$this->load->library('email_library');
						
							
							
							
							$message = 'Hey '.$user->name.', <br/><br/> Your task "'.$taskinfo[0]->title.'" message: <br/><br/> '.$post['message'].'';
					
							$response2 = $this->email_library->sendEmail('RooRunner Reply Message', $message , $user->name.'<'.$user->email.'>');
						
						if($response1 && $response2):
							
							$this->load->helper('url');
             				redirect('/manage/current/', 'refresh');
							
						else:
							$this->error("Sorry, an error occured. Your message did not send. ");
							
						endif;	
							
							
			  
			
	}
	
	public function message($id){
		
		    
        try{
              $home = array('name' => $this->session_data['name'], 'id' => $id);
              $header['stylesheets'] = '';
              $header['title'] = 'RooRunner &middot; Message';
              $menuArray = array('usertype' => $this->session_data['usertype']);
			
				//Where the fuck is my functionality...  
			  $this->load->model('model_users'); 
			  
			  
              $this->load->view('header', $header);
			  $this->load->view('main/menu', $menuArray);
			  $this->load->view('main/message', $home);
			  $this->load->view('footer');
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
    }
	
	

	
	public $App_ID;

    public function App_Process(){
		
		$this->load->library('general_library');
        $gl = new general_library();
        $this->App_ID = $gl->getUserAppID($this->session_data);	
		$App_ID= $this->App_ID;
		
		
		//We will then check if the user has started creating their app. 
		//And show them to where ever they left off. 
		//Steps 1 - 7 by going to the database first...
		  
		$this->db->where('App_ID', $App_ID);
        $query_users = $this->db->get('applications');					  
		 
			if($query_users->num_rows != 1):
               
          		else: 
					foreach ($query_users->result() as $row)
					{
					   $submitted = $row->approved;
					}    
			endif;
			
		
		if($submitted == 0):
			 $this->load->helper('url');
             redirect('/process/start/', 'refresh');
		endif;
	}
    
	public function index() {
		try {
			$home = array('name' => $this->session_data['name'], 'usertype' => $this->session_data['usertype']);
			$header['stylesheets'] = '';
			$header['title'] = '';
			$menuArray = array('usertype' => $this->session_data['usertype']);
			$this->load->model('model_page_entertainment');
			$home['tasks'] = $this->model_page_entertainment->getEventTable($this->session_data);
			$this->showpage('main/options', $home);
			// $this->load->view('header', $header);
			// $this->load->view('main/menu', $menuArray);
			// $this->load->view('main/options', $home);
			// $this->load->view('footer');
		}
		catch(Exception $e){
			$this->error("Error loading the page.");
		}
	}
	
	public function current() {

		try {
			$home = array('name' => $this->session_data['name']);
			$header['stylesheets'] = '';
			$header['title'] = '';
			$menuArray = array('usertype' => $this->session_data['usertype']);

			$this->load->model('model_page_entertainment');

			$home['tasks'] = $this->model_page_entertainment->getEventTable($this->session_data);
			$this->showpage('main/home', $home);
/*
			$this->load->view('header', $header);
			$this->load->view('main/menu', $menuArray);
			$this->load->view('main/home', $home);
			$this->load->view('footer');
*/
		}
		catch(Exception $e) {
			$this->error("Error loading the page.");
		}
	}
	
	public function message_runners() {

		try {
			$home = array('name' => $this->session_data['name']);
			$header['stylesheets'] = '';
			$header['title'] = '';
			$menuArray = array('usertype' => $this->session_data['usertype']);

			$this->load->model('model_page_entertainment');

			$home['tasks'] = $this->model_page_entertainment->getAllRunners($this->session_data);

			$this->load->view('header', $header);
			$this->load->view('main/menu', $menuArray);
			$this->load->view('main/runners', $home);
			$this->load->view('footer');
		}
		catch(Exception $e) {
			$this->error("Error loading the page.");
		}
	}
	
	
	
	public function task($id){
		
		    
        try{
              $home = array('name' => $this->session_data['name']);
              $header['stylesheets'] = '';
			  $header['title'] = '';
              $header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
			  
			  $this->load->model('model_page_entertainment');
                   
			 $home['tasks'] = $this->model_page_entertainment->getDetails($id,$this->session_data);
              

              $this->load->view('header', $header);
              $this->load->view('main/menu', $menuArray);
              $this->load->view('main/task', $home);
              $this->load->view('footer');
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
    }
	
	
	public function jobs(){
		
		    
        try{
              $home = array('name' => $this->session_data['name']);
              $header['stylesheets'] = '<link href="http://fonts.googleapis.com/css?family=SourceSansPro:400,400italic,700|OpenSansCondensed:300,700" rel="stylesheet" /><script src="js/jquery.min.js"></script>
		<script src="/js/config.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-panels.min.js"></script>
		<link rel="stylesheet" href="/css/skel-noscript.css" />
			<link rel="stylesheet" href="/css/style.css" />
			<link rel="stylesheet" href="/css/style-desktop.css" />
			<link rel="stylesheet" href="/css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="/js/html5shiv.js"></script><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="/css/ie7.css" /><![endif]-->';
              $header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
			  
			  $this->load->model('model_page_entertainment');
                   
			 $home['tasks'] = $this->model_page_entertainment->getJobs($this->session_data);
              

              $this->load->view('header', $header);
              $this->load->view('main/menu', $menuArray);
              $this->load->view('main/jobs', $home);
              $this->load->view('footer');
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
}

public function accept($id){
	
        try{
              
			  
			  $this->load->model('model_page_entertainment');
			  $value = $this->model_page_entertainment->accept($id,$this->session_data);
           
			
              if($value):
							// the value went over so send message and then do the email
							//Sends info to all Runners through email and text messages :)
							
						$this->db->where('id', $id);
						$querytask = $this->db->get('tasks');
						$result_task = $querytask->result();
						
						//($result_task[0]->user_id);
					   $this->load->model('model_users');
					   $user = $this->model_users->getUserInformation($result_task[0]->user_id);
					   
					   
					   $this->load->library('twilio');
					   
							//Our Number 
							$from = '6158618612';
							
							//The Runner Number
							$to = $user->phone;
							$message = 'Hey '.$user->name.'. Your task, "'.$result_task[0]->title.'" has been accepted and is currently in progress. Go to www.roorunner.com for more details.';
					
							$response = $this->twilio->sms($from, $to, $message);
					   
						
						$this->load->library('email_library');
						
							
							
							
							$message = 'Hey '.$user->name.', <br/><br/> Your task "'.$result_task[0]->title.'" has been accepted and is currently in progress. <br /><br /> Go to www.roorunner.com for more details.';
					
							$response = $this->email_library->sendEmail('Accepted Task', $message , $user->name.'<'.$user->email.'>');
							
						   $this->load->helper('url');
						   redirect('/manage/task/'.$id.'', 'refresh');
						   return false;
					   

					   
			  else:
              			$this->load->helper('url');
                       redirect('/manage/task/'.$id.'', 'refresh');
                       return false;
			endif;
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
}

public function past(){
		
		    
        try{
              $home = array('name' => $this->session_data['name']);
              $header['stylesheets'] = '<link href="http://fonts.googleapis.com/css?family=SourceSansPro:400,400italic,700|OpenSansCondensed:300,700" rel="stylesheet" /><script src="js/jquery.min.js"></script>
		<script src="/js/config.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-panels.min.js"></script>
		<link rel="stylesheet" href="/css/skel-noscript.css" />
			<link rel="stylesheet" href="/css/style.css" />
			<link rel="stylesheet" href="/css/style-desktop.css" />
			<link rel="stylesheet" href="/css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="/js/html5shiv.js"></script><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="/css/ie7.css" /><![endif]-->';
              $header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
			  
			  $this->load->model('model_page_entertainment');
                   
			 $home['tasks'] = $this->model_page_entertainment->getPastJobs($this->session_data);
              

              $this->load->view('header', $header);
              $this->load->view('main/menu', $menuArray);
              $this->load->view('main/past', $home);
              $this->load->view('footer');
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
}

public function cancel(){
		
		    
        try{
              $home = array('name' => $this->session_data['name']);
              $header['stylesheets'] = '<link href="http://fonts.googleapis.com/css?family=SourceSansPro:400,400italic,700|OpenSansCondensed:300,700" rel="stylesheet" /><script src="js/jquery.min.js"></script>
		<script src="/js/config.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-panels.min.js"></script>
		<link rel="stylesheet" href="/css/skel-noscript.css" />
			<link rel="stylesheet" href="/css/style.css" />
			<link rel="stylesheet" href="/css/style-desktop.css" />
			<link rel="stylesheet" href="/css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="/js/html5shiv.js"></script><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="/css/ie7.css" /><![endif]-->';
              $header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
			  
			  $this->load->model('model_page_entertainment');
                   
			 $home['tasks'] = $this->model_page_entertainment->getPastJobs($this->session_data);
              

              $this->load->view('header', $header);
              $this->load->view('main/menu', $menuArray);
              $this->load->view('main/past', $home);
              $this->load->view('footer');
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
}

public function delete($id){
		
		    
        try{
              $home = array('name' => $this->session_data['name']);
              $header['stylesheets'] = '<link href="http://fonts.googleapis.com/css?family=SourceSansPro:400,400italic,700|OpenSansCondensed:300,700" rel="stylesheet" /><script src="js/jquery.min.js"></script>
		<script src="/js/config.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-panels.min.js"></script>
		<link rel="stylesheet" href="/css/skel-noscript.css" />
			<link rel="stylesheet" href="/css/style.css" />
			<link rel="stylesheet" href="/css/style-desktop.css" />
			<link rel="stylesheet" href="/css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="/js/html5shiv.js"></script><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="/css/ie7.css" /><![endif]-->';
              $header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
			  
			  $this->load->model('model_page_entertainment');     
			  $value = $this->model_page_entertainment->delete($id,$this->session_data);
              
			  if($value):
				   $this->load->helper('url');
				   redirect('/manage/current/', 'refresh');
				   return false;
			  else:
				   $this->load->helper('url');
				   redirect('/manage/current/', 'refresh');
				   return false;
			 endif;
			
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
}
	
	
	
	public function updatetask($id)
    {
       try
       {
           $post = $this->input->post();
           if(isset($post['submit'])):
               if((!isset($post['title'])) || (!isset($post['reward'])) || (!isset($post['description'])) || (!isset($post['location']))):
                   $this->form_errors = "Fill out all information.";
				   return false;
				   $this->update();

               else:
				   $this->load->model('model_users');
				   $valid = $this->model_users->update2($id,$this->session_data);
				   
				   //Checks is user information is valid
                   if($valid):
	
					   $this->load->helper('url');
                       redirect('/manage/task/'.$id.'', 'refresh');
                       return true;
				   else:
					   $this->form_errors = "An Error Occured Please Try Again";
					   $this->update();
					   return false;
                   endif;
               endif;
               else:
               $this->update();
               return true;
           endif;
       }
       catch(Exception $e)
       {
            $this->error($e->getMessage());
       }
    }
	
	public function create() {

		try {

			$header['stylesheets'] = '';
			$header['title'] = '';
			$menuArray = array('usertype' => $this->session_data['usertype']);

			
			$errors = $this->form_errors;
			if($errors != ''):
			$errors['description'] = $this->form_errors['description'];
			$errors['title2'] = $this->form_errors['title'];
			$errors['location'] = $this->form_errors['location'];
			$errors['reward'] = $this->form_errors['reward'];
			$errors['error'] = "<div class='alert alert-danger'>Please Fill Out All Fields</div>";
			$login = array('error' => $errors);
			else:
				$login = array('error' => "");
			endif;

			$this->showpage('main/create', $login);
/*
			$this->load->view('header', $header);
			$this->load->view('main/menu', $menuArray);
			$this->load->view('main/create', $login);
			$this->load->view('footer');
*/
		}
		catch(Exception $e){
			$this->error("Error loading the page.");
		}
	}
	
	public function profile() {

		try {

			$header['stylesheets'] = '';
			$header['title'] = '';
			$menuArray = array('usertype' => $this->session_data['usertype']);
			$profile_section_info = array();

			$this->load->model('model_users');
			$profile_section_info['info'] = $this->model_users->getUserInformation($this->session_data['userid']);
			$profile_section_info['trust'] = $this->model_users->getUserTrustPoints($this->session_data['userid']);
			$profile_section_info['reward'] = $this->model_users->getUserRewardPoints($this->session_data['userid']);
			//($profile_section_info);
			//$login = array('error' => $errors);

			$this->showpage('main/profile', $profile_section_info);

/*			$this->showpage($view => data) is equivalent to:

			$this->load->view('header', $header);
			$this->load->view('main/menu', $menuArray);
			$this->load->view('main/profile', $profile_section_info);
			$this->load->view('footer');
*/

		}
		catch(Exception $e){
			$this->error("Error loading the page.");
		}
	}
	
	public function createtask()
    {
       try
       {
           $post = $this->input->post();
           if(isset($post['submit'])):
		   	
               if((strlen($post['title']) <= 0) || (strlen($post['reward']) <= 0) || (strlen($post['description']) <= 0) || (strlen($post['location']) <= 0)):
			   
			   	   
				   
                   $this->form_errors = $post;
				   
				   //($this->form_errors);
				   $this->create();
					return false;
                   
                   else:
                   
				   //('inside else');
				   $this->load->model('model_users');
                   
				   $valid = $this->model_users->create($this->session_data);
                   
				   //Checks is user information is valid
                   if($valid):
					   //Sends info to all Runners through email and text messages :)
					   $runners = $this->model_users->getRunners();
					   
					   if(count($runners) > 0):
						   if($this->load->library('twilio')):
						   foreach($runners as $runner):
								//Our Number 
								$from = '6158618612';
								//The Runner Number
								$to = $runner->phone;
								$message = 'Hey '.$runner->name.', a new task has been posted. "'.$post['title'].'" Go to www.roorunner.com for more details.';
						
								$response = $this->twilio->sms($from, $to, $message);
						   endforeach;
							endif;
							
							if($this->load->library('email_library')):
							foreach($runners as $runner):
								//Our Number 
								$from = '6158618612';
								
								//The Runner Number
								$to = $runner->phone;
								$message = 'Hey '.$runner->name.', <br/> A new task has been posted. <br /><br />'.$post['title'].' Go to www.roorunner.com for more details.';
								$response = $this->email_library->sendEmail('New Available Run', $message , $runner->name.'<'.$runner->email.'>');
								
						   endforeach;
							endif;
							
						endif;
						//Get them and set up a foreach loop to send out to every last on of them.  
						
					   
					   $this->load->helper('url');
                       redirect('/manage/current/', 'refresh');
                       return false;
                       else:
                           $this->form_errors = "An Error Occured Please Try Again";
                           $this->create();
                           return false;
					
                   endif;
               endif;
               else:
               $this->create();
               return true;
           endif;
		   
       }
       catch(Exception $e)
       {
            $this->error($e->getMessage());
       }
    }




public function buytasks(){
	try{
		$post = $this->input->post();
		if(isset($post['stripeToken'])):
			if((strlen($post['stripeToken']) <= 0)):
				$this->form_errors = $post;
				//$this->showpage();
				var_dump($this->form_errors);
				return false;				
			else:
				$this->showpage('main/purchase');
				$this->load->helper('stripe');	
				$token = $post['stripeToken'];
				$customer = Stripe_Customer::create(array(
				      'email' => 'customer@example.com',
				      'card'  => $token
				));
				 
			  $charge = Stripe_Charge::create(array(
			      'customer' => $customer->id,
			      'amount'   => 5000,
			      'currency' => 'usd'
			  ));
			 
			  echo '<h1>Successfully charged $5!</h1>';
			  var_dump($token);
			  var_dump($customer);
			  var_dump($charge);	
			endif;
		else:
			//print_r($post);
			$this->showpage('main/purchase');
		endif;
	}
	catch(Exception $e){
		$this->error("Error loading the page.<br/>" . $e->getMessage());
	}

}
	
public function completeduser($id){
		
		//Send off message and text to user and to reciever 
		    
        try{
              $home = array();
              $header['stylesheets'] = '';
              $header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
              $this->load->model('model_page_entertainment');
			  $taskinfo = $this->model_page_entertainment->getRawDetails($id, $this->session_data);
			  
			  $status = $this->sendfeedmessage($taskinfo[0]->user_id, '0', $id);
			  $status2 = $this->sendfeedmessage($taskinfo[0]->reciever_id, '1', $id);
				if($status && $status2):
					//Remove from db 
					$this->delete($id);
				
				else:
					$this->load->helper('url');
             		redirect('manage/current', 'refresh');
				endif;
				
				
              
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
    
    
    
}	
	
public function update($id){
		
		    
        try{
              $home = array();
              $header['stylesheets'] = '<link href="http://fonts.googleapis.com/css?family=SourceSansPro:400,400italic,700|OpenSansCondensed:300,700" rel="stylesheet" /><script src="js/jquery.min.js"></script>
		<script src="/js/config.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-panels.min.js"></script>
		<link rel="stylesheet" href="/css/skel-noscript.css" />
			<link rel="stylesheet" href="/css/style.css" />
			<link rel="stylesheet" href="/css/style-desktop.css" />
			<link rel="stylesheet" href="/css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="/js/html5shiv.js"></script><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="/css/ie7.css" /><![endif]-->';
              //$header['title'] = 'RooRunner &middot; Member';
              $menuArray = array('usertype' => $this->session_data['usertype']);
              $this->load->model('model_page_entertainment');
               
			   $home['info'] = $this->model_page_entertainment->getData($id,$this->session_data); 
			
	
              $this->load->view('header', $header);
              $this->load->view('main/menu', $menuArray);
              $this->load->view('main/update', $home);
              $this->load->view('footer');
        }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
    }
   public function UpdateProfile(){
		
		    
        try{
              
               $this->load->model('model_users');
			   $success= $this->model_users->updateUserProfile($this->session_data); 
			
				if($success):
					  $this->profile();
					  $this->message = "Your information has been updated.";
				else:
					  //($this->form_errors);
					  //$this->profile();
				
				endif;
	
              
     }
    catch(Exception $e){
        $this->error("Error loading the page.");
    }
    }
    
    
 

}



?>
