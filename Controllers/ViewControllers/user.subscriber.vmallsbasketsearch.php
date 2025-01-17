<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP()){
				$serv = new SubscriberServices();
				
				$this->setMaster('user.subscriber.vmallsbasketsearch.view.php');
				if(isset($_REQUEST["Method"])){
					switch($_REQUEST["Method"]){
						
						case "SearchTransList":
							//print_r($_REQUEST["TransHdatefrom"]);
							//para sa msisdn at transaction palang to wala pa yung sa vmid at all
							//refer to this part
							/*if(!empty($_REQUEST["txtSearch"]) && $this->CheckAlpha($_REQUEST['txtSearch']) && $_REQUEST["TransHdatefrom"] != '' && $_REQUEST["TransHdateto"] != ''){
								$datediff = $this->checkDateDiff($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
								//print_r($datediff);
								if($_SESSION['searchrange'] > $datediff){
									$ret = $serv->searchVmallsList($_REQUEST["txtSearch"], $_REQUEST["type"], $_REQUEST["TransHdatefrom"], $_REQUEST["TransHdateto"]);
									//var_dump($ret);
									$this->setData("searchListResult",$ret);
									if($ret->ResponseCode !=0){
										if(isset($ret->Token)){
											$_SESSION["token"] = $ret->Token;
										}
										if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
											session_destroy();
										}
										$this->setData("responseMessage",$ret->Message);
									}
								}else{
									$ret = new ServiceResponse();
									$ret->ResponseCode = 99;
									$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									$this->setData("transactionhistorydata",$ret);
								}
							}else{
								$this->setData("responseMessage",_("Please input valid character"));
							}*/
							//for all selection
							if($_POST['type']=="ALL"){
								if (empty($_REQUEST["txtSearch"]) && $_REQUEST["TransHdatefrom"] != '' && $_REQUEST["TransHdateto"] != ''){
									$datediff = $this->checkDateDiff($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
									if($_SESSION['searchrange'] > $datediff){
									//$this->setData("responseMessage",$datediff);	
									$ret = $serv->searchVmallsList($_REQUEST["txtSearch"], $_REQUEST["type"], $_REQUEST["TransHdatefrom"], $_REQUEST["TransHdateto"]);
									//var_dump($ret);
									$this->setData("searchListResult",$ret);
									if($ret->ResponseCode !=0){
										if(isset($ret->Token)){
											$_SESSION["token"] = $ret->Token;
										}
										if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
											session_destroy();
										}
										$this->setData("responseMessage",$ret->Message);
									}
									} else{
										//$this->setData("responseMessage",$datediff."Lampas na");
										//$this->setData("transactionhistorydata",$ret->Message); 
										$ret = new ServiceResponse();
										$ret->ResponseCode = 99;
										$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
										$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
										//$this->setData("transactionhistorydata",$ret->Message);
										$this->setData("responseMessage",$ret->Message); 
									}
								//$this->setData("responseMessage",_($_POST['type']));
								}else{
									$this->setData("responseMessage",_("Please input valid character"));
								}
							}
							//for msisdn/basketid selection
							else if(($_POST['type']=="MSISDN")||($_POST['type']=="BASKETID")){
								if(!empty($_REQUEST["txtSearch"]) && $this->CheckAlpha($_REQUEST['txtSearch']) && $_REQUEST["TransHdatefrom"] != '' && $_REQUEST["TransHdateto"] != ''){
								$datediff = $this->checkDateDiff($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
								//print_r($datediff);
								if($_SESSION['searchrange'] > $datediff){
									$ret = $serv->searchVmallsList($_REQUEST["txtSearch"], $_REQUEST["type"], $_REQUEST["TransHdatefrom"], $_REQUEST["TransHdateto"]);
									//var_dump($ret);
									$this->setData("searchListResult",$ret);
									if($ret->ResponseCode !=0){
										if(isset($ret->Token)){
											$_SESSION["token"] = $ret->Token;
										}
										if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
											session_destroy();
										}
										$this->setData("responseMessage",$ret->Message);
									}
								}else{
									$ret = new ServiceResponse();
									$ret->ResponseCode = 99;
									$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									//$this->setData("transactionhistorydata",$ret);
									$this->setData("responseMessage",$ret->Message); 
								}
							}else{
								$this->setData("responseMessage",_("Please input valid character"));
							}
							}
							//for vmid selection
							else{
								//$this->setData("responseMessage",_("VMID"));
								if(!empty($_REQUEST["txtSearch"]) && $this->CheckAlpha($_REQUEST['txtSearch']) && $_REQUEST["TransHdatefrom"] != '' && $_REQUEST["TransHdateto"] != ''){
								$datediff = $this->checkDateDiff($_REQUEST["TransHdatefrom"],$_REQUEST["TransHdateto"]);
								//print_r($datediff);
								if($_SESSION['searchrange'] > $datediff){
									$ret = $serv->searchVmallsList($_REQUEST["txtSearch"], $_REQUEST["type"], $_REQUEST["TransHdatefrom"], $_REQUEST["TransHdateto"]);
									//var_dump($ret);
									$this->setData("searchListResult",$ret);
									if($ret->ResponseCode !=0){
										if(isset($ret->Token)){
											$_SESSION["token"] = $ret->Token;
										}
										if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
											session_destroy();
										}
										$this->setData("responseMessage",$ret->Message);
									}
								}else{
									$ret = new ServiceResponse();
									$ret->ResponseCode = 99;
									$ret->Message = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									$ret->Value = _("Invalid Date Range your allowed date range is within : ") .$_SESSION['searchrange'] . _(" Days") ;
									//$this->setData("transactionhistorydata",$ret);
									$this->setData("responseMessage",$ret->Message); 
								}
							}else{
								$this->setData("responseMessage",_("Please input valid character"));
							}
							}
							
						break;
						
						
						case "Search":
							//print_r("search");
							if(!empty($_REQUEST["txtSearch"]) && $this->CheckAlpha($_REQUEST['txtSearch'])){
								$ret = $serv->vmallsBasketDetails(strtoupper($_REQUEST["txtSearch"]));
								
								$this->setData("searchResult",$ret);
								
								if($ret->ResponseCode !=0){
									if(isset($ret->Token)){
										$_SESSION["token"] = $ret->Token;
									}
									if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
										session_destroy();
									}
									
									$this->setData("responseMessage", $ret->Message);
								}
							}else{
								$this->setData("responseMessage",_("Please input valid characters"));
							}
						break;
						
					}
				}			
				//$this->render();
			}else{
				print_r("else");
				//$this->setMaster('index.master.php');
				//$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
	
	$emp = new SubscriberController();
?>