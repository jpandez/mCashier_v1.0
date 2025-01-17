<?php session_start(); 
	  ob_start();
?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE') && $_REQUEST["msisdn"] == $_SESSION["downloadmsisdn"]){ 
				
				if($_REQUEST["smbBoolean"]){
					//$ret = $serv->getIdIMAGESMB($_SESSION["currentUser"], $_REQUEST["msisdn"]);
					if($_REQUEST["ftype"] == "QC"){
						$ret = $serv->getIdIMAGESMB($_SESSION["currentUser"],$_REQUEST["image"],$_REQUEST["appID"]);
					}else{
						$ret = $serv->getIdIMAGEBNK($_SESSION["currentUser"],$_REQUEST["image"],$_REQUEST["appID"]);
					}
					
				} else{
					$ret = $serv->getIdIMAGE($_SESSION["currentUser"], $_REQUEST["appID"],$_REQUEST["image"]);
				}
				
				//$data = file_get_contents('/var/www/html/Projects/uploads/test2.pdf');
				$imagePath = $ret->Value[0]->IMAGE;
				if (!empty($imagePath) && is_string($imagePath)) {
					$data = file_get_contents($imagePath);
				} else {
					$data = null;
				}
				//$base64image = base64_encode($data);

				if($_REQUEST["image"]==1){
					$type= "_A";
				}else if($_REQUEST["image"]==2){
					$type= "_B";
				}else if($_REQUEST["image"]==3){
					$type= "_C";
				}else if($_REQUEST["image"]==4){
					$type= "_D";
				}else if($_REQUEST["image"]==5){
					$type= "_E";
				}else if($_REQUEST["image"]==6){
					$type= "_F";
				}else if($_REQUEST["image"]==7){
					$type= "_G";
				}else if($_REQUEST["image"]==8){
					$type= "_H";
				}else if($_REQUEST["image"]==9){
					$type= "_I";
				}else if($_REQUEST["image"]==10){
					$type= "_J";
				}
				
				ob_end_clean();
				ob_start();
				//$binary = base64_decode($ret->Value[0]->IMAGE);
				$binary = $data;
				$finfo = new finfo(FILEINFO_MIME);
				$mime_type = $finfo->buffer($binary);
				//echo $mime_type;
				switch($mime_type) {
					case "image/jpeg; charset=binary":
						$ext = ".jpg";
						break;
					case "application/pdf; charset=binary":
						$ext = ".pdf";
						break;
					default:
						$ext = ".NOFILEFOUND";
						break;
				}
				
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=ApplicationFile_" . $_REQUEST["msisdn"].$type. $ext);
				//header("Content-Disposition: attachment; filename=ApplicationFile_" .date("YmdHis") . $ext);
				header("Content-Type: application/octet-stream");
				header("Content-Transfer-Encoding: binary");			
				echo $binary;
				
				ob_end_flush();			
				die();
				exit;
				
				$this->setMaster("user.reports.transactionreports.view.php");
				$this->render();
				
			}else{
				echo _("Unauthorized Access!");
			}
		}
	}
		$i = new SubscriberTransactionsController();
?>