<?php require_once("views.config.properties.php"); ?>
<div id="bonus" style="display:none;">	
	<div id="bonusTabs">
		<ul>
			<li id="bonusByTypeLink"><a href="#bonusByTypeTab"><?php echo _("Bonus by Type"); ?></a></li>
			<li id="bonusByMSISDNLink"><a href="#bonusByMSISDNTab"><?php echo _("Bonus by MSISDN"); ?></a></li>
		</ul>
		<div id="bonusByTypeTab">
			<button type="button" id="btnAddBonusByType" class="uibutton"><?php echo _("Add"); ?></button>
			<div id="_bonusByType" style="width:100%;font-size:10px;">
				<?php $getBonusByType = $this->data("getBonusByType");?>
				<?php if(isset($getBonusByType->ResponseCode)){ ?>
						<?php if(is_array($getBonusByType->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtbonusbytype" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("CONFIGURATIONS"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getBonusByType->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td width="100%"><?php echo "KEY:(".$t->KEY."), TYPE:(".$t->TYPE."), ACCOUNT:(".$t->ACCOUNT."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestBonusByType('<?php echo $t->ID."','".$t->KEY."','".$t->TYPE."','".$t->ACCOUNT."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->STATUS."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->NAME; ?>');"><?php echo _("Request"); ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found : $getBonusByType->Message</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
		
		<div id="bonusByMSISDNTab">
			<button id="btnAddBonusByMSISDN" class="uibutton"><?php echo _("Add"); ?></button>
			<div id="_bonusByMSISDN" style="width:100%;font-size:10px;">
				<?php $getBonusByMSISDN = $this->data("getBonusByMSISDN");?>
				<?php if(isset($getBonusByMSISDN->ResponseCode)){ ?>
						<?php if(is_array($getBonusByMSISDN->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtbonusbymsisdn" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("CONFIGURATIONS"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getBonusByMSISDN->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td width="100%"><?php echo "KEY:(".$t->KEY."), MSISDN:(".$t->MSISDN."), ACCOUNT:(".$t->ACCOUNT."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestBonusByMSISDN('<?php echo $t->ID."','".$t->KEY."','".$t->MSISDN."','".$t->ACCOUNT."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->STATUS."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->NAME; ?>');"><?php echo _("Request"); ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found : $getBonusByMSISDN->Message</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
	</div>


<div id="divBonusByTypeRequestDialog" title="<?php echo _("Request Bonus by Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="id" disabled="true"/></td>
					<td><?php echo _("ACCOUNT"); ?></td><td><input type="text" id="account"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="fixed"/></td>
				</tr>
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><select id="type"><option value="">Select Type</option></select></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="percent"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="priority"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="status"><option value="0">Disabled</option><option value="1">Enabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="amountFrom"/></td>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="amountTo"/></td>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("NAME"); ?></td><td><input type="text" id="name"/></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnBonusByTypeRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnBonusByTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="btypeloading"></div>
		</div>
	</form>
</div>
<div id="divBonusByMSISDNRequestDialog" title="<?php echo _("Request Bonus by MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="_id" disabled="true"/></td>
					<td><?php echo _("ACCOUNT"); ?></td><td><input type="text" id="_account"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="_fixed"/></td>
				</tr>
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="_msisdn"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="_percent"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="_priority"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="_status"><option value="0">Disabled</option><option value="1">Enabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="_amountFrom"/></td>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="_amountTo"/></td>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("NAME"); ?></td><td><input type="text" id="_name"/></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnBonusByMSISDNRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnBonusByMSISDNCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="bmsisdnloading"></div>
		</div>
	</form>
</div>

<!-- Add dialogs -->
<div id="divBonusByTypeAddDialog" title="<?php echo _("Add new Bonus by Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" name="bonusByTypeAdd" id="bonusByTypeAdd" class="tablet">
				<tr>
					<td><?php echo _("ACCOUNT"); ?></td><td><input type="text" id="add_account"/></td>
					<td><?php echo _("NAME"); ?></td><td><input type="text" id="add_name"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="add_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="add_fixed" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><select id="add_type"><option value="">Select Type</option></select></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="add_percent" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="add_priority" value="0"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="add_status" disabled="true"><option>Disabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="add_amountFrom" value="1"/></td>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="add_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="add_amountTo" value="10"/></td>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="add_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnBonusByTypeAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Add"); ?></span>
		        </a>
		        <a id="btnBonusByTypeAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="btypealoading"></div>
		</div>
	</form>
</div>

<div id="divBonusByMSISDNAddDialog" title="<?php echo _("Add new Bonus by MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ACCOUNT"); ?></td><td><input type="text" id="_add_account"/></td>
					<td><?php echo _("NAME"); ?></td><td><input type="text" id="_add_name"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="_add_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="_add_fixed" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="_add_msisdn" value="0"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="_add_percent" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="_add_priority" value="0"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select disabled="true"><option>Disabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="_add_amountFrom" value="1"/></td>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="_add_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="_add_amountTo" value="10"/></td>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="_add_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnBonusByMSISDNAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnBonusByMSISDNAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="bmsisdnaloading"></div>
		</div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript" charset="utf-8">
	loadTable();
	function loadTable(){
		oTable = $('#dtbonusbytype,#dtbonusbymsisdn').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	};
	$("#bonus").fadeIn(1500);
	$("#bonusTabs").tabs();

	$('#divBonusByTypeRequestDialog,#divBonusByMSISDNRequestDialog,#divBonusByTypeAddDialog,#divBonusByMSISDNAddDialog').dialog({
		autoOpen: false,
		width: 800,
		draggable: false,
		resizable: false,
		modal:true
	});
	$("#btnBonusByTypeCancel").click(function(){
		$("#divBonusByTypeRequestDialog").dialog('close');
	});
	$("#btnBonusByMSISDNCancel").click(function(){
		$("#divBonusByMSISDNRequestDialog").dialog('close');
	});
	$("#btnAddBonusByType").click(function(){
		$("#divBonusByTypeAddDialog").dialog('open');
		key_lists("#add_key");
		type_lists("#add_type");
	});
	$("#btnBonusByTypeAddCancel").click(function(){
		$("#divBonusByTypeAddDialog").dialog('close');
	});
	$("#btnAddBonusByMSISDN").click(function(){
		$("#divBonusByMSISDNAddDialog").dialog('open');
		key_lists("#_add_key");

	});
	$("#btnBonusByMSISDNAddCancel").click(function(){
		$("#divBonusByMSISDNAddDialog").dialog('close');
	});

	function requestBonusByType(id,key,type,account,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,name){
		$("#id").val(id);
		type_lists("#type",type);
		key_lists("#key",key);
		$("#account").val(account);
		$("#fixed").val(fixed);
		$("#percent").val(percent);
		$("#priority").val(priority);
		$("#status").val(status);
		$("#amountFrom").val(amountFrom);
		$("#amountTo").val(amountTo);
		$("#accountFrom").val(accountFrom);
		$("#accountTo").val(accountTo);
		$("#name").val(name);
		$('#divBonusByTypeRequestDialog').dialog('open');
	}

	$("#btnBonusByTypeRequest").click(function(){
		$('.btypeloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestBonusByType',
				id:$("#id").val(),
				account:$("#account").val(),
				name:$("#name").val(),
				key:$("#key").val(),
				type:$("#type").val(),
				status:$("#status").val(),
				priority:$("#priority").val(),
				fixedAmount:$("#fixed").val(),
				percentAmount:$("#percent").val(),				
				amountFrom:$("#amountFrom").val(),
				amountTo:$("#amountTo").val(),
				accountFrom:$("#accountFrom").val(),
				accountTo:$("#accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusByTypeRequestDialog").dialog('close');
				}
				$('.btypeloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});	

	function requestBonusByMSISDN(id,key,msisdn,account,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,name){
		$("#_id").val(id);
		key_lists("#_key",key);
		$("#_msisdn").val(msisdn);
		$("#_account").val(account);
		$("#_fixed").val(fixed);
		$("#_percent").val(percent);
		$("#_priority").val(priority);
		$("#_status").val(status);
		$("#_amountFrom").val(amountFrom);
		$("#_amountTo").val(amountTo);
		$("#_accountFrom").val(accountFrom);
		$("#_accountTo").val(accountTo);
		$("#_name").val(name);
		$("#divBonusByMSISDNRequestDialog").dialog('open');
	}

	$("#btnBonusByMSISDNRequest").click(function(){
		$('.bmsisdnloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestBonusByMSISDN',
				id:$("#_id").val(),
				account:$("#_account").val(),
				name:$("#_name").val(),
				key:$("#_key").val(),
				msisdn:$("#_msisdn").val(),
				status:$("#_status").val(),
				priority:$("#_priority").val(),
				fixedAmount:$("#_fixed").val(),
				percentAmount:$("#_percent").val(),				
				amountFrom:$("#_amountFrom").val(),
				amountTo:$("#_amountTo").val(),
				accountFrom:$("#_accountFrom").val(),
				accountTo:$("#_accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusByMSISDNRequestDialog").dialog('close');
				}
				$('.bmsisdnloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});	

	$("#btnBonusByTypeAdd").click(function(){
		$('.btypealoading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addBonusByType',
				account:$("#add_account").val(),
				name:$("#add_name").val(),
				key:$("#add_key").val(),
				type:$("#add_type").val(),
				fixedAmount:$("#add_fixed").val(),
				percentAmount:$("#add_percent").val(),
				priority:$("#add_priority").val(),
				amountFrom:$("#add_amountFrom").val(),
				amountTo:$("#add_amountTo").val(),
				accountFrom:$("#add_accountFrom").val(),
				accountTo:$("#add_accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusByTypeAddDialog").dialog('close');
				}
				$('.btypealoading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnBonusByMSISDNAdd").click(function(){
		$('.bmsisdnaloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addBonusByMSISDN',
				account:$("#_add_account").val(),
				name:$("#_add_name").val(),
				key:$("#_add_key").val(),
				msisdn:$("#_add_msisdn").val(),
				fixedAmount:$("#_add_fixed").val(),
				percentAmount:$("#_add_percent").val(),
				priority:$("#_add_priority").val(),
				amountFrom:$("#_add_amountFrom").val(),
				amountTo:$("#_add_amountTo").val(),
				accountFrom:$("#_add_accountFrom").val(),
				accountTo:$("#_add_accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusByMSISDNAddDialog").dialog('close');
				}
				$('.bmsisdnaloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
</script>