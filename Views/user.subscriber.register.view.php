<?php $responseMessage = $this->data("responseMessage"); ?>
<?php require_once("views.config.properties.php"); ?>
<body style="background-color:white;background-image:none;">
<div id ="subsreg"  style="display:none;">
	<div align="right" style="display:none;">
		<table>
			<tr>
				<td>FORMS:
					<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/FATCA Test v1.doc" target="_blank">FATCA Test v1.doc</a> ||
					<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/W-8BEN - Confirm non US status - for Individuals.pdf" target="_blank">W-8BEN - Confirm non US status - for Individuals.pdf</a> ||
					<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/W8 BEN-E -Confirm non US status - for Entities.pdf" target="_blank">W8 BEN-E -Confirm non US status - for Entities.pdf</a> ||
					<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/W9 form - To confirm US status.pdf" target="_blank">W9 form - To confirm US status.pdf</a> ||
					<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/Risk Matrix for Merchants (Final Version Oct 2014) (5).xlsx" target="_blank">Risk Matrix for Merchants.xlsx</a>
				</td>
			</tr>
		</table>
	</div>
	<div id="dialogUploadMpos" title="<?php echo _("Upload Batch Cashier File"); ?>">
		
	</div>
	<form id="registration_form" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.register.php" method="post">
		<input type="hidden" name="Method" value="Register" />
		<table border="0" cellspacing="5" id="tblRegister" class="tablet">
			<tr>
				<td colspan="6"><h3><?php echo _("Company Information"); ?></h3></td>
			</tr>
			
			<tr>
				<td><?php echo _("Company Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" class="verifyText" style="text-transform: uppercase" name="REGCORPBUSINESSNAME" id="REGCORPBUSINESSNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPBUSINESSNAME']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				
				<td><?php echo _("Receipt Printed Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" class="verifyText" name="REGCORPRECEIPTNAME" id="REGCORPRECEIPTNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPRECEIPTNAME']) ;?>" maxlength="20" onkeyup="this.value=runNoSpecial(this.value)" style="text-transform: uppercase">
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				
				<td><?php echo _("On boarded by"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="REGCORPONBOARDEDBY" name="REGCORPONBOARDEDBY" style="width:100%;">
						
					</select>
				</td>
			</tr>
			<tr style="display:none;">
				
				<td><?php echo _("Type of Business"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="REGCORPTYPEOFBUSINESS" name="REGCORPTYPEOFBUSINESS" style="width:100%;">
						
					</select>
				</td>
				<td><?php echo _("Nature of Business"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" class="verifyText" name="REGCORPOWNERSHIPINFO" id="REGCORPOWNERSHIPINFO" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPOWNERSHIPINFO']) ;?>">
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>					
			</tr>
			<tr>
				<td colspan="6"><?php echo _("Company Address"); ?></td>
			</tr>
			<tr style="display:none;">
				<td><?php echo _("Building Name"); ?><!--<span style="color:red">*</span>-->:</td>
				<td>
					<input type="text" name="REGCORPBUILDINGNAME" id="REGCORPBUILDINGNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPBUILDINGNAME']) ;?>" >
					<!--<div class="field required">
					<input type="text" class="verifyText" name="REGCORPBUILDINGNAME" id="REGCORPBUILDINGNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPBUILDINGNAME']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>-->
				</td>
				<td><?php echo _("Floor"); ?><!--<span style="color:red">*</span>-->:</td>
				<td>
					<input type="text" name="REGCORPFLOOR" id="REGCORPFLOOR" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPFLOOR']) ;?>" >
					<!--<div class="field required">
					<input type="text" class="verifyText" name="REGCORPFLOOR" id="REGCORPFLOOR" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPFLOOR']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>-->
				</td>
				<td><?php echo _("Street Name"); ?><!--<span style="color:red">*</span>-->:</td>
				<td>
					<input type="text" name="REGCORPSTREETNAME" id="REGCORPSTREETNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPSTREETNAME']) ;?>" >
					<!--<div class="field required">
					<input type="text" class="verifyText" name="REGCORPSTREETNAME" id="REGCORPSTREETNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPSTREETNAME']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>-->
				</td>
			</tr>
			<tr>
				<td><?php echo _("Area / City"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" style="text-transform: uppercase" class="verifyText" name="REGCORPAREA" id="REGCORPAREA" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPAREA']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Emirate"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="REGCORPCITY" name="REGCORPCITY" style="width:100%;">
						
					</select>
					<!--<div class="field required">
					<input type="text" class="verifyText" name="REGCORPCITY" id="REGCORPCITY" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPCITY']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>-->
				</td>
				<td style="display:none;"><?php echo _("Country"); ?><span style="color:red">*</span>:</td>
				<td style="display:none;">
					<select id="regCountry" name="COUNTRY" style="width:100%;">
						
					</select>
				</td>
			</tr>
			<tr>
				<td><?php echo _("P O Box"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
					<input type="text" class="verifyText" name="REGCORPPOBOX" id="REGCORPPOBOX" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPPOBOX']) ;?>" onkeyup="this.value=numOnly(this.value)" maxlength="6">
					<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6"><h3><?php echo _("Authorized Person Details"); ?></h3></td>
			</tr>
			<tr>
				<td><?php echo _("First Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" style="text-transform: uppercase" class="verifyText" id="regFName" name="FIRSTNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['FIRSTNAME']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Last Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" style="text-transform: uppercase" class="verifyText" id="regLName" name="LASTNAME" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['LASTNAME']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Primary Email"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="regEmail" name="EMAIL"value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['EMAIL']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			<tr>
				
				
			</tr>
			<tr style="display:none;">
				<td><?php echo _("ID Type"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="regIDDesc" name="IDDESC">
						
					</select>
				</td>
				<td><?php echo _("ID No."); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="regIDNumber" name="IDNUMBER" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['IDNUMBER']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Nationality"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="regNationality" name="NATIONALITY">
						
					</select>
				</td>				
			</tr>
			<tr style="display:none;">
				<td><?php echo _("Date of Issuance"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="ISSUANCE" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['ISSUANCE']) ;?>" name="ISSUANCE" readonly="true">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Date of Expiry"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" id="regExpiryDate" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['EXPIRY']) ;?>" name="EXPIRY" readonly="true">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td><?php echo _("Title / Position"); ?><span style="color:red">*</span>:</td>
				<td colspan="3">
					<div class="field required">
						<input id="regProfession" class="verifyText" type="text" name="PROFESSION" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['PROFESSION']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6"><h3><?php echo _("Fees"); ?></h3></td>
			</tr>
			<tr>
				<td></td><td><?php echo _("Premium"); ?></td><td><?php echo _("Non-Premium"); ?></td>
			</tr>
			<tr>
				<td><?php echo _("Merchant Discount Rate ( % )"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="MERCDISCOUNTRATE" id="MERCDISCOUNTRATE" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['MERCDISCOUNTRATE']) ;?>" onkeyup="run(this)" >
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="MERCDISCOUNTRATE2" id="MERCDISCOUNTRATE2" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['MERCDISCOUNTRATE2']) ;?>" onkeyup="run(this)" >
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>
				
				<td style="display:none;"><?php echo _("Acquiring Interchange ( % )"); ?>:</td>
				<td style="display:none;">
					<input type="text" class="verifyText" name="REGCORPFEESTRXN" id="REGCORPFEESTRXN" value="<?php echo ($this->data("response") == 0) ? '0.9' : sanitize_string($_REQUEST['REGCORPFEESTRXN']) ;?>" onkeyup="run(this)" >							
				</td>
			</tr>
			<tr>
				<td>
					<select id="CASHTYPE" name="CASHTYPE" style="width:100%;">
						<option value='PERCENT'>Cash Discount Rate (%)</option>
						<option value='FIXED'>Cash Transaction Fee</option>
						<option value='MONTHLY'>Cash Monthly Charges</option>
					</select>
				</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="CASHDISCOUNTRATE" id="CASHDISCOUNTRATE" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['CASHDISCOUNTRATE']) ;?>" onkeyup="run(this)" >
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
					
				</td>						
				<td style="display:none;"><?php echo _("Cash Transaction Fee"); ?>:</td>
				<td style="display:none;">
					<input type="text" class="verifyText" name="CASHTRANSFEE" id="CASHTRANSFEE" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['CASHTRANSFEE']) ;?>" onkeyup="run(this)" >							
				</td>
			</tr>
			<tr>
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6"><h3><?php echo _("Account/device settings"); ?></h3></td>
			</tr>
			<tr>
				<td><?php echo _("Number of card readers requested");?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" name="cardreaderrequested" id="cardreaderrequested" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['cardreaderrequested']) ;?>" onkeyup="run(this)" maxlength="2">0
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
					
				</td>
				<td><?php echo _("Account Type"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="regAccountType" name="TYPE" style="width:100%;" onchange="corp();">
						
					</select>
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
						<input type="text" class="verifyText" name="MSISDN" id="regAuthorizedNumber" onkeyup="this.value=this.value.replace(/\D/g,'');"  value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['MSISDN']) ;?>">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>			
				<td><?php echo _("Validity"); ?>:</td>
				<td><input type="text" class="verifyText" name="msisdnValidity" id="msisdnValidity" disabled="disabled" ></td>
				
				<td><?php echo _("Device Type"); ?>:</td>
					<td>
						<select id="DEVICETYPE" name="DEVICETYPE" style="width:100%;">
							<option value='ANDROID'>Android</option>
							<option value='IOS'>iOS</option>
							<option value='WINDOWS'>Windows</option>
						</select>
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
			<!-- CASHIER 1 TO 9 END -->	
			<tr>
				<td colspan="6">&nbsp;<button  id="btnTEST" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("TEST"); ?></button></td>
			</tr>
			<tr>
				<tr><td colspan="6"><button  id="fileclick" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Attach File"); ?></button>Application File, PDF or JPEG, max file size 6MB</td></tr>
				<tr>
					<td colspan="6"><div id='preview'></div></td>
				</tr>
			</tr>
			<tr>
				<td colspan="6">
					
					<!--<button  id="btnRegisterPOP" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("Register"); ?></button>-->
					<button id="btnRegister" class="ui-state-default-eti ui-corner-all ui-button" >
						<?php echo _("Register"); ?>
					</button>
				</td>
			</tr>
		</table>
		<div id="dialogREG" title="<?php echo _("Register Account"); ?>">
			Are you sure you want to submit?
		</div>

	</form>
	<div align="left" style="display:none;">
		<table>
			<tr><td>Application File, PDF or JPEG, max file size 3MB</td><!--<td>Image 2</td><td>Image 3</td>--></tr>
			<tr>
				<td>
					<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
						<input type="hidden" name="Method" id="Method" value="Image1" />
						<input type="file" name="photoimg" id="photoimg" accept="application/pdf,image/png, image/gif, image/jpeg" />
						<!--<input type="hidden" name="filename" id="filename" value="NewName" />-->
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
</div>
</body>
<link rel="icon" type="image/ico" href="<?php echo $GLOBALS['VIEW_PATH'];?>images/etisalat.ico" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/datatables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/buttons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/errors.css" rel="stylesheet" type="text/css" />
<!-- <link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
	
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-ui-1.8.18.custom.min.js"></script> -->

<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/smoothness/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.3.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.datatables.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.visualize.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/notes.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form-validation-and-hints.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.selectskin.js"></script>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.textchange.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form.js"></script>

<script>
$.ajaxSetup({
	data: {
		t: window.parent.pagetoken
	},
	dataType: "jsonp"
});

	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";	
	window.imgPath = "<?php echo $GLOBALS["VIEW_PATH"]?>";

function run(field) {
    setTimeout(function() {
		var regex  = /^-?\d*\.?\d*$/;
        field.value = regex.exec(field.value);
    }, 0);
}
$("#ISSUANCE").datepicker({
	//duration:''
	//showOn: 'button', buttonImage: window.imgPath + 'images/calendar.gif', buttonImageOnly: true, 
	changeMonth:true, changeYear:true,
	maxDate: new Date(),
	yearRange: '-100:+20',
	dateFormat: 'yy-mm-dd'
});
</script>

<script type="text/javascript" >
$('#btnTEST').hide();
$('#btnTEST').click(function(){
	//$('#registration_form').get(0).submit();
	$("#btnRegister").trigger('click');
	//alert("Test");
});
$('#photoimg').hide();
$("#fileclick").click(function () {
    $("#photoimg").trigger('click');
});
window.pho = "0";
$("#photoimg").click(function () {
    window.pho = "1";
});

$('#btnRegisterSubmit').click(function(){
	//$('#registration_form').get(0).submit();
	document.getElementById("registration_form").submit();
});
$('#btnRegisterPOP').click(function(){
		$('#dialogREG').dialog('open');
});
 $(document).ready(function() { 
 
 
 $('#dialogREG').dialog({
		autoOpen: false
	});
		
            $('#photoimg').on('change', function()			{ 
			$("#preview").html('');
			$("#preview").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
				target: '#preview'
				}).submit();
				window.pho = "0";
			});
			
			$('#photoimg2').on('change', function()			{ 
			$("#preview2").html('');
			$("#preview2").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform2").ajaxForm({
				target: '#preview2'
				}).submit();
		
			});
			
			$('#photoimg3').on('change', function()			{ 
			$("#preview3").html('');
			$("#preview3").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform3").ajaxForm({
				target: '#preview3'
				}).submit();
		
			});
        }); 
</script>
<style>

body
{
font-family:arial;
}
.preview, .preview2, .preview3
{
width:100px;
border:solid 1px #dedede;
padding:10px;
}
#preview, #preview2, #preview3
{
color:#cc0000;
font-size:12px
}

</style>

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	
	var ht = $("#registration_form").css('height');
	ht = ht.replace("px","");
	$("#if",window.parent.document).css('height',parseInt(ht)+200);
	$('#tblCorp').show();
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
	if($("#regAuthorizedNumber").val() == ''){
	$("#btnRegister").hide();}
	$("#regAuthorizedNumber").bind('textchange', function(){	
    	var params = {Method:'validateMSISDN',inp:$("#regAuthorizedNumber").val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};			
		$.ajax({
			url:service_url,
			type:"POST", 
			data:params,
			complete:function(result,status){
					if(status=="success" || 1==1){													
						$("#msisdnValidity").css("color", "#ffffff");
						if(result.responseText == 4){								
							$("#msisdnValidity").val('Account Already Exist!')
							$("#btnRegister").hide();
							$("#msisdnValidity").css("background-color", "#ff9900");
														
						}
						if(result.responseText == 1){
							$("#msisdnValidity").val('Invalid Format!')
							$("#btnRegister").hide();
							$("#msisdnValidity").css("background-color", "#ff0000");
						}
						if(result.responseText == 2 || result.responseText == 0){
							//SAM
							/*CHANGE IN PRODUCTION*/
							$("#msisdnValidity").val('FREE!')								
							$("#btnRegister").show();
							$("#msisdnValidity").css("background-color", "#009900");
							var ht = $("#registration_form").css('height');
							ht = ht.replace("px","");
							$("#if",window.parent.document).css('height',parseInt(ht)+70);
							//checkmsisdn();
							/*CHANGE IN PRODUCTION*/
							/* if(checkmsisdn() == "true"){
								$("#msisdnValidity").val('FREE!')								
								$("#btnRegister").show();
								$("#msisdnValidity").css("background-color", "#009900");
								var ht = $("#registration_form").css('height');
								ht = ht.replace("px","");
								$("#if",window.parent.document).css('height',parseInt(ht)+70);
							}else{
								$("#msisdnValidity").val('Account not KYC!')
								$("#btnRegister").hide();
								$("#msisdnValidity").css("background-color", "#ff9900");
							} */
						}
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
    });
	function checkmsisdn(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment... Checking MSISDN...</h3>' });
	
		var params = {Method:'getMposCustomerDetailsCBCM',msisdn:$("#regAuthorizedNumber").val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
		var msisdnstatus = "false";
		$.ajax({
			url:service_url,
			type:"POST", 
			data:params,
			dataType:'json',
			success: function(json){
				/* $("#REGCORPBUSINESSNAME").val("");
				$("#REGCORPAREA").val("");
				$("#REGCORPCITY").val("");
				$("#regCountry").val("");
				$("#REGCORPPOBOX").val("") */;
				
				$("#msisdnValidity").val('Account not KYC!')
				$("#btnRegister").hide();
				$("#msisdnValidity").css("background-color", "#ff9900");
								
				if(json.responsecode == 0){
					msisdnstatus = json.message;
					
					if(msisdnstatus == "true"){
						/* $("#REGCORPBUSINESSNAME").val(json.value.accountname);
						$("#REGCORPAREA").val(json.value.areacity);
						$("#REGCORPCITY").val(json.value.emirates);
						$("#regCountry").val(json.value.country);
						$("#REGCORPPOBOX").val(json.value.pobox); */

						$("#msisdnValidity").val('FREE!')								
						$("#btnRegister").show();
						$("#msisdnValidity").css("background-color", "#009900");
						var ht = $("#registration_form").css('height');
						ht = ht.replace("px","");
						$("#if",window.parent.document).css('height',parseInt(ht)+70);
					}
				}
				
				setTimeout($.unblockUI, 1000);
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
		return msisdnstatus;
	}
	function checkage(){
		var today = new Date();
		var dobArr = $("#regDob").val().split("-");
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
	
	
	window.AccountType = "<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['TYPE'])?>";
	loadAccountTypeREG();
	function loadAccountTypeREG(){
        var params = {Method:'getAccountTypeRegister',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
        $.ajax({
			type: "POST",
           url:service_url,
           success:function(result,status){
               var listitem = ""                                
               $('#regAccountType').find('option').remove();
                for(var i = 0; i < result.value.length; i++)
                {           
					//listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'">' + result.value[i].DESCRIPTION + '</option>';
					
					var selected = "";
                    if(result.value[i].ACCOUNTTYPE == window.AccountType){
                        selected = "selected";
                    }

                    if(result.value[i].ACCOUNTTYPE!="MERC" && result.value[i].ACCOUNTTYPE!="MPOS"){
                 	   listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'"' + selected +'>' + result.value[i].DESCRIPTION + '</option>';
                    }
                 
                }
                $('#regAccountType').html(listitem);
                $('#regAccountType').click();   
           },
           dataType:"JSON",
           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
        });
	}


	loadStoreTypeREG();
	function loadStoreTypeREG(){
        var params = {Method:'getAccountTypeRegister',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
        $.ajax({
			type: "POST",
           url:service_url,
           success:function(result,status){
               var listitem = ""                                
               $('#regStoreType').find('option').remove();
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
           },
           dataType:"JSON",
           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
        });
	}
	
	nationality();
	function nationality(){
		var params = {
				Method:'queryGlobal',
				query: 'VAx6TD1cdLGY0gtdmqoy1Ww7qORzV+pK/njFL3qi3RnjueRPSi4wDCPTJnSJdezn1AS5RxRMK32Gj/IDS2EiRzftsFeC5PdooPdZcmXfcVA=',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#regNationality').find('option').remove();
					$('#regCountry').find('option').remove();
					for(x in result.value){
						
						listitem += '<option>' + result.value[x].COUNTRY + '</option>';
						
					}
					$('#regNationality').html(listitem);
					$('#regNationality').click();
					$('#regCountry').html(listitem);
					$('#regCountry').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	idDescription();
	function idDescription(){
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
					$('#regIDDesc').find('option').remove();
					for(x in result.value){
						
						listitem += '<option>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#regIDDesc').html(listitem);
					$('#regIDDesc').click();
				}, error: function(e){
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
					$('#REGCORPCITY').find('option').remove();
					for(x in result.value){
						
						listitem += '<option>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#REGCORPCITY').html(listitem);
					$('#REGCORPCITY').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	profession();
	function profession(){
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
					$('#regProfession').find('option').remove();
					for(x in result.value){
						
						listitem += '<option>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#regProfession').html(listitem);
					$('#regProfession').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	businesstype();
	function businesstype(){
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
						
						listitem += '<option>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#REGCORPTYPEOFBUSINESS').html(listitem);
					$('#REGCORPTYPEOFBUSINESS').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	onboardedby();
	function onboardedby(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR5172Oef91SVilBfZq1GVuwz4MK5TuTyqSM7Tjn7mgXt74yHOYKNdgZWjJi8afLIwsmw==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#REGCORPONBOARDEDBY').find('option').remove();
					for(x in result.value){
						
						listitem += '<option>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#REGCORPONBOARDEDBY').html(listitem);
					$('#REGCORPONBOARDEDBY').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
$('#dialogReg').dialog({
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
	position: 'top',
	show: { effect: 'drop', direction: "up" },
	hide: { effect: 'drop', direction: "up", duration:700 }
});	
/* $('#btnRegister').click(function(){
		$('#dialogReg').dialog('open');
		return false;
}); */

$("#cardreaderrequested").bind('textchange', function(){
	if(Number($("#cardreaderrequested").val())>10){
		$("#cardreaderrequested").val("");
		$("<p>Please use Batch upload functionality. Create the main account first, then open created account and upload the file with cashier details.</p>").dialog({width: 450,resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}
	
	var type = $("#regAccountType").val();
	if(type == 'MADM'){
		//SAM
		//checkCashier(2);
		checkCashier(Number($("#cardreaderrequested").val()) + 1);
	}else{
		//SAM
		//checkCashier(1);
		checkCashier($("#cardreaderrequested").val());
	}
});





var crr = "<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['cardreaderrequested']) + (sanitize_string($_REQUEST['TYPE']) != "MERC" ? 1 : 0);?>";
checkCashier(crr);
function checkCashier(n){
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
	var type = $("#regAccountType").val();
	if(type == 'MADM'){
		//checkCashier(2);
 		$('#regStoreType').removeAttr('disabled');
		checkCashier(Number($("#cardreaderrequested").val()) + 1);
	}else{
		//checkCashier(1);
		$('#regStoreType').val(type);
		$('#regStoreType').attr('disabled', 'disabled');
		checkCashier($("#cardreaderrequested").val());
		
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
	$("#c"+n).bind('textchange', function(){	
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
							$("#btnRegister").hide();
							$("#msisdnValidity"+n).css("background-color", "#ff9900");
														
						}
						if(result.responseText == 1){
							$("#msisdnValidity"+n).val('Invalid Format!')
							$("#btnRegister").hide();
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
								$("#btnRegister").hide();
								$("#msisdnValidity"+n).css("background-color", "#ff9900");
							}else{
								$("#msisdnValidity"+n).val('FREE!')
								$("#msisdnValidity"+n).css("background-color", "#009900");
								var ht = $("#registration_form").css('height');
								ht = ht.replace("px","");
								$("#if",window.parent.document).css('height',parseInt(ht)+70);
								if($("#msisdnValidity").val() == 'FREE!'){
									$("#btnRegister").show();
								}
							}
							if(ccnt == 1){
								$("#msisdnValidity"+n).val('Already Exist MSISDN!')
								$("#btnRegister").hide();
								$("#msisdnValidity"+n).css("background-color", "#ff9900");
							}
						}
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
}
</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
		<?php if(strpos($responseMessage,'successfully') !== false):?>
			$(document).ready(function(){
				$("<p><?php echo $responseMessage. '. Do you want to upload cashiers in batch?'?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); $('#dialogUploadMpos').dialog('open'); $("#dialogUploadMpos").load("<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.uploadcashier.iframe.php?AccountType=" + $("#regStoreType").val()); },"Cancel": function() { $(this).dialog("close"); } } });
			});
		<?php else:?>
			$(document).ready(function(){
					if($("#cardreaderrequested").val()!=''){
						var type = $("#regAccountType").val();
						if(type == 'MADM'){
							//SAM
							//checkCashier(2);
							checkCashier(Number($("#cardreaderrequested").val()) + 1);
						}else{
							//SAM
							//checkCashier(1);
							checkCashier($("#cardreaderrequested").val());
						}
					}
					
				$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Cancel": function() { $(this).dialog("close"); } } });
			});
		<?php endif;?>
	<?php endif;?>

$(document).ready(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	setTimeout(function(){
		$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				dataType: "text",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
		});

	}, 3000);
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
		position: 'top',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});	
});

$("#subsreg").fadeIn(700);	
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>