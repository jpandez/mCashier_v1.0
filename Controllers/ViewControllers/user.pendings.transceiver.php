<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending transceiver*/
			if($this->getRolesConfig('VIEW_PENDING_SYSTEM_INFO')){
				$getTransceiverPndg = $serv->getTransceiverPndg($_SESSION["currentUser"]);
				if(isset($getTransceiverPndg->Token)){
					$_SESSION["token"] = $getTransceiverPndg->Token;
				}
				if($getTransceiverPndg->ResponseCode == 13 || $getTransceiverPndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getTransceiverPndg",$getTransceiverPndg);
				$this->setMaster("user.pendings.transceiver.view.php");
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>