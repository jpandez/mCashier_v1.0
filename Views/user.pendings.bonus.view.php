<?php require_once("views.config.properties.php"); ?>
<div id="bonuspndg" style="display:none;">
	<div class="uitabs">
		<ul>
			<li id="bonusTypePndgLink"><a href="#bonusTypePndgTab"><?php echo _("Bonus By Type"); ?></a></li>
			<li id="bonusMsisdnPndgLink"><a href="#bonusMsisdnPndgTab"><?php echo _("Bonus By MSISDN"); ?></a></li>
		</ul>
		<div id="bonusTypePndgTab" style="font-size:10px;margin-top:15px;">
			<?php $getBonusByTypePndg = $this->data("getBonusByTypePndg");?>
			<?php if(isset($getBonusByTypePndg->ResponseCode)){ ?>
				<?php if(is_array($getBonusByTypePndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtbonusTypePndg" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>														
						<th><?php echo _("CREATED BY"); ?></th>
						<th align="center"><?php echo _("Action"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getBonusByTypePndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="bonusTypePndg_<?php echo $t->PNDGID; ?>">
								<td width="5%"><?php echo $t->PNDGID; ?></td>
								<td width="15%"><?php echo $t->CREATEDDATE; ?></td>
								<td ><?php echo "ID:(".$t->ID."), KEY:(".$t->KEY."), TYPE:(".$t->TYPE."), ACCOUNT:(".$t->ACCOUNT."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), STATUS:(".$t->STATUS."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
								<td width="10%"><?php echo $t->CREATEDUSER; ?></td>
								<td width="10%" align="center"><a href="javascript:bonusByTypePending('<?php echo "APPROVED"."','".$t->ID."','".$t->PNDGID."','".$t->ACCOUNT."','".$t->NAME."','".$t->KEY."','".$t->TYPE."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Approve"); ?></a> | 
																<a href="javascript:bonusByTypePending('<?php echo "REJECTED"."','".$t->ID."','".$t->PNDGID."','".$t->ACCOUNT."','".$t->NAME."','".$t->KEY."','".$t->TYPE."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>No Records Found : $getBonusByTypePndg->Message</h3>";
				}?>
			<?php } ?>
		</div>
		<div id="bonusMsisdnPndgTab" style="font-size:10px;margin-top:15px;">
			<?php $getBonusByMSISDNPndg = $this->data("getBonusByMSISDNPndg");?>
			<?php if(isset($getBonusByMSISDNPndg->ResponseCode)){ ?>
				<?php if(is_array($getBonusByMSISDNPndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtbonusMsisdnPndg" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>														
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("Action"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getBonusByMSISDNPndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="bonusMSISDNPndg_<?php echo $t->PNDGID; ?>">
								<td width="5%"><?php echo $t->PNDGID; ?></td>
								<td width="15%"><?php echo $t->CREATEDDATE; ?></td>
								<td ><?php echo "ID:(".$t->ID."), KEY:(".$t->KEY."), MSISDN:(".$t->MSISDN."), ACCOUNT:(".$t->ACCOUNT."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), STATUS:(".$t->STATUS."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
								<td width="10%"><?php echo $t->CREATEDUSER; ?></td>
								<td width="10%" align="center"><a href="javascript:bonusByMSISDNPending('<?php echo "APPROVED"."','".$t->ID."','".$t->PNDGID."','".$t->ACCOUNT."','".$t->NAME."','".$t->KEY."','".$t->MSISDN."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Approve"); ?></a> | 
																<a href="javascript:bonusByMSISDNPending('<?php echo "REJECTED"."','".$t->ID."','".$t->PNDGID."','".$t->ACCOUNT."','".$t->NAME."','".$t->KEY."','".$t->MSISDN."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>No Records Found : $getBonusByMSISDNPndg->Message</h3>";
				}?>
			<?php } ?>
		</div>
	</div>


<div id="divBonusByTypePendingDialog" title="<?php echo _("Pending Bonus by Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="pend_id" disabled="true"/></td>
					<td><?php echo _("PENDING ID"); ?></td><td><input type="text" id="pend_pndgid" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT"); ?></td><td><input type="text" id="pend_account" disabled="true"/></td>
					<td><?php echo _("NAME"); ?></td><td><input type="text" id="pend_name" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><input type="text" id="pend_key" disabled="true"/></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="pend_fixed" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><input type="text" id="pend_type" disabled="true"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="pend_percent" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="pend_priority" disabled="true"/></td>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="pend_amountFrom" disabled="true"/></td>
				</tr>
				<tr>					
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><input type="text" id="pend_accountFrom" disabled="true"/></td>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="pend_amountTo" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><input type="text" id="pend_accountTo" disabled="true"/></td>		
					<td><?php echo _("CREATED USER"); ?></td><td><input type="text" id="pend_createdUser" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?></td><td><input type="text" id="pend_status" disabled="true"/></td>
					<td><?php echo _("CREATED DATE"); ?></td><td><input type="text" id="pend_createdDate" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("REMARKS"); ?></td><td><input type="text" id="pend_remarks" disabled="true"/></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnBonusByTypeSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
		        </a>
		        <a id="btnBonusByTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="btypependingloading"></div>
		</div>
	</form>
</div>

<div id="divBonusByMSISDNPendingDialog" title="<?php echo _("Pending Bonus by MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="_pend_id" disabled="true"/></td>
					<td><?php echo _("PENDING ID"); ?></td><td><input type="text" id="_pend_pndgid" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT"); ?></td><td><input type="text" id="_pend_account" disabled="true"/></td>
					<td><?php echo _("NAME"); ?></td><td><input type="text" id="_pend_name" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><input type="text" id="_pend_key" disabled="true"/></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="_pend_fixed" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="_pend_msisdn" disabled="true"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="_pend_percent" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="_pend_priority" disabled="true"/></td>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="_pend_amountFrom" disabled="true"/></td>
				</tr>
				<tr>					
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><input type="text" id="_pend_accountFrom" disabled="true"/></td>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="_pend_amountTo" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><input type="text" id="_pend_accountTo" disabled="true"/></td>			
					<td><?php echo _("CREATED USER"); ?></td><td><input type="text" id="_pend_createdUser" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?></td><td><input type="text" id="_pend_status" disabled="true"/></td>
					<td><?php echo _("CREATED DATE"); ?></td><td><input type="text" id="_pend_createdDate" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("REMARKS"); ?></td><td><input type="text" id="_pend_remarks" disabled="true"/></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnBonusByMSISDNSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
		        </a>
		        <a id="btnBonusByMSISDNCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="bmsisdnpendingloading"></div>
		</div>
	</form>
</div>


</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	$(function(){
		$('#dtbonusTypePndg,#dtbonusMsisdnPndg').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#bonuspndg").fadeIn(700);

	$("#divBonusByTypePendingDialog,#divBonusByMSISDNPendingDialog").dialog({
		autoOpen: false,
		width: 800,
		draggable: false,
		resizable: false,
		modal:true
	});
	$("#btnBonusByTypeCancel").click(function(){
		$("#divBonusByTypePendingDialog").dialog('close');
	});
	$("#btnBonusByMSISDNCancel").click(function(){
		$("#divBonusByMSISDNPendingDialog").dialog('close');
	});

	function bonusByTypePending(remarks,id,pndgID,account,name,key,type,fixed,percent,priority,amountFrom,amountTo,accountFrom,accountTo,createdUser,createdDate,status){
		$("#pend_remarks").val(remarks);
		$("#pend_id").val(id);
		$("#pend_pndgid").val(pndgID);
		$("#pend_account").val(account);
		$("#pend_name").val(name);
		$("#pend_key").val(key);
		$("#pend_type").val(type);
		$("#pend_fixed").val(fixed);
		$("#pend_percent").val(percent);
		$("#pend_priority").val(priority);
		$("#pend_amountFrom").val(amountFrom);
		$("#pend_amountTo").val(amountTo);
		$("#pend_accountFrom").val(accountFrom);
		$("#pend_accountTo").val(accountTo);
		$("#pend_createdUser").val(createdUser);
		$("#pend_createdDate").val(createdDate);
		var stat = status==0?'Disabled':'Enabled';
		$("#pend_status").val(stat);
		$("#divBonusByTypePendingDialog").dialog('open');
	}
	
	$("#btnBonusByTypeSubmit").click(function(){
		//$('.btypependingloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRejectBonusByTypePending',
				remarks:$("#pend_remarks").val(),
				id:$("#pend_pndgid").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusByTypePendingDialog").dialog('close');
					$("#bonusTypePndg_"+$("#pend_pndgid").val()).hide();
				}
				//$('.btypependingloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				//});
				
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function bonusByMSISDNPending(remarks,id,pndgID,account,name,key,msisdn,fixed,percent,priority,amountFrom,amountTo,accountFrom,accountTo,createdUser,createdDate,status){
		$("#_pend_remarks").val(remarks);
		$("#_pend_id").val(id);
		$("#_pend_pndgid").val(pndgID);
		$("#_pend_account").val(account);
		$("#_pend_name").val(name);
		$("#_pend_key").val(key);
		$("#_pend_msisdn").val(msisdn);
		$("#_pend_fixed").val(fixed);
		$("#_pend_percent").val(percent);
		$("#_pend_priority").val(priority);
		$("#_pend_amountFrom").val(amountFrom);
		$("#_pend_amountTo").val(amountTo);
		$("#_pend_accountFrom").val(accountFrom);
		$("#_pend_accountTo").val(accountTo);
		$("#_pend_createdUser").val(createdUser);
		$("#_pend_createdDate").val(createdDate);
		var stat = status==0?'Disabled':'Enabled';
		$("#_pend_status").val(stat);
		$("#divBonusByMSISDNPendingDialog").dialog('open');
	}

	$("#btnBonusByMSISDNSubmit").click(function(){
		//$('.bmsisdnpendingloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRejectBonusByMSISDNPending',
				remarks:$("#_pend_remarks").val(),
				id:$("#_pend_pndgid").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusByMSISDNPendingDialog").dialog('close');
					$("#bonusMSISDNPndg_"+$("#_pend_pndgid").val()).hide();
				}
				//$('.bmsisdnpendingloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				//});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

</script>