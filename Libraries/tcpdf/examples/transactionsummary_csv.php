<?php
session_start();
$header = "DATE,TOTAL SUBS,SUBS APPROVED,SUBS USED,SYS AMOUNT,SUCCESS TRANS,FAILED TRANS,CASHIN TRANS,CASHIN AMOUNT,CASHOUT TRANS,CASHOUT AMOUNT,B2W TRANS,B2W AMOUNT,W2B TRANS,W2B AMOUNT,BILL-MERC TRANS,BILL-MERC AMOUNT,P2P TRANS,P2P AMOUNT,KEYCOST TRANS,KEYCOST AMOUNT,BONUS TRANS,BONUS AMOUNT\r\n";
$data = "";
foreach($_SESSION['data']->Value as $t){
	$data = $data . $t->DATEREPORT . "," . $t->SUBS . "," . $t->SUBSREG . "," . $t->SUBSUSED . "," . $t->SVA . "," . $t->SUCCESSTRANS . "," . $t->FAILEDTRANS . "," . $t->CASHINTRANS . "," . $t->CASHINAMOUNT . "," . $t->CASHOUTTRANS . "," . $t->CASHOUTAMOUNT . "," . $t->BANK2EWTRANS . "," . $t->BANK2EWAMOUNT . "," . $t->EW2BANKTRANS . "," . $t->EW2BANKAMOUNT . "," . $t->BILLTRANS . "," . $t->BILLAMOUNT . "," . $t->EW2EWTRANS . "," . $t->EW2EWAMOUNT . "," . $t->KEYCOSTTRANS . "," . $t->KEYCOSTAMOUNT . "," . $t->BONUSTRANS . "," . $t->BONUSAMOUNT . "\r\n";
}

$out = $header . $data;

header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=transaction_summary_" .date("YmdHis") . ".csv");
echo $out;
?>