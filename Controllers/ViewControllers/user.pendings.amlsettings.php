<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			/*pending aml*/
			if($this->getRolesConfig('VIEW_PENDING_AML_SETTINGS')){
								
				$getAmlTypePndg = $serv->getAmlTypePndg();
				$getAmlMSISDNPndg = $serv->getAmlMSISDNPndg();
				
				if(isset($getAmlMSISDNPndg->Token)){
					$_SESSION["token"] = $getAmlMSISDNPndg->Token;
				}
				if($getAmlMSISDNPndg->ResponseCode == 13 || $getAmlMSISDNPndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getAmlTypePndg",$getAmlTypePndg);
				$this->setData("getAmlMSISDNPndg",$getAmlMSISDNPndg);
				$this->setMaster("user.pendings.amlsettings.view.php");
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>