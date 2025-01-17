<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_TOP_MERCHANT_REPORT')){
				$serv = new SubscriberServices();

				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){
						case "topmerchant":
							if($_REQUEST["reportType"] != '' && $_REQUEST["month"] != '' && $_REQUEST["year"] != ''){
									$retCASH = $serv->topFiveReportCASH($_REQUEST["reportType"],$_REQUEST["month"],$_REQUEST["year"]);
									$retCARD = $serv->topFiveReportCARD($_REQUEST["reportType"],$_REQUEST["month"],$_REQUEST["year"]);
									
									$this->setData("topFiveReportCARDData",$retCARD);
									$this->setData("topFiveReportCASHData",$retCASH);
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								
							}else{
								$this->setData("responseMessage",_("Please input all required fields."));
							}
						break;
						
						
						
					}
				}

				$this->setMaster("user.reports.topMerchant.view.php");
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