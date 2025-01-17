<?php require_once("views.config.properties.php"); ?>
<?php
unset($_SESSION['sizeSend4']);
unset($_SESSION['sizeSend5']);
?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
	.loading, .ploading, .rloading, .revloading {
		height:25px;
		width:81px;
		float:right;
		background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
		display:none;
	}
	
	.preview4, .preview5
{
	width:100px;
	border:solid 1px #dedede;
	padding:10px;
}
._d-inline{
	display:inline;
}
._pendingreg{
	display:none;
	margin-top:15px;
}
._accountsummary{
	width:100%;
	font-size:10px;
}
._m-top{
	margin-top:10px;
}
._m-bottom{
	margin-bottom:10px;
}
._d-none{
	display:none;
}
._divKYC{
	border:0px solid gray;
}
._accountInfoTabHolder{
	border:0px solid;width:1100px;
}
._account_info_details{
	border:2px solid red;margin-top:10px;margin-right:600px;float:left;
}
._bank_info_details{
	border:0px solid red;width:350px;margin-top:5px;margin-right:30px;float:left;
}
._accounttype{
	width:150px;
}
._bank_info_details2{
	border:0px solid red;width:350px;margin-top:5px;margin-right:10px;float:left;
}
._containeruploadfiles{
	border:0px solid #606060;width:100%;margin-top:20px;float:left;margin-bottom:80px;
}
._uploadfiles{
	border:1px solid #c6c2c2; border-radius:7px; width:49%;margin-top:0px;float:left; margin-right:2%;background-color:#f7f7f7; height:215px; overflow: scroll;  padding:10px;
}
._f-left{
	float:left;
}
._f-right{
	float:right;
}
._account_info_details2{
	border:0px solid red;width:370px;margin-top:5px;float:left;
}
._preview{
	float:left; border-style: solid; height: 25px;padding: 5px;
}
._viewuploadedfiles{
	border:1px solid #c6c2c2; border-radius:7px;width:49%;margin-top:0px;float:left; background-color:#f7f7f7;  height:215px; overflow: scroll; overflow-x: hidden; padding: 10px;
}
</style>
<div id="data_loading" class="_d-inline">
	<table width = "100%">
		<tr>
			<td align = "center">
				<img src = "<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" alt = "Loading"/>
			</td>
		</tr>
	</table>
</div>
<div id="pendingreg" class="_pendingreg">
	<div id="accountsummary" class="_accountsummary">
		<?php $pendingsubscriber = $this->data("subscriberPending"); ?>
		<?php if(isset($pendingsubscriber->ResponseCode)){ ?>
		<?php if(is_array($pendingsubscriber->Value)){?>
		<div class="_m-top"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="account" width="100%" >
			<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("DATE REGISTERED"); ?></th>
					<th><?php echo _("COMPANY"); ?></th>
					<th><?php echo _("MSISDN"); ?></th>
					<th><?php echo _("FIRST NAME"); ?></th>
					<th><?php echo _("LAST NAME"); ?></th>
					<th><?php echo _("ACCOUNT TYPE"); ?></th>																
					<th><?php echo _("STATUS"); ?></th>
					<th><?php echo _("IS VAT APP USER"); ?></th>
					<th><?php echo _("STATUS"); ?></th>
					<th><?php echo _("USER ID"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($pendingsubscriber->Value as $t): $ctr++;?>
				<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_<?php echo $t->MSISDN; ?>">
					<td><?php echo $t->REGDATE; ?></td>
					<td><?php echo $t->COMPANY; ?></td>
					<td>
						<?php 
						if (($t->ID)==($t->MSISDN)){
							echo ''; 
						} else if (strlen($t->MSISDN)!= 12){
							echo '';
						}  else {
							echo $t->MSISDN;
						}
						?>
					</td>
					<td><?php echo $t->FIRSTNAME; ?></td>
					<td><?php echo $t->LASTNAME; ?></td>
					<td><?php echo $t->TYPE; ?></td>										
					<!--<td><?php echo $t->STATUS; ?></td>-->
					<td>DEACTIVE</td>
					<td><?php if(($t->ISVATAPPUSER)==0){
								echo "NO";
							}else if(($t->ISVATAPPUSER)==1){
								echo "YES";
							} ?></td>
					<td><?php echo $t->KYCREASON; ?></td>
					<td><?php echo $t->USERID; ?></td>
					<td> <?php if(($t->ID) == ($t->MSISDN)) { ?>
						<!-- <a href="javascript:viewSMBAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a> -->
						<button class="btn btn-sm btn-primary viewaccount-link" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>" data-action="viewSMBAccount">View</button>
						<?php } else { ?>
						<!-- <a href="javascript:viewAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a> -->
						<button class="btn btn-sm btn-primary viewaccount-link" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>" data-action="viewAccount">View</button>
						<?php } ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php } 
	else {
		echo "<h3>". $pendingsubscriber->Message ."</h3>";
	}?>
	<?php } ?>
</div>

<div id="pending_acccount_view" class="_d-none" title="Pending Approval">
	<div class="panelButtons _m-bottom">
		<div id="divKYC" class="_divKYC">

			<button id="btnApproveKYC" class="buttonx"><?php echo _("approve"); ?></button>
			<button id="btnRejectKYC" class="buttonx"><?php echo _("decline"); ?></button> 
			<button id="btnSendbackKYC" class="buttonx"><?php echo _("send back to Etisalat"); ?></button> 

			<button id="btnApproveSMBKYC" class="buttonx"><?php echo _("approve"); ?></button>
			<button id="btnRejectSMBKYC" class="buttonx"><?php echo _("decline"); ?></button> 
			<button id="btnSendbackSMBKYC" class="buttonx"><?php echo _("Send Back to compliance"); ?></button>
			<?php if($this->getRolesConfig('SENTBACK_REQUEST')) { 
			echo '<button id="btnSendBackApplication" class="buttonx">';
			echo _("send back to Etisalat");
			echo '</button>';
			} ?>
			
		
			<!--<button id="btnSendBackApplication" class="buttonx"><?php echo _("send back"); ?></button>-->

				<!--<button id="btnEditPInfo" class="buttonx"><?php echo _("edit"); ?></button>
				<button id="btnUpdatePInfo" class="_d-none" class="buttonx"><?php echo _("save"); ?></button>
				<button id="btnCancelPInfo" class="_d-none" class="buttonx"><?php echo _("cancel"); ?></button>-->
			<!--	<div style="float:right;">
					<div align="right" style="float:right;"><a id="checkID"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("Application File1");} ?></a></div><br><br>
					<div align="right" style="float:right;"><a id="checkID2"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("Application File2");} ?></a></div><br><br>
					<div align="right" style="float:right;"><a id="checkID3"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("Application File3");} ?></a></div><br>
					
					
					<table>
					<tr>
						<td align="center"> <div style="float:right; border-style: solid; height: 25px;padding: 10px;"id='preview4'></div></td>
						<td align="bottom">	<div class="imagename" id="cancelImage4" align="bottom" style="color:#585b60; float:right;" hidden>
								
									
									<a id="delD" title="Delete Application File"  href="javascript:delImage('Image4')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>	
						<td align="center">	<button  id="fileclick4" type = "button" class="ui-button ui-state-default-eti ui-corner-all" align="right" style="float:right;"><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button><br>
							<input id="sendImageStatus4" value="NC" class="_d-none"/>
						</td>
						
					</tr>	
					<tr>
					
						<td align="center">	<div style="float:right; border-style: solid; height: 25px;padding: 5px;"id='preview5'></div></td>
						<td align="bottom">	<div class="imagename" id="cancelImage5"align="bottom" style="color:#585b60; float:right;width:27;" hidden>
								
									
									<a id="delE" title="Delete Application File" href="javascript:delImage('Image5')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>
						<td align="center">	<button  id="fileclick5" type = "button" class="ui-button ui-state-default-eti ui-corner-all" align="right" style="float:right;"><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button><br>
							<input id="sendImageStatus5" value="NC" class="_d-none"/>
						</td>
					</tr>
					<tr>
					
						<td align="center">	<div style="float:right; border-style: solid; height: 25px;padding: 5px;"id='preview6'></div></td>
						<td align="bottom">	<div class="imagename" id="cancelImage6"align="bottom" style="color:#585b60; float:right;width:27;" hidden>
								
									
									<a id="delF" title="Delete Application File" href="javascript:delImage('Image6')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>
						<td align="center">	<button  id="fileclick6" type = "button" class="ui-button ui-state-default-eti ui-corner-all" align="right" style="float:right;"><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button><br>
							<input id="sendImageStatus6" value="NC" class="_d-none"/>
						</td>
						
						
					</tr>
					<tr>
					
						<td align="center">	<div style="float:right; border-style: solid; height: 25px;padding: 5px;"id='preview7'></div></td>
						<td align="bottom">	<div class="imagename" id="cancelImage7"align="bottom" style="color:#585b60; float:right;width:27;" hidden>
								
									
									<a id="delG" title="Delete Application File" href="javascript:delImage('Image7')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>
						<td align="center">	<button  id="fileclick7" type = "button" class="ui-button ui-state-default-eti ui-corner-all" align="right" style="float:right;"><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button><br>
							<input id="sendImageStatus7" value="NC" class="_d-none"/>
						</td>
						
						
					</tr>
					<tr>
					
						<td align="center">	<div style="float:right; border-style: solid; height: 25px;padding: 5px;"id='preview8'></div></td>
						<td align="bottom">	<div class="imagename" id="cancelImage8"align="bottom" style="color:#585b60; float:right;width:27;" hidden>
								
									
									<a id="delH" title="Delete Application File" href="javascript:delImage('Image8')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>
						<td align="center">	<button  id="fileclick8" type = "button" class="ui-button ui-state-default-eti ui-corner-all" align="right" style="float:right;"><?php echo _("Attach File (Max 3MB | PDF or JPG)"); ?></button><br>
							<input id="sendImageStatus8" value="NC" class="_d-none"/>
						</td>
						
						
					</tr>

					</table>
				</div> -->
			</div>								
		</div>
		<!--<form id="imageformnew4" method="post" enctype="multipart/form-data" action='ajaximage2.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage4" />
								<input type="file" name="photoimgSend4" id="photoimgSend4" />

		</form>
		<form id="imageformnew5" method="post" enctype="multipart/form-data" action='ajaximage2.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage5" />
								<input type="file" name="photoimgSend5" id="photoimgSend5" />

		</form>

		<form id="imageformnew6" method="post" enctype="multipart/form-data" action='ajaximage2.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage6" />
								<input type="file" name="photoimgSend6" id="photoimgSend6" />

		</form>
		<form id="imageformnew7" method="post" enctype="multipart/form-data" action='ajaximage2.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage7" />
								<input type="file" name="photoimgSend7" id="photoimgSend7" />

		</form>
		<form id="imageformnew8" method="post" enctype="multipart/form-data" action='ajaximage2.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage8" />
								<input type="file" name="photoimgSend8" id="photoimgSend8" />

		</form>
		
		<div id='preview4'></div>
		<div id='preview5'></div>
		<div id='preview6'></div>
		<div id='preview7'></div>
		<div id='preview8'></div>			-->
			
		<div class="accountInfoTabHolder _accountInfoTabHolder">		
			<div class="account_info_details _account_info_details">
				<table border="1" id="tblAccount" cellspacing="5" class="tablet">
					<tr>
						<td>
							<?php echo _("Merchant ID"); ?><span class="text-danger">*</span>:
						</td>
						<td>
							<input id="mid" type="text" class="numonly">
						</td>
						<td><?php echo _("Merchant MSISDN"); ?><span class="text-danger">*</span>:</td><td><input id="mmsisdn" type="text" ><input id="mmsisdn2" type="text" ></td>
						<!--<td><?php echo _("Terminal ID"); ?><span class="text-danger">*</span>:</td><td><input id="tid" type="text" disabled="disabled"></td>-->
						<td id="tdtid"><?php echo _("Terminal ID"); ?><span class="text-danger">*</span>:</td><td><input id="tid" maxlength="8" minlength="8" type="text" class="numonly"></td>
					</tr>
				</table>
			</div>
		</div>
		
		
		
		
		
		<div class="bank_info_details _bank_info_details">
		
			<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
				<tr><td><?php echo _("Company Name"); ?>:</td><td><input type="text" id="corpbusinessname" disabled="disabled" ></td></tr>
				<tr>
					<td><?php echo _("Account Type"); ?><span class="text-danger">*</span>:</td>
					<td>
						<select id="selectedType" class="_accounttype" disabled="disabled">
							
						</select>
					</td>
				</tr>
				<tr class="_d-none"><td><?php echo _("Type of Business"); ?><span class="text-danger">*</span>:</td>
					<td><input type="text" id="corptypeofbusiness" disabled="disabled" ></td>
				</tr>
				<tr><td><?php echo _("On Boarded By"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corponboardedby" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("Receipt Printed Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpreceiptname" disabled="disabled" ></td></tr>
				<tr class="_d-none"><td><?php echo _("Nature of Business"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpownershipinfo" disabled="disabled" ></td></tr>
				<tr>
					<!--<td>&nbsp;</td>-->
				</tr>
				<tr class="_d-none"><td><?php echo _("Building Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="building" disabled="disabled" ></td></tr>
				<tr class="_d-none"><td><?php echo _("Floor"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="floor" disabled="disabled" ></td></tr>
				<tr class="_d-none"><td><?php echo _("Street Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="street" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("Area"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="area" disabled="disabled" ></td></tr>
				<tr><td><?php echo _("City / Emirate"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="city" disabled="disabled" ></td></tr>
				<tr class="_d-none"><td><?php echo _("Country"); ?><span class="text-danger">*</span> :</td>
					<td><input type="text" id="country" disabled="disabled" ></td></tr>
					<tr><td><?php echo _("P O Box"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pobox" disabled="disabled" ></td></tr>
				</table>
			</div>
			<div class="bank_info_details _bank_info_details2">
				<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
					<tr>
						<td colspan="2">Authorized Person Details</td>
					</tr>
					<tr><td><?php echo _("First Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pFName" disabled="disabled" ></td></tr>
					<tr><td><?php echo _("Last Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pLName" disabled="disabled" ></td></tr>				
					<tr><td><?php echo _("Primary MSISDN"); ?><span class="text-danger">*</span>:</td><td><input id="authNumber" type="text" disabled="disabled" ><input id="authNumber2" type="text" ></td></tr>
					<tr><td><?php echo _("Primary Email"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pEmail" disabled="disabled" ></td></tr>
					<tr class="_d-none"><td><?php echo _("ID Type"); ?><span class="text-danger">*</span> :</td>
						<td><input type="text" id="pIDDesc" disabled="disabled" ></td>
					</tr>
					<tr class="_d-none"><td><?php echo _("ID No."); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDNumber" disabled="disabled" ></td></tr>
					<tr class="_d-none"><td><?php echo _("Date of Issuance"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDIssuance" disabled="disabled" readonly="true"></td></tr>
					<tr class="_d-none"><td><?php echo _("Date of Expiry"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDExpiry" disabled="disabled" readonly="true"></td></tr>
					<tr class="_d-none"><td><?php echo _("Nationality"); ?><span class="text-danger">*</span> :</td>
						<td><input type="text" id="pNationality" disabled="disabled" ></td></tr>

					<tr><td><?php echo _("AppID"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pAppID" disabled="disabled" ></td></tr>
					
					<tr><td><?php echo _("TRN"); ?> :</td><td><input type="text" id="pTRN" disabled="disabled" ></td></tr>

						<tr class="_d-none"><td><?php echo _("Title / Position"); ?><span class="text-danger">*</span>:</td>
							<td><input type="text" id="pProfession" disabled="disabled" >
							
							</td>
						</tr>
					</table>
				</div>
				<div class="account_info_details2 _account_info_details2">
					<table border="0" cellspacing="5" class="tablet">
						<tr>
							<td colspan="2">Fees</td>
						</tr>
						<tr>
							<td><?php echo _("Merchant Discount Rate Premium (%)"); ?><span class="text-danger">*</span>:</td>
							<td>
								<div class="field required">
									<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESTRXN" id="mercdiscountrate" >
									<span class="iferror"><?php echo _("Field required"); ?></span>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo _("Merchant Discount Rate NonPremium (%)"); ?><span class="text-danger">*</span>:</td>
							<td>
								<div class="field required">
									<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESTRXNNONP" id="mercdiscountratenonp" >
									<span class="iferror"><?php echo _("Field required"); ?></span>
								</div>
							</td>
						</tr>
						<tr>
							<td class="_d-none"><?php echo _("Acquiring Interchange (%)"); ?>:</td>
							<td class="_d-none">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="mcvisafee" >
							</td>					
						</tr>
						<tr>
							<td>
								<select id="CASHTYPE" name="CASHTYPE" class="w-100" disabled="disabled">

								</select>
							</td>
							<td>
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashdiscountrate" >
							</td>					
						</tr>
						<tr>
							<td class="_d-none"><?php echo _("Cash Transaction Fee"); ?>:</td>
							<td class="_d-none">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashtransfee" >
							</td>					
						</tr>
					</table>
				</div>
				
				<form name="form" action="" method="get">
					<input type="text" id="QuerySum" name="QuerySum" disabled="disabled" hidden>
				</form>
			
				<div class="containeruploadfiles _containeruploadfiles">
				<div class="uploadfiles _uploadfiles">
				<h3>Upload New File (Maximum of 5 files)</h3>
				<button id="fileclick" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button>   
									&nbsp;&nbsp;

								<div class="_preview"id='preview'>	</div>					
							
									<button id="cancelImage1" class="text-danger">Remove</button>

							</br>
							</br>
							</br>

							<!-- <button style="float:left;" id="addFile2" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button> -->
							
							<div class="_d-none" id="file2div">

							<button id="fileclicknew1" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
							&nbsp;&nbsp; 
							
							<div class="_preview" id='previewnew1'></div>
							<button id="cancelImage2" class="text-danger">Remove</button>

							</div>
								
								</br>
								</br>
							
							<!-- <button style="float:left;  display:none;" id="addFile3" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button> -->

							<div class="_d-none" id="file3div">

							<button id="fileclicknew2" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
							&nbsp;&nbsp;
							<div class="_preview" id='previewnew2'></div>	
							<button id="cancelImage3" class="text-danger">Remove</button>


							</div>
								
								</br>
								</br>

								<!-- <button style="float:left;  display:none;" id="addFile4" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button>  -->

								<div class="_d-none" id="file4div">
									
									<button id="fileclicknew3" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew3'></div>	
									<button id="cancelImage4" class="text-danger">Remove</button>


								</div>

								</br>
								</br>

								<!-- <button style="float:left; display:none;" id="addFile5" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button>  -->

								<div class="_d-none" id="file5div">
									
									<button id="fileclicknew4" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew4'></div>	
									<button id="cancelImage5" class="text-danger">Remove</button>


								</div>

								</br>
								</br>

								<!-- <button style="float:left;display:none;" id="addFile6" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button>  -->

								<div class="_d-none" id="file6div">
									
									<button id="fileclicknew5" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew5'></div>	
									<button id="cancelImage6" class="text-danger">Remove</button>


								</div>

								</br>
								</br>

								<!-- <button style="float:left;display:none;" id="addFile7" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button>  -->

								<div class="_d-none" id="file7div">
									
									<button id="fileclicknew6" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew6'></div>	
									<button id="cancelImage7" class="text-danger">Remove</button>


								</div>

								</br>
								</br>

								<!-- <button style="float:left; display:none;" id="addFile8" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button>  -->

								<div class="_d-none" id="file8div">
									
									<button id="fileclicknew7" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew7'></div>	
									<button id="cancelImage8" class="text-danger">Remove</button>


								</div>

								</br>
								</br>

								<!-- <button style="float:left; display:none;" id="addFile9" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button>  -->

								<div class="_d-none" id="file9div">
									
									<button id="fileclicknew8" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew8'></div>	
									<button id="cancelImage9" class="text-danger">Remove</button>


								</div>

								</br>
								</br>

								<!-- <button style="float:left; display:none;" id="addFile10" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Add File"); ?></button> --> 

								<div class="_d-none" id="file10div">
									
									<button id="fileclicknew9" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left"><?php echo _("Add File (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview" id='previewnew9'></div>	
									<button id="cancelImage10" class="text-danger">Remove</button>


								</div>
				
				</div>
				<div class="viewuploadedfiles _viewuploadedfiles">
				<div class="_f-left">
				<h3>Uploaded File</h3>
					<?php  
						/*$number = $_GET['QuerySum'];
						echo "".$number;
						for ($x = 0; $x <= 2; $x++) {
						  echo "The number is: $x <br>";
						}*/
					?> 
					<div id="listqwert"></div>
					<!--<div align="right" style="float:right;"><a id="checkID"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("View Application File 1");} ?></a></div><br><br>
					<div align="right" style="float:right;"><a id="checkID2"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("View Application File 2");} ?></a></div><br><br>
					<div align="right" style="float:right;"><a id="checkID3"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("View Application File 3");} ?></a></div><br>-->
				</div>	
			
				</div>
			
				</div>
				

				<td>
												
												
												
												
												
												
											</td>
				<div align="left" class="_d-none">
									<table>
										<tr><td>Application File, PDF or JPEG, max total size 3MB</td><!--<td>Image 2</td><td>Image 3</td>--></tr>
										<tr>
											<td>
												<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Image1" />
													<input type="hidden" name="updateI1" id="updateI1" value="REG" />
													<input type="file" name="photoimg" id="photoimg" />

												</form>
											</td>
											<td>
												<form id="imageformnew1" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew1" />
													<input type="hidden" name="updateI2" id="updateI2" value="REG" />
													<input type="file" name="photoimgnew1" id="photoimgnew1" />
					 
												</form>
											</td>
											
											<td>
												<form id="imageformnew2" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew2" />
													<input type="hidden" name="updateI3" id="updateI3" value="REG" />
													<input type="file" name="photoimgnew2" id="photoimgnew2" />
					 
												</form>
											</td>

											<td>
												<form id="imageformnew3" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew3" />
													<input type="hidden" name="updateI4" id="updateI4" value="REG" />
													<input type="file" name="photoimgnew3" id="photoimgnew3" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew4" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew4" />
													<input type="hidden" name="updateI5" id="updateI5" value="REG" />
													<input type="file" name="photoimgnew4" id="photoimgnew4" />

					 
												</form>
											</td>
											<td>
												<form id="imageformnew5" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew5" />
													<input type="hidden" name="updateI6" id="updateI6" value="REG" />
													<input type="file" name="photoimgnew5" id="photoimgnew5" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew6" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew6" />
													<input type="hidden" name="updateI7" id="updateI7" value="REG" />
													<input type="file" name="photoimgnew6" id="photoimgnew6" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew7" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew7" />
													<input type="file" name="photoimgnew7" id="photoimgnew7" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew8" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew8" />
													<input type="file" name="photoimgnew8" id="photoimgnew8" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew9" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew9" />
													<input type="file" name="photoimgnew9" id="photoimgnew9" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew10" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew10" />
													<input type="file" name="photoimgnew10" id="photoimgnew10" />
					 
												</form>
											</td>


											
									<!--<td>
										<form id="imageform2" method="post" enctype="multipart/form-data" action='ajaximage.php'>
											<input type="hidden" name="Method" id="Method" value="Image2" />
											<input type="file" name="photoimg2" id="photoimg2" />
										</form>
									</td>
									<td>
										<form id="imageform3" method="post" enctype="multipart/form-data" action='ajaximage.php'>
											<input type="hidden" name="Method" id="Method" value="Image3" />
											<input type="file" name="photoimg3" id="photoimg3" />
										</form>
									</td>-->
								</tr>
								<tr>
									<td>
										
									</td>
									<td>
										<div id='preview2'>
										</div>
									</td>
									<td>
										<div id='preview3'>
										</div>
									</td>
								</tr>
							</table>
						</div>

				
			</div>

			
			
			
			
			
			<div id="dialogDecline" title="<?php echo _("Decline Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="declinedesc" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnDeclineSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSendBack" title="<?php echo _("Send Back Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="sendbackdesc" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnSendBackSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back to Etisalat"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogApprove" title="<?php echo _("Approve Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Please confirm your registration!"); ?></td>
							<td>
								<button  id="btnApproveSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--SMB -->
			<div id="dialogSMBApprove" title="<?php echo _("Approve Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Please confirm your registration!"); ?></td>
							<td>
								<button  id="btnApproveSMBSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSMBDecline" title="<?php echo _("Decline Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="declineSMBdesc" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnDeclineSMBSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSMBSendBack" title="<?php echo _("Compliance Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message </br>(Maximum of 256 characters.)"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="sendbackSMBdesc" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnSendBackSMBSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send to Compliance"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSMBSendBackApp" title="<?php echo _("Send Back SMB Application"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message </br>(Maximum of 256 characters.)"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="sendbackSMBdescApp" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnSendBackSMBSubscriberApp" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back to Etisalat"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<!--
			<div id="dialogDelImage4" style="width:400px;" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage4" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage5" style="width:400px;" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage5" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			-->
			<input type="hidden" id="bankimage4" value="bankimage4" />
			<input type="hidden" id="bankimage5" value="bankimage5" />
			<input type="hidden" id="bankimage6" value="bankimage6" />
			<input type="hidden" id="bankimage7" value="bankimage7" />
			<input type="hidden" id="bankimage8" value="bankimage8" />
			
			<div class="ploading"></div>

			<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
			<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
			<script type="text/javascript" src="../../Views/js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
			<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
			
			<script nonce="<?php echo $_SESSION['nonce'];?>">

				function run(field) {
					var qwer = field.replace(/\s/g,'');
					return qwer;
				}
				function run2(field) {
					var numonly = field.replace(/\D/g,'');
					return numonly;
				}

				var ht = $("#pendingreg").css('height');
				ht = ht.replace("px","");
		//$("#pendingreg",window.parent.document).css('height',parseInt(ht)+200);
		$(document).ready(function() {
			$('.viewaccount-link').on('click', function() {
				var id = $(this).data('id');
				var type = $(this).data('type');
				var action = $(this).data('action');
				if (action == "viewSMBAccount"){
					viewSMBAccount(id, type);
				}else if (action == "viewAccount"){
					viewAccount(id, type);
				}
			});

			$('._ctids').on('keyup', function() {
                var i = this.id.split('_')[1];
                this.value = run(this.value);
                validateTID(i);
            });

			$('._smbctids').on('keyup', function() {
                this.value = run2(this.value);
			});

			$('.numonly').on('keyup', function() {
                this.value = this.value.replace(/\D/g, '');
            });

			$(".buttonx").button();

			oTable = $('#account').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button",
				"aaSorting": [[0, "desc" ]]
			});

			
// may 16 2018 added by onyx 

	$('#addFile2').click(function (){
		$('#file2div').show();
		$('#addFile2').hide();
		$('#addFile3').show();
	});

	$('#addFile3').click(function (){
		$('#file3div').show();
		$('#addFile3').hide();
		$('#addFile4').show();
	});
	$('#addFile4').click(function (){
		$('#file4div').show();
		$('#addFile4').hide();
		$('#addFile5').show();
	});
	$('#addFile5').click(function (){
		$('#file5div').show();
		$('#addFile5').hide();
	});
	$('#addFile6').click(function (){
		$('#file6div').show();
		$('#addFile6').hide();
		$('#addFile7').show();
	});
	$('#addFile7').click(function (){
		$('#file7div').show();
		$('#addFile7').hide();
		$('#addFile8').show();
	});
	$('#addFile8').click(function (){
		$('#file8div').show();
		$('#addFile8').hide();
		$('#addFile9').show();
	});
	$('#addFile9').click(function (){
		$('#file9div').show();
		$('#addFile9').hide();
		$('#addFile10').show();
	});
	$('#addFile10').click(function (){
		$('#file10div').show();
		$('#addFile10').hide();
	});

	$('#photoimg').hide();
	$("#fileclick").click(function () {
		$("#photoimg").trigger('click');
	});
	
	$("#fileclicknew1").click(function () {
		$("#photoimgnew1").trigger('click');
	});
	$("#fileclicknew2").click(function () {
		$("#photoimgnew2").trigger('click');
	});
	$("#fileclicknew3").click(function () {
		$("#photoimgnew3").trigger('click');
	});
	$("#fileclicknew4").click(function () {
		$("#photoimgnew4").trigger('click');
	});
	$("#fileclicknew5").click(function () {
		$("#photoimgnew5").trigger('click');
	});
	$("#fileclicknew6").click(function () {
		$("#photoimgnew6").trigger('click');
	});
	$("#fileclicknew7").click(function () {
		$("#photoimgnew7").trigger('click');
	});
	$("#fileclicknew8").click(function () {
		$("#photoimgnew8").trigger('click');
	});
	$("#fileclicknew9").click(function () {
		$("#photoimgnew9").trigger('click');
	});
	$("#fileclicknew10").click(function () {
		$("#photoimgnew10").trigger('click');
	});
	
	window.pho = "0";
	$("#photoimg").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew1").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew2").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew3").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew4").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew5").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew6").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew7").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew8").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew9").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew10").click(function () {
		window.pho = "1";
	});

	
	
	$(document).ready(function() { 

		$('#dialogREG').dialog({
			autoOpen: false
		});
		
		$('#photoimg').on('change', function()			{ 
			$("#preview").html('');
			$("#preview").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
				target: '#preview'
			}).submit();
			window.pho = "0";
			$("#cancelImage1").show();
			$("#file2div").show();
		});
		
		$('#photoimgnew1').on('change', function()			{ 
			$("#previewnew1").html('');
			$("#previewnew1").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew1").ajaxForm({
				target: '#previewnew1'
			}).submit();
			window.pho = "0";
			$("#cancelImage2").show();
			$("#file3div").show();
			
		});
		
		$('#photoimgnew2').on('change', function()			{ 
			$("#previewnew2").html('');
			$("#previewnew2").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew2").ajaxForm({
				target: '#previewnew2'
			}).submit();
			window.pho = "0";
			$("#cancelImage3").show();
			$("#file4div").show();
		});

		$('#photoimgnew3').on('change', function()			{ 
			$("#previewnew3").html('');
			$("#previewnew3").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew3").ajaxForm({
				target: '#previewnew3'
			}).submit();
			window.pho = "0";
			$("#cancelImage4").show();
			$("#file5div").show();
		});

		$('#photoimgnew4').on('change', function()			{ 
			$("#previewnew4").html('');
			$("#previewnew4").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew4").ajaxForm({
				target: '#previewnew4'
			}).submit();
			window.pho = "0";
			$("#cancelImage5").show();
		});

		$('#photoimgnew5').on('change', function()			{ 
			$("#previewnew5").html('');
			$("#previewnew5").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew5").ajaxForm({
				target: '#previewnew5'
			}).submit();
			window.pho = "0";
			$("#cancelImage6").show();
		});

		$('#photoimgnew6').on('change', function()			{ 
			$("#previewnew6").html('');
			$("#previewnew6").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew6").ajaxForm({
				target: '#previewnew6'
			}).submit();
			window.pho = "0";
			$("#x7").show();
		});

		$('#photoimgnew7').on('change', function()			{ 
			$("#previewnew7").html('');
			$("#previewnew7").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew7").ajaxForm({
				target: '#previewnew7'
			}).submit();
			window.pho = "0";
			$("#x8").show();
		});

		$('#photoimgnew8').on('change', function()			{ 
			$("#previewnew8").html('');
			$("#previewnew8").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew8").ajaxForm({
				target: '#previewnew8'
			}).submit();
			window.pho = "0";
			$("#x9").show();
		});

		$('#photoimgnew9').on('change', function()			{ 
			$("#previewnew9").html('');
			$("#previewnew9").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew9").ajaxForm({
				target: '#previewnew9'
			}).submit();
			window.pho = "0";
			$("#x10").show();
		});

		$('#photoimgnew10').on('change', function()			{ 
			$("#previewnew10").html('');
			$("#previewnew10").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew10").ajaxForm({
				target: '#previewnew10'
			}).submit();
			window.pho = "0";
			$("#x11").show();
		});

		$('#photoimg2').on('change', function()			{ 
			$("#preview2").html('');
			$("#preview2").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform2").ajaxForm({
				target: '#preview2'
			}).submit();

		});

		$('#photoimg3').on('change', function()			{ 
			$("#preview3").html('');
			$("#preview3").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform3").ajaxForm({
				target: '#preview3'
			}).submit();

		});
	}); 

//----.

		$('#photoimgSend4').hide();
		$('#photoimgSend5').hide();
		$('#photoimgSend6').hide();
		$('#photoimgSend7').hide();
		$('#photoimgSend8').hide();

		$("#fileclick4").click(function () {
			$("#photoimgSend4").trigger('click');
		});
		$("#fileclick5").click(function () {
			$("#photoimgSend5").trigger('click');
		});
		$("#fileclick6").click(function () {
			$("#photoimgSend6").trigger('click');
		});
		$("#fileclick7").click(function () {
			$("#photoimgSend7").trigger('click');
		});
		$("#fileclick8").click(function () {
			$("#photoimgSend8").trigger('click');
		});
				
		window.pho = "0";
		$("#photoimgSend4").click(function () {
			window.pho = "1";
		});
		$("#photoimgSend5").click(function () {
			window.pho = "1";
		});
		$("#photoimgSend6").click(function () {
			window.pho = "1";
		});
		$("#photoimgSend7").click(function () {
			window.pho = "1";
		});
		$("#photoimgSend8").click(function () {
			window.pho = "1";
		});

$('#photoimgSend4').on('change', function()			{ 
			$("#pre4").show();
			$("#preview4").html('HELLO 4');
			$("#preview4").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew4").ajaxForm({
				target: '#preview4'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus4").val("REP");
			//$("#delImage4").show();
			$("#cancelImage4").show();
			
		});
		$('#photoimgSend5').on('change', function()			{ 
			$("#pre5").show();
			$("#preview5").html('HELLO 5');
			$("#preview5").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew5").ajaxForm({
				target: '#preview5'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus5").val("REP");
			//$("#delImage5").show();
			$("#cancelImage5").show();
			
		}); 
		$('#photoimgSend6').on('change', function()			{ 
			$("#pre6").show();
			$("#preview6").html('HELLO 6');
			$("#preview6").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew6").ajaxForm({
				target: '#preview6'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus6").val("REP");
			//$("#delImage5").show();
			$("#cancelImage6").show();
			
		});
		$('#photoimgSend7').on('change', function()			{ 
			$("#pre7").show();
			$("#preview7").html('HELLO 7');
			$("#preview7").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew7").ajaxForm({
				target: '#preview7'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus7").val("REP");
			//$("#delImage5").show();
			$("#cancelImage7").show();
			
		});
		$('#photoimgSend8').on('change', function()			{ 
			$("#pre8").show();
			$("#preview8").html('HELLO 8');
			$("#preview8").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew8").ajaxForm({
				target: '#preview8'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus8").val("REP");
			//$("#delImage5").show();
			$("#cancelImage8").show();
			
		});

		/*$("#cancelImage4").click(function(){
			$("#sendImageStatus4").val("NC");
			//$("#delImage4").show();
			$("#preview4").html('');
			document.getElementById('sendImageStatus4').value='';
			document.getElementById('bankimage4').value='DEL';
			$("#sendImageStatus4").val('');
			<?php
			unset($_SESSION['sendBackImage4']);
			unset($_SESSION['sizeSend4']);
			unset($_SESSION['image4']);
			unset($_SESSION['imagenew4']);
			?>
			$(this).hide();
		});
		$("#cancelImage5").click(function(){
			$("#sendImageStatus5").val("NC");
			//$("#delImage5").show();
			$("#preview5").html('');
			document.getElementById('sendImageStatus5').value='';
			document.getElementById('bankimage5').value='DEL';
			$("#sendImageStatus5").val('');
			<?php
			unset($_SESSION['sendBackImage5']);
			unset($_SESSION['sizeSend5']);
			unset($_SESSION['image5']);
			unset($_SESSION['imagenew5']);
			?>
			$(this).hide();
		});*/

		$("#cancelImage6").click(function(){
			$("#sendImageStatus6").val("NC");
			//$("#delImage5").show();
			$("#preview6").html('');
			document.getElementById('sendImageStatus6').value='';
			document.getElementById('bankimage6').value='DEL';
			$("#sendImageStatus6").val('');
			<?php
			unset($_SESSION['sendBackImage6']);
			unset($_SESSION['sizeSend6']);
			unset($_SESSION['image6']);
			unset($_SESSION['imagenew6']);
			?>
			$(this).hide();
		});
		$("#cancelImage7").click(function(){
			$("#sendImageStatus7").val("NC");
			//$("#delImage5").show();
			$("#preview7").html('');
			document.getElementById('sendImageStatus7').value='';
			document.getElementById('bankimage7').value='DEL';
			$("#sendImageStatus7").val('');
			<?php
			unset($_SESSION['sendBackImage7']);
			unset($_SESSION['sizeSend7']);
			unset($_SESSION['image7']);
			unset($_SESSION['imagenew7']);
			?>
			$(this).hide();
		});
		$("#cancelImage8").click(function(){
			$("#sendImageStatus8").val("NC");
			//$("#delImage5").show();
			$("#preview8").html('');
			document.getElementById('sendImageStatus8').value='';
			document.getElementById('bankimage8').value='DEL';
			$("#sendImageStatus8").val('');
			<?php
			unset($_SESSION['sendBackImage8']);
			unset($_SESSION['sizeSend8']);
			unset($_SESSION['image8']);
			unset($_SESSION['imagenew8']);
			?>
			$(this).hide();
		});

		/*$("#btnDelImage4").click(function(){
			$("#sendImageStatus4").val("DEL");
			$("#delImage4").hide();	

		$("#dialogDelImage4").dialog('close');			
		});
		$("#btnDelImage5").click(function(){
			$("#sendImageStatus5").val("DEL");
			$("#delImage5").hide();	

		$("#dialogDelImage5").dialog('close');			
		});

*/
	
		
//----		
			



			$('#mid').keyup(function() { 
    	//alert($("#selectedType").val());
    	str = $(this).val()
    	str = str.replace(/\s/g,'')
    	$(this).val(str)

    	if($("#selectedType").val()=="MERCHANT"){
    		if(jQuery.trim($("#mid").val())==""){
    			$(".ctids").prop('disabled', true);
    			$("#tid").prop('disabled', true);
    		}else{
    			$(".ctids").prop('disabled', false);
    			$("#tid").prop('disabled', false);
    		}
    	}else{
    		//alert($("#selectedType").val());
    		if(jQuery.trim($("#mid").val())==""){
    			$(".ctids").prop('disabled', true);
    		}else{
    			$(".ctids").prop('disabled', false);
    		}
    	}
    	$("input.cmids").val($("#mid").val());
    });

			$('#tid').keyup(function() { 
				str = $(this).val()
				str = str.replace(/\s/g,'')
				$(this).val(str)
			});


			$('#pending_acccount_view').dialog({
				autoOpen: false,
				width: 1200,
				height: 600,
				//height:1000,
				draggable: true,
				resizable: false,
				modal:true,
				// position:'bottom'
			});

	// Dialog			
	$('#dialogDecline, #dialogSendBack, #dialogApprove').dialog({
		autoOpen: false,
		width: 700,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		// position: 'center',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});
	//SMB Dialog
	$('#dialogSMBDecline, #dialogSMBSendBack, #dialogSMBApprove, #dialogSMBSendBackApp, #dialogDelImage4, #dialogDelImage5').dialog({
		autoOpen: false,
		width: 700,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		// position: 'center',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});

	
});

		function checkMID($accounttype,$mmsisdn, $accid){

			$("#mmsisdn").val($mmsisdn);
			$("#mmsisdn").prop('disabled', true);
			$("#mmsisdn2").val('');
			$("#mmsisdn2").prop('disabled', true);
			$("#authNumber2").prop('disabled', true);

			if($mmsisdn == $accid){
				$("#mmsisdn").hide();
				$("#mmsisdn2").show();
				$("#authNumber").hide();
				$("#authNumber2").show();
			} else {
				$("#mmsisdn").show();
				$("#mmsisdn2").hide();
				$("#authNumber").show();
				$("#authNumber2").hide();
			}

			if($accounttype == "MADM"){
		//$("#tid").prop('disabled', true);
		$("#tid").hide();
		$("#tdtid").hide();
		
	}else{
		//$("#tid").prop('disabled', false);
		$("#tid").show();
		$("#tdtid").show();
	}

	$("input.cmids").val($("#mid").val());

	if(jQuery.trim($("#tid").val())!=""){
		$("#tid").prop('disabled', true);
	}
	if(jQuery.trim($("#mid").val())==""){
		$(".ctids").prop('disabled', true);
	}else{
		$("#tid").prop('disabled', false);
		$("#mid").prop('disabled', false);
		$(".ctids").prop('disabled', false);
	}

	if(jQuery.trim($("#mid").val())=="" && $accounttype != "MADM"){
		$("#tid").prop('disabled', false);
	}
}
/*function checkMID($accounttype,$accountid, $mobilenumber){
	
	$("#mmsisdn").val($mmsisdn);
	$("#mmsisdn").prop('disabled', true);

	//$("#mmsisdn2").val('');
	//$("#mmsisdn2").prop('disabled', true);
	
	/*if ($accountid == $mobilenumber){
		$("#mmsisdn2").val('');
		$("#mmsisdn2").prop('disabled', true);
		$("#mmsisdn2").show();
		$("#mmsisdn").val($mmsisdn);
		$("#mmsisdn").prop('disabled', true);
		$("#mmsisdn").hide();
	} else {
		$("#mmsisdn2").val('');
		$("#mmsisdn2").prop('disabled', true);
		$("#mmsisdn2").hide();
		$("#mmsisdn").val($mmsisdn);
		$("#mmsisdn").prop('disabled', true);
		$("#mmsisdn").show();
	}
		

	if($accounttype == "MADM"){
		//$("#tid").prop('disabled', true);
		$("#tid").hide();
		$("#tdtid").hide();
		
	}else{
		//$("#tid").prop('disabled', false);
		$("#tid").show();
		$("#tdtid").show();
	}

	$("input.cmids").val($("#mid").val());

    if(jQuery.trim($("#tid").val())!=""){
        $("#tid").prop('disabled', true);
    }
	if(jQuery.trim($("#mid").val())==""){
        $(".ctids").prop('disabled', true);
    }else{
    	$("#mid").prop('disabled', true);
        $(".ctids").prop('disabled', false);
    }
    
    if(jQuery.trim($("#mid").val())=="" && $accounttype != "MADM"){
    	$("#tid").prop('disabled', false);
    }
}*/
var cashierLength;

function viewAccount(id, AccountType){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);

	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType:  'json',
		data: {
			Method: 'pendingAccountView',
			rdoSearchOption: 3,
			txtSearch: id,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.Result.ResponseCode == 0){
				//alert(json.Result.Value.CASHIERS.length);
				$("#pending_acccount_view").dialog('open');
				if(json.Access[0] == false){
					$("#btnEditPInfo").hide();
					$("#btnUpdatePInfo").hide();
					$("#btnCancelPInfo").hide();
				}else{
					$("#btnEditPInfo").show();					
				}
				if(json.Access[1] == false){
					$("#btnApproveKYC").hide();
					$("#btnRejectKYC").hide();
					$("#btnSendbackKYC").hide();
					
					$("#btnApproveSMBKYC").hide();
					$("#btnRejectSMBKYC").hide();
					$("#btnSendbackSMBKYC").hide();
					$("#btnSendBackApplication").hide();
				}else{
					$("#btnApproveKYC").show();
					$("#btnRejectKYC").show();
					$("#btnSendbackKYC").show();
					
					$("#btnApproveSMBKYC").hide();
					$("#btnRejectSMBKYC").hide();
					$("#btnSendbackSMBKYC").hide();
					$("#btnSendBackApplication").hide();
				}
				$("#accountID").val(json.Result.AccountInformation.AccountID);
				var option = "<option>"+json.Result.AccountInformation.AccountType+"</option>";
				option = "<option>"+AccountType+"</option>";
				$("#selectedType").html(option);
				$("#aliasName").val(json.Result.AccountInformation.Alias);
				
				$("#pAccountStatus").val(json.Result.AccountInformation.Status);
				
				var stringaccounttype = json.Result.AccountInformation.AccountType;
				if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.terminalid!="" && json.Result.AccountInformation.merchantid!=""){
					$("#tid").val(json.Result.AccountInformation.terminalid);
					$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.merchantid!=""){
					$("#tid").val(json.Result.AccountInformation.terminalid);
					$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',true);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else{
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val("");
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
				}
				var locked = json.Result.AccountInformation.Locked == "true" ? "YES" : "NO";
				$("#pLocked").val(locked);
				$("#subKYC").val(json.Result.AccountInformation.KYC);
				$("#pRefAccount").val(json.Result.AccountInformation.ReferenceAccount);
				
				$("#corponboardedby").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				
				$("#mercdiscountrate").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee").val(json.Result.AccountInformation.cashtransfee);//pTRN
				$("#pTRN").val(json.Result.AccountInformation.TRN);


				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE').html(listitem);
					$('#CASHTYPE').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE').html(listitem);
					$('#CASHTYPE').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE').html(listitem);
					$('#CASHTYPE').click();
				}
				$("tr#add_data").remove();

				cashierLength = json.Result.Value.CASHIERS.length;
				
				if(json.Result.Value.CASHIERS.length > 0){
					//alert(json.Result.Value.CASHIERS[0].msisdn);
					//$("tr#add_data").remove();
					for(var i =0;i < json.Result.Value.CASHIERS.length;i++){

						$("#tblAccount").append("<tr id='add_data'><td>Merchant ID<span class'text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class'text-danger'>*</span>:</td><td><input class='cids' id='cid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].msisdn + "></td><td>Terminal ID<span class'text-danger'>*</span>:</td><td><input maxlength='8' minlength='8' class='ctids _ctids' id='ctid_" + i + "' type='text' disabled='disabled'></td></tr>");
						$("#cmid_" + i).attr('disabled',false);
						$("#cid_" + i).attr('disabled',true);
						$("#ctid_" + i).attr('disabled',false);
						$("#ctid_" + i).val("");
						$(".account_info_details").css('width','820px');
					}
					$("#mid").val(json.Result.MerchantID);
					 //alert(json.Result.TerminalID);
					 $("#tid").val(json.Result.TerminalID);
					}
					checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber, json.Result.AccountInformation.AccountID);
				//checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber);
				$("#pTIN").val(json.Result.AccountInformation.PersonalInformation.TINNumber);
				$("#checkID").attr("href", download_url + $("#authNumber").val());
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}
var accType;


$("#cancelImage1").click(function(){
			$("#updateI1").val("NC");
			$("#delImage1").show();
			$("#preview").html('');
			<?php
			$_SESSION['imageB2W']="";
			$_SESSION['size1']="";
			?>
			$(this).hide();
		});
		
	$("#cancelImage2").click(function(){
			$("#updateI2").val("NC");
			$("#delImage2").show();
			$("#previewnew1").html('');
			<?php
			$_SESSION['imagenew1']="";
			$_SESSION['size2']="";
			?>
			$(this).hide();
		});
	$("#cancelImage3").click(function(){
			$("#updateI3").val("NC");
			$("#delImage3").show();
			$("#previewnew2").html('');
			<?php
			$_SESSION['imagenew2']="";
			$_SESSION['size3']="";
			?>
			$(this).hide();
		});
		
	$("#cancelImage4").click(function(){
			$("#updateI4").val("NC");
			$("#delImage4").show();
			$("#previewnew3").html('');
			<?php
			$_SESSION['imagenew3']="";
			$_SESSION['size4']="";
			?>
			$(this).hide();
		});
		
	$("#cancelImage5").click(function(){
			$("#updateI5").val("NC");
			$("#delImage5").show();
			$("#previewnew4").html('');
			<?php
			$_SESSION['imagenew4']="";
			$_SESSION['size5']="";
			?>
			$(this).hide();
		});
	$("#cancelImage6").click(function(){
			$("#updateI6").val("NC");
			$("#delImage6").show();
			$("#previewnew5").html('');
			<?php
			unset($_SESSION['imagenew5']);
			unset($_SESSION['size6']);
			?>
			$(this).hide();
		});
	$("#cancelImage7").click(function(){
			$("#updateI7").val("NC");
			$("#delImage7").show();
			$("#previewnew6").html('');
			<?php
			unset($_SESSION['imagenew6']);
			unset($_SESSION['size7']);
			?>
			$(this).hide();
		});
	$("#cancelImage8").click(function(){
			$("#updateI8").val("NC");
			$("#delImage8").show();
			$("#previewnew7").html('');
			<?php
			unset($_SESSION['imagenew7']);
			unset($_SESSION['size8']);
			?>
			$(this).hide();
		});
	$("#cancelImage9").click(function(){
			$("#updateI9").val("NC");
			$("#delImage9").show();
			$("#previewnew8").html('');
			<?php
			unset($_SESSION['imagenew8']);
			unset($_SESSION['size9']);
			?>
			$(this).hide();
		});
	$("#cancelImage10").click(function(){
			$("#updateI10").val("NC");
			$("#delImage10").show();
			$("#previewnew9").html('');
			<?php
			unset($_SESSION['imagenew9']);
			unset($_SESSION['size10']);
			?>
			$(this).hide();
		});
		
function viewSMBAccount(id, AccountType){
	$('#listqwert').append('');
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);
	
	$("#cancelImage1").hide();
	$("#cancelImage2").hide();
	$("#cancelImage3").hide();
	$("#cancelImage4").hide();
	$("#cancelImage5").hide();
	$("#cancelImage6").hide();
	$("#cancelImage7").hide();
	$("#cancelImage8").hide();
	$("#cancelImage9").hide();
	$("#cancelImage10").hide();
	
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType:  'json',
		data: {
			Method: 'pendingSMBAccountView',
			rdoSearchOption: 3,
			txtSearch: id,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			console.log(json);
			if(json.Result.ResponseCode == 0){
				//alert(json.Result.Value.CASHIERS.length);
				$("#pending_acccount_view").dialog('open');
				//$("#pending_acccount_view").dialog('close');
				//$("#pending_smb_acccount_view").dialog('open');
				
				if(json.Access[0] == false){
					$("#btnEditPInfo").hide();
					$("#btnUpdatePInfo").hide();
					$("#btnCancelPInfo").hide();
				}else{
					$("#btnEditPInfo").show();					
				}
				if(json.Access[1] == false){
					$("#btnApproveKYC").hide();
					$("#btnRejectKYC").hide();
					$("#btnSendbackKYC").hide();
					
					$("#btnApproveSMBKYC").hide();
					$("#btnRejectSMBKYC").hide();
					$("#btnSendbackSMBKYCKYC").hide();
					$("#btnSendBackApplication").hide();
				}else{
					/*$("#btnApproveKYC").show();
					$("#btnRejectKYC").show();
					$("#btnSendbackKYC").show();*/
					$("#btnApproveKYC").hide();
					$("#btnRejectKYC").hide();
					$("#btnSendbackKYC").hide();
					
					$("#btnApproveSMBKYC").show();
					$("#btnRejectSMBKYC").show();
					$("#btnSendbackSMBKYC").show();
					$("#btnSendBackApplication").show();
				}

				$("#accountID").val(json.Result.AccountInformation.AccountID);

				accType = AccountType;

				var option = "<option>"+json.Result.AccountInformation.AccountType+"</option>";
				option = "<option>"+AccountType+"</option>";
				$("#selectedType").html(option);
				$("#aliasName").val(json.Result.AccountInformation.Alias);
				
				$("#pAccountStatus").val(json.Result.AccountInformation.Status);
				
				var stringaccounttype = json.Result.AccountInformation.AccountType;
				if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.terminalid!="" && json.Result.AccountInformation.merchantid!=""){
					//$("#tid").val(json.Result.AccountInformation.terminalid);
					//$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else if(stringaccounttype.indexOf("MPOS")>-1 && json.Result.AccountInformation.merchantid!=""){
					//$("#tid").val(json.Result.AccountInformation.terminalid);
					//$("#mid").val(json.Result.AccountInformation.merchantid);
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val(json.Result.AccountInformation.readerserialnumber);
					$("#mid").attr('disabled',true);
					$("#tid").attr('disabled',false);
					$("#tid").val("");
				}else{
					$("#tid").val("");
					$("#mid").val("");
					$("#sno").val("");
					$("#mid").attr('disabled',false);
					$("#tid").attr('disabled',false);
				}
				var locked = json.Result.AccountInformation.Locked == "true" ? "YES" : "NO";
				$("#pLocked").val(locked);
				$("#subKYC").val(json.Result.AccountInformation.KYC);
				$("#pRefAccount").val(json.Result.AccountInformation.ReferenceAccount);
				
				$("#corponboardedby").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				$("#pTRN").val(json.Result.AccountInformation.TRN);
				var upcount=$("#QuerySum").val(json.Result.QuerySum);
				var upcountFGH=$('#listqwert').html("");
			
					
					for(var i =0;i < json.Result.QuerySum;i++){
						
						$('#listqwert').append('<div align="right" class="_f-right"><a id="checkID'+(i+1)+'">'+'<?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _(" View Application File " );}?>'+(i+1)+'</a></div><br><br>');
					}

				if(json.Result.AccountInformation.KYCREASON=='approved from BANK Compliance'){
					//alert('test');
					$('#btnSendbackSMBKYC').hide();
				}else{
					//alert('testss');
					$('#btnSendbackSMBKYC').show();
				}
					
				
				$("#mercdiscountrate").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee").val(json.Result.AccountInformation.cashtransfee)

				$("#mercpackages").val(json.Result.AccountInformation.CorpInformation.packages);

				$("#pAppID").val(json.Result.AccountInformation.ApplicationID);
				
				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE').html(listitem);
					$('#CASHTYPE').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE').html(listitem);
					$('#CASHTYPE').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE').html(listitem);
					$('#CASHTYPE').click();
				}
				$("tr#add_data").remove();
				
				cashierLength = json.Result.Value.CASHIERS.length;

				if(json.Result.Value.CASHIERS.length > 0){
					//alert(json.Result.Value.CASHIERS[0].msisdn);
					//$("tr#add_data").remove();
					
					/*var cashierMSISDN = '';
					if (json.Result.AccountInformation.AccountID == json.Result.AccountInformation.MobileNumber){
						cashierMSISDN = ' ';
					} else {
						cashierMSISDN = json.Result.Value.CASHIERS[i].msisdn;
					}*/
					
					

					for(var i =0;i < json.Result.Value.CASHIERS.length;i++){
						
						$("#tblAccount").append("<tr id='add_data'><td>Merchant ID<span class'text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class'text-danger'>*</span>:</td><td><input class='cids' id='cid_" + i + "' type='text' value = "+ json.Result.Value.CASHIERS[i].msisdn +"><input id ='ciddisplay' type='text' value='' disabled='disabled'></td><td>Terminal ID<span class'text-danger'>*</span>:</td><td><input maxlength='8' minlength='8' class='ctids _smbctids' id='ctid_" + i + "' type='text' disabled='disabled'></td></tr>");

						$(".cids").hide();
						$("#cmid_" + i).attr('disabled',true);
						$("#cid_" + i).attr('disabled',true);
						$("#ctid_" + i).attr('disabled',false);
						$("#ctid_" + i).val("");
						$(".account_info_details").css('width','820px');
					}
					$("#mid").val("");
					 //alert(json.Result.TerminalID);
					 $("#tid").val("");
					}

					checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber, json.Result.AccountInformation.AccountID);

				//checkMID(json.Result.AccountInformation.AccountType, '');
				//checkMID(json.Result.AccountInformation.AccountType, json.Result.AccountInformation.MobileNumber);
				$("#pTIN").val(json.Result.AccountInformation.PersonalInformation.TINNumber);
				//$("#checkID").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true);
				
				$("#checkID1").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"1"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID2").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"2"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID3").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"3"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID4").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"4"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID5").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"5"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID6").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"6"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID7").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"7"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID8").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"8"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID9").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"9"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID10").attr("href", download_url + "msisdn=" + $("#authNumber").val() + "&" + "smbBoolean=" + true+"&"+"image="+"10"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				
				console.log("auth: "+$("#authNumber").val());
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}

var download_url = "<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.download.file.php?";

$('#btnApproveSMBKYC').click(function(){
	var isNull = "false";
var isZero = 0;
	$(".ctids").each(function(){
		if($(this).val() == ""){
			isNull = "true";
		}
		//CTIDs.push($(this).val());
	});
	
	var CTIDs = [];
	$(".ctids").each(function(){
		CTIDs.push($(this).val());
	});

	// var duplicate_ = 0;
	// var dp = 0;
	// var null_ = 0;
	// var isnull = 0;

	// for(var i = 1; i <= cashierLength; i++){
	// 	if(CTIDs[i - 1] == CTIDs[i]){						
	// 		duplicate_ = 1;
	// 	} 
	// 	if(CTIDs[0] == CTIDs[i]){
	// 		duplicate_ = 1;
	// 	}
	// }

	console.log(accType);
	if(accType == "MERCHANT ADMIN"){
		if($("#mid").val() == "" || $(".cids").val() == "" || isNull == "true"){
		$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	} else {

		var i = 0;
		var cnt = 0;
		var ccnt = 0;

		while (i < cashierLength) {
			if(CTIDs[i - 1] == CTIDs[i]){
				cnt++;
			}
			if(CTIDs[0] == CTIDs[i]){
				cnt++;
			}
			if($("#tid").val() == CTIDs[i]){
				cnt++;
			}
			if($("#mid").val() == "0" ||  CTIDs[i] == "0" || $("#tid").val() == "0"){	
					isZero++;
				}
				i++;
			}

			if(isZero > 0){
				$("<p>Merchant/Terminal ID field cannot be zero (0).</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else if(cnt > 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else{
				$('#dialogSMBApprove').dialog('open');				
			}

			if(ccnt == 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
	}
	} else {
		if($("#mid").val() == "" || $(".cids").val() == "" || $("#tid").val() == "" || isNull == "true"){
		$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	} else {

		var i = 0;
		var cnt = 0;
		var ccnt = 0;

		while (i < cashierLength) {
			if(CTIDs[i - 1] == CTIDs[i]){
				cnt++;
			}
			if(CTIDs[0] == CTIDs[i]){
				cnt++;
			}
			if($("#tid").val() == CTIDs[i]){
				cnt++;
			}
			if($("#mid").val() == "0" ||  CTIDs[i] == "0" || $("#tid").val() == "0"){	
					isZero++;
				}
				i++;
			}

			if(isZero > 0){
				$("<p>Merchant/Terminal ID field cannot be zero (0).</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else if(cnt > 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}  else{
				$('#dialogSMBApprove').dialog('open');				
			}

			if(ccnt == 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
	}
	}
	

	return false;
});

$("#btnApproveSMBSubscriber").click(function(){
	$('#btnApproveSMBSubscriber').prop("disabled", true);
	var CIDs = [];
	var CTIDs = [];

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});

	$(".ctids").each(function(){
		CTIDs.push($(this).val());
	});
	//alert(CTIDs);
	if($("#mid").val() == ""){
		$("<p>Merchant ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else if(CTIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveSMBKYCCashier',
				MSISDN: $("#authNumber").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				cashierids: CIDs,
				cashiertids: CTIDs,
				serialnumber: 0,
				appID:$("#pAppID").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$('#dialogSMBApprove').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveSMBKYC',
				MSISDN: $("#authNumber").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				serialnumber: 0,
				appID:$("#pAppID").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$('#dialogSMBApprove').dialog('close');

				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	$('#btnApproveSMBSubscriber').prop("disabled", false);
});

$('#btnRejectSMBKYC').click(function(){
	$('#dialogSMBDecline').dialog('open');
	return false;
});

$("#btnDeclineSMBSubscriber").click(function(){
	var CIDs = [];
	var CTIDs = [];

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});


	if(CIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectSMBKYCCashier',
				MSISDN: $("#authNumber").val(),
				cashierids: CIDs,
				reason: $("#declineSMBdesc").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogSMBDecline").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectSMBKYC',
				MSISDN: $("#authNumber").val(),
				reason: $("#declineSMBdesc").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogSMBDecline").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}


});

$('#btnSendbackSMBKYC').click(function(){
	$('#dialogSMBSendBack').dialog('open');
	return false;
});
$('#btnSendBackApplication').click(function(){
	$("#sendbackSMBdescApp").val("");
	$('#dialogSMBSendBackApp').dialog('open');
	return false;
	
	 
});

$("#btnSendBackSMBSubscriber").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	if($("#sendbackSMBdesc").val().length > 256 ){
		setTimeout($.unblockUI, 1000);
			$("<p>Description message exceeds the maximum limit of 256 characters.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackSMBKYC',
			MSISDN: $("#authNumber").val(),
			reason: $("#sendbackSMBdesc").val(),
			appID: $("#pAppID").val(),
			stat1: $("#updateI1").val(),
			stat2: $("#updateI2").val(),
			stat3: $("#updateI3").val(),
			stat4: $("#updateI4").val(),
			stat5: $("#updateI5").val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
				$("#pending_acccount_view").dialog('close');
				$("#dialogSMBSendBack").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}, error: function(e){
			setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
	}

});

$("#btnSendBackSMBSubscriberApp").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	
	if($("#sendbackSMBdescApp").val().length > 256 ){
		setTimeout($.unblockUI, 1000);
			$("<p>Description message exceeds the maximum limit of 256 characters.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackSMBKYCApp',
			MSISDN: $("#authNumber").val(),
			reason: $("#sendbackSMBdescApp").val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
				$("#pending_acccount_view").dialog('close');
				$("#dialogSMBSendBackApp").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}, error: function(e){
			setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}
});

$('#btnApproveKYC').click(function(){
	var isNull = "false";
	//var CTIDs = [];
	$(".ctids").each(function(){
		if($(this).val() == ""){
			isNull = "true";
		}
		//CTIDs.push($(this).val());
	});
	//alert(CTIDs.length);
	//alert(CTIDs);
	//CTIDs.push($(this).val());

	//|| $("#tid").val() == "" || isNull == "true"
	if($("#mid").val() == "" || ("#tid").val() == ""){
		$("<p>Merchant/Terminal ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		$('#dialogApprove').dialog('open');
	}
	return false;
});
$("#btnApproveSubscriber").click(function(){
	console.log('#bankimage4');
	$('#btnApproveSubscriber').prop("disabled", true);
	var CIDs = [];
	var CTIDs = [];

/*	var imageBank4 = '';
	var imageBank5 = '';
	
	if ('#bankimage4'== 'DEL'){
		imageBank4 = '';
	} else {
		imageBank4 = $("#sendImageStatus4").val();
	}
	
	if ('#bankimage5'== 'DEL'){
		imageBank5 = '';
	} else {
		imageBank5 = $("#sendImageStatus5").val();
	}
	*/
	
	
	$(".cids").each(function(){
		CIDs.push($(this).val());
	});

	$(".ctids").each(function(){
		CTIDs.push($(this).val());
	});
	//alert(CTIDs);
	if($("#mid").val() == ""){
		$("<p>Merchant ID field is required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else if(CTIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "120" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveKYCCashier',
				MSISDN: $("#authNumber").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				cashierids: CIDs,
				cashiertids: CTIDs,
				serialnumber: 0,
				imgstat4: $("#sendImageStatus4").val(),
				imgstat5: $("#sendImageStatus5").val(),
				imgstat6: $("#sendImageStatus6").val(),
				imgstat7: $("#sendImageStatus7").val(),
				imgstat8: $("#sendImageStatus8").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$('#dialogApprove').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "120" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveKYC',
				MSISDN: $("#authNumber").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				serialnumber: 0,
				imgstat4: $("#sendImageStatus4").val(),
				imgstat5: $("#sendImageStatus5").val(),
				imgstat6: $("#sendImageStatus6").val(),
				imgstat7: $("#sendImageStatus7").val(),
				imgstat8: $("#sendImageStatus8").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$('#dialogApprove').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	$('#btnApproveSubscriber').prop("disabled", false);
});

$('#btnRejectKYC').click(function(){
	$('#dialogDecline').dialog('open');
	return false;
});
$("#btnDeclineSubscriber").click(function(){
	var CIDs = [];
	var CTIDs = [];

	$(".cids").each(function(){
		CIDs.push($(this).val());
	});


	if(CIDs.length > 0){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectKYCCashier',
				MSISDN: $("#authNumber").val(),
				cashierids: CIDs,
				reason: $("#declinedesc").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogDecline").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'rejectKYC',
				MSISDN: $("#authNumber").val(),
				reason: $("#declinedesc").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
					$("#pending_acccount_view").dialog('close');
					$("#dialogDecline").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}


});

$('#btnSendbackKYC').click(function(){
	$('#dialogSendBack').dialog('open');
	return false;
});
$("#btnSendBackSubscriber").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackKYC',
			MSISDN: $("#authNumber").val(),
			reason: $("#sendbackdesc").val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_" + $("#authNumber").val()).css({display:'none'});
				$("#pending_acccount_view").dialog('close');
				$("#dialogSendBack").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}, error: function(e){
			setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});

});

function delImage(image){
	switch(image){
		case "Image4":
		//$("#dialogDelImage4").dialog('open');
			$('#photoimgSend4').val('');
		    $("#preview4").html('');
			document.getElementById('sendImageStatus4').value='';
			$("#sendImageStatus4").val('');
			document.getElementById('bankimage4').value='DEL';
			<?php
			unset($_SESSION['sendBackImage4']);
			unset($_SESSION['sizeSend4']);
			unset($_SESSION['image4']);
			unset($_SESSION['imagenew4']);
			?>
			
		break;
		
		case "Image5":
		//$("#dialogDelImage5").dialog('open');
			$('#photoimgSend5').val('');
			$("#preview5").html('');
			document.getElementById('sendImageStatus5').value='';
			$("#sendImageStatus5").val('');
			document.getElementById('bankimage5').value='DEL';
			<?php
			unset($_SESSION['sendBackImage5']);
			unset($_SESSION['sizeSend5']);
			unset($_SESSION['image5']);
			unset($_SESSION['imagenew5']);
			?>
		break;

		case "Image6":
		//$("#dialogDelImage5").dialog('open');
			$('#photoimgSend6').val('');
			$("#preview6").html('');
			document.getElementById('sendImageStatus6').value='';
			$("#sendImageStatus6").val('');
			document.getElementById('bankimage6').value='DEL';
			<?php
			unset($_SESSION['sendBackImage6']);
			unset($_SESSION['sizeSend6']);
			unset($_SESSION['image6']);
			unset($_SESSION['imagenew6']);
			?>
		break;
		case "Image7":
		//$("#dialogDelImage5").dialog('open');
			$('#photoimgSend7').val('');
			$("#preview7").html('');
			document.getElementById('sendImageStatus7').value='';
			$("#sendImageStatus7").val('');
			document.getElementById('bankimage7').value='DEL';
			<?php
			unset($_SESSION['sendBackImage7']);
			unset($_SESSION['sizeSend7']);
			unset($_SESSION['image7']);
			unset($_SESSION['imagenew7']);
			?>
		break;
		case "Image8":
		//$("#dialogDelImage5").dialog('open');
			$('#photoimgSend8').val('');
			$("#preview8").html('');
			document.getElementById('sendImageStatus8').value='';
			$("#sendImageStatus8").val('');
			document.getElementById('bankimage8').value='DEL';
			<?php
			unset($_SESSION['sendBackImage8']);
			unset($_SESSION['sizeSend8']);
			unset($_SESSION['image8']);
			unset($_SESSION['imagenew8']);
			?>
		break;

		
	}
}


		
		




$("#btnEditPInfo").click(function(){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'inline'});
	$("#btnEditPInfo").css({display:'none'});
	$(".personalInfoDetails").attr('disabled',false);

	$("#pEmail").attr('disabled',false);
});

$("#btnCancelPInfo").click(function(){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);
});

$("#btnUpdatePInfo").click(function(){
	if($("#pLName").val() == "" || $("#pFName").val() == "" || $("#pIDNumber").val() == "" || $("#pIDDesc").val() == ""	|| $("#pIDExpiry").val() == "" || $("#pNationality").val() == "" || $("#selectedGender").val() == "" || $("#pDOB").val() == "" || $("#pPOB").val() == "" || $("#pCity").val() == ""	|| $("#pRegion").val() == "" || $("#pCountry").val() == ""  ){
		$("<p>All fields with * are required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		if($('#corpdateofincorporation').val() == ''){$('#corpdateofincorporation').val('2012-08-17');}
		var params = {
			Method:'updateAccount',
			MSISDN:$("#authNumber").val(),
			ALIAS:$('#aliasName').val(),
			GENDER:$('#selectedGender').val(),
			LASTNAME:$('#pLName').val(),
			MIDDLENAME:$('#pSName').val(),
			FIRSTNAME:$('#pFName').val(),
			EMAIL:$('#pEmail').val(),
			DOB:$('#pDOB').val(),
			IDNUMBER:$('#pIDNumber').val(),
			IDDESC:$('#pIDDesc').val(),
			EXPIRY:$('#pIDExpiry').val(),
			NATIONALITY:$('#pNationality').val(),
			POB:$('#pPOB').val(),
			CITY:$('#pCity').val(),
			REGION:$('#pRegion').val(),
			COUNTRY:$('#pCountry').val(),
			TYPE:$('#selectedType').val(),
			KYC:$('#subKYC').val(),
			ACCOUNTSTATUS:$('#pAccountStatus').val(),
			REFACCOUNT:$('#pRefAccount').val(),
			BUILDING:$('#pLocation').val(),
			STREET:$('#pStreet').val(),
			COMPANY:$('#pCompany').val(),
			PROFESSION:$('#pProfession').val(),
			LOCKED:$('#pLocked').val(),
			ALTNUMBER:$('#pAltNumber').val(),
			CORPDATEOFINCORPORATION:$('#corpdateofincorporation').val(),
			CORPBUSINESSNAME:$('#corpbusinessname').val(),
			CORPTRADELICENSENUMBER:$('#corptradelicensenumber').val(),
			CORPREGISTEREDADDRESS:$('#corpregistredaddress').val(),
			CORPTYPEOFBUSINESS:$('#corptypeofbusiness').val(),
			CORPOWNERSHIPINFO:$('#corpownershipinfo').val(),
			TINNUMBER:$('#pTIN').val(),
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};		
		$('.ploading').fadeToggle(300);
		$.ajax({
			url:service_url,
			type:"POST", 
			data:params,
			complete:function(res,status){
				viewAccount($("#accountID").val());
				$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
				$("#btnEditPInfo").css({display:'inline'});
				$('.ploading').fadeToggle(300,'linear',function(){
					$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				});
			}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
});
$("#data_loading").css('display','none');
$("#pendingreg").fadeIn(700);


</script>