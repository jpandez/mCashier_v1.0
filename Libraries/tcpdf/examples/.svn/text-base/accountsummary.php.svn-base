<?php 

session_start(); 

?>

<?php

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
require('mailer.php');
require('config.php');



// extend TCPF with custom functions
class MYPDF extends TCPDF {

	// Load table data from file
	public function LoadData() {
		$data = array();
		
		foreach($_SESSION['accountsummary']->Value as $t){
			$data[] = explode(',', $t->ID . "," . $t->FIRSTNAME . "," . $t->LASTNAME . "," . $t->MSISDN . "," . $t->NICKNAME . "," . $t->STATUS . "," . $t->CURRENTAMOUNT);
		}
	
		return $data;
	}

	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');
		// Header
		$w = array(10, 35, 30, 30,20,25,30);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		foreach($data as $row) {
			$this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 6, $row[2], 'LR', 0, 'R', $fill);
			$this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
			$this->Cell($w[4], 6, $row[4], 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, $row[5], 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, $row[6], 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
	
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		
		// Details
		$this->Cell(0, 10, 'www.etisalat.ae', 0, false, 'L', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Telcom Live Content');
$pdf->SetTitle('Account Summary');
$pdf->SetSubject('Account Summary');
$pdf->SetKeywords('TLC, Telcom Live Content');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('courier', '', 10);

// add a page
$pdf->AddPage();

//Column titles
$header = array("ID","FIRSTNAME","LASTNAME","MSISDN","NICKNAME","STATUS","CURRENTAMOUNT");


//Data loading
$data = $pdf->LoadData();

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

//Change To Avoid the PDF Error 
  ob_end_clean();

//Close and output PDF document
if(isset($_REQUEST['is_mail'])){

$pdf->Output(TMP. 'account_summary.pdf', 'F');
sendMail($_SESSION['SMTPHOST'],$_SESSION['SMTPPORT'],$_SESSION['SMTPUSERNAME'],
		 $_SESSION['SMTPPASSWORD'],TMP. "account_summary_" . date("Y-m-d H:i:s") . ".pdf",PDF_CREATOR,$_REQUEST['tomail'],'Account Summary','','');

}else{
	
	$pdf->Output("account_summary_" . date("Y-m-d H:i:s") . ".pdf", 'D');
}


//============================================================+
// END OF FILE                                                
//============================================================+
