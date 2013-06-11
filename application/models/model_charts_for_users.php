<?php

class model_charts_for_users extends CI_Model{
    
    
    private $start_date;
    private $end_date;
    

    
    private $age = array('14-17', '18-20', '21-24', '25-29', '30-34', '35-44', '45-54', '55-63', '64 and up');
    private $sex = array('Men', 'Women');
   
    private $App_ID;
    
    
    private $data;
    
    private $register_vs_nonregister_result;
    
    private $result_main;
    private $result_nonregistered;
    
    private $json_chart;
    
    private $title;
    private $subTitle;
    private $xAxisBarGraph;
    private $yAxisTitle;
    private $barChartSeries;
    
    private $lineChartSeries;
    
    private $barchart;
    
    private $pieChartSeries;
    private $piechart;
    
    private $linechart;
    
    private $line_chart;
    public function __construct(){
        parent::__construct();
        
        $post = $this->input->post();
        $this->load->library('general_library');
        $gl = new general_library();
        $this->load->library('session');
        $this->App_ID = $gl->getUserAppID($this->session->all_userdata());
      
        if(isset($post['json'])):
            $this->data = json_decode($post['json']);
        else:
            $this->data = json_decode('{"chart_by":"line","group_by":"age","start_date":"'. 
                    date('m/d/Y', strtotime("-1 month",strtotime('now')))
                    .'","end_date":"'. 
                    date('m/d/Y') .
                    '","filter_state":"all","App_ID": "'.  $this->App_ID.'","seconds":"all", "filter_city":"all","filter_sex":"male","unique_users":"no","age_filter":"all", "phone_type": "all"}');
        endif;
        
        $this->assembleQueries();
  
        
    }
    
    public function outputJsonChartData(){
            if ($this->data->chart_by == 'Bar'):
            $this->assembleBarGraphData();
        elseif ($this->data->chart_by == 'pie'):
            $this->assemblePieGraphData();
        elseif ($this->data->chart_by == 'line'):
            $this->createDataLineCharts();
        endif;
        
        return json_encode($this->json_chart);
    }
        
    private function assembleWhereAppIDAndTime(){
        
             $this->db->where('`phone_users`.`App_ID`', $this->App_ID);
        if($this->data->phone_type == "Windows"):
            $this->db->where('isWindows', '1');
        elseif($this->data->phone_type == 'iPhone'):
            $this->db->where('isiPhone', '1');
        elseif($this->data->phone_type == 'Android'):
            $this->db->where('isAndroid', '1');
        endif;
        
    }

    
    private function createWhereForClickTableDateSearchRange(){
        
        $this->assembleWhereAppIDAndTime();

        $this->db->where('DATE(phone_users.date) >=', date('Y-m-d', strtotime($this->data->start_date)));
        $this->db->where('DATE(phone_users.date) <=', date('Y-m-d', strtotime($this->data->end_date)));
//    }
    }
    

    
    private function createWhereForState(){
        $this->db->where('phone_users.state', $this->data->filter_state);
    }
    
    private function createWhereForCity(){
        $this->db->where('phone_users.city', $this->data->filter_city);
    }
    
    private function createWhereForSex(){
        $this->db->where('phone_users.sex', $this->data->filter_sex);
    }
    
    private function createWhereForAgeRange(){
        
        
               $startcount = 1;
               $endcount = count($this->data->age_filter);
               
              foreach($this->data->age_filter as $user): 
                                
               if($endcount == 1):         //
                   $this->db->where("((YEAR( CURDATE( ) ) - YEAR( phone_users.birthday )) BETWEEN '$user->min' AND '$user->max')", NULL, FALSE);      
                   break;
               endif;
               
               
               if($startcount == 1):
                   $this->db->where("(((YEAR( CURDATE( ) ) - YEAR( phone_users.birthday )) BETWEEN '$user->min' AND '$user->max')", NULL, FALSE);
                   elseif($endcount == $startcount):
                     $this->db->or_where("((YEAR( CURDATE( ) ) - YEAR( phone_users.birthday )) BETWEEN '$user->min' AND '$user->max'))", NULL, FALSE);
                   else:
                       $this->db->or_where("((YEAR( CURDATE( ) ) - YEAR( phone_users.birthday )) BETWEEN '$user->min' AND '$user->max')", NULL, FALSE);
               endif;
               $startcount += 1;
              
              
               endforeach;
             
    }
    
    private function assembleWhereClauseForPhoneUsers(){
       
        if($this->data->filter_state != 'all'):
            $this->createWhereForState();
        endif;
        
        if($this->data->filter_city != 'all'):
            $this->createWhereForCity();
        endif;
        
        if($this->data->filter_sex != 'all'):
            $this->createWhereForSex();
        endif;
        
        if($this->data->age_filter != 'all'):
            $this->createWhereForAgeRange();
        endif;
    }
    
  
    private function assembleLineChart(){
        
          $line_chart = new stdClass();
          $line_chart->chart = new stdClass();
          $line_chart->chart->renderTo = "userchart";
          $line_chart->chart->zoomType = 'x';
          $line_chart->chart->spacingRight =  20;
          $line_chart->chart->backgroundColor = '#000';
          $line_chart->chart->width = '700';
          
          
          $line_chart->title = new stdClass();
          $line_chart->title->text = $this->title;
          $line_chart->subtitle = new stdClass();
          $line_chart->subtitle->text = $this->subTitle;
          
          $line_chart->xAxis = new stdClass();
          $line_chart->xAxis->type = 'datetime';
          $line_chart->xAxis->maxZoom =  14 * 24 * 3600000;
          $line_chart->xAxis->title = new stdClass();
          $line_chart->xAxis->title->text = null;
          
          $line_chart->yAxis = new stdClass();
          $line_chart->yAxis->title = new stdClass();
          
          $line_chart->yAxis->title->text = "Number of clicks / impressions";
          $line_chart->yAxis->showFirstLabel = false;
          
          $line_chart->tooltip = new stdClass();
          $line_chart->tooltip->shared = true;
          

          $line_chart->series = $this->lineChartSeries;
          $this->line_chart = $line_chart;
    }
    
    private function assemblePieChart(){
        $pie_chart->chart = new stdClass();
        $pie_chart->chart->renderTo = "userchart";
        $pie_chart->chart->backgroundColor = '#000';
        $pie_chart->chart->plotBorderWidth = null;
        $pie_chart->chart->plotShadow = false;
        $pie_chart->chart->width = '700';

        
        $pie_chart->title = new stdClass();
        $pie_chart->title->text = $this->title;
        
        $pie_chart->subtitle = new stdClass();
        $pie_chart->subtitle->text = $this->subTitle;
       
        
        $pie_chart->tooltip = new stdClass();
        $pie_chart->tooltip->pointFormat = '{series.name}: <b>{point.percentage}%</b>';
        $pie_chart->tooltip->percentageDecimals = 1;
        
       
        
        $pie_chart->plotOptions = new stdClass();
        $pie_chart->plotOptions->pie = new stdClass();
        $pie_chart->plotOptions->pie->allowPointSelect = true;
        $pie_chart->plotOptions->pie->cursor = true;
        $pie_chart->plotOptions->pie->dataLabels = new stdClass();
        $pie_chart->plotOptions->pie->dataLabels->enabled = false;
        $pie_chart->plotOptions->pie->showInLegend = true;  
        $pie_chart->series = $this->pieChartSeries;
            
        $this->piechart = $pie_chart;

    }
    
    private function assembleBarChart(){
        
        $barchart = new stdClass();
        $barchart->chart = new stdClass();
        $barchart->chart->renderTo = 'userchart';
        $barchart->chart->type = 'column';
        $barchart->chart->backgroundColor = '#000';
        $barchart->chart->width = '700';
                  
                  
        $barchart->title = new stdClass();
        $barchart->title->text = $this->title;
        

        
        $barchart->subtitle = new stdClass();
        $barchart->subtitle->text = $this->subTitle;
        
        $barchart->xAxis = new stdClass();
        $barchart->xAxis->categories = $this->xAxisBarGraph;
        
        $barchart->yAxis = new stdClass();
        $barchart->yAxis->title = new stdClass();
       
        
        
        $barchart->yAxis->title->margin = 60;
        $barchart->yAxis->title->text = $this->yAxisTitle;
        
        $barchart->legend = new stdClass();
        $barchart->legend->enabled = false;

        $barchart->credits = new stdClass();
        $barchart->credits->enabled = false;
        $barchart->series = $this->barChartSeries;
        
        $this->barchart = $barchart;
       
    

    }
    
    private function selectByAge(){
        
                         
         $this->db->select("SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 14 AND 17,  1, 0 )) AS `_14_17`, 
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 18 AND 20, 1 , 0 )) AS `_18_20`, 
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 21 AND 24, 1, 0 )) AS `_21_24`,
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 25 AND 29, 1 , 0 )) AS `_25_29`,
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 30 AND 34, 1 , 0 )) AS `_30_34`,
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 35 AND 44, 1 , 0 )) AS `_35_44`,
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 45 AND 54, 1 , 0 )) AS `_45_54`,
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 55 AND 63, 1 , 0 )) AS `_55_63`,
                                            SUM(IF( YEAR( CURDATE( ) ) - YEAR( phone_users.birthday ) BETWEEN 64 AND 190, 1 , 0 )) AS `UP`", false);

        
    }
    
    private function selectBySex(){
    $this->db->select("SUM(IF(`sex` = 'male', 1, 0)) as 'Men', SUM(IF(`sex` = 'female', 1, 0)) AS 'Women' ", false);   }
    
    private function selectByLocation(){
       $this->db->select("COUNT( * ) AS 'number_of_users', `phone_users`.`city` , `phone_users`.`state`, CONCAT(`phone_users`.`city`, ', ',  `phone_users`.`state`) AS `city_state`", false);
   }
   
    private function selectBySubscriber(){
       $this->db->select("SUM( IF( `phone_users`.`cansendpush` = '1', 1, 0 ) ) AS 'subscriber', SUM( IF( `phone_users`.`cansendpush` = '0', 1, 0 ) ) AS 'non_subscriber'", false);
   }
   
      
    private function lineChartAll(){
                $this->db->select("DATE(`phone_users`.`date`) AS 'DATE'");
                $this->db->order_by('`phone_users`.date ASC');
                $this->db->group_by('DATE(`phone_users`.`date`)');
    }
        

   
    public function assembleQueries(){
        
        
        
       
            if ($this->data->group_by == 'age'):
                $this->selectByAge();
            elseif ($this->data->group_by == 'location'):
                $this->selectByLocation();
                $this->db->group_by('city');
                $this->db->group_by('state');
                $this->db->order_by('city');
                $this->db->order_by('state');
            elseif ($this->data->group_by == 'gender'):
                $this->selectBySex();
            elseif ($this->data->group_by == 'subscriber'):
                $this->selectBySubscriber();
            endif;
            if ($this->data->chart_by == 'line'):
                $this->lineChartAll();
            endif;
            $this->assembleWhereClauseForPhoneUsers();
            $this->createWhereForClickTableDateSearchRange();
            $this->db->from('phone_users');

            $query = $this->db->get();
            $this->result_main = $query->result();

          
    }
   
    
    
    public function getxAxisForBarGraphLocation(){
        $location_xAxis = array();
        
        foreach($this->result_main as $loc):
            $location_xAxis[] = $loc->city_state;
        endforeach;
        
        
        $location_xAxis = array_unique($location_xAxis);
        
        
        
        return $location_xAxis;
    }
    
    public function getxAxisForBarGraph(){
        if($this->data->group_by == 'age'):
           
            $this->xAxisBarGraph = array('age_1' => '14-17', 'age_2' => '18-20','age_3' => '21-24','age_4' => '25-29','age_5' => '30-34', 'age_6' => '35-44', 'age_7' => '45-54', 'age_8' => '55-63', 'age_9' => '64 and up');

        elseif($this->data->group_by == 'gender'):

            $this->xAxisBarGraph = array('Men' => 'Men', 'Women' => 'Women');
            
        elseif($this->data->group_by == 'location'):
            
            $this->xAxisBarGraph = $this->getxAxisForBarGraphLocation();
            
        elseif($this->data->group_by == 'subscriber'):

            $this->xAxisBarGraph = array('subscribers', 'non subscribers');
            
        elseif($this->data->group_by == 'anonymous'):
            
            $this->xAxisBarGraph = array('registered', 'non registered');
            
        endif;
        
        
    }
    
    public function prepareBarGraphData($title, $data_series_points){
        
        $barchartSeries = array();
        $barchartSeries[] = array('name' => "number of users ", 'data' => $data_series_points);
        $this->barChartSeries = $barchartSeries;
         
         $this->title = $title;
        
         
         $this->subTitle = date('m/d/Y', strtotime($this->data->start_date)) . " - " . date('m/d/Y', strtotime($this->data->end_date));

    }
    
    public function assembleBarGraphData(){
        $this->getxAxisForBarGraph();
        if($this->data->group_by == 'age'):
            $this->assembleAgeBarChart();
        elseif($this->data->group_by == 'gender'):
            $this->assembleBarGraphSex();
        elseif($this->data->group_by == 'location'):
            $this->assembleBarGraphLocation();
        elseif($this->data->group_by == 'subscriber'):
            $this->assembleBarGraphSubscriber();
        endif;
        $this->assembleBarChart();
 
        $this->json_chart = json_encode($this->barchart);
        
    }
    
    public function assembleAgeBarChart(){
            $data = array();
            if($this->result_main[0]->_14_17 == 0):
                unset($this->xAxisBarGraph['age_1']);
                else:
                $data[] = (int)$this->result_main[0]->_14_17;    
             endif;
             if($this->result_main[0]->_18_20 == 0):
                unset($this->xAxisBarGraph['age_2']);
                else:
                $data[] = (int)$this->result_main[0]->_18_20;    
             endif;
            if($this->result_main[0]->_21_24 == 0):
                unset($this->xAxisBarGraph['age_3']);
                else:
                $data[] = (int)$this->result_main[0]->_21_24;    
             endif;
             if($this->result_main[0]->_25_29 == 0):
                unset($this->xAxisBarGraph['age_4']);
                else:
                $data[] = (int)$this->result_main[0]->_25_29;    
             endif;
             if($this->result_main[0]->_30_34 == 0):
                unset($this->xAxisBarGraph['age_5']);
                else:
                $data[] = (int)$this->result_main[0]->_30_34;    
             endif;
             if($this->result_main[0]->_35_44 == 0):
                unset($this->xAxisBarGraph['age_6']);
                else:
                $data[] = (int)$this->result_main[0]->_35_44;    
             endif;
             if($this->result_main[0]->_45_54 == 0):
                unset($this->xAxisBarGraph['age_7']);
                else:
                $data[] = (int)$this->result_main[0]->_45_54;    
             endif;            
             if($this->result_main[0]->_55_63 == 0):
                unset($this->xAxisBarGraph['age_8']);
                else:
                $data[] = (int)$this->result_main[0]->_55_63;    
             endif;
             if($this->result_main[0]->UP == 0):
                unset($this->xAxisBarGraph['age_9']);
                else:
                $data[] = (int)$this->result_main[0]->UP;    
             endif;

             
             $this->xAxisBarGraph = array_values($this->xAxisBarGraph);
             
             $this->prepareBarGraphData("Bar Chart For Age", $data);
        
    }
    
    private function assembleBarGraphLocation(){
        
        $data = array();
        foreach($this->result_main as $loc):
            $data[] = (int)$loc->number_of_users;
        endforeach;

        
        $this->xAxisBarGraph = array_values($this->xAxisBarGraph);
        
        $this->prepareBarGraphData("Bar Chart For Location", $data);

    }
    
    private function assembleBarGraphSex(){
        
        $data = array();

        if ($this->result_main[0]->Men == 0):
            unset($this->xAxisBarGraph['Men']);
        else:
            $data[] = (int)$this->result_main[0]->Men;
        endif;

        if ($this->result_main[0]->Women == 0):
            unset($this->xAxisBarGraph['Women']);
        else:
            $data[] = (int)$this->result_main[0]->Women;
        endif;



        $this->xAxisBarGraph = array_values($this->xAxisBarGraph);

        $this->prepareBarGraphData("Bar Chart For Sex", $data);
    }
    
    private function assembleBarGraphSubscriber(){
        $data = array();
        
        if($this->result_main[0]->subscriber == 0):
            unset($this->xAxisBarGraph['subscriber']);
            else:
            $data[] = (int)$this->result_main[0]->subscriber;
        endif;
        
        if($this->result_main[0]->non_subscriber == 0):
            unset($this->xAxisBarGraph['non_subscriber']);
            else:
            $data[] = (int)$this->result_main[0]->subscriber;
        endif;
  
        

        $this->xAxisBarGraph = array_values($this->xAxisBarGraph);

        $this->prepareBarGraphData("Bar Chart For Subscriber vs Non Subscribers", $data);
    }
    

    
    private function preparePieGraphData($data, $title){
        $pieChartSeries = array(array('type' => 'pie', 'name' => "Percentage", 'data' => $data ));
        $this->pieChartSeries = $pieChartSeries;
         $this->title = $title;

         
         $this->subTitle = date('m/d/Y', strtotime($this->data->start_date)) . " - " . date('m/d/Y', strtotime($this->data->end_date));

    }
    
    private function assemblePieGraphAge(){
                 $data = array();
            if($this->result_main[0]->_14_17 > 0):
                   $data[] = array('14-17', (int)$this->result_main[0]->_14_17);    
             endif;
             if($this->result_main[0]->_18_20 > 0):
                 $data[] = array('18-20',(int)$this->result_main[0]->_18_20);    
             endif;
            if($this->result_main[0]->_21_24 > 0):
                $data[] =  array('21-24',(int)$this->result_main[0]->_21_24);    
             endif;
             if($this->result_main[0]->_25_29 > 0):
                 $data[] = array('21-24', (int)$this->result_main[0]->_25_29);    
             endif;
             if($this->result_main[0]->_30_34 > 0):
                $data[] = array('30-34',(int)$this->result_main[0]->_30_34);    
             endif;
             if($this->result_main[0]->_35_44 > 0):
                 $data[] = array('35-44', (int)$this->result_main[0]->_35_44);    
             endif;
             if($this->result_main[0]->_45_54 > 0):
                 $data[] = array('45-54',(int)$this->result_main[0]->_45_54);    
             endif;            
             if($this->result_main[0]->_55_63 > 0):
                 $data[] = array('55-63', (int)$this->result_main[0]->_55_63);    
             endif;
             if($this->result_main[0]->UP > 0):
                $data[] = array('64 and up', (int)$this->result_main[0]->UP);    
             endif;
          
             
             $this->preparePieGraphData($data, "Pie Chart For Age");
    }
    
    private function assemblePieGraphSex(){
          $data = array();

        if ($this->result_main[0]->Men > 0):
            $data[] = array('Men',(int)$this->result_main[0]->Men);
        endif;

        if ($this->result_main[0]->Women > 0):
            $data[] = array('Women',(int)$this->result_main[0]->Women);
        endif;



        $this->preparePieGraphData( $data, "Pie Charts for Sex");

    }
    
    private function assemblePieGraphLocation(){
        $data = array();
        foreach($this->result_main as $loc):
            $data[] = array($loc->city_state , (int)$loc->number_of_users);
        endforeach;
        
                
        $this->preparePieGraphData($data, "Pie Chart For Location");
        
    }
    
    private function assemblePieGraphSubscriber(){
       
        $data = array();
        
        if($this->result_main[0]->subscriber > 0):
            $data[] = array('subscribers', (int)$this->result_main[0]->subscriber);
        endif;
        
        if($this->result_main[0]->non_subscriber > 0):
            $data[] = array('non subscribers',  (int)$this->result_main[0]->non_subscriber); 
        endif;
        
       


        $this->preparePieGraphData($data, "Pie Chart For Subscriber vs Non Subscribers");

    }
    
    private function assemblePieGraphRegisteredNonRegistered(){
                 $data = array();
        $register = (int)$this->register_vs_nonregister_result[0]->registered;        
        if($register > 0):
            $data[] = array('registered',$register);
        endif;
        
  

        $this->preparePieGraphData($data, "Pie Chart For Registered vs Non Registered");

    }
    
    private function assemblePieGraphData(){

       if($this->data->group_by == 'age'):
            $this->assemblePieGraphAge();
        elseif($this->data->group_by == 'gender'):
            $this->assemblePieGraphSex();
        elseif($this->data->group_by == 'location'):
            $this->assemblePieGraphLocation();
        elseif($this->data->group_by == 'subscriber'):
            $this->assemblePieGraphSubscriber();
        endif;
        
        $this->assemblePieChart();
 
        $this->json_chart = json_encode($this->piechart);

    }
    
    private function createDataLineCharts(){
       if($this->data->group_by == 'age'):
            $this->assembleLineChartForAge();
        elseif($this->data->group_by == 'gender'):
            $this->assembleLineChartForSex();
        elseif($this->data->group_by == 'location'):
            $this->assembleLineGraphLocation();
        elseif($this->data->group_by == 'subscriber'):
            $this->assembleLineGraphSubscriber();
        endif;
    }
    
    private function assembleLineChartForAge(){
        
        
        $this->assembleLineChartDataArrayHolderForAge();
        foreach($this->result_main as $age_dates):
            $dates = (array)$age_dates;
            foreach($dates as $key => $ages):
                if($key == 'DATE'):
                    continue;
                endif;
                if($key == 'UP' ):
                    $this->linechart['64 and up'][$age_dates->DATE] += $ages;
                
                    else:
                     $key = substr($key, 1);
                     $key = str_replace("_", "-", $key);
                     $this->linechart[$key][$age_dates->DATE] += $ages;
                endif;
            endforeach;
        endforeach;
       $lineChartTemp = array();
        foreach($this->linechart as $age => $val_array):
            foreach($val_array as $val):
                $lineChartTemp[$age][] = $val;
            endforeach;
        endforeach;
        
        
        $point_array = array();
        date_default_timezone_set('UTC');
        $utc = (strtotime($this->data->start_date) * 1000) + (24 * 3600 * 1000) - (strtotime('02-01-1970 00:00:00') * 1000);
        foreach($lineChartTemp as $key => $age_group):
            if(array_sum($age_group) == 0):
                unset($lineChartTemp[$key]);
            else:
            $type_chart = new stdClass();
            $type_chart->type = 'area';
            $type_chart->name = "Age: " . str_replace("-", " - ", $key);
            $type_chart->pointInterval =  24 * 3600 * 1000;
            $type_chart->pointStart =  $utc;
            $type_chart->data = $age_group;
            $point_array[] = $type_chart;   
             endif;
        endforeach;
        
        
        
        
        $this->lineChartSeries = $point_array;

          $this->title = "Age Users  ";
        
        $this->subTitle = date('m/d/Y', strtotime($this->data->start_date)) . " - " . date('m/d/Y', strtotime($this->data->end_date));
        $this->lineChartSeries = $point_array;
        $this->assembleLineChart();
        $this->json_chart = json_encode($this->line_chart);
        
    }
    
    private function assembleLineChartDataArrayHolderForAge(){
        $line_chart = array();
        $start_strtotime = strtotime($this->data->start_date);
        $end_strtotime = strtotime($this->data->end_date);
        while($start_strtotime <= $end_strtotime):
            foreach($this->age as $age):
                $line_chart[$age][date('Y-m-d', $start_strtotime)] = 0;
            endforeach;
            $start_strtotime = strtotime("+1 day" . date('Y-m-d', $start_strtotime) );
        endwhile;
        
      
        
        $this->linechart = $line_chart;
    } 
    
    private function assembleLineChartDataArrayHolderForSex(){
     
        $line_chart = array();
        $start_strtotime = strtotime($this->data->start_date);
        $end_strtotime = strtotime($this->data->end_date);
        while($start_strtotime <= $end_strtotime):
            foreach($this->sex as $sex):
                $line_chart[$sex][date('Y-m-d', $start_strtotime)] = 0;
            endforeach;
            $start_strtotime = strtotime("+1 day" . date('Y-m-d', $start_strtotime) );
        endwhile;
        
      
        
        $this->linechart = $line_chart;

    }
    
    private function assembleLineChartForSex(){
        $this->assembleLineChartDataArrayHolderForSex();
        foreach($this->result_main as $sex_dates):
            $dates = (array)$sex_dates;
            foreach($dates as $key => $nums):
                if($key == 'DATE'):
                    continue;
                endif;
                     $this->linechart[$key][$sex_dates->DATE] += $nums;
            endforeach;
        endforeach;
       $lineChartTemp = array();
        foreach($this->linechart as $age => $val_array):
            foreach($val_array as $val):
                $lineChartTemp[$age][] = $val;
            endforeach;
        endforeach;
        
        
        $point_array = array();
        date_default_timezone_set('UTC');
        $utc = (strtotime($this->data->start_date) * 1000) + (24 * 3600 * 1000) - (strtotime('02-01-1970 00:00:00') * 1000);

        foreach($lineChartTemp as $key => $age_group):
            if(array_sum($age_group) == 0):
                unset($lineChartTemp[$key]);
            else:
            $type_chart = new stdClass();
            $type_chart->type = 'area';
            $type_chart->name = $key . " : ";
            $type_chart->pointInterval =  24 * 3600 * 1000;
            $type_chart->pointStart =  $utc;
            $type_chart->data = $age_group;
            $point_array[] = $type_chart;   
             endif;
        endforeach;
        
        
        
 
        $this->lineChartSeries = $point_array;

        $this->title = "Users  By Gender ";
        
        $this->subTitle = date('m/d/Y', strtotime($this->data->start_date)) . " - " . date('m/d/Y', strtotime($this->data->end_date));
        $this->lineChartSeries = $point_array;
        $this->assembleLineChart();
        $this->json_chart = json_encode($this->line_chart);
    }
    
    private function assembleLineGraphLocation(){
        $this->assembleLineChartDataArrayHolderForLocation();
        foreach($this->result_main as $loc_dates):
            $this->linechart[$loc_dates->city_state][$loc_dates->DATE] += $loc_dates->number_of_users;
        endforeach;
        
       $lineChartTemp = array();
        foreach($this->linechart as $age => $val_array):
            foreach($val_array as $val):
                $lineChartTemp[$age][] = $val;
            endforeach;
        endforeach;
        
        
        $point_array = array();
        date_default_timezone_set('UTC');
        $utc = (strtotime($this->data->start_date) * 1000) + (24 * 3600 * 1000) - (strtotime('02-01-1970 00:00:00') * 1000);
        
        foreach($lineChartTemp as $key => $age_group):
            if(array_sum($age_group) == 0):
                unset($lineChartTemp[$key]);
            else:
            $type_chart = new stdClass();
            $type_chart->type = 'area';
            $type_chart->name = $key . " : ";
            $type_chart->pointInterval =  24 * 3600 * 1000;
            $type_chart->pointStart =  $utc;
            $type_chart->data = $age_group;
            $point_array[] = $type_chart;   
             endif;
        endforeach;
        
        $this->lineChartSeries = $point_array;

        $this->title = "Users  By Location ";
        
        $this->subTitle = date('m/d/Y', strtotime($this->data->start_date)) . " - " . date('m/d/Y', strtotime($this->data->end_date));
        $this->lineChartSeries = $point_array;
        $this->assembleLineChart();
        $this->json_chart = json_encode($this->line_chart);
        
    }
    
    private function assembleLineChartDataArrayHolderForLocation(){

        
        $start_strtotime = strtotime($this->data->start_date);
        $end_strtotime = strtotime($this->data->end_date);
        
        $location_array = array();
        foreach($this->result_main as $loc):
            $location_array[] = $loc->city_state;
        endforeach;
        
            $location_array = array_unique($location_array);
            $line_chart_array = array();
            $start_strtotime = strtotime($this->data->start_date);
            $end_strtotime = strtotime($this->data->end_date);
            while($start_strtotime <= $end_strtotime):
                foreach($location_array as $state_cities):
                        $line_chart_array[$state_cities][date('Y-m-d', $start_strtotime)] = 0;
                endforeach;
                $start_strtotime = strtotime("+1 day" . date('Y-m-d', $start_strtotime) );
            endwhile;


        
        $this->linechart = $line_chart_array;
        
    }
    
    public function assembleLineChartDataArrayHolderForSubscribers(){
        $line_chart = array();
        $start_strtotime = strtotime($this->data->start_date);
        $end_strtotime = strtotime($this->data->end_date);
        $subscribers = array('subscriber', 'non_subscriber');
        while($start_strtotime <= $end_strtotime):
            foreach($subscribers as $sub):
                $line_chart[$sub][date('Y-m-d', $start_strtotime)] = 0;
            endforeach;
            $start_strtotime = strtotime("+1 day" . date('Y-m-d', $start_strtotime) );
        endwhile;


        
        $this->linechart = $line_chart;

        
    }
    
    private function assembleLineGraphSubscriber(){
      
        $this->assembleLineChartDataArrayHolderForSubscribers();
        foreach($this->result_main as $sex_dates):
            $dates = (array)$sex_dates;
            foreach($dates as $key => $nums):
                if($key == 'DATE'):
                    continue;
                endif;
                     $this->linechart[$key][$sex_dates->DATE] += $nums;
            endforeach;
        endforeach;
       $lineChartTemp = array();
        foreach($this->linechart as $age => $val_array):
            foreach($val_array as $val):
                $lineChartTemp[$age][] = $val;
            endforeach;
        endforeach;
        
        
        $point_array = array();
        date_default_timezone_set('UTC');
        $utc = (strtotime($this->data->start_date) * 1000) + (24 * 3600 * 1000) - (strtotime('02-01-1970 00:00:00') * 1000);
         
       foreach($lineChartTemp as $key => $age_group):
            if(array_sum($age_group) == 0):
                unset($lineChartTemp[$key]);
            else:
            $key = str_replace("_", " ", $key);
            $key = ucwords($key);
            $type_chart = new stdClass();
            $type_chart->type = 'area';
            $type_chart->name = $key . " : ";
            $type_chart->pointInterval =  24 * 3600 * 1000;
            $type_chart->pointStart =  $utc;
            $type_chart->data = $age_group;
            $point_array[] = $type_chart;   
             endif;
        endforeach;
        
        
        

        $this->lineChartSeries = $point_array;

        $this->title = "Users  By Subscriber and Non Subscribers ";
        
        $this->subTitle = date('m/d/Y', strtotime($this->data->start_date)) . " - " . date('m/d/Y', strtotime($this->data->end_date));
        $this->lineChartSeries = $point_array;
        $this->assembleLineChart();
        $this->json_chart = json_encode($this->line_chart);
    
    }
   
}