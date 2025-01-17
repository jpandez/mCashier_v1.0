<div id="rxrx" style="display:none;">
<input type="submit" id="btnReceiverAddR" value="Add" class="ui-state-default ui-corner-all ui-button" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>>
	<div id="accountsummary" style="width:100%;font-size:10px;">
		<?php $getReceiver = $this->data("getReceiver");?>
		<?php if(isset($getReceiver->ResponseCode)){ ?>
			<?php if(is_array($getReceiver->Value)){?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtreceiver" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>						
						<th><?php echo _("EDIT REQUEST"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getReceiver->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<td><?php echo $t->ID; ?></td>
								<td width="100%"><?php echo "SYSTEMID : " . $t->SYSTEMID . ", PASSWORD : ". $t->PASSWORD . ", IP : ". $t->IP . ", PORT : ". $t->PORT . ", TON : ". $t->TON . ", NPI : ". $t->NPI . ", SYSTYPE : ". $t->SYSTYPE . ", STATUS : ". $t->STATUS . ", HOSTIP : ". $t->HOSTIP . ", SHORTCODE : ". $t->SHORTCODE . ", KEEPALIVEINTERVAL : ". $t->KEEPALIVEINTERVAL . ", RESPONSETIMEOUT : ". $t->RESPONSETIMEOUT . ", SECURED : ". $t->SECURED; ?></td>
								<!--<td><?php echo $t->SYSTEMID; ?></td>
								<td><?php echo $t->PASSWORD; ?></td>
								<td><?php echo $t->IP; ?></td>
								<td><?php echo $t->PORT; ?></td>
								<td><?php echo $t->TON; ?></td>										
								<td><?php echo $t->NPI; ?></td>
								<td><?php echo $t->ORIGTON; ?></td>
								<td><?php echo $t->ORIGNPI; ?></td>
								<td><?php echo $t->DESTTON; ?></td>
								<td><?php echo $t->DESTNPI; ?></td>
								<td><?php echo $t->SYSTYPE; ?></td>
								<td><?php echo $t->STATUS; ?></td>										
								<td><?php echo $t->HOSTIP; ?></td>
								<td><?php echo $t->SHORTCODE; ?></td>
								<td><?php echo $t->KEEPALIVEINTERVAL; ?></td>
								<td><?php echo $t->RESPONSETIMEOUT; ?></td>
								<td><?php echo $t->PINPATTERN; ?></td>
								<td><?php echo $t->PINREPLACE; ?></td>-->
								<td><a href="javascript:requestReceiver('<?php echo $t->ID . "','" . $t->SYSTEMID . "','". $t->PASSWORD . "','" . $t->IP . "','" . $t->PORT . "','" . $t->TON . "','" . $t->NPI . "','" . $t->SYSTYPE . "','" . $t->STATUS. "','" . $t->HOSTIP. "','" . $t->SHORTCODE. "','" . $t->KEEPALIVEINTERVAL. "','" . $t->RESPONSETIMEOUT. "','" . $t->SECURED; ?>');" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>><?php echo _("Request"); ?></a>
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
<!-- ui-dialog receiver -->
<div id="dialogReceiver" title="<?php echo _("Request Receiver"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("ID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxID"  id="rxID" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTEMID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxSYSTEMID"  id="rxSYSTEMID" ></td>
			<td><?php echo _("PASSWORD"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxPASSWORD"  id="rxPASSWORD" ></td>
		</tr>
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxIP"  id="rxIP" ></td>
			<td><?php echo _("PORT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxPORT"  id="rxPORT" ></td>						
		</tr>
		<tr>
			<td><?php echo _("TON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxTON" id="rxTON" ></td>
			<td><?php echo _("NPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxNPI" id="rxNPI" ></td>
		</tr>					
		<tr>
			<td><?php echo _("SYSTYPE"); ?>:</td><td><input type="text" name="rxSYSTYPE" id="rxSYSTYPE"></td>
			<td><?php echo _("STATUS"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxSTATUS" id="rxSTATUS" ></td>
		</tr>	
		<tr>
			<td><?php echo _("HOSTIP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxHOSTIP" id="rxHOSTIP" ></td>
			<td><?php echo _("SHORTCODE"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxSHORTCODE" id="rxSHORTCODE" ></td>						
		</tr>
		<tr>
			<td><?php echo _("KEEPALIVEINTERVAL"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxKEEPALIVEINTERVAL" id="rxKEEPALIVEINTERVAL"></td>
			<td><?php echo _("RESPONSETIMEOUT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxRESPONSETIMEOUT" id="rxRESPONSETIMEOUT"></td>
		</tr>	
		<tr>
			<td><?php echo _("SECURED"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxSECURED" id="rxSECURED"></td>										
		</tr>			
	</table>
	<div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnReceiverRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
			</a>
			<a id="btnReceiverCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="rxrloading"></div>
</div>
<!-- end ui-dialog receiver -->
<!-- ui-dialog receiver add -->
<div id="dialogReceiverAdd" title="<?php echo _("Add Receiver"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		<tr>
			<td><?php echo _("SYSTEMID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxaddSYSTEMID"  id="rxaddSYSTEMID"></td>
		</tr>
		<tr>
			<td><?php echo _("PASSWORD"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxaddPASSWORD"  id="rxaddPASSWORD"></td>
		</tr>
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxaddIP"  id="rxaddIP"></td>						
		</tr>
		<tr>
			<td><?php echo _("PORT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxaddPORT"  id="rxaddPORT" value="1188"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTYPE"); ?>:</td><td><input type="text" name="rxaddSYSTYPE" id="rxaddSYSTYPE"></td>
		</tr>
		<tr>
			<td><?php echo _("HOSTIP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxaddHOSTIP" id="rxaddHOSTIP"></td>
		</tr>					
		<tr>
			<td><?php echo _("SHORTCODE"); ?><span style="color:red">*</span>:</td><td><input type="text" name="rxaddSHORTCODE" id="rxaddSHORTCODE" value="444"></td>						
		</tr>								
	</table>
	<div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnReceiverAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Add"); ?></span>
			</a>
			<a id="btnReceiverCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="rxaloading"></div>
</div>
<!-- end ui-dialog receiver add -->
</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	$(function(){
		oTable = $('#dtreceiver').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});

	$('#dialogReceiver').dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});

	// Dialog
	$('#dialogReceiverAdd').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	
	$("#btnReceiverAddR").click(function(){
				 $('#dialogReceiverAdd').dialog('open');	
	});

	$("#btnReceiverCancelAdd").click(function(){
				 $('#dialogReceiverAdd').dialog('close');	
	});
	
	$("#btnReceiverCancel").click(function(){
				 $('#dialogReceiver').dialog('close');	
	});
	
	$("#btnReceiverAdd").click(function(){
		var params = {
				Method:'addReceiver',
				systemid:$("#rxaddSYSTEMID").val(),
				password:$("#rxaddPASSWORD").val(),
				ip:$("#rxaddIP").val(),
				port:$("#rxaddPORT").val(),
				systype:$("#rxaddSYSTYPE").val(),
				hostip:$("#rxaddHOSTIP").val(),
				shortcode:$("#rxaddSHORTCODE").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.rxaloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$('.rxaloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							
					});
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	$("#btnReceiverRequest").click(function(){
		var params = {
				Method:'requestReceiver',
				pndgid:$("#rxID").val(),
				systemid:$("#rxSYSTEMID").val(),
				password:$("#rxPASSWORD").val(),
				ip:$("#rxIP").val(),
				port:$("#rxPORT").val(),
				ton:$("#rxTON").val(),
				npi:$("#rxNPI").val(),					
				systype:$("#rxSYSTYPE").val(),
				status:$("#rxSTATUS").val(),
				hostip:$("#rxHOSTIP").val(),
				shortcode:$("#rxSHORTCODE").val(),
				keepaliveinterval:$("#rxKEEPALIVEINTERVAL").val(),
				responsetimeout:$("#rxRESPONSETIMEOUT").val(),
				secured:$("#rxSECURED").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.rxrloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$('.rxrloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							
					});
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	function requestReceiver(ID, SYSTEMID, PASSWORD, IP, PORT, TON, NPI, SYSTYPE, STATUS, HOSTIP, SHORTCODE, KEEPALIVEINTERVAL, RESPONSETIMEOUT, SECURED){
	$('#dialogReceiver').dialog('open');
	$("#rxID").val(ID);
	$("#rxSYSTEMID").val(SYSTEMID);
	$("#rxPASSWORD").val(PASSWORD);
	$("#rxIP").val(IP);
	$("#rxPORT").val(PORT);
	$("#rxTON").val(TON);
	$("#rxNPI").val(NPI);
	$("#rxSYSTYPE").val(SYSTYPE);
	$("#rxSTATUS").val(STATUS);
	$("#rxHOSTIP").val(HOSTIP);
	$("#rxSHORTCODE").val(SHORTCODE);
	$("#rxKEEPALIVEINTERVAL").val(KEEPALIVEINTERVAL);
	$("#rxRESPONSETIMEOUT").val(RESPONSETIMEOUT);
	$("#rxSECURED").val(SECURED);
	}
	
	$("#rxrx").fadeIn(700);
</script>