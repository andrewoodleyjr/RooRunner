<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_musicApps
 *
 * @author GOI LLC
 */
class model_musicapps extends CI_Model{
   
    protected $_result_applications = false;
    protected $App_ID;
    protected $run_app = false;
    
    public function __construct() {

          parent::__construct(); 

       
    }
    
    public function initialize($App_ID)
    {
        $this->load->library('general_library');
        $gl = new general_library();
        $this->_sessionArray = $gl->isLoggedInCustomer();
        if(!is_array($this->_sessionArray)):
            throw new Exception("Error, you are not logged in.");
        endif;
        
        $this->App_ID = $App_ID;
            
        $this->run_app = true;
            
    }
    
   
    
    

    /** General Functions **/
    
    protected function helperg_get_application_row($App_ID)
    {
        
        if(!$this->run_app):
            throw new Exception("Error trying object not initialized");
        endif;
        $this->db->where('App_ID', $App_ID);
        $query_application = $this->db->get('applications');
        if($query_application->num_rows != 1):
            throw new Exception("Error trying to get application information.");
        endif;
        
        return $query_application->result();
        
    }
    
    protected function helper_update_profile($text, $query)
    {
        
        if(!$this->run_app):
            throw new Exception("Error trying object not initialized");
        endif;
        $result_music_applications_profile = $query->result();
        $result_music_applications_profile[0]->value = urldecode($text);
        $id = $result_music_applications_profile[0]->id;
        if(!$this->db->update('music_applications_profile', $result_music_applications_profile[0], "id = $id")):
            throw new Exception("Error inserting into music app profile");
        endif;
        
        return true;
               
        
    }
    
    public function helper_update_main()
    {
        if(!$this->run_app):
            throw new Exception("Error trying object not initialized");
        endif;
        
        $post = $this->input->post();
        if(!isset($post['json'])):
            throw new Exception("Error getting post data");
        
        endif;
        
        $json = json_decode($post['json']);
        
        $this->db->where('App_ID', $this->App_ID);
        $query_music_applications  = $this->db->get('music_applications');
        
            if($query_music_applications->num_rows != 1):
                throw new Exception("Error getting inforamtion about the app");
            endif;
        
        $result_music_applications = $query_music_applications->result();
        $id = $result_music_applications[0]->id;
		$music_type = '';
            foreach($json as $val):
                $key = $val->name;
                $value = $val->value;
				if($key == 'music_type'):
					$music_type = $value;
					
					$this->db->where('App_ID', $this->App_ID);
					$query_music_applications2  = $this->db->get('applications');
					
						if($query_music_applications2->num_rows != 1):
							throw new Exception("Error getting inforamtion about the app");
						endif;
					
					$result_music_applications2 = $query_music_applications2->result();
					$artist_id = $result_music_applications2[0]->artist_id;
					
					$myresult = array($key=>$value);
					if(!$this->db->update('artists', $myresult, "id = $artist_id")):
						throw new Exception("Error updating information");
					endif;
					
					
				else:
            		$result_music_applications[0]->{$key} = $value;
				endif;
            endforeach;
                
        if(!$this->db->update('music_applications', $result_music_applications[0], "id = $id")):
            throw new Exception("Error updating information");
        endif;
	
        
        return true;
    }
    
       public function helper_insert_profile($insert_arr)
    {
          
        
        $insert_music_applications_profile = array();
        $insert_music_applications_profile['value'] = $insert_arr['value'];
        $insert_music_applications_profile['value_type'] = $insert_arr['value_type'];
        $insert_music_applications_profile['name']  = urldecode($insert_arr['name']);
        $insert_music_applications_profile['isFile'] = $insert_arr['isFile'];
        $insert_music_applications_profile['datecreated'] = date('Y-m-d H:i:s');
        $insert_music_applications_profile['App_ID'] = $insert_arr['App_ID'];
        if(!$this->db->insert('music_applications_profile', $insert_music_applications_profile)):
            throw new Exception("Error trying to insert application profile information");
        endif;
        
        return true;
        
             
        
    }
    
    public function helper_is_there_profile($field, $App_ID)
    {
        $this->db->where('name', $field->name);
        $this->db->where('App_ID', $App_ID);
        $query_music_applications_profile = $this->db->get('music_applications_profile');
        if($query_music_applications_profile->num_rows == 0):
                return false;
            elseif($query_music_applications_profile->num_rows == 1):
                return $query_music_applications_profile;
            else:
                throw new Exception("Error getting information");
        endif;
        
    }
    
    /** music Music App **/
    
    
 
}

?>
