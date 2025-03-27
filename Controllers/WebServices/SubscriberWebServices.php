<?php session_start();?>
<?php require_once("services.config.properties.php"); ?>
<?php require_once("dataValidation.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"]."BusinessControllers/SubscriberServices.php");?>
<?php require_once($GLOBALS["CONTROLLER_PATH"]."BusinessControllers/ServiceResponse.php"); ?>
<?php require_once($GLOBALS["LIB_PATH"]."/Wrappers/nusoap.php"); ?>
<?php require_once($GLOBALS["LIB_PATH"] . "Utils/utils.Common.php"); ?>
<?php

$serv = new SubscriberServices();
$dataV = new dataValidation();
//if(isset($_SESSION["currentUser"])){
$cont = false;
if($_REQUEST["Method"] == 'approveSMBKYCProcessorCashier'){ $cont = true; }
if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $_SESSION['loginip']==((!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP']: ((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'])) || $cont == true){
	
	if(isset($_REQUEST["Method"])){
		$ret = new stdClass();  
		//edited by pat 28112019
		if($_REQUEST["FToken"] != $_SESSION['pagetoken']){
				echo _("Token not valid. Please refresh the page.\n FToken= ".$_REQUEST["FToken"]." \n page= ".$_SESSION['pagetoken']);
				exit();
		}
		//edited by pat 28112019
		$_SESSION['timeout'] = time();

		switch($_REQUEST["Method"]){
			
			
			case "pendingAccountView":
			$ret = $serv->search(strtoupper($_REQUEST["txtSearch"]),$_REQUEST["rdoSearchOption"]);
			
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
				$_SESSION["downloadmsisdn"] = $ret->AccountInformation->MobileNumber;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}else{
				$_SESSION["EditAccount"] = false;
				$_SESSION["ApproveAccount"] = false;
				if($_SESSION['roles']['EDIT_ACCOUNT']=='YES'){
					$editAccount = "EDIT_" . $ret->AccountInformation->AccountType;
					if($_SESSION['roles']["APPROVE_" . $ret->AccountInformation->AccountType]=='YES'){
						$_SESSION['ApproveAccount'] = true;
					}else{
						switch($ret->AccountInformation->AccountType){
							case "MERC":
							case "BILL":
							if($_SESSION['roles']['APPROVE_MERC_/_BILLER']=='YES'){$_SESSION['ApproveAccount'] = true;}
							break;								
						}
					}
					
					if($_SESSION['roles'][$editAccount]=='YES'){
						$_SESSION['EditAccount'] = true;
							//$_SESSION['ApproveAccount'] = true;
					}else{
						switch($ret->AccountInformation->AccountType){
							case "MERC":
							case "BILL":
							if($_SESSION['roles']['EDIT_MERC_/_BILLER']=='YES'){$_SESSION['EditAccount'] = true;}
									//if($_SESSION['roles']['APPROVE_MERC_/_BILLER']=='YES'){$_SESSION['ApproveAccount'] = true;}
							break;								
						}
					}	
				}
			}

			$access = array($_SESSION['EditAccount'], $_SESSION['ApproveAccount']);
			$arr = array("Result"=>$ret, "Access"=>$access);
			echo json_encode($arr);
			exit;
			break;
			
			case "pendingSMBAccountView":
			$ret = $serv->searchSMB(strtoupper($_REQUEST["txtSearch"]),$_REQUEST["rdoSearchOption"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
					//$_SESSION["downloadmsisdn"] = $ret->AccountInformation->AccountID;
				$_SESSION["downloadmsisdn"] = $ret->AccountInformation->MobileNumber;

			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}else{
				$_SESSION["EditAccount"] = false;
				$_SESSION["ApproveAccount"] = false;
				if($_SESSION['roles']['EDIT_ACCOUNT']=='YES'){
					$editAccount = "EDIT_" . $ret->AccountInformation->AccountType;
					if($_SESSION['roles']["APPROVE_" . $ret->AccountInformation->AccountType]=='YES'){
						$_SESSION['ApproveAccount'] = true;
					}else{
						switch($ret->AccountInformation->AccountType){
							case "MERC":
							case "BILL":
							if($_SESSION['roles']['APPROVE_MERC_/_BILLER']=='YES'){$_SESSION['ApproveAccount'] = true;}
							break;								
						}
					}
					
					if($_SESSION['roles'][$editAccount]=='YES'){
						$_SESSION['EditAccount'] = true;
							//$_SESSION['ApproveAccount'] = true;
					}else{
						switch($ret->AccountInformation->AccountType){
							case "MERC":
							case "BILL":
							if($_SESSION['roles']['EDIT_MERC_/_BILLER']=='YES'){$_SESSION['EditAccount'] = true;}
									//if($_SESSION['roles']['APPROVE_MERC_/_BILLER']=='YES'){$_SESSION['ApproveAccount'] = true;}
							break;								
						}
					}	
				}
			}
			
			
			$access = array($_SESSION['EditAccount'], $_SESSION['ApproveAccount']);
			$arr = array("Result"=>$ret, "Access"=>$access);
			echo json_encode($arr);
			exit;
			break;
			
			case "pendingSMBProcessorView":
				//$ret = $serv->searchSMBprocessor(strtoupper($_REQUEST["txtSearch"]),$_REQUEST["rdoSearchOption"]);
			$ret = $serv->searchSMBprocessor(strtoupper($_REQUEST["txtSearch"]),$_REQUEST["rdoSearchOption"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
					//$_SESSION["downloadmsisdn"] = $ret->AccountInformation->AccountID;
				$_SESSION["downloadmsisdn"] = $ret->AccountInformation->MobileNumber;

			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}else{
				$_SESSION["EditAccount"] = false;
				$_SESSION["ApproveAccount"] = false;
				if($_SESSION['roles']['EDIT_ACCOUNT']=='YES'){
					$editAccount = "EDIT_" . $ret->AccountInformation->AccountType;
					if($_SESSION['roles']["APPROVE_" . $ret->AccountInformation->AccountType]=='YES'){
						$_SESSION['ApproveAccount'] = true;
					}else{
						switch($ret->AccountInformation->AccountType){
							case "MERC":
							case "BILL":
							if($_SESSION['roles']['APPROVE_MERC_/_BILLER']=='YES'){$_SESSION['ApproveAccount'] = true;}
							break;								
						}
					}
					
					if($_SESSION['roles'][$editAccount]=='YES'){
						$_SESSION['EditAccount'] = true;
							//$_SESSION['ApproveAccount'] = true;
					}else{
						switch($ret->AccountInformation->AccountType){
							case "MERC":
							case "BILL":
							if($_SESSION['roles']['EDIT_MERC_/_BILLER']=='YES'){$_SESSION['EditAccount'] = true;}
									//if($_SESSION['roles']['APPROVE_MERC_/_BILLER']=='YES'){$_SESSION['ApproveAccount'] = true;}
							break;								
						}
					}	
				}
			}
			
			
			$access = array($_SESSION['EditAccount'], $_SESSION['ApproveAccount']);
			$arr = array("Result"=>$ret, "Access"=>$access);
			echo json_encode($arr);
			exit;
			break;
			
			case "activate":
			
			if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
				$ret = $serv->activate($_REQUEST["MSISDN"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					$_SESSION['currentSearch']->AccountInformation->Status="ACTIVE";
					echo $_REQUEST["MSISDN"] . _(" has been successfully activated.");
				}else{
					echo $ret->Message;
				}
				
			}else{
				echo _("Not Valid for Activation!");
			}
			
			break;
			case "deactivate":
			
			if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
				$ret = $serv->deactivate($_REQUEST["MSISDN"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					$_SESSION['currentSearch']->AccountInformation->Status="DEACTIVE";
					echo $_REQUEST["MSISDN"] . _(" has been successfully deactivated.");
				}else{
					echo $ret->Message;
				}
				
			}else{
				echo _("Not Valid for Deactivation!");
			}
			
			break;
			case "lock":
			
			if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
				if($_REQUEST["LockDescription"] != ''){
					$ret = $serv->lock($_REQUEST["MSISDN"],$_REQUEST["LockDescription"]);
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					if($ret->ResponseCode == 0){
						$_SESSION['currentSearch']->AccountInformation->Locked="true";
						echo $_REQUEST["MSISDN"] . _(" has been successfully locked.");
					}else{
						echo $ret->Message;
					}
				}else{
					echo _("Please input lock description");
				}
				
			}else{
				echo _("Not Valid for lock!");
			}
			
			break;
			case "unlock":
			
			if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
				$ret = $serv->unlock($_REQUEST["MSISDN"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					$_SESSION['currentSearch']->AccountInformation->Locked="false";
					echo $_REQUEST["MSISDN"] . _(" has been successfully unlocked.");
				}else{
					echo $ret->Message;
				}
				
			}else{
				echo _("Not Valid for unlock!");
			}
			
			break;
			case "resetPassword":
			
			if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
				$ret = $serv->resetPassword($_REQUEST["MSISDN"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo _("Successfully Reset Password");
				}else{
					echo $ret->Message;
				}
				
			}else{
				echo _("Not Valid for reset password!");
			}
			
			break;
			
			case "deleteMobileIMSI":
			
			$validation = true;
			$resMessage = "";
			
			if($_REQUEST["MSISDN"] == ''){
				$validation = false;
				$resMessage = _("Please input all required fields.");
			}
			
			if($validation){
				
				$ret = $serv->deleteMobileIMSI($_REQUEST["MSISDN"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo _("You have successfully deleted mobile IMSI");
				}else if($ret->ResponseCode == 2 || $ret->ResponseCode == 3){
					echo _("IMSI does not exist");
				}else{
					echo $ret->Message;
				}

			}else{
				echo $resMessage;
			}
			break;
			//DELETETERMINALID
			case "deleteTerminalID":
			
			$validation = true;
			$resMessage = "";
			
			if($_REQUEST["MSISDN"] == ''){
				$validation = false;
				$resMessage = _("Please input all required fields.");
			}
			
			if($validation){
				
				$ret = $serv->deleteTerminalID($_REQUEST["MSISDN"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo _("Deletion of terminal id is now subject for approval.");
				}else if($ret->ResponseCode == 2 || $ret->ResponseCode == 3){
					echo _("Unable to request deletion of terminal id");
				}else{
					echo $ret->Message;
				}
				
			}else{
				echo $resMessage;
			}
			break;
			//DELETETERMINALID END
			case "updateAccountType":
			
			$validation = true;
			$resMessage = "";
			
			if($_REQUEST["MSISDN"] == '' || $_REQUEST["TYPE"] == ''){
				$validation = false;
				$resMessage = _("Please input all required fields.");
			}
			
			if($validation){
				
				$ret = $serv->updateAccountType($_REQUEST["MSISDN"], $_REQUEST["TYPE"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo _("You have successfully saved your account type");
				}else if($ret->ResponseCode == 2 || $ret->ResponseCode == 3){
					echo _("Account does not exist");
				}else{
					echo $ret->Message;
				}

			}else{
				echo $resMessage;
			}
			break;
			
			case "updateAccount":
			
			$validation = true;
			$resMessage = "";
			
			$msisdn = isset($_REQUEST["MSISDN"])?$_REQUEST["MSISDN"]:$_SESSION['currentSearch']->AccountInformation->MobileNumber;
			$alias = isset($_REQUEST["ALIAS"])?$_REQUEST["ALIAS"]:$_SESSION['currentSearch']->AccountInformation->Alias;
			$type = isset($_REQUEST["TYPE"])?$_REQUEST["TYPE"]:$_SESSION['currentSearch']->AccountInformation->AccountType;
			$kyc = isset($_REQUEST["KYC"])?$_REQUEST["KYC"]:$_SESSION['currentSearch']->AccountInformation->KYC;
			$accountstatus = isset($_REQUEST["ACCOUNTSTATUS"])?$_REQUEST["ACCOUNTSTATUS"]:$_SESSION['currentSearch']->AccountInformation->Status;
			$refaccount = isset($_REQUEST["REFACCOUNT"])?$_REQUEST["REFACCOUNT"]:$_SESSION['currentSearch']->AccountInformation->ReferenceAccount;
			$locked = isset($_REQUEST["LOCKED"])?$_REQUEST["LOCKED"]:($_SESSION['currentSearch']->AccountInformation->Locked=='true'?"YES":"NO");
			
			$corpdate = isset($_REQUEST["CORPDATEOFINCORPORATION"])?$_REQUEST["CORPDATEOFINCORPORATION"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->dateofincorporation;
			$corpbname = isset($_REQUEST["CORPBUSINESSNAME"])?$_REQUEST["CORPBUSINESSNAME"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->businessname;
			$corptnumber = isset($_REQUEST["CORPTRADELICENSENUMBER"])?$_REQUEST["CORPTRADELICENSENUMBER"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->tradelicensenumber;
			$corpraddress = isset($_REQUEST["CORPREGISTEREDADDRESS"])?$_REQUEST["CORPREGISTEREDADDRESS"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->registeredaddress;
			$corptype = isset($_REQUEST["CORPTYPEOFBUSINESS"])?$_REQUEST["CORPTYPEOFBUSINESS"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->typeofbusiness;
			$corpoinfo = isset($_REQUEST["CORPOWNERSHIPINFO"])?$_REQUEST["CORPOWNERSHIPINFO"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->ownershipinfo;
			
			$mcvisafee = isset($_REQUEST["mcvisafee"])?$_REQUEST["mcvisafee"]:$_SESSION['currentSearch']->AccountInformation->mcvisafee;
			$othersfee = isset($_REQUEST["othersfee"])?$_REQUEST["othersfee"]:$_SESSION['currentSearch']->AccountInformation->othersfee;
			$mercdiscountrate = isset($_REQUEST["mercdiscountrate"])?$_REQUEST["mercdiscountrate"]:$_SESSION['currentSearch']->AccountInformation->mercdiscountrate;
			$cashdiscountrate = isset($_REQUEST["cashdiscountrate"])?$_REQUEST["cashdiscountrate"]:$_SESSION['currentSearch']->AccountInformation->cashdiscountrate;
			$cashtransfee = isset($_REQUEST["cashtransfee"])?$_REQUEST["cashtransfee"]:$_SESSION['currentSearch']->AccountInformation->cashtransfee;
			$cashtype = isset($_REQUEST["cashtype"])?$_REQUEST["cashtype"]:$_SESSION['currentSearch']->AccountInformation->cashtype;
			
			$corpbuilding = isset($_REQUEST["corpbuilding"])?$_REQUEST["corpbuilding"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->building;
			$corpstreet = isset($_REQUEST["corpstreet"])?$_REQUEST["corpstreet"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->street;
			$corpcity = isset($_REQUEST["corpcity"])?$_REQUEST["corpcity"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->city;
			$corpfloor = isset($_REQUEST["corpfloor"])?$_REQUEST["corpfloor"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->floor;
			$corparea = isset($_REQUEST["corparea"])?$_REQUEST["corparea"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->area;
			$corppobox = isset($_REQUEST["corppobox"])?$_REQUEST["corppobox"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->pobox;
			$corpreceiptname = isset($_REQUEST["corpreceiptname"])?$_REQUEST["corpreceiptname"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->receiptname;
			$corponboardedby = isset($_REQUEST["corponboardedby"])?$_REQUEST["corponboardedby"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->onboardedby;
			$corpcontactno = isset($_REQUEST["corpcontactno"])?$_REQUEST["corpcontactno"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->onboardedby;
			$trn = isset($_REQUEST["trn"])?$_REQUEST["trn"]:$_SESSION['currentSearch']->AccountInformation->TRN;
			
			
			
			$idissuancedate = isset($_REQUEST["idissuancedate"])?$_REQUEST["idissuancedate"]:$_SESSION['currentSearch']->AccountInformation->ValidID->Issuance;
			
			/*if($_REQUEST["EMAIL"] != ''){
				if(!filter_var($_REQUEST["EMAIL"], FILTER_VALIDATE_EMAIL)){
					$validation = false;
					$resMessage = _("Invalid Email format.");
				}
			}*/
			if(!$dataV->CheckEmail($_REQUEST["EMAIL"])){
				$validation = false;
					$resMessage = _("Invalid Email format.");
			}
			
			
			$exp = $_REQUEST['EXPIRY'] == "" ? date('Y-m-d') : $_REQUEST['EXPIRY'];
			
			if(!$dataV->CheckAlpha($_REQUEST['LASTNAME']) || !$dataV->CheckAlpha($_REQUEST['FIRSTNAME']) 
				/* || !$dataV->CheckAlpha($_REQUEST['IDNUMBER']) || !$dataV->CheckAlpha($_REQUEST['IDDESC']) || !$dataV->CheckAlpha($_REQUEST['NATIONALITY']) */ 
				|| !$dataV->CheckAlpha($corpreceiptname) || !$dataV->CheckAlpha($type) 
				/* || !$dataV->CheckAlpha($_REQUEST['PROFESSION']) || !$dataV->CheckAlpha($corpbname) || !$dataV->CheckAlpha($corpfloor) || !$dataV->CheckAlpha($corpstreet) */ || !$dataV->CheckAlpha($corparea) 
				|| !$dataV->CheckAlpha($corpcity) 
				/* || !$dataV->CheckAlpha($_REQUEST["COUNTRY"]) */ 
				|| !$dataV->CheckAlpha($corppobox) 
				/* || !$dataV->CheckAlpha($idissuancedate)
				|| !$dataV->CheckAlpha($exp) || !$dataV->CheckAlpha($corptype) */ ){
				$validation = false;
			$resMessage = _("Please input valid formatss.");
		}
		
		if($msisdn == '' || $_REQUEST["LASTNAME"] == '' || $_REQUEST["FIRSTNAME"] == '' 
			/* || $_REQUEST["IDNUMBER"] == '' || $_REQUEST["IDDESC"] == '' || $_REQUEST["NATIONALITY"] == '' || $_REQUEST["COUNTRY"] == '' || $_REQUEST["STREET"] == '' || $locked == '' || $_REQUEST["TINNUMBER"] == '' */){
			$validation = false;
		$resMessage = _("Please input all required fields.");
	}
	
	
	
	
	if($validation){
		
		
		$ret = $serv->updateAccount($msisdn,$alias,$_REQUEST["GENDER"],
			$_REQUEST["LASTNAME"],$_REQUEST["MIDDLENAME"],$_REQUEST["FIRSTNAME"],
			$_REQUEST["EMAIL"],$_REQUEST["DOB"],$_REQUEST["IDNUMBER"],
			$_REQUEST["IDDESC"],$exp,$_REQUEST["NATIONALITY"],$_REQUEST["POB"],
			$_REQUEST["CITY"],$_REQUEST["REGION"],$_REQUEST["COUNTRY"],
			$type,$kyc,$accountstatus,
			$refaccount,$_SESSION["currentUser"],$_REQUEST["BUILDING"],
			$_REQUEST["STREET"],$_REQUEST["COMPANY"],$_REQUEST["PROFESSION"],$locked,
			$_REQUEST["ALTNUMBER"],$corpdate,$corpbname,
			$corptnumber,$corpraddress,$corptype,
			$corpoinfo,$_REQUEST["TINNUMBER"],
			$mcvisafee,$othersfee,
			$corpbuilding,$corpstreet,$corpcity,$corpfloor,$corparea,$corppobox,
			$idissuancedate,$mercdiscountrate,$cashdiscountrate,$cashtransfee,
			$corpreceiptname,$cashtype,
			$corponboardedby, $corpcontactno,$_REQUEST["isvatappuser"],$trn);
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		if($ret->ResponseCode == 0){
			echo _("You have successfully saved your account");
		}else if($ret->ResponseCode == 2 || $ret->ResponseCode == 3){
			echo _("Account does not exist");
		}else{
			echo $ret->Message;
		}

	}else{
		echo $resMessage;
	}
	break;
	
	case "updateVAT":
			
			$validation = true;
			$resMessage = "";
			
			
	if(isset($_REQUEST["ID"]) && $_REQUEST["ID"] != ''){
		
		
		$ret = $serv->updateVAT($_REQUEST["ID"],$_REQUEST["isvatappuser"]);
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		if($ret->ResponseCode == 0){
			echo _("You have successfully saved your account");
		}else if($ret->ResponseCode == 2 || $ret->ResponseCode == 3){
			echo _("Account does not exist");
		}else{
			echo $ret->Message;
		}

	}else{
		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
	}
	break;
	
	case "approveKYC":
	
	if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
		if($_REQUEST["terminalid"] != '' && $_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $dataV->CheckAlpha($_REQUEST["terminalid"])){	
			$ret = $serv->approveKYC($_REQUEST["MSISDN"], $_SESSION["currentUser"],$_REQUEST["terminalid"], $_REQUEST["merchantid"],$_REQUEST["serialnumber"]);     
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0){
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
			}else{
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid merchant/terminal id required field!")));
		}
	}else{
		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
	}
	
	break;

	case "approveKYCCashier":
	
	if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
		if($_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $_REQUEST["cashierids"] != '' && $_REQUEST["cashiertids"] != ''){
			/* if($_REQUEST["terminalid"] != '' && $_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $dataV->CheckAlpha($_REQUEST["terminalid"]) && $_REQUEST["cashierids"] != '' && $_REQUEST["cashiertids"] != ''){ */
				$ret = $serv->approveKYCCashier($_REQUEST["MSISDN"], $_SESSION["currentUser"],$_REQUEST["terminalid"], $_REQUEST["merchantid"],$_REQUEST["cashierids"],$_REQUEST["cashiertids"],$_REQUEST["serialnumber"]);     
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid merchant/terminal id required field!")));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
		}
		
		break;

		case "rejectKYC":
		
		if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
			if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
				$ret = $serv->rejectKYC($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["reason"]);     
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for decline!")));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
		}
		
		break;


		case "rejectKYCCashier":		
		if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
			if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
				$ret = $serv->rejectKYCCashier($_REQUEST["MSISDN"], $_REQUEST["cashierids"], $_SESSION["currentUser"], $_REQUEST["reason"]);     
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for decline!")));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
		}
		
		break;
		
		case "sendbackKYC":
		
		if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
			if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
				$ret = $serv->sendbackKYC($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["reason"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for send back!")));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
		}
		
		break;
		
		case "processorApprove":
		
		if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
			$ret = $serv->processorApprove($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["id"]);							
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0){
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			}else{
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid MSISDN required field!")));
		}

		
		break;
		
		case "allocate":
		
		/*data validation*/
		$validation = true;
		$validationMessage = "";
		if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
			$validation = false;
			$validationMessage = _("Please input your correct PASSWORD!");
		}
		if ($_REQUEST["PASSWORD"] == ''){
			$validation = false;
			$validationMessage = _("Please input your PASSWORD!");
		}
		if(!$dataV->CheckAlpha($_REQUEST["REMARKS"])){
			$validation = false;
			$validationMessage = "Please input valid format for REMARKS.";
		}
		if ($_REQUEST["REMARKS"] == ''){
			$validation = false;
			$validationMessage = _("Please input REMARKS!");
		}
		if ($_REQUEST["AMOUNT"] == ''){
			$validation = false;
			$validationMessage = _("Please input AMOUNT!");
		}
		if ($_REQUEST["MSISDN"] == ''){
			$validation = false;
			$validationMessage = _("Not valid for allocation/deallocation.");
		}
		
		if($validation){
			
			$ret = $serv->allocate($_REQUEST["MSISDN"],$_REQUEST["AMOUNT"],$_SESSION["currentUser"],$_REQUEST["REMARKS"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0){
				echo _("Success, please wait for the approval");
			}else{
				echo $ret->Message;
			}
			
		}else{
			echo $validationMessage;
		}
		break;
		
		case "userLogin":
		$ret = $serv->userLogin($_REQUEST["username"], $_REQUEST["password"]);
		echo $ret->Message;
		break;

		case "userLoginOTP":

		$ret = $serv->userLoginOTP($_REQUEST["username"], $_REQUEST["password"],$_REQUEST["otp"]);
		echo $ret->Message;
		break;

		case "userRolesList":
		$ret = $serv->userRolesList();
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "updateModule":
		
		if(isset($_REQUEST["module"]) && $_REQUEST["module"] != ''){
			$value = ($_REQUEST['action'] == "NO") ? "YES" : "NO";                
			$ret = $serv->updateModule($_SESSION['userroles'],$_REQUEST['module'],$value);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0 ){
				echo $_REQUEST['module'] . _("'s module has been successfully set to ") . $value . ".";                        
			}else{
				echo $ret->Message;
			}
			
		}else{
			echo _("Not Valid for update user module!");
		}
		
		break;
		
		case "userRolesAddnew":
		
		if(isset($_REQUEST["userlevel"]) && $_REQUEST["userlevel"] != '' && $_REQUEST["sessiontimeout"] != '' && $_REQUEST["passwordchange"] != '' && $_REQUEST["passwordexpiry"] != '' && $_REQUEST["minpassword"] != '' && $_REQUEST["passwordhistory"] != '' && $_REQUEST["maxallocation"] != '' && $_REQUEST["searchrange"] != ''){
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["userlevel"])){
				$validation = false;
				$validationMessage = _("Please input valid format for User Level.");			}
			if(!$dataV->CheckNumeric($_REQUEST["sessiontimeout"]) || !$dataV->CheckNumeric($_REQUEST["passwordchange"])){
				$validation = false;
				$validationMessage = _("Please input valid format for session timeout / password change.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["passwordexpiry"]) || !$dataV->CheckNumeric($_REQUEST["minpassword"])){
				$validation = false;
				$validationMessage = _("Please input valid format for password expiry / minimum password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["passwordhistory"]) || !$dataV->CheckNumeric($_REQUEST["maxallocation"])){
				$validation = false;
				$validationMessage = _("Please input valid format for password history / max allocation.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["searchrange"])){
				$validation = false;
				$validationMessage = _("Please input valid format for search range.");
			}
			if($validation){
				
				$ret = $serv->userRolesAddnew($_REQUEST["userlevel"], $_REQUEST["sessiontimeout"], $_REQUEST["passwordchange"], $_REQUEST["passwordexpiry"], $_REQUEST["minpassword"], $_REQUEST["passwordhistory"], $_REQUEST["maxallocation"], $_REQUEST["searchrange"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("User level has been successfully added.");
				}else{
					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "userLocked":
		if($_REQUEST["user_id"] != '' && $_REQUEST["username"] != '' && $_REQUEST["locked"] != ''){
			if($_REQUEST["locked"] == 'true'){
				$ret = $serv->userLocked($_REQUEST["user_id"], $_REQUEST["username"], $_REQUEST["locked"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo $_REQUEST["username"] . _("'s web account has been successfully locked.");
				}else{
					echo $ret->Message;
				} 
			}else if($_REQUEST["locked"] == 'false'){
				$ret = $serv->userLocked($_REQUEST["user_id"], $_REQUEST["username"], $_REQUEST["locked"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo $_REQUEST["username"] . _("'s web account has been successfully unlocked.");
				}else{
					echo $ret->Message;
				}
			}
			
		}else{
			echo _("Not valid for user lock.");
		}
		break;
		
		case "userResetPassword":
		
		if($_REQUEST["user_id"] != '' && $_REQUEST["username"] != ''){
			$ret = $serv->userResetPassword($_REQUEST["user_id"], $_REQUEST["username"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0 ){
				echo _("Successfully Reset Password");
			}else{
				echo $ret->Message;
			}
			
		}else{
			echo _("Not valid for user reset password.");
		}
		
		break;
		
		case "getUserlevelDetails":
		$ret = $serv->getUserlevelDetails($_REQUEST["userlevel_value"]);
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "userRolesUpdate":
		
		if($_REQUEST["id"] != '' && $_REQUEST["userlevel"] != '' && $_REQUEST["sessiontimeout"] != '' && $_REQUEST["passwordchange"] != '' && $_REQUEST["passwordexpiry"] != '' && $_REQUEST["minpassword"] != '' && $_REQUEST["passwordhistory"] != '' && $_REQUEST["maxallocation"] != '' && $_REQUEST["searchrange"] != '' && $_REQUEST["newpasswordexpiry"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckNumeric($_REQUEST["sessiontimeout"]) || !$dataV->CheckNumeric($_REQUEST["passwordchange"])){
				$validation = false;
				$validationMessage = _("Please input valid format for session timeout / password change.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["passwordexpiry"]) || !$dataV->CheckNumeric($_REQUEST["minpassword"])){
				$validation = false;
				$validationMessage = _("Please input valid format for password expiry / minimum password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["passwordhistory"]) || !$dataV->CheckNumeric($_REQUEST["maxallocation"])){
				$validation = false;
				$validationMessage = _("Please input valid format for password history / max allocation.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["searchrange"])){
				$validation = false;
				$validationMessage = _("Please input valid format for search range.");
			}
			if(!$dataV->CheckAlpha($_REQUEST["userlevel"])){
				$validation = false;
				$validationMessage = _("Please select valid user level.");
			}
			if($validation){
				if($_REQUEST["userlevel"] != 'SELECTUSERLEVEL'){
					$ret = $serv->userRolesUpdate($_REQUEST["id"], $_REQUEST["userlevel"] , $_REQUEST["sessiontimeout"],$_REQUEST["passwordchange"],$_REQUEST["passwordexpiry"], $_REQUEST["minpassword"], $_REQUEST["passwordhistory"], $_REQUEST["maxallocation"], $_SESSION['currentUser'], $_REQUEST["searchrange"], $_REQUEST["newpasswordexpiry"]);
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					if($ret->ResponseCode == 0 ){
						echo _("Request user level updates has been successfully sent.");
					}else{
						echo $ret->Message;
					}
					
				}else{
					echo _("Please SELECT USER LEVEL.");
				}
			}else{
				echo $validationMessage;
			}
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "userUpdate":
		$validation = true;
		$resMessage = "";
		if($_REQUEST["userlevel"] == 'SELECTUSERLEVEL'){
			$validation = false;
			$resMessage = _("Please select User Level.");
		}
		if(!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)){
			$validation = false;
			$resMessage = _("Invalid Email format.");
		}
		if(!$dataV->CheckAlpha($_REQUEST['firstname']) || !$dataV->CheckAlpha($_REQUEST['lastname'])){
			$validation = false;
			$resMessage = _("Invalid Firstname/Lastname format.");
		}
		if(!$dataV->CheckAlpha($_REQUEST['userlevel'])){
			$validation = false;
			$resMessage = _("Invalid User Level format.");
		}
		if(!$dataV->CheckAlpha($_REQUEST['status'])){
			$validation = false;
			$resMessage = _("Invalid Status format.");
		}
		if(!$_REQUEST['department'] == ''){
			if(!$dataV->CheckAlpha($_REQUEST['department'])){
				$validation = false;
				$resMessage = _("Invalid department format.");
			}
		}
		if($_REQUEST["username"] == '' || $_REQUEST["firstname"] == '' || $_REQUEST["lastname"] == '' || $_REQUEST["msisdn"] == '' || $_REQUEST["userlevel"] == ''){
			$validation = false;
			$resMessage = _("Please input all required fields.");
		}
		
		if($validation){
			
			$ret = $serv->userUpdate($_REQUEST["userid"], $_REQUEST["username"] , $_REQUEST["firstname"],$_REQUEST["lastname"],$_REQUEST["department"], $_REQUEST["userlevel"], $_REQUEST["status"], $_SESSION["currentUser"], $_REQUEST["email"], $_REQUEST["msisdn"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0 ){
				echo $_REQUEST["username"] . _("'s web account has been successfully updated.");
			}else{
				echo $ret->Message;
			}
			
		}else{
			echo $resMessage;
		}
		break;
		
		case "userChangePassword":
		if($_REQUEST["oldpassword"] != '' && $_REQUEST["newpassword"] != '' && $_REQUEST["confirmpassword"] != ''){
			if($_REQUEST["newpassword"] == $_REQUEST["confirmpassword"]){
				$ret = $serv->userChangePassword($_SESSION["currentUserID"], $_SESSION["currentUser"], $_REQUEST["oldpassword"],$_REQUEST["newpassword"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					/*session_destroy();*/
					echo $_SESSION["currentUser"] . _("'s password has been successfully changed.");
					session_destroy();
				}else{
					echo $ret->Message;
				}
				
			}else{
				echo _("Passwords do not match! Please confirm your password!");
			}
		}else{
			echo _("Please input and confirm your password!");
		}
		break;
		
		case "getSystemInfo":
		$ret = $serv->getSystemInfo();
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "amlConfigType":
		$ret = $serv->amlConfigType($_REQUEST["type"],$_REQUEST["accounttype"],$_REQUEST["key"]);
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);                
		break;
		
		case "updateAmlConfigType":
		
		if($_REQUEST["id"] != '' && $_REQUEST["type"] != '' && $_REQUEST["accounttype"] != '' && $_REQUEST["key"] != '' && $_REQUEST["priority"] != '' && $_REQUEST["maxamount"] != '' && $_REQUEST["maxcurrentamount"] != '' && $_REQUEST["maxamountday"] != '' && $_REQUEST["maxamountmonth"] != '' && $_REQUEST["maxtransday"] != '' && $_REQUEST["maxtransmonth"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckNumeric($_REQUEST["maxamount"]) || !$dataV->CheckNumeric($_REQUEST["maxcurrentamount"])){
				$validation = false;
				$validationMessage = _("Please input valid format for max amount / max current amount.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["maxamountday"]) || !$dataV->CheckNumeric($_REQUEST["maxamountmonth"])){
				$validation = false;
				$validationMessage = _("Please input valid format for max amount day / max amount month.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["maxtransday"]) || !$dataV->CheckNumeric($_REQUEST["maxtransmonth"])){
				$validation = false;
				$validationMessage = _("Please input valid format for max trans day / max trans month.");
			}

			if($validation){
				$ret = $serv->updateAmlConfigType($_REQUEST["id"], $_REQUEST["type"] , $_REQUEST["accounttype"],$_REQUEST["key"],$_REQUEST["priority"], $_REQUEST["maxamount"], $_REQUEST["maxcurrentamount"], $_REQUEST["maxamountday"],$_REQUEST["maxamountmonth"], $_REQUEST["maxtransday"],$_REQUEST["maxtransmonth"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				
				echo $ret->Message;
			}else{
				echo $validationMessage;
			}
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "getAllUsers":
		$ret = $serv->getAllUsers();
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "getAccountType":
		$ret = $serv->getAccountType();
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "getAccountTypeRegister":
		$ret = $serv->getAccountType();
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$ctr=0; foreach($ret->Value as $t): 
		$regAccount = "REGISTER_" . $t->ACCOUNTTYPE;
		
		if($_SESSION['roles'][$regAccount]=='YES'){
			$ret->Values[$ctr] = array("ACCOUNTTYPE" => $t->ACCOUNTTYPE, "DESCRIPTION" => $t->DESCRIPTION);
			$ctr++;
		}else if($t->ACCOUNTTYPE == 'MERC' || $t->ACCOUNTTYPE == 'BILL'){
			if($_SESSION['roles']['REGISTER_MERC_/_BILLER']=='YES'){
				$ret->Values[$ctr] = array("ACCOUNTTYPE" => $t->ACCOUNTTYPE, "DESCRIPTION" => $t->DESCRIPTION);
				$ctr++;
			}
		}					
		endforeach;
		
		$arr = array("value"=>$ret->Values, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "getAccountTypeRegister2":
            	//print_r($_REQUEST["MSISDN"]);
		$ret = $serv->getAccountType2($_REQUEST["MSISDN"]);
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$ctr=0; foreach($ret->Value as $t):
		$regAccount = "REGISTER_" . $t->ACCOUNTTYPE;
		
		if($_SESSION['roles'][$regAccount]=='YES'){
			$ret->Values[$ctr] = array("ACCOUNTTYPE" => $t->ACCOUNTTYPE, "DESCRIPTION" => $t->DESCRIPTION);
			$ctr++;
		}else if($t->ACCOUNTTYPE == 'MERC' || $t->ACCOUNTTYPE == 'BILL'){
			if($_SESSION['roles']['REGISTER_MERC_/_BILLER']=='YES'){
				$ret->Values[$ctr] = array("ACCOUNTTYPE" => $t->ACCOUNTTYPE, "DESCRIPTION" => $t->DESCRIPTION);
				$ctr++;
			}
		}
		endforeach;
		
		$arr = array("value"=>$ret->Values, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "transactionSummary":
		$ret = $serv->transactionSummary($_REQUEST["fromdate"], $_REQUEST["todate"]);
		header('Content-Type: text/javascript');
		
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		
		$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
		echo json_encode($arr);
		break;
		
		case "approveAllocationCheck":
		/*data validation*/
		
		if ($_REQUEST["msisdn"] == '' || $_REQUEST["transactionid"] == '' || $_REQUEST["value"] == '' || $_REQUEST["alloctype"] == '' || $_REQUEST["amount"] == ''){
			
			echo _("Allocation / Deallocation not valid for approval!");
		}else{
			$_SESSION["allocMSISDN"] = $_REQUEST["msisdn"];
			$_SESSION["allocTRANSID"] = $_REQUEST["transactionid"];
			$_SESSION["allocVALUE"] = $_REQUEST["value"];
			$_SESSION["allocTYPE"] = $_REQUEST["alloctype"];
			if($_REQUEST["alloctype"] == 'ALLOC' && $_REQUEST["value"] == 'APPROVED'){
				echo _("Allocate an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
			}else if($_REQUEST["alloctype"] == 'DEALLOC' && $_REQUEST["value"] == 'APPROVED'){
				echo _("Deallocate an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
			}else{
				echo _("Please enter you password.");
			}
			
		}
		
		break;
		
		case "approveAllocation":
		/*data validation*/
		$validation = true;
		$validationMessage = "";
		if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
			$validation = false;
			$validationMessage = _("Please input your correct PASSWORD!");
		}
		if ($_REQUEST["PASSWORD"] == ''){
			$validation = false;
			$validationMessage = _("Please input your PASSWORD!");
		}
		if ($_SESSION["allocTRANSID"] == '' || $_SESSION["allocVALUE"] == '' || $_SESSION["allocMSISDN"] == ''){
			$validation = false;
			$validationMessage = _("Allocation / Deallocation not valid for approval!");
		}
		
		if($validation){
			if($_SESSION["allocVALUE"] == "APPROVED" && $_SESSION["allocTYPE"] == 'ALLOC'){
				$ret = $serv->approveAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDN"], $_SESSION["allocVALUE"],$_SESSION["allocTRANSID"]);						
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("You have successfully allocated an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDN"] . ".";
				}else{
					echo $ret->Message;
				}
				
				exit;
			}else if($_SESSION["allocVALUE"] == "APPROVED" && $_SESSION["allocTYPE"] == 'DEALLOC'){
				$ret = $serv->approveAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDN"], $_SESSION["allocVALUE"],$_SESSION["allocTRANSID"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("You have successfully approved deallocation an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDN"] . ".";
				}else{
					echo $ret->Message;
				}
				
				exit;
			}else if($_SESSION["allocVALUE"] != "APPROVED" && $_SESSION["allocTYPE"] == 'ALLOC'){
				$ret = $serv->approveAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDN"], $_SESSION["allocVALUE"],$_SESSION["allocTRANSID"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				
				if($ret->ResponseCode == 0 ){
					echo _("Successfully Disapprove");
				}else{
					echo $ret->Message;
				}
				
				exit;
			}else if($_SESSION["allocVALUE"] != "APPROVED" && $_SESSION["allocTYPE"] == 'DEALLOC'){
				$ret = $serv->approveAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDN"], $_SESSION["allocVALUE"],$_SESSION["allocTRANSID"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Deallocation have successfully Disapproved! Amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDN"] . ".";
				}else{
					echo $ret->Message;
				}
				
				exit;
			}
			$_SESSION["allocMSISDN"] = "";
			$_SESSION["allocTRANSID"] = "";
			$_SESSION["allocVALUE"] = "";
			$_SESSION["allocTYPE"] = "";
		}else{
			echo $validationMessage;
		}
		break;
		
		case "RequestSystemInfo":
		
		if($_REQUEST["sysCurrencyType"] != '' && $_REQUEST["sysCountryCode"] != '' && $_REQUEST["sysAccountNumber"] != '' && $_REQUEST["sysSenderNumber"] != '' && $_REQUEST["sysAcceptDecimal"] != '' && $_REQUEST["sysDefaultDealerPassword"] != '' && $_REQUEST["sysFailedTransferCount"] != '' && $_REQUEST["sysInvalidPasswordCount"] != '' && $_REQUEST["sysRPREDayCount"] != '' && $_REQUEST["sysMinAlias"] != '' && $_REQUEST["sysMaxAlias"] != '' && $_REQUEST["sysMsisdnToAlias"] != '' && $_REQUEST["sysMinAlloc"] != '' && $_REQUEST["sysMaxAlloc"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckNumeric($_REQUEST["sysDefaultDealerPassword"])){
				$validation = false;
				$validationMessage = _("Please input valid format for default password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["sysFailedTransferCount"]) || !$dataV->CheckNumeric($_REQUEST["sysInvalidPasswordCount"])){
				$validation = false;
				$validationMessage = _("Please input valid format for failed transfer count / invalid password count.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["sysRPREDayCount"]) || !$dataV->CheckNumeric($_REQUEST["sysMinAlias"])){
				$validation = false;
				$validationMessage = _("Please input valid format for RPRE day count / minimum alias.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["sysMaxAlias"]) || !$dataV->CheckNumeric($_REQUEST["sysMsisdnToAlias"])){
				$validation = false;
				$validationMessage = _("Please input valid format for max alias / msisdn to alias.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["sysMinAlloc"]) || !$dataV->CheckNumeric($_REQUEST["sysMaxAlloc"])){
				$validation = false;
				$validationMessage = _("Please input valid format for minimum alloc / max alloc.");
			}
			if($validation){
				$arr= array(
					"currencytype" => $_REQUEST['sysCurrencyType'],
					"countrycode" => $_REQUEST['sysCountryCode'],
					"accountnumber" => $_REQUEST['sysAccountNumber'],
					"sendernumber" => $_REQUEST['sysSenderNumber'],
					"acceptdecimal" => $_REQUEST['sysAcceptDecimal'],
					"defaultdealerpassword" => $_REQUEST['sysDefaultDealerPassword'],
					"failedtransfercount" => $_REQUEST['sysFailedTransferCount'],
					"invalidpasswordcount" => $_REQUEST['sysInvalidPasswordCount'],
					"username" => $_SESSION["currentUser"],
					"rpreDayCount" => $_REQUEST['sysRPREDayCount'],
					"minAlias" => $_REQUEST['sysMinAlias'],
					"maxAlias" => $_REQUEST['sysMaxAlias'],
					"msisdnToAlias" => $_REQUEST['sysMsisdnToAlias'],
					"minAlloc" => $_REQUEST['sysMinAlloc'],
					"maxAlloc" => $_REQUEST['sysMaxAlloc'],
					"crypt" => ""
					);
				$ret = $serv->call("requestSystemInfo",$arr,false);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}					
				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request system info has been successfully sent.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		break;
		
		case "approveSystemInfo":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			$ret = $serv->approveSystemInfo($_SESSION["currentUser"], $_REQUEST["id"], $_REQUEST["remarks"]);
			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("System Info not valid for approval.")));
		}
		break;
		
		case "approveUserLevels":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			$ret = $serv->approveUserLevels($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"], $_REQUEST["userlevel"]);
			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("User Level not valid for approval.")));
		}
		break;
		
		case "requestMessages":
		
		if($_REQUEST["id"] != '' && $_REQUEST["message"] != '' && $_REQUEST["description"] != '' && $_REQUEST["type"] != '' && $_REQUEST["language"] != ''){
			$ret = $serv->requestMessages($_REQUEST["id"], $_REQUEST["message"], $_REQUEST["description"], $_REQUEST["type"], $_REQUEST["language"], $_SESSION["currentUser"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0 ){
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request message has been successfully sent.")));
			}else{
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			}
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		
		break;
		
		case "approveMessagesPndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			$ret = $serv->approveMessagesPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);
			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Message not valid for approval.")));
		}
		break;
		
		case "addAmlTypePndg":
		
		if($_REQUEST["type"] != '' && $_REQUEST["accounttype"] != '' && $_REQUEST["key"] != '' && $_REQUEST["priority"] != '' && $_REQUEST["maxamount"] != '' && $_REQUEST["maxcurrentamount"] != '' && $_REQUEST["maxamountday"] != '' && $_REQUEST["maxamountmonth"] != '' && $_REQUEST["maxtransday"] != '' && $_REQUEST["maxtransmonth"] != ''){
			
			$ret = $serv->addAmlTypePndg($_REQUEST["type"] , $_REQUEST["accounttype"],$_REQUEST["key"],$_REQUEST["priority"], $_REQUEST["maxamount"], $_REQUEST["maxcurrentamount"], $_REQUEST["maxamountday"],$_REQUEST["maxamountmonth"], $_REQUEST["maxtransday"],$_REQUEST["maxtransmonth"],$_SESSION["currentUser"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0 ){
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request AML Type has been successfully sent.")));
			}else{
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		
		break;
		
		case "approveAmlTypePndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			$ret = $serv->approveAmlTypePndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);
			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
			echo  json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;	
		}else{
			echo "AML Type not valid for approval.";
		}
		break;
		
		case "updateKeyCostType":
		if($_REQUEST['id']!=""){
			$valid = true;
			$validationMessage = "";

			if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input valid id.");}
			else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input valid key.");}
			else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input valid type.");}
			else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input valid account.");}
			else if(!$dataV->CheckNumeric($_REQUEST['fixed'])){$valid=false;$validationMessage=_("Please input valid fixed amount.");}
			else if(!$dataV->CheckNumeric($_REQUEST['percent'])){$valid=false;$validationMessage=_("Please input valid percent amount.");}
			else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input valid priority.");}
			else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input valid status.");}
			else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input valid amount from.");}
			else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input valid amount to.");}
			else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input valid account from.");}
			else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input valid account to.");}
			
			if($valid){
				$ret = $serv->updateKeyCostType($_REQUEST['id'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['account'],$_REQUEST['fixed'],$_REQUEST['percent'],$_REQUEST['priority'],$_REQUEST['status'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
				if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
				if($ret->ResponseCode == 14){session_destroy();}
				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Key Cost Type has been successfully sent.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
		}        
		break;
		
		case "approveKeyCostTypePndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			$ret = $serv->approveKeyCostTypePndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);
			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("KeyCost Type not valid for approval.")));
		}
		break;
		
		case "search":
		$ret = $serv->search($_REQUEST["inp"],$_REQUEST["option"]);
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		echo $ret->ResponseCode;
		exit;
		break;
		
		case "validateMSISDN":
		$ret = $serv->validateMSISDN($_REQUEST["inp"]);
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		echo $ret->ResponseCode;
		exit;
		break;
		
		case "validateNickname":
		$ret = $serv->validateNickname($_REQUEST["inp"]);
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		echo $ret->ResponseCode;
		exit;
		break;
		
		case "validateTID":
		$ret = $serv->validateTID($_REQUEST["inp"]);
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		echo $ret->ResponseCode;
		exit;
		break;
		
		case "validateMID":
		$ret = $serv->validateMID($_REQUEST["inp"]);
		if(isset($ret->Token)){
			$_SESSION["token"] = $ret->Token;
		}
		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
			session_destroy();
		}
		echo $ret->ResponseCode;
		exit;
		break;
		
		case "addKeyCostType":

		if($_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['account']!="" && $_REQUEST['fixed']!="" && $_REQUEST['percent']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
			$valid=true;

			$validationMessage="";
			if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input valid key.");}
			else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input valid type.");}
			else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input valid account.");}
			else if(!$dataV->CheckNumeric($_REQUEST['fixed'])){$valid=false;$validationMessage=_("Please input valid fixed amount.");}
			else if(!$dataV->CheckNumeric($_REQUEST['percent'])){$valid=false;$validationMessage=_("Please input valid percent amount.");}
			else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input valid priority.");}
			else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input valid amount from.");}
			else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input valid amount to.");}
			else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input valid account from.");}
			else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input valid account to.");}
			
			if($valid){

				$ret = $serv->addKeyCostType($_REQUEST['key'],$_REQUEST['type'],$_REQUEST['account'],$_REQUEST['fixed'],$_REQUEST['percent'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);

				if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}

				if($ret->ResponseCode == 14){session_destroy();}

				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Key Cost Type has been successfully sent.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{

				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
		}else{

			echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
		}
		
		break;
		
		case "requestTransceiver":
		
		if($_REQUEST["pndgid"] != '' && $_REQUEST["systemid"] != '' && $_REQUEST["password"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["port"] != '' && $_REQUEST["ton"] != '' && $_REQUEST["npi"] != '' && $_REQUEST["origton"] != '' && $_REQUEST["orignpi"] != '' && $_REQUEST["destton"] != '' && $_REQUEST["destnpi"] != '' && $_REQUEST["status"] != '' && $_REQUEST["hostip"] != '' && $_REQUEST["shortcode"] != '' && $_REQUEST["keepaliveinterval"] != '' && $_REQUEST["responsetimeout"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["systemid"]) || !$dataV->CheckAlpha($_REQUEST["password"])){
				$validation = false;
				$validationMessage = _("Please input valid format for systemid / password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["port"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / port.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ton"]) || !$dataV->CheckNumeric($_REQUEST["npi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ton / npi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["origton"]) || !$dataV->CheckNumeric($_REQUEST["orignpi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for origton / orignpi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["destton"]) || !$dataV->CheckNumeric($_REQUEST["destnpi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for destton / destnpi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["status"])){
				$validation = false;
				$validationMessage = _("Please input valid format for status.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["hostip"]) || !$dataV->CheckNumeric($_REQUEST["shortcode"])){
				$validation = false;
				$validationMessage = _("Please input valid format for hostip / shortcode.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["keepaliveinterval"]) || !$dataV->CheckNumeric($_REQUEST["responsetimeout"])){
				$validation = false;
				$validationMessage = _("Please input valid format for keepaliveinterval / responsetimeout.");
			}
			
			if($validation){
				$ret = $serv->requestTransceiver($_REQUEST["pndgid"], $_REQUEST["systemid"], $_REQUEST["password"], $_REQUEST["ip"], $_REQUEST["port"],$_REQUEST["ton"], $_REQUEST["npi"], $_REQUEST["origton"], $_REQUEST["orignpi"], $_REQUEST["destton"], $_REQUEST["destnpi"], $_REQUEST["systype"], $_REQUEST["status"], $_REQUEST["hostip"], $_REQUEST["shortcode"], $_REQUEST["keepaliveinterval"], $_REQUEST["responsetimeout"], $_REQUEST["pinpattern"], $_REQUEST["pinreplace"], $_SESSION["currentUser"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Transceiver has been successfully sent.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		
		break;
		
		case "approveTransceiverPndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			$ret = $serv->approveTransceiverPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);
			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Transceiver not valid for approval.")));
		}
		break;
		
		case "requestTransmitter":
		
		if($_REQUEST["pndgid"] != '' && $_REQUEST["systemid"] != '' && $_REQUEST["password"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["port"] != '' && $_REQUEST["ton"] != '' && $_REQUEST["npi"] != '' && $_REQUEST["origton"] != '' && $_REQUEST["orignpi"] != '' && $_REQUEST["destton"] != '' && $_REQUEST["destnpi"] != '' && $_REQUEST["status"] != '' && $_REQUEST["hostip"] != '' && $_REQUEST["shortcode"] != '' && $_REQUEST["keepaliveinterval"] != '' && $_REQUEST["responsetimeout"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["systemid"]) || !$dataV->CheckAlpha($_REQUEST["password"])){
				$validation = false;
				$validationMessage = _("Please input valid format for systemid / password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["port"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / port.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ton"]) || !$dataV->CheckNumeric($_REQUEST["npi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ton / npi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["origton"]) || !$dataV->CheckNumeric($_REQUEST["orignpi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for origton / orignpi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["destton"]) || !$dataV->CheckNumeric($_REQUEST["destnpi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for destton / destnpi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["status"])){
				$validation = false;
				$validationMessage = _("Please input valid format for status.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["hostip"]) || !$dataV->CheckNumeric($_REQUEST["shortcode"])){
				$validation = false;
				$validationMessage = _("Please input valid format for hostip / shortcode.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["keepaliveinterval"]) || !$dataV->CheckNumeric($_REQUEST["responsetimeout"])){
				$validation = false;
				$validationMessage = _("Please input valid format for keepaliveinterval / responsetimeout.");
			}
			
			if($validation){
				$ret = $serv->requestTransmitter($_REQUEST["pndgid"], $_REQUEST["systemid"], $_REQUEST["password"], $_REQUEST["ip"], $_REQUEST["port"],$_REQUEST["ton"], $_REQUEST["npi"], $_REQUEST["origton"], $_REQUEST["orignpi"], $_REQUEST["destton"], $_REQUEST["destnpi"], $_REQUEST["systype"], $_REQUEST["status"], $_REQUEST["hostip"], $_REQUEST["shortcode"], $_REQUEST["keepaliveinterval"], $_REQUEST["responsetimeout"], $_REQUEST["pinpattern"], $_REQUEST["pinreplace"], $_SESSION["currentUser"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Request Transmitter has been successfully sent.");
				}else{
					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
			exit;
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "approveTransmitterPndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			
			$ret = $serv->approveTransmitterPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);					
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			echo $ret->Message;
			exit;

		}else{
			echo _("Transmitter not valid for approval.");
		}
		break;
		
		case "requestReceiver":
		
		if($_REQUEST["pndgid"] != '' && $_REQUEST["systemid"] != '' && $_REQUEST["password"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["port"] != '' && $_REQUEST["ton"] != '' && $_REQUEST["npi"] != '' && $_REQUEST["secured"] != '' && $_REQUEST["status"] != '' && $_REQUEST["hostip"] != '' && $_REQUEST["shortcode"] != '' && $_REQUEST["keepaliveinterval"] != '' && $_REQUEST["responsetimeout"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["systemid"]) || !$dataV->CheckAlpha($_REQUEST["password"])){
				$validation = false;
				$validationMessage = _("Please input valid format for systemid / password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["port"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / port.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ton"]) || !$dataV->CheckNumeric($_REQUEST["npi"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ton / npi.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["status"])){
				$validation = false;
				$validationMessage = _("Please input valid format for status.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["hostip"]) || !$dataV->CheckNumeric($_REQUEST["shortcode"])){
				$validation = false;
				$validationMessage = _("Please input valid format for hostip / shortcode.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["keepaliveinterval"]) || !$dataV->CheckNumeric($_REQUEST["responsetimeout"])){
				$validation = false;
				$validationMessage = _("Please input valid format for keepaliveinterval / responsetimeout.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["secured"])){
				$validation = false;
				$validationMessage = _("Please input valid format for secured.");
			}
			
			if($validation){
				$ret = $serv->requestReceiver($_REQUEST["pndgid"], $_REQUEST["systemid"], $_REQUEST["password"], $_REQUEST["ip"], $_REQUEST["port"],$_REQUEST["ton"], $_REQUEST["npi"], $_REQUEST["systype"], $_REQUEST["status"], $_REQUEST["hostip"], $_REQUEST["shortcode"], $_REQUEST["keepaliveinterval"], $_REQUEST["responsetimeout"], $_REQUEST["secured"], $_SESSION["currentUser"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Request Receiver has been successfully sent.");
				}else{
					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
			exit;
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "approveReceiverPndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){
			
			$ret = $serv->approveReceiverPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);					
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			echo $ret->Message;
			exit;
			
		}else{
			echo _("Receiver not valid for approval.");
		}
		break;
		
		case "requestServerConfig":
		
		if($_REQUEST["pndgid"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["func"] != '' && $_REQUEST["status"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["func"])){
				$validation = false;
				$validationMessage = _("Please input valid format for function.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["status"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / status.");
			}
			
			if($validation){
				$ret = $serv->requestServerConfig($_REQUEST["pndgid"], $_REQUEST["ip"], $_REQUEST["func"], $_REQUEST["status"], $_SESSION["currentUser"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Server Config has been successfully sent.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		
		break;
		
		case "approveServerConfigPndg":
		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){

			$ret = $serv->approveServerConfigPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);						

			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			exit;

		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Server Config not valid for approval.")));
		}
		break;
		
		case "addTransceiver":
		
		if($_REQUEST["systemid"] != '' && $_REQUEST["password"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["port"] != '' && $_REQUEST["hostip"] != '' && $_REQUEST["shortcode"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["systemid"]) || !$dataV->CheckAlpha($_REQUEST["password"])){
				$validation = false;
				$validationMessage = _("Please input valid format for systemid / password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["port"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / port.");
			}
			
			if(!$dataV->CheckNumeric($_REQUEST["hostip"]) || !$dataV->CheckNumeric($_REQUEST["shortcode"])){
				$validation = false;
				$validationMessage = _("Please input valid format for hostip / shortcode.");
			}
			if($validation){
				$ret = $serv->addTransceiver($_REQUEST["systemid"], $_REQUEST["password"], $_REQUEST["ip"], $_REQUEST["port"], $_REQUEST["systype"],$_REQUEST["hostip"], $_REQUEST["shortcode"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Transceiver has been successfully added.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		
		break;
		
		case "addTransmitter":
		
		if($_REQUEST["systemid"] != '' && $_REQUEST["password"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["port"] != '' && $_REQUEST["hostip"] != '' && $_REQUEST["shortcode"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["systemid"]) || !$dataV->CheckAlpha($_REQUEST["password"])){
				$validation = false;
				$validationMessage = _("Please input valid format for systemid / password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["port"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / port.");
			}
			
			if(!$dataV->CheckNumeric($_REQUEST["hostip"]) || !$dataV->CheckNumeric($_REQUEST["shortcode"])){
				$validation = false;
				$validationMessage = _("Please input valid format for hostip / shortcode.");
			}
			
			if($validation){
				$ret = $serv->addTransmitter($_REQUEST["systemid"], $_REQUEST["password"], $_REQUEST["ip"], $_REQUEST["port"], $_REQUEST["systype"],$_REQUEST["hostip"], $_REQUEST["shortcode"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Transmitter has been successfully added.");
				}else{					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
			exit;
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "addReceiver":
		
		if($_REQUEST["systemid"] != '' && $_REQUEST["password"] != '' && $_REQUEST["ip"] != '' && $_REQUEST["port"] != '' && $_REQUEST["hostip"] != '' && $_REQUEST["shortcode"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["systemid"]) || !$dataV->CheckAlpha($_REQUEST["password"])){
				$validation = false;
				$validationMessage = _("Please input valid format for systemid / password.");
			}
			if(!$dataV->CheckNumeric($_REQUEST["ip"]) || !$dataV->CheckNumeric($_REQUEST["port"])){
				$validation = false;
				$validationMessage = _("Please input valid format for ip / port.");
			}
			
			if(!$dataV->CheckNumeric($_REQUEST["hostip"]) || !$dataV->CheckNumeric($_REQUEST["shortcode"])){
				$validation = false;
				$validationMessage = _("Please input valid format for hostip / shortcode.");
			}
			
			if($validation){
				$ret = $serv->addReceiver($_REQUEST["systemid"], $_REQUEST["password"], $_REQUEST["ip"], $_REQUEST["port"], $_REQUEST["systype"],$_REQUEST["hostip"], $_REQUEST["shortcode"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Receiver has been successfully added.");
				}else{
					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
			exit;
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "addServerConfig":
		
		if($_REQUEST["ip"] != ''){
			$validation = true;
			$validationMessage = "";
			
			if (!filter_var($_REQUEST["ip"], FILTER_VALIDATE_IP)) {
				$validation = false;
				$validationMessage = _("Please input valid format for ip.");
			}
			
			if($validation){
				$ret = $serv->addServerConfig($_REQUEST["ip"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Server Config has been successfully added.")));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}
			}else{
				echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
			}
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
		}
		break;
		
		case "requestReversal":
		
		if($_REQUEST["referenceid"] != '' && $_REQUEST["type"] != '' && $_REQUEST["frmsisdn"] != '' && $_REQUEST["tomsisdn"] != '' && $_REQUEST["amount"] != '' && $_REQUEST["remarks"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["remarks"])){
				$validation = false;
				$validationMessage = _("Please input valid format for remarks.");
			}
			
			if($validation){
				$ret = $serv->requestReversal($_REQUEST["referenceid"], $_REQUEST["type"], $_REQUEST["frmsisdn"], $_REQUEST["tomsisdn"], $_REQUEST["amount"], $_SESSION["currentUser"], $_REQUEST["remarks"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Success, please wait for the approval");
				}else if($ret->ResponseCode == 98){
					echo _("Cash reversal already exists");
				}else{
					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
			exit;
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "requestRfndVoid":
		
		if($_REQUEST["referenceid"] != '' && $_REQUEST["type"] != '' && $_REQUEST["msisdn"] != '' && $_REQUEST["amount"] != '' && $_REQUEST["remarks"] != ''){
			
			$validation = true;
			$validationMessage = "";
			if(!$dataV->CheckAlpha($_REQUEST["remarks"])){
				$validation = false;
				$validationMessage = _("Please input valid format for remarks.");
			}
			
			if($validation){
				$ret = $serv->requestRfndVoid($_REQUEST["referenceid"], $_REQUEST["type"], $_REQUEST["msisdn"], $_REQUEST["amount"], $_SESSION["currentUser"], $_REQUEST["remarks"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0 ){
					echo _("Success, please wait for the approval");
				}else if($ret->ResponseCode == 98){
					echo _("Cash reversal already exists");
				}else{
					echo $ret->Message;
				}
			}else{
				echo $validationMessage;
			}
			exit;
		}else{
			echo _("Please input all required fields.");
		}
		
		break;
		
		case "approveReversalPndg":
		
		/*data validation*/
		$validation = true;
		$validationMessage = "";
		
		if($_SESSION["reversal_frmsisdn"] == '' || $_SESSION["reversal_tomsisdn"] == '' || $_SESSION["reversal_value"] == '' || $_SESSION["reversal_referenceid"] == ''){
			$validation = false;
			$validationMessage = _("Please input all required fields.");
		}
		if ($_SESSION["currentPassword"] != $_REQUEST["Password"]){
			$validation = false;
			$validationMessage = _("Please input your correct PASSWORD!");
		}
		if ($_REQUEST["Password"] == ''){
			$validation = false;
			$validationMessage = _("Please input your PASSWORD!");
		}
		
		if($validation){
			
			$ret = $serv->approveReversalPndg($_SESSION["currentUser"], $_SESSION["reversal_frmsisdn"], $_SESSION["reversal_tomsisdn"], $_SESSION["reversal_value"], $_SESSION["reversal_referenceid"]);

			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0){
				if($_SESSION['reversal_value']=="APPROVE"){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("You have successfully reverse an amount of ") . $ret->Message));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Pending reversal has been rejected.")));
				}
			}else{
				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
			}
			exit;
		}else{
			echo json_encode(array("ResponseCode"=>1,"Message"=>$validationMessage));
		}
		
		break;
		case "approveReversalPndgCheck":
		if($_REQUEST['frmsisdn']=="" || $_REQUEST['tomsisdn']=="" || $_REQUEST['value']=="" || $_REQUEST['referenceid']=="" || $_REQUEST['amount']==""){
			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Reversal is not valid for approval.")));
		}else{
			$_SESSION['reversal_frmsisdn'] = $_REQUEST['frmsisdn'];
			$_SESSION['reversal_tomsisdn'] = $_REQUEST['tomsisdn'];
			$_SESSION['reversal_value'] = $_REQUEST['value'];
			$_SESSION['reversal_referenceid'] = $_REQUEST['referenceid'];
			$message = ucwords(strtolower($_REQUEST['value'])) . " reversal with the amount of " . $_REQUEST["amount"] . " to " . $_REQUEST["tomsisdn"] . " ?";
			echo json_encode(array("ResponseCode"=>0,"Message"=>$message));
		}
		break;
		
		case "approveRefundPndg":
		
		/*data validation*/
		$validation = true;
		$validationMessage = "";
		
		if($_SESSION["refund_msisdn"] == '' || $_SESSION["refund_value"] == '' || $_SESSION["refund_referenceid"] == ''){
			$validation = false;
			$validationMessage = _("Please input all required fields.");
		}
            	/* if ($_SESSION["currentPassword"] != $_REQUEST["Password"]){
            		
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["Password"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	} */
            	
            	if($validation){
            		
            		$ret = $serv->approveRefundPndg($_SESSION["currentUser"], $_SESSION["refund_msisdn"], $_SESSION["refund_value"], $_SESSION["refund_referenceid"]);            		
            		if(isset($ret->Token)){
            			$_SESSION["token"] = $ret->Token;
            		}
            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            			session_destroy();
            		}
            		if($ret->ResponseCode == 0){
            			if($_SESSION['refund_value']=="APPROVE"){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("You have successfully reverse an amount of ") . $ret->Message));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Pending reversal has been rejected.")));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		}
            		exit;
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>$validationMessage));
            	}
            	
            	break;
            	case "approveRefundPndgCheck":
            	if( $_REQUEST['msisdn']=="" || $_REQUEST['value']=="" || $_REQUEST['referenceid']=="" || $_REQUEST['amount']==""){
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Refund is not valid for approval.")));
            	}else{
            		$_SESSION['refund_msisdn'] = $_REQUEST['msisdn'];
            		$_SESSION['refund_value'] = $_REQUEST['value'];
            		$_SESSION['refund_referenceid'] = $_REQUEST['referenceid'];
            		$message = ucwords(strtolower($_REQUEST['value'])) . " refund with the amount of " . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		echo json_encode(array("ResponseCode"=>0,"Message"=>$message));
            	}
            	break;
            	
            	case "queryGlobal":
            	
            	$ret = $serv->queryGlobal($_REQUEST["query"]);
            	header('Content-Type: text/javascript');
            	
            	if(isset($ret->Token)){
            		$_SESSION["token"] = $ret->Token;
            	}
            	if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            		session_destroy();
            	}
            	$arr = array("value"=>$ret->Value, "responsecode" => $ret->ResponseCode, "message" => $ret->Message);
            	echo json_encode($arr);
            	break;
            	
            	case "allocateEVD":
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if ($_REQUEST["REMARKS"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input REMARKS!");
            	}
            	if ($_REQUEST["AMOUNT"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input AMOUNT!");
            	}
            	if ($_REQUEST["MSISDN"] == ''){
            		$validation = false;
            		$validationMessage = _("Not valid for allocation/deallocation.");
            	}
            	
            	if($validation){
            		if($_SESSION['roles']['FINANCIAL_SERVICES']=='YES'){
            			$ret = $serv->allocateEVD($_REQUEST["MSISDN"],$_REQUEST["AMOUNT"],$_SESSION["currentUser"],$_REQUEST["REMARKS"]);
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			
            			if($ret->ResponseCode == 0){
            				echo _("Success, please wait for the approval");
            			}else{
            				echo $ret->Message;
            			}
            			
            		}else{
            			echo _("Unauthorized Access!");
            		}
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "approveAllocationCheckEVD":
            	/*data validation*/
            	
            	if ($_REQUEST["msisdn"] == '' || $_REQUEST["transactionid"] == '' || $_REQUEST["value"] == '' || $_REQUEST["alloctype"] == '' || $_REQUEST["amount"] == ''){
            		
            		echo _("Allocation / Deallocation not valid for approval!");
            	}else{
            		$_SESSION["allocMSISDNEVD"] = $_REQUEST["msisdn"];
            		$_SESSION["allocTRANSIDEVD"] = $_REQUEST["transactionid"];
            		$_SESSION["allocVALUEEVD"] = $_REQUEST["value"];
            		$_SESSION["allocTYPEEVD"] = $_REQUEST["alloctype"];
            		if($_REQUEST["alloctype"] == 'EVD ALLOC' && $_REQUEST["value"] == 'APPROVED'){
            			echo _("Allocate EVD an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		}else if($_REQUEST["alloctype"] == 'EVD DEALLOC' && $_REQUEST["value"] == 'APPROVED'){
            			echo _("Deallocate EVD an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		}else{
            			echo _("Please enter you password.");
            		}
            		
            	}
            	
            	break;
            	
            	case "approveEVDAllocation":
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if ($_SESSION["allocTRANSIDEVD"] == '' || $_SESSION["allocVALUEEVD"] == '' || $_SESSION["allocMSISDNEVD"] == ''){
            		$validation = false;
            		$validationMessage = _("Allocation / Deallocation EVD not valid for approval!");
            	}
            	
            	if($validation){
            		if($_SESSION["allocVALUEEVD"] == "APPROVED" && $_SESSION["allocTYPEEVD"] == 'EVD ALLOC'){
            			$ret = $serv->approveEVDAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDNEVD"], $_SESSION["allocVALUEEVD"],$_SESSION["allocTRANSIDEVD"]);						
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully allocated EVD an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNEVD"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEEVD"] == "APPROVED" && $_SESSION["allocTYPEEVD"] == 'EVD DEALLOC'){
            			$ret = $serv->approveEVDAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDNEVD"], $_SESSION["allocVALUEEVD"],$_SESSION["allocTRANSIDEVD"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully approved deallocation EVD an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNEVD"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEEVD"] != "APPROVED" && $_SESSION["allocTYPEEVD"] == 'EVD ALLOC'){
            			$ret = $serv->approveEVDAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDNEVD"], $_SESSION["allocVALUEEVD"],$_SESSION["allocTRANSIDEVD"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			
            			if($ret->ResponseCode == 0 ){
            				echo _("Successfully Disapprove");
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEEVD"] != "APPROVED" && $_SESSION["allocTYPEEVD"] == 'EVD DEALLOC'){
            			$ret = $serv->approveEVDAllocation($_SESSION["currentUser"], $_SESSION["allocMSISDNEVD"], $_SESSION["allocVALUEEVD"],$_SESSION["allocTRANSIDEVD"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("Deallocation EVD have successfully Disapproved! Amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNEVD"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}
            		$_SESSION["allocMSISDNEVD"] = "";
            		$_SESSION["allocTRANSIDEVD"] = "";
            		$_SESSION["allocVALUEEVD"] = "";
            		$_SESSION["allocTYPEEVD"] = "";
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "requestAirBonusTopup":
            	if($_REQUEST['ID'] != ""){
            		$ret = $serv->requestAirBonusTopup($_REQUEST['ID'],$_REQUEST['PRODUCTID'],$_REQUEST['MINRANGE'],$_REQUEST['MAXRANGE'],$_REQUEST['SERVICECLASS'],$_REQUEST['DEDICATEDACCOUNTID'],$_REQUEST['FIXEDAMOUNT'],$_REQUEST['PERCENTAMOUNT'],$_REQUEST['EXPIRYDAYS'],$_REQUEST['EXPIRYDATE'],$_REQUEST['STATUS'],$_REQUEST['CREATEDDATE'],$_REQUEST['MODIFYDATE'],$_REQUEST['DISABLEDATE'],$_REQUEST['CREATEDUSER'],$_REQUEST['MODIFYUSER'],$_REQUEST['DISABLEUSER'],$_REQUEST['NAME'],$_REQUEST['CELLIDMINRANGE'],$_REQUEST['CELLIDMAXRANGE'],$_SESSION['currentUser']);
            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            		if($ret->ResponseCode == 0 ){
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request air bonus topup has been successfully sent.")));
            		}else{
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		}
            		exit;
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
            	}
            	break;

            	case "addAirBonusTopup":
            	if($_REQUEST['PRODUCTID']!="" && $_REQUEST['SERVICECLASS']!="" && $_REQUEST['DEDICATEDACCOUNTID']!="" && $_REQUEST['MINRANGE']!="" && $_REQUEST['MAXRANGE']!="" && $_REQUEST['CELLIDMINRANGE']!="" && $_REQUEST['CELLIDMAXRANGE']!="" && $_REQUEST['FIXEDAMOUNT']!="" && $_REQUEST['PERCENTAMOUNT']!="" && $_REQUEST['EXPIRYDAYS']!="" && $_REQUEST['EXPIRYDATE']!="" && $_REQUEST['NAME']!=""){
            		$valid = true;
            		$validationMessage = "";
            		
            		if(!$dataV->CheckNumeric($_REQUEST['PRODUCTID'])){$valid = false;$validationMessage = _("Please input a valid product id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['SERVICECLASS'])){$valid = false;$validationMessage = _("Please input a valid service class.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['DEDICATEDACCOUNTID'])){$valid = false;$validationMessage = _("Please input a valid dedicated account id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['MAXRANGE'])){$valid = false;$validationMessage = _("Please input a valid max. range.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['MINRANGE'])){$valid = false;$validationMessage = _("Please input a valid min. range.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['CELLIDMINRANGE'])){$valid = false;$validationMessage = _("Please input a valid cell id min. range.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['CELLIDMAXRANGE'])){$valid = false;$validationMessage = _("Please input a valid cell id max. range.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['FIXEDAMOUNT'])){$valid = false;$validationMessage = _("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['PERCENTAMOUNT'])){$valid = false;$validationMessage = _("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['EXPIRYDAYS'])){$valid = false;$validationMessage = _("Please input a valid expiry days.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['EXPIRYDATE'])){$valid = false;$validationMessage = _("Please input a valid expiry date.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['NAME'])){$valid = false;$validationMessage = _("Please input a valid name.");}

            		if($valid){
            			$ret = $serv->addAirBonusTopup('0',$_REQUEST['PRODUCTID'],$_REQUEST['SERVICECLASS'],$_REQUEST['DEDICATEDACCOUNTID'],$_REQUEST['MINRANGE'],$_REQUEST['MAXRANGE'],$_REQUEST['CELLIDMINRANGE'],$_REQUEST['CELLIDMAXRANGE'],$_REQUEST['FIXEDAMOUNT'],$_REQUEST['PERCENTAMOUNT'],$_REQUEST['EXPIRYDAYS'],$_REQUEST['EXPIRYDATE'],$_REQUEST['NAME'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Air Bonus Topup has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addBonusByType":
            	if($_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->addBonusByType('0',$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Bonus by Type has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addBonusByMSISDN":
            	if($_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->addBonusByMSISDN('0',$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Bonus by MSISDN has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addCommissionsByType":
            	if($_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";


            		if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->addCommissionsByType('0',$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Commission by Type has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addCommissionsByMSISDN":
            	if($_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";


            		if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->addCommissionsByMSISDN('0',$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Commission by MSISDN has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestBonusByType":
            	if($_REQUEST['id']!="" && $_REQUEST['status']!="" && $_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		
            		if($valid){
            			$ret = $serv->requestBonusByType($_REQUEST['id'],$_REQUEST['status'],$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Bonus by Type has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestBonusByMSISDN":
            	if($_REQUEST['id']!="" && $_REQUEST['status']!="" && $_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->requestBonusByMSISDN($_REQUEST['id'],$_REQUEST['status'],$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Bonus by MSISDN has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestCommissionsByType":
            	if($_REQUEST['id']!="" && $_REQUEST['status']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->requestCommissionsByType($_REQUEST['id'],$_REQUEST['status'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Commissions by Type has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestCommissionsByMSISDN":
            	if($_REQUEST['id']!="" && $_REQUEST['status']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}

            		else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
            		
            		if($valid){
            			$ret = $serv->requestCommissionsByMSISDN($_REQUEST['id'],$_REQUEST['status'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Commissions by MSISDN has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;
            	
            	case "approveRejectBonusByTypePending":
            	if($_REQUEST['id']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectBonusByTypePending($_SESSION['currentUser'],$_REQUEST['id'],$_REQUEST['remarks']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectBonusByMSISDNPending":
            	if($_REQUEST['id']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectBonusByMSISDNPending($_REQUEST['id'],$_REQUEST['remarks'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectCommissionsByTypePending":
            	if($_REQUEST['id']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectCommissionsByTypePending($_SESSION['currentUser'],$_REQUEST['id'],$_REQUEST['remarks']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectCommissionsByMSISDNPending":
            	if($_REQUEST['id']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectCommissionsByMSISDNPending($_REQUEST['id'],$_REQUEST['remarks'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}            	break;
            	
            	case "approveAirBonusTopupPndg":
            	if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){

            		$ret = $serv->approveAirBonusTopupPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);						

            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


            		echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		exit;

            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Air Bonus Topup not valid for approval.")));
            	}
            	break;
            	
            	case "requestAirConfig":
            	if($_REQUEST['AIRSERVERID'] != ""){
            		$ret = $serv->requestAirConfig($_REQUEST['AIRSERVERID'],$_REQUEST['TIMEOFFSET'],$_REQUEST['FACTOR'],$_REQUEST['URL'],$_REQUEST['CTYPE'],$_REQUEST['AGENT'],$_REQUEST['IP'],$_REQUEST['HOST'],$_REQUEST['PORT'],$_REQUEST['STATUS'],$_REQUEST['CURRENCYTYPE'],$_REQUEST['AUTHORIZATION'],$_REQUEST['REFILLID'],$_REQUEST['ACCEPTDECIMAL'],$_REQUEST['TIMEOUT'],$_SESSION['currentUser']);
            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            		if($ret->ResponseCode == 0 ){
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request air configuration has been successfully sent.")));
            		}else{
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		}
            		exit;
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
            	}
            	break;
            	
            	case "addAirConfig":
            	if($_REQUEST['TIMEOFFSET'] != ""){
            		$ret = $serv->addAirConfig($_REQUEST['TIMEOFFSET'],$_REQUEST['FACTOR'],$_REQUEST['URL'],$_REQUEST['CTYPE'],$_REQUEST['AGENT'],$_REQUEST['IP'],$_REQUEST['HOST'],$_REQUEST['PORT'],$_REQUEST['CURRENCYTYPE'],$_REQUEST['AUTHORIZATION'],$_REQUEST['REFILLID'],$_REQUEST['ACCEPTDECIMAL'],$_REQUEST['TIMEOUT']);
            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            		if($ret->ResponseCode == 0 ){
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Air configuration has been successfully added.")));
            		}else{
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		}
            		exit;
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Please input all required fields.")));
            	}
            	break;
            	
            	case "approveAirConfigPndg":
            	if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){

            		$ret = $serv->approveAirConfigPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"]);						

            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}

            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}

            		echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		exit;

            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Air Configuration not valid for approval.")));
            	}
            	break;
            	
            	case "approveTerminalIDPndg":
            	if(isset($_REQUEST["remarks"]) && $_REQUEST["remarks"] == 'APPROVE'){
            		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != '' && $_REQUEST["msisdn"] != '' && $_REQUEST["newmsisdn"] != '' && $_REQUEST["terminalid"] != ''){
            			
            			$ret = $serv->approveTerminalIDPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"],$_REQUEST["msisdn"],$_REQUEST["newmsisdn"],$_REQUEST["terminalid"]);
            			
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			exit;
            			
            		}else{
            			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Terminal ID not valid for approval.")));
            		}
            	}else if (isset($_REQUEST["remarks"]) && $_REQUEST["remarks"] == 'REJECT'){
            		if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != '' && $_REQUEST["msisdn"] != '' && $_REQUEST["terminalid"] != ''){
            			
            			$ret = $serv->approveTerminalIDPndg($_SESSION["currentUser"], $_REQUEST["remarks"], $_REQUEST["id"],$_REQUEST["msisdn"],$_REQUEST["newmsisdn"],$_REQUEST["terminalid"]);
            			
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			exit;
            			
            		}else{
            			echo json_encode(array("ResponseCode"=>1,"Message"=>_("Terminal ID not valid for approval.")));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Terminal ID not valid for approval.")));
            	}
            	
            	break;
            	
            	
            	
            	case "addKeyAllowedType":
            	if($_REQUEST['type']!="" && $_REQUEST['key']!="" && $_REQUEST['send']!="" && $_REQUEST['receive']!="" && $_REQUEST['priority']!="" & $_REQUEST['description']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['send'])){$valid=false;$validationMessage=_("Please input a valid send.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['receive'])){$valid=false;$validationMessage=_("Please input a valid receive.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['description'])){$valid=false;$validationMessage=_("Please input a valid description.");}
            		
            		
            		if($valid){
            			$ret = $serv->addKeyAllowedType($_REQUEST['type'],$_REQUEST['key'],$_REQUEST['send'],$_REQUEST['receive'],$_REQUEST['priority'],$_REQUEST['description']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Key Allowed Type has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestKeyAllowedType":
            	if($_REQUEST['id']!="" && $_REQUEST['type']!="" && $_REQUEST['key']!="" && $_REQUEST['send']!="" && $_REQUEST['receive']!="" && $_REQUEST['priority']!="" & $_REQUEST['description']!="" && $_REQUEST['status']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['send'])){$valid=false;$validationMessage=_("Please input a valid send.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['receive'])){$valid=false;$validationMessage=_("Please input a valid receive.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['description'])){$valid=false;$validationMessage=_("Please input a valid description.");}
            		
            		
            		if($valid){
            			$ret = $serv->requestKeyAllowedType($_REQUEST['id'],$_REQUEST['type'],$_REQUEST['key'],$_REQUEST['send'],$_REQUEST['receive'],$_REQUEST['priority'],$_REQUEST['description'],$_REQUEST['status'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Key Allowed Type has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addKeyAllowedMSISDN":
            	if($_REQUEST['msisdn']!="" && $_REQUEST['key']!="" && $_REQUEST['send']!="" && $_REQUEST['receive']!="" && $_REQUEST['priority']!="" & $_REQUEST['description']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['send'])){$valid=false;$validationMessage=_("Please input a valid send.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['receive'])){$valid=false;$validationMessage=_("Please input a valid receive.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['description'])){$valid=false;$validationMessage=_("Please input a valid description.");}
            		
            		
            		if($valid){
            			$ret = $serv->addKeyAllowedMSISDN($_REQUEST['msisdn'],$_REQUEST['key'],$_REQUEST['send'],$_REQUEST['receive'],$_REQUEST['priority'],$_REQUEST['description']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Key Allowed MSISDN has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestKeyAllowedMSISDN":
            	if($_REQUEST['id']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['key']!="" && $_REQUEST['send']!="" && $_REQUEST['receive']!="" && $_REQUEST['priority']!="" & $_REQUEST['description']!="" && $_REQUEST['status']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['send'])){$valid=false;$validationMessage=_("Please input a valid send.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['receive'])){$valid=false;$validationMessage=_("Please input a valid receive.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['description'])){$valid=false;$validationMessage=_("Please input a valid description.");}
            		
            		
            		if($valid){
            			$ret = $serv->requestKeyAllowedMSISDN($_REQUEST['id'],$_REQUEST['msisdn'],$_REQUEST['key'],$_REQUEST['send'],$_REQUEST['receive'],$_REQUEST['priority'],$_REQUEST['description'],$_REQUEST['status'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Key Allowed MSISDN has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectKeyAllowedType":
            	if($_REQUEST['pndgid']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['pndgid'])){$valid=false;$validationMessage=_("Please input a valid pending id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectKeyAllowedType($_REQUEST['pndgid'],$_REQUEST['remarks'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectKeyAllowedMSISDN":
            	if($_REQUEST['pndgid']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['pndgid'])){$valid=false;$validationMessage=_("Please input a valid pending id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectKeyAllowedMSISDN($_REQUEST['pndgid'],$_REQUEST['remarks'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;
            	
            	case "requestKeyCostMSISDN":
            	if($_REQUEST['id']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input valid account.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixed'])){$valid=false;$validationMessage=_("Please input valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percent'])){$valid=false;$validationMessage=_("Please input valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input valid status.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input valid account to.");}
            		
            		if($valid){
            			$ret = $serv->requestKeyCostMSISDN($_REQUEST['id'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['account'],$_REQUEST['fixed'],$_REQUEST['percent'],$_REQUEST['priority'],$_REQUEST['status'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Key Cost MSISDN has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addKeyCostMSISDN";
            	if($_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['account']!="" && $_REQUEST['fixed']!="" && $_REQUEST['percent']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!=""){
            		$valid=true;
            		$validationMessage="";
            		if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input valid account.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['fixed'])){$valid=false;$validationMessage=_("Please input valid fixed amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['percent'])){$valid=false;$validationMessage=_("Please input valid percent amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input valid amount from.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input valid amount to.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input valid account from.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input valid account to.");}
            		
            		if($valid){
            			$ret = $serv->addKeyCostMSISDN($_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['account'],$_REQUEST['fixed'],$_REQUEST['percent'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Key Cost MSISDN has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectKeyCostMSISDN":
            	if($_REQUEST['pndgid']!="" && $_REQUEST['remarks']!=""){
            		$valid = true;
            		$validationMessage = "";
            		if(!$dataV->CheckNumeric($_REQUEST['pndgid'])){$valid=false;$validationMessage=_("Please input a valid pending id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
            		
            		if($valid){
            			$ret  = $serv->approveRejectKeyCostMSISDN($_REQUEST['pndgid'],$_REQUEST['remarks']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
            			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addAMLMSISDNSend":
            	if($_REQUEST['msisdn']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['minAmount']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['minAmount'])){$valid=false;$validationMessage=_("Please input a valid min.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}

            		if($valid){
            			$ret  = $serv->addAMLMSISDNSend($_REQUEST['msisdn'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['minAmount'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("AML MSISDN-Send has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addAMLMSISDNReceive":
            	if($_REQUEST['msisdn']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!="" && $_REQUEST['maxCurrentAmount']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxCurrentAmount'])){$valid=false;$validationMessage=_("Please input a valid max.current amount.");}

            		if($valid){
            			$ret  = $serv->addAMLMSISDNReceive($_REQUEST['msisdn'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth'],$_REQUEST['maxCurrentAmount']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("AML MSISDN-Send has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestAMLMSISDNSend":
            	if($_REQUEST['id']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['minAmount']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['minAmount'])){$valid=false;$validationMessage=_("Please input a valid min.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}

            		if($valid){
            			$ret  = $serv->requestAMLMSISDNSend($_REQUEST['id'],$_REQUEST['msisdn'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['minAmount'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request AML MSISDN-Send has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestAMLMSISDNReceive":
            	if($_REQUEST['id']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!="" && $_REQUEST['maxCurrentAmount']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxCurrentAmount'])){$valid=false;$validationMessage=_("Please input a valid max.current amount.");}

            		if($valid){
            			$ret  = $serv->requestAMLMSISDNReceive($_REQUEST['id'],$_REQUEST['msisdn'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth'],$_REQUEST['maxCurrentAmount']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("AML MSISDN-Receive has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "approveRejectAMLMSISDNPndg":
            	if($_REQUEST["pndgid"] != '' && $_REQUEST["remarks"] != ''){
            		$ret = $serv->approveRejectAMLMSISDNPndg($_REQUEST["remarks"], $_REQUEST["pndgid"],$_SESSION['currentUser']);
            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            		echo  json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		exit;	
            	}else{
            		echo "AML Type not valid for approval.";
            	}
            	break;

            	case "addAMLTypeSend":
            	if($_REQUEST['type']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['minAmount']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['minAmount'])){$valid=false;$validationMessage=_("Please input a valid min.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}

            		if($valid){
            			$ret  = $serv->addAMLTypeSend($_REQUEST['type'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['minAmount'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("AML Type-Send has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "addAMLTypeReceive":
            	if($_REQUEST['type']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!="" && $_REQUEST['maxCurrentAmount']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxCurrentAmount'])){$valid=false;$validationMessage=_("Please input a valid max.current amount.");}

            		if($valid){
            			$ret  = $serv->addAMLTypeReceive($_REQUEST['type'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth'],$_REQUEST['maxCurrentAmount']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("AML Type-Receive has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestAMLTypeSend":
            	if($_REQUEST['id']!="" && $_REQUEST['type']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['minAmount']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['minAmount'])){$valid=false;$validationMessage=_("Please input a valid min.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}

            		if($valid){
            			$ret  = $serv->requestAMLTypeSend($_REQUEST['id'],$_REQUEST['type'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['minAmount'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request AML Type-Send has been successfully sent.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "requestAMLTypeReceive":
            	if($_REQUEST['id']!="" && $_REQUEST['type']!="" && $_REQUEST['key']!="" && $_REQUEST['priority']!="" && $_REQUEST['maxAmount']!="" && $_REQUEST['maxAmountDay']!="" && $_REQUEST['maxAmountMonth']!="" && $_REQUEST['maxTransDay']!="" && $_REQUEST['maxTransMonth']!="" && $_REQUEST['maxCurrentAmount']!=""){
            		$valid = true;
            		$validationMessage = "";

            		if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
            		else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid priority.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmount'])){$valid=false;$validationMessage=_("Please input a valid max.amount.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountDay'])){$valid=false;$validationMessage=_("Please input a valid max.amount / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxAmountMonth'])){$valid=false;$validationMessage=_("Please input a valid max.amount / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransDay'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / day.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxTransMonth'])){$valid=false;$validationMessage=_("Please input a valid max.transaction / month.");}
            		else if(!$dataV->CheckNumeric($_REQUEST['maxCurrentAmount'])){$valid=false;$validationMessage=_("Please input a valid max.current amount.");}

            		if($valid){
            			$ret  = $serv->requestAMLTypeReceive($_REQUEST['id'],$_REQUEST['type'],$_REQUEST['key'],$_REQUEST['priority'],$_REQUEST['maxAmount'],$_REQUEST['maxAmountDay'],$_REQUEST['maxAmountMonth'],$_REQUEST['maxTransDay'],$_REQUEST['maxTransMonth'],$_REQUEST['maxCurrentAmount']);
            			if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
            			if($ret->ResponseCode == 0 ){
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("AML Type-Receive has been successfully added.")));
            			}else{
            				echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            			}
            		}else{
            			echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
            		}
            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
            	}
            	break;

            	case "allocateB2W":
            	
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if(!$dataV->CheckAlpha($_REQUEST["REMARKS"])){
            		$validation = false;
            		$validationMessage = "Please input valid format for REMARKS.";
            	}
            	
            	if ($_REQUEST["REMARKS"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input REMARKS!");
            	}
            	if ($_REQUEST["AMOUNT"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input AMOUNT!");
            	}
            	if ($_REQUEST["MSISDN"] == ''){
            		$validation = false;
            		$validationMessage = _("Not valid for allocation B2W.");
            	}
            	if ($_REQUEST["BANKREFERENCE"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input BANKREFERENCE!");
            	}
            	
            	if($validation){
            		
            		$ret = $serv->allocateB2W($_REQUEST["MSISDN"],$_REQUEST["AMOUNT"],$_SESSION["currentUser"],$_REQUEST["REMARKS"],$_REQUEST["BANKREFERENCE"],$_SESSION['imageB2W']);
            		
            		if(isset($ret->Token)){
            			$_SESSION["token"] = $ret->Token;
            		}
            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            			session_destroy();
            		}
            		if($ret->ResponseCode == 0){
            			echo _("Success Bank to Wallet request, please wait for the confirmation and approval");
            		}else{
            			echo $ret->Message;
            		}
            		
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "confirmAllocationB2WCheck":
            	/*data validation*/
            	
            	if ($_REQUEST["msisdn"] == '' || $_REQUEST["transactionid"] == '' || $_REQUEST["value"] == '' || $_REQUEST["alloctype"] == '' || $_REQUEST["amount"] == ''){
            		
            		echo _("Bank to Wallet Allocation not valid for confirmation!");
            	}else{
            		$_SESSION["allocMSISDNBankConfirm"] = $_REQUEST["msisdn"];
            		$_SESSION["allocTRANSIDBankConfirm"] = $_REQUEST["transactionid"];
            		$_SESSION["allocVALUEBankConfirm"] = $_REQUEST["value"];
            		$_SESSION["allocTYPEBankConfirm"] = $_REQUEST["alloctype"];
            		if($_REQUEST["value"] == 'CONFIRM'){
            			echo _("Confirm Bank to Wallet Allocate an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		}else{
            			echo _("Reject? Please enter your password.");
            		}
            		
            	}
            	
            	break;
            	
            	case "confirmAllocationB2W":
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if ($_SESSION["allocTRANSIDBankConfirm"] == '' || $_SESSION["allocVALUEBankConfirm"] == '' || $_SESSION["allocMSISDNBankConfirm"] == ''){
            		$validation = false;
            		$validationMessage = _("Bank to Wallet Allocation not valid for confirmation!");
            	}
            	
            	if($validation){
            		if($_SESSION["allocVALUEBankConfirm"] == "CONFIRM"){
            			$ret = $serv->confirmAllocationB2W($_SESSION["currentUser"], $_SESSION["allocMSISDNBankConfirm"], $_SESSION["allocVALUEBankConfirm"],$_SESSION["allocTRANSIDBankConfirm"]);						
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully confirmed bank to wallet allocate an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNBankConfirm"] . ". Please wait for bank approval.";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEBankConfirm"] == "REJECT"){
            			$ret = $serv->confirmAllocationB2W($_SESSION["currentUser"], $_SESSION["allocMSISDNBankConfirm"], $_SESSION["allocVALUEBankConfirm"],$_SESSION["allocTRANSIDBankConfirm"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully rejected bank to wallet allocate! Amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNBankConfirm"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}
            		$_SESSION["allocMSISDNBankConfirm"] = "";
            		$_SESSION["allocTRANSIDBankConfirm"] = "";
            		$_SESSION["allocVALUEBankConfirm"] = "";
            		$_SESSION["allocTYPEBankConfirm"] = "";
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "confirmAllocationW2BCheck":
            	/*data validation*/
            	
            	if ($_REQUEST["msisdn"] == '' || $_REQUEST["transactionid"] == '' || $_REQUEST["value"] == '' || $_REQUEST["alloctype"] == '' || $_REQUEST["amount"] == ''){
            		
            		echo _("Wallet to Bank Allocation not valid for confirmation!");
            	}else{
            		$_SESSION["allocMSISDNWalletBankConfirm"] = $_REQUEST["msisdn"];
            		$_SESSION["allocTRANSIDWalletBankConfirm"] = $_REQUEST["transactionid"];
            		$_SESSION["allocVALUEWalletBankConfirm"] = $_REQUEST["value"];
            		$_SESSION["allocTYPEWalletBankConfirm"] = $_REQUEST["alloctype"];
            		if($_REQUEST["value"] == 'CONFIRM'){
            			echo _("Confirm Wallet to Bank Allocate an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		}else{
            			echo _("Reject? Please enter your password.");
            		}
            		
            	}
            	
            	break;
            	
            	case "confirmAllocationW2B":
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if ($_SESSION["allocTRANSIDWalletBankConfirm"] == '' || $_SESSION["allocVALUEWalletBankConfirm"] == '' || $_SESSION["allocMSISDNWalletBankConfirm"] == ''){
            		$validation = false;
            		$validationMessage = _("Wallet to Bank Allocation not valid for confirmation!");
            	}
            	
            	if($validation){
            		if($_SESSION["allocVALUEWalletBankConfirm"] == "CONFIRM"){
            			$ret = $serv->confirmAllocationW2B($_SESSION["currentUser"], $_SESSION["allocMSISDNWalletBankConfirm"], $_SESSION["allocVALUEWalletBankConfirm"],$_SESSION["allocTRANSIDWalletBankConfirm"]);						
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully confirmed wallet to bank allocate an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNWalletBankConfirm"] . ". Please wait for bank approval.";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEWalletBankConfirm"] == "REJECT"){
            			$ret = $serv->confirmAllocationW2B($_SESSION["currentUser"], $_SESSION["allocMSISDNWalletBankConfirm"], $_SESSION["allocVALUEWalletBankConfirm"],$_SESSION["allocTRANSIDWalletBankConfirm"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully rejected wallet to bank allocate! Amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNWalletBankConfirm"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}
            		$_SESSION["allocMSISDNWalletBankConfirm"] = "";
            		$_SESSION["allocTRANSIDWalletBankConfirm"] = "";
            		$_SESSION["allocVALUEWalletBankConfirm"] = "";
            		$_SESSION["allocTYPEWalletBankConfirm"] = "";
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "approveAllocationB2WCheck":
            	/*data validation*/
            	
            	if ($_REQUEST["msisdn"] == '' || $_REQUEST["transactionid"] == '' || $_REQUEST["value"] == '' || $_REQUEST["alloctype"] == '' || $_REQUEST["amount"] == '' || $_REQUEST["bankref"] == ''){
            		
            		echo _("Bank to Wallet Allocation not valid for approval!");
            	}else{
            		$_SESSION["allocMSISDNBankApprove"] = $_REQUEST["msisdn"];
            		$_SESSION["allocTRANSIDBankApprove"] = $_REQUEST["transactionid"];
            		$_SESSION["allocVALUEBankApprove"] = $_REQUEST["value"];
            		$_SESSION["allocTYPEBankApprove"] = $_REQUEST["alloctype"];
            		$_SESSION["bankrefBankApprove"] = $_REQUEST["bankref"];
            		if($_REQUEST["value"] == 'APPROVE'){
            			echo _("Approve Bank to Wallet Allocate an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		}else{
            			echo _("Reject? Please enter your password.");
            		}
            		
            	}
            	
            	break;
            	
            	case "approveAllocationB2W":
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if ($_SESSION["allocTRANSIDBankApprove"] == '' || $_SESSION["allocVALUEBankApprove"] == '' || $_SESSION["allocMSISDNBankApprove"] == ''){
            		$validation = false;
            		$validationMessage = _("Bank to Wallet Allocation not valid for approval!");
            	}
            	
            	if($validation){
            		if($_SESSION["allocVALUEBankApprove"] == "APPROVE"){
            			$ret = $serv->approveAllocationB2W($_SESSION["currentUser"], $_SESSION["allocMSISDNBankApprove"], $_SESSION["allocVALUEBankApprove"],$_SESSION["allocTRANSIDBankApprove"],$_SESSION["bankrefBankApprove"]);						
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully approved bank to wallet allocate an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNBankApprove"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEBankApprove"] == "REJECT"){
            			$ret = $serv->approveAllocationB2W($_SESSION["currentUser"], $_SESSION["allocMSISDNBankApprove"], $_SESSION["allocVALUEBankApprove"],$_SESSION["allocTRANSIDBankApprove"],$_SESSION["bankrefBankApprove"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully rejected bank to wallet allocate! Amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNBankApprove"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}
            		$_SESSION["allocMSISDNBankApprove"] = "";
            		$_SESSION["allocTRANSIDBankApprove"] = "";
            		$_SESSION["allocVALUEBankApprove"] = "";
            		$_SESSION["allocTYPEBankApprove"] = "";
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "approveAllocationW2BCheck":
            	/*data validation*/
            	
            	if ($_REQUEST["msisdn"] == '' || $_REQUEST["transactionid"] == '' || $_REQUEST["value"] == '' || $_REQUEST["alloctype"] == '' || $_REQUEST["amount"] == ''){
            		
            		echo _("Wallet to Bank Allocation not valid for approval!");
            	}else{
            		$_SESSION["allocMSISDNWalletBankApprove"] = $_REQUEST["msisdn"];
            		$_SESSION["allocTRANSIDWalletBankApprove"] = $_REQUEST["transactionid"];
            		$_SESSION["allocVALUEWalletBankApprove"] = $_REQUEST["value"];
            		$_SESSION["allocTYPEWalletBankApprove"] = $_REQUEST["alloctype"];
            		$_SESSION["accountnumber"] = $_REQUEST["accountnumber"];
            		$_SESSION["bank"] = $_REQUEST["bank"];
            		$_SESSION["reference"] = $_REQUEST["reference"];
            		if($_REQUEST["value"] == 'APPROVE'){
            			echo _("Approve Wallet to Bank Allocate an amount of ") . $_REQUEST["amount"] . " to " . $_REQUEST["msisdn"] . " ?";
            		}else{
            			echo _("Reject? Please enter your password.");
            		}
            		
            	}
            	
            	break;
            	
            	case "approveAllocationW2B":
            	/*data validation*/
            	$validation = true;
            	$validationMessage = "";
            	if ($_SESSION["currentPassword"] != $_REQUEST["PASSWORD"]){
            		$validation = false;
            		$validationMessage = _("Please input your correct PASSWORD!");
            	}
            	if ($_REQUEST["PASSWORD"] == ''){
            		$validation = false;
            		$validationMessage = _("Please input your PASSWORD!");
            	}
            	if ($_SESSION["allocTRANSIDWalletBankApprove"] == '' || $_SESSION["allocVALUEWalletBankApprove"] == '' || $_SESSION["allocMSISDNWalletBankApprove"] == ''){
            		$validation = false;
            		$validationMessage = _("Wallet to Bank Allocation not valid for approval!");
            	}
            	
            	if($validation){
            		if($_SESSION["allocVALUEWalletBankApprove"] == "APPROVE"){
            			$ret = $serv->approveAllocationW2B($_SESSION["currentUser"], $_SESSION["allocMSISDNWalletBankApprove"], $_SESSION["allocVALUEWalletBankApprove"],$_SESSION["allocTRANSIDWalletBankApprove"], $_SESSION["accountnumber"], $_SESSION["bank"], $_SESSION["reference"]);						
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully approved wallet to bank allocate an amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNWalletBankApprove"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}else if($_SESSION["allocVALUEWalletBankApprove"] == "REJECT"){
            			$ret = $serv->approveAllocationW2B($_SESSION["currentUser"], $_SESSION["allocMSISDNWalletBankApprove"], $_SESSION["allocVALUEWalletBankApprove"],$_SESSION["allocTRANSIDWalletBankApprove"], $_SESSION["accountnumber"], $_SESSION["bank"], $_SESSION["reference"]);
            			
            			if(isset($ret->Token)){
            				$_SESSION["token"] = $ret->Token;
            			}
            			
            			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            				session_destroy();
            			}
            			if($ret->ResponseCode == 0 ){
            				echo _("You have successfully rejected wallet to bank allocate! Amount of ") . $ret->Message . " to " . $_SESSION["allocMSISDNWalletBankApprove"] . ".";
            			}else{
            				echo $ret->Message;
            			}
            			
            			exit;
            		}
            		$_SESSION["allocMSISDNWalletBankApprove"] = "";
            		$_SESSION["allocTRANSIDWalletBankApprove"] = "";
            		$_SESSION["allocVALUEWalletBankApprove"] = "";
            		$_SESSION["allocTYPEWalletBankApprove"] = "";
            		$_SESSION["accountnumber"] = "";
            		$_SESSION["bank"] = "";
            		$_SESSION["reference"] = "";
            	}else{
            		echo $validationMessage;
            	}
            	break;
            	
            	case "approveRejectCommissionsPending":
            	if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){

            		$ret = $serv->approveRejectCommissionsPending($_REQUEST["id"], $_REQUEST["remarks"], $_SESSION["currentUser"], $_REQUEST["fromdate"], $_REQUEST["todate"]);						

            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


            		echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		exit;

            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Dealer Commission not valid for approval.")));
            	}
            	break;
            	
            	case "approveRejectCommissionsPendingForConfirmation":
            	if($_REQUEST["id"] != '' && $_REQUEST["remarks"] != ''){

            		$ret = $serv->approveRejectCommissionsPendingForConfirmation($_REQUEST["id"], $_REQUEST["remarks"], $_SESSION["currentUser"], $_REQUEST["fromdate"], $_REQUEST["todate"]);						

            		if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


            		if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


            		echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
            		exit;

            	}else{
            		echo json_encode(array("ResponseCode"=>1,"Message"=>_("Dealer Commission not valid for confirmation.")));
            	}
            	break;
            	
            	case "getAllocationB2WPndgIMAGE":
            	$ret = $serv->getAllocationB2WPndgIMAGE($_SESSION["currentUser"], $_REQUEST["referenceid"]);
            	
            	if(isset($ret->Token)){
            		$_SESSION["token"] = $ret->Token;
            	}
            	if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
            		session_destroy();
            	}
            	
            	
            	echo "<div class='row-fluid'><div class='span6' style='float:left;margin-top:10px;margin-bottom:10px'><img src='data:image/jpeg;base64,".($ret->Value[0]->IMAGE)."' width='800'/></div></div>";
				/* 
				$arr = array("Result"=>$ret);
				echo json_encode($arr); */
				break;
				
				case "getIdIMAGE":
				$ret = $serv->getIdIMAGE($_SESSION["currentUser"], $_REQUEST["msisdn"]);
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
					// $pdf = fopen ('test1.pdf','w');
					// fwrite ($pdf, base64_decode($ret->Value[0]->IMAGE));
					// fclose ($pdf);
				
					/* $binary = base64_decode($ret->Value[0]->IMAGE);
					header('Content-type: application/pdf');
					header('Content-Disposition: attachment; filename="my.pdf"');
					echo $binary; */
					echo "<div class='row-fluid'><div class='span6' style='float:left;margin-top:10px;margin-bottom:10px'><img src='data:image/jpeg;base64,".($ret->Value[0]->IMAGE)."' width='600'/></div></div>";
					
					exit;
					break;
					
					case "getIdIMAGESMB":
					$ret = $serv->getIdIMAGESMB($_SESSION["currentUser"], $_REQUEST["msisdn"]);
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					// $pdf = fopen ('test1.pdf','w');
					// fwrite ($pdf, base64_decode($ret->Value[0]->IMAGE));
					// fclose ($pdf);
					
					/* $binary = base64_decode($ret->Value[0]->IMAGE);
					header('Content-type: application/pdf');
					header('Content-Disposition: attachment; filename="my.pdf"');
					echo $binary; */
					echo "<div class='row-fluid'><div class='span6' style='float:left;margin-top:10px;margin-bottom:10px'><img src='data:image/jpeg;base64,".($ret->Value[0]->IMAGE)."' width='600'/></div></div>";
					
					exit;
					break;
					
					case "getIdIMAGEMAI":
					$ret = $serv->getIdIMAGEMAI($_SESSION["currentUser"], $_REQUEST["image"],$_REQUEST["msisdn"]);
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}

					echo "<div class='row-fluid'><div class='span6' style='float:left;margin-top:10px;margin-bottom:10px'><img src='data:image/jpeg;base64,".($ret->Value[0]->IMAGE)."' width='600'/></div></div>";
					
					exit;
					break;

					case "getIdIMAGEMAIBANK":
					$ret = $serv->getIdIMAGEMAIBANK($_SESSION["currentUser"],$_REQUEST["image"],$_REQUEST["msisdn"]);
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}

					echo "<div class='row-fluid'><div class='span6' style='float:left;margin-top:10px;margin-bottom:10px'><img src='data:image/jpeg;base64,".($ret->Value[0]->IMAGE)."' width='600'/></div></div>";
					
					exit;
					break;



					case "globalSearchSMS":
					$ret = $serv->globalSearchSMS($_REQUEST["message"],$_REQUEST["referenceid"],$_REQUEST["msisdn"]);
					header('Content-Type: text/javascript');
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
					break;
					
					case "approveRejectCommissions1PendingForConfirmation":
					if($_REQUEST["remarks"] != ''){

						$ret = $serv->approveRejectCommissions1PendingForConfirmation($_REQUEST["remarks"], $_SESSION["currentUser"], $_REQUEST["fromdate"], $_REQUEST["todate"], $_REQUEST["commissionType"], 2);						

						if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


						echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						exit;

					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("Dealer Commission not valid for confirmation request.")));
					}
					break;
					
					case "approveRejectCommissions1PendingForApproval":
					if($_REQUEST["remarks"] != ''){

						$ret = $serv->approveRejectCommissions1PendingForApproval($_REQUEST["remarks"], $_SESSION["currentUser"], $_REQUEST["fromdate"], $_REQUEST["todate"], $_REQUEST["commissionType"], 2);						

						if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


						echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						exit;

					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("Dealer Commission not valid for approval.")));
					}
					break;
					
					case "approveRejectCommissionsForConfirmation":
					if($_REQUEST["remarks"] != ''){

						$ret = $serv->approveRejectCommissionsForConfirmation($_REQUEST["remarks"], $_SESSION["currentUser"], $_REQUEST["runid"]);						

						if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


						echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						exit;

					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("Dealer Commission not valid for confirmation.")));
					}
					break;
					
					case "approveRejectCommissionsForApproval":
					if($_REQUEST["remarks"] != ''){

						$ret = $serv->approveRejectCommissionsForApproval($_REQUEST["remarks"], $_SESSION["currentUser"], $_REQUEST["runid"]);						

						if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}


						echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						exit;

					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("Dealer Commission not valid for approval.")));
					}
					break;
					
					case "updateIdIMAGE":
					if($_REQUEST["msisdn"] != '' && $_SESSION["imageB2W"] != ''){

						$ret = $serv->updateIdIMAGE($_REQUEST["msisdn"], $_SESSION["imageB2W"], $_SESSION["currentUser"]);						

						if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}


						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}

						if($ret->ResponseCode == 0){
							echo $ret->Message;
						}else{
							echo $ret->Message;
						}

						exit;

					}else{
						echo _("ID Image not valid for update.");
					}
					break;
					
					case "requestBonusAirByType":
					if($_REQUEST['id']!="" && $_REQUEST['status']!="" && $_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
						$valid = true;
						$validationMessage = "";

						if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
						else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
						else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
						else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
						else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
						else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
						
						if($valid){
							$ret = $serv->requestBonusAirByType($_REQUEST['id'],$_REQUEST['status'],$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
							if($ret->ResponseCode == 0 ){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Bonus by Type has been successfully sent.")));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}
						}else{
							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					break;

					case "requestBonusAirByMSISDN":
					if($_REQUEST['id']!="" && $_REQUEST['status']!="" && $_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
						$valid = true;
						$validationMessage = "";

						if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
						else if(!$dataV->CheckNumeric($_REQUEST['status'])){$valid=false;$validationMessage=_("Please input a valid status.");}
						else if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
						else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
						else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
						else if(!$dataV->CheckAlpha($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
						else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
						
						if($valid){
							$ret = $serv->requestBonusAirByMSISDN($_REQUEST['id'],$_REQUEST['status'],$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo'],$_SESSION['currentUser']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
							if($ret->ResponseCode == 0 ){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Request Bonus by MSISDN has been successfully sent.")));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}
						}else{
							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					break;
					
					case "addBonusAirByType":
					if($_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['type']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
						$valid = true;
						$validationMessage = "";

						if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
						else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
						else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
						else if(!$dataV->CheckAlpha($_REQUEST['type'])){$valid=false;$validationMessage=_("Please input a valid type.");}
						else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
						
						if($valid){
							$ret = $serv->addBonusAirByType('0',$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['type'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
							if($ret->ResponseCode == 0 ){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Bonus by Type has been successfully added.")));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}
						}else{
							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					break;

					case "addBonusAirByMSISDN":
					if($_REQUEST['account']!="" && $_REQUEST['name']!="" && $_REQUEST['key']!="" && $_REQUEST['msisdn']!="" && $_REQUEST['fixedAmount']!="" && $_REQUEST['percentAmount']!="" && $_REQUEST['priority']!="" && $_REQUEST['amountFrom']!="" && $_REQUEST['amountTo']!="" && $_REQUEST['accountFrom']!="" && $_REQUEST['accountTo']!=""){
						$valid = true;
						$validationMessage = "";

						if(!$dataV->CheckAlpha($_REQUEST['account'])){$valid=false;$validationMessage=_("Please input a valid account.");}
						else if(!$dataV->CheckAlpha($_REQUEST['name'])){$valid=false;$validationMessage=_("Please input a valid name.");}
						else if(!$dataV->CheckAlpha($_REQUEST['key'])){$valid=false;$validationMessage=_("Please input a valid key.");}
						else if(!$dataV->CheckNumeric($_REQUEST['msisdn'])){$valid=false;$validationMessage=_("Please input a valid msisdn.");}
						else if(!$dataV->CheckNumeric($_REQUEST['fixedAmount'])){$valid=false;$validationMessage=_("Please input a valid fixed amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['percentAmount'])){$valid=false;$validationMessage=_("Please input a valid percent amount.");}
						else if(!$dataV->CheckNumeric($_REQUEST['priority'])){$valid=false;$validationMessage=_("Please input a valid percent priority.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountFrom'])){$valid=false;$validationMessage=_("Please input a valid amount from.");}
						else if(!$dataV->CheckNumeric($_REQUEST['amountTo'])){$valid=false;$validationMessage=_("Please input a valid amount to.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountFrom'])){$valid=false;$validationMessage=_("Please input a valid account from.");}
						else if(!$dataV->CheckAlpha($_REQUEST['accountTo'])){$valid=false;$validationMessage=_("Please input a valid account to.");}
						
						if($valid){
							$ret = $serv->addBonusAirByMSISDN('0',$_REQUEST['account'],$_REQUEST['name'],$_REQUEST['key'],$_REQUEST['msisdn'],$_REQUEST['fixedAmount'],$_REQUEST['percentAmount'],$_REQUEST['priority'],$_REQUEST['amountFrom'],$_REQUEST['amountTo'],$_REQUEST['accountFrom'],$_REQUEST['accountTo']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
							if($ret->ResponseCode == 0 ){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Bonus by MSISDN has been successfully added.")));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}
						}else{
							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					break;
					
					case "mPosItemUpdate":
					if($_REQUEST['itemcode']!="" && $_REQUEST['itemname']!="" && $_REQUEST['unitcode']!="" && $_REQUEST['priceperunit']!="" && $_REQUEST['subvention']!="" && $_REQUEST['barcode']!="" ){
						$valid = true;
						$validationMessage = "";

						if(!$dataV->CheckAlpha($_REQUEST['itemname'])){$valid=false;$validationMessage=_("Please input a valid item name.");}
						else if(!$dataV->CheckNumeric($_REQUEST['itemcode'])){$valid=false;$validationMessage=_("Please input a valid item code.");}
						else if(!$dataV->CheckNumeric($_REQUEST['unitcode'])){$valid=false;$validationMessage=_("Please input a valid unit code.");}
						else if(!$dataV->CheckNumeric($_REQUEST['priceperunit'])){$valid=false;$validationMessage=_("Please input a valid price per unit.");}
						else if(!$dataV->CheckNumeric($_REQUEST['subvention'])){$valid=false;$validationMessage=_("Please input a valid subvention.");}
						else if(!$dataV->CheckNumeric($_REQUEST['barcode'])){$valid=false;$validationMessage=_("Please input a valid barcode.");}
						
						if($valid){
							$ret = $serv->mPosItemUpdate($_REQUEST['itemcode'],$_REQUEST['itemname'],$_REQUEST['unitcode'],$_REQUEST['priceperunit'],$_REQUEST['subvention'],$_REQUEST['barcode']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
							if($ret->ResponseCode == 0 ){
								echo _("Item has been successfully updated.");
							}else{
								echo $ret->Message;
							}
						}else{
							echo $validationMessage;
						}
					}else{
						echo _("Please fill-up all the required fields.");
					}
					break;
					case "mPosItemAdd":

					if($_REQUEST['itemname']!="" && $_REQUEST['itemcode']!="" && $_REQUEST['unitcode']!="" && $_REQUEST['unit']!="" && $_REQUEST['price']!="" && $_REQUEST['subvention']!="" && $_REQUEST['barcode']!="" && $_REQUEST['validitycode']!="" ){
						$valid=true;

						$validationMessage="";
						if(!$dataV->CheckAlpha($_REQUEST['itemname'])){$valid=false;$validationMessage=_("Please input valid item name.");}	            	
						else if(!$dataV->CheckNumeric($_REQUEST['itemcode'])){$valid=false;$validationMessage=_("Please input valid item code.");}
						else if(!$dataV->CheckNumeric($_REQUEST['unitcode'])){$valid=false;$validationMessage=_("Please input valid unit code.");}
						else if(!$dataV->CheckNumeric($_REQUEST['price'])){$valid=false;$validationMessage=_("Please input valid price.");}
						else if(!$dataV->CheckNumeric($_REQUEST['subvention'])){$valid=false;$validationMessage=_("Please input valid subvention.");}
						else if(!$dataV->CheckNumeric($_REQUEST['barcode'])){$valid=false;$validationMessage=_("Please input valid barcode.");}
						else if(!$dataV->CheckNumeric($_REQUEST['validitycode'])){$valid=false;$validationMessage=_("Please input valid validity code.");}
						else if(!$dataV->CheckAlpha($_REQUEST['unit'])){$valid=false;$validationMessage=_("Please input valid unit.");}
						
						if($valid){

							$ret = $serv->mPosItemAdd($_REQUEST['itemcode'],$_REQUEST['itemname'],$_REQUEST['unitcode'],$_REQUEST['price'],$_REQUEST['subvention'],$_REQUEST['barcode'],$_REQUEST['unit'],$_REQUEST['validitycode']);

							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}

							if($ret->ResponseCode == 14){session_destroy();}

							if($ret->ResponseCode == 0 ){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("MPOS items has been successfully added.")));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}
						}else{

							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{

						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					
					break;
					case "approveRejectBonusAirByTypePending":
					if($_REQUEST['id']!="" && $_REQUEST['remarks']!=""){
						$valid = true;
						$validationMessage = "";
						if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
						else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
						
						if($valid){
							$ret  = $serv->approveRejectBonusAirByTypePending($_SESSION['currentUser'],$_REQUEST['id'],$_REQUEST['remarks']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
							echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
						}else{
							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					break;
					case "approveRejectBonusAirByMSISDNPending":
					if($_REQUEST['id']!="" && $_REQUEST['remarks']!=""){
						$valid = true;
						$validationMessage = "";
						if(!$dataV->CheckNumeric($_REQUEST['id'])){$valid=false;$validationMessage=_("Please input a valid id.");}
						else if(!$dataV->CheckAlpha($_REQUEST['remarks'])){$valid=false;$validationMessage=_("Please input a valid remarks.");}
						
						if($valid){
							$ret  = $serv->approveRejectBonusAirByMSISDNPending($_REQUEST['id'],$_REQUEST['remarks'],$_SESSION['currentUser']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}						
							echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));						
						}else{
							echo json_encode(array("ResponseCode"=>2,"Message"=>$validationMessage));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>"Please fill-up all the required fields."));
					}
					break;
					case "mPosTBLNBECONFIGUpdate":
					if($_REQUEST['url']!="" && $_REQUEST['port']!="" && $_REQUEST['header']!="" && $_REQUEST['forcepin']!="" && $_REQUEST['cvm']!="" ){
						$valid = true;
						$validationMessage = "";

						if(!$dataV->CheckAlpha($_REQUEST['url'])){$valid=false;$validationMessage=_("Please input a valid url.");}
						else if(!$dataV->CheckNumeric($_REQUEST['port'])){$valid=false;$validationMessage=_("Please input a valid port.");}
						else if(!$dataV->CheckNumeric($_REQUEST['header'])){$valid=false;$validationMessage=_("Please input a valid header.");}
						else if(!$dataV->CheckNumeric($_REQUEST['forcepin'])){$valid=false;$validationMessage=_("Please input a valid force pin.");}
						else if(!$dataV->CheckNumeric($_REQUEST['cvm'])){$valid=false;$validationMessage=_("Please input a valid cvm.");}
						
						if($valid){
							$ret = $serv->mPosTBLNBECONFIGUpdate($_REQUEST['url'],$_REQUEST['port'],$_REQUEST['header'],$_REQUEST['forcepin'],$_REQUEST['cvm']);
							if(isset($ret->Token)){$_SESSION["token"] = $ret->Token;}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){session_destroy();}
							if($ret->ResponseCode == 0 ){
								echo _("mPOS config has been successfully updated.");
							}else{
								echo $ret->Message;
							}
						}else{
							echo $validationMessage;
						}
					}else{
						echo _("Please fill-up all the required fields.");
					}
					break;

					case "mPOSupdate":					
					if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
						$ret = $serv->mPOSupdate($_REQUEST["MSISDN"],$_REQUEST["terminalid"],$_REQUEST["serialnumber"]);
						
						if(isset($ret->Token)){
							$_SESSION["token"] = $ret->Token;
						}
						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
							session_destroy();
						}
						if($ret->ResponseCode == 0){
							echo $_REQUEST["MSISDN"] . _(" mpos account has been successfully updated.");
						}else{
							echo $ret->Message;
						}
						
					}else{
						echo _("Not Valid for mPOSupdate!");
					}
					
					break;
					
					case "registerAccountMPOS":
				//$_REQUEST["TYPE"] = "MPOS";
					if($_REQUEST["REGCORPBUSINESSNAME"] == '' || $_REQUEST["TYPE"] == '' || 
				   /* $_REQUEST["REGCORPTYPEOFBUSINESS"] == '' || $_REQUEST["REGCORPOWNERSHIPINFO"] == '' ||
				   $_REQUEST["REGCORPBUILDINGNAME"] == '' || $_REQUEST["REGCORPFLOOR"] == '' ||
				   $_REQUEST["REGCORPSTREETNAME"] == '' || $_REQUEST["REGCORPAREA"] == '' ||
				   $_REQUEST["REGCORPCITY"] == '' || $_REQUEST["COUNTRY"] == '' ||
				   $_REQUEST["REGCORPPOBOX"] == '' || */ 
				   $_REQUEST["FIRSTNAME"] == '' || $_REQUEST["LASTNAME"] == '' ||
				   $_REQUEST["MSISDN"] == '' || $_REQUEST["EMAIL"] == '' || 
				   /* $_REQUEST["IDDESC"] == '' || $_REQUEST["IDNUMBER"] == '' ||
				   $_REQUEST["NATIONALITY"] == '' || $_REQUEST["ISSUANCE"] == '' ||
				   $_REQUEST["EXPIRY"] == '' || $_REQUEST["PROFESSION"] == '' || */
				   $_REQUEST["MERCDISCOUNTRATE"] == '' || $_REQUEST["REGCORPFEESTRXN"] == '' ||
				   $_REQUEST["CASHDISCOUNTRATE"] == '' || $_REQUEST["CASHTRANSFEE"] == ''){
						$ret->ResponseCode = 99;
					$ret->Message = _("Please input all required fields.");
				}else if(!$dataV->CheckAlpha($_REQUEST['LASTNAME']) || !$dataV->CheckAlpha($_REQUEST['FIRSTNAME'])){
					$ret->ResponseCode = 98;
					$ret->Message = _("Please input valid format..");
					
				}else if(!filter_var($_REQUEST["EMAIL"], FILTER_VALIDATE_EMAIL)){
					$ret->ResponseCode = 98;
					$ret->Message = _("Invalid Email format.");
				}else{
					
					$_REQUEST["REGCORPDATEOFINCORPORATION"] = $_REQUEST["REGCORPDATEOFINCORPORATION"] == "" ? "2012-01-01" : $_REQUEST["REGCORPDATEOFINCORPORATION"];	
// 					if($_REQUEST["CURRENTREFACCOUNT"]=='0'){
// 						$refaccount = "0," . $_SESSION['AccountID'];
// 					}else{
					$refaccount = $_REQUEST["CURRENTREFACCOUNT"];
//					}
					
					//print_r($refaccount);
					
					$ret = $serv->registerAccountMPOS($_REQUEST["MSISDN"],$_REQUEST['ALIAS'],$_REQUEST["GENDER"],
						$_REQUEST["LASTNAME"],$_REQUEST["MIDDLENAME"],$_REQUEST["FIRSTNAME"],
						$_REQUEST["EMAIL"],$_REQUEST["DOB"],$_REQUEST["IDNUMBER"],
						$_REQUEST["IDDESC"],$_REQUEST["EXPIRY"],$_REQUEST["NATIONALITY"],$_REQUEST["POB"],
						$_REQUEST["CITY"],$_REQUEST["REGION"],$_REQUEST["COUNTRY"],
						$_REQUEST["TYPE"],"FOR APPROVAL",$_REQUEST["ACCOUNTSTATUS"],
						$refaccount ,$_SESSION['currentUser'],$_REQUEST["BUILDING"],
						$_REQUEST["STREET"],$_REQUEST["REGCORPBUSINESSNAME"],$_REQUEST["PROFESSION"],"NO",
						$_REQUEST["ALTNUMBER"],$_REQUEST["AUTHORIZINGLASTNAME"],$_REQUEST["AUTHORIZINGFIRSTNAME"],
						$_REQUEST["AUTHORIZINGIDNUMBER"],$_REQUEST["AUTHORIZINGIDDESCRIPTION"],$_REQUEST["AUTHORIZINGMOBILENUMBER"],
						$_REQUEST["REGCORPDATEOFINCORPORATION"],$_REQUEST["REGCORPBUSINESSNAME"],$_REQUEST["REGCORPTRADELICENSENUMBER"],
						$_REQUEST["REGCORPREGISTREDADDRESS"],$_REQUEST["REGCORPTYPEOFBUSINESS"],$_REQUEST["REGCORPOWNERSHIPINFO"],$_REQUEST["TINNUMBER"],$_SESSION['imageB2W'],
						$_SESSION['searchmsisdn'],$_REQUEST["TERMINALID"],$_REQUEST["MERCHANTID"],$_REQUEST["SERIALNO"],
						$_SESSION['image2'],$_SESSION['image3'],
						$_REQUEST['REGCORPBUILDINGNAME'],$_REQUEST['REGCORPSTREETNAME'],
						$_REQUEST['REGCORPCITY'],$_REQUEST['REGCORPFLOOR'],
						$_REQUEST['REGCORPAREA'],$_REQUEST['REGCORPPOBOX'],
						$_REQUEST['ISSUANCE'],$_REQUEST['MERCDISCOUNTRATE'],
						$_REQUEST['CASHDISCOUNTRATE'],$_REQUEST['CASHTRANSFEE'],
						$_REQUEST["REGCORPRECEIPTNAME"],$_REQUEST["CASHTYPE"],$_REQUEST["DEVICETYPE"],$_REQUEST['REGCORPFEESTRXN'],$_REQUEST['REGCORPFEESOTHER']);
					
					
					if($ret->ResponseCode == 0){
						$ret->Message = _("You have successfully registered your account");
					}else{
						
						if(isset($ret->Token)){
							$_SESSION["token"] = $ret->Token;
						}
						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
							session_destroy();
						}
						if($ret->ResponseCode == 4){
							$ret->Message = _("Account already exist");
						}
						if($ret->ResponseCode == 40){
							$ret->Message = _("Nickname Account already exist");
						}
						if($ret->ResponseCode == 1){
							$ret->Message = _("Invalid Mobile Number!");
						}
						if($ret->ResponseCode == 21){
							$ret->Message = _("API. Mobile number not allowed to be registered.");
						}
						if($ret->ResponseCode == 22){
							$ret->Message = _("API System Busy to verify the moblie number. Please try again.");
						}
					}
				}
				
				
				header('Content-Type: text/javascript');
				
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				
				$arr = array("responsecode" => $ret->ResponseCode, "message" => $ret->Message);
				echo json_encode($arr);
				break;
				
				
				
				case "registerAccountStore":
            	//$_REQUEST["TYPE"] = "MPOS";
				if($_REQUEST["REGCORPBUSINESSNAME"] == '' || $_REQUEST["TYPE"] == '' ||
					$_REQUEST["FIRSTNAME"] == '' || $_REQUEST["LASTNAME"] == '' ||
					$_REQUEST["MSISDN"] == '' || $_REQUEST["EMAIL"] == '' ||
					$_REQUEST["MERCDISCOUNTRATE"] == '' || $_REQUEST["REGCORPFEESTRXN"] == '' ||
					$_REQUEST["CASHDISCOUNTRATE"] == '' || $_REQUEST["CASHTRANSFEE"] == '' || $_REQUEST["REGCORPRECEIPTNAME"] == '' || 
					$_REQUEST["REGCORPAREA"] == '' || $_REQUEST["REGCORPCITY"] == '' || $_REQUEST["REGCORPPOBOX"] == ''){
            		//print_r("REGCORP:" . $_REQUEST["REGCORPAREA"]);
					$ret->ResponseCode = 99;
				$ret->Message = _("Please input all required fields.");
			}else if(!$dataV->CheckAlpha($_REQUEST['LASTNAME']) || !$dataV->CheckAlpha($_REQUEST['FIRSTNAME'])){
				$ret->ResponseCode = 98;
				$ret->Message = _("Please input valid format..");
				
			}else if(!filter_var($_REQUEST["EMAIL"], FILTER_VALIDATE_EMAIL)){
				$ret->ResponseCode = 98;
				$ret->Message = _("Invalid Email format.");
			}else{
				
				$_REQUEST["REGCORPDATEOFINCORPORATION"] = $_REQUEST["REGCORPDATEOFINCORPORATION"] == "" ? "2012-01-01" : $_REQUEST["REGCORPDATEOFINCORPORATION"];
            		//if($_REQUEST["CURRENTREFACCOUNT"]=='0'){
				$refaccount = "0," . $_SESSION['AccountID'];
            		//}else{
            			//$refaccount = $_REQUEST["CURRENTREFACCOUNT"] . ',' . $_SESSION['AccountID'];
            		//	$refaccount = $_REQUEST["CURRENTREFACCOUNT"];
            		//}
				
            		//print_r($refaccount);
				
				$ret = $serv->registerAccountStore($_REQUEST["MSISDN"],$_REQUEST['ALIAS'],$_REQUEST["GENDER"],
					$_REQUEST["LASTNAME"],$_REQUEST["MIDDLENAME"],$_REQUEST["FIRSTNAME"],
					$_REQUEST["EMAIL"],$_REQUEST["DOB"],$_REQUEST["IDNUMBER"],
					$_REQUEST["IDDESC"],$_REQUEST["EXPIRY"],$_REQUEST["NATIONALITY"],$_REQUEST["POB"],
					$_REQUEST["CITY"],$_REQUEST["REGION"],$_REQUEST["COUNTRY"],
					$_REQUEST["TYPE"],$_REQUEST["STORETYPE"],"FOR APPROVAL",$_REQUEST["ACCOUNTSTATUS"],
					$refaccount ,$_SESSION['currentUser'],$_REQUEST["BUILDING"],
					$_REQUEST["STREET"],$_REQUEST["REGCORPBUSINESSNAME"],$_REQUEST["PROFESSION"],"NO",
					$_REQUEST["ALTNUMBER"],$_REQUEST["AUTHORIZINGLASTNAME"],$_REQUEST["AUTHORIZINGFIRSTNAME"],
					$_REQUEST["AUTHORIZINGIDNUMBER"],$_REQUEST["AUTHORIZINGIDDESCRIPTION"],$_REQUEST["AUTHORIZINGMOBILENUMBER"],
					$_REQUEST["REGCORPDATEOFINCORPORATION"],$_REQUEST["REGCORPBUSINESSNAME"],$_REQUEST["REGCORPTRADELICENSENUMBER"],
					$_REQUEST["REGCORPREGISTREDADDRESS"],$_REQUEST["REGCORPTYPEOFBUSINESS"],$_REQUEST["REGCORPOWNERSHIPINFO"],$_REQUEST["TINNUMBER"],$_SESSION['imageStore'],
					$_SESSION['searchmsisdn'],$_REQUEST["TERMINALID"],$_REQUEST["MERCHANTID"],$_REQUEST["SERIALNO"],
					$_SESSION['image2'],$_SESSION['image3'],
					$_REQUEST['REGCORPBUILDINGNAME'],$_REQUEST['REGCORPSTREETNAME'],
					$_REQUEST['REGCORPCITY'],$_REQUEST['REGCORPFLOOR'],
					$_REQUEST['REGCORPAREA'],$_REQUEST['REGCORPPOBOX'],
					$_REQUEST['ISSUANCE'],$_REQUEST['MERCDISCOUNTRATE'],
					$_REQUEST['CASHDISCOUNTRATE'],$_REQUEST['CASHTRANSFEE'],
					$_REQUEST["REGCORPRECEIPTNAME"],$_REQUEST["CASHTYPE"],$_REQUEST["CASHIERS"],$_REQUEST["DEVICETYPE"],$_REQUEST["REGONBOARDEDBY"],$_REQUEST['REGCORPFEESTRXN'],$_REQUEST['REGCORPFEESOTHER']);
				
				
				if($ret->ResponseCode == 0){
					$ret->Message = _("You have successfully registered your account");
				}else{
					
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					if($ret->ResponseCode == 4){
						$ret->Message = _("Account already exist");
					}
					if($ret->ResponseCode == 40){
						$ret->Message = _("Nickname Account already exist");
					}
					if($ret->ResponseCode == 1){
						$ret->Message = _("Invalid Mobile Number!");
					}
					if($ret->ResponseCode == 21){
						$ret->Message = _("API. Mobile number not allowed to be registered.");
					}
					if($ret->ResponseCode == 22){
						$ret->Message = _("API System Busy to verify the moblie number. Please try again.");
					}
				}
			}
			
			
			header('Content-Type: text/javascript');
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			
			$arr = array("responsecode" => $ret->ResponseCode, "message" => $ret->Message);
			echo json_encode($arr);
			break;
			
			case "getMposCustomerDetailsCBCM":
			$ret = $serv->getMposCustomerDetailsCBCM($_REQUEST["msisdn"]);
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
                //echo $ret->ResponseCode;
			$arr = array("responsecode" => $ret->ResponseCode, "message" => $ret->Message, "value" => $ret->Value);
			echo json_encode($arr);
			exit;
			break;
			
			case "approveSMBKYC":
			
			if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
				/*if($_REQUEST["terminalid"] != '' && $_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $dataV->CheckAlpha($_REQUEST["terminalid"])){*/	
					if($_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"])){
						$ret = $serv->approveSMBKYC($_REQUEST["MSISDN"], $_SESSION["currentUser"],$_REQUEST["terminalid"], $_REQUEST["merchantid"],$_REQUEST["serialnumber"]);     
						
						if(isset($ret->Token)){
							$_SESSION["token"] = $ret->Token;
						}
						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
							session_destroy();
						}
						if($ret->ResponseCode == 0){
							echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						}else{
							echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid merchant/terminal id required field!")));
					}
				}else{
					echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
				}
				
				break;

				case "approveSMBKYCCashier":
				
				if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
					if($_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $_REQUEST["cashierids"] != '' && $_REQUEST["cashiertids"] != ''){
						/* if($_REQUEST["terminalid"] != '' && $_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $dataV->CheckAlpha($_REQUEST["terminalid"]) && $_REQUEST["cashierids"] != '' && $_REQUEST["cashiertids"] != ''){ */
							$ret = $serv->approveSMBKYCCashier($_REQUEST["MSISDN"], $_SESSION["currentUser"],$_REQUEST["terminalid"], $_REQUEST["merchantid"],$_REQUEST["cashierids"],$_REQUEST["cashiertids"],$_REQUEST["serialnumber"], $_REQUEST["imgstat4"],$_REQUEST["imgstat5"],$_REQUEST["imgstat6"],$_REQUEST["imgstat7"],$_REQUEST["imgstat8"],$_REQUEST["appID"]);							
							
							if(isset($ret->Token)){
								$_SESSION["token"] = $ret->Token;
							}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
								session_destroy();
							}
							if($ret->ResponseCode == 0){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid merchant/terminal id required field!")));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
					}
					
					break;

					case "approveSMBKYCProcessor":
					
					if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
						$ret = $serv->approveSMBKYCProcessor($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["id"]);							
						
						if(isset($ret->Token)){
							$_SESSION["token"] = $ret->Token;
						}
						if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
							session_destroy();
						}
						if($ret->ResponseCode == 0){
							echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						}else{
							echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
						}
					}else{
						echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid MSISDN required field!")));
					}
					break;

					case "approveSMBKYCProcessorCashier":
					
					if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
						if($_REQUEST["cashierids"] != '' && $_REQUEST["cashiertids"] != '' && $_REQUEST["vatfunctionality"] != '' && $_REQUEST["corppackages"] != ''){
							/* if($_REQUEST["terminalid"] != '' && $_REQUEST["merchantid"] != '' && $dataV->CheckAlpha($_REQUEST["merchantid"]) && $dataV->CheckAlpha($_REQUEST["terminalid"]) && $_REQUEST["cashierids"] != '' && $_REQUEST["cashiertids"] != ''){ */
								$ret = $serv->approveSMBKYCProcessorCashier($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["id"], $_REQUEST["cashierids"], $_REQUEST["cashiertids"], $_REQUEST["vatfunctionality"], $_REQUEST["corppackages"]);     
								
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								if($ret->ResponseCode == 0){
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}else{
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}
							}else{
								echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out valid merchant/terminal id, packages and vat functionality required field!")));
							}
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;

						case "rejectSMBKYC":
						
						if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
							if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
								$ret = $serv->rejectSMBKYC($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["reason"]);     
								
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								if($ret->ResponseCode == 0){
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
								}else{
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}
							}else{
								echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for decline!")));
							}
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;


						case "rejectSMBKYCCashier":		
						if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
							if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
								$ret = $serv->rejectSMBKYCCashier($_REQUEST["MSISDN"], $_REQUEST["cashierids"], $_SESSION["currentUser"], $_REQUEST["reason"]);     
								
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								if($ret->ResponseCode == 0){
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
								}else{
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}
							}else{
								echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for decline!")));
							}
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;
						
						case "sendbackSMBKYC":
						
						if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
							if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){


								$ret = $serv->sendbackSMBKYC($_REQUEST["MSISDN"], $_SESSION["currentUser"], $_REQUEST["reason"], $_REQUEST["appID"],$_REQUEST["stat1"],
									$_REQUEST["stat2"],$_REQUEST["stat3"],$_REQUEST["stat4"],$_REQUEST["stat5"]);
								
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								if($ret->ResponseCode == 0){
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully sent for compliance")));
								}else{
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}
							}else{
								echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for send back!")));
							}
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;
						
						case "sendbackToBank":
						
						if(isset($_REQUEST["id"]) && $_REQUEST["id"] != ''){
							//if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
								$ret = $serv->sendbackToBank($_REQUEST["compname"],
								 $_REQUEST["accType"],
								 $_REQUEST["corpboard"],
								 $_REQUEST["corparea"],
								 $_REQUEST["city"],
								 $_REQUEST["pobox"],
								 $_REQUEST["corpreceiptname"],
								 $_REQUEST["pFName"],
								 $_REQUEST["pLname"],
								 $_REQUEST["authNumber2"],
								 $_REQUEST["pEmail"],
								 $_REQUEST["mercdiscountrate"],
								 $_REQUEST["mercdiscountratenonp"],
								 $_REQUEST["cashdiscountrate"],
								 $_REQUEST["imgstat1"],
								 $_REQUEST["imgstat2"],
								 $_REQUEST["imgstat3"],
								 $_REQUEST["imgstat4"],
								 $_REQUEST["imgstat5"],
								 $_REQUEST["imgstat6"],
								 $_REQUEST["imgstat7"],
								 $_REQUEST["imgstat8"],
								 $_REQUEST["imgstat9"],
								 $_REQUEST["imgstat10"],
								 $_REQUEST["id"],
								 $_REQUEST["appID"]);
								
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								if($ret->ResponseCode == 0){
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Successfully Changed KYC Status")));
								}else{
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}
							/*}else{
								echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for send back!")));
							}*/
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;
						
						case "sendbackSMBKYCApp":
						
						if(isset($_REQUEST["MSISDN"]) && $_REQUEST["MSISDN"] != ''){
							if($_REQUEST["reason"] != '' && $dataV->CheckAlpha($_REQUEST['reason'])){	
								$ret = $serv->sendbackSMBKYCApp($_REQUEST["MSISDN"], $_REQUEST["reason"]);
								
								if(isset($ret->Token)){
									$_SESSION["token"] = $ret->Token;
								}
								if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
									session_destroy();
								}
								if($ret->ResponseCode == 0){
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>_("Account has been successfully sent back to QC Team.")));
								}else{
									echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
								}
							}else{
								echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out the valid reason for send back!")));
							}
						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;
						
						case "activateAccount":
						
						if(isset($_REQUEST["inputValue"]) && $_REQUEST["inputValue"] != ''){
							
							$ret = $serv->activateAccount($_REQUEST["inputValue"], $_SESSION["currentUser"]);     
							
							if(isset($ret->Token)){
								$_SESSION["token"] = $ret->Token;
							}
							if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
								session_destroy();
							}
							if($ret->ResponseCode == 0){
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>"Service activated"));
							}else{
								echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
							}

						}else{
							echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for update KYC!")));
						}
						
						break;
						
						case "updateSMBAccount":
						
						$validation = true;
						$resMessage = "";
						
/*				$msisdn = isset($_REQUEST["MSISDN"])?$_REQUEST["MSISDN"]:$_SESSION['currentSearch']->AccountInformation->MobileNumber;
				$alias = isset($_REQUEST["ALIAS"])?$_REQUEST["ALIAS"]:$_SESSION['currentSearch']->AccountInformation->Alias;
				$type = isset($_REQUEST["TYPE"])?$_REQUEST["TYPE"]:$_SESSION['currentSearch']->AccountInformation->AccountType;
				$kyc = isset($_REQUEST["KYC"])?$_REQUEST["KYC"]:$_SESSION['currentSearch']->AccountInformation->KYC;
				$accountstatus = isset($_REQUEST["ACCOUNTSTATUS"])?$_REQUEST["ACCOUNTSTATUS"]:$_SESSION['currentSearch']->AccountInformation->Status;
				$refaccount = isset($_REQUEST["REFACCOUNT"])?$_REQUEST["REFACCOUNT"]:$_SESSION['currentSearch']->AccountInformation->ReferenceAccount;
				$locked = isset($_REQUEST["LOCKED"])?$_REQUEST["LOCKED"]:($_SESSION['currentSearch']->AccountInformation->Locked=='true'?"YES":"NO");
												
				$corpdate = isset($_REQUEST["CORPDATEOFINCORPORATION"])?$_REQUEST["CORPDATEOFINCORPORATION"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->dateofincorporation;
				$corpbname = isset($_REQUEST["CORPBUSINESSNAME"])?$_REQUEST["CORPBUSINESSNAME"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->businessname;
				$corptnumber = isset($_REQUEST["CORPTRADELICENSENUMBER"])?$_REQUEST["CORPTRADELICENSENUMBER"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->tradelicensenumber;
				$corpraddress = isset($_REQUEST["CORPREGISTEREDADDRESS"])?$_REQUEST["CORPREGISTEREDADDRESS"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->registeredaddress;
				$corptype = isset($_REQUEST["CORPTYPEOFBUSINESS"])?$_REQUEST["CORPTYPEOFBUSINESS"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->typeofbusiness;
				$corpoinfo = isset($_REQUEST["CORPOWNERSHIPINFO"])?$_REQUEST["CORPOWNERSHIPINFO"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->ownershipinfo;
				
				$mcvisafee = isset($_REQUEST["mcvisafee"])?$_REQUEST["mcvisafee"]:$_SESSION['currentSearch']->AccountInformation->mcvisafee;
				$othersfee = isset($_REQUEST["othersfee"])?$_REQUEST["othersfee"]:$_SESSION['currentSearch']->AccountInformation->othersfee;
				$mercdiscountrate = isset($_REQUEST["mercdiscountrate"])?$_REQUEST["mercdiscountrate"]:$_SESSION['currentSearch']->AccountInformation->mercdiscountrate;
				$cashdiscountrate = isset($_REQUEST["cashdiscountrate"])?$_REQUEST["cashdiscountrate"]:$_SESSION['currentSearch']->AccountInformation->cashdiscountrate;
				$cashtransfee = isset($_REQUEST["cashtransfee"])?$_REQUEST["cashtransfee"]:$_SESSION['currentSearch']->AccountInformation->cashtransfee;
				$cashtype = isset($_REQUEST["cashtype"])?$_REQUEST["cashtype"]:$_SESSION['currentSearch']->AccountInformation->cashtype;
				
				$corpbuilding = isset($_REQUEST["corpbuilding"])?$_REQUEST["corpbuilding"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->building;
				$corpstreet = isset($_REQUEST["corpstreet"])?$_REQUEST["corpstreet"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->street;
				$corpcity = isset($_REQUEST["corpcity"])?$_REQUEST["corpcity"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->city;
				$corpfloor = isset($_REQUEST["corpfloor"])?$_REQUEST["corpfloor"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->floor;
				$corparea = isset($_REQUEST["corparea"])?$_REQUEST["corparea"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->area;
				$corppobox = isset($_REQUEST["corppobox"])?$_REQUEST["corppobox"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->pobox;
				$corpreceiptname = isset($_REQUEST["corpreceiptname"])?$_REQUEST["corpreceiptname"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->receiptname;
				$corponboardedby = isset($_REQUEST["corponboardedby"])?$_REQUEST["corponboardedby"]:$_SESSION['currentSearch']->AccountInformation->CorpInformation->onboardedby;
				
				$idissuancedate = isset($_REQUEST["idissuancedate"])?$_REQUEST["idissuancedate"]:$_SESSION['currentSearch']->AccountInformation->ValidID->Issuance;
*/				
				if($_REQUEST["EMAIL"] != ''){
					if(!filter_var($_REQUEST["EMAIL"], FILTER_VALIDATE_EMAIL)){
						$validation = false;
						$resMessage = _("Invalid Email format.");
					}
				}
				
//				$exp = $_REQUEST['EXPIRY'] == "" ? date('Y-m-d') : $_REQUEST['EXPIRY'];
				
				if(!$dataV->CheckAlpha($_REQUEST['LASTNAME']) 
//					|| !$dataV->CheckAlpha($_REQUEST['FIRSTNAME']) 
					/* || !$dataV->CheckAlpha($_REQUEST['IDNUMBER']) || !$dataV->CheckAlpha($_REQUEST['IDDESC']) || !$dataV->CheckAlpha($_REQUEST['NATIONALITY']) */ 
//				|| !$dataV->CheckAlpha($corpreceiptname) //|| !$dataV->CheckAlpha($type) 
					/* || !$dataV->CheckAlpha($_REQUEST['PROFESSION']) || !$dataV->CheckAlpha($corpbname) || !$dataV->CheckAlpha($corpfloor) || !$dataV->CheckAlpha($corpstreet) */ 
//				|| !$dataV->CheckAlpha($corparea) 
//				|| !$dataV->CheckAlpha($corpcity) 
					/* || !$dataV->CheckAlpha($_REQUEST["COUNTRY"]) */ 
//				|| !$dataV->CheckAlpha($corppobox) 
				/* || !$dataV->CheckAlpha($idissuancedate)
				|| !$dataV->CheckAlpha($exp) || !$dataV->CheckAlpha($corptype) */ ){
					$validation = false;
				$resMessage = _("Please input valid format.");
			}
			
			if($_REQUEST["MSISDN"] == '' || $_REQUEST["LASTNAME"] == '' || $_REQUEST["FIRSTNAME"] == '' 
				/* || $_REQUEST["IDNUMBER"] == '' || $_REQUEST["IDDESC"] == '' || $_REQUEST["NATIONALITY"] == '' || $_REQUEST["COUNTRY"] == '' || $_REQUEST["STREET"] == '' || $locked == '' || $_REQUEST["TINNUMBER"] == '' */){
				$validation = false;
			$resMessage = _("Please input all required fields.");
		}
		
		
		
		
		if($validation){
			
			
			$ret = $serv->updateSMBAccount($_REQUEST["MSISDN"],
				$_SESSION["currentUser"],
				$_REQUEST["LASTNAME"],
				$_REQUEST["FIRSTNAME"],
				$_REQUEST["EMAIL"],
				$_REQUEST["AREA"],
				$_REQUEST["CITY"],
				$_REQUEST["POBOX"],
				$_REQUEST["CORPBUSINESSNAME"],
				$_REQUEST["CORPRECEIPTNAME"]
				);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0){
				echo _("You have successfully saved your account");
			}else if($ret->ResponseCode == 2 || $ret->ResponseCode == 3){
				echo _("Account does not exist");
			}else{
				echo $ret->Message;
			}

		}else{
			echo $resMessage;
		}
		break;

		case "approveSMBKYCcompliance":
			$ret = $serv->approveSMBKYCcompliance($_REQUEST["MSISDN"], $_SESSION["currentUser"]);			
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
					
		break;
		
		case "requestUpdateMSISDN":
			if(isset($_REQUEST["oldMSISDN"]) && $_REQUEST["newMSISDN"] != ''){
					$ret = $serv->requestUpdateMSISDN($_REQUEST["oldMSISDN"], $_REQUEST["newMSISDN"], $_REQUEST["MID"], $_REQUEST["TID"],$_SESSION["currentUser"]);     
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					if($ret->ResponseCode == 0){
						echo ($ret->Message);
					}else{
						echo ($ret->Message);
					}
			}else{
				echo ("Not Valid for MSISDN update!");
			}	
		break;
		
		case "approveUpdateMSISDN":
			if(isset($_REQUEST["oldMSISDN"]) && $_REQUEST["newMSISDN"] != ''){
				if($_REQUEST["oldMSISDN"] != '' && $_REQUEST["newMSISDN"] != ''){
					$ret = $serv->approveUpdateMSISDN($_REQUEST["oldMSISDN"], $_REQUEST["newMSISDN"], $_REQUEST["status"]);     
					if(isset($ret->Token)){
						$_SESSION["token"] = $ret->Token;
					}
					if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
						session_destroy();
					}
					if($ret->ResponseCode == 0){
						echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
					}else{
						echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
					}
				}else{
					echo json_encode(array("ResponseCode"=>1,"Message"=>_("please fill out required field!1")));
				}
			}else{
				echo json_encode(array("ResponseCode"=>1,"Message"=>_("Not Valid for MSISDN update!")));
			}	
		break;
		
		case "testAPICall":

			$ret = $serv->testAPICall();
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			if($ret->ResponseCode == 0){
				echo $_REQUEST["MSISDN"] . _(" has been successfully locked.");
			}else{
				echo $ret->Message;
			}
			
			break;
			
		case "cancelRestorePNDGRegistration":
				$ret = $serv->cancelRestorePNDGRegistration($_REQUEST["pndgID"], $_REQUEST["status"], $_SESSION["currentUser"]);     
				if(isset($ret->Token)){
					$_SESSION["token"] = $ret->Token;
				}
				if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
					session_destroy();
				}
				if($ret->ResponseCode == 0){
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}else{
					echo json_encode(array("ResponseCode"=>$ret->ResponseCode,"Message"=>$ret->Message));
				}

		break;
		
		case "errorAramexView":
			$ret = $serv->aramexEIDErrorLog($_REQUEST["refid"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			
			echo json_encode($ret);
		break;

		case "generateKSN":
			if ($_REQUEST["ksnCount"] == '' || $_REQUEST["ksnCount"] == 0){
				echo $ret->Message = _("Please enter KSN count.");
				return;
			}
			$ret = $serv->generateKSN($_REQUEST["ksnCount"]);
			
			if(isset($ret->Token)){
				$_SESSION["token"] = $ret->Token;
			}
			if($ret->ResponseCode == 13 || $ret->ResponseCode == 14){
				session_destroy();
			}
			
			echo json_encode($ret);
		break;		
			
	}
}
}else{
	echo _("Unauthorized Access!");
}
?>
