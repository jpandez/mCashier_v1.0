<?php
session_start();

$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
							<tr class="ui-widget-header">
								<th>DATE</th>
								<th>TOTAL SUBS</th>
								<th>SUBS APPROVED</th>
								<th>SUBS USED</th>
								<th>SYS AMOUNT</th>
								<th>SUCCESS TRANS</th>
								<th>FAILED TRANS</th>
								<th>CASHIN TRANS</th>
								<th>CASHIN AMOUNT</th>
								<th>CASHOUT TRANS</th>
								<th>CASHOUT AMOUNT</th>
								<th>B2W TRANS</th>
								<th>B2W AMOUNT</th>
								<th>W2B TRANS</th>
								<th>W2B AMOUNT</th>
								<th>BILL-MERC TRANS</th>
								<th>BILL-MERC AMOUNT</th>
								<th>P2P TRANS</th>
								<th>P2P AMOUNT</th>
								<th>KEYCOST TRANS</th>
								<th>KEYCOST AMOUNT</th>
								<th>BONUS TRANS</th>
								<th>BONUS AMOUNT</th>
							</tr>
							</thead>
							<tbody>';
							 $ctr=0; 
							 foreach($_SESSION['data']->Value as $t): 
							 $ctr++;
									
							$str = $str . "<tr>".
										"<td>$t->DATEREPORT</td>
										<td>$t->SUBS</td>
										<td>$t->SUBSREG</td>
										<td>$t->SUBSUSED</td>
										<td>$t->SVA</td>
										<td>$t->SUCCESSTRANS</td>
										<td>$t->FAILEDTRANS</td>
										<td>$t->CASHINTRANS</td>
										<td>$t->CASHINAMOUNT</td>
										<td>$t->CASHOUTTRANS</td>
										<td>$t->CASHOUTAMOUNT</td>
										<td>$t->BANK2EWTRANS</td>
										<td>$t->BANK2EWAMOUNT</td>
										<td>$t->EW2BANKTRANS</td>
										<td>$t->EW2BANKAMOUNT</td>
										<td>$t->BILLTRANS</td>
										<td>$t->BILLAMOUNT</td>
										<td>$t->EW2EWTRANS</td>
										<td>$t->EW2EWAMOUNT</td>
										<td>$t->KEYCOSTTRANS</td>
										<td>$t->KEYCOSTAMOUNT</td>
										<td>$t->BONUSTRANS</td>
										<td>$t->BONUSAMOUNT</td>
									</tr>";
							endforeach;
					$str = $str . '</tbody>
					</table>';

//Change To Avoid the PDF Error 
ob_end_clean();
header("Content-type: application/octet-stream");
# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=transactionsummary_" . date("YmdHis") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $str;
?>