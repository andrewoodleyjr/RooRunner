<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_charts
 *
 * @author GOI LLC
 */
class model_charts extends CI_Model{

    
    private $post;
    private $linechart;
    
    private $download_array;
    private $download_m_array;
    
    private $sales_array;
    private $sales_m_array;
    
    private $currency_array;
    private $App_ID;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('general_library');
        $gl = new general_library();
        $this->load->library('session');
        $session_data = $this->session->all_userdata();
        $this->App_ID = $gl->getUserAppID($session_data);
    }
    
    public function getApps(){
        $this->db->select('app_nickname, App_ID');
        $query = $this->db->get('applications');
        $result = $query->result();
        $option = "<option value='all'>All</option>";
        foreach($result as $apps):
            $option .= "<option value='$apps->App_ID'>$apps->app_nickname</option>";
        endforeach;
        
        return $option;
    }
    
    
    
    public function demo_chart_city_users($state){
     
        $this->db->select('DISTINCT `phone_users`.`city`', false);
        $this->db->from('phone_users');
        $this->db->where('state', $state);
        $this->db->where('App_ID', $this->App_ID);
        $this->db->order_by('phone_users.state');
        $query = $this->db->get();
        $result = $query->result();
        $options = "<option value='all'>All</option>";
        foreach($result as $user):
            $options .= "<option value='{$user->city}'>{$user->city}</option>";
        endforeach;
        
        return $options;

    }
    
    public function demo_chart_states_users(){
        
        $this->db->select('DISTINCT `phone_users`.`state`', false);
        $this->db->where('App_ID', $this->App_ID);
        $this->db->from('phone_users');
        $this->db->order_by('phone_users.state');
        $query = $this->db->get();
        $result = $query->result();
        $options = "<option value='all'>All</option>";
        foreach($result as $user):
            $options .= "<option value='{$user->state}'>{$user->state}</option>";
        endforeach;
        
        return $options;

    }
    
   
}

?>
