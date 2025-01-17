<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getAirbonusTopup = $serv->getAirbonusTopup();
			if(isset($getAirbonusTopup->Token)){
				$_SESSION["token"] = $getAirbonusTopup->Token;
			}
			if($getAirbonusTopup->ResponseCode == 13 || $getAirbonusTopup->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getAirbonusTopup",$getAirbonusTopup);
			$this->setMaster("user.systemsettings.airbonustopup.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>