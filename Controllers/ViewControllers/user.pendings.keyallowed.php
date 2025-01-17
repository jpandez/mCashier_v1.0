<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getKeyAllowedTypePndg = $serv->getKeyAllowedTypePndg();				
			$getKeyAllowedMSISDNPndg = $serv->getKeyAllowedMSISDNPndg();

			if(isset($getKeyAllowedMSISDNPndg->Token)){
				$_SESSION["token"] = $getKeyAllowedMSISDNPndg->Token;
			}
			if($getKeyAllowedMSISDNPndg->ResponseCode == 13 || $getKeyAllowedMSISDNPndg->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getKeyAllowedTypePndg",$getKeyAllowedTypePndg);
			$this->setData("getKeyAllowedMSISDNPndg",$getKeyAllowedMSISDNPndg);
			$this->setMaster("user.pendings.keyallowed.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>