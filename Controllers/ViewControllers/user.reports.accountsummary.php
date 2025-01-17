<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			$accountsummary = $serv->accountSummarySearch(isset($_REQUEST['perpage'])?$_REQUEST['perpage']:'15',isset($_REQUEST['pagenum'])?$_REQUEST['pagenum']:'1');
			$_SESSION['accountsummary'] = $accountsummary;
			$this->setData("accountsummary",$accountsummary);
			$this->setMaster("user.reports.accountsummary.view.php");
			if($accountsummary->ResponseCode !=0){
				$this->setData("responseMessage",$ret->Message);
			}
			if(isset($accountsummary->Token)){
				$_SESSION["token"] = $accountsummary->Token;
			}
			if($accountsummary->ResponseCode == 13 || $accountsummary->ResponseCode == 14){
				session_destroy();
			}
			
			if(isset($_REQUEST["Method"])){
				switch($_REQUEST["Method"]){
					case "ExportAccountSummaryCSV":
						if($_REQUEST["queryCount"] <= 10000){
							$ret = $serv->accountSummarySearch('15','1','all');
							
							if(isset($ret)){
								$out = $this->ASexportCSV($ret);								
								header("Content-type: text/x-csv");								
								header("Content-Disposition: attachment; filename=accountsummary_" .date("YmdHis") . ".csv");
								echo $out;
								die();
								exit;
							}
						}else{
							
							$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
						}
						
					break;
					
					case "ExportAccountSummaryEXCEL":
						if($_REQUEST["queryCount"] <= 1500){
							$ret = $serv->accountSummarySearch('15','1','all');
							
							if(isset($ret)){								
								$out = $this->ASexportEXCEL($ret);
								ob_end_clean();
								header("Content-type: application/octet-stream");
								header("Content-Disposition: attachment; filename=accountsummary_" . date("YmdHis") . ".xls");
								header("Pragma: no-cache");
								header("Expires: 0");
								echo $out;
								die();
								exit;
							}
						}else{
							
							$this->setData("responseMessage", _("Export in EXCEL is more than 1500 records. Please contact system administrator for scheduled reports."));
						}
						
					break;
					
					case "ExportAccountSummaryPDF":
						if($_REQUEST["queryCount"] <= 1500){
														
							$ret = $serv->accountSummarySearch('15','1','all');
							
							if(isset($ret)){
								$_SESSION['data'] = $ret;
								$_SESSION['header'] = "Account Summary Report Date : " . date("Y-m-d H:i:s");
								$path = "/tcpdf/examples/exp_accountsummary.php";
								$this->setData("responseReport", $path);
							}
						}else{
							
							$this->setData("responseMessage", _("Export in PDF is more than 1500 records. Please contact system administrator for scheduled reports."));
						}
						
					break;
				}
			}
			
			$this->render();
			
		}
	}
		$i = new SubscriberTransactionsController();
?>