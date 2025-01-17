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
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_PENDING_SENT_BACK_REGISTRATIONS')){
				$sendbackdata = $serv->getSentBackRequest();
				if(isset($sendbackdata->Token)){
					$_SESSION["token"] = $sendbackdata->Token;
					$_SESSION["downloadmsisdn"] = "";
				}
				if($sendbackdata->ResponseCode == 13 || $sendbackdata->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("sendbackddata",$sendbackdata);
				$this->setMaster("user.pendings.sendback.view.php");
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