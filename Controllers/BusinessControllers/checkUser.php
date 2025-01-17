<?php 

$GLOBALS["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/Projects/mCashier_v1.0/";
$GLOBALS["CONTROLLER_PATH"] = $GLOBALS["ROOT"] . "Controllers/";
$GLOBALS["MODEL_PATH"] = $GLOBALS["ROOT"] . "Models/";
$GLOBALS["VIEW_PATH"] = $GLOBALS["ROOT"] . "Views/";
$GLOBALS["LIB_PATH"] = $GLOBALS["ROOT"] . "Libraries/";
$GLOBALS["BASE_URL"] = "https://tlcmobilemoney.ignorelist.com/Projects/_MobileCash%20v1.0b/";
//$GLOBALS["BASE_URL"] = "http://localhost:8080/Projects/_MobileCash v1.0b/";

$_MAIL["user"] = "test2@webapplicationsdeveloper.net";
$_MAIL["password"]="test1234";
$_MAIL["server"] = "mail.webapplicationsdeveloper.net";
$GLOBALS["MAIL"]=$_MAIL;

$_GUISERVICE["user"] ="test";
$_GUISERVICE["password"]="test"; ?>

<?php require_once("SubscriberServices.php"); ?>

<?php
session_start();

/*if(isset($_SESSION['sessionid'])){
		 $svc  = new SubscriberServices();
         $ret = $svc->checkSession($_SESSION['sessionid'], $_SESSION['currentUser']);
      
         if(!$ret->ResponseCode == 0){
         	$svc->addAuditTrail($_SESSION["currentUserID"], $_SESSION["currentUser"], "USER SESSION HAS BEEN LOGOUT", $_SERVER['REMOTE_ADDR'] );
         	session_destroy();
         	echo "false";
         	exit;
         }
         
         // set timeout period in seconds
		$inactive = $_SESSION['sessiontimeout']; //should be configurable
		// check to see if $_SESSION['timeout'] is set
		if(isset($_SESSION['timeout']) ) {
			$session_life = time() - $_SESSION['timeout'];
			if($session_life > $inactive){
				 $svc->addAuditTrail($_SESSION["currentUserID"], $_SESSION["currentUser"], "USER SESSION HAS BEEN LOGOUT", $_SERVER['REMOTE_ADDR'] );
	         	session_destroy();
				echo "false";				
				exit; 
			}
		}else{
		   $_SESSION['timeout'] = time();
		  }
		
		echo "true";
		//echo "-". $session_life;
		exit;
}else{
	echo "false";
}
*/
$svc  = new SubscriberServices();
$ret = $svc->checkSession2();
if($ret->ResponseCode != 0){
	$_SESSION = array();
	session_destroy();
}
echo $ret;
?>