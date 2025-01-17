<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_UPDATE_MSISDNS')){
				$updatemsisdn = $serv->getMSISDNUpdateRequest();
				
				if(isset($updatemsisdn->Token)){
					$_SESSION["token"] = $updatemsisdn->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($updatemsisdn->ResponseCode == 13 || $updatemsisdn->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("updateMSISDNdata",$updatemsisdn);
				$this->setMaster("user.pendings.updatemsisdn.view.php");
			}else{
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();	
		}
	}
		$i = new SubscriberTransactionsController();
?>