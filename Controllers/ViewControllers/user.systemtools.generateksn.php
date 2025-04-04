<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('GENERATE_KSN')){
					
				$this->setMaster("user.systemtools.generateksn.view.php");
				
			}else{
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>