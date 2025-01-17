<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
 class SubscriberController extends ViewController{
  public function __construct(){
   parent::__construct();
   if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('TRANSACTION_HISTORY')){
     
    $this->setMaster('user.reports.mposrevenuereport.iframe.view.php');
    $serv = new SubscriberServices();
    
   }else{
      //$this->setMaster('index.master.php');
	  $this->setMaster('user.redirect.iframe.view.php');
   }
   $this->render();
  }
 }
 
 $emp = new SubscriberController();
?>