<?php require_once("views.config.properties.php"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.sloading {
	height:10px;
	width:32px;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.loading, .revloading, .ploading, .rloading, .sysloading, .ulevelloading, .msgloading, .amlloading, .kctloading, .trxloading, .allocloading, .allocEVDloading, .txloading, .rxloading, .scloading, .amlloadinga, .amlloadingr, .kctloadinga, .kctloadingr, .btypependingloading, .bmsisdnpendingloading, .allocloadingB2W, .allocloadingW2B, .allocloadingB2Wapp, .allocloadingW2Bapp, .dcommiloading {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
.transloading {
	height:25px;
	width:81px;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
.lockloading, .deallocload {
	height:10px;
	width:32px;
	float:right;margin-right:50%;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.ui-button{margin-right:5px;}
._d-none{
	display:none;
}
._tablet{
	text-align:left;
}
._v-hidden{
	visibility: hidden;
}
</style>	
<div class="SubscriberDetails mt-5">
	<div id="tabs">
		<ul>
		<!-- all statuses -->
			<?php if($this->getRolesConfig('VIEW_DASHBOARD')){ ?>
				<li id="pendingStatusTabLink"><a href="#pendingStatusTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.dashboard.php"><?php echo _("Dashboard"); ?></a></li>
			<?php } ?>
		
			<?php if($this->getRolesConfig('VIEW_PENDING_REGISTRATIONS')){ ?>
				<li id="pendingAccountTabLink"><a href="#pendingAccountTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.accounts.php"><?php echo _("Accounts"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_PENDING_TERMINALID')){ ?>
				<li id="pendingTerminalIDTabLink"><a href="#pendingTerminalIDTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.terminalids.php"><?php echo _("Terminal IDs"); ?></a></li>
			<?php } ?>
			
			
<!-- REJECTED -->
			<?php if($this->getRolesConfig('VIEW_REJECTED_ACCOUNTS')){ ?><!-- VIEW_REJECTED_ACCOUNTS -->
				<li id="pendingAccountRejectedTabLink"><a href="#pendingAccountRejectedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.rejected.accounts.php"><?php echo _("Approval Exception"); ?></a></li>
			<?php } ?>			
<!-- BANK APPROVED -->
			<?php if($this->getRolesConfig('VIEW_APPROVED_ACCOUNTS')){ ?> <!-- VIEW_APPROVED_ACCOUNTS -->
				<li id="pendingAccountApprovedTabLink"><a href="#pendingAccountApprovedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.approved.accounts2.php"><?php echo _("Approved Accounts"); ?></a></li>
			<?php } ?>
<!-- BANK SENDBACK -->
			<?php if($this->getRolesConfig('VIEW_PENDING_SENT_BACK_REGISTRATIONS')){ ?> <!-- VIEW_APPROVED_ACCOUNTS -->
				<li id="pendingSendBackTabLink"><a href="#pendingSendBackTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.sendback.php"><?php echo _("Send Back Application"); ?></a></li>
			<?php } ?>
<!--BANK COMPLIANCE-->
			<?php if($this->getRolesConfig('VIEW_FOR_COMPLIANCE_ACCOUNTS')){ ?> <!-- VIEW_FOR_COMPLIANCE_ACCOUNTS -->
				<li id="pendingAccountComplianceTabLink"><a href="#pendingAccountComplianceTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.compliance.php"><?php echo _("Bank Compliance"); ?></a></li>
			<?php } ?>
<!-- PROCESSOR APPROVAL -->
			<?php if($this->getRolesConfig('APPROVE_KYC_PROCESSOR')){ ?> <!--APPROVE_KYC_PROCESSOR-->
				<li id="pendingProcessorApprovedTabLink"><a href="#pendingProcessorApprovedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.processor.php"><?php echo _("Processor"); ?></a></li>
			<?php } ?>
<!-- SHARAFDG APPROVAL -->
			<?php if($this->getRolesConfig('APPROVE_KYC_SHARAFDG')){ ?> <!--APPROVE_KYC_SHARAFDG-->
				<li id="pendingSharafDGApprovedTabLink"><a href="#pendingSharafDGApprovedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.sharafdg.php"><?php echo _("SharafDG"); ?></a></li>
			<?php } ?>
<!-- UPDATE MSISDN -->
			<?php if($this->getRolesConfig('VIEW_UPDATE_MSISDNS')){ ?> <!-- VIEW_UPDATE_MSISDNS -->
				<li id="pendingUpdateMSISDNTabLink"><a href="#pendingUpdateMSISDNTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.updatemsisdn.php"><?php echo _("Update MSISDN Application"); ?></a></li>
			<?php } ?>



			
			<?php if($this->getRolesConfig('VIEW_PENDING_ALLOCATIONS')){ ?>	
				<li id="pendingAllocationTabLink"><a href="#pendingAllocationTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.allocations.php"><?php echo _("Allocations"); ?></a></li>			
			<?php } ?>

			<?php if($this->getRolesConfig('VIEW_PENDING_ALLOCATIONS_EVD')){ ?>					
				<li id="pendingEVDAllocationTabLink"><a href="#pendingEVDAllocationTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.evdallocations.php"><?php echo _("EVD Allocation"); ?></a></li>
			<?php } ?>	
				
			<?php if($this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS') || $this->getRolesConfig('VIEW_PENDING_BANK_ALLOCATIONS_BANK_APPROVAL')){ ?>
				<li id="pendingB2WAllocationTabLink"><a href="#pendingB2WAllocationTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.b2wallocations.php"><?php echo _("Bank Allocation"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('APPROVE_CASH_REVERSAL')){ ?>
				<li id="pendingReversalTabLink"><a href="#pendingReversalTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.reversal.php"><?php echo _("Reversal"); ?></a></li>
			<?php } ?>	
			
			<!--<?php if($this->getRolesConfig('APPROVE_RFNDVOID')){ ?>
				<li id="pendingRfndVoidTabLink"><a href="#pendingRfndVoidTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.rfndvoid.php"><?php echo _("Rfnd/Void"); ?></a></li>
			<?php } ?>	-->
			
			<?php if($this->getRolesConfig('VIEW_PENDING_DEALER_COMMISSION')){ ?>
				<li id="pendingDealerCommissionTabLink"><a href="#pendingDealerCommissionTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.dealercommission1.iframe.php"><?php echo _("Dealer Commission"); ?></a></li>
			<?php } ?>	
				
			<?php if($this->getRolesConfig('VIEW_PENDING_AML_SETTINGS')){ ?>
				<li id="pendingAMLTabLink"><a href="#pendingAMLTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.amlsettings.php"><?php echo _("AML Settings"); ?></a></li>
			<?php } ?>	
				
			<?php if($this->getRolesConfig('VIEW_PENDING_KEY_ALLOWED_MSISDN_TYPE')){ ?>	
				<li id="pendingKeyAllowedTabLink"><a href="#pendingKeyAllowedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.keyallowed.php"><?php echo _("Key Allowed"); ?></a></li>
			<?php } ?>	
				
			<?php if($this->getRolesConfig('VIEW_PENDING_AIR_BONUS_TOPUP')){ ?>
				<li id="pendingAirBonusTopupTabLink"><a href="#pendingAirBonusTopupTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.airbonustopup.php"><?php echo _("Air Bonus"); ?></a></li>
			<?php } ?>	
				
			<?php if($this->getRolesConfig('VIEW_PENDING_BONUS_MSISDN_TYPE')){ ?>
				<li id="pendingBonusTabLink"><a href="#pendingBonusTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.bonus.php"><?php echo _("Bonus"); ?></a></li>
			<?php } ?>	
			
			<?php if($this->getRolesConfig('VIEW_PENDING_BONUS_AIRTIME_MSISDN_TYPE')){ ?>
				<li id="pendingBonusTabLink"><a href="#pendingBonusairtimeTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.bonusairtime.php"><?php echo _("Bonus Airtime"); ?></a></li>
			<?php } ?>	
			
			<?php if($this->getRolesConfig('VIEW_PENDING_COMMISSION_MSISDN_TYPE')){ ?>
				<li id="pendingCommissionsTabLink"><a href="#pendingCommissionsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.commissions.php"><?php echo _("Commissions"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_PENDING_KEY_COST_CHARGES')){ ?>
				<li id="pendingKeyCostTypeLink"><a href="#pendingKeyCostType" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.keycosttypes.php"><?php echo _("Key Costs"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_PENDING_USER_LEVEL')){ ?>
				<li id="pendingUserlevelTabLink"><a href="#pendingUserlevelTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.userlevels.php"><?php echo _("User levels"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_PENDING_MESSAGES')){ ?>
				<li id="pendingMessagesTabLink"><a href="#pendingMessagesTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.messages.php"><?php echo _("Messages"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_PENDING_SYSTEM_INFO')){ ?>
				<li id="pendingTransceiverLink"><a href="#pendingTransceiver" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.transceiver.php"><?php echo _("Transceiver"); ?></a></li>
				<!--<li id="pendingTransmitterLink"><a href="#pendingTransmitter" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.transmitter.php"><?php echo _("Transmitter"); ?></a></li>
				<li id="pendingReceiverLink"><a href="#pendingReceiver" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.receiver.php"><?php echo _("Receiver"); ?></a></li>-->
				<li id="pendingServerConfigLink"><a href="#pendingServerConfig" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.serverconfig.php"><?php echo _("Server Config"); ?></a></li>
				<li id="pendingAirConfigLink"><a href="#pendingAirConfig" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.airconfig.php"><?php echo _("Air Config"); ?></a></li>
				<li id="pendingSysInfoTabLink"><a href="#pendingSysInfoTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.systeminfo.php"><?php echo _("System Info"); ?></a></li>
			<?php } ?>	
		</ul>
		<div class="mt-5"></div>

		<div id="pendingAccountTab"></div>
		<div id="pendingTerminalIDTab"></div>
		<div id="pendingAccountRejectedTab"></div>
		<div id="pendingAccountComplianceTab"></div>
<!--approved accounts -->
		<div id="pendingStatusTab"></div>
		<div id="pendingAccountApprovedTab"></div>
		<div id="pendingSendBackTab"></div>
		<div id="pendingUpdateMSISDNTab"></div>
		<div id="pendingProcessorApprovedTab"></div>
		<div id="pendingSharafDGApprovedTab"></div>
		
		<div id="pendingAllocationTab"></div>
		<div id="pendingEVDAllocationTab"></div>
		<div id="pendingB2WAllocationTab"></div>
		<div id="pendingReversalTab"></div>
		<div id="pendingRfndVoidTab"></div>
		<div id="pendingDealerCommissionTab"></div>
		<div id="pendingUserlevelTab"></div>
		<div id="pendingMessagesTab"></div>
		<div id="pendingAMLTab"></div>
		<div id="pendingKeyAllowedTab"></div>
		<div id="pendingAirBonusTopupTab"></div>
		<div id="pendingBonusTab"></div>
		<div id="pendingBonusairtimeTab"></div>
		<div id="pendingCommissionsTab"></div>
		<div id="pendingKeyCostType"></div>
		<div id="pendingTransceiver"></div>
		<div id="pendingTransmitter"></div>
		<div id="pendingReceiver"></div>
		<div id="pendingServerConfig"></div>
		<div id="pendingAirConfig"></div>
		<div id="pendingSysInfoTab"></div>

		<div class="loading"></div><div class="sysloading"></div><div class="ulevelloading"></div><div class="msgloading"></div><div class="amlloading"></div><div class="kctloading"></div><div class="trxloading"></div><div class="txloading"></div><div class="rxloading"></div><div class="scloading"></div>
	</div>
</div>
<div id="dialogPndgAllocationCheck" title="<?php echo _("Pending Allocation"); ?>">
<div id="app_sendingMsg" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
<div id="app_resultMsg"></div>
    <form>
	    <input id="allocTransID" type="hidden" name="allocTransID">
	    <input id="allocValue" type="hidden" name="allocValue"> 
		<table class="tablet _tablet">					
			<tr>
				<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" name="allocMsisdn" id="allocMsisdn" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" name="allocRefID" id="allocRefID" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" name="allocAmount" id="allocAmount" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?> :</td><td><input type="text" name="allocType" id="allocType" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" name="allocStatus" id="allocStatus" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" name="allocRemarks" id="allocRemarks" readonly="readonly"></td>						
			</tr>
								
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('APPROVE_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveCheck' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' id='allocVal'></span>
					</a>";
				}
			?>
            <a id="btnAllocCancelCheck" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" class="_v-hidden" />
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<div id="dialogPndgAllocation" title="<?php echo _("Pending Allocation"); ?>">
    <form>
	    
		<table class="tablet _tablet">					
			<tr>
				<td colspan="2"><span id="allocConfirm"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="allocPassword">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('APPROVE_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApprove' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' >OK</span>
					</a>";
				}
			?>
            <a id="btnAllocCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" class="_v-hidden" />
		</div><div class="allocloading"></div>
	</form>
</div>
<div id="dialogPndgAllocationCheckEVD" title="<?php echo _("Pending EVD Allocation"); ?>">
<div id="app_sendingMsg" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
<div id="app_resultMsg"></div>
    <form>
	    <input id="allocTransIDEVD" type="hidden" name="allocTransIDEVD">
	    <input id="allocValueEVD" type="hidden" name="allocValueEVD"> 
		<table class="tablet _tablet">					
			<tr>
				<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" name="allocMsisdnEVD" id="allocMsisdnEVD" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" name="allocRefIDEVD" id="allocRefIDEVD" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" name="allocAmountEVD" id="allocAmountEVD" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?> :</td><td><input type="text" name="allocTypeEVD" id="allocTypeEVD" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("STATUS"); ?> :</td><td><input type="text" name="allocStatusEVD" id="allocStatusEVD" readonly="readonly"></td>
			</tr>
			<tr>
				<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" name="allocRemarksEVD" id="allocRemarksEVD" readonly="readonly"></td>						
			</tr>
								
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('APPROVE_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveCheckEVD' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' id='allocValEVD'></span>
					</a>";
				}
			?>
            <a id="btnAllocCancelCheckEVD" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" class="_v-hidden" />
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<div id="dialogPndgAllocationEVD" title="<?php echo _("Pending EVD Allocation"); ?>">
    <form>
	    
		<table class="tablet _tablet">					
			<tr>
				<td colspan="2"><span id="allocConfirmEVD"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="allocPasswordEVD">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<?php 
				if($this->getRolesConfig('APPROVE_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('APPROVE_ALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_DEALLOCATION') == 'TRUE' or $this->getRolesConfig('REJECT_ALLOCATION') == 'TRUE'){
					echo "<a id='btnAllocApproveEVD' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
						<span class='ui-button-text' >OK</span>
					</a>";
				}
			?>
            <a id="btnAllocCancelEVD" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
            <input type="reset" id="buttonReset" class="_v-hidden" />
		</div><div class="allocEVDloading"></div>
	</form>
</div>
<div id="dialogPndgReversal" title="<?php echo _("Pending Reversal"); ?>">
<div id="app_sendingMsg" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
<div id="app_resultMsg"></div>
    <form>
	    <input id="reversalValue" type="hidden" name="reversalValue">            
			<table class="tablet _tablet">
				<tr>
					<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" name="reversalRefID" id="reversalRefID" readonly="readonly"></td>
				</tr>					
				<tr>
					<td><?php echo _("SOURCE MSISDN"); ?> :</td><td><input type="text" name="reversalSourceMsisdn" id="reversalSourceMsisdn" readonly="readonly"></td>
				</tr>
				<tr>
					<td><?php echo _("DEST MSISDN"); ?> :</td><td><input type="text" name="reversalDestMsisdn" id="reversalDestMsisdn" readonly="readonly"></td>
				</tr>					
				<tr>
					<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" name="reversalAmount" id="reversalAmount" readonly="readonly"></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?> :</td><td><input type="text" name="reversalStatus" id="reversalStatus" readonly="readonly"></td>
				</tr>					
				<tr>
					<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" name="reversalRemarks" id="reversalRemarks" readonly="readonly"></td>						
				</tr>
				<!--<tr>
					<td><b><?php echo _("Your Password"); ?> :</b></td>
					<td>
						<input type="password" id="reversalPassword">
					</td>
				</tr>-->
			</table>
			 <div align="left">
	        	<a id="btnReversalApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text" id="reversalVal"></span>
	            </a>
	            <a id="btnReversalCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text">Cancel</span>
	            </a>
	            <input type="reset" id="buttonResetReversal" class="_v-hidden" />
			</div><div class="revloading"></div>
	</form>
</div>
<!-- Dialog Pending RFNDVOID -->
<div id="dialogPndgRfndVoid" title="<?php echo _("Pending Rfnd/Void"); ?>">
<div id="app_sendingMsg" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
<div id="app_resultMsg"></div>
    <form>
	    <input id="refundValue" type="hidden" name="refundValue">            
			<table class="tablet _tablet">
				<tr>
					<td><?php echo _("REFERENCE ID"); ?> :</td><td><input type="text" name="refundRefID" id="refundRefID" readonly="readonly"></td>
				</tr>					
				<tr>
					<td><?php echo _("MOBILE NUMBER"); ?> :</td><td><input type="text" name="refundMsisdn" id="refundMsisdn" readonly="readonly"></td>
				</tr>					
				<tr>
					<td><?php echo _("AMOUNT"); ?> :</td><td><input type="text" name="refundAmount" id="refundAmount" readonly="readonly"></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?> :</td><td><input type="text" name="refundStatus" id="refundStatus" readonly="readonly"></td>
				</tr>					
				<tr>
					<td><?php echo _("REMARKS"); ?> :</td><td><input type="text" name="refundRemarks" id="refundRemarks" readonly="readonly"></td>						
				</tr>
				<!--<tr>
					<td><b><?php echo _("Your Password"); ?> :</b></td>
					<td>
						<input type="password" id="reversalPassword">
					</td>
				</tr>-->
			</table>
			 <div align="left">
	        	<a id="btnRfndVoidApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text" id="refundVal"></span>
	            </a>
	            <a id="btnRfndVoidCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text">Cancel</span>
	            </a>
	            <input type="reset" id="buttonResetReversal" class="_v-hidden" />
			</div><div class="revloading"></div>
	</form>
</div>
<!-- END DIALOG PENDING RFNDVOID -->
<div id="dialogPndgReversalPassword" title="<?php echo _("Pending Reversal"); ?>">
    <form>
	    
		<table class="tablet _tablet">					
			<tr>
				<td colspan="2"><span id="reversalConfirm"></span></td>
			</tr>			
			<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="reversalPassword">
				</td>
			</tr>					
		</table>
		 <div align="left">
        	<a id='_btnReversalApprove' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
				<span class='ui-button-text' >OK</span>
			</a>
            <a id="_btnReversalCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<!-- DIALOG PENDING RFNDVOID PASSWORD -->
<div id="dialogPndgRfndVoidPassword" title="<?php echo _("Pending Rfnd/Void"); ?>">
    <form>
	    
		<table class="tablet _tablet">					
			<tr>
				<td colspan="2"><span id="refundConfirm"></span></td>
			</tr>			
			<!--<tr>
				<td><b><?php echo _("Your Password"); ?> :</b></td>
				<td>
					<input type="password" id="refundPassword">
				</td>
			</tr> -->					
		</table>
		 <div align="left">
        	<a id='_btnRefundApprove' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover' role='button' aria-disabled='false'>
				<span class='ui-button-text' >OK</span>
			</a>
            <a id="_btnRefundCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text">Cancel</span>
            </a>
		</div><!--<div class="allocloading"></div>-->
	</form>
</div>
<!-- END DIALOG PENDING RFNDVOID PASSWORD -->
<!-- dialog AML -->
<div id="dialogPndgAML" title="<?php echo _("Pending AML"); ?>">
<div id="app_sendingMsg1" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
<div id="app_resultMsg1"></div>
    <form>
	    <input id="reversalValue" type="hidden" name="reversalValue">            
			<table class="tablet _tablet">
				<tr>
					<td><?php echo _("ID"); ?> :</td><td><input type="text" name="amlID" id="amlID" disabled="true"></td>
					<td><?php echo _("CREATED TIMESTAMP"); ?> :</td><td><input type="text" name="amlDATE" id="amlDATE" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("TYPE"); ?> :</td><td><input type="text" name="amlTYPE" id="amlTYPE" disabled="true"></td>
					<td><?php echo _("KEY"); ?> :</td><td><input type="text" name="amlKEY" id="amlKEY" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?> :</td><td><input type="text" name="amlPRIORITY" id="amlPRIORITY" disabled="true"></td>
					<td><?php echo _("MAX AMOUNT"); ?> :</td><td><input type="text" name="amlMAXAMOUNT" id="amlMAXAMOUNT" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("MIN AMOUNT"); ?> :</td><td><input type="text" name="amlMINAMOUNT" id="amlMINAMOUNT" disabled="true"></td>
					<td><?php echo _("MAX CURRENT AMOUNT"); ?> :</td><td><input type="text" name="amlMAXCURRENTAMOUNT" id="amlMAXCURRENTAMOUNT" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("MAX AMOUNT DAY"); ?> :</td><td><input type="text" name="amlMAXAMOUNTDAY" id="amlMAXAMOUNTDAY" disabled="true"></td>
					<td><?php echo _("MAX AMOUNT MONTH"); ?> :</td><td><input type="text" name="amlMAXAMOUNTMONTH" id="amlMAXAMOUNTMONTH" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("MAX TRANS DAY"); ?> :</td><td><input type="text" name="amlMAXTRANSDAY" id="amlMAXTRANSDAY" disabled="true"></td>
					<td><?php echo _("MAX TRANS MONTH"); ?> :</td><td><input type="text" name="amlMAXTRANSMONTH" id="amlMAXTRANSMONTH" disabled="true"></td>
				</tr>
				
				<tr>
					<td><?php echo _("TRANSACTION TYPE"); ?> :</td><td><input type="text" name="amlTRANSACTIONTYPE" id="amlTRANSACTIONTYPE" disabled="true"></td>
					<td><?php echo _("ACTION"); ?> :</td><td><input type="text" name="amlACTION" id="amlACTION" disabled="true"></td>
				</tr>
									
			</table>
			 <div align="right">
	        	<a id="btnAMLApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false" value="test">
	                <span class="ui-button-text" id="amlVal">Approve</span>
	            </a>
	            <a id="btnAMLCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text">Cancel</span>
	            </a>
	            <input type="reset" id="buttonResetReversal" class="_v-hidden" />
			</div><div class="amlloadinga"></div>
	</form>
</div>

<!-- dialog AML REJECT -->
<div id="dialogPndgAMLr" title="<?php echo _("Pending AML"); ?>">
<div id="app_sendingMsg1" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
<div id="app_resultMsg1"></div>
    <form>
			<table class="tablet _tablet">
				<tr>
					<td><?php echo _("ID"); ?> :</td><td><input type="text" name="amlIDr" id="amlIDr" disabled="true"></td>
					<td><?php echo _("CREATED TIMESTAMP"); ?> :</td><td><input type="text" name="amlDATEr" id="amlDATEr" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("TYPE"); ?> :</td><td><input type="text" name="amlTYPEr" id="amlTYPEr" disabled="true"></td>
					<td><?php echo _("KEY"); ?> :</td><td><input type="text" name="amlKEYr" id="amlKEYr" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("PRIORITY"); ?> :</td><td><input type="text" name="amlPRIORITYr" id="amlPRIORITYr" disabled="true"></td>
					<td><?php echo _("MAX AMOUNT"); ?> :</td><td><input type="text" name="amlMAXAMOUNTr" id="amlMAXAMOUNTr" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("MIN AMOUNT"); ?> :</td><td><input type="text" name="amlMINAMOUNTr" id="amlMINAMOUNTr" disabled="true"></td>
					<td><?php echo _("MAX CURRENT AMOUNT"); ?> :</td><td><input type="text" name="amlMAXCURRENTAMOUNTr" id="amlMAXCURRENTAMOUNTr" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("MAX AMOUNT DAY"); ?> :</td><td><input type="text" name="amlMAXAMOUNTDAYr" id="amlMAXAMOUNTDAYr" disabled="true"></td>
					<td><?php echo _("MAX AMOUNT MONTH"); ?> :</td><td><input type="text" name="amlMAXAMOUNTMONTHr" id="amlMAXAMOUNTMONTHr" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("MAX TRANS DAY"); ?> :</td><td><input type="text" name="amlMAXTRANSDAYr" id="amlMAXTRANSDAYr" disabled="true"></td>
					<td><?php echo _("MAX TRANS MONTH"); ?> :</td><td><input type="text" name="amlMAXTRANSMONTHr" id="amlMAXTRANSMONTHr" disabled="true"></td>
				</tr>
				
				<tr>
					<td><?php echo _("TRANSACTION TYPE"); ?> :</td><td><input type="text" name="amlTRANSACTIONTYPEr" id="amlTRANSACTIONTYPEr" disabled="true"></td>
					<td><?php echo _("ACTION"); ?> :</td><td><input type="text" name="amlACTIONr" id="amlACTIONr" disabled="true"></td>
				</tr>
									
			</table>
			 <div align="right">
	        	<a id="btnAMLApprover" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false" value="test">
	                <span class="ui-button-text" id="amlVal">Reject</span>
	            </a>
	            <a id="btnAMLCancelr" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text">Cancel</span>
	            </a>
	            <input type="reset" id="buttonResetReversal" class="_v-hidden" />
			</div><div class="amlloadingr"></div>
	</form>
</div>

<!-- dialog Key Cost Types -->
<div id="dialogPndgKeyCostTypes" title="<?php echo _("Pending Key Cost Types"); ?>">
<div id="app_sendingMsg1" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>

    <form>
	    
			<table class="tablet _tablet">
				<tr>
					<td><?php echo _("ID"); ?> :</td><td><input type="text" name="kctID" id="kctID" readonly="readonly" disabled="true"></td>
					<td><?php echo _("CREATED TIMESTAMP"); ?> :</td><td><input type="text" name="kctDATE" id="kctDATE" readonly="readonly" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("TYPE"); ?> :</td><td><input type="text" name="kctTYPE" id="kctTYPE" readonly="readonly" disabled="true"></td>
					<td><?php echo _("KEY"); ?> :</td><td><input type="text" name="kctKEY" id="kctKEY" readonly="readonly" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT"); ?> :</td><td><input type="text" name="kctACCOUNT" id="kctACCOUNT" readonly="readonly" disabled="true"></td>
					<td><?php echo _("FIXED"); ?> :</td><td><input type="text" name="kctFIXED" id="kctFIXED" readonly="readonly" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("PERCENT"); ?> :</td><td><input type="text" name="kctPERCENT" id="kctPERCENT" readonly="readonly" disabled="true"></td>
					<td><?php echo _("PRIORITY"); ?> :</td><td><input type="text" name="kctPRIORITY" id="kctPRIORITY" readonly="readonly" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?> :</td><td><input type="text" name="kctSTATUS" id="kctSTATUS" readonly="readonly" disabled="true"></td>
					<td><?php echo _("AMOUNTFR"); ?> :</td><td><input type="text" name="kctAMOUNTFR" id="kctAMOUNTFR" readonly="readonly" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNTTO"); ?> :</td><td><input type="text" name="kctAMOUNTTO" id="kctAMOUNTTO" readonly="readonly" disabled="true"></td>
					<td><?php echo _("ACCOUNTFR"); ?> :</td><td><input type="text" name="kctACCOUNTFR" id="kctACCOUNTFR" readonly="readonly" disabled="true"></td>
				</tr>
				
				<tr>
					<td><?php echo _("ACTION"); ?> :</td><td><input type="text" name="kctACTION" id="kctACTION" readonly="readonly" disabled="true"></td>

				</tr>
									
			</table>
			 <div align="right">
	        	<a id="btnKCTApprove" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false" value="test">
	                <span class="ui-button-text" id="amlVal">Approve</span>
	            </a>
	            <a id="btnKCTCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text">Cancel</span>
	            </a>
	            <input type="reset" id="buttonResetReversal" class="_v-hidden" />
			</div><div class="kctloadinga"></div>
	</form>
</div>

<!-- dialog Key Cost Types Reject -->
<div id="dialogPndgKeyCostTypesr" title="<?php echo _("Pending Key Cost Types"); ?>">
<div id="app_sendingMsg1" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>

    <form>
	    
			<table class="tablet _tablet">
				<tr>
					<td><?php echo _("ID"); ?> :</td><td><input type="text" name="kctIDr" id="kctIDr" readonly="readonly" disabled="true"></td>
					<td><?php echo _("CREATED TIMESTAMP"); ?> :</td><td><input type="text" name="kctDATEr" id="kctDATEr" readonly="readonly" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("TYPE"); ?> :</td><td><input type="text" name="kctTYPEr" id="kctTYPEr" readonly="readonly" disabled="true"></td>
					<td><?php echo _("KEY"); ?> :</td><td><input type="text" name="kctKEYr" id="kctKEYr" readonly="readonly" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("ACCOUNT"); ?> :</td><td><input type="text" name="kctACCOUNTr" id="kctACCOUNTr" readonly="readonly" disabled="true"></td>
					<td><?php echo _("FIXED"); ?> :</td><td><input type="text" name="kctFIXEDr" id="kctFIXEDr" readonly="readonly" disabled="true"></td>
				</tr>					
				<tr>
					<td><?php echo _("PERCENT"); ?> :</td><td><input type="text" name="kctPERCENTr" id="kctPERCENTr" readonly="readonly" disabled="true"></td>
					<td><?php echo _("PRIORITY"); ?> :</td><td><input type="text" name="kctPRIORITYr" id="kctPRIORITYr" readonly="readonly" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("STATUS"); ?> :</td><td><input type="text" name="kctSTATUSr" id="kctSTATUSr" readonly="readonly" disabled="true"></td>
					<td><?php echo _("AMOUNTFR"); ?> :</td><td><input type="text" name="kctAMOUNTFRr" id="kctAMOUNTFRr" readonly="readonly" disabled="true"></td>
				</tr>
				<tr>
					<td><?php echo _("AMOUNTTO"); ?> :</td><td><input type="text" name="kctAMOUNTTOr" id="kctAMOUNTTOr" readonly="readonly" disabled="true"></td>
					<td><?php echo _("ACCOUNTFR"); ?> :</td><td><input type="text" name="kctACCOUNTFRr" id="kctACCOUNTFRr" readonly="readonly" disabled="true"></td>
				</tr>
				
				<tr>
					<td><?php echo _("ACTION"); ?> :</td><td><input type="text" name="kctACTIONr" id="kctACTIONr" readonly="readonly" disabled="true"></td>

				</tr>
									
			</table>
			 <div align="right">
	        	<a id="btnKCTApprover" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false" value="test">
	                <span class="ui-button-text" id="amlVal">Reject</span>
	            </a>
	            <a id="btnKCTCancelr" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	                <span class="ui-button-text">Cancel</span>
	            </a>
	            <input type="reset" id="buttonResetReversal" class="_v-hidden" />
			</div><div class="kctloadingr"></div>
	</form>
</div>
<div id="confirmDialog"></div>

<script nonce="<?php echo $_SESSION['nonce'];?>">
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
	var global_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearch.php";
	var global_search_refid_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearchrefid.php";
	window.authMobNumber = "<?php echo $account==null?"":$account->MobileNumber ?>";
	window.imgPath = "<?php echo $GLOBALS["VIEW_PATH"]?>";
	window.CurrentUser = "<?php echo $currentUser; ?>";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script src="<?php echo $GLOBALS['VIEW_PATH'];?>js/sha256.js"></script>
<script src="<?php echo $GLOBALS['VIEW_PATH'];?>js/enc-base64-min.js"></script>	
<script nonce="<?php echo $_SESSION['nonce'];?>">
	
	//Dialog
	$('#dialogPndgAllocation, #dialogPndgReversalPassword, #dialogPndgAllocationEVD, #dialogPndgRfndVoidPassword').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnAllocCancel").click(function(){
		$('#dialogPndgAllocation').dialog('close');		
	});
	$("#_btnReversalCancel").click(function(){
		$("#dialogPndgReversalPassword").dialog('close');
	});
	$("#_btnRefundCancel").click(function(){
		$("#dialogPndgRfndVoidPassword").dialog('close');
	});
	$("#btnAllocCancelEVD").click(function(){
		$('#dialogPndgAllocationEVD').dialog('close');		
	});
	$('#dialogPndgAllocationCheck, #dialogPndgAllocationCheckEVD').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnAllocCancelCheck").click(function(){
		$('#dialogPndgAllocationCheck').dialog('close');		
	});
	$("#btnAllocCancelCheckEVD").click(function(){
		$('#dialogPndgAllocationCheckEVD').dialog('close');		
	});
	//Dialog:dialogPndgReversal
	$('#dialogPndgReversal').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnReversalCancel").click(function(){
		$('#dialogPndgReversal').dialog('close');		
	});
	//Dialog:dialogPndgRfndVoid
	$('#dialogPndgRfndVoid').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnRfndVoidCancel").click(function(){
		$('#dialogPndgRfndVoid').dialog('close');		
	});
	//Dialog:dialogPndgAML
	$('#dialogPndgAML').dialog({
		autoOpen: false,
		width: 850,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnAMLCancel").click(function(){
		$('#dialogPndgAML').dialog('close');		
	});
	//Dialog:dialogPndgAML
	$('#dialogPndgAMLr').dialog({
		autoOpen: false,
		width: 850,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnAMLCancelr").click(function(){
		$('#dialogPndgAMLr').dialog('close');		
	});
	
	//Dialog:dialogPndgKeyCostTypes
	$('#dialogPndgKeyCostTypes').dialog({
		autoOpen: false,
		width: 850,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnKCTCancel").click(function(){
		$('#dialogPndgKeyCostTypes').dialog('close');		
	});
	//Dialog:dialogPndgKeyCostTypesr
	$('#dialogPndgKeyCostTypesr').dialog({
		autoOpen: false,
		width: 850,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnKCTCancelr").click(function(){
		$('#dialogPndgKeyCostTypesr').dialog('close');		
	});
	
	//confirmation dialog
	$("#confirmDialog").dialog({
        bgiframe: true,
        autoOpen: false,
        height: 150,
        width: 450,
        modal: true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up" },
        resizable:false,
        draggable:false,
        title:"Confirm",
        closeOnEscape:false,
        buttons: { 
                    "No":function(){$("#hidConfirmMessage").html('');$(this).dialog("close"); },
                    "Yes": function() { $(this).dialog("close"); $(this).dialog('destroy'); me.cb(me.params);}
        }
        ,open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
    });
	
	function approveAllocation(strmsisdn,strvalue,strtransactionid,strrefid,stramount,strremarks,strtype){
		$('#dialogPndgAllocationCheck').dialog('open');
		$("#allocMsisdn").val(strmsisdn);
		$("#allocRefID").val(strrefid);
		$("#allocAmount").val(stramount);
		$("#allocType").val(strtype);
		$("#allocValue").val(strvalue);
		$("#allocRemarks").val(strremarks);
		$("#allocTransID").val(strtransactionid);		
		document.getElementById("allocVal").innerHTML=strvalue;
		$("#allocStatus").val("ALLOCATION FOR APPROVAL");
		if(strtype == 'DEALLOC'){
			$("#allocStatus").val("DEALLOCATION FOR APPROVAL");
		}
		$("#allocPassword").val('');
	}
	$("#btnAllocApproveCheck").click(function(){
		var params = {
					Method:'approveAllocationCheck',
					msisdn:$("#allocMsisdn").val(),
					alloctype:$("#allocType").val(),
					value:$("#allocValue").val(),
					transactionid:$("#allocTransID").val(),
					refid:$("#allocRefID").val(),
     				amount:$("#allocAmount").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		/* $('.allocloading').fadeToggle(300); */			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					/* $('.allocloading').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
										
					}); */
					if(status=="success"){
						$("#allocConfirm").text(res.responseText);
						$('#dialogPndgAllocation').dialog('open');
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							/* $("#alloc_" + $("#allocRefID").val()).hide();
							$('#dialogPndgAllocation').dialog('close'); */
						}
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnAllocApprove").click(function(){
		var params = {
					Method:'approveAllocation',					
					PASSWORD:$("#allocPassword").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.allocloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$('.allocloading').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					});
					if(status=="success"){
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							$("#alloc_" + $("#allocRefID").val()).hide();
							$('#dialogPndgAllocation').dialog('close');
							$('#dialogPndgAllocationCheck').dialog('close');
						}
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	function approveEVDAllocation(strmsisdn,strvalue,strtransactionid,strrefid,stramount,strremarks,strtype){
		$('#dialogPndgAllocationCheckEVD').dialog('open');
		$("#allocMsisdnEVD").val(strmsisdn);
		$("#allocRefIDEVD").val(strrefid);
		$("#allocAmountEVD").val(stramount);
		$("#allocTypeEVD").val(strtype);
		$("#allocValueEVD").val(strvalue);
		$("#allocRemarksEVD").val(strremarks);
		$("#allocTransIDEVD").val(strtransactionid);		
		document.getElementById("allocValEVD").innerHTML=strvalue;
		$("#allocStatusEVD").val("ALLOCATION FOR APPROVAL");
		if(strtype == 'EVD DEALLOC'){
			$("#allocStatusEVD").val("DEALLOCATION FOR APPROVAL");
		}
		$("#allocPasswordEVD").val('');
	}
	$("#btnAllocApproveCheckEVD").click(function(){
		var params = {
					Method:'approveAllocationCheckEVD',
					msisdn:$("#allocMsisdnEVD").val(),
					alloctype:$("#allocTypeEVD").val(),
					value:$("#allocValueEVD").val(),
					transactionid:$("#allocTransIDEVD").val(),
					refid:$("#allocRefIDEVD").val(),
     				amount:$("#allocAmountEVD").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		/* $('.allocloading').fadeToggle(300); */			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					
					if(status=="success"){
						$("#allocConfirmEVD").text(res.responseText);
						$('#dialogPndgAllocationEVD').dialog('open');
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							
						}
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnAllocApproveEVD").click(function(){
		var params = {
					Method:'approveEVDAllocation',					
					PASSWORD:$("#allocPasswordEVD").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
		$('.allocEVDloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				complete:function(res,status){
					$('.allocEVDloading').fadeToggle(300,'linear',function(){
						$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
					});
					if(status=="success"){
						if(res.responseText.toLowerCase().indexOf("success",0)>-1){
							$("#evdalloc_" + $("#allocRefIDEVD").val()).hide();
							$('#dialogPndgAllocationEVD').dialog('close');
							$('#dialogPndgAllocationCheckEVD').dialog('close');
						}
					}	
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function approveSysInfo(strid,strremarks){
		var ret = confirm("Press OK if you are sure you want to "+strremarks);
		if (ret)
			{
	        var params = {
						Method:'approveSystemInfo',
						id:strid,
						remarks:strremarks,
						FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.sysloading').fadeToggle(300);			
				$.ajax({url:service_url,
					type:"POST", 
					data:params,
					dataType:'json',
					success:function(json){
						if(json.ResponseCode == 0){
							$("#sysinfo_" + strid).hide();
						}
						$('.sysloading').fadeToggle(300,'linear',function(){
							$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
						});
					}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}

	function approveUserLevels(strremarks, strid, struserlevel){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveUserLevels',
					remarks:strremarks,
					id:strid,
					userlevel:struserlevel,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.ulevelloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#ulevel_" + strid).hide();	
							}
							$('.ulevelloading').fadeToggle(300,'linear',function(){
								$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});							
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	function approveMessagesPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveMessagesPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.msgloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){
								$("#msg_" + strid).hide();
							}



							$('.msgloading').fadeToggle(300,'linear',function(){
								$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	function approveAmlTypePndg(strremarks,strid,strdate,strtype,strkey,strpriority,strmaxamount,strminamount,strmaxcurrentamount,strmaxamountday,strmaxamountmonth,strmaxtransday,strmaxtransmonth,strtranstype){
		$('#dialogPndgAML').dialog('open');
		$("#amlID").val(strid);
		$("#amlDATE").val(strdate);
		$("#amlTYPE").val(strtype);
		$("#amlKEY").val(strkey);
		$("#amlPRIORITY").val(strpriority);
		$("#amlMAXAMOUNT").val(strmaxamount);
		$("#amlMINAMOUNT").val(strtranstype=='SEND'?strminamount:'N/A');
		$("#amlMAXCURRENTAMOUNT").val(strtranstype=='SEND'?'N/A':strmaxcurrentamount);
		$("#amlMAXAMOUNTDAY").val(strmaxamountday);
		$("#amlMAXAMOUNTMONTH").val(strmaxamountmonth);
		$("#amlMAXTRANSDAY").val(strmaxtransday);
		$("#amlMAXTRANSMONTH").val(strmaxtransmonth);
		$("#amlTRANSACTIONTYPE").val(strtranstype);
		$("#amlACTION").val(strremarks);
		
	}
	function approveAmlTypePndgReject(strremarks,strid,strdate,strtype,strkey,strpriority,strmaxamount,strminamount,strmaxcurrentamount,strmaxamountday,strmaxamountmonth,strmaxtransday,strmaxtransmonth,strtranstype){
		$('#dialogPndgAMLr').dialog('open');
		$("#amlIDr").val(strid);
		$("#amlDATEr").val(strdate);
		$("#amlTYPEr").val(strtype);
		$("#amlKEYr").val(strkey);
		$("#amlPRIORITYr").val(strpriority);
		$("#amlMAXAMOUNTr").val(strmaxamount);
		$("#amlMINAMOUNTr").val(strminamount);
		$("#amlMAXCURRENTAMOUNTr").val(strmaxcurrentamount);
		$("#amlMAXAMOUNTDAYr").val(strmaxamountday);
		$("#amlMAXAMOUNTMONTHr").val(strmaxamountmonth);
		$("#amlMAXTRANSDAYr").val(strmaxtransday);
		$("#amlMAXTRANSMONTHr").val(strmaxtransmonth);
		$("#amlTRANSACTIONTYPEr").val(strtranstype);
		$("#amlACTIONr").val(strremarks);
		
	}
	$("#btnAMLApprove").click(function(){
		var params = {
					Method:'approveAmlTypePndg',
					remarks:$("#amlACTION").val(),
					id:$("#amlID").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};
		//$('.amlloadinga').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){

						$("#aml_" + $("#amlID").val()).hide();
						$('#dialogPndgAML').dialog('close');
					}
					//$('.amlloadinga').fadeToggle(300,'linear',function(){
						$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					//});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	$("#btnAMLApprover").click(function(){
		var params = {
					Method:'approveAmlTypePndg',
					remarks:$("#amlACTIONr").val(),
					id:$("#amlIDr").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};
		//$('.amlloadingr').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType:'json',
				success:function(json){
					if(json.ResponseCode == 0){

						$("#aml_" + $("#amlIDr").val()).hide();
						$('#dialogPndgAMLr').dialog('close');
					}
					//$('.amlloadingr').fadeToggle(300,'linear',function(){
						$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					//});


				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	function approveAmlTypePndg1(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveAmlTypePndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.amlloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						complete:function(res,status){
							$("#aml_" + strid).hide();
							$('.amlloading').fadeToggle(300,'linear',function(){
									$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	
	function approveKeyCostTypePndg1(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveKeyCostTypePndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.kctloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						complete:function(res,status){
							$("#kcost_" + strid).hide();
							$('.kctloading').fadeToggle(300,'linear',function(){
									$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	function approveTransceiverPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveTransceiverPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.trxloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#trx_" + strid).hide();				
							}							
							$('.trxloading').fadeToggle(300,'linear',function(){
								$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}

	function approveTransmitterPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveTransmitterPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.txloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						complete:function(res,status){
							if(res.responseText == "Successfully : APPROVED" || res.responseText == "Successfully : REJECT"){
								$("#tx_" + strid).hide();				
							}							
							$('.txloading').fadeToggle(300,'linear',function(){
									$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	function approveReceiverPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveReceiverPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.rxloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						complete:function(res,status){
							if(res.responseText == "Successfully : APPROVED" || res.responseText == "Successfully : REJECT"){
								$("#rx_" + strid).hide();			
							}							
							$('.rxloading').fadeToggle(300,'linear',function(){
									$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	function approveServerConfigPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveServerConfigPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.scloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#server_" + strid).hide();		
							}							
							$('.scloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	function approveReversal(strfrmsisdn,strtomsisdn,strvalue,strrefid,stramount,strremarks){
		$('#dialogPndgReversal').dialog('open');
		$("#reversalRefID").val(strrefid);
		$("#reversalSourceMsisdn").val(strfrmsisdn);
		$("#reversalDestMsisdn").val(strtomsisdn);
		$("#reversalValue").val(strvalue);
		$("#reversalAmount").val(stramount);
		$("#reversalRemarks").val(strremarks);		
		document.getElementById("reversalVal").innerHTML=strvalue;
		$("#reversalStatus").val("REVERSAL FOR "+ strvalue);
		$("#allocPassword").val('');
	}
	function approveRfndVoid(strmsisdn,strvalue,strrefid,stramount,strremarks){
		$('#dialogPndgRfndVoid').dialog('open');
		$("#refundRefID").val(strrefid);
		$("#refundMsisdn").val(strmsisdn);
		$("#refundValue").val(strvalue);
		$("#refundAmount").val(stramount);
		$("#refundRemarks").val(strremarks);		
		document.getElementById("refundVal").innerHTML=strvalue;
		$("#refundStatus").val("REFUND FOR "+ strvalue);
		$("#allocPassword").val('');
	}


	$("#btnReversalApprove").click(function(){
		$.ajax({
			url: service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveReversalPndgCheck',
				frmsisdn:$("#reversalSourceMsisdn").val(),
				tomsisdn:$("#reversalDestMsisdn").val(),
				value:$("#reversalValue").val(),
				amount:$("#reversalAmount").val(),
				referenceid:$("#reversalRefID").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#reversalConfirm").text(json.Message);
					$("#dialogPndgReversalPassword").dialog('open');
					$("#reversalPassword").val('');
				}else{
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
				}
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});


	$("#btnRfndVoidApprove").click(function(){
		$.ajax({
			url: service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRefundPndgCheck',
				msisdn:$("#refundMsisdn").val(),
				value:$("#refundValue").val(),
				amount:$("#refundAmount").val(),
				referenceid:$("#refundRefID").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#refundConfirm").text(json.Message);
					$("#dialogPndgRfndVoidPassword").dialog('open');
					$("#reversalPassword").val('');
				}else{
					$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
				}
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	$("#_btnReversalApprove").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveReversalPndg',
				Password:$("#reversalPassword").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogPndgReversal,#dialogPndgReversalPassword").dialog('close');
					$("#reversal_" + $("#reversalRefID").val()).hide();

				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });

			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

			
	$("#_btnRefundApprove").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'approveRefundPndg',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogPndgRfndVoid,#dialogPndgRfndVoidPassword").dialog('close');
					$("#refund_" + $("#refundRefID").val()).hide();
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() {  $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
/*	$(document).ready(function(){$("#pendingAccountTabLink a").trigger('click')});
	$(document).ready(function(){$("#pendingProcessorApprovedTabLink a").trigger('click')});
	$(document).ready(function(){$("#pendingAccountComplianceTabLink a").trigger('click')}); */
	$(document).ready(function(){$("#pendingSharafDGApprovedTabLink a").trigger('click')});
	$(document).ready(function(){$("#pendingStatusTabLink a").trigger('click')});

</script>
