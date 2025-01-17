<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() ){
				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){
						case "ExportPDF":
							//print_r("asdf");
							$serv = new SubscriberServices();
							$ret = $serv->statementReceipt($_REQUEST["referenceid"]);
							//var_dump($ret);
							$_SESSION['data'] = '';
							if(isset($ret)){
								//var_dump("asdf");
								$_SESSION['data'] = $ret;
								//print_r($_SESSION['data']);
								//header('Location:' . 'http://185.3.152.34/Projects/mCashier_v1.0/Libraries/tcpdf/examples/exp_transactionreceipt.php');
								header('Location:' . $GLOBALS["BASE_URL"]  . 'Libraries/tcpdf/examples/exp_transactionreceipt.php');
								//$this->setData("responseReport", $path);
							}		
							//var_dump("qwert");
						break;
						
						
					}
				}else{
					if($_REQUEST["DateFrom"] == '' || $_REQUEST["DateTo"] == ''){
						$this->setData("responseMessage",_("Please input all required fields."));
						$this->setMaster("subscriber.transactions.view.php");
						$this->render();
					}else{
						$serv = new SubscriberServices();
						$datediff = $this->checkDateDiff($_REQUEST["DateFrom"],$_REQUEST["DateTo"]);
						   
						 
						if($_SESSION['searchrange'] > $datediff){
							if(isset($_REQUEST["Key"]) && $_REQUEST["Key"] != ''){
								$ret = $serv->getStatementKey($_REQUEST["MSISDN"],$_REQUEST["DateFrom"],$_REQUEST["DateTo"],$_REQUEST['Key']);
							}else{
								$ret = $serv->getStatementMPOS($_REQUEST["MSISDN"],$_REQUEST["DateFrom"],$_REQUEST["DateTo"]);
							}
							if($ret->ResponseCode == 0){
							$_SESSION['searchdata'] = $ret->Value;
							$_SESSION['searchdatefrom'] = $_REQUEST["DateFrom"];
							$_SESSION['searchdateto'] = $_REQUEST["DateTo"];
							}
							
							if(isset($ret->Token)){
								$_SESSION["token"] = $ret->Token;
							}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
								session_destroy();
							}
							$this->setMaster("subscriber.transactions.view.php");
							$this->setData("reports",$ret);
							$this->render();
							
							
						}else{
							$ret = new ServiceResponse();
							$ret->ResponseCode = 99;
							$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
							$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
							
							$this->setMaster("subscriber.transactions.view.php");
							$this->setData("reports",$ret);
							$this->render();							   	
						}
					}
				}
			}else{
				$this->setMaster('index.master.php');
				$this->render();
			}
			
		}
		
		function checkDateDiff($fromdate = '', $todate = ''){
			$date1 = new DateTime($fromdate);
			$date2 = new DateTime($todate);
			$interval = $date1->diff($date2);
			
			return $interval->days;
		}
	}
		$i = new SubscriberTransactionsController();
?>