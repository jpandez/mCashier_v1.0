<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
 class SubscriberController extends ViewController{
  public function __construct(){
   parent::__construct();
   if(isset($_SESSION["currentUser"])){
	$_SESSION["title"] = $_REQUEST["title"];
	$_SESSION["runid"] = $_REQUEST["runid"];
     
    $this->setMaster('user.pendings.dealercommission1sumdetails.iframe.view.php');
    $serv = new SubscriberServices();
    
   }else{
      $this->setMaster('index.master.php');
   }
   $this->render();
  }
 }
 
 $emp = new SubscriberController();
?>