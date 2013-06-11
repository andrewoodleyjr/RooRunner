<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_cron
 *
 * @author GOI LLC
 */
class model_cron extends CI_Model{
    //put your code here
    
    
    public function sendemails(){
        $sql = "SELECT DATEDIFF(  `date_for_renew` , NOW( ) ) AS  `DAYS` ,  `email` ,  `first_name` ,  `last_name` 
                FROM  `subscriptions` 
                JOIN  `artists` ON  `artists`.`id` =  `subscriptions`.`artist_id` 
                HAVING DAYS = '30' || DAYS ='15' || DAYS = '1';";
        $query = $this->db->query($sql);
        $this->load->library('general_library');
        $gl = new general_library();
        foreach($query->result() as $email):
            $email_array = array();
            $email_array['subject'] = "Your subscription has " . $email->DAYS . " left.";
            $email_array['message'] = "Your subscription has " . $email->DAYS . " left.";
            $email_array['email'] = $email->email;
            $gl->sendEmail($email_array);
        endforeach;
        
        return true;
    }
}

?>
