<?php require_once("views.config.properties.php"); ?>
<div id="commissions" style="display:none;">
	<div id="commissionsTabs">
		<ul>
			<li id="commissionsByTypeLink"><a href="#commissionsByTypeTab"><?php echo _("Commissions by Type"); ?></a></li>
			<li id="commissionsByMSISDNLink"><a href="#commissionsByMSISDNTab"><?php echo _("Commissions by MSISDN"); ?></a></li>
		</ul>
		<div id="commissionsByTypeTab">
			<button id="btnAddCommissionsByType" class="uibutton"><?php echo _("Add"); ?></button>
			<div id="_commissionsByType" style="width:100%;font-size:10px;">
				<?php $getCommissionsByType = $this->data("getCommissionsByType");?>
				<?php if(isset($getCommissionsByType->ResponseCode)){ ?>
						<?php if(is_array($getCommissionsByType->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtcommissionsbytype" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("CONFIGURATIONS"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getCommissionsByType->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td width="100%"><?php echo "KEY:(".$t->KEY."), TYPE:(".$t->TYPE."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestCommissionsByType('<?php echo $t->ID."','".$t->KEY."','".$t->TYPE."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->STATUS."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->NAME; ?>');"><?php echo _("Request"); ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found : $getCommissionsByType->Message</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
		<div id="commissionsByMSISDNTab">
			<button id="btnAddCommissionsByMSISDN" class="uibutton"><?php echo _("Add"); ?></button>
			<div id="_commissionsByMSISDN" style="width:100%;font-size:10px;">
				<?php $getCommissionsByMSISDN = $this->data("getCommissionsByMSISDN");?>
				<?php if(isset($getCommissionsByMSISDN->ResponseCode)){ ?>
						<?php if(is_array($getCommissionsByMSISDN->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtcommissionsbymsisdn" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("CONFIGURATIONS"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getCommissionsByMSISDN->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td width="100%"><?php echo "KEY:(".$t->KEY."), MSISDN:(".$t->MSISDN."), FIXED:(".$t->FIXED."), PERCENT:(".$t->PERCENT."), PRIORITY:(".$t->PRIORITY."), AMOUNT FROM:(".$t->AMOUNTFR."), AMOUNT TO:(".$t->AMOUNTTO."), ACCOUNT FROM: (".$t->ACCOUNTFR."), ACCOUNT TO: (".$t->ACCOUNTTO."), NAME:(".$t->NAME.")" ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestCommissionsByMSISDN('<?php echo $t->ID."','".$t->KEY."','".$t->MSISDN."','".$t->FIXED."','".$t->PERCENT."','".$t->PRIORITY."','".$t->STATUS."','".$t->AMOUNTFR."','".$t->AMOUNTTO."','".$t->ACCOUNTFR."','".$t->ACCOUNTTO."','".$t->NAME; ?>');"><?php echo _("Request"); ?></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php } else {
						echo "<h3> No Records Found : $getCommissionsByMSISDN->Message</h3>";
					}?>
				<?php } ?>
			</div>
		</div>
	</div>


<!-- Request dialogs -->
<div id="divCommissionsByTypeRequestDialog" title="<?php echo _("Request Commissions by Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="c_id" disabled="true"/></td>

					<td><?php echo _("NAME"); ?></td><td><input type="text" id="c_name"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="c_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="c_fixed"/></td>
				</tr>
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><select id="c_type"><option value="">Select Type</option></select></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="c_percent"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="c_priority"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="c_status"><option value="0">Disabled</option><option value="1">Enabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="c_amountFrom"/></td>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="c_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="c_amountTo"/></td>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="c_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>

				</tr>
			</table>
			<div align="right">
		    	<a id="btnCommissionsByTypeRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnCommissionsByTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="ctypeloading"></div>
		</div>
	</form>
</div>

<div id="divCommissionsByMSISDNRequestDialog" title="<?php echo _("Request Bonus by MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="_c_id" disabled="true"/></td>

					<td><?php echo _("NAME"); ?></td><td><input type="text" id="_c_name"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="_c_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="_c_fixed"/></td>
				</tr>
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="_c_msisdn"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="_c_percent"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="_c_priority"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="_c_status"><option value="0">Disabled</option><option value="1">Enabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="_c_amountFrom"/></td>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="_c_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="_c_amountTo"/></td>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="_c_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>

				</tr>
			</table>
			<div align="right">
		    	<a id="btnCommissionsByMSISDNRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnCommissionsByMSISDNCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="cmsisdnloading"></div>
		</div>
	</form>
</div>
<!-- Add dialogs -->
<div id="divCommissionsByTypeAddDialog" title="<?php echo _("Add new Commissions by Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>

					<td><?php echo _("NAME"); ?></td><td><input type="text" id="addc_name"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="addc_status" disabled="true"><option>Disabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="addc_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="addc_fixed" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><select id="addc_type"><option value="">Select Type</option></select></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="addc_percent" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="addc_priority" value="0"/></td>



					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="addc_amountFrom" value="1"/></td>

				</tr>
				<tr>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="addc_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="addc_amountTo" value="10"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="addc_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnCommissionsByTypeAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Add"); ?></span>
		        </a>
		        <a id="btnCommissionsByTypeAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="ctypealoading"></div>
		</div>
	</form>
</div>

<div id="divCommissionsByMSISDNAddDialog" title="<?php echo _("Add new Commissions by MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>

					<td><?php echo _("NAME"); ?></td><td><input type="text" id="_addc_name"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select disabled="true"><option>Disabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="_addc_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("FIXED"); ?></td><td><input type="text" id="_addc_fixed" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="_addc_msisdn" value="0"/></td>
					<td><?php echo _("PERCENT"); ?></td><td><input type="text" id="_addc_percent" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="_addc_priority" value="0"/></td>



					<td><?php echo _("AMOUNT FROM"); ?></td><td><input type="text" id="_addc_amountFrom" value="1"/></td>

				</tr>
				<tr>
					<td><?php echo _("ACCOUNT FROM"); ?></td><td><select id="_addc_accountFrom"><option>SENDER</option><option>RECEIVER</option></select></td>
					<td><?php echo _("AMOUNT TO"); ?></td><td><input type="text" id="_addc_amountTo" value="10"/></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT TO"); ?></td><td><select id="_addc_accountTo"><option>SENDER</option><option>RECEIVER</option></select></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnCommissionsByMSISDNAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnCommissionsByMSISDNAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="cmsisdnaloading"></div>
		</div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	loadTable();
	function loadTable(){
		oTable = $('#dtcommissionsbytype,#dtcommissionsbymsisdn').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	};
	$("#commissions").fadeIn(1500);
	$("#commissionsTabs").tabs();

	$("#divCommissionsByTypeAddDialog,#divCommissionsByMSISDNAddDialog,#divCommissionsByTypeRequestDialog,#divCommissionsByMSISDNRequestDialog").dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true
	});

	$("#btnAddCommissionsByType").click(function(){
		$("#divCommissionsByTypeAddDialog").dialog('open');
		key_lists("#addc_key");
		type_lists("#addc_type");
	});
	$("#btnCommissionsByTypeAddCancel").click(function(){
		$("#divCommissionsByTypeAddDialog").dialog('close');
	});
	$("#btnAddCommissionsByMSISDN").click(function(){
		$("#divCommissionsByMSISDNAddDialog").dialog('open');
		key_lists("#_addc_key");
	});
	$("#btnCommissionsByMSISDNAddCancel").click(function(){
		$("#divCommissionsByMSISDNAddDialog").dialog('close');
	});
	$("#btnCommissionsByTypeCancel").click(function(){
		$("#divCommissionsByTypeRequestDialog").dialog('close');
	});
	$("#btnCommissionsByMSISDNCancel").click(function(){
		$("#divCommissionsByMSISDNRequestDialog").dialog('close');
	});

	function requestCommissionsByType(id,key,type,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,name){
		$("#c_id").val(id);
		type_lists("#c_type",type);
		key_lists("#c_key",key);

		$("#c_fixed").val(fixed);
		$("#c_percent").val(percent);
		$("#c_priority").val(priority);
		$("#c_status").val(status);
		$("#c_amountFrom").val(amountFrom);
		$("#c_amountTo").val(amountTo);
		$("#c_accountFrom").val(accountFrom);
		$("#c_accountTo").val(accountTo);
		$("#c_name").val(name);
		$("#divCommissionsByTypeRequestDialog").dialog('open');
	}

	$("#btnCommissionsByTypeRequest").click(function(){
		//$('.ctypeloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestCommissionsByType',
				id:$("#c_id").val(),

				name:$("#c_name").val(),
				key:$("#c_key").val(),
				type:$("#c_type").val(),
				status:$("#c_status").val(),
				priority:$("#c_priority").val(),
				fixedAmount:$("#c_fixed").val(),
				percentAmount:$("#c_percent").val(),				
				amountFrom:$("#c_amountFrom").val(),
				amountTo:$("#c_amountTo").val(),
				accountFrom:$("#c_accountFrom").val(),
				accountTo:$("#c_accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divCommissionsByTypeRequestDialog").dialog('close');
				}
				//$('.ctypeloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				//});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function requestCommissionsByMSISDN(id,key,msisdn,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,name){
		$("#_c_id").val(id);
		key_lists("#_c_key",key);
		$("#_c_msisdn").val(msisdn);

		$("#_c_fixed").val(fixed);
		$("#_c_percent").val(percent);
		$("#_c_priority").val(priority);
		$("#_c_status").val(status);
		$("#_c_amountFrom").val(amountFrom);
		$("#_c_amountTo").val(amountTo);
		$("#_c_accountFrom").val(accountFrom);
		$("#_c_accountTo").val(accountTo);
		$("#_c_name").val(name);
		$("#divCommissionsByMSISDNRequestDialog").dialog('open');
	}

	$("#btnCommissionsByMSISDNRequest").click(function(){
		//$('.cmsisdnloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestCommissionsByMSISDN',
				id:$("#_c_id").val(),

				name:$("#_c_name").val(),
				key:$("#_c_key").val(),
				msisdn:$("#_c_msisdn").val(),
				status:$("#_c_status").val(),
				priority:$("#_c_priority").val(),
				fixedAmount:$("#_c_fixed").val(),
				percentAmount:$("#_c_percent").val(),				
				amountFrom:$("#_c_amountFrom").val(),
				amountTo:$("#_c_amountTo").val(),
				accountFrom:$("#_c_accountFrom").val(),
				accountTo:$("#_c_accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divCommissionsByMSISDNRequestDialog").dialog('close');
				}
				//$('.cmsisdnloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				//});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnCommissionsByTypeAdd").click(function(){
		//$('.ctypealoading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addCommissionsByType',

				name:$("#addc_name").val(),
				key:$("#addc_key").val(),
				type:$("#addc_type").val(),
				fixedAmount:$("#addc_fixed").val(),
				percentAmount:$("#addc_percent").val(),
				priority:$("#addc_priority").val(),
				amountFrom:$("#addc_amountFrom").val(),
				amountTo:$("#addc_amountTo").val(),
				accountFrom:$("#addc_accountFrom").val(),
				accountTo:$("#addc_accountTo").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divCommissionsByTypeAddDialog").dialog('close');
				}
				//$('.ctypealoading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				//});
			}
		});
	});
	$("#btnCommissionsByMSISDNAdd").click(function(){
		//$('.cmsisdnaloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addCommissionsByMSISDN',

				name:$("#_addc_name").val(),
				key:$("#_addc_key").val(),
				msisdn:$("#_addc_msisdn").val(),
				fixedAmount:$("#_addc_fixed").val(),
				percentAmount:$("#_addc_percent").val(),
				priority:$("#_addc_priority").val(),
				amountFrom:$("#_addc_amountFrom").val(),
				amountTo:$("#_addc_amountTo").val(),
				accountFrom:$("#_addc_accountFrom").val(),
				accountTo:$("#_addc_accountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divCommissionsByMSISDNAddDialog").dialog('close');
				}
				//$('.cmsisdnaloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				//});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
</script>