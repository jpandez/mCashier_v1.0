<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP()){
				$serv = new SubscriberServices();
				
				$data = $_SESSION["currentSearch"];
				$MID = $data->MerchantID;
				$ret = $serv->getPackagesSummaryMerchantReport($MID);
				$this->setData("getPackagesSummaryReport",$ret);
				
				$this->setMaster('user.subscriber.search.accounttab.view.php');
				$this->setData("searchResult",$_SESSION["currentSearch"]);
			}else{
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
	
	$emp = new SubscriberController();
?>