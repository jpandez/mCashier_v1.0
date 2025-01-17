<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
			
			$this->setMaster("user.subscriber.search.uploadcashier.view.php");		
			$serv = new SubscriberServices();
			$csv_mimes = array('text/csv','text/x-csv','text/plain','application/csv','text/comma-separated-values','application/excel','application/vnd.ms-excel','application/vnd.msexcel','text/anytext','application/octet-stream','application/txt');		
			if(in_array($_FILES['inpCSV']['type'],$csv_mimes)){
				if($_FILES['inpCSV']['error']>0){
					$ret->Message = _("System is busy. Please try again later.");
				}else{
					//print_r($_SESSION['newStore']);
					$file_name = "(" . date('Ymd H-i-s') . ")" . "_".$_FILES['inpCSV']['name'];
					$file = $GLOBALS["ROOT"] . "temp/" . $file_name;
					if(!file_exists($file)){
						move_uploaded_file($_FILES["inpCSV"]["tmp_name"],$file);
						$ret = $serv->uploadCashier($_SESSION['currentUser'], $file, $_SESSION['searchmsisdn'], $_SESSION['batchAccountType'], $_SESSION['newStore']);
						
						$ch = curl_init("http://10.128.194.103/Projects/mCashier_v1.0/temp/upload.php");
						
						$data = array('filename' => $file_name, 'fileupload' => '@'.$file);
						
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
						echo curl_exec($ch);
						
						if($ret->ResponseCode != 0){
							unlink($file);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}							
						}
					}else{
						$ret->Message = _("File is already exists.");
					}
				}
			}
			
			$this->setData("uploadCashier",$ret);
			$this->setData("accountType", $_SESSION['batchAccountType']);	
			$this->setData("newStore", $_SESSION['newStore']);
			$this->setData("currentUser",$_SESSION['currentUser']);
			
			$this->render();			
		}
	}
	
	$emp = new SubscriberController();
?>