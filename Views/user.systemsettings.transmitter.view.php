<?php require_once("views.config.properties.php"); ?>
<div id="transtx" style="display:none;">
<input type="submit" id="btnTransmitterAddR" value="Add" class="ui-state-default ui-corner-all ui-button" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>>
	<div id="accountsummary" style="width:100%;font-size:10px;"><?php $getTransmitter = $this->data("getTransmitter");?>
		<?php if(isset($getTransmitter->ResponseCode)){ ?>
			<?php if(is_array($getTransmitter->Value)){?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dttransmitter" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>
						<th><?php echo _("EDIT REQUEST"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getTransmitter->Value as $t): $ctr++;?>
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
								<td><a href="javascript:requestTransmitter('<?php echo $t->ID . "','" . $t->SYSTEMID . "','". $t->PASSWORD . "','" . $t->IP . "','" . $t->PORT . "','" . $t->TON . "','" . $t->NPI . "','" . $t->ORIGTON . "','" . $t->ORIGNPI. "','" . $t->DESTTON . "','" . $t->DESTNPI. "','" . $t->SYSTYPE . "','" . $t->STATUS. "','" . $t->HOSTIP. "','" . $t->SHORTCODE. "','" . $t->KEEPALIVEINTERVAL. "','" . $t->RESPONSETIMEOUT. "','" . $t->PINPATTERN. "','" . $t->PINREPLACE; ?>');" <?php echo ($this->getRolesConfig('SYSTEM_INFO_EDIT')) ? '' : 'style="display:none;"'; ?>><?php echo _("Request"); ?></a>
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
<!-- ui-dialog transmitter -->
<div id="dialogTransmitter" title="<?php echo _("Request Transmitter"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("ID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txID"  id="txID" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTEMID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txSYSTEMID"  id="txSYSTEMID" ></td>
			<td><?php echo _("PASSWORD"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txPASSWORD"  id="txPASSWORD" ></td>
		</tr>
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txIP"  id="txIP" ></td>
			<td><?php echo _("PORT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txPORT"  id="txPORT" ></td>						
		</tr>
		<tr>
			<td><?php echo _("TON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txTON" id="txTON" ></td>
			<td><?php echo _("NPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txNPI" id="txNPI" ></td>
		</tr>
		<tr>
			<td><?php echo _("ORIGTON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txORIGTON" id="txORIGTON" ></td>
			<td><?php echo _("ORIGNPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txORIGNPI" id="txORIGNPI"></td>
		</tr>
		<tr>
			<td><?php echo _("DESTTON"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txDESTTON" id="txDESTTON"></td>
			<td><?php echo _("DESTNPI"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txDESTNPI" id="txDESTNPI"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTYPE"); ?>:</td><td><input type="text" name="txSYSTYPE" id="txSYSTYPE"></td>
			<td><?php echo _("STATUS"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txSTATUS" id="txSTATUS" ></td>
		</tr>	
		<tr>
			<td><?php echo _("HOSTIP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txHOSTIP" id="txHOSTIP" ></td>
			<td><?php echo _("SHORTCODE"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txSHORTCODE" id="txSHORTCODE" ></td>						
		</tr>
		<tr>
			<td><?php echo _("KEEPALIVEINTERVAL"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txKEEPALIVEINTERVAL" id="txKEEPALIVEINTERVAL"></td>
			<td><?php echo _("RESPONSETIMEOUT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txRESPONSETIMEOUT" id="txRESPONSETIMEOUT"></td>
		</tr>	
		<!--<tr>
			<td>PINPATTERN:</td><td><input type="text" name="txPINPATTERN" id="txPINPATTERN"></td>
			<td>PINREPLACE:</td><td><input type="text" name="txPINREPLACE" id="txPINREPLACE"></td>						
		</tr>-->			
	</table>
	<div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnTransmitterRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
			</a>
			<a id="btnTransmitterCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="txloading"></div>
</div>
<!-- end ui-dialog transmitter -->
<!-- ui-dialog transmitter add -->
<div id="dialogTransmitterAdd" title="<?php echo _("Add Transmitter"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		<tr>
			<td><?php echo _("SYSTEMID"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txaddSYSTEMID"  id="txaddSYSTEMID"></td>
		</tr>
		<tr>
			<td><?php echo _("PASSWORD"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txaddPASSWORD"  id="txaddPASSWORD"></td>
		</tr>
		<tr>
			<td><?php echo _("IP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txaddIP"  id="txaddIP"></td>						
		</tr>
		<tr>
			<td><?php echo _("PORT"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txaddPORT"  id="txaddPORT" value="1188"></td>
		</tr>
		<tr>
			<td><?php echo _("SYSTYPE"); ?>:</td><td><input type="text" name="txaddSYSTYPE" id="txaddSYSTYPE"></td>
		</tr>
		<tr>
			<td><?php echo _("HOSTIP"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txaddHOSTIP" id="txaddHOSTIP"></td>
		</tr>					
		<tr>
			<td><?php echo _("SHORTCODE"); ?><span style="color:red">*</span>:</td><td><input type="text" name="txaddSHORTCODE" id="txaddSHORTCODE" value="444"></td>						
		</tr>								
	</table>
	<div align="right">
		<?php if($this->getRolesConfig('SYSTEM_INFO_EDIT')){ ?>
			<a id="btnTransmitterAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("Add"); ?></span>
			</a>
			<a id="btnTransmitterCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
				<span class="ui-button-text"><?php echo _("cancel"); ?></span>
			</a>
		<?php } ?>
	</div><div class="txaloading"></div>
</div>
<!-- end ui-dialog transmitter add -->
</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	$(function(){
		oTable = $('#dttransmitter').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});

	// Dialog
	$('#dialogTransmitterAdd').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});

	// Dialog
	$('#dialogTransmitter').dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	
	$("#btnTransmitterAdd").click(function(){
		var params = {
				Method:'addTransmitter',
				systemid:$("#txaddSYSTEMID").val(),
				password:$("#txaddPASSWORD").val(),
				ip:$("#txaddIP").val(),
				port:$("#txaddPORT").val(),
				systype:$("#txaddSYSTYPE").val(),
				hostip:$("#txaddHOSTIP").val(),
				shortcode:$("#txaddSHORTCODE").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.txaloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$('.txaloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	

	$("#btnTransmitterRequest").click(function(){
		var params = {
				Method:'requestTransmitter',
				pndgid:$("#txID").val(),
				systemid:$("#txSYSTEMID").val(),
				password:$("#txPASSWORD").val(),
				ip:$("#txIP").val(),
				port:$("#txPORT").val(),
				ton:$("#txTON").val(),
				npi:$("#txNPI").val(),
				origton:$("#txORIGTON").val(),
				orignpi:$("#txORIGNPI").val(),
				destton:$("#txDESTTON").val(),
				destnpi:$("#txDESTNPI").val(),
				systype:$("#txSYSTYPE").val(),
				status:$("#txSTATUS").val(),
				hostip:$("#txHOSTIP").val(),
				shortcode:$("#txSHORTCODE").val(),
				keepaliveinterval:$("#txKEEPALIVEINTERVAL").val(),
				responsetimeout:$("#txRESPONSETIMEOUT").val(),
				pinpattern:$("#txPINPATTERN").val(),
				pinreplace:$("#txPINREPLACE").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.txloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$('.txloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							
					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	$("#btnTransmitterAddR").click(function(){
				 $('#dialogTransmitterAdd').dialog('open');	
	});

	$("#btnTransmitterCancelAdd").click(function(){
				 $('#dialogTransmitterAdd').dialog('close');	
	});
	
	$("#btnTransmitterCancel").click(function(){
				 $('#dialogTransmitter').dialog('close');	
	});
	
	function requestTransmitter(ID, SYSTEMID, PASSWORD, IP, PORT, TON, NPI, ORIGTON, ORIGNPI, DESTTON, DESTNPI, SYSTYPE, STATUS, HOSTIP, SHORTCODE, KEEPALIVEINTERVAL, RESPONSETIMEOUT, PINPATTERN, PINREPLACE){
	$('#dialogTransmitter').dialog('open');
	$("#txID").val(ID);
	$("#txSYSTEMID").val(SYSTEMID);
	$("#txPASSWORD").val(PASSWORD);
	$("#txIP").val(IP);
	$("#txPORT").val(PORT);
	$("#txTON").val(TON);
	$("#txNPI").val(NPI);
	$("#txORIGTON").val(ORIGTON);
	$("#txORIGNPI").val(ORIGNPI);
	$("#txDESTTON").val(DESTTON);
	$("#txDESTNPI").val(DESTNPI);
	$("#txSYSTYPE").val(SYSTYPE);
	$("#txSTATUS").val(STATUS);
	$("#txHOSTIP").val(HOSTIP);
	$("#txSHORTCODE").val(SHORTCODE);
	$("#txKEEPALIVEINTERVAL").val(KEEPALIVEINTERVAL);
	$("#txRESPONSETIMEOUT").val(RESPONSETIMEOUT);
	$("#txPINPATTERN").val(PINPATTERN);
	$("#txPINREPLACE").val(PINREPLACE);
	}
	
	$("#transtx").fadeIn(700);
</script>