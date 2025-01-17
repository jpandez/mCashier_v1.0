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
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('APPROVE_KYC_SHARAFDG')){
				$sharafdgapprovesubscriber = $serv->subscriberForSharafdg();
				if(isset($sharafdgapprovesubscriber->Token)){
					$_SESSION["token"] = $sharafdgapprovesubscriber->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($sharafdgapprovesubscriber->ResponseCode == 13 || $sharafdgapprovesubscriber->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("subscriberForSharafDG",$sharafdgapprovesubscriber);
				$this->setMaster("user.pendings.sharafdg.view.php");
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