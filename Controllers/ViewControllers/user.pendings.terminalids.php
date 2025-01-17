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
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_PENDING_TERMINALID')){
				$pendingTerminalID = $serv->getTerminalIDPending();
				if(isset($pendingTerminalID->Token)){
					$_SESSION["token"] = $pendingTerminalID->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($pendingTerminalID->ResponseCode == 13 || $pendingTerminalID->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("terminalIDPending",$pendingTerminalID);
				$this->setMaster("user.pendings.terminalids.view.php");
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