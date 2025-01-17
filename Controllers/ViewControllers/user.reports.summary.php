<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			if(isset($_REQUEST["Method"])){
						
				switch($_REQUEST["Method"]){												
					
					case "TransactionSummary":

						if($_REQUEST["Sumdatefrom"] != '' && $_REQUEST["Sumdateto"] != ''){

						   $datediff = $this->checkDateDiff($_REQUEST["Sumdatefrom"],$_REQUEST["Sumdateto"]);
							
						   if($_SESSION['searchrange'] > $datediff){
							$ret = $serv->transactionSummary($_REQUEST["Sumdatefrom"],$_REQUEST["Sumdateto"]);
							$_SESSION['data'] = $ret;
							$this->setData("transactionsummary",$ret);
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
							$this->setData("transactionsummary",$ret);
						   }									   
							
						}else{
							$this->setData("responseMessage",_("Please input all required fields."));
						}
					break;
					
					case "ExportTransactionSummaryCSV;":
						
						$out = $this->SUexportCSV($_SESSION['data']);
						header("Content-type: text/x-csv");
						header("Content-Disposition: attachment; filename=transaction_summary_" .date("YmdHis") . ".csv");
						echo $out;
						die();
						exit;
												
					break;
				}
			}
			$this->setMaster("user.reports.summary.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>