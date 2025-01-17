<?php require_once("views.config.properties.php"); ?>
<div id="keycost" style="display:none;">
	<div class="uitabs">
		<ul>
			<li id="keycostTypeLink"><a href="#keycostTypeTab"><?php echo _("Key Cost Type"); ?></a></li>
			<li id="keycostMSISDNLink"><a href="#keycostMSISDNTab"><?php echo _("Key Cost MSISDN"); ?></a></li>
		</ul>
		<div id="keycostTypeTab">
			<input type="button" id="btnKeyCostTypeAddR" value="Add" class="ui-state-default ui-corner-all ui-button" <?php echo ($this->getRolesConfig('EDIT_KEY_COST_CHARGES')) ? '' : 'style="display:none;"'; ?>>
			<div id="accountsummary" style="width:100%;font-size:10px;">
				<?php $getKeyCostType = $this->data("getKeyCostType");?>
				<?php if(isset($getKeyCostType->ResponseCode)){ ?>
						<?php if(is_array($getKeyCostType->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeycosttype" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("KEY"); ?></th>
								<th><?php echo _("TYPE"); ?></th>
								<th><?php echo _("ACCOUNT"); ?></th>
								<th><?php echo _("FIXED"); ?></th>
								<th><?php echo _("PERCENT"); ?></th>																						
								<th><?php echo _("PRIORITY"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("AMOUNT FROM"); ?></th>
								<th><?php echo _("AMOUNT TO"); ?></th>
								<th><?php echo _("ACCOUNT FROM"); ?></th>
								<th><?php echo _("ACCOUNT TO"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
								<!--<th>SEND</th>							
								<th>RECEIVE</th>-->
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getKeyCostType->Value as $t): $ctr++;?>
									
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td><?php echo $t->KEY; ?></td>
										<td><?php echo $t->TYPE; ?></td>
										<td><?php echo $t->ACCOUNT; ?></td>
										<td><?php echo $t->FIXED; ?></td>
										<td><?php echo $t->PERCENT; ?></td>										
										<td><?php echo $t->PRIORITY; ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><?php echo $t->AMOUNTFR; ?></td>
										<td><?php echo $t->AMOUNTTO; ?></td>
										<td><?php echo $t->ACCOUNTFR; ?></td>
										<td><?php echo $t->ACCOUNTTO; ?></td>
										<td><a href="javascript:requestKeyCostType('<?php echo $t->KEY . "','" . $t->TYPE . "','". $t->ACCOUNT . "','" . $t->FIXED . "','" . $t->PERCENT . "','" . $t->PRIORITY . "','" . $t->STATUS . "','','','" . $t->AMOUNTFR . "','" . $t->AMOUNTTO. "','" . $t->ACCOUNTFR . "','" . $t->ACCOUNTTO . "','"  . $t->ID; ?>');" <?php echo ($this->getRolesConfig('EDIT_KEY_COST_CHARGES')) ? '' : 'style="display:none;"'; ?>><?php echo _("Request"); ?></a>
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

		<div id="keycostMSISDNTab">
			<input type="button" id="btnKeyCostMSISDNAddR" value="Add" class="ui-state-default ui-corner-all ui-button" <?php echo ($this->getRolesConfig('EDIT_KEY_COST_CHARGES')) ? '' : 'style="display:none;"'; ?>>
			<div style="width:100%;font-size:10px;">
				<?php $getKeyCostMSISDN = $this->data("getKeyCostMSISDN");?>
				<?php if(isset($getKeyCostMSISDN->ResponseCode)){ ?>
						<?php if(is_array($getKeyCostMSISDN->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeycostmsisdn" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("KEY"); ?></th>
								<th><?php echo _("MSISDN"); ?></th>
								<th><?php echo _("ACCOUNT"); ?></th>
								<th><?php echo _("FIXED"); ?></th>
								<th><?php echo _("PERCENT"); ?></th>																						
								<th><?php echo _("PRIORITY"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("AMOUNT FROM"); ?></th>
								<th><?php echo _("AMOUNT TO"); ?></th>
								<th><?php echo _("ACCOUNT FROM"); ?></th>
								<th><?php echo _("ACCOUNT TO"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
								<!--<th>SEND</th>							
								<th>RECEIVE</th>-->
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getKeyCostMSISDN->Value as $t): $ctr++;?>
									
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td><?php echo $t->KEY; ?></td>
										<td><?php echo $t->MSISDN; ?></td>
										<td><?php echo $t->ACCOUNT; ?></td>
										<td><?php echo $t->FIXED; ?></td>
										<td><?php echo $t->PERCENT; ?></td>										
										<td><?php echo $t->PRIORITY; ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><?php echo $t->AMOUNTFR; ?></td>
										<td><?php echo $t->AMOUNTTO; ?></td>
										<td><?php echo $t->ACCOUNTFR; ?></td>
										<td><?php echo $t->ACCOUNTTO; ?></td>
										<td><a href="javascript:requestKeyCostMSISDN('<?php echo $t->KEY . "','" . $t->MSISDN . "','". $t->ACCOUNT . "','" . $t->FIXED . "','" . $t->PERCENT . "','" . $t->PRIORITY . "','" . $t->STATUS . "','" . $t->AMOUNTFR . "','" . $t->AMOUNTTO. "','" . $t->ACCOUNTFR . "','" . $t->ACCOUNTTO . "','"  . $t->ID; ?>');" <?php echo ($this->getRolesConfig('EDIT_KEY_COST_CHARGES')) ? '' : 'style="display:none;"'; ?>><?php echo _("Request"); ?></a>
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


<!-- ui-dialog key cost type -->
<div id="dialogKeyCostType" title="<?php echo _("Request Key Cost Type"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("ID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctID"  id="kctID" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="kctKey"><option value="">Select Key</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Type"); ?><span style="color:red">*</span>:</td><td><select id="kctType"><option value="">Select Type</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Account"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctAccount"  id="kctAccount" disabled="disabled"></td>						
		</tr>
		<tr>
			<td><?php echo _("Fixed"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctFixed"  id="kctFixed" ></td>
		</tr>
		<tr>
			<td><?php echo _("Percent"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctPercent" id="kctPercent" ></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctPriority" id="kctPriority" ></td>
		</tr>
		<tr>
			<td><?php echo _("Status"); ?><span style="color:red">*</span>:</td><td><select id="kctStatus"><option value="1">Enable</option><option value="0">Disable</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Amount From"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctAmountFr" id="kctAmountFr"></td>						
		</tr>	
		<tr>
			<td><?php echo _("Amount To"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kctAmountTo" id="kctAmountTo"></td>						
		</tr>
		<tr>
			<td><?php echo _("Account From"); ?><span style="color:red">*</span>:</td><td><select name="kctAccountFr" id="kctAccountFr"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="kctAccountFr" id="kctAccountFr"> --></td>						
		</tr>
		<tr>
			<td><?php echo _("Account To"); ?><span style="color:red">*</span>:</td><td><select name="kctAccountFr" id="kctAccountTo"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="kctAccountFr" id="kctAccountFr"> --></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnKeyCostTypeRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnKeyCostTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
        </a>                    
	</div><div class="kctloading"></div>
</div>
<!-- end ui-dialog key cost type -->
<!-- ui-dialog key cost type add -->
<div id="dialogKeyCostTypeAdd" title="<?php echo _("Add Key Cost Type"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="addKey"><option value="">Select Key</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Type"); ?><span style="color:red">*</span>:</td><td><select id="addType"><option value="">Select Type</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Account"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAccount"  id="addAccount"></td>						
		</tr>
		<tr>
			<td><?php echo _("Fixed"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addFixed"  id="addFixed" value="1"></td>
		</tr>
		<tr>
			<td><?php echo _("Percent"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addPercent" id="addPercent" value="0"></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addPriority" id="addPriority" value="0"></td>
		</tr>					
		<tr>
			<td><?php echo _("Amount From"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountFr" id="addAmountFr" value="1"></td>						
		</tr>	
		<tr>
			<td><?php echo _("Amount To"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountTo" id="addAmountTo" value="10"></td>						
		</tr>
		<tr>
			<td><?php echo _("Account From"); ?><span style="color:red">*</span>:</td><td><select name="addAccountFr" id="addAccountFr"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="addAccountFr" id="addAccountFr" value="SENDER"> --></td>						
		</tr>
		<tr>
			<td><?php echo _("Account To"); ?><span style="color:red">*</span>:</td><td><select name="addAccountFr" id="addAccountTo"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="addAccountFr" id="addAccountFr" value="SENDER"> --></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnKeyCostTypeAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Add"); ?></span>
        </a>
        <a id="btnKeyCostTypeCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
        </a>                    
	</div><div class="addloading"></div>
</div>

<div id="dialogKeyCostMSISDNAdd" title="<?php echo _("Add Key Cost MSISDN"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="addMKey"><option value="">Select Key</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("MSISDN"); ?><span style="color:red">*</span>:</td><td><input type="text" id="addMMSISDN"/></td>
		</tr>
		<tr>
			<td><?php echo _("Account"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAccount"  id="addMAccount"></td>						
		</tr>
		<tr>
			<td><?php echo _("Fixed"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addFixed"  id="addMFixed" value="1"></td>
		</tr>
		<tr>
			<td><?php echo _("Percent"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addPercent" id="addMPercent" value="0"></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addPriority" id="addMPriority" value="0"></td>
		</tr>					
		<tr>
			<td><?php echo _("Amount From"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountFr" id="addMAmountFr" value="1"></td>						
		</tr>	
		<tr>
			<td><?php echo _("Amount To"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountTo" id="addMAmountTo" value="10"></td>						
		</tr>
		<tr>
			<td><?php echo _("Account From"); ?><span style="color:red">*</span>:</td><td><select name="addAccountFr" id="addMAccountFr"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="addAccountFr" id="addAccountFr" value="SENDER"> --></td>						
		</tr>
		<tr>
			<td><?php echo _("Account To"); ?><span style="color:red">*</span>:</td><td><select name="addAccountFr" id="addMAccountTo"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="addAccountFr" id="addAccountFr" value="SENDER"> --></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnKeyCostMSISDNAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Add"); ?></span>
        </a>
        <a id="btnKeyCostMSISDNCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div><div class="addloading"></div>
</div>

<div id="dialogKeyCostMSISDN" title="<?php echo _("Request Key Cost MSISDN"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("ID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmID"  id="kcmID" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="kcmKey"><option value="">Select Key</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("MSISDN"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmMSISDN"  id="kcmMSISDN"/></td>
		</tr>
		<tr>
			<td><?php echo _("Account"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmAccount"  id="kcmAccount" disabled="disabled"></td>						
		</tr>
		<tr>
			<td><?php echo _("Fixed"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmFixed"  id="kcmFixed" ></td>
		</tr>
		<tr>
			<td><?php echo _("Percent"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmPercent" id="kcmPercent" ></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmPriority" id="kcmPriority" ></td>
		</tr>
		<tr>
			<td><?php echo _("Status"); ?><span style="color:red">*</span>:</td><td><select id="kcmStatus"><option value="1">Enable</option><option value="0">Disable</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Amount From"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmAmountFr" id="kcmAmountFr"></td>						
		</tr>	
		<tr>
			<td><?php echo _("Amount To"); ?><span style="color:red">*</span>:</td><td><input type="text" name="kcmAmountTo" id="kcmAmountTo"></td>						
		</tr>
		<tr>
			<td><?php echo _("Account From"); ?><span style="color:red">*</span>:</td><td><select name="kcmAccountFr" id="kcmAccountFr"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="kctAccountFr" id="kctAccountFr"> --></td>						
		</tr>
		<tr>
			<td><?php echo _("Account To"); ?><span style="color:red">*</span>:</td><td><select name="kcmAccountFr" id="kcmAccountTo"><option value="SENDER">SENDER</option><option value="RECEIVER">RECEIVER</option></select><!-- <input type="text" name="kctAccountFr" id="kctAccountFr"> --></td>						
		</tr>		
	</table>
	<div align="right">
    	<a id="btnKeyCostMSISDNRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnKeyCostMSISDNRCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div><div class="kctloading"></div>
</div>

</div>
<!-- end ui-dialog key cost type add -->
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript" src="../../Views/js/registerupdate.js"></script>
<script type="text/javascript" src="../../Views/js/systemsettings.js"></script>
<script type="text/javascript">
	$(function(){
		oTable = $('#dtkeycosttype,#dtkeycostmsisdn').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#keycost").fadeIn(700);

	// Dialog
	$('#dialogKeyCostType,#dialogKeyCostTypeAdd,#dialogKeyCostMSISDNAdd,#dialogKeyCostMSISDN').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnKeyCostMSISDNAddR").click(function(){
		$("#addMMSISDN").val('');
		key_lists("#addMKey");
		$("#dialogKeyCostMSISDNAdd").dialog('open');
	});
	$("#btnKeyCostMSISDNCancelAdd").click(function(){
		$("#dialogKeyCostMSISDNAdd").dialog('close');
	});
	$("#btnKeyCostMSISDNRCancel").click(function(){
		$("#dialogKeyCostMSISDN").dialog('close');
	});
	
	function requestKeyCostType(strkey, strtype, straccount, strfixed, strpercent, strpriority, strstatus, strsend, strreceive, stramountfr, stramountto, straccountfr, straccountto, strid){
		$('#dialogKeyCostType').dialog('open');
		key_lists("#kctKey",strkey);
		type_lists("#kctType",strtype);
		$("#kctAccount").val(straccount);
		$("#kctFixed").val(strfixed);
		$("#kctPercent").val(strpercent);
		$("#kctPriority").val(strpriority);
		$("#kctStatus").val(strstatus);
		$("#kctAmountFr").val(stramountfr);
		$("#kctAmountTo").val(stramountto);
		$("#kctAccountFr").val(straccountfr);
		$("#kctAccountTo").val(straccountto);
		$("#kctID").val(strid);
	}
	
	$("#btnKeyCostTypeCancel").click(function(){
				 $('#dialogKeyCostType').dialog('close');	
	});

	$("#btnKeyCostTypeCancelAdd").click(function(){
				 $('#dialogKeyCostTypeAdd').dialog('close');	
	});

	$("#btnKeyCostTypeAddR").click(function(){
		$('#dialogKeyCostTypeAdd').dialog('open');
		key_lists("#addKey");
		type_lists("#addType");	
	});
	
	$("#btnKeyCostTypeRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'updateKeyCostType',
				id:$("#kctID").val(),
				key:$("#kctKey").val(),
				type:$("#kctType").val(),
				account:$("#kctAccount").val(),
				fixed:$("#kctFixed").val(),
				percent:$("#kctPercent").val(),
				priority:$("#kctPriority").val(),
				status:$("#kctStatus").val(),
				amountFrom:$("#kctAmountFr").val(),
				amountTo:$("#kctAmountTo").val(),
				accountFrom:$("#kctAccountFr").val(),
				accountTo:$("#kctAccountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$('#dialogKeyCostType').dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	$("#btnKeyCostTypeAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addKeyCostType',
				key:$("#addKey").val(),
				type:$("#addType").val(),
				account:$("#addAccount").val(),
				fixed:$("#addFixed").val(),
				percent:$("#addPercent").val(),
				priority:$("#addPriority").val(),
				amountFrom:$("#addAmountFr").val(),
				amountTo:$("#addAmountTo").val(),
				accountFrom:$("#addAccountFr").val(),
				accountTo:$("#addAccountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogKeyCostTypeAdd").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnKeyCostMSISDNAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addKeyCostMSISDN',
				key:$("#addMKey").val(),
				msisdn:$("#addMMSISDN").val(),
				account:$("#addMAccount").val(),
				fixed:$("#addMFixed").val(),
				percent:$("#addMPercent").val(),
				priority:$("#addMPriority").val(),
				amountFrom:$("#addMAmountFr").val(),
				amountTo:$("#addMAmountTo").val(),
				accountFrom:$("#addMAccountFr").val(),
				accountTo:$("#addMAccountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogKeyCostMSISDNAdd").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function requestKeyCostMSISDN(key,msisdn,account,fixed,percent,priority,status,amountFrom,amountTo,accountFrom,accountTo,id){
		$('#dialogKeyCostMSISDN').dialog('open');
		key_lists("#kcmKey",key);
		$("#kcmMSISDN").val(msisdn);
		$("#kcmAccount").val(account);
		$("#kcmFixed").val(fixed);
		$("#kcmPercent").val(percent);
		$("#kcmPriority").val(priority);
		$("#kcmStatus").val(status);
		$("#kcmAmountFr").val(amountFrom);
		$("#kcmAmountTo").val(amountTo);
		$("#kcmAccountFr").val(accountFrom);
		$("#kcmAccountTo").val(accountTo);
		$("#kcmID").val(id);
	}
	$("#btnKeyCostMSISDNRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestKeyCostMSISDN',
				id:$("#kcmID").val(),
				key:$("#kcmKey").val(),
				msisdn:$("#kcmMSISDN").val(),
				account:$("#kcmAccount").val(),
				fixed:$("#kcmFixed").val(),
				percent:$("#kcmPercent").val(),
				priority:$("#kcmPriority").val(),
				status:$("#kcmStatus").val(),
				amountFrom:$("#kcmAmountFr").val(),
				amountTo:$("#kcmAmountTo").val(),
				accountFrom:$("#kcmAccountFr").val(),
				accountTo:$("#kcmAccountTo").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$('#dialogKeyCostMSISDN').dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

</script>