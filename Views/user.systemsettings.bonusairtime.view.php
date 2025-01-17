<?php require_once("views.config.properties.php"); ?>
<div id="bonusairtime" style="display:none;">	
	<div id="bonusairtimeTabs">
		<ul>
			<li id="bonusairtimeByTypeLink"><a href="#bonusairtimeByTypeTab"><?php echo _("Bonus Airtime by Type"); ?></a></li>
			<li id="bonusairtimeByMSISDNLink"><a href="#bonusairtimeByMSISDNTab"><?php echo _("Bonus Airtime by MSISDN"); ?></a></li>
		</ul>
		<div id="bonusairtimeByTypeTab">
			<button type="button" id="btnAddBonusairtimeByType" class="uibutton"><?php echo _("Add"); ?></button>
			<div id="_bonusairtimeByType" style="width:100%;font-size:10px;">
				<?php $getBonusairtimeByType = $this->data("getBonusairtimeByType");?>
				<?php if(isset($getBonusairtimeByType->ResponseCode)){ ?>
						<?php if(is_array($getBonusairtimeByType->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtbonusairtimebytype" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("CONFIGURATIONS"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getBonusairtimeByType->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td width="100%"><?php echo "KEY:(".$t->KEY."), TYPE:(".$t->TYPE."), ACCOUNT:(".$t->ACCOUNT."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestBonusairtimeByType('<?php echo $t->ID."','".$t->KEY."','".$t->TYPE."','".$t->ACCOUNT."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->STATUS."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->NAME; ?>');"><?php echo _("Request"); ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found : $getBonusairtimeByType->Message</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
		
		<div id="bonusairtimeByMSISDNTab">
			<button id="requestBonusairtimeByType" class="uibutton"><?php echo _("Add"); ?></button>
			<div id="_bonusairtimeByMSISDN" style="width:100%;font-size:10px;">
				<?php $getBonusairtimeByMSISDN = $this->data("getBonusairtimeByMSISDN");?>
				<?php if(isset($getBonusairtimeByMSISDN->ResponseCode)){ ?>
						<?php if(is_array($getBonusairtimeByMSISDN->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtbonusairtimebymsisdn" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("CONFIGURATIONS"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getBonusairtimeByMSISDN->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td width="100%"><?php echo "KEY:(".$t->KEY."), MSISDN:(".$t->MSISDN."), ACCOUNT:(".$t->ACCOUNT."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestBonusairtimeByMSISDN('<?php echo $t->ID."','".$t->KEY."','".$t->MSISDN."','".$t->ACCOUNT."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->STATUS."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->NAME; ?>');"><?php echo _("Request"); ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found : $getBonusairtimeByMSISDN->Message</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
	</div>


<div id="divBonusairtimeByTypeRequestDialog" title="<?php echo _("Request Bonus Airtime by Type"); ?>">
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
		    	<a id="btnBonusairtimeByTypeRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnBonusairtimeByTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="btypeloading"></div>
		</div>
	</form>
</div>
<div id="divBonusairtimeByMSISDNRequestDialog" title="<?php echo _("Request Bonus Airtime by MSISDN"); ?>">
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
		    	<a id="btnBonusairtimeByMSISDNRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnBonusairtimeByMSISDNCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="bmsisdnloading"></div>
		</div>
	</form>
</div>

<!-- Add dialogs -->
<div id="divBonusairtimeByTypeAddDialog" title="<?php echo _("Add new Bonus Airtime by Type"); ?>">
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
		    	<a id="btnBonusairtimeByTypeAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Add"); ?></span>
		        </a>
		        <a id="btnBonusairtimeByTypeAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="btypealoading"></div>
		</div>
	</form>
</div>

<div id="divBonusairtimeByMSISDNAddDialog" title="<?php echo _("Add new Bonus Airtime by MSISDN"); ?>">
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
		    	<a id="btnBonusairtimeByMSISDNAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnBonusairtimeByMSISDNAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
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
		oTable = $('#dtbonusairtimebytype,#dtbonusairtimebymsisdn').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	};
	$("#bonusairtime").fadeIn(1500);
	$("#bonusairtimeTabs").tabs();

	$('#divBonusairtimeByTypeRequestDialog,#divBonusairtimeByMSISDNRequestDialog,#divBonusairtimeByTypeAddDialog,#divBonusairtimeByMSISDNAddDialog').dialog({
		autoOpen: false,
		width: 800,
		draggable: false,
		resizable: false,
		modal:true
	});
	$("#btnBonusairtimeByTypeCancel").click(function(){
		$("#divBonusairtimeByTypeRequestDialog").dialog('close');
	});
	$("#btnBonusairtimeByMSISDNCancel").click(function(){
		$("#divBonusairtimeByMSISDNRequestDialog").dialog('close');
	});
	$("#btnAddBonusairtimeByType").click(function(){
		$("#divBonusairtimeByTypeAddDialog").dialog('open');
		key_lists("#add_key");
		type_lists("#add_type");
	});
	$("#btnBonusairtimeByTypeAddCancel").click(function(){
		$("#divBonusairtimeByTypeAddDialog").dialog('close');
	});
	$("#requestBonusairtimeByType").click(function(){
		$("#divBonusairtimeByMSISDNAddDialog").dialog('open');
		key_lists("#_add_key");

	});
	$("#btnBonusairtimeByMSISDNAddCancel").click(function(){
		$("#divBonusairtimeByMSISDNAddDialog").dialog('close');
	});

	function requestBonusairtimeByType(id,key,type,account,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,name){
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
		$('#divBonusairtimeByTypeRequestDialog').dialog('open');
	}

	$("#btnBonusairtimeByTypeRequest").click(function(){
		$('.btypeloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestBonusAirByType',
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
					$("#divBonusairtimeByTypeRequestDialog").dialog('close');
				}
				$('.btypeloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});	

	function requestBonusairtimeByMSISDN(id,key,msisdn,account,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,name){
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
		$("#divBonusairtimeByMSISDNRequestDialog").dialog('open');
	}

	$("#btnBonusairtimeByMSISDNRequest").click(function(){
		$('.bmsisdnloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestBonusAirByMSISDN',
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
					$("#divBonusairtimeByMSISDNRequestDialog").dialog('close');
				}
				$('.bmsisdnloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});	

	$("#btnBonusairtimeByTypeAdd").click(function(){
		$('.btypealoading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addBonusAirByType',
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
				accountTo:$("#add_accountTo").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divBonusairtimeByTypeAddDialog").dialog('close');
				}
				$('.btypealoading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}
		});
	});

	$("#btnBonusairtimeByMSISDNAdd").click(function(){
		$('.bmsisdnaloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addBonusAirByMSISDN',
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
					$("#divBonusairtimeByMSISDNAddDialog").dialog('close');
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