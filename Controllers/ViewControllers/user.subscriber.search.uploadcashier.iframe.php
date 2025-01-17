<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
 class SubscriberController extends ViewController{
  public function __construct(){
   parent::__construct();
   if(isset($_SESSION["currentUser"])){
     
   	if(isset($_REQUEST["AccountType"])){
   		$_SESSION["batchAccountType"] = $_REQUEST["AccountType"];
   	}
   	
   	if(isset($_REQUEST["NewStore"])){
   		$_SESSION["newStore"] = $_REQUEST["NewStore"];
   	}
   	
    $this->setMaster('user.subscriber.search.uploadcashier.iframe.view.php');
    $serv = new SubscriberServices();
    
   }else{
      $this->setMaster('index.master.php');
   }
   $this->render();
  }
 }
 
 
 $emp = new SubscriberController();
?>