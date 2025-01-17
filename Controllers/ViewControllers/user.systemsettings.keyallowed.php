<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getKeyAllowedType = $serv->getKeyAllowedType();				
			$getKeyAllowedMSISDN = $serv->getKeyAllowedMSISDN();
			if(isset($getKeyAllowedMSISDN->Token)){
				$_SESSION["token"] = $getKeyAllowedMSISDN->Token;
			}
			if($getKeyAllowedMSISDN->ResponseCode == 13 || $getKeyAllowedMSISDN->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getKeyAllowedType",$getKeyAllowedType);
			$this->setData("getKeyAllowedMSISDN",$getKeyAllowedMSISDN);
			$this->setMaster("user.systemsettings.keyallowed.view.php");
			$this->render();
		}
	}
	$i = new SubscriberTransactionsController();
?>