<div id="serverconfig" style="width:100%;font-size:10px;display:none;">
	<?php $getServerConfigPndg = $this->data("getServerConfigPndg");?>
	<?php if(isset($getServerConfigPndg->ResponseCode)){ ?>
		<?php if(is_array($getServerConfigPndg->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtserverconfig" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("PNDGID"); ?></th>
					<th><?php echo _("CREATED TIMESTAMP"); ?></th>
					<th><?php echo _("IP"); ?></th>
					<th><?php echo _("FUNCTION"); ?></th>
					<th><?php echo _("STATUS"); ?></th>														
					<th><?php echo _("CREATED BY"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($getServerConfigPndg->Value as $t): $ctr++;?>
						
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="server_<?php echo $t->PNDGID; ?>">
							<td><?php echo $t->PNDGID; ?></td>
							<td><?php echo $t->CREATEDDATE; ?></td>
							<td><?php echo $t->IP; ?></td>
							<td><?php echo $t->FUNCTION; ?></td>
							<td><?php echo $t->STATUS; ?></td>										
							<td><?php echo $t->CREATEDBY; ?></td>
							<td><a href="javascript:approveServerConfigPndg('APPROVED','<?php echo $t->PNDGID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_SYSTEM_INFO_EDIT')) ? 'Approve' : ''; ?></a> |
								<a href="javascript:approveServerConfigPndg('REJECT','<?php echo $t->PNDGID; ?>');"><?php echo ($this->getRolesConfig('REJECT_SYSTEM_INFO_EDIT')) ? 'Reject' : ''; ?></a>
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
			oTable = $('#dtserverconfig').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		} );
$("#serverconfig").fadeIn(700);
</script>