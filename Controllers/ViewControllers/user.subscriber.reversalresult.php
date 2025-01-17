<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>

<?php
	class SubscriberTransactionsController extends ViewController{
		public function __construct(){
			parent::__construct();
			$serv = new SubscriberServices();
			
			$response="";
			if($_REQUEST["referenceid"] == ''){
				$response = _("Please input reference id.");
			}else{
				$ret = $serv->ReversalSearch($_REQUEST["referenceid"]);
				if($ret->ResponseCode==0){
					$frmsisdn = $serv->search($ret->Value->FRMSISDN,1);
					$tomsisdn = $serv->search($ret->Value->TOMSISDN,1);
					
					/* if($frmsisdn->AccountInformation->KYC=="FOR APPROVAL"){
						$response= _("Sender KYC does not allowed for reversal");
					}
					if($frmsisdn->AccountInformation->AccountType=="TEMP"){
						$response= _("Sender Account Type does not allowed for reversal");
					}
					$aType=$tomsisdn->AccountInformation->AccountType;
					if($aType=="MERC" || $aType=="BILL"){
						$response= $tomsisdn->AccountInformation->AccountTypeDescription . _(" - Merchant / Biller Recepient Account Type does not allowed for reversal");
					}
					$toNewCurrentStock=$tomsisdn->AccountInformation->CurrentStock-$ret->Value->AMOUNT;
					if($toNewCurrentStock<0){
						$response= _("Recepient does not have enough balance for reversal");
					} */
					
					$this->setData("frmsisdn",$frmsisdn);
					$this->setData("tomsisdn",$tomsisdn);
				}elseif($ret->ResponseCode!=0){
					if($ret->ResponseCode==99){
						$response = $ret->Message . _(" Transaction Type not valid for reversal.");
					}else{
						$response=$ret->Message;
					}
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
				}
			}
			$this->setData("responseMessage",$response);
			
			$this->setMaster("user.subscriber.reversalresult.view.php");
			$this->setData("reversal",$ret);
			
			$this->render();
		}
	}
		$i = new SubscriberTransactionsController();
?>