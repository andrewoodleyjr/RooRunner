<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author GOI LLC
 * 
 * The music_application_defined id = 1; 
 */
include('model_musicapps.php');
class model_insert_update_music_app2 extends model_musicapps{
    //put your code here
    
       private $upload_path = '/home2/adthrif1/public_html/connect_showcase/files/apps/';

    
    public function __construct() 
    {

        parent::__construct();
        
    }
    
    private function catch_errors($e)
    {
              
        return $this->catch_errors($e);
    }
    
    public function create_in_app_purchase($App_ID, $credits){
        
        $this->db->where('App_ID', $App_ID);
        $this->db->where('credits', $credits);
        $query_InAppPurchases = $this->db->get('InAppPurchases');
        if($query_InAppPurchases->num_rows != 0):
            return json_encode(array('error' => '1', 'message' => 'App credits already exist.' ));
        endif;
        $name = "co." . $App_ID . '.' . $credits;
        $inApp = array('name' => $name, 'credits' => $credits, 'App_ID' => $App_ID);
        
        if(!$this->db->insert('InAppPurchases', $inApp)):
                        return json_encode(array('error' => '1', 'message' => 'Error adding the in app purchase please try again.' ));
        endif;
        
        $this->load->model('model_page_entertainment');
        $this->model_page_entertainment->initialize($App_ID);
        $table = $this->model_page_entertainment->assembleInAppPurchaseData();
        
        return json_encode(array('error' => '0', 'table' => $table));
    }
    
    public function delete_in_app_purchase($App_ID, $inApp_id){
        $this->db->where('App_ID', $App_ID);
        $this->db->where('id', $inApp_id);
        if(!$this->db->delete('InAppPurchases')):
            return json_encode(array('error' => '1', 'message' => 'Error, not able to delete please contact admin'));
        endif;
        
        $this->load->model('model_page_entertainment');
        $this->model_page_entertainment->initialize($App_ID);
        $table = $this->model_page_entertainment->assembleInAppPurchaseData();
        
        return json_encode(array('error' => '0', 'table' => $table));
        
    }
    
    public function Add_Song()
    {
        
        
        if(!$this->run_app):
                throw new Exception("Error, please initialize before running the applicatons");
        endif;
            
        $post = $this->input->post();
        if(!isset($post['add_song_name']) || !isset($post['add_artist']) || !isset($_FILES['add_music_file']) ):
            throw new Exception("Not enough information to add song.");
        endif;
       
        $position = 1;
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('position', 'DESC');
        $query_music_applications_song  = $this->db->get('music_applications_songs');
        if($query_music_applications_song->num_rows > 0):
            $result_music_applications_song = $query_music_applications_song->result();
            $position = $result_music_applications_song[0]->position + 1;
        endif;
        
        
        
        $insert_song = array();
        $insert_song['song_name'] = $post['add_song_name'];
        $insert_song['song_artist'] = $post['add_artist'];
        $insert_song['datecreated'] = date('Y-m-d H:i:s');
        $insert_song['affiliate_link'] = '';
        $insert_song['position'] = $position;
        $insert_song['song_type'] = '';
        
        if(!isset($_FILES['add_music_file']) || $_FILES['add_music_file']['error'] != 0):
            throw new Exception("No File was found.");
        endif;
        
        $insert_song['song_stored'] = '';
        $insert_song['App_ID'] = $this->App_ID;
        if(!$this->db->insert('music_applications_songs', $insert_song)):
            throw new Exception("Error inserting into the database");
        endif;
        $song_id = $this->db->insert_id();
        $song_name = md5($this->App_ID . "_Song_" . $song_id);
        
        $fileArray = array();
        $fileArray['nameOfPostVariable'] = 'add_music_file';
        $fileArray['filename'] = $song_name;
        $fileArray['folder']  = $this->upload_path;
        $fileArray['size'] = 100000;
        $fileArray['filetype'] = 'mp3|wav|aac|ogg';

        $this->load->library('general_library');
        $gl = new general_library();
       
        $file_info = $gl->uploadpic($fileArray);
        $song_file = 'files/apps/'. $song_name . $file_info["file_ext"];
        if(!$this->db->update('music_applications_songs', array('song_stored' =>  $song_file, 'song_type' => $file_info['file_type']), "id = $song_id")):
            throw new Exception("Error recording song file");
        endif;
        
        return true;
        
        
    }
    public function getSingleMusic($id)
    {
        
        $this->db->where('id', $id);
        $query_music_applications_songs = $this->db->get('music_applications_songs');
        
        if($query_music_applications_songs->num_rows != 1):
            throw new Exception("Error getting song information.");
        endif;
        
        $result_music_applications_songs = $query_music_applications_songs->result();
        
        $json_array = array();
        $json_array['song_name'] = $result_music_applications_songs[0]->song_name;
        $json_array['aff_link'] = $result_music_applications_songs[0]->affiliate_link;
        $json_array['song_artist'] = $result_music_applications_songs[0]->song_artist;
        return json_encode($json_array);
        
    }
    
    public function edit_music()
    {
        
        $post = $this->input->post();
        if(!isset($post['edit_song_name']) || !isset($post['edit_artist']) || !isset($post['song_id'])):
            throw new Exception("Not enough information was provided to edit the song.");
        endif;
    
        
        $this->db->where('id', $post['song_id']);
        $query_music_applications_songs = $this->db->get('music_applications_songs');
        if($query_music_applications_songs->num_rows != 1):
            throw new Exception("Error getting information about the song.");
        endif;
        $result_music_applications_songs = $query_music_applications_songs->result();
        if(file_exists($this->upload_path. str_replace("http://connect.shwcase.co", "", $result_music_applications_songs[0]->song_stored))):
            unlink($this->upload_path. str_replace("http://connect.shwcase.co", "", $result_music_applications_songs[0]->song_stored));
        endif;
        
        

        
        $update_music_applications_songs = array();
        $update_music_applications_songs['song_name'] = $post['edit_song_name'];
        $update_music_applications_songs['song_artist'] = $post['edit_artist'];
        if($_FILES['edit_music_file']['error'] == 0):
            $this->load->library('general_library');
            $gl = new general_library();
            $song_name = md5($this->App_ID . "_Song_" . $post['song_id']);
            $fileArray = array();
            $fileArray['nameOfPostVariable'] = 'edit_music_file';
            $fileArray['filename'] = $song_name;
            $fileArray['folder']  = $this->upload_path;
            $fileArray['size'] = 100000;
            $fileArray['filetype'] = 'mp3|wav|AAC|Ogg';
            $file_info = $gl->uploadpic($fileArray);
            $song_file = '/files/apps/'. $song_name . $file_info["file_ext"];       
            $update_music_applications_songs['song_stored'] = 'http://connect.shwcase.co'. $song_file;
            $update_music_applications_songs['song_type'] = $file_info['file_type'];
            endif;
            
       if(!$this->db->update('music_applications_songs', $update_music_applications_songs, "id = {$post['song_id']}")):
          throw new Exception("Error updating file");  
       endif; 
       
       return true;
    }
    
    public function Add_Instagram_HashTag($tag_name)
    {
        $position = 1;
        $this->db->select('position');
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications_instagram = $this->db->get('music_applications_instagram');
        if($query_music_applications_instagram->num_rows > 0):
            $position  += $query_music_applications_instagram->num_rows;
        endif;
        
        $insert_music_applications_instagram = array();
        $insert_music_applications_instagram['hash_tag'] = $tag_name;
        $insert_music_applications_instagram['position'] = $position;
        $insert_music_applications_instagram['App_ID'] = $this->App_ID;
        if(!$this->db->insert('music_applications_instagram', $insert_music_applications_instagram)):
            throw new Exception("Error inserting data for the table");
        endif;
        
        return true;
    }
    
    public function delete_music($id)
    {
        $this->db->where('id', $id);
        $query_music_applications_songs = $this->db->get('music_applications_songs');
        $result_music_applications_songs = $query_music_applications_songs->result();
        if(isset($result_music_applications_songs[0]->song_stored) && 
        file_exists($this->upload_path. str_replace("http://connect.shwcase.co", "", $result_music_applications_songs[0]->song_stored))):
            unlink($this->upload_path. str_replace("http://connect.shwcase.co", "", $result_music_applications_songs[0]->song_stored));
        endif;
        
        $this->db->where('id', $id);
        if(!$this->db->delete('music_applications_songs')):
            throw new Exception("Error deleting file from database");
        endif;
        
        
        $this->load->model('model_page_entertainment');
        $this->model_page_entertainment->initialize($this->App_ID, $this->_result_applications);
        $json_returned = array();
        $json_returned['table'] = $this->model_page_entertainment->getMusicTable();
        $json_returned['message'] = "You have deleted the song";
        return json_encode($json_returned);
    }
    
    public function edit_song_position(){
        $post = $this->input->post();
        $json = json_decode($post['position']);
       
        foreach($json as $song):
             $update_song = array();
            $update_song['id'] = $song->id;
            $update_song['position'] = $song->position;
            if(!$this->db->update('music_applications_songs', $update_song, "id = {$song->id}")):
                throw new Exception("Error updating the menu");
            endif;
        endforeach;
        $this->load->model('model_page_entertainment');
        $this->model_page_entertainment->initialize($this->App_ID, $this->_result_applications);
        $json_returned = array();
        $json_returned['table'] = $this->model_page_entertainment->getMusicTable();
        return $json_returned;
    }
    
    public function record_music_profile($App_ID){
            
            $post = $this->input->post();
            if(!isset($post['json'])):
                throw new Exception("Error getting post information");
            endif;
            
            $fields = json_decode($post['json']);
            foreach($fields as $field):
                $query = $this->helper_is_there_profile($field, $App_ID);
                
                if($query):
                   $profile = $this->helper_update_profile($field->value, $query);
                else:    
                    $insert_arr = array();
                    $insert_arr['value'] = $field->value;
                    $insert_arr['name'] = $field->name;
                    $insert_arr['value_type'] = 'text';
                    $insert_arr['isFile'] = 0;
                    $insert_arr['App_ID'] = $App_ID;
                    $profile = $this->helper_insert_profile($insert_arr);
                endif;

            endforeach;
            if(!isset($profile) || $profile == false):
                throw new Exception("Error getting update/insert query.");
            endif;
            
            return true;
    }
    
     public function edit_hashtag($tag_name, $tag_id)
     {
         $update_hashtag = array();
         $update_hashtag['hash_tag'] = $tag_name;
         if(!$this->db->update('music_applications_instagram', $update_hashtag, array('id' => $tag_id, 'App_ID' => $this->App_ID))):
             throw new Exception("Error updating app information.");
         endif;
         
         return true;
     }
     
     public function change_hashtag_position(){
         $post = $this->input->post();
         if(!isset($post['json'])):
             throw new Exception("Error updating position for hash tags");
         endif;
         $json = json_decode($post['json']);
         foreach($json as $tag):
             if(!$this->db->update('music_applications_instagram', 
                     array('position' => $tag->position), "id = {$tag->tag_id}" )):
                 throw new Exception("Error updating position");
             endif;
        endforeach;
        
        return true;
     }
     
     public function updateTheme()
     {
         $post = $this->input->post();
         if(!isset($post['tabbar']) || !isset($post['tabbar_select_button']) || 
            !isset($post['tabbar_select_text']) || !isset($post['background']) || !isset($post['list_background'])
                 || !isset($post['background']) || !isset($post['font'])):
             throw new Exception("Error not enough info was sent.");
         endif;
         if(count($post) != 7):
             throw new Exception("Bad information was provide for updating the colors, please contact admin.");
         endif;
         
         
         
         
         foreach($post as $key => $val):
             if($key == "font"):
                 $this->changeFonts($key);
                 continue;
              endif;
             
         $this->db->where('name', $key);
         $this->db->where('App_ID', $this->App_ID);
         $query_music_applications_colors = $this->db->get('music_applications_colors');
         if($query_music_applications_colors->num_rows == 0):
             
             $this->helper_insertTheme($key);
             
             elseif($query_music_applications_colors->num_rows == 1):
             
             $this->helper_updateTheme($key);
             
             else:
             
             throw new Exception("Error duplicat information");
             
         endif;
         
         endforeach;
         
         return true;
         
     }
     
     private function changeFonts($name){
         $post = $this->input->post();
         $this->db->where('font_name', $name);
         $this->db->where('App_ID', $this->App_ID);
         $query_music_applications_fonts = $this->db->get('music_applications_fonts');
         $result_music_applications_fonts = $query_music_applications_fonts->result();
         $row_count = count($result_music_applications_fonts);
         if($row_count == 0):
             $insert_music_applications_fonts = array();
             $insert_music_applications_fonts['font_name'] = $name;
             $insert_music_applications_fonts['font_type'] = $post[$name];
             $insert_music_applications_fonts['App_ID'] = $this->App_ID;
             if(!$this->db->insert('music_applications_fonts', $insert_music_applications_fonts)):
                 throw new Exception("Error add font data");
             endif;
         elseif($row_count == 1):
             $update_music_applications_fonts = array();
             $update_music_applications_fonts['font_type'] = $post[$name];
             $update_by = array();
             $update_by['font_name'] = $name;
             $update_by['App_ID'] = $this->App_ID;
             if(!$this->db->update('music_applications_fonts', $update_music_applications_fonts, $update_by )):
                 throw new Exception("Error with font data");
             endif;
         else:
             throw new Exception("Error duplicate data");
         endif;
     }
     
     
     private function helper_insertTheme($name)
     {
                  $post = $this->input->post();

         $insert_music_applications_colors = array();
         $json_color = json_decode($post[$name]);
         $insert_music_applications_colors['r'] = $json_color->r;
         $insert_music_applications_colors['g'] = $json_color->g;
         $insert_music_applications_colors['b'] = $json_color->b;
         $insert_music_applications_colors['alpha'] = $json_color->a;
         $insert_music_applications_colors['hex_color'] = $json_color->hex;
         $insert_music_applications_colors['name'] = $name;
         $insert_music_applications_colors['App_ID'] = $this->App_ID;
         if(!$this->db->insert('music_applications_colors', $insert_music_applications_colors)):
             throw new Exception("Error inserting color data");
         endif;
     }
     
     private function helper_updateTheme($name)
     {
         $post = $this->input->post();
         $update_music_applications_colors = array();
         $json_color = json_decode($post[$name]);

         $this->db->where('App_ID', $this->App_ID);
         $this->db->where('name', $name);
         $query_music_applications_colors = $this->db->get('music_applications_colors');
         if($query_music_applications_colors->num_rows != 1):
             throw new Exception("Error duplicate data");
         endif;
         $update_music_applications_colors['r'] = $json_color->r;
         $update_music_applications_colors['g'] = $json_color->g;
         $update_music_applications_colors['b'] = $json_color->b;
         $update_music_applications_colors['alpha'] = $json_color->a;
         $update_music_applications_colors['hex_color'] = $json_color->hex;
         $update_music_applications_colors['name'] = $name;
         $update_by = array('App_ID' => $this->App_ID, 'name' => $name);
         if(!$this->db->update('music_applications_colors', $update_music_applications_colors, $update_by)):
             throw new Exception("Error updating color data");
         endif;
         

     }
     
     public function change_position()
     {
         $post = $this->input->post();
         if(!isset($post['json'])):
             throw new Exception("Error getting json");
         endif;
         
         $link_position = json_decode($post['json']);
         foreach($link_position as $link):
             $id = $link->id;
             if(!$this->db->update('music_applications_links', array('position' => $link->position), "id = $id")):
                 throw new Exception("Error updating position of link table");
             endif;
         endforeach;
         
         return true;
     }
     
     public function edit_link(){
         
         $post = $this->input->post();
         if(!isset($post['link_location']) || !isset($post['link_name']) || !isset($post['link_id'])):
             throw new Exception("Error no post data");
         endif;
         
         $id = $post['link_id'];
         $update_music_applications_links = array();
         $update_music_applications_links['link_name'] = $post['link_name'];
         $update_music_applications_links['link_url'] = $post['link_location'];
         if(!$this->db->update('music_applications_links', $update_music_applications_links, "id = $id")):
             throw new Exception('Error updating the link');
         endif;
         
         return true;
     }
     
     public function delete_link($link_id){
         $this->db->where('id', $link_id);
         if(!$this->db->delete('music_applications_links')):
             throw new Exception("Error deleting link");
         endif;
         return;
     }
     
     public function add_link()
     {
         $post = $this->input->post();
         if(!isset($post['link_location']) || !isset($post['link_name'])):
             throw new Exception("Error no post data");
         endif;
         
         
         $position = 1;
         $this->db->where('App_ID', $this->App_ID);
         $query_music_applications_links = $this->db->get('music_applications_links');
         if($query_music_applications_links->num_rows > 0):
             
             $position += $query_music_applications_links->num_rows;
             
         endif;
         
         $insert_music_applications_links = array();
         $insert_music_applications_links['link_name'] = $post['link_name'];
         $insert_music_applications_links['link_url'] = $post['link_location'];
         $insert_music_applications_links['App_ID'] = $this->App_ID;
         $insert_music_applications_links['position'] = $position;
         if(!$this->db->insert('music_applications_links', $insert_music_applications_links)):
             throw new Exception("Error adding link.");
         endif; 
         
         return true;
     }  
     
     public function delete_hashtag($tag_id){
         
         $this->db->where('App_ID', $this->App_ID);
         $this->db->where('id', $tag_id);
         if(!$this->db->delete('music_applications_instagram')):
             throw new Exception("Error delete hash tag");
         endif;
         
         return true;
     }
    
        
        public function deleteCommentOnFanWall($comment_id)
         {
        $this->db->where('id', $comment_id);
        $query_music_applications_fanwall = $this->db->get('music_applications_fanwall');
        
        if($query_music_applications_fanwall->num_rows != 1):
            throw new Exception('Error getting comment information');
        endif;
        
        $this->db->where('id', $comment_id);
        if(!$this->db->delete('music_applications_fanwall')):
            throw new Exception('Error deleting comment');
        endif;
        
        $this->load->model('model_page_entertainment');
        $this->model_page_entertainment->initialize($this->App_ID, $this->_result_applications);
        $json_returned = array();
        $json_returned['table'] = $this->model_page_entertainment->getFanWallTable();
        $json_returned['message'] = "You have just deleted the comment.";
        $json_returned['error'] = 0;
        return $json_returned;
       

       }
       
       public function add_event()
       {
           $post = $this->input->post();
           if(!isset($post['add_events_name'])     || !isset($post['add_events_category'])   || 
              !isset($post['add_events_venue'])    || !isset($post['add_events_address'])    ||
              !isset($post['add_events_city'])     || !isset($post['add_events_state'])      || 
              !isset($post['add_events_zip'])      || !isset($post['add_events_startdate'])  ||
              !isset($post['event_add_starttime']) || !isset($post['event_add_enddate'])     ||
              !isset($post['event_add_endtime'])   || !isset($post['event_add_description'])):
               throw new Exception(print_r($post));
               endif;
               
               $insert_event = array();
               $insert_event['event_name'] = $post['add_events_name'];
               $insert_event['start_date'] = date('Y-m-d H:i:s', strtotime($post['add_events_startdate'] . $post['event_add_starttime']));
               $insert_event['end_date'] = date('Y-m-d H:i:s', strtotime($post['event_add_enddate'] . $post['event_add_endtime']));
               $insert_event['street'] = $post['add_events_address'];
               $insert_event['city'] = $post['add_events_city'];
               $insert_event['state'] = $post['add_events_state'];
               $insert_event['zip'] = $post['add_events_zip'];
               $insert_event['venue_name'] = $post['add_events_venue'];
               $insert_event['category'] = $post['add_events_category'];
               $insert_event['description'] = $post['event_add_description'];
               $insert_event['App_ID'] = $this->App_ID;
               $insert_event['datecreated'] = date('Y-m-d H:i:s');
               
               if(!$this->db->insert('music_applications_events', $insert_event)):
                   throw new Exception("Error inserting event, please contact admin");
               endif;
               
               return true;
       }
       
       public function get_event_by_id($event_id)
       {
           $this->db->where('id', $event_id);
           $query_music_applications_events = $this->db->get('music_applications_events');
           
           if($query_music_applications_events->num_rows != 1):
               throw new Exception("Error getting event id.");
           endif;
           
           $result_music_applications_events = $query_music_applications_events->result();
           $event = $result_music_applications_events[0];
           $event->edit_events_startdate = date('m/d/Y', strtotime($event->start_date));
           $event->event_edit_starttime = date('g:i a', strtotime($event->start_date));
           $event->event_edit_enddate = date('m/d/Y', strtotime($event->end_date));
           $event->event_edit_endtime = date('g:i a', strtotime($event->end_date));

           return json_encode($result_music_applications_events[0]);
           
       }
    
       public function edit_event(){
           $post = $this->input->post();
           if(!isset($post['edit_events_name'])     || !isset($post['edit_events_category'])   || 
              !isset($post['edit_events_venue'])    || !isset($post['edit_events_address'])    ||
              !isset($post['edit_events_city'])     || !isset($post['edit_events_state'])      || 
              !isset($post['edit_events_zip'])      || !isset($post['edit_events_startdate'])  ||
              !isset($post['event_edit_starttime']) || !isset($post['event_edit_enddate'])     ||
              !isset($post['event_edit_endtime'])   || !isset($post['event_edit_description']) ||
              !isset($post['event_id'])):
               throw new Exception(print_r($post));
               endif;
               $id = $post['event_id'];
               $update_event = array();
               $update_event['event_name'] = $post['edit_events_name'];
               $update_event['start_date'] = date('Y-m-d H:i:s', strtotime($post['edit_events_startdate'] . $post['event_edit_starttime']));
               $update_event['end_date'] = date('Y-m-d H:i:s', strtotime($post['event_edit_enddate'] . $post['event_edit_endtime']));
               $update_event['street'] = $post['edit_events_address'];
               $update_event['city'] = $post['edit_events_city'];
               $update_event['state'] = $post['edit_events_state'];
               $update_event['zip'] = $post['edit_events_zip'];
               $update_event['venue_name'] = $post['edit_events_venue'];
               $update_event['category'] = $post['edit_events_category'];
               $update_event['description'] = $post['event_edit_description'];
               if(!$this->db->update('music_applications_events', $update_event, "id = $id")):
                   throw new Exception("Error updating the event");
               endif;
               
               return true;
       }
       
       public function delete_event($event_id)
       {
           $this->db->where('id', $event_id);
           if(!$this->db->delete('music_applications_events')):
               throw new Exception("Error deleting the event");
           endif;
        $this->load->model('model_page_entertainment');
        $this->model_page_entertainment->initialize($this->App_ID, $this->_result_applications);
        $json_returned = array();
        $json_returned['table'] = $this->model_page_entertainment->getEventTable();
        $json_returned['message'] = "You have just deleted the event.";
        $json_returned['error'] = 0;
        return $json_returned;
       }
    
    
    public function delete_all_music()
    {
        
    }
      
    public function add_youtube()
    {
        
    }
    

}

?>
