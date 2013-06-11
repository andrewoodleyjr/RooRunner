<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of charts
 *
 * @author GOI LLC
 */
require('check.php');
class charts extends check{



    private $bigView = false;
    private $App_ID;
    public function __construct() {
        parent::__construct();
        $this->load->library('general_library');
        $gl = new general_library();
        $this->App_ID = $gl->getUserAppID($this->session_data);
        $this->load->model('model_chart');
        $this->bigView = $this->model_chart->bigCharts($this->App_ID);
    }
    
    public function index(){
        try
        {
            $this->smallCharts();
        }
        catch(Exception $e){
            $this->error($e->getMessage());
        }
    }
    
    private function bigCharts(){
       $this->load->model('model_charts');
       $menuArray = array();
       $footer = array();
       $header = array();
       $charts = array();
       $charts['demo_charts_states_users'] = $this->model_charts->demo_chart_states_users();
       $footer['js'] = "<script src='/scripts/highcharts/js/highcharts.js' ></script><script src='/scripts/js/charts.js'></script>";
       $header['stylesheets'] = "<link href='/scripts/tbs/css/datepicker.css' rel='stylesheet' type='text/css' /><link href='/scripts/css/charts.css' rel='stylesheet' type='text/css' />";
       $this->load->view('header', $header);
       $this->load->view('menu', $menuArray);
       $this->load->view('charts/charts_big', $charts);
       $this->load->view('footer', $footer);
             

    }
    
    private function smallCharts(){
      
      $this->load->model('model_charts');
      
           $menuArray = array();
           $menu = '<li><a href="/manage/" style="color:">Home</a></li>
              <li ><a href="/setting/">Settings</a></li>
              <li ><a href="/manage/faq">Help</a></li>
              <li><a href="/main/logout">Sign Out</a></li>';
           $menuArray['menu'] = $menu;
       $footer = array();
       $header = array();
       $charts = array();
       $charts['apps'] = $this->model_charts->getApps();
       $charts['demo_charts_states_users'] = $this->model_charts->demo_chart_states_users();
       $footer['js'] = "<script src='/scripts/highcharts/js/highcharts.js' ></script><script src='/scripts/js/charts.js'></script>";
       $header['stylesheets'] = "<link href='/scripts/tbs/css/datepicker.css' rel='stylesheet' type='text/css' /><link href='/scripts/css/charts.css' rel='stylesheet' type='text/css' />";
       $this->load->view('header', $header);
       $this->load->view('menu', $menuArray);
       $this->load->view('charts/charts', $charts);
       $this->load->view('footer', $footer);

    }
    

     public function ajaxUserCharts(){
            try
            {
                $this->load->model('model_charts_for_users');
                $json =  $this->model_charts_for_users->outputJsonChartData();
                $this->output->set_output(trim($json));
            }
            catch(Exception $e)
            {
                
            }
        }
    
}

?>