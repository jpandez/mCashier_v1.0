<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/SubscriberServices.php"); ?>
<?php
ini_set('memory_limit', '1G'); // or you could use 1G

$GLOBALS["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/Projects/mCashier_v1.0/";
$GLOBALS["CONTROLLER_PATH"] = $GLOBALS["ROOT"] . "Controllers/";
$GLOBALS["MODEL_PATH"] = $GLOBALS["ROOT"] . "Models/";
$GLOBALS["VIEW_PATH"] = $GLOBALS["ROOT"] . "Views/";
$GLOBALS["LIB_PATH"] = $GLOBALS["ROOT"] . "Libraries/";

$GLOBALS["BASE_URL"] = "http://localhost/Projects/mCashier_v1.0/";
//$GLOBALS["BASE_URL"] = "http://localhost//Projects/mCashier_v1.0/";
//$_GUISERVICE["wsdl"] ="http://localhost:9080/GUI?wsdl";
//$_GUISERVICE["wsdl"] ="http://192.168.56.1:9080/GUI?wsdl";
$_GUISERVICE["wsdl"] ="http://69.48.191.13:9001/GUI?wsdl";
$GLOBALS["GUISERVICE"] = $_GUISERVICE;


DEFINE("DEVELOPMENT_PLATFORM", FALSE); //CHANGE TO FALSE ON LIVE ENVIRONMENT
DEFINE('ROOT',dirname(dirname(__FILE__)));

//set application error reporting
function setReporting(){  
    if(DEVELOPMENT_PLATFORM){
        error_reporting(E_ALL);
        ini_set('display_errors','On');       
    }else{
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors','On');
        //ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS. date('dmY@H00') . '.log');
        ini_set('error_log', ROOT.'/temp/logs/'. date('dmY@H00') . '.log');
    }
}

function __autoloadClasses($className){
    if(file_exists( $GLOBALS['LIB_PATH'] .  strtolower($className) . '.class.php')){
        require_once($GLOBALS['LIB_PATH'] .  strtolower($className) . '.class.php');
    }
}

function checkSession(){
	if(isset($_SESSION['sessionid'])){
		$svc  = new SubscriberServices();
		$ret = $svc->checkSession2();
		if($ret->ResponseCode != 0){
			session_destroy();
		}
         // set timeout period in seconds
		$inactive = $_SESSION['sessiontimeout']; //should be configurable
		// check to see if $_SESSION['timeout'] is set
		if(isset($_SESSION['timeout']) ) {
			$session_life = time() - $_SESSION['timeout'];
			if($session_life > $inactive){				
	         	session_destroy();
	         	header("Location:index.php"); 
			}
		}
		$_SESSION['timeout'] = time();
	}
}

//LANGUAGE
if(isset($_SESSION['lang'])){
	if($_SESSION['lang'] == 'ar'){
		$lang = "ar_AE";
		putenv("LC_ALL=$lang");
		setlocale(LC_ALL, $lang);
		bindtextdomain("messages", "/var/www/html/Projects/mCashier_v1.0/locale");
		bind_textdomain_codeset('messages', 'UTF-8');
		textdomain("messages");
	}
	if($_SESSION['lang'] == 'fr'){
		$lang = "fr_FR";
		putenv("LC_ALL=$lang");
		setlocale(LC_ALL, $lang);
		bindtextdomain("messages", "/var/www/html/Projects/mCashier_v1.0/locale");
		bind_textdomain_codeset('messages', 'UTF-8');
		textdomain("messages");
	}
	
}

spl_autoload_register('__autoloadClasses');


setReporting();

if(!isset($_SESSION['timezone']))
{

        $zonelist = array('Kwajalein' => -12.00, 'Pacific/Midway' => -11.00, 'Pacific/Honolulu' => -10.00, 'America/Anchorage' => -9.00, 'America/Los_Angeles' => -8.00, 'America/Denver' => -7.00, 'America/Tegucigalpa' => -6.00, 'America/New_York' => -5.00, 'America/Caracas' => -4.30, 'America/Halifax' => -4.00, 'America/St_Johns' => -3.30, 'America/Argentina/Buenos_Aires' => -3.00, 'America/Sao_Paulo' => -3.00, 'Atlantic/South_Georgia' => -2.00, 'Atlantic/Azores' => -1.00, 'Europe/Dublin' => 0, 'Europe/Belgrade' => 1.00, 'Europe/Minsk' => 2.00, 'Asia/Kuwait' => 3.00, 'Asia/Tehran' => 3.30, 'Asia/Muscat' => 4.00, 'Asia/Yekaterinburg' => 5.00, 'Asia/Kolkata' => 5.30, 'Asia/Katmandu' => 5.45, 'Asia/Dhaka' => 6.00, 'Asia/Rangoon' => 6.30, 'Asia/Krasnoyarsk' => 7.00, 'Asia/Brunei' => 8.00, 'Asia/Seoul' => 9.00, 'Australia/Darwin' => 9.30, 'Australia/Canberra' => 10.00, 'Asia/Magadan' => 11.00, 'Pacific/Fiji' => 12.00, 'Pacific/Tongatapu' => 13.00);
        $index = array_keys($zonelist, 8);
        $_SESSION['timezone'] = $index[0];
}
date_default_timezone_set($_SESSION['timezone']);
if(!isset($_REQUEST["Method"])){
checkSession();
}
?>
