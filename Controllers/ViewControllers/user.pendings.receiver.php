<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending receiver*/
			if($this->getRolesConfig('VIEW_PENDING_SYSTEM_INFO')){
				$getReceiverPndg = $serv->getReceiverPndg($_SESSION["currentUser"]);
				if(isset($getReceiverPndg->Token)){
					$_SESSION["token"] = $getReceiverPndg->Token;
				}
				if($getReceiverPndg->ResponseCode == 13 || $getReceiverPndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getReceiverPndg",$getReceiverPndg);
				$this->setMaster("user.pendings.receiver.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>