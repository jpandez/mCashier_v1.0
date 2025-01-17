<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			/*pending allocations*/
			if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS')){
				$getAllocationB2WPndg = $serv->getAllocationB2WPndg($_SESSION["currentUser"], "0");
				if(isset($getAllocationB2WPndg->Token)){
				$_SESSION["token"] = $getAllocationB2WPndg->Token;
				}
				if($getAllocationB2WPndg->ResponseCode == 13 || $getAllocationB2WPndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getAllocationB2WPndg",$getAllocationB2WPndg);
			}
			if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS_BANK_APPROVAL')){
				$getBankPndg = $serv->getAllocationB2WPndg($_SESSION["currentUser"], "-1");
				if(isset($getBankPndg->Token)){
				$_SESSION["token"] = $getBankPndg->Token;
				}
				if($getBankPndg->ResponseCode == 13 || $getBankPndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getBankPndg",$getBankPndg);
			}
			
			$this->setMaster("user.pendings.b2wallocations.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>