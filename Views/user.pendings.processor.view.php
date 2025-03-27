<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
	.loading_pr, .ploading_pr, .rloading_pr, .revloading_pr {
		height:25px;
		width:81px;
		float:right;
		background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
		display:none;
	}
	._d-inline_pr{
		display:inline;
	}
	._pendingprocessorapproval_pr{
		display:none;margin-top:15px;
	}
	._accountforprocessorsummary_pr{
		width:100%;font-size:10px;
	}
	._m-top_pr{
		margin-top:10px;
	}
	._d-none_pr{
		display:none;
	}
	._panelButtons_pr{
		margin-bottom:10px;	
	}
	._divKYC_pr{
		border:0px solid gray;
	}
	._f-right_pr{
		float:right;
	}
	._accountInfoTabHolder_pr{
		border:0px solid;
	}
	._account_info_details_pr{
		border:2px solid red; margin-top:10px;margin-right:600px;float:left;
	}
	._bank_info_details_pr{
		border:0px solid red;width:350px;margin-top:5px;margin-right:30px;float:left;
	}
	._accounttype_pr{
		width:150px;
	}
	._bank_info_details2_pr{
		border:0px solid red;width:350px;margin-top:5px;margin-right:10px;float:left;
	}
	._account_info_details2_pr{
		border:0px solid red;width:370px;margin-top:5px;float:left;
	}
</style>
<div id="data_loading_pr" class="_d-inline_pr">
	<table width = "100%">
		<tr>
			<td align = "center">
				<img src = "<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" alt = "Loading"/>
			</td>
		</tr>
	</table>
</div>
<div id="pendingprocessorapproval_pr" class="_pendingprocessorapproval_pr">
	<div id="accountforprocessorsummary_pr" class="_accountforprocessorsummary_pr">
		<?php $processorapprovesubscriber = $this->data("subscriberForProcessor"); ?>
		<?php if(isset($processorapprovesubscriber->ResponseCode)){ ?>
		<?php if(is_array($processorapprovesubscriber->Value)){?>
		<div class="_m-top_pr"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="accountforprocessor" width="100%">
			<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("DATE REGISTERED"); ?></th>
					<th><?php echo _("COMPANY"); ?></th>
					<th><?php echo _("MSISDN"); ?></th>
					<th><?php echo _("FIRST NAME"); ?></th>
					<th><?php echo _("LAST NAME"); ?></th>
					<th><?php echo _("ACCOUNT TYPE"); ?></th>																
					<th><?php echo _("STATUS"); ?></th>
					<th><?php echo _("USER ID"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($processorapprovesubscriber->Value as $t): $ctr++;?>
				<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="processorPending_<?php echo $t->MSISDN; ?>">
					<td><?php echo $t->REGDATE; ?></td>
					<td><?php echo $t->COMPANY; ?></td>
					<td>
						<?php 
						if (($t->ID)==($t->MSISDN)){
							echo ''; 
						} else {
							echo $t->MSISDN;
						}
						?>
					</td>
					<td><?php echo $t->FIRSTNAME; ?></td>
					<td><?php echo $t->LASTNAME; ?></td>
					<td><?php echo $t->TYPE; ?></td>										
					<td><?php echo $t->STATUS; ?></td>
					<td><?php echo $t->USERID; ?></td>
					<td><?php if(($t->ID) == ($t->MSISDN)) { ?>
						<!-- <a href="javascript:viewSMBAccountforProcessor('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a> -->
						<button class="btn btn-sm btn-primary viewaccount-link_pr" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>" data-action="viewSMBAccountforProcessor">View</button>
						<?php } else { ?>
						<!-- <a href="javascript:viewAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a> -->
						<button class="btn btn-sm btn-primary viewaccount-link_pr" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>" data-action="viewAccount">View</button>
						<?php } ?>
					</td>
					<!-- <td><a href="javascript:viewSMBAccountforProcessor('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a></td> -->
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php } 
	else {
		echo "<h3>". $processorapprovesubscriber->Message ."</h3>";
	}?>
	<?php } ?>
</div>

<div id="pending_processor_view_pr" class="_d-none_pr" title="Pending Approval PROCESSOR">
	<div class="panelButtons_pr _panelButtons_pr">
		<div id="divKYC_pr" class="_divKYC_pr">
			
			<button id="btnApproveKYC_pr" class="buttonx"><?php echo _("approve"); ?></button>
			
			<button id="btnProcessorApprove_pr" class="buttonx"><?php echo _("approve"); ?></button>
			
				<!--<button id="btnEditPInfo" class="buttonx"><?php echo _("edit"); ?></button>
				<button id="btnUpdatePInfo" class="_d-none_pr" class="buttonx"><?php echo _("save"); ?></button>
				<button id="btnCancelPInfo" class="_d-none_pr" class="buttonx"><?php echo _("cancel"); ?></button>-->
				<div align="right" class="_f-right_pr"><a id="checkID_pr"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("Application File");} ?></a></div>
			</div>								
		</div>
		<div class="accountInfoTabHolder_pr _accountInfoTabHolder_pr">		
			<div class="account_info_details_pr _account_info_details_pr">
				<table border="1" id="tblAccount_pr" cellspacing="5" class="tablet">
					<tr>
						<td><?php echo _("Merchant ID"); ?><span class="text-danger">*</span>:</td><td><input id="mid_pr" type="text" ></td>
						<td><?php echo _("Merchant MSISDN"); ?><span class="text-danger">*</span>:</td>
						<td>
							<div class="field required">
								<input id="mmsisdn_pr" type="text" class="numonly">
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
							<!-- <td><?php echo _("TID Validity"); ?>:</td>
							<td>
								<div class="field required">
									<input type="text" class="verifyText" name="msisdnValidity" id="msisdnValidity" disabled="disabled" ></td>
								</div>
							</td> -->
						</td>
						<td id="tdtid_pr"><?php echo _("Terminal ID"); ?><span class="text-danger">*</span>:</td><td><input id="tid_pr" type="text" disabled="disabled">
						<td id="tlcid_pr"><?php echo _("TLC ID"); ?><span class='text-danger'>*</span>:</td><td><input class='tlcids' id ='tlcID_pr' type='text' disabled='disabled'></td>
					</td>
				</tr>
				<tr>
					<td></td><td></td>
					<td><?php echo _("MSISDN Validity"); ?>:</td>
					<td>
						<div class="field required">
							<input type="text" class="verifyText" name="msisdnValidity" id="msisdnValidity_pr" disabled="disabled" >
						</div>
					</td>
				</tr>

			</table>
		</div>
	</div>


	<div class="bank_info_details_pr _bank_info_details_pr">
		<table border="0" id="tblAccount3_pr" cellspacing="5" class="tablet">
			<tr><td><?php echo _("Company Name"); ?>:</td><td><input type="text" id="corpbusinessname_pr" disabled="disabled" ></td></tr>
			<tr>
				<td><?php echo _("Account Type"); ?><span class="text-danger">*</span>:</td>
				<td>
					<select id="selectedType_pr" class="_accounttype_pr" disabled="disabled">

					</select>
				</td>
			</tr>
			<tr class="_d-none_pr"><td><?php echo _("Type of Business"); ?><span class="text-danger">*</span>:</td>
				<td><input type="text" id="corptypeofbusiness_pr" disabled="disabled" ></td>
			</tr>
			<tr><td><?php echo _("On Boarded By"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corponboardedby_pr" disabled="disabled" ></td></tr>
			<tr><td><?php echo _("Receipt Printed Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpreceiptname_pr" disabled="disabled" ></td></tr>
			<tr class="_d-none_pr"><td><?php echo _("Nature of Business"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpownershipinfo_pr" disabled="disabled" ></td></tr>
			<tr>
				<!--<td>&nbsp;</td>-->
			</tr>
			<tr class="_d-none_pr"><td><?php echo _("Building Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="building_pr" disabled="disabled" ></td></tr>
			<tr class="_d-none_pr"><td><?php echo _("Floor"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="floor_pr" disabled="disabled" ></td></tr>
			<tr class="_d-none_pr"><td><?php echo _("Street Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="street_pr" disabled="disabled" ></td></tr>
			<tr><td><?php echo _("Area"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="area_pr" disabled="disabled" ></td></tr>
			<tr><td><?php echo _("City / Emirate"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="city_pr" disabled="disabled" ></td></tr>
			<tr class="_d-none_pr"><td><?php echo _("Country"); ?><span class="text-danger">*</span> :</td>
				<td><input type="text" id="country_pr" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("P O Box"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pobox_pr" disabled="disabled" ></td></tr>
			</table>
		</div>
		<div class="bank_info_details_pr _bank_info_details2_pr">
			<table border="0" id="tblAccount3_pr" cellspacing="5" class="tablet">
				<tr>
					<td colspan="2">Authorized Person Details</td>
				</tr>
				<tr><td><?php echo _("First Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pFName_pr" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("Last Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pLName_pr" disabled="disabled" ></td></tr>				
				<tr><td><?php echo _("Primary MSISDN"); ?><span class="text-danger">*</span>:</td><td><input id="authNumber_pr" type="text" disabled="disabled" ><input id="authNumber2_pr" type="text" ></td></tr>
				<tr><td><?php echo _("Primary Email"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pEmail_pr" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("TRN"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pTRN_pr" disabled="disabled" ></td></tr>
				<tr class="_d-none_pr"><td><?php echo _("ID Type"); ?><span class="text-danger">*</span> :</td>
					<td><input type="text" id="pIDDesc_pr" disabled="disabled" ></td>
				</tr>
				<tr class="_d-none_pr"><td><?php echo _("ID No."); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDNumber_pr" disabled="disabled" ></td></tr>
				<tr class="_d-none_pr"><td><?php echo _("Date of Issuance"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDIssuance_pr" disabled="disabled" readonly="true"></td></tr>
				<tr class="_d-none_pr"><td><?php echo _("Date of Expiry"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDExpiry_pr" disabled="disabled" readonly="true"></td></tr>
				<tr class="_d-none_pr"><td><?php echo _("Nationality"); ?><span class="text-danger">*</span> :</td>
					<td><input type="text" id="pNationality_pr" disabled="disabled" ></td></tr>
					<tr class="_d-none_pr"><td><?php echo _("Title / Position"); ?><span class="text-danger">*</span>:</td>
						<td><input type="text" id="pProfession_pr" disabled="disabled" ></td>
					</tr>
				</table>
			</div>
			<div class="account_info_details2_pr _account_info_details2_pr">
				<table border="0" cellspacing="5" class="tablet">
					<tr>
						<td colspan="2">Fees</td>
					</tr>
					<tr>
						<td><?php echo _("Merchant Discount Rate Premium (%)"); ?><span class="text-danger">*</span>:</td>
						<td>
							<div class="field required">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESTRXN" id="mercdiscountrate_pr" >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
					</tr>
					<tr>
						<td><?php echo _("Merchant Discount Rate NonPremium (%)"); ?><span class="text-danger">*</span>:</td>
						<td>
							<div class="field required">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESTRXNNONP" id="mercdiscountratenonp_pr" >
								<span class="iferror"><?php echo _("Field required"); ?></span>
							</div>
						</td>
					</tr>
					<tr>
						<td class="_d-none_pr"><?php echo _("Acquiring Interchange (%)"); ?>:</td>
						<td class="_d-none_pr">
							<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="mcvisafee_pr" >
						</td>					
					</tr>
					<tr>
						<td>
							<select id="CASHTYPE_pr" name="CASHTYPE" class="w-100" disabled="disabled">

							</select>
						</td>
						<td>
							<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashdiscountrate_pr" >
						</td>					
					</tr>
					<tr>
						<td class="_d-none_pr"><?php echo _("Cash Transaction Fee"); ?>:</td>
						<td class="_d-none_pr">
							<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashtransfee_pr" >
						</td>					
					</tr>
				</table>
			</div>

		</div>


<!--<div id="dialogDecline" title="<?php echo _("Decline Merchant / Cashier"); ?>">
	<div class="dLock" align="center">
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
				<td>
					<textarea rows="2" cols="30" id="declinedesc" ></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnDeclineSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div id="dialogSendBack" title="<?php echo _("Send Back Merchant / Cashier"); ?>">
	<div class="dLock" align="center">
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
				<td>
					<textarea rows="2" cols="30" id="sendbackdesc" ></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnSendBackSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>-->
<div id="dialogApprove_pr" title="<?php echo _("Approve Merchant / Cashier"); ?>">
	<div class="dLock" align="center">
		<table class="tablet text-start">
			<tr>
				<td><?php echo _("Please confirm your approval!"); ?></td>
				<td>
					<button  id="btnApproveSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>
<!--SMB -->
<div id="dialogProcessorApprove_pr" title="<?php echo _("Approve Merchant / Cashier"); ?>">
	<div class="dLock" align="center">
		<table class="tablet text-start">
			<tr>
				<td><?php echo _("Please confirm your approval!"); ?></td>
				<td>
					<button  id="btnProcessorApproveSubscriber_pr" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>
<!--<div id="dialogSMBDecline" title="<?php echo _("Decline Merchant / Cashier"); ?>">
	<div class="dLock" align="center">
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
				<td>
					<textarea rows="2" cols="30" id="declineSMBdesc" ></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnDeclineSMBSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div id="dialogSMBSendBack" title="<?php echo _("Send Back Merchant / Cashier"); ?>">
	<div class="dLock" align="center">
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
				<td>
					<textarea rows="2" cols="30" id="sendbackSMBdesc" ></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnSendBackSMBSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>-->

<div class="ploading_pr"></div>

<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.textchange.min.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

	function run(field) {
		var qwer = field.replace(/\s/g,'');
		return qwer;
	}

	var ht = $("#pendingprocessorapproval_pr").css('height');
	ht = ht.replace("px","");
		//$("#pendingreg",window.parent.document).css('height',parseInt(ht)+200);
		$(document).ready(function() {

			$('.viewaccount-link_pr').on('click', function() {
				var id = $(this).data('id');
				var type = $(this).data('type');
				var action = $(this).data('action');
				if (action == "viewSMBAccountforProcessor"){
					viewSMBAccountforProcessor(id, type);
				}else if (action == "viewAccount"){
					viewAccount(id, type);
				}
			});

			$(document).on('keyup', '._ctids', function() {
                var i = this.id.split('_')[1];
				validateMSISDN(i);
            });

			$('._smbctids').on('keyup', function() {
                this.value = run2(this.value);
			});

			$('.numonly').on('keyup', function() {
                this.value = this.value.replace(/\D/g, '');
            });

			$(".buttonx").button();

			oTable = $('#accountforprocessor').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button",
				"aaSorting": [[0, "desc" ]]
			});




			

			$('#mid_pr').keyup(function() { 
				str = $(this).val()
				str = str.replace(/\s/g,'')
				$(this).val(str)
				
				if($("#selectedType_pr").val()=="MERCHANT"){
					if(jQuery.trim($("#mid_pr").val())==""){
						$(".ctids").prop('disabled', true);
						$("#tid_pr").prop('disabled', true);
					}else{
						$(".ctids").prop('disabled', false);
						$("#tid_pr").prop('disabled', false);
					}
				}else{
					if(jQuery.trim($("#mid_pr").val())==""){
						$(".ctids").prop('disabled', true);
					}else{
						$(".ctids").prop('disabled', false);
					}
				}
				$("input.cmids").val($("#mid_pr").val());
			});

			$('#tid_pr').keyup(function() { 
				str = $(this).val()
				str = str.replace(/\s/g,'')
				$(this).val(str)
			});
			
			$('#pending_processor_view_pr').dialog({
				autoOpen: false,
				width: 1200,
				height: 600,
				draggable: true,
				resizable: false,
				modal:true,
				// position:'bottom'
			});
			
	// Dialog			
	$('#dialogDecline, #dialogSendBack, #dialogApprove_pr').dialog({
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
	$('#dialogSMBDecline, #dialogSMBSendBack, #dialogProcessorApprove_pr').dialog({
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

//function checkTIDMID($accounttype, $accid, $tid, $mid){
	function checkTIDMID($accounttype, $tid, $mid){
		$("#tid_pr").val($tid);
		$("#mid_pr").val($mid);
		if ($accounttype == "MADM"){
		//$("#tempid").val($accid);
		$("#tid_pr").val('');
		$("#mid_pr").val($mid);
	} else {
		//$("#tempid").val($accid);
		$("#tid_pr").val($tid);
		$("#mid_pr").val($mid);
	}
}

function checkMID($accounttype,$mmsisdn, $accid){
	
	$("#mmsisdn_pr").val("");
	$("#mmsisdn_pr").prop('disabled', false);
		//$("#mmsisdn2").val('');
		//$("#mmsisdn2").prop('disabled', true);
		$("#authNumber2_pr").prop('disabled', true);

		$("input.cmids").val($("#mid_pr").val());

		if(jQuery.trim($("#tid_pr").val())!=""){
			$("#tid_pr").prop('disabled', true);
		}
		if(jQuery.trim($("#mid_pr").val())==""){
			$(".ctids").prop('disabled', true);
		}else{
			$("#mid_pr").prop('disabled', true);
			$(".ctids").prop('disabled', true);
		}
		
		if(jQuery.trim($("#mid_pr").val())=="" && $accounttype != "MADM"){
			$("#tid_pr").prop('disabled', true);
		}
	}

	var cashierLength;
	function viewSMBAccountforProcessor(id, AccountType){
		$('#btnApproveSMBSubscriber').prop("disabled", false);
		$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
		$("#btnEditPInfo").css({display:'inline'});
		$(".personalInfoDetails").attr('disabled',true);
		$("#btnProcessorApprove_pr").hide();

		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType:  'json',
			data: {
				Method: 'pendingSMBProcessorView',
				rdoSearchOption: 3,
				txtSearch: id,
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.Result.ResponseCode == 0){

					$("#pending_processor_view_pr").dialog('open');					

					if (json.Result.AccountInformation.AccountID == json.Result.AccountInformation.MobileNumber){
						$("#btnProcessorApprove_pr").show();
						$("#btnApproveKYC_pr").hide();
					} else {
						$("#btnProcessorApprove_pr").hide();
						$("#btnApproveKYC_pr").show();
					}

					//alert(json.Result.AccountInformation.AccountType);
				if (json.Result.AccountInformation.AccountType == "MADM"){
					$("#tid_pr").hide();
					//$("#tdtid_pr").hide();
					//$("#tlcID_pr").hide();
					//$("#tlcid_pr").hide();
				}else {
					$("#tid_pr").show();
					$("#tdtid_pr").show();
					$("#tlcID_pr").show();
					$("#tlcid_pr").show();
				}
				// $("#tid").hide();
				// $("#tdtid_pr").hide();
				$("#authNumber_pr").hide();
				$("#authNumber2_pr").show();
				$("#authNumber2_pr").prop('disabled', true);
				
				$("#accountID").val(json.Result.AccountInformation.AccountID);
				var option = "<option>"+json.Result.AccountInformation.AccountType+"</option>";
				option = "<option>"+AccountType+"</option>";
				$("#selectedType_pr").html(option);
				$("#aliasName").val(json.Result.AccountInformation.Alias);
				
				$("#pAccountStatus").val(json.Result.AccountInformation.Status);

				$("#tlcID_pr").val(json.Result.AccountInformation.AccountID);

				$("#tid_pr").val(json.Result.TerminalID);
				$("#mid_pr").val(json.Result.MerchantID);
				$("#mid_pr").attr('disabled',false);
				$("#tid_pr").attr('disabled',true);

				var locked = json.Result.AccountInformation.Locked == "true" ? "YES" : "NO";
				$("#pLocked").val(locked);
				$("#subKYC").val(json.Result.AccountInformation.KYC);
				$("#pRefAccount").val(json.Result.AccountInformation.ReferenceAccount);
				
				$("#corponboardedby_pr").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname_pr").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname_pr").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness_pr").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo_pr").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building_pr").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street_pr").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city_pr").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor_pr").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area_pr").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox_pr").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country_pr").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName_pr").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName_pr").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber_pr").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail_pr").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber_pr").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc_pr").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance_pr").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry_pr").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality_pr").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession_pr").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				
				$("#mercdiscountrate_pr").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp_pr").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee_pr").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate_pr").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee_pr").val(json.Result.AccountInformation.cashtransfee)
				$("#pTRN_pr").val(json.Result.AccountInformation.TRN);
				
				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE_pr').html(listitem);
					$('#CASHTYPE_pr').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE_pr').html(listitem);
					$('#CASHTYPE_pr').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE_pr').html(listitem);
					$('#CASHTYPE_pr').click();
				}
				$("tr#add_data").remove();

				cashierLength = json.Result.Value.CASHIERS.length;

				if(json.Result.Value.CASHIERS.length > 0){
					
					for(var i =0;i < json.Result.Value.CASHIERS.length;i++){
						
						$("#tblAccount_pr").append("<tr id='add_data'><td>Merchant ID<span class='text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class='text-danger'>*</span>:</td><td><input class='cids _ctids' id='cid_" + i + "' type='text'><input type='text' class='verifyText' name='msisdnValidity" + i + "' id='msisdnValidity_pr" + i + "' disabled='disabled' ></td><td>Terminal ID<span class='text-danger'>*</span>:</td><td><input id='ctid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].terminalID + "></td><td>TLC ID<span class='text-danger'>*</span>:</td><td><input class='ctids' id ='ciddisplay_" + i + "' type='text' value=" + json.Result.Value.CASHIERS[i].appId + " disabled='disabled'></td><td><input class='msisdnCashiers' id ='msisdnCashiers_" + i + "' type='text' value=" + json.Result.Value.CASHIERS[i].msisdn + " disabled='disabled'></td>/tr> <tr id='add_data'> <td></td><td></td> <td></td><td></td> <td>Vat Functionality</td><td><div class='field required'><input type='radio' class='vats' name='vatFunctionality_" + i + "' checked value='1' id='yes' /><label for='yes'>Enable</label><input type='radio' class='vats' name='vatFunctionality_" + i + "' checked value='0' id='no' /><label for='no'>Disable</label></div></td><td>Packages</td><td><div class='field required'><select class='packs' id='corpPackages_" + i + "' name='corpPackages_" + i + "' class='w-100' ><option value='Standalone'>Standalone</option><option value='Essential'>Essential</option><option value='Essential lite'>Essential lite</option><option value='Essential plus'>Essential plus </option><option value='Smart'>Smart</option><option value='Smart lite'>Smart lite</option><option value='Smart  plus'>Smart plus</option></select></div></td></tr>");


						$(".cids").show();
						$("#msisdnCashiers").hide();
						$(".msisdnCashiers").hide();
						$("#cmid_" + i).attr('disabled',true);
						$("#cmid_" + i).val("");			
						$("#ciddisplay_" + i).attr('disabled',true);		 	
						$("#cid_" + i).attr('disabled',false);
						$("#ctid_" + i).attr('disabled',true);
					}
					$("#mid_pr").val(json.Result.MerchantID);
					
					$("#tid_pr").val(json.Result.TerminalID);
				}
				
				checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber, json.Result.AccountInformation.AccountID);

				$("#pTIN").val(json.Result.AccountInformation.PersonalInformation.TINNumber);
				$("#checkID_pr").attr("href", download_url + $("#authNumber_pr").val());
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}

var download_url = "<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.download.file.php?msisdn=";


$('#btnProcessorApprove_pr').click(function(){
	var isNull = "false";
	if($("#mmsisdn_pr").val() == ""){
		$("<p>MSISDN field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		$('#dialogProcessorApprove_pr').dialog('open');
	}
	return false;
});



$("#btnProcessorApproveSubscriber_pr").click(function(){
	//$('#btnProcessorApproveSubscriber_pr').prop("disabled", true);

	var thismsisdn = $("#mmsisdn_pr").val();
	var thisid = $("#authNumber_pr").val();
	var input = thisid.concat("-").concat(thismsisdn);
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });

	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'approveSMBKYCProcessor',
			MSISDN: thismsisdn,
			id: input,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			// setTimeout($.unblockUI, 1000);
			if(json.ResponseCode == 0){
				// $("#accountPending_" + $("#mmsisdn_pr").val()).css({display:'none'});
				$("#pending_processor_view_pr").dialog('close');
				$('#dialogProcessorApprove_pr').dialog('close');
				registerCashiers(thismsisdn);
			}else{
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
			// setTimeout($.unblockUI, 1000);
		}, error: function(e){
			setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	})

	
	// $('#btnApproveSMBSubscriber').prop("disabled", false);
});


function registerCashiers(thismsisdn){

	var CIDs = [];
	var CTIDs = [];
	
	var vatFuncts = [];
	var corpPacks = [];

	var thismsisdn = $("#mmsisdn_pr").val();
	var thisid = $("#authNumber_pr").val();
	var input = thisid.concat("-").concat(thismsisdn);

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});

	$(".msisdnCashiers").each(function(){
		CTIDs.push($(this).val());
	});
	
	$(".vats").each(function(){
		vatFuncts.push($(this).val());
	});
	
	$(".packs").each(function(){
		corpPacks.push($(this).val());
	});


	if(CTIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveSMBKYCProcessorCashier',
				MSISDN: thismsisdn,
				id: input,
				cashierids: CIDs,
				cashiertids: CTIDs,
				vatfunctionality: vatFuncts,
				corppackages: corpPacks,
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#processorPending_" + $("#tlcID_pr").val()).css({display:'none'});
					$("#pending_processor_view_pr").dialog('close');
					$('#dialogProcessorApprove_pr').dialog('close');	
				} 
				$("<p>"+thismsisdn + ", " + CIDs + " " + json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				setTimeout($.unblockUI, 1000);
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
}


$('#btnApproveKYC_pr').click(function(){
	var isNull = "false";
	$(".ctids").each(function(){
		if($(this).val() == ""){
			isNull = "true";
		}
	});
	if($("#mid_pr").val() == ""){
		$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		$('#dialogApprove_pr').dialog('open');
	}
	return false;
});


function run(field) {
	setTimeout(function() {
		var regex  = /^-?\d*\.?\d*$/;
		field.value = regex.exec(field.value);
	}, 0);
}

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

$("#mmsisdn_pr").bind('textchange', function(){	
	var params = {Method:'validateMSISDN',inp:$("#mmsisdn_pr").val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};			
	$.ajax({
		url:service_url,
		type:"POST", 
		data:params,
		complete:function(result,status){
			if(status=="success" || 1==1){													
				$("#msisdnValidity_pr").css("color", "#ffffff");

				if(result.responseText == 4){								
					$("#msisdnValidity_pr").val('Account Already Exist!')
					$("#msisdnValidity_pr").css("background-color", "#ff9900");
					$("#btnProcessorApprove_pr").hide();
					
				}
				if(result.responseText == 1){
					$("#msisdnValidity_pr").val('Invalid Format!')
					$("#msisdnValidity_pr").css("background-color", "#ff0000");
					$("#btnProcessorApprove_pr").hide();
				}
				if(result.responseText == 2){
					var i = 0;
					var cnt = 0;

					while (i < cashierLength) {
						if($("#mmsisdn_pr").val() == $("#cid_"+i).val()){
							cnt = 1;
						}
						validateMSISDN(i);
						i++;
					}
					if(cnt > 0){
						$("#msisdnValidity_pr").val('Already Exist in Cashier List!')
						$("#btnProcessorApprove_pr").hide();
						$("#msisdnValidity_pr").css("background-color", "#ff9900");
					}else{
						$("#msisdnValidity_pr").val('FREE!')
						$("#msisdnValidity_pr").css("background-color", "#009900");
						$("#btnProcessorApprove_pr").show();
					}
				}
			}
		}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
});

function validateMSISDN(n){
	var params = {Method:'validateMSISDN',inp:$("#cid_"+n).val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};		

	$.ajax({
		url:service_url,
		type:"POST", 
		data:params,
		complete:function(result,status){
			if(status=="success" || 1==1){													
				$("#msisdnValidity_pr"+n).css("color", "#ffffff");

				if(result.responseText == 4){								
					$("#msisdnValidity_pr"+n).val('Account Already Exist!')
					$("#btnProcessorApprove_pr").hide();
					$("#msisdnValidity_pr"+n).css("background-color", "#ff9900");

				}
				if(result.responseText == 1){
					$("#msisdnValidity_pr"+n).val('Invalid Format!')
					$("#btnProcessorApprove_pr").hide();
					$("#msisdnValidity_pr"+n).css("background-color", "#ff0000");
				}
				if(result.responseText == 2){
					var i = 0;
					var cnt = 0;
					var ccnt = 0;

					while (i < cashierLength) {
						if($("#cid_"+i).val() == $("#cid_"+n).val()){
							cnt++;
						}
						if($("#mmsisdn_pr").val() == $("#cid_"+n).val()){
							ccnt = 1;
						}
						i++;
					}
					if(cnt > 1){
						$("#msisdnValidity_pr"+n).val('Already Exist in Cashier List!')
						$("#btnProcessorApprove_pr").hide();
						$("#msisdnValidity_pr"+n).css("background-color", "#ff9900");
					}else{
						$("#msisdnValidity_pr"+n).val('FREE!')
						$("#msisdnValidity_pr"+n).css("background-color", "#009900");

						var i_ = 0;

						while (i_ < cashierLength) {
							if($("#msisdnValidity_pr"+i_).val() == "FREE!"){
								$("#btnProcessorApprove_pr").show();
								
							} else{
								$("#btnProcessorApprove_pr").hide();
							}
							i_++;
						}						
					}

					if(ccnt == 1){
						$("#msisdnValidity_pr"+n).val('Already Exist MSISDN!')
						$("#btnProcessorApprove_pr").hide();
						$("#msisdnValidity_pr"+n).css("background-color", "#ff9900");
					}
				}

			}
		}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});

	
}


$("#data_loading_pr").css('display','none');
$("#pendingprocessorapproval_pr").fadeIn(700);

</script>