<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_page_entertainment
 *
 * @author GOI LLC
 */
class model_page_entertainment extends CI_Model{
    //put your code here
    
       private  $_result_applications;
       private  $App_ID;
    
    
   public function getPageInfo()
   {
            $page_info = array();
			$page_info['event_table'] = $this->getEventTable();
			$page_info['event_data'] = $this->getData();
            $page_info['runners_data'] = $this->getAllRunners();
			
            return $page_info;
   }
         
    public function initialize()
    {
             $this->App_ID = $App_ID;
             if($_result_applications != null):
             $this->_result_applications = $_result_applications;
             else:
                 $this->db->where('App_ID', $App_ID);
                 $query_applications = $this->db->get('applications');
                 if($query_applications->num_rows != 1):
                     throw new Exception("No application was found.");
                 endif;
                 $this->_result_applications = $query_applications->result();
                 
             endif;
             
    }
    
    public function getInstragramTable(){
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('position', 'ASC');
        $query_music_applications_instagram = $this->db->get('music_applications_instagram');
        if($query_music_applications_instagram->num_rows == 0):
            return "<tr><td></td><td>No Hash Tags</td><td></td></tr>";
        endif;
        $table = '';
        $count = 1;
        foreach($query_music_applications_instagram->result() as $hash_tag_tr):
            $table .= "<tr data-id='{$hash_tag_tr->id}'>";
            $table .= "<td>" . $count . "</td>";
            $table .= "<td>" . $hash_tag_tr->hash_tag . "</td>";
            $table .= "<td><a href='\#edit_instragram' class='change_hashtag' data-tag_name='{$hash_tag_tr->hash_tag}' data-id='{$hash_tag_tr->id}' data-toggle='modal'><img src='/images/edit2.png' style='width:25px'></a><a data-id='{$hash_tag_tr->id}' class='delete_hashtag' href='#' ><img   src='/images/delete.png' style='width:30px'></a></td>";
              $table .= "</tr>";
            $count += 1;
        endforeach;
        
        return $table;
    }
    
    
   public function get_time_ago($time_stamp)
{
    $time_difference = strtotime('now') - $time_stamp;

    if ($time_difference >= 60 * 60 * 24 * 365.242199)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
         * This means that the time difference is 1 year or more
         */
        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
         * This means that the time difference is 1 month or more
         */
        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 7)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
         * This means that the time difference is 1 week or more
         */
        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
    }
    elseif ($time_difference >= 60 * 60 * 24)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day
         * This means that the time difference is 1 day or more
         */
        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
    }
    elseif ($time_difference >= 60 * 60)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour
         * This means that the time difference is 1 hour or more
         */
        return $this->get_time_ago_string($time_stamp, 60 * 60, 'hour');
    }
    else
    {
        /*
         * 60 seconds/minute
         * This means that the time difference is a matter of minutes
         */
        return $this->get_time_ago_string($time_stamp, 60, 'minute');
    }
}

public function get_time_ago_string($time_stamp, $divisor, $time_unit)
{
    $time_difference = strtotime("now") - $time_stamp;
    $time_units      = floor($time_difference / $divisor);

    settype($time_units, 'string');

    if ($time_units === '0')
    {
        return 'less than 1 ' . $time_unit . ' ago';
    }
    elseif ($time_units === '1')
    {
        return '1 ' . $time_unit . ' ago';
    }
    else
    {
        /*
         * More than "1" $time_unit. This is the "plural" message.
         */
        // TODO: This pluralizes the time unit, which is done by adding "s" at the end; this will not work for i18n!
        return $time_units . ' ' . $time_unit . 's ago';
    }
}
    
   

    public function getEventTable($session)
    {
		//var_dump($session['userid']);
		//$where = "status`='1' OR 'status'='0'";
        //$this->db->where('user_id',$session['userid']);
        $this->db->where("(status = '1' OR status = '0') 
                   AND user_id = '{$session['userid']}' OR reciever_id = '{$session['userid']}'");
        $this->db->order_by('datetime', 'DESC');
        $query_current_tasks  = $this->db->get('tasks');
		//var_dump($query_current_tasks);
		
        if($query_current_tasks->num_rows <= 0):
            return "You Currently Have No Tasks";
        endif;
        $result_current_tasks = $query_current_tasks->result();
        $table = '';
        $count = 1;
        foreach($result_current_tasks as $task):
			$time = $this->get_time_ago(strtotime($task->datetime));
			
		
            $table .= '<a href="/manage/task/'.$task->id.'"><article class="is-post is-post-excerpt"><div class="row" style="padding-left:30px">';
			$table .= '<h2 class="byline">'.$task->title.'</h2><p><font style="color:green">Meeting Place: '.$task->location.'</font></p>';
			if($task->status == '0'):
				$table .= '<span class="byline" style="color:Red">On Market</span><p>'.$time.'</p>';
			else:
				$table .= '<span class="byline" style="color:Green">In Process</span><p>'.$time.'</p>';
			endif;
			$table .= '</div>'; 
            $table .= "</article></a>";
           $table .= "<hr style='width:100%'/>";
            $count += 1;
        endforeach;
        
        return $table;
    }
	
	public function getAllRunners($session)
    {
		//var_dump($session['userid']);
		//$where = "status`='1' OR 'status'='0'";
        //$this->db->where('user_id',$session['userid']);
        $this->db->where("(status = '1' OR status = '0') 
                   AND user_id = '{$session['userid']}' OR reciever_id = '{$session['userid']}'");
        $this->db->order_by('datetime', 'DESC');
        $query_current_tasks  = $this->db->get('tasks');
		//var_dump($query_current_tasks);
		
        if($query_current_tasks->num_rows <= 0):
            return "You Currently Have No Tasks";
        endif;
        $result_current_tasks = $query_current_tasks->result();
        $table = '';
        $count = 1;
		
        foreach($result_current_tasks as $task):
		
			if($task->id == 0 || $task->status == 0):
			
			else:
				$this->load->model('model_users');
				$recieverinfo['runner_info'] = $this->model_users->getUserInformation($task->reciever_id);
				$recieverinfo['runner_reward'] = $this->model_users->getUserRewardPoints($task->reciever_id);
				$recieverinfo['runner_trust'] = $this->model_users->getUserTrustPoints($task->reciever_id);
				
				
				
				$time = $this->get_time_ago(strtotime($task->datetime));
				
			
				$table .= '<a href="/manage/message/'.$task->id.'"><article class="is-post is-post-excerpt"><div class="row" style="padding-left:30px">';
				$table .= '<h2 class="byline">'.$recieverinfo['runner_info']->name.'</h2>';
				$table .= '<span class="byline" style="color:Orange">Reward Points: '.$recieverinfo['runner_reward'].'</span>';
				$table .= '<span class="byline" style="color:Green"> Trust Points: '.$recieverinfo['runner_trust'].'</span>';
				$table .= '<p><font style="font-size: 16px; letter-spacing: 0;color: #999;margin: 10px 0 15px 0; line-height: 1.4em;">'.$task->title.'</font> - <font style="font-size: 12px; font-style: italic; letter-spacing: 0;color: #999;margin: 10px 0 15px 0; line-height: 1.4em;">'.$time.'</font></p>';
				
					
				
				$table .= '</div>'; 
				$table .= "</article></a>";
			    $table .= "<hr style='width:100%'/>";
				$count += 1;
				 
			endif;
        endforeach;
        	
        return $table;
    }
	
	 public function getData($id,$session)
    {
		
        $this->db->where("id", $id);
		$this->db->where("user_id", $session['userid']);
        $query_current_tasks  = $this->db->get('tasks');
		
        if($query_current_tasks->num_rows <= 0):
            return false;
        endif;
        return $query_current_tasks->result();
        
      
    }
	
	public function getJobs($session)
    {
		//var_dump($session['userid']);
		$this->db->where('status','0');
        
        $this->db->order_by('datetime', 'DESC');
        $query_current_tasks  = $this->db->get('tasks');
		//var_dump($query_current_tasks);
		
        if($query_current_tasks->num_rows <= 0):
            return "There Are No Tasks";
        endif;
        $result_current_tasks = $query_current_tasks->result();
        $table = '';
        $count = 1;
        foreach($result_current_tasks as $task):
			
			$this->db->where("id", $task->user_id);
			$query_user = $this->db->get('users');
			$user_results = $query_user->result();
			
			//var_dump($user_results[0]->image);
			
			if(strlen($user_results[0]->image) > 0):
				$image = $user_results[0]->image;
			else:
				$image = '';
			endif;
			
			
			  $this->load->model('model_users');
			  $profile_section_info['info'] = $this->model_users->getUserInformation($session['userid']);
			  $profile_section_info['trust'] = $this->model_users->getUserTrustPoints($session['userid']);
			  $reward = $this->model_users->getUserRewardPoints($session['userid']);
			
			
			$trust2 = 0;
			//Calculate Points Here
			if(strlen($profile_section_info['info']->image)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->name)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->description)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->twitter)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->phone)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->location)):
				$trust2++;
			endif;
			
			$trust2 += $profile_section_info['trust'];
			
			$time = $this->get_time_ago(strtotime($task->datetime));
			$description = substr($task->description, 0, 100);
            $table .= '<a href="/manage/task/'.$task->id.'"><h2>'.$task->title.'</h2>';
			$table .= "<$description<h4><h3>Posted $time</h3>";
            $table .= '';
			$table .= '<!--<img src="'.$image.'" width="100" />--><strong>Reward Points:</strong> '.$reward.'<br /><strong>Trusted Points:</strong> '.$trust2.'  </p>';	
		
			$this->load->model('model_users');
			$recieverinfo['info'] = $this->model_users->getUserInformation($task->user_id);
			$table .= '<p>phone: '.$recieverinfo['info']->phone.' email: '.$recieverinfo['info']->email.'</p>';	
			$table .= '<hr>';
            $count += 1;
        endforeach;
        
        return $table;
    }
	
	
	
	public function accept($id, $session)
    {
		//var_dump($session['userid']);
		$this->db->where('id',$id);
		$this->db->where('status','0');
        
        $query_current_tasks  = $this->db->get('tasks');
		//var_dump($query_current_tasks);
		
        if($query_current_tasks->num_rows <= 0):
            return false;
		else:
			$status = array();
			$status['status'] = '1';
			$status['reciever_id'] = $session['userid'];
			$this->db->update('tasks', $status ,'id = '.$id.'');
			return true;
        endif;
        
    }
	
	public function getRawTaskDetails($id)
    {
		
		$this->db->where('id',$id);
        $query_current_tasks  = $this->db->get('tasks');
		
        if($query_current_tasks->num_rows <= 0):
            return "Sorry This Task Does Not Exist";
        endif;
		$result_current_tasks = $query_current_tasks->result();
		return $result_current_tasks;
    }
	
	public function getRawDetails($id ,$session)
    {
		
		$this->db->where('id',$id);
        $query_current_tasks  = $this->db->get('tasks');
		
        if($query_current_tasks->num_rows <= 0):
            return "Sorry This Task Does Not Exist";
        endif;
		$result_current_tasks = $query_current_tasks->result();
		return $result_current_tasks;
	}
	
	
	
	public function getDetails($id ,$session)
    {
		
		$this->db->where('id',$id);
        $query_current_tasks  = $this->db->get('tasks');
		
        if($query_current_tasks->num_rows <= 0):
            return "Sorry This Task Does Not Exist";
        endif;
		$result_current_tasks = $query_current_tasks->result();
		
		$table = '';
		//First Check the status of the task... 
		//This determines the action we will do!
		
		//This is still on the market so do a certain action for everyone and specfic action for owner of task
		if($result_current_tasks[0]->status == '0'):
			$table = $this->openTask($result_current_tasks, $session);
		
		//This task is in progress the only ones able to see is the owner and person doing task
		elseif(($result_current_tasks[0]->status == '1') || ($result_current_tasks[0]->status == '2') || ($result_current_tasks[0]->status == '3')):
			if(($result_current_tasks[0]->user_id == $session['userid']) || ($result_current_tasks[0]->reciever_id == $session['userid'])):
			$table = $this->closedTask($result_current_tasks, $session);
			
			else:
				$table = 'Sorry this task is now private.';
			endif;
		//Deleted task so nothing should show 
		elseif($result_current_tasks[0]->status == '4'):
			$table = 'This task has been deleted';
		
		endif;
		
        return $table;
    }
	
	public function closedTask($result, $session)
	{
		
        $count = 1;
		
		
        foreach($result as $task):
        $table = '<h2>'.$task->title.'</h2>';   
			
		if($task->status == '0'):
				$table .= '<h3>Status:	On Market<
							';
		elseif($task->status == '1'):
				$table .= '<h3>Status:	In Progress
							';
		elseif($task->status == '2'):
				$table .= '<h3>
							Status:	Completed
							';
		elseif($task->status == '3'):
				$table .= '<h3>
							Status:	Cancelled
							';
		endif;
		
		$time = $time = $this->get_time_ago(strtotime($task->datetime));
			
		 $table .= '- '.$time.'</h3>';
					
			
            $table .= '
			 <h4>Description<h4>
			
			 <p><strong>Meeting Place:</strong> '.$task->location.'</p>
						<p>'.$task->description.'</p>
			
					';
				
			  if($task->user_id == $session['userid']):
			  	$theuser = $task->reciever_id;
				else:
				$theuser = $task->user_id;
			endif;
			  
			  $this->load->model('model_users');
			  $profile_section_info['info'] = $this->model_users->getUserInformation($theuser);
			  $profile_section_info['trust'] = $this->model_users->getUserTrustPoints($theuser);
			  $profile_section_info['reward'] = $this->model_users->getUserRewardPoints($theuser);
			
			
			$trust2 = 0;
			//Calculate Points Here
			if(strlen($profile_section_info['info']->image)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->name)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->description)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->twitter)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->phone)):
				$trust2++;
			endif;
			if(strlen($profile_section_info['info']->location)):
				$trust2++;
			endif;
			
			$profile_section_info['trust'] += $trust2;
			
            $table .= '
				
					
				
					
							<img width="150" src="'.$profile_section_info['info']->image.'" />
					
						<h4>RooRunner</h4>
						<p>
						'.$profile_section_info['info']->name.'<br />
						Reward Points: '.$profile_section_info['reward'].'<br />
						Trust Points: '.$profile_section_info['trust'].'<br />
						Brief Introduction: '.$profile_section_info['info']->description.'<br />
						
						
						</p>
					';
				
			if($task->user_id == $session['userid']):
				$table .= '<a href="/manage/message/'.$task->id.'"><input type="button"  class="btn btn-large btn-primary" style="width:100%; margin-bottom:10px;" value="Send Message"/></a> 
									<a href="/manage/completeduser/'.$task->id.'"><input type="button"  class="btn btn-large btn-danger" style="width:100%; margin-bottom:10px;" value="End Run"/> </a>
									
									
									
								';
		 	else:
				$table .= '
									<a href="/manage/message/'.$task->id.'"><input type="button"  class="btn btn-large btn-primary" style="width:100%; margin-bottom:10px;" value="Send Message"/> </a>
									
							';
			endif;
		
             
            
            $count += 1;
        endforeach;
		return $table;
	}
	
	
	public function openTask($result, $session)
	{
		
        $count = 1;
		
		
        foreach($result as $task):
        $table = '
				<h2>'.$task->title.'</h2>';   
				
		if($task->status == '0'):
				$table .= '<h3>Status: On Market -
							';
		elseif($task->status == '1'):
				$table .= '<h3>Status: In Progress - 
							';
		elseif($task->status == '2'):
				$table .= '<h3>
							Status:	Completed - 
							
							';
		elseif($task->status == '3'):
				$table .= '<h3>
							Status:	Cancelled - 
							
							';
		endif;
		
		$time = $time = $this->get_time_ago(strtotime($task->datetime));
			
		 $table .= ''.$time.'</h3><div >';
		
            $table .= '<h4>Description</h4>';
						
						
			$table .= '<p ><strong>Meeting Place:</strong> '.$task->location.'
						<br />'.$task->description.'</p> </div>';
			
           
				
			if($task->user_id == $session['userid']):
				$table .= '<div>
									<a href="/manage/update/'.$task->id.'"><input type="button"  class="btn btn-large btn-primary" style="width:100%; margin-bottom:10px;" value="Update"></a> 
									
									<a href="/manage/delete/'.$task->id.'"><input type="button"  class="btn btn-large btn-danger" style="width:100%;" value="Delete"/></a></div>
							';
		 	else:
				$table .= '<div><a href="/manage/accept/'.$task->id.'"><input type="button"  class="btn btn-large btn-primary" style="width:100%; margin-bottom:10px;" value="Accept Task"/></a></div>';
			endif;
	
        endforeach;
		return $table;
	}
	
	
	public function getPastJobs($session)
    {
		//var_dump($session['userid']);
		//$where = "status`='1' OR 'status'='0'";
        
        $this->db->where("(status = '3' OR status = '2') 
                   AND user_id = '{$session['userid']}' ");
        $this->db->order_by('datetime', 'DESC');
        $query_current_tasks  = $this->db->get('tasks');
		//var_dump($query_current_tasks);
		
        if($query_current_tasks->num_rows <= 0):
            return "There Are No Tasks";
        endif;
        $result_current_tasks = $query_current_tasks->result();
        $table = '';
        $count = 1;
        foreach($result_current_tasks as $task):
            $table .= '<a href="/manage/task/'.$task->id.'"><article class="is-post is-post-excerpt"><div class="row"><div class="3u">';
			
		if($task->status == '2'):
				$table .= '<span class="byline">Completed</span>';
			else:
				$table .= '<span class="byline">Canceled</span>';
			endif;
			
			$table .= '</div>';
            $table .= '<div class="7u"><span class="byline">'.$task->title.'</span></div></div>';
			
            $table .= "<p>$task->description</p>";
             
            $table .= "</article></a>";
           $table .= "<hr style='width:100%'/>";
            $count += 1;
        endforeach;
        
        return $table;
    }
	
	public function delete($id, $session)
    {
		
        
        $this->db->where("user_id", $session['userid']);
		$this->db->where("id", $id);
        $query_current_tasks  = $this->db->get('tasks');
		//var_dump($query_current_tasks);
		
        if($query_current_tasks->num_rows <= 0):
            return false;
        endif;
		
		$results_task = $query_current_tasks->result();
		
		//If status was in progress send a survey to the user and the runner notifying the runner...
		/*
		if($results_task[0]->status == 1):
			
			  $this->load->model('model_users');
			  $message['user'] = $this->model_users->getUserInformation($results_task[0]->user_id);
			  $message['reciever'] = $this->model_users->getUserInformation($results_task[0]->reciever_id);
			  
			  $reponse = $this->sendTheMessages($message['user'], '');
			  
			  $reponse = $this->sendTheMessages($message['reciever'], 'reciever');
			  
					
		
		endif;
		
		*/
		
		if(!$this->db->delete('tasks', array('id' => $id))):
			return false;
		else:
			return true;
		endif; 
		
	
    }
	
	public function sendTheMessages($user, $type)
	{
		//Send text message first...
		$this->load->library('twilio');	  
		//Our Number 
		$from = '6158618612';
		//The Runner Number
		$to = $user[0]->phone;
		//
		$message = 'Hey '.$user[0]->name.', a new task has been posted. "'.$post['title'].'" Go to www.roorunner.com for more details.';
	  
			  $response = $this->twilio->sms($from, $to, $message);
					 
						
			  $this->load->library('email_library');
			  
			  //Our Number 
			  $from = '6158618612';
			  
			  //The Runner Number
			  $to = $runner->phone;
			  $message = 'Hey '.$runner->name.', <br/> A new task has been posted. <br /><br />'.$post['title'].' Go to www.roorunner.com for more details.';
	  
			  $response = $this->email_library->sendEmail('New Available Run', $message , $runner->name.'<'.$runner->email.'>');
					
		
	}
	
	
	
    public function getMusicTable()
    {
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('position', 'ASC');
        $query_music_applications_song = $this->db->get('music_applications_songs');
        if($query_music_applications_song->num_rows <= 0):
            
            return "<tr><td>No songs uploaded</td><td></td><td></td><td></td></tr>";
        endif;
        
        $table = '';
        $result_music_applications_song = $query_music_applications_song->result();
        foreach($result_music_applications_song as $song):
            $table .= "<tr id='{$song->id}'>";
            $table .= "<td>{$song->position}</td>";
            $table .= "<td>Song's Name:  " . $song->song_name . "<br />Song's Artist:  " . $song->song_artist . "</td>";
            $table .= "<td>" . "<a href='http://connect.shwcase.co/{$song->song_stored}' class='btn btn-primary'>Preview Song</a>" . "</td>";
            $table .= "<td>" . "<a href='#editmusic' class='edit_song_link' data-id='{$song->id}' data-toggle='modal'><img src='/images/edit2.png' style='width:25px'></a><a href='#' class='delete_song' data-id='{$song->id}'  date-app_id='$this->App_ID' ><img src='/images/delete.png'  style='width:30px'>" . "</td>";
            
            $table .= "</tr>";
       endforeach;
       
       return $table;
    }
    
    public function getApplicationProfile(){
        
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications_profile = $this->db->get('music_applications_profile');
        
        if($query_music_applications_profile->num_rows == 0):
            throw new Exception("No application was found.");
        endif;
        $result_music_applications_profile = $query_music_applications_profile->result();
        
        $page_array = array();
        foreach($result_music_applications_profile as $row):
            $page_array[$row->name] = $row->value;
        endforeach;
        return $page_array;
        
        
    }
    
    public function getMainApplictionFields()
    {
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications = $this->db->get('music_applications');
        if($query_music_applications->num_rows != 1):
            throw new Exception("Error getting applcition information");
        endif;
        $result_music_applications = $query_music_applications->result();
        $info = array();
        $info['phone'] = $result_music_applications[0]->phone;
        $info['about'] = $result_music_applications[0]->about;
        $info['email'] = $result_music_applications[0]->email;
        $info['website'] = $result_music_applications[0]->website;
        return $info;
        
    }
	
	public function getUser()
    {
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications = $this->db->get('applications');
        if($query_music_applications->num_rows != 1):
            throw new Exception("Error getting applcition information");
        endif;
        $result_music_applications = $query_music_applications->result();
        
		$this->db->where('id', $result_music_applications[0]->artist_id);
        $query_music_applications = $this->db->get('artists');
        if($query_music_applications->num_rows != 1):
            throw new Exception("Error getting applcition information");
        endif;
        $result_music_applications = $query_music_applications->result();
		
		$info = array();
		$info['genre'] = $result_music_applications[0]->music_type;
		$info['web_ext'] = $result_music_applications[0]->web_ext;
        
        return $info;
        
    }
}

?>