<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of app
 *
 * @author GOI LLC
 */
require_once ('check.php');

class app extends check {

    private $App_ID;

    public function __construct() {
        parent::__construct();
        $this->load->library('general_library');
        $gl = new general_library();
        $this->App_ID = $gl->getUserAppID($this->session_data);
    }

    public function index() {
        try {
            $header = array();
            $menuArray = array();
            $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
            $this->load->model('model_apps');
            $manage = $this->model_apps->getAppOverview($this->App_ID);

            $header['stylesheets'] = '<link href="/scripts/css/manage_overview.css" rel="stylesheet" media="all" type="text/css" />';
            $header['title'] = 'Shwcase Artist Portal &middot; Manage';
            $footer = array();
            $this->load->view('header', $header);
            $this->load->view('menu', $menuArray);
            $this->load->view('app/manage_overview', $manage);
            $this->load->view('footer', $footer);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function ajax_sendPushEmail() {

        try {


            $this->load->model('model_apps');
            if (!$this->model_apps->checkApplicationApproved($this->App_ID)):
                $send_json = array();
                $send_json['message'] = "Your application is not active.";
                $send_json['error'] = 'yes';
                $this->output->set_output(json_encode($send_json));
                return false;
            endif;
            $number_pushes = 0;
            $number_emails = 0;
            $post = $this->input->post();
            if (!isset($post['message']) || $post['message'] == ''):
                throw new Exception("You must show the message.");
            endif;



            $email = '';

            if (isset($post['email']) && $post['email'] == 'send'):
                $email = 'send';
            endif;

            $post['message'] = urldecode($post['message']);


            if (!$this->model_apps->after_deduction($this->App_ID, $email)):

                $send_json = array();
                $send_json['message'] = "Sorry, you don't have enough credits in the system. <a href='/banking'>Add more credits.</a>";
                $send_json['error'] = 'yes';
                $this->output->set_output(json_encode($send_json));
                return false;

            endif;


            if ($email == 'send'):
                $number_emails = $this->model_apps->sendEmails($this->App_ID, $post['message']);
            endif;

            $number_pushes = $this->model_apps->sendPushNotifications($this->App_ID, $post['message']);

            if ($number_emails > $number_pushes):
                $this->model_apps->record_push($this->App_ID, $number_emails, -1);
            else:
                $this->model_apps->record_push($this->App_ID, $number_pushes, -1);
            endif;


            $message = "You sent $number_pushes push notifications and you sent $number_emails emails";
            $send_json = array();
            $send_json['message'] = $message;
            $send_json['error'] = 'no';
            $this->output->set_output(json_encode($send_json));
            return true;
        } catch (Exception $e) {
            $send_json = array();
            $send_json['message'] = $e->getMessage();
            $send_json['error'] = 'yes';
            $this->output->set_output(json_encode($send_json));
        }
    }

 public function sendEmail() {

        try {


           



           



            if ($email == 'send'):
                $number_emails = $this->model_apps->sendEmails($this->App_ID, $post['message']);
            endif;

            $number_pushes = $this->model_apps->sendPushNotifications($this->App_ID, $post['message']);

            if ($number_emails > $number_pushes):
                $this->model_apps->record_push($this->App_ID, $number_emails, -1);
            else:
                $this->model_apps->record_push($this->App_ID, $number_pushes, -1);
            endif;


            $message = "You sent $number_pushes push notifications and you sent $number_emails emails";
            $send_json = array();
            $send_json['message'] = $message;
            $send_json['error'] = 'no';
            $this->output->set_output(json_encode($send_json));
            return true;
        } catch (Exception $e) {
            $send_json = array();
            $send_json['message'] = $e->getMessage();
            $send_json['error'] = 'yes';
            $this->output->set_output(json_encode($send_json));
        }
    }


    public function delete_all() {
        try {

            $header = array();
            $menuArray = array();
            $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
            $this->load->model('model_apps');
            $this->model_apps->delete_app($this->App_ID);
            $header['stylesheets'] = '<link href="/scripts/css/manage_delete.css" rel="stylesheet" media="all" type="text/css" />';
            $header['title'] = 'Shwcase Artist Portal &middot; Manage';
            $footer = array();
            $this->load->view('header', $header);
            $this->load->view('menu', $menuArray);
            $this->load->view('app/manage_deletedApp');
            $this->load->view('footer', $footer);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function delete() {

        try {

            $header = array();
            $menuArray = array();
            $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
            $this->load->model('model_apps');
            $manage = $this->model_apps->getAppDelete($this->App_ID);

            $header['stylesheets'] = '<link href="/scripts/css/manage_delete.css" rel="stylesheet" media="all" type="text/css" />';
            $header['title'] = 'Shwcase Artist Portal &middot; Manage';
            $footer = array();
            $this->load->view('header', $header);
            $this->load->view('menu', $menuArray);
            $this->load->view('app/manage_delete', $manage);
            $this->load->view('footer', $footer);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function ajax_updateUser($type) {
        try {




            $this->load->model('model_apps');
            if ($type == 'age'):
                $json = $this->model_apps->getJsonForAge($this->App_ID);
                $this->output->set_output($json);
            elseif ($type == 'Sex'):
                $json = $this->model_apps->getJsonForSex($this->App_ID);
                $this->output->set_output($json);
            elseif ($type == 'Location'):
                $json = $this->model_apps->getJsonForLocation($this->App_ID);
                $this->output->set_output($json);
            elseif ($type == 'Subscribers'):
                $json = $this->model_apps->getJsonForSubscribers($this->App_ID);
                $this->output->set_output($json);
            endif;
        } catch (Exception $e) {
            $this->output->set_output($e->getMessage());
        }
    }

    public function users() {
        $header = array();
        $footer = array();

        $menuArray = array();
        $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
        $footer['js'] = "
        <script language='javascript' type='text/javascript'>
function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}
</script> 
        <script src='/scripts/highcharts/js/highcharts.js' ></script>" .
                "<script type='text/javascript' src='/scripts/js/manage_users.js' ></script>" .
                "<script type='text/javascript' src='/scripts/js/jquery.dataTables.js' ></script>" .
                "<script type='text/javascript' src='/scripts/js/DT_bootstrap.js' ></script>";

        $header['stylesheets'] = '<link href="/scripts/css/manage_users.css" rel="stylesheet" media="all" type="text/css" />';
        $header['stylesheets'] .= '<link href="/scripts/css/DT_Tables_General.css" rel="stylesheet" media="all" type="text/css" />';
        $header['title'] = 'Shwcase Artist Portal &middot; Manage';
        $this->load->model('model_apps');
        $table = $this->model_apps->getTableOfUser($this->App_ID);
        $this->load->view('header', $header);
        $this->load->view('menu', $menuArray);
        $this->load->view('app/manage_users', array('app_table' => $table));
        $this->load->view('footer', $footer);
    }

    public function edit() {
        try {

            $this->load->model('model_apps');
            $header = array();
            $footer = array();
            $menuArray = array();
            $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
            $footer['js'] = "<script type=\"text/javascript\" >
                        $('input[id=default_picture]').change(function() {
                        $('#default').val($(this).val());
                        });

                        $('input[id=icon_picture]').change(function() {
                        $('#icon').val($(this).val());
                        });
                        $('input[id=apn_file]').change(function() {
                        $('#apn').val($(this).val());
                        });
                        </script>";

            $header['stylesheets'] = '<link href="/scripts/css/manage_edit.css" rel="stylesheet" media="all" type="text/css" />';
            $header['title'] = 'Shwcase Artist Portal &middot; Edit App';

            $manage = $this->model_apps->getEditInfo($this->App_ID);



            $this->load->view('header', $header);
            $this->load->view('menu', $menuArray);
            $this->load->view('app/manage_edit', $manage);
            $this->load->view('footer', $footer);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function load_checkout($type, $errors = '') {
        $header = array();
        $menu = array();
        $year = '';
        $year_num = date('Y');
        $this->load->model('model_checkout');
        for ($i = $year_num; $i < $year_num + 30; $i += 1):
            $year .= "<option value='$i'>$i</option>";
        endfor;
        $menuArray = array();
        $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';
        if ($type == 'subscription'):
            $checkout = $this->model_checkout->getSalesItemInfo(5);
        else:

            $checkout = $this->model_checkout->getSalesItemInfo(4);
        endif;
        $checkout['special'] = $type;
        $checkout['year'] = $year;
        $header['stylesheets'] = '<link href="/scripts/css/checkout_thankyou.css" rel="stylesheet" media="all" />';
        $footer['js'] = "<script src='/scripts/js/blockUI.js' type='text/javascript'></script>";
        $footer['js'] .= "<script src='/scripts/js/manage_checkout.js' type='text/javascript'></script>";


        $this->load->view('header', $header);
        $this->load->view('menu', $menuArray);
        $this->load->view('checkout/checkout', $checkout);
        $this->load->view('footer', $footer);
    }

    public function pay_change() {
        try {
            $this->load->model('model_apps');
            $approved = $this->model_apps->approved($this->App_ID);


           if (!$approved):
                $this->model_apps->updateEditInformation($this->App_ID, false);

                $this->load->helper('url');
                redirect('/app/edit', 'refresh');
                return true;
           else:
                $this->model_apps->updateEditInformation($this->App_ID, true);

                $this->load->helper('url');
                redirect('/app/edit', 'refresh');
                return true;
            endif; 
            
            
            /*else:
                $this->model_apps->updateEditInformation($this->App_ID, true);

                $this->load_checkout('change_app');
                return true;
            endif;*/
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
	
	 public function pay_change2() {
        try {
            $this->load->model('model_apps');
            $approved = $this->model_apps->approved($this->App_ID);
			

           if (!$approved):	   		
                $this->model_apps->updateEditInformation2($this->App_ID, false);
				
                $this->load->helper('url');
                redirect('/process/start/app', 'refresh');
                return true;
           else:
		   		
                $this->model_apps->updateEditInformation2($this->App_ID, true);
				
                $this->load->helper('url');
                redirect('/process/start/app', 'refresh');
                return true;
            endif; 
            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function processSubscription() {
        try {
            $this->load->model('model_apps');
            $thankyou = $this->model_apps->processSubscription($this->App_ID);
            if (is_numeric($thankyou)):
                $output = json_encode(array('error' => 'no', 'order_id' => (int) $thankyou, 'message' => ''));
            elseif (is_string($thankyou)):
                $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => $thankyou));
            else:
                $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => "Error processing credit card information please contact admin. "));
            endif;
            $this->output->set_output($output);
            return true;
        } catch (Exception $e) {
            $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => $e->getMessage()));
            $this->output->set_output($output);
        }
    }

    public function subscribe() {
        try {
            $this->load->model('model_apps');
            $approved = $this->model_apps->approved($this->App_ID);


            if (!$approved):
                throw new Exception("Error: Your application is still being reviewed, please contact us for more detials.");
            else:
                $this->load_checkout('subscription');
                return true;
            endif;
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function load_thankyou($thankyou) {

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

    public function payment_process() {
        try {
            $this->load->model('model_apps');
            $data_s = $this->session->all_userdata();
            if (isset($data_s['checkout']) && $data_s['checkout'] == true):
                $this->load->helper('url');
                redirect('/manage/', 'refresh');
                return true;
            endif;
            $this->session->set_userdata(array('checkout' => true));
            $thankyou = $this->model_apps->processAppChange($this->App_ID);
            if (is_numeric($thankyou)):
                $output = json_encode(array('error' => 'no', 'order_id' => (int) $thankyou, 'message' => ''));
            elseif (is_string($thankyou)):
                $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => $thankyou));
            else:
                $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => "Error processing credit card information please contact admin. "));
            endif;
            $this->output->set_output($output);
            return true;
        } catch (Exception $e) {
            $output = json_encode(array('error' => 'yes', 'order_id' => 'N/A', 'message' => $e->getMessage()));
            $this->output->set_output($output);
        }
    }

    public function manage_app($pagename = 'home') {
        try {
            $this->load->model('model_page_entertainment');
            $this->model_page_entertainment->initialize($this->App_ID);

            $header = array();
            $menuArray = array();
            $menuArray['menu'] = '<li><a href="/manage/" style="color:">Home</a></li>
                        <li ><a href="/setting/">Settings</a></li>
                        <li><a href="/manage/faq">Help</a></li>
                        <li><a href="/logout/">Sign Out</a></li>';

            $header['stylesheets'] = '<link href="/scripts/css/manage_entertainment.css" rel="stylesheet" media="all" type="text/css" /><link href="/scripts/datepicker/css/datepicker.css" rel="stylesheet"><link href="js/google-code-prettify/prettify.css" rel="stylesheet" /><link type="text/css" href="/scripts/timepicker/compiled/timepicker.css" rel="stylesheet" media="all"/><link href="/scripts/colorpicker/css/colorpicker.css" rel="stylesheet" media="all" type="text/css" />';
            $footer = array();
            $footer['js'] = '<script src="/scripts/datepicker/js/bootstrap-datepicker.js" ></script>
                            <script src="/scripts/timepicker/js/bootstrap-timepicker.js" ></script>
                            </script><script src="/scripts/colorpicker/js/bootstrap-colorpicker.js"></script>
                            <script src="/scripts/js/jquery.tablednd.js"></script> 
                            <script src="/scripts/js/entertainment_app.js"></script>';
            $this->load->view('header', $header);
            $this->load->view('menu', $menuArray);
            $page_array = $this->model_page_entertainment->getPageInfo();
            $page_array['App_ID'] = $this->App_ID;
            $page_array['tab_' . $pagename] = 'active in';
            $this->load->view("app/manage_entertainment", $page_array);
            $this->load->view('footer', $footer);
        } catch (Exception $e) {
            $this->error($message);
        }
    }

}

?>