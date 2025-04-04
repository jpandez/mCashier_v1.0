
<?php
	class ViewController{
		var $_master = "";
		var $_headerFile;
		var $_contents;
		var $_data=null;
		var $_viewPath;
        public $roles = array();
	
		public function __construct(){
			$this->_viewPath = $GLOBALS["VIEW_PATH"];
			 
            /* fix to redirect to login page if session not isset.             */
            $url = $_SERVER["REQUEST_URI"];
            $url = explode("/",$url);
			if(!isset($_SESSION["currentUser"]) && $url[count($url) - 1] <> "index.php"){
				if (!isset($_SESSION['reloaded'])) {
					$_SESSION['reloaded'] = true;
					echo "<script nonce=".$_SESSION['nonce'].">location.reload();</script>"; 
					exit;
				}
			}
            
            /* populate session for roles if exists */
            if(isset($_SESSION['roles'])){
                $this->roles = $_SESSION['roles'];
            }
		}

		public function setCSP(){
			$nonce = base64_encode(random_bytes(16));
			$csp = "default-src 'self'; script-src 'self' 'nonce-$nonce'; style-src 'self' 'nonce-$nonce'; img-src 'self' data:; connect-src 'self'; font-src 'self'; object-src 'none'; frame-ancestors 'self'; form-action 'self';";
			$_SESSION['nonce'] = $nonce;
			header("Content-Security-Policy: $csp");
		}
		
		public function setViewPath($path){
			$this->_viewPath = $path;
		}
		public function setContent($name,$path){
			$this->setCSP();
			if ($_SESSION["ISFIRSTLOGON"] == 1 || $_SESSION["USEREXPIRY"] > 0){
				$this->_contents[$name] = 'user.management.view.php';
			}else{
				$this->_contents[$name] = $path;
			}
			//$this->_contents[$name] = $path;
		}
		public function setMaster($master){
				$this->_master = $master;
		}
		
		public function setHtmlHeaders($headerFile){
			$this->_headerFile = $headerFile;
		}
		
		
		public function setData($name,$value){
			$this->_data[$name] = $value;
		}
		
		public function render(){
		//header('Set-Cookie: HttpOnly;Secure');
		//header("Cache-Control: no-cache, no-store");
		//header("Pragma: no-cache");
		
			require_once($this->_viewPath . $this->_master);
		}
		
		public function loadContent($name){
		
			include_once($this->_viewPath . $this->_contents[$name]);
		}
		
		public function loadHtmlHeaders(){
			include_once($this->_viewPath . $this->_headerFile);
		}
		
		public function data($name){
				if($this->_data==null)return null;
				return array_key_exists($name,$this->_data)?$this->_data[$name]:null;
			
		}
        
        public function addRolesConfig($module = '' , $value = ''){
            $this->roles[$module] = $value;
            $_SESSION['roles'] = $this->roles;
        }
        
        public function getRolesConfig($module = ''){
            return ($this->roles[$module] == "YES") ? true : false;
        }
		
		public function checkDateDiff($fromdate = '', $todate = ''){
			$date1 = new DateTime($fromdate);
			$date2 = new DateTime($todate);
			$interval = $date1->diff($date2);
			echo "";
			return $interval->days;
		 }
		 
		public function CheckAlpha($value = ''){
			$validString = preg_match("/^[a-zA-Z0-9_.() -]+$/", $value) ? true : false;
			return $validString;
		}
		
		public function CheckNumeric($value = ''){
			$validString = preg_match("/^[0-9,.]+$/", $value) ? true : false;
			return $validString;
		}
		
		/* Reports Exports */
		public function TRexportCSV($ret){
			if($_SESSION['datatype'] == "HITS_PULL"){
			
				$header = "ID,REFERENCE ID,TYPE,MSISDN,MESSAGE,TRANSACTION DATE\r\n";
				$data = "";
				foreach($ret->Value as $t){
					$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TYPE . "," . $t->MSISDN . "," . $t->MESSAGE . "," . $t->TIMESTAMP ."\r\n";
				}

			}else{
		
				$header = "ID,REFERENCE ID,TYPE,DETAIL TYPE,SOURCE,DESTINATION,AMOUNT,SOURCE BALANCE BEFORE,SOURCE BALANCE AFTER,DEST BALANCE BEFORE,DEST BALANCE AFTER,TRANSACTION DATE,REF1,REF2\r\n";
				$data = "";
				foreach($ret->Value as $t){
					$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TRANSTYPE . "," . $t->DETAILTYPE . "," . $t->SOURCE . "," . $t->DESTINATION . "," . $t->AMOUNT . "," . $t->SOURCEBALANCEBEFORE . "," . $t->SOURCEBALANCEAFTER . "," . $t->DESTINATIONBALANCEBEFORE . "," . $t->DESTINATIONBALANCEAFTER . "," . $t->TRANSACTIONDATE . ",'" . html_entity_decode($t->REFDATA1) . "','" . $t->REFDATA2 ."'\r\n";
				}
			}
			$str = $header . $data;
			return $str;
		}
		
		public function TRexportEXCEL($ret){
		
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
								 foreach($ret->Value as $t): 
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
									<th>REF1</th>
									<th>REF2</th>
								</tr>
							</thead>
							<tbody>';
								 $ctr=0; 
								 foreach($ret->Value as $t): 
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
									<td>$t->REFDATA1</td>
									<td>$t->REFDATA2</td>
								</tr>";
								endforeach;
				$str = $str . '</tbody>
						</table>';
			}

			return $str;
		}
		
		public function THexportCSV($ret){
			$header = "ID,REFERENCE ID,TYPE,DETAIL TYPE,SOURCE,DESTINATION,AMOUNT,SOURCE BALANCE BEFORE,SOURCE BALANCE AFTER,DEST BALANCE BEFORE,DEST BALANCE AFTER,TRANSACTION DATE\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TRANSTYPE . "," . $t->DETAILTYPE . "," . $t->SOURCE . "," . $t->DESTINATION . "," . $t->AMOUNT . "," . $t->SOURCEBALANCEBEFORE . "," . $t->SOURCEBALANCEAFTER . "," . $t->DESTINATIONBALANCEBEFORE . "," . $t->DESTINATIONBALANCEAFTER . "," . $t->TRANSACTIONDATE ."\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function THexportEXCEL($ret){

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
							 foreach($ret->Value as $t): 
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

			return $str;
		}
		
		public function ASexportCSV($ret){
			$header = "ID,FIRST NAME,LAST NAME,MSISDN,NICKNAME,STATUS,CURRENT AMOUNT,LAST TRANSACTION DATE,LOCKED,LOCKED DESCRIPTION\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->ID . "," . $t->FIRSTNAME . "," . $t->LASTNAME . "," . $t->MSISDN . "," . $t->NICKNAME . "," . $t->STATUS . "," . $t->CURRENTAMOUNT . "," . $t->LASTTRANSDATE . "," . $t->LOCKED . "," . $t->LOCKED_DESCRIPTION ."\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function ASexportEXCEL($ret){

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
							 foreach($ret->Value as $t): 
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

			return $str;
		}
		
		public function SubsexportCSV($ret){
			$header = "ACCOUNT ID,TYPE,NICKNAME,FIRSTNAME,SECONDNAME,LASTNAME,MSISDN,STATUS,REGDATE,KYC,BUSINESS TYPE\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->ID . "," . $t->TYPE . "," . $t->NICKNAME . "," . $t->FIRSTNAME . "," . $t->SECONDNAME . "," . $t->LASTNAME . "," . $t->MSISDN . "," . $t->STATUS . "," . $t->REGDATE . "," . $t->KYC . "," . $t->CORPTYPEOFBUSINESS . "\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function SubsexportEXCEL($ret){
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
							<th>BUSINESS TYPE</th>
						</tr>
						</thead>
						<tbody>';
				 $ctr=0; 
				 foreach($ret->Value as $t): 
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
								<td>$t->CORPTYPEOFBUSINESS</td>
							</tr>";
							endforeach;
					$str = $str . '</tbody>
					</table>';
			return $str;
		}
		
		public function SUexportCSV($ret){
			$header = "DATE,TOTAL SUBS,SUBS APPROVED,SUBS USED,SYS AMOUNT,SUCCESS TRANS,FAILED TRANS,CASHIN TRANS,CASHIN AMOUNT,CASHOUT TRANS,CASHOUT AMOUNT,B2W TRANS,B2W AMOUNT,W2B TRANS,W2B AMOUNT,BILL-MERC TRANS,BILL-MERC AMOUNT,P2P TRANS,P2P AMOUNT,KEYCOST TRANS,KEYCOST AMOUNT,BONUS TRANS,BONUS AMOUNT\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->DATEREPORT . "," . $t->SUBS . "," . $t->SUBSREG . "," . $t->SUBSUSED . "," . $t->SVA . "," . $t->SUCCESSTRANS . "," . $t->FAILEDTRANS . "," . $t->CASHINTRANS . "," . $t->CASHINAMOUNT . "," . $t->CASHOUTTRANS . "," . $t->BANK2EWTRANS . "," . $t->BANK2EWAMOUNT . "," . $t->EW2BANKTRANS . "," . $t->EW2BANKAMOUNT . "," . $t->BILLTRANS . "," . $t->BILLAMOUNT . "," . $t->EW2EWTRANS . "," . $t->EW2EWAMOUNT . "," . $t->KEYCOSTTRANS . "," . $t->KEYCOSTAMOUNT . "," . $t->BONUSTRANS . "," . $t->BONUSAMOUNT . "\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function TFexportCSV($ret){
			$header = "REFERENCE ID,TRANSACTION DATE,TRANSACTION TYPE,STATUS,SOURCE MSISDN,FIRST NAME,LAST NAME,ACCOUNT TYPE,MESSAGE HITS,MESSAGE PULL\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->REFERENCEID . "," . $t->TRANSACTIONDATE . "," . $t->TRANSTYPE . "," . $t->STATUS . "," . $t->MSISDN . "," . $t->FIRSTNAME . "," . $t->LASTNAME . "," . $t->ACCOUNTTYPE . "," . $t->MSGHITS . ",(" . $t->MSGPULL .")\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function TFexportEXCEL($ret){

			$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
						<thead>
							<tr class="ui-widget-header">
								<th>REFERENCE ID</th>
								<th>TRANSACTION DATE</th>
								<th>TRANSACTION TYPE</th>
								<th>SOURCE MSISDN</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
								<th>ACCOUNT TYPE</th>
								<th>STATUS</th>
								<th>MESSAGE HITS</th>
								<th>MESSAGE PULL</th>
							</tr>
						</thead>
						<tbody>';
							 $ctr=0; 
							 foreach($ret->Value as $t): 
							 $ctr++;
									
			$str = $str . "<tr>
								<td>$t->REFERENCEID</td>
								<td>$t->TRANSACTIONDATE</td>
								<td>$t->TRANSTYPE</td>
								<td>$t->MSISDN</td>
								<td>$t->FIRSTNAME</td>
								<td>$t->LASTNAME</td>
								<td>$t->ACCOUNTTYPE</td>
								<td>$t->STATUS</td>
								<td>$t->MSGHITS</td>
								<td>$t->MSGPULL</td>
							</tr>";
							endforeach;
			$str = $str . '</tbody>
					</table>';

			return $str;
		}
		
		public function USERSexportCSV($ret){
			$header = "USERID,USERNAME,MSISDN,FIRSTNAME,LASTNAME,USERSLEVEL,STATUS,DEPARTMENT,LOCKED,DATEREGISTERED,DATEMODIFIED,EMAIL\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->USERID . "," . $t->USERNAME . "," . $t->MSISDN . "," . $t->FIRSTNAME . "," . $t->LASTNAME . "," . $t->USERSLEVEL . "," . $t->STATUS . "," . $t->DEPARTMENT . "," . $t->LOCKED . "," . $t->DATEREGISTERED . "," . $t->DATEMODIFIED . "," . $t->EMAIL . "\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function MRexportEXCEL($ret){
			$str =  '<table >' .
					'<tr><td colspan="9"><b><font color="red">Report Name:</font> Detailed mCashier Revenue Report</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Source:</font> mCashier Server (GUI)</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Period:  From:</font> ' . $_SESSION["searchdatefrom"] . ' <font color="red">To:</font> ' . $_SESSION["searchdateto"] . ' </b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Date & Time Stamp (Generated Date):</font> ' . date("F j, Y g:i a") . '</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">User Name (Generated The Report) :</font> ' . $_SESSION["currentUser"] . '</b></td></tr>' .
					'</table><br>';
			$str = $str . '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;font-size: 12px;">
						<thead>
							<tr class="ui-widget-header" bgcolor="#C4BCBC">
								<th>TRANSACTION DATE</th>
								<th>AUTHORIZATION CODE</th>
								<th>UNIQUE TRANSACTION REFERENCE</th>
								<th>CREDIT CARD</th>
								<th>MERCHANT ID</th>
								<th>MERCHANT MSISDN</th>
								<th>COMPANY NAME</th>
								<th>TRANSACTION AMOUNT</th>
								<th>ACQUIRER INTERCHANGE</th>
								<th>REVENUE SHARE</th>
							</tr>
						</thead>
						<tbody>';
							 $ctr=0; $total=0; $rate=0; $share=0;
							 foreach($ret->Value as $t): 
							 $ctr++;
								$total = $total + $t->TRANSACTION_AMOUNT;
								$rate = $rate + $t->INTERCHANGE_RATE;
								$share = $share + $t->REVENUE_SHARE;
			$str = $str . "<tr>
								<td>'$t->TRANSACTION_DATE'</td>
								<td>$t->AUTHORIZATION_CODE</td>
								<td>$t->UNIQUE_TRANSACTION_REFERENCE</td>
								<td>$t->CREDIT_CARD</td>
								<td>$t->MERCHANTID</td>
								<td>$t->MSISDN</td>
								<td>$t->MERCHANTNAME</td>
								<td>$t->TRANSACTION_AMOUNT</td>
								<td>$t->INTERCHANGE_RATE</td>
								<td>$t->REVENUE_SHARE</td>
							</tr>";
							endforeach;
			$str = $str . "<tr><tdcolspan='9'></td></tr>
					<tr><td colspan='6'></td><td><b><font color='red'>Total</font></b></td><td><b><font color='red'>$total</font></b></td><td><b><font color='red'>$rate</font></b></td><td><b><font color='red'>$share</font></b></td></tr>
					</tbody>
					</table>";

			return $str;
		}
		
		
		public function GSexportEXCEL($ret){
			$str =  '<table >' .
					'<tr><td colspan="9"><b><font color="red">Report Name:</font> Detailed GlobalSearch Report</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Source:</font> mCashier Server (GUI)</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Date & Time Stamp (Generated Date):</font> ' . date("F j, Y g:i a") . '</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">User Name (Generated The Report) :</font> ' . $_SESSION["currentUser"] . '</b></td></tr>' .
					'</table><br>';
			$str = $str . '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;font-size: 12px;">
						<thead>
							<tr class="ui-widget-header" bgcolor="#C4BCBC">
								<th>TRANSACTION ID</th>
								<th>TRANSACTION DATE</th>
								<th>TYPE</th>
								<th>MERCHANT PHONE</th>								
								<th>MESSAGE</th>
							</tr>
						<thead>
						<tbody>';
			$ctr=0; $total=0; $rate=0; $share=0;
			foreach($ret->Value as $t):
			$ctr++;
			
			if($t->TYPE == "SENT" || $t->TYPE == "RECV"){
			$str = $str . "<tr>
				<td>$t->REFERENCEID</td>
				<td>'$t->TRANSACTION_DATE'</td>
				<td>$t->TYPE</td>
				<td>$t->MERCHANT_MSISDN</td>
				<td>$t->MESSAGE</td>
				</tr>";
			}
			endforeach;
			$str = $str . "<tr><tdcolspan='9'></td></tr>
			</tbody>
			</table>";
			
			$str = $str . '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;font-size: 12px;">
						<thead>
							<tr class="ui-widget-header" bgcolor="#C4BCBC">
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
						<thead>
						<tbody>';
			
			$ctr=0; $total=0; $rate=0; $share=0;
			foreach($ret->Value as $t):
			$ctr++;
				
			if($t->TYPE != "SENT" && $t->TYPE != "RECV"){
				$str = $str . "<tr>
				<td>$t->MID</td>
				<td>$t->REFERENCEID</td>
				<td>'$t->TRANSACTION_DATE'</td>
				<td>$t->TYPE</td>
				<td>$t->MERCHANT_MSISDN</td>
				<td>$t->AMOUNT</td>
				<td>$t->STATUS</td>
				<td>$t->REASON</td>
				<td>$t->AUTH_CODE</td>
				<td>$t->RRN</td>
				</tr>";
			}
			endforeach;
			$str = $str . "<tr><tdcolspan='9'></td></tr>
			</tbody>
			</table>";
	
			return $str;
		}
		
		public function GSexportCSV($ret){
			$header = "TRANSACTIONID,TRANSACTIONDATE,TYPE,MERCHANTPHONE,MESSAGE\r\n";
			$data = "";
			foreach($ret->Value as $t):
				if($t->TYPE == "SENT" || $t->TYPE == "RECV"){
					$data = $data . $t->REFERENCEID . "," . $t->TRANSACTION_DATE . "," . $t->TYPE . "," . $t->MERCHANT_MSISDN . "," . $t->MESSAGE . "\r\n";
				}
			endforeach;
			$str = $header . $data . "\r\n\r\n";
			
			$str = $str . "MERCHANTID,TRANSACTIONID,TRANSACTIONDDATE,TYPE,MERCHANTMSISDN,AMOUNT,STATUS,REASON,AUTHCODE,RRN\r\n";
			foreach($ret->Value as $t):
				if($t->TYPE != "SENT" && $t->TYPE != "RECV"){
					$str = $str . $t->MID . "," . $t->REFERENCEID . ",'" . $t->TRANSACTION_DATE . "'," . $t->TYPE . "," . $t->MERCHANT_MSISDN . "," . $t->AMOUNT . "," . $t->STATUS . "," . $t->REASON . "," . $t->AUTH_CODE . "," . $t->RRN . "\r\n";
				}
			endforeach;
								
			return $str;
		}
		
		public function SMRexportEXCEL($ret){
			$str =  '<table >' .
					'<tr><td colspan="9"><b><font color="red">Report Name:</font> Summary mCashier Revenue Report</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Source:</font> mCashier Server (GUI)</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Period:  From:</font> ' . $_SESSION["searchdatefrom"] . ' <font color="red">To:</font> ' . $_SESSION["searchdateto"] . ' </b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">Report Date & Time Stamp (Generated Date):</font> ' . date("F j, Y g:i a") . '</b></td></tr>' .
					'<tr><td colspan="9"><b><font color="red">User Name (Generated The Report) :</font> ' . $_SESSION["currentUser"] . '</b></td></tr>' .
					'</table><br>';
			$str = $str . '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;font-size: 12px;">
						<thead>
							<tr class="ui-widget-header" bgcolor="#C4BCBC">
								<th>CARD SCHEME</th>
								<th>ONBOARDED BY</th>
								<th>TOTAL</th>
								<th>ACQUIRER INTERCHANGE</th>
								<th>REVENUE SHARE</th>
							</tr>
						</thead>
						<tbody>';
							 $ctr=0; $total=0; $rate=0; $share=0;
							 foreach($ret->Value as $t): 
							 $ctr++;
								$total = ($total) + floatval(str_replace(',', '', $t->TOTAL));
								$rate = $rate + $t->INTERCHANGE_RATE;
								$share = $share + $t->REVENUE_SHARE;
			$str = $str . "<tr>
								<td>$t->CARD_TYPE</td>
								<td>$t->CORPONBOARDEDBY</td>
								<td>$t->TOTAL</td>
								<td>$t->INTERCHANGE_RATE</td>
								<td>$t->REVENUE_SHARE</td>
							</tr>";
							endforeach;
			$str = $str . "<tr><tdcolspan='9'></td></tr>
					<tr><td></td><td><b><font color='red'>Total</font></b></td><td><b><font color='red'>$total</font></b></td><td><b><font color='red'>$rate</font></b></td><td><b><font color='red'>$share</font></b></td></tr>
					</tbody>
					</table>";

			return $str;
		}
		
		public function THexportCSVmpos($ret){
			if($_SESSION['datatype'] == "HITS_PULL"){
			
				$header = "ID,TRANSACTION ID,TYPE,MSISDN,MESSAGE,TRANSACTION DATE\r\n";
				$data = "";
				foreach($ret->Value as $t){
					$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TYPE . "," . $t->MSISDN . "," . $t->MESSAGE . "," . $t->TIMESTAMP ."\r\n";
				}

			}else{
				if($_SESSION['datatype'] == "ALL"){
					$header = "MERCHANT ID,TRANSACTION ID,TRANSACTION DATE,TYPE,MERCHANT MSISDN,COMPANY,TERMINALID,AMOUNT,STATUS,REASON,AUTH CODE,RRN,NOTE\r\n";
					$data = "";
					foreach($ret->Value as $t){
						$data = $data . $t->MID . "," . $t->REFERENCEID . "," . $t->TRANSACTION_DATE . "," . $t->TYPE . "," . $t->MERCHANT_MSISDN . "," . $t->COMPANY . "," . $t->TERMINALID . ",". $t->AMOUNT . "," . ($t->STATUS==0?"SUCCESS":"FAILED") . "," . $t->REASON . "," . $t->AUTH_CODE . "," . $t->RRN . "," . $t->NOTE ."\r\n";
					}
				}
				
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function THexportEXCELmpos($ret){

			if($_SESSION['datatype'] == "HITS_PULL"){
				$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
								<tr class="ui-widget-header">
									<th>ID</th>
									<th>TRANSACTION ID</th>
									<th>TYPE</th>
									<th>MSISDN</th>
									<th>MESSAGE</th>
									<th>TRANSACTION DATE</th>
								</tr>
							</thead>
								<tbody>';
								 $ctr=0; 
								 foreach($ret->Value as $t): 
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
									<th>TRANSACTION ID</th>
									<th>TRANSACTION DATE</th>
									<th>TYPE</th>
									<th>MERCHANT MSISDN</th>
									<th>COMPANY</th>
									<th>TERMINALID</th>
									<th>AMOUNT</th>
									<th>STATUS</th>
									<th>REASON</th>';
									$str = $str .
									'<th>AUTH CODE</th>
									<th>RRN</th>
									<th>NOTE</th>';
									
								$str = $str .
								'</tr>
							</thead>
							<tbody>';
								 $ctr=0; 
								 foreach($ret->Value as $t): 
								 $ctr++;$statusDesc = $t->STATUS==0?"SUCCESS":"FAILED";
										
				$str = $str . "<tr>
									<td>$t->MID</td>
									<td>$t->REFERENCEID</td>
									<td>$t->TRANSACTION_DATE</td>
									<td>$t->TYPE</td>
									<td>$t->MERCHANT_MSISDN</td>
									<td>$t->COMPANY</td>
									<td>$t->TERMINALID</td>
									<td>$t->AMOUNT</td>
									<td>$statusDesc</td>
									<td>$t->REASON</td>";
									$str = $str .
									"<td>$t->AUTH_CODE</td>
									<td>$t->RRN</td>
									<td>$t->NOTE</td>";
								$str = $str .
								"</tr>";
								endforeach;
				$str = $str . '</tbody>
						</table>';
			}

			return $str;
		}
		
		public function TRexportCSVmpos($ret){
			if($_SESSION['datatype'] == "HITS_PULL"){
			
				$header = "ID,TRANSACTION ID,TYPE,MSISDN,MESSAGE,TRANSACTION DATE\r\n";
				$data = "";
				foreach($ret->Value as $t){
					$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TYPE . "," . $t->MSISDN . "," . $t->MESSAGE . "," . $t->TIMESTAMP ."\r\n";
				}

			}else{
				if($_SESSION['datatype'] == "ALL"){
					$header = "MERCHANT ID,TRANSACTION ID,TRANSACTION DATE,TYPE,MERCHANT MSISDN,COMPANY,TERMINALID,AMOUNT,STATUS,REASON,AUTH CODE,RRN,NOTE\r\n";
					$data = "";
					foreach($ret->Value as $t){
						$data = $data . $t->MID . "," . $t->REFERENCEID . "," . $t->TRANSACTION_DATE . "," . $t->TYPE . "," . $t->MERCHANT_MSISDN . "," . $t->COMPANY . "," . $t->TERMINALID. "," . $t->AMOUNT . "," . ($t->STATUS==0?"SUCCESS":"FAILED") . "," . $t->REASON . "," . $t->AUTH_CODE . "," . $t->RRN . "," . $t->NOTE ."\r\n";
					}
				}
				if($_SESSION['datatype'] != "ALL"){
					$header = "MERCHANT ID,TRANSACTION ID,TRANSACTION DATE,TYPE,MERCHANT MSISDN,AMOUNT,STATUS,REASON,AUTH CODE,RRN,CARD DETAILS,CARD HOLDER,NOTE\r\n";
					$data = "";
					foreach($ret->Value as $t){
						$data = $data . $t->MID . "," . $t->REFERENCEID . "," . $t->TRANSACTION_DATE . "," . $t->TYPE . "," . $t->MERCHANT_MSISDN . "," . $t->COMPANY . "," . $t->TERMINALID . "," . $t->AMOUNT . "," . ($t->STATUS==0?"SUCCESS":"FAILED") . "," . $t->REASON . "," . $t->AUTH_CODE . "," . $t->RRN . "," . $t->CARD_DETAILS . "," . $t->CARD_HOLDER . "," . $t->NOTE ."\r\n";
					}
				}
				if($_SESSION['datatype'] == "PCSH"){
					$header = "MERCHANT ID,TRANSACTION ID,TRANSACTION DATE,TYPE,MERCHANT MSISDN,AMOUNT,STATUS,REASON,CURRENCY,AMOUNT GIVEN,CHANGE,NOTE\r\n";
					$data = "";
					foreach($ret->Value as $t){
						$data = $data . $t->MID . "," . $t->REFERENCEID . "," . $t->TRANSACTION_DATE . "," . $t->TYPE . "," . $t->MERCHANT_MSISDN . "," . $t->COMPANY . "," . $t->TERMINALID . "," . $t->AMOUNT . "," . ($t->STATUS==0?"SUCCESS":"FAILED") . "," . $t->REASON . "," . $t->CURRENCY . "," . $t->AMOUNT_GIVEN . "," . $t->CHANGE . "," . $t->NOTE ."\r\n";
					}
				}
			}
			$str = $header . $data;
			return $str;
		}
		
		public function TRexportEXCELmpos($ret){
		
			if($_SESSION['datatype'] == "HITS_PULL"){
				$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
							<thead>
								<tr class="ui-widget-header">
									<th>ID</th>
									<th>TRANSACTION ID</th>
									<th>TYPE</th>
									<th>MSISDN</th>
									<th>MESSAGE</th>
									<th>TRANSACTION DATE</th>
								</tr>
							</thead>
								<tbody>';
								 $ctr=0; 
								 foreach($ret->Value as $t): 
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
									<th>TRANSACTION ID</th>
									<th>TRANSACTION DATE</th>
									<th>TYPE</th>
									<th>MERCHANT MSISDN</th>
									<th>COMPANY</th>
									<th>TERMINAL ID</th>
									<th>AMOUNT</th>
									<th>STATUS</th>
									<th>REASON</th>';
									#if($_SESSION['datatype'] == "PANO" || $_SESSION['datatype'] == "ALL"){
									if($_SESSION['datatype'] == "CARDS" ||$_SESSION['datatype'] == "PNOE" || $_SESSION['datatype'] == "PNOM" || $_SESSION['datatype'] == "PNCM" || $_SESSION['datatype'] == "ALL") {
									$str = $str .
									'<th>AUTH CODE</th>
									<th>RRN</th>';
									}
									#if($_SESSION['datatype'] == "PANO"){
									if($_SESSION['datatype'] == "CARDS" ||$_SESSION['datatype'] == "PNOE" || $_SESSION['datatype'] == "PNOM" || $_SESSION['datatype'] == "PNCM") {
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
								$str = $str . '<th>NOTE</th>' .
								'</tr>
							</thead>
							<tbody>';
								 $ctr=0; 
								 foreach($ret->Value as $t): 
								 $ctr++;$statusDesc = $t->STATUS==0?"SUCCESS":"FAILED";
										
				$str = $str . "<tr>
									<td>$t->MID</td>
									<td>$t->REFERENCEID</td>
									<td>$t->TRANSACTION_DATE</td>
									<td>$t->TYPE</td>
									<td>$t->MERCHANT_MSISDN</td>
									<td>$t->COMPANY</td>
									<td>$t->TERMINALID</td>
									<td>$t->AMOUNT</td>
									<td>$statusDesc</td>
									<td>$t->REASON</td>";
									if($_SESSION['datatype'] == "CARDS" ||$_SESSION['datatype'] == "PNOE" || $_SESSION['datatype'] == "PNOM" || $_SESSION['datatype'] == "PNCM" || $_SESSION['datatype'] == "ALL") {
									$str = $str .
									"<td>$t->AUTH_CODE</td>
									<td>$t->RRN</td>";
									}
									if($_SESSION['datatype'] == "CARDS" ||$_SESSION['datatype'] == "PNOE" || $_SESSION['datatype'] == "PNOM" || $_SESSION['datatype'] == "PNCM") {
									$str = $str .
									"<td>$t->CARD_DETAILS</td>
									<td>$t->CARD_HOLDER</td>
									<td>$t->NOTE</td>";
									
									}
									if($_SESSION['datatype'] == "PCSH"){
									$str = $str .
									"<td>$t->CURRENCY</td>
									<td>$t->AMOUNT_GIVEN</td>
									<td>$t->CHANGE</td>";
									}
								$str = $str . "<td>$t->NOTE</td>" .
								"</tr>";
								endforeach;
				$str = $str . '</tbody>
						</table>';
			}

			return $str;
		}
		
		
		public function TRexportCSVmercrevenue($ret){
					
			$header = "CORPONBOARDEDBY,MERCHANT ID,TERMINAL ID,MSISDN,COMPANY,TOTAL TRANSACTIONS,TOTAL AMOUNT, TOTAL REVENUE\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->CORPONBOARDEDBY . "," .$t->MERCHANTID . "," . $t->TERMINALID . "," . $t->MSISDN . "," . $t->COMPANY . "," . $t->TOTALTRANS . "," . str_replace(',', '', $t->TOTALAMOUNT)  . "," . str_replace(',', '', $t->TOTALREVENUE) ."\r\n";
			}
		
			
			$str = $header . $data;
			return $str;
		}
		
		
		public function TRexportEXCELmercrevenue($ret){	
			$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
						<thead>
							<tr class="ui-widget-header">
								<th>BOARDED BY</th>
								<th>MERCHANT ID</th>
								<th>TERMINAL ID</th>
								<th>MSISDN</th>
								<th>COMPANY</th>
								<th>TOTAL TRANSACTIONS</th>
								<th>TOTAL AMOUNT</th>
								<th>TOTAL REVENUE</th>
							</tr>
						</thead>
							<tbody>';
			$ctr=0;
			foreach($ret->Value as $t):
			$ctr++;
	
			$str = $str . "<tr>
			<td>$t->CORPONBOARDEDBY</td>
			<td>$t->MERCHANTID</td>
			<td>$t->TERMINALID</td>
			<td>$t->MSISDN</td>
			<td>$t->COMPANY</td>
			<td>$t->TOTALTRANS</td>
			<td>$t->TOTALAMOUNT</td>
			<td>$t->TOTALREVENUE</td>
			</tr>";
			endforeach;
			$str = $str . '</tbody>
			</table>';
			
		
			return $str;
		}
		
		
		public function RMexportCSVmpos($ret){		
			$header = "MERCHANT ID,COMPANY,TERMINAL ID,MSISDN,ACCOUNT TYPE,DATE REGISTERED,OWNERSHIP,MERCHANT RATE PREMIUM,MERCHANT RATE NON PREMIUM\r\n";
			$data = "";
			foreach($ret->Value as $t){
				$data = $data . $t->MERCHANTID . "," . $t->CORPBUSINESSNAME . "," . $t->TERMINALID . "," . $t->MSISDN . "," . $t->DESCRIPTION . ",'" . $t->REGDATE . "'," . $t->CORPONBOARDEDBY . "," . $t->PREMIUM . "," . $t->NONPREMIUM ."\r\n";
			}
			
			$str = $header . $data;
			return $str;
		}
		
		public function RMexportEXCELmpos($ret){

			$str = '<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-color:black;">
						<thead>
							<tr class="ui-widget-header">
								<th>MERCHANT ID</th>
								<th>COMPANY</th>
								<th>TERMINAL ID</th>
								<th>MSISDN</th>
								<th>ACCOUNT TYPE</th>
								<th>DATE REGISTERED</th>
								<th>OWNERSHIP</th>
								<th>MERCHANT RATE PREMIUM</th>
								<th>MERCHANT RATE NON PREMIUM</th>';
								
							$str = $str .
							'</tr>
						</thead>
						<tbody>';
							 $ctr=0; 
							 foreach($ret->Value as $t): $ctr++;
									
			$str = $str . "<tr>
								<td>$t->MERCHANTID</td>
								<td>$t->CORPBUSINESSNAME</td>
								<td>$t->TERMINALID</td>
								<td>$t->MSISDN</td>
								<td>$t->DESCRIPTION</td>
								<td>$t->REGDATE</td>
								<td>$t->CORPONBOARDEDBY</td>
								<td>$t->PREMIUM</td>
								<td>$t->NONPREMIUM</td>";
								
							$str = $str .
							"</tr>";
							endforeach;
			$str = $str . '</tbody>
					</table>';

			return $str;
		}
		
		/*public function verifyIP(){
			$token = $_REQUEST["t"];
		
			$valid = FALSE;
			if($_SESSION['loginip']==((!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP']: (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'])){
				$valid = TRUE && $_SESSION['pagetoken'] == $token;
			}
			$valid = TRUE;
            return $valid;
        }*/
		public function verifyIP(){
			$token = $_REQUEST["t"];
			
			$valid = FALSE;
			if($_SESSION['loginip']==((!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP']: ((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']))){
			}
			$methodlist = array("SearchList","Search");
			
			if (strpos($_REQUEST["Method"] ?? '', 'Export') !== false) {
				 return TRUE; 
			}

			if (strpos($_REQUEST["Method"] ?? '', '1') !== false) {
				return TRUE; 
		   	}
			
			if (in_array($_REQUEST["Method"] ?? '', $methodlist)) {
				if($_SESSION['pagetoken'] == $token){
					$valid = TRUE;
				}else{
					$valid = FALSE;
				}
			}else{
				$valid = TRUE;
			}
			
			if(isset($_REQUEST["Method"]) && $_SESSION['pagetoken'] != $token){
				$_REQUEST["Method"] = NULL;
				$this->setData("responseMessage",_("Token not valid. Please refresh the page"));
			}else{
				
			}
			$valid = TRUE;
            return $valid;
        }
	}
?>