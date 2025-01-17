<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('VIEW_MESSAGES_CONFIGURED')){
				$serv = new SubscriberServices();
				
				$getMessages = $serv->getMessages();

				if(isset($getMessages->Token)){
					$_SESSION["token"] = $getMessages->Token;
				}
				if($getMessages->ResponseCode == 13 || $getMessages->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getMessages",$getMessages);
				$this->setMaster("user.systemsettings.messages.view.php");
				$this->render();
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
$i = new SubscriberTransactionsController();
?>