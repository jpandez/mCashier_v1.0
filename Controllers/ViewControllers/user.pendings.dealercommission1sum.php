<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			$serv = new SubscriberServices();	
			$ret = $serv->getDlerCommissionsFilesSummary($_REQUEST["runid"]);
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			$this->setMaster("user.pendings.dealercommission1sum.view.php");
			$this->setData("reports",$ret);
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>