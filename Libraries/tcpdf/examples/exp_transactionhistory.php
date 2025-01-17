<?php 

session_start(); 

?>

<?php

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');


// extend TCPF with custom functions
class MYPDF extends TCPDF {

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
$pdf->SetTitle('Transaction History');
$pdf->SetSubject('Transaction History');
$pdf->SetKeywords('TLC, Telcom Live Content');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING . $_SESSION['header']);

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
									$str = $str .
									'<th>AUTH CODE</th>
									<th>RRN</th>';
									
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
									$str = $str .
									"<td>$t->AUTH_CODE</td>
									<td>$t->RRN</td>";
									
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
$pdf->Output('transactionsummary_' . date("YmdHis") . '.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
