<div id="accountsummary" style="width:100%;font-size:10px;">
	<?php $reversal = $this->data("reversal"); ?>
	<?php if(isset($reversal->ResponseCode)){ ?>
		<?php if(is_array($reversal->Value)){?>
			<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="reversal" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("REFERENCEID ID"); ?></th>
						<th><?php echo _("SOURCE MOBILE"); ?></th>
						<th><?php echo _("DEST NUMBER"); ?></th>
						<th><?php echo _("AMOUNT"); ?></th>
						<th><?php echo _("REMARKS"); ?></th>															
						<th><?php echo _("STATUS TYPE"); ?></th>
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("Approve/Reject"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($reversal->Value as $t): $ctr++;?>									
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="reversal_<?php echo $t->OLDREFERENCEID; ?>">
								<td><?php echo $t->TIMESTAMP; ?></td>
								<td><?php echo $t->OLDREFERENCEID; ?></td>
								<td><?php echo $t->FRMSISDN; ?></td>
								<td><?php echo $t->TOMSISDN; ?></td>
								<td><?php echo $t->AMOUNT; ?></td>
								<td><?php echo $t->REMARKS; ?></td>
								<td><?php echo $t->TYPE; ?></td>
								<td><?php echo $t->EXTENDEDDATA; ?></td>
								<td><a href="javascript:approveReversal('<?php echo $t->FRMSISDN; ?>','<?php echo $t->TOMSISDN; ?>','APPROVE','<?php echo $t->OLDREFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>');"><?php echo ($this->getRolesConfig('APPROVE_CASH_REVERSAL') ? 'Approve' : '')?></a> |
									<a href="javascript:approveReversal('<?php echo $t->FRMSISDN; ?>','<?php echo $t->TOMSISDN; ?>','REJECT','<?php echo $t->OLDREFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>');"><?php echo ($this->getRolesConfig('APPROVE_CASH_REVERSAL') ? 'Reject' : '')?></a>
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
			oTable = $('#reversal').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		} );
</script>