<?php 

session_start(); 

?>

<?php

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');


class MYPDF extends TCPDF {	
}

$pdf = new MYPDF('P', 'px', array(1122, 302), true, 'UTF-8', false);//new MYPDF('P', PDF_UNIT, $custom_layout, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Telcom Live Content');
$pdf->SetTitle('Transaction Reports');
$pdf->SetSubject('Transaction Reports');
$pdf->SetKeywords('TLC, Telcom Live Content');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
//$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font

$pdf->SetFont('courier', '', 8.5);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
//var_dump($_SESSION['data']->Value );
$data = $_SESSION['data']->Value ;


// output the HTML content
$pdf->writeHTML($data, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Change To Avoid the PDF Error 
  ob_end_clean();

//Close and output PDF document
$pdf->Output('transactionreceipt_' . date("YmdHis") . '.pdf', 'FD');

//============================================================+
// END OF FILE                                                
//============================================================+
