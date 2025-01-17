<style nonce="<?php echo $_SESSION['nonce'];?>">
._userlevels{
	width:100%;font-size:10px;display:none;
}
._m-top{
	margin-top:10px;
}
</style>
<div id="userlevels" class="_userlevels">
	<?php $pendinguserslevel = $this->data("getUsersLevelPndg");?>
	<?php if(isset($pendinguserslevel->ResponseCode)){ ?>
		<?php if($pendinguserslevel->ResponseCode==0){ ?>
			<?php if(is_array($pendinguserslevel->Value)){?>
				<div class="_m-top"></div>
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtuserlevel" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("ID"); ?></th>
							<th><?php echo _("CREATED TIMESTAMP"); ?></th>
							<th><?php echo _("USER LEVEL"); ?></th>														
							<th><?php echo _("CREATED BY"); ?></th>
							<th><?php echo _("Approve/Reject"); ?></th>							
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($pendinguserslevel->Value as $t): $ctr++;?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="ulevel_<?php echo $t->ID; ?>">
									<td><?php echo $t->ID; ?></td>
									<td><?php echo $t->CREATEDDATE; ?></td>
									<td><?php echo "USER LEVEL : " . $t->USERSLEVEL . ", SESSIONTIMEOUT : ". $t->SESSIONTIMEOUT . ", PASSWORD EXPIRY : ". $t->PASSWORDEXPIRY . ", MIN PASSWORD : ". $t->MINPASSWORD . ", PASSWORD HISTORY : ". $t->PASSWORDHISTORY . ", MAXALLOCUSER : ". $t->MAXALLOCUSER . ", PASSWORDCHANGE : ". $t->PASSWORDCHANGE . ", NEWPASSWORDEXPIRY : ". $t->NEWPASSWORDEXPIRY; ?></td>
									<td><?php echo $t->CREATEDBY; ?></td>
									<td>
									<!-- <a href="javascript:approveUserLevels('APPROVED','<?php echo $t->ID . "','" . $t->USERSLEVEL; ?>');"><?php echo ($this->getRolesConfig('APPROVE_USERS_LEVEL')) ? 'Approve' : ''; ?></a> |
									<a href="javascript:approveUserLevels('REJECT','<?php echo $t->ID . "','" . $t->USERSLEVEL; ?>');"><?php echo ($this->getRolesConfig('APPROVE_USERS_LEVEL')) ? 'Reject' : ''; ?></a> -->
										<?php if ($this->getRolesConfig('APPROVE_USERS_LEVEL')): ?>
											<button class="btn btn-sm btn-primary approveUserLevels" data-action="APPROVED" data-id="<?php echo $t->ID ?>" data-userslevel="<?php echo $t->USERSLEVEL; ?>">Approve</button> |
											<button class="btn btn-sm btn-primary approveUserLevels" data-action="REJECT" data-id="<?php echo $t->ID ?>" data-userslevel="<?php echo $t->USERSLEVEL; ?>">Reject</button>
										<?php endif;?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			<?php } else {
				echo "<h3> No Records Found</h3>";
			}?>
		<?php } //else { echo "<h3>Please contact the system administrator</h3>"; } ?>
	<?php } ?>
</div>

<script nonce="<?php echo $_SESSION['nonce'];?>">
$(document).ready(function() {
	oTable = $('#dtuserlevel').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button"
	});

	$('.approveUserLevels').on('click', function() {
		var action = $(this).data('action');
		var id = $(this).data('id');
		var userslevel = $(this).data('userslevel');
		approveUserLevels(action, id, userslevel);
	});
} );
$("#userlevels").fadeIn(700);
</script>