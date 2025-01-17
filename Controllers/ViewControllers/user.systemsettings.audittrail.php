<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_AUDIT_TRAILS')){
			
				if($_REQUEST["fromdate"] != '' && $_REQUEST["todate"] != ''){
					$serv = new SubscriberServices();	
					//$ret = $serv->getAuditTrail($_SESSION["currentUserID"],$_SESSION["currentUser"],$_REQUEST["fromdate"],$_REQUEST["todate"]);
					$ret = $serv->getAuditTrail($_REQUEST["userid"],$_REQUEST["username"],$_REQUEST["fromdate"],$_REQUEST["todate"]);
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
				}else{
					$this->setData("responseMessage",_("Please input all required fields."));
				}
				$this->setMaster("user.systemsettings.audittrail.view.php");
				$this->setData("reports",$ret);
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