<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>

<div class ="ploading"></div>
<div align="right" id="btnEditPImageForm" style="display:none;float:right;">Image Upload
	<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
		<input type="file" name="photoimg" id="photoimg" accept="application/pdf,image/png, image/gif, image/jpeg"/>
	</form>
	<div id='preview'>
	</div>
</div>
<div id="BankInfoTabHolder" class="BankInfoTabHolder" style="border:0px solid;height:230px;width:1100px;display:none;">
	<div class="panelButtons" style="margin-bottom:10px;">
		<?php if($_SESSION["EditAccount"]){ ?>
		<a href="#" id="btnEditPInfo" class="ui-state-default ui-corner-all ui-button"><?php echo _("Edit"); ?></a>
		<a href="#" id="btnUpdatePInfo" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("Save"); ?></a>
		<a href="#" id="btnCancelPInfo" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("Cancel"); ?></a>

		<a href="#" id="btnEditPImage" class="ui-state-default ui-corner-all ui-button"><?php echo _("Edit Application File"); ?></a>
		<a href="#" id="btnUpdatePImage" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("Save Application File"); ?></a>
		
		<a href="#" id="btnEditVAT" class="ui-state-default ui-corner-all ui-button"><?php echo _("Edit VAT Functionality"); ?></a>
		<a href="#" id="btnUpdateVAT" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("Save VAT Functionality"); ?></a>
		<?php } ?>
		
	</div>
	<div align="left"><a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.download.file.php?msisdn=<?php echo isset($account)?$account->MobileNumber:""; ?>"><?php echo _("Application File"); ?></a></div>
	<div class="bank_info_details" style="border:0px solid red;width:450px;margin-top:5px;margin-right:30px;float:left;">
		<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
			<tr><td><?php echo _("Company Name"); ?>:</td><td><input type="text" id="corpbusinessname" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->businessname ?>"></td></tr>
			<tr>
				<td><?php echo _("Account Type"); ?><span style="color:red">*</span>:</td>
				<td>
					<select id="selectedType" style="width:150px;" disabled="disabled" >
						<option><?php echo $account==null?"":$account->AccountType; ?></option>												  
					</select>
				</td>
			</tr>
			<tr style="display:none;"><td><?php echo _("Type of Business"); ?><span style="color:red">*</span>:</td>
				<td><select id="corptypeofbusiness" style="width:100%;" disabled="disabled"></select></td>
			</tr>
			<tr><td><?php echo _("Receipt Printed Name"); ?><span style="color:red">*</span>:</td><td><input type="text" id="corpreceiptname" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->receiptname ?>"></td></tr>
			<tr><td><?php echo _("On boarded by"); ?><span style="color:red">*</span>:</td>
				<td><select id="corponboardedby" style="width:100%;" disabled="disabled"></select></td>
			</tr>
			<tr>
				<tr style="display:none;"><td><?php echo _("Nature of Business"); ?><span style="color:red">*</span>:</td><td><input type="text" id="corpownershipinfo" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->ownershipinfo ?>"></td></tr>
				<tr>
					<!--<td>&nbsp;</td>-->
				</tr>
				<tr style="display:none;"><td><?php echo _("Building Name"); ?><!--<span style="color:red">*</span>-->:</td><td><input type="text" id="corpbuilding" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->building ?>"></td></tr>
				<tr style="display:none;"><td><?php echo _("Floor"); ?><!--<span style="color:red">*</span>-->:</td><td><input type="text" id="corpfloor" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->floor ?>"></td></tr>
				<tr style="display:none;"><td><?php echo _("Street Name"); ?><!--<span style="color:red">*</span>-->:</td><td><input type="text" id="corpstreet" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->street ?>"></td></tr>
				<tr><td><?php echo _("Area"); ?><span style="color:red">*</span>:</td><td><input type="text" id="corparea" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->area ?>"></td></tr>
				<tr><td><?php echo _("City / Emirate"); ?><span style="color:red">*</span>:</td><td><input type="text" id="corpcity" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->city ?>"></td></tr>
				<tr style="display:none;">
					<td><?php echo _("Country"); ?><span style="color:red">*</span>:</td>
					<td><select id="pCountry" style="width:100%;" disabled="disabled"></select></td>
				</tr>
				<tr>
					<td><?php echo _("P O Box"); ?><span style="color:red">*</span>:</td>
					<td><input type="text" id="corppobox" disabled="disabled" value="<?php echo $account==null?"":$account->CorpInformation->pobox ?>"></td>
				</tr>
				<tr style="display:none;">
					<td><?php echo _("Country"); ?><span style="color:red">*</span>:</td>
					<td><select id="pCountry" style="width:100%;" disabled="disabled"></select></td>
				</tr>
				<tr>
					<td><?php echo _("Contact Number"); ?><span style="color:red">*</span>:</td>
					<td><input type="text" id="corpcontactno" disabled="disabled" value="<?php 
					echo $account->CorpInformation->corpcontactno != null ? $account->CorpInformation->corpcontactno : ($account->CorpInformation->contactno != null ? $account->CorpInformation->contactno : "") ?>">
					</td>
				</tr>
			</table>
		</div>
		<div class="bank_info_details" style="border:0px solid red;width:450px;margin-top:5px;margin-right:10px;float:left;">
			<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
				<tr>
					<td colspan="2">Authorized Person Details</td>
				</tr>
				<tr><td><?php echo _("First Name"); ?><span style="color:red">*</span>:</td><td><input type="text" id="pFName" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->FirstName ?>"></td></tr>
				<tr><td><?php echo _("Last Name"); ?><span style="color:red">*</span>:</td><td><input type="text" id="pLName" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->LastName; ?>"></td></tr>				
				<tr><td><?php echo _("Primary MSISDN"); ?><span style="color:red">*</span>:</td><td><input id="authNumber" type="text" disabled="disabled" value="<?php echo isset($account)?$account->MobileNumber:"" ?>"></td></tr>
				<tr><td><?php echo _("Primary Email"); ?><span style="color:red">*</span>:</td><td><input type="text" id="pEmail" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->EmailAddress ?>"></td></tr>
				<tr style="display:none;"><td><?php echo _("ID Type"); ?><span style="color:red">*</span>:</td>
					<td><select id="pIDDesc" style="width:100%;" disabled="disabled"></select></td>
				</tr>
				<tr style="display:none;"><td><?php echo _("ID No."); ?><span style="color:red">*</span>:</td><td><input type="text" id="pIDNumber" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->ValidID->IDNumber ?>"></td></tr>
				<tr style="display:none;"><td><?php echo _("Date of Issuance"); ?><span style="color:red">*</span>:</td><td><input type="text" id="pIDIssuance" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->ValidID->Issuance ?>" readonly="true"></td></tr>
				<tr style="display:none;"><td><?php echo _("Date of Expiry"); ?><span style="color:red">*</span>:</td><td><input type="text" id="pIDExpiry" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->ValidID->Expiry ?>" readonly="true"></td></tr>
				<tr style="display:none;"><td><?php echo _("Nationality"); ?><span style="color:red">*</span>:</td>
					<td><select id="pNationality" style="width:100%;" disabled="disabled"></select></td></tr>
					<tr style="display:none;"><td><?php echo _("Title / Position"); ?><span style="color:red">*</span>:</td>
						<td><input type="text" id="pProfession" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->EmploymentDetails->Profession ?>"></td>
					</tr>
				</table>
			</div>
			
			
			<div class="bank_info_details" style="border:0px solid red;width:450px;margin-top:5px;margin-right:10px;float:left;">
			<table border="0" id="tblAccountVat" cellspacing="5" class="tablet">
				<tr>
					<td colspan="2">VAT App Setting</td>
				</tr>
				<tr><td><?php echo _("VAT Functionality for App"); ?><span style="color:red">*</span>:</td><td><div class="field required">
						<?php
						if (($account->VatFunctionality)=='1'){
							echo '<input type="radio" name="ISVATUSER" checked value="1" id="yes" disabled /><label for="yes">'; echo _("Enable"); echo'</label>
						<input type="radio" name="ISVATUSER"  value="0" id="no" disabled /><label for="no">'; echo _("Disable"); echo '</label>';
						}else{
							echo '<input type="radio" name="ISVATUSER"  value="1" id="yes" disabled /><label for="yes">'; echo _("Enable"); echo'</label>
						<input type="radio" name="ISVATUSER" checked value="0" id="no" disabled /><label for="no">'; echo _("Disable"); echo '</label>';
						}?>
						
						<input type="text" name="setter"   id="vatsetter" value="<?php echo $account==null?"":$account->VatFunctionality ?> "  hidden />
						
					</div></td></tr>
				
				
				</table>
			</div>

		</div>
		


		<?php if($this->getRolesConfig('ALLOCATE_CASH') == false && $this->getRolesConfig('DEALLOCATE_CASH') == false){echo '<script>$("#dialogAllocate_").remove();</script>';} ?>
<!--
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
-->
<!-- start allocate -->
<script type="text/javascript" >
	$(document).ready(function() { 
		
		$('#photoimg').on('change', function()			{ 
			$("#preview").html('');
			$("#preview").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
				target: '#preview'
			}).submit();

		});
	}); 
</script>
<style>

	body
	{
		font-family:arial;
	}
	.preview
	{
		width:100px;
		border:solid 1px #dedede;
		padding:10px;
	}
	#preview
	{
		color:#cc0000;
		font-size:12px
	}

</style>
<script>
	$('.ui-button').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
		);
	
	$(".ui-button").button();
	$('#dialogAllocate_').click(function(){
		$('#dialogAllocate').dialog('open');
		return false;
	});

	
	searchBusinesstype();
	function searchBusinesstype(){
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
					$('#corptypeofbusiness').find('option').remove();
					for(x in result.value){
						
						var selected = "";
						if(result.value[x].DESCRIPTION == window.businesstype){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#corptypeofbusiness').html(listitem);
					$('#corptypeofbusiness').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		}

		searchOnboardedby();
		function searchOnboardedby(){
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
						$('#corponboardedby').find('option').remove();
						for(x in result.value){

							var selected = "";
							if(result.value[x].DESCRIPTION == window.onboardedby){
								selected = "selected";
							}
							listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';

						}
						$('#corponboardedby').html(listitem);
						$('#corponboardedby').click();
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}
		</script>

		<script>
			var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
			var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";	
		</script>
		<script>
			$(document).ready(function(){
				var ht = $("#BankInfoTabHolder").css('height');
				ht = ht.replace("px","");
				$("#ifsearch",window.parent.document).css('height',parseInt(ht)+450);
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

	//Start
	<?php echo ($this->getRolesConfig('SEARCH_ACCOUNT_&_VIEW')) ? '' : 'var _0xbdb5=["\x72\x65\x6D\x6F\x76\x65","\x23\x73\x65\x61\x72\x63\x68\x41\x63\x63\x6F\x75\x6E\x74\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x73\x65\x61\x72\x63\x68\x41\x63\x63\x6F\x75\x6E\x74\x54\x61\x62"];$(_0xbdb5[1])[_0xbdb5[0]]();$(_0xbdb5[2])[_0xbdb5[0]]();'; ?>
	<?php echo ($this->getRolesConfig('REGISTER_ACCOUNT')) ? '' : 'var _0xbc1d=["\x72\x65\x6D\x6F\x76\x65","\x23\x52\x65\x67\x69\x73\x74\x65\x72\x41\x63\x63\x6F\x75\x6E\x74\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x52\x65\x67\x69\x73\x74\x65\x72\x41\x63\x63\x6F\x75\x6E\x74\x54\x61\x62"];$(_0xbc1d[1])[_0xbc1d[0]]();$(_0xbc1d[2])[_0xbc1d[0]]();'; ?>
	<?php echo ($this->getRolesConfig('GLOBAL_SEARCH_VIEW')) ? '' : 'var _0x621a=["\x72\x65\x6D\x6F\x76\x65","\x23\x47\x6C\x6F\x62\x61\x6C\x53\x65\x61\x72\x63\x68\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x47\x6C\x6F\x62\x61\x6C\x53\x65\x61\x72\x63\x68\x54\x61\x62"];$(_0x621a[1])[_0x621a[0]]();$(_0x621a[2])[_0x621a[0]]();'; ?>
	<?php echo ($this->getRolesConfig('CASH_REVERSAL_REQUEST')) ? '' : 'var _0x578a=["\x72\x65\x6D\x6F\x76\x65","\x23\x52\x65\x76\x65\x72\x73\x61\x6C\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x52\x65\x76\x65\x72\x73\x61\x6C\x54\x61\x62"];$(_0x578a[1])[_0x578a[0]]();$(_0x578a[2])[_0x578a[0]]();'; ?>
	<?php echo ($this->getRolesConfig('ACCOUNT_INFORMATION')) ? '' : 'var _0x59ae=["\x72\x65\x6D\x6F\x76\x65","\x23\x61\x63\x63\x6F\x75\x6E\x74\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x61\x63\x63\x6F\x75\x6E\x74\x54\x61\x62"];$(_0x59ae[1])[_0x59ae[0]]();$(_0x59ae[2])[_0x59ae[0]]();'; ?>
	<?php echo ($this->getRolesConfig('CORPORATE_ACCOUNT_VIEW')) ? '' : 'var _0x63de=["\x72\x65\x6D\x6F\x76\x65","\x23\x63\x6F\x72\x70\x69\x6E\x66\x6F\x4C\x69\x6E\x6B","\x23\x63\x6F\x72\x70\x69\x6E\x66\x6F"];$(_0x63de[1])[_0x63de[0]]();$(_0x63de[2])[_0x63de[0]]();'; ?>
	<?php echo ($this->getRolesConfig('PERSONAL_DETAILS_VIEW')) ? '' : 'var _0x350c=["\x72\x65\x6D\x6F\x76\x65","\x23\x69\x6E\x66\x6F\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x69\x6E\x66\x6F\x54\x61\x62"];$(_0x350c[1])[_0x350c[0]]();$(_0x350c[2])[_0x350c[0]]();'; ?>
	<?php echo ($this->getRolesConfig('STATEMENT_VIEW')) ? '' : 'var _0x51b2=["\x72\x65\x6D\x6F\x76\x65","\x23\x48\x69\x73\x74\x6F\x72\x79\x54\x61\x62\x4C\x69\x6E\x6B","\x23\x48\x69\x73\x74\x6F\x72\x79\x54\x61\x62"];$(_0x51b2[1])[_0x51b2[0]]();$(_0x51b2[2])[_0x51b2[0]]();'; ?>
	<?php echo isset($account)?(strtoupper(trim($account->KYC))=="APPROVED"?'var _0x3de0=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x3de0[1])[_0x3de0[0]]();':($_SESSION['ViewKYC']=="NO")?'var _0x3de0=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x3de0[1])[_0x3de0[0]]();':($account->UserID==$_SESSION["currentUser"])?'var _0x3de0=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x3de0[1])[_0x3de0[0]]();':''):'var _0x3de0=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x3de0[1])[_0x3de0[0]]();' ?>
	<?php echo isset($account)?'':'var _0xcb5a=["\x72\x65\x6D\x6F\x76\x65","\x23\x53\x75\x62\x73\x63\x72\x69\x62\x65\x72\x54\x61\x62"];$(_0xcb5a[1])[_0xcb5a[0]]();' ?>
	<?php echo isset($account)?($this->getRolesConfig('FINANCIAL_SERVICES') ? '' : 'var _0xbfcd=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x61\x6C\x6F\x67\x41\x6C\x6C\x6F\x63\x61\x74\x65\x5F"];$(_0xbfcd[1])[_0xbfcd[0]]();'):'var _0xbfcd=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x61\x6C\x6F\x67\x41\x6C\x6C\x6F\x63\x61\x74\x65\x5F"];$(_0xbfcd[1])[_0xbfcd[0]]();' ?>
	<?php echo ($_SESSION['EditAccount']) ? '' : 'var _0x2be3=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x45\x64\x69\x74\x50\x49\x6E\x66\x6F\x2C\x20\x23\x62\x74\x6E\x55\x70\x64\x61\x74\x65\x50\x49\x6E\x66\x6F\x2C\x20\x23\x62\x74\x6E\x43\x61\x6E\x63\x65\x6C\x50\x49\x6E\x66\x6F"];$(_0x2be3[1])[_0x2be3[0]]();'; ?>
	<?php echo isset($account)?($account->Status=='ACTIVE'?'var _0x255a=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x41\x63\x74\x69\x76\x61\x74\x65"];$(_0x255a[1])[_0x255a[0]]();':($this->getRolesConfig('ACTIVATE_ACCOUNT') ? '' : 'var _0x255a=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x41\x63\x74\x69\x76\x61\x74\x65"];$(_0x255a[1])[_0x255a[0]]();')):'var _0x255a=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x41\x63\x74\x69\x76\x61\x74\x65"];$(_0x255a[1])[_0x255a[0]]();' ?>
	<?php echo isset($account)?($account->Status=='ACTIVE'?($this->getRolesConfig('DEACTIVATE_ACCOUNT') ? '' : 'var _0x555d=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x44\x65\x61\x63\x74\x69\x76\x61\x74\x65"];$(_0x555d[1])[_0x555d[0]]();'):'var _0x555d=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x44\x65\x61\x63\x74\x69\x76\x61\x74\x65"];$(_0x555d[1])[_0x555d[0]]();'):'var _0x555d=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x44\x65\x61\x63\x74\x69\x76\x61\x74\x65"];$(_0x555d[1])[_0x555d[0]]();' ?>
	<?php echo isset($account)?($this->getRolesConfig('RESET_MOBILE_PASSWORD') ? '' : 'var _0x8fea=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x52\x65\x73\x65\x74\x50\x69\x6E"];$(_0x8fea[1])[_0x8fea[0]]();'):'var _0x8fea=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x52\x65\x73\x65\x74\x50\x69\x6E"];$(_0x8fea[1])[_0x8fea[0]]();' ?>
	<?php echo isset($account)?($account->Locked=='true'?'var _0xa156=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x4C\x6F\x63\x6B"];$(_0xa156[1])[_0xa156[0]]();':($this->getRolesConfig('LOCK_ACCOUNT') ? '' : 'var _0xa156=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x4C\x6F\x63\x6B"];$(_0xa156[1])[_0xa156[0]]();')):'var _0xa156=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x4C\x6F\x63\x6B"];$(_0xa156[1])[_0xa156[0]]();' ?>
	<?php echo isset($account)?($account->Locked=='true'?($this->getRolesConfig('UNLOCK_ACCOUNT') ? '' : 'var _0xba7a=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x55\x6E\x6C\x6F\x63\x6B"];$(_0xba7a[1])[_0xba7a[0]]();'):'var _0xba7a=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x55\x6E\x6C\x6F\x63\x6B"];$(_0xba7a[1])[_0xba7a[0]]();'):'var _0xba7a=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x55\x6E\x6C\x6F\x63\x6B"];$(_0xba7a[1])[_0xba7a[0]]();' ?>
	<?php echo isset($account)?(strtoupper(trim($account->KYC))=="APPROVED"?'var _0x4874=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x4874[1])[_0x4874[0]]();':($_SESSION['ViewKYC']=="NO")?'var _0x4874=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x4874[1])[_0x4874[0]]();':($account->UserID==$_SESSION["currentUser"])?'var _0x4874=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x4874[1])[_0x4874[0]]();':''):'var _0x4874=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x76\x4B\x59\x43"];$(_0x4874[1])[_0x4874[0]]();' ?>
	<?php echo ($this->getRolesConfig('ALLOCATE_CASH')) ? '' : 'var _0x29c8=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x41\x6C\x6C\x6F\x63\x61\x74\x65"];$(_0x29c8[1])[_0x29c8[0]]();'; ?>
	<?php echo ($this->getRolesConfig('DEALLOCATE_CASH')) ? '' : 'var _0xa8fd=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x44\x65\x61\x6C\x6C\x6F\x63\x61\x74\x65"];$(_0xa8fd[1])[_0xa8fd[0]]();'; ?>
	<?php echo ($this->getRolesConfig('REGISTER_NICKNAME')) ? '' : 'var _0x7a4e=["\x72\x65\x6D\x6F\x76\x65","\x23\x72\x65\x67\x4E\x69\x63\x6B\x4E\x61\x6D\x65"];$(_0x7a4e[1])[_0x7a4e[0]]();'; ?>
	//End
	
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
						listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'"' + selected +'>' + result.value[i].DESCRIPTION + '</option>';
					}



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
	SearchNationality();
	function SearchNationality(){
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
					$('#pNationality').find('option').remove();
					$('#pCountry').find('option').remove();
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
					$('#pNationality').html(listitem1);
					$('#pNationality').click();
					$('#pCountry').html(listitem2);
					$('#pCountry').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		}
		searchIdDescription();
		function searchIdDescription(){
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
						$('#pIDDesc').find('option').remove();
						for(x in result.value){
							var selected = "";
							if(result.value[x].DESCRIPTION == window.IDDescription){
								selected = "selected";
							}
							listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';

						}
						$('#pIDDesc').html(listitem);
						$('#pIDDesc').click();
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}

			$("#btnEditPImage").click(function(){
				$(this).hide();
				$('#btnUpdatePImage').show();
				$('#btnEditPImageForm').show();
			});
			
			$("input:radio").on('click', function() {
				 
				  var $box = $(this);
				  if ($box.is(":checked")) {
					
					var group = "input:checkbox[name='" + $box.attr("name") + "']";
					
					$(group).prop("checked", false);
					$box.prop("checked", true);
					var vat = $(this).val()
				   $("#vatsetter").val(vat);
				  } else {
					$box.prop("checked", false);
				  }
			});

			$("#btnUpdatePImage").click(function(){
				$(this).hide();
				$('#btnEditPImageForm').hide();
				$('#btnEditPImage').show();
			});

			$("#btnUpdatePImage").click(function(){
				var now = new Date();

				var params = {
					Method:'updateIdIMAGE',
					msisdn:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

				$('.ploading').fadeToggle(300);
				$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
				$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.ploading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							
							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});

			});

			$("#btnEditPInfo").click(function(){
				$('#tblAccount3 tr td input[type=text],select').removeAttr('disabled');
				$(this).hide();
				$('#btnUpdatePInfo').show();
				$('#btnCancelPInfo').show();
				$('#authNumber, #selectedType').attr('disabled','disabled');
				$("input[type=radio]").attr('disabled', false);
			});

			$("#btnUpdatePInfo").click(function(){
				$('#tblAccount3 tr td input[type=text],#tblAccount3 tr td select, #selectedType').attr('disabled','disabled');
				$(this).hide();
				$('#btnCancelPInfo').hide();
				$('#btnEditPInfo').show();
				$("input[type=radio]").attr('disabled', true);
			});

			$("#btnCancelPInfo").click(function(){
				$('#tblAccount3 tr td input[type=text],#tblAccount3 tr td select, #selectedType').attr('disabled','disabled');
				$(this).hide();
				$('#btnUpdatePInfo').hide();
				$('#btnEditPInfo').show();
			});	
			$("#btnUpdatePInfo").click(function(){
				var now = new Date();

				if($('#corpdateofincorporation').val() == ''){			
					$('#corpdateofincorporation').val('2012-08-17');
				}
				
			//alert($("#vatsetter").val());
					
				var params = {
					Method:'updateAccount',
					MSISDN:window.authMobNumber,
					ALIAS:$('#aliasName').val(),
					GENDER:$('#selectedGender').val(),
					LASTNAME:$('#pLName').val(),
					MIDDLENAME:$('#pSName').val(),
					FIRSTNAME:$('#pFName').val(),
					EMAIL:$('#pEmail').val(),
					DOB:$('#pDOB').val(),
					IDNUMBER:$('#pIDNumber').val(),
					IDDESC:$('#pIDDesc').val(),
					EXPIRY:$('#pIDExpiry').val(),
					NATIONALITY:$('#pNationality').val(),
					POB:$('#pPOB').val(),
					CITY:$('#pCity').val(),
					REGION:$('#pRegion').val(),
					COUNTRY:$('#pCountry').val(),
					TYPE:$('#selectedType').val(),
					KYC:$('#subKYC').val(),
					ACCOUNTSTATUS:$('#pAccountStatus').val(),
					REFACCOUNT:$('#pRefAccount').val(),
					USERID:window.CurrentUser,
					BUILDING:$('#pLocation').val(),
					STREET:$('#pStreet').val(),
					COMPANY:$('#pCompany').val(),
					PROFESSION:$('#pProfession').val(),
					LOCKED:$('#pLocked').val(),
					ALTNUMBER:$('#pAltNumber').val(),
					CORPDATEOFINCORPORATION:$('#corpdateofincorporation').val(),
					CORPBUSINESSNAME:$('#corpbusinessname').val(),
					CORPTRADELICENSENUMBER:$('#corptradelicensenumber').val(),
					CORPREGISTEREDADDRESS:$('#corpregistredaddress').val(),
					CORPTYPEOFBUSINESS:$('#corptypeofbusiness').val(),
					CORPOWNERSHIPINFO:$('#corpownershipinfo').val(),
					TINNUMBER:$('#pTinNumber').val(),
					corpbuilding:$('#corpbuilding').val(),
					corpstreet:$('#corpstreet').val(),
					corpcity:$('#corpcity').val(),
					corpfloor:$('#corpfloor').val(),
					corparea:$('#corparea').val(),
					corppobox:$('#corppobox').val(),
					idissuancedate:$('#pIDIssuance').val(),
					corpreceiptname:$('#corpreceiptname').val(),
					corponboardedby:$('#corponboardedby').val(),
					corpcontactno:$('#corpcontactno').val(),
					isvatappuser:$("#vatsetter").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

				$('.ploading').fadeToggle(300);
				$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
				$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.ploading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});

			});	
			
			$("#btnEditVAT").click(function(){
				$(this).hide();
				$('#btnUpdateVAT').show();
				$('#tblAccountVat').attr('disabled',false);
				$("input[type=radio]").attr('disabled', false);
				//$("input[type=radio]").attr('disabled', false);
			});
		</script>
		<script type="text/javascript">   
			<?php if($responseMessage !=null):?>
			$(document).ready(function(){			
				$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			});
		<?php endif;?>	

		$("#BankInfoTabHolder").fadeIn(700);	
	</script>

