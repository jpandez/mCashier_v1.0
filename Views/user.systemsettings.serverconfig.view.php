<?php require_once("views.config.properties.php"); ?>
<div id="server" style="display:none;">
<input type="submit" id="btnServerConfigAddR" value="Add" class="ui-state-default ui-corner-all ui-button" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>>
	<div id="accountsummary" style="width:100%;font-size:10px;">
		<?php $getServerConfig = $this->data("getServerConfig");?>
		<?php if(isset($getServerConfig->ResponseCode)){ ?>
			<?php if(is_array($getServerConfig->Value)){?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtserverconfig" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("IP"); ?></th>
						<th><?php echo _("FUNCTION"); ?></th>
						<th><?php echo _("STATUS"); ?></th>
						<th><?php echo _("EDIT REQUEST"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getServerConfig->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<td><?php echo $t->ID; ?></td>
								<td><?php echo $t->IP; ?></td>
								<td><?php echo $t->FUNCTION; ?></td>
								<td><?php echo $t->STATUS; ?></td>
								<td><a href="javascript:requestServerConfig('<?php echo $t->ID . "','" . $t->IP . "','". $t->FUNCTION . "','" . $t->STATUS; ?>');" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>><?php echo _("Request"); ?></a>
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
<!-- ui-dialog server config -->
<div id="dialogServerConfig" title="<?php echo _("Request Server Config"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("ID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="scID"  id="scID" disabled="disabled"></td>
		</tr>				
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="scIP"  id="scIP" ></td>					
		</tr>
		<tr>
			<td><?php echo _("FUNCTION"); ?><span style="color:red">*</span>:</td><td><input type="text" name="scFUNCTION" id="scFUNCTION" ></td>
		</tr>					
		<tr>
			<td><?php echo _("STATUS"); ?><span style="color:red">*</span>:</td><td><input type="text" name="scSTATUS" id="scSTATUS"></td>
		</tr>							
	</table>
	 <div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnServerConfigRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
			</a>
			<a id="btnServerConfigCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="scloading"></div>
</div>
<!-- end ui-dialog server config -->
<!-- ui-dialog server config add -->
<div id="dialogServerConfigAdd" title="<?php echo _("Add Server Config"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="scaddIP"  id="scaddIP"></td>						
		</tr>
									
	</table>
	<div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnServerConfigAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Add"); ?></span>
			</a>
			<a id="btnServerConfigCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="scaloading"></div>
</div>
<!-- end ui-dialog server config add -->
</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	$(function(){
		oTable = $('#dtserverconfig').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});

	// Dialog
	$('#dialogServerConfigAdd').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});	

	$('#dialogServerConfig').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	
	$("#btnServerConfigAddR").click(function(){
				 $('#dialogServerConfigAdd').dialog('open');	
	});

	$("#btnServerConfigCancelAdd").click(function(){
				 $('#dialogServerConfigAdd').dialog('close');	
	});
	
	$("#btnServerConfigCancel").click(function(){
				 $('#dialogServerConfig').dialog('close');	
	});
	
	$("#btnServerConfigAdd").click(function(){
		var params = {
				Method:'addServerConfig',
				ip:$("#scaddIP").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.scaloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$('#dialogServerConfigAdd').dialog('close');
					}

					$('.scaloading').fadeToggle(300,'linear',function(){
						$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnServerConfigRequest").click(function(){
		var params = {
				Method:'requestServerConfig',
				pndgid:$("#scID").val(),
				ip:$("#scIP").val(),
				func:$("#scFUNCTION").val(),
				status:$("#scSTATUS").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.scloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$('#dialogServerConfig').dialog('close');
					}

					$('.scloading').fadeToggle(300,'linear',function(){
							$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	function requestServerConfig(ID, IP, FUNCTION, STATUS){
	$('#dialogServerConfig').dialog('open');
	$("#scID").val(ID);
	$("#scIP").val(IP);
	$("#scFUNCTION").val(FUNCTION);
	$("#scSTATUS").val(STATUS);
	}
	
	$("#server").fadeIn(700);
</script>