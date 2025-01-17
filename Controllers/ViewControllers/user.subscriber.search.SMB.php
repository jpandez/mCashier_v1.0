<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
						
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() ){
				
				$this->setMaster('user.subscriber.search.SMB.view.php');
				$serv = new SubscriberServices();
				if(isset($_REQUEST["Method"])){
					
					switch($_REQUEST["Method"]){
						
						case "SearchList":
							if((!empty($_REQUEST["txtSearch"]) && $_REQUEST['rdoSearchOption']) &&
								(!empty($_REQUEST["rdoSearchOption"]) && $_REQUEST['rdoSearchOption'])
								){


								$searchValue = $_REQUEST["txtSearch"];

								$ret = $serv->searchList(trim($searchValue), $_REQUEST["rdoSearchOption"]);
								
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
						
						case "searchListSubs":
							if(!empty($_REQUEST["txtSearch"]) && $this->CheckAlpha($_REQUEST['txtSearch'])){							
								$ret = $serv->searchListSubs($_REQUEST["txtSearch"]);
								
								$this->setData("searchListSubs",$ret);
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
						
							if(!empty($_REQUEST["txtSearch"]) && $this->CheckAlpha($_REQUEST['txtSearch'])){
								$ret = $serv->searchsmb(strtoupper($_REQUEST["txtSearch"]),$_REQUEST["rdoSearchOption"]);
								
								if($ret->ResponseCode == 0 ){
									$_SESSION['AccountID'] =  $ret->AccountInformation->AccountID;
								
									$_SESSION['searchmsisdn'] = $ret->AccountInformation->MobileNumber;
									$_SESSION['terminalid'] = $ret->AccountInformation->terminalid;
									$_SESSION['merchantid'] = $ret->AccountInformation->merchantid;
									$_SESSION['searchalias'] =  $ret->AccountInformation->Alias;
									$_SESSION['searchcurrentstock'] =  $ret->AccountInformation->CurrentStock;
									$_SESSION['searchname'] =  $ret->AccountInformation->PersonalInformation->FirstName . ' ' . $ret->AccountInformation->PersonalInformation->LastName;
								}
								
								$_SESSION["currentSearch"] = "";
								$_SESSION["batchAccountType"] = "";
								$_SESSION['imageB2W'] = "";
								$_SESSION['imageStore'] = "";
								$_SESSION["currentSearch"] = $ret;
								$_SESSION["downloadmsisdn"] = $ret->AccountInformation->MobileNumber;
								
								$_SESSION["EditAccount"] = false;
								if($this->getRolesConfig('EDIT_ACCOUNT') == true){
									$editAccount = "EDIT_" . $ret->AccountInformation->AccountType;
									
									if($this->getRolesConfig($editAccount) == true){
										//print_r(strtoupper($ret->AccountInformation->KYC));
										$_SESSION['EditAccount'] = true;
									}else{								
										switch($ret->AccountInformation->AccountType){										
											case "MERC":
											case "BILL":
												if($this->getRolesConfig('EDIT_MERC_/_BILLER') == true){$_SESSION['EditAccount'] = true;}
											break;										
										}
									}
								}
								
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
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
	
	$emp = new SubscriberController();
?>