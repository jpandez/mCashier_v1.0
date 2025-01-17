<?php require_once("views.config.properties.php"); ?>
<div id="amlsettings">

<div class="uitabs">
	<ul>
		<li id="amlTypePndgLink"><a href="#amlTypePndgTab"><?php echo _("AML Type"); ?></a></li>
		<li id="amlMSISDNPndgLink"><a href="#amlMSISDNPndgTab"><?php echo _("AML MSISDN"); ?></a></li>
	</ul>
	<div id="amlTypePndgTab" style="margin-top:15px;">
		<div style="width:100%;font-size:10px;">
			<?php $pendingaml = $this->data("getAmlTypePndg");?>
			<?php if(isset($pendingaml->ResponseCode)){ ?>
				<?php if(is_array($pendingaml->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtaml" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("AML CONFIG"); ?></th>														
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("Approve/Reject"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($pendingaml->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="aml_<?php echo $t->PNDGID; ?>">
								<td><?php echo $t->PNDGID; ?></td>
								<td><?php echo $t->CREATEDDATE; ?></td>
								<td width="100%"><?php echo "TYPE : ". $t->TYPE . ", KEY : ". $t->KEY . ", PRIORITY : ". $t->PRIORITY . ", MAXAMOUNT : ". $t->MAXAMOUNT . ", MINAMOUNT : ". $t->MINAMOUNT . ", MAXCURRENTAMOUNT : ". $t->MAXCURRENTAMOUNT . ", MAXAMOUNTDAY : ". $t->MAXAMOUNTDAY . ", MAXAMOUNTMONTH : ". $t->MAXAMOUNTMONTH . ", MAXTRANSDAY : ". $t->MAXTRANSDAY . ", MAXTRANSMONTH : ". $t->MAXTRANSMONTH . ", TRANSACTIONTYPE : ". $t->TRANSACTIONTYPE; ?></td>
								<td><?php echo $t->CREATEDBY; ?></td>
								<td><a href="javascript:approveAmlTypePndg('APPROVED','<?php echo $t->PNDGID; ?>','<?php echo $t->CREATEDDATE; ?>','<?php echo $t->TYPE; ?>','<?php echo $t->KEY; ?>','<?php echo $t->PRIORITY; ?>','<?php echo $t->MAXAMOUNT; ?>','<?php echo $t->MINAMOUNT; ?>','<?php echo $t->MAXCURRENTAMOUNT; ?>','<?php echo $t->MAXAMOUNTDAY; ?>','<?php echo $t->MAXAMOUNTMONTH; ?>','<?php echo $t->MAXTRANSDAY; ?>','<?php echo $t->MAXTRANSMONTH; ?>','<?php echo $t->TRANSACTIONTYPE; ?>');"><?php echo ($this->getRolesConfig('APPROVE_AML_SETTINGS_CHANGES')) ? 'Approve' : ''; ?></a> |
									<a href="javascript:approveAmlTypePndgReject('REJECT','<?php echo $t->PNDGID; ?>','<?php echo $t->CREATEDDATE; ?>','<?php echo $t->TYPE; ?>','<?php echo $t->KEY; ?>','<?php echo $t->PRIORITY; ?>','<?php echo $t->MAXAMOUNT; ?>','<?php echo $t->MINAMOUNT; ?>','<?php echo $t->MAXCURRENTAMOUNT; ?>','<?php echo $t->MAXAMOUNTDAY; ?>','<?php echo $t->MAXAMOUNTMONTH; ?>','<?php echo $t->MAXTRANSDAY; ?>','<?php echo $t->MAXTRANSMONTH; ?>','<?php echo $t->TRANSACTIONTYPE; ?>');"><?php echo ($this->getRolesConfig('REJECT_AML_SETTINGS_CHANGES')) ? 'Reject' : ''; ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>No records found.</h3>";
				}?>
			<?php } ?>
		</div>
	</div>
	<div id="amlMSISDNPndgTab" style="margin-top:15px;">
		<div style="width:100%;font-size:10px;">
			<?php $getAmlMSISDNPndg = $this->data("getAmlMSISDNPndg");?>
			<?php if(isset($getAmlMSISDNPndg->ResponseCode)){ ?>
				<?php if(is_array($getAmlMSISDNPndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtamlmsisdn" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("AML CONFIG"); ?></th>														
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("Approve/Reject"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getAmlMSISDNPndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="amlmsisdn_<?php echo $t->PNDGID; ?>">
								<td><?php echo $t->PNDGID; ?></td>
								<td><?php echo $t->CREATEDDATE; ?></td>
								<td width="100%"><?php echo "MSISDN : ". $t->MSISDN . ", KEY : ". $t->KEY . ", PRIORITY : ". $t->PRIORITY . ", MAXAMOUNT : ". $t->MAXAMOUNT . ", MINAMOUNT : ". $t->MINAMOUNT . ", MAXCURRENTAMOUNT : ". $t->MAXCURRENTAMOUNT . ", MAXAMOUNTDAY : ". $t->MAXAMOUNTDAY . ", MAXAMOUNTMONTH : ". $t->MAXAMOUNTMONTH . ", MAXTRANSDAY : ". $t->MAXTRANSDAY . ", MAXTRANSMONTH : ". $t->MAXTRANSMONTH . ", TRANSACTIONTYPE : ". $t->TRANSACTIONTYPE; ?></td>
								<td><?php echo $t->CREATEDBY; ?></td>
								<td><a href="javascript:approveAmlMSISDNPndg('<?php echo 'APPROVED'."','".$t->PNDGID."','".$t->MSISDN."','".$t->KEY."','".$t->PRIORITY."','".$t->MINAMOUNT."','".$t->MAXAMOUNT."','".$t->MAXAMOUNTDAY."','".$t->MAXAMOUNTMONTH."','".$t->MAXTRANSDAY."','".$t->MAXTRANSMONTH."','".$t->MAXCURRENTAMOUNT."','".$t->TRANSACTIONTYPE."','".$t->CREATEDBY."','".$t->CREATEDDATE ?>');"><?php echo ($this->getRolesConfig('APPROVE_AML_SETTINGS_CHANGES')) ? 'Approve' : ''; ?></a> |
									<a href="javascript:approveAmlMSISDNPndg('<?php echo 'REJECT'."','".$t->PNDGID."','".$t->MSISDN."','".$t->KEY."','".$t->PRIORITY."','".$t->MINAMOUNT."','".$t->MAXAMOUNT."','".$t->MAXAMOUNTDAY."','".$t->MAXAMOUNTMONTH."','".$t->MAXTRANSDAY."','".$t->MAXTRANSMONTH."','".$t->MAXCURRENTAMOUNT."','".$t->TRANSACTIONTYPE."','".$t->CREATEDBY."','".$t->CREATEDDATE ?>');"><?php echo ($this->getRolesConfig('REJECT_AML_SETTINGS_CHANGES')) ? 'Reject' : ''; ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>No records found.</h3>";
				}?>
			<?php } ?>
		</div>
	</div>
</div>


<div id="divAMLMSISDNRequestDialog" title="<?php echo _("Pending AML MSISDN"); ?>">
	<input type="hidden" id="AMP_pndgid"/>
	<div class="dAllocate" align="center">
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="AMP_msisdn" disabled="true"/></td>
				<td><?php echo _("Key"); ?></td><td><input type="text" id="AMP_key" disabled="true"/></td>
			</tr>
			<tr>
				<td><?php echo _("Priority"); ?></td><td><input type="text" id="AMP_priority" disabled="true"/></td>
				<td><?php echo _("Transaction type"); ?></td><td><input type="text" id="AMP_transType" disabled="true"/></td>
			</tr>
			<tr>
				<td><?php echo _("Min.Amount"); ?></td><td><input type="text" id="AMP_minAmount" disabled="true"/></td>
				<td><?php echo _("Max.Amount/Day"); ?></td><td><input type="text" id="AMP_maxAmountDay" disabled="true"/></td>
			</tr>
			<tr>
				<td><?php echo _("Max.Amount"); ?></td><td><input type="text" id="AMP_maxAmount" disabled="true"/></td>
				<td><?php echo _("Max.Amount/Month"); ?></td><td><input type="text" id="AMP_maxAmountMonth" disabled="true"/></td>
			</tr>
			<tr>
				<td><?php echo _("Max.Transaction/Day"); ?></td><td><input type="text" id="AMP_transDay" disabled="true"/></td>
				<td><?php echo _("Max.Current Amount"); ?></td><td><input type="text" id="AMP_maxCurrentAmount" disabled="true"/></td>
			</tr>
			<tr>
				<td><?php echo _("Max.Transaction/Month"); ?></td><td><input type="text" id="AMP_transMonth" disabled="true"/></td>
				<td><?php echo _("Created By"); ?></td><td><input type="text" id="AMP_createdBy" disabled="true"/></td>
			</tr>
			<tr>
				<td><?php echo _("Created Date"); ?></td><td><input type="text" id="AMP_createdDate" disabled="true"/></td>
				<td><?php echo _("Remarks"); ?></td><td><input type="text" id="AMP_remarks" disabled="true"/></td>
			</tr>
		</table>
		<div align="right">
	    	<a id="btnAMLMSISDNRequestSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
	        </a>
	        <a id="btnAMLMSISDNRequestCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
	        </a>                    
		</div>
	</div>
</div>

<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script>
$(function(){
	$('#dtaml,#dtamlmsisdn').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button"
	});
});
$("#amlsettings").fadeIn(700);
$("#divAMLMSISDNRequestDialog").dialog({
	autoOpen: false,
	width: 800,
	draggable: false,
	resizable: false,
	modal:true
});
$("#btnAMLMSISDNRequestCancel").click(function(){
	$("#divAMLMSISDNRequestDialog").dialog('close');
});

function approveAmlMSISDNPndg(remarks,pndgID,msisdn,key,priority,minAmount,maxAmount,maxAmountDay,maxAmountMonth,maxTransDay,maxTransMonth,maxCurrentAmount,transactionType,createdBy,createdDate){
	$("#AMP_remarks").val(remarks);
	$("#AMP_pndgid").val(pndgID);
	$("#AMP_msisdn").val(msisdn);
	$("#AMP_key").val(key);
	$("#AMP_priority").val(priority);
	$("#AMP_minAmount").val(transactionType=="RECEIVE"?'N/A':minAmount);
	$("#AMP_maxAmount").val(maxAmount);
	$("#AMP_maxAmountDay").val(maxAmountDay);
	$("#AMP_maxAmountMonth").val(maxAmountMonth);
	$("#AMP_transDay").val(maxTransDay);
	$("#AMP_transMonth").val(maxTransMonth);
	$("#AMP_maxCurrentAmount").val(transactionType=="SEND"?'N/A':maxCurrentAmount);
	$("#AMP_transType").val(transactionType);
	$("#AMP_createdBy").val(createdBy);
	$("#AMP_createdDate").val(createdDate);
	$("#divAMLMSISDNRequestDialog").dialog('open');
}

$("#btnAMLMSISDNRequestSubmit").click(function(){
	$.ajax({
		url:service_url,
		type:'post',
		dataType:'json',
		data:{
			Method:'approveRejectAMLMSISDNPndg',
			pndgid:$("#AMP_pndgid").val(),
			remarks:$("#AMP_remarks").val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#amlmsisdn_"+$("#AMP_pndgid").val()).hide();
				$("#divAMLMSISDNRequestDialog").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
});
</script>