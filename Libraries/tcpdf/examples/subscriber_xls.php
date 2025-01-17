<?php
session_start();

$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
							<tr class="ui-widget-header">
								<th>ACCOUNT ID</th>
								<th>TYPE</th>
								<th>NICKNAME</th>
								<th>FIRSTNAME</th>
								<th>SECONDNAME</th>
								<th>LASTNAME</th>
								<th>MSISDN</th>
								<th>STATUS</th>
								<th>REGDATE</th>
								<th>KYC</th>
							</tr>
							</thead>
							<tbody>';
							 $ctr=0; 
							 foreach($_SESSION['data']->Value as $t): 
							 $ctr++;
									
							$str = $str . "<tr>
										<td>$t->ID</td>
										<td>$t->TYPE</td>
										<td>$t->NICKNAME</td>
										<td>$t->FIRSTNAME</td>
										<td>$t->SECONDNAME</td>
										<td>$t->LASTNAME</td>
										<td>$t->MSISDN</td>
										<td>$t->STATUS</td>
										<td>$t->REGDATE</td>
										<td>$t->KYC</td>
									</tr>";
							endforeach;
					$str = $str . '</tbody>
					</table>';

//Change To Avoid the PDF Error 
ob_end_clean();
header("Content-type: application/octet-stream");
# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=subscriber_" . date("YmdHis") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $str;
?>