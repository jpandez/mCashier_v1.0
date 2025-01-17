<?php require_once("views.config.properties.php"); ?>
<div id="keyallowedpndg" style="display:none">
	<div class="uitabs">
		<ul>
			<li id="keyAllowedTypePndgLink"><a href="#keyAllowedTypePndgTab"><?php echo _("Key Allowed Type"); ?></a></li>
			<li id="keyAllowedMSISDNPndgLink"><a href="#keyAllowedMSISDNPndgTab"><?php echo _("Key Allowed MSISDN"); ?></a></li>
		</ul>
		<div id="keyAllowedTypePndgTab" style="font-size:10px;margin-top:15px;">
			<?php $getKeyAllowedTypePndg = $this->data("getKeyAllowedTypePndg");?>
			<?php if(isset($getKeyAllowedTypePndg->ResponseCode)){ ?>
				<?php if(is_array($getKeyAllowedTypePndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeyAllowedTypePndg" width="100%">
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
						<?php $ctr=0; foreach($getKeyAllowedTypePndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="keyAllowedTypePndg_<?php echo $t->PNDGID; ?>">
								<td width="5%"><?php echo $t->PNDGID; ?></td>
								<td width="15%"><?php echo $t->CREATEDDATE; ?></td>
								<td ><?php echo "ID:(".$t->ID."), TYPE:(".$t->TYPE."), KEY:(".$t->KEY."), SEND:(".$t->SEND."), RECEIVE:(".$t->RECEIVE."), DESCRIPTION:(".$t->DESCRIPTION."), PRIORITY:(".$t->PRIORITY."), STATUS:(".$t->STATUS.")"; ?></td>
								<td width="10%"><?php echo $t->CREATEDUSER; ?></td>
								<td width="10%" align="center"><a href="javascript:approveKeyAllowedType('<?php echo $t->PNDGID."','".$t->TYPE."','".$t->KEY."','".$t->SEND."','".$t->RECEIVE."','".$t->PRIORITY."','".$t->STATUS."','".$t->DESCRIPTION."','"."APPROVE"; ?>');"><?php echo _("Approve"); ?></a> | 
																<a href="javascript:approveKeyAllowedType('<?php echo $t->PNDGID."','".$t->TYPE."','".$t->KEY."','".$t->SEND."','".$t->RECEIVE."','".$t->PRIORITY."','".$t->STATUS."','".$t->DESCRIPTION."','"."REJECT"; ?>');"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>". $getKeyAllowedTypePndg->Value ."</h3>";
				}?>
			<?php } ?>
		</div>
		<div id="keyAllowedMSISDNPndgTab" style="font-size:10px;margin-top:15px;">
			<?php $getKeyAllowedMSISDNPndg = $this->data("getKeyAllowedMSISDNPndg");?>
			<?php if(isset($getKeyAllowedMSISDNPndg->ResponseCode)){ ?>
				<?php if(is_array($getKeyAllowedMSISDNPndg->Value)){?>
				<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtkeyAllowedMSISDNPndg" width="100%">
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
						<?php $ctr=0; foreach($getKeyAllowedMSISDNPndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="keyAllowedMSISDNPndg_<?php echo $t->PNDGID; ?>">
								<td width="5%"><?php echo $t->PNDGID; ?></td>
								<td width="15%"><?php echo $t->CREATEDDATE; ?></td>
								<td ><?php echo "ID:(".$t->ID."), MSISDN:(".$t->MSISDN."), KEY:(".$t->KEY."), SEND:(".$t->SEND."), RECEIVE:(".$t->RECEIVE."), DESCRIPTION:(".$t->DESCRIPTION."), PRIORITY:(".$t->PRIORITY."), STATUS:(".$t->STATUS.")"; ?></td>
								<td width="10%"><?php echo $t->CREATEDUSER; ?></td>
								<td width="10%" align="center"><a href="javascript:approveKeyAllowedMSISDN('<?php echo $t->PNDGID."','".$t->MSISDN."','".$t->KEY."','".$t->SEND."','".$t->RECEIVE."','".$t->PRIORITY."','".$t->STATUS."','".$t->DESCRIPTION."','"."APPROVE"; ?>');"><?php echo _("Approve"); ?></a> | 
																<a href="javascript:approveKeyAllowedMSISDN('<?php echo $t->PNDGID."','".$t->MSISDN."','".$t->KEY."','".$t->SEND."','".$t->RECEIVE."','".$t->PRIORITY."','".$t->STATUS."','".$t->DESCRIPTION."','"."REJECT"; ?>');"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php } else {
					echo "<h3>". $getKeyAllowedMSISDNPndg->Value ."</h3>";
				}?>
			<?php } ?>
		</div>
	</div>


<!-- Dialogs -->
<div id="divKeyAllowedTypePendingDialog" title="<?php echo _("Pending Key Allowed Type"); ?>">
	<input type="hidden" id="pendKAT_pndgid"/>
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("TYPE"); ?></td><td><input type="text" id="pendKAT_type" disabled="true"/></td>
					<td><?php echo _("KEY"); ?></td><td><input type="text" id="pendKAT_key" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("SEND"); ?></td><td><input type="text" id="pendKAT_send" disabled="true"/></td>
					<td><?php echo _("RECEIVE"); ?></td><td><input type="text" id="pendKAT_receive" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="pendKAT_priority" disabled="true"/></td>
					<td><?php echo _("STATUS"); ?></td><td><input type="text" id="pendKAT_status" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("DESCRIPTION"); ?></td><td><input type="text" id="pendKAT_description" disabled="true"/></td>
					<td><?php echo _("REMARKS"); ?></td><td><input type="text" id="pendKAT_remarks" disabled="true"/></td>
				</tr>
			</table>
			<div align="right">
			<?php if($this->getRolesConfig('APPROVE_KEY_ALLOWED_MSISDN_TYPE_CHANGES') || $this->getRolesConfig('REJECT_KEY_ALLOWED_MSISDN_TYPE_CHANGES')){ ?>
		    	<a id="btnKeyAllowedTypeSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
		        </a>
		        <a id="btnKeyAllowedTypeAppCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>
			<?php } ?>
			</div>
		</div>
	</form>
</div>

<div id="divKeyAllowedMSISDNPendingDialog" title="<?php echo _("Pending Key Allowed Msisdn"); ?>">
	<input type="hidden" id="pendKAM_pndgid"/>
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("MSISDN"); ?></td><td><input type="text" id="pendKAM_msisdn" disabled="true"/></td>
					<td><?php echo _("KEY"); ?></td><td><input type="text" id="pendKAM_key" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("SEND"); ?></td><td><input type="text" id="pendKAM_send" disabled="true"/></td>
					<td><?php echo _("RECEIVE"); ?></td><td><input type="text" id="pendKAM_receive" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?></td><td><input type="text" id="pendKAM_priority" disabled="true"/></td>
					<td><?php echo _("STATUS"); ?></td><td><input type="text" id="pendKAM_status" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("DESCRIPTION"); ?></td><td><input type="text" id="pendKAM_description" disabled="true"/></td>
					<td><?php echo _("REMARKS"); ?></td><td><input type="text" id="pendKAM_remarks" disabled="true"/></td>
				</tr>
			</table>
			<div align="right">
			<?php if($this->getRolesConfig('APPROVE_KEY_ALLOWED_MSISDN_TYPE_CHANGES') || $this->getRolesConfig('REJECT_KEY_ALLOWED_MSISDN_TYPE_CHANGES')){ ?>
		    	<a id="btnKeyAllowedMSISDNSubmit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Submit"); ?></span>
		        </a>
		        <a id="btnKeyAllowedMSISDNAppCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
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
		$('#dtkeyAllowedTypePndg,#dtkeyAllowedMSISDNPndg').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#keyallowedpndg").fadeIn(1500);
	$("#divKeyAllowedTypePendingDialog,#divKeyAllowedMSISDNPendingDialog").dialog({
		autoOpen: false,
		width: 700,
		draggable: false,
		resizable: false,
		modal:true
	});
	$("#btnKeyAllowedTypeAppCancel").click(function(){
		$("#divKeyAllowedTypePendingDialog").dialog('close');
	});
	$("#btnKeyAllowedMSISDNAppCancel").click(function(){
		$("#divKeyAllowedMSISDNPendingDialog").dialog('close');
	});

	function approveKeyAllowedType(pndgid,type,key,send,receive,priority,status,description,remarks){
		var new_send = send==0?'NO':'YES';
		var new_receive = receive==0?'NO':'YES';
		var new_status = status==0?'Disable':'Enable';
		$("#divKeyAllowedTypePendingDialog").dialog('open');
		$("#pendKAT_pndgid").val(pndgid);
		$("#pendKAT_type").val(type);
		$("#pendKAT_key").val(key);
		$("#pendKAT_send").val(new_send);
		$("#pendKAT_receive").val(new_receive);
		$("#pendKAT_priority").val(priority);
		$("#pendKAT_status").val(new_status);
		$("#pendKAT_description").val(description);
		$("#pendKAT_remarks").val(remarks);
	}

	$("#btnKeyAllowedTypeSubmit").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRejectKeyAllowedType',
				pndgid:$("#pendKAT_pndgid").val(),
				remarks:$("#pendKAT_remarks").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divKeyAllowedTypePendingDialog").dialog('close');
					$("#keyAllowedTypePndg_"+$("#pendKAT_pndgid").val()).hide();
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function approveKeyAllowedMSISDN(pndgid,msisdn,key,send,receive,priority,status,description,remarks){
		var new_send = send==0?'NO':'YES';
		var new_receive = receive==0?'NO':'YES';
		var new_status = status==0?'Disable':'Enable';
		$("#divKeyAllowedMSISDNPendingDialog").dialog('open');
		$("#pendKAM_pndgid").val(pndgid);
		$("#pendKAM_msisdn").val(msisdn);
		$("#pendKAM_key").val(key);
		$("#pendKAM_send").val(new_send);
		$("#pendKAM_receive").val(new_receive);
		$("#pendKAM_priority").val(priority);
		$("#pendKAM_status").val(new_status);
		$("#pendKAM_description").val(description);
		$("#pendKAM_remarks").val(remarks);
	}
	
	$("#btnKeyAllowedMSISDNSubmit").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRejectKeyAllowedMSISDN',
				pndgid:$("#pendKAM_pndgid").val(),
				remarks:$("#pendKAM_remarks").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#divKeyAllowedMSISDNPendingDialog").dialog('close');
					$("#keyAllowedMSISDNPndg_"+$("#pendKAM_pndgid").val()).hide();
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		});
	});
</script>