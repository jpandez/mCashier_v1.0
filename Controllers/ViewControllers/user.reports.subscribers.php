<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();

				$ret = $serv->getSubscriberCount(true);
				/* $accountsummary = $serv->getAccountSummary(); */
				$_SESSION['accountsummary'] = $accountsummary;
				
				$header = "";
				$data = "";
				$option = "";
				
				if(is_array($ret)){
					$header = $header . "<td>Total</td>";
					$data = $data . "<td>" . ($ret['Value'][0][DEACTIVE]+$ret['Value'][0][ACTIVE]+$ret['Value'][1][ACTIVE]) . "</td>";
					
					$option = "<option value='ALL'>ALL</option>";
					foreach($ret['Value'] as $row){
						$key = array_keys($row);
						$selected = "";
						$header = $header . "<td>" . $key[0] . "</td>";
						$data = $data . "<td>" . $row[$key[0]] . "</td>";
						if(isset($_REQUEST['accounttype'])){
							if($_REQUEST['accounttype'] == $key[0]){ $selected = "selected";}
						}
						$option = $option . "<option value='" . $key[0] . "'". $selected .">" . $key[0] . "</option>";
					}
				}
				
				$this->setData("subsCountheader",$header);
				$this->setData("subsCountdata",$data);
				$this->setData("subsOptionvalue",$option);
				$this->setData("accountsummary",$accountsummary);
			

			if(isset($_REQUEST["Method"])){
				switch($_REQUEST["Method"]){			
					case "SubscriberList":
					
						$ret = $serv->subscriberListSearch($_REQUEST["accounttype"],isset($_REQUEST['perpage'])?$_REQUEST['perpage']:'15',isset($_REQUEST['pagenum'])?$_REQUEST['pagenum']:'1');
						$_SESSION['data'] = $ret;
						$this->setData("subscriberlist",$ret);
						if($ret->ResponseCode !=0){
							if(isset($ret->Token)){
								$_SESSION["token"] = $ret->Token;
							}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
								session_destroy();
							}
					
						}
					break;
					case "ExportSubscriberCSV":
						if($_REQUEST["queryCount"] <= 10000){
							$ret = $serv->subscriberListSearch($_REQUEST["accounttype"],'15','1','all');
							
							if(isset($ret)){
								$out = $this->SubsexportCSV($ret);								
								header("Content-type: text/x-csv");								
								header("Content-Disposition: attachment; filename=subscriber_list_" .date("YmdHis") . ".csv");
								echo $out;
								die();
								exit;
							}
						}else{
							
							$this->setData("responseMessage", _("Export in CSV is more than 10000 records. Please contact system administrator for scheduled reports."));
						}
						
					break;
					
					case "ExportSubscriberEXCEL":
						if($_REQUEST["queryCount"] <= 1500){
							$ret = $serv->subscriberListSearch($_REQUEST["accounttype"],'15','1','all');
							
							if(isset($ret)){								
								$out = $this->SubsexportEXCEL($ret);
								ob_end_clean();
								header("Content-type: application/octet-stream");
								header("Content-Disposition: attachment; filename=subscriber_list_" . date("YmdHis") . ".xls");
								header("Pragma: no-cache");
								header("Expires: 0");
								echo $out;
								die();
								exit;
							}
						}else{
							
							$this->setData("responseMessage", _("Export in EXCEL is more than 1500 records. Please contact system administrator for scheduled reports."));
						}
						
					break;
					
					case "ExportSubscriberPDF":
						if($_REQUEST["queryCount"] <= 1500){
							$ret = $serv->subscriberListSearch($_REQUEST["accounttype"],'15','1','all');
							
							if(isset($ret)){
								$_SESSION['data'] = $ret;
								$_SESSION['header'] = "Subscribers List Report Date : " . date("Y-m-d H:i:s");
								$path = "/tcpdf/examples/exp_subscriber.php";
								$this->setData("responseReport", $path);
							}
						}else{
							
							$this->setData("responseMessage", _("Export in PDF is more than 1500 records. Please contact system administrator for scheduled reports."));
						}
						
					break;
				}
			}
			
			$this->setMaster("user.reports.subscribers.view.php");
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>