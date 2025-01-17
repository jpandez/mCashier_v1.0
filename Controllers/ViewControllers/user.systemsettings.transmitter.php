<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			/*Transmitter*/
			if($this->getRolesConfig('VIEW_SYSTEM_INFO_CONFIGURED')){
				$getTransmitter = $serv->getTransmitter();
				if($getTransmitter->ResponseCode == 13 || $getTransmitter->ResponseCode == 14){
					session_destroy();
				}				
				$this->setData("getTransmitter",$getTransmitter);
				$this->setMaster("user.systemsettings.transmitter.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>