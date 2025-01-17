<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('SEARCH_WEB_USER')){
			
				if(isset($_REQUEST["Method"])){
							
					switch($_REQUEST["Method"]){
						case "SearchList":
							if(!empty($_REQUEST["txtSearch"])/* && $this->CheckAlpha($_REQUEST['txtSearch'])*/){							
								$ret = $serv->userSearchList($_REQUEST["txtSearch"]);
								
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
								$this->setData("responseMessage",_("Please input valid character"));
							}
						break;
						case "Search":
							if(!empty($_REQUEST["txtSearch"])/* && $this->CheckAlpha($_REQUEST['txtSearch'])*/){
								$user =strtoupper($_REQUEST['txtSearch']);
								$ret = $serv->userSearch($user,'0');
								
								$this->setData("searchResult",$ret);
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
								$this->setData("responseMessage",_("Please input valid character"));
							}
						break;
						case "ExportUsersListCSV":
							
							$ret = $serv->userSearchList('export');
							
							if(isset($ret)){
								$out = $this->USERSexportCSV($ret);
								header("Content-type: text/x-csv");
								header("Content-Disposition: attachment; filename=users_lists_" .date("YmdHis") . ".csv");
								echo $out;
								die();
								exit;
							}
							
						break;
					}
				}
			
				$this->setMaster("user.management.usersearch.view.php");
				//$this->render();
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
$i = new SubscriberTransactionsController();
?>