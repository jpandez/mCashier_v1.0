<?php 

$GLOBALS["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/Projects/mCashier_v1.0/";
$GLOBALS["CONTROLLER_PATH"] = $GLOBALS["ROOT"] . "Controllers/";
$GLOBALS["MODEL_PATH"] = $GLOBALS["ROOT"] . "Models/";
$GLOBALS["VIEW_PATH"] = $GLOBALS["ROOT"] . "Views/";
$GLOBALS["LIB_PATH"] = $GLOBALS["ROOT"] . "Libraries/";
$GLOBALS["BASE_URL"] = "https://tlcmobilemoney.ignorelist.com/Projects/_MobileCash%20v1.0b/";
//$GLOBALS["BASE_URL"] = "http://localhost:8080/Projects/_MobileCash v1.0b/";
include $GLOBALS["CONTROLLER_PATH"]."/private_data/CWT5bq4MmtAmTaHbvr3uHp.php";
 require_once("SubscriberServices.php");
session_start();
$svc  = new SubscriberServices();
$ret = $svc->checkSession2();
if($ret->ResponseCode != 0){
	$_SESSION = array();
	session_destroy();
}
	echo $ret;
?>