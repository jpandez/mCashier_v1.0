<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.loading_tr, .ploading_tr, .rloading_tr, .revloading_tr {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
._pendingterminal_tr{
	display:none;margin-top:15px;
}
._terminalsummary_tr{
	width:100%;font-size:10px;
}
._m-top_tr{
	margin-top:10px;
}
._d-none_tr{
	display:none;
}
</style>
<div id="pendingterminal_tr" class="_pendingterminal_tr">
<div id="terminalsummary_tr" class="_terminalsummary_tr">
<?php $pendingTerminalID = $this->data("terminalIDPending"); ?>
<?php if(isset($pendingTerminalID->ResponseCode)){ ?>
	<?php if(is_array($pendingTerminalID->Value)){?>
		<div class="_m-top_tr"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="terminalIDTable_tr" width="100%">
			<thead>
			<tr class="ui-widget-header">
				<th><?php echo _("COMPANY"); ?></th>
				<th><?php echo _("MSISDN"); ?></th>
				<th><?php echo _("MERCHANT MSISDN"); ?></th>
				<th><?php echo _("TERMINAL ID"); ?></th>
				<th><?php echo _("FIRST NAME"); ?></th>
				<th><?php echo _("LAST NAME"); ?></th>
				<th><?php echo _("USER ID"); ?></th>
				<th><?php echo _("Approve/Reject"); ?></th>							
			</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($pendingTerminalID->Value as $t): $ctr++;?>
					<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="terminalPending_tr<?php echo $t->REFERENCEID; ?>">
						<td><?php echo $t->COMPANY; ?></td>
						<td><?php echo $t->MSISDN; ?></td>
						<td><?php echo $t->MERCHANTMSISDN; ?></td>
						<td><?php echo $t->TERMINALID; ?></td>
						<td><?php echo $t->FIRSTNAME; ?></td>
						<td><?php echo $t->LASTNAME; ?></td>
						<td><?php echo $t->EXTENDEDDATA; ?></td>
						<td><!--<a href="javascript:approveTerminalIDPndg('APPROVE','<?php echo $t->REFERENCEID; ?>','<?php echo $t->MSISDN; ?>','<?php echo $t->TERMINALID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_TERMINALID_PENDING')) ? 'Approve' : ''; ?></a> -->
							<?php if ($this->getRolesConfig('APPROVE_TERMINALID_PENDING')): ?><button class="btn btn-sm btn-primary approve-link_tr" data-action="APPROVE" data-referenceid="<?php echo $t->REFERENCEID; ?>" data-msisdn="<?php echo $t->MSISDN; ?>" data-terminalid="<?php echo $t->TERMINALID; ?>">Approve</button><?php endif; ?> |
							<!-- <a href="javascript:approveTerminalIDPndg('REJECT','<?php echo $t->REFERENCEID; ?>','<?php echo $t->MSISDN; ?>','<?php echo $t->TERMINALID; ?>');"><?php echo ($this->getRolesConfig('REJECT_TERMINALID_PENDING')) ? 'Reject' : ''; ?></a> -->
							<?php if ($this->getRolesConfig('REJECT_TERMINALID_PENDING')):?><button class="btn btn-sm btn-primary approve-link_tr" data-action="REJECT" data-referenceid="<?php echo $t->REFERENCEID; ?>" data-msisdn="<?php echo $t->MSISDN; ?>" data-terminalid="<?php echo $t->TERMINALID; ?>">Reject</button><?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php } 
		else {
			//echo "<h3>". $pendingTerminalID->Message ."</h3>";
			echo "<h3>No Record Found</h3>";
		}?>
<?php } ?>
</div>
</div>

<div id="dialogApproveTerminal_tr" title="<?php echo _("New MSISDN for Terminal ID"); ?>">
	<div class="dLock" align="center">
		<table class="text-start tablet">
			<tr >
				<td><?php echo _("TYPE"); ?>:</td>
				<td><input type="text" id="txtApprovalType_tr" disabled></td>
			</tr>
			<tr >
				<td><?php echo _("Approval Reference"); ?>:</td>
				<td><input type="text" id="txtApprovalReference_tr" disabled></td>
			</tr>
			<tr>
				<td><?php echo _("Terminal ID"); ?>:</td>
				<td><input type="text" id="txtTerminalID_tr" disabled></td>
			</tr>
			<tr>
				<td><?php echo _("Old MSISDN"); ?>:</td>
				<td><input type="text" id="txtOldMsisdn_tr" disabled></td>
			</tr>
			<tr>
				<td><?php echo _("New MSISDN"); ?><span class="text-danger">*</span> :</td>
				<td><input type="text" id="txtNewMsisdn_tr" ></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnApproveTerminal_tr" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="dialogRejectTerminal_tr" title="<?php echo _("Reject Terminal Removal"); ?>">
	<div class="dLock" align="center">
		<table class="text-start tablet">
			<tr >
				<td><?php echo _("TYPE"); ?>:</td>
				<td><input type="text" id="txtRApprovalType_tr" disabled></td>
			</tr>
			<tr >
				<td><?php echo _("Approval Reference"); ?>:</td>
				<td><input type="text" id="txtRApprovalReference_tr" disabled></td>
			</tr>
			<tr>
				<td><?php echo _("Terminal ID"); ?>:</td>
				<td><input type="text" id="txtRTerminalID_tr" disabled></td>
			</tr>
			<tr>
				<td><?php echo _("MSISDN"); ?>:</td>
				<td><input type="text" id="txtROldMsisdn_tr" disabled></td>
			</tr>
			<tr class="_d-none_tr">
				<td><?php echo _("New MSISDN"); ?>:</td>
				<td><input type="text" id="txtRNewMsisdn_tr" ></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button  id="btnRejectTerminal_tr" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Reject"); ?></button>
					<div class="lockloading"></div>
				</td>
			</tr>
		</table>
	</div>
</div>

<div class="ploading_tr"></div>

<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

		var ht = $("#pendingterminal_tr").css('height');
		ht = ht.replace("px","");
		//$("#pendingreg",window.parent.document).css('height',parseInt(ht)+200);
$(document).ready(function() {

	$('.approve-link_tr').on('click', function() {
		var action = $(this).data('action');
		var referenceid = $(this).data('referenceid');
		var msisdn = $(this).data('msisdn');
		var terminalid = $(this).data('terminalid');
		approveTerminalIDPndg(action, referenceid, msisdn, terminalid)
	});

	$(".buttonx").button();

	oTable = $('#terminalIDTable_tr').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button",
		"aaSorting": [[0, "desc" ]]
	});


	$('#dialogApproveTerminal_tr, #dialogRejectTerminal_tr').dialog({
		autoOpen: false,
		width: 700,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		// position: 'center',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
});
$("#pendingterminal_tr").fadeIn(700);

function approveTerminalIDPndg(strremarks, strid, strmsisdn, terminalid){
	if(strremarks == "APPROVE"){
		$("#dialogApproveTerminal_tr").dialog('open');
		$("#txtApprovalReference_tr").val(strid);
		$("#txtTerminalID_tr").val(terminalid);
		$("#txtApprovalType_tr").val(strremarks);
		$("#txtOldMsisdn_tr").val(strmsisdn);
	}
	if(strremarks == "REJECT"){
		$("#dialogRejectTerminal_tr").dialog('open');
		$("#txtRApprovalReference_tr").val(strid);
		$("#txtRTerminalID_tr").val(terminalid);
		$("#txtRApprovalType_tr").val(strremarks);
		$("#txtROldMsisdn_tr").val(strmsisdn);
	}
}

$("#btnApproveTerminal_tr").click(function(){
	$('#btnApproveTerminal_tr').prop("disabled", true);
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	
	var params = {
				Method:'approveTerminalIDPndg',
				remarks: $("#txtApprovalType_tr").val(),
				id: $("#txtApprovalReference_tr").val(),
				msisdn: $("#txtOldMsisdn_tr").val(),
				newmsisdn: $("#txtNewMsisdn_tr").val(),
				terminalid: $("#txtTerminalID_tr").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			$('.scloading').fadeToggle(300);			
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					dataType:'json',
					success:function(json){
						//$('#dialogApproveTerminal_tr').dialog('close');
						if(json.ResponseCode == 0){
							$("#terminalPending_tr" + $("#txtApprovalReference_tr").val()).hide();
							$('#dialogApproveTerminal_tr').dialog('close');
						}							
						$('.scloading').fadeToggle(300,'linear',function(){
								$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
	
	$('#btnApproveTerminal_tr').prop("disabled", false);
});

$("#btnRejectTerminal_tr").click(function(){
	$('#btnRejectTerminal_tr').prop("disabled", true);
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	
	var params = {
				Method:'approveTerminalIDPndg',
				remarks: $("#txtRApprovalType_tr").val(),
				id: $("#txtRApprovalReference_tr").val(),
				msisdn: $("#txtROldMsisdn_tr").val(),
				newmsisdn: $("#txtRNewMsisdn_tr").val(),
				terminalid: $("#txtRTerminalID_tr").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			$('.scloading').fadeToggle(300);			
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					dataType:'json',
					success:function(json){
						$('#dialogRejectTerminal_tr').dialog('close');
						if(json.ResponseCode == 0){
							$("#terminalPending_tr" + $("#txtRApprovalReference_tr").val()).hide();	
						}							
						$('.scloading').fadeToggle(300,'linear',function(){
								$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
					}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});

	setTimeout($.unblockUI, 1000);
	$('#btnRejectTerminal_tr').prop("disabled", false);
});
</script>