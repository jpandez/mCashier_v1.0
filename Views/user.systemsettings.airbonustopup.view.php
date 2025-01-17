<?php require_once("views.config.properties.php"); ?>
<div id="airbonustopup" style="display:none;">
<button id="btnAddAirBonusTopup" class="uibutton"><?php echo _("Add"); ?></button>
	<div id="accountsummary" style="width:100%;font-size:10px;">
		<?php $getAirBonusTopup = $this->data("getAirbonusTopup");?>
		<?php if(isset($getAirBonusTopup->ResponseCode)){ ?>
				<?php if(is_array($getAirBonusTopup->Value)){?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtairbonustopup" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>
						<th><?php echo _("STATUS"); ?></th>
						<th><?php echo _("EDIT REQUEST"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getAirBonusTopup->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<td><?php echo $t->ID; ?></td>
								<td width="100%"><?php echo "PRODUCTID : (" . $t->PRODUCTID . "), MINRANGE : (". $t->MINRANGE . "), MAXRANGE : (". $t->MAXRANGE . "), SERVICECLASS : (". $t->SERVICECLASS . "), DEDICATEDACCOUNTID : (". $t->DEDICATEDACCOUNTID . "), FIXEDAMOUNT : (". $t->FIXEDAMOUNT . "), PERCENTAMOUNT : (". $t->PERCENTAMOUNT . "), EXPIRYDAYS : (". $t->EXPIRYDAYS . "), EXPIRYDATE : (". $t->EXPIRYDATE . "), CREATEDDATE : (". $t->CREATEDDATE . "), MODIFYDATE : (". $t->MODIFYDATE . "), DISABLEDATE : (". $t->DISABLEDATE . "), CREATEDUSER : (". $t->CREATEDUSER . "), MODIFYUSER : (". $t->MODIFYUSER . "), DISABLEUSER : (". $t->DISABLEUSER . "), NAME : (". $t->NAME . "), CELLIDMINRANGE : (". $t->CELLIDMINRANGE . "), CELLIDMAXRANGE : (" . $t->CELLIDMAXRANGE . ")"; ?></td>
								<td><?php echo $t->STATUS==0?'Disabled':'Enabled'; ?></td>
								<td><a href="javascript:requestAirBonusTopup('<?php echo $t->ID."','".$t->PRODUCTID."','".$t->MINRANGE."','".$t->MAXRANGE."','".$t->SERVICECLASS."','".$t->DEDICATEDACCOUNTID."','".$t->FIXEDAMOUNT."','".$t->PERCENTAMOUNT."','".$t->EXPIRYDAYS."','".$t->EXPIRYDATE."','".$t->STATUS."','".$t->CREATEDDATE."','".$t->MODIFYDATE."','".$t->DISABLEDATE."','".$t->CREATEDUSER."','".$t->MODIFYUSER."','".$t->DISABLEUSER."','".$t->NAME."','".$t->CELLIDMINRANGE."','".$t->CELLIDMAXRANGE; ?>')"><?php echo _("Request"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php } else {
				echo "<h3> No Records Found: $getAirBonusTopup->Message</h3>";
			}?>
		<?php } ?>
	</div>

<div id="divAirBonusTopupRequestDialog" title="<?php echo _("Request Air Bonus Topup"); ?>">
	<input type="hidden" name="Method" id="RequestAirBonusTopup"></input>
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" name="airBonusTopupRequest" id="airBonusTopupRequest" class="tablet">
				<tr>
					<td><?php echo _("ID"); ?></td><td><input type="text" id="ab_id" disabled="true"/></td>
					<td><?php echo _("PRODUCT ID"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_productID" /></td>
					<td><?php echo _("SERVICE CLASS"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_serviceClass" /></td>
				</tr>
				<tr>
					<td><?php echo _("DEDICATED ACCOUNT ID"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_dedicatedAccID" /></td>
					<td><?php echo _("STATUS"); ?><span style="color:red">*</span></td><td><select id="ab_status"><option value="0">Disabled</option><option value="1">Enabled</option></select></td>
					<td><?php echo _("NAME"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_name" /></td>
				</tr>
				<tr>
					<td><?php echo _("MIN RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_minRange" /></td>
					<td><?php echo _("CELL ID MIN RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_cellIDMinRange" /></td>
					<td><?php echo _("FIXED AMOUNT"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_fixedAmount" /></td>
				</tr>
				<tr>
					<td><?php echo _("MAX RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_maxRange" /></td>
					<td><?php echo _("CELL ID MAX RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_cellIDMaxRange" /></td>
					<td><?php echo _("PERCENT AMOUNT"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_percentAmount" /></td>
				</tr>
				<tr>
					<td><?php echo _("CREATED DATE"); ?></td><td><input type="text" id="ab_createdDate" disabled="true"/></td>
					<td><?php echo _("MODIFY DATE"); ?></td><td><input type="text" id="ab_modifyDate" disabled="true"/></td>
					<td><?php echo _("DISABLE DATE"); ?></td><td><input type="text" id="ab_disableDate" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("CREATED USER"); ?></td><td><input type="text" id="ab_createdUser" disabled="true"/></td>
					<td><?php echo _("MODIFY USER"); ?></td><td><input type="text" id="ab_modifyUser" disabled="true"/></td>
					<td><?php echo _("DISABLE USER"); ?></td><td><input type="text" id="ab_disableUser" disabled="true"/></td>
				</tr>
				<tr>
					<td><?php echo _("EXPIRY DAYS"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_expiryDays" /></td>
					<td><?php echo _("EXPIRY DATE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_expiryDate" readonly="true" /></td>
				</tr>
			</table>
			<div align="right">
		    	<a id="btnAirBonusTopupRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
		        </a>
		        <a id="btnAirBonusTopupCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
		        </a>                    
			</div><div class="airbonusloading"></div>
		</div>
	</form>
</div>
<div id="divAirBonusTopupAddDialog" title="<?php echo _("Add new Air Bonus Topup"); ?>">
	<form>
		<div class="dAllocate" align="center">
			<table style="text-align:left;" name="airBonusTopupRequest" id="airBonusTopupRequest" class="tablet">
				<tr>
					<td><?php echo _("PRODUCT ID"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_productID"/></td>
					<td><?php echo _("SERVICE CLASS"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_serviceClass"/></td>
				</tr>
				<tr>
					<td><?php echo _("DEDICATED ACCOUNT ID"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_dedicatedAccID"/></td>
					<td><?php echo _("STATUS"); ?><span style="color:red">*</span></td><td><select id="ab_add_status" disabled="true"><option value="1">Disabled</option></select></td>
				</tr>
				<tr>
					<td><?php echo _("MIN RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_minRange" value="1"/></td>
					<td><?php echo _("CELL ID MIN RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_cellIDMinRange" value="1"/></td>
				</tr>
				<tr>
					<td><?php echo _("MAX RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_maxRange" value="10"/></td>
					<td><?php echo _("CELL ID MAX RANGE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_cellIDMaxRange" value="10"/></td>
				</tr>
				<tr>
					<td><?php echo _("FIXED AMOUNT"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_fixedAmount" value="0"/></td>
					<td><?php echo _("PERCENT AMOUNT"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_percentAmount" value="0"/></td>
				</tr>
				<tr>
					<td><?php echo _("EXPIRY DAYS"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_expiryDays" value="0"/></td>
					<td><?php echo _("EXPIRY DATE"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_expiryDate" /></td>
				</tr>
				<tr>
					<td><?php echo _("NAME"); ?><span style="color:red">*</span></td><td><input type="text" id="ab_add_name"/></td>
				</tr>		
			</table>
			<div align="right">
		    	<a id="btnAirBonusTopupAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Add"); ?></span>
		        </a>
		        <a id="btnAirBonusTopupAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
		            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
		        </a>                    
			</div><div class="airbonusaloading"></div>
		</div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">	
	$(function(){
		oTable = $('#dtairbonustopup').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#airbonustopup").fadeIn(1500);

	$('#divAirBonusTopupRequestDialog').dialog({
		autoOpen: false,
		width: 1200,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	$('#divAirBonusTopupAddDialog').dialog({
		autoOpen: false,
		width: 800,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	$("#btnAirBonusTopupCancel").click(function(){
		$('#divAirBonusTopupRequestDialog').dialog('close');
	});

	$("#btnAddAirBonusTopup").click(function(){
		$('#divAirBonusTopupAddDialog').dialog('open');
	});

	$("#btnAirBonusTopupAddCancel").click(function(){
		$('#divAirBonusTopupAddDialog').dialog('close');
	});

	function requestAirBonusTopup(id,productID,minRange,maxRange,serviceClass,dedicatedAccID,fixedAmount,percentAmount,expiryDays,expiryDate,status,createdDate,modifyDate,disableDate,createdUser,modifyUser,disableUser,name,cellIDMinRange,cellIDMaxRange){
		$("#ab_id").val(id);
		$("#ab_productID").val(productID);
		$("#ab_minRange").val(minRange);
		$("#ab_maxRange").val(maxRange);
		$("#ab_serviceClass").val(serviceClass);
		$("#ab_dedicatedAccID").val(dedicatedAccID);
		$("#ab_fixedAmount").val(fixedAmount);
		$("#ab_percentAmount").val(percentAmount);
		$("#ab_expiryDays").val(expiryDays);
		$("#ab_expiryDate").val(expiryDate);
		$("#ab_status").val(status);
		$("#ab_createdDate").val(createdDate);
		$("#ab_modifyDate").val(modifyDate);
		$("#ab_disableDate").val(disableDate);
		$("#ab_createdUser").val(createdUser);
		$("#ab_modifyUser").val(modifyUser);
		$("#ab_disableUser").val(disableUser);
		$("#ab_name").val(name);
		$("#ab_cellIDMinRange").val(cellIDMinRange);
		$("#ab_cellIDMaxRange").val(cellIDMaxRange);
		$("#divAirBonusTopupRequestDialog").dialog('open');
	}

	$("#btnAirBonusTopupRequest").click(function(){
		$('.airbonusloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestAirBonusTopup',
				ID:$("#ab_id").val(),
				PRODUCTID:$("#ab_productID").val(),
				MINRANGE:$("#ab_minRange").val(),
				MAXRANGE:$("#ab_maxRange").val(),
				SERVICECLASS:$("#ab_serviceClass").val(),
				DEDICATEDACCOUNTID:$("#ab_dedicatedAccID").val(),
				FIXEDAMOUNT:$("#ab_fixedAmount").val(),
				PERCENTAMOUNT:$("#ab_percentAmount").val(),
				EXPIRYDAYS:$("#ab_expiryDays").val(),
				EXPIRYDATE:$("#ab_expiryDate").val(),
				STATUS:$("#ab_status").val(),
				CREATEDDATE:$("#ab_createdDate").val(),
				MODIFYDATE:$("#ab_modifyDate").val(),
				DISABLEDATE:$("#ab_disableDate").val(),
				CREATEDUSER:$("#ab_createdUser").val(),
				MODIFYUSER:$("#ab_modifyUser").val(),
				DISABLEUSER:$("#ab_disableUser").val(),
				NAME:$("#ab_name").val(),
				CELLIDMINRANGE:$("#ab_cellIDMinRange").val(),
				CELLIDMAXRANGE:$("#ab_cellIDMaxRange").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$('#divAirBonusTopupRequestDialog').dialog('close');
				}
				$('.airbonusloading').fadeToggle(300,'linear',function(){
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnAirBonusTopupAdd").click(function(){
		$('.airbonusaloading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addAirBonusTopup',
				PRODUCTID:$("#ab_add_productID").val(),
				DEDICATEDACCOUNTID:$("#ab_add_dedicatedAccID").val(),
				MINRANGE:$("#ab_add_minRange").val(),
				MAXRANGE:$("#ab_add_maxRange").val(),
				FIXEDAMOUNT:$("#ab_add_fixedAmount").val(),
				EXPIRYDAYS:$("#ab_add_expiryDays").val(),
				NAME:$("#ab_add_name").val(),
				SERVICECLASS:$("#ab_add_serviceClass").val(),
				CELLIDMINRANGE:$("#ab_add_cellIDMinRange").val(),
				CELLIDMAXRANGE:$("#ab_add_cellIDMaxRange").val(),
				PERCENTAMOUNT:$("#ab_add_percentAmount").val(),
				EXPIRYDATE:$("#ab_add_expiryDate").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$('#divAirBonusTopupAddDialog').dialog('close');
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