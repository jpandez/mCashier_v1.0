<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();	
			/*ServerConfig*/
			if($this->getRolesConfig('VIEW_SYSTEM_INFO_CONFIGURED')){
				$getServerConfig = $serv->getServerConfig();
				if($getServerConfig->ResponseCode == 13 || $getServerConfig->ResponseCode == 14){
					session_destroy();
				}
				$this->setData("getServerConfig",$getServerConfig);
				$this->setMaster("user.systemsettings.serverconfig.view.php");
				$this->render();
			}			
		}
	}
		$i = new SubscriberTransactionsController();
?>