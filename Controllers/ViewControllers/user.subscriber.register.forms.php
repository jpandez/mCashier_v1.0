<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>

<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('REGISTER_ACCOUNT')){
				$_SESSION['batchAccountType'] = "";
				$this->setMaster("user.subscriber.register.forms.view.php");
				$serv = new SubscriberServices();
				
			}else{
				$this->setMaster('index.master.php');
			}
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>