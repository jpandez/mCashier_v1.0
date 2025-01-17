<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('ROLES_CONFIGURATION')){
                    $serv = new SubscriberServices();
					$this->setMaster("user.management.rolesconfiguration.view.php");
					
					if(isset($_REQUEST["Method"])){
						
						switch($_REQUEST["Method"]){
							
                            case "Roles":
                                $_SESSION['userroles'] = $_REQUEST['userlevelroles'];
                                $ret = $serv->applicationRoles($_REQUEST['userlevelroles'], true);
                                $this->setData("roles",$ret);
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
                            break;
                            						
						}
					}
					
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			
			$this->render();
		}
	}
$i = new SubscriberTransactionsController();
?>