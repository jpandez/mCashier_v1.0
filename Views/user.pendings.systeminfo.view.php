<div id="systemInfo" style="width:100%;font-size:10px;display:none;">
	<?php $pendingasysinfo = $this->data("getSystemInfoPndg");?>
	<?php if(isset($pendingasysinfo->ResponseCode)){ ?>
		<?php if(is_array($pendingasysinfo->Value)){?>
			<div style="margin-top:10px";></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtsysinfo" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("SYSTEM INFO"); ?></th>														
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("Approve/Reject"); ?></th>							
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($pendingasysinfo->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="sysinfo_<?php echo $t->ID; ?>">
								<td><?php echo $t->ID; ?></td>
								<td><?php echo $t->CREATEDDATE; ?></td>
								<td width="100%"><?php echo "CURRENCY TYPE : " . $t->CURRENCYTYPE . ", COUNTRY CODE : ". $t->COUNTRYCODE . ", SYSTEM ACCOUNT INFO : ". $t->SYSTEMACCOUNTINFO . ", SENDER NUMBER : ". $t->SENDERNUMBER . ", ACCEPT DECIMAL : ". $t->ACCEPTDECIMAL . ", DEFAULT DEALER PASSWORD : ". $t->DEFAULTDEALERPASSWORD . ", FAILED TRANSFER COUNT : ". $t->FAILEDTRANSFERCOUNT . ", INVALID PASSWORD COUNT : ". $t->INVALIDPASSWORDCOUNT . ", RPRE DAY COUNT : ". $t->RPREDAYCOUNT . ", MIN ALIAS : ". $t->MINALIAS . ", MAX ALIAS : ". $t->MAXALIAS . ", MSISDN TO ALIAS : ". $t->MSISDNTOALIAS . ", MIN ALLOC : ". $t->MINALLOC . ", MAX ALLOC : ". $t->MAXALLOC . ", CRYPT : ". $t->CRYPT; ?></td>
								<td><?php echo $t->CREATEDBY; ?></td>
								<td><a href="javascript:approveSysInfo('<?php echo $t->ID; ?>','APPROVED');"><?php echo ($this->getRolesConfig('APPROVE_SYSTEM_INFO_EDIT')) ? 'Approve' : ''; ?></a> |
									<a href="javascript:approveSysInfo('<?php echo $t->ID; ?>','REJECT');"><?php echo ($this->getRolesConfig('REJECT_SYSTEM_INFO_EDIT')) ? 'Reject' : ''; ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		<?php } else {
			echo "<h3>" . $pendingasysinfo->Message . "</h3>";
		}?>
	<?php } ?>
</div>

<script>
$(document).ready(function() {
			oTable = $('#dtsysinfo').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		});
$("#systemInfo").fadeIn(700);
</script>