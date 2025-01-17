<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getBonusByType = $serv->getBonusByType();				
			$getBonusByMSISDN = $serv->getBonusByMSISDN();
			if(isset($getBonusByMSISDN->Token)){
				$_SESSION["token"] = $getBonusByMSISDN->Token;
			}
			if($getBonusByMSISDN->ResponseCode == 13 || $getBonusByMSISDN->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getBonusByType",$getBonusByType);
			$this->setData("getBonusByMSISDN",$getBonusByMSISDN);
			$this->setMaster("user.systemsettings.bonus.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>