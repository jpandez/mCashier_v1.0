<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>

<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() ){
				if($_REQUEST["subscriber"] == '' || $_REQUEST["skey"] == '' || $_REQUEST["value"] == '' || $_REQUEST["fromdate"] == '' || $_REQUEST["todate"] == ''){
					$this->setData("responseMessage",_("Please input all required fields."));
					
				}else{
					if($_REQUEST["transtype"] == 'ALL'){
						$ret1 = $serv->globalSearchMPOS($_REQUEST["subscriber"],$_REQUEST["skey"],strtoupper($_REQUEST["value"]),'HITS_PULL',$_REQUEST["fromdate"],$_REQUEST["todate"]);
						$this->setData("reports1",$ret1);				
					}	
					$ret = $serv->globalSearchMPOS($_REQUEST["subscriber"],$_REQUEST["skey"],strtoupper($_REQUEST["value"]),$_REQUEST["transtype"],$_REQUEST["fromdate"],$_REQUEST["todate"]);
					
					$_SESSION['datatype'] = $_REQUEST['transtype'];
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
				}
				$this->setMaster("subscriber.globalsearch.view.php");
				$this->setData("reports",$ret);
				$this->render();
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
				$this->render();
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>