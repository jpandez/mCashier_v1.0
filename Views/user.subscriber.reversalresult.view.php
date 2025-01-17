<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $reversal = $this->data("reversal"); $rev = $reversal!=null?($reversal->ResponseCode==0?$reversal->Value:null):null; ?>
<?php $frmsisdn = $this->data("frmsisdn"); $fr = $frmsisdn!=null?($frmsisdn->ResponseCode==0?$frmsisdn->AccountInformation:null):null;?>
<?php $tomsisdn = $this->data("tomsisdn"); $to = $tomsisdn!=null?($tomsisdn->ResponseCode==0?$tomsisdn->AccountInformation:null):null;?>

<div style="visibility:<?php echo isset($rev)?'visible':'hidden' ?>;">
	<table cellpadding="0" cellspacing="0" border="0" class="tablet" id="tblReversal" width="100%">
		<tr>
			<td><?php echo _("TRANSACTION DATE"); ?></td><td><input type="text" id="TIMESTAMP" value="<?php echo isset($rev)?$rev->TIMESTAMP:"" ?>" disabled="disabled"></td>
			<td><?php echo _("REFERENCE ID"); ?></td><td><input type="text" id="REFERENCEID" value="<?php echo isset($rev)?$rev->REFERENCEID:"" ?>" disabled="disabled"></td>
			<td><?php echo _("TYPE"); ?></td><td><input type="text" id="TYPE" value="<?php echo isset($rev)?$rev->TYPE:"" ?>" disabled="disabled"></td>				
		</tr>
		<tr>
			<td><?php echo _("SOURCE"); ?></td><td><input type="text" id="FRMSISDN" value="<?php echo isset($rev)?$rev->FRMSISDN:"" ?>" disabled="disabled"></td>
			<td><?php echo _("DESTINATION"); ?></td><td><input type="text" id="TOMSISDN" value="<?php echo isset($rev)?$rev->TOMSISDN:"" ?>" disabled="disabled"></td>
			<td><?php echo _("AMOUNT"); ?></td><td><input type="text" id="AMOUNT" value="<?php echo isset($rev)?$rev->AMOUNT:"" ?>" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("SOURCE BALANCE BEFORE"); ?></td><td><input type="text" id="ORIGBALANCEBEFORE" value="<?php echo isset($rev)?$rev->ORIGBALANCEBEFORE:"" ?>" disabled="disabled"></td>
			<td><?php echo _("SOURCE BALANCE AFTER"); ?></td><td><input type="text" id="ORIGBALANCEAFTER" value="<?php echo isset($rev)?$rev->ORIGBALANCEAFTER:"" ?>" disabled="disabled"></td>
		</tr>
		<tr>
			<td><?php echo _("DEST BALANCE BEFORE"); ?></td><td><input type="text" id="DESTBALANCEBEFORE" value="<?php echo isset($rev)?$rev->DESTBALANCEBEFORE:"" ?>" disabled="disabled"></td>
			<td><?php echo _("DEST BALANCE AFTER"); ?></td><td><input type="text" id="DESTBALANCEAFTER" value="<?php echo isset($rev)?$rev->DESTBALANCEAFTER:"" ?>" disabled="disabled"></td>
		</tr>				
	</table>
	
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="tblReversalFrTo" width="100%">
		<thead>
			<tr class="ui-widget-header">
				<th><?php echo _("Sender MSISDN"); ?></th>
				<th><?php echo _("Sender Current Amount"); ?></th>
				<th><?php echo _("Recepient MSISDN"); ?></th>
				<th><?php echo _("Recepient Current Amount"); ?></th>				
			</tr>
		</thead>
		<tbody>												
			<tr>
				<td><?php echo isset($fr)?$fr->MobileNumber:"" ?></td>
				<td><?php echo isset($fr)?$fr->CurrentStock:"" ?></td>
				<td><?php echo isset($to)?$to->MobileNumber:"" ?></td>
				<td><?php echo isset($to)?$to->CurrentStock:"" ?></td>				
			</tr>				
		</tbody>
	</table>	
</div>
<div style="margin-top:30px";></div>
<div  align="center" class="tablet" style="visibility:<?php echo ($responseMessage==null)?'visible':'hidden' ?>;" id="reqRev">
	<table >
		<tr>
			<td><?php echo _("Cash Reversal Request"); ?></td>
		</tr>
		<tr>
			<td><?php echo _("Amount"); ?>:</td><td><?php echo isset($rev)?$rev->AMOUNT:"" ?></td>
		</tr>
		<tr>
			<td><?php echo _("Remarks"); ?><span style="color:red">*</span>:</td><td><input type="text" id="reversalRemarks" disabled="disabled"></td>
		</tr>
		<tr>
			<td colspan="2">
				<?php
				if($this->getRolesConfig('CASH_REVERSAL_REQUEST') && ($responseMessage==null)){
					echo "<input type='submit' id='btnRequestReversal' value='". _("Reverse") ."' class='ui-state-default ui-corner-all ui-button'>";
					echo "<input type='submit' id='btnRequestSave' value='". _("Save") ."' class='ui-state-default ui-corner-all ui-button' style='display:none;'>";
					echo "<input type='submit' id='btnRequestCancel' value='". _("cancel") ."' class='ui-state-default ui-corner-all ui-button' style='display:none;'>";
				}
				?>				
				<div class="revloading">
				</div>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});	
	<?php endif;?>
		$("#btnRequestReversal").click(function(){			
			$(this).hide();
			$('#btnRequestSave').show();
			$('#btnRequestCancel').show();
			$("#reversalRemarks").removeAttr('disabled');
		});	
		$("#btnRequestSave").click(function(){			
			$(this).hide();
			$('#btnRequestCancel').hide();
			$('#btnRequestReversal').show();
			$("#reversalRemarks").attr('disabled','disabled');
		});
		$("#btnRequestCancel").click(function(){
			$("#reversalRemarks").val("");
			$("#reversalRemarks").attr('disabled','disabled');
			$(this).hide();
			$('#btnRequestSave').hide();
			$('#btnRequestReversal').show();
		});
		$("#btnRequestSave").click(function(){
			var params = {
						Method:'requestReversal',
						referenceid:$('#REFERENCEID').val(),
						type:$('#TYPE').val(),
						frmsisdn:$('#FRMSISDN').val(),
						tomsisdn:$('#TOMSISDN').val(),
						amount:$('#AMOUNT').val(),
						remarks:$('#reversalRemarks').val(),
						FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};		
				$('.revloading').fadeToggle(300);
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						complete:function(res,status){
							$('.revloading').fadeToggle(300,'linear',function(){
									$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});		
		});
 </script>