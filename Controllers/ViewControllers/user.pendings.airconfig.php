<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending air config*/
			if($this->getRolesConfig('VIEW_PENDING_SYSTEM_INFO')){
				$getAirConfigPndg = $serv->getAirConfigPndg($_SESSION["currentUser"]);
				if(isset($getAirConfigPndg->Token)){
					$_SESSION["token"] = $getAirConfigPndg->Token;
				}
				if($getAirConfigPndg->ResponseCode == 13 || $getAirConfigPndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getAirConfigPndg",$getAirConfigPndg);
				$this->setMaster("user.pendings.airconfig.view.php");
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>