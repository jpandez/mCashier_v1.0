<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>

<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
						
			$ret = $serv->getTransactionSummary($_REQUEST["fromdate"],$_REQUEST["todate"]);	
			/*print_r($ret);		*/
			$this->setData("transactionlogs",$ret);
			$this->setMaster("reports.translogs.view.php");
			$this->render();
			
			
		}
	}
		$i = new SubscriberTransactionsController();
?>