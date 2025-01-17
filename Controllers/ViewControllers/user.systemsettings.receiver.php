<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			/*Receiver*/
			
			if($this->getRolesConfig('VIEW_SYSTEM_INFO_CONFIGURED')){
				$getReceiver = $serv->getReceiver();		
				if($getReceiver->ResponseCode == 13 || $getReceiver->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getReceiver",$getReceiver);
				$this->setMaster("user.systemsettings.receiver.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>