<?php 

session_start(); 

?>

<?php

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');


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
$pdf->SetTitle('Transaction Reports');
$pdf->SetSubject('Transaction Reports');
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
$pdf->SetFont('helvetica', '', 8.5);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			if($_SESSION['datatype'] == "HITS_PULL"){
				$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
								<tr class="ui-widget-header">
									<th>ID</th>
									<th>REFERENCE ID</th>
									<th>TYPE</th>
									<th>MSISDN</th>
									<th>MESSAGE</th>
									<th>TRANSACTION DATE</th>
								</tr>
							</thead>
								<tbody>';
								 $ctr=0; 
								//foreach($ret->Value as $t):
								foreach($_SESSION['data']->Value as $t):								 
								 $ctr++;
										
					$str = $str . "<tr>
										<td>$t->ID</td>
										<td>$t->REFERENCEID</td>
										<td>$t->TYPE</td>
										<td>$t->MSISDN</td>
										<td>$t->MESSAGE</td>
										<td>$t->TIMESTAMP</td>
									</tr>";
								endforeach;
					$str = $str . '</tbody>
						</table>';
			}else{

				$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
								<tr class="ui-widget-header">
									<th>MERCHANT ID</th>
									<th>REFERENCE ID</th>
									<th>TRANSACTION DATE</th>
									<th>TYPE</th>
									<th>MERCHANT MSISDN</th>
									<th>AMOUNT</th>
									<th>STATUS</th>
									<th>REASON</th>';
									if($_SESSION['datatype'] == "PANO" || $_SESSION['datatype'] == "ALL"){
									$str = $str .
									'<th>AUTH CODE</th>
									<th>RRN</th>';
									}
									if($_SESSION['datatype'] == "PANO"){
									$str = $str .
									'<th>CARD DETAILS</th>
									<th>CARD HOLDER</th>';
									}
									if($_SESSION['datatype'] == "PCSH"){
									$str = $str .
									'<th>CURRENCY</th>
									<th>AMOUNT GIVEN</th>
									<th>CHANGE</th>';
									}
								$str = $str .
								'</tr>
							</thead>
							<tbody>';
								 $ctr=0; 
								//foreach($ret->Value as $t):
								foreach($_SESSION['data']->Value as $t):
								 $ctr++;
										
				$str = $str . "<tr>
									<td>$t->MID</td>
									<td>$t->REFERENCEID</td>
									<td>$t->TRANSACTION_DATE</td>
									<td>$t->TYPE</td>
									<td>$t->MERCHANT_MSISDN</td>
									<td>$t->AMOUNT</td>
									<td>$t->STATUS</td>
									<td>$t->REASON</td>";
									if($_SESSION['datatype'] == "PANO" || $_SESSION['datatype'] == "ALL"){
									$str = $str .
									"<td>$t->AUTH_CODE</td>
									<td>$t->RRN</td>";
									}
									if($_SESSION['datatype'] == "PANO"){
									$str = $str .
									"<td>$t->CARD_DETAILS</td>
									<td>$t->CARD_HOLDER</td>";
									}
									if($_SESSION['datatype'] == "PCSH"){
									$str = $str .
									"<td>$t->CURRENCY</td>
									<td>$t->AMOUNT_GIVEN</td>
									<td>$t->CHANGE</td>";
									}
								$str = $str .
								"</tr>";
								endforeach;
				$str = $str . '</tbody>
						</table>';
			}




// output the HTML content
$pdf->writeHTML($str, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Change To Avoid the PDF Error 
  ob_end_clean();

//Close and output PDF document
$pdf->Output('transactionreports_' . date("YmdHis") . '.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
