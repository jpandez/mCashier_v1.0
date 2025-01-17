<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getbonusairtimeByTypePndg = $serv->getBonusAirByTypePndg();
			$getbonusairtimeByMSISDNPndg = $serv->getBonusAirByMSISDNPndg();
			if(isset($getbonusairtimeByMSISDNPndg->Token)){
				$_SESSION["token"] = $getbonusairtimeByMSISDNPndg->Token;
			}
			if($getbonusairtimeByMSISDNPndg->ResponseCode == 13 || $getbonusairtimeByMSISDNPndg->ResponseCode == 14){
				session_destroy();
			}
			//print_r($getbonusairtimeByTypePndg);
			$this->setData("getbonusairtimeByTypePndg",$getbonusairtimeByTypePndg);
			$this->setData("getbonusairtimeByMSISDNPndg",$getbonusairtimeByMSISDNPndg);
			$this->setMaster("user.pendings.bonusairtime.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>