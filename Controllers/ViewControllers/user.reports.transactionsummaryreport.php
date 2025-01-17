<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('TRANSACTION_HISTORY')){
				$serv = new SubscriberServices();

				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){
						case "Transactions":
							if($_REQUEST["TransSdatefrom"] != '' && $_REQUEST["TransSdateto"] != ''){
								
								$datediff = $this->checkDateDiff($_REQUEST["TransSdatefrom"],$_REQUEST["TransSdateto"]);
								if($_SESSION['searchrange'] > $datediff){
									
									$ret = $serv->transactionSummaryReport($_REQUEST["TransSdatefrom"],$_REQUEST["TransSdateto"]);
									$_SESSION['datatype'] = $_REQUEST['type'];
									$this->setData("transactionhistorydata",$ret);
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								
								}else{
									$ret = new ServiceResponse();
									$ret->ResponseCode = 99;
									$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									$this->setData("transactionhistorydata",$ret);
							   }
								
							}else{
								$this->setData("responseMessage",_("Please input all required fields."));
							}
						break;
						
						case "ExportTransactionsCSV":
							if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->transactionSummaryReport($_REQUEST["TransSdatefrom"],$_REQUEST["TransSdateto"]);
								
								if(isset($ret)){
									$out = $this->THexportCSVmpos($ret);
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=transaction_history_" .date("YmdHis") . ".csv");
									echo $out;
									die();
									exit;
								}
							}else{
								
								$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
							}
							
						break;
						
						case "ExportTransactionsEXCEL":
							if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->transactionSummaryReport($_REQUEST["TransSdatefrom"],$_REQUEST["TransSdateto"]);
								
								if(isset($ret)){								
									$out = $this->THexportEXCELmpos($ret);
									ob_end_clean();
									header("Content-type: application/octet-stream");
									header("Content-Disposition: attachment; filename=transactionhistory_" . date("YmdHis") . ".xls");
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
						
						case "ExportTransactionsPDF":
							if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->transactionSummaryReport($_REQUEST["TransSdatefrom"],$_REQUEST["TransSdateto"]);
								
								if(isset($ret)){
									$_SESSION['data'] = $ret;
									$_SESSION['datatype'] = $_REQUEST['type'];
									$_SESSION['header'] = "Transaction History Date from : " . $_REQUEST["TransSdatefrom"] . " to " . $_REQUEST["TransSdateto"];
									$path = "/tcpdf/examples/exp_transactionhistory.php";
									$this->setData("responseReport", $path);
								}
							}else{
								
								$this->setData("responseMessage", _("Export in PDF is more than 1500 records. Please contact system administrator for scheduled reports."));
							}
							
						break;
					}
				}

				$this->setMaster("user.reports.transactionsummaryreport.view.php");
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