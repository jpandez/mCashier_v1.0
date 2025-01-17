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
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_DASHBOARD')){
				$subscriberDashboard = $serv->subscriberDashboard();
				if(isset($pendingsubscriber->Token)){
					$_SESSION["token"] = $subscriberDashboard->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($subscriberDashboard->ResponseCode == 13 || $subscriberDashboard->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("subscriberDashboard",$subscriberDashboard);
				$this->setMaster("user.pendings.dashboard.view.php");
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