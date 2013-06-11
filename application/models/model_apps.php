<?php


class model_apps extends CI_Model{
    
    private $upload_path = '/home2/adthrif1/public_html/connect_showcase/files/apps/';
    private $server_path = '/home2/adthrif1/public_html/connect_showcase/';
    
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function getAppOverview($App_ID) {



        $this->db->where('App_ID', $App_ID);
        $query_single_application = $this->db->get('applications');

        if ($query_single_application->num_rows != 1):
            throw new Exception("No Application found.");
        endif;



        $result_single_application = $query_single_application->result();

        $App_Return = array();
        $App_Return['app_nickname'] = $result_single_application[0]->app_nickname;
        $App_Return['app_name'] = $result_single_application[0]->app_name;
        $App_Return['keyword'] = $result_single_application[0]->keywords;
        $App_Return['App_ID'] = $App_ID;
        $App_Return['description'] = $result_single_application[0]->description;
        
		
		if($result_single_application[0]->approved == 4):
            $App_Return['status'] = "<a class='btn btn-info overview_a_buttons disabled'>Pendind Approval</a>";
        elseif($result_single_application[0]->approved == 1):
            $App_Return['status'] = "<a class='btn btn-success overview_a_buttons disabled'>Approved</a>";
        elseif($result_single_application[0]->approved == 2):
            $App_Return['status'] = "<a class='btn btn-danger overview_a_buttons disabled'>Not Approved</a>";
		elseif($result_single_application[0]->approved == 3):
            $App_Return['status'] = "<a class='btn btn-warning overview_a_buttons disabled'>Waiting For Submission</a>";
		elseif($result_single_application[0]->approved == 0):
            $App_Return['status'] = "<a class='btn btn-warning overview_a_buttons disabled'>Waiting For Submission</a>";
        endif;
		
		
		if($result_single_application[0]->approved == 2):
            $App_Return['status2'] = "<a class='btn btn-warning overview_a_buttons'  href=../process/change_to_submit/{$App_ID}'>Resubmit</a>";
		elseif($result_single_application[0]->approved == 3):
            $App_Return['status2'] = "<a class='btn btn-warning overview_a_buttons'  href='../process/change_to_submit/{$App_ID}'>Submit Your App</a>";
		elseif($result_single_application[0]->approved == 0):
            $App_Return['status2'] = "<a class='btn btn-warning overview_a_buttons'  href='../process/change_to_submit/{$App_ID}'>Submit Your App</a>";
        endif;
		
		$this->db->where('id', $result_single_application[0]->artist_id);
        $query_single_artist = $this->db->get('artists');

        if ($query_single_artist->num_rows != 1):
            throw new Exception("No Application found.");
        endif;


        $result_single_artist = $query_single_artist->result();
		
		if(strlen($result_single_artist[0]->web_ext) > 0):
			$App_Return['status3'] = "<a class='btn btn-primary overview_a_buttons'  href='http://{$result_single_artist[0]->web_ext}.shwcase.co' target='_blank'>Go to Your Website</a>";
		else:
			$App_Return['status3'] = "<a class='btn btn-warning overview_a_buttons'  href='../setting/#website' >Setup Your Website</a>";	
		endif;
		
        $this->load->library('session');
        $session = $this->session->all_userdata();
        
        $this->db->select('DATEDIFF(`date_for_renew`, NOW( )) AS  `DAYS`', false);
        $this->db->where('artist_id', $session['userid']);
        $query_subscription = $this->db->get('subscriptions');
        
        if($query_subscription->num_rows == 1):
            $result_subscription = $query_subscription->result();
            $App_Return['subscription'] = "Subscription Expires: " . $result_subscription[0]->DAYS . " Days";
            elseif($query_subscription->num_rows == 0):
            $App_Return['subscription'] = "Free App with Ads";
            else:
            throw new Exception("Error Subscription duplicate, please contact admin.");
        endif;
        
        
        
        $this->db->where('App_ID', $App_ID);
        $query_application_profile = $this->db->get('application_profile');
        if ($query_application_profile->num_rows != 0):

            $result_application_profile = $query_application_profile->result();
            foreach ($result_application_profile as $row):

                if ($row->name == 'itunes_url'):
                    $App_Return['itunes_url'] = $row->value;
                elseif ($row->name == 'icon'):
                    $App_Return['small_pic'] = 'http://connect.shwcase.co' . $row->value;
                elseif ($row->name == 'default'):
                    $App_Return['second_img'] = 'http://connect.shwcase.co' . $row->value;
                endif;

            endforeach;
          
        endif;
        
        if(!isset($App_Return['small_pic'])):
            $App_Return['small_pic'] = '/images/512x512.png';
        endif;
        
         if(!isset($App_Return['second_img'])):
            $App_Return['second_img'] = '/images/Default.png';
        endif;
        
        if(!isset($App_Return['itunes_url'])):
            $App_Return['status4'] = "<a class='btn btn-warning overview_a_buttons'  href='https://itunes.apple.com/us/app/shwcase-artist-portal/id649679350?ls=1&mt=8'  target='_blank'>Preview Your App</a>";
		else:
            $App_Return['status4'] = "<a class='btn btn-primary overview_a_buttons'  href='{$App_Return['itunes_url']}'  target='_blank'>View Your App</a>";
        endif;

        return $App_Return;
    }
    
    public function helper_updateAddPush($App_ID, $post_name){
        $this->load->library("upload");
          $deleteFiles = glob('./push/' . $App_ID . '.*');
            if(!strpos($_FILES[$post_name]['name'], ".pem")):
                        throw new Exception("Error wrong file type.");
                        return;
                    endif;          
          
          foreach($deleteFiles as $file):
                        unlink($file);
                    endforeach;
                  
                    $config['upload_path'] =  './push/';
                    $config['allowed_types'] = '*';
                    $config['max_size']	= '1000';
                    $config['file_name'] = $App_ID;
                    $config['overwrite'] = true;
                                   
                    $this->upload->initialize($config);
                    $uploaded = $this->upload->do_upload($post_name);
                    $data = $this->upload->data();
                    
                     if(!$uploaded):
                         
                       throw new Exception($this->upload->display_errors(). '<br />' );
                     endif;
    }
    
    public function approved($App_ID){
        $this->db->select('approved');
        $this->db->where('App_ID', $App_ID);
        $query = $this->db->get('applications');
        if($query->num_rows != 1):
            throw new Exception("Error, applicaition not found.");
        endif;
        
        $result = $query->result();
        if($result[0]->approved == 1):
            return true;
        else:
            return false;
        endif;
    }
   
    public function delete_app($App_ID){
        
         
        
        
        $this->db->where('App_ID', $App_ID);
        
        $query_application_profile = $this->db->get('application_profile');
        $result_application_profile = $query_application_profile->result();
        
        
        
        
        
        foreach($result_application_profile as $row):
            
            if($row->isFile == 1):
                
                if(file_exists('.' . $row->value)):
                    unlink('.' . $row->value);
                endif;
            
            endif;
            
        endforeach;
        
        $this->db->where('App_ID', $App_ID);
        
        
        if(!$this->db->delete('application_profile')):
            throw new Exception("Error deleting database record");
        endif;
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('applications')):
            throw new Exception("Error deleting Application");
        endif;
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications')):
            throw new Exception('Error deleting music application');
        endif;
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_colors')):
            throw new Exception('Error deleting music applications colors');
        endif;
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_events')):
            throw new Exception('Error deleting music applications events');
        endif;  
                
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_fanwall')):
            throw new Exception('Error deleting music applications fanwall');
        endif;        
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_fonts')):
            throw new Exception('Error deleting music applications fonts');
        endif;  
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_instagram')):
            throw new Exception('Error deleting music applications instagram');
        endif;  
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_links')):
            throw new Exception('Error deleting music applications links');
        endif;  
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_profile')):
            throw new Exception('Error deleting music applications links');
        endif; 
        
        $this->db->where("App_ID", $App_ID);
        if(!$this->db->delete('music_applications_songs')):
            throw new Exception('Error deleting simple applications links');
        endif;
    }
    
    private function helper_updateEditInformation($filename, $post_name){
          
          $this->load->library("upload");
          $deleteFiles = glob($this->upload_path . $filename . '.*');
                    foreach($deleteFiles as $file):
                        unlink($file);
                    endforeach;

                    $config['upload_path'] =  $this->upload_path;
                    $config['allowed_types'] = 'jpg|png';
                    $config['max_size']	= '100000';
                    //$config['max_width'] = '10240';
                    //$config['max_height'] = '10240';
                    $config['file_name'] = $filename;
                    $config['overwrite'] = true;
                                   
                    $this->upload->initialize($config);
                    $uploaded = $this->upload->do_upload($post_name);
                    $data = $this->upload->data();
                     if($uploaded):
                         return '/files/apps/' . $filename . $data['file_ext'];
                     else:
                       throw new Exception($this->upload->display_errors());
                     endif;
    }

    public function updateEditInformation($App_ID, $approved){
           
            $post = $this->input->post();

            if(!isset($post['name']) || !isset($post['nickname']) ):
                throw new Exception("Please fill out the form completely");
            endif;
                
            $update_application = array();
            $update_application['app_nickname'] = $post['nickname'];
            $update_application['app_name'] = $post['name'];
            $update_application['keywords'] = $post['keywords'];
            $update_application['description'] = $post['description'];
            
            if($approved):
            $update_application['update_app'] = 1;
            endif;
                
                if(!$this->db->update('applications', $update_application, "App_ID = $App_ID")):
                    throw new Exception("Error updating the database for edit informaiton");
                endif;
                $picture_update = array();
                
                
                if($_FILES['icon_picture']['error'] == 0):
                    $picture_update['icon'] = $this->helper_updateEditInformation(md5($App_ID . "_icon_picture"), 'icon_picture');
                endif;

                
                 if($_FILES['default_picture']['error'] == 0):
                       $picture_update['default'] = $this->helper_updateEditInformation(md5($App_ID . "_default_picture"), 'default_picture');
                 endif;
                
                

                
                if(isset($picture_update['default'])):
                    $this->db->where('name', 'default');
                    $this->db->where('App_ID', $App_ID);
                    $query_application_profile = $this->db->get('application_profile');
                    if($query_application_profile->num_rows == 0):
                        
                        $insert_application_profile = array();
                        $insert_application_profile['name'] = 'default';
                        $insert_application_profile['value'] = $picture_update['default'];
                        $insert_application_profile['App_ID'] = $App_ID;
                        $insert_application_profile['isFile'] = 1;
                        if(!$this->db->insert('application_profile', $insert_application_profile)):
                            throw new Exception("Error adding to the database");
                        endif;
                        
                        elseif($query_application_profile->num_rows == 1):
                            
                            if(!$this->db->update('application_profile', 
                                    array("value" => $picture_update['default']),
                                    array(
                                        "name" => "default",
                                        "App_ID" => $App_ID
                                        ))):
                                throw new Exception("Error updating default picture");
                            endif;
                            
                        else:
                        throw new Exception('Error accessing information in application profiles');
                    endif;
                    
                endif;
                
                
                
                if(isset($picture_update['icon'])):
                    $this->db->where('name', 'icon');
                    $this->db->where('App_ID', $App_ID);
                    $query_application_profile = $this->db->get('application_profile');
                    if($query_application_profile->num_rows == 0):
                        
                        $this->load->library('session');
                        $session = $this->session->all_userdata();
                        $insert_application_profile = array();
                        $insert_application_profile['name'] = 'icon';
                        $insert_application_profile['value'] = $picture_update['icon'];
                        $insert_application_profile['App_ID'] = $App_ID;
                        $insert_application_profile['isFile'] = 1;
                        if(!$this->db->insert('application_profile', $insert_application_profile)):
                            throw new Exception("Error adding to the database");
                        endif;
                        
                        elseif($query_application_profile->num_rows == 1):
                            
                            if(!$this->db->update('application_profile', 
                                    array("value" => $picture_update['icon']),
                                    array(
                                        "name" => "icon",
                                        "App_ID" => $App_ID
                                        ))):
                                throw new Exception("Error updating default picture");
                            endif;
                            
                        else:
                        throw new Exception('Error accessing information in application profiles');
                    endif;
                    
                endif;
                
        //Check to see if their app has been approved and if so chnage the updater to 1
        /*if(!$this->db->update('applications', $update_application, "App_ID = $App_ID")):
                    throw new Exception("Error updating the database for edit informaiton");
                endif;*/
        
        return true;
    }
    
    public function updateEditInformation2($App_ID, $approved){
           
            $post = $this->input->post();

            if(!isset($post['name']) || !isset($post['nickname']) ):
                throw new Exception("Please fill out the form completely");
            endif;
                
            $update_application = array();
            $update_application['app_nickname'] = $post['nickname'];
            $update_application['app_name'] = $post['name'];
            $update_application['keywords'] = $post['keywords'];
            $update_application['description'] = $post['description'];
            
            if($approved):
            $update_application['update_app'] = 1;
            endif;
                
                if(!$this->db->update('applications', $update_application, "App_ID = $App_ID")):
                    throw new Exception("Error updating the database for edit informaiton");
                endif;
                $picture_update = array();
                
                
                if($_FILES['icon_picture']['error'] == 0):
                    $picture_update['icon'] = $this->helper_updateEditInformation(md5($App_ID . "_icon_picture"), 'icon_picture');
                endif;

                
                 if($_FILES['default_picture']['error'] == 0):
                       $picture_update['default'] = $this->helper_updateEditInformation(md5($App_ID . "_default_picture"), 'default_picture');
                 endif;
                
                

                
                if(isset($picture_update['default'])):
                    $this->db->where('name', 'default');
                    $this->db->where('App_ID', $App_ID);
                    $query_application_profile = $this->db->get('application_profile');
                    if($query_application_profile->num_rows == 0):
                        
                        $insert_application_profile = array();
                        $insert_application_profile['name'] = 'default';
                        $insert_application_profile['value'] = $picture_update['default'];
                        $insert_application_profile['App_ID'] = $App_ID;
                        $insert_application_profile['isFile'] = 1;
                        if(!$this->db->insert('application_profile', $insert_application_profile)):
                            throw new Exception("Error adding to the database");
                        endif;
                        
                        elseif($query_application_profile->num_rows == 1):
                            
                            if(!$this->db->update('application_profile', 
                                    array("value" => $picture_update['default']),
                                    array(
                                        "name" => "default",
                                        "App_ID" => $App_ID
                                        ))):
                                throw new Exception("Error updating default picture");
                            endif;
                            
                        else:
                        throw new Exception('Error accessing information in application profiles');
                    endif;
                    
                endif;
                
                
                
                if(isset($picture_update['icon'])):
                    $this->db->where('name', 'icon');
                    $this->db->where('App_ID', $App_ID);
                    $query_application_profile = $this->db->get('application_profile');
                    if($query_application_profile->num_rows == 0):
                        
                        $this->load->library('session');
                        $session = $this->session->all_userdata();
                        $insert_application_profile = array();
                        $insert_application_profile['name'] = 'icon';
                        $insert_application_profile['value'] = $picture_update['icon'];
                        $insert_application_profile['App_ID'] = $App_ID;
                        $insert_application_profile['isFile'] = 1;
                        if(!$this->db->insert('application_profile', $insert_application_profile)):
                            throw new Exception("Error adding to the database");
                        endif;
                        
                        elseif($query_application_profile->num_rows == 1):
                            
                            if(!$this->db->update('application_profile', 
                                    array("value" => $picture_update['icon']),
                                    array(
                                        "name" => "icon",
                                        "App_ID" => $App_ID
                                        ))):
                                throw new Exception("Error updating default picture");
                            endif;
                            
                        else:
                        throw new Exception('Error accessing information in application profiles');
                    endif;
                    
                endif;
                
        //Check to see if their app has been approved and if so chnage the updater to 1
        /*if(!$this->db->update('applications', $update_application, "App_ID = $App_ID")):
                    throw new Exception("Error updating the database for edit informaiton");
                endif;*/
        
        return true;
    }
    
    
    public function processSubscription($App_ID){
        $post = $this->input->post();
       
                $this->load->library('session');
        $session = $this->session->all_userdata();

        if(!isset($post['FIRST_NAME']) || !isset($post['LAST_NAME']) || !isset($post['CARD_TYPE'])
                || !isset($post['CARD_NUMBER']) || !isset($post['MONTH']) || !isset($post['YEAR']) 
                || !isset($post['CVV2'])):
                return "Please make sure you fill out the form comletely";
        endif;
        
        $this->db->select('description, price, name');
        $this->db->where('id', 5);
        $query_sales_item = $this->db->get('sales_items');
        if($query_sales_item->num_rows != 1):
            throw new Exception("No sales item found.");
        endif;
        $result_sales_item = $query_sales_item->result();
        $payment = array();
        $payment['num'] = $post['CARD_NUMBER'];
        $payment['type'] = strtolower($post['CARD_TYPE']);
        $payment['month'] = $post['MONTH'];
        $payment['year'] = $post['YEAR'];
        $payment['cvv2'] = $post['CVV2'];
        $payment['first'] = $post['FIRST_NAME'];
        $payment['last'] = $post['LAST_NAME'];
        $payment['amount'] = $result_sales_item[0]->price;
        $payment['description'] = $result_sales_item[0]->description;
        $this->load->model('model_checkout_oath');
        $this->model_checkout_oath->createCardData($payment);
        $json =  $this->model_checkout_oath->make_post_call();
        if(!isset($json['state'])):
            return "Error your card was not approved. Please try again.";
        endif;

        if($json['state'] == 'approved'):
            $insert_order = array();
            $insert_order['sales_item_id'] = 5;
            $insert_order['artist_id'] = $session['userid'];
            $insert_order['description'] = $result_sales_item[0]->description;
            $insert_order['last_4'] = str_replace("xxxxxxxxxxxx", "", $json['payer']['funding_instruments'][0]['credit_card']['number']);
            $insert_order['price'] = $json['transactions'][0]['amount']['total'];
            $insert_order['datecreated'] = date('Y-m-d H:i:s');
            $insert_order['transaction_id'] = $json['transactions'][0]['related_resources'][0]['sale']['id'];
            $insert_order['name'] = $result_sales_item[0]->name;
            if(!$this->db->insert('orders_artists', $insert_order)):
                throw new Exception("Error inserting Sales data");
            endif;
            
            $order_id = $this->db->insert_id();
            
            $this->db->select('id, artist_id, date_for_renew');
            $this->db->where('artist_id', $session['userid']);
            $query = $this->db->get('subscriptions');
            if($query->num_rows == 0):
                $artist = array();
                $startDate = new DateTime();
                
                $artist['artist_id'] = $session['userid'];
                $artist['datecreated'] = $startDate->format('Y-m-d H:i:s'); 
                $startDate->add(new DateInterval('P1Y'));
                $artist['date_for_renew'] = $startDate->format('Y-m-d H:i:s');
                if(!$this->db->insert('subscriptions', $artist)):
                    throw new Exception("Error adding subscription.");
                endif;
                elseif($query->num_rows == 1):
                    $result = $query->result();
                    $newDate = date('Y-m-d H:i:s',strtotime('+1 years',strtotime($result[0]->date_for_renew)));
                    if(!$this->db->update('subscriptions', 
                            array('date_for_renew' => $newDate),
                            array('id' => $result[0]->id))):
                        throw new Exception("Error adding information to the subscription.");
                    endif;
                    
                    
                    $insert_credits = array();
                    $insert_credits['artists_id'] = $session['userid'];
                    $insert_credits['datecreated'] =  date('Y-m-d H:i:s');
                    $insert_credits['App_ID'] = $App_ID;
                    $insert_credits['credits'] = 12000;
            if(!$this->db->insert('push_credits', $insert_credits)):
                throw new Exception('There was an error in buying the credits');
            endif;
                else:
                throw new Exception("Error duplicate information for subscription.");
            endif;

            $sql = "SELECT  `first_name` ,  `app_nickname` ,  `email` 
                FROM  `artists` 
                JOIN  `applications` ON  `applications`.`artist_id` =  `artists`.`id` 
                WHERE  `artist_id` = '{$session['userid']}';";
            $query_artist = $this->db->query($sql);
            if($query_artist->num_rows != 1):
                throw new Exception("Error getting name infomration.");
            endif;
            $result_artist = $query_artist->result();
            
            
            $this->load->library('email_library');
            $el = new email_library();
       $price = "$" . number_format($insert_order['price']);
            
            $message = $el->regularEmail($result_artist[0]->first_name, "Your most recent transaction has been completed. We have received a payment of {$price} for subscription. <br /><br />Thankyou<br/>Shwcase");
   
              if(!$el->sendEmail("Transaction Completed", $message, $result_artist[0]->email)):
                throw new Exception("Error sending confirmation email.");
            endif;
            
            return $order_id;
            
            else:
            return false;
        endif;
    }
    
    public function processAppChange($App_ID){

        $post = $this->input->post();
        if(!isset($post['FIRST_NAME']) || !isset($post['LAST_NAME']) || !isset($post['CARD_TYPE'])
                || !isset($post['CARD_NUMBER']) || !isset($post['MONTH']) || !isset($post['YEAR']) 
                || !isset($post['CVV2'])):
                return "Please make sure you fill out the form comletely";
        endif;
        
        $this->load->library('session');
        $session = $this->session->all_userdata();

        
        $this->db->select('description, price, name');
        $this->db->where('id', 4);
        $query_sales_item = $this->db->get('sales_items');
        if($query_sales_item->num_rows != 1):
            throw new Exception("No sales item found.");
        endif;
        
        $result_sales_item = $query_sales_item->result();
        
        $payment = array();
        $payment['num'] = $post['CARD_NUMBER'];
        $payment['type'] = strtolower($post['CARD_TYPE']);
        $payment['month'] = $post['MONTH'];
        $payment['year'] = $post['YEAR'];
        $payment['cvv2'] = $post['CVV2'];
        $payment['first'] = $post['FIRST_NAME'];
        $payment['last'] = $post['LAST_NAME'];
        $payment['amount'] = $result_sales_item[0]->price;
        $payment['description'] = $result_sales_item[0]->description;
        $this->load->model('model_checkout_oath');
        $this->model_checkout_oath->createCardData($payment);
        $json =  $this->model_checkout_oath->make_post_call();
        if(!isset($json['state'])):
            return "Error your card was not approved. Please try again.";
        endif;

        if($json['state'] == 'approved'):
            $insert_order = array();
            $insert_order['sales_item_id'] = 4;
            $insert_order['artist_id'] = $session['userid'];
            $insert_order['description'] = $result_sales_item[0]->description;
            $insert_order['last_4'] = str_replace("xxxxxxxxxxxx", "", $json['payer']['funding_instruments'][0]['credit_card']['number']);
            $insert_order['price'] = $json['transactions'][0]['amount']['total'];
            $insert_order['datecreated'] = date('Y-m-d H:i:s');
            $insert_order['transaction_id'] = $json['transactions'][0]['related_resources'][0]['sale']['id'];
            $insert_order['name'] = $result_sales_item[0]->name;
            if(!$this->db->insert('orders_artists', $insert_order)):
                throw new Exception("Error inserting Sales data");
            endif;
            
            $order_id = $this->db->insert_id();
            
            if(!$this->db->update('applications', array('update_app' => '2'), array('App_ID' => $App_ID))):
                throw new Exception("Error updating application status");
            endif;
            
            
                        $sql = "SELECT  `first_name` ,  `app_nickname` ,  `email` 
                FROM  `artists` 
                JOIN  `applications` ON  `applications`.`artist_id` =  `artists`.`id` 
                WHERE  `artist_id` = '{$session['userid']}';";
            $query_artist = $this->db->query($sql);
            if($query_artist->num_rows != 1):
                throw new Exception("Error getting name infomration.");
            endif;
            $result_artist = $query_artist->result();

            
            
            $this->load->library('email_library');
            $el = new email_library();
            $message = $el->regularEmail($result_artist[0]->first_name, "We have receive your submitted request for {$result_artist[0]->app_nickname} to be updated. Its currently being processed, this may take 7-9 business days. <br /><br />Thankyou<br/>Shwcase");
            if(!$el->sendEmail("Edit App Request", $message, $result_artist[0]->email)):
                throw new Exception("Error sending confirmation email.");
            endif;
            
            return $order_id;
            
            else:
            return false;
        endif;
        
    }
    
    public function getAppDelete($App_ID) {

        $this->load->library('session');
        $session = $this->session->all_userdata();


        $this->db->where('App_ID', $App_ID);
        $query_single_application = $this->db->get('applications');

        if ($query_single_application->num_rows != 1):
            throw new Exception("No Application found.");
        endif;



        $result_single_application = $query_single_application->result();

        $App_Return = array();
        $App_Return['app_name'] = $result_single_application[0]->app_name;
        $App_Return['App_ID'] = $App_ID;
        

        $this->db->where('App_ID', $App_ID);
        $query_application_profile = $this->db->get('application_profile');
        if ($query_application_profile->num_rows != 0):

            $result_application_profile = $query_application_profile->result();
            foreach ($result_application_profile as $row):

                if ($row->name == 'itunes_url'):
                    $App_Return['itunes_url'] = $row->value;
                elseif ($row->name == 'icon'):
                    $App_Return['small_pic'] = $row->value;
                endif;

            endforeach;


        else:

            $App_Return['itunes_url'] = '#';
            $App_Return["small_pic"] = '../../images/512x512.png';
            $App_Return["second_img"] = '../../images/Default.png';

        endif;

        return $App_Return;
    }

    public function getEditInfo($App_ID) {
        

        $this->db->where('App_ID', $App_ID);
        $query_application = $this->db->get('applications');

        if ($query_application->num_rows != 1):
            throw new Exception("No Application found");
        endif;

        $result_applications = $query_application->result();

        $edit = array();
        $edit['name'] = $result_applications[0]->app_name;
        $edit['nickname'] = $result_applications[0]->app_nickname;
        $edit['keywords'] = $result_applications[0]->keywords;
        $edit['description'] = $result_applications[0]->description;
        if($result_applications[0]->approved == 0):
        	$edit['update_message'] = "";
        elseif($result_applications[0]->update_app  == 1):
            $edit['update_message'] = "<div class='alert alert-danger'>You need to pay in order for your app to be update.</div>";
        elseif($result_applications[0]->update_app == 2):
            $edit['update_message'] = "<div class='alert alert-danger'>Your app should be update within 7 business, we have recieved your payment. </div>";
        endif;

        
        
        $this->db->where('App_ID', $App_ID);
        $query_application_profile = $this->db->get('application_profile');
         if ($query_application_profile->num_rows != 0):

            $result_application_profile = $query_application_profile->result();
            foreach ($result_application_profile as $row):
                if ($row->name == 'itunes_url'):
                    $edit['itunes_url'] = $row->value;
                elseif ($row->name == 'icon'):
                    $edit['icon'] = 'http://connect.shwcase.co' . $row->value;
                elseif($row->name == 'default'):
                    $edit['default'] = 'http://connect.shwcase.co' . $row->value;
                endif;
            endforeach;
          
        endif;
        
        if(!isset($edit['icon'])):
            $edit['icon'] = '/images/512x512.png';
        endif;
        
         if(!isset($edit['default'])):
            $edit['default'] = '/images/Default.png';
        endif;
        
        
        
        
        
        return $edit;
        
            
        
        
    }
    
    public function getJsonForAge($App_ID){

        $date_14 =  strtotime('-14 years');
        $date_17 =  strtotime('-17 years');
        $date_18 =  strtotime('-18 years');
        $date_20 =  strtotime('-20 years');
        $date_21 =  strtotime('-21 years');
        $date_24 =  strtotime('-24 years');
        $date_25 =  strtotime('-25 years');
        $date_29 =  strtotime('-29 years');
        $date_30 =  strtotime('-30 years');
        $date_34 =  strtotime('-34 years');
        $date_35 =  strtotime('-35 years');
        $date_44 =  strtotime('-44 years');
        $date_45 =  strtotime('-45 years');
        $date_54 =  strtotime('-54 years');
        $date_55 =  strtotime('-55 years');
        $date_63 =  strtotime('-63 years');
        $date_64 =  strtotime('-64 years');
        
      
        $data = array();
        $data['14-17'] = 0;
        $data['18-20'] = 0;
        $data['21-24'] = 0;
        $data['25-29'] = 0;
        $data['30-34'] = 0;
        $data['35-44'] = 0;
        $data['45-54'] = 0;
        $data['55-63'] = 0;
        $data['64 and up'] = 0;
        
        $this->db->where('App_ID', $App_ID);
        $this->db->order_by('birthday', 'ASC');
        $query_customer_users = $this->db->get('phone_users');
        $result_customer_users = $query_customer_users->result();
        foreach($result_customer_users as $user):
            
            $compare_date = strtotime($user->birthday);
            if($compare_date <= strtotime($date_14) && $compare_date >= strtotime($date_17)):
                $data['14-17'] += 1;
            elseif($compare_date <= $date_18 && $compare_date >= $date_20):
                $data['18-20'] += 1;
            elseif($compare_date <= $date_21 && $compare_date >= $date_24):
                $data['21-24'] += 1;
            elseif($compare_date <= $date_25 && $compare_date >= $date_29):
                $data['25-29'] += 1;
            elseif($compare_date <= $date_30 && $compare_date >= $date_34):
                $data['30-34'] += 1;           
            elseif($compare_date <= $date_35 && $compare_date >= $date_44):
                $data['35-44'] += 1;
            elseif($compare_date <= $date_45 && $compare_date >= $date_54):
                $data['45-54'] += 1;  
            elseif($compare_date <= $date_55 && $compare_date >= $date_63):
                $data['55-63'] += 1;
            elseif($compare_date <= $date_64):
                $data['64 and up'] += 1;         
            endif;
        endforeach;
        
        return $this->helper_json_machine($data, 'Age');

        
    }
    
    private function helper_json_machine($data, $title){
                $index = '';
        $max = max($data);
        foreach($data as $key => $val):
            if($max == $val):
                $index = $key;
                break;
            endif;
        endforeach;
        
        
        
        $jsondata = array();
        foreach($data as $key => $val):
            
            if($val == 0):
                continue;
            endif;
            $temp_array = array();
            if($key != $index):
                $temp_array[] = $key;
                $temp_array[] = $val;
                else:
                $temp_array['sliced'] = 'true';
                $temp_array['selected']   = 'true';
                $temp_array['y'] = $val;
                $temp_array['name'] = $key;
            endif;
            $jsondata[] = $temp_array;

        endforeach;
        
        sleep(3);
        $plotjson = array();
        $plotjson['type'] = 'pie';
        $plotjson['data'] = $jsondata;
        $jsontoreturn  = array();
        $jsontoreturn['plot'] = $plotjson;
        $jsontoreturn['title'] = $title;
        return json_encode($jsontoreturn);
    }
    
    public function getJsonForSex($App_ID){
       $this->db->where('App_ID', $App_ID);
       $this->db->order_by('sex', 'ASC');
       $query_phone_users = $this->db->get('phone_users');
       if($query_phone_users->num_rows == 0):
           throw new Exception("Sorry No Data");
       endif;
       $result_customer_app_users = $query_phone_users->result();
       $data = array();
       $data['men'] = 0;
       $data['women'] = 0;
       foreach($result_customer_app_users as $user):
           if($user->sex == 'male'):
               $data['men'] += 1;
           elseif($user->sex == 'female'):
               $data['women'] += 1;
           endif;
       endforeach;

      return $this->helper_json_machine($data, 'Sex');

    }
    
    public function getJsonForLocation($App_ID){
        
       $sql = "SELECT COUNT( CONCAT(  `city` ,  ', ',  `state` ) ) AS  `loc_num` , CONCAT(  `city` ,  ', ',  `state` ) AS  `city_state` 
                FROM  `phone_users`
                Where `App_ID` = '$App_ID'
                GROUP BY  `city_state` 
                ORDER BY  `loc_num` DESC ";
       $query_phone_users = $this->db->query($sql);
       $result_customer_app_users = $query_phone_users->result();
       $data = array();
       foreach($result_customer_app_users as $user):
           if($user->city_state == "unknown, unknown"):
             $data["Unknown"] = (int)$user->loc_num;
           else:
             $data[$user->city_state] = (int)$user->loc_num;
           endif;
       endforeach;
      
       return $this->helper_json_machine($data, "User Locations");
    }
    
    public function getJsonForSubscribers($App_ID){
       $this->db->where('App_ID', $App_ID);
       $query_phone_users = $this->db->get('phone_users');
       $result_customer_app_users = $query_phone_users->result();
       $data = array();
       $data['subscribers'] = 0;
       $data['non subscribers'] = 0;
       foreach($result_customer_app_users as $user):
           if(strlen($user->device_token) > 0):
               $data['subscribers'] += 1;
           else:
             $data['non subscribers'] += 1;
           endif;
       endforeach;
       
       return $this->helper_json_machine($data, "Subcribers vs Non Subscribers ");

    }
    
    public function getTableOfUser($App_ID){
        $this->db->where('App_ID', $App_ID);
        $this->db->order_by('first_name', 'ASC');
       $query_phone_users = $this->db->get('phone_users');
       $td = '';
       $result_customer_app_users = $query_phone_users->result();
       foreach($result_customer_app_users as $row):
           $email = '';
           $sub = '';
           
           
           if(strlen($row->email) > 0):
               $email = 'yes';
           else:
               $email = 'no';
           endif;
           if(strlen($row->device_token) > 0):
               $sub = 'yes';
           else:
               $sub = 'no';
           endif;
           
           
           $td .= '<tr>';
		   
		   if(strlen($row->first_name) == 0):
		   		$row->first_name = 'Not Specified';
		   endif;
		   
		   if(strlen($row->last_name) == 0):
		   		$row->first_name = 'Not Specified';
		   endif;
		   
		   if(strlen($row->link) == 0):
		   		 $td .= "<td>" . "" .$row->first_name . ' ' . $row->last_name . "</td>";
		   else:
			 	$td .= "<td>" . "<a href='$row->link'>" .$row->first_name . ' ' . $row->last_name . "</a></td>";
		   endif;
		   
		   if(strlen($row->city) == 0 && strlen($row->state) == 0):
		   		 $td .= "<td>Unknown Location</td>";
		   else:
			 	$td .= "<td>" . $row->city . ", " . $row->state . "</td>";
		   endif;
		   
           
           $td .= "<td>" . floor((time() - strtotime($row->birthday))/31556926) . "</td>";
           $td .= "<td>" . $row->sex . "</td>";
           $td .= "<td>" . $email . "</td>";
           $td .= "<td>" . $sub . "</td>";
           $td .= "</tr>";
       endforeach;
       if($td == ''):
           $td = "<tr><td></td><td>No Users</td></td><td></td><td></td><td></td><td></td></tr>";
       endif;
       return $td;
    }
    
    
    public function sendPushNotifications($App_ID, $message){
        
        $count = 0;
        $this->db->select('device_token');
            $this->db->where('App_ID', $App_ID );
            $this->db->where('isiPhone', '1');
            $this->db->where('cansendpush', '1');
            $query_phone_users = $this->db->get('phone_users');  
            if($query_phone_users->num_rows > 0):

            $apps = array();
            $result_phone_users = $query_phone_users->result();
            foreach($result_phone_users as $d_t):
                $apps[] = $d_t->device_token;
            endforeach;
            $this->load->library('apn');
            $apn = new APN();
            $apn->changePEMFile("./push/co.shwcase." . $App_ID . ".pem");
            $apn->payloadMethod = 'enhance';
            foreach($apps as $d_t):
                 if(!$d_t == 0):
                 	$send_result = $apn->sendMessage($d_t, $message,  1, 'default');
                 	if($send_result):
                     	$count += 1;
                	endif;
                 file_put_contents("noahs.txt", $send_result);
				 endif;
            endforeach;
            $apn->disconnectPush();
            endif;
            /*$this->db->where('App_ID', $App_ID);
            $this->db->where('isAndroid', '1');
            $this->db->where('cansendpush', '1');
            $query_phone_users = $this->db->get('phone_users');
            $result_phone_users = $query_phone_users->result();
            $gcm_id_array = array();
            foreach($result_phone_users as $user):
              if($user->android_device_token == ''):
                  continue;
              endif;
              $gcm_id_array[] = $user->android_device_token;
            endforeach;
            
            if(count($gcm_id_array) == 0):
                return $count;
            endif;
            
            $this->load->library('GCMPushMessage');
            $gcm = new GCMPushMessage();
            $gcm->setDevices($gcm_id_array);
            $json = $gcm->send($message);
            $send = json_decode($json);
            $count += (int)$send->success;*/
            return $count;
    }
    
    
    private function getPushCredits($user_id){
        $this->db->where('artists_id', $user_id);
        $query_push_credits = $this->db->get('push_credits');
        $count_credits = 0;
        $result_push_credits = $query_push_credits->result();
       
        foreach($result_push_credits as $row):
            $count_credits += $row->credits;	
        endforeach;
        return $count_credits;
        
        
    }
    
    public function checkApplicationApproved($App_ID){
        $this->db->where('App_ID', $App_ID);
        $query_single_application = $this->db->get('applications');
        $result_single_application = $query_single_application->result();
        if($result_single_application[0]->approved == 1):
            return true;
        else:
            return false;
        endif;

    }
    
    
    
    
    
    public function after_deduction($App_ID, $email){
        $this->db->where('App_ID', $App_ID);
        $query_applications = $this->db->get('applications');
        
        if($query_applications->num_rows != 1):
            throw new Exception("Error getting applicaiton's data");
        endif;
        $result_applications = $query_applications->result();
        $user_id = $result_applications[0]->artist_id;
        $number_credits_on_account = $this->getPushCredits($user_id);

        $this->db->where('App_ID', $App_ID);
        $this->db->where('cansendpush', 1);
        $this->db->where('isIphone', '1');
            if($email == 'send'):
                $this->db->or_where('cansendemail', 1);
            endif;
        $query_phone_users = $this->db->get('phone_users');
        
         $this->db->where('App_ID', $App_ID);
         $this->db->where('cansendpush', 1);
         $this->db->where('isAndroid', '1');
            if($email == 'send'):
                $this->db->or_where('cansendemail', 1);
            endif;
        $query_phone_users = $this->db->get('phone_users');
        

        $credit = $number_credits_on_account - $query_phone_users->num_rows;
        if($credit > 0):
            return true;
        else:
            return false;
        endif;
    }

    public function sendAccept($id, $session){
        
        $this->db->where('id', $id);
		$this->db->where('user_id', $session['userid']);
        $query_tasks = $this->db->get('tasks');
        $result_tasks = $query_tasks->result();
		
        if($query_tasks->num_rows != 1):
            throw new Exception("Error in finding the application information");
        endif;
		
		//Load the reciever information
		$this->db->where('id', $result_tasks[0]->reciever_id);
        $query_reciever = $this->db->get('users');
		$result_reciever = $query_reciever->result();
		
		//Load the actual user information too...
		$this->db->where('id', $result_tasks[0]->user_id);
        $query_user = $this->db->get('users');
		$result_user = $query_user->result();
	
	  	$this->load->library('session');
        $session = $this->session->all_userdata();
  
        $subject = "Message From Fest Runner";
        $from_display = 'Fest Runner';
		
		
		$message = "Hey ".$result_user->name.", <br/><br/>".$result_receiver->name." has accepted your request. You can contact him at ".$result_reciever->email.".";
	
	
	//Load the email and send them out to everyone. 	
        $this->load->library('general_library');
        $gl = new general_library();
		$emailarr = array();
		$emailarr['subject'] = $subject;
		$emailarr['message'] = $message;
		$emailarr['email'] = $result_reciever->email;
		$emailarr['from_email'] = $result_user->email;
		$emailarr['from_display'] = $result_user->email;
		$sent = $gl->sendEmail($emailarr);

        
        return true;
		
    }
    
    public function record_push($App_ID, $number, $negative) {
        $this->load->library('session');
        $session = $this->session->all_userdata();
        $insert_push_credits = array();
        $this->db->where('App_ID', $App_ID);
        $query_applications = $this->db->get('applications');
        if($query_applications->num_rows != 1):
            throw new Exception("Error in getting application data.");
        endif;
        $insert_push_credits['artists_id'] = $session['userid'];
        $insert_push_credits['credits'] = $number * $negative;
        $insert_push_credits['datecreated'] = date('Y-m-d');
        $insert_push_credits['App_ID'] = $App_ID;
        if(!$this->db->insert('push_credits', $insert_push_credits)):
            throw new Exception("Error in recording push notifications please contact admin.");
        endif;
         
        $sql = "SELECT SUM(  `credits` ) AS  'credits'
                FROM  `push_credits` 
                WHERE  `artists_id` =  '{$session['userid']}'";
                $query = $this->db->query($sql);
                $result = $query->result();
                $remaining = $result[0]->credits;
            $email_text = "Your request to send push notifications has been completed. <br /><br />Number of people reached: {$number} <br />Credits Spent: {$number}<br />Credits Remaining: {$remaining}<br/><br />Thankyou<br/>Shwcase";
            $this->db->where('id', $session['userid']);
            $query_artists = $this->db->get('artists');
            if($query_artists->num_rows != 1):
                throw new Exception("Error getting information from database");
            endif;
            
            $result_artists = $query_artists->result();
            $firstname = $result_artists[0]->first_name;
            $email = $result_artists[0]->email;
            $this->load->library('email_library');
            $el = new email_library();
            $message_email = $el->regularEmail($firstname, $email_text);
            if(!$el->sendEmail($firstname, $message_email, $email)):
                throw new Exception("Error sending email");
            endif;
    }
    
}


?>