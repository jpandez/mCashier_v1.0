<div style="margin-top:10px"></div>
<div id="airt" style="display:none;">
<button id="btnAddAirConfig" class="uibutton"><?php echo _("Add"); ?></button>
	<div id="accountsummary" style="width:100%;font-size:10px;">
		<?php $getAirConfig = $this->data("getAirConfig"); ?>
		<?php if(isset($getAirConfig->ResponseCode)){ ?>
			<?php if(is_array($getAirConfig->Value)){ ?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="airConfig" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>
						<th><?php echo _("STATUS"); ?></th>
						<th><?php echo _("EDIT REQUEST"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getAirConfig->Value as $t): $ctr++;?>
							
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" >
								<td><?php echo $t->AIRSERVERID; ?></td>
								<td width="100%"><?php echo "TIMEOFFSET : (" . $t->TIMEOFFSET . "), FACTOR : (". $t->FACTOR . "), URL : (". $t->URL . "), CTYPE : (". $t->CTYPE . "), AGENT : (". $t->AGENT . "), IP : (". $t->IP . "), HOST : (". $t->HOST . "), PORT : (". $t->PORT . "), CURRENCYTYPE : (". $t->CURRENCYTYPE . "), AUTHORIZATION : (". $t->AUTHORIZATION . "), REFILLID : (". $t->REFILLID . "), ACCEPTDECIMAL : (". $t->ACCEPTDECIMAL . "), TIMEOUT : (". $t->TIMEOUT . ")"; ?></td>
								<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
								<td><a href="javascript:requestAirConfig('<?php echo $t->AIRSERVERID."','".$t->TIMEOFFSET."','".$t->FACTOR."','".$t->URL."','".$t->CTYPE."','".$t->AGENT."','".$t->IP."','".$t->HOST."','".$t->PORT."','".$t->STATUS."','".$t->CURRENCYTYPE."','".$t->AUTHORIZATION."','".$t->REFILLID."','".$t->ACCEPTDECIMAL."','".$t->TIMEOUT; ?>')"><?php echo _("Request"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table><div class="loading"></div><div class="sysloading"></div><div class="ulevelloading"></div>
			<?php } else {
				echo "<h3> No Records Found : $getAirConfig->Message</h3>";
			}?>
		<?php } ?>
	</div>
<div id="divAirConfigRequestDialog" title="<?php echo _("Request Air Configuration"); ?>">
	<input type="hidden" name="Method" id="requestAirConfig"></input>
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" name="airBonusTopupRequest" id="airBonusTopupRequest" class="tablet">
				<tr>
					<td><?php echo _("AIRSERVERID"); ?></td><td><input type="text" id="AIRSERVERID" disabled="true"/></td>
					<td><?php echo _("TIMEOFFSET"); ?><span style="color:red">*</span></td><td><input type="text" id="TIMEOFFSET" /></td>
					<td><?php echo _("FACTOR"); ?><span style="color:red">*</span></td><td><input type="text" id="FACTOR" /></td>
				</tr>
				<tr>
					<td><?php echo _("URL"); ?><span style="color:red">*</span></td><td><input type="text" id="URL" /></td>
					<td><?php echo _("CTYPE"); ?><span style="color:red">*</span></td><td><input type="text" id="CTYPE" /></td>
					<td><?php echo _("AGENT"); ?><span style="color:red">*</span></td><td><input type="text" id="AGENT" /></td>
				</tr>
				<tr>
					<td><?php echo _("IP"); ?><span style="color:red">*</span></td><td><input type="text" id="IP" /></td>
					<td><?php echo _("HOST"); ?><span style="color:red">*</span></td><td><input type="text" id="HOST" /></td>
					<td><?php echo _("PORT"); ?><span style="color:red">*</span></td><td><input type="text" id="PORT" /></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?><span style="color:red">*</span></td><td><input type="text" id="STATUS" /></td>
					<td><?php echo _("CURRENCYTYPE"); ?><span style="color:red">*</span></td><td><input type="text" id="CURRENCYTYPE" /></td>
					<td><?php echo _("AUTHORIZATION"); ?></td><td><input type="text" id="AUTHORIZATION" /></td>
				</tr>
				<tr>
					<td><?php echo _("REFILLID"); ?></td><td><input type="text" id="REFILLID" /></td>
					<td><?php echo _("ACCEPTDECIMAL"); ?><span style="color:red">*</span></td><td><input type="text" id="ACCEPTDECIMAL" /></td>
					<td><?php echo _("TIMEOUT"); ?><span style="color:red">*</span></td><td><input type="text" id="TIMEOUT" /></td>
				</tr>
				
			</table>
			<div align="right">
				<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
					<a id="btnAirConfigRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
						<span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
					</a>
					<a id="btnAirConfigCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
						<span class="ui-button-text"><?php echo _("cancel"); ?></span>
					</a>
				<?php } ?>
			</div><div class="airbonusloading"></div>
		</div>
	</form>
</div>
<div id="divAirConfigAddDialog" title="<?php echo _("Add new Air Configuration"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" name="airBonusTopupRequest" id="airBonusTopupRequest" class="tablet">
				<tr>
					
					<td><?php echo _("TIMEOFFSET"); ?><span style="color:red">*</span></td><td><input type="text" id="addTIMEOFFSET"  value="+0000" /></td>
					<td><?php echo _("FACTOR"); ?><span style="color:red">*</span></td><td><input type="text" id="addFACTOR" value="1" /></td>
					
				</tr>
				<tr>
					<td><?php echo _("URL"); ?><span style="color:red">*</span></td><td><input type="text" id="addURL" value="/Air" /></td>
					<td><?php echo _("CTYPE"); ?><span style="color:red">*</span></td><td><input type="text" id="addCTYPE" value="text/xml" /></td>
					
				</tr>
				<tr>
					<td><?php echo _("AGENT"); ?><span style="color:red">*</span></td><td><input type="text" id="addAGENT" value="UGw Server/3.1/1.0" /></td>
					<td><?php echo _("IP"); ?><span style="color:red">*</span></td><td><input type="text" id="addIP" value="0.0.0.0" /></td>
					
				</tr>
				<tr>
					<td><?php echo _("HOST"); ?><span style="color:red">*</span></td><td><input type="text" id="addHOST" value="air" /></td>
					<td><?php echo _("PORT"); ?><span style="color:red">*</span></td><td><input type="text" id="addPORT" value="10010" /></td>
				</tr>
				<tr>
					
					<td><?php echo _("CURRENCYTYPE"); ?><span style="color:red">*</span></td><td><input type="text" id="addCURRENCYTYPE" value="PHP" /></td>
					<td><?php echo _("AUTHORIZATION"); ?></td><td><input type="text" id="addAUTHORIZATION" /></td>
				</tr>
				<tr>
					<td><?php echo _("REFILLID"); ?></td><td><input type="text" id="addREFILLID" /></td>
					<td><?php echo _("ACCEPTDECIMAL"); ?><span style="color:red">*</span></td><td><input type="text" id="addACCEPTDECIMAL" value="0" /></td>
				</tr>
				<tr>
					<td><?php echo _("TIMEOUT"); ?><span style="color:red">*</span></td><td><input type="text" id="addTIMEOUT" value="60000" /></td>
				</tr>
				
			</table>
			<div align="right">
				<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
					<a id="btnAirConfigAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
						<span class="ui-button-text"><?php echo _("Add"); ?></span>
					</a>
					<a id="btnAirConfigAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
						<span class="ui-button-text"><?php echo _("Cancel"); ?></span>
					</a>
				<?php } ?>
			</div><div class="airbonusaloading"></div>
		</div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript" charset="utf-8">
	loadTable();
	function loadTable(){
		oTable = $('#airConfig').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	} ;
	$("#airt").fadeIn(1500);
	
	$('#divAirConfigRequestDialog').dialog({
		autoOpen: false,
		width: 1200,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	$('#divAirConfigAddDialog').dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	$("#btnAirConfigCancel").click(function(){
		$('#divAirConfigRequestDialog').dialog('close');
	});

	$("#btnAddAirConfig").click(function(){
		$('#divAirConfigAddDialog').dialog('open');
	});

	$("#btnAirConfigAddCancel").click(function(){
		$('#divAirConfigAddDialog').dialog('close');
	});
	
	
	function requestAirConfig(AIRSERVERID,TIMEOFFSET,FACTOR,URL,CTYPE,AGENT,IP,HOST,PORT,STATUS,CURRENCYTYPE,AUTHORIZATION,REFILLID,ACCEPTDECIMAL,TIMEOUT){
		$("#AIRSERVERID").val(AIRSERVERID);
		$("#TIMEOFFSET").val(TIMEOFFSET);
		$("#FACTOR").val(FACTOR);
		$("#URL").val(URL);
		$("#CTYPE").val(CTYPE);
		$("#AGENT").val(AGENT);
		$("#IP").val(IP);
		$("#HOST").val(HOST);
		$("#PORT").val(PORT);
		$("#STATUS").val(STATUS);
		$("#CURRENCYTYPE").val(CURRENCYTYPE);
		$("#AUTHORIZATION").val(AUTHORIZATION);
		$("#REFILLID").val(REFILLID);
		$("#ACCEPTDECIMAL").val(ACCEPTDECIMAL);
		$("#TIMEOUT").val(TIMEOUT);
		$("#divAirConfigRequestDialog").dialog('open');
	}

	$("#btnAirConfigRequest").click(function(){
		$('.airbonusloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestAirConfig',
				AIRSERVERID:$("#AIRSERVERID").val(),
				TIMEOFFSET:$("#TIMEOFFSET").val(),
				FACTOR:$("#FACTOR").val(),
				URL:$("#URL").val(),
				CTYPE:$("#CTYPE").val(),
				AGENT:$("#AGENT").val(),
				IP:$("#IP").val(),
				HOST:$("#HOST").val(),
				PORT:$("#PORT").val(),
				STATUS:$("#STATUS").val(),
				CURRENCYTYPE:$("#CURRENCYTYPE").val(),
				AUTHORIZATION:$("#AUTHORIZATION").val(),
				REFILLID:$("#REFILLID").val(),
				ACCEPTDECIMAL:$("#ACCEPTDECIMAL").val(),
				TIMEOUT:$("#TIMEOUT").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$('#divAirConfigRequestDialog').dialog('close');
				}
				$('.airbonusloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnAirConfigAdd").click(function(){
		$('.airbonusaloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addAirConfig',
				TIMEOFFSET:$("#addTIMEOFFSET").val(),
				FACTOR:$("#addFACTOR").val(),
				URL:$("#addURL").val(),
				CTYPE:$("#addCTYPE").val(),
				AGENT:$("#addAGENT").val(),
				IP:$("#addIP").val(),
				HOST:$("#addHOST").val(),
				PORT:$("#addPORT").val(),
				CURRENCYTYPE:$("#addCURRENCYTYPE").val(),
				AUTHORIZATION:$("#addAUTHORIZATION").val(),
				REFILLID:$("#addREFILLID").val(),
				ACCEPTDECIMAL:$("#addACCEPTDECIMAL").val(),
				TIMEOUT:$("#addTIMEOUT").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$('#divAirConfigAddDialog').dialog('close');
				}
				$('.airbonusaloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
</script>