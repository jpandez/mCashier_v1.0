<?php
include("ajaximage.php");
?>
<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null; /* print_r($searchResult); */?>
<style type="text/css">
#uploadForm {
	text-align: justify;
    width: 400px;
    height: 25px;
    background-color: white;
    box-shadow: 1px 2px 3px #ededed;
    position:relative;
    border: 1px solid #d8d8d8;
	overflow: hidden;
}
 #inpCSV{
    width:400px;
    height:25px;
    opacity:0
}
#val {
    width: 400px;
    height:25px;
    position: absolute;
    top: 0;
    left: 0;
    font-size:13px;
    line-height: 25px;
    text-indent: 10px;
    pointer-events: none;
}
#buttonSelectCSV {
    cursor: pointer;
    display: block;
    width: 90px;
    background-color: #719E19;
    height:25px;
    color: white;
    position: absolute;
    right:0;
    top: 0;
    font-size: 11px;
    line-height:25px;
    text-align: center;
    -webkit-transition: 500ms all;
    -moz-transition: 500ms all;
    transition: 500ms all;
}

#buttonSelectCSV:hover {
    background-color: #212121;
	color: #BED30B;
}

.uploadBtnDisa {
	cursor: not-allowed;
	width: 90px;
	background-color: #878881;
	color: white;
	border:none;
	padding: 4px;
	font-size: 11px;
	-webkit-transition: 500ms all;
    -moz-transition: 500ms all;
    transition: 500ms all;
	box-shadow: 1px 2px 3px #ededed;
}

.uploadBtnEna {
	cursor: pointer;
	width: 90px;
	background-color: #719E19;
	color: white;
	border:none;
	padding: 4px;
	font-size: 11px;
	-webkit-transition: 500ms all;
    -moz-transition: 500ms all;
    transition: 500ms all;
	box-shadow: 1px 2px 3px #ededed;
}

.uploadBtnEna:hover {
	background-color: #212121;
	color: #BED30B;
}
td {
	vertical-align: middle !important;
}
</style>
<div class="loading"></div>
<div id="account_info_tab" class="account_info"  style="display:none;">
	<div class="panelButtons" style="margin-bottom:10px;">
		<?php 
		
		if(($this->getRolesConfig('ALLOCATE_CASH') == true || $this->getRolesConfig('DEALLOCATE_CASH') == true) && $this->getRolesConfig('FINANCIAL_SERVICES') == true){?>
			<button  id="dialogAllocate_" type = "button" style="float:left;" class="ui-state-default ui-corner-all ui-button"><?php echo _("allocate"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('ALLOCATE_EVD_STOCK') == true || $this->getRolesConfig('DEALLOCATE_EVD_STOCK') == true){?>
			<button  id="dialogAllocateEVD_" type = "button" style="float:left;" class="ui-state-default ui-corner-all ui-button"><?php echo _("allocate EVD"); ?></button>
		<?php } ?>
			
		<?php if($this->getRolesConfig('ALLOCATE_BANK_TO_WALLET') == true && $account->ReferenceAccount == '0' && ($account->AccountType == 'DLER' || $account->AccountType == 'CORP' || $account->AccountType == 'MCOM' || $account->AccountType == 'INTR')){?>
			<button  id="dialogAllocateB2W_" type = "button" style="float:left;" class="ui-state-default ui-corner-all ui-button"><?php echo _("allocate B2W"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('ACTIVATE_ACCOUNT') == true && $account->Status != 'ACTIVE' && strtoupper(trim($account->KYC)) == 'APPROVED'){?>
			<button  id="btnActivate" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("activate"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('DEACTIVATE_ACCOUNT') == true && $account->Status == 'ACTIVE'){?>
			<button  id="btnDeactivate" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("deactivate"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('RESET_MOBILE_PASSWORD') == true){?>
			<button  id="btnResetPin" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("reset mobile password"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('LOCK_ACCOUNT') == true && $account->Locked != 'true'){?>
			<button  id="btnLock" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("lock"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('UNLOCK_ACCOUNT') == true && $account->Locked == 'true'){?>
			<button  id="btnUnlock" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;;" ><?php echo _("unlock"); ?></button>
		<?php } ?>
		
		<?php if($this->getRolesConfig('DELETE_IMSI') == true && $account->MobileIMSI > 0){ ?>
			<button  id="btnDeleteIMSI" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;;" ><?php echo _("release IMSI"); ?></button>
		<?php } ?>
		
		<!-- DELETETERMINALID -->
		<?php if($this->getRolesConfig('DELETE_TERMINALID') == true && $account->terminalid > 0 && $account->AccountType == 'MPOS'){ ?>
			<button  id="btnDeleteTerminalID" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;;" ><?php echo _("release Terminal ID"); ?></button>
		<?php } ?>
		<!-- END DELETETERMINALID -->
		
		<?php if($this->getRolesConfig('UPDATE_MPOS_INFO')) { ?>
			<button  id="btnmposedit" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;;" ><?php echo _("Edit mPOS"); ?></button>
			<button  id="btnmpossave" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;;" ><?php echo _("Save"); ?></button>
			<button  id="btnmposcancel" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;;" ><?php echo _("Cancel"); ?></button>			
		<?php } ?>
		
		<?php //echo $this->getRolesConfig('REGISTER_SUB_ACCOUNT_MPOS'). ' ' . $account->ReferenceAccount . ' ' . $searchResult->QueryCount . ' ' . $account->Status;?>
		
		<?php if($this->getRolesConfig('REGISTER_SUB_ACCOUNT_MPOS') == true && $searchResult->QueryCount == 'YES' && $account->Status != 'DEACTIVE' && $account->AccountType =='MADM'){?>
			<button  id="btnRegStore" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("add TID"); ?></button>
		<?php } ?>
		
		<?php /*if($this->getRolesConfig('REGISTER_SUB_ACCOUNT_MPOS') == true && $searchResult->QueryCount == 'YES' && $account->Status != 'DEACTIVE' && $account->AccountType !='MADM'){?>
			<button  id="btnRegMPOS" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("add cashier"); ?></button>
		<?php }*/ ?>
		
		<?php if($this->getRolesConfig('UPLOAD_CASHIER') == true && $searchResult->QueryCount == 'YES' && $account->Status != 'DEACTIVE' && $account->AccountType !='MADM'){ ?>
			<button  id="btnUploadMPOS" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("upload batch cashier"); ?></button>
		<?php } ?>
		
		<!--<button  id="btntest" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php //echo _("test"); ?></button>  -->
		
		<?php if($this->getRolesConfig('UPLOAD_CASHIER') == true && $searchResult->QueryCount == 'YES' && $account->Status != 'DEACTIVE' && $account->AccountType =='MADM'){ ?>
			<div style="float:left;vertical-align: middle;"><button  id="btnUploadStore" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("upload batch store"); ?></button></div>
		<?php } ?>
		
	</div>
	<div class="accountInfoTabHolder" style="border:0px solid;height:230px;width:1100px">
	<?php if(isset($account->KYC) &&  strtoupper(trim($account->KYC)) == "APPROVED" || isset($account->UserID) || $_SESSION['ViewKYC'] ="NO" && $account->UserID == $_SESSION["currentUser"]){echo "<div style='height:40px;'></div>";}?>
		<div class="account_info_details" style="border:0px solid red;width:350px;margin-top:10px;margin-right:15px;float:left;">
			<table border="0" id="tblAccount" cellspacing="5" class="tablet">
				<tr><td><?php echo _("TLC ID"); ?>:</td><td><input id="accountID" type="text" disabled="disabled" value="<?php echo isset($account)?$account->AccountID:"";?>"></td></tr>
				<tr><td><?php echo _("Account Status"); ?>:</td><td><input id="pAccountStatus" type="text" disabled="disabled" value="<?php echo isset($account)?$account->Status:""; ?>"></td></tr>				
				<tr><td><?php echo _("Date Registered"); ?>:</td><td><input type="text" disabled="disabled" value="<?php echo isset($account)?$account->RegisteredDate:""; ?>"></td></tr>
				<tr><td><?php echo _("KYC Status"); ?>:</td><td><input id="subKYC" type="text" disabled="disabled" value="<?php echo isset($account)?$account->KYC:"" ?>"></td></tr>
				<tr><td><?php echo _("KYC Description"); ?>:</td><td><input id="subKYCdesc" type="text" disabled="disabled" value="<?php echo isset($account)?$account->KYCREASON:"" ?>" title="<?php echo isset($account)?$account->KYCREASON:"" ?>"></td></tr>				
				<tr><td><?php echo _("date modified"); ?>:</td><td><input type="text" disabled="disabled" value="<?php echo isset($account)?$account->ModifiedDate:"" ?>"></td></tr>
			</table>
		</div>
		<div class="account_info_details2" style="border:0px solid red;width:350px;margin-top:10px;margin-right:10px;float:left;">
			<table border="0" id="tblAccount2" cellspacing="5" class="tablet">
				<tr><td><?php echo _("Terminal ID"); ?>:</td><td><input id="pTerminalid" type="text" disabled="disabled" value="<?php echo isset($account)?$account->terminalid:"" ?>"></td></tr>
				<tr><td><?php echo _("Merchant ID"); ?>:</td><td><input id="mid" type="text" disabled="disabled" value="<?php echo isset($account)?$account->merchantid:"" ?>"></td></tr>
				<tr><td><?php echo _("Reader Serial Number"); ?>:</td><td><input id="pReaderSerialNumber" type="text" disabled="disabled" value="<?php echo isset($account)?$account->readerserialnumber:"" ?>"></td></tr>
				
				<tr><td><?php echo _("Created By"); ?>:</td><td><input id="test_userID" type="text" disabled="disabled" value="<?php echo isset($account)?$account->Createdby:"" ?>"></td></tr>
				<tr><td><?php echo _("Locked"); ?>:</td><td><input id="pLocked" type="text" disabled="disabled" value="<?php echo isset($account)?($account->Locked=='true'?"YES":"NO"):"" ?>"></td></tr>
				<tr><td><?php echo _("Lock Description"); ?>:</td><td><input id="pLockdesc" type="text" disabled="disabled" value="<?php echo isset($account)?$account->LockDescription:"" ?>"></td></tr>
			</table>
		</div>
		<div class="account_info_details2" style="border:0px solid red;width:370px;margin-top:10px;float:left;">
			<table border="0" cellspacing="5" class="tablet">
				<tr>
					<td colspan="2">Fees</td>
				</tr>
				<tr>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input disabled="disabled" type="text" class="verifyText" name="REGCORPPACKAGES" id="REGCORPPACKAGES" value="<?php echo $account==null?"":$account->Packages ?>" >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
					</td>
				</tr>
				<tr>
					<td><?php echo _("Merchant Discount Rate Premium (%)"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input disabled="disabled" type="text" class="verifyText" name="REGCORPFEESTRXN" id="REGCORPFEESTRXN" value="<?php echo $account==null?"":$account->mercdiscountrate ?>" onkeyup="run(this)" >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
					</td>
				</tr>
				<tr>
					<td><?php echo _("Merchant Discount Rate NonPremium (%)"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input disabled="disabled" type="text" class="verifyText" name="REGCORPFEESTRXNNONPREMIUM" id="REGCORPFEESTRXNNONPREMIUM" value="<?php echo $account==null?"":$account->nonpremium ?>" onkeyup="run(this)" >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
					</td>
				</tr>
				<tr>
					<td style="display:none;"><?php echo _("Acquiring Interchange (%)"); ?>:</td>
					<td style="display:none;">
						<input disabled="disabled" type="text" class="verifyText" name="REGCORPFEESOTHER" id="REGCORPFEESOTHER" value="<?php echo $account==null?"":$account->mcvisafee ?>" onkeyup="run(this)" >
					</td>					
				</tr>
				<tr>
					<td>
						<select id="CASHTYPE" name="CASHTYPE" style="width:100%;" disabled="disabled">
							<option value='PERCENT' <?php if($account->cashtype=='PERCENT'){ echo 'selected="selected"';} ?>>Cash Discount Rate (%)</option>
							<option value='FIXED' <?php if($account->cashtype=='FIXED'){ echo 'selected="selected"';} ?>>Cash Transaction Fee</option>
							<option value='MONTHLY' <?php if($account->cashtype=='MONTHLY'){ echo 'selected="selected"';} ?>>Cash Monthly Charges</option>
						</select>
					</td>
					<td>
						<input disabled="disabled" type="text" class="verifyText" name="REGCORPFEESOTHER" id="REGCORPFEESOTHER" value="<?php echo $account==null?"":$account->cashdiscountrate ?>" onkeyup="run(this)" >
					</td>					
				</tr>
				<tr>
					<td style="display:none;"><?php echo _("Cash Transaction Fee"); ?>:</td>
					<td style="display:none;">
						<input disabled="disabled" type="text" class="verifyText" name="REGCORPFEESOTHER" id="REGCORPFEESOTHER" value="<?php echo $account==null?"":$account->cashtransfee ?>" onkeyup="run(this)" >
					</td>					
				</tr>
			</table>
		</div>
	</div>
	<div style="margin-top:50px";></div>
		<div class="account_info_details2" style="border:0px solid red;width:70%;margin-top:10px;float:left;">
				<?php $PackagesSummaryReport = $this->data("getPackagesSummaryReport"); ?>
				<?php if($_SESSION["currentUserLevel"] == 'ADMIN' && $account->AccountType == 'MADM'){ ?>
				<?php if(isset($PackagesSummaryReport->ResponseCode)){ ?>
					<?php if(is_array($PackagesSummaryReport->Value)){ ?>
					<h3><?php  echo _("Total Number of Cashier: "); echo $PackagesSummaryReport->QueryCount; ?></h3>
					<div style="margin-top:15px";></div>
					<table style="width: 100%; table-layout: fixed;" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_registeredMerchants">
						<thead>
						<tr class="ui-widget-header">							
							<?php $ctr=0; foreach($PackagesSummaryReport->Value as $t): $ctr++;?>
								<th><?php echo $t->CORPPACKAGES; ?></th>
							<?php endforeach; ?>
						</tr>
						</thead>
						<tbody>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<?php $ctr=0; foreach($PackagesSummaryReport->Value as $t): $ctr++;?>
									<td><?php echo $t->PACKAGE_COUNT; ?></td>
								<?php endforeach; ?>
							</tr>
						</tbody>
					</table>
					<div style="margin-top:-45px";></div>
			
					<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found : $PackagesSummaryReport->Message</h3>";
				}?>
				<?php }} ?>
		</div>
</div>
			

<div id="dialogLock" title="<?php echo _("Lock Subscriber"); ?>">
	<div class="dLock" align="center">
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("lock description"); ?><span style="color:red">*</span> :</td>
				<td>
					<textarea rows="2" cols="30" id="lockdesc" ></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnLockSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Lock Subscriber"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="dialogUploadMpos" title="<?php echo _("Upload Batch Cashier File"); ?>">
		
</div>

<div id="dialogUploadStore" title="<?php echo _("Upload Batch Store File"); ?>">
		
</div>

<div id="dialogMPOS" title="<?php echo _("Cashier Registration"); ?>">
	<div class="dLock" align="center">
		<table border="0" cellspacing="5" id="tblRegister" class="tablet">
			<tr>
				<td colspan="6"><?php echo _("Authorized Person Details"); ?></td>
			</tr>
			<tr>
				<td><?php echo _("First Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="addFName" name="FIRSTNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['FIRSTNAME']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Last Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="addLName" name="LASTNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['LASTNAME']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td><?php echo _("Primary MSISDN"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="MSISDN" id="addAuthorizedNumber" onkeyup="this.value=this.value.replace(/\D/g,'');"  value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['MSISDN']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Validity"); ?>:</td>
				<td><input type="text" class="verifyText" name="msisdnValidity" id="msisdnValidity" disabled="disabled" ></td>
				<td><?php echo _("Primary Email"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="addEmail" name="EMAIL"value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['EMAIL']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td><?php echo _("Device Type"); ?>:</td>
				<td>
					<select id="DEVICETYPE" name="DEVICETYPE" style="width:100%;">
						<option value='ANDROID'>Android</option>
						<option value='IOS'>iOS</option>
						<option value='WINDOWS'>Windows</option>
					</select>
				</td>
			</tr>
			
			
			<div align="left">
				<table>
					<tr align="left">
						<td colspan="6" align="left">
							<input type="Submit" value="Register Cashier" id="btnRegisterMPOS" class="ui-state-default ui-corner-all ui-button" >
						</td>
					</tr>
				</table>
			</div>
			
		</table>
	</div>
</div>

<div id="dialogStore" title="<?php echo _("Terminal Registration"); ?>">
	<div class="dLock" align="center">
		<table border="0" cellspacing="5" id="tblRegisterStore" class="tablet">
			<tr>
				<td colspan="6"><?php echo _("Authorized Person Details"); ?></td>
			</tr>
			<tr>
				<td><?php echo _("First Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="addFNameStore" name="STOREFIRSTNAME" value="<?php echo $account==null?"":$account->PersonalInformation->FirstName ?>" readonly>
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Last Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="addLNameStore" name="STORELASTNAME" value="<?php echo $account==null?"":$account->PersonalInformation->LastName; ?>" readonly>
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Store Type"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="regStoreType" name="STORETYPE" style="width:100%;">
						
					</select>
				</td>
			</tr>
			<tr>
				<td><?php echo _("Primary MSISDN"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="STOREMSISDN" id="addAuthorizedNumberStore" onkeyup="this.value=this.value.replace(/\D/g,'');"  value="<?php echo isset($account)?$account->MobileNumber:"" ?>" readonly>
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td></td>
				<td></td>
				<td><?php echo _("Primary Email"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="addEmailStore" name="STOREEMAIL"value="<?php echo $account==null?"":$account->PersonalInformation->EmailAddress ?>" readonly>
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td><?php echo _("Receipt Printed Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" class="verifyText" name="STOREREGCORPRECEIPTNAME" id="STOREREGCORPRECEIPTNAME" value="<?php echo $account==null?"":$account->CorpInformation->receiptname ?>" maxlength="20" style="text-transform: uppercase" readonly>
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Device Type"); ?>:</td>
				<td>
					<select id="DEVICETYPE" name="DEVICETYPE" style="width:100%;">
						<option value='ANDROID'>Android</option>
						<option value='IOS'>iOS</option>
						<option value='WINDOWS'>Windows</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="6"><?php echo _("Company Information"); ?></td>
			</tr>
			<tr>
				<td><?php echo _("Area / City"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="STOREREGCORPAREA" name="STOREREGCORPAREA" value="<?php echo $account==null?"":$account->CorpInformation->area ?>" readonly>
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Emirate"); ?><span style="color:red">*</span>:</td>
				<td>
					<input type="text" id="STOREREGCORPCITY" name="STOREREGCORPCITY" value="<?php echo $account==null?"":$account->CorpInformation->city ?>" readonly>
				</td>
				<td><?php echo _("P O Box"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" class="verifyText" name="STOREREGCORPPOBOX" id="STOREREGCORPPOBOX" value="<?php echo $account==null?"":$account->CorpInformation->pobox ?>" readonly>
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			
			
			<tr>
				<td colspan="6"><h3><?php echo _("Account/device settings"); ?></h3></td>
			</tr>
			<tr>
				<td><?php echo _("Number of card readers requested");?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="cardreaderrequested2" id="cardreaderrequested2" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['cardreaderrequested2']) ;?>" onkeyup="run(this)" maxlength="2">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
					
				</td>				
			</tr>
			<!-- CASHIER 1 TO 9 START -->	
				<tr style="display:none;" class="cc1">
					<td><?php echo _("Cashier 1 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c1" id="c1" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1']) ;?>" onkeyup="this.value=this.value.replace(/\D/g,'');" >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity1" id="msisdnValidity1" disabled="disabled" ></td>
					<td><?php echo _("Cashier 1 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE1" name="DEVICETYPE1" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>
																			
				</tr>
				<tr style="display:none;" class="cc1">
					<td><?php echo _("Cashier 1 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c1fn" id="c1fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c1fn" id="c1fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 1 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c1ln" id="c1ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c1ln" id="c1ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 1 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c1e" id="c1e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1e']) ;?>"  >
												
					</td>
				</tr>
				
				<tr style="display:none;" class="cc1">
					<td><?php echo _("Cashier 1 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c1tid" id="c1tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf1' checked value='1' id='vf1' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf1' checked value='0' id='vf1' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp1' name='cp1' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc2">
					<td><?php echo _("Cashier 2 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c2" id="c2" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity2" id="msisdnValidity2" disabled="disabled" ></td>
					<td><?php echo _("Cashier 2 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE2" name="DEVICETYPE2" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>
																			
				</tr>
				<tr style="display:none;" class="cc2">
					<td><?php echo _("Cashier 2 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c2fn" id="c2fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c2fn" id="c2fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 2 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c2ln" id="c2ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c2ln" id="c2ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 2 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c2e" id="c2e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc2">
					<td><?php echo _("Cashier 2 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c2tid" id="c2tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf2' checked value='1' id='vf2' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf2' checked value='0' id='vf2' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp2' name='cp2' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc3">
					<td><?php echo _("Cashier 3 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c3" id="c3" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity3" id="msisdnValidity3" disabled="disabled" ></td>
					<td><?php echo _("Cashier 3 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE3" name="DEVICETYPE3" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>								
				</tr>
				<tr style="display:none;" class="cc3">
					<td><?php echo _("Cashier 3 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c3fn" id="c3fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c3fn" id="c3fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 3 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c3ln" id="c3ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c3ln" id="c3ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 3 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c3e" id="c3e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3e']) ;?>"  >
						
					</td>
				</tr>
				<tr style="display:none;" class="cc3">
					<td><?php echo _("Cashier 3 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c3tid" id="c3tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf3' checked value='1' id='vf3' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf3' checked value='0' id='vf3' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp3' name='cp3' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc4">
					<td><?php echo _("Cashier 4 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c4" id="c4" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity4" id="msisdnValidity4" disabled="disabled" ></td>
					<td><?php echo _("Cashier 4 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE4" name="DEVICETYPE4" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>												
				</tr>
				<tr style="display:none;" class="cc4">
					<td><?php echo _("Cashier 4 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c4fn" id="c4fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c4fn" id="c4fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 4 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c4ln" id="c4ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c4ln" id="c4ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 4 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c4e" id="c4e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc4">
					<td><?php echo _("Cashier 4 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c4tid" id="c4tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf4' checked value='1' id='vf4' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf4' checked value='0' id='vf4' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp4' name='cp4' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc5">
					<td><?php echo _("Cashier 5 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c5" id="c5" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity5" id="msisdnValidity5" disabled="disabled" ></td>
					<td><?php echo _("Cashier 5 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE5" name="DEVICETYPE5" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>													
				</tr>
				<tr style="display:none;" class="cc5">
					<td><?php echo _("Cashier 5 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c5fn" id="c5fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c5fn" id="c5fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 5 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c5ln" id="c5ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c5ln" id="c5ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 5 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c5e" id="c5e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc5">
					<td><?php echo _("Cashier 5 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c5tid" id="c5tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf5' checked value='1' id='vf5' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf5' checked value='0' id='vf5' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp5' name='cp5' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc6">
					<td><?php echo _("Cashier 6 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c6" id="c6" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity6" id="msisdnValidity6" disabled="disabled" ></td>
					<td><?php echo _("Cashier 6 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE6" name="DEVICETYPE6" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>													
				</tr>
				<tr style="display:none;" class="cc6">
					<td><?php echo _("Cashier 6 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c6fn" id="c6fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c6fn" id="c6fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 6 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c6ln" id="c6ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c6ln" id="c6ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 6 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c6e" id="c6e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc6">
					<td><?php echo _("Cashier 6 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c6tid" id="c6tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf6' checked value='1' id='vf6' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf6' checked value='0' id='vf6' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp6' name='cp6' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc7">
					<td><?php echo _("Cashier 7 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c7" id="c7" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity7" id="msisdnValidity7" disabled="disabled" ></td>
					<td><?php echo _("Cashier 7 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE7" name="DEVICETYPE7" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>											
				</tr>
				<tr style="display:none;" class="cc7">
					<td><?php echo _("Cashier 7 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c7fn" id="c7fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c7fn" id="c7fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 7 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c7ln" id="c7ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c7ln" id="c7ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 7 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c7e" id="c7e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc7">
					<td><?php echo _("Cashier 7 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c7tid" id="c7tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf7' checked value='1' id='vf7' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf7' checked value='0' id='vf7' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp7' name='cp7' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc8">
					<td><?php echo _("Cashier 8 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c8" id="c8" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity8" id="msisdnValidity8" disabled="disabled" ></td>
					<td><?php echo _("Cashier 8 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE8" name="DEVICETYPE8" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>									
				</tr>
				<tr style="display:none;" class="cc8">
					<td><?php echo _("Cashier 8 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c8fn" id="c8fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c8fn" id="c8fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 8 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c8ln" id="c8ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c8ln" id="c8ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 8 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c8e" id="c8e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc8">
					<td><?php echo _("Cashier 8 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c8tid" id="c8tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf8' checked value='1' id='vf8' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf8' checked value='0' id='vf8' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp8' name='cp8' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc9">
					<td><?php echo _("Cashier 9 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c9" id="c9" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity9" id="msisdnValidity9" disabled="disabled" ></td>
					<td><?php echo _("Cashier 9 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE9" name="DEVICETYPE9" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>												
				</tr>
				<tr style="display:none;" class="cc9">
					<td><?php echo _("Cashier 9 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 9 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 9 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9e" id="c9e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc9">
					<td><?php echo _("Cashier 9 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9tid" id="c9tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf9' checked value='1' id='vf9' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf9' checked value='0' id='vf9' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp9' name='cp9' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
				
				<tr style="display:none;" class="cc10">
					<td><?php echo _("Cashier 10 MSISDN"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c9" id="c9" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
						
					</td>
					<td><?php echo _("Validity"); ?>:</td>
					<td><input type="text" class="verifyText" name="msisdnValidity9" id="msisdnValidity9" disabled="disabled" ></td>
					<td><?php echo _("Cashier 10 device"); ?>:</td>
					<td>
						<select id="DEVICETYPE10" name="DEVICETYPE10" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
					</td>												
				</tr>
				<tr style="display:none;" class="cc10">
					<td><?php echo _("Cashier 10 First Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 10 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 10 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c9e" id="c9e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9e']) ;?>"  >
						
					</td>
				</tr>
				
				<tr style="display:none;" class="cc10">
					<td><?php echo _("Cashier 10 TID"); ?><span style="color:red">*</span>:</td>
					<td>
						<input type="text" class="verifyText" name="c10tid" id="c10tid" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c10tid']) ;?>"  >
					</td>
					<td><?php echo _("Vat Functionality"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<input type='radio' class='vats' name='vf10' checked value='1' id='vf10' /> <label for='yes'>Enable</label>
							<input type='radio' class='vats' name='vf10' checked value='0' id='vf10' /> <label for='no'>Disable</label>
						</div>
					</td>
					<td><?php echo _("Packages"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class='field required'>
							<select class='packs' id='cp10' name='cp10' style='width:100%;' >
								<option value='Standalone'>Standalone</option>
								<option value='Essential'>Essential</option>
								<option value='Essential lite'>Essential lite</option>
								<option value='Essential plus'>Essential plus </option>
								<option value='Smart'>Smart</option>
								<option value='Smart lite'>Smart lite</option>
								<option value='Smart  plus'>Smart plus</option>
							</select>
						</div>
					</td>
				</tr>
			<!-- CASHIER 1 TO 9 END -->	
			
			<tr><td colspan="6"><button  id="fileclickStore" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Attach File"); ?></button>Application File, PDF or JPEG, max file size 6MB</td></tr>
			<tr>
				<td colspan="6"><div id='previewStore'></div></td>
			</tr>
			
			
			<div align="left">
				<table>
					<tr align="left">
						<td colspan="6" align="left">
							<input type="Submit" value="Register Store" id="btnRegisterStore" class="ui-state-default ui-corner-all ui-button" >
						</td>
					</tr>
				</table>
			</div>
			
			
		<div align="left" style="display:none;">
		<table>
			<tr><td>Application File, PDF or JPEG, max file size 3MB</td><!--<td>Image 2</td><td>Image 3</td>--></tr>
			<tr>
				<td>
					<form id="imageformStore" method="post" enctype="multipart/form-data" action='ajaximage.php'>
						<input type="hidden" name="Method" id="Method" value="ImageStore" />
						<input type="file" name="photoimgStore" id="photoimgStore" accept="application/pdf,image/png, image/gif, image/jpeg"/>
						
					</form>
				</td>
				<!--<td>
					<form id="imageform2" method="post" enctype="multipart/form-data" action='ajaximage.php'>
						<input type="hidden" name="Method" id="Method" value="Image2" />
						<input type="file" name="photoimg2" id="photoimg2" />
					</form>
				</td>
				<td>
					<form id="imageform3" method="post" enctype="multipart/form-data" action='ajaximage.php'>
						<input type="hidden" name="Method" id="Method" value="Image3" />
						<input type="file" name="photoimg3" id="photoimg3" />
					</form>
				</td>-->
			</tr>
			<tr>
				<td>
					
				</td>
				<td>
					<div id='preview2'>
					</div>
				</td>
				<td>
					<div id='preview3'>
					</div>
				</td>
			</tr>
		</table>
	</div>
			
		</table>
	</div>
</div>
<!-- end ui-dialog lock -->

<!-- start allocate -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" >
function run(field) {
    setTimeout(function() {
        //var regex = /\d*\.?\d?/g;
		var regex  = /^-?\d*\.?\d*$/;
        field.value = regex.exec(field.value);
    }, 0);
}



 $(document).ready(function() { 
	
	$('#photoimgStore').hide();
	$("#fileclickStore").click(function () {
		$("#photoimgStore").trigger('click');
	});
	window.pho = "0";
	$("#photoimgStore").click(function () {
		window.pho = "1";
	});


	$('#photoimgStore').on('change', function()			{ 
		$("#previewStore").html('');
		$("#previewStore").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
		$("#imageformStore").ajaxForm({
			target: '#previewStore'
			}).submit();
			window.pho = "0";
	});
		
        $('#photoimg').on('change', function(){ 
			$("#preview").html('');
			$("#preview").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
				target: '#preview'
				}).submit();
		});
		
		$('#photoimg2').on('change', function(){ 
			$("#preview2").html('');
			$("#preview2").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform2").ajaxForm({
				target: '#preview2'
				}).submit();
		});
		
		$('#photoimg3').on('change', function(){ 
			$("#preview3").html('');
			$("#preview3").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
				$("#imageform3").ajaxForm({
					target: '#preview3'
					}).submit();
			
				});
        }); 

 loadStoreTypeREG();
	function loadStoreTypeREG(){
     var params = {Method:'getAccountTypeRegister',
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
    		 		//MSISDN:"<?php echo $account->MobileNumber; ?>"
        		 };
     $.ajax({
		type: "POST",
        url:service_url,
        success:function(result,status){
            var listitem = ""                                
            $('#regStoreType').find('option').remove();
            $('#regStoreType2').find('option').remove();
             for(var i = 0; i < result.value.length; i++)
             {           
					//listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'">' + result.value[i].DESCRIPTION + '</option>';
					
				 var selected = "";
                 if(result.value[i].ACCOUNTTYPE == window.AccountType){
                     selected = "selected";
                 }
                 if(result.value[i].ACCOUNTTYPE!="MADM" && result.value[i].ACCOUNTTYPE!="MERC" && result.value[i].ACCOUNTTYPE!="MPOS"){
              	   listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'"' + selected +'>' + result.value[i].DESCRIPTION + '</option>';
                 }
             }
             $('#regStoreType').html(listitem);
             $('#regStoreType').click();   
             $('#regStoreType2').html(listitem);
             $('#regStoreType2').click();
             
        },
        dataType:"JSON",
        data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
     });
	}

	region();
	function region(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR51+Sma/ekvy49dYDKIkPHILWqu2taEAYwJnsknXhb1JEeiRwPfSvQQB9/jSSdhK+s7g==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#STOREREGCORPCITY').find('option').remove();
					for(x in result.value){
						
						listitem += '<option>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#STOREREGCORPCITY').html(listitem);
					$('#STOREREGCORPCITY').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
</script>
<style>

body
{
font-family:arial;
}
.preview, .preview2, .preview3, .previewStore
{
width:100px;
border:solid 1px #dedede;
padding:10px;
}
#preview, #preview2, #preview3, #previewStore
{
color:#cc0000;
font-size:12px
}

</style>


<script>
$('.a1').mask("000 000 000 000", {reverse: true});
$('.b1').mask("000 000 000 000", {reverse: true});
$(".a1").change(function(){
    var nStr = $(".a1").val().trim();
    nStr = nStr.replace(/ /g, '');
    
    var inD = ".";
    var outD = ".";
    var sep = " ";
    var dpos = nStr.indexOf(inD);
 var nStrEnd = '';
 if (dpos != -1) {
  nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
  nStr = nStr.substring(0, dpos);
 }
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(nStr)) {
  nStr = nStr.replace(rgx, '$1' + sep + '$2');
 }
   
    $(".a1").val(nStr + nStrEnd);
});
$(".b1").change(function(){
    var nStr = $(".b1").val().trim();
    nStr = nStr.replace(/ /g, '');
    
    var inD = ".";
    var outD = ".";
    var sep = " ";
    var dpos = nStr.indexOf(inD);
 var nStrEnd = '';
 if (dpos != -1) {
  nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
  nStr = nStr.substring(0, dpos);
 }
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(nStr)) {
  nStr = nStr.replace(rgx, '$1' + sep + '$2');
 }
   
    $(".b1").val(nStr + nStrEnd);
});
</script>
<script>
$('.a').mask("000 000 000 000", {reverse: true});
$('.b').mask("000 000 000 000", {reverse: true});
$(".a").change(function(){
    var nStr = $(".a").val().trim();
    nStr = nStr.replace(/ /g, '');
    
    var inD = ".";
    var outD = ".";
    var sep = " ";
    var dpos = nStr.indexOf(inD);
 var nStrEnd = '';
 if (dpos != -1) {
  nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
  nStr = nStr.substring(0, dpos);
 }
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(nStr)) {
  nStr = nStr.replace(rgx, '$1' + sep + '$2');
 }
   
    $(".a").val(nStr + nStrEnd);
});
$(".b").change(function(){
    var nStr = $(".b").val().trim();
    nStr = nStr.replace(/ /g, '');
    
    var inD = ".";
    var outD = ".";
    var sep = " ";
    var dpos = nStr.indexOf(inD);
 var nStrEnd = '';
 if (dpos != -1) {
  nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
  nStr = nStr.substring(0, dpos);
 }
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(nStr)) {
  nStr = nStr.replace(rgx, '$1' + sep + '$2');
 }
   
    $(".b").val(nStr + nStrEnd);
});

$('.ui-button').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
$(".ui-button").button();
$('#dialogAllocate_').click(function(){
		$('#dialogAllocate').dialog('open');
		return false;
});
$('#dialogAllocateEVD_').click(function(){
		$('#dialogAllocateEVD').dialog('open');
		return false;
});
$('#dialogAllocateB2W_').click(function(){
		$('#dialogAllocateB2W').dialog('open');
		return false;
});



	$("#btnAllocate").click(function(){
		if($("#allocAMNT").val().replace(/ /g, '') == $("#allocAMNT2").val().replace(/ /g, '')){
		$("#btnAllocate").attr('disabled',true);
			var params = {
					Method:'allocate',
					MSISDN:window.authMobNumber,
					AMOUNT:$("#allocAMNT").val().replace(/ /g, ''),
					REMARKS:$("#allocRemarks").val(),
					PASSWORD:$("#allocPassword").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			
			$('.allocloading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$("#btnAllocate").attr('disabled',false);
						//alert(res.responseText);
						if(status=="success"){
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								var prev = $("#txtCurrentAmount").val();
								var amt = parseInt(prev) + parseInt(params.AMOUNT);
								//$("#txtCurrentAmount").val(amt);
								$("#allocAMNT").val('')
								$("#allocAMNT2").val('')
								$("#allocRemarks").val('')
								$("#allocPassword").val('')
							}
						}
						$('.allocloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$('#dialogAllocate').dialog('close');
							}
						});
					}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});

		}else{
			$("<p><?php echo _("Amount did not match! Please confirm!"); ?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

		}	
	});
	
	$("#btnDeallocate").click(function(){
		if($("#allocAMNT").val().replace(/ /g, '') == $("#allocAMNT2").val().replace(/ /g, '')){
		$("#btnDeallocate").attr('disabled',true);
			var params = {
					Method:'allocate',
					MSISDN:window.authMobNumber,
					AMOUNT:$("#allocAMNT").val().replace(/ /g, '') * -1,
					USERID:window.CurrentUser,
					REMARKS:$("#allocRemarks").val(),
					PASSWORD:$("#allocPassword").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			
			$('.deallocload').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$("#btnDeallocate").attr('disabled',false);
						//alert(res.responseText);
						if(status=="success"){
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								var prev = $("#txtCurrentAmount").val();
								var amt = parseInt(prev) + parseInt(params.AMOUNT);
								//$("#txtCurrentAmount").val(amt);
								$("#allocAMNT").val('')
								$("#allocRemarks").val('')
								$("#allocPassword").val('')
							}
						}
						$('.deallocload').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$('#dialogAllocate').dialog('close');
							}
						});
					}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});

		}else{
			$("<p><?php echo _("Amount did not match! Please confirm!"); ?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
	$("#btnAllocateEVD").click(function(){
			var params = {
					Method:'allocateEVD',
					MSISDN:window.authMobNumber,
					AMOUNT:$("#allocAMNTEVD").val(),
					REMARKS:$("#allocRemarksEVD").val(),
					PASSWORD:$("#allocPasswordEVD").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			$('.allocloadingEVD').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						//alert(res.responseText);
						if(status=="success"){
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								var prev = $("#txtCurrentAmountEVD").val();
								var amt = parseInt(prev) + parseInt(params.AMOUNT);
								//$("#txtCurrentAmount").val(amt);
								$("#allocAMNTEVD").val('')
								$("#allocRemarksEVD").val('')
								$("#allocPasswordEVD").val('')
							}
						}
						
						$('.allocloadingEVD').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$('#dialogAllocateEVD').dialog('close');
							}
						});
					}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
			
	});
	
	$("#btnDeallocateEVD").click(function(){
	
			var params = {
					Method:'allocateEVD',
					MSISDN:window.authMobNumber,
					AMOUNT:$("#allocAMNTEVD").val() * -1,
					USERID:window.CurrentUser,
					REMARKS:$("#allocRemarksEVD").val(),
					PASSWORD:$("#allocPasswordEVD").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				
			};
			
			$('.deallocloadEVD').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						//alert(res.responseText);
						if(status=="success"){
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								var prev = $("#txtCurrentAmountEVD").val();
								var amt = parseInt(prev) + parseInt(params.AMOUNT);
								//$("#txtCurrentAmount").val(amt);
								$("#allocAMNTEVD").val('')
								$("#allocRemarksEVD").val('')
								$("#allocPasswordEVD").val('')
							}
						}
						$('.deallocloadEVD').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$('#dialogAllocateEVD').dialog('close');
							}
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});

	});
	
	
	$("#btnAllocateB2W").click(function(){

		$("#btnAllocateB2W").attr('disabled',true);
		if($("#allocAMNTB2W").val().replace(/ /g, '') == $("#allocAMNTB2W2").val().replace(/ /g, '')){
			var params = {
					Method:'allocateB2W',
					MSISDN:window.authMobNumber,
					BANKREFERENCE:$("#allocBankRefB2W").val(),
					AMOUNT:$("#allocAMNTB2W").val().replace(/ /g, ''),
					REMARKS:$("#allocRemarksB2W").val(),
					PASSWORD:$("#allocPasswordB2W").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			
			$('.allocloadingB2W').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$("#btnAllocateB2W").attr('disabled',false);
						if(status=="success"){
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$("#allocBankRefB2W").val('');
								$("#allocAMNTB2W").val('')
								$("#allocAMNTB2W2").val('')
								$("#allocRemarksB2W").val('')
								$("#allocPasswordB2W").val('')
							}
						}
						$('.allocloadingB2W').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$('#dialogAllocateB2W').dialog('close');
							}
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});

		}else{
			$("#btnAllocateB2W").attr('disabled',false);
			$("<p><?php echo _("Amount did not match! Please confirm!"); ?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

		}	
	});
</script>
<!-- start activate/deactivate -->
<script>
$("#btnActivate").click(function(){
	$("#btnActivate").attr('disabled',true);
			var params = {
					Method:'activate',
					MSISDN:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			$('.loading').fadeToggle(300);
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					error:function(a,b,c){console.log(a);console.log(b);console.log(c)},
					complete:function(res,status){
						$("#btnActivate").attr('disabled',false);
						$('.loading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
									if(res.responseText.toLowerCase().indexOf("success",0)>-1){
										$("#btnDeactivate").fadeToggle(10);
										$("#btnActivate").fadeToggle(10);
										$("#pAccountStatus").val("ACTIVE");
									}
								}
									if(res.responseText.toLowerCase().indexOf("success",0)>-1){
										$("#btnDeactivate").fadeToggle(10);
										$("#btnActivate").fadeToggle(10);
										$("#pAccountStatus").val("ACTIVE");
									}
						});
						$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
							type:"POST",
							complete:function(res,status){
								window.parent.pagetoken = res.responseText;
								setTimeout($.unblockUI, 1000);
							}
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#btnDeactivate").click(function(){
		$("#btnDeactivate").attr('disabled',true);
			var params = {
					Method:'deactivate',
					MSISDN:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			$('.loading').fadeToggle(300);
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$("#btnDeactivate").attr('disabled',false);
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
						if(status=="success"){
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$("#btnDeactivate").fadeToggle(10);
								$("#btnActivate").fadeToggle(10);
								$("#pAccountStatus").val("DEACTIVE");
							}
						}
							if(res.responseText.toLowerCase().indexOf("success",0)>-1){
								$("#btnDeactivate").fadeToggle(10);
								$("#btnActivate").fadeToggle(10);
								$("#pAccountStatus").val("DEACTIVE");
							}
						$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
							type:"POST",
							complete:function(res,status){
								window.parent.pagetoken = res.responseText;
								setTimeout($.unblockUI, 1000);
							}
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
</script>
<!-- start reset pin -->
<script>
$("#btnResetPin").click(function(){
	$("#btnResetPin").attr('disabled',true);
			var params = {
					Method:'resetPassword',
					MSISDN:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
			};
			$('.loading').fadeToggle(300);
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					//async:false,
					complete:function(res,status){
						$("#btnResetPin").attr('disabled',false);
						$('.loading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
						//alert(res.responseText);
						$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
							type:"POST",
							complete:function(res,status){
								window.parent.pagetoken = res.responseText;
								setTimeout($.unblockUI, 1000);
							}
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
});
</script>
<!-- start lock/unlock -->
<script>
$('#btnLock').click(function(){
		$('#dialogLock').dialog('open');
		return false;
});
$("#btnLockSubscriber").click(function(){
	$("#btnLockSubscriber").attr('disabled',true);
			var params = {
					Method:'lock',
					MSISDN:window.authMobNumber,
					LockDescription:$("#lockdesc").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
			};
			
				$('.lockloading').fadeToggle(300);
				$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						//async:false,
						complete:function(res,status){
							$("#btnLockSubscriber").attr('disabled',false);
							$('.lockloading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
									if(res.responseText.toLowerCase().indexOf("success",0)>-1){
										$("#btnLock").fadeToggle(10);
										$("#btnUnlock").fadeToggle(10);
										$("#pLocked").val("YES");
										$("#lockdesc").val('')
									}
								}
									if(res.responseText.toLowerCase().indexOf("success",0)>-1){
										$("#btnLock").fadeToggle(10);
										$("#btnUnlock").fadeToggle(10);
										$("#pLocked").val("YES");
										$("#lockdesc").val('')
									}
								$('#dialogLock').dialog('close');
							});
							
							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
						}, error: function(e){
							setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			
	});
	
	$("#btntest").click(function(){
			var params = {
					Method:'testAPICall',
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			
				$('.lockloading').fadeToggle(300);
				$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						//async:false,
						complete:function(res,status){
							$('.lockloading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
									if(res.responseText.toLowerCase().indexOf("success",0)>-1){
										$("#btnLock").fadeToggle(10);
										$("#btnUnlock").fadeToggle(10);
										$("#pLocked").val("YES");
										$("#lockdesc").val('')
									}
								}
									if(res.responseText.toLowerCase().indexOf("success",0)>-1){
										$("#btnLock").fadeToggle(10);
										$("#btnUnlock").fadeToggle(10);
										$("#pLocked").val("YES");
										$("#lockdesc").val('')
									}
								$('#dialogLock').dialog('close');
							});
							
							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
						}, error: function(e){
							setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			
	});

	$("#btnUnlock").click(function(){
		$("#btnUnlock").attr('disabled',true);
			var params = {
					Method:'unlock',
					MSISDN:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
					
			};
			$('.loading').fadeToggle(300);
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					//async:false,
					complete:function(res,status){
						$("#btnUnlock").attr('disabled',false);
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$("#btnLock").fadeToggle(10);
									$("#btnUnlock").fadeToggle(10);
									$("#pLocked").val("NO");
								}
							}
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$("#btnLock").fadeToggle(10);
									$("#btnUnlock").fadeToggle(10);
									$("#pLocked").val("NO");
								}
						});
						//alert(res.responseText);
						$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
							type:"POST",
							complete:function(res,status){
								window.parent.pagetoken = res.responseText;
								setTimeout($.unblockUI, 1000);
							}
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#btnDeleteIMSI").click(function(){
		$("#btnDeleteIMSI").attr('disabled',true);
			var params = {
					Method:'deleteMobileIMSI',
					MSISDN:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
					
			};
			$('.loading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$("#btnDeleteIMSI").attr('disabled',false);
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$("#btnDeleteIMSI").fadeToggle(10);
								}
							}
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});


	$("#btnDeleteTerminalID").click(function(){
		$("#btnDeleteTerminalID").attr('disabled',true);
			var params = {
					Method:'deleteTerminalID',
					MSISDN:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			$('.loading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								
									if(res.responseText.toLowerCase().indexOf("subject",0)>-1){
										$("#btnDeleteTerminalID").hide();
									}else{
										$("#btnDeleteTerminalID").attr('disabled',false);
									}
								
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
</script>



<script>
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";	
</script>
<script>
$(function(){
		oTable = $('#reports_registeredMerchants').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false
		});
	});

$(document).ready(function(){
	function run(field) {
	    setTimeout(function() {
			var regex  = /^-?\d*\.?\d*$/;
	        field.value = regex.exec(field.value);
	    }, 0);
	}

	$("#cardreaderrequested2").bind('keyup', function(){
		//("test");
		if(Number($("#cardreaderrequested2").val())>10){
			$("#cardreaderrequested2").val("");
			$("<p>Please use Batch upload functionality. Create the main account first, then open created account and upload the file with cashier details.</p>").dialog({width: 450,resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		
		var type = $("#regStoreType").val();

		//alert(type);
		if(type == 'MADM'){
			//SAM
			//checkCashier(2);
			//checkCashier(Number($("#cardreaderrequested2").val()) + 1);
		}else{
			//SAM
			//checkCashier(1);
			//checkCashier($("#cardreaderrequested2").val());
			checkCashier(Number($("#cardreaderrequested2").val()) + 1);
		}
	});


	var crr = "<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['cardreaderrequested2']) + (sanitize_string($_REQUEST['TYPE']) != "MERC" ? 1 : 0);?>";
	checkCashier(crr);
	function checkCashier(n){
		//alert("checkcashier: " + n);
		if(n >= 2){$('.cc1').show();}else{$('.cc1').hide();}
		if(n >= 3){$('.cc2').show();}else{$('.cc2').hide();}
		if(n >= 4){$('.cc3').show();}else{$('.cc3').hide();}
		if(n >= 5){$('.cc4').show();}else{$('.cc4').hide();}
		if(n >= 6){$('.cc5').show();}else{$('.cc5').hide();}
		if(n >= 7){$('.cc6').show();}else{$('.cc6').hide();}
		if(n >= 8){$('.cc7').show();}else{$('.cc7').hide();}
		if(n >= 9){$('.cc8').show();}else{$('.cc8').hide();}
		if(n >= 10){$('.cc9').show();}else{$('.cc9').hide();}
		if(n >= 11){$('.cc10').show();}else{$('.cc10').hide();}
	}
	
	function corp(){
		var type = $("#regStoreType").val();
		if(type == 'MADM'){
			//checkCashier(2);
	 		$('#regStoreType').removeAttr('disabled');
			checkCashier(Number($("#cardreaderrequested2").val()) + 1);
		}else{
			//checkCashier(1);
			$('#regStoreType').val(type);
			$('#regStoreType').attr('disabled', 'disabled');
			checkCashier($("#cardreaderrequested2").val());
			
		}
	}
	
	validateMSISDNc("1");
	validateMSISDNc("2");
	validateMSISDNc("3");
	validateMSISDNc("4");
	validateMSISDNc("5");
	validateMSISDNc("6");
	validateMSISDNc("7");
	validateMSISDNc("8");
	validateMSISDNc("9");
	validateMSISDNc("10");
	function validateMSISDNc(n){
		$("#c"+n).bind('keyup', function(){	
			if($("#c"+n).val() == $("#addAuthorizedNumberStore").val()){
				$("#msisdnValidity"+n).css("color", "#ffffff");
				$("#msisdnValidity"+n).val('Already Exist MSISDN!')
				$("#btnRegisterStore").hide();
				$("#msisdnValidity"+n).css("background-color", "#ff9900");
			}else{
				var params = {Method:'validateMSISDN',inp:$("#c"+n).val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};			
				$.ajax({
					url:service_url,
					type:"POST", 
					data:params,
					complete:function(result,status){
							if(status=="success" || 1==1){													
								$("#msisdnValidity"+n).css("color", "#ffffff");
								if(result.responseText == 4){								
									$("#msisdnValidity"+n).val('Account Already Exist!')
									$("#btnRegisterStore").hide();
									$("#msisdnValidity"+n).css("background-color", "#ff9900");
																
								}
								if(result.responseText == 1){
									$("#msisdnValidity"+n).val('Invalid Format!')
									$("#btnRegisterStore").hide();
									$("#msisdnValidity"+n).css("background-color", "#ff0000");
								}
								if(result.responseText == 2){
									var i = 1;
									var cnt = 0;
									var ccnt = 0;
									while (i < 10) {
										if($("#c"+i).val() == $("#c"+n).val()){
											cnt++;
										}
										if($("#regAuthorizedNumber").val() == $("#c"+n).val()){
											ccnt = 1;
										}
										i++;
									}
									if(cnt > 1){
										$("#msisdnValidity"+n).val('Already Exist in Cashier List!')
										$("#btnRegisterStore").hide();
										$("#msisdnValidity"+n).css("background-color", "#ff9900");
									}else{
										$("#msisdnValidity"+n).val('FREE!')
										$("#msisdnValidity"+n).css("background-color", "#009900");
										$("#btnRegisterStore").show();
										var ht = $("#registration_form").css('height');
										ht = ht.replace("px","");
										$("#if",window.parent.document).css('height',parseInt(ht)+70);
									}
									if(ccnt == 1){
										$("#msisdnValidity"+n).val('Already Exist MSISDN!')
										$("#btnRegisterStore").hide();
										$("#msisdnValidity"+n).css("background-color", "#ff9900");
									}
									
									
								}
							}
						}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}
		});
	}
	
	
	

	
	var ht = $("#account_info_tab").css('height');
	ht = ht.replace("px","");
	$("#ifsearch",window.parent.document).css('height',parseInt(ht)+340);
	
	// Dialog			
	$('#dialogAllocate, #dialogAllocateEVD, #dialogLock, #dialogAllocateB2W').dialog({
		autoOpen: false,
		width: 700,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		//position: 'top',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	$('#dialogMPOS').dialog({
		autoOpen: false,
		width: 1200,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		//position: 'top',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});	
	$('#dialogStore').dialog({
		autoOpen: false,
		width: 1200,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		//position: 'top',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});	
	$('#dialogUploadMpos').dialog({
		autoOpen: false,
		width: 1200,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		//position: 'top',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});	

	$('#dialogUploadStore').dialog({
		autoOpen: false,
		width: 1200,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		//position: 'top',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});	

	$('#btnUploadMPOS').click(function(){
		//alert("asdf");
		$('#dialogUploadMpos').dialog('open');
		$("#dialogUploadMpos").load("<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.uploadcashier.iframe.php?AccountType=<?php echo $account==null?"":$account->AccountType?>&NewStore=0");
		return false;
	});	


	$('#btnUploadStore').click(function(){
		//alert("asdf");
		$('#dialogUploadStore').dialog('open');
		$("#dialogUploadStore").load("<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.uploadcashier.iframe.php?AccountType=" + $("#regStoreType2").val() + "&NewStore=1");
		return false;
	});	
});
// Prevent the backspace key from navigating back.
	$(document).unbind('keydown').bind('keydown', function (event) {
		var doPrevent = false;
		if (event.keyCode === 8) {
			var d = event.srcElement || event.target;
			if ((d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'TEXT') 
				 || d.tagName.toUpperCase() === 'TEXTAREA' || (d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'PASSWORD')) {
				doPrevent = d.readOnly || d.disabled;
			}
			else {
				doPrevent = true;
			}
		}
		if (doPrevent) {
			event.preventDefault();
		}
	});

	
	
	$("#allocAMNT").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode == 86 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
	});
	loadAccountType();
	
	function loadAccountType(){
        var params = {Method:'getAccountType',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
        $.ajax({
			type: "POST",
           url:service_url,
           success:function(result,status){
               var listitem = ""
               $('#selectedType').find('option').remove();                                      
                for(var i = 0; i < result.value.length; i++)
                {            
                	var selected = "";
                    if(result.value[i].ACCOUNTTYPE == window.AccountType){
                        selected = "selected";
                    }
                   
                    listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'"' + selected +'>' + result.value[i].DESCRIPTION + '</option>';
                                                
                }
                
                $('#selectedType').html(listitem);               
                $('#selectedType').click();
              
           },
           dataType:"JSON",
           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
        });       
	}

	$('#btnmpossave').hide();
	$('#btnmposcancel').hide();
	$("#btnmposedit").click(function(){
		$('#pTerminalid').removeAttr('disabled');
		$('#pReaderSerialNumber').removeAttr('disabled');
		$('#btnmpossave').show();
		$('#btnmposcancel').show();
		$('#btnmposedit').hide();
	});
	$("#btnmposcancel").click(function(){
		$('#pTerminalid').attr('disabled','disabled');
		$('#pReaderSerialNumber').attr('disabled','disabled');
		$('#btnmposedit').show();
		$('#btnmpossave').hide();
		$('#btnmposcancel').hide();
	});
	$("#btnmpossave").click(function(){
		
	});
	$("#btnmpossave").click(function(){
		$("#btnmpossave").attr('disabled',true);
			var params = {
					Method:'mPOSupdate',
					MSISDN:window.authMobNumber,
					terminalid:$('#pTerminalid').val(),
					serialnumber:$('#pReaderSerialNumber').val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
					
			};
			$('.loading').fadeToggle(300);
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					//async:false,
					complete:function(res,status){
						$("#btnmpossave").attr('disabled',false);
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$('#pTerminalid').attr('disabled','disabled');
									$('#pReaderSerialNumber').attr('disabled','disabled');
									$('#btnmpossave').hide();
									$('#btnmposcancel').hide();
									$('#btnmposedit').show();
								}
							}
							
							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
						});
						//alert(res.responseText);
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});

	

$('#btnRegMPOS').click(function(){
	$('#dialogMPOS').dialog('open');
	return false;
});	

$('#btnRegStore').click(function(){
	$('#dialogStore').dialog('open');
	
	return false;
});	



	nationality1();
	function nationality1(){
		var params = {
				Method:'queryGlobal',
				query: 'VAx6TD1cdLGY0gtdmqoy1Ww7qORzV+pK/njFL3qi3RnjueRPSi4wDCPTJnSJdezn1AS5RxRMK32Gj/IDS2EiRzftsFeC5PdooPdZcmXfcVA=',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem1 = "";
					var listitem2 = "";                              
					$('#NATIONALITY').find('option').remove();
					$('#COUNTRY').find('option').remove();
					$('#addNationality').find('option').remove();
					for(x in result.value){
						
						var selected1 = "";
						if(result.value[x].COUNTRY == window.nationality){
							selected1 = "selected";
						}
						var selected2 = "";
						if(result.value[x].COUNTRY == window.country){
							selected2 = "selected";
						}
						listitem1 += '<option ' + selected1 + '>' + result.value[x].COUNTRY + '</option>';
						listitem2 += '<option ' + selected2 + '>' + result.value[x].COUNTRY + '</option>';
						
					}
					$('#NATIONALITY').html(listitem1);
					$('#NATIONALITY').click();
					$('#COUNTRY').html(listitem2);
					$('#COUNTRY').click();
					$('#addNationality').html(listitem1);
					$('#addNationality').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	idDescription1();
	function idDescription1(){
		var params = {
				Method:'queryGlobal',
				query: '4AkaOJGv/zrVZBP0IcCju/qSv+PtvFkzXP0OF87YgPLcTXo/VFY9SCS3n2T3BsxHh1iauNqTqGImNWWz4X7YmsHsr1j4E8UjURsnlIDuhtY=',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#addIDDesc').find('option').remove();
					for(x in result.value){
						
						var selected = "";
						if(result.value[x].DESCRIPTION == window.IDDescription){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#addIDDesc').html(listitem);
					$('#addIDDesc').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
		
	region1();
	function region1(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR51+Sma/ekvy49dYDKIkPHILWqu2taEAYwJnsknXhb1JEeiRwPfSvQQB9/jSSdhK+s7g==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#REGION').find('option').remove();
					for(x in result.value){
						
						var selected = "";
						if(result.value[x].DESCRIPTION == window.Region){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#REGION').html(listitem);
					$('#REGION').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	profession1();
	function profession1(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR51+8Y/cSaFpWOnMxaNuQn1WGIad0FzRV8oFVBVvO8RD1KxF9htfRKEiCys2WCVc49jg==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#PROFESSION').find('option').remove();
					for(x in result.value){
						
						var selected = "";
						if(result.value[x].DESCRIPTION == window.profession){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#PROFESSION').html(listitem);
					$('#PROFESSION').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	businesstype1();
	function businesstype1(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR518HocjGrLnhgg0+njw6Tr/qGUjlK7TvmLJmB6a/k+x9DmLdlYyUp7ltBPoHaZpg0bQ==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#REGCORPTYPEOFBUSINESS').find('option').remove();
					for(x in result.value){
						var selected = "";
						if(result.value[x].DESCRIPTION == window.businesstype){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#REGCORPTYPEOFBUSINESS').html(listitem);
					$('#REGCORPTYPEOFBUSINESS').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	$("#btnRegisterMPOS").hide();
	$("#addAuthorizedNumber").change(function(){	
    	var params = {Method:'validateMSISDN',inp:$("#addAuthorizedNumber").val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};			
		$.ajax({
			url:service_url,
			type:"POST", 
			data:params,
			complete:function(result,status){												
					if(status=="success" || 1==1){													
						$("#msisdnValidity").css("color", "#ffffff");
						if(result.responseText == 4){								
							$("#msisdnValidity").val('Account Already Exist!')
							$("#btnRegisterMPOS").hide();
							$("#msisdnValidity").css("background-color", "#ff9900");
														
						}
						if(result.responseText == 1){
							$("#msisdnValidity").val('Invalid Format!')
							$("#btnRegisterMPOS").hide();
							$("#msisdnValidity").css("background-color", "#ff0000");
						}
						if(result.responseText == 2){
							$("#msisdnValidity").val('FREE!')								
							$("#btnRegisterMPOS").show();
							$("#msisdnValidity").css("background-color", "#009900");
							var ht = $("#registration_form").css('height');
							ht = ht.replace("px","");
							$("#if",window.parent.document).css('height',parseInt(ht)+70);
						}
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
    });	



	$("#btnRegisterStore").hide();
	$("#addAuthorizedNumberStore").change(function(){	
    	var params = {Method:'validateMSISDN',inp:$("#addAuthorizedNumberStore").val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};			
		$.ajax({
			url:service_url,
			type:"POST", 
			data:params,
			complete:function(result,status){												
					if(status=="success" || 1==1){													
						$("#msisdnValidityStore").css("color", "#ffffff");
						if(result.responseText == 4){								
							$("#msisdnValidityStore").val('Account Already Exist!')
							$("#btnRegisterStore").hide();
							$("#msisdnValidityStore").css("background-color", "#ff9900");
														
						}
						if(result.responseText == 1){
							$("#msisdnValidityStore").val('Invalid Format!')
							$("#btnRegisterStore").hide();
							$("#msisdnValidityStore").css("background-color", "#ff0000");
						}
						if(result.responseText == 2){
							$("#msisdnValidityStore").val('FREE!')								
							$("#btnRegisterStore").show();
							$("#msisdnValidityStore").css("background-color", "#009900");
							var ht = $("#registration_form").css('height');
							ht = ht.replace("px","");
							$("#if",window.parent.document).css('height',parseInt(ht)+70);
						}
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
    });	
	function checkage(){
		var today = new Date();
		var dobArr = $("#DOB").val().split("-");
	    var birthDate = new Date(dobArr[0],dobArr[1]-1,dobArr[2]);
	    var age = today.getFullYear() - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
	        age--;
	    }
		if (age>=18){
			$('#tblKin').hide();
		}
		else
		{
			$('#tblKin').show();
			var ht = $("#registration_form").css('height');
			ht = ht.replace("px","");
				$("#if",window.parent.document).css('height',parseInt(ht)+20);
		}
	}


	$("#btnRegisterMPOS").click(function(){
		//alert('<?php echo $account==null?"":$account->AccountType?>');
		if($("#addFName").val().trim()=="" || $("#addLName").val().trim()=="" || $("#addEmail").val().trim() ==""){
			$("#addFName").val("Cashier");
			$("#addLName").val("<?php echo $account==null?"": (int)$account->numberofcashier + 1 ?>");
			$("#addEmail").val("<?php echo $account==null?"":$account->PersonalInformation->EmailAddress ?>");
			
		}else{
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({
				url:service_url,
				type:'post',
				dataType:'json',
				data:{
					Method:'registerAccountMPOS', 
					REGCORPBUSINESSNAME:'<?php echo $account==null?"":$account->CorpInformation->businessname ?>',
					TYPE:'<?php echo $account==null?"":$account->AccountType?>',
					REGCORPTYPEOFBUSINESS:window.businesstype,
					REGCORPOWNERSHIPINFO:'<?php echo $account==null?"":$account->CorpInformation->ownershipinfo ?>',
					REGCORPBUILDINGNAME:'<?php echo $account==null?"":$account->CorpInformation->building ?>',
					REGCORPFLOOR:'<?php echo $account==null?"":$account->CorpInformation->floor ?>',
					REGCORPSTREETNAME:'<?php echo $account==null?"":$account->CorpInformation->street ?>',
					REGCORPAREA:'<?php echo $account==null?"":$account->CorpInformation->area ?>',
					REGCORPCITY:'<?php echo $account==null?"":$account->CorpInformation->city ?>',
					COUNTRY:window.country,
					REGCORPPOBOX:'<?php echo $account==null?"":$account->CorpInformation->pobox ?>',
					REGCORPRECEIPTNAME:'<?php echo $account==null?"":$account->CorpInformation->receiptname ?>',
					CASHTYPE:'<?php echo $account==null?"":$account->cashtype ?>',
					FIRSTNAME:$("#addFName").val(),
					LASTNAME:$("#addLName").val(),
					MSISDN:$("#addAuthorizedNumber").val(),
					EMAIL:$("#addEmail").val(),
					CURRENTREFACCOUNT:'<?php echo $account==null?"":$account->ReferenceAccount ?>',
					IDDESC:"",
					IDNUMBER:"",
					NATIONALITY:"",
					ISSUANCE:"",
					EXPIRY:"",
					PROFESSION:"",
					MERCDISCOUNTRATE:'<?php echo $account==null?"":$account->mercdiscountrate ?>',
					REGCORPFEESTRXN:'<?php echo $account==null?"":$account->mcvisafee ?>',
					CASHDISCOUNTRATE:'<?php echo $account==null?"":$account->cashdiscountrate ?>',
					CASHTRANSFEE:'<?php echo $account==null?"":$account->cashtransfee ?>',
					TERMINALID:0,
					MERCHANTID:'<?php echo isset($account)?$account->merchantid:"" ?>',
					SERIALNO:0,
					DEVICETYPE:$("#DEVICETYPE").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				},success: function(json){
					if(json.responsecode == 0){
						$("#dialogMPOS").dialog('close');

					}
					$("<p>"+json.message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					
					$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
						type:"POST",
						complete:function(res,status){
							window.parent.pagetoken = res.responseText;
							setTimeout($.unblockUI, 1000);
						}
					});

				}, error: function(e){
					setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		}
	});



	$("#btnRegisterStore").click(function(){
		//alert('<?php echo $account==null?"":$account->AccountType?>');
		if($("#addFNameStore").val().trim()=="" || $("#addLNameStore").val().trim()=="" || $("#addEmailStore").val().trim() ==""){
			$("#addFNameStore").val("Store");
			$("#addLNameStore").val("<?php echo $account==null?"": (int)$account->numberofstore + 1 ?>");
			$("#addEmailStore").val("<?php echo $account==null?"":$account->PersonalInformation->EmailAddress ?>");
		}else{
			var cashier1 = $("#c1").val() + "," + $("#c1fn").val() + "," + $("#c1ln").val() + "," + $("#c1e").val() + "," + $("#DEVICETYPE1").val() + "," + $("#c1tid").val() + "," + $("#cp1").val() + "," + $("#vf1").val();
			var cashier2 = $("#c2").val() + "," + $("#c2fn").val() + "," + $("#c2ln").val() + "," + $("#c2e").val() + "," + $("#DEVICETYPE2").val() + "," + $("#c2tid").val() + "," + $("#cp2").val() + "," + $("#vf2").val();
			var cashier3 = $("#c3").val() + "," + $("#c3fn").val() + "," + $("#c3ln").val() + "," + $("#c3e").val() + "," + $("#DEVICETYPE3").val() + "," + $("#c3tid").val() + "," + $("#cp3").val() + "," + $("#vf3").val();
			var cashier4 = $("#c4").val() + "," + $("#c4fn").val() + "," + $("#c4ln").val() + "," + $("#c4e").val() + "," + $("#DEVICETYPE4").val() + "," + $("#c4tid").val() + "," + $("#cp4").val() + "," + $("#vf4").val();
			var cashier5 = $("#c5").val() + "," + $("#c5fn").val() + "," + $("#c5ln").val() + "," + $("#c5e").val() + "," + $("#DEVICETYPE5").val() + "," + $("#c5tid").val() + "," + $("#cp5").val() + "," + $("#vf5").val();
			var cashier6 = $("#c6").val() + "," + $("#c6fn").val() + "," + $("#c6ln").val() + "," + $("#c6e").val() + "," + $("#DEVICETYPE6").val() + "," + $("#c6tid").val() + "," + $("#cp6").val() + "," + $("#vf6").val();
			var cashier7 = $("#c7").val() + "," + $("#c7fn").val() + "," + $("#c7ln").val() + "," + $("#c7e").val() + "," + $("#DEVICETYPE7").val() + "," + $("#c7tid").val() + "," + $("#cp7").val() + "," + $("#vf7").val();
			var cashier8 = $("#c8").val() + "," + $("#c8fn").val() + "," + $("#c8ln").val() + "," + $("#c8e").val() + "," + $("#DEVICETYPE8").val() + "," + $("#c8tid").val() + "," + $("#cp8").val() + "," + $("#vf8").val();
			var cashier9 = $("#c9").val() + "," + $("#c9fn").val() + "," + $("#c9ln").val() + "," + $("#c9e").val() + "," + $("#DEVICETYPE9").val() + "," + $("#c9tid").val() + "," + $("#cp9").val() + "," + $("#vf9").val();
			var cashier10 = $("#c10").val() + "," + $("#c10fn").val() + "," + $("#c10ln").val() + "," + $("#c10e").val() + "," + $("#DEVICETYPE10").val() + "," + $("#c10tid").val() + "," + $("#cp10").val() + "," + $("#vf10").val();
			var cashiers = [cashier1, cashier2, cashier3, cashier4, cashier5, cashier6, cashier7, cashier8, cashier9, cashier10];
			
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({
				url:service_url,
				type:'post',
				dataType:'json',
				data:{
					Method:'registerAccountStore', 
					REGCORPBUSINESSNAME:'<?php echo $account==null?"":$account->CorpInformation->businessname ?>',
					TYPE:'<?php echo $account==null?"":$account->AccountType?>',
					STORETYPE:$("#regStoreType").val(),
					REGCORPTYPEOFBUSINESS:window.businesstype,
					REGCORPOWNERSHIPINFO:'<?php echo $account==null?"":$account->CorpInformation->ownershipinfo ?>',
					REGCORPBUILDINGNAME:'<?php echo $account==null?"":$account->CorpInformation->building ?>',
					REGCORPFLOOR:'<?php echo $account==null?"":$account->CorpInformation->floor ?>',
					REGCORPSTREETNAME:'<?php echo $account==null?"":$account->CorpInformation->street ?>',
					REGONBOARDEDBY:'<?php echo $account==null?"":$account->CorpInformation->onboardedby ?>',
					REGCORPAREA:$("#STOREREGCORPAREA").val(),
					REGCORPCITY:$("#STOREREGCORPCITY").val(),
					COUNTRY:window.country,
					REGCORPPOBOX:$("#STOREREGCORPPOBOX").val(),
					REGCORPRECEIPTNAME:$("#STOREREGCORPRECEIPTNAME").val(),
					CASHTYPE:'<?php echo $account==null?"":$account->cashtype ?>',
					CASHIERS: cashiers,
					FIRSTNAME:$("#addFNameStore").val(),
					LASTNAME:$("#addLNameStore").val(),
					MSISDN:$("#addAuthorizedNumberStore").val(),
					EMAIL:$("#addEmailStore").val(),
					CURRENTREFACCOUNT:'<?php echo $account==null?"":$account->ReferenceAccount ?>',
					IDDESC:"",
					IDNUMBER:"",
					NATIONALITY:"",
					ISSUANCE:"",
					EXPIRY:"",
					PROFESSION:"",
					MERCDISCOUNTRATE:'<?php echo $account==null?"":$account->mercdiscountrate ?>',
					REGCORPFEESTRXN:'<?php echo $account==null?"":$account->mcvisafee ?>',
					CASHDISCOUNTRATE:'<?php echo $account==null?"":$account->cashdiscountrate ?>',
					CASHTRANSFEE:'<?php echo $account==null?"":$account->cashtransfee ?>',
					TERMINALID:0,
					MERCHANTID:'<?php echo isset($account)?$account->merchantid:"" ?>',
					SERIALNO:0,
					DEVICETYPE:$("#DEVICETYPE").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				},success: function(json){
					if(json.responsecode == 0){
						$("#dialogStore").dialog('close');

					}
					$("<p>"+json.message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					
					$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
						type:"POST",
						complete:function(res,status){
							window.parent.pagetoken = res.responseText;
							setTimeout($.unblockUI, 1000);
						}
					});

				}, error: function(e){
					setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		}
	});
	

$("#addISSUANCE").datepicker({
	//duration:''
	//showOn: 'button', buttonImage: window.imgPath + 'images/calendar.gif', buttonImageOnly: true, 
	changeMonth:true, changeYear:true,
	maxDate: new Date(),
	yearRange: '-100:+20',
	dateFormat: 'yy-mm-dd'
});
$("#addExpiryDate").datepicker({
	//duration:''
	//showOn: 'button', buttonImage: window.imgPath + 'images/calendar.gif', buttonImageOnly: true, 
	changeMonth:true, changeYear:true,
	minDate: new Date(),
	yearRange: '-100:+20',
	dateFormat: 'yy-mm-dd'
});
</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){			
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>

$("#account_info_tab").fadeIn(700);	

<?php if($uploadCashier->Message != null):?>
$(document).ready(function(){	
	$("<p><?php echo $uploadCashier->Message; ?></p>").dialog({
		resizable:false,
		modal:true,
		buttons: { 
			"Ok": function() { 
				$(this).dialog("close");
			} 
		} 
	});						
});
<?php endif; ?>
$("#inpCSV").change(function() {
	var type = $("#inpCSV").val().split('.').pop().toLowerCase();
	if(type == "csv"){
		$("#uploadBtn").attr('disabled',false);
		$("#uploadBtn").removeClass('uploadBtnDisa');
		$("#uploadBtn").addClass('uploadBtnEna');
		$("#err").hide();
	}else{
		$("#uploadBtn").attr('disabled',true);
		$("#uploadBtn").removeClass('uploadBtnEna');
		$("#uploadBtn").addClass('uploadBtnDisa');
		$("#err").html('Invalid filetype, please choose CSV file.');
		$("#err").show();
	}
});
$("#uploadBtn").click(function() {
	$("#uploadGif").show();
});
$('#buttonSelectCSV').click(function () {
    $("#inpCSV").trigger('click');
});
$("#inpCSV").change(function () {
    $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
});


</script>