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
			if($this->getRolesConfig('VIEW_PENDING_ALLOCATIONS')){
				$pendingallocation = $serv->getAllocationPndg($_SESSION["currentUser"]);
				if(isset($pendingallocation->Token)){
					$_SESSION["token"] = $pendingallocation->Token;
				}
				if($pendingallocation->ResponseCode == 13 || $pendingallocation->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getAllocationPndg",$pendingallocation);
				$this->setMaster("user.pendings.evdallocations.view.php");
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>