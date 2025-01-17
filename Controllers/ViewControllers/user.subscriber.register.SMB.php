<?php session_start(); ?>
<?php require_once("viewcontrollers.config.properties.php"); ?>
<?php require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php"); ?>
<?php require_once("ViewController.php"); ?>
<?php
	class SubscriberController extends ViewController{
		public function __construct(){
			parent::__construct();
			if(isset($_SESSION["currentUser"]) && !empty($_SESSION["currentUser"]) && $this->verifyIP() && $this->getRolesConfig('SMB_REGISTER_ACCOUNT')){
				$this->setMaster('user.subscriber.register.SMB.view.php');
				$_SESSION['counterfile']="";
				$serv = new SubscriberServices();
				if(isset($_REQUEST["Method"])){
					
					switch($_REQUEST["Method"]){
						
						case "RegisterSMB":
							
							$cashier1 = $_REQUEST["c1"].",".$_REQUEST["c1fn"].",".$_REQUEST["c1ln"].",".($_REQUEST["c1e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c1e"].",".$_REQUEST["DEVICETYPE1"].","."1");
							$cashier2 = $_REQUEST["c2"].",".$_REQUEST["c2fn"].",".$_REQUEST["c2ln"].",".($_REQUEST["c2e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c2e"].",".$_REQUEST["DEVICETYPE2"].","."2");
							$cashier3 = $_REQUEST["c3"].",".$_REQUEST["c3fn"].",".$_REQUEST["c3ln"].",".($_REQUEST["c3e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c3e"].",".$_REQUEST["DEVICETYPE3"].","."3");
							$cashier4 = $_REQUEST["c4"].",".$_REQUEST["c4fn"].",".$_REQUEST["c4ln"].",".($_REQUEST["c4e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c4e"].",".$_REQUEST["DEVICETYPE4"].","."4");
							$cashier5 = $_REQUEST["c5"].",".$_REQUEST["c5fn"].",".$_REQUEST["c5ln"].",".($_REQUEST["c5e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c5e"].",".$_REQUEST["DEVICETYPE5"].","."5");
							$cashier6 = $_REQUEST["c6"].",".$_REQUEST["c6fn"].",".$_REQUEST["c6ln"].",".($_REQUEST["c6e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c6e"].",".$_REQUEST["DEVICETYPE6"].","."6");
							$cashier7 = $_REQUEST["c7"].",".$_REQUEST["c7fn"].",".$_REQUEST["c7ln"].",".($_REQUEST["c7e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c7e"].",".$_REQUEST["DEVICETYPE7"].","."7");
							$cashier8 = $_REQUEST["c8"].",".$_REQUEST["c8fn"].",".$_REQUEST["c8ln"].",".($_REQUEST["c8e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c8e"].",".$_REQUEST["DEVICETYPE8"].","."8");
							$cashier9 = $_REQUEST["c9"].",".$_REQUEST["c9fn"].",".$_REQUEST["c9ln"].",".($_REQUEST["c9e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c9e"].",".$_REQUEST["DEVICETYPE9"].","."9");
							$cashier10 = $_REQUEST["c10"].",".$_REQUEST["c10fn"].",".$_REQUEST["c10ln"].",".($_REQUEST["c10e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c10e"].",".$_REQUEST["DEVICETYPE10"].","."10");
							$cashier11 = $_REQUEST["c11"].",".$_REQUEST["c11fn"].",".$_REQUEST["c11ln"].",".($_REQUEST["c11e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c11e"].",".$_REQUEST["DEVICETYPE11"].","."11");
							$cashier12 = $_REQUEST["c12"].",".$_REQUEST["c12fn"].",".$_REQUEST["c12ln"].",".($_REQUEST["c12e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c12e"].",".$_REQUEST["DEVICETYPE12"].","."12");
							$cashier13 = $_REQUEST["c13"].",".$_REQUEST["c13fn"].",".$_REQUEST["c13ln"].",".($_REQUEST["c13e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c13e"].",".$_REQUEST["DEVICETYPE13"].","."13");
							$cashier14 = $_REQUEST["c14"].",".$_REQUEST["c14fn"].",".$_REQUEST["c14ln"].",".($_REQUEST["c14e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c14e"].",".$_REQUEST["DEVICETYPE14"].","."14");
							$cashier15 = $_REQUEST["c15"].",".$_REQUEST["c15fn"].",".$_REQUEST["c15ln"].",".($_REQUEST["c15e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c15e"].",".$_REQUEST["DEVICETYPE15"].","."15");
							$cashier16 = $_REQUEST["c16"].",".$_REQUEST["c16fn"].",".$_REQUEST["c16ln"].",".($_REQUEST["c16e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c16e"].",".$_REQUEST["DEVICETYPE16"].","."16");
							$cashier17 = $_REQUEST["c17"].",".$_REQUEST["c17fn"].",".$_REQUEST["c17ln"].",".($_REQUEST["c17e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c17e"].",".$_REQUEST["DEVICETYPE17"].","."17");
							$cashier18 = $_REQUEST["c18"].",".$_REQUEST["c18fn"].",".$_REQUEST["c18ln"].",".($_REQUEST["c18e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c18e"].",".$_REQUEST["DEVICETYPE18"].","."18");
							$cashier19 = $_REQUEST["c19"].",".$_REQUEST["c19fn"].",".$_REQUEST["c19ln"].",".($_REQUEST["c19e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c19e"].",".$_REQUEST["DEVICETYPE19"].","."19");
							$cashier20 = $_REQUEST["c20"].",".$_REQUEST["c20fn"].",".$_REQUEST["c20ln"].",".($_REQUEST["c20e"] == null ? $_REQUEST["EMAIL"] : $_REQUEST["c20e"].",".$_REQUEST["DEVICETYPE20"].","."20");
							$cashier = array($cashier1,$cashier2,$cashier3,$cashier4,$cashier5,$cashier6,$cashier7,$cashier8,$cashier9,$cashier10,$cashier11,$cashier12,$cashier13,$cashier14,$cashier15,$cashier16,$cashier17,$cashier18,$cashier19,$cashier20);
							
								if ($_REQUEST['REGCORPPACKAGES'] == 'STANDALONE'){
									if ($_REQUEST['CASHTYPE'] == 'PERCENT'){
										$_REQUEST['CASHDISCOUNTRATE'] = "0";
									}
								}else{
									if ($_REQUEST['CASHTYPE'] == 'PERCENT'){
										$_REQUEST['CASHDISCOUNTRATE'] = "33.75";
									}
								}
							
							if($_REQUEST["REGCORPBUSINESSNAME"] == '' || $_REQUEST["TYPE"] == '' || $_REQUEST["REGCORPAREA"] == '' ||
							   $_REQUEST["REGCORPCITY"] == '' || 
							   $_REQUEST["REGCORPPOBOX"] == '' || $_REQUEST['REGCORPONBOARDEDBY'] == '' ||
							   $_REQUEST["FIRSTNAME"] == '' || $_REQUEST["LASTNAME"] == '' ||
							   /*$_REQUEST["MSISDN"] == '' ||*/ $_REQUEST["EMAIL"] == '' || 
							   /* $_REQUEST["IDDESC"] == '' || $_REQUEST["IDNUMBER"] == '' ||
							   $_REQUEST["NATIONALITY"] == '' || $_REQUEST["ISSUANCE"] == '' ||
							   $_REQUEST["EXPIRY"] == '' || $_REQUEST["PROFESSION"] == '' || */
							   $_REQUEST["MERCDISCOUNTRATE"] == '' || $_REQUEST["REGCORPFEESTRXN"] == '' ||
							   $_REQUEST["CASHDISCOUNTRATE"] == '' || $_REQUEST["CASHTRANSFEE"] == '' || 
							   $_REQUEST["REGCORPRECEIPTNAME"] == '' || $_REQUEST["CASHTYPE"] == '' || $_REQUEST['REGCORPCONTACTNO'] == ''){
								$ret->ResponseCode = 99;
								$ret->Message = _("Please input all required fields.");
							}else if(!$this->CheckAlpha($_REQUEST['LASTNAME']) 
							|| !$this->CheckAlpha($_REQUEST['FIRSTNAME']) 
							/* || !$this->CheckAlpha($_REQUEST['IDNUMBER']) 
							|| !$this->CheckAlpha($_REQUEST['IDDESC']) 
							|| !$this->CheckAlpha($_REQUEST['NATIONALITY']) */
							|| !$this->CheckAlpha($_REQUEST['REGCORPBUSINESSNAME'])
							|| !$this->CheckAlpha($_REQUEST['TYPE'])
							/* || !$this->CheckAlpha($_REQUEST['REGCORPTYPEOFBUSINESS'])
							|| !$this->CheckAlpha($_REQUEST['REGCORPOWNERSHIPINFO']) */
							|| !$this->CheckAlpha($_REQUEST['REGCORPRECEIPTNAME'])
							/* || !$this->CheckAlpha($_REQUEST['REGCORPBUILDINGNAME'])
							|| !$this->CheckAlpha($_REQUEST['REGCORPFLOOR'])
							|| !$this->CheckAlpha($_REQUEST['REGCORPSTREETNAME']) */
							|| !$this->CheckAlpha($_REQUEST['REGCORPAREA'])
							|| !$this->CheckAlpha($_REQUEST['REGCORPCITY'])
							/* || !$this->CheckAlpha($_REQUEST['COUNTRY']) */
//							|| !$this->CheckAlpha($_REQUEST['MSISDN']) 
							/* || !$this->CheckAlpha($_REQUEST['EMAIL']) */
							/* || !$this->CheckAlpha($_REQUEST['ISSUANCE'])
							|| !$this->CheckAlpha($_REQUEST['EXPIRY'])
							|| !$this->CheckAlpha($_REQUEST['PROFESSION']) */
							|| !$this->CheckAlpha($_REQUEST['MERCDISCOUNTRATE'])
							|| !$this->CheckAlpha($_REQUEST['CASHDISCOUNTRATE'])){
								$ret->ResponseCode = 98;
								$ret->Message = _("Please input valid format..");
							
							}else if(!filter_var($_REQUEST["EMAIL"], FILTER_VALIDATE_EMAIL)){
								$ret->ResponseCode = 96;
								$ret->Message = _("Please input valid email format..");
							}else if($_SESSION['file1']==''){
								$ret->ResponseCode = 97;
								$ret->Message = _("Please attach the required file.");
							}
							else{
							
								$_REQUEST["REGCORPDATEOFINCORPORATION"] = $_REQUEST["REGCORPDATEOFINCORPORATION"] == "" ? "2012-01-01" : $_REQUEST["REGCORPDATEOFINCORPORATION"];
								
								$isMPOSOnly = "";
								
								if($_REQUEST["TYPE"] == "MADM"){
									$isMPOSOnly = "0";
								} else {
									$isMPOSOnly = "1";
								}
								
									$ret = $serv->registerSMBAccount(
									$_REQUEST["MSISDN"],
									$_REQUEST['ALIAS'],
									$_REQUEST["GENDER"],
									$_REQUEST["LASTNAME"],
									$_REQUEST["MIDDLENAME"],
									$_REQUEST["FIRSTNAME"],
									$_REQUEST["EMAIL"],
									$_REQUEST["DOB"],
									$_REQUEST["IDNUMBER"],
									$_REQUEST["IDDESC"],
									$_REQUEST["EXPIRY"],
									$_REQUEST["NATIONALITY"],
									$_REQUEST["POB"],
									$_REQUEST["CITY"],
									$_REQUEST["REGION"],
									$_REQUEST["COUNTRY"],
									$_REQUEST["TYPE"],
									$_REQUEST["STORETYPE"],
									"FOR APPROVAL",
									$_REQUEST["ACCOUNTSTATUS"],
									0 ,
									$_SESSION['currentUser'],
									$_REQUEST["BUILDING"],
									$_REQUEST["STREET"],
									$_REQUEST["REGCORPBUSINESSNAME"],
									$_REQUEST["PROFESSION"],"NO",
									$_REQUEST["ALTNUMBER"],
									$_REQUEST["AUTHORIZINGLASTNAME"],
									$_REQUEST["AUTHORIZINGFIRSTNAME"],
									$_REQUEST["AUTHORIZINGIDNUMBER"],
									$_REQUEST["AUTHORIZINGIDDESCRIPTION"],
									$_REQUEST["AUTHORIZINGMOBILENUMBER"],
									$_REQUEST["REGCORPDATEOFINCORPORATION"],
									$_REQUEST["REGCORPBUSINESSNAME"],
									$_REQUEST["REGCORPTRADELICENSENUMBER"],
									$_REQUEST["REGCORPREGISTREDADDRESS"],
									$_REQUEST["REGCORPTYPEOFBUSINESS"],
									$_REQUEST["REGCORPOWNERSHIPINFO"],
									$_REQUEST["TINNUMBER"],
									$_SESSION['searchmsisdn'],
									0,
									0,
									0,
									$_REQUEST['REGCORPBUILDINGNAME'],
									$_REQUEST['REGCORPSTREETNAME'],
									$_REQUEST['REGCORPCITY'],
									$_REQUEST['REGCORPFLOOR'],
									$_REQUEST['REGCORPAREA'],
									$_REQUEST['REGCORPPOBOX'],
									$_REQUEST['ISSUANCE'],
									$_REQUEST['MERCDISCOUNTRATE'],
									$_REQUEST['CASHDISCOUNTRATE'],
									$_REQUEST['CASHTRANSFEE'],
									$_REQUEST["REGCORPRECEIPTNAME"],
									$_REQUEST["CASHTYPE"],
									$cashier,
									$_REQUEST["MERCDISCOUNTRATE2"],
									$_REQUEST["DEVICETYPE"], 
									$_REQUEST['REGCORPCONTACTNO'],
									$_REQUEST['REGCORPONBOARDEDBY'], 
									$isMPOSOnly, 
									$_SESSION['urlfile1'],
									$_SESSION['urlfile2'],
									$_SESSION['urlfile3'],
									$_SESSION['urlfile4'],
									$_SESSION['urlfile5'],
									$_SESSION['urlfile6'],
									$_SESSION['urlfile7'],
									$_SESSION['urlfile8'],
									$_SESSION['urlfile9'],
									$_SESSION['urlfile10'],
									$_REQUEST['REGTRN'],$_REQUEST['REGCORPFEESTRXN'],
									$_REQUEST['REGCORPFEESOTHER']
									);

									
								if($ret->ResponseCode == 0){
									unset($_SESSION['file1']);unset($_SESSION['file6']);
									unset($_SESSION['file2']);unset($_SESSION['file7']);
									unset($_SESSION['file3']);unset($_SESSION['file8']);
									unset($_SESSION['file4']);unset($_SESSION['file9']);
									unset($_SESSION['file5']);unset($_SESSION['file10']);

									unset($_SESSION['urlfile1']);unset($_SESSION['urlfile6']);
									unset($_SESSION['urlfile2']);unset($_SESSION['urlfile7']);
									unset($_SESSION['urlfile3']);unset($_SESSION['urlfile8']);
									unset($_SESSION['urlfile4']);unset($_SESSION['urlfile9']);
									unset($_SESSION['urlfile5']);unset($_SESSION['urlfile10']);
									
									$_SESSION['searchmsisdn'] = $_REQUEST["MSISDN"];
									$_SESSION['batchAccountType'] = $_REQUEST["STORETYPE"];
									//$ret->Message = _("You have successfully registered your account");
									$ret->Message = _("Account has been successfully created and sent to Bank for approval");
									//$ret->Message = _($_SESSION['imagenew3']);
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
										$ret->Message = _("API System Busy to verify the mobile number. Please try again.");
									}
								}
							}
							$this->setData("responseMessage",$ret->Message);
							$this->setData("response",$ret->ResponseCode);
							
						break;
					}
				}
			}else{
				//$this->setMaster('index.master.php');
				$this->setMaster('user.redirect.iframe.view.php');
			}
			$this->render();
		}
	}
	
	$emp = new SubscriberController();
?>