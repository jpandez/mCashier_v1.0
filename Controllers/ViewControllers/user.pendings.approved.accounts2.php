<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			/*approved subsribers*/
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_APPROVED_ACCOUNTS')){
				$approvedsubscriber = $serv->subscriberPendingApproved();
				if(isset($pendingsubscriber->Token)){
					$_SESSION["token"] = $approvedsubscriber->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($approvedsubscriber->ResponseCode == 13 || $approvedsubscriber->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("subscriberPending",$approvedsubscriber);
				$this->setMaster("user.pendings.approved.accounts2.view.php");
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