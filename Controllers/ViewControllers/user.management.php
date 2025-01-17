<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php");?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP()){
				$serv = new SubscriberServices();
				$this->setData("currentUser",$_SESSION["currentUser"]);
				$this->setData("pageTitle",_("User Management"));
				$this->setContent('main','user.management.view.php');
				$this->setMaster('user.master.php');
				
				$_SESSION["ISCHANGEPASSWORD"] = 0;
				if(isset($_REQUEST["Method"])){
					$_SESSION["ISCHANGEPASSWORD"] = $_REQUEST["Method"];
				}
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
	
	$emp = new SubscriberController();
?>