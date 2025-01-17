<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getAirbonusTopupPndg = $serv->getAirbonusTopupPndg($_SESSION["currentUser"]);
			if(isset($getAirbonusTopupPndg->Token)){
					$_SESSION["token"] = $getAirbonusTopupPndg->Token;
			}
			if($getAirbonusTopupPndg->ResponseCode == 13 || $getAirbonusTopupPndg->ResponseCode == 14){
				session_destroy();
			}
			//print_r($getAirbonusTopupPndg);
			$this->setData("getAirbonusTopupPndg",$getAirbonusTopupPndg);
			$this->setMaster("user.pendings.airbonustopup.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>