<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getCommissionsByTypePndg = $serv->getCommissionsByTypePndg();				
			$getCommissionsByMSISDNPndg = $serv->getCommissionsByMSISDNPndg();
			if(isset($getCommissionsByMSISDNPndg->Token)){
				$_SESSION["token"] = $getCommissionsByMSISDNPndg->Token;
			}
			if($getCommissionsByMSISDNPndg->ResponseCode == 13 || $getCommissionsByMSISDNPndg->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getCommissionsByTypePndg",$getCommissionsByTypePndg);
			$this->setData("getCommissionsByMSISDNPndg",$getCommissionsByMSISDNPndg);
			$this->setMaster("user.pendings.commissions.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>