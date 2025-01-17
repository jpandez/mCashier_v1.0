<?php require_once("bc.config.properties.php"); ?>
<?php require_once("ServiceResponse.php"); ?>
<?php require_once($GLOBALS["LIB_PATH"]."/Wrappers/nusoap.php"); ?>
<?php require_once($GLOBALS["LIB_PATH"]."/Utils/utils.Common.php"); ?>
<?php
class SubscriberServices{
	var $_GUISERVICE=null;
	var $logger = null;
	public function __construct(){
		$this->_GUISERVICE = $GLOBALS["GUISERVICE"];
		$this->logger = new Common();
	}
	
	public function activate($MSISDN){
		
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('activate', array('MSISDN'=>$MSISDN));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function allocate($MSISDN,$Amount,$UserID,$Remarks){
		
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('allocate', array('MSISDN'=>$MSISDN,'Amount'=>$Amount,'UserID'=>$UserID,'Remarks'=>$Remarks));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
				//print_r($ret);
		return $ret;
	}
	
	public function changePassword($MSISDN, $oldPassword,$newPassword){
		
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('changePassword', array('MSISDN'=>$MSISDN));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function deactivate($MSISDN){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('deactivate', array('MSISDN'=>$MSISDN));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function lock($MSISDN, $LockDescription){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('lock', array('MSISDN'=>$MSISDN,'LockDescription'=>$LockDescription));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function registerAccount($MSISDN,$Alias,$Gender,$LastName,$MiddleName,
		$FirstName,$EmailAddress,$DateOfBirth,$IDNumber,$IDDesc,$IDExpiry,
		$Nationality,$BirthPlace,$CityID,$RegionID,$CountryID,
		$Type,$StoreType,$KYC,$Status,$ReferenceAccount,$UserID,$BuildingName,
		$StreetName,$CompanyName,$Profession,$Locked,$AltNumber,
		$AuthorizingLastName,$AuthorizingFirstName,$AuthorizingIDNumber,
		$AuthorizingIDDesc,$AuthorizingMsisdn,
		$corpdateofincorporation,$corpbusinessname,$corptradelicensenumber,$corpregistredaddress,$corptypeofbusiness,$corpownershipinfo,$tinnumber,
		$image,
		$sessionmsisdn,$terminalid,$merchantid,$serialno,
		$image2,$image3,
		$corpbuilding,$corpstreet,$corpcity,$corpfloor,$corparea,
		$corppobox,$idissuancedate,$mercdiscountrate,$cashdiscountrate,$cashtransfee,
		$corpreceiptname,$cashtype,$cashier,
		$corponboardedby,$nonpremium,$devicetype,$mcvisafee='0',$othersfee='0'){

		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('registerAccount', array('AuthorizingLastName'=>$AuthorizingLastName,'AuthorizingFirstName'=>$AuthorizingFirstName,'AuthorizingIDNumber'=>$AuthorizingIDNumber,
			'AuthorizingIDDesc'=>$AuthorizingIDDesc,'AuthorizingMsisdn'=>$AuthorizingMsisdn,
			'MSISDN'=>$MSISDN,'Alias'=>$Alias,'Gender'=>$Gender,'LastName'=>$LastName,'MiddleName'=>$MiddleName,
			'FirstName'=>$FirstName,'EmailAddress'=>$EmailAddress,'DateOfBirth'=>$DateOfBirth,'IDNumber'=>$IDNumber,'IDDesc'=>$IDDesc,'IdExpiryDate'=>$IDExpiry,
			'Nationality'=>$Nationality,'BirthPlace'=>$BirthPlace,'CityID'=>$CityID,'RegionID'=>$RegionID,'CountryID'=>$CountryID,
			'Type'=>$Type,'StoreType'=>$StoreType,'KYC'=>$KYC,'Status'=>$Status,'ReferenceAccount'=>$ReferenceAccount,'UserID'=>$UserID,'BuildingName'=>$BuildingName,
			'StreetName'=>$StreetName,'CompanyName'=>$CompanyName,'Profession'=>$Profession,'Locked'=>$Locked,'AltNumber'=>$AltNumber,
			'corpdateofincorporation'=>$corpdateofincorporation,'corpbusinessname'=>$corpbusinessname,'corptradelicensenumber'=>$corptradelicensenumber,'corpregisteredaddress'=>$corpregistredaddress,'corptypeofbusiness'=>$corptypeofbusiness,'corpownershipinfo'=>$corpownershipinfo,
			'tinnumber'=>$tinnumber,'image'=>$image,
			'sessionmsisdn'=>$sessionmsisdn,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'serialno'=>$serialno,
			'image2'=>$image2,'image3'=>$image3,
			'mcvisafee'=>$mcvisafee,'othersfee'=>$othersfee,
			'corpbuilding'=>$corpbuilding,'corpstreet'=>$corpstreet,
			'corpcity'=>$corpcity,'corpfloor'=>$corpfloor,
			'corparea'=>$corparea,'corppobox'=>$corppobox,
			'idissuancedate'=>$idissuancedate,'mercdiscountrate'=>$mercdiscountrate,
			'cashdiscountrate'=>$cashdiscountrate,'cashtransfee'=>$cashtransfee,
			'corpreceiptname'=>$corpreceiptname,'cashtype'=>$cashtype,
			'cashier'=>$cashier,
			'corponboardedby'=>$corponboardedby,'nonpremium'=>$nonpremium,'devicetype'=>$devicetype));
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function resetPassword($MSISDN){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('resetPassword', array('MSISDN'=>$MSISDN));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function search($inp, $option){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('search', array('inp'=>$inp,'option'=>$option));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		//print_r($result);
		return $ret;
	}
	
	public function unlock($MSISDN){
		
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('unlock', array('MSISDN'=>$MSISDN));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function updateAccount($MSISDN,$Alias,$Gender,$LastName,$MiddleName,
		$FirstName,$EmailAddress,$DateOfBirth,$IDNumber,$IDDesc,$IDExpiry,
		$Nationality,$BirthPlace,$CityID,$RegionID,$CountryID,
		$Type,$KYC,$Status,$ReferenceAccount,$UserID,$BuildingName,
		$StreetName,$CompanyName,$Profession,$Locked,$AltNumber,
		$corpdateofincorporation,$corpbusinessname,$corptradelicensenumber,$corpregistredaddress,$corptypeofbusiness,$corpownershipinfo,$tinnumber,
		$mcvisafee,$othersfee,
		$corpbuilding,$corpstreet,$corpcity,$corpfloor,$corparea,$corppobox,
		$idissuancedate,$mercdiscountrate,$cashdiscountrate,$cashtransfee,
		$corpreceiptname,$cashtype,$corponboardedby,$corpcontactno,$isvatappuser){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('updateAccount', array('MSISDN'=>$MSISDN,'Alias'=>$Alias,'Gender'=>$Gender,'LastName'=>$LastName,'MiddleName'=>$MiddleName,
			'FirstName'=>$FirstName,'EmailAddress'=>$EmailAddress,'DateOfBirth'=>$DateOfBirth,'IDNumber'=>$IDNumber,'IDDesc'=>$IDDesc,'IdExpiryDate'=>$IDExpiry,
			'Nationality'=>$Nationality,'BirthPlace'=>$BirthPlace,'CityID'=>$CityID,'RegionID'=>$RegionID,'CountryID'=>$CountryID,
			'Type'=>$Type,'KYC'=>$KYC,'Status'=>$Status,'ReferenceAccount'=>$ReferenceAccount,'UserID'=>$UserID,'BuildingName'=>$BuildingName,
			'StreetName'=>$StreetName,'CompanyName'=>$CompanyName,'Profession'=>$Profession,'Locked'=>$Locked, 'AltNumber'=>$AltNumber, 
			'corpdateofincorporation'=>$corpdateofincorporation,'corpbusinessname'=>$corpbusinessname,'corptradelicensenumber'=>$corptradelicensenumber,'corpregisteredaddress'=>$corpregistredaddress,'corptypeofbusiness'=>$corptypeofbusiness,'corpownershipinfo'=>$corpownershipinfo,
			'tinnumber'=>$tinnumber,
			'mcvisafee'=>$mcvisafee,'othersfee'=>$othersfee,
			'corpbuilding'=>$corpbuilding,'corpstreet'=>$corpstreet,
			'corpcity'=>$corpcity,'corpfloor'=>$corpfloor,
			'corparea'=>$corparea,'corppobox'=>$corppobox,
			'idissuancedate'=>$idissuancedate,'mercdiscountrate'=>$mercdiscountrate,
			'cashdiscountrate'=>$cashdiscountrate,'cashtransfee'=>$cashtransfee,'corpreceiptname'=>$corpreceiptname,'cashtype'=>$cashtype,
			'corponboardedby'=>$corponboardedby, 'vatfunctionality'=>$isvatappuser));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	
	public function updateVAT($ID,$isvatappuser){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('updateVatFunctionality', array('ID'=>$ID,'isVatUser'=>$isvatappuser));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	public function updateKYC($MSISDN,$kyc,$userID){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		$result = $client->call('updateKYC', array('MSISDN'=>$MSISDN,'kyc'=>$kyc,'userID'=>$userID));
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
	
	
	public function getTransactions($MSISDN,$DateFrom,$DateTo){
		$ret = new ServiceResponse();
		$ret->Message = "System is Busy. Please try again later";
		$ret->ResponseCode = 100;
		
		$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
		$err = $client->getError();
		if ($err) {
			$this->logger->WriteLog(var_export($err,true));
		}
		
		
		$result = $client->call('getStatement', array('MSISDN'=>$MSISDN,'DateFrom'=>$DateFrom,'DateTo'=>$DateTo));
		
		
		if ($client->fault) {
			$this->logger->WriteLog(var_export($result,true));
		} else {
			$err = $client->getError();
			if ($err) {
				$this->logger->WriteLog(var_export($err,true));
			} else {
				$ret = json_decode(base64_decode($result));
			}
		}
		return $ret;
	}
	
        /**
         * Gui User Functions
         * 
         */
        
        public function userLogin($username = '', $password = '', $sessionid = '',$assoc = false){
        	$ret = array();
        	$ret['Message'] = "System is Busy. Please try again later";
        	$ret['ResponseCode'] = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userLogin', array('username' => $username, 'password' => $password, 'sessionid' => $sessionid)); 
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result),$assoc);
        		}
        	}
            //print_r($ret);
        	return $ret;
        	
        }


        public function userLoginOTP($otp='', $username = '', $password = '', $sessionid = '',$assoc = false){
        	$ret = array();
        	$ret['Message'] = "System is Busy. Please try again later";
        	$ret['ResponseCode'] = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userLoginOTP', array('username' => $username, 'password' => $password, 'sessionid' => $sessionid,'otp' => $otp)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result),$assoc);
        		}
        	}
            //print_r($ret);
        	return $ret;
        	
        }


        
        public function checkSession($sessionid = '', $username = ''){
        	$ret = array();
        	$ret['Message'] = "System is Busy. Please try again later";
        	$ret['ResponseCode'] = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('checkSession', array('sessionid' => $sessionid, 'username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        	
        }
        public function checkSession2(){
        	$ret = array();
        	$ret['Message'] = "System is Busy. Please try again later";
        	$ret['ResponseCode'] = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('checkSession');
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = base64_decode($result);
        		}
        	}
        	
        	return $ret;
        	
        }
        
        public function userSearchList($skey = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userSearchList', array('skey' => $skey)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function userSearch($skey = '', $option = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userSearch', array('skey' => $skey, 'option' => $option)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function userRegistration($username = '', $firstname = '', $lastname = '', $department = '', $userlevel = '', $status = '', $createdby = '', $email = '', $msisdn = '', $allowedip = '0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	//added
			$this->logger->WriteLog(var_export($username,true));
			
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userRegistration', array('username' => $username, 'firstname' => $firstname, 'lastname' => $lastname, 'department' => $department, 'userlevel' => $userlevel, 'status' => $status, 'created_by' => $createdby, 'email' => $email, 'msisdn' => $msisdn, 'allowedip'=> $allowedip)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function userRolesList($user_role = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userRolesGetRoles', array('user_role' => $user_role)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function applicationRoles($userlevel = '', $assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('applicationRoles', array('userlevel' => $userlevel)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result), $assoc);
        		}
        	}
        	
        	return $ret;
        }
        
        public function updateModule($userlevel = '', $module = '', $value = '' ,$assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userRolesModifyRoles', array('userlevel' => $userlevel,'option' => $module, 'value' => $value)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result), $assoc);
        		}
        	}
        	
        	return $ret;
        }
        
        public function userRolesAddnew($userlevel = '', $sessiontimeout = '', $passwordchange = '', $passwordexpiry = '', $minpassword = '', $passwordhistory = '', $maxallocation = '', $searchrange = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userRolesAddnew', array('userlevel' => $userlevel, 'sessiontimeout' => $sessiontimeout, 'passwordchange' => $passwordchange, 'passwordexpiry' => $passwordexpiry, 'minpassword' => $minpassword, 'passwordhistory' => $passwordhistory, 'maxallocation' => $maxallocation, 'searchrange' => $searchrange)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        public function userLocked($user_id = '', $username = '', $locked = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userLocked', array('user_id' => $user_id, 'username' => $username, 'locked' => $locked)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function userResetPassword($user_id = '', $username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userResetPassword', array('user_id' => $user_id, 'username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function getUserlevelDetails($userlevel, $assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userRolesGetRoles', array('user_role' => $userlevel)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function userRolesUpdate($id = '', $userlevel = '' ,$sessiontimeout = '', $passwordchange = '', $passwordexpiry = '', $minpassword = '', $passwordhistory = '', $maxallocation = ''  , $username = '',$searchrange = '', $newpasswordexpiry ='', $assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userRolesUpdate', array('id' => $id, 'userlevel' => $userlevel , 'sessiontimeout' => $sessiontimeout , 'passwordchange' => $passwordchange , 'passwordexpiry' => $passwordexpiry , 'minpassword' => $minpassword, 'passwordhistory' => $passwordhistory, 'maxallocation' => $maxallocation, 'username' => $username, 'searchrange' => $searchrange, 'newpasswordexpiry' => $newpasswordexpiry)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function userUpdate($userid = '', $username = '' ,$firstname = '', $lastname = '', $department = '', $userlevel = '', $status = '', $modified_by = '', $email='', $msisdn='', $allowedip='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userUpdate', array('userid' => $userid, 'username' => $username , 'firstname' => $firstname , 'lastname' => $lastname , 'department' => $department , 'userlevel' => $userlevel, 'status' => $status, 'modified_by' => $modified_by, 'email' => $email, 'msisdn' => $msisdn, 'allowedip' => $allowedip)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function userChangePassword($user_id = '', $username = '' ,$oldpassword = '', $newpassword = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('userChangePassword', array('user_id' => $user_id, 'username' => $username , 'oldpassword' => $oldpassword , 'newpassword' => $newpassword)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function globalSearch($subscriber='', $skey='', $value='', $transtype='', $fromdate='', $todate=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('globalSearch', array('subscriber'=>$subscriber,'skey'=>$skey,'value'=>$value,'value'=>$value,'transtype'=>$transtype,'fromdate'=>$fromdate,'todate'=>$todate));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function globalSearchReferenceID($referenceid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('globalSearchReferenceID', array('referenceid'=>$referenceid));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function globalSearchSMS($message, $referenceid='', $msisdn=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('globalSearchSMS', array('referenceid'=>$referenceid,'msisdn'=>$msisdn,'message'=>$message));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getSystemInfo(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getSystemInfo', array()); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function amlConfigType($type='',$accounttype='',$key=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('amlConfigType', array('type'=>$type,'accounttype'=>$accounttype,'key'=>$key));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        
        
        public function getTransactionHistory($fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionReportsAll', array('fromdate'=>$fromdate,'todate'=>$todate));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode($this->logger->checkEncoding(base64_decode($result)));
        		}
        	}
        	return $ret;
        }
        
        public function getTransactionHistoryAll($fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionHistoryDetails', array('fromdate'=>$fromdate,'todate'=>$todate));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getTransactionReportsDetails($type='', $fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionReportsDetails', array('transtype'=>$type , 'fromdate'=>$fromdate,'todate'=>$todate));
        	
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getTransactionReports($type='', $fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionReports', array('transtype'=>$type , 'fromdate'=>$fromdate,'todate'=>$todate));
        	
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode($this->logger->checkEncoding(base64_decode($result)));
        		}
        	}
        	return $ret;
        }
        
        public function getSubscriberCount($assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberCount', array());
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result),$assoc);
        		}
        	}
        	return $ret;
        }
        
        public function getSubscriberList($accounttype='' , $assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberList', array("type" => $accounttype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result),$assoc);
        		}
        	}
        	return $ret;
        }
        
        public function transactionSummary($fromdate='' ,  $todate = '' , $assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionSummary', array("fromdate" => $fromdate, "todate" => $todate));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
						//$ret = json_decode($this->logger->checkEncoding(base64_decode($result)),$assoc);
						//$ret = base64_decode($result);
        			$ret = json_decode(base64_decode($result));
        		}
        	}
			//print_r($ret);
        	return $ret;
        }
        
        public function getAccountSummary($assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('accountSummary', array());
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result),$assoc);
        		}
        	}
        	return $ret;
        }
        
        public function subscriberPending($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberPending', array('skey'=>$skey,'value'=>$value));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
        
        public function getTerminalIDPending($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getTerminalIDPending', array('username' => $_SESSION["currentUser"]));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
			//print_r($ret);
        	return $ret;
        }
        
        
        public function updateAmlConfigType($id='',$type='',$accounttype='',$key='',$priority='',$maxamount='',$maxcurrentamount='',$maxamountday='',$maxamountmonth='',$maxtransday='',$maxtransmonth=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('updateAmlConfigType', array('id'=>$id,'type'=>$type,'accounttype'=>$accounttype,'key'=>$key,'priority'=>$priority,'maxamount'=>$maxamount,'maxcurrentamount'=>$maxcurrentamount,'maxamountday'=>$maxamountday,'maxamountmonth'=>$maxamountmonth,'maxtransday'=>$maxtransday,'maxtransmonth'=>$maxtransmonth));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
       public function getAuditTrail($userid='',$username='',$fromdate='',$todate=''){
			$ret = new ServiceResponse();
            $ret->Message = "System is Busy. Please try again later";
            $ret->ResponseCode = 100;
            
            $client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
            $err = $client->getError();
            
            if($err){
                $this->logger->WriteLog(var_export($err,true));
            }

            $result = $client->call('getAuditTrail', array('userid'=>$userid,'username'=>$username,'fromdate'=>$fromdate,'todate'=>$todate));
            
            if ($client->fault) {
					$this->logger->WriteLog(var_export($result,true));
            } else {
					$err = $client->getError();
					if ($err) {
						$this->logger->WriteLog(var_export($err,true));
					} else {
					   
						$ret = json_decode(base64_decode($result));
						//$ret = base64_decode($result);
					}
            }
            //print_r($ret);
			return $ret;
		 }
        
        public function addAuditTrail($userid = '', $username = '', $log = '', $ip = '127.0.0.1'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addAuditTrail', array('userid'=>$userid,'username'=>$username,'log'=>$log,'ip'=>$ip));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function getAllUsers(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getAllUsers', array()); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function getAccountType(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getAccountType', array()); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function getAccountType2($msisdn=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getAccountType2', array('msisdn'=>$msisdn));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function getAllocationPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getAllocationPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function approveAllocation($username='',$msisdn='',$value='',$transactionid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveAllocation', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'transactionid'=>$transactionid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function call($method = '', $arr = array(), $assoc = false){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call($method, $arr);
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getSystemInfoPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getSystemInfoPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function getUserlevelPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getUserLevelPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
			//print_r($ret);
        	return $ret;
        }
        
        public function approveSystemInfo($username='',$id='',$remarks=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveSystemInfo', array('username'=>$username,'id'=>$id,'remarks'=>$remarks));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveUserLevels($username='',$remarks='',$id='',$userlevel=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveUserLevels', array('username'=>$username,'remarks'=>$remarks,'id'=>$id,'userlevel'=>$userlevel));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getMessages(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getMessages', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function requestMessages($id='',$message='',$description='',$type='',$language='',$username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	/*$message = mb_convert_encoding($message, 'HTML-ENTITIES', 'UTF-8');*/
//echo htmlspecialchars($message);
        	$result = $client->call('requestMessages', array('msgid'=>$id,'message'=>$message,'description'=>$description,'type'=>$type,'language'=>$language,'username'=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getMessagesPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getMessagesPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function approveMessagesPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveMessagesPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function addAmlTypePndg($type='',$accounttype='',$key='',$priority='',$maxamount='',$maxcurrentamount='',$maxamountday='',$maxamountmonth='',$maxtransday='',$maxtransmonth='',$username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('addAmlTypePndg', array('type'=>$type,'accounttype'=>$accounttype,'key'=>$key,'priority'=>$priority,'maxamount'=>$maxamount,'maxcurrentamount'=>$maxcurrentamount,'maxamountday'=>$maxamountday,'maxamountmonth'=>$maxamountmonth,'maxtransday'=>$maxtransday,'maxtransmonth'=>$maxtransmonth,'username'=>$username));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getAmlTypePndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getAmlTypePndg', array()); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function getAmlMSISDNPndg($username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getAmlMSISDNPndg', array('username'=>$username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveAmlTypePndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveAmlTypePndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getKeyCostType(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getKeyCostType', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function updateKeyCostType($id="",$key="",$type="",$account="",$fixed="",$percent="",$priority="",$status="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('updateKeyCostType', array("id"=>$id,"key"=>$key,"type"=>$type,"account"=>$account,"fixed"=>$fixed,"percent"=>$percent,"priority"=>$priority,"status"=>$status,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getKeyCostTypePndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getKeyCostTypePndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function approveKeyCostTypePndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveKeyCostTypePndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function addKeyCostType($key="",$type="",$account="",$fixed="",$percent="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addKeyCostType', array("key"=>$key,"type"=>$type,"account"=>$account,"fixed"=>$fixed,"percent"=>$percent,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;

        }
        
        
        public function getTransceiver(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getTransceiver', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = $this->logger->formatJson($result);
        			
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function requestTransceiver($pndgid='', $systemid='', $password='', $ip='', $port='', $ton='', $npi='', $origton='', $orignpi='', $destton='', $destnpi='', $systype='', $status='', $hostip='', $shortcode='', $keepaliveinterval='', $responsetimeout='', $pinpattern='', $pinreplace='', $username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestTransceiver', array('pndgid'=>$pndgid,'systemid'=>$systemid,'password'=>$password,'ip'=>$ip,'port'=>$port,'ton'=>$ton,'npi'=>$npi,'origton'=>$origton,'orignpi'=>$orignpi,'destton'=>$destton,'destnpi'=>$destnpi,'systype'=>$systype,'status'=>$status,'hostip'=>$hostip,'shortcode'=>$shortcode,'keepaliveinterval'=>$keepaliveinterval,'responsetimeout'=>$responsetimeout,'pinpattern'=>$pinpattern,'pinreplace'=>$pinreplace,'username'=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getTransceiverPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getTransceiverPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function approveTransceiverPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveTransceiverPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function getTransmitter(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getTransmitter', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = $this->logger->formatJson($result);
        			
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function requestTransmitter($pndgid='', $systemid='', $password='', $ip='', $port='', $ton='', $npi='', $origton='', $orignpi='', $destton='', $destnpi='', $systype='', $status='', $hostip='', $shortcode='', $keepaliveinterval='', $responsetimeout='', $pinpattern='', $pinreplace='', $username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestTransmitter', array('pndgid'=>$pndgid,'systemid'=>$systemid,'password'=>$password,'ip'=>$ip,'port'=>$port,'ton'=>$ton,'npi'=>$npi,'origton'=>$origton,'orignpi'=>$orignpi,'destton'=>$destton,'destnpi'=>$destnpi,'systype'=>$systype,'status'=>$status,'hostip'=>$hostip,'shortcode'=>$shortcode,'keepaliveinterval'=>$keepaliveinterval,'responsetimeout'=>$responsetimeout,'pinpattern'=>$pinpattern,'pinreplace'=>$pinreplace,'username'=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getTransmitterPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getTransmitterPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function approveTransmitterPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveTransmitterPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function getReceiver(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getReceiver', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = $this->logger->formatJson($result);
        			
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function requestReceiver($pndgid='', $systemid='', $password='', $ip='', $port='', $ton='', $npi='', $systype='', $status='', $hostip='', $shortcode='', $keepaliveinterval='', $responsetimeout='', $secured='', $username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestReceiver', array('pndgid'=>$pndgid,'systemid'=>$systemid,'password'=>$password,'ip'=>$ip,'port'=>$port,'ton'=>$ton,'npi'=>$npi,'systype'=>$systype,'status'=>$status,'hostip'=>$hostip,'shortcode'=>$shortcode,'keepaliveinterval'=>$keepaliveinterval,'responsetimeout'=>$responsetimeout,'secured'=>$secured,'username'=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getReceiverPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getReceiverPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function approveReceiverPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveReceiverPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function getServerConfig(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getServerConfig', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = $this->logger->formatJson($result);
        			
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function requestServerConfig($pndgid='', $ip='', $function='', $status='', $username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestServerConfig', array('pndgid'=>$pndgid,'ip'=>$ip,'function'=>$function,'status'=>$status,'username'=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getServerConfigPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getServerConfigPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function approveServerConfigPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveServerConfigPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function addTransceiver($systemid='',$password='',$ip='',$port='',$systype='',$hostip='',$shortcode=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addTransceiver', array('systemid'=>$systemid,'password'=>$password,'ip'=>$ip,'port'=>$port,'systype'=>$systype,'hostip'=>$hostip,'shortcode'=>$shortcode));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function addTransmitter($systemid='',$password='',$ip='',$port='',$systype='',$hostip='',$shortcode=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addTransmitter', array('systemid'=>$systemid,'password'=>$password,'ip'=>$ip,'port'=>$port,'systype'=>$systype,'hostip'=>$hostip,'shortcode'=>$shortcode));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function addReceiver($systemid='',$password='',$ip='',$port='',$systype='',$hostip='',$shortcode=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addReceiver', array('systemid'=>$systemid,'password'=>$password,'ip'=>$ip,'port'=>$port,'systype'=>$systype,'hostip'=>$hostip,'shortcode'=>$shortcode));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function addServerConfig($ip=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addServerConfig', array('ip'=>$ip));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function ReversalSearch($referenceid = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('ReversalSearch', array('referenceid' => $referenceid)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function RefundVoidSearch($referenceid = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('RefundVoidSearch', array('referenceid' => $referenceid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
		 	//print_r($ret);
        	return $ret;
        }
        
        
        public function requestRfndVoid($referenceid='', $type='', $msisdn='', $amount='', $extendeddata='', $remarks=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('requestRfndVoid', array('referenceid'=>$referenceid,'type'=>$type,'msisdn'=>$msisdn,'amount'=>$amount,'extendeddata'=>$extendeddata,'remarks'=>$remarks));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function requestReversal($referenceid='', $type='', $frmsisdn='', $tomsisdn='', $amount='', $extendeddata='', $remarks=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestReversal', array('referenceid'=>$referenceid,'type'=>$type,'frmsisdn'=>$frmsisdn,'tomsisdn'=>$tomsisdn,'amount'=>$amount,'extendeddata'=>$extendeddata,'remarks'=>$remarks));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getReversalPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getReversalPndg', array('username' => $username)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
            //print_r($ret);
        	return $ret;
        }
        
        public function getRefundVoidPndg($username = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getRefundVoidPndg', array('username' => $username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
		 	//print_r($ret);
        	return $ret;
        }
        
        public function approveReversalPndg($username='',$frmsisdn='',$tomsisdn='',$value='',$referenceid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveReversalPndg', array('username'=>$username,'frmsisdn'=>$frmsisdn,'tomsisdn'=>$tomsisdn,'value'=>$value,'referenceid'=>$referenceid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function approveRefundPndg($username='',$msisdn='',$value='',$referenceid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('approveRefundPndg', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'referenceid'=>$referenceid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function validateMSISDN($inp){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('validateMSISDN', array('inp'=>$inp));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function validateNickname($inp){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('validateNickname', array('inp'=>$inp));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function validateTID($inp){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('validateTID', array('inp'=>$inp));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function validateMID($inp){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('validateMID', array('inp'=>$inp));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function approveKYC($MSISDN,$userID, $terminalid, $merchantid, $serialnumber){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveKYC', array('MSISDN'=>$MSISDN,'userID'=>$userID,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'serialnumber'=>$serialnumber));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveKYCCashier($MSISDN,$userID, $terminalid, $merchantid, $cashierids, $cashiertids, $serialnumber){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveKYCCashier', array('MSISDN'=>$MSISDN,'userID'=>$userID,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'cashierids'=>$cashierids,'cashiertids'=>$cashiertids,'serialnumber'=>$serialnumber));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function rejectKYC($MSISDN,$userID, $reason){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('rejectKYC', array('MSISDN'=>$MSISDN,'userID'=>$userID,'reason'=>$reason));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }


        public function rejectKYCCashier($MSISDN, $cashierids, $userID, $reason){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('rejectKYCCashier', array('MSISDN'=>$MSISDN,'cashierids'=>$cashierids,'userID'=>$userID,'reason'=>$reason));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function sendbackKYC($MSISDN,$userID, $reason){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('sendbackKYC', array('MSISDN'=>$MSISDN,'userID'=>$userID,'reason'=>$reason));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function queryGlobal($query){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('queryGlobal', array('query'=>$query));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function transactionHistoryDetailsSearch($fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionHistoryDetailsSearch', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionReportsDetailsSearch($transtype = '', $fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionReportsDetailsSearch', array('transtype'=>$transtype,'fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function accountSummarySearch($perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('accountSummarySearch', array('perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function subscriberListSearch($type = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberListSearch', array('type'=>$type,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function allocateEVD($MSISDN,$Amount,$UserID,$Remarks){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('allocateEVD', array('MSISDN'=>$MSISDN,'Amount'=>$Amount,'UserID'=>$UserID,'Remarks'=>$Remarks));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function approveEVDAllocation($username='',$msisdn='',$value='',$transactionid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveEVDAllocation', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'transactionid'=>$transactionid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function updateAccountType($MSISDN='',$Type=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('updateAccountType', array('MSISDN'=>$MSISDN,'Type'=>$Type));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function deleteMobileIMSI($MSISDN=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('deleteMobileIMSI', array('MSISDN'=>$MSISDN));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
		//DELETETERMINALID
        public function deleteTerminalID($MSISDN=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('deleteTerminalID', array('MSISDN'=>$MSISDN));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		//DELETETERMINALID END
        
        public function getAirbonusTopup(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getAirbonusTopup', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestAirBonusTopup(
        	$id="",
        	$productID="",
        	$minRange="",
        	$maxRange="",
        	$serviceClass="",
        	$dedicatedAccountID="",
        	$fixedAmount="",
        	$percentAmount="",
        	$expiryDays="",
        	$expiryDate="",
        	$status="",
        	$createdDate="",
        	$modifyDate="",
        	$disableDate="",
        	$createdUser="",
        	$modifyUser="",
        	$disableUser="",
        	$name="",
        	$cellIDMinRange="",
        	$cellIDMaxRange="",
        	$currentUser=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestAirBonusTopup', array(
        		"id"=>$id,
        		"productID"=>$productID,
        		"minRange"=>$minRange,
        		"maxRange"=>$maxRange,
        		"serviceClass"=>$serviceClass,
        		"dedicatedAccountID"=>$dedicatedAccountID,
        		"fixedAmount"=>$fixedAmount,
        		"percentAmount"=>$percentAmount,
        		"expiryDays"=>$expiryDays,
        		"expiryDate"=>$expiryDate,
        		"status"=>$status,
        		"createdDate"=>$createdDate,
        		"modifyDate"=>$modifyDate,
        		"disableDate"=>$disableDate,
        		"createdUser"=>$createdUser,
        		"modifyUser"=>$modifyUser,
        		"disableUser"=>$disableUser,
        		"name"=>$name,
        		"cellIDMinRange"=>$cellIDMinRange,
        		"cellIDMaxRange"=>$cellIDMaxRange,
        		"username"=>$currentUser));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusByType(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusByType', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusByMSISDN(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusByMSISDN', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getCommissionsByType(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getCommissionsByType', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getCommissionsByMSISDN(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getCommissionsByMSISDN', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addAirBonusTopup($status="",$productID="",$serviceClass="",$dedicatedAccountID="",$minRange="",$maxRange="",$cellIDMinRange="",$cellIDMaxRange="",$fixedAmount="",$percentAmount="",$expiryDays="",$expiryDate="",$name="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addAirBonusTopup', array("status"=>$status,"productID"=>$productID,"serviceClass"=>$serviceClass,"dedicatedAccountID"=>$dedicatedAccountID,"minRange"=>$minRange,"maxRange"=>$maxRange,"cellIDMinRange"=>$cellIDMinRange,"cellIDMaxRange"=>$cellIDMaxRange,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"expiryDays"=>$expiryDays,"expiryDate"=>$expiryDate,"name"=>$name,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addBonusByType($status="",$account="",$name="",$key="",$type="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addBonusByType', array("status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"type"=>$type,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addBonusByMSISDN($status="",$account="",$name="",$key="",$msisdn="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addBonusByMSISDN', array("status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"msisdn"=>$msisdn,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addCommissionsByType($status="",$name="",$key="",$type="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addCommissionsByType', array("status"=>$status,"name"=>$name,"key"=>$key,"type"=>$type,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addCommissionsByMSISDN($status="",$name="",$key="",$msisdn="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addCommissionsByMSISDN', array("status"=>$status,"name"=>$name,"key"=>$key,"msisdn"=>$msisdn,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestBonusByType($id="",$status="",$account="",$name="",$key="",$type="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestBonusByType', array("id"=>$id,"status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"type"=>$type,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestBonusByMSISDN($id="",$status="",$account="",$name="",$key="",$msisdn="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestBonusByMSISDN', array("id"=>$id,"status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"msisdn"=>$msisdn,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestCommissionsByType($id="",$status="",$name="",$key="",$type="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestCommissionsByType', array("id"=>$id,"status"=>$status,"name"=>$name,"key"=>$key,"type"=>$type,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestCommissionsByMSISDN($id="",$status="",$name="",$key="",$msisdn="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestCommissionsByMSISDN', array("id"=>$id,"status"=>$status,"name"=>$name,"key"=>$key,"msisdn"=>$msisdn,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getAirbonusTopupPndg($username){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getAirbonusTopupPndg', array("username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusByTypePndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusByTypePndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusByMSISDNPndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusByMSISDNPndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getCommissionsByTypePndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getCommissionsByTypePndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getCommissionsByMSISDNPndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getCommissionsByMSISDNPndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        public function approveRejectBonusByTypePending($username,$id="",$remarks=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectBonusByTypePending', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        public function approveRejectBonusByMSISDNPending($id="",$remarks="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectBonusByMSISDNPending', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        public function approveRejectCommissionsByTypePending($username,$id="",$remarks=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectCommissionsByTypePending', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        public function approveRejectCommissionsByMSISDNPending($id="",$remarks="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectCommissionsByMSISDNPending', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveAirBonusTopupPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveAirbonusTopupPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        
        public function getAirConfig(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getAirConfig', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function requestAirConfig($airserverid="",$timeoffset="",$factor="",$url="",$ctype="",$agent="",
        	$ip="",$host="",$port="",$status="",$currencytype="",$authorization="",
        	$refillid="",$acceptdecimal="",$timeout="",$username=""){
        	
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestAirConfig', array(
        		"airserverid"=>$airserverid,"timeoffset"=>$timeoffset,"factor"=>$factor,"url"=>$url,"ctype"=>$ctype,"agent"=>$agent,
        		"ip"=>$ip,"host"=>$host,"port"=>$port,"status"=>$status,"currencytype"=>$currencytype,"authorization"=>$authorization,
        		"refillid"=>$refillid,"acceptdecimal"=>$acceptdecimal,"timeout"=>$timeout,"username"=>$username));
        	
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function addAirConfig($timeoffset="",$factor="",$url="",$ctype="",$agent="",
        	$ip="",$host="",$port="",$currencytype="",$authorization="",
        	$refillid="",$acceptdecimal="",$timeout=""){
        	
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addAirConfig', array(
        		"timeoffset"=>$timeoffset,"factor"=>$factor,"url"=>$url,"ctype"=>$ctype,"agent"=>$agent,
        		"ip"=>$ip,"host"=>$host,"port"=>$port,"currencytype"=>$currencytype,"authorization"=>$authorization,
        		"refillid"=>$refillid,"acceptdecimal"=>$acceptdecimal,"timeout"=>$timeout));
        	
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getAirConfigPndg($username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getAirConfigPndg', array("username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveAirConfigPndg($username='',$remarks='',$id=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveAirConfigPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}

        	return $ret;
        }
        
        public function approveTerminalIDPndg($username='',$remarks='',$id='', $msisdn='', $newmsisdn='', $terminalid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('approveTerminalIDPndg', array('username'=>$username,'remarks'=>$remarks,'id'=>$id, 'msisdn'=>$msisdn, 'newmsisdn'=>$newmsisdn, 'terminalid'=>$terminalid));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getKeyAllowedType(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getKeyAllowedType', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getKeyAllowedMSISDN(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getKeyAllowedMSISDN', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addKeyAllowedType($type="",$key="",$send="",$receive="",$priority="",$description=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addKeyAllowedType', array("type"=>$type,"key"=>$key,"send"=>$send,"receive"=>$receive,"priority"=>$priority,"description"=>$description,"status"=>"0"));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestKeyAllowedType($id="",$type="",$key="",$send="",$receive="",$priority="",$description="",$status="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestKeyAllowedType', array("id"=>$id,"type"=>$type,"key"=>$key,"send"=>$send,"receive"=>$receive,"priority"=>$priority,"description"=>$description,"status"=>$status,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addKeyAllowedMSISDN($msisdn="",$key="",$send="",$receive="",$priority="",$description=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addKeyAllowedMSISDN', array("msisdn"=>$msisdn,"key"=>$key,"send"=>$send,"receive"=>$receive,"priority"=>$priority,"description"=>$description,"status"=>"0"));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestKeyAllowedMSISDN($id="",$msisdn="",$key="",$send="",$receive="",$priority="",$description="",$status="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestKeyAllowedMSISDN', array("id"=>$id,"msisdn"=>$msisdn,"key"=>$key,"send"=>$send,"receive"=>$receive,"priority"=>$priority,"description"=>$description,"status"=>$status,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getKeyAllowedTypePndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getKeyAllowedTypePndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getKeyAllowedMSISDNPndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getKeyAllowedMSISDNPndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveRejectKeyAllowedType($id="",$remarks="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectKeyAllowedType', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveRejectKeyAllowedMSISDN($id="",$remarks="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectKeyAllowedMSISDN', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getKeyCostMSISDN(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getKeyCostMSISDN', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestKeyCostMSISDN($id="",$key="",$msisdn="",$account="",$fixed="",$percent="",$priority="",$status="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestKeyCostMSISDN', array("id"=>$id,"key"=>$key,"msisdn"=>$msisdn,"account"=>$account,"fixed"=>$fixed,"percent"=>$percent,"priority"=>$priority,"status"=>$status,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addKeyCostMSISDN($key="",$msisdn="",$account="",$fixed="",$percent="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addKeyCostMSISDN', array("key"=>$key,"msisdn"=>$msisdn,"account"=>$account,"fixed"=>$fixed,"percent"=>$percent,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getKeyCostMSISDNPndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getKeyCostMSISDNPndg', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveRejectKeyCostMSISDN($id="",$remarks=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectKeyCostMSISDN', array("id"=>$id,"remarks"=>$remarks));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getAMLByTypeSend(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getAMLByTypeSend', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getAMLByTypeReceive(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getAMLByTypeReceive', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getAMLByMSISDNSend(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getAMLByMSISDNSend', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getAMLByMSISDNReceive(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getAMLByMSISDNReceive', array());
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addAMLMSISDNSend($msisdn="",$key="",$priority="",$minAmount="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addAMLMSISDNSend', array("msisdn"=>$msisdn,"key"=>$key,"priority"=>$priority,"minAmount"=>$minAmount,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addAMLMSISDNReceive($msisdn="",$key="",$priority="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth="",$maxCurrentAmount=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addAMLMSISDNReceive', array("msisdn"=>$msisdn,"key"=>$key,"priority"=>$priority,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth,"maxCurrentAmount"=>$maxCurrentAmount));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestAMLMSISDNSend($id="",$msisdn="",$key="",$priority="",$minAmount="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestAMLMSISDNSend', array("id"=>$id,"msisdn"=>$msisdn,"key"=>$key,"priority"=>$priority,"minAmount"=>$minAmount,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestAMLMSISDNReceive($id="",$msisdn="",$key="",$priority="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth="",$maxCurrentAmount=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestAMLMSISDNReceive', array("id"=>$id,"msisdn"=>$msisdn,"key"=>$key,"priority"=>$priority,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth,"maxCurrentAmount"=>$maxCurrentAmount));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveRejectAMLMSISDNPndg($remarks='',$id='',$username=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveRejectAMLMSISDNPndg', array('remarks'=>$remarks,'id'=>$id,'username'=>$username));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addAMLTypeSend($type="",$key="",$priority="",$minAmount="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addAMLTypeSend', array("type"=>$type,"key"=>$key,"priority"=>$priority,"minAmount"=>$minAmount,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addAMLTypeReceive($type="",$key="",$priority="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth="",$maxCurrentAmount=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('addAMLTypeReceive', array("type"=>$type,"key"=>$key,"priority"=>$priority,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth,"maxCurrentAmount"=>$maxCurrentAmount));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestAMLTypeSend($id="",$type="",$key="",$priority="",$minAmount="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestAMLTypeSend', array("id"=>$id,"type"=>$type,"key"=>$key,"priority"=>$priority,"minAmount"=>$minAmount,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestAMLTypeReceive($id="",$type="",$key="",$priority="",$maxAmount="",$maxAmountDay="",$maxAmountMonth="",$maxTransDay="",$maxTransMonth="",$maxCurrentAmount=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('requestAMLTypeReceive', array("id"=>$id,"type"=>$type,"key"=>$key,"priority"=>$priority,"maxAmount"=>$maxAmount,"maxAmountDay"=>$maxAmountDay,"maxAmountMonth"=>$maxAmountMonth,"maxTransDay"=>$maxTransDay,"maxTransMonth"=>$maxTransMonth,"maxCurrentAmount"=>$maxCurrentAmount));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function allocateB2W($MSISDN,$Amount,$UserID,$Remarks,$BankReference,$image){
        	
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('allocateB2W', array('MSISDN'=>$MSISDN,'Amount'=>$Amount,'UserID'=>$UserID,'Remarks'=>$Remarks,'BankReference'=>$BankReference,'image'=>$image));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function getAllocationB2WPndg($username, $status='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getAllocationB2WPndg', array('username'=>$username,'status'=>$status));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getAllocationB2WPndgIMAGE($username, $referenceid='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getAllocationB2WPndgIMAGE', array('username'=>$username,'referenceid'=>$referenceid));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getIdIMAGE($username, $msisdn='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getIdIMAGE', array('username'=>$username,'msisdn'=>$msisdn));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getIdIMAGESMB($username,$image,$msisdn='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getIdIMAGESMB', array('username'=>$username,'msisdn'=>$msisdn, 'image'=>$image));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getIdIMAGEBNK($username, $image, $msisdn='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	//$result = $client->call('getIdIMAGESMB', array('username'=>$username,'msisdn'=>$msisdn));
        	$result = $client->call('getIdIMAGEBNK', array('username'=>$username,'msisdn'=>$msisdn, 'image'=>$image));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function confirmAllocationB2W($username='',$msisdn='',$value='',$transactionid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('confirmAllocationB2W', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'transactionid'=>$transactionid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function confirmAllocationW2B($username='',$msisdn='',$value='',$transactionid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('confirmAllocationW2B', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'transactionid'=>$transactionid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveAllocationB2W($username='',$msisdn='',$value='',$transactionid='',$bankref=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveAllocationB2W', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'transactionid'=>$transactionid,'bankref'=>$bankref));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveAllocationW2B($username='',$msisdn='',$value='',$transactionid='',$accountnumber='',$bank='',$reference=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveAllocationW2B', array('username'=>$username,'msisdn'=>$msisdn,'value'=>$value,'transactionid'=>$transactionid,'accountnumber'=>$accountnumber,'bank'=>$bank,'reference'=>$reference));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getCommissionsPndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getCommissionsPndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getDlerCommissionsPndg($fromdate = '', $todate = '', $perpage='10', $pagenum='1', $rtype = 'page', $remarks = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getDlerCommissionsPndg', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype,'remarks'=>$remarks));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveRejectCommissionsPending($id='',$remarks='',$username='',$fromdate='',$todate=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveRejectCommissionsPending', array('id'=>$id,'remarks'=>$remarks,'username'=>$username,'fromdate'=>$fromdate,'todate'=>$todate));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveRejectCommissionsPendingForConfirmation($id='',$remarks='',$username='',$fromdate='',$todate=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveRejectCommissionsPendingForConfirmation', array('id'=>$id,'remarks'=>$remarks,'username'=>$username,'fromdate'=>$fromdate,'todate'=>$todate));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionFailed($fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('transactionFailed', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionMpos($fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('transactionMpos', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getStatementKey($MSISDN="",$DateFrom="",$DateTo="",$Key=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getStatementKey', array('MSISDN'=>$MSISDN,'DateFrom'=>$DateFrom,'DateTo'=>$DateTo,'Key'=>$Key));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function subscriberPendingSearch($skey='', $value='', $perpage = '15', $pagenum = '1'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberPendingSearch', array('skey'=>$skey,'value'=>$value,'perpage'=>$perpage,'pagenum'=>$pagenum));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
        
        public function getDlerCommissionsDetail($fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getDlerCommissionsDetail', array('fromdate'=>$fromdate,'todate'=>$todate));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveRejectCommissions1PendingForConfirmation($remarks='',$username='',$fromdate='',$todate='',$commissionType='',$walletid='2'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveRejectCommissions1PendingForConfirmation', array('id'=>$id,'remarks'=>$remarks,'username'=>$username,'fromdate'=>$fromdate,'todate'=>$todate,'commissionType'=>$commissionType,'walletid'=>$walletid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getDlerCommissionsDetailForApproval($fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getDlerCommissionsDetailForApproval', array('fromdate'=>$fromdate,'todate'=>$todate));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveRejectCommissions1PendingForApproval($remarks='',$username='',$fromdate='',$todate='',$commissionType='',$walletid='2'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('approveRejectCommissions1PendingForApproval', array('id'=>$id,'remarks'=>$remarks,'username'=>$username,'fromdate'=>$fromdate,'todate'=>$todate,'commissionType'=>$commissionType,'walletid'=>$walletid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getDlerCommissionsFiles($status = '0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getDlerCommissionsFiles', array('status'=>$status));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveRejectCommissionsForConfirmation($remarks='',$username='',$runid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectCommissionsForConfirmation', array('remarks'=>$remarks,'username'=>$username,'runid'=>$runid));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveRejectCommissionsForApproval($remarks='',$username='',$runid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectCommissionsForApproval', array('remarks'=>$remarks,'username'=>$username,'runid'=>$runid));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getDlerCommissionsFilesSummary($runid=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getDlerCommissionsFilesSummary', array('runid'=>$runid));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function updateIdIMAGE($msisdn='', $image='', $UserID=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('updateIdIMAGE', array('msisdn'=>$msisdn,'image'=>$image,'UserID'=>$UserID));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getDlerCommissionsDetails($perpage='10', $pagenum='1', $rtype = 'page', $title = '', $runid='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getDlerCommissionsDetails', array('perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype,'title'=>$title,'runid'=>$runid));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        
        public function getBonusAirByType(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusAirByType', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusAirByMSISDN(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusAirByMSISDN', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addBonusAirByType($status="",$account="",$name="",$key="",$type="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addBonusAirByType', array("status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"type"=>$type,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function addBonusAirByMSISDN($status="",$account="",$name="",$key="",$msisdn="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('addBonusAirByMSISDN', array("status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"msisdn"=>$msisdn,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestBonusAirByType($id="",$status="",$account="",$name="",$key="",$type="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestBonusAirByType', array("id"=>$id,"status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"type"=>$type,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function requestBonusAirByMSISDN($id="",$status="",$account="",$name="",$key="",$msisdn="",$fixedAmount="",$percentAmount="",$priority="",$amountFrom="",$amountTo="",$accountFrom="",$accountTo="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestBonusAirByMSISDN', array("id"=>$id,"status"=>$status,"account"=>$account,"name"=>$name,"key"=>$key,"msisdn"=>$msisdn,"fixedAmount"=>$fixedAmount,"percentAmount"=>$percentAmount,"priority"=>$priority,"amountFrom"=>$amountFrom,"amountTo"=>$amountTo,"accountFrom"=>$accountFrom,"accountTo"=>$accountTo,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusAirByTypePndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusAirByTypePndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getBonusAirByMSISDNPndg(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getBonusAirByMSISDNPndg', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveRejectBonusAirByTypePending($username,$id="",$remarks=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectBonusAirByTypePending', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveRejectBonusAirByMSISDNPending($id="",$remarks="",$username=""){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveRejectBonusAirByMSISDNPending', array("id"=>$id,"remarks"=>$remarks,"username"=>$username));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPosItemList(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPosItemList', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPosItemSearch($itemcode=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPosItemSearch', array("itemcode"=>$itemcode));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPosItemUpdate($itemcode='',$itemname='',$unitcode='',$priceperunit='',$subvention='',$barcode=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPosItemUpdate', array("itemcode"=>$itemcode,"itemname"=>$itemname,"unitcode"=>$unitcode,"priceperunit"=>$priceperunit,"subvention"=>$subvention,"barcode"=>$barcode));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPosItemAdd($itemcode='',$itemname='',$unitcode='',$priceperunit='',$subvention='',$barcode='',$unit='',$validitycode=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPosItemAdd', array("itemcode"=>$itemcode,"itemname"=>$itemname,"unitcode"=>$unitcode,"priceperunit"=>$priceperunit,"subvention"=>$subvention,"barcode"=>$barcode,"unit"=>$unit,"validitycode"=>$validitycode));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPosTBLNBECONFIG(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPosTBLNBECONFIG', array());
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPosTBLNBECONFIGUpdate($url='',$port='',$header='',$forcepin='',$cvm=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPosTBLNBECONFIGUpdate', array("url"=>$url,"port"=>$port,"header"=>$header,"forcepin"=>$forcepin,"cvm"=>$cvm));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function mPOSupdate($MSISDN, $terminalid, $serialnumber){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('mPOSupdate', array('MSISDN'=>$MSISDN,'terminalid'=>$terminalid,'serialnumber'=>$serialnumber));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function searchList($skey, $inpOption, $skey2=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('searchList', array('skey' => $skey, 'inpOption' => $inpOption, 'skey2' => $skey2)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }

        
        
        
        public function searchVmallsList($skey = '', $type = '', $datefrom = '', $dateto = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('searchVmallsList', array('skey' => $skey, 'type' => $type, 'datefrom' => $datefrom, 'dateto' => $dateto));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        
        public function vmallsBasketDetails($referenceid = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('vmallsBasketDetails', array('referenceid' => $referenceid));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function searchListSubs($skey = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE['wsdl'],'WSDL');
        	$err = $client->getError();
        	
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('searchListSubs', array('skey' => $skey)); 
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	
        	return $ret;
        }
        
        public function registerAccountMPOS($MSISDN,$Alias,$Gender,$LastName,$MiddleName,
        	$FirstName,$EmailAddress,$DateOfBirth,$IDNumber,$IDDesc,$IDExpiry,
        	$Nationality,$BirthPlace,$CityID,$RegionID,$CountryID,
        	$Type,$KYC,$Status,$ReferenceAccount,$UserID,$BuildingName,
        	$StreetName,$CompanyName,$Profession,$Locked,$AltNumber,
        	$AuthorizingLastName,$AuthorizingFirstName,$AuthorizingIDNumber,
        	$AuthorizingIDDesc,$AuthorizingMsisdn,
        	$corpdateofincorporation,$corpbusinessname,$corptradelicensenumber,$corpregistredaddress,$corptypeofbusiness,$corpownershipinfo,$tinnumber,
        	$image,
        	$sessionmsisdn,$terminalid,$merchantid,$serialno,
        	$image2,$image3,
        	$corpbuilding,$corpstreet,$corpcity,$corpfloor,$corparea,
        	$corppobox,$idissuancedate,$mercdiscountrate,$cashdiscountrate,$cashtransfee,
        	$corpreceiptname,$cashtype,$devicetype,$mcvisafee='0',$othersfee='0'){

        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('registerAccountMPOS', array('AuthorizingLastName'=>$AuthorizingLastName,'AuthorizingFirstName'=>$AuthorizingFirstName,'AuthorizingIDNumber'=>$AuthorizingIDNumber,
        		'AuthorizingIDDesc'=>$AuthorizingIDDesc,'AuthorizingMsisdn'=>$AuthorizingMsisdn,
        		'MSISDN'=>$MSISDN,'Alias'=>$Alias,'Gender'=>$Gender,'LastName'=>$LastName,'MiddleName'=>$MiddleName,
        		'FirstName'=>$FirstName,'EmailAddress'=>$EmailAddress,'DateOfBirth'=>$DateOfBirth,'IDNumber'=>$IDNumber,'IDDesc'=>$IDDesc,'IdExpiryDate'=>$IDExpiry,
        		'Nationality'=>$Nationality,'BirthPlace'=>$BirthPlace,'CityID'=>$CityID,'RegionID'=>$RegionID,'CountryID'=>$CountryID,
        		'Type'=>$Type,'KYC'=>$KYC,'Status'=>$Status,'ReferenceAccount'=>$ReferenceAccount,'UserID'=>$UserID,'BuildingName'=>$BuildingName,
        		'StreetName'=>$StreetName,'CompanyName'=>$CompanyName,'Profession'=>$Profession,'Locked'=>$Locked,'AltNumber'=>$AltNumber,
        		'corpdateofincorporation'=>$corpdateofincorporation,'corpbusinessname'=>$corpbusinessname,'corptradelicensenumber'=>$corptradelicensenumber,'corpregisteredaddress'=>$corpregistredaddress,'corptypeofbusiness'=>$corptypeofbusiness,'corpownershipinfo'=>$corpownershipinfo,
        		'tinnumber'=>$tinnumber,'image'=>$image,
        		'sessionmsisdn'=>$sessionmsisdn,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'serialno'=>$serialno,
        		'image2'=>$image2,'image3'=>$image3,
        		'mcvisafee'=>$mcvisafee,'othersfee'=>$othersfee,
        		'corpbuilding'=>$corpbuilding,'corpstreet'=>$corpstreet,
        		'corpcity'=>$corpcity,'corpfloor'=>$corpfloor,
        		'corparea'=>$corparea,'corppobox'=>$corppobox,
        		'idissuancedate'=>$idissuancedate,'mercdiscountrate'=>$mercdiscountrate,
        		'cashdiscountrate'=>$cashdiscountrate,'cashtransfee'=>$cashtransfee,
        		'corpreceiptname'=>$corpreceiptname,'cashtype'=>$cashtype,'devicetype'=>$devicetype));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        
        public function registerAccountStore($MSISDN,$Alias,$Gender,$LastName,$MiddleName,
        	$FirstName,$EmailAddress,$DateOfBirth,$IDNumber,$IDDesc,$IDExpiry,
        	$Nationality,$BirthPlace,$CityID,$RegionID,$CountryID,
        	$Type,$StoreType,$KYC,$Status,$ReferenceAccount,$UserID,$BuildingName,
        	$StreetName,$CompanyName,$Profession,$Locked,$AltNumber,
        	$AuthorizingLastName,$AuthorizingFirstName,$AuthorizingIDNumber,
        	$AuthorizingIDDesc,$AuthorizingMsisdn,
        	$corpdateofincorporation,$corpbusinessname,$corptradelicensenumber,$corpregistredaddress,$corptypeofbusiness,$corpownershipinfo,$tinnumber,
        	$image,
        	$sessionmsisdn,$terminalid,$merchantid,$serialno,
        	$image2,$image3,
        	$corpbuilding,$corpstreet,$corpcity,$corpfloor,$corparea,
        	$corppobox,$idissuancedate,$mercdiscountrate,$cashdiscountrate,$cashtransfee,
        	$corpreceiptname,$cashtype,$cashier,$devicetype, $corponboardedby,
        	$mcvisafee='0',$othersfee='0'){
        	
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('registerAccountStore', array('AuthorizingLastName'=>$AuthorizingLastName,'AuthorizingFirstName'=>$AuthorizingFirstName,'AuthorizingIDNumber'=>$AuthorizingIDNumber,
        		'AuthorizingIDDesc'=>$AuthorizingIDDesc,'AuthorizingMsisdn'=>$AuthorizingMsisdn,
        		'MSISDN'=>$MSISDN,'Alias'=>$Alias,'Gender'=>$Gender,'LastName'=>$LastName,'MiddleName'=>$MiddleName,
        		'FirstName'=>$FirstName,'EmailAddress'=>$EmailAddress,'DateOfBirth'=>$DateOfBirth,'IDNumber'=>$IDNumber,'IDDesc'=>$IDDesc,'IdExpiryDate'=>$IDExpiry,
        		'Nationality'=>$Nationality,'BirthPlace'=>$BirthPlace,'CityID'=>$CityID,'RegionID'=>$RegionID,'CountryID'=>$CountryID,
        		'Type'=>$Type, 'StoreType'=>$StoreType, 'KYC'=>$KYC,'Status'=>$Status,'ReferenceAccount'=>$ReferenceAccount,'UserID'=>$UserID,'BuildingName'=>$BuildingName,
        		'StreetName'=>$StreetName,'CompanyName'=>$CompanyName,'Profession'=>$Profession,'Locked'=>$Locked,'AltNumber'=>$AltNumber,
        		'corpdateofincorporation'=>$corpdateofincorporation,'corpbusinessname'=>$corpbusinessname,'corptradelicensenumber'=>$corptradelicensenumber,'corpregisteredaddress'=>$corpregistredaddress,'corptypeofbusiness'=>$corptypeofbusiness,'corpownershipinfo'=>$corpownershipinfo,
        		'tinnumber'=>$tinnumber,'image'=>$image,
        		'sessionmsisdn'=>$sessionmsisdn,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'serialno'=>$serialno,
        		'image2'=>$image2,'image3'=>$image3,
        		'mcvisafee'=>$mcvisafee,'othersfee'=>$othersfee,
        		'corpbuilding'=>$corpbuilding,'corpstreet'=>$corpstreet,
        		'corpcity'=>$corpcity,'corpfloor'=>$corpfloor,
        		'corparea'=>$corparea,'corppobox'=>$corppobox,
        		'idissuancedate'=>$idissuancedate,'mercdiscountrate'=>$mercdiscountrate,
        		'cashdiscountrate'=>$cashdiscountrate,'cashtransfee'=>$cashtransfee,
        		'corpreceiptname'=>$corpreceiptname,'cashtype'=>$cashtype, 'cashier'=>$cashier, 'devicetype'=>$devicetype, 'corponboardedby'=>$corponboardedby));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function detailedMposRevenueReport($fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('detailedMposRevenueReport', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function summaryMposRevenueReport($fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('summaryMposRevenueReport', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionHistoryDetailsSearchMPOS($transtype = '', $fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionHistoryDetailsSearchMPOS', array('transtype'=>$transtype,'fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionReportsDetailsSearchMPOS($selecttype, $typevalue, $transtype = '', $fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionReportsDetailsSearchMPOS', array('selecttype'=>$selecttype,'typevalue'=>$typevalue,'transtype'=>$transtype,'fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        
        public function statementReceipt($referenceid){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('statementReceipt', array('referenceid'=>$referenceid));
			//print_r($result);
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionReportsMercRevenue($reportselecttype, $selecttype, $typevalue, $transtype = '', $fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionReportsMercRevenue', array('reportselecttype'=>$reportselecttype,'selecttype'=>$selecttype,'typevalue'=>$typevalue,'transtype'=>$transtype,'fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
			//print_r($result);
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function globalSearchMPOS($subscriber='', $skey='', $value='', $transtype='', $fromdate='', $todate=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('globalSearchMPOS', array('subscriber'=>$subscriber,'skey'=>$skey,'value'=>$value,'value'=>$value,'transtype'=>$transtype,'fromdate'=>$fromdate,'todate'=>$todate));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
        	return $ret;
        }
        
        public function getStatementMPOS($MSISDN,$DateFrom,$DateTo){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('getStatementMPOS', array('MSISDN'=>$MSISDN,'DateFrom'=>$DateFrom,'DateTo'=>$DateTo));
        	
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function globalSearchReferenceIDMPOS($referenceid='', $fromdate='', $todate='', $selecttype=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('globalSearchReferenceIDMPOS', array('referenceid'=>$referenceid,'fromdate'=>$fromdate, 'todate'=>$todate, 'selecttype'=>$selecttype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function getMposCustomerDetailsCBCM($msisdn){
        	
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('getMposCustomerDetailsCBCM', array('msisdn'=>$msisdn));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function uploadCashier($username, $filepath, $master, $accountType, $newStore){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('uploadCashier', array('username'=>$username,'filepath'=>$filepath,'master'=>$master, 'accountType'=>$accountType, 'newStore'=>$newStore));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}				
			//print_r($ret);
        	return $ret;
        }
        
        public function registeredMerchantsReport($boardedby = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('registeredMerchantsReport', array('boardedby'=>$boardedby,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function registeredMerchantsActiveReport($boardedby = '', $perpage = '15', $pagenum = '1', $rtype = 'page', $days = '30'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('registeredMerchantsActiveReport', array('boardedby'=>$boardedby,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype,'days'=>$days));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function transactionSummaryReport($fromdate = '', $todate = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('transactionSummaryReport', array('fromdate'=>$fromdate,'todate'=>$todate));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
//register SMB Accoount
        public function registerSMBAccount(
        	$MSISDN,
        	$Alias,
        	$Gender,
        	$LastName,
        	$MiddleName,
        	$FirstName,
        	$EmailAddress,
        	$DateOfBirth,
        	$IDNumber,
        	$IDDesc,
        	$IDExpiry,
        	$Nationality,
        	$BirthPlace,
        	$CityID,
        	$RegionID,
        	$CountryID,
        	$Type,
        	$StoreType,
        	$KYC,
        	$Status,
        	$ReferenceAccount,
        	$UserID,
        	$BuildingName,
        	$StreetName,
        	$CompanyName,
        	$Profession,
        	$Locked,
        	$AltNumber,
        	$AuthorizingLastName,
        	$AuthorizingFirstName,
        	$AuthorizingIDNumber,
        	$AuthorizingIDDesc,
        	$AuthorizingMsisdn,
        	$corpdateofincorporation,
        	$corpbusinessname,
        	$corptradelicensenumber,
        	$corpregistredaddress,
        	$corptypeofbusiness,
        	$corpownershipinfo,
        	$tinnumber,
        	$sessionmsisdn,
        	$terminalid,
        	$merchantid,
        	$serialno,
        	$corpbuilding,
        	$corpstreet,
        	$corpcity,
        	$corpfloor,
        	$corparea,
        	$corppobox,
        	$idissuancedate,
        	$mercdiscountrate,
        	$cashdiscountrate,
        	$cashtransfee,
        	$corpreceiptname,
        	$cashtype,
        	$cashier,
        	$nonpremium,
        	$devicetype,
        	$contactno,
        	$corponboardedby,
        	$isMPOSOnly,
        		$furl1,$furl2,$furl3,$furl4,$furl5,$furl6,$furl7,$furl8,$furl9,$furl10,$regtrn,$mcvisafee='0',$othersfee='0'){

        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('registerSMBAccount', array(
        		'AuthorizingLastName'=>$AuthorizingLastName,
        		'AuthorizingFirstName'=>$AuthorizingFirstName,
        		'AuthorizingIDNumber'=>$AuthorizingIDNumber,
        		'AuthorizingIDDesc'=>$AuthorizingIDDesc,
        		'AuthorizingMsisdn'=>$AuthorizingMsisdn,
        		'MSISDN'=>$MSISDN,
        		'Alias'=>$Alias,
        		'Gender'=>$Gender,
        		'LastName'=>$LastName,
        		'MiddleName'=>$MiddleName,
        		'FirstName'=>$FirstName,
        		'EmailAddress'=>$EmailAddress,
        		'DateOfBirth'=>$DateOfBirth,
        		'IDNumber'=>$IDNumber,
        		'IDDesc'=>$IDDesc,
        		'IdExpiryDate'=>$IDExpiry,
        		'Nationality'=>$Nationality,
        		'BirthPlace'=>$BirthPlace,
        		'CityID'=>$CityID,
        		'RegionID'=>$RegionID,
        		'CountryID'=>$CountryID,
        		'Type'=>$Type,
        		'StoreType'=>$StoreType,
        		'KYC'=>$KYC,
        		'Status'=>$Status,
        		'ReferenceAccount'=>$ReferenceAccount,
        		'UserID'=>$UserID,
        		'BuildingName'=>$BuildingName,
        		'StreetName'=>$StreetName,
        		'CompanyName'=>$CompanyName,
        		'Profession'=>$Profession,
        		'Locked'=>$Locked,
        		'AltNumber'=>$AltNumber,
        		'corpdateofincorporation'=>$corpdateofincorporation,
        		'corpbusinessname'=>$corpbusinessname,
        		'corptradelicensenumber'=>$corptradelicensenumber,
        		'corpregisteredaddress'=>$corpregistredaddress,
        		'corptypeofbusiness'=>$corptypeofbusiness,
        		'corpownershipinfo'=>$corpownershipinfo,
        		'tinnumber'=>$tinnumber,
        		'sessionmsisdn'=>$sessionmsisdn,
        		'terminalid'=>$terminalid,
        		'merchantid'=>$merchantid,
        		'serialno'=>$serialno,
        		'mcvisafee'=>$mcvisafee,'othersfee'=>$othersfee,
        		'corpbuilding'=>$corpbuilding,
        		'corpstreet'=>$corpstreet,
        		'corpcity'=>$corpcity,
        		'corpfloor'=>$corpfloor,
        		'corparea'=>$corparea,
        		'corppobox'=>$corppobox,
        		'idissuancedate'=>$idissuancedate,
        		'mercdiscountrate'=>$mercdiscountrate,
        		'cashdiscountrate'=>$cashdiscountrate,
        		'cashtransfee'=>$cashtransfee,
        		'corpreceiptname'=>$corpreceiptname,
        		'cashtype'=>$cashtype,
        		'cashier'=>$cashier,
        		'nonpremium'=>$nonpremium,
        		'devicetype'=>$devicetype, 
        		'contactno'=>$contactno,
        		'corponboardedby'=>$corponboardedby, 
        		'isMPOSOnly'=>$isMPOSOnly,
    			'furl1'=>$furl1,
    			'furl2'=>$furl2,
    			'furl3'=>$furl3,
    			'furl4'=>$furl4,
    			'furl5'=>$furl5,
    			'furl6'=>$furl6,
    			'furl7'=>$furl7,
    			'furl8'=>$furl8,
    			'furl9'=>$furl9,
    			'furl10'=>$furl10,
				'TRN'=>$regtrn));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function subscriberPendingApproved($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberPendingApproved', array('skey'=>$skey,'value'=>$value));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
        
        public function subscriberRejected($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberRejected', array('skey'=>$skey,'value'=>$value));
        	$this->logger->WriteLog(var_export( array('skey'=>$skey,'value'=>$value),true));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
        
        public function subscriberCompliance($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberCompliance', array('skey'=>$skey,'value'=>$value));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
			//print_r($ret);				
        	return $ret;
        }

        public function approveSMBKYCProcessor($MSISDN,$userID, $id){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveSMBKYCProcessor', array('MSISDN'=>$MSISDN,'userID'=>$userID, 'id'=>$id));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveSMBKYCProcessorCashier($MSISDN,$userID, $id, $cashierids, $cashiertids, $vatfunctionality, $corppackages){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveSMBKYCProcessorCashier', array('MSISDN'=>$MSISDN,'userID'=>$userID,'id'=>$id,'cashierids'=>$cashierids,'cashiertids'=>$cashiertids, 'cashierproducts'=>$corppackages, 'vatfuctionality'=>$vatfunctionality));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function approveSMBKYC($MSISDN,$userID, $terminalid, $merchantid, $serialnumber){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveSMBKYC', array('MSISDN'=>$MSISDN,'userID'=>$userID,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'serialnumber'=>$serialnumber));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function approveSMBKYCCashier($MSISDN,$userID, $terminalid, $merchantid, $cashierids, $cashiertids, $serialnumber, $image4, $image5, $image6,$image7,$image8,$appID){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	//$result = $client->call('approveSMBKYCCashier', array('MSISDN'=>$MSISDN,'userID'=>$userID,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'cashierids'=>$cashierids,'cashiertids'=>$cashiertids,'serialnumber'=>$serialnumber,'image4'=>$_SESSION['sendBackImage4'],'image5'=>$_SESSION['sendBackImage5'],'image6'=>$_SESSION['sendBackImage6'],'image7'=>$_SESSION['sendBackImage7'],'image8'=>$_SESSION['sendBackImage8'],'appID'=>$appID));

        	$result = $client->call('approveSMBKYCCashier', array('MSISDN'=>$MSISDN,'userID'=>$userID,'terminalid'=>$terminalid,'merchantid'=>$merchantid,'cashierids'=>$cashierids,'cashiertids'=>$cashiertids,'serialnumber'=>$serialnumber,'image4'=>$_SESSION['imageB2W'],'image5'=>$_SESSION['imagenew1'],'image6'=>$_SESSION['imagenew2'],'image7'=>$_SESSION['imagenew3'],'image8'=>$_SESSION['imagenew4'],'appID'=>$appID,'furl1'=>$_SESSION['urlBfile1'],'furl2'=>$_SESSION['urlBfile2'],'furl3'=>$_SESSION['urlBfile3'],'furl4'=>$_SESSION['urlBfile4'],'furl5'=>$_SESSION['urlBfile5']));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function rejectSMBKYC($MSISDN,$userID, $reason){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('rejectSMBKYC', array('MSISDN'=>$MSISDN,'userID'=>$userID,'reason'=>$reason));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }


        public function rejectSMBKYCCashier($MSISDN, $cashierids, $userID, $reason){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('rejectSMBKYCCashier', array('MSISDN'=>$MSISDN,'cashierids'=>$cashierids,'userID'=>$userID,'reason'=>$reason));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function sendbackSMBKYC($MSISDN,$userID, $reason, $appID, $s1, $s2, $s3, $s4, $s5){
        	$ret = new ServiceResponse();
        	//var_dump($s1." | ".$s2." | ".$s3." | ".$s4." | ".$s5." | ".$appID);
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	$val1="";
        	$val2="";
        	$val3="";
        	$val4="";
        	$val5="";

        	if($s1=='REG'){
				$val1=$_SESSION['imageB2W'];
			}
			if($s2=='REG'){
				$val2=$_SESSION['imagenew1'];
			}
			if($s3=='REG'){
				$val3=$_SESSION['imagenew2'];
			}
			if($s4=='REG'){
				$val4=$_SESSION['imagenew3'];
			}
			if($s5=='REG'){
				$val5=$_SESSION['imagenew4'];
			}

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('sendbackSMBKYC', array('MSISDN'=>$MSISDN,'userID'=>$userID,'reason'=>$reason,'image4'=>$val1,'image5'=>$val2,'image6'=>$val3,'image7'=>$val4,'image8'=>$val5,'appID'=>$appID,'furl1'=>$_SESSION['urlBfile1'],'furl2'=>$_SESSION['urlBfile2'],'furl3'=>$_SESSION['urlBfile3'],'furl4'=>$_SESSION['urlBfile4'],'furl5'=>$_SESSION['urlBfile5']));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function sendbackToBank($compname,
									 $accType,
									 $corpboard,
									 $corparea,
									 $city,
									 $pobox,
									 $corpreceiptname,
									 $pFName,
									 $pLname,
									 $authNumber2,
									 $pEmail,
									 $mercdiscountrate,
									 $mercdiscountratenonp,
									 $cashdiscountrate,
									 $imgstat1,
									 $imgstat2,
									 $imgstat3,
									 $imgstat4,
									 $imgstat5,
									 $imgstat6,
									 $imgstat7,
									 $imgstat8,
									 $imgstat9,
									 $imgstat10,
									 $id,
									 $appID){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('updateSMBPNDGAccount', array('CompanyName'=>$compname,
									 'Type'=>$accType,
									 'corponboardedby'=>$corpboard,
									 'corparea'=>$corparea,
									 'CityID'=>$city,
									 'corppobox'=>$pobox,
									 'corpreceiptname'=>$corpreceiptname,
									 'AuthorizingFirstName'=>$pFName,
									 'AuthorizingLastName'=>$pLname,
									 'MSISDN'=>$authNumber2,
									 'EmailAddress'=>$pEmail,
									 'mercdiscountrate'=>$mercdiscountrate,
									 'mercdiscountratenonp'=>$mercdiscountratenonp,
									 'cashdiscountrate'=>$cashdiscountrate,
									 'imgstat'=>$imgstat1,
									 'imgstat2'=>$imgstat2,
									 'imgstat3'=>$imgstat3,
									 'imgstat4'=>$imgstat4,
									 'imgstat5'=>$imgstat5,
									 'imgstat6'=>$imgstat6,
									 'imgstat7'=>$imgstat7,
									 'imgstat8'=>$imgstat8,
									 'imgstat9'=>$imgstat9,
									 'imgstat10'=>$imgstat10,
									 'ID'=>$id,
									 'image'=>$_SESSION['imageB2W'],
									 'image2'=>$_SESSION['imagenew1'],
									 'image3'=>$_SESSION['imagenew2'],
									 'image4'=>$_SESSION['imagenew3'],
									 'image5'=>$_SESSION['imagenew4'],
									 'image6'=>$_SESSION['imagenew5'],
									 'image7'=>$_SESSION['imagenew6'],
									 'image8'=>$_SESSION['imagenew7'],
									 'image9'=>$_SESSION['imagenew8'],
									 'image10'=>$_SESSION['imagenew9'],
									 'appID'=>$appID,
									 'userID'=>$_SESSION['currentUserID'],
									 'furl1'=>$_SESSION['urlBfile1'],
									 'furl2'=>$_SESSION['urlBfile2'],
									 'furl3'=>$_SESSION['urlBfile3'],
									 'furl4'=>$_SESSION['urlBfile4'],
									 'furl5'=>$_SESSION['urlBfile5'],
									 'furl6'=>$_SESSION['urlBfile6'],
									 'furl7'=>$_SESSION['urlBfile7'],
									 'furl8'=>$_SESSION['urlBfile8'],
									 'furl9'=>$_SESSION['urlBfile9'],
									 'furl10'=>$_SESSION['urlBfile10']
									 ));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function sendbackSMBKYCApp($MSISDN, $reason){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('sentBankRequest', array('ID'=>$MSISDN,'reason'=>$reason));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function searchSMB($inp, $option){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('searchSMB', array('inp'=>$inp,'option'=>$option));
				//$this->logger->WriteLog(var_export(array('inp'=>$inp,'option'=>$option),true));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
				//$this->logger->WriteLog(var_export(json_decode(base64_decode($result),true)));
				//$this->logger->WriteLog(var_export('NO RESPONSE',true));
        	return $ret;
        }
        
        public function subscriberForProcessor($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberForProcessor', array('skey'=>$skey,'value'=>$value));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
        
        public function searchSMBprocessor($inp, $option){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = $client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('searchSMBprocessor', array('inp'=>$inp,'option'=>$option));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);
				//$this->logger->WriteLog(var_export(json_decode(base64_decode($result),true)));
				//$this->logger->WriteLog(var_export('NO RESPONSE',true));
        	return $ret;
        }
        
        public function processorApprove($MSISDN, $userID, $id){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('processorApprove', array('MSISDN'=>$MSISDN,'userID'=>$userID, 'id'=>$id));
				//$parameters = array('MSISDN'=>$MSISDN,'userID'=>$userID, 'id'=>$id);
				//$this->logger->WriteLog(var_export($parameters,true));
        	$this->logger->WriteLog(var_export($result,true));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//$this->logger->WriteLog(var_export(json_decode(base64_decode($result)),true));
        	return $ret;
        }
        
        public function subscriberForSharafdg($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberForSharafdg', array('skey'=>$skey,'value'=>$value));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);	
        	
        	return $ret;
        }
        
        public function activateAccount($id, $userID){
        	$this->logger->WriteLog(var_export('activate account Subscriber Services',true));
        	
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('activateAccount', array('id'=>$id,'userID'=>$userID));
        	$this->logger->WriteLog(var_export('activate account Subscriber Services Service call',true));
        	
        	$this->logger->WriteLog(var_export(array('id'=>$id,'userID'=>$userID),true));	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);	
//$this->logger->WriteLog(var_export(json_decode(base64_decode($result)),true));				
        	return $ret;
        }
        
        public function updateSMBAccount($MSISDN, $userID, $LastName, $FirstName, $Email, $Area, $City, $Pobox, $CorpBusinessName, $CorpReceiptName){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('updateSMBAccount', array('MSISDN'=>$MSISDN,'userID'=>$userID, 'Lastname'=>$LastName,'Firstname'=>$FirstName,
        		'Email'=>$Email, 'Area'=>$Area, 'City'=>$City, 'Pobox'=>$Pobox, 'Corpbusinessname'=>$CorpBusinessName, 'Corpreceiptname'=>$CorpReceiptName));
        	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
        public function subscriberDashboard($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('subscriberDashboard', array('skey'=>$skey,'value'=>$value));
        	$this->logger->WriteLog(var_export(array('skey'=>$skey,'value'=>$value),true));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
		
		 public function getSentBackRequest($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('getSentBackRequest', array('skey'=>$skey,'value'=>$value));
        	$this->logger->WriteLog(var_export(array('skey'=>$skey,'value'=>$value),true));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
		
		
		public function getIdIMAGEMAI($username,$image,$msisdn='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	//$this->logger->WriteLog(var_export($image,true));
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	//$result = $client->call('getIdIMAGESMB', array('username'=>$username,'msisdn'=>$msisdn));
        	$result = $client->call('getIdIMAGEMAI', array('username'=>$username,'msisdn'=>$msisdn, 'imageID'=>$image));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

        public function getIdIMAGEMAIBANK($username,$image,$msisdn='0'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	//$this->logger->WriteLog(var_export($image,true));
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if($err){
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	//$result = $client->call('getIdIMAGESMB', array('username'=>$username,'msisdn'=>$msisdn));
        	$result = $client->call('getIdIMAGEMAIBANK', array('username'=>$username,'msisdn'=>$msisdn, 'imageID'=>$image));
        	if($client->fault){
        		$this->logger->WriteLog(var_export($result,true));
        	}else{
        		$err = $client->getError();
        		if($err){
        			$this->logger->WriteLog(var_export($err,true));
        		}else{
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
//ARAMEXEIDREPORT		
		public function aramexEIDReport($fromdate = '', $todate = '', $perpage = '15', $pagenum = '1', $rtype = 'page'){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('aramexEIDReport', array('fromdate'=>$fromdate,'todate'=>$todate,'perpage'=>$perpage,'pagenum'=>$pagenum,'rtype'=>$rtype,'awb'=>''));
				//print_r($result);		
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }


         public function approveSMBKYCcompliance($MSISDN, $userID){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveSMBKYCcompliance', array('MSISDN'=>$MSISDN,'userID'=>$userID));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
		public function requestUpdateMSISDN($oldMSISDN,$newMSISDN,$MID,$TID,$userID){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('requestUpdateMSISDN', array('oldMSISDN'=>$oldMSISDN,'newMSISDN'=>$newMSISDN,'MID'=>$MID,'TID'=>$TID,'userID'=>$userID,'remarks'=>'TESTHARDCODED'));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function getMSISDNUpdateRequest($skey='', $value=''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('getMSISDNUpdateRequest', array('skey'=>$skey,'value'=>$value));
        	$this->logger->WriteLog(var_export(array('skey'=>$skey,'value'=>$value),true));
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
				//print_r($ret);				
        	return $ret;
        }
		
		public function approveUpdateMSISDN($oldMSISDN,$newMSISDN,$status){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;

        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	$result = $client->call('approveUpdateMSISDN', array('oldMSISDN'=>$oldMSISDN,'newMSISDN'=>$newMSISDN,'userID'=>'TESTHARDCODED','status'=>$status));

        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		
		public function getPendingRegReport(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}

        	$result = $client->call('getPendingRegReport', array());	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function getPackagesSummaryReport(){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getPackagesSummaryReport', array());	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function getPackagesSummaryMerchantReport($MID){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	$result = $client->call('getPackagesSummaryMerchantReport', array('MID'=>$MID));	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function topFiveReportCASH($reportType = '', $month = '', $year = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('topFiveReport', array('reportType'=>$reportType,'month'=>$month,'year'=>$year,'userID'=>'test','transtype'=>'CASH'));	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
		
		public function topFiveReportCARD($reportType = '', $month = '', $year = ''){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('topFiveReport', array('reportType'=>$reportType,'month'=>$month,'year'=>$year,'userID'=>'test','transtype'=>'CARD'));	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }

		public function cancelRestorePNDGRegistration($pndgID, $status, $userID){
        	$ret = new ServiceResponse();
        	$ret->Message = "System is Busy. Please try again later";
        	$ret->ResponseCode = 100;
        	
        	$client = new nusoap_client($this->_GUISERVICE["wsdl"], 'WSDL');
        	$err = $client->getError();
        	if ($err) {
        		$this->logger->WriteLog(var_export($err,true));
        	}
        	
        	
        	$result = $client->call('cancelRestorePNDGRegistration', array('pndgID'=>$pndgID,'userID'=>$userID,'status'=> $status));	
        	if ($client->fault) {
        		$this->logger->WriteLog(var_export($result,true));
        	} else {
        		$err = $client->getError();
        		if ($err) {
        			$this->logger->WriteLog(var_export($err,true));
        		} else {
        			$ret = json_decode(base64_decode($result));
        		}
        	}
        	return $ret;
        }
        
    }
    ?>