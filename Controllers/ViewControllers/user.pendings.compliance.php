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
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_FOR_COMPLIANCE_ACCOUNTS')){
				$compliancesubscriber = $serv->subscriberCompliance();
				if(isset($compliancesubscriber->Token)){
					$_SESSION["token"] = $compliancesubscriber->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($compliancesubscriber->ResponseCode == 13 || $compliancesubscriber->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("subscriberPendingCompliance",$compliancesubscriber);
				$this->setMaster("user.pendings.compliance.view.php");
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