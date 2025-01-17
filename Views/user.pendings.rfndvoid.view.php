<style nonce="<?php echo $_SESSION['nonce'];?>">
._accountsummary_rd{
	width:100%;font-size:10px;
}
._m-top{
	margin-top:10px;
}
</style>
<div id="accountsummary"class="_accountsummary_rd">
	<?php $reversal = $this->data("reversal"); ?>
	<?php if(isset($reversal->ResponseCode)){ ?>
		<?php if(is_array($reversal->Value)){?>
			<div class="_m-top"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="reversal" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("REFERENCEID ID"); ?></th>
						<th><?php echo _("MOBILE NUMBER"); ?></th>
						<th><?php echo _("AMOUNT"); ?></th>
						<th><?php echo _("REMARKS"); ?></th>															
						<th><?php echo _("STATUS TYPE"); ?></th>
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("Approve/Reject"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($reversal->Value as $t): $ctr++;?>									
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="refund_<?php echo $t->OLDREFERENCEID; ?>">
								<td><?php echo $t->TIMESTAMP; ?></td>
								<td><?php echo $t->OLDREFERENCEID; ?></td>
								<td><?php echo $t->MSISDN; ?></td>
								<td><?php echo $t->AMOUNT; ?></td>
								<td><?php echo $t->REMARKS; ?></td>
								<td><?php echo $t->TYPE; ?></td>
								<td><?php echo $t->EXTENDEDDATA; ?></td>
								<td>
									<!-- <a href="javascript:approveRfndVoid('<?php echo $t->MSISDN; ?>','APPROVE','<?php echo $t->OLDREFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>');"><?php echo ($this->getRolesConfig('APPROVE_RFNDVOID') ? 'Approve' : '')?></a> |
									<a href="javascript:approveRfndVoid('<?php echo $t->MSISDN; ?>','REJECT','<?php echo $t->OLDREFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>');"><?php echo ($this->getRolesConfig('APPROVE_RFNDVOID') ? 'Reject' : '')?></a> -->
									<?php if($this->getRolesConfig('APPROVE_RFNDVOID')):?>
									<button class="btn btn-sm btn-primary approveRfndVoid" data-msisdn="<?php echo $t->MSISDN; ?>" data-action="APPROVE" data-oldreferenceid="<?php echo $t->OLDREFERENCEID; ?>" data-amount="<?php echo $t->AMOUNT; ?>" data-remarks="<?php echo str_replace("'","\'",$t->REMARKS); ?>">Approve</button> |
									<button class="btn btn-sm btn-primary approveRfndVoid" data-msisdn="<?php echo $t->MSISDN; ?>" data-action="REJECT" data-oldreferenceid="<?php echo $t->OLDREFERENCEID; ?>" data-amount="<?php echo $t->AMOUNT; ?>" data-remarks="<?php echo str_replace("'","\'",$t->REMARKS); ?>">Reject</button>
									<?php endif; ?>
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

<script nonce="<?php echo $_SESSION['nonce'];?>">
$(document).ready(function() {
	oTable = $('#reversal').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button"
	});

	$('.approveRfndVoid').on('click', function() {
		var msisdn = $(this).data('msisdn');
		var action = $(this).data('action');
		var oldreferenceid = $(this).data('oldreferenceid');
		var amount = $(this).data('amount');
		var remarks = $(this).data('remarks');
		approveRfndVoid(msisdn,action,oldreferenceid,amount,remarks)
	});
} );
</script>