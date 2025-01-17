<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			if(!isset($_REQUEST["perpage"])){
				$_REQUEST["perpage"] = 10;
				$_REQUEST["pagenum"]= 1;
			}
			
			$ret = $serv->getDlerCommissionsDetails($_REQUEST["perpage"], $_REQUEST["pagenum"], 'page', $_SESSION["title"], $_SESSION["runid"]);
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getCommissionsPndgForConfirmation",$ret);
			
			
			if($this->getRolesConfig('VIEW_PENDING_DEALER_COMMISSION')){
				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){						
						case "ExportDetailsCSV":
							if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->getDlerCommissionsDetails(10, 1, 'all', $_SESSION["title"], $_SESSION["runid"]);
								
								if(isset($ret)){									
									
									$heads = "ID,REFERENCETO,TYPE,MSISDN,AMOUNT,REMARKS,TRANSACTION DATE\r\n";
									$data = "";
									foreach($ret->Value as $t){
										$data = $data . $t->RUNID . "," . $t->REFERENCEID . "," . $t->TYPE . "," . $t->MSISDN . "," . $t->CREDIT . "," . $t->REMARKS . "," . $t->TIMESTAMP ."\r\n";
									}
									
									$str = $heads . $data;
									$out = $str;
																	
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=dealer_commission_" . $_SESSION["title"] ."_" .date("YmdHis") . ".csv");
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
				
				$this->setMaster("user.pendings.dealercommission1sumdetails.view.php");
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>