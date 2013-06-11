<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_users
 *
 * @author GOI LLC
 */
class model_app_process extends CI_Model{
    //put your code here
        private $upload_path = '/home2/adthrif1/public_html/connect_showcase/files/apps/';

    
    public function check_register_form(){
        $post = $this->input->post();
        
        if(!isset($post['email']) || !isset($post['password'])
          || !isset($post['confirmpassword']) || !isset($post['firstname']) || !isset($post['lastname'])      ):
            return "Please make sure that the form is filled out completely.";
        endif;
        
        if(strlen($post['password']) < 5):
            return "Please make sure that password is 5 characters or longer.";
        endif;
        
        if($post['password'] !== $post['confirmpassword']):
            return "Your passwords do not match.";
        endif;
        
        
        
        $this->db->select('email');
        $this->db->where('email', $post['email']);
        $query_artist = $this->db->get('artists');
        if($query_artist->num_rows != 0):
            return "The email you are trying to register already exists";
        endif;
        
        if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)):
            return "The email you submitted is not valid.";
        endif;
        
        return "True";
    }
        public function updateUserProfile($session){
                  
        $post = $this->input->post();
        
        $update_advertisers = array();
                 
                 if(isset($post['firstname']) && $post['firstname'] != ''):
                     $update_advertisers['first_name'] = $post['firstname'];
                 endif;
                 if(isset($post['lastname']) && $post['lastname'] != ''):
                     $update_advertisers['last_name'] = $post['lastname'];
                 endif;
                 
                 if(isset($post['mobile']) && $post['mobile']):
                     $update_advertisers['phone'] = $post['mobile'];
                 endif;
                 
                 if(isset($post['email']) && ($post['email'] != $session['email'])):
                     $this->db->where('email', strtolower($post['email']));
                     $user_query = $this->db->get('artists');
                     if($user_query->num_rows != 0):
                         throw new Exception("1: The email you are trying to update to already exists");
                         else:
                             
                             $update_advertisers['email'] = strtolower($post['email']);
                         
                     endif;
                 endif;
          $this->db->where('id', $session['userid']);
         
         if(!$this->db->update('artists', $update_advertisers)):
             throw new Exception("1: User Profile did not update");
         else:
             
          $this->load->library('email_library');
          $el = new email_library();
          
          $message = $el->regularEmail($post['firstname'], "This is only a reminder, your account settings have been updated.  <br /><br />Thankyou<br/>Shwcase");
          if(!$el->sendEmail("Account Information", $message, $post['email'])):
              throw new Exception("Error no email was sent.");
          endif;

             
             return true;
         endif;
         
         
         
    }
    
        public function forgetPassword(){
        
        $post = $this->input->post();
        $this->db->where('email',$post['email']);
        $query_artist = $this->db->get('artists');
        if($query_artist->num_rows != 1):
            return false;
        endif;
        
        $this->load->library('general_library');
        $general = new general_library();        
        
        $result_artist = $query_artist->result();
        $newpassword = $general->generate_key();
        $result_artist[0]->password = md5($newpassword);
        if(!$this->db->update('artists',$result_artist[0], "id = {$result_artist[0]->id}")):
            throw new Exception("Password did not reset in the database");
        endif;
        
          $this->load->library('email_library');
          $el = new email_library();
          
          $message = $el->regularEmail($result_artist[0]->first_name,"Your new password is " . $newpassword . " <br /><br />Thankyou<br/>Shwcase");
          if(!$el->sendEmail("Account Information", $message, $post['email'])):
              throw new Exception("Error no email was sent.");
          endif;
        
        return true;
    }

    public function updatepassword($session){
        
        $post = $this->input->post();
          if(!isset($post['oldpassword'], $post['newpassword'], $post['confirmpassword']) || 
                        !($post['oldpassword'] != '') || 
                        !($post['newpassword'] != '') || 
                        !($post['confirmpassword'] != '')):
              throw new Exception("2: Please Fill in all of the fields.");
          endif; 
                 
          if($post['newpassword'] != $post['confirmpassword']):
                    throw new Exception("2: The passwords did not match");
          endif;
          
          $this->db->where('id',$session['userid']);
          $this->db->where('password', md5($post['oldpassword']));
          $query_advertisers = $this->db->get('artists');
          if($query_advertisers->num_rows != 1):
            throw new Exception('2: User Information and password did not match.');
          endif;
          $result_customer_user = $query_advertisers->result();
          $result_customer_user[0]->password = md5($post['newpassword']);
          if(!$this->db->update('artists', $result_customer_user[0], "id = {$result_customer_user[0]->id}")):
                throw new Exception("2:  The password did not update, please try again.");
          endif;
                  
          $this->load->library('email_library');
          $el = new email_library();
          
          $message = $el->regularEmail($result_customer_user[0]->first_name, "This is only a reminder, your account settings have been updated.  <br /><br />Thankyou<br/>Shwcase");
          if(!$el->sendEmail("Account Information", $message, $result_customer_user[0]->email)):
              throw new Exception("Error no email was sent.");
          endif;
          
          
          return true;
          
    }
    
    public function getCustomerUserInformation($id){
        
        $this->db->where('id', $id);
        $query_advertisers = $this->db->get('artists');
        if($query_advertisers->num_rows != 1):
            throw new Exception('no user found, please log back in and report to admin');
        endif;
        
        $result_customer_user = $query_advertisers->result();
        return $result_customer_user[0];
    }
	
	public function getAppInformation($id){
        
        $this->db->where('artist_id', $id);
        $query_advertisers = $this->db->get('applications');
        if($query_advertisers->num_rows != 1):
            throw new Exception('no user found, please log back in and report to admin');
        endif;
        
        $result_customer_user = $query_advertisers->result();
        return $result_customer_user[0];
    }
	
	public function getInAppInformation($App_ID){
        
        $this->db->where('App_ID', $App_ID);
        $query_advertisers = $this->db->get('music_applications');
        if($query_advertisers->num_rows != 1):
            throw new Exception('no user found, please log back in and report to admin');
        endif;
        
        $result_customer_user = $query_advertisers->result();
        return $result_customer_user[0];
    }
	
	public function getApplicationProfile($id){
        
        $this->db->where('App_ID', $id);
        $query_advertisers = $this->db->get('music_applications_profile');
        /*if($query_advertisers->num_rows != 1):
            throw new Exception('no user found in music app profile, please log back in and report to admin');
        endif;
        */
        $result_customer_user = $query_advertisers->result();
        return $result_customer_user;
    }
	
	public function getAboutInformation($id)
    {
        $this->db->where('App_ID', $id);
        $query_music_applications = $this->db->get('music_applications');
        if($query_music_applications->num_rows != 1):
            throw new Exception("Error getting applcition information");
        endif;
        $result_music_applications = $query_music_applications->result();
        /*
		$info = array();
        $info['phone'] = $result_music_applications[0]->phone;
        $info['about'] = $result_music_applications[0]->about;
        $info['email'] = $result_music_applications[0]->email;
        $info['website'] = $result_music_applications[0]->website;
		
        return $info;
        */
		return $result_music_applications[0];
		
    }
	
    public function register(){
        $post = $this->input->post();
        $this->load->library('general_library');
        $gl = new general_library();
        $this->db->where('email', $post['email']);
        $query = $this->db->get('artists');
        if($query->num_rows != 0):
            throw new Exception("Error email alread exists");
        endif;
        
        $first_name = $post['firstname'];
        $last_name = $post['lastname'];
        $email = $post['email'];
        $password = $post['password'];
        $random = $gl->generate_key();
        $insert_artist = array('first_name' => $first_name, 'last_name' => $last_name, 
            'random' => $random, 'confirmed' => '1', 'email' => $email,
            'password' => md5($password), 'phone' => "", 'datecreated' => date('Y-m-d H:i:s'));
    
        
        if(!$this->db->insert('artists', $insert_artist)):
            throw new Exception("Error with inserting you into the artists.");
        endif;
        

        $user_id = $this->db->insert_id();
        
        
        if(!$this->createSimpleApp($user_id)):
            throw new Exception("Error your app was not created please contact admin");
        endif;
        
        
        $this->load->library('email_library');
        $el = new email_library();
        $link = "http://artists.shwcase.co/";//"http://artists.shwcase.co/main/confirm/" . $user_id . '/' . $random;
        $message = $el->registerEmail("Welcome To Shwcase! We look forward to helping you in grow your fan base and message in the mobile world. <br /><br />Thankyou<br/>Shwcase", $link, $first_name);
        if(!$el->sendEmail("Welcome To Shwcase", $message, $email)):
            throw new Exception("Error sending email");
        endif;
        
        return true;
    }
        public function validateUser(){
        $post = $this->input->post();

        if(isset($post['email'], $post['password'])):
            $this->db->where('email', strtolower($post['email']));
            $this->db->where('password', md5($post['password']));
            $this->db->where('confirmed','1');
            $query_users = $this->db->get('artists');
            if($query_users->num_rows != 1):
                return false;
            else:
                
                $result_users = $query_users->result();
                
           $userSession =
                        array(
                            'email' => $result_users[0]->email,
                            'userid' => $result_users[0]->id,
                            'type' => 'artist_user',
                            'firstname' => $result_users[0]->first_name,
                            'logged_in' => TRUE
                );                
             
                $this->load->library('session');
                $this->session->set_userdata($userSession);

                return true;
            endif;
            
        endif;
    }

    
    
    public function confirm_registration($user, $random){
        $this->db->where('id', $user);
        $this->db->where('random', $random );
        $query_artist = $this->db->get('artists');
        if($query_artist->num_rows != 1):
            throw new Exception("The user does not exist.");
        endif;
        
        $update_artist = array('confirmed' => 1);
        if(!$this->db->update('artists', $update_artist, "id = $user")):
            throw new Exception("Error updating user, please contact admin.");
        endif;
        
        return true;
        
    }
    
    private function helper_updateEditInformation($filename, $post_name){
          
          $this->load->library("upload");
          $deleteFiles = glob($this->upload_path . $filename . '.*');
                    foreach($deleteFiles as $file):
                        unlink($file);
                    endforeach;

                    $config['upload_path'] =  $this->upload_path;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	= '4194000';
                    $config['max_width'] = '10240';
                    $config['max_height'] = '7680';
                    $config['file_name'] = $filename;
                    $config['overwrite'] = true;
                                   
                    $this->upload->initialize($config);
                    $uploaded = $this->upload->do_upload($post_name);
                    $data = $this->upload->data();
                     if($uploaded):
                         return '/files/apps/' . $filename . $data['file_ext'];
                     else:
                       throw new Exception($this->upload->display_errors(''));
                     endif;
    }
    private  function RGBToHex($r, $g, $b) {
		//String padding bug found and the solution put forth by Pete Williams (http://snipplr.com/users/PeteW)
		$hex = "#";
		$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
 
		return $hex;
	}
    private function createSimpleApp($user_id){
               
        $post = $this->input->post();
        
        
         $this->load->library('session');
        $session = $this->session->all_userdata();

        $insert_application = array();
        $insert_application['datecreated'] = date('Y-m-d H:i:s');
        $insert_application['app_name'] = "Change Me";
        $insert_application['app_nickname'] =  "Change Me";
        $insert_application['description'] =  "Change Me";
        $insert_application['keywords'] =  "Change Me";
        $insert_application['artist_id']= $user_id;


        
        if(!$this->db->insert('applications', $insert_application)):
            throw new Exception("Error inserting application into the database.");
        endif;
        $App_ID = $this->db->insert_id();
        
        
//       if($_FILES['icon_picture']['error'] == 0):
//                  
//          $picture_update['icon'] = $this->helper_updateEditInformation(md5($App_ID . "_icon_picture"), 'icon_picture');
//                    
//                  
//       endif;
//                
//                  
//                
//        if($_FILES['default_picture']['error'] == 0):
//
//          $picture_update['default'] = $this->helper_updateEditInformation(md5($App_ID . "_default_picture"), 'default_picture');
//
//        endif;
      
//        $insert_application_profile = array();
//        $insert_application_profile['name'] = 'default';
//        $insert_application_profile['value'] = $picture_update['default'];
//        $insert_application_profile['App_ID'] = $App_ID;
//        $insert_application_profile['isFile'] = 1;
//        if(!$this->db->insert('application_profile', $insert_application_profile)):
//             throw new Exception("Error adding to the database");
//        endif;
//        
//        $insert_application_profile = array();
//        $insert_application_profile['name'] = 'icon';
//        $insert_application_profile['value'] = $picture_update['icon'];
//        $insert_application_profile['App_ID'] = $App_ID;
//        $insert_application_profile['isFile'] = 1;
//        if(!$this->db->insert('application_profile', $insert_application_profile)):
//             throw new Exception("Error adding to the database");
//        endif;        
        
        
        $insert_simple_applications = array();
        $insert_simple_applications['about'] = "Change Me";
        $insert_simple_applications['email'] = $post['email'];
        $insert_simple_applications['website'] = "Change Me";
        $insert_simple_applications['Phone'] = "Change Me";
        $insert_simple_applications['App_ID'] = $App_ID;
        $insert_simple_applications['datecreated'] = date('Y-m-d H:i:s');
        
        $this->load->library('general_library');
        $gl = new general_library();
        
        
        
        
        
        
        if(!$this->db->insert('music_applications', $insert_simple_applications)):
            throw new Exception("Error inserting simple application in the database.");
        endif;
        
        
        $text_color = array();
        $text_color['r'] = 255;
        $text_color['g'] = 255;
        $text_color['b'] = 255;
        $text_color['alpha'] = 1.0;
        $text_color['hex_color'] = $this->RGBToHex($text_color['r'], $text_color['g'], $text_color['b']);
        $text_color['name'] = 'text_color';
        $text_color['App_ID'] = $App_ID;
        if(!$this->db->insert('music_applications_colors', $text_color)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
        
        
        $list_background = array();
        $list_background['r'] = 0;
        $list_background['g'] = 0;
        $list_background['b'] = 0;
        $list_background['alpha'] = 0.5;
        $list_background['hex_color'] = $this->RGBToHex($list_background['r'], $list_background['g'], $list_background['b']);
        $list_background['name'] = 'list_background';
        $list_background['App_ID'] = $App_ID;
        if(!$this->db->insert('music_applications_colors', $list_background)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
        
        
        $background = array();
        $background['r'] = 77;
        $background['g'] = 77;
        $background['b'] = 77;
        $background['alpha'] = 1;

        $background['hex_color'] = $this->RGBToHex($background['r'], $background['g'], $background['b']);
        $background['name'] = 'background';
        $background['App_ID'] = $App_ID;  
        if(!$this->db->insert('music_applications_colors', $background)):
            throw new Exception("Error Adding Colors <br />");
        endif;
        
        $tabbar_select_text = array();
        $tabbar_select_text['r'] = 255;
        $tabbar_select_text['g'] = 255;
        $tabbar_select_text['b'] = 255;
        $tabbar_select_text['alpha'] = 1;
        $tabbar_select_text['hex_color'] = $this->RGBToHex($tabbar_select_text['r'], $tabbar_select_text['g'], $tabbar_select_text['b']);
        $tabbar_select_text['name'] = 'tabbar_select_text';
        $tabbar_select_text['App_ID'] = $App_ID;  
        if(!$this->db->insert('music_applications_colors', $tabbar_select_text)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
        
        $tabbar = array();
        $tabbar['r'] = 0;
        $tabbar['g'] = 0;
        $tabbar['b'] = 0;
        $tabbar['hex_color'] = $this->RGBToHex($tabbar['r'], $tabbar['g'], $tabbar['b']);
        $tabbar['name'] = 'tabbar';
                $tabbar['alpha'] = 1;

        $tabbar['App_ID'] = $App_ID; 
        if(!$this->db->insert('music_applications_colors', $tabbar)):
            throw new Exception("Error Adding Colors <br />");
        endif;
        
        
        $tabbar_select_button = array();
        $tabbar_select_button['r'] = 255;
        $tabbar_select_button['g'] = 255;
        $tabbar_select_button['b'] = 255;
        $tabbar_select_button['alpha'] = 1;
        $tabbar_select_button['hex_color'] = $this->RGBToHex($tabbar_select_button['r'], $tabbar_select_button['g'], $tabbar_select_button['b']);
        $tabbar_select_button['name'] = 'tabbar_select_button';
        $tabbar_select_button['App_ID'] = $App_ID; 
        if(!$this->db->insert('music_applications_colors', $tabbar_select_button)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
        $song_length = array('name' => 'song_length', 'value' => '-1', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $login = array('name' => 'forced_signin	', 'value' => '0', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $instagram = array('name' => 'instagram', 'value' => 'shwcase', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $useinstgram = array('name' => 'useinstagram', 'value' => '1', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $pollstar = array('name' => 'pollstar', 'value' => '', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );

        $facebook = array('name' => 'facebook', 'value' => 'shwcase', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $twitter = array('name' => 'twitter', 'value' => 'shwcase', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $youtube = array('name' => 'youtube', 'value' => 'justgoi', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        $ustream = array('name' => 'ustream', 'value' => 'justgoi', 'isFile' => 0, 'value_type' => 'text', 'datecreated' => date('Y-m-d H:i:s'), 'App_ID' => $App_ID );
        if(!$this->db->insert('music_applications_profile', $facebook)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
          if(!$this->db->insert('music_applications_profile', $twitter)):
            throw new Exception("Error Adding Colors <br />");
        endif;        
        if(!$this->db->insert('music_applications_profile', $youtube)):
            throw new Exception("Error Adding Colors <br />" );
        endif;        
        if(!$this->db->insert('music_applications_profile', $ustream)):
            throw new Exception("Error Adding Colors <br />" );
        endif; 
        if(!$this->db->insert('music_applications_profile', $song_length)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
         if(!$this->db->insert('music_applications_profile', $login)):
            throw new Exception("Error Adding Colors <br />");
        endif;
        if(!$this->db->insert('music_applications_profile', $instagram)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
       if(!$this->db->insert('music_applications_profile', $useinstgram)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
         
           if(!$this->db->insert('music_applications_profile', $pollstar)):
            throw new Exception("Error Adding Colors <br />" );
        endif;
        
        $font = array('font_type' => 'TimesNewRomanPSMT', 'font_name' => 'font', 'App_ID' => $App_ID);
        if(!$this->db->insert('music_applications_fonts', $font)):
            throw new Exception("Error inserting font data");
        endif;
        
        
        return true;
    }
}

?>