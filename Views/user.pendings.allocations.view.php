<div id="divallocations" style="width:100%;font-size:10px;display:none;">
	<?php $pendingallocation = $this->data("getAllocationPndg"); ?>
	<?php if(isset($pendingallocation->ResponseCode)){ ?>
		<?php if(is_array($pendingallocation->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="allocations" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("CREATED TIMESTAMP"); ?></th>
					<th><?php echo _("REFERENCEID ID"); ?></th>
					<th><?php echo _("AUTHORIZED MOBILE NUMBER"); ?></th>
					<th><?php echo _("AMOUNT"); ?></th>
					<th><?php echo _("REMARKS"); ?></th>															
					<th><?php echo _("STATUS TYPE"); ?></th>
					<th><?php echo _("CREATED BY"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($pendingallocation->Value as $t): $ctr++;?>
						<?php if ($t->TYPE == 'DEALLOC' && $this->getRolesConfig('VIEW_PENDING_DEALLOCATIONS')){ ?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="alloc_<?php echo $t->REFERENCEID; ?>">
								<td><?php echo $t->TIMESTAMP; ?></td>
								<td><?php echo $t->REFERENCEID; ?></td>
								<td><?php echo $t->FRMSISDN; ?></td>
								<td><?php echo $t->AMOUNT; ?></td>
								<td><?php echo $t->REMARKS; ?></td>
								<td><?php echo $t->TYPE; ?></td>
								<td><?php echo $t->EXTENDEDDATA; ?></td>
								<td><a href="javascript:approveAllocation('<?php echo $t->FRMSISDN; ?>','APPROVED','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>');"><?php echo ($this->getRolesConfig('APPROVE_DEALLOCATION') ? 'Approve dealloc' : ''); ?></a> |
									<a href="javascript:approveAllocation('<?php echo $t->FRMSISDN; ?>','REJECT','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>');"><?php echo ($this->getRolesConfig('REJECT_DEALLOCATION') ? 'Reject dealloc' : ''); ?></a>
								</td>
							</tr>
						<?php } ?>
						<?php if ($t->TYPE == 'ALLOC' && $this->getRolesConfig('VIEW_PENDING_ALLOCATIONS')){ ?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="alloc_<?php echo $t->REFERENCEID; ?>">
								<td><?php echo $t->TIMESTAMP; ?></td>
								<td><?php echo $t->REFERENCEID; ?></td>
								<td><?php echo $t->TOMSISDN; ?></td>
								<td><?php echo $t->AMOUNT; ?></td>
								<td><?php echo $t->REMARKS; ?></td>
								<td><?php echo $t->TYPE; ?></td>
								<td><?php echo $t->EXTENDEDDATA; ?></td>
								<td><a href="javascript:approveAllocation('<?php echo $t->TOMSISDN; ?>','APPROVED','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>');"><?php echo ($this->getRolesConfig('APPROVE_ALLOCATION') ? 'Approve alloc' : ''); ?></a> |
									<a href="javascript:approveAllocation('<?php echo $t->TOMSISDN; ?>','REJECT','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>');"><?php echo ($this->getRolesConfig('REJECT_ALLOCATION') ? 'Reject alloc' : ''); ?></a>
								</td>
							</tr>
						<?php } ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php } else {
					echo "<h3>". $pendingallocation->Message;
					if ($pendingallocation->Message == "Success"){ echo ": No Records Found."; }
					echo "</h3>";
				}?>
	<?php } ?>
</div>
			
<script>
$(document).ready(function() {
			oTable = $('#allocations').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		});
$("#divallocations").fadeIn(700);
</script>