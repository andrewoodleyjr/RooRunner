<?php

require 'check.php';
class banking extends check{
 
    private $payments;
    public $_menu = '<li ><a href="/manage/" style="color:">Home</a></li>
              <li ><a href="/setting/">Settings</a></li>
              <li><a href="/manage/faq">Help</a></li>
              <li><a href="/main/logout">Sign Out</a></li>';
    
    public function __construct() {
        parent::__construct();        
        $this->load->model('model_payments');
        $this->payments = new model_payments();
        $this->payments->initialize($this->session_data);

    }
        public function getHistoryTable(){
          try     
        
        {
            
            $table = array('table' => $this->payments->turnintoarray());
            $this->output->set_output(json_encode($table));
            return true;
            
        }
        catch(Exception $e)
        {
            $this->error($e->getMessage());
        }
    }
    
     public function invoice_table(){
        try     
        
        {
            
            $table = array('table' => $this->payments->getSalesInvoice() . $this->payments->addSummation());
            $this->output->set_output(json_encode($table));
            return true;
            
        }
        catch(Exception $e){
            $this->error($e->getMessage());
        }
        
     }
    
   public function pdf(){
        try {
              
          $this->load->library('mypdf');
            $post = $this->input->post();
            $ret = $this->payments->pdf();
            $data = $ret['table'];
            $userInfo = $this->payments->getDataUser();
            $name = $userInfo['name'];
            $email =  $userInfo['email'];
            $phone = $userInfo['phone'];
            $customer = "$name \n$email\ntel: $phone";
            $total = $ret['total'];
            if(!is_numeric($post['month']) || !is_numeric($post['year'])):
                $post['month'] = date('m');
                $post['year'] = date('Y');
            endif;
            
            
            $invoicenumber = $this->session_data['userid'] . $post['month'] . $post['year'];
            $date = date('F Y', strtotime($post['year']-$post['month']-0));
            
            $pdf = new mypdf('P', 'mm', 'Letter');

            $pdf->AliasNbPages();

            $pdf->AddPage();


            $pdf->SetFont('Times', 'B', 12);

            $pdf->SetTextColor(105, 105, 105);


            $pdf->Cell(110, 5, '', 0, 0, 'L');
            $pdf->Cell(0, 5, 'CUSTOMER', 0, 0, 'L');

            $pdf->Ln();

            $pdf->Cell(110, 15, '', 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->SetTextColor(192, 192, 192);
            $pdf->MultiCell(0, 5, $customer, 0, 'L', false);

            $pdf->Ln();

            $pdf->SetFont('Times', 'B', 22);
            $pdf->SetTextColor(105, 105, 105);
            $pdf->Cell(110, 7, 'INVOICE', 0, 2, 'L');

            $pdf->SetFont('Times', '', 18);
            $pdf->SetTextColor(220, 97, 90);
            $pdf->Cell(110, 5, $invoicenumber, 0, 1, 'L');

            $pdf->SetFont('Times', '', 12);
            $pdf->SetTextColor(192, 192, 192);
            $pdf->Cell(110, 5, $date, 0, 0, 'L');

            $pdf->SetFillColor(83, 83, 83);
           
            $pdf->SetFont('Times', '', 48);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->MultiCell(96, 30, $total, 0, 'T', true);
            $pdf->Cell(110, 5, 'CUSTOMER', 0, 0, 'L');

            $pdf->SetFont('Times', '', 8);
           
            $pdf->MultiCell(96, 3, 'Above is the total invoice. Provided below are the details of the invoice. To pay sign into Shwcase and click Banking & Agreements. For any questions feel free to contact us developer@shwcase.co. ', 0, 1, 'L', true);
            $pdf->Image('images/114x114transparent.png', 185, 70, 30, 0, '', 'http://www.shwcase.co');
            //$pdf->Image('images/transparentBlack.png', 120, 70, 96, 38, 'PNG', 'http://www.shwcase.co');
            $pdf->Ln();
            
            $header = array('#', 'Transaction', 'Details', 'Amount');
            $pdf->BuildTable($header, $data);

            $pdf->SetTextColor(0);

            
            $pdf->Output(); 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }  

    
    public function index(){
        
        try{
            $this->load->model('model_payments');
            $this->model_payments->initialize($this->session_data);
            $banking = array();
            $menuArray = array('menu' => $this->_menu);
            $footer = array();
            $header = array();
            $table = $this->model_payments->getSalesInvoice();
            $banking['credits'] = $this->model_payments->getNumberOfCredits();
            $banking['invoice_table_tr'] = $table . $this->model_payments->addSummation();
            $banking['htable'] = $table;
            $footer['js'] = "<script src='/scripts/js/banking.js' type='text/javascript'></script>" . 
                      "<script type='text/javascript' src='/scripts/js/jquery.dataTables.js' ></script>" . 
                      "<script type='text/javascript' src='/scripts/js/DT_bootstrap_banking.js' ></script>";
            $header['stylesheets'] = "<link href='/scripts/tbs/css/datepicker.css' rel='stylesheet' type='text/css' />" . 
                     "<link href='/scripts/css/banking.css' rel='stylesheet' type='text/css' />" .
                     "<link href='/scripts/css/DT_Tables_General.css' rel='stylesheet' type='text/css' />" ;
            $this->load->view('header', $header);
            $this->load->view('menu', $menuArray);
            $this->load->view('banking/banking', $banking);
            $this->load->view('footer', $footer);
        }
        catch(Exception $e)
        {
            $this->error($e->getMessage());
        }
    }
}

?>