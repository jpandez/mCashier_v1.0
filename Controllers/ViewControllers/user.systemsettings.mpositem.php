<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			if(isset($_REQUEST["Method"])){
						
				switch($_REQUEST["Method"]){
					case "SearchList":
													
						$ret = $serv->mPosItemList();
						
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
						
					break;
					case "Search":
						if(!empty($_REQUEST["txtSearch"])){
							$user =strtoupper($_REQUEST['txtSearch']);
							$ret = $serv->mPosItemSearch($user);
							
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
				}
			}else{
				$ret = $serv->mPosItemList();
				
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
			}
			
			$this->setMaster("user.systemsettings.mpositem.view.php");
			$this->render();
		}
	}
$i = new SubscriberTransactionsController();
?>