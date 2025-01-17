<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending reversal*/
			if($this->getRolesConfig('APPROVE_RFNDVOID') || $this->getRolesConfig('REJECT_RFNDVOID')){
				$reversal = $serv->getRefundVoidPndg($_SESSION["currentUser"]);
				if(isset($reversal->Token)){
					$_SESSION["token"] = $reversal->Token;
				}
				if($reversal->ResponseCode == 13 || $reversal->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("reversal",$reversal);
				$this->setMaster("user.pendings.rfndvoid.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>