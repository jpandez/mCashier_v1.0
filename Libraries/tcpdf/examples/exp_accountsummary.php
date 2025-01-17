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

$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
							<tr class="ui-widget-header">
								<th>ID</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
								<th>MSISDN</th>
								<th>NICKNAME</th>
								<th>STATUS</th>
								<th>CURRENT AMOUNT</th>
								<th>LAST TRANSACTION DATE</th>
								<th>LOCKED</th>
								<th>LOCKED DESCRIPTION</th>
							</tr>
							</thead>
							<tbody>';
							 $ctr=0; 
							 foreach($_SESSION['data']->Value as $t): 
							 $ctr++;
									
							$str = $str . "<tr>
										<td>$t->ID</td>
										<td>$t->FIRSTNAME</td>
										<td>$t->LASTNAME</td>
										<td>$t->MSISDN</td>
										<td>$t->NICKNAME</td>
										<td>$t->STATUS</td>
										<td>$t->CURRENTAMOUNT</td>
										<td>$t->LASTTRANSDATE</td>
										<td>$t->LOCKED</td>
										<td>$t->LOCKED_DESCRIPTION</td>
									</tr>";
							endforeach;
					$str = $str . '</tbody>
					</table>';

// output the HTML content
$pdf->writeHTML($str, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

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
