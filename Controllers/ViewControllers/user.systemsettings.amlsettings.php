<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			/*System Info*/
			
			/* $ret = $serv->addAuditTrail($_SESSION["currentUserID"], $_SESSION["currentUser"], "VIEW AML SETTINGS", $_SERVER['REMOTE_ADDR'] );
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 14){
				session_destroy();
			} */
			$getAMLByTypeSend = $serv->getAMLByTypeSend();
			$getAMLByTypeReceive = $serv->getAMLByTypeReceive();
			$this->setData("getAMLByTypeSend",$getAMLByTypeSend);
			$this->setData("getAMLByTypeReceive",$getAMLByTypeReceive);


			$getAMLByMSISDNSend = $serv->getAMLByMSISDNSend();				
			$getAMLByMSISDNReceive = $serv->getAMLByMSISDNReceive();				
			$this->setData("getAMLByMSISDNSend",$getAMLByMSISDNSend);
			$this->setData("getAMLByMSISDNReceive",$getAMLByMSISDNReceive);
			$this->setMaster("user.systemsettings.amlsettings.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>