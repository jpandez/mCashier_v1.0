<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending dealer commission*/
			if($this->getRolesConfig('VIEW_PENDING_DEALER_COMMISSION')){
				/* $ret = $serv->getCommissionsPndg(); */
				
				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){
						case "getDealerCommissionForConfirmation":	
							if($_REQUEST["TransDdatefrom"] != '' && $_REQUEST["TransDdateto"] != ''){
								$datediff = $this->checkDateDiff($_REQUEST["TransDdatefrom"],$_REQUEST["TransDdateto"]);
								if($_SESSION['searchrange'] > $datediff){
							
									$ret = $serv->getDlerCommissionsDetail($_REQUEST["TransDdatefrom"],$_REQUEST["TransDdateto"]);
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
									$this->setData("responseMessage",$ret->Message);
							   }
							}else{
								$this->setData("responseMessage",_("Please input all required fields."));
							}
							$this->setData("getCommissionsPndgForConfirmation",$ret);
						break;
						case "getDealerCommission":	
							if($_REQUEST["TransHdatefrom"] != '' && $_REQUEST["TransHdateto"] != ''){
								$datediff = $this->checkDateDiff($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
								if($_SESSION['searchrange'] > $datediff){
							
									$ret = $serv->getDlerCommissionsDetailForApproval($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
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
									$this->setData("responseMessage",$ret->Message);
							   }
							}else{
								$this->setData("responseMessage",_("Please input all required fields."));
							}
							$this->setData("getCommissionsPndg",$ret);
						break;
						
						
						case "ExportConfirmationCSV":
							if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->getDlerCommissionsPndg($_REQUEST["TransDdatefrom"],$_REQUEST["TransDdateto"],10, 1, 'all', 'FOR CONFIRMATION');
								
								if(isset($ret)){									
									
									$heads = "ID,REFERENCETO,TYPE,SOURCE,DESTINATION,AMOUNT,REMARKS,NAME,TRANSACTION DATE\r\n";
									$data = "";
									foreach($ret->Value as $t){
										$data = $data . $t->ID . "," . $t->REFERENCETO . "," . $t->TYPE . "," . $t->FRMSISDN . "," . $t->TOMSISDN . "," . $t->AMOUNT . "," . $t->REMARKS . "," . $t->NAME . "," . $t->TIMESTAMP ."\r\n";
									}
									
									$str = $heads . $data;
									$out = $str;
																	
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=dealer_commission_for_confirmation_" .date("YmdHis") . ".csv");
									echo $out;
									die();
									exit;
								}
							}else{
								
								$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
							}
						
						break;
						case "ExportApprovalCSV":
							if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->getDlerCommissionsPndg($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"],10, 1, 'all', 'FOR APPROVAL');
								
								if(isset($ret)){									
									
									$heads = "ID,REFERENCETO,TYPE,SOURCE,DESTINATION,AMOUNT,REMARKS,NAME,TRANSACTION DATE\r\n";
									$data = "";
									foreach($ret->Value as $t){
										$data = $data . $t->ID . "," . $t->REFERENCETO . "," . $t->TYPE . "," . $t->FRMSISDN . "," . $t->TOMSISDN . "," . $t->AMOUNT . "," . $t->REMARKS . "," . $t->NAME . "," . $t->TIMESTAMP ."\r\n";
									}
									
									$str = $heads . $data;
									$out = $str;
																	
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=dealer_commission_for_approval_" .date("YmdHis") . ".csv");
									echo $out;
									die();
									exit;
								}
							}else{
								
								$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
							}
						
						break;
						
					}
				}				
				/* print_r($ret); */
				
				$ret = $serv->getDlerCommissionsFiles('0');
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getCommissionsPndgForConfirmation",$ret);
				$ret = $serv->getDlerCommissionsFiles('5');
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getCommissionsPndg",$ret);
				
				$this->setMaster("user.pendings.dealercommission1.view.php");
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>