<?php require_once("views.config.properties.php"); ?>
<div id="commissionspndg" style="display:none;">
	<div class="uitabs">
		<ul>
			<li id="commissionsTypePndgLink"><a href="#commissionsTypePndgTab"><?php echo _("Commissions by Type"); ?></a></li>
			<li id="commissionsMSISDNPndgLink"><a href="#commissionsMSISDNPndgTab"><?php echo _("Commissions by MSISDN"); ?></a></li>
		</ul>
		<div id="commissionsTypePndgTab" style="font-size:10px;margin-top:15px;">
			<?php $getCommissionsByTypePndg = $this->data("getCommissionsByTypePndg");?>
			<?php if(isset($getCommissionsByTypePndg->ResponseCode)){ ?>
				<?php if(is_array($getCommissionsByTypePndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtcommissionsTypePndg" width="100%">
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
						<?php $ctr=0; foreach($getCommissionsByTypePndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="commissionsTypePndg_<?php echo $t->PNDGID; ?>">
								<td width="5%"><?php echo $t->PNDGID; ?></td>
								<td width="15%"><?php echo $t->CREATEDDATE; ?></td>
								<td ><?php echo "ID:(".$t->ID."), KEY:(".$t->KEY."), TYPE:(".$t->TYPE."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), STATUS:(".$t->STATUS."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
								<td width="10%"><?php echo $t->CREATEDUSER; ?></td>
								<td width="10%" align="center"><a href="javascript:commissionsByTypePending('<?php echo "APPROVED"."','".$t->ID."','".$t->PNDGID."','".$t->NAME."','".$t->KEY."','".$t->TYPE."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Approve"); ?></a> | 
																<a href="javascript:commissionsByTypePending('<?php echo "REJECTED"."','".$t->ID."','".$t->PNDGID."','".$t->NAME."','".$t->KEY."','".$t->TYPE."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>No Records Found : $getCommissionsByTypePndg->Message</h3>";
				}?>
			<?php } ?>
		</div>
		<div id="commissionsMSISDNPndgTab" style="font-size:10px;margin-top:15px;">
			<?php $getCommissionsByMSISDNPndg = $this->data("getCommissionsByMSISDNPndg");?>
			<?php if(isset($getCommissionsByMSISDNPndg->ResponseCode)){ ?>
				<?php if(is_array($getCommissionsByMSISDNPndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtcommissionsMSISDNPndg" width="100%">
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
						<?php $ctr=0; foreach($getCommissionsByMSISDNPndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="commissionsMSISDNPndg_<?php echo $t->PNDGID; ?>">
								<td width="5%"><?php echo $t->PNDGID; ?></td>
								<td width="15%"><?php echo $t->CREATEDDATE; ?></td>
								<td ><?php echo "ID:(".$t->ID."), KEY:(".$t->KEY."), MSISDN:(".$t->MSISDN."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), STATUS:(".$t->STATUS."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."),ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
								<td width="10%"><?php echo $t->CREATEDUSER; ?></td>
								<td width="10%" align="center"><a href="javascript:commissionsByMSISDNPending('<?php echo "APPROVED"."','".$t->ID."','".$t->PNDGID."','".$t->NAME."','".$t->KEY."','".$t->MSISDN."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Approve"); ?></a> | 
																<a href="javascript:commissionsByMSISDNPending('<?php echo "REJECTED"."','".$t->ID."','".$t->PNDGID."','".$t->NAME."','".$t->KEY."','".$t->MSISDN."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->CREATEDUSER."','".$t->CREATEDDATE."','".$t->STATUS; ?>');"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>No Records Found : $getCommissionsByMSISDNPndg->Message</h3>";
				}?>
			<?php } ?>
		</div>
	</div>


<div id="divCommissionsByTypePendingDialog" title="<?php echo _("Pending Commissions by Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="pendc_id" disabled="true"/></td>
					<td><?php echo _("PENDING ID"); ?></td><td><input type="text" id="pendc_pndgid" disabled="true"/></td>
				</tr>
				<tr>

					<td><?php echo _("NAME"); ?></td><td><input type="text" id="pendc_name" disabled="true"/></td>
					<td><?php echo _("REMARKS"); ?></td><td><input type="text" id="pendc_remarks" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><input type="text" id="pendc_key" disabled="true"/></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="pendc_fixed" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><input type="text" id="pendc_type" disabled="true"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="pendc_percent" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="pendc_priority" disabled="true"/></td>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="pendc_amountFrom" disabled="true"/></td>
				</tr>
				<tr>					
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><input type="text" id="pendc_accountFrom" disabled="true"/></td>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="pendc_amountTo" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><input type="text" id="pendc_accountTo" disabled="true"/></td>					

					<td><?php echo _("CREATED USER"); ?></td><td><input type="text" id="pendc_createdUser" disabled="true"/></td>

				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?></td><td><input type="text" id="pendc_status" disabled="true"/></td>
					<td><?php echo _("CREATED DATE"); ?></td><td><input type="text" id="pendc_createdDate" disabled="true"/></td>

				</tr>
			</table>
			<div align="right">
		    	<a id="btnCommissionsByTypeSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
		        </a>
		        <a id="btnCommissionsByTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="btypependingloading"></div>
		</div>
	</form>
</div>

<div id="divCommissionsByMSISDNPendingDialog" title="<?php echo _("Pending Commissions by MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="_pendc_id" disabled="true"/></td>
					<td><?php echo _("PENDING ID"); ?></td><td><input type="text" id="_pendc_pndgid" disabled="true"/></td>
				</tr>
				<tr>

					<td><?php echo _("NAME"); ?></td><td><input type="text" id="_pendc_name" disabled="true"/></td>
					<td><?php echo _("REMARKS"); ?></td><td><input type="text" id="_pendc_remarks" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><input type="text" id="_pendc_key" disabled="true"/></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="_pendc_fixed" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="_pendc_msisdn" disabled="true"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="_pendc_percent" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="_pendc_priority" disabled="true"/></td>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="_pendc_amountFrom" disabled="true"/></td>
				</tr>
				<tr>					
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><input type="text" id="_pendc_accountFrom" disabled="true"/></td>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="_pendc_amountTo" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><input type="text" id="_pendc_accountTo" disabled="true"/></td>					

					<td><?php echo _("CREATED USER"); ?></td><td><input type="text" id="_pendc_createdUser" disabled="true"/></td>

				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?></td><td><input type="text" id="_pendc_status" disabled="true"/></td>
					<td><?php echo _("CREATED DATE"); ?></td><td><input type="text" id="_pendc_createdDate" disabled="true"/></td>

				</tr>
			</table>
			<div align="right">
		    	<a id="btnCommissionsByMSISDNSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
		        </a>
		        <a id="btnCommissionsByMSISDNCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
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
		$('#dtcommissionsTypePndg,#dtcommissionsMSISDNPndg').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#commissionspndg").fadeIn(700);

	$("#divCommissionsByTypePendingDialog,#divCommissionsByMSISDNPendingDialog").dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnCommissionsByTypeCancel").click(function(){
		$("#divCommissionsByTypePendingDialog").dialog('close');
	});
	$("#btnCommissionsByMSISDNCancel").click(function(){
		$("#divCommissionsByMSISDNPendingDialog").dialog('close');
	});

	function commissionsByTypePending(remarks,id,pndgID,name,key,type,fixed,percent,priority,amountFrom,amountTo,accountFrom,accountTo,createdUser,createdDate,status){
		$("#pendc_remarks").val(remarks);
		$("#pendc_id").val(id);
		$("#pendc_pndgid").val(pndgID);

		$("#pendc_name").val(name);
		$("#pendc_key").val(key);
		$("#pendc_type").val(type);
		$("#pendc_fixed").val(fixed);
		$("#pendc_percent").val(percent);
		$("#pendc_priority").val(priority);
		$("#pendc_amountFrom").val(amountFrom);
		$("#pendc_amountTo").val(amountTo);
		$("#pendc_accountFrom").val(accountFrom);
		$("#pendc_accountTo").val(accountTo);
		$("#pendc_createdUser").val(createdUser);
		$("#pendc_createdDate").val(createdDate);
		var stat = status==0?'Disabled':'Enabled';
		$("#pendc_status").val(stat);
		$("#divCommissionsByTypePendingDialog").dialog('open');
	}

	$("#btnCommissionsByTypeSubmit").click(function(){
		//$('.btypependingloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRejectCommissionsByTypePending',
				remarks:$("#pendc_remarks").val(),
				id:$("#pendc_pndgid").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divCommissionsByTypePendingDialog").dialog('close');
					$("#commissionsTypePndg_"+$("#pendc_pndgid").val()).hide();
				}
				//$('.btypependingloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				//});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function commissionsByMSISDNPending(remarks,id,pndgID,name,key,msisdn,fixed,percent,priority,amountFrom,amountTo,accountFrom,accountTo,createdUser,createdDate,status){
		$("#_pendc_remarks").val(remarks);
		$("#_pendc_id").val(id);
		$("#_pendc_pndgid").val(pndgID);

		$("#_pendc_name").val(name);
		$("#_pendc_key").val(key);
		$("#_pendc_msisdn").val(msisdn);
		$("#_pendc_fixed").val(fixed);
		$("#_pendc_percent").val(percent);
		$("#_pendc_priority").val(priority);
		$("#_pendc_amountFrom").val(amountFrom);
		$("#_pendc_amountTo").val(amountTo);
		$("#_pendc_accountFrom").val(accountFrom);
		$("#_pendc_accountTo").val(accountTo);
		$("#_pendc_createdUser").val(createdUser);
		$("#_pendc_createdDate").val(createdDate);
		var stat = status==0?'Disabled':'Enabled';
		$("#_pendc_status").val(stat);
		$("#divCommissionsByMSISDNPendingDialog").dialog('open');
	}

	$("#btnCommissionsByMSISDNSubmit").click(function(){
		//$('.bmsisdnpendingloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRejectCommissionsByMSISDNPending',
				remarks:$("#_pendc_remarks").val(),
				id:$("#_pendc_pndgid").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divCommissionsByMSISDNPendingDialog").dialog('close');
					$("#commissionsMSISDNPndg_"+$("#_pendc_pndgid").val()).hide();
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