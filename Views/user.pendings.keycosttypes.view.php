<?php require_once("views.config.properties.php"); ?>
<div id="keycost" style="display:none;">
	<div class="uitabs">
		<ul>
			<li id="keyCostTypePndgLink"><a href="#keyCostTypePndgTab"><?php echo _("Key Cost Type"); ?></a></li>
			<li id="keyCostMSISDNPndgLink"><a href="#keyCostMSISDNPndgTab"><?php echo _("Key Cost MSISDN"); ?></a></li>
		</ul>
		<div id="keyCostTypePndgTab" style="margin-top:15px;">
			<div id="keycosttypes" style="width:100%;font-size:10px;">
				<?php $getKeyCostTypePndg = $this->data("getKeyCostTypePndg");?>
				<?php if(isset($getKeyCostTypePndg->ResponseCode)){ ?>
					<?php if(is_array($getKeyCostTypePndg->Value)){?>
						<div style="margin-top:10px";></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeycosttype" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("Key"); ?></th>
								<th><?php echo _("Type"); ?></th>														
								<th><?php echo _("Account"); ?></th>														
								<th><?php echo _("Fixed"); ?></th>														
								<th><?php echo _("Percent"); ?></th>														
								<th><?php echo _("Priority"); ?></th>														
								<th><?php echo _("Amount From"); ?></th>														
								<th><?php echo _("Amount To"); ?></th>														
								<th><?php echo _("Account From"); ?></th>														
								<th><?php echo _("Timestamp"); ?></th>
								<th><?php echo _("Created By"); ?></th>
								<th><?php echo _("Status"); ?></th>							
								<th><?php echo _("Action"); ?></th>							
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getKeyCostTypePndg->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="kcost_<?php echo $t->ID; ?>">
										<td><?php echo $t->ID; ?></td>
										<td><?php echo $t->KEY; ?></td>
										<td><?php echo $t->TYPE; ?></td>
										<td><?php echo $t->ACCOUNT; ?></td>
										<td><?php echo $t->FIXED; ?></td>
										<td><?php echo $t->PERCENT; ?></td>
										<td><?php echo $t->PRIORITY; ?></td>
										<td><?php echo $t->AMOUNTFR; ?></td>
										<td><?php echo $t->AMOUNTTO; ?></td>
										<td><?php echo $t->ACCOUNTFR; ?></td>
										<td><?php echo $t->CREATEDDATE; ?></td>
										<td><?php echo $t->CREATEDBY; ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td width="13%" align="center"><a href="javascript:approveKeyCostTypePndg('APPROVED','<?php echo $t->ID; ?>','<?php echo $t->CREATEDDATE; ?>','<?php echo $t->TYPE; ?>','<?php echo $t->KEY; ?>','<?php echo $t->ACCOUNT; ?>','<?php echo $t->FIXED; ?>','<?php echo $t->PERCENT; ?>','<?php echo $t->PRIORITY; ?>','<?php echo $t->STATUS; ?>','<?php echo $t->AMOUNTFR; ?>','<?php echo $t->AMOUNTTO; ?>','<?php echo $t->ACCOUNTFR; ?>');"><?php echo ($this->getRolesConfig('APPROVE_KEY_COST_CHARGES_CHANGES')) ? 'Approve' : ''; ?></a> |
																	   <a href="javascript:approveKeyCostTypePndg('REJECT','<?php echo $t->ID; ?>','<?php echo $t->CREATEDDATE; ?>','<?php echo $t->TYPE; ?>','<?php echo $t->KEY; ?>','<?php echo $t->ACCOUNT; ?>','<?php echo $t->FIXED; ?>','<?php echo $t->PERCENT; ?>','<?php echo $t->PRIORITY; ?>','<?php echo $t->STATUS; ?>','<?php echo $t->AMOUNTFR; ?>','<?php echo $t->AMOUNTTO; ?>','<?php echo $t->ACCOUNTFR; ?>');"><?php echo ($this->getRolesConfig('REJECT_KEY_COST_CHARGES_CHANGES')) ? 'Reject' : ''; ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
		<div id="keyCostMSISDNPndgTab" style="margin-top:15px;">
			<div style="width:100%;font-size:10px;">
				<?php $getKeyCostMSISDNPndg = $this->data("getKeyCostMSISDNPndg");?>
				<?php if(isset($getKeyCostMSISDNPndg->ResponseCode)){ ?>
					<?php if(is_array($getKeyCostMSISDNPndg->Value)){?>
						<div style="margin-top:10px";></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeycostmsisdn" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("Key"); ?></th>
								<th><?php echo _("MSISDN"); ?></th>														
								<th><?php echo _("Account"); ?></th>														
								<th><?php echo _("Fixed"); ?></th>														
								<th><?php echo _("Percent"); ?></th>														
								<th><?php echo _("Priority"); ?></th>														
								<th><?php echo _("Amount From"); ?></th>														
								<th><?php echo _("Amount To"); ?></th>														
								<th><?php echo _("Account From"); ?></th>														
								<th><?php echo _("Timestamp"); ?></th>
								<th><?php echo _("Created By"); ?></th>
								<th><?php echo _("Status"); ?></th>							
								<th><?php echo _("Action"); ?></th>							
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getKeyCostMSISDNPndg->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="kcostmsisdn_<?php echo $t->PNDGID; ?>">
										<td><?php echo $t->PNDGID; ?></td>
										<td><?php echo $t->KEY; ?></td>
										<td><?php echo $t->MSISDN; ?></td>
										<td><?php echo $t->ACCOUNT; ?></td>
										<td><?php echo $t->FIXED; ?></td>
										<td><?php echo $t->PERCENT; ?></td>
										<td><?php echo $t->PRIORITY; ?></td>
										<td><?php echo $t->AMOUNTFR; ?></td>
										<td><?php echo $t->AMOUNTTO; ?></td>
										<td><?php echo $t->ACCOUNTFR; ?></td>
										<td><?php echo $t->CREATEDDATE; ?></td>
										<td><?php echo $t->CREATEDBY; ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td width="13%" align="center"><a href="javascript:approveKeyCostMSISDNPndg('APPROVED','<?php echo $t->PNDGID; ?>','<?php echo $t->CREATEDDATE; ?>','<?php echo $t->MSISDN; ?>','<?php echo $t->KEY; ?>','<?php echo $t->ACCOUNT; ?>','<?php echo $t->FIXED; ?>','<?php echo $t->PERCENT; ?>','<?php echo $t->PRIORITY; ?>','<?php echo $t->STATUS; ?>','<?php echo $t->AMOUNTFR; ?>','<?php echo $t->AMOUNTTO; ?>','<?php echo $t->ACCOUNTFR; ?>');"><?php echo ($this->getRolesConfig('APPROVE_KEY_COST_CHARGES_CHANGES')) ? 'Approve' : ''; ?></a> |
																		<a href="javascript:approveKeyCostMSISDNPndg('REJECT','<?php echo $t->PNDGID; ?>','<?php echo $t->CREATEDDATE; ?>','<?php echo $t->MSISDN; ?>','<?php echo $t->KEY; ?>','<?php echo $t->ACCOUNT; ?>','<?php echo $t->FIXED; ?>','<?php echo $t->PERCENT; ?>','<?php echo $t->PRIORITY; ?>','<?php echo $t->STATUS; ?>','<?php echo $t->AMOUNTFR; ?>','<?php echo $t->AMOUNTTO; ?>','<?php echo $t->ACCOUNTFR; ?>');"><?php echo ($this->getRolesConfig('REJECT_KEY_COST_CHARGES_CHANGES')) ? 'Reject' : ''; ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
	</div>

<div id="dialogPndgKeyCostMSISDN" title="<?php echo _("Pending Key Cost MSISDN"); ?>">
    <form>
		<table style="text-align:left;" class="tablet">
			<tr>
				<td><?php echo _("ID"); ?> :</td><td><input type="text" id="kcmID" readonly="readonly" disabled="true"></td>
				<td><?php echo _("CREATED TIMESTAMP"); ?> :</td><td><input type="text" id="kcmDATE" readonly="readonly" disabled="true"></td>
			</tr>					
			<tr>
				<td><?php echo _("MSISDN"); ?> :</td><td><input type="text" id="kcmMSISDN" readonly="readonly" disabled="true"></td>
				<td><?php echo _("KEY"); ?> :</td><td><input type="text" id="kcmKEY" readonly="readonly" disabled="true"></td>
			</tr>
			<tr>
				<td><?php echo _("ACCOUNT"); ?> :</td><td><input type="text" id="kcmACCOUNT" readonly="readonly" disabled="true"></td>
				<td><?php echo _("FIXED"); ?> :</td><td><input type="text" id="kcmFIXED" readonly="readonly" disabled="true"></td>
			</tr>					
			<tr>
				<td><?php echo _("PERCENT"); ?> :</td><td><input type="text" id="kcmPERCENT" readonly="readonly" disabled="true"></td>
				<td><?php echo _("PRIORITY"); ?> :</td><td><input type="text" id="kcmPRIORITY" readonly="readonly" disabled="true"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" id="kcmSTATUS" readonly="readonly" disabled="true"></td>
				<td><?php echo _("AMOUNTFR"); ?> :</td><td><input type="text" id="kcmAMOUNTFR" readonly="readonly" disabled="true"></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNTTO"); ?> :</td><td><input type="text" id="kcmAMOUNTTO" readonly="readonly" disabled="true"></td>
				<td><?php echo _("ACCOUNTFR"); ?> :</td><td><input type="text" id="kcmACCOUNTFR" readonly="readonly" disabled="true"></td>
			</tr>
			<tr>
				<td><?php echo _("ACTION"); ?> :</td><td><input type="text" id="kcmACTION" readonly="readonly" disabled="true"></td>
			</tr>			
		</table>
		 <div align="right">
        	<a id="btnKCMApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text"><?php echo _("Submit"); ?></span>
            </a>
            <a id="btnKCMCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
            </a>
		</div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script>
$(function(){
	$('#dtkeycosttype,#dtkeycostmsisdn').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button"
	});
});
$("#keycost").fadeIn(700);
$("#dialogPndgKeyCostMSISDN").dialog({
	autoOpen: false,
	width: 850,
	draggable: false,
	resizable: false,
	modal:true
});
$("#btnKCMCancel").click(function(){
	$("#dialogPndgKeyCostMSISDN").dialog('close');
});

function approveKeyCostMSISDNPndg(remarks,pndgid,createdDate,msisdn,key,account,fixed,percent,priority,status,amountFrom,amountTo,accountFrom){
	$("#kcmID").val(pndgid);
	$("#kcmDATE").val(createdDate);
	$("#kcmMSISDN").val(msisdn);
	$("#kcmKEY").val(key);
	$("#kcmACCOUNT").val(account);
	$("#kcmFIXED").val(fixed);
	$("#kcmPERCENT").val(percent);
	$("#kcmPRIORITY").val(priority);
	$("#kcmSTATUS").val(status);
	$("#kcmAMOUNTFR").val(amountFrom);
	$("#kcmAMOUNTTO").val(amountTo);
	$("#kcmACCOUNTFR").val(accountFrom);
	$("#kcmACTION").val(remarks);
	$('#dialogPndgKeyCostMSISDN').dialog('open');
}

$("#btnKCMApprove").click(function(){
	$.ajax({
		url:service_url,
		type:'post',
		dataType:'json',
		data:{
			Method:'approveRejectKeyCostMSISDN',
			pndgid:$("#kcmID").val(),
			remarks:$("#kcmACTION").val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){
				$('#dialogPndgKeyCostMSISDN').dialog('close');
				$("#kcostmsisdn_"+$("#kcmID").val()).hide();
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
});


/*kecy cost type*/
function approveKeyCostTypePndg(strremarks,strid,strdate,strtype,strkey,straccount,strfixed,strpercent,strpriority,strstatus,stramountfr,stramountto,straccountfr){
		$('#dialogPndgKeyCostTypes').dialog('open');
		$("#kctID").val(strid);
		$("#kctDATE").val(strdate);
		$("#kctTYPE").val(strtype);
		$("#kctKEY").val(strkey);
		$("#kctACCOUNT").val(straccount);
		$("#kctFIXED").val(strfixed);
		$("#kctPERCENT").val(strpercent);
		$("#kctPRIORITY").val(strpriority);
		$("#kctSTATUS").val(strstatus);
		$("#kctAMOUNTFR").val(stramountfr);
		$("#kctAMOUNTTO").val(stramountto);
		$("#kctACCOUNTFR").val(straccountfr);
		$("#kctACTION").val(strremarks);
		
	}
	/*
	function approveKeyCostTypePndgReject(strremarks,strid,strdate,strtype,strkey,straccount,strfixed,strpercent,strpriority,strstatus,stramountfr,stramountto,straccountfr){
		$('#dialogPndgKeyCostTypesr').dialog('open');
		$("#kctIDr").val(strid);
		$("#kctDATEr").val(strdate);
		$("#kctTYPEr").val(strtype);
		$("#kctKEYr").val(strkey);
		$("#kctACCOUNTr").val(straccount);
		$("#kctFIXEDr").val(strfixed);
		$("#kctPERCENTr").val(strpercent);
		$("#kctPRIORITYr").val(strpriority);
		$("#kctSTATUSr").val(strstatus);
		$("#kctAMOUNTFRr").val(stramountfr);
		$("#kctAMOUNTTOr").val(stramountto);
		$("#kctACCOUNTFRr").val(straccountfr);
		$("#kctACTIONr").val(strremarks);
		
	}*/
	$("#btnKCTApprove").click(function(){
		var params = {
					Method:'approveKeyCostTypePndg',
					remarks:$("#kctACTION").val(),
					id:$("#kctID").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		//$('.kctloadinga').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$("#kcost_" + $("#kctID").val()).hide();
						$('#dialogPndgKeyCostTypes').dialog('close');
					}
					//$('.kctloadinga').fadeToggle(300,'linear',function(){
						$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					//});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	/*$("#btnKCTApprover").click(function(){
		var params = {
					Method:'approveKeyCostTypePndg',
					remarks:$("#kctACTIONr").val(),
					id:$("#kctIDr").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.kctloadingr').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$("#kcost_" + $("#kctIDr").val()).hide();
						$('#dialogPndgKeyCostTypesr').dialog('close');					
					}					
					$('.kctloadingr').fadeToggle(300,'linear',function(){
							$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});*/
</script>