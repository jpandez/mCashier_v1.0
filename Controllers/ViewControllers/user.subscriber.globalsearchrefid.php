<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			
			
			if(isset($_REQUEST["Method"])){
				switch($_REQUEST["Method"]){
					case "ExportToExcel":
						$serv = new SubscriberServices();	
						$ret = $serv->globalSearchReferenceIDMPOS($_REQUEST["referenceid"],$_REQUEST["refiddatefrom"],$_REQUEST["refiddateto"],$_REQUEST["selecttype"]);
						//print_r($ret);
						if(isset($ret)){
							$out = $this->GSexportEXCEL($ret);
							ob_end_clean();
							header("Content-type: application/octet-stream");
							header("Content-Disposition: attachment; filename=detailedTransaction_" . date("YmdHis") . ".xls");
							header("Pragma: no-cache");
							header("Expires: 0");
							echo $out;
							die();
							exit;
						}
						break;
					case "ExportToCSV":
						$serv = new SubscriberServices();
						$ret = $serv->globalSearchReferenceIDMPOS($_REQUEST["referenceid"],$_REQUEST["refiddatefrom"],$_REQUEST["refiddateto"],$_REQUEST["selecttype"]);
						//print_r($ret);
						if(isset($ret)){
							$out = $this->GSexportCSV($ret);
							ob_end_clean();
							header("Content-type: text/x-csv");
							header("Content-Disposition: attachment; filename=detailed_transaction" . date("YmdHis") . ".csv");
							header("Pragma: no-cache");
							header("Expires: 0");
							echo $out;
							die();
							exit;
						}
						break;
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
				if($_REQUEST["referenceid"] == ''){
					$this->setData("responseMessage",_("Please input reference id/rrn."));
					$this->setMaster("subscriber.globalsearchrefid.view.php");
					$this->render();
				}else if($_REQUEST["refiddatefrom"] == '' || $_REQUEST["refiddateto"] == ''){
					$this->setData("responseMessage",_("Invalid date."));
					$this->setMaster("subscriber.globalsearchrefid.view.php");
					$this->render();
				}else{
					$serv = new SubscriberServices();	
					$ret = $serv->globalSearchReferenceIDMPOS($_REQUEST["referenceid"],$_REQUEST["refiddatefrom"],$_REQUEST["refiddateto"],$_REQUEST["selecttype"]);
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					
					$this->setData("reports",$ret);
				}
			}
			$this->setMaster("subscriber.globalsearchrefid.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>