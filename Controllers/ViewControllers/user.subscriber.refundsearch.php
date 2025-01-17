<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>

<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			$this->setData("responseMessage",$response);
			
			$this->setMaster("user.subscriber.refundsearch.view.php");
			$this->setData("reversal",$ret);
			
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>