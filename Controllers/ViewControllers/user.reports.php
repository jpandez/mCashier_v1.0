<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php");?>
<?php
	class SubscriberController extends ViewController{
	   
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP()){
					$serv = new SubscriberServices();
				
					$this->setData("currentUser",$_SESSION["currentUser"]);
					$this->setData("pageTitle",_("System Report"));
					
					if(isset($_REQUEST["Method"])){						
						switch($_REQUEST["Method"]){
							
							case "ExportTransactionSummaryCSV":
								
								if(isset($_SESSION['data'])){
									$header = "DATE,CASHQTY,CASHSEND,ALLOCQTY,ALLOCSEND,DEALLOCQTY,DEALLOCSEND\r\n";
									$data = "";
									foreach($_SESSION['data']->Value as $t){
										$data = $data . date('Y-m-d', strtotime($t->TIMESTAMP)). "," . $t->CASHQTY . "," . $t->CASHSEND . "," . $t->ALLOCQTY . "," . $t->ALLOCSEND . "," . $t->DEALLOCQTY . "," . $t->DEALLOCSEND  ."\r\n";
									}
									
									$out = $header . $data;
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=transaction_summary_" .date("YmdHis") . ".csv");
									echo $out;
									die();
								} 
								exit;
							break;
							
							case "ExportSubscriberCSV":
								
								if(isset($_SESSION['data'])){
									$header = "ACCOUNT ID,TYPE,NICKNAME,FIRSTNAME,SECONDNAME,LASTNAME,MSISDN,STATUS,REGDATE,KYC\r\n";
									$data = "";
									foreach($_SESSION['data']->Value as $t){
										$data = $data . $t->ID . "," . $t->TYPE . "," . $t->NICKNAME . "," . $t->FIRSTNAME . "," . $t->SECONDNAME . "," . $t->LASTNAME . "," . $t->MSISDN . "," . $t->STATUS . "," . $t->REGDATE . "," . $t->KYC ."\r\n";
									}
									
									$out = $header . $data;
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=subscriber_list_" . date("YmdHis") . ".csv");
									echo $out;
									die();
								} 
								exit;
							break;
							
							case "ExportTransactionHistoryCSV":
								
								if(isset($_SESSION['data'])){
									
									$header = "ID,REFERENCE ID,TYPE,DETAIL TYPE,SOURCE,DESTINATION,AMOUNT,SOURCE BALANCE BEFORE,SOURCE BALANCE AFTER,DEST BALANCE BEFORE,DEST BALANCE AFTER,TRANSACTION DATE\r\n";
									$data = "";
									foreach($_SESSION['data']->Value as $t){
										$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TRANSTYPE . "," . $t->DETAILTYPE . "," . $t->SOURCE . "," . $t->DESTINATION . "," . $t->AMOUNT . "," . $t->SOURCEBALANCEBEFORE . "," . $t->SOURCEBALANCEAFTER . "," . $t->DESTINATIONBALANCEBEFORE . "," . $t->DESTINATIONBALANCEAFTER . "," . $t->TRANSACTIONDATE ."\r\n";
									}
									
									$out = $header . $data;
									
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=transaction_history_" .date("YmdHis") . ".csv");
									echo $out;
									die();
								} 
								exit;
							break;
							
							case "ExportAccountSummaryCSV":
								
								if(isset($_SESSION['accountsummary'])){
									$header = "ID,FIRSTNAME,LASTNAME,MSISDN,NICKNAME,STATUS,CURRENTAMOUNT\r\n";
									$data = "";
									foreach($_SESSION['accountsummary']->Value as $t){
										$data = $data . $t->ID . "," . $t->FIRSTNAME . "," . $t->LASTNAME . "," . $t->MSISDN . "," . $t->NICKNAME . "," . $t->STATUS . "," . $t->CURRENTAMOUNT ."\r\n";
									}
									
									$out = $header . $data;
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=account_summary_" . date("YmdHis") . ".csv");
									echo $out;
									die();
								} 
								exit;
							break;
							
							case "ExportTransactionReportsCSV":
								
								if(isset($_SESSION['data'])){
									if(isset($_SESSION['data'])){
									if($_SESSION['datatype'] == "HITS_PULL"){
									
									$header = "ID,
												REFERENCE ID,
												TYPE,
												MSISDN,
												MESSAGE,
												TRANSACTION DATE\r\n";
									$data = "";
									foreach($_SESSION['data']->Value as $t){
										$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TYPE . "," . $t->MSISDN . "," . $t->MESSAGE . ",". $t->TIMESTAMP ."\r\n";
									}
									$out = $header . $data;										
									}else{
									$header = "ID,REFERENCE ID,TYPE,DETAIL TYPE,SOURCE,DESTINATION,AMOUNT,SOURCE BALANCE BEFORE,SOURCE BALANCE AFTER,DEST BALANCE BEFORE,DEST BALANCE AFTER,TRANSACTION DATE\r\n";
									$data = "";
									foreach($_SESSION['data']->Value as $t){
										$data = $data . $t->ID . "," . $t->REFERENCEID . "," . $t->TRANSTYPE . "," . $t->DETAILTYPE . "," . $t->SOURCE . "," . $t->DESTINATION . "," . $t->AMOUNT . "," . $t->SOURCEBALANCEBEFORE . "," . $t->SOURCEBALANCEAFTER . "," . $t->DESTINATIONBALANCEBEFORE . "," . $t->DESTINATIONBALANCEAFTER . "," . $t->TRANSACTIONDATE ."\r\n";
									}
									
									$out = $header . $data;
									}
									}
									
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=transaction_reports_" .  date("YmdHis")  . ".csv");
									echo $out;
									die();
								} 
								exit;
							break;
						}
					}	
					
					$this->setContent('main','user.reports.view.php');
					$this->setMaster('user.master.php');
					
					
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
		
		
	}
	
	$emp = new SubscriberController();
?>