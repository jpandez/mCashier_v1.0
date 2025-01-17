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
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_PENDING_REGISTRATIONS')){
				$pendingsubscriber = $serv->subscriberPending();

				if(isset($pendingsubscriber->Token)){
					$_SESSION["token"] = $pendingsubscriber->Token;
					$_SESSION["downloadmsisdn"] = "";
				}

				if($pendingsubscriber->ResponseCode == 13 || $pendingsubscriber->ResponseCode == 14){
					session_destroy();
				}
				
				$this->setData("subscriberPending",$pendingsubscriber);
				$this->setMaster("user.pendings.accounts.view.php");
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