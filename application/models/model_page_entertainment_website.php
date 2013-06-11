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
class model_page_entertainment_website extends CI_Model{
    //put your code here
    
       private  $_result_applications;
       private  $App_ID;
    
    
   public function getPageInfo($App_ID)
   {		$this->App_ID = $App_ID;
            $page_info = array();
			$page_info['App_ID'] = $this->App_ID;
            //$page_info['music_table'] = $this->getMusicTable();
            //$page_info['fanwall'] = $this->getFanWallTable();
            $page_info['event_table'] = $this->getEventTable();
            $page_info['picture_table'] = $this->getInstragramTable();
            $page_info['link_table'] = $this->getLinkTable();
            //$page_info['table_inApp'] = $this->assembleInAppPurchaseData();
            foreach($this->getApplicationProfile() as $key => $val):
                $page_info[$key] = $val;
            endforeach;
            if($page_info['pollstar'] == ''):
                $page_info['pollstar_info'] = 'Use PollStar';
                else:
                $page_info['pollstar_info'] = "Use Regular Events";
            endif;
            
            $time_keys = array('30', '60', '90', '120', '150', 'full song');
            
            
            foreach($this->getMainApplictionFields() as $key => $val):
                $page_info[$key] = $val;
            endforeach;
            if(!isset($page_info["song_length"])):
                $page_info['song_length'] = '';
                foreach($time_keys as $val):
                    if($val != "full song"):
                        $page_info['song_length'] .= "<option value='$val' >$val seconds</option>";
                    else:
                        $page_info['song_length'] .= "<option value='$val' >$val</option>";
                    endif;
                endforeach;
                else:
                    foreach($time_keys as $val):
                        if($page_info['song_length'] == $val):
                            if($val != "full song"):
                                    $page_info['song_length'] .= "<option selected='selected' value='$val' >$val seconds</option>";
                                else:
                                    $page_info['song_length'] .=  "<option selected='selected' value='$val' >$val</option>";
                            endif;
                            else:
                              if($val != "full song"):
                                    $page_info['song_length'] .= "<option value='$val' >$val seconds</option>";
                                else:
                                    $page_info['song_length'] .=  "<option value='$val' >$val</option>";
                            endif;   
                            
                            
                        endif;
                    endforeach;
            endif;
            
            $color_array = $this->getThemeData();
			//var_dump($color_array);
            foreach($color_array as $key => $val):
                                $page_info[$key] = $val;
            endforeach;
            
           
            return $page_info;
   }
         
    public function initialize($App_ID, $_result_applications = null)
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
    
    public function getFanWallTable()
    {
         $this->db->where('App_ID', $this->App_ID);
         $this->db->order_by('datecreated', 'DESC');
         $query_music_applications_fanwall = $this->db->get('music_applications_fanwall');
         if($query_music_applications_fanwall->num_rows == 0):
             return "<tr><td>No Comments</td> <td></td> <td></td> </tr>";
         endif;
         $table = '';
         $phone_users_ids = array();
         $result_music_applications_fanwall = $query_music_applications_fanwall->result();
         foreach($result_music_applications_fanwall as $comment):
             $phone_users_ids[] = $comment->phone_users_id;
         endforeach;
         
         $phone_users_ids = array_unique($phone_users_ids);
         $this->db->where_in('id', $phone_users_ids);
         $query_phone_users = $this->db->get('phone_users');
         $result_phone_users = $query_phone_users->result();
         $array_customer_user_links_index_by_id = array();
         foreach($result_phone_users as $row):
             $name = $row->first_name . " " . $row->last_name;
             $array_customer_user_links_index_by_id[$row->id] = "<a href='{$row->link}'>$name</a>";
         endforeach;
         foreach($result_music_applications_fanwall as $comment):
             $table .= "<tr>";
             $table .= "<td>" . $comment->comment . "<br />" . $array_customer_user_links_index_by_id[$comment->phone_users_id] . "</td>";
             $table .= "<td>" . date('m/d/Y', strtotime($comment->datecreated)) . "</td>";
             $table .= "<td>" . "<a href='#'><img class='delete_wall' src='/images/delete.png' style='width:30px'data-id='{$comment->id}' /></a></td>";
            
             $table .= "</tr>";
         endforeach;
         return $table;
    }
    
    
    public function getLinkTable(){
        
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('position', 'ASC');
        $query_music_applications_links = $this->db->get('music_applications_links');
        if($query_music_applications_links->num_rows == 0):
            
            return "";
            
        endif;
        
        $table = '';
        $counter = 1;
        $result_music_applications_links = $query_music_applications_links->result();
        foreach($result_music_applications_links as $link):
            $link_assembled = "<a href='$link->link_url' target='_blank'>{$link->link_name}</a>";
            $table .= "<li>" . $link_assembled . "</li>";   
        endforeach;
        
        return $table;
        
    }
    
    public function assembleInAppPurchaseData(){
        $this->db->select('credits, name, id');
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('name');
        $query_inAppPurchase = $this->db->get('InAppPurchases');
        if($query_inAppPurchase->num_rows == 0):
            return "<tr> <td></td> <td>No In App Purchase</td> <td></td> <td></td> </tr>";
        endif;
        
        $table = '';
        $counter = 1;
        $result_inAppPurchases = $query_inAppPurchase->result();
        foreach($result_inAppPurchases as $inApp):
            $table .= "<tr>";
            $table .= "<td>$counter</td>";
            $table .= "<td>" . $inApp->name . "</td>";
            $table .= "<td>" . $inApp->credits . "</td>";
            $table .= "<td><a data-id='{$inApp->id}' class='delete_inApp' href='#' ><img   src='/images/delete.png' style='width:30px'></a></td>";
        
        $counter += 1;    
        endforeach;
        
        return $table;
    }
    
    
    private function assembleColors($color)
    {
      
      
      $ret_color = array();
      $color_json = array();
      //$color_json['r'] = $color->r;
      //$color_json['g'] = $color->g;
      //$color_json['b'] = $color->b;
      //$color_json['a'] = $color->alpha;
      $color_json['hex'] = $color->hex_color;
      $ret_color['json_' . $color->name] = htmlentities(json_encode($color_json));
      //$ret_color['rgba_' . $color->name] = "rgba(" . $color->r . ", " . $color->g . ", " . $color->b . ", " . $color->alpha . ")"; 
      $ret_color['hex_' . $color->name] = $color->hex_color;
      return $ret_color;
    }
    
    public function getThemeData()
    {
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications_colors = $this->db->get('music_applications_colors');
        $result_music_applications_colors = $query_music_applications_colors->result();
        $colorBigArray = array();
        foreach($result_music_applications_colors as $color):
            $assemble_color = $this->assembleColors($color);
            foreach($assemble_color as $key => $val):
                $colorBigArray[$key] = $val; 
            endforeach;
        endforeach;
        
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications_fonts = $this->db->get('music_applications_fonts');
        if($query_music_applications_fonts->num_rows != 1):
            throw new Exception('Error duplicate font data');
        endif;
        $result_music_applications_fonts = $query_music_applications_fonts->result();
        $font = $result_music_applications_fonts[0];
        $colorBigArray['selected_font'] = "<option selected='selected' value='{$font->font_type}'>{$font->font_type}</option>";
        
        //var_dump($colorBigArray);
        
        return $colorBigArray;
    }

    public function getEventTable($all = false)
    {
        $this->db->where('App_ID', $this->App_ID);
        if($all == false):
         $this->db->where('start_date >=', date('Y-m-d H:i:s'));
        endif;
        $this->db->order_by('start_date', 'ASC');
        $query_music_applications_events  = $this->db->get('music_applications_events');
        if($query_music_applications_events->num_rows <= 0):
            return "<div class='12u' style='text-align:center;'>Events Coming Soon...</div>";
        endif;
        $result_music_applicatons_events = $query_music_applications_events->result();
        $table = '';
        $count = 1;
        foreach($result_music_applicatons_events as $event):
            $table .= "<div class='12u' style='margin-left:0;'>";
			$table .= "<div class='2u' style='margin-left:0;'>". date("F d, Y", strtotime($event->start_date))."</div>";// . "<br />" . date('g:i a', strtotime($event->start_date)) ."</div>";
			$table .= "<div class='8u' style='text-align:center'>{$event->event_name}<br/>{$event->venue_name}<br/> Starts at " . date('g:i a', strtotime($event->start_date)) ." </div>";
            //$table .= "<div>{$event->event_name}</td>";
            $table .= "<div class='2u' style='text-align:right'>{$event->city} {$event->state}</div>";
            //$table .= "<td>". date("m/d/Y", strtotime($event->start_date)) . "<br />" . date('g:i a', strtotime($event->start_date)) ."</td>";
             //$table .= "<td>" . "<a href='#editevent' date-id='{$event->id}' class='edit_events_button'  data-toggle='modal'><img  src='/images/edit2.png' style='width:25px' /></a><a  class='event_delete' date-id='{$event->id}' ><img  src='/images/delete.png' style='width:30px'  /></a> </td>";
            //$table .= "<td></td>";
            $table .= "</div>";
			
            $count += 1;
        endforeach;
        
        return $table;
    }
    public function getMusicTable()
    {
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('position', 'ASC');
        $query_music_applications_song = $this->db->get('music_applications_songs');
        if($query_music_applications_song->num_rows <= 0):
            
            return "{
					title: 'No songs uploaded',
					mp3: ''
					";
        endif;
        
        $table = '';
        $result_music_applications_song = $query_music_applications_song->result();
		$count=1;
        foreach($result_music_applications_song as $song):
            $table .= "{\n";
            $table .= "					count: '".$count.".',\n";
		    $table .= "					title: '".$song->song_name."<br />By: ".$song->song_artist."',\n";
			
			if(strpos($song->song_stored,'/n/') !== false)
			{
				$song->song_stored = str_replace("/n/ ", "", $song->song_stored);
				 $table .= "					mp3: '".$song->song_stored."/;stream/1',\n 
				 								oga: '".$song->song_stored."/;stream/1'\n";
				 
			}
			else
			{
				 $table .= "					mp3: 'http://connect.shwcase.co/".$song->song_stored."'\n";
			}
           
            $table .= "				},\n";
			$count++;
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
}

?>