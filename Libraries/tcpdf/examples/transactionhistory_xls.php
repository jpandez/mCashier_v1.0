<?php
session_start();

$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
							<tr class="ui-widget-header">
								<th>ID</th>
								<th>REFERENCE ID</th>
								<th>TYPE</th>
								<th>DETAIL TYPE</th>
								<th>SOURCE</th>
								<th>DESTINATION</th>
								<th>AMOUNT</th>
								<th>SOURCE BALANCE BEFORE</th>
								<th>SOURCE BALANCE AFTER</th>
								<th>DEST BALANCE BEFORE</th>
								<th>DEST BALANCE AFTER</th>
								<th>TRANSACTION DATE</th>
							</tr>
							</thead>
							<tbody>';
							 $ctr=0; 
							 foreach($_SESSION['data']->Value as $t): 
							 $ctr++;
									
							$str = $str . "<tr>
										<td>$t->ID</td>
										<td>$t->REFERENCEID</td>
										<td>$t->TRANSTYPE</td>
										<td>$t->DETAILTYPE</td>
										<td>$t->SOURCE</td>
										<td>$t->DESTINATION</td>
										<td>$t->AMOUNT</td>
										<td>$t->SOURCEBALANCEBEFORE</td>
										<td>$t->SOURCEBALANCEAFTER</td>
										<td>$t->DESTINATIONBALANCEBEFORE</td>
										<td>$t->DESTINATIONBALANCEAFTER</td>
										<td>$t->TRANSACTIONDATE</td>
									</tr>";
							endforeach;
					$str = $str . '</tbody>
					</table>';

//Change To Avoid the PDF Error 
ob_end_clean();
header("Content-type: application/octet-stream");
# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=transactionhistory_" . date("YmdHis") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $str;
?>