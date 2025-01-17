<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			
			if($this->getRolesConfig('VIEW_SYSTEM_INFO_CONFIGURED')){
				$getKeyCostType = $serv->getKeyCostType();				
				$getKeyCostMSISDN = $serv->getKeyCostMSISDN();				
				
				if(isset($getKeyCostType->Token)){
					$_SESSION["token"] = $getKeyCostType->Token;
				}
				if($getKeyCostType->ResponseCode == 13 || $getKeyCostType->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getKeyCostType",$getKeyCostType);
				$this->setData("getKeyCostMSISDN",$getKeyCostMSISDN);
				$this->setMaster("user.systemsettings.keycosttype.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>