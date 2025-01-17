<?php session_start();?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class IndexController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			$_SESSION['lang'] = $_REQUEST['lang'];
			//LANGUAGE
			if(isset($_SESSION['lang'])){
				if($_SESSION['lang'] == 'ar'){
					$lang = "ar_AE";
					putenv("LC_ALL=$lang");
					setlocale(LC_ALL, $lang);
					bindtextdomain("messages", "/var/www/html/Projects/_MobileCash v1.0b/locale");
					bind_textdomain_codeset('messages', 'UTF-8');
					textdomain("messages");
				}
				if($_SESSION['lang'] == 'fr'){
					$lang = "fr_FR";
					putenv("LC_ALL=$lang");
					setlocale(LC_ALL, $lang);
					bindtextdomain("messages", "/var/www/html/Projects/_MobileCash v1.0b/locale");
					bind_textdomain_codeset('messages', 'UTF-8');
					textdomain("messages");
				}
			}
			/* $this->setContent('main','user.subscriber.view.php');
			$this->setMaster('user.master.php');
			$this->render(); */
			
			//header('Location: ' . $_REQUEST['url']);
			header('Location: user.subscriber.php');
		}
		
	}
	$index = new IndexController();
?>