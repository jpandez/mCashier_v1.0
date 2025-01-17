<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.loading_cp, .ploading_cp, .rloading_cp, .revloading_cp {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
._d-inline_cp{
	display:inline;
}
._compliance_cp{
	display:none;margin-top:15px;
}
._accountsummary_cp{
	width:100%;font-size:10px;
}
._m-top_cp{
	margin-top:10px;
}
._d-none_cp{
	display:none;
}
._m-bottom_cp{
	margin-bottom:10px;
}
._divKYC_cp{
	border:0px solid gray;
}
._bank_info_details_cp{
	border:0px solid red;width:350px;margin-top:5px;margin-right:30px;float:left;
}
._accounttype_cp{
	width:150px;
}
._bank_info_details2_cp{
	border:0px solid red;width:350px;margin-top:5px;margin-right:10px;float:left;
}
._account_info_details2_cp{
	border:0px solid red;width:370px;margin-top:5px;float:left;
}
._containeruploadfiles_cp{
	border:0px solid #606060;width:100%;margin-top:20px;float:left;margin-bottom:80px;
}
._viewuploadedfiles1_cp{
	border:1px solid #c6c2c2; border-radius:7px; width:49%;margin-top:0px;float:left; margin-right:2%;background-color:#f7f7f7; height:215px; overflow: scroll;  padding:10px;
}
._f-left_cp{
	float:left;
}
._viewuploadedfiles2_cp{
	border:1px solid #c6c2c2; border-radius:7px;width:49%;margin-top:0px;float:left; background-color:#f7f7f7;  height:215px; overflow: scroll; overflow-x: hidden; padding: 10px;
}
._f-right_cp{
	float:right;
}
</style>
<div id="data_loading_cp" class="_d-inline_cp">
	<table width = "100%">
		<tr>
			<td align = "center">
				<img src = "<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" alt = "Loading"/>
			</td>
		</tr>
	</table>
</div>
<div id="compliance_cp" class="_compliance_cp">
	<div id="accountsummary_cp" class="_accountsummary_cp">
		<?php $compliancesubscriber = $this->data("subscriberPendingCompliance"); ?>
		<?php if(isset($compliancesubscriber->ResponseCode)){ ?>
		<?php if(is_array($compliancesubscriber->Value)){?>
		<div class="_m-top_cp"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="forcompliance_cp" width="100%">
			<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("DATE REGISTERED"); ?></th>
					<th><?php echo _("COMPANY"); ?></th>
					<th><?php echo _("MSISDN"); ?></th>
					<th><?php echo _("FIRST NAME"); ?></th>
					<th><?php echo _("LAST NAME"); ?></th>
					<th><?php echo _("ACCOUNT TYPE"); ?></th>																
					<th><?php echo _("STATUS"); ?></th>
					<th><?php echo _("REASON"); ?></th>
					<th><?php echo _("USER ID"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($compliancesubscriber->Value as $t): $ctr++;?>
				<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_cp<?php echo $t->MSISDN; ?>">
					<td><?php echo $t->REGDATE; ?></td>
					<td><?php echo $t->COMPANY; ?></td>
					<td><?php 
					if (($t->ID)==($t->MSISDN)){
						echo ''; 
					} else {
						echo $t->MSISDN;
					}
					?></td>
					<td><?php echo $t->FIRSTNAME; ?></td>
					<td><?php echo $t->LASTNAME; ?></td>
					<td><?php echo $t->TYPE; ?></td>										
					<!--<td><?php echo $t->STATUS; ?></td>-->
					<td>DEACTIVE</td>
					<td><?php echo $t->KYCREASON; ?></td>
					<td><?php echo $t->USERID; ?></td>
					<td>
						<?php if(($t->ID) == ($t->MSISDN)) { ?>
						<!-- <a href="javascript:viewSMBAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a> -->
						<button class="btn btn-sm btn-primary viewaccount-link_cp" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>" data-action="viewSMBAccount">View</button>
						<?php } else { ?>
						<!-- <a href="javascript:viewAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a> -->
						<button class="btn btn-sm btn-primary viewaccount-link_cp" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>" data-action="viewAccount">View</button>
						<?php } ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php } 
	else {
		echo "<h3>". $compliancesubscriber->Message ."</h3>";
	}?>
	<?php } ?>
</div>

<div id="pending_compliance_view_cp" class="_d-none_cp" title="Pending Compliance">
	<div class="panelButtons_cp _m-bottom_cp">
		<div id="divKYC_cp" class="_divKYC_cp">
				<!--<button id="btnApproveKYC" class="buttonx"><?php echo _("approve"); ?></button>
				<button id="btnRejectKYC" class="buttonx"><?php echo _("decline"); ?></button> - 
				<button id="btnSendbackKYC" class="buttonx"><?php echo _("send back"); ?></button>
			-->
			<button id="btnApproveSMBKYC_cp" class="buttonx"><?php echo _("approve"); ?></button>
			<button id="btnRejectSMBKYC_cp" class="buttonx"><?php echo _("decline"); ?></button> 
			
			
				<!--<button id="btnEditPInfo" class="buttonx"><?php echo _("edit"); ?></button>
				<button id="btnUpdatePInfo" class="_d-none_cp" class="buttonx"><?php echo _("save"); ?></button>
				<button id="btnCancelPInfo" class="_d-none_cp" class="buttonx"><?php echo _("cancel"); ?></button>
			-->
			<!-- <div align="right" class="_f-right_cp"><a id="checkID"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("Application File");} ?></a></div> -->
		</div>								
	</div>
	
	<div class="bank_info_details_cp _bank_info_details_cp">
		<table border="0" id="tblAccount3_cp" cellspacing="5" class="tablet">
			<tr><td><?php echo _("Company Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpbusinessname_cp" disabled="disabled" ></td></tr>
			<tr>
				<td><?php echo _("Account Type"); ?>:</td>
				<td>
					<select id="selectedType_cp" class="_accounttype_cp" disabled="disabled">
						
					</select>
				</td>
			</tr>
			<tr class="_d-none_cp"><td><?php echo _("Type of Business"); ?><span class="text-danger">*</span>:</td>
				<td><input type="text" id="corptypeofbusiness_cp" disabled="disabled" ></td>
			</tr>
			<tr><td><?php echo _("On Boarded By"); ?>:</td><td><input type="text" id="corponboardedby_cp" disabled="disabled" ></td></tr>
			<tr><td><?php echo _("Receipt Printed Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpreceiptname_cp" disabled="disabled" ></td></tr>
			<tr class="_d-none_cp"><td><?php echo _("Nature of Business"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpownershipinfo_cp" disabled="disabled" ></td></tr>
			<tr>
				<!--<td>&nbsp;</td>-->
			</tr>
			<tr class="_d-none_cp"><td><?php echo _("Building Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="building_cp" disabled="disabled" ></td></tr>
			<tr class="_d-none_cp"><td><?php echo _("Floor"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="floor_cp" disabled="disabled" ></td></tr>
			<tr class="_d-none_cp"><td><?php echo _("Street Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="street_cp" disabled="disabled" ></td></tr>
			<tr><td><?php echo _("Area"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="area_cp" disabled="disabled" ></td></tr>
			<tr><td><?php echo _("City / Emirate"); ?>:</td><td><input type="text" id="city_cp" disabled="disabled" ></td></tr>
			<tr class="_d-none_cp"><td><?php echo _("Country"); ?> :</td>
				<td><input type="text" id="country_cp" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("P O Box"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pobox_cp" disabled="disabled" ></td></tr>
			</table>
		</div>
		<div class="bank_info_details_cp _bank_info_details2_cp">
			<table border="0" id="tblAccount3_cp" cellspacing="5" class="tablet">
				<tr>
					<td colspan="2">Authorized Person Details</td>
				</tr>
				<tr><td><?php echo _("First Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pFName_cp" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("Last Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pLName_cp" disabled="disabled" ></td></tr>				
				<tr><td><?php echo _("Primary MSISDN"); ?>:</td><td><input id="authNumber_cp" type="text" disabled="disabled" ><input id="authNumber2_cp" type="text" ></td></tr>
				<tr><td><?php echo _("Primary Email"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pEmail_cp" disabled="disabled" ></td></tr>
				<tr class="_d-none_cp"><td><?php echo _("ID Type"); ?><span class="text-danger">*</span> :</td>
					<td><input type="text" id="pIDDesc_cp" disabled="disabled" ></td>
				</tr>
				<tr class="_d-none_cp"><td><?php echo _("ID No."); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDNumber_cp" disabled="disabled" ></td></tr>
				<tr class="_d-none_cp"><td><?php echo _("Date of Issuance"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDIssuance_cp" disabled="disabled" readonly="true"></td></tr>
				<tr class="_d-none_cp"><td><?php echo _("Date of Expiry"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDExpiry_cp" disabled="disabled" readonly="true"></td></tr>
				<tr class="_d-none_cp"><td><?php echo _("Nationality"); ?><span class="text-danger">*</span> :</td>
					<td><input type="text" id="pNationality_cp" disabled="disabled" ></td></tr>
					<tr class="_d-none_cp"><td><?php echo _("Title / Position"); ?><span class="text-danger">*</span>:</td>
						<td><input type="text" id="pProfession_cp" disabled="disabled" ></td>
					</tr>
				</table>
			</div>
			<div class="account_info_details2_cp _account_info_details2_cp">
				<table border="0" cellspacing="5" class="tablet">
					<tr>
						<td colspan="2">Fees</td>
					</tr>
					<tr>
						<td><?php echo _("Merchant Discount Rate Premium (%)"); ?><span class="text-danger">*</span>:</td>
						<td>
							<div class="field required">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESTRXN" id="mercdiscountrate_cp" >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo _("Merchant Discount Rate NonPremium (%)"); ?><span class="text-danger">*</span>:</td>
						<td>
							<div class="field required">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESTRXNNONP" id="mercdiscountratenonp_cp" >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
					</tr>
					<tr>
						<td class="_d-none_cp"><?php echo _("Acquiring Interchange (%)"); ?>:</td>
						<td class="_d-none_cp">
							<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="mcvisafee_cp" >
						</td>					
					</tr>
					<tr>
						<td>
							<select id="CASHTYPE_cp" name="CASHTYPE" class="w-100" disabled="disabled">
								
							</select>
						</td>
						<td>
							<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashdiscountrate_cp" >
						</td>					
					</tr>
					<tr>
						<td class="_d-none_cp"><?php echo _("Cash Transaction Fee"); ?>:</td>
						<td class="_d-none_cp">
							<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashtransfee_cp" >
						</td>					
					</tr>
				</table>
			</div>
			<div class="containeruploadfiles_cp _containeruploadfiles_cp">
				<div class="viewuploadedfiles_cp _viewuploadedfiles1_cp">
					<div class="_f-left_cp">
						<h3>Uploaded Merchant File</h3>
						<div id="listQC_cp"></div>
					</div>	
				</div>
				<div class="viewuploadedfiles_cp _viewuploadedfiles2_cp">
					<div class="_f-left_cp">
						<h3>Uploaded by Bank</h3>
						<div id="listBNK_cp"></div>
					</div>	
				</div>
		</div>


		<div id="dialogSMBApprove_cp" title="<?php echo _("Approve Merchant / Cashier"); ?>">
			<div class="dLock" align="center">
				<table class="text-start tablet">
					<tr>
						<td><?php echo _("Please confirm your registration!"); ?></td>
						<td>
							<button  id="btnApproveSMBSubscriber_cp" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
							<div class="lockloading"></div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div id="dialogSMBDecline_cp" title="<?php echo _("Decline Merchant / Cashier"); ?>">
			<div class="dLock" align="center">
				<table class="text-start tablet">
					<tr>
						<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
						<td>
							<textarea rows="2" cols="30" id="declineSMBdesc_cp" ></textarea>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<button  id="btnDeclineSMBSubscriber_cp" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
							<div class="lockloading"></div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="ploading_cp"></div>

		<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
		<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
		<script type="text/javascript" src="../../Views/js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
		<script nonce="<?php echo $_SESSION['nonce'];?>">

			function run(field) {
				var qwer = field.replace(/\s/g,'');
				return qwer;
			}
			function run2(field) {
				var numonly = field.replace(/\D/g,'');
				return numonly;
			}

			var ht = $("#compliance_cp").css('height');
			ht = ht.replace("px","");
			$("#compliance_cp",window.parent.document).css('height',parseInt(ht)+200);
			$(document).ready(function() {

			$('.viewaccount-link_cp').on('click', function() {
				var id = $(this).data('id');
				var type = $(this).data('type');
				var action = $(this).data('action');
				if (action == "viewSMBAccount"){
					viewSMBAccount(id, type);
				}else if (action == "viewAccount"){
					viewAccount(id, type);
				}
			});

			$('._ctids').on('keyup', function() {
                var i = this.id.split('_')[1];
                this.value = run(this.value);
                validateTID(i);
            });

			$('._smbctids').on('keyup', function() {
                this.value = run2(this.value);
			});

			$('.numonly').on('keyup', function() {
                this.value = this.value.replace(/\D/g, '');
            });

				$(".buttonx").button();

				oTable = $('#forcompliance_cp').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "two_button",
					"aaSorting": [[0, "desc" ]]
				});


				$('#mid').keyup(function() { 
    	//alert($("#selectedType_cp").val());
    	str = $(this).val()
    	str = str.replace(/\s/g,'')
    	$(this).val(str)
    	
    	if($("#selectedType_cp").val()=="MERCHANT"){
    		if(jQuery.trim($("#mid").val())==""){
    			$(".ctids").prop('disabled', true);
    			$("#tid").prop('disabled', true);
    		}else{
    			$(".ctids").prop('disabled', false);
    			$("#tid").prop('disabled', false);
    		}
    	}else{
    		//alert($("#selectedType_cp").val());
    		if(jQuery.trim($("#mid").val())==""){
    			$(".ctids").prop('disabled', true);
    		}else{
    			$(".ctids").prop('disabled', false);
    		}
    	}
    	$("input.cmids").val($("#mid").val());
    });

				$('#tid').keyup(function() { 
					str = $(this).val()
					str = str.replace(/\s/g,'')
					$(this).val(str)
				});
				

				$('#pending_compliance_view_cp').dialog({
					autoOpen: false,
					width: 1200,
					height: 600,
					draggable: true,
					resizable: false,
					modal:true,
					// position:'bottom'
				});
	// Dialog			
	$('#dialogDecline, #dialogSendBack, #dialogApprove').dialog({
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
		// position: 'center',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	//SMB Dialog
	$('#dialogSMBDecline_cp, #dialogSMBSendBack, #dialogSMBApprove_cp').dialog({
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
		// position: 'center',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});

	
});


			function checkMID($accounttype,$mmsisdn, $accid){
				
				$("#mmsisdn").val($mmsisdn);
				$("#mmsisdn").prop('disabled', true);
				$("#mmsisdn2").val('');
				$("#mmsisdn2").prop('disabled', true);
				$("#authNumber2_cp").prop('disabled', true);
				
				if($mmsisdn == $accid){
					$("#mmsisdn").hide();
					$("#mmsisdn2").show();
					$("#authNumber_cp").hide();
					$("#authNumber2_cp").show();
				} else {
					$("#mmsisdn").show();
					$("#mmsisdn2").hide();
					$("#authNumber_cp").show();
					$("#authNumber2_cp").hide();
				}
				
				if($accounttype == "MADM"){
		//$("#tid").prop('disabled', true);
		$("#tid").hide();
		$("#tdtid").hide();
		
	}else{
		//$("#tid").prop('disabled', false);
		$("#tid").show();
		$("#tdtid").show();
	}

	$("input.cmids").val($("#mid").val());

	if(jQuery.trim($("#tid").val())!=""){
		$("#tid").prop('disabled', true);
	}
	if(jQuery.trim($("#mid").val())==""){
		$(".ctids").prop('disabled', true);
	}else{
		$("#mid").prop('disabled', false);
		$(".ctids").prop('disabled', false);
	}
	
	if(jQuery.trim($("#mid").val())=="" && $accounttype != "MADM"){
		$("#tid").prop('disabled', false);
	}
}

function viewAccount(id, AccountType){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',false);

	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType:  'json',
		data: {
			Method: 'pendingAccountView',
			rdoSearchOption: 3,
			txtSearch: id,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.Result.ResponseCode == 0){
				//alert(json.Result.Value.CASHIERS.length);
				$("#pending_compliance_view_cp").dialog('open');
				if(json.Access[0] == false){
					$("#btnEditPInfo").hide();
					$("#btnUpdatePInfo").hide();
					$("#btnCancelPInfo").hide();
				}else{
					$("#btnEditPInfo").show();					
				}
				if(json.Access[1] == false){
					$("#btnApproveKYC").hide();
					$("#btnRejectKYC").hide();
					$("#btnSendbackKYC").hide();
					
					$("#btnApproveSMBKYC_cp").hide();
					$("#btnRejectSMBKYC_cp").hide();
					$("#btnSendbackSMBKYC").hide();
				}else{
					$("#btnApproveKYC").show();
					$("#btnRejectKYC").show();
					$("#btnSendbackKYC").show();
					
					$("#btnApproveSMBKYC_cp").hide();
					$("#btnRejectSMBKYC_cp").hide();
					$("#btnSendbackSMBKYC").hide();
				}
				$("#accountID").val(json.Result.AccountInformation.AccountID);
				var option = "<option>"+json.Result.AccountInformation.AccountType+"</option>";
				option = "<option>"+AccountType+"</option>";
				$("#selectedType_cp").html(option);
				$("#aliasName").val(json.Result.AccountInformation.Alias);
				
				$("#pAccountStatus").val(json.Result.AccountInformation.Status);
				
				var stringaccounttype = json.Result.AccountInformation.AccountType;
				if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.terminalid!="" && json.Result.AccountInformation.merchantid!=""){
					$("#tid").val(json.Result.AccountInformation.terminalid);
					$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',true);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.merchantid!=""){
					$("#tid").val(json.Result.AccountInformation.terminalid);
					$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',true);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else{
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val("");
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
				}
				var locked = json.Result.AccountInformation.Locked == "true" ? "YES" : "NO";
				$("#pLocked").val(locked);
				$("#subKYC").val(json.Result.AccountInformation.KYC);
				$("#pRefAccount").val(json.Result.AccountInformation.ReferenceAccount);
				
				$("#corponboardedby_cp").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname_cp").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname_cp").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness_cp").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo_cp").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building_cp").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street_cp").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city_cp").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor_cp").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area_cp").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox_cp").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country_cp").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName_cp").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName_cp").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber_cp").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail_cp").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality_cp").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession_cp").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				
				$("#mercdiscountrate_cp").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp_cp").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee_cp").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate_cp").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee_cp").val(json.Result.AccountInformation.cashtransfee);
				
				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE_cp').html(listitem);
					$('#CASHTYPE_cp').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE_cp').html(listitem);
					$('#CASHTYPE_cp').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE_cp').html(listitem);
					$('#CASHTYPE_cp').click();
				}
				$("tr#add_data").remove();

				if(json.Result.Value.CASHIERS.length > 0){
					//alert(json.Result.Value.CASHIERS[0].msisdn);
					//$("tr#add_data").remove();
					for(var i =0;i < json.Result.Value.CASHIERS.length;i++){
						
						$("#tblAccount").append("<tr id='add_data'><td>Merchant ID<span class='text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class='text-danger'>*</span>:</td><td><input class='cids' id='cid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].msisdn + "></td><td>Terminal ID<span class='text-danger'>*</span>:</td><td><input maxlength='8' minlength='8' class='ctids _ctids' id='ctid_" + i + "' type='text' disabled='disabled'></td></tr>");
						$("#cmid_" + i).attr('disabled',true);
						$("#cid_" + i).attr('disabled',true);
						$("#ctid_" + i).attr('disabled',false);
						$("#ctid_" + i).val("");
						$(".account_info_details").css('width','820px');
					}
					$("#mid").val(json.Result.MerchantID);
					 //alert(json.Result.TerminalID);
					 $("#tid").val(json.Result.TerminalID);
					}
					checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber, json.Result.AccountInformation.AccountID);
				//checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber);
				$("#pTIN").val(json.Result.AccountInformation.PersonalInformation.TINNumber);
				$("#checkID").attr("href", download_url + $("#authNumber_cp").val());
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}
var accType;
var cashierLength;
function viewSMBAccount(id, AccountType){
	$('#listBNK_cp').append('');
	$('#listQC_cp').append('');
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);

	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType:  'json',
		data: {
			Method: 'pendingSMBAccountView',
			rdoSearchOption: 3,
			txtSearch: id,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.Result.ResponseCode == 0){
				//alert(json.Result.Value.CASHIERS.length);
				$("#pending_compliance_view_cp").dialog('open');
				//$("#pending_compliance_view_cp").dialog('close');
				//$("#pending_smb_acccount_view").dialog('open');
				
				if(json.Access[0] == false){
					$("#btnEditPInfo").hide();
					$("#btnUpdatePInfo").hide();
					$("#btnCancelPInfo").hide();
				}else{
					$("#btnEditPInfo").hide();					
				}
				if(json.Access[1] == false){
					$("#btnApproveKYC").hide();
					$("#btnRejectKYC").hide();
					$("#btnSendbackKYC").hide();
					
					$("#btnApproveSMBKYC_cp").show();
					$("#btnRejectSMBKYC_cp").show();
					$("#btnSendbackSMBKYCKYC").hide();
				}else{
					/*$("#btnApproveKYC").show();
					$("#btnRejectKYC").show();
					$("#btnSendbackKYC").show();*/
					$("#btnApproveKYC").hide();
					$("#btnRejectKYC").hide();
					$("#btnSendbackKYC").hide();
					
					$("#btnApproveSMBKYC_cp").show();
					$("#btnRejectSMBKYC_cp").show();
					$("#btnSendbackSMBKYC").show();
				}
				$("#accountID").val(json.Result.AccountInformation.AccountID);
				var option = "<option>"+json.Result.AccountInformation.AccountType+"</option>";
				option = "<option>"+AccountType+"</option>";
				accType = AccountType;
				$("#selectedType_cp").html(option);
				$("#aliasName").val(json.Result.AccountInformation.Alias);
				
				$("#pAccountStatus").val(json.Result.AccountInformation.Status);
				
				var stringaccounttype = json.Result.AccountInformation.AccountType;
				if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.terminalid!="" && json.Result.AccountInformation.merchantid!=""){
					//$("#tid").val(json.Result.AccountInformation.terminalid);
					//$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.merchantid!=""){
					//$("#tid").val(json.Result.AccountInformation.terminalid);
					//$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',true);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else{
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val("");
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
				}
				var locked = json.Result.AccountInformation.Locked == "true" ? "YES" : "NO";
				$("#pLocked").val(locked);
				$("#subKYC").val(json.Result.AccountInformation.KYC);
				$("#pRefAccount").val(json.Result.AccountInformation.ReferenceAccount);
				
				$("#corponboardedby_cp").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname_cp").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname_cp").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness_cp").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo_cp").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building_cp").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street_cp").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city_cp").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor_cp").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area_cp").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox_cp").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country_cp").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName_cp").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName_cp").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber_cp").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail_cp").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry_cp").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality_cp").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession_cp").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				
				$("#mercdiscountrate_cp").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp_cp").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee_cp").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate_cp").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee_cp").val(json.Result.AccountInformation.cashtransfee);
				var upcountFGH=$('#listBNK_cp').html("");
				var upcountFGH=$('#listQC_cp').html("");

				for(var i =0;i < json.Result.QCfileCount;i++){
						
						$('#listQC_cp').append('<div align="right" class="_f-right_cp"><a id="QcheckID'+(i+1)+'">'+'<?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _(" View Application File " );}?>'+(i+1)+'</a></div><br><br>');
					}

				for(var i =0;i < json.Result.BNKfileCount;i++){
						
						$('#listBNK_cp').append('<div align="right" class="_f-right_cp"><a id="BcheckID'+(i+1)+'">'+'<?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _(" View Application File " );}?>'+(i+1)+'</a></div><br><br>');
				}


				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE_cp').html(listitem);
					$('#CASHTYPE_cp').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE_cp').html(listitem);
					$('#CASHTYPE_cp').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE_cp').html(listitem);
					$('#CASHTYPE_cp').click();
				}
				$("tr#add_data").remove();
				cashierLength = json.Result.Value.CASHIERS.length;
				if(json.Result.Value.CASHIERS.length > 0){
					//alert(json.Result.Value.CASHIERS[0].msisdn);
					//$("tr#add_data").remove();
					
					/*var cashierMSISDN = '';
					if (json.Result.AccountInformation.AccountID == json.Result.AccountInformation.MobileNumber){
						cashierMSISDN = ' ';
					} else {
						cashierMSISDN = json.Result.Value.CASHIERS[i].msisdn;
					}*/
					
					for(var i =0;i < json.Result.Value.CASHIERS.length;i++){
						
						$("#tblAccount").append("<tr id='add_data'><td>Merchant ID<span class='text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class='text-danger'>*</span>:</td><td><input class='cids' id='cid_" + i + "' type='text' value = "+ json.Result.Value.CASHIERS[i].msisdn +"><input id ='ciddisplay' type='text' value='' disabled='disabled'></td><td>Terminal ID<span class='text-danger'>*</span>:</td><td><input maxlength='8' minlength='8' onkeyup='this.value=run2(this.value)' class='ctids' id='ctid_" + i + "' type='text' disabled='disabled'></td></tr>");
						
						$(".cids").hide();
						$("#cmid_" + i).attr('disabled',true);
						$("#cid_" + i).attr('disabled',true);
						$("#ctid_" + i).attr('disabled',true);
						$("#ctid_" + i).val("");
						$(".account_info_details").css('width','820px');
					}
					 //$("#mid").val(json.Result.MerchantID);
					 //alert(json.Result.TerminalID);
					 //$("#tid").val(json.Result.TerminalID);
					}
					
					checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber, json.Result.AccountInformation.AccountID);
					
				//checkMID(json.Result.AccountInformation.AccountType, '');
				//checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber);
				$("#pTIN").val(json.Result.AccountInformation.PersonalInformation.TINNumber);
				$("#checkID").attr("href", download_url + $("#authNumber_cp").val());

				$("#QcheckID1").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"1"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID2").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"2"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID3").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"3"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID4").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"4"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID5").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"5"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID6").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"6"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID7").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"7"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID8").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"8"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID9").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"9"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#QcheckID10").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"10"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");

				$("#BcheckID1").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"1"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID2").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"2"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID3").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"3"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID4").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"4"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID5").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"5"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID6").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"6"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID7").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"7"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID8").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"8"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID9").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"9"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");
				$("#BcheckID10").attr("href", download_url + "msisdn=" + $("#authNumber_cp").val() + "&" + "smbBoolean=" + true+"&"+"image="+"10"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"BANK");

			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}

var download_url = "<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.download.file.php?";

$('#btnApproveSMBKYC_cp').click(function(){
	var isNull = "false";
	var isZero = 0;
	//var CTIDs = [];
	$(".ctids").each(function(){
		if($(this).val() == ""){
			isNull = "true";
		}
		//CTIDs.push($(this).val());
	});
	//alert(CTIDs.length);
	//alert(CTIDs);
	//CTIDs.push($(this).val());

	//|| $("#tid").val() == "" || isNull == "true"
	var CTIDs = [];
	$(".ctids").each(function(){
		CTIDs.push($(this).val());
	});
	$('#dialogSMBApprove_cp').dialog('open');

	/*if(accType == "MERCHANT ADMIN"){
		if($("#mid").val() == "" || $(".cids").val() == "" || isNull == "true"){
			$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		} else {

			var i = 0;
			var cnt = 0;
			var ccnt = 0;

			while (i < cashierLength) {
				if(CTIDs[i - 1] == CTIDs[i]){
					cnt++;
				}
				if(CTIDs[0] == CTIDs[i]){
					cnt++;
				}
				if($("#tid").val() == CTIDs[i]){
					cnt++;
				}
				if($("#mid").val() == "0" ||  CTIDs[i] == "0" || $("#tid").val() == "0"){	
					isZero++;
				}
				i++;
			}

			if(isZero > 0){
				$("<p>Merchant/Terminal ID field cannot be zero (0).</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else if(cnt > 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else{
				$('#dialogSMBApprove_cp').dialog('open');				
			}

			if(ccnt == 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}
	} else {
		if($("#mid").val() == "" || $(".cids").val() == "" || $("#tid").val() == "" || isNull == "true"){
			$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		} else {

			var i = 0;
			var cnt = 0;
			var ccnt = 0;

			while (i < cashierLength) {
				if(CTIDs[i - 1] == CTIDs[i]){
					cnt++;
				}
				if(CTIDs[0] == CTIDs[i]){
					cnt++;
				}
				if($("#mid").val() == "0" ||  CTIDs[i] == "0" || $("#tid").val() == "0"){	
					isZero++;
				}
				i++;
			}

			if(isZero > 0){
				$("<p>Merchant/Terminal ID field cannot be zero (0).</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else if(cnt > 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else{
				$('#dialogSMBApprove_cp').dialog('open');				
			}
			
			if(ccnt == 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}
	}*/

	return false;
});

$("#btnApproveSMBSubscriber_cp").click(function(){
	$('#btnApproveSMBSubscriber_cp').prop("disabled", true);
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveSMBKYCcompliance',
				MSISDN: $("#authNumber_cp").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#pending_compliance_view_cp").dialog('close');
					$('#dialogSMBApprove_cp').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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
	$('#btnApproveSMBSubscriber_cp').prop("disabled", false);
});

$('#btnRejectSMBKYC_cp').click(function(){
	$('#dialogSMBDecline_cp').dialog('open');
	return false;
});

$("#btnDeclineSMBSubscriber_cp").click(function(){
	var CIDs = [];
	var CTIDs = [];

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});


	if(CIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectSMBKYCCashier',
				MSISDN: $("#authNumber_cp").val(),
				cashierids: CIDs,
				reason: $("#declineSMBdesc_cp").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogSMBDecline_cp").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectSMBKYC',
				MSISDN: $("#authNumber_cp").val(),
				reason: $("#declineSMBdesc_cp").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogSMBDecline_cp").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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


$('#btnApproveKYC').click(function(){
	var isNull = "false";
	//var CTIDs = [];
	$(".ctids").each(function(){
		if($(this).val() == ""){
			isNull = "true";
		}
		//CTIDs.push($(this).val());
	});
	//alert(CTIDs.length);
	//alert(CTIDs);
	//CTIDs.push($(this).val());

	//|| $("#tid").val() == "" || isNull == "true"
	if($("#mid").val() == ""){
		$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		$('#dialogApprove').dialog('open');
	}
	return false;
});
$("#btnApproveSubscriber").click(function(){
	$('#btnApproveSubscriber').prop("disabled", true);
	var CIDs = [];
	var CTIDs = [];

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});

	$(".ctids").each(function(){
		CTIDs.push($(this).val());
	});
	//alert(CTIDs);
	if($("#mid").val() == ""){
		$("<p>Merchant ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else if(CTIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveKYCCashier',
				MSISDN: $("#authNumber_cp").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				cashierids: CIDs,
				cashiertids: CTIDs,
				serialnumber: 0,
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$('#dialogApprove').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveKYC',
				MSISDN: $("#authNumber_cp").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				serialnumber: 0,
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$('#dialogApprove').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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
	$('#btnApproveSubscriber').prop("disabled", false);
});

$('#btnRejectKYC').click(function(){
	$('#dialogDecline').dialog('open');
	return false;
});
$("#btnDeclineSubscriber").click(function(){
	var CIDs = [];
	var CTIDs = [];

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});


	if(CIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectKYCCashier',
				MSISDN: $("#authNumber_cp").val(),
				cashierids: CIDs,
				reason: $("#declinedesc").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogDecline").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectKYC',
				MSISDN: $("#authNumber_cp").val(),
				reason: $("#declinedesc").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_cp" + $("#authNumber_cp").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogDecline").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
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
$("#btnEditPInfo").click(function(){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'inline'});
	$("#btnEditPInfo").css({display:'none'});
	//$(".personalInfoDetails").attr('disabled',false);
	$("#mid").attr('disabled', true);
	$("#tid").attr('disabled', true);
	$("#mmsisdn").attr('disabled', true);
	$("#corponboardedby_cp").attr('disabled', true);
	$("#selectedType_cp").attr('disabled', true);
	$("#coutnry").attr('disabled', true);
	$("#city_cp").attr('disabled', true);
	
	$("#corpbusinessname_cp").attr('disabled', false);
	$("#corpreceiptname_cp").attr('disabled', false);
	$("#area_cp").attr('disabled', false);
	$("#pobox_cp").attr('disabled', false);
	$("#pFName_cp").attr('disabled', false);
	$("#pLName_cp").attr('disabled', false);
	$("#pEmail_cp").attr('disabled', false);
	//$("<p>Edit Button</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
});

$("#btnCancelPInfo").click(function(){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);
	
});

$("#btnUpdatePInfo").click(function(){
	if($("#pLName_cp").val() == "" || $("#pFName_cp").val() == "" ||  $("#pCity").val() == "" ){
		$("<p>All fields with * are required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		if($('#corpdateofincorporation').val() == ''){$('#corpdateofincorporation').val('2012-08-17');}
		var params = {
			Method:'updateSMBAccount',
			MSISDN:$("#authNumber_cp").val(),
			LASTNAME:$('#pLName_cp').val(),
			FIRSTNAME:$('#pFName_cp').val(),
			EMAIL:$('#pEmail_cp').val(),
			AREA:$('#area_cp').val(),
			CITY:$('#city_cp').val(),
			POBOX:$('#pobox_cp').val(),
			CORPBUSINESSNAME:$('#corpbusinessname_cp').val(),
			CORPRECEIPTNAME:$('#corpreceiptname_cp').val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};		
		$('.ploading_cp').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:"POST", 
			//data:params,
			data:{
				Method:'updateSMBAccount',
				MSISDN:$("#authNumber_cp").val(),
				LASTNAME:$('#pLName_cp').val(),
				FIRSTNAME:$('#pFName_cp').val(),
				EMAIL:$('#pEmail_cp').val(),
				AREA:$('#area_cp').val(),
				CITY:$('#city_cp').val(),
				POBOX:$('#pobox_cp').val(),
				CORPBUSINESSNAME:$('#corpbusinessname_cp').val(),
				CORPRECEIPTNAME:$('#corpreceiptname_cp').val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},
			complete:function(res,status){
				viewSMBAccount($("#mmsisdn").val());
				$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
				$("#btnEditPInfo").css({display:'inline'});
				$('.ploading_cp').fadeToggle(300,'linear',function(){
					$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			
		});
	}
});
$("#data_loading_cp").css('display','none');
$("#compliance_cp").fadeIn(700);

</script>