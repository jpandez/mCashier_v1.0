<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			$getBonusByTypePndg = $serv->getBonusByTypePndg();				
			$getBonusByMSISDNPndg = $serv->getBonusByMSISDNPndg();
			if(isset($getBonusByMSISDNPndg->Token)){
				$_SESSION["token"] = $getBonusByMSISDNPndg->Token;
			}
			if($getBonusByMSISDNPndg->ResponseCode == 13 || $getBonusByMSISDNPndg->ResponseCode == 14){
				session_destroy();
			}
			$this->setData("getBonusByTypePndg",$getBonusByTypePndg);
			$this->setData("getBonusByMSISDNPndg",$getBonusByMSISDNPndg);
			$this->setMaster("user.pendings.bonus.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>