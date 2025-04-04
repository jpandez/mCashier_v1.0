<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('TRANSACTION_REPORTS')){
				$serv = new SubscriberServices();

				if(isset($_REQUEST["Method"])){						
					switch($_REQUEST["Method"]){
						case "TransactionReports":
							if($_REQUEST["TransRdatefrom"] != '' && $_REQUEST["TransRdateto"] != ''){
								$datediff = $this->checkDateDiff($_REQUEST["TransRdatefrom"],$_REQUEST["TransRdateto"]);
								//if($_SESSION['searchrange'] > $datediff){
								if(31 >= $datediff){
									$ret = $serv->transactionReportsDetailsSearchMPOS($_REQUEST["selecttype"],$_REQUEST["typeValue"],$_REQUEST["type"], $_REQUEST["TransRdatefrom"],$_REQUEST["TransRdateto"],$_REQUEST["perpage"],$_REQUEST["pagenum"]);
									$_SESSION['data'] = $ret;
									$_SESSION['datatype'] = $_REQUEST['type'];
									$this->setData("transactionreportsdata",$ret);
									if(isset($ret->Token)){
										$_SESSION["token"] = $ret->Token;
									}
									if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
										session_destroy();
									}
								
								}else{
									$ret = new ServiceResponse();
									$ret->ResponseCode = 99;
									//$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									//$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;

									$ret->Message = _("Invalid Date Range your allowed date range is within : ") ."31" . _(" Days") ;
									$ret->Value = _("Invalid Date Range your allowed date range is within : ") ."31" . _(" Days") ; 

									$this->setData("transactionreportsdata",$ret);							   	
							   }
								
							}else{
								$this->setData("responseMessage",_("Please input all required fields."));
							}
						break;
						
						case "ExportTransactionReportsCSV":
							//if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->transactionReportsDetailsSearchMPOS($_REQUEST["selecttype"],$_REQUEST["typeValue"],$_REQUEST["type"], $_REQUEST["TransRdatefrom"],$_REQUEST["TransRdateto"],$_REQUEST["perpage"],$_REQUEST["pagenum"], 'all','CSV');
								if(isset($ret)){
									
									if($ret->QueryCount >= 13000){
										$this->setData("responseMessage", $ret->Value);
									}
									else{
										$out = $this->TRexportCSVmpos($ret);
										header("Content-type: text/x-csv");								
										header("Content-Disposition: attachment; filename=transaction_report_" .date("YmdHis") . ".csv");
										echo $out;
										die();
										exit;
									}
								}
							//}else{	
							//	$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
							//}
							
						break;
						
						case "ExportTransactionReportsEXCEL":
							//if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->transactionReportsDetailsSearchMPOS($_REQUEST["selecttype"],$_REQUEST["typeValue"],$_REQUEST["type"], $_REQUEST["TransRdatefrom"],$_REQUEST["TransRdateto"],$_REQUEST["perpage"],$_REQUEST["pagenum"], 'all','EXCEL');
								
								if(isset($ret)){
									
									if($ret->QueryCount >= 13000){
										$this->setData("responseMessage", $ret->Value);
									}
									else{
										$out = $this->TRexportEXCELmpos($ret);
										ob_end_clean();
										header("Content-type: application/octet-stream");
										header("Content-Disposition: attachment; filename=transaction_report_" . date("YmdHis") . ".xls");
										header("Pragma: no-cache");
										header("Expires: 0");
										echo $out;
										die();
										exit;
									}
									
								}
							//}else{	
							//	$this->setData("responseMessage", _("Export in EXCEL is more than 1500 records. Please contact system administrator for scheduled reports."));
							//}
							
						break;
						
						case "ExportTransactionReportsPDF":
							//if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->transactionReportsDetailsSearchMPOS($_REQUEST["selecttype"],$_REQUEST["typeValue"],$_REQUEST["type"], $_REQUEST["TransRdatefrom"],$_REQUEST["TransRdateto"],$_REQUEST["perpage"],$_REQUEST["pagenum"], 'all');
								
								if(isset($ret)){
									$_SESSION['data'] = $ret;
									$_SESSION['datatype'] = $_REQUEST['type'];
									$_SESSION['header'] = "Transaction Report Date from : " . $_REQUEST["TransRdatefrom"] . " to " . $_REQUEST["TransRdateto"];
									$path = "/tcpdf/examples/exp_transactionreports.php";
									$this->setData("responseReport", $path);
								}
							///}else{	
							//	$this->setData("responseMessage", _("Export in PDF is more than 1500 records. Please contact system administrator for scheduled reports."));
							//}
							
						break;
					}
				}

				$this->setMaster("user.reports.transactionreports.view.php");
				//$this->render();
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>