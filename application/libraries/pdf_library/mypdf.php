<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require("pdf/fpdf.php");



class mypdf extends FPDF {



        public $title = "315 10th Ave North #102A\nNashville TN, 37203\ndeveloper@shwcase.co";



        //Page header method

        function Header() {



			$this->SetFont('Times','',10);
	
			//$w = $this->GetStringWidth($this->title)+155;
	
			$this->SetTextColor(192,192,192);
	
			$this->SetLineWidth(.5);
	
			$this->Image('images/shwcase_image3.png',10,-3,40,40,'','http://www.shwcase.co');
			
			$this->Cell(36,0,'', 0,0,'L');
			$this->MultiCell(155,4,$this->title,0,'L',false);
			
	
			$this->Ln(10);



		}



        //Page footer method

        function Footer()       {

        //Position at 1.5 cm from bottom

        $this->SetY(-15);

        $this->SetFont('Times','',10);

        $this->Cell(0,10,'GOI LLC. Page '

        .$this->PageNo().' of {nb}',0,0,'C');

        }

	function BuildTable($header,$data) {

        //Colors, line width and bold font

        $this->SetFillColor(255);

        $this->SetTextColor(105);

        $this->SetDrawColor(192);

        $this->SetLineWidth(.3);

        $this->SetFont('Times','B',12);

        //Header

        // make an array for the column widths

       $w=array(10,45,115,25);

        // send the headers to the PDF document

        for($i=0;$i<count($header);$i++)

        $this->Cell($w[$i],7,$header[$i],1,0,'C',1);

        $this->Ln();

        //Color and font restoration

        $this->SetFillColor(173,216,230);

        $this->SetTextColor(0);

        $this->SetFont('');



        //now spool out the data from the $data array

        $fill=true; // used to alternate row color backgrounds

        foreach($data as $row)

        {

        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);

        // set colors to show a URL style link

        $this->SetTextColor(0);

        $this->SetFont('', '');
        
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);

        // restore normal color settings

        $this->SetTextColor(0);

        $this->SetFont('');

        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);

	$this->SetTextColor(0);

        $this->SetFont('');

        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);


        $this->Ln();

        // flips from true to false and vise versa

        $fill =! $fill;

        }

        $this->Cell(array_sum($w),0,'','T');

        }


}





?>