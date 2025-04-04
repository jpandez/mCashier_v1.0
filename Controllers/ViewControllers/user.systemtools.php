<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP()){
				$this->setData("currentUser",$_SESSION["currentUser"]);
				$this->setData("pageTitle",_("System Tools"));
				$this->setContent('main','user.systemtools.view.php');
				$this->setMaster('user.master.php');
				
				$serv = new SubscriberServices();
				
			}else{
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
	
	$emp = new SubscriberController();
?>