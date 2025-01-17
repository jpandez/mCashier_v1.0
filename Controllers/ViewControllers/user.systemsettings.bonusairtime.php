<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getBonusairtimeByType = $serv->getBonusAirByType();				
			$getBonusairtimeByMSISDN = $serv->getBonusAirByMSISDN();
			if(isset($getBonusairtimeByMSISDN->Token)){
				$_SESSION["token"] = $getBonusairtimeByMSISDN->Token;
			}
			if($getBonusairtimeByMSISDN->ResponseCode == 13 || $getBonusairtimeByMSISDN->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getBonusairtimeByType",$getBonusairtimeByType);
			$this->setData("getBonusairtimeByMSISDN",$getBonusairtimeByMSISDN);
			$this->setMaster("user.systemsettings.bonusairtime.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>