<?php 

session_start(); 

?>

<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2010-11-20
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

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
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

$str = '<h2 style="padding:0; margin:0;">Account Details</h2>' .
		'<table>' .
		'<tr>' .
		'<td>Account Statement : ' . $_SESSION["searchmsisdn"] . '</td>' .
		'<td rowspan="4" style="text-align:right;"><img src="images/login/logo_etisalat.png" width="120px" height="50px" /></td>' .
		'</tr>' .
		'<tr>' .
		'<td>Account Number & Merchant Name : ' . $_SESSION["searchmsisdn"] .' || ' . $_SESSION["searchalias"] . '</td>' .
		'</tr>' .
		'<tr>' .
		'<td>Registered Name : ' . $_SESSION["searchname"] . '</td>' .
		'</tr>' .
		'<tr>' .
		'<td>Bank Name  : </td>' .
		'</tr>' .
		'<tr>' .
		'<td>Date ranging from ' . $_SESSION["searchdatefrom"] . ' to ' . $_SESSION["searchdateto"] . ' </td>' .
		'</tr>' .
		'<tr>' .
		'<td>Date Created :  ' . date("Y-m-d") . ' </td>' .
		'</tr>' .
		'</table>' .
		'<p><h2>Account Statement</h2></p>' .
		'<table cellpadding="2" cellspacing="0" border="1" width="100%" style="border-color:black; font-size:25px;">
				<thead>' .
				'<tr>
						<th>MERCHANT ID</th>
						<th>TRANSACTION ID</th>
						<th>TRANSACTION DATE</th>
						<th>TYPE</th>
						<th>MERCHANT MSISDN</th>
						<th>AMOUNT</th>
						<th>STATUS</th>
						<th>REASON</th>
						<th>AUTH CODE</th>
						<th>RRN</th>
				</tr></thead>
			<tbody>'; 
				$ctr=0; foreach($_SESSION['searchdata'] as $t): $ctr++;
				$statusDesc = $t->STATUS==0?"SUCCESS":"FAILED";		
				$str = $str . "<tr>
							    <td>$t->MID</td>
								<td>$t->REFERENCEID</td>
								<td>$t->TRANSACTION_DATE</td>
								<td>$t->TYPE</td>
								<td>$t->MERCHANT_MSISDN</td>
								<td>$t->AMOUNT</td>
								<td>$statusDesc</td>
								<td>$t->REASON</td>
								<td>$t->AUTH_CODE</td>
								<td>$t->RRN</td>
							</tr>";
				
				endforeach;
			
			
			$str = $str . '</tbody></table>';

// output the HTML content
$pdf->writeHTML($str, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Change To Avoid the PDF Error 
  ob_end_clean();

if(isset($_REQUEST['is_mail'])){

	$pdf->Output(TMP. 'accountstatement.pdf', 'F');
	if(sendMail(SMTPHOST,SMTPPORT,SMTPUSER,
		 SMTPPASSWORD,TMP. 'accountstatement.pdf',PDF_CREATOR,$_REQUEST['tomail'],'Account Statement','','')){
		 echo 'Mobile cashier Statement sent successfully to registered email id : ' . $_REQUEST['tomail'];
	}

}else{
	
	$pdf->Output('accountstatement.pdf', 'I');
}

//echo $str;

//============================================================+
// END OF FILE                                                
//============================================================+
