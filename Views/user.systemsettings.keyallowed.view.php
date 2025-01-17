<?php require_once("views.config.properties.php"); ?>
<div id="keyallowed" style="display:none;">
	<div class="uitabs">
		<ul>
			<li id="keyAllowedTypeTabLink"><a href="#keyAllowedTypeTab"><?php echo _("Key allowed Type"); ?></a></li>
			<li id="keyAllowedMSISDNTabLink"><a href="#keyAllowedMSISDNTab"><?php echo _("Key allowed MSISDN"); ?></a></li>
		</ul>
		<div id="keyAllowedTypeTab">
			<?php if($this->getRolesConfig('EDIT_KEY_ALLOWED_MSISDN_TYPE')){ ?>
			<button type="button" id="btnAddKeyAllowedType" class="uibutton"><?php echo _("Add"); ?></button>
			<?php } ?>
			<div style="width:100%;font-size:10px;">
				<?php $getKeyAllowedType = $this->data("getKeyAllowedType");?>
				<?php if(isset($getKeyAllowedType->ResponseCode)){ ?>
						<?php if(is_array($getKeyAllowedType->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeyallowedtype" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("TYPE"); ?></th>
								<th><?php echo _("KEY"); ?></th>
								<th><?php echo _("SEND"); ?></th>
								<th><?php echo _("RECEIVE"); ?></th>								
								<th><?php echo _("DESCRIPTION"); ?></th>
								<th><?php echo _("PRIORITY"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getKeyAllowedType->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td><?php echo $t->TYPE; ?></td>
										<td><?php echo $t->KEY; ?></td>
										<td><?php echo $t->SEND==0?'NO':'YES'; ?></td>
										<td><?php echo $t->RECEIVE==0?'NO':'YES'; ?></td>
										<td><?php echo $t->DESCRIPTION; ?></td>
										<td><?php echo $t->PRIORITY; ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestKeyAllowedType('<?php echo $t->ID."','".$t->TYPE."','".$t->KEY."','".$t->SEND."','".$t->RECEIVE."','".$t->DESCRIPTION."','".$t->PRIORITY."','".$t->STATUS; ?>');"><?php echo _("Request"); ?></a>
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
		<div id="keyAllowedMSISDNTab">
			<?php if($this->getRolesConfig('EDIT_KEY_ALLOWED_MSISDN_TYPE')){ ?>
			<button type="button" id="btnAddKeyAllowedMSISDN" class="uibutton"><?php echo _("Add"); ?></button>
			<?php } ?>
			<div style="width:100%;font-size:10px;">
				<?php $getKeyAllowedMSISDN = $this->data("getKeyAllowedMSISDN");?>
				<?php if(isset($getKeyAllowedMSISDN->ResponseCode)){ ?>
						<?php if(is_array($getKeyAllowedMSISDN->Value)){?>
						<div style="margin-top:10px"></div>
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeyallowedmsisdn" width="100%">
							<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("ID"); ?></th>
								<th><?php echo _("MSISDN"); ?></th>
								<th><?php echo _("KEY"); ?></th>
								<th><?php echo _("SEND"); ?></th>
								<th><?php echo _("RECEIVE"); ?></th>								
								<th><?php echo _("DESCRIPTION"); ?></th>
								<th><?php echo _("PRIORITY"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("EDIT REQUEST"); ?></th>
							</tr>
							</thead>
							<tbody>
								<?php $ctr=0; foreach($getKeyAllowedMSISDN->Value as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->ID; ?></td>
										<td><?php echo $t->MSISDN; ?></td>
										<td><?php echo $t->KEY; ?></td>
										<td><?php echo $t->SEND==0?'NO':'YES'; ?></td>
										<td><?php echo $t->RECEIVE==0?'NO':'YES'; ?></td>										
										<td><?php echo $t->DESCRIPTION; ?></td>
										<td><?php echo $t->PRIORITY; ?></td>
										<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
										<td><a href="javascript:requestKeyAllowedMSISDN('<?php echo $t->ID."','".$t->MSISDN."','".$t->KEY."','".$t->SEND."','".$t->RECEIVE."','".$t->DESCRIPTION."','".$t->PRIORITY."','".$t->STATUS; ?>');"><?php echo _("Request"); ?></a>
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


<!-- Dialogs -->
<div id="divKeyAllowedTypeRequestDialog" title="<?php echo _("Request Key Allowed Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="reqKAT_id" disabled="true"/></td>
					<td><?php echo _("TYPE"); ?></td><td><select id="reqKAT_type"><option value="">Select Type</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="reqKAT_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="reqKAT_priority"/></td>
				</tr>
				<tr>
					<td><?php echo _("SEND"); ?></td><td><select id="reqKAT_send"><option value="0">NO</option><option value="1">YES</option></select></td>
					<td><?php echo _("RECEIVE"); ?></td><td><select id="reqKAT_receive"><option value="0">NO</option><option value="1">YES</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("DESCRIPTION"); ?></td><td><input type="text" id="reqKAT_description"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="reqKAT_status"><option value="0">Disable</option><option value="1">Enable</option></select></td>
				</tr>
			</table>
			<div align="right">
			<?php if($this->getRolesConfig('EDIT_KEY_ALLOWED_MSISDN_TYPE')){ ?>
		    	<a id="btnKeyAllowedTypeRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnKeyAllowedTypeCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>    
			<?php } ?>
			</div>
		</div>
	</form>
</div>

<div id="divKeyAllowedTypeAddDialog" title="<?php echo _("Add new Key Allowed Type"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><select id="addKAT_type"><option value="">Select Type</option></select></td>
					<td><?php echo _("KEY"); ?></td><td><select id="addKAT_key"><option value="">Select Key</option></select></td>				
				</tr>
				<tr>
					<td><?php echo _("SEND"); ?></td><td><select id="addKAT_send"><option value="0">NO</option><option value="1">YES</option></select></td>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="addKAT_priority" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("RECEIVE"); ?></td><td><select id="addKAT_receive"><option value="0">NO</option><option value="1">YES</option></select></td>
					<td><?php echo _("DESCRIPTION"); ?></td><td><input type="text" id="addKAT_description"/></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?></td><td><select id="addKAT_status" disabled="true"><option>Disable</option></select></td>
				</tr>
			</table>
			<div align="right">
			<?php if($this->getRolesConfig('EDIT_KEY_ALLOWED_MSISDN_TYPE')){ ?>
		    	<a id="btnKeyAllowedTypeAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Add"); ?></span>
		        </a>
		        <a id="btnKeyAllowedTypeAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>
			<?php } ?>
			</div>
		</div>
	</form>
</div>

<div id="divKeyAllowedMSISDNRequestDialog" title="<?php echo _("Request Key Allowed MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="reqKAM_id" disabled="true"/></td>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="reqKAM_msisdn"/></td>
				</tr>
				<tr>
					<td><?php echo _("KEY"); ?></td><td><select id="reqKAM_key"><option value="">Select Key</option></select></td>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="reqKAM_priority"/></td>
				</tr>
				<tr>
					<td><?php echo _("SEND"); ?></td><td><select id="reqKAM_send"><option value="0">NO</option><option value="1">YES</option></select></td>
					<td><?php echo _("RECEIVE"); ?></td><td><select id="reqKAM_receive"><option value="0">NO</option><option value="1">YES</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("DESCRIPTION"); ?></td><td><input type="text" id="reqKAM_description"/></td>
					<td><?php echo _("STATUS"); ?></td><td><select id="reqKAM_status"><option value="0">Disable</option><option value="1">Enable</option></select></td>
				</tr>
			</table>
			<div align="right">
			<?php if($this->getRolesConfig('EDIT_KEY_ALLOWED_MSISDN_TYPE')){ ?>
		    	<a id="btnKeyAllowedMSISDNRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnKeyAllowedMSISDNCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a> 
			<?php } ?>
			</div>
		</div>
	</form>
</div>

<div id="divKeyAllowedMSISDNAddDialog" title="<?php echo _("Add new Key Allowed MSISDN"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="addKAM_msisdn"/></td>
					<td><?php echo _("KEY"); ?></td><td><select id="addKAM_key"><option value="">Select Key</option></select></td>				
				</tr>
				<tr>
					<td><?php echo _("SEND"); ?></td><td><select id="addKAM_send"><option value="0">NO</option><option value="1">YES</option></select></td>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="addKAM_priority" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("RECEIVE"); ?></td><td><select id="addKAM_receive"><option value="0">NO</option><option value="1">YES</option></select></td>
					<td><?php echo _("DESCRIPTION"); ?></td><td><input type="text" id="addKAM_description"/></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?></td><td><select id="addKAM_status" disabled="true"><option>Disable</option></select></td>
				</tr>
			</table>
			<div align="right">
			<?php if($this->getRolesConfig('EDIT_KEY_ALLOWED_MSISDN_TYPE')){ ?>
		    	<a id="btnKeyAllowedMSISDNAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Add"); ?></span>
		        </a>
		        <a id="btnKeyAllowedMSISDNAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>
			<?php } ?>
			</div>
		</div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	$(function(){
		$('#dtkeyallowedtype,#dtkeyallowedmsisdn').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#keyallowed").fadeIn(1500);

	$("#divKeyAllowedTypeRequestDialog,#divKeyAllowedTypeAddDialog,#divKeyAllowedMSISDNRequestDialog,#divKeyAllowedMSISDNAddDialog").dialog({
		autoOpen: false,
		width: 600,
		draggable: true,
		resizable: false,
		modal:true,
		draggable:false
	});
	$("#btnKeyAllowedTypeCancel").click(function(){
		$("#divKeyAllowedTypeRequestDialog").dialog('close');
	});
	$("#btnKeyAllowedTypeAddCancel").click(function(){
		$("#divKeyAllowedTypeAddDialog").dialog('close');
	});
	$("#btnAddKeyAllowedType").click(function(){
		$("#divKeyAllowedTypeAddDialog").dialog('open');
		type_lists("#addKAT_type");
		key_lists("#addKAT_key");
		$("#addKAT_description").val('');
	});
	$("#btnKeyAllowedMSISDNCancel").click(function(){
		$("#divKeyAllowedMSISDNRequestDialog").dialog('close');
	});
	$("#btnKeyAllowedMSISDNAddCancel").click(function(){
		$("#divKeyAllowedMSISDNAddDialog").dialog('close');
	});

	function requestKeyAllowedType(id,type,key,send,receive,description,priority,status){
		$("#reqKAT_id").val(id);
		type_lists("#reqKAT_type",type);
		key_lists("#reqKAT_key",key);
		$("#reqKAT_send").val(send);
		$("#reqKAT_receive").val(receive);
		$("#reqKAT_description").val(description);
		$("#reqKAT_priority").val(priority);
		$("#reqKAT_status").val(status);
		$("#divKeyAllowedTypeRequestDialog").dialog('open');
	}

	$("#btnKeyAllowedTypeAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addKeyAllowedType',
				type:$("#addKAT_type").val(),
				key:$("#addKAT_key").val(),
				send:$("#addKAT_send").val(),
				receive:$("#addKAT_receive").val(),
				priority:$("#addKAT_priority").val(),
				description:$("#addKAT_description").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divKeyAllowedTypeAddDialog").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnKeyAllowedTypeRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestKeyAllowedType',
				id:$("#reqKAT_id").val(),
				type:$("#reqKAT_type").val(),
				key:$("#reqKAT_key").val(),
				send:$("#reqKAT_send").val(),
				receive:$("#reqKAT_receive").val(),
				priority:$("#reqKAT_priority").val(),
				status:$("#reqKAT_status").val(),
				description:$("#reqKAT_description").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divKeyAllowedTypeRequestDialog").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function requestKeyAllowedMSISDN(id,msisdn,key,send,receive,description,priority,status){
		$("#reqKAM_id").val(id);
		$("#reqKAM_msisdn").val(msisdn);
		key_lists("#reqKAM_key",key);
		$("#reqKAM_send").val(send);
		$("#reqKAM_receive").val(receive);
		$("#reqKAM_description").val(description);
		$("#reqKAM_priority").val(priority);
		$("#reqKAM_status").val(status);
		$("#divKeyAllowedMSISDNRequestDialog").dialog('open');
	}
	$("#btnKeyAllowedMSISDNRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestKeyAllowedMSISDN',
				id:$("#reqKAM_id").val(),
				msisdn:$("#reqKAM_msisdn").val(),
				key:$("#reqKAM_key").val(),
				send:$("#reqKAM_send").val(),
				receive:$("#reqKAM_receive").val(),
				priority:$("#reqKAM_priority").val(),
				status:$("#reqKAM_status").val(),
				description:$("#reqKAM_description").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divKeyAllowedMSISDNRequestDialog").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnAddKeyAllowedMSISDN").click(function(){
		$("#divKeyAllowedMSISDNAddDialog").dialog('open');
		key_lists("#addKAM_key");
		$("#addKAM_description,#addKAM_msisdn").val('');
	});
	$("#btnKeyAllowedMSISDNAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addKeyAllowedMSISDN',
				msisdn:$("#addKAM_msisdn").val(),
				key:$("#addKAM_key").val(),
				send:$("#addKAM_send").val(),
				receive:$("#addKAM_receive").val(),
				priority:$("#addKAM_priority").val(),
				description:$("#addKAM_description").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divKeyAllowedMSISDNAddDialog").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
</script>