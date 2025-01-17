<?php session_start(); session_regenerate_id(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class IndexController extends ViewController{
		public function __construct(){
			parent::__construct();
			$this->setCSP();
			/*$this->setContent('main','user.subscriber.view.php');*/
			if(isset($_SESSION["currentUser"]) && $this->verifyIP()){
				
				$this->setData("pageTitle","Account Management");
				$this->setData("currentUser",$_SESSION["currentUser"]);
				$this->setMaster('user.master.php');
				/*$this->setContent('main','user.subscriber.view.php');*/
				if ($_SESSION["ISFIRSTLOGON"] == 1){
					if ($_SESSION["USEREXPIRY"] < 1){
						$this->setData("responseData",_("Your account's password has expired. please contact your system administrator"));
						session_destroy();
						$this->setMaster("index.master.php");
					}else{
						$this->setContent('main','user.management.view.php');
						$this->setData("responseMessage",_("Please Change your PASSWORD."));
						header("location: user.management.php?t=" . $_SESSION['pagetoken']);
					}					
				}
				else{
					$this->setContent('main','user.subscriber.view.php');
					header("location: user.subscriber.php?t=" . $_SESSION['pagetoken']);
				}
			}else{
				if(isset($_REQUEST["Method"]) ){
					
					if ($_SESSION['pagetoken']==$_POST['csrf-token']) {
						if (time() >= $_SESSION['token-expire']) {
							$this->setData("responseData","Token expired. Page will refresh in 5 seconds");
							$this->setMaster("index.master.php");
							header("Refresh:5");
						}else{
						// 	$user =strtoupper($_POST['username']);
						// 	$pass = $_POST['password'];
						// //	$pass = $_POST['password'] . "@" . $_SESSION['logintoken'];

							$user = "";
							$pass =  "";
							$logOTP =  "";

							if($_REQUEST["Method"] == 'userLogin'){
							   	$user = strtoupper($_POST['username']);
								$pass =  $_POST['password'];
								$logOTP =  "";

								$_SESSION["otpUser"] = $user;
								$_SESSION["otpPassword"] = $pass;
							}
							
							if($_REQUEST["Method"] == 'userLoginOTP'){
								$user = $_SESSION["otpUser"];
								$pass = $_SESSION["otpPassword"];
								$logOTP = $_POST['pin'];
							}

							$_SESSION['loginip'] = (!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP']: ((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);
							$_SESSION['logintoken'] = "";
							if(!$this->CheckAlpha($user)){
								$this->setData("responseData", "Please Enter valid username.");
								$this->setMaster("index.master.php");
							}else{




								//$sessionid = session_id()  . "@" . $_SERVER['REMOTE_ADDR'];
								$sessionid = session_id()  . "@" . $_SESSION['loginip'];
								$svc  = new SubscriberServices();
								//$user =strtoupper($_REQUEST['username']);
								// $ret = $svc->userLoginOTP($logOTP,$user,$pass, $sessionid, true);
								$ret = $svc->userLogin($user,$pass, $sessionid, true);
								$retMessage = $ret['Message'];
								/* print_r($ret); */
					
								if($ret['ResponseCode'] == 0){
									$_SESSION['lang'] = $_REQUEST['lang'];
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
							
									$roles = $ret['Value']['ROLESCONFIG'];				   
									$_SESSION["token"]=$ret['Token'];
																
									$_SESSION["sysCurrentAmount"] = $nombre_format_francais = number_format($ret['QueryCount'], 0, ',', ' ');;
									
									$_SESSION["currentUser"] = $user;
									$_SESSION["currentPassword"] = $pass;
									$_SESSION["currentUserID"] = $ret['Value']['USERID'];
									$_SESSION["currentUserIP"] = $ret['Value']['ALLOWEDIP'];
									$_SESSION["sessionid"] = $sessionid;
									$_SESSION["sessiontimeout"] = (isset($ret['Value']['SESSIONTIMEOUT'])) ? $ret['Value']['SESSIONTIMEOUT'] : 300;
									$_SESSION["searchrange"] = (isset($ret['Value']['SEARCHRANGE'])) ? $ret['Value']['SEARCHRANGE'] : 120;
									$_SESSION["currentUserLevel"] = (isset($ret['Value']['USERLEVEL'])) ? $ret['Value']['USERLEVEL'] : 'ADMIN';
									$_SESSION["maxALLOC"] = (isset($ret['Value']['MAXALLOCUSER'])) ? $ret['Value']['MAXALLOCUSER'] : '1';
									$_SESSION["LASTLOGIN"] = (isset($ret['Value']['LASTLOGIN'])) ? date_create($ret['Value']['LASTLOGIN']) : '1';
									$_SESSION["ISFIRSTLOGON"] = (isset($ret['Value']['ISFIRSTLOGON'])) ? $ret['Value']['ISFIRSTLOGON'] : '1';
									$_SESSION["USEREXPIRY"] = (isset($ret['Value']['USEREXPIRY'])) ? $ret['Value']['USEREXPIRY'] : '1';
									$_SESSION["NEWPASSWORDEXPIRY"] = (isset($ret['Value']['NEWPASSWORDEXPIRY'])) ? $ret['Value']['NEWPASSWORDEXPIRY'] : '1';
									/*set sessions*/
									foreach($roles as $row){
									
										$key = array_keys($row);
										$module =  str_replace(' ', '_' ,str_replace('-', '_' ,$key[0]));
									 
										$this->addRolesConfig($module,$row[$key[0]]);
									}

									$this->setData("pageTitle","Account Management");
									$this->setData("currentUser",$_SESSION["currentUser"]);
									$this->setMaster('user.master.php');
									
									if($_SESSION["USEREXPIRY"] > 0){
										$this->setContent('main','user.management.view.php');
										$this->setData("responseMessage",_("Password Expired. Please Change your PASSWORD."));
										$retMessage = $retMessage . " : Change password.";
										header("location: user.management.php?t=" . $_SESSION['pagetoken']);
									}
									else if ($_SESSION["ISFIRSTLOGON"] == 1){
										
										$this->setContent('main','user.management.view.php');
										$this->setData("responseMessage",_("Please Change your PASSWORD."));
										$retMessage = $retMessage . " : Change password.";
										header("location: user.management.php?t=" . $_SESSION['pagetoken']);
									}
									else{
										if($ret['Value']['USEREXPIRYDAYS'] > 0){									
											$this->setData("responseMessage",str_replace("xx",$ret['Value']['USEREXPIRYDAYS'],_("Your password will expire in xx day(s)")));
										}
										$this->setContent('main','user.subscriber.view.php');
										header("location: user.subscriber.php?t=" . $_SESSION['pagetoken']);
									}
																								
									/*$svc->addAuditTrail($_SESSION["currentUserID"], $_SESSION["currentUser"], "USERLOGIN", $_SERVER['REMOTE_ADDR'] );*/
											  
									
									/*print_r($_SESSION["token"]);*/
							
								}elseif($ret['ResponseCode'] == 105){
									$this->setData("responseData",$ret['ResponseCode']);
									$this->setData("responseMessage",$ret['Message']=="Please enter OTP"?"":$ret['Message']);
									$this->setMaster("index.master.php");
								}else{
									$this->setData("responseData",$ret['Message']);
									$this->setMaster("index.master.php");
								}
							/* $svc->addAuditTrail($ret['Value']['USERID'], $user, "USERLOGIN : ". $retMessage, $_SERVER['REMOTE_ADDR'] ); */
							}
					
						$_SESSION['logintoken'] = "";
						}
					}else{
						$this->setData("responseData","Invalid page Token. Page will refresh in 5 seconds");
						$this->setMaster("index.master.php");
						header("Refresh:5");
					}
				}else{
					$this->setMaster('index.master.php');
				}
				
			}
			$this->render();

		}
		
	}
	$index = new IndexController();
?>
