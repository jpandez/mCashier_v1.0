<?php
session_start();


require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

require('mailer.php');
require('config.php');

$str = '<h2 style="padding:0; margin:0;">Account Details</h2>' .
		'<table>' .
		'<tr>' .
		'<td>Account Statement : ' . $_SESSION["searchmsisdn"] . '</td>' .
		'<td rowspan="4" style="text-align:right;"></td>' .
		'</tr>' .
		'<tr>' .
		'<td>Terminal ID & Merchant ID : ' . $_SESSION["terminalid"] .' || ' . $_SESSION["merchantid"] . '</td>' .
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
		'<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
				<tr>
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
				</tr>
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
//echo $str;
if(isset($_REQUEST['is_mail'])){
	$filename = date("Ymd_His") ."_mCashier_Statement_" . $_SESSION["searchmsisdn"] . ".xls";
	createFile(TMP , $str , $filename);
	if(sendMail(SMTPHOST,SMTPPORT,SMTPUSER,
		 SMTPPASSWORD,TMP. $filename,PDF_CREATOR,$_REQUEST['tomail'],'mCashier Account Statement Report','mCashier Account Statement Report','')){
		 echo 'Mobile cashier Statement sent successfully to registered email id : ' . $_REQUEST['tomail'];
	}else{echo "Sending email faield!";}
}else{
	
//Change To Avoid the PDF Error 
ob_end_clean();
header("Content-type: application/octet-stream");
# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=" . $_SESSION["searchmsisdn"] . "_Report_" . date("YmdHis") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $str;

}

