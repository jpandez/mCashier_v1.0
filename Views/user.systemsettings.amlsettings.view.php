<?php require_once("views.config.properties.php"); ?>
<div id="aml" style="display:none;">
	<div class="uitabs">
		<ul>
			<li id="amlByTypeLink"><a href="#amlByTypeTab"><?php echo _("AML by Type"); ?></a></li>
			<li id="amlByMSISDNLink"><a href="#amlByMSISDNTab"><?php echo _("AML by MSISDN"); ?></a></li>
		</ul>
		<div id="amlByTypeTab">
			<div class="uitabs">
				<ul>
					<li id="amlTypeSendLink"><a href="#amlTypeSendTab"><?php echo _("Send"); ?></a></li>
					<li id="amlTypeReceiveLink"><a href="#amlTypeReceiveTab"><?php echo _("Receive"); ?></a></li>
				</ul>
				<div id="amlTypeSendTab">
					<?php if($this->getRolesConfig('EDIT_AML_SETTINGS')) { ?>
					<button type="button" id="btnATS_add" class="uibutton"><?php echo _("Add"); ?></button>
					<?php }?>
					<div style="width:100%;font-size:10px;">
						<?php $getAMLByTypeSend = $this->data("getAMLByTypeSend");?>
						<?php if(isset($getAMLByTypeSend->ResponseCode)){ ?>
								<?php if(is_array($getAMLByTypeSend->Value)){?>
								<div style="margin-top:10px"></div>
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtamlbytypesend" width="100%">
									<thead>
									<tr class="ui-widget-header">
										<th><?php echo _("ID"); ?></th>
										<th><?php echo _("Type"); ?></th>
										<th><?php echo _("Key"); ?></th>
										<th><?php echo _("Priority"); ?></th>
										<th><?php echo _("Min.Amount"); ?></th>
										<th><?php echo _("Max.Amount"); ?></th>
										<th><?php echo _("Max.Amount/ Day"); ?></th>
										<th><?php echo _("Max.Amount/ Month"); ?></th>
										<th><?php echo _("Max.Trans./ Day"); ?></th>
										<th><?php echo _("Max.Trans./ Month"); ?></th>
										<th><?php echo _("Action"); ?></th>
									</tr>
									</thead>
									<tbody>
										<?php $ctr=0; foreach($getAMLByTypeSend->Value as $t): $ctr++;?>
											<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
												<td><?php echo $t->ID; ?></td>
												<td><?php echo $t->TYPE; ?></td>
												<td><?php echo $t->KEY; ?></td>
												<td><?php echo $t->PRIORITY; ?></td>
												<td><?php echo $t->MINAMOUNT; ?></td>
												<td><?php echo $t->MAXAMOUNT; ?></td>
												<td><?php echo $t->MAXAMOUNTDAY; ?></td>
												<td><?php echo $t->MAXAMOUNTMONTH; ?></td>
												<td><?php echo $t->MAXTRANSDAY; ?></td>
												<td><?php echo $t->MAXTRANSMONTH; ?></td>
												<td><a href="javascript:requestAMLTypeSend('<?php echo $t->ID."','".$t->TYPE."','".$t->KEY."','".$t->PRIORITY."','".$t->MINAMOUNT."','".$t->MAXAMOUNT."','".$t->MAXAMOUNTDAY."','".$t->MAXAMOUNTMONTH."','".$t->MAXTRANSDAY."','".$t->MAXTRANSMONTH ?>');"><?php echo ($this->getRolesConfig('EDIT_AML_SETTINGS')) ? _("Request") : ''; ?></a>
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
				</div>
				<div id="amlTypeReceiveTab">
				<?php if($this->getRolesConfig('EDIT_AML_SETTINGS')) { ?>
					<button type="button" id="btnATR_add" class="uibutton"><?php echo _("Add"); ?></button>
				<?php }?>
					<div style="width:100%;font-size:10px;">
						<?php $getAMLByTypeReceive = $this->data("getAMLByTypeReceive");?>
						<?php if(isset($getAMLByTypeReceive->ResponseCode)){ ?>
								<?php if(is_array($getAMLByTypeReceive->Value)){?>
								<div style="margin-top:10px"></div>
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtamlbymsisdnreceive" width="100%">
									<thead>
									<tr class="ui-widget-header">
										<th><?php echo _("ID"); ?></th>
										<th><?php echo _("Type"); ?></th>
										<th><?php echo _("Key"); ?></th>
										<th><?php echo _("Priority"); ?></th>
										<th><?php echo _("Max.Amount"); ?></th>
										<th><?php echo _("Max.Amount/ Day"); ?></th>
										<th><?php echo _("Max.Amount/ Month"); ?></th>
										<th><?php echo _("Max.Trans./ Day"); ?></th>
										<th><?php echo _("Max.Trans./ Month"); ?></th>
										<th><?php echo _("Max.Current Amount"); ?></th>
										<th><?php echo _("Action"); ?></th>
									</tr>
									</thead>
									<tbody>
										<?php $ctr=0; foreach($getAMLByTypeReceive->Value as $t): $ctr++;?>
											<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
												<td><?php echo $t->ID; ?></td>
												<td><?php echo $t->TYPE; ?></td>
												<td><?php echo $t->KEY; ?></td>
												<td><?php echo $t->PRIORITY; ?></td>
												<td><?php echo $t->MAXAMOUNT; ?></td>
												<td><?php echo $t->MAXAMOUNTDAY; ?></td>
												<td><?php echo $t->MAXAMOUNTMONTH; ?></td>
												<td><?php echo $t->MAXTRANSDAY; ?></td>
												<td><?php echo $t->MAXTRANSMONTH; ?></td>
												<td><?php echo $t->MAXCURRENTAMOUNT; ?></td>
												<td><a href="javascript:requestAMLTypeReceive('<?php echo $t->ID."','".$t->TYPE."','".$t->KEY."','".$t->PRIORITY."','".$t->MAXAMOUNT."','".$t->MAXAMOUNTDAY."','".$t->MAXAMOUNTMONTH."','".$t->MAXTRANSDAY."','".$t->MAXTRANSMONTH."','".$t->MAXCURRENTAMOUNT ?>');"><?php echo ($this->getRolesConfig('EDIT_AML_SETTINGS')) ? _("Request") : ''; ?></a>
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
				</div>
			</div>
		</div>
		<div id="amlByMSISDNTab">
			<div class="uitabs">
				<ul>
					<li id="amlMSISDNSendLink"><a href="#amlMSISDNSendTab"><?php echo _("Send"); ?></a></li>
					<li id="amlMSISDNReceiveLink"><a href="#amlMSISDNReceiveTab"><?php echo _("Receive"); ?></a></li>
				</ul>
				<div id="amlMSISDNSendTab">
				<?php if($this->getRolesConfig('EDIT_AML_SETTINGS')) { ?>
					<button type="button" id="btnAMS_add" class="uibutton"><?php echo _("Add"); ?></button>
				<?php }?>
					<div style="width:100%;font-size:10px;">
						<?php $getAMLByMSISDNSend = $this->data("getAMLByMSISDNSend");?>
						<?php if(isset($getAMLByMSISDNSend->ResponseCode)){ ?>
								<?php if(is_array($getAMLByMSISDNSend->Value)){?>
								<div style="margin-top:10px"></div>
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtamlbymsisdnsend" width="100%">
									<thead>
									<tr class="ui-widget-header">
										<th><?php echo _("ID"); ?></th>
										<th><?php echo _("MSISDN"); ?></th>
										<th><?php echo _("Key"); ?></th>
										<th><?php echo _("Priority"); ?></th>
										<th><?php echo _("Min.Amount"); ?></th>
										<th><?php echo _("Max.Amount"); ?></th>
										<th><?php echo _("Max.Amount/ Day"); ?></th>
										<th><?php echo _("Max.Amount/ Month"); ?></th>
										<th><?php echo _("Max.Trans./ Day"); ?></th>
										<th><?php echo _("Max.Trans./ Month"); ?></th>
										<th><?php echo _("Action"); ?></th>
									</tr>
									</thead>
									<tbody>
										<?php $ctr=0; foreach($getAMLByMSISDNSend->Value as $t): $ctr++;?>
											<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
												<td><?php echo $t->ID; ?></td>
												<td><?php echo $t->MSISDN; ?></td>
												<td><?php echo $t->KEY; ?></td>
												<td><?php echo $t->PRIORITY; ?></td>
												<td><?php echo $t->MINAMOUNT; ?></td>
												<td><?php echo $t->MAXAMOUNT; ?></td>
												<td><?php echo $t->MAXAMOUNTDAY; ?></td>
												<td><?php echo $t->MAXAMOUNTMONTH; ?></td>
												<td><?php echo $t->MAXTRANSDAY; ?></td>
												<td><?php echo $t->MAXTRANSMONTH; ?></td>
												<td><a href="javascript:requestAMLMSISDNSend('<?php echo $t->ID."','".$t->MSISDN."','".$t->KEY."','".$t->PRIORITY."','".$t->MINAMOUNT."','".$t->MAXAMOUNT."','".$t->MAXAMOUNTDAY."','".$t->MAXAMOUNTMONTH."','".$t->MAXTRANSDAY."','".$t->MAXTRANSMONTH ?>');"><?php echo ($this->getRolesConfig('EDIT_AML_SETTINGS')) ? _("Request") : ''; ?></a>
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
				</div>
				<div id="amlMSISDNReceiveTab">
				<?php if($this->getRolesConfig('EDIT_AML_SETTINGS')) { ?>
					<button type="button" id="btnAMR_add" class="uibutton"><?php echo _("Add"); ?></button>
				<?php }?>
					<div style="width:100%;font-size:10px;">
						<?php $getAMLByMSISDNReceive = $this->data("getAMLByMSISDNReceive");?>
						<?php if(isset($getAMLByMSISDNReceive->ResponseCode)){ ?>
								<?php if(is_array($getAMLByMSISDNReceive->Value)){?>
								<div style="margin-top:10px"></div>
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtamlbymsisdnreceive" width="100%">
									<thead>
									<tr class="ui-widget-header">
										<th><?php echo _("ID"); ?></th>
										<th><?php echo _("MSISDN"); ?></th>
										<th><?php echo _("Key"); ?></th>
										<th><?php echo _("Priority"); ?></th>
										<th><?php echo _("Max.Amount"); ?></th>
										<th><?php echo _("Max.Amount/ Day"); ?></th>
										<th><?php echo _("Max.Amount/ Month"); ?></th>
										<th><?php echo _("Max.Trans./ Day"); ?></th>
										<th><?php echo _("Max.Trans./ Month"); ?></th>
										<th><?php echo _("Max.Current Amount"); ?></th>
										<th><?php echo _("Action"); ?></th>
									</tr>
									</thead>
									<tbody>
										<?php $ctr=0; foreach($getAMLByMSISDNReceive->Value as $t): $ctr++;?>
											<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
												<td><?php echo $t->ID; ?></td>
												<td><?php echo $t->MSISDN; ?></td>
												<td><?php echo $t->KEY; ?></td>
												<td><?php echo $t->PRIORITY; ?></td>
												<td><?php echo $t->MAXAMOUNT; ?></td>
												<td><?php echo $t->MAXAMOUNTDAY; ?></td>
												<td><?php echo $t->MAXAMOUNTMONTH; ?></td>
												<td><?php echo $t->MAXTRANSDAY; ?></td>
												<td><?php echo $t->MAXTRANSMONTH; ?></td>
												<td><?php echo $t->MAXCURRENTAMOUNT; ?></td>
												<td><a href="javascript:requestAMLMSISDNReceive('<?php echo $t->ID."','".$t->MSISDN."','".$t->KEY."','".$t->PRIORITY."','".$t->MAXAMOUNT."','".$t->MAXAMOUNTDAY."','".$t->MAXAMOUNTMONTH."','".$t->MAXTRANSDAY."','".$t->MAXTRANSMONTH."','".$t->MAXCURRENTAMOUNT ?>');"><?php echo ($this->getRolesConfig('EDIT_AML_SETTINGS')) ? _("Request") : ''; ?></a>
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
				</div>
			</div>



			
		</div>
	</div>



<!-- Dialogs -->
<div id="dialogATSend" title="<?php echo _("Add Account Type Send"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("Account Type"); ?><span style="color:red">*</span>:</td><td><select id="ATS_type" style="width:150px;"><option value="">Select Type</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="ATS_key" style="width:150px;"><option value="">Select Key</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATS_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Min Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATS_minAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="ATS_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATS_maxAmountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATS_maxAmountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATS_maxTransactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATS_maxTransactionMonth"></td>						
		</tr>				
	</table>
	 <div align="right">
    	<a id="btnATSAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Add"); ?></span>
        </a>
        <a id="btnATSAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div><div class="sdloading"></div>
</div>
<div id="dialogATReceive" title="<?php echo _("Add Account Type Receive"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("Account Type"); ?><span style="color:red">*</span>:</td><td><select id="ATR_type" style="width:150px;"><option value="">Select Type</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="ATR_key" style="width:150px;"><option value="">Select Key</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATR_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Trans"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="ATR_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATR_maxAmountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATR_maxAmountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATR_maxTransDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATR_maxTransMonth"></td>						
		</tr>	
		<tr>
			<td><?php echo _("Max Current Amount"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATR_maxCurrentAmount" ></td>
		</tr>			
	</table>
	<div align="right">
    	<a id="btnATRAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Add"); ?></span>
        </a>
        <a id="btnATRAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>
	</div><div class="rxloading"></div>
</div>
<div id="dialogRequestAMLTypeSend" title="<?php echo _("Request AML by Type - Send"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<input type="hidden" id="ATSreq_id"/>
		<tr>
			<td><?php echo _("Type"); ?><span style="color:red">*</span>:</td><td><select id="ATSreq_type" style="width:150px;"><option value="">Select Type</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="ATSreq_key" style="width:150px;"></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATSreq_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Min Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATSreq_minAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="ATSreq_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATSreq_amountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATSreq_amountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATSreq_transactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATSreq_transactionMonth"></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnATSRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnATSRequestCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div>
</div>

<div id="dialogRequestAMLTypeReceive" title="<?php echo _("Request AML by Type - Receive"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<input type="hidden" id="ATRreq_id"/>
		<tr>
			<td><?php echo _("Type"); ?><span style="color:red">*</span>:</td><td><select id="ATRreq_type" style="width:150px;"><option value="">Select Type</option></select></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="ATRreq_key" style="width:150px;"></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATRreq_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="ATRreq_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATRreq_amountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATRreq_amountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATRreq_transactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATRreq_transactionMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Current Amount"); ?><span style="color:red">*</span>:</td><td><input type="text" id="ATRreq_currentAmount"></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnATRRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnAMTRequestCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div>
</div>

<div id="dialogAddAMLMSISDNSend" title="<?php echo _("Add AML by MSISDN - Send"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("MSISDN"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMS_msisdn"></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="AMS_key" style="width:150px;"></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMS_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Min Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMS_minAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMS_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMS_amountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMS_amountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMS_transactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMS_transactionMonth"></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnAMSAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnAMSAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div>
</div>

<div id="dialogAddAMLMSISDNReceive" title="<?php echo _("Add AML by MSISDN - Receive"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<tr>
			<td><?php echo _("MSISDN"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMR_msisdn"></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="AMR_key" style="width:150px;"></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMR_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMR_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMR_amountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMR_amountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMR_transactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMR_transactionMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Current Amount"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMR_currentAmount"></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnAMRAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnAMRAddCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div>
</div>

<div id="dialogRequestAMLMSISDNSend" title="<?php echo _("Request AML by MSISDN - Send"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<input type="hidden" id="AMSreq_id"/>
		<tr>
			<td><?php echo _("MSISDN"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMSreq_msisdn"></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="AMSreq_key" style="width:150px;"></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMSreq_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Min Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMSreq_minAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMSreq_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMSreq_amountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMSreq_amountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMSreq_transactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMSreq_transactionMonth"></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnAMSRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnAMSRequestCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div>
</div>

<div id="dialogRequestAMLMSISDNReceive" title="<?php echo _("Request AML by MSISDN - Receive"); ?>">		                
	<table style="text-align:left;" class="tablet">
		<input type="hidden" id="AMRreq_id"/>
		<tr>
			<td><?php echo _("MSISDN"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMRreq_msisdn"></td>
		</tr>
		<tr>
			<td><?php echo _("Key"); ?><span style="color:red">*</span>:</td><td><select id="AMRreq_key" style="width:150px;"></select></td>
		</tr>
		<tr>
			<td><?php echo _("Priority"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMRreq_priority" value="0"/></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Transaction"); ?><span style="color:red">*</span>:</td><td><input type="text"  id="AMRreq_maxAmount" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMRreq_amountDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Amount/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMRreq_amountMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Day"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMRreq_transactionDay" ></td>
		</tr>
		<tr>
			<td><?php echo _("Max Transaction/Month"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMRreq_transactionMonth"></td>						
		</tr>
		<tr>
			<td><?php echo _("Max Current Amount"); ?><span style="color:red">*</span>:</td><td><input type="text" id="AMRreq_currentAmount"></td>						
		</tr>
	</table>
	<div align="right">
    	<a id="btnAMRRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
        </a>
        <a id="btnAMRRequestCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Cancel"); ?></span>
        </a>                    
	</div>
</div>


</div>
<!-- end ui-dialog account type send -->
<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
$(function(){
	$('#dtamlbymsisdnsend,#dtamlbymsisdnreceive,#dtamlbytypesend').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});
});
$("#aml").fadeIn(700);

// Dialog
$('#dialogATSend,#dialogATReceive,#dialogAddAMLMSISDNSend,#dialogAddAMLMSISDNReceive,#dialogRequestAMLMSISDNSend,#dialogRequestAMLMSISDNReceive,#dialogRequestAMLTypeSend,#dialogRequestAMLTypeReceive').dialog({
	autoOpen: false,
	width: 500,
	draggable: true,
	resizable: false,
	modal:true
});
$("#btnAMS_add").click(function(){
	amlKey("#AMS_key");
	$("#dialogAddAMLMSISDNSend").dialog('open');
});
$("#btnAMSAddCancel").click(function(){
	$("#dialogAddAMLMSISDNSend").dialog('close');
});
$("#btnAMR_add").click(function(){
	amlKey("#AMR_key");
	$("#dialogAddAMLMSISDNReceive").dialog('open');
});
$("#btnAMRAddCancel").click(function(){
	$("#dialogAddAMLMSISDNReceive").dialog('close');
});
$("#btnAMSRequestCancel").click(function(){
	$("#dialogRequestAMLMSISDNSend").dialog('close');
});
$("#btnAMRRequestCancel").click(function(){
	$("#dialogRequestAMLMSISDNReceive").dialog('close');
});
$("#btnATS_add").click(function(){
	type_lists("#ATS_type");
	amlKey("#ATS_key");
	$("#dialogATSend").dialog('open');
});
$("#btnATSAddCancel").click(function(){
	$("#dialogATSend").dialog('close');
});
$("#btnATR_add").click(function(){
	type_lists("#ATR_type");
	amlKey("#ATR_key");
	$("#dialogATReceive").dialog('open');
});
$("#btnATRAddCancel").click(function(){
	$("#dialogATReceive").dialog('close');
});
$("#btnATSRequestCancel").click(function(){
	$("#dialogRequestAMLTypeSend").dialog('close');
});
$("#btnAMTRequestCancel").click(function(){
	$("#dialogRequestAMLTypeReceive").dialog('close');
});


	function amlKey(ddID,selected){
		var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR512wC//8P1n5kvO+46bNKk47mYGeBBS2vFTduOsRSypT4ceKnNXqxQHu18qHMt0qulg==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$(ddID).find('option').remove();
					listitem+="<option value=''>Select Key</option>"
					for(x in result.value){
						listitem += '<option value="'+ result.value[x].KEY +'">' + result.value[x].KEY + '</option>';
					}
					$(ddID).html(listitem);
					$(ddID+" option[value='"+selected+"']").attr('selected','selected');
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}

	$("#btnAMSAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addAMLMSISDNSend',
				msisdn:$("#AMS_msisdn").val(),
				key:$("#AMS_key").val(),
				priority:$("#AMS_priority").val(),
				minAmount:$("#AMS_minAmount").val(),
				maxAmount:$("#AMS_maxAmount").val(),
				maxAmountDay:$("#AMS_amountDay").val(),
				maxAmountMonth:$("#AMS_amountMonth").val(),
				maxTransDay:$("#AMS_transactionDay").val(),
				maxTransMonth:$("#AMS_transactionMonth").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogAddAMLMSISDNSend").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnAMRAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addAMLMSISDNReceive',
				msisdn:$("#AMR_msisdn").val(),
				key:$("#AMR_key").val(),
				priority:$("#AMR_priority").val(),
				maxAmount:$("#AMR_maxAmount").val(),
				maxAmountDay:$("#AMR_amountDay").val(),
				maxAmountMonth:$("#AMR_amountMonth").val(),
				maxTransDay:$("#AMR_transactionDay").val(),
				maxTransMonth:$("#AMR_transactionMonth").val(),
				maxCurrentAmount:$("#AMR_currentAmount").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogAddAMLMSISDNReceive").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function requestAMLMSISDNSend(id,msisdn,key,priority,minAmount,maxAmount,maxAmountDay,maxAmountMonth,maxTransDay,maxTransMonth){
		$("#AMSreq_id").val(id);
		$("#AMSreq_msisdn").val(msisdn);
		amlKey("#AMSreq_key",key);
		$("#AMSreq_priority").val(priority);
		$("#AMSreq_minAmount").val(minAmount);
		$("#AMSreq_maxAmount").val(maxAmount);
		$("#AMSreq_amountDay").val(maxAmountDay);
		$("#AMSreq_amountMonth").val(maxAmountMonth);
		$("#AMSreq_transactionDay").val(maxTransDay);
		$("#AMSreq_transactionMonth").val(maxTransMonth);
		$("#dialogRequestAMLMSISDNSend").dialog('open');
	}

	function requestAMLMSISDNReceive(id,msisdn,key,priority,maxAmount,maxAmountDay,maxAmountMonth,maxTransDay,maxTransMonth,maxCurrentAmount){
		$("#AMRreq_id").val(id);
		$("#AMRreq_msisdn").val(msisdn);
		amlKey("#AMRreq_key",key);
		$("#AMRreq_priority").val(priority);
		$("#AMRreq_maxAmount").val(maxAmount);
		$("#AMRreq_amountDay").val(maxAmountDay);
		$("#AMRreq_amountMonth").val(maxAmountMonth);
		$("#AMRreq_transactionDay").val(maxTransDay);
		$("#AMRreq_transactionMonth").val(maxTransMonth);
		$("#AMRreq_currentAmount").val(maxCurrentAmount);
		$("#dialogRequestAMLMSISDNReceive").dialog('open');
	}

	$("#btnAMSRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestAMLMSISDNSend',
				id:$("#AMSreq_id").val(),
				msisdn:$("#AMSreq_msisdn").val(),
				key:$("#AMSreq_key").val(),
				priority:$("#AMSreq_priority").val(),
				minAmount:$("#AMSreq_minAmount").val(),
				maxAmount:$("#AMSreq_maxAmount").val(),
				maxAmountDay:$("#AMSreq_amountDay").val(),
				maxAmountMonth:$("#AMSreq_amountMonth").val(),
				maxTransDay:$("#AMSreq_transactionDay").val(),
				maxTransMonth:$("#AMSreq_transactionMonth").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogRequestAMLMSISDNSend").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnAMRRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestAMLMSISDNReceive',
				id:$("#AMRreq_id").val(),
				msisdn:$("#AMRreq_msisdn").val(),
				key:$("#AMRreq_key").val(),
				priority:$("#AMRreq_priority").val(),
				maxAmount:$("#AMRreq_maxAmount").val(),
				maxAmountDay:$("#AMRreq_amountDay").val(),
				maxAmountMonth:$("#AMRreq_amountMonth").val(),
				maxTransDay:$("#AMRreq_transactionDay").val(),
				maxTransMonth:$("#AMRreq_transactionMonth").val(),
				maxCurrentAmount:$("#AMRreq_currentAmount").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogRequestAMLMSISDNReceive").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
/*--------------------------AML TYPE----------------------------------*/

	$("#btnATSAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addAMLTypeSend',
				type:$("#ATS_type").val(),
				key:$("#ATS_key").val(),
				priority:$("#ATS_priority").val(),
				minAmount:$("#ATS_minAmount").val(),
				maxAmount:$("#ATS_maxAmount").val(),
				maxAmountDay:$("#ATS_maxAmountDay").val(),
				maxAmountMonth:$("#ATS_maxAmountMonth").val(),
				maxTransDay:$("#ATS_maxTransactionDay").val(),
				maxTransMonth:$("#ATS_maxTransactionMonth").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogATSend").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnATRAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'addAMLTypeReceive',
				type:$("#ATR_type").val(),
				key:$("#ATR_key").val(),
				priority:$("#ATR_priority").val(),
				maxAmount:$("#ATR_maxAmount").val(),
				maxAmountDay:$("#ATR_maxAmountDay").val(),
				maxAmountMonth:$("#ATR_maxAmountMonth").val(),
				maxTransDay:$("#ATR_maxTransDay").val(),
				maxTransMonth:$("#ATR_maxTransMonth").val(),
				maxCurrentAmount:$("#ATR_maxCurrentAmount").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogATReceive").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	function requestAMLTypeSend(id,type,key,priority,minAmount,maxAmount,maxAmountDay,maxAmountMonth,maxTransDay,maxTransMonth){
		$("#ATSreq_id").val(id);
		type_lists("#ATSreq_type",type);
		amlKey("#ATSreq_key",key);
		$("#ATSreq_priority").val(priority);
		$("#ATSreq_minAmount").val(minAmount);
		$("#ATSreq_maxAmount").val(maxAmount);
		$("#ATSreq_amountDay").val(maxAmountDay);
		$("#ATSreq_amountMonth").val(maxAmountMonth);
		$("#ATSreq_transactionDay").val(maxTransDay);
		$("#ATSreq_transactionMonth").val(maxTransMonth);
		$("#dialogRequestAMLTypeSend").dialog('open');
	}

	function requestAMLTypeReceive(id,type,key,priority,maxAmount,maxAmountDay,maxAmountMonth,maxTransDay,maxTransMonth,maxCurrentAmount){
		$("#ATRreq_id").val(id);
		type_lists("#ATRreq_type",type);
		amlKey("#ATRreq_key",key);
		$("#ATRreq_priority").val(priority);
		$("#ATRreq_maxAmount").val(maxAmount);
		$("#ATRreq_amountDay").val(maxAmountDay);
		$("#ATRreq_amountMonth").val(maxAmountMonth);
		$("#ATRreq_transactionDay").val(maxTransDay);
		$("#ATRreq_transactionMonth").val(maxTransMonth);
		$("#ATRreq_currentAmount").val(maxCurrentAmount);
		$("#dialogRequestAMLTypeReceive").dialog('open');
	}

	$("#btnATSRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestAMLTypeSend',
				id:$("#ATSreq_id").val(),
				type:$("#ATSreq_type").val(),
				key:$("#ATSreq_key").val(),
				priority:$("#ATSreq_priority").val(),
				minAmount:$("#ATSreq_minAmount").val(),
				maxAmount:$("#ATSreq_maxAmount").val(),
				maxAmountDay:$("#ATSreq_amountDay").val(),
				maxAmountMonth:$("#ATSreq_amountMonth").val(),
				maxTransDay:$("#ATSreq_transactionDay").val(),
				maxTransMonth:$("#ATSreq_transactionMonth").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogRequestAMLTypeSend").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

	$("#btnATRRequest").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'requestAMLTypeReceive',
				id:$("#ATRreq_id").val(),
				type:$("#ATRreq_type").val(),
				key:$("#ATRreq_key").val(),
				priority:$("#ATRreq_priority").val(),
				maxAmount:$("#ATRreq_maxAmount").val(),
				maxAmountDay:$("#ATRreq_amountDay").val(),
				maxAmountMonth:$("#ATRreq_amountMonth").val(),
				maxTransDay:$("#ATRreq_transactionDay").val(),
				maxTransMonth:$("#ATRreq_transactionMonth").val(),
				maxCurrentAmount:$("#ATRreq_currentAmount").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogRequestAMLTypeReceive").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
</script>