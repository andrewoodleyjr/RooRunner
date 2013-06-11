<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_checkout
 *
 * @author GOI LLC
 */
class model_checkout extends CI_Model
{
    public $sessionArray;
    private $api_version;
    private $api_endpoint;
    private $api_username;
    private $api_password;
    private $api_signature;
    private $sandbox;
    
    public $result;
    protected $_nvp;
    protected $_return_val_array;
 
    
    public function __construct() {
        // Set sandbox (test mode) to true/false.
        $this->sandbox = TRUE;
        // Set PayPal API version and credentials.
        $this->api_version = '94.0';
        $this->api_endpoint = $this->sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
        $this->api_username = $this->sandbox ? 'develo_1357014667_biz_api1.justgoi.com' : 'LIVE_USERNAME_GOES_HERE';
        $this->api_password = $this->sandbox ? '1357014701' : 'LIVE_PASSWORD_GOES_HERE';
        $this->api_signature = $this->sandbox ? 'AFcWxV21C7fd0v3bYYYRCpSSRl31Au8Y342urzcJwjwRGFsIKUnp4-l6' : 'LIVE_SIGNATURE_GOES_HERE';
        
        $this->_nvp = 'USER=' . urlencode($this->api_username);
        $startArray = array(
               'PWD' => $this->api_password,
               'SIGNATURE' => $this->api_signature,
               'VERSION' => $this->api_version
                );
        foreach($startArray as $key => $val):
            $this->_nvp .= '&'.$key.'='.urlencode($val);
        endforeach;
    }
    
    
        public function cURL($nvpArray){
        
      
        $nvp_string = '';
        if(is_array($nvpArray)):
            
            $nvp_string = '';
            
            foreach($nvpArray as $var => $val):
                
                    $nvp_string .= '&'.$var.'='.urlencode(trim($val));
            
            endforeach;
           
           
            
        endif;

      
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_VERBOSE, 1);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_TIMEOUT, 30);
      curl_setopt($curl, CURLOPT_URL, $this->api_endpoint);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $this->_nvp . $nvp_string);
      $result = curl_exec($curl);
      curl_close($curl);
      
      return urldecode($result);
      

    }
    
    
    public function isErrors()
    {
        $error = '';
        $post = $this->input->post();
        if(!isset($post['CARD_TYPE'], $post['CARD_NUMBER'], $post['MONTH'], 
           $post['YEAR'], $post['CVV2'], $post['FIRST_NAME'], $post['LAST_NAME'], 
           $post['STREET'], $post['CITY'],$post['STATE'], $post['ZIP']) || 
            ($post['CARD_TYPE'] == '') || ($post['CARD_NUMBER'] == '') || ($post['YEAR'] == '') ||  
            ($post['CVV2'] == '') || ($post['FIRST_NAME'] == '') || ($post['LAST_NAME'] == '') || 
            ($post['STREET'] == '') ||  ($post['STATE'] == '') || ($post['ZIP'] == '')
                        ):
            $error = "Please fill out all of the fields";
            return $error;
        endif;
        
        if(!is_numeric($post['YEAR']) && !(strlen($post['YEAR']) == 4)):
            $error = "Please use the drop down box for the year";
            return $error;
        endif;
        
        if(!is_numeric($post['MONTH']) && !(strlen($post['MONTH']) == 2)):
            $error = "Please use the drop down box for the month";
            return $error;
        endif;
        
        if(!is_numeric($post['CVV2']) && !(strlen($post['CVV2']) == 3)):
            $error = "Please enter three digits for the cvv2 numbers.";
            return $error;       
        endif;
        
        if(!ctype_alpha($post['FIRST_NAME'])):
            $error = "Only letters for your first name.";
            return $error;
        endif;
        
        if(!ctype_alpha($post['LAST_NAME'])):
            $error = "Only letters for your last name.";
            return $error;            
        endif;
        
        if(!ctype_alpha($post['STATE']) && !(strlen($post['STATE']) == 2)):
            $error = "Please use the state drop down box";
            return $error;
        endif;
        
        if(!is_numeric($post['ZIP'])):
            $error = "Please enter a five digit zip code, no letters";
            return $error;
        endif;
                
       
        
        return "true";
    }
    
    public function processNonRecurringPurchase(){
        
        $post = $this->input->post();
        $street_2 = '';
        if($post['STREET2'] !=  ''):
            $street_2 = $post['STREET2'];
        endif;
        if(!isset($this->sessionArray['sales_item_id'])):
            throw new Exception("No sales item.");
        endif;
        $checkout = $this->getSalesItemInfo($this->sessionArray['sales_item_id']);
        
        
        $nvp_var = array();   
        $nvp_var['METHOD'] = 'DoDirectPayment';
        //$nvp_var['IPADDRESS'] = $_SERVER['REMOTE_ADDR'];
        $nvp_var['FIRSTNAME'] = $post['FIRST_NAME'];
        $nvp_var['LASTNAME'] = $post['LAST_NAME'];
        $nvp_var['CURRENCYCODE'] = 'USD';
        $nvp_var['CREDITCARDTYPE'] = $post['CARD_TYPE'];
        $nvp_var['ACCT'] = $post['CARD_NUMBER'];
        $nvp_var['EXPDATE'] = $post['MONTH'] . $post['YEAR'];//MMYYYY
        $nvp_var['CVV2'] = $post['CVV2'];
        $nvp_var['STREET'] = $post['STREET'];
        $nvp_var['STREET2'] = $street_2;
        $nvp_var['CITY'] = $post['CITY'];
        $nvp_var['STATE'] = $post['STATE'];
        $nvp_var['ZIP'] = $post['ZIP'];
        $nvp_var['COUNTRYCODE'] = 'US';
        $nvp_var['EMAIL'] = $this->sessionArray['email'];
        $nvp_var['TAX_AMT'] = 0;//The amount of taxes we need to charge
        $nvp_var['USER_ID'] = $this->sessionArray['userid'];
        
        // US is the us  this is url for country codde  
        // https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_ACCountryCodes
        $nvp_var['AMT'] = $checkout['total_price'];//AMOUNT THAT WILL BE CHARGED
        $nvp_var['DESC'] =  $checkout['description'];//This is the description of the item
        $nvp_var['USER_ID'] = $this->sessionArray['userid'];
        $nvp_var['INVNUM'] = $this->sessionArray['sales_item_id'];
        $payment  = $this->cURL($nvp_var);
                
        $processedPayment = $this->NVPToArray($payment);

        
        if(!isset($processedPayment['TRANSACTIONID']) || (strpos($payment, "Failure") > 0)):
            throw new Exception("Error processing your payment please contact admin.");
        endif;
        
        $insert_orders = array();
        $insert_orders['sales_items_id'] = $this->sessionArray['sales_item_id'];
        $insert_orders['description'] = $checkout['description'];
        $insert_orders['last_4'] = substr($post['CARD_NUMBER'],-4,4);
        $insert_orders['price'] = $checkout['total_price'];
        $insert_orders['datecreated'] = date('Y-m-d H:i:s');
        $insert_orders['transaction_id'] = $processedPayment['TRANSACTIONID'];
        $insert_orders['name'] = $checkout['name'];
        if(!$this->db->insert('orders', $insert_orders)):
            throw new Exception("Error recording order data");
        endif;
        
        $insert_credits = array();
        $insert_credits['datecreated'] = date('Y-m-d H:i:s');
        $insert_credits['number_of_credits'] = $checkout['amount'];
        $insert_credits['advertiser_id'] = $this->sessionArray['userid'];
        if(!$this->db->insert('credits', $insert_credits)):
            throw new Exception("Error recording credit data.");
        endif;
        
        return $insert_orders;
    }
    
      private  function NVPToArray($NVPString)
      {
        $proArray = array();
            while(strlen($NVPString))
            {
                // name
                $keypos= strpos($NVPString,'=');
                $keyval = substr($NVPString,0,$keypos);
                // value
                $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
                $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
                // decoding the respose
                $proArray[$keyval] = urldecode($valval);
                $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
            }
        return $proArray;
     }
    
    public function getSalesItemInfo($sales_item_id)
    {
        

         
        $this->db->where('id', $sales_item_id);
        $query_sales_items = $this->db->get('sales_items');
        if($query_sales_items->num_rows != 1):
            throw new Exception("Error no sales item found.");
        endif;
        
        
        
        $result_sales_items = $query_sales_items->result();
        $name = $result_sales_items[0]->name;
        $description = $result_sales_items[0]->description;
        $price = $result_sales_items[0]->price;
        $amount = $result_sales_items[0]->amount;
        return array(
            'name' => $name, 
            'description' => $description, 
            'total_price' => $price,
            'amount' => $amount
                );
        
    }
    
    public function initialize($session)
    {
        $this->sessionArray =& $session;
    }
    
}

?>
