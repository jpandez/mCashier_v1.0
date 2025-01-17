<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php session_start(); ?>

<?php
	class LogoutController extends ViewController{
		public function __construct(){
				$this->setCSP();
				parent::__construct();
				 $svc  = new SubscriberServices();
				
				$svc->addAuditTrail($_SESSION["currentUserID"], $_SESSION["currentUser"], "USERLOGOUT", $_SESSION['loginip'] );
				session_destroy();
				header("Location: index.php");
				//echo("<script>window.location.href='index.php'</script>");
		}
	}
	$i = new LogoutController();

?>