<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getCommissionsByType = $serv->getCommissionsByType();				
			$getCommissionsByMSISDN = $serv->getCommissionsByMSISDN();
			if(isset($getCommissionsByMSISDN->Token)){
				$_SESSION["token"] = $getCommissionsByMSISDN->Token;
			}
			if($getCommissionsByMSISDN->ResponseCode == 13 || $getCommissionsByMSISDN->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getCommissionsByType",$getCommissionsByType);
			$this->setData("getCommissionsByMSISDN",$getCommissionsByMSISDN);
			$this->setMaster("user.systemsettings.commissions.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>