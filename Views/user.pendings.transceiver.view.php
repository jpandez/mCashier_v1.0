<div id="transceiver" style="width:100%;font-size:10px;display:none;">
	<?php $getTransceiverPndg = $this->data("getTransceiverPndg");?>
	<?php if(isset($getTransceiverPndg->ResponseCode)){ ?>
		<?php if(is_array($getTransceiverPndg->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="dttransceiver" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("PNDGID"); ?></th>
					<th><?php echo _("CREATED TIMESTAMP"); ?></th>
					<th><?php echo _("TRANSCEIVER CONFIG"); ?></th>														
					<th><?php echo _("CREATED BY"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($getTransceiverPndg->Value as $t): $ctr++;?>
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="trx_<?php echo $t->PNDGID; ?>">
							<td><?php echo $t->PNDGID; ?></td>
							<td><?php echo $t->CREATEDDATE; ?></td>										
							<td width="100%"><?php echo "SYSTEMID : " . $t->SYSTEMID . ", PASSWORD : ". $t->PASSWORD . ", IP : ". $t->IP . ", PORT : ". $t->PORT . ", TON : ". $t->TON . ", NPI : ". $t->NPI . ", ORIGTON : ". $t->ORIGTON . ", ORIGNPI : ". $t->ORIGNPI . ", DESTTON : ". $t->DESTTON . ", DESTNPI : ". $t->DESTNPI . ", SYSTYPE : ". $t->SYSTYPE . ", STATUS : ". $t->STATUS . ", HOSTIP : ". $t->HOSTIP . ", SHORTCODE : ". $t->SHORTCODE . ", KEEPALIVEINTERVAL : ". $t->KEEPALIVEINTERVAL . ", RESPONSETIMEOUT : ". $t->RESPONSETIMEOUT; //. ", PINPATTERN : ". $t->PINPATTERN . ", PINREPLACE : ". $t->PINREPLACE; ?></td>
							<td><?php echo $t->CREATEDBY; ?></td>
							<td><a href="javascript:approveTransceiverPndg('APPROVED','<?php echo $t->PNDGID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_SYSTEM_INFO_EDIT')) ? 'Approve' : ''; ?></a> |
								<a href="javascript:approveTransceiverPndg('REJECT','<?php echo $t->PNDGID; ?>');"><?php echo ($this->getRolesConfig('REJECT_SYSTEM_INFO_EDIT')) ? 'Reject' : ''; ?></a>
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
<script>
$(document).ready(function() {
			oTable = $('#dttransceiver').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		} );
$("#transceiver").fadeIn(700);
</script>