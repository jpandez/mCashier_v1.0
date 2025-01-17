<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			/*pending subsribers*/
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('APPROVE_KYC_PROCESSOR')){
				$processorapprovesubscriber = $serv->subscriberForProcessor();
				if(isset($processorapprovesubscriber->Token)){
					$_SESSION["token"] = $processorapprovesubscriber->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($processorapprovesubscriber->ResponseCode == 13 || $processorapprovesubscriber->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("subscriberForProcessor",$processorapprovesubscriber);
				$this->setMaster("user.pendings.processor.view.php");
				//$this->render();
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();	
		}
	}
		$i = new SubscriberTransactionsController();
?>