<?php require_once("views.config.properties.php"); ?>
<div id="divallocationsB" style="display:none;">
	<div class="uitabs">
		<ul>
			<?php if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS')){ ?>
			<li><a href="#bankConfirmationTab"><?php echo _("Bank Allocation Confirmation"); ?></a></li><?php }?>
			<?php if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS_BANK_APPROVAL')){ ?>
			<li><a href="#bankApprovalTab"><?php echo _("Bank Allocation Approval"); ?></a></li><?php }?>
			
		</ul>
		<?php if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS')){ ?>
		<div id="bankConfirmationTab" style="font-size:10px;margin-top:15px;">
			<?php $getAllocationB2WPndg = $this->data("getAllocationB2WPndg"); ?>
			<?php if(isset($getAllocationB2WPndg->ResponseCode)){ ?>
				<?php if(is_array($getAllocationB2WPndg->Value)){?>
					<div style="margin-top:10px";></div>
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="allocationsBankConfirm" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("CREATED TIMESTAMP"); ?></th>
							<th><?php echo _("REFERENCEID ID"); ?></th>
							<th><?php echo _("AUTHORIZED MOBILE NUMBER"); ?></th>
							<th><?php echo _("BANK REFERENCE"); ?></th>
							<th><?php echo _("AMOUNT"); ?></th>
							<th><?php echo _("REMARKS"); ?></th>															
							<th><?php echo _("STATUS TYPE"); ?></th>
							<th><?php echo _("CREATED BY"); ?></th>
							<th><?php echo _("Approve/Reject"); ?></th>							
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getAllocationB2WPndg->Value as $t): $ctr++;?>
								<?php $t->EXTENDEDDATA = json_decode(html_entity_decode($t->EXTENDEDDATA), true); ?>
								<?php if ($t->TYPE == 'B2WG' && $this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS')){ ?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="allocB2W_<?php echo $t->REFERENCEID; ?>">
										<td><?php echo $t->TIMESTAMP; ?></td>
										<td><?php echo $t->REFERENCEID; ?></td>
										<td><?php echo $t->TOMSISDN; ?></td>
										<td width="50%"><?php echo $t->EXTENDEDDATA["bankreference"]; ?></td>
										<td><?php echo $t->AMOUNT; ?></td>
										<td><?php echo $t->REMARKS; ?></td>
										<td width="20%"><?php echo $t->TYPE . " (Bank to Wallet)"; ?></td>
										<td><?php echo $t->EXTENDEDDATA["username"]; ?></td>
										<td><a href="javascript:confirmB2WAllocation('<?php echo $t->TOMSISDN; ?>','CONFIRM','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $t->EXTENDEDDATA["bankreference"]; ?>');"><?php echo ($this->getRolesConfig('CONFIRM_BANK_ALLOCATION') && $t->EXTENDEDDATA["username"] != $_SESSION["currentUser"] ? 'Confirm' : ''); ?></a> |
											<a href="javascript:confirmB2WAllocation('<?php echo $t->TOMSISDN; ?>','REJECT','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $t->EXTENDEDDATA["bankreference"]; ?>');"><?php echo ($this->getRolesConfig('REJECT_CONFIRM_BANK_ALLOCATION') && $t->EXTENDEDDATA["username"] != $_SESSION["currentUser"] ? 'Reject' : ''); ?></a>
										</td>
									</tr>
								<?php } ?>
								
								<?php if ($t->TYPE == 'W2BI' && $t->EXTENDEDDATA["username"] != $_SESSION["currentUser"] && $this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS')){ ?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="allocB2W_<?php echo $t->REFERENCEID; ?>">
										<td><?php echo $t->TIMESTAMP; ?></td>
										<td><?php echo $t->REFERENCEID; ?></td>
										<td><?php echo $t->FRMSISDN; ?></td>
										<td><?php echo $bankref = "Bank Name:(" . $t->EXTENDEDDATA["bankname"] ."), Branch:(" . $t->EXTENDEDDATA["bankbranch"] . "), Account Number:(" . $t->EXTENDEDDATA["accountnumber"] . "), Reference:(" . $t->EXTENDEDDATA["reference"] . ")"; ?></td>
										<td><?php echo $t->AMOUNT; ?></td>
										<td><?php echo $t->REMARKS; ?></td>
										<td><?php echo $t->TYPE . " (Wallet to Bank)"; ?></td>
										<td><?php echo $t->EXTENDEDDATA["username"]; ?></td>
										<td><a href="javascript:confirmW2BAllocation('<?php echo $t->FRMSISDN; ?>','CONFIRM','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $bankref; ?>');"><?php echo ($this->getRolesConfig('CONFIRM_BANK_ALLOCATION') ? 'Confirm' : ''); ?></a> |
											<a href="javascript:confirmW2BAllocation('<?php echo $t->FRMSISDN; ?>','REJECT','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $bankref; ?>');"><?php echo ($this->getRolesConfig('REJECT_CONFIRM_BANK_ALLOCATION') ? 'Reject' : ''); ?></a>
										</td>
									</tr>
								<?php } ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php } else {
							echo "<h3>No Records Found : $getAllocationB2WPndg->Message</h3>";
						}?>
			<?php } ?>
		</div>
		<?php }?>
		
		<?php if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS_BANK_APPROVAL')){ ?>
		<div id="bankApprovalTab" style="font-size:10px;margin-top:15px;">
			<?php $getBankPndg = $this->data("getBankPndg"); ?>
			<?php if(isset($getBankPndg->ResponseCode)){ ?>
				<?php if(is_array($getBankPndg->Value)){?>
					<div style="margin-top:10px";></div>
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="allocationsBankApproval" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("CREATED TIMESTAMP"); ?></th>
							<th><?php echo _("REFERENCEID ID"); ?></th>
							<th><?php echo _("AUTHORIZED MOBILE NUMBER"); ?></th>
							<th><?php echo _("BANK REFERENCE"); ?></th>
							<th><?php echo _("AMOUNT"); ?></th>
							<th><?php echo _("REMARKS"); ?></th>															
							<th><?php echo _("STATUS TYPE"); ?></th>
							<th><?php echo _("CREATED BY"); ?></th>
							<th><?php echo _("Approve/Reject"); ?></th>							
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getBankPndg->Value as $t): $ctr++;?>
								<?php $t->EXTENDEDDATA = json_decode(html_entity_decode($t->EXTENDEDDATA), true); ?>
								<?php if ($t->TYPE == 'B2WG' && $t->CONFIRMEDBY != $_SESSION["currentUser"] && $this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS_BANK_APPROVAL')){ ?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="allocB2Wap_<?php echo $t->REFERENCEID; ?>">
										<td><?php echo $t->TIMESTAMP; ?></td>
										<td><?php echo $t->REFERENCEID; ?></td>
										<td><?php echo $t->TOMSISDN; ?></td>
										<td width="50%"><?php echo $t->EXTENDEDDATA["bankreference"]; ?></td>
										<td><?php echo $t->AMOUNT; ?></td>
										<td><?php echo $t->REMARKS; ?></td>
										<td width="20%"><?php echo $t->TYPE . " (Bank to Wallet)"; ?></td>
										<td><?php echo $t->EXTENDEDDATA["username"]; ?></td>
										<td><a href="javascript:approveB2WAllocation('<?php echo $t->TOMSISDN; ?>','APPROVE','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $t->EXTENDEDDATA["bankreference"]; ?>');"><?php echo ($this->getRolesConfig('APPROVE_BANK_ALLOCATION') ? 'Approve' : ''); ?></a> |
											<a href="javascript:approveB2WAllocation('<?php echo $t->TOMSISDN; ?>','REJECT','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $t->EXTENDEDDATA["bankreference"]; ?>');"><?php echo ($this->getRolesConfig('REJECT_BANK_ALLOCATION') ? 'Reject' : ''); ?></a>
										</td>
									</tr>
								<?php } ?>
								
								<?php if ($t->TYPE == 'W2BI' && $t->CONFIRMEDBY != $_SESSION["currentUser"] && $this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS_BANK_APPROVAL')){ ?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="allocB2Wap_<?php echo $t->REFERENCEID; ?>">
										<td><?php echo $t->TIMESTAMP; ?></td>
										<td><?php echo $t->REFERENCEID; ?></td>
										<td><?php echo $t->FRMSISDN; ?></td>
										<td><?php echo $bankref2 = "Bank Name:(" . $t->EXTENDEDDATA["bankname"] ."), Branch:(" . $t->EXTENDEDDATA["bankbranch"] . "), Account Number:(" . $t->EXTENDEDDATA["accountnumber"] . "), Reference:(" . $t->EXTENDEDDATA["reference"] . ")"; ?></td>
										<td><?php echo $t->AMOUNT; ?></td>
										<td><?php echo $t->REMARKS; ?></td>
										<td><?php echo $t->TYPE . " (Wallet to Bank)"; ?></td>
										<td><?php echo $t->EXTENDEDDATA["username"]; ?></td>
										<td><a href="javascript:approveW2BAllocation('<?php echo $t->FRMSISDN; ?>','APPROVE','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $bankref2; ?>','<?php echo $t->EXTENDEDDATA["accountnumber"]; ?>','<?php echo $t->EXTENDEDDATA["bankname"]; ?>','<?php echo $t->EXTENDEDDATA["reference"]; ?>');"><?php echo ($this->getRolesConfig('APPROVE_BANK_ALLOCATION') ? 'Approve' : ''); ?></a> |
											<a href="javascript:approveW2BAllocation('<?php echo $t->FRMSISDN; ?>','REJECT','<?php echo $t->ID; ?>','<?php echo $t->REFERENCEID; ?>','<?php echo $t->AMOUNT; ?>','<?php echo str_replace("'","\'",$t->REMARKS); ?>','<?php echo $t->TYPE; ?>','<?php echo $bankref2; ?>','<?php echo $t->EXTENDEDDATA["accountnumber"]; ?>','<?php echo $t->EXTENDEDDATA["bankname"]; ?>','<?php echo $t->EXTENDEDDATA["reference"]; ?>');"><?php echo ($this->getRolesConfig('REJECT_BANK_ALLOCATION') ? 'Reject' : ''); ?></a>
										</td>
									</tr>
								<?php } ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php } else {
							echo "<h3>No Records Found : $getBankPndg->Message</h3>";
						}?>
			<?php } ?>
		</div>
		<?php }?>
	</div>


<div id="dialogPndgAllocationCheckBankConfirm" title="<?php echo _("Pending BANK to Wallet Allocation for Confirmation"); ?>">
	<div id="app_sendingMsg" style="display:none;"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
	<div id="app_resultMsg"></div>
    <form>
	    <input id="allocTransIDBankConfirm" type="hidden">
	    <input id="allocValueBankConfirm" type="hidden"> 
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" id="allocMsisdnBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" id="allocRefIDBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("BANK REFERENCE"); ?> :</td><td><input type="text" id="allocBankRefIDBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" id="allocAmountBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?> :</td><td><input type="text" id="allocTypeBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" id="allocStatusBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" id="allocRemarksBankConfirm" readonly="readonly"></td>
			</tr>
			<td>
				<a href="javascript:B2WAllocationImage();"><?php echo _("Check Image"); ?></a>
			</td>
			<td>
				
			</td>
								
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('CONFIRM_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_CONFIRM_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveCheckBankConfirm' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' id='allocValBankConfirm'></span>
					</a>";
				}
			?>
            <a id="btnAllocCancelCheckBankConfirm" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<div id="dialogPndgAllocationBankConfirm" title="<?php echo _("Pending BANK to Wallet Allocation for Confirmation"); ?>">
    <form>
	    
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td colspan="2"><span id="allocConfirmBankConfirm"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="allocPasswordBankConfirm">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('CONFIRM_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_CONFIRM_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveBankConfirm' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' >OK</span>
					</a>";
				}
			?>
            <a id="btnAllocCancelBankConfirm" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><div class="allocloadingB2W"></div>
	</form>
</div>	

<div id="dialogPndgAllocationCheckWalletBankConfirm" title="<?php echo _("Pending Wallet to Bank Allocation for Confirmation"); ?>">
	<div id="app_sendingMsg" style="display:none;"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
	<div id="app_resultMsg"></div>
    <form>
	    <input id="allocTransIDWalletBankConfirm" type="hidden">
	    <input id="allocValueWalletBankConfirm" type="hidden"> 
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" id="allocMsisdnWalletBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" id="allocRefIDWalletBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("BANK REFERENCE"); ?> :</td><td><span id='allocBankRefIDWalletBankConfirm'></span></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" id="allocAmountWalletBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?> :</td><td><input type="text" id="allocTypeWalletBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" id="allocStatusWalletBankConfirm" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" id="allocRemarksWalletBankConfirm" readonly="readonly"></td>
			</tr>
								
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('CONFIRM_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_CONFIRM_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveCheckWalletBankConfirm' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' id='allocValWalletBankConfirm'></span>
					</a>";
				}
			?>
            <a id="btnAllocCancelCheckWalletBankConfirm" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<div id="dialogPndgAllocationWalletBankConfirm" title="<?php echo _("Pending Wallet to Bank Allocation for Confirmation"); ?>">
    <form>
	    
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td colspan="2"><span id="allocConfirmWalletBankConfirm"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="allocPasswordWalletBankConfirm">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('CONFIRM_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_CONFIRM_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveWalletBankConfirm' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' >OK</span>
					</a>";
				}
			?>
            <a id="btnAllocCancelWalletBankConfirm" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><div class="allocloadingW2B"></div>
	</form>
</div>
		
<!-- bank approvals -->
<div id="dialogCheckBankApprove" title="<?php echo _("Pending BANK to Wallet Allocation for Approval"); ?>">
	<div id="app_sendingMsg" style="display:none;"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
	<div id="app_resultMsg"></div>
    <form>
	    <input id="allocTransIDBankApprove" type="hidden">
	    <input id="allocValueBankApprove" type="hidden"> 
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" id="allocMsisdnBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" id="allocRefIDBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("BANK REFERENCE"); ?> :</td><td><input type="text" id="allocBankRefIDBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" id="allocAmountBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?> :</td><td><input type="text" id="allocTypeBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" id="allocStatusBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" id="allocRemarksBankApprove" readonly="readonly"></td>
			</tr>
			<td>
				<a href="javascript:B2WAllocationImage();"><?php echo _("Check Image"); ?></a>
			</td>
								
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocCheckBankApprove' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' id='allocValBankApprove'></span>
					</a>";
				}
			?>
            <a id="btnAllocCancelCheckBankApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<div id="dialogBankApprove" title="<?php echo _("Pending BANK to Wallet Allocation for approval"); ?>">
        
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td colspan="2"><span id="allocConfirmBankApprove"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="allocPasswordBankApprove">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_BANK_ALLOCATION') == 'TRUE'){
					echo "<button  id='btnBankApprove' type = 'button' class='ui-button ui-state-default ui-corner-all'>OK</button>";
				}
			?>
            <button  id="btnAllocCancelBankApprove" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Cancel"); ?></button>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><div class="allocloadingB2Wapp"></div>
	
</div>

<!-- bank approvals wallet to bank-->
<div id="dialogPndgAllocationCheckWalletBankApprove" title="<?php echo _("Pending Wallet to Bank Allocation for Approval"); ?>">
	<div id="app_sendingMsg" style="display:none;"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
	<div id="app_resultMsg"></div>
    <form>
	    <input id="allocTransIDWalletBankApprove" type="hidden">
	    <input id="allocValueWalletBankApprove" type="hidden"> 
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" id="allocMsisdnWalletBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" id="allocRefIDWalletBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("BANK REFERENCE"); ?> :</td><td><span id='allocBankRefIDWalletBankApprove'></span></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" id="allocAmountWalletBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?> :</td><td><input type="text" id="allocTypeWalletBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" id="allocStatusWalletBankApprove" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" id="allocRemarksWalletBankApprove" readonly="readonly"></td>
			</tr>
								
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveCheckWalletBankApprove' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' id='allocValWalletBankApprove'></span>
					</a>";
				}
			?>
            <a id="btnAllocCancelCheckWalletBankApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<div id="dialogPndgAllocationWalletBankApprove" title="<?php echo _("Pending Wallet to Bank Allocation for Approval"); ?>">
    <form>
	    
		<table style="text-align:left;" class="tablet">					
			<tr>
				<td colspan="2"><span id="allocConfirmWalletBankApprove"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="allocPasswordWalletBankApprove">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_BANK_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_BANK_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveWalletBankApprove' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' >OK</span>
					</a>";
				}
			?>
            <a id="btnAllocCancelWalletBankApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" style="visibility: hidden;" />
		</div><div class="allocloadingW2Bapp"></div>
	</form>
</div>
		
		<div class="row-fluid" id="divPhoto" title="Image"></div>
		
</div>

<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>			
<script>
	$(document).ready(function() {
				oTable = $('#allocationsBankConfirm, #allocationsBankApproval').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "two_button"
				});
			});
	$("#divallocationsB").fadeIn(700);

	$('#dialogPndgAllocationCheckBankConfirm, #dialogPndgAllocationBankConfirm, #dialogPndgAllocationCheckWalletBankConfirm, #dialogPndgAllocationWalletBankConfirm, #dialogCheckBankApprove, #dialogBankApprove, #dialogPndgAllocationWalletBankApprove, #dialogPndgAllocationCheckWalletBankApprove').dialog({
			autoOpen: false,
			width: 450,
			draggable: true,
			resizable: false,
			modal:true
		});
	$('#divPhoto').dialog({
			autoOpen: false,
			width: 1000,
			position: 'top',
			draggable: true,
			resizable: true,
			modal:true
		});	
	
	$("#btnAllocCancelCheckBankConfirm").click(function(){
		$("#dialogPndgAllocationCheckBankConfirm").dialog('close');
	});
	$("#btnAllocCancelBankConfirm").click(function(){
		$("#dialogPndgAllocationBankConfirm").dialog('close');
	});
	
	$("#btnAllocCancelCheckWalletBankConfirm").click(function(){
		$("#dialogPndgAllocationCheckWalletBankConfirm").dialog('close');
	});
	$("#btnAllocCancelWalletBankConfirm").click(function(){
		$("#dialogPndgAllocationWalletBankConfirm").dialog('close');
	});
	
	$("#btnAllocCancelCheckBankApprove").click(function(){
		$("#dialogCheckBankApprove").dialog('close');
	});
	$("#btnAllocCancelBankApprove").click(function(){
		$("#dialogBankApprove").dialog('close');
	});
	
	$("#btnAllocCancelCheckWalletBankApprove").click(function(){
		$("#dialogPndgAllocationCheckWalletBankApprove").dialog('close');
	});
	$("#btnAllocCancelWalletBankApprove").click(function(){
		$("#dialogPndgAllocationWalletBankApprove").dialog('close');
	});
	
	var refid = "";
	function confirmB2WAllocation(strmsisdn,strvalue,strtransactionid,strrefid,stramount,strremarks,strtype,strbankref){
		$('#dialogPndgAllocationCheckBankConfirm').dialog('open');
		$("#allocMsisdnBankConfirm").val(strmsisdn);
		$("#allocRefIDBankConfirm").val(strrefid);		
		$("#allocBankRefIDBankConfirm").val(strbankref);
		$("#allocAmountBankConfirm").val(stramount);
		$("#allocTypeBankConfirm").val(strtype);
		$("#allocValueBankConfirm").val(strvalue);
		$("#allocRemarksBankConfirm").val(strremarks);
		$("#allocTransIDBankConfirm").val(strtransactionid);		
		document.getElementById("allocValBankConfirm").innerHTML=strvalue;
		$("#allocStatusBankConfirm").val("BANK TO WALLET FOR CONFIRMATION");		
		$("#allocPasswordBankConfirm").val('');
		
		refid = strrefid;
	}
	$("#btnAllocApproveCheckBankConfirm").click(function(){
		var params = {
					Method:'confirmAllocationB2WCheck',
					msisdn:$("#allocMsisdnBankConfirm").val(),
					alloctype:$("#allocTypeBankConfirm").val(),
					value:$("#allocValueBankConfirm").val(),
					transactionid:$("#allocTransIDBankConfirm").val(),
					refid:$("#allocRefIDBankConfirm").val(),
     				amount:$("#allocAmountBankConfirm").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					if(status=="success"){
						$("#allocConfirmBankConfirm").text(res.responseText);
						$('#dialogPndgAllocationBankConfirm').dialog('open');						
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnAllocApproveBankConfirm").click(function(){
		$("#btnAllocApproveBankConfirm").attr('disabled',true);
		var params = {
					Method:'confirmAllocationB2W',					
					PASSWORD:$("#allocPasswordBankConfirm").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.allocloadingB2W').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					$('.allocloadingB2W').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					});
					if(status=="success"){
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							$("#allocB2W_" + $("#allocRefIDBankConfirm").val()).hide();
							$('#dialogPndgAllocationBankConfirm').dialog('close');
							$('#dialogPndgAllocationCheckBankConfirm').dialog('close');
						}
					}
					$("#btnAllocApproveBankConfirm").attr('disabled',false);
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	function confirmW2BAllocation(strmsisdn,strvalue,strtransactionid,strrefid,stramount,strremarks,strtype,strbankref){
		$('#dialogPndgAllocationCheckWalletBankConfirm').dialog('open');
		$("#allocMsisdnWalletBankConfirm").val(strmsisdn);
		$("#allocRefIDWalletBankConfirm").val(strrefid);		
		$("#allocBankRefIDWalletBankConfirm").text(strbankref);
		$("#allocAmountWalletBankConfirm").val(stramount);
		$("#allocTypeWalletBankConfirm").val(strtype);
		$("#allocValueWalletBankConfirm").val(strvalue);
		$("#allocRemarksWalletBankConfirm").val(strremarks);
		$("#allocTransIDWalletBankConfirm").val(strtransactionid);		
		document.getElementById("allocValWalletBankConfirm").innerHTML=strvalue;
		$("#allocStatusWalletBankConfirm").val("WALLET TO BANK FOR CONFIRMATION");		
		$("#allocPasswordWalletBankConfirm").val('');
	}
	$("#btnAllocApproveCheckWalletBankConfirm").click(function(){
		var params = {
					Method:'confirmAllocationW2BCheck',
					msisdn:$("#allocMsisdnWalletBankConfirm").val(),
					alloctype:$("#allocTypeWalletBankConfirm").val(),
					value:$("#allocValueWalletBankConfirm").val(),
					transactionid:$("#allocTransIDWalletBankConfirm").val(),
					refid:$("#allocRefIDWalletBankConfirm").val(),
     				amount:$("#allocAmountWalletBankConfirm").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					if(status=="success"){
						$("#allocConfirmWalletBankConfirm").text(res.responseText);
						$('#dialogPndgAllocationWalletBankConfirm').dialog('open');						
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnAllocApproveWalletBankConfirm").click(function(){
		$("#btnAllocApproveWalletBankConfirm").attr('disabled',true);
		var params = {
					Method:'confirmAllocationW2B',					
					PASSWORD:$("#allocPasswordWalletBankConfirm").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.allocloadingW2B').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$("#btnAllocApproveWalletBankConfirm").attr('disabled',false);
					$('.allocloadingW2B').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					});
					if(status=="success"){
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							$("#allocB2W_" + $("#allocRefIDWalletBankConfirm").val()).hide();
							$('#dialogPndgAllocationWalletBankConfirm').dialog('close');
							$('#dialogPndgAllocationCheckWalletBankConfirm').dialog('close');
						}
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	
	/* bank approvals */
	
	function approveB2WAllocation(strmsisdn,strvalue,strtransactionid,strrefid,stramount,strremarks,strtype,strbankref){
		$('#dialogCheckBankApprove').dialog('open');
		$("#allocMsisdnBankApprove").val(strmsisdn);
		$("#allocRefIDBankApprove").val(strrefid);		
		$("#allocBankRefIDBankApprove").val(strbankref);
		$("#allocAmountBankApprove").val(stramount);
		$("#allocTypeBankApprove").val(strtype);
		$("#allocValueBankApprove").val(strvalue);
		$("#allocRemarksBankApprove").val(strremarks);
		$("#allocTransIDBankApprove").val(strtransactionid);		
		document.getElementById("allocValBankApprove").innerHTML=strvalue;
		$("#allocStatusBankApprove").val("BANK TO WALLET FOR APPROVAL");		
		$("#allocPasswordBankApprove").val('');
		
		refid = strrefid;
	}
	$("#btnAllocCheckBankApprove").click(function(){
		var params = {
					Method:'approveAllocationB2WCheck',
					msisdn:$("#allocMsisdnBankApprove").val(),
					alloctype:$("#allocTypeBankApprove").val(),
					value:$("#allocValueBankApprove").val(),
					transactionid:$("#allocTransIDBankApprove").val(),
					refid:$("#allocRefIDBankApprove").val(),
     				amount:$("#allocAmountBankApprove").val(),
					bankref:$("#allocBankRefIDBankApprove").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					if(status=="success"){
						$("#allocConfirmBankApprove").text(res.responseText);
						$('#dialogBankApprove').dialog('open');						
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnBankApprove").click(function(){
		$("#btnBankApprove").attr('disabled',true);
		var params = {
					Method:'approveAllocationB2W',					
					PASSWORD:$("#allocPasswordBankApprove").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.allocloadingB2Wapp').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					$('.allocloadingB2Wapp').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					});
					if(status=="success"){
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							$("#allocB2Wap_" + $("#allocRefIDBankApprove").val()).hide();
							$('#dialogBankApprove').dialog('close');
							$('#dialogCheckBankApprove').dialog('close');
						}
					}	
					$("#btnBankApprove").attr('disabled',false);
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	
	
	var getAccountnumber = "";
	var getBank = "";
	var getReference = "";
	function approveW2BAllocation(strmsisdn,strvalue,strtransactionid,strrefid,stramount,strremarks,strtype,strbankref,straccountnumber,strbank,strreference){
		$('#dialogPndgAllocationCheckWalletBankApprove').dialog('open');
		$("#allocMsisdnWalletBankApprove").val(strmsisdn);
		$("#allocRefIDWalletBankApprove").val(strrefid);		
		$("#allocBankRefIDWalletBankApprove").text(strbankref);
		$("#allocAmountWalletBankApprove").val(stramount);
		$("#allocTypeWalletBankApprove").val(strtype);
		$("#allocValueWalletBankApprove").val(strvalue);
		$("#allocRemarksWalletBankApprove").val(strremarks);
		$("#allocTransIDWalletBankApprove").val(strtransactionid);		
		document.getElementById("allocValWalletBankApprove").innerHTML=strvalue;
		$("#allocStatusWalletBankApprove").val("WALLET TO BANK FOR APPROVAL");		
		$("#allocPasswordWalletBankApprove").val('');
		
		getAccountnumber = straccountnumber;
		getBank = strbank;
		getReference = strreference;
	}
	$("#btnAllocApproveCheckWalletBankApprove").click(function(){
		var params = {
					Method:'approveAllocationW2BCheck',
					msisdn:$("#allocMsisdnWalletBankApprove").val(),
					alloctype:$("#allocTypeWalletBankApprove").val(),
					value:$("#allocValueWalletBankApprove").val(),
					transactionid:$("#allocTransIDWalletBankApprove").val(),
					refid:$("#allocRefIDWalletBankApprove").val(),
     				amount:$("#allocAmountWalletBankApprove").val(),
					accountnumber:getAccountnumber,
					bank:getBank,
					reference:getReference,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					if(status=="success"){
						$("#allocConfirmWalletBankApprove").text(res.responseText);
						$('#dialogPndgAllocationWalletBankApprove').dialog('open');						
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnAllocApproveWalletBankApprove").click(function(){
		$("#btnAllocApproveWalletBankApprove").attr('disabled',true);
		var params = {
					Method:'approveAllocationW2B',					
					PASSWORD:$("#allocPasswordWalletBankApprove").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.allocloadingW2Bapp').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$("#btnAllocApproveWalletBankApprove").attr('disabled',false);
					$('.allocloadingW2Bapp').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					});
					if(status=="success"){
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							$("#allocB2Wap_" + $("#allocRefIDWalletBankApprove").val()).hide();
							$('#dialogPndgAllocationWalletBankApprove').dialog('close');
							$('#dialogPndgAllocationCheckWalletBankApprove').dialog('close');
						}
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	function B2WAllocationImage(){
		var params = {
					Method:'getAllocationB2WPndgIMAGE',
					referenceid:refid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"post", 
				dataType:"html",
				data:params,
				success: function(html){
										 						
						$("#divPhoto").html(html);
						$('#divPhoto').dialog('open');
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
</script>