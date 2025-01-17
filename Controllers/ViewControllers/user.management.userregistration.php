<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('CREATE_WEB_USER')){
			
				$serv = new SubscriberServices();
				$this->setMaster("user.management.userregistration.view.php");
					
				if(isset($_REQUEST["Method"])){
					
					switch($_REQUEST["Method"]){
													
						case "RegisterUser":
							
							$validation = true;
							$resMessage = "";
							if($_REQUEST["userlevel"] == 'SELECTUSERLEVEL'){
								$validation = false;
								$resMessage = _("Please select User Level.");
							}
							if(!$this->CheckAlpha($_REQUEST['userlevel'])){
								$validation = false;
								$resMessage = _("Invalid User Level format.");
							}
							if(!$this->CheckAlpha($_REQUEST['status'])){
								$validation = false;
								$resMessage = _("Invalid Status format.");
							}
							if(!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)){
								$validation = false;
								$resMessage = _("Invalid Email format.");
							}
							if(!$this->CheckAlpha($_REQUEST['username'])){
								$validation = false;
								$resMessage = _("Invalid Username format.");
							}
							if(!$this->CheckAlpha($_REQUEST['firstname']) || !$this->CheckAlpha($_REQUEST['lastname'])){
								$validation = false;
								$resMessage = _("Invalid Firstname/Lastname format.");
							}
							if($_REQUEST['department'] != ''){
								if(!$this->CheckAlpha($_REQUEST['department'])){
									$validation = false;
									$resMessage = _("Invalid department format.");
								}
							}
							
							if($_REQUEST["username"] == '' || $_REQUEST["userlevel"] == ''|| $_REQUEST["firstname"] == ''|| $_REQUEST["lastname"] == ''|| $_REQUEST["msisdn"] == ''|| $_REQUEST["email"] == ''){
								$validation = false;
								$resMessage = _("Please input all required fields.");
							}
							
							if($validation){
								$userReg =strtoupper($_REQUEST['username']);
								$ret = $serv->userRegistration($userReg, $_REQUEST["firstname"], $_REQUEST["lastname"], $_REQUEST["department"], $_REQUEST["userlevel"], $_REQUEST["status"], $_SESSION["currentUser"], $_REQUEST["email"], $_REQUEST["msisdn"]);                
								
								if($ret->ResponseCode !=0){
									if(isset($ret->Token)){
										$_SESSION["token"] = $ret->Token;
									}
									if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
										session_destroy();
									}
									
									$this->setData("responseMessage",$ret->Message);
								}else{
									$ret->Message = $userReg . _(" has been successfully registered.");
									$this->setData("responseMessage",$ret->Message);
								}
								$this->setData("response",$ret->ResponseCode);
							}else{
								$this->setData("responseMessage",$resMessage);
								$this->setData("response","999");
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
$i = new SubscriberTransactionsController();
?>