<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entertainment
 *
 * @author GOI LLC
 */
require_once('check.php');
class entertainment2 extends check
{
    
    
    private $entertain_model;
    
    public $_menu = '<li class="active"><a href="/manage/" style="color:">Home</a></li>
              <li ><a href="/setting/">Settings</a></li>
              <li><a href="/manage/faq">Help</a></li>
              <li><a href="/logout/">Sign Out</a></li>';
    
    public function __construct() {
        parent::__construct();
        
        
        try
        {
            $this->load->model('model_insert_update_music_app2');
            $this->entertain_model = new model_insert_update_music_app();
            $this->entertain_model->initialize($this->uri->segment(3));
            
            
        }
        catch(Exception $e)
        {
            $this->catch_errors($e);
        }
      
    }
    
    private function catch_errors($e)
    {
                 $login = array();
               $header = array('menu' => $this->_menu);
                $header['title'] = 'error';
              $login['error'] = $e->getMessage(); 
              $header['stylesheets'] = '<link href="/scripts/css/main.css" rel="stylesheet" media="all" type="text/css" />';
              $this->load->view('header', $header);
              $this->load->view('menu');
              $this->load->view('error', $login);
              $this->load->view('footer');    
    }
    
    public function create_in_app_purchase($App_ID, $number_credits){
        try
        {
           $this->load->model('model_insert_update_music_app');
           $this->output->set_output($this->model_insert_update_music_app->create_in_app_purchase($App_ID, $number_credits));
        }
        catch(Exception $e)
        {
            
        }
    }
    
    public function delete_in_app_purchase($App_ID, $inApp_ID){
        try
        {
           $this->load->model('model_insert_update_music_app');
           $this->output->set_output($this->model_insert_update_music_app->delete_in_app_purchase($App_ID, $inApp_ID));
           

        }
        catch(Exception $e)
        {
            
        }
    }
    
    public function add_Instragram($App_ID, $tag_name)
    {
            try
            {
                $this->entertain_model->Add_Instagram_HashTag($tag_name);
                $json_return = array();
                $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getInstragramTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function edit_Instragram($App_ID, $tag_name, $tag_id)
    {
          try
            {
            
            $this->entertain_model->edit_hashtag($tag_name, $tag_id);
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getInstragramTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function delete_Instragram($App_ID, $tag_id)
    {
          try
            {
            
            $this->entertain_model->delete_hashtag($tag_id);
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getInstragramTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function changeposition($App_ID){
          try
            {
            
            $this->entertain_model->change_hashtag_position();
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getInstragramTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function add_link($App_ID)
    {
           try
            {
            
            $this->entertain_model->add_link();
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getLinkTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
        public function edit_link($App_ID)
    {
           try
            {
            
            $this->entertain_model->edit_link();
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getLinkTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function delete_link($App_ID, $link_id){
          try
            {
            
            $this->entertain_model->delete_link($link_id);
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getLinkTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function themechange($App_ID){
         try
            {
            $this->entertain_model->updateTheme();  
            $this->output->set_output("You have successfully updated the colors.");
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
        
    }
    
    public function position_link($App_ID){
          try
            {
            $this->entertain_model->change_position();
            $json_return = array();
            $json_return['error'] = 0;
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);     
            $json_return['table'] = $this->model_page_entertainment->getLinkTable();
            $json_return['error'] = 0;
            $this->output->set_output(json_encode($json_return));
            
            }
            catch(Exception $e)
            {
                $this->output->set_output(strip_tags($e->getMessage()));
            }
    }
    
    public function add_record_songs($App_ID)
    {
         try
           {
             
             
            
             $recorded = $this->entertain_model->Add_Song();
             if($recorded == true):
             $this->load->helper('url');
             redirect("/process/music", "refresh");
             return true;                
             endif;
           }
           catch(Exception $e)
           {
             $this->catch_errors($e);
           } 
            
    }
    
    public function get_song_edit($id)
    {
     try{
         $json = $this->entertain_model->getSingleMusic($id);
         $this->output->set_output($json);
         return true;
        }
        catch(Exception $e)
        {
            $this->output->set_output(strip_tags($e->getMessage()));
        }
    }
    
    public function edit_song($App_ID)
    {
        try{
            $edited = $this->entertain_model->edit_music();
            if($edited):
                $this->load->helper('url');
                redirect("/process/music", 'refresh');
                return true;
                else:
                return false;
            endif;
            
           }
           catch(Exception $e)
           {
               $this->catch_errors($e);
           }
        
    }
    
    public function delete_song($App_ID, $song_id)
    {
        try
        {
           $json = $this->entertain_model->delete_music($song_id);
            $this->output->set_output($json);
            return true;
        }
        catch(Exception $e)
        {
          $this->output->set_output(strip_tags($e->getMessage()));
        }
    }
    
    public function change_song_position($App_ID)
    {
        try
        {
           $json_ret = $this->entertain_model->edit_song_position();
           if($json_ret):
               $json_ret['error'] = 0;
               $json_ret['message'] = "You have successfully update the song's positions";
               $this->output->set_output(json_encode($json_ret));
               return true;
               else:
               $json_ret = array();
               $json_ret['error'] = 1;
               $json_ret['message'] = "Error update the menu position.";
               $this->output->set_output(json_encode($json_ret));
               return true;
           endif;
        }
        catch(Exception $e)
        {
           $json_ret = array();
               $json_ret['error'] = 1;
               $json_ret['message'] = $e->getMessage();
               $this->output->set_output(json_encode($json_ret));
               return true; 
    }
    }
    
    public function simple_record($App_ID)
    {
        try
        {
            
            
           $json = array();
           if(!$this->entertain_model->record_music_profile($App_ID)):
              $json['message'] = "Error getting information";
              $json['error'] = 1;
           else:
               $json['message'] = "You have successfully updated the information";
               $json['error'] = 0;
           endif;
            
            
           $this->output->set_output(json_encode($json));
           
           
            
         }
        catch(Exception $e)
        {
             $json_ret = array();
               $json_ret['error'] = 1;
               $json_ret['message'] = $e->getMessage();
               $this->output->set_output($e->getMessage());
               return true; 
    } 
    }
    
    public function simple_record_main($App_ID)
    {
            try
            {
                $json = array();
                
                if(!$this->entertain_model->helper_update_main()):
                    $json['message'] = "Error getting information";
                    $json['error'] = 1;
                else:
                    $json['message'] = "You have successfully updated the information";
                    $json['error'] = 0;
                endif;
            
            
           $this->output->set_output(json_encode($json));            
            }
            catch(Exception $e)
            {
                 $json_ret = array();
               $json_ret['error'] = 1;
               $json_ret['message'] = $e->getMessage();
               $this->output->set_output($e->getMessage());
               return true; 
            }
    }
    
    public function delete_comment($App_ID, $comment_id){
        try
        {
 
          $json = $this->entertain_model->deleteCommentOnFanWall($comment_id);
          $this->output->set_output(json_encode($json));
          return true;
        }
        catch(Exception $e)
        {
            $json_ret = array();
            $json_ret['error'] = 1;
            $json_ret['message'] = $e->getMessage();
            $this->output->set_output($e->getMessage());
            return true; 
        }
    }
    
    public function add_event($App_ID)
    {
     try
        {
 
           $this->entertain_model->add_event();
          $this->load->helper('url');
		  //var_dump( 'hello World');
          redirect("/process/event", 'refresh');
          return true;
        }
        catch(Exception $e)
        {
            $this->catch_errors($e);
        } 
    }
    
    public function getEventByID($App_ID, $event_id){
        try
        {
          $json = $this->entertain_model->get_event_by_id($event_id);
          $this->output->set_output($json);
          return true;
        }
        catch(Exception $e)
        {
            $json_ret = array();
            $json_ret['error'] = 1;
            $json_ret['message'] = $e->getMessage();
            $this->output->set_output($e->getMessage());
            return true; 
        }
    }
    
    public function edit_event($App_ID)
     {
       try
        {
          $this->entertain_model->edit_event();
          $this->load->helper('url');
          redirect("/process/event", 'refresh');
          return true;
          }
        catch(Exception $e)
        {
           $this->catch_errors($e);
        }
    }
    
    public function get_table($App_ID, $hd)
    {
        try
        {
            $this->load->model('model_page_entertainment');
            
            $this->model_page_entertainment->initialize($App_ID);
            if($hd == 'show'):
            $table = $this->model_page_entertainment->getEventTable(true);
            else:
            $table = $this->model_page_entertainment->getEventTable(false);
            endif;
            $json = array();
            $json['table'] = $table;
            $json['error'] = 0;
            
            $this->output->set_output(json_encode($json));
            return true;
        }
        catch(Exception $e)
        {
            
        }
    }
    
    public function delete_event($App_ID, $event_id)
    {
        try
        {
         $json = $this->entertain_model->delete_event($event_id);
          $this->output->set_output(json_encode($json));
          return true;
          }
        catch(Exception $e)
        {
           $this->catch_errors($e);
        }       
    }
}

?>
