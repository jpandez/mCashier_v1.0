<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending keycosttype*/
			if($this->getRolesConfig('VIEW_PENDING_KEY_COST_CHARGES')){
								
				$getKeyCostTypePndg = $serv->getKeyCostTypePndg();
				$getKeyCostMSISDNPndg = $serv->getKeyCostMSISDNPndg();
					if(isset($getKeyCostTypePndg->Token)){
					$_SESSION["token"] = $getKeyCostTypePndg->Token;
				}
				if($getKeyCostTypePndg->ResponseCode == 13 || $getKeyCostTypePndg->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getKeyCostMSISDNPndg",$getKeyCostMSISDNPndg);
				$this->setData("getKeyCostTypePndg",$getKeyCostTypePndg);
				$this->setMaster("user.pendings.keycosttypes.view.php");
				$this->render();
			}	

			
		}
	}
		$i = new SubscriberTransactionsController();
?>