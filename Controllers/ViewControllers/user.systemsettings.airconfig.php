<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getAirConfig = $serv->getAirConfig();
			if(isset($getAirConfig->Token)){
				$_SESSION["token"] = $getAirConfig->Token;
			}
			if($getAirConfig->ResponseCode == 13 || $getAirConfig->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getAirConfig",$getAirConfig);
			$this->setMaster("user.systemsettings.airconfig.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>