<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_payments
 *
 * @author GOI LLC
 */
class model_payments extends CI_Model{
    
    private $session;
    private $result_orders;
    
    public function __construct(){
        parent::__construct();
    }
    
    public function initialize($session){
        $this->session = $session;
    }
    
    public function processCredits($sales_item_id){
         
        
        
        $post = $this->input->post();
        
        if(!isset($post['FIRST_NAME']) || !isset($post['LAST_NAME']) || !isset($post['CARD_TYPE'])
                || !isset($post['CARD_NUMBER']) || !isset($post['MONTH']) || !isset($post['YEAR']) 
                || !isset($post['CVV2'])):
                return "Please make sure you fill out the form comletely";
        endif;
        
        $this->db->select('description, price, name, amount');
        $this->db->where('id', $sales_item_id);
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
            $insert_order['artist_id'] = $this->session['userid'];
            $insert_order['description'] = $result_sales_item[0]->description;
            $insert_order['last_4'] = str_replace("xxxxxxxxxxxx", "", $json['payer']['funding_instruments'][0]['credit_card']['number']);
            $insert_order['price'] = $json['transactions'][0]['amount']['total'];
            $insert_order['datecreated'] = date('Y-m-d H:i:s');
            $insert_order['transaction_id'] = $json['transactions'][0]['related_resources'][0]['sale']['id'];
            $insert_order['name'] = $result_sales_item[0]->name;
            
            if(!$this->db->insert('orders_artists', $insert_order)):
                throw new Exception("Error inserting Sales data");
            endif;
            
            $order_id  = $this->db->insert_id();
            
            $this->load->library('general_library');
            $insert_credits = array();
            $insert_credits['artists_id'] = $this->session['userid'];
            $insert_credits['datecreated'] =  date('Y-m-d H:i:s');
            $insert_credits['App_ID'] = $this->general_library->getUserAppID($this->session);
            $insert_credits['credits'] = $result_sales_item[0]->amount;
            
            if(!$this->db->insert('push_credits', $insert_credits)):
                throw new Exception('There was an error in buying the credits');
            endif;
            
            $this->db->where('id', $this->session['userid']);
            $query_user = $this->db->get('artists');
            
            if($query_user->num_rows != 1):
                throw new Exception("Error getting information");
            endif;
            
            $result_user = $query_user->result();
            $firstname = $result_user[0]->first_name;
            $email = $result_user[0]->email;
            $this->load->library('email_library');
            $el = new email_library();
            $price = "$" . number_format($insert_order['price']);
            $message = $el->regularEmail($firstname, "Your most recent transaction has been completed. We have received a payment of {$price} for {$insert_order['name']}.  <br /><br />Thankyou<br/>Shwcase");
//            
            if(!$el->sendEmail("Transaction Completed", $message, $email)):
               throw new Exception("Email not delivered");
            endif;
            
           return $order_id;
            
            else:
                
            return false;
            
        endif;
    }
    
    public function getSalesInvoice($month_2 = null){
        $post = $this->input->post();
      
            if(!isset($post['month']) || !isset($post['year'])):
                if($month_2 != null):
                 $start_date =   date('Y-m-d', strtotime('-1 month'));
                 $end_date = date('Y-m-d');   
                    else:
                        
                 $month = date('m');
                $year = date('Y'); 
                
                    
                endif;
                else:
                
                $month = $post['month'];
                $year = $post['year'];
                        
                    
                   endif;
                
                if($month_2 == null):
                $date = $this->processFirstAndLastMonth($month, $year);
                $this->getSalesIntoArray($date['startdate'], $date['enddate']);    
                    else:
                  $this->getSalesIntoArray($start_date, $end_date);    

                endif;    
                
                
                return $this->turnintoTable();
                    

        
        
        
    }
    
    public function getLastTransaction($order_id){
        $this->db->select('name, price, transaction_id, description');
        $this->db->where('id', $order_id);
        $query = $this->db->get('orders_artists');
        $result = $query->result();
        $ret = array('name' => $result[0]->name, 'price' => $result[0]->price,
            'transaction_id' => $result[0]->transaction_id, 'description' => $result[0]->description);
        return $ret;
    }
    
    public function getNumberOfCredits(){
        
        $this->db->select('SUM(`credits`) AS credits');
        $this->db->where('artists_id', $this->session['userid']);
        $query_credits = $this->db->get('push_credits'); 

        
        $result_credits = $query_credits->result();
        $number_of_credits = $result_credits[0]->credits;
        
        
        
        return $number_of_credits;
        
    }
    
   
    public function addSummation(){
       
        $total = $this->summation();

        $table = "<tr>
                  <td colspan='4' class='banking_general_table_total'>Total</td>
                  <td>$total</td>
                </tr>";
       return  $table; 
    }
    
    private function getSalesIntoArray($start, $end)
    {
        $this->db->where('datecreated >=', date('Y-m-d', strtotime($start)));
        $this->db->where('datecreated <=', date('Y-m-d', strtotime($end)));
        $this->db->where('artist_id', $this->session['userid']);

        $this->db->order_by('datecreated', "ASC");
        
        $query_orders = $this->db->get('orders_artists');
        $this->result_orders = $query_orders->result();
        
    }
    
    private function summation(){
        $total = 0;
        foreach($this->result_orders as $order):
            $total += $order->price;
        endforeach;
        
        return  "$" . number_format($total, 2);
    }

    public function turnintoarray(){
         $post = $this->input->post();
        if(!isset($post['startdate']) || !isset($post['enddate'])):
            $startdate = $this->firstOfMonth();
            $enddate = $this->lastOfMonth();
            else:
             $startdate = date('Y-m-d', strtotime($post['startdate']));
             $enddate = date('Y-m-d', strtotime($post['enddate']));
        endif;
        $this->getSalesIntoArray($startdate, $enddate);
        
                $array_ret = array();
                     $counter = 1;

                foreach($this->result_orders as $order):
                    $tr = array();
                    $tr[] = $counter;
                    $tr[] = $order->transaction_id;
                    $tr[] = $order->description;
                    $tr[] = date('m/d/Y', strtotime($order->datecreated));
                    $tr[] =  "$" . number_format($order->price, 2);
                    $array_ret[] = $tr;
                endforeach;
                
                return $array_ret;
                
    }
    
    
    private function turnintoTable(){
     $table = '';
     $counter = 1;
     foreach($this->result_orders as $order):
         $table .= '<tr>';
         $table .= "<td>" . $counter . "</td>";
         $table .= "<td>" . $order->transaction_id . "</td>";
         $table .= "<td>" . $order->description . "</td>";
         $table .= "<td>" . date('m/d/Y', strtotime($order->datecreated)) . "</td>";
         $table .= "<td>" . "$" . number_format($order->price, 2) . "</td>";
         $table .= "</tr>";
     endforeach;
     if($table == ''):
      $table .=   "<tr> <td>1</td> <td></td> <td>No Data For Month Selected</td> <td></td> <td></td> </tr>";
     endif;
     return $table;
    }
    
    private function processFirstAndLastMonth($month, $year){
        $startdate = date('Y-m-d', strtotime("$year-$month"));
        $endDate = new DateTime( "$year-$month-1" );   
        
        return array('startdate' => $startdate, 'enddate' => $endDate->format("Y-m-t"));
    }
    
    private function firstOfMonth() {
        return date("Y-m-d", strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
    }

    private function lastOfMonth() {
        return date("Y-m-d", strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
    }
    
    public function getSalesCustomDateTable(){
        $post = $this->input->post();
        if(!isset($post['startdate']) || !isset($post['enddate'])):
            $startdate = $this->firstOfMonth();
            $enddate = $this->lastOfMonth();
            else:
             $startdate = date('Y-m-d', strtotime($post['startdate']));
             $enddate = date('Y-m-d', strtotime($post['enddate']));
        endif;
        return $this->turnintoTable($this->getSalesIntoArray($startdate, $enddate));
    }
    
    public function pdf(){
      
       $post = $this->input->post();   
        if(!isset($post['month']) || !isset($post['year']) || $post['month'] == ''
           || $post['month'] == 'month' || $post['year'] == '' || $post['year'] == 'year'):
                $s = time (); 
                $post['month'] = date('m', $s);
                $post['year'] = date('Y', $s);
                
        endif;        
        $total_price = 0;
        $counter = 1;
        $dataTable = array();
        
           
        $date = $this->processFirstAndLastMonth($post['month'], $post['year']);
        $this->getSalesIntoArray($date['startdate'], $date['enddate']);
            
            foreach($this->result_orders as $row):
                $total_price += $row->price;
                
            if(strlen($row->description) > 18):
                $row->name = substr($row->description,0, 18) . ' ...';
            endif;
            
            if(strlen($row->description > 70)):
                $row->description = substr($row->description,0, 70) . ' ...';
            endif;
            
                 $insert_data = array();
                 $insert_data[] = $counter;
                 $insert_data[] = $row->transaction_id;
                 $insert_data[] = $row->description;
                 $insert_data[] = "$" . number_format($row->price, 2);
                 $dataTable[] = $insert_data;
                 $counter += 1;
            endforeach;
            
            if(count($dataTable) == 0):
                $dataTable[] = array('', 'No Data','', '');
            endif;
            $dataTable[] = array('', '','', "$" . number_format($total_price, 2));
            
            return array('table' => $dataTable, 'total' => "$" . number_format($total_price, 2)) ;
    }
   
    public function getDataUser(){
        
        $this->db->where('id', $this->session['userid']);
        $query_advertisers = $this->db->get('artists');
        
        if($query_advertisers->num_rows != 1):
           throw new Exception("No user data.");
        endif;
        
        $result_advertisers = $query_advertisers->result();
        $userInfo = array();
        $userInfo['name'] = ucfirst($result_advertisers[0]->first_name) . ' ' . ucfirst($result_advertisers[0]->last_name);
        $userInfo['phone'] = $result_advertisers[0]->phone;
        $userInfo['email'] = $result_advertisers[0]->email;
        return $userInfo;
    }
    
}

?>
