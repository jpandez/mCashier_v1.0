<?php $responseMessage = $this->data("responseMessage"); ?>
<?php require_once("views.config.properties.php"); ?>
<?php
unset($_SESSION['size1']);
unset($_SESSION['size2']);
unset($_SESSION['size3']);
?>

<head>
	<style type="text/css">
	.DivToScroll{   
    background-color: #F5F5F5;
    border: 1px solid #DDDDDD;
    border-radius: 4px 0 4px 0;
    color: #3B3C3E;
    font-size: 12px;
    font-weight: bold;
    left: -1px;
    padding: 10px 7px 5px;
}

.DivWithScroll{
    height:140px;
    overflow:scroll;
    overflow-x:hidden;
}	

	</style>
</head>

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
		<form id="registration_form" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.register.SMB.php" method="post">
			<input type="hidden" name="Method" value="RegisterSMB" />
			<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
			<table border="0" cellspacing="5" id="tblRegister" class="tablet">
				<tr>
					<td colspan="6"><h3><?php echo _("Company Information"); ?></h3></td>
				</tr>

				<tr>
					<td><?php echo _("Company Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" class="verifyText" name="REGCORPBUSINESSNAME" id="REGCORPBUSINESSNAME" onkeyup="this.value=runNoSpecial(this.value)" maxlength="50" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPBUSINESSNAME']) ; ?>" >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
					</td>

					<td><?php echo _("Receipt Printed Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="REGCORPRECEIPTNAME" id="REGCORPRECEIPTNAME" maxlength="23" onkeyup="this.value=runNoSpecial(this.value)" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPRECEIPTNAME']) ;?>" maxlength="20" style="text-transform: uppercase">
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>
					</td>

					<td><?php echo _("On boarded by"); ?><span style="color:red">*</span>:</td>
					<td>
						<select id="REGCORPONBOARDEDBY" name="REGCORPONBOARDEDBY" style="width:100%;">
							<option>ETISALAT</option>
						</select>
						<!--<input type="text" class="verifyText" id="REGCORPONBOARDEDBY" name="REGCORPONBOARDEDBY" maxlength="23" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" value="<?php //echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPONBOARDEDBY']) ;?>">
						<span class="iferror"><?php //echo _("Field required"); ?></span>-->
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
					<input type="text" style="text-transform: uppercase" class="verifyText" name="REGCORPAREA" id="REGCORPAREA" maxlength="50" onkeyup="this.value=runNoSpecial(this.value)" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPAREA']) ;?>" >
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
			<td><?php echo _("TRN"); ?>:</td>
			<td>
				<input type="text" class="verifyText" name="REGTRN" id="REGTRN" maxlength="50" onkeyup="this.value=numOnly(this.value)" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['TRN']) ;?>" >
			</td>

		</tr>
		<tr>
			<td><?php echo _("P O Box"); ?><span style="color:red">*</span>:</td>
			<td>
				<div class="field required">
					<input type="text" class="verifyText" name="REGCORPPOBOX" id="REGCORPPOBOX" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPPOBOX']) ;?>" maxlength="6" onkeyup="this.value=numOnly(this.value)">
					<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
			</td>
			<!-- SMB -->
			<td><?php echo _("Contact Number"); ?><span style="color:red">*</span>:</td>
			<td>
				<div class="field required">
					<input type="text" class="verifyText" name="REGCORPCONTACTNO" id="REGCORPCONTACTNO" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['REGCORPCONTACTNO']) ;?>" onkeyup="this.value=this.value.replace(/\D/g,'');">
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
					<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" id="regFName" name="FIRSTNAME" maxlength="23" onkeyup="this.value=runNoSpecial(this.value)" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['FIRSTNAME']) ;?>">
					<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
			</td>
			<td><?php echo _("Last Name"); ?><span style="color:red">*</span>:</td>
			<td>
				<div class="field required">
					<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" id="regLName" name="LASTNAME" maxlength="23" onkeyup="this.value=runNoSpecial(this.value)" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['LASTNAME']) ;?>">
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
					<input type="text" class="verifyText" name="MERCDISCOUNTRATE" id="MERCDISCOUNTRATE" onkeyup="this.value=numOnly1(this.value)" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['MERCDISCOUNTRATE']) ;?>" >
					<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
			</td>
			<td>
				<div class="field required">
					<input type="text" class="verifyText" name="MERCDISCOUNTRATE2" id="MERCDISCOUNTRATE2" onkeyup="this.value=numOnly1(this.value)" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['MERCDISCOUNTRATE2']) ;?>"  >
					<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
			</td>

			<td style="display:none;"><?php echo _("Acquiring Interchange ( % )"); ?>:</td>
			<td style="display:none;">
				<input type="text" class="verifyText" name="REGCORPFEESTRXN" id="REGCORPFEESTRXN" onkeyup="this.value=numOnly1(this.value)" value="<?php echo ($this->data("response") == 0) ? '0.9' : sanitize_string($_REQUEST['REGCORPFEESTRXN']) ;?>"  >							
			</td>
		</tr>
		<tr>
			<td>
				<select id="CASHTYPE" name="CASHTYPE" style="width:100%;" onchange="changeDiscountRate()">
					<option value="FIXED" selected="selected">Cash Transaction Fee</option>
					<option value="MONTHLY">Cash Monthly Charges</option>
					<option value="PERCENT">Cash Discount Rate (%)</option>
				</select>
			</td>
			<td>
				<!--	<div class="field required">
						<input type="text" class="verifyText" name="CASHDISCOUNTRATE" id="CASHDISCOUNTRATE" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['CASHDISCOUNTRATE']) ;?>" onkeyup="run(this)" >
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div> -->
					<div class="field required">
						<input type="text" class="verifyText" name="CASHDISCOUNTRATE" id="CASHDISCOUNTRATE" value="0" onchange="changeDiscountRate()">
						<span class="iferror"><?php echo _("Field required"); ?></span>
					</div>
				</td>						
				<td style="display:none;"><?php echo _("Cash Transaction Fee"); ?>:</td>
				<td style="display:none;">
					<input type="text" class="verifyText" name="CASHTRANSFEE" id="CASHTRANSFEE" onkeyup="run(this)" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['CASHTRANSFEE']) ;?>"  >							
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
						<!--<input type="text" class="verifyText" name="cardreaderrequested" id="cardreaderrequested" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['cardreaderrequested']) ;?>" onkeyup="run(this)" maxlength="2">-->
						<input type="text" class="verifyText" name="cardreaderrequested" id="cardreaderrequested" value="<?php echo ($this->data("response") == 0) ? '0' : sanitize_string($_REQUEST['cardreaderrequested']) ;?>" onkeyup="this.value=numOnly(this.value)" maxlength="2">
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
				<td></td>
				<td></td>
				<td></td>
				<td></td>
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
				<td><?php echo _("Cashier 1 First Name"); ?><span style="color:red">*</span>:</td>
				<td>
					<div class="field required">
						<input type="text" class="verifyText" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" name="c1fn" id="c1fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1fn']) ;?>"  >
						<span class="iferror"><?php echo _("Field required"); ?></span>
							<!--<div class="field required">
								<input type="text" class="verifyText" name="c1fn" id="c1fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>-->

						</td>
						<td><?php echo _("Cashier 1 Last Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c1ln" id="c1ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1ln']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c1ln" id="c1ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 1 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c1e" id="c1e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c1e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>												
						</td>
					</tr>



					<tr style="display:none;" class="cc1">	
						<td>
							<select id="CASHTYPE1" name="CASHTYPE1" style="width:100%;" onchange="changeDiscountRate(1)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE1" id="CASHDISCOUNTRATE1" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(1)" hidden>
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES1" name="REGCORPPACKAGES1" style="width:100%;" onchange="changeDiscountRate(1)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 1 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE1" name="DEVICETYPE1" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>

					</tr>

					<tr style="display:none;" class="cc2">
						<td><?php echo _("Cashier 2 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c2fn" id="c2fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c2fn" id="c2fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 2 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c2ln" id="c2ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c2ln" id="c2ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 2 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c2e" id="c2e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c2e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc2">
						<td>
							<select id="CASHTYPE2" name="CASHTYPE2" style="width:100%;" onchange="changeDiscountRate(2)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE2" id="CASHDISCOUNTRATE2" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(2)" hidden>
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES2" name="REGCORPPACKAGES2" style="width:100%;" onchange="changeDiscountRate(2)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 2 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE2" name="DEVICETYPE2" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>

					</tr>

					<tr style="display:none;" class="cc3">
						<td><?php echo _("Cashier 3 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c3fn" id="c3fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c3fn" id="c3fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 3 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c3ln" id="c3ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c3ln" id="c3ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 3 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c3e" id="c3e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c3e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc3">

						<td>
							<select id="CASHTYPE3" name="CASHTYPE3" style="width:100%;" onchange="changeDiscountRate(3)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE3" id="CASHDISCOUNTRATE3" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(3)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES3" name="REGCORPPACKAGES3" style="width:100%;" onchange="changeDiscountRate(3)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 3 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE3" name="DEVICETYPE3" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>								
					</tr>

					<tr style="display:none;" class="cc4">
						<td><?php echo _("Cashier 4 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c4fn" id="c4fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c4fn" id="c4fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 4 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c4ln" id="c4ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c4ln" id="c4ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 4 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c4e" id="c4e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c4e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc4">

						<td>
							<select id="CASHTYPE4" name="CASHTYPE4" style="width:100%;" onchange="changeDiscountRate(4)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE4" id="CASHDISCOUNTRATE4" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(4)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES4" name="REGCORPPACKAGES4" style="width:100%;" onchange="changeDiscountRate(4)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 4 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE4" name="DEVICETYPE4" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc5">
						<td><?php echo _("Cashier 5 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c5fn" id="c5fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c5fn" id="c5fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 5 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c5ln" id="c5ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c5ln" id="c5ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 5 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c5e" id="c5e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c5e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc5">

						<td>
							<select id="CASHTYPE5" name="CASHTYPE5" style="width:100%;" onchange="changeDiscountRate(5)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE5" id="CASHDISCOUNTRATE5" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(5)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES5" name="REGCORPPACKAGES5" style="width:100%;" onchange="changeDiscountRate(5)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 5 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE5" name="DEVICETYPE5" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>													
					</tr>

					<tr style="display:none;" class="cc6">
						<td><?php echo _("Cashier 6 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c6fn" id="c6fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c6fn" id="c6fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 6 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c6ln" id="c6ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c6ln" id="c6ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 6 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c6e" id="c6e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c6e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc6">

						<td>
							<select id="CASHTYPE6" name="CASHTYPE6" style="width:100%;" onchange="changeDiscountRate(6)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE6" id="CASHDISCOUNTRATE6" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(6)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES6" name="REGCORPPACKAGES6" style="width:100%;" onchange="changeDiscountRate(6)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 6 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE6" name="DEVICETYPE6" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>													
					</tr>

					<tr style="display:none;" class="cc7">
						<td><?php echo _("Cashier 7 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c7fn" id="c7fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c7fn" id="c7fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 7 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c7ln" id="c7ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c7ln" id="c7ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 7 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c7e" id="c7e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c7e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc7">

						<td>
							<select id="CASHTYPE7" name="CASHTYPE7" style="width:100%;" onchange="changeDiscountRate(7)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE7" id="CASHDISCOUNTRATE7" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(7)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES7" name="REGCORPPACKAGES7" style="width:100%;" onchange="changeDiscountRate(7)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 7 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE7" name="DEVICETYPE7" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>											
					</tr>

					<tr style="display:none;" class="cc8">
						<td><?php echo _("Cashier 8 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">	
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c8fn" id="c8fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c8fn" id="c8fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 8 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c8ln" id="c8ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c8ln" id="c8ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 8 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c8e" id="c8e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c8e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc8">

						<td>
							<select id="CASHTYPE8" name="CASHTYPE8" style="width:100%;" onchange="changeDiscountRate(8)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE8" id="CASHDISCOUNTRATE8" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(8)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES8" name="REGCORPPACKAGES8" style="width:100%;" onchange="changeDiscountRate(8)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 8 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE8" name="DEVICETYPE8" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>									
					</tr>

					<tr style="display:none;" class="cc9">
						<td><?php echo _("Cashier 9 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 9 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 9 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c9e" id="c9e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc9">

						<td>
							<select id="CASHTYPE9" name="CASHTYPE9" style="width:100%;" onchange="changeDiscountRate(9)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE9" id="CASHDISCOUNTRATE9" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(9)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES9" name="REGCORPPACKAGES9" style="width:100%;" onchange="changeDiscountRate(9)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 9 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE9" name="DEVICETYPE9" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc10">
						<td><?php echo _("Cashier 10 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c10fn" id="c10fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9fn" id="c9fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9fn']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 10 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c10ln" id="c10ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						<!--<div class="field required">
							<input type="text" class="verifyText" name="c9ln" id="c9ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c9ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>
						</div>-->
						
					</td>
					<td><?php echo _("Cashier 10 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c10e" id="c10e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c10e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc10">

						<td>
							<select id="CASHTYPE10" name="CASHTYPE10" style="width:100%;" onchange="changeDiscountRate(10)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE10" id="CASHDISCOUNTRATE10" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(10)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES10" name="REGCORPPACKAGES10" style="width:100%;" onchange="changeDiscountRate(10)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 10 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE10" name="DEVICETYPE10" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<!--  ADDITIONAL 5 -->

					<tr style="display:none;" class="cc11">
						<td><?php echo _("Cashier 11 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c11fn" id="c11fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c11fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 11 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c11ln" id="c11ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c11ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 11 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c11e" id="c11e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c11e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc11">

						<td>
							<select id="CASHTYPE11" name="CASHTYPE11" style="width:100%;" onchange="changeDiscountRate(11)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE11" id="CASHDISCOUNTRATE11" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(11)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES11" name="REGCORPPACKAGES11" style="width:100%;" onchange="changeDiscountRate(11)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 11 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE11" name="DEVICETYPE11" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc12">
						<td><?php echo _("Cashier 12 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c12fn" id="c12fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c12fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 12 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c12ln" id="c12ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c12ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 12 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c12e" id="c12e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c12e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc12">

						<td>
							<select id="CASHTYPE12" name="CASHTYPE12" style="width:100%;" onchange="changeDiscountRate(12)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE12" id="CASHDISCOUNTRATE12" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(12)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES12" name="REGCORPPACKAGES12" style="width:100%;" onchange="changeDiscountRate(12)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 12 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE12" name="DEVICETYPE12" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc13">
						<td><?php echo _("Cashier 13 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c13fn" id="c13fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c13fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 13 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c13ln" id="c13ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c13ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 13 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c13e" id="c13e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c13e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc13">

						<td>
							<select id="CASHTYPE13" name="CASHTYPE13" style="width:100%;" onchange="changeDiscountRate(13)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE13" id="CASHDISCOUNTRATE13" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(13)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES13" name="REGCORPPACKAGES13" style="width:100%;" onchange="changeDiscountRate(13)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 13 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE13" name="DEVICETYPE13" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc14">
						<td><?php echo _("Cashier 14 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c14fn" id="c14fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c14fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 14 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c14ln" id="c14ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c14ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 14 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c14e" id="c14e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c14e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc14">

						<td>
							<select id="CASHTYPE14" name="CASHTYPE14" style="width:100%;" onchange="changeDiscountRate(14)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE14" id="CASHDISCOUNTRATE14" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(14)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES14" name="REGCORPPACKAGES14" style="width:100%;" onchange="changeDiscountRate(14)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 14 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE14" name="DEVICETYPE14" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc15">
						<td><?php echo _("Cashier 15 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c15fn" id="c15fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c15fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 15 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c15ln" id="c15ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c15ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 15 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c15e" id="c15e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c15e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc15">

						<td>
							<select id="CASHTYPE15" name="CASHTYPE15" style="width:100%;" onchange="changeDiscountRate(15)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE15" id="CASHDISCOUNTRATE15" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(15)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES15" name="REGCORPPACKAGES15" style="width:100%;" onchange="changeDiscountRate(15)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 15 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE15" name="DEVICETYPE15" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>


					<tr style="display:none;" class="cc16">
						<td><?php echo _("Cashier 16 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c16fn" id="c16fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c16fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 16 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c16ln" id="c16ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c16ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 16 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c16e" id="c16e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c16e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc16">

						<td>
							<select id="CASHTYPE16" name="CASHTYPE16" style="width:100%;" onchange="changeDiscountRate(16)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE16" id="CASHDISCOUNTRATE16" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(16)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES16" name="REGCORPPACKAGES16" style="width:100%;" onchange="changeDiscountRate(16)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 16 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE16" name="DEVICETYPE16" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc17">
						<td><?php echo _("Cashier 17 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c17fn" id="c17fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c17fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 17 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c17ln" id="c17ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c12ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 17 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c17e" id="c17e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c17e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc17">

						<td>
							<select id="CASHTYPE17" name="CASHTYPE17" style="width:100%;" onchange="changeDiscountRate(12)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE17" id="CASHDISCOUNTRATE17" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(12)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES17" name="REGCORPPACKAGES17" style="width:100%;" onchange="changeDiscountRate(17)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 17 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE17" name="DEVICETYPE17" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc18">
						<td><?php echo _("Cashier 18 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c18fn" id="c18fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c18fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 18 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c18ln" id="c18ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c18ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 18 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c18e" id="c18e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c18e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc18">

						<td>
							<select id="CASHTYPE18" name="CASHTYPE18" style="width:100%;" onchange="changeDiscountRate(18)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE18" id="CASHDISCOUNTRATE18" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(18)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES18" name="REGCORPPACKAGES18" style="width:100%;" onchange="changeDiscountRate(18)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 18 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE18" name="DEVICETYPE18" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc19">
						<td><?php echo _("Cashier 19 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c19fn" id="c19fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c19fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 19 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c19ln" id="c19ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c19ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 19 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c19e" id="c14e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c19e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc19">

						<td>
							<select id="CASHTYPE19" name="CASHTYPE19" style="width:100%;" onchange="changeDiscountRate(19)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE19" id="CASHDISCOUNTRATE19" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(19)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES19" name="REGCORPPACKAGES19" style="width:100%;" onchange="changeDiscountRate(19)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 19 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE19" name="DEVICETYPE19" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>

					<tr style="display:none;" class="cc20">
						<td><?php echo _("Cashier 20 First Name"); ?><span style="color:red">*</span>:</td>
						<td>
							<div class="field required">
								<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c20fn" id="c20fn" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c15fn']) ;?>"  >
								<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 20 Last Name"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" style="text-transform: uppercase" onkeyup="this.value=runNoSpecial(this.value)" class="verifyText" name="c20ln" id="c20ln" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c20ln']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	
						
					</td>
					<td><?php echo _("Cashier 20 Email"); ?><span style="color:red">*</span>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="c20e" id="c15e" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['c20e']) ;?>"  >
							<span class="iferror"><?php echo _("Field required"); ?></span>	

						</td>
					</tr>
					<tr style="display:none;" class="cc20">

						<td>
							<select id="CASHTYPE20" name="CASHTYPE20" style="width:100%;" onchange="changeDiscountRate(20)" hidden>
							</select>
						</td>
						<td>
							<div class="field required">
								<input type="text" class="verifyText" name="CASHDISCOUNTRATE20" id="CASHDISCOUNTRATE20" onkeyup="this.value=numOnly(this.value)" value="0" onchange="changeDiscountRate(15)" hidden >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
						<td><!--<?php echo _("Packages"); ?><span style="color:red">*</span>:--></td>
						<td>
							<select id="REGCORPPACKAGES20" name="REGCORPPACKAGES20" style="width:100%;" onchange="changeDiscountRate(20)" hidden>
							</select>
						</td>
						<td><?php echo _("Cashier 20 device"); ?>:</td>
						<td>
							<select id="DEVICETYPE20" name="DEVICETYPE20" style="width:100%;">
								<option value='ANDROID'>Android</option>
								<option value='IOS'>iOS</option>
								<option value='WINDOWS'>Windows</option>
							</select>
						</td>												
					</tr>


					<!-- CASHIER 1 TO 9 END -->	
					<tr>
						<td colspan="6">&nbsp;<button  id="btnTEST" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("TEST"); ?></button></td>
					</tr>
				<!--	<tr>
						<td><button  style="float:left; position:fixed" id="fileclick" type = "button" class="ui-button ui-state-default-eti ui-corner-all" ><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button>   
						<button type = "button" style="float:left; position:fixed" id="fileclicknew1" type = "button" class="ui-button ui-state-default-eti ui-corner-all" hidden><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button> 
						</td>
					</tr>-->
					<tr>
						
						<td colspan="6">
						 		<iframe src="<?php echo $GLOBALS['VIEW_PATH'];?>user.subscriber.register.SMB.uploadfiles.view.php" width="100%" height="500px"></iframe>
						</td>
					</tr>
					<tr>
						<td colspan="6">

							<!--<button  id="btnRegisterPOP" type = "button" class="ui-state-default ui-corner-all ui-button" style="float:left;"><?php echo _("Register"); ?></button>-->
							<button id="btnRegister" class="ui-state-default-eti ui-corner-all ui-button" style="display: none">
								<?php echo _("Register"); ?>
							</button>
							<!-- <input type="text" name="tester" id="tester"> -->
						</td>
					</tr>
				</table>
				<div id="dialogREG" title="<?php echo _("Register Account"); ?>">
					Are you sure you want to submit? 
				</div>

			</form>
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

	function rundec(field) {
		var noSpecialKey = preg_replace( '/[0-9.]/', '', field);
	return noSpecialKey;
	}
	

	function runNoSpecial(field){
		var noSpecialKey = field.replace(/[$&+,:;=?@#|'<>.^*()%!_-`~\\\/{}]/g, '');
		return noSpecialKey;
	}
//[$&+,:;=?@#|'<>.^*()%!-A-Za-z]
function numOnly(field){
	var noSpecialKey = field.replace(/\D/g, '');
	return noSpecialKey;
}

function numOnly1(field){
	var noSpecialKey = field.replace(/[^0-9.]/g, '');
	return noSpecialKey;
}

$("#replaceImage1").click(function(){
			
			$("#preview").html('');
			<?php
			unset($_SESSION['imageB2W']);
			unset($_SESSION['size1']);
			?>
			$(this).hide();
			$("#regImageStat").val("DEL");
			$("#fileclicknew").show();
		});
		
	$("#replaceImage2").click(function(){
			$("#previewnew1").html('');
			<?php
			unset($_SESSION['imagenew1']);
			unset($_SESSION['size2']);
			?>
			$(this).hide();
			$("#fileclicknew1").show();
			$("#regImageStat2").val("DEL");
		});
	$("#replaceImage3").click(function(){
			$("#previewnew2").html('');
			<?php
			unset($_SESSION['imagenew2']);
			unset($_SESSION['size3']);
			?>
			$(this).hide();
			$("#fileclicknew2").show();
			$("#regImageStat3").val("DEL");
		});
		
	$("#replaceImage4").click(function(){
			$("#previewnew3").html('');
			<?php
			unset($_SESSION['imagenew3']);
			unset($_SESSION['size4']);
			?>
			$(this).hide();
			$("#fileclicknew3").show();
			$("#regImageStat4").val("DEL");
		});
		
	$("#replaceImage5").click(function(){
			$("#previewnew4").html('');
			<?php
			unset($_SESSION['imagenew4']);
			unset($_SESSION['size5']);
			?>
			$(this).hide();
			$("#fileclicknew4").show();
			$("#regImageStat5").val("DEL");
		});
	$("#replaceImage6").click(function(){
			$("#previewnew5").html('');
			<?php
			unset($_SESSION['imagenew5']);
			unset($_SESSION['size6']);
			?>
			$(this).hide();
			$("#fileclicknew5").show();
			$("#regImageStat6").val("DEL");
		});
	$("#replaceImage7").click(function(){
			$("#previewnew6").html('');
			<?php
			unset($_SESSION['imagenew6']);
			unset($_SESSION['size7']);
			?>
			$(this).hide();
			$("#fileclicknew6").show();
			$("#regImageStat7").val("DEL");
		});
	$("#replaceImage8").click(function(){
			$("#previewnew7").html('');
			<?php
			unset($_SESSION['imagenew7']);
			unset($_SESSION['size8']);
			?>
			$(this).hide();
			$("#fileclicknew7").show();
			$("#regImageStat8").val("DEL");
		});
	$("#replaceImage9").click(function(){
			$("#previewnew8").html('');
			<?php
			unset($_SESSION['imagenew8']);
			unset($_SESSION['size9']);
			?>
			$(this).hide();
			$("#fileclicknew8").show();
			$("#regImageStat9").val("DEL");
		});
	$("#replaceImage10").click(function(){
			$("#previewnew9").html('');
			<?php
			unset($_SESSION['imagenew9']);
			unset($_SESSION['size10']);
			?>
			$(this).hide();
			$("#regImageStat10").val("DEL");
			$("#fileclicknew9").show();
		});

$("input:radio").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  // alert( $(this).val());
  } else {
    $box.prop("checked", false);
  }
});

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

$('#addFile2').hide();
	$('#photoimg').hide();
	$("#fileclick").click(function () {
		$("#photoimg").trigger('click');
		
		
	});
	
	$("#fileclicknew1").click(function () {
		$("#photoimgnew1").trigger('click');
		
	});
	
	$("#fileclicknew2").click(function () {
		$("#photoimgnew2").trigger('click');
		
	});
	$("#fileclicknew3").click(function () {
		$("#photoimgnew3").trigger('click');
		
	});
	$("#fileclicknew4").click(function () {
		$("#photoimgnew4").trigger('click');

	});
	$("#fileclicknew5").click(function () {
		$("#photoimgnew5").trigger('click');
		
	});
	$("#fileclicknew6").click(function () {
		$("#photoimgnew6").trigger('click');
		
	});
	$("#fileclicknew7").click(function () {
		$("#photoimgnew7").trigger('click');
		
	});
	$("#fileclicknew8").click(function () {
		$("#photoimgnew8").trigger('click');
		
	});
	$("#fileclicknew9").click(function () {
		$("#photoimgnew9").trigger('click');
		
	});
	$("#fileclicknew10").click(function () {
		$("#photoimgnew10").trigger('click');
	});
	
	window.pho = "0";
	$("#photoimg").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew1").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew2").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew3").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew4").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew5").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew6").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew7").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew8").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew9").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew10").click(function () {
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
			$("#replaceImage1").show();
			//$("#fileclick").hide();
			$('#file2div').show();
			$("#fileclicknew1").show();
			$('#regImageStat1').val("REG");
		});
		
		$('#photoimgnew1').on('change', function()			{ 
			$("#previewnew1").html('');
			$("#previewnew1").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew1").ajaxForm({
				target: '#previewnew1'
			}).submit();
			window.pho = "0";
			$("#replaceImage2").show();
			//$("#fileclicknew1").hide();
			$('#file3div').show();
			$("#fileclicknew2").show();
			$('#regImageStat2').val("REG");
		});
		
		$('#photoimgnew2').on('change', function()			{ 
			$("#previewnew2").html('');
			$("#previewnew2").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew2").ajaxForm({
				target: '#previewnew2'
			}).submit();
			window.pho = "0";
			$("#replaceImage3").show();
			//$("#fileclicknew2").hide();
			$('#file4div').show();
			$("#fileclicknew3").show();
			$('#regImageStat3').val("REG");
		});

		$('#photoimgnew3').on('change', function()			{ 
			$("#previewnew3").html('');
			$("#previewnew3").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew3").ajaxForm({
				target: '#previewnew3'
			}).submit();
			window.pho = "0";
			$("#replaceImage4").show();
			//$("#fileclicknew3").hide();
			$('#file5div').show();
			$('#regImageStat4').val("REG");
			$("#fileclicknew4").show();
		});

		$('#photoimgnew4').on('change', function()			{ 
			$("#previewnew4").html('');
			$("#previewnew4").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew4").ajaxForm({
				target: '#previewnew4'
			}).submit();
			window.pho = "0";
			$("#replaceImage5").show();
			//$("#fileclicknew4").hide();
			$('#file6div').show();
			$('#regImageStat5').val("REG");
			$("#fileclicknew5").show();
		});

		$('#photoimgnew5').on('change', function()			{ 
			$("#previewnew5").html('');
			$("#previewnew5").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew5").ajaxForm({
				target: '#previewnew5'
			}).submit();
			window.pho = "0";
			$("#replaceImage6").show();
			//$("#fileclicknew5").hide();
			$('#file7div').show();
			$('#regImageStat6').val("REG");
			$("#fileclicknew6").show();
		});

		$('#photoimgnew6').on('change', function()			{ 
			$("#previewnew6").html('');
			$("#previewnew6").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew6").ajaxForm({
				target: '#previewnew6'
			}).submit();
			window.pho = "0";
			$("#replaceImage7").show();
			//$("#fileclicknew6").hide();
			$('#file8div').show();
			$('#regImageStat7').val("REG");
			$("#fileclicknew7").show();
		});

		$('#photoimgnew7').on('change', function()			{ 
			$("#previewnew7").html('');
			$("#previewnew7").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew7").ajaxForm({
				target: '#previewnew7'
			}).submit();
			window.pho = "0";
			$("#replaceImage8").show();
			//$("#fileclicknew7").hide();
			$('#file9div').show();
			$('#regImageStat8').val("REG");
			$("#fileclicknew8").show();
		});

		$('#photoimgnew8').on('change', function()			{ 
			$("#previewnew8").html('');
			$("#previewnew8").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew8").ajaxForm({
				target: '#previewnew8'
			}).submit();
			window.pho = "0";
			$("#replaceImage9").show();
			//$("#fileclicknew8").hide();
			$('#file10div').show();
			$('#regImageStat9').val("REG");
			$("#fileclicknew9").show();
		});

		$('#photoimgnew9').on('change', function()			{ 
			$("#previewnew9").html('');
			$("#previewnew9").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew9").ajaxForm({
				target: '#previewnew9'
			}).submit();
			window.pho = "0";
			$("#replaceImage10").show();
			//$("#fileclicknew9").hide();
			$('#regImageStat10').val("REG");
		});

		$('#photoimgnew10').on('change', function()			{ 
			$("#previewnew10").html('');
			$("#previewnew10").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew10").ajaxForm({
				target: '#previewnew10'
			}).submit();
			window.pho = "0";
			$("#replaceImage10").show();
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
.preview, .preview2, .preview3, .previewnew1
{
	width:100px;
	border:solid 1px #dedede;
	padding:10px;
}
#preview, #preview2, #preview3, #previewnew1
{
	color:#cc0000;
	font-size:12px
}

</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		var ht = $("#registration_form").css('height');
		ht = ht.replace("px","");
		$("#if",window.parent.document).css('height',parseInt(ht)-300);
		$('#tblCorp').show();
		region();
		
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
	//$("#btnRegister").hide();
}
//ditttooo =================================================
//msisdn validation
//=========================================================

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
			
			var listCount = result.value.length;
			
			listitem += '<option value="'+ result.value[listCount-1].ACCOUNTTYPE +'"' + selected +'>' + result.value[listCount-1].DESCRIPTION + '</option>';
			for(var i = 0; i < result.value.length-1; i++)
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
				corp();
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
		url:service_url,
		type: "POST",
		success:function(result,status){
			var listitem = ""                                
			$('#regStoreType').find('option').remove();
			listitem += '<option value="'+ result.value[result.value.length-1].ACCOUNTTYPE +'"' + selected +'>' + result.value[result.value.length-1].DESCRIPTION + '</option>';
			for(var i = 0; i < result.value.length-1; i++)
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

	//onboardedby();
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
		if(Number($("#cardreaderrequested").val())>20){
			$("#cardreaderrequested").val("");
			$("<p>Please use Batch upload functionality. Create the main account first, then open created account and upload the file with cashier details.</p>").dialog({width: 450,resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}

		var type = $("#regAccountType").val();
		if(type == 'MADM'){
		//SAM
		//checkCashier(2);
		checkCashier(Number($("#cardreaderrequested").val()) + 1);
		loadCashierCashType(Number($("#cardreaderrequested").val()) + 1);
	}else{
		//SAM
		//checkCashier(1);
		checkCashier(Number($("#cardreaderrequested").val()) + 1);
		loadCashierCashType(Number($("#cardreaderrequested").val()) + 1);
	}
});





	var crr = "<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['cardreaderrequested']) + (sanitize_string($_REQUEST['TYPE']) != "MERC" ? 1 : 0);?>";

	checkCashier(crr);
	function checkCashier(n){


		var x = 0;
		var y = 0;

		for(x = 1; x <= n; x++){

			for(y = 1; y <= 20; y++){

				if(n >= (y+1)){

					$('.cc' + y).show();
					$('c' + y + 'fn').required = true;
					$('c' + y + 'ln').required = true;
					$('c' + y + 'e').required = true;
				}else{

					$('.cc' + y).hide();
					$('c' + y + 'fn').required = false;
					$('c' + y + 'ln').required = false;
					$('c' + y + 'e').required = false;

				}

			}	

		}


	}

	loadCashierCashType(crr);
	function loadCashierCashType(n){

		var JSONCashType = { "cashtype" : [
		{
			"value ":"PERCENT", "name":"Cash Discount Rate (%)"
		},
		{
			"value ":"FIXED", "name":"Cash Transaction Fee"
		},
		{
			"value ":"MONTHLY", "name":"Cash Monthly Charges"
		}
		]};

		console.log(JSON.stringify(JSONCashType));
		console.log(n)

		var i = 0;
		var j = 0;

		for(i = 1; i<n; i++) {

			var listitem = "";

			$('#CASHTYPE'+i).find('option').remove();
			$('#CASHTYPE'+i).find('option').remove();

			for(j = 0; j<JSONCashType.cashtype.length; j++){
				listitem += '<option value="'+ JSONCashType.cashtype.value[j] + '>' + JSONCashType.cashtype.name[j] + '</option>';	
			}					

			$('#CASHTYPE'+i).html(listitem);
			$('#CASHTYPE'+i).click();
		}		
		
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
		checkCashier(Number($("#cardreaderrequested").val()) + 1);
		
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
validateMSISDNc("11");
validateMSISDNc("12");
validateMSISDNc("13");
validateMSISDNc("14");
validateMSISDNc("15");
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

function changeDiscountRate(){
	var feeTypeSelected = document.getElementById("CASHTYPE").value;
	
	if (feeTypeSelected == 'PERCENT'){
		document.getElementById('CASHDISCOUNTRATE').disabled = true;
		$('#CASHDISCOUNTRATE').val("33.75");
	}else {
		document.getElementById('CASHDISCOUNTRATE').disabled = false;
		$('#CASHDISCOUNTRATE').val("0");
	}
}
</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
	<?php if(strpos($responseMessage,'successfully') !== false):?>
			/*$(document).ready(function(){
				$("<p><?php echo $responseMessage. '. Do you want to upload cashiers in batch?'?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); $('#dialogUploadMpos').dialog('open'); $("#dialogUploadMpos").load("<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.uploadcashier.iframe.php?AccountType=" + $("#regStoreType").val()); },"Cancel": function() { $(this).dialog("close"); } } });
			});*/
			$("<p>Registration Successful. Your account has been sent for Bank Approval!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
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
							checkCashier(Number($("#cardreaderrequested").val()) + 1);
						}
					}
					
					$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Cancel": function() { $(this).dialog("close"); } } });
				});
			<?php endif;?>
			<?php endif;?>

			$(document).ready(function(){
				$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h1><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "150" /> Just a moment...</h1>' });
				setTimeout(function(){
					setTimeout($.unblockUI, 1000);
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

			function run(field) {
				var qwer = field.replace(/\s/g,'');
				return qwer;
			}


			$("#subsreg").fadeIn(700);	
			
			
		function delAclick() {
			document.getElementById("preview").innerHTML = "";
			$("#x1").hide();
			<?php session_start();?>
			<?php unset($_SESSION['imageB2W']); ?>
			<?php $_SESSION['imageB2W'] = ''; ?>
			/*<?php
				session_start();
				unset($_SESSION['imageB2W']);
			?>*/
			/*$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/ajaximage.php",
			type: 'post',
			headers: {"REQUEST_METHOD": "POST", "Method": "delImageB2W"},
			data:
			{
				Method: 'delImageB2W'
			}, success: console.log(<?php echo $_REQUEST['Method'];?>)
			});*/
		}
		function delBclick() {
  document.getElementById("previewnew1").innerHTML = "";
  $("#x2").hide();
  //<?php $_SESSION['image2']=$_POST[""]; ?>
  <?php unset($_SESSION['imagenew1']); ?>
  console.log(<?php $_SESSION['image2'];?>);
  console.log("delete file B");
		}
		function delCclick() {
  document.getElementById("previewnew2").innerHTML = "";
  $("#x3").hide();
  //<?php $_SESSION['image3']=$_POST[""]; ?>
   <?php unset($_SESSION['imagenew2']); ?>
  console.log(<?php $_SESSION['image3'];?>);
  console.log("delete file C");
		}

	function delDclick() {
	  	document.getElementById("previewnew3").innerHTML = "";
	  	$("#x4").hide();
	   	<?php unset($_SESSION['imagenew3']); ?>
	  	console.log(<?php $_SESSION['image4'];?>);
	  	console.log("delete file D");
	}

function delEclick() {
  	document.getElementById("previewnew4").innerHTML = "";
  	$("#x5").hide();
   	<?php unset($_SESSION['imagenew4']); ?>
  	console.log(<?php $_SESSION['image5'];?>);
  	console.log("delete file E");
}

function delFclick() {
  	document.getElementById("previewnew5").innerHTML = "";
  	$("#x6").hide();
   	<?php unset($_SESSION['imagenew5']); ?>
  	console.log(<?php $_SESSION['image6'];?>);
  	console.log("delete file F");
}

function delGclick() {
  	document.getElementById("previewnew6").innerHTML = "";
  	$("#x7").hide();
   	<?php unset($_SESSION['imagenew6']); ?>
  	console.log(<?php $_SESSION['image7'];?>);
  	console.log("delete file G");
}

function delHclick() {
  	document.getElementById("previewnew7").innerHTML = "";
  	$("#x8").hide();
   	<?php unset($_SESSION['imagenew7']); ?>
  	console.log(<?php $_SESSION['image8'];?>);
  	console.log("delete file H");
}

function delIclick() {
  	document.getElementById("previewnew8").innerHTML = "";
  	$("#x9").hide();
   	<?php unset($_SESSION['imagenew8']); ?>
  	console.log(<?php $_SESSION['image9'];?>);
  	console.log("delete file I");
}

function delJclick() {
  	document.getElementById("previewnew9").innerHTML = "";
  	$("#x10").hide();
   	<?php unset($_SESSION['imagenew9']); ?>
  	console.log(<?php $_SESSION['image10'];?>);
  	console.log("delete file J");
}


		</script>
		<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>