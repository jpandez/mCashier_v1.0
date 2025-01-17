<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			/*pending system info*/
			if($this->getRolesConfig('VIEW_PENDING_SYSTEM_INFO')){
				$pendingasysinfo = $serv->getSystemInfoPndg($_SESSION["currentUser"]);
				if(isset($pendingasysinfo->Token)){
					$_SESSION["token"] = $pendingasysinfo->Token;
				}
				if($pendingasysinfo->ResponseCode == 13 || $pendingasysinfo->ResponseCode == 14){
					session_destroy();
				}
				
				$this->setData("getSystemInfoPndg",$pendingasysinfo);
				$this->setMaster("user.pendings.systeminfo.view.php");
				$this->render();
			}	
		}
	}
		$i = new SubscriberTransactionsController();
?>