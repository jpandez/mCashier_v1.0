<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('REGISTERED_MERCHANTS_REPORT')){
				$serv = new SubscriberServices();
				
				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){
						case "RegisteredMerchants":
							
							$ret = $serv->registeredMerchantsInActiveReport($_REQUEST["selecttype"],$_REQUEST["perpage"],$_REQUEST["pagenum"],'page','30');
							$_SESSION['datatype'] = $_REQUEST['type'];
							$this->setData("registeredmerchantsdata",$ret);
							if(isset($ret->Token)){
								$_SESSION["token"] = $ret->Token;
							}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
								session_destroy();
							}
							
						break;
						
						case "ExportRegisteredMerchantsCSV":
							//if($_REQUEST["queryCount"] <= 10000){
								$ret = $serv->registeredMerchantsInActiveReport($_REQUEST["selecttype"],'10','1','all','30');
								
								if(isset($ret)){
									$out = $this->RMexportCSVmpos($ret);
									header("Content-type: text/x-csv");
									header("Content-Disposition: attachment; filename=inactive_merchants_30days_active_" .date("YmdHis") . ".csv");
									echo $out;
									die();
									exit;
								}
							//}else{
							//	$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
							//}
							
						break;
						
						case "ExportRegisteredMerchantsEXCEL":
							//if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->registeredMerchantsInActiveReport($_REQUEST["selecttype"],'10','1','all','30');
								
								if(isset($ret)){								
									$out = $this->RMexportEXCELmpos($ret);
									ob_end_clean();
									header("Content-type: application/octet-stream");
									header("Content-Disposition: attachment; filename=inactive_merchants_30days_active_" . date("YmdHis") . ".xls");
									header("Pragma: no-cache");
									header("Expires: 0");
									echo $out;
									die();
									exit;
								}
							//}else{	
							//	$this->setData("responseMessage", _("Export in EXCEL is more than 1500 records. Please contact system administrator for scheduled reports."));
							//}
							
						break;
						
						case "ExportRegisteredMerchantsPDF":
							//if($_REQUEST["queryCount"] <= 1500){
								$ret = $serv->registeredMerchantsReport($_REQUEST["selecttype"],'10','1','all');
								
								if(isset($ret)){
									$_SESSION['data'] = $ret;
									$_SESSION['datatype'] = $_REQUEST['type'];
									$_SESSION['header'] = "Registered Merchants Date from : ";
									$path = "/tcpdf/examples/exp_registeredmerchants.php";
									$this->setData("responseReport", $path);
								}
							//}else{
							//	$this->setData("responseMessage", _("Export in PDF is more than 1500 records. Please contact system administrator for scheduled reports."));
							//}
							
						break;
						
					}
				}else{
					$_REQUEST["selecttype"] = 'ETISALAT';
					$ret = $serv->registeredMerchantsInActiveReport($_REQUEST["selecttype"],'15','1','page','30');
					$_SESSION['datatype'] = $_REQUEST['type'];
					$this->setData("registeredmerchantsdata",$ret);
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
				}

				$this->setMaster("user.reports.inactivemerchants30.view.php");
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