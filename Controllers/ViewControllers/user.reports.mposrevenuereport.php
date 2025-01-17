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
						case "MposRevenueReport":
							if($_REQUEST["TransHdatefrom"] != '' && $_REQUEST["TransHdateto"] != ''){
								
								$datediff = $this->checkDateDiff($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
								if($_SESSION['searchrange'] > $datediff){
									
									$ret = $serv->detailedMposRevenueReport($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"],$_REQUEST["perpage"],$_REQUEST["pagenum"]);
									
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
						
						case "ExportMposRevenueReportCSV":
							if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->detailedMposRevenueReport($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"],'10','1','all');
								
								if(isset($ret)){
									$out = $this->THexportCSV($ret);
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=detailedMPOSrevenueReport_" .date("YmdHis") . ".csv");
									echo $out;
									die();
									exit;
								}
							}else{
								
								$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
							}
							
						break;
						
						case "ExportMposRevenueReportEXCEL":
							if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->detailedMposRevenueReport($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"],'10','1','all');
								
								if(isset($ret)){
									$_SESSION["searchdatefrom"] = $_REQUEST["TransHdatefrom"];
									$_SESSION["searchdateto"] = $_REQUEST["TransHdateto"];
									$out = $this->MRexportEXCEL($ret);
									ob_end_clean();
									header("Content-type: application/octet-stream");
									header("Content-Disposition: attachment; filename=detailedmCashierrevenueReport_" . date("YmdHis") . ".xls");
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
						
						case "ExportMposRevenueReportPDF":
							if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->detailedMposRevenueReport($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"],'10','1','all');
								
								if(isset($ret)){
									$_SESSION['data'] = $ret;
									$_SESSION['header'] = "Transaction History Date from : " . $_REQUEST["TransHdatefrom"] . " to " . $_REQUEST["TransHdateto"];
									$path = "/tcpdf/examples/exp_transactionhistory.php";
									$this->setData("responseReport", $path);
								}
							}else{
								
								$this->setData("responseMessage", _("Export in PDF is more than 1500 records. Please contact system administrator for scheduled reports."));
							}
							
						break;
					}
				}

				$this->setMaster("user.reports.mposrevenuereport.view.php");
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