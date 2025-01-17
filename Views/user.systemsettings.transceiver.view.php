<?php require_once("views.config.properties.php"); ?>
<div id="transrx" style="display:none;">
<input type="submit" id="btnTransceiverAddR" value="Add" class="ui-state-default ui-corner-all ui-button" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>>
	<div id="accountsummary" style="width:100%;font-size:10px;">
		<?php $getTransceiver = $this->data("getTransceiver");?>
		<?php if(isset($getTransceiver->ResponseCode)){ ?>
				<?php if(is_array($getTransceiver->Value)){?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dttransceiver" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>
						<th><?php echo _("EDIT REQUEST"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getTransceiver->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<td><?php echo $t->ID; ?></td>
								<td width="100%"><?php echo "SYSTEMID : " . $t->SYSTEMID . ", PASSWORD : ". $t->PASSWORD . ", IP : ". $t->IP . ", PORT : ". $t->PORT . ", TON : ". $t->TON . ", NPI : ". $t->NPI . ", ORIGTON : ". $t->ORIGTON . ", ORIGNPI : ". $t->ORIGNPI . ", DESTTON : ". $t->DESTTON . ", DESTNPI : ". $t->DESTNPI . ", SYSTYPE : ". $t->SYSTYPE . ", STATUS : ". $t->STATUS . ", HOSTIP : ". $t->HOSTIP . ", SHORTCODE : ". $t->SHORTCODE . ", KEEPALIVEINTERVAL : ". $t->KEEPALIVEINTERVAL . ", RESPONSETIMEOUT : ". $t->RESPONSETIMEOUT . ", PINPATTERN : ". $t->PINPATTERN . ", PINREPLACE : ". $t->PINREPLACE; ?></td>
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
								<td><a href="javascript:requestTransceiver('<?php echo $t->ID . "','" . $t->SYSTEMID . "','". $t->PASSWORD . "','" . $t->IP . "','" . $t->PORT . "','" . $t->TON . "','" . $t->NPI . "','" . $t->ORIGTON . "','" . $t->ORIGNPI. "','" . $t->DESTTON . "','" . $t->DESTNPI. "','" . $t->SYSTYPE . "','" . $t->STATUS. "','" . $t->HOSTIP. "','" . $t->SHORTCODE. "','" . $t->KEEPALIVEINTERVAL. "','" . $t->RESPONSETIMEOUT. "','" . $t->PINPATTERN. "','" . $t->PINREPLACE; ?>');" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>><?php echo _("Request"); ?></a>
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
<!-- ui-dialog transceiver add -->
<div id="dialogTransceiverAdd" title="<?php echo _("Add Transceiver"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		<tr>
			<td><?php echo _("SYSTEMID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxaddSYSTEMID"  id="trxaddSYSTEMID"></td>
		</tr>
		<tr>
			<td><?php echo _("PASSWORD"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxaddPASSWORD"  id="trxaddPASSWORD"></td>
		</tr>
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxaddIP"  id="trxaddIP"></td>						
		</tr>
		<tr>
			<td><?php echo _("PORT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxaddPORT"  id="trxaddPORT" value="1188"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTYPE"); ?>:</td><td><input type="text" name="trxaddSYSTYPE" id="trxaddSYSTYPE"></td>
		</tr>
		<tr>
			<td><?php echo _("HOSTIP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxaddHOSTIP" id="trxaddHOSTIP"></td>
		</tr>					
		<tr>
			<td><?php echo _("SHORTCODE"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxaddSHORTCODE" id="trxaddSHORTCODE" value="444"></td>						
		</tr>								
	</table>
	 <div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnTransceiverAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Add"); ?></span>
			</a>
			<a id="btnTransceiverCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>	
	</div><div class="trxaloading"></div>
</div>
<!-- end ui-dialog transceiver add -->
<!-- ui-dialog transceiver -->
<div id="dialogTransceiver" title="<?php echo _("Request Transceiver"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("ID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxID"  id="trxID" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTEMID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxSYSTEMID"  id="trxSYSTEMID" ></td>
			<td><?php echo _("PASSWORD"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxPASSWORD"  id="trxPASSWORD" ></td>
		</tr>
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxIP"  id="trxIP" ></td>
			<td><?php echo _("PORT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxPORT"  id="trxPORT" ></td>						
		</tr>
		<tr>
			<td><?php echo _("TON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxTON" id="trxTON" ></td>
			<td><?php echo _("NPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxNPI" id="trxNPI" ></td>
		</tr>
		<tr>
			<td><?php echo _("ORIGTON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxORIGTON" id="trxORIGTON" ></td>
			<td><?php echo _("ORIGNPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxORIGNPI" id="trxORIGNPI"></td>
		</tr>
		<tr>
			<td><?php echo _("DESTTON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxDESTTON" id="trxDESTTON"></td>
			<td><?php echo _("DESTNPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxDESTNPI" id="trxDESTNPI"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTYPE"); ?>:</td><td><input type="text" name="trxSYSTYPE" id="trxSYSTYPE"></td>
			<td><?php echo _("STATUS"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxSTATUS" id="trxSTATUS" ></td>
		</tr>	
		<tr>
			<td><?php echo _("HOSTIP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxHOSTIP" id="trxHOSTIP" ></td>
			<td><?php echo _("SHORTCODE"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxSHORTCODE" id="trxSHORTCODE" ></td>						
		</tr>
		<tr>
			<td><?php echo _("KEEPALIVEINTERVAL"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxKEEPALIVEINTERVAL" id="trxKEEPALIVEINTERVAL"></td>
			<td><?php echo _("RESPONSETIMEOUT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="trxRESPONSETIMEOUT" id="trxRESPONSETIMEOUT"></td>
		</tr>	
		<!--<tr>
			<td>PINPATTERN:</td><td><input type="text" name="trxPINPATTERN" id="trxPINPATTERN"></td>
			<td>PINREPLACE:</td><td><input type="text" name="trxPINREPLACE" id="trxPINREPLACE"></td>						
		</tr>-->			
	</table>
	<div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnTransceiverRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
			</a>
			<a id="btnTransceiverCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="trxloading"></div>
</div>
<!-- end ui-dialog transceiver -->
</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">	
	$(function(){
		oTable = $('#dttransceiver').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	
	// Dialog
	$('#dialogTransceiverAdd').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});

	// Dialog
	$('#dialogTransceiver').dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	
	$("#btnTransceiverAdd").click(function(){
		var params = {
				Method:'addTransceiver',
				systemid:$("#trxaddSYSTEMID").val(),
				password:$("#trxaddPASSWORD").val(),
				ip:$("#trxaddIP").val(),
				port:$("#trxaddPORT").val(),
				systype:$("#trxaddSYSTYPE").val(),
				hostip:$("#trxaddHOSTIP").val(),
				shortcode:$("#trxaddSHORTCODE").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.trxaloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$('#dialogTransceiverAdd').dialog('close');
					}

					$('.trxaloading').fadeToggle(300,'linear',function(){
							$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnTransceiverRequest").click(function(){
		var params = {
				Method:'requestTransceiver',
				pndgid:$("#trxID").val(),
				systemid:$("#trxSYSTEMID").val(),
				password:$("#trxPASSWORD").val(),
				ip:$("#trxIP").val(),
				port:$("#trxPORT").val(),
				ton:$("#trxTON").val(),
				npi:$("#trxNPI").val(),
				origton:$("#trxORIGTON").val(),
				orignpi:$("#trxORIGNPI").val(),
				destton:$("#trxDESTTON").val(),
				destnpi:$("#trxDESTNPI").val(),
				systype:$("#trxSYSTYPE").val(),
				status:$("#trxSTATUS").val(),
				hostip:$("#trxHOSTIP").val(),
				shortcode:$("#trxSHORTCODE").val(),
				keepaliveinterval:$("#trxKEEPALIVEINTERVAL").val(),
				responsetimeout:$("#trxRESPONSETIMEOUT").val(),
				pinpattern:$("#trxPINPATTERN").val(),
				pinreplace:$("#trxPINREPLACE").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.trxloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$('#dialogTransceiver').dialog('close');
					}

					$('.trxloading').fadeToggle(300,'linear',function(){
							$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnTransceiverAddR").click(function(){
				 $('#dialogTransceiverAdd').dialog('open');	
	});

	$("#btnTransceiverCancelAdd").click(function(){
				 $('#dialogTransceiverAdd').dialog('close');	
	});

	$("#btnTransceiverCancel").click(function(){
				 $('#dialogTransceiver').dialog('close');	
	});
	
	function requestTransceiver(ID, SYSTEMID, PASSWORD, IP, PORT, TON, NPI, ORIGTON, ORIGNPI, DESTTON, DESTNPI, SYSTYPE, STATUS, HOSTIP, SHORTCODE, KEEPALIVEINTERVAL, RESPONSETIMEOUT, PINPATTERN, PINREPLACE){
	$('#dialogTransceiver').dialog('open');
	$("#trxID").val(ID);
	$("#trxSYSTEMID").val(SYSTEMID);
	$("#trxPASSWORD").val(PASSWORD);
	$("#trxIP").val(IP);
	$("#trxPORT").val(PORT);
	$("#trxTON").val(TON);
	$("#trxNPI").val(NPI);
	$("#trxORIGTON").val(ORIGTON);
	$("#trxORIGNPI").val(ORIGNPI);
	$("#trxDESTTON").val(DESTTON);
	$("#trxDESTNPI").val(DESTNPI);
	$("#trxSYSTYPE").val(SYSTYPE);
	$("#trxSTATUS").val(STATUS);
	$("#trxHOSTIP").val(HOSTIP);
	$("#trxSHORTCODE").val(SHORTCODE);
	$("#trxKEEPALIVEINTERVAL").val(KEEPALIVEINTERVAL);
	$("#trxRESPONSETIMEOUT").val(RESPONSETIMEOUT);
	$("#trxPINPATTERN").val(PINPATTERN);
	$("#trxPINREPLACE").val(PINREPLACE);
	}
	
	$("#transrx").fadeIn(700);
</script>