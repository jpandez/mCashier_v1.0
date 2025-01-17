<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending messages*/
			if($this->getRolesConfig('VIEW_PENDING_MESSAGES')){
				$pendingmessages = $serv->getMessagesPndg($_SESSION["currentUser"]);
				if(isset($pendingmessages->Token)){
					$_SESSION["token"] = $pendingmessages->Token;
				}
				if($pendingmessages->ResponseCode == 13 || $pendingmessages->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getMessagesPndg",$pendingmessages);
				$this->setMaster("user.pendings.messages.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>