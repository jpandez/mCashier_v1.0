<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			if(isset($_REQUEST["fromdate"]) && isset($_REQUEST["todate"])){
				if($_REQUEST["fromdate"] != '' && $_REQUEST["todate"] != ''){
					$serv = new SubscriberServices();	
					$ret = $serv->getAuditTrail($_REQUEST["userid"],$_REQUEST["username"],$_REQUEST["fromdate"],$_REQUEST["todate"]);
				}else{
					$this->setData("responseMessage",_("Please input all required fields."));
				}
			}
			$this->setMaster("user.systemsettings.audittrail.view.php");
			$this->setData("reports",$ret);
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>