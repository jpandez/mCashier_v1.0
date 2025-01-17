<div id="messages" style="width:100%;font-size:10px;display:none;">
	<?php $pendingmessages = $this->data("getMessagesPndg");?>
	<?php if(isset($pendingmessages->ResponseCode)){ ?>
		<?php if(is_array($pendingmessages->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtmessage" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("ID"); ?></th>
					<th><?php echo _("CREATED TIMESTAMP"); ?></th>
					<th><?php echo _("MESSAGE"); ?></th>														
					<th><?php echo _("CREATED BY"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($pendingmessages->Value as $t): $ctr++;?>
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="msg_<?php echo $t->ID; ?>">
							<td><?php echo $t->ID; ?></td>
							<td><?php echo $t->CREATEDDATE; ?></td>
							<td width="100%"><?php echo "MSGID : " . $t->MSGID . ", LANGUAGE : ". $t->LANGUAGE . ", MESSAGE : ". $t->MESSAGE . ", TYPE : ". $t->TYPE . ", DESCRIPTION : ". $t->DESCRIPTION; ?></td>
							<td><?php echo $t->CREATEDBY; ?></td>
							<td><a href="javascript:approveMessagesPndg('APPROVED','<?php echo $t->ID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_MESSAGES_CHANGES')) ? 'Approve' : ''; ?></a> |
								<a href="javascript:approveMessagesPndg('REJECT','<?php echo $t->ID; ?>');"><?php echo ($this->getRolesConfig('REJECT_MESSAGES_CHANGES')) ? 'Reject' : ''; ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php } else {
			echo "<h3>". $pendingmessages->Message ."</h3>";
		}?>
	<?php } ?>
</div>

<script>
$(document).ready(function() {
			oTable = $('#dtmessage').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		} );
$("#messages").fadeIn(700);
</script>