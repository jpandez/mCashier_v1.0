<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			$ret = $serv->mPosTBLNBECONFIG();				
			$this->setData("mPosTBLNBECONFIG",$ret);
			if($ret->ResponseCode !=0){
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				
				$this->setData("responseMessage",$ret->Message);
			}
			
			$this->setMaster("user.systemsettings.mposconfig.view.php");
			$this->render();
		}
	}
$i = new SubscriberTransactionsController();
?>