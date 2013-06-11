<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of checkout
 *
 * @author GOI LLC
 */

require_once('check.php');

class checkout extends CI_Controller {

    public $sessionArray;
    public $_menu = '<li ><a href="/manage/" style="color:">Home</a></li>
              <li ><a href="/setting/">Settings</a></li>
              <li><a href="/manage/faq">Help</a></li>
              <li><a href="/main/logout">Sign Out</a></li>';

    private $checkout;
    

     
    public function index() {

        try {
		

            $header = array();
            $menu = array();
            $this->session->unset_userdata('checkout');
            if(isset($this->sessionArray['paid'])):
                $this->session->unset_userdata('paid');
                $this->load->helper('url');
                redirect('/', 'refresh');
                return false;
            endif;
            $post = $this->input->post();
			
            if(!isset($post['sales_item_id']) && !isset($this->sessionArray['sales_item_id'])):
                $this->load->helper('url');
                redirect('/banking/', 'refresh');
                return false;
            endif;
             
            
            $year = '';
            $year_num = date('Y');
            
            for($i = $year_num; $i < $year_num + 30; $i += 1):
                $year .= "<option value='$i'>$i</option>";
            endfor;
            
                $menu['menu'] = $this->_menu;
                $footer = array();
                $footer['js'] = "<script src='/scripts/js/blockUI.js' type='text/javascript'></script>";
                $footer['js'] .= "<script src='/scripts/js/manage_checkout.js' type='text/javascript'></script>";
                $this->load->model('model_checkout');
                $this->session->set_userdata('sales_item_id', $post['sales_item_id']);
                $checkout = $this->model_checkout->getSalesItemInfo($post['sales_item_id']);
                $checkout['year'] = $year;
                $header['stylesheets'] = '<link href="/scripts/css/checkout_thankyou.css" rel="stylesheet" media="all" />';
                $this->load->view('header', $header);
                $this->load->view('menu', $menu);
                $this->load->view('checkout/checkout', $checkout);
                $this->load->view('footer', $footer);
                return true;
                
            

        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
	
	
	public function app() {

        try {
		

            $header = array();
            $menu = array();
            $this->session->unset_userdata('checkout');
            if(isset($this->sessionArray['paid'])):
                $this->session->unset_userdata('paid');
                $this->load->helper('url');
                redirect('/', 'refresh');
                return false;
            endif;
            $post = $this->input->post();
			$post['sales_item_id'] = '6';
            if(!isset($post['sales_item_id']) && !isset($this->sessionArray['sales_item_id'])):
                $this->load->helper('url');
                redirect('/banking/', 'refresh');
                return false;
            endif;
             
            
            $year = '';
            $year_num = date('Y');
            
            for($i = $year_num; $i < $year_num + 30; $i += 1):
                $year .= "<option value='$i'>$i</option>";
            endfor;
            
                $menu['menu'] = $this->_menu;
                $footer = array();
                $footer['js'] = "<script src='/scripts/js/blockUI.js' type='text/javascript'></script>";
                $footer['js'] .= "<script src='/scripts/js/manage_checkout.js' type='text/javascript'></script>";
                $this->load->model('model_checkout');
                $this->session->set_userdata('sales_item_id', $post['sales_item_id']);
                $checkout = $this->model_checkout->getSalesItemInfo($post['sales_item_id']);
                $checkout['year'] = $year;
                $header['stylesheets'] = '<link href="/scripts/css/checkout_thankyou.css" rel="stylesheet" media="all" />';
                $this->load->view('header', $header);
                $this->load->view('menu', $menu);
                $this->load->view('checkout/checkout', $checkout);
                $this->load->view('footer', $footer);
                return true;
                
            

        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
	
	
    
        protected function error($message){
            $login = array();
            $header = array();
            $header['title'] = 'error';
            $login['message'] = $message;
            $header['stylesheets'] = '<link href="/scripts/css/main.css" rel="stylesheet" media="all" type="text/css" />';
            $this->load->view('header', $header);
            $this->load->view('menu');
            $this->load->view('thankyou', $login);
            $this->load->view('footer');
			
		
		
    }

    
    public function process(){

        try{
        $data_s = $this->session->all_userdata();
        if(isset($data_s['checkout'] )):
            $this->load->helper('url');
            redirect('/manage/', 'refresh');
            return true;
        endif;

        $this->load->model('model_payments');
        
        $this->model_payments->initialize($data_s);
        
         $thankyou  =  $this->model_payments->processCredits($data_s['sales_item_id']);
                 if(is_numeric($thankyou)):
                    $output = json_encode(array('error' => 'no', 'order_id' => (int)$thankyou, 'message' => ''));
                    elseif(is_string($thankyou)):
                    $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => $thankyou));
                    else:
                    $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => "Error processing credit card information please contact admin. "));
                 endif;
                 $this->output->set_output($output);
                 return true;
        }
        catch(Exception $e){
             $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => $e->getMessage()));
                      $this->output->set_output($output);

             }
     
    }
    
    public function thankyou($order_id){
        try
        {
           $this->load->model('model_payments');
           
           $this->load_thankyou($this->model_payments->getLastTransaction($order_id));
        }
        catch(Exception $e)
        {
            $this->error($e->getMessage());
        }
    }
    private function load_thankyou($thankyou){
        
        $header = array();
        $menu = array();
              $menu['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
                        $header['stylesheets'] = '<link href="/scripts/css/checkout_thankyou.css" rel="stylesheet" media="all" />';
                        $this->load->view('header', $header);
                        $this->load->view('menu', $menu);
                        $this->load->view('checkout/thankyou', $thankyou);
                        $this->load->view('footer');  

    }
    private function load_checkout($errors = ''){
            $header = array();
            $menu = array();
            $year = '';
            $year_num = date('Y');
            $this->load->model('model_checkout');
            for($i = $year_num; $i < $year_num + 30; $i += 1):
                $year .= "<option value='$i'>$i</option>";
            endfor;
               $menuArray = array();
            $menuArray['menu']= '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>'; 

                $checkout = $this->model_checkout->getSalesItemInfo(4);
                if($errors != ''):
                    $checkout['error'] = $errors;
                endif;
                $checkout['year'] = $year;
                $header['stylesheets'] = '<link href="/scripts/css/checkout_thankyou.css" rel="stylesheet" media="all" />';
                $footer = array();
                $footer['js'] = "<script src='/scripts/js/blockUI.js' type='text/javascript'></script>";
                $footer['js'] .= "<script src='/scripts/js/manage_checkout.js' type='text/javascript'></script>";
                $this->load->view('header', $header);
                $this->load->view('menu', $menuArray);
                $this->load->view('checkout/checkout', $checkout);
                $this->load->view('footer');
       
    }
   
}

?>
