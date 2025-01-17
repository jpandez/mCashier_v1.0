<?php $responseMessage = $this->data("responseMessage"); ?>
<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
	.loading_sb, .ploading_sb, .rloading_sb, .revloading_sb {
		height:25px;
		width:81px;
		float:right;
		background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
		display:none;
	}
	.imagename_sb{
		border-style: solid;
		border-width: thin;
		background-color:#e8e8e8;
		height:25px;
		padding: 5px;
		border-color: #7c7b7b;
	
	}
	
	.preview_sb, .preview2_sb, .preview3_sb, .previewnew1_sb
{
	width:100px;
	border:solid 1px #dedede;
	padding:10px;
}
table {
  white-space: normal!important;
}

td {
  word-wrap: break-word;
}
._accountsummary_sb{
	width:100%;font-size:10px;
}
._m-top_sb{
	margin-top:10px;
}
._d-none_sb{
	display:none;
}
._bank_info_details_sb{
	border:0px solid red;width:350px;margin-top:5px;margin-right:30px;float:left;
}
._m-bottom_sb{
	margin-bottom:10px;
}
._divKYC_sb{
	border:0px solid gray;
}
._accounttype_sb{
	width:150px;
}
._bank_info_details2_sb{
	border:0px solid red;width:350px;margin-top:5px;margin-right:10px;float:left;
}
._account_info_details2_sb{
	border:0px solid red;width:370px;margin-top:5px;float:left;
}
._containeruploadfiles_sb{
	border:0px solid #606060;width:100%;margin-top:20px;float:left;margin-bottom:80px;
}
._uploadfiles_sb{
	border:1px solid #c6c2c2; border-radius:7px; width:49%;margin-top:0px;float:left; margin-right:2%;background-color:#f7f7f7; height:215px; overflow: scroll;  padding:10px;
}
._preview_sb{
	float:left; border-style: solid; height: 25px;padding: 5px;
}
._f-left_sb{
	float:left;
}
._viewuploadedfiles_sb{
	border:1px solid #c6c2c2; border-radius:7px;width:49%;margin-top:0px;float:left; background-color:#f7f7f7;  height:215px; overflow: scroll; overflow-x: hidden; padding: 10px;
}
._dialog-img-alert_sb{
	width:400px;
}
._f-right_sb{
	float:right;
}
</style>
	<div id="accountsummary_sb" class="_accountsummary_sb">
		<?php $pendingsubscriber = $this->data("sendbackddata"); ?>
		<?php if(isset($pendingsubscriber->ResponseCode)){ ?>
		<?php if(is_array($pendingsubscriber->Value)){?>
		<div class="_m-top_sb"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="sendback" width="100%">
			<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("DATE REGISTERED"); ?></th>
							<th><?php echo _("REGISTRATION NUMBER"); ?></th>
							<th><?php echo _("COMPANY"); ?></th>
							<th><?php echo _("MSISDN"); ?></th>
							<th><?php echo _("FIRST NAME"); ?></th>
							<th><?php echo _("LASTNAME"); ?></th>
							<th><?php echo _("ACCOUNT TYPE"); ?></th>
							<th><?php echo _("STATUS"); ?></th>
							<th><?php echo _("IS VAT APP USER"); ?></th>
							<th><?php echo _("NOTE"); ?></th>
						
							<th><?php echo _("EDIT"); ?></th>							
				</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($pendingsubscriber->Value as $t): $ctr++;?>
				<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_sb<?php echo $t->MSISDN; ?>">
					<td><?php echo $t->REGDATE; ?></td>
					<td><?php echo $t->APPLICATIONID; ?></td>
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
					<td>SEND BACK</td>
					<td><?php if(($t->ISVATAPPUSER)==0){
								echo "NO";
							}else if(($t->ISVATAPPUSER)==1){
								echo "YES";
							} ?></td>
					<td><?php echo $t->REMARKS; ?></td>
					
					<td>
						<!-- <a href="javascript:viewSMBAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">UPLOAD</a></td> -->
					<button class="btn btn-sm btn-primary viewaccount-link_sb" data-id="<?php echo $t->ID; ?>" data-type="<?php echo $t->TYPE; ?>">UPLOAD</button>
					<!--<td> <?php if(($t->ID) == ($t->MSISDN)) { ?>
						<a href="javascript:viewSMBAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a>
						<?php } else { ?>
						<a href="javascript:viewAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a>
						<?php } ?>
					</td>-->
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


<div id="pending_acccount_view_sb" class="_d-none_sb" title="Pending Approval">
	<div class="panelButtons_sb _m-bottom_sb">
		<div id="divKYC" class="_divKYC_sb">
 
			<?php if($this->getRolesConfig('SMB_UPDATE_PNDG_ACCOUNT')){ ?>
							<button id="btnSendbackToBank" class="buttonx"><?php echo _("send back"); ?></button>
						<?php } ?>
		

				<!--<button id="btnEditPInfo" class="buttonx"><?php echo _("edit"); ?></button>
				<button id="btnUpdatePInfo" class="_d-none_sb" class="buttonx"><?php echo _("save"); ?></button>
				<button id="btnCancelPInfo" class="_d-none_sb" class="buttonx"><?php echo _("cancel"); ?></button>-->
			<!--	<div style="width:100%; float:right;" id="conBtns">
				<table style="border:0" border="1" width="100%">
					<tr style="padding: 5px;">
						<td width="65%">
						<?php if($this->getRolesConfig('SMB_UPDATE_PNDG_ACCOUNT')){ ?>
							<button id="btnSendbackToBank" class="buttonx"><?php echo _("send back"); ?></button>
						<?php } ?>
						</td>
						<td ><div style="height:5px;"></div>
							<div class="imagename_sb" id="delImage1" align="right" style=" width:300px; ">
								<a id="checkIDx" style="color:#585b60;">
									<?php echo _("Application File 1 "); 
									?> </a>
									&nbsp;&nbsp; 
									<a id="delA" title="Delete Application File"  href="javascript:delImage('Image1')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
							</div>
						</td>
						<td >
							
							<button  id="fileclick_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Attach File"); ?></button><br>
							<input id="sendImageStatus1" value="NC" class="_d-none_sb" />
						</td>
					</tr>
					
					<tr>
						<td width="65%">	
						</td>
						<td>
							<div class="imagename_sb" id="delImage2" align="right" style=" width:300px; color:#585b60;">
								<a id="checkID2x" style="color:#585b60;" >
									<?php echo _(" Application File2"); ?>  </a>
									&nbsp;&nbsp; <a id="delB" title="Delete Application File"  href="javascript:delImage('Image2')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>
						<td>
							<button  id="fileclick2" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Attach File"); ?></button><br>
							<input id="sendImageStatus2" value="NC" class="_d-none_sb"/>
						</td>
					</tr>
					
					<tr>
						<td width="65%">	
						</td>
						<td >
							<div class="imagename_sb" id="delImage3"align="right" style=" width:300px; color:#585b60;">
								<a id="checkID3x" style="color:#585b60;">
									<?php echo _(" Application File3"); ?></a> &nbsp;&nbsp;
								<a id="delC" title="Delete Application File" href="javascript:delImage('Image3')"><img src='../../Views/images/icons/close_1-512.png' width='12px'></a>
								</div>
						</td>
						<td>
							<button  id="fileclick3" type = "button" class="ui-button ui-state-default-eti ui-corner-all"><?php echo _("Attach File"); ?></button><br>
							<input id="sendImageStatus3" value="NC" class="_d-none_sb"/>
						</td>
					</tr>
				</table>
					
					
					
				</div>-->
			</div>								
		</div>
		
<!--		<form id="imageformnew" method="post" enctype="multipart/form-data" action='ajaximage.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage1" />
								<input type="file" name="photoimgSend1" id="photoimgSend1" />

		</form>
		<form id="imageformnew2_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage2" />
								<input type="file" name="photoimgSend2" id="photoimgSend2" />

		</form>
		<form id="imageformnew3_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
								<input type="hidden" name="Method" id="Method" value="sendImage3" />
								<input type="file" name="photoimgSend3" id="photoimgSend3" />

		</form> -->
		
		
	
		
		
		<div class="bank_info_details_sb _bank_info_details_sb">
			<table border="0" id="tblAccount3_sb" cellspacing="5" class="tablet">
				<tr><td><?php echo _("Company Name"); ?>:</td><td><input type="text" id="corpbusinessname_sb" ></td></tr>
				<tr>
					<td><?php echo _("Account Type"); ?><span class="text-danger">*</span>:</td>
					<td>
						<select id="selectedType_sb" class="_accounttype_sb">
							
						</select>
					</td>
				</tr>
				<tr class="_d-none_sb"><td><?php echo _("Type of Business"); ?><span class="text-danger">*</span>:</td>
					<td><input type="text" id="corptypeofbusiness_sb" ></td>
				</tr>
				<tr><td><?php echo _("On Boarded By"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corponboardedby_sb"></td></tr>
				<tr><td><?php echo _("Receipt Printed Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpreceiptname_sb" ></td></tr>
				<tr class="_d-none_sb"><td><?php echo _("Nature of Business"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="corpownershipinfo_sb" ></td></tr>
				<tr>
					<!--<td>&nbsp;</td>-->
				</tr>
				<tr class="_d-none_sb"><td><?php echo _("Building Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="building_sb"  ></td></tr>
				<tr class="_d-none_sb"><td><?php echo _("Floor"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="floor_sb"  ></td></tr>
				<tr class="_d-none_sb"><td><?php echo _("Street Name"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="street_sb"  ></td></tr>
				<tr><td><?php echo _("Area"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="area_sb"  ></td></tr>
				<tr><td><?php echo _("City / Emirate"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="city_sb"  ></td></tr>
				<tr class="_d-none_sb"><td><?php echo _("Country"); ?><span class="text-danger">*</span> :</td>
					<td><input type="text" id="country_sb" disabled="disabled" ></td></tr>
					<tr><td><?php echo _("P O Box"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pobox_sb"  ></td></tr>
				</table> 
			</div>
			<div class="bank_info_details_sb _bank_info_details2_sb">
				<table border="0" id="tblAccount3_sb" cellspacing="5" class="tablet">
					<tr>
						<td colspan="2">Authorized Person Details</td>
					</tr>
					<tr><td><?php echo _("First Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pFName_sb"  ></td></tr>
					<tr><td><?php echo _("Last Name"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pLName_sb"  ></td></tr>				
					<tr><td><?php echo _("Primary MSISDN"); ?><span class="text-danger">*</span>:</td><td><input id="authNumber_sb" type="text"  ><input id="authNumber2_sb" type="text" ></td></tr>
					<tr><td><?php echo _("Primary Email"); ?><span class="text-danger">*</span>:</td><td><input type="text" id="pEmail_sb"  ></td></tr>
					<tr class="_d-none_sb"><td><?php echo _("ID Type"); ?><span class="text-danger">*</span> :</td>
						<td><input type="text" id="pIDDesc_sb" disabled="disabled" ></td>
					</tr>
					<tr class="_d-none_sb"><td><?php echo _("ID No."); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDNumber_sb" ></td></tr>
					<tr class="_d-none_sb"><td><?php echo _("Date of Issuance"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDIssuance_sb"  readonly="true"></td></tr>
					<tr class="_d-none_sb"><td><?php echo _("Date of Expiry"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pIDExpiry_sb" readonly="true"></td></tr>
					<tr class="_d-none_sb"><td><?php echo _("Nationality"); ?><span class="text-danger">*</span> :</td>
						<td><input type="text" id="pNationality_sb" disabled="disabled" ></td></tr>
						<tr class="_d-none_sb"><td><?php echo _("Title / Position"); ?><span class="text-danger">*</span>:</td>
							<td><input type="text" id="pProfession_sb" disabled="disabled" ></td>
						</tr>
					<tr><td><?php echo _("AppID"); ?><span class="text-danger">*</span> :</td><td><input type="text" id="pAppID_sb" disabled="disabled" ></td></tr>
					</table>
				</div>
				<div class="account_info_details2_sb _account_info_details2_sb">
					<table border="0" cellspacing="5" class="tablet">
						<tr>
							<td colspan="2">Fees</td>
						</tr>
						<tr>
							<td><?php echo _("Merchant Discount Rate Premium (%)"); ?><span class="text-danger">*</span>:</td>
							<td>
								<div class="field required">
									<input type="text" class="verifyText numonly" name="REGCORPFEESTRXN" id="mercdiscountrate_sb" >
									<span class="iferror"><?php echo _("Field required"); ?></span>
								</div>
							</td>
						</tr>
						<tr>
							<td><?php echo _("Merchant Discount Rate NonPremium (%)"); ?><span class="text-danger">*</span>:</td>
							<td>
								<div class="field required">
									<input  type="text" class="verifyText numonly" name="REGCORPFEESTRXNNONP" id="mercdiscountratenonp_sb" >
									<span class="iferror"><?php echo _("Field required"); ?></span>
								</div>
							</td>
						</tr>
						<tr>
							<td class="_d-none_sb"><?php echo _("Acquiring Interchange (%)"); ?>:</td>
							<td class="_d-none_sb">
								<input  type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="mcvisafee_sb" >
							</td>					
						</tr>
						<tr>
							<td>
								<select id="CASHTYPE_sb" name="CASHTYPE" class="w-100" disabled="disabled">

								</select>
							</td>
							<td>
								<input  type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashdiscountrate_sb" >
							</td>					
						</tr>
						<tr>
							<td class="_d-none_sb"><?php echo _("Cash Transaction Fee"); ?>:</td>
							<td class="_d-none_sb">
								<input disabled="disabled" type="text" class="verifyText numonly" name="REGCORPFEESOTHER" id="cashtransfee_sb" >
							</td>					
						</tr>
					</table>
				</div>
				
			<!--	<div class="account_info_details3" style="border:0px solid red;width:95%;margin-top:5px;float:left; padding-left:75px;">
					<table border="0" cellspacing="5"  id="pre1" width="30%" style="float:left; display:none;">
						<tr>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="2">
								<div id='previewx'></div><button id="cancelImage1_sb" class="text-danger">Cancel</button>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="5"  id="pre2" width="30%" style="float:left; display:none;">
						<tr>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="2">
								<div id='preview2_sb'></div><button id="cancelImage2_sb" class="text-danger">Cancel</button>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="5"  id="pre3" width="30%" style="float:left; display:none;">
						<tr>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="2">
								<div id='preview3_sb'></div><button id="cancelImage3_sb" class="text-danger">Cancel</button>
							</td>
						</tr>
					</table>
				</div>-->

							<div class="containeruploadfiles_sb _containeruploadfiles_sb">
				<div class="uploadfiles_sb _uploadfiles_sb">
				<h3>Upload New File</h3>
				
			<!--	<input id="updateI1_sb" value="NC" style="display:blocke;" />
				<input id="updateI2_sb" value="NC" class="_d-none_sb" />
				<input id="updateI3_sb" value="NC" class="_d-none_sb" />
				<input id="updateI4_sb" value="NC" class="_d-none_sb" />
				<input id="updateI5_sb" value="NC" class="_d-none_sb" />
				<input id="updateI6_sb" value="NC" class="_d-none_sb" />
				<input id="updateI7_sb" value="NC" class="_d-none_sb" />
				<input id="updateI8_sb" value="NC" class="_d-none_sb" />
				<input id="updateI9_sb" value="NC" class="_d-none_sb" />
				<input id="updateI10_sb" value="NC" class="_d-none_sb" />-->
				<button id="fileclick_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 1 (Max 8MB | PDF or JPG)"); ?></button>   
									&nbsp;&nbsp;

								<div class="_preview_sb"id='preview_sb'>	</div>					
							
									<!--<a id="delA" title="Delete Application File" onclick="delAclick()"><img src='../../Views/images/icons/close_1-512.png' width='12px' align='left' id="x1" hidden></a>-->
									
									<button id="cancelImage1_sb" class="text-danger">Remove</button>

							</br>
							</br>
							</br>
							
							<div id="file2div_sb">

							<button id="fileclicknew1_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 2 (Max 8MB | PDF or JPG)"); ?></button> 
							&nbsp;&nbsp; 
							
							<div class="_preview_sb" id='previewnew1_sb'></div>
							<button id="cancelImage2_sb" class="text-danger">Remove</button>

							</div>
								
								</br>
								</br>

							<div id="file3div_sb">

							<button id="fileclicknew2_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 3 (Max 8MB | PDF or JPG)"); ?></button> 
							&nbsp;&nbsp;
							<div class="_preview_sb" id='previewnew2_sb'></div>	
							<button id="cancelImage3_sb" class="text-danger">Remove</button>

							</div>
								
								</br>
								</br>

								<div id="file4div_sb">
									
									<button id="fileclicknew3_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 4 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew3_sb'></div>	
									<button id="cancelImage4_sb" class="text-danger">Remove</button>

								</div>

								</br>
								</br>

								<div id="file5div_sb">
									
									<button id="fileclicknew4_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 5 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew4_sb'></div>	
									<button id="cancelImage5_sb" class="text-danger">Remove</button>

								</div>

								</br>
								</br>

								<div id="file6div_sb">
									
									<button id="fileclicknew5_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 6 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew5_sb'></div>	
									<button id="cancelImage6_sb" class="text-danger">Remove</button>

								</div>

								</br>
								</br>

								<div id="file7div_sb">
									
									<button id="fileclicknew6_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 7 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew6_sb'></div>	
									<button id="cancelImage7_sb" class="text-danger">Remove</button>

								</div>

								</br>
								</br>

								<div id="file8div_sb">
									
									<button id="fileclicknew7_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 8 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew7_sb'></div>	
									<button id="cancelImage8_sb" class="text-danger">Remove</button>

								</div>

								</br>
								</br>

								<div id="file9div_sb">
									
									<button id="fileclicknew8_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 9 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew8_sb'></div>	
									<button id="cancelImage9_sb" class="text-danger">Remove</button>

								</div>

								</br>
								</br>

								<div id="file10div_sb">
									
									<button id="fileclicknew9_sb" type = "button" class="ui-button ui-state-default-eti ui-corner-all _f-left_sb"><?php echo _("Add/Replace File 10 (Max 8MB | PDF or JPG)"); ?></button> 
									&nbsp;&nbsp;
									<div class="_preview_sb" id='previewnew9_sb'></div>	
									<button id="cancelImage10_sb" class="text-danger">Remove</button>

								</div>
				
				</div>
				<div class="viewuploadedfiles_sb _viewuploadedfiles_sb">
				<div class="_f-left_sb">
				<h3>Uploaded File</h3>
					<?php  
						/*$number = $_GET['QuerySum'];
						echo "".$number;
						for ($x = 0; $x <= 2; $x++) {
						  echo "The number is: $x <br>";
						}*/
					?> 
					<div id="listqwert_sb"></div>
					<!--<div align="right" style="float:right;"><a id="checkID"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("View Application File 1");} ?></a></div><br><br>
					<div align="right" style="float:right;"><a id="checkID2"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("View Application File 2");} ?></a></div><br><br>
					<div align="right" style="float:right;"><a id="checkID3"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("View Application File 3");} ?></a></div><br>-->
				</div>	
			
				</div>
			
				</div>
				<input id="updateI1_sb" value="NC"  class="_d-none_sb"/>
				<input id="updateI2_sb" value="NC" class="_d-none_sb" />
				<input id="updateI3_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI4_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI5_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI6_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI7_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI8_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI9_sb" value="NC" class="_d-none_sb"/>
				<input id="updateI10_sb" value="NC" class="_d-none_sb"/>
				<div align="left" class="_d-none_sb">
									<table>
										<tr><td>Application File, PDF or JPEG, max total size 3MB</td><!--<td>Image 2</td><td>Image 3</td>--></tr>
										<tr>
											<td>
												<form id="imageform_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Image1" />
													<input type="file" name="photoimg" id="photoimg_sb" />

												</form>
											</td>
											<td>
												<form id="imageformnew1_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew1" />
													<input type="file" name="photoimgnew1" id="photoimgnew1_sb" />
					 
												</form>
											</td>
											
											<td>
												<form id="imageformnew2_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew2" />
													<input type="file" name="photoimgnew2" id="photoimgnew2_sb" />
					 
												</form>
											</td>

											<td>
												<form id="imageformnew3_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew3" />
													<input type="file" name="photoimgnew3" id="photoimgnew3_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew4_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew4" />
													<input type="file" name="photoimgnew4" id="photoimgnew4_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew5_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew5" />
													<input type="file" name="photoimgnew5" id="photoimgnew5_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew6_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew6" />
													<input type="file" name="photoimgnew6" id="photoimgnew6_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew7_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew7" />
													<input type="file" name="photoimgnew7" id="photoimgnew7_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew8_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew8" />
													<input type="file" name="photoimgnew8" id="photoimgnew8_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew9_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew9" />
													<input type="file" name="photoimgnew9" id="photoimgnew9_sb" />
					 
												</form>
											</td>
											<td>
												<form id="imageformnew10_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="Imagenew10" />
													<input type="file" name="photoimgnew10" id="photoimgnew10_sb" />
					 
												</form>
											</td>


											<td>
												<!--<form id="imageform1D" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="delImageB2W" />
													<input type="file" name="photoimg" id="photoimg" />

												</form>-->
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
										<div id='preview2_sb'>
										</div>
									</td>
									<td>
										<div id='preview3_sb'>
										</div>
									</td>
								</tr>
							</table>
							
										<form id="repimageform1_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage1" />
													<input type="file" name="repphotoimg1" id="repphotoimg1_sb" />

												</form>
												<form id="repimageform2_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage2" />
													<input type="file" name="repphotoimg2" id="repphotoimg2_sb" />

												</form>
												<form id="repimageform3_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage1" />
													<input type="file" name="repphotoimg3" id="repphotoimg3_sb" />

												</form>
												<form id="repimageform4_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage4" />
													<input type="file" name="repphotoimg4" id="repphotoimg4_sb" />

												</form>
												<form id="repimageform5_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage5" />
													<input type="file" name="repphotoimg5" id="repphotoimg5_sb" />

												</form>
												<form id="repimageform6_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage6" />
													<input type="file" name="repphotoimg6" id="repphotoimg6_sb" />

												</form>
												<form id="repimageform7_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage7" />
													<input type="file" name="repphotoimg7" id="repphotoimg7_sb" />

												</form>
												<form id="repimageform8_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage8" />
													<input type="file" name="repphotoimg8" id="repphotoimg8_sb" />

												</form>
												<form id="repimageform9_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage9" />
													<input type="file" name="repphotoimg9" id="repphotoimg9_sb" />

												</form>
												<form id="repimageform10_sb" method="post" enctype="multipart/form-data" action='ajaximage.php'>
													<input type="hidden" name="Method" id="Method" value="repImage10" />
													<input type="file" name="repphotoimg10" id="repphotoimg10_sb" />

												</form>
						</div>

			
				
				
			</div>
			
			


			<div id="dialogDecline_sb" title="<?php echo _("Decline Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="declinedesc_sb" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnDeclineSubscriber_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSendBack_sb" title="<?php echo _("Send Back Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="sendbackdesc_sb" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnSendBackSubscriber_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogApprove_sb" title="<?php echo _("Approve Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Please confirm your registration!"); ?></td>
							<td>
								<button  id="btnApproveSubscriber_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--SMB -->
			<div id="dialogSMBApprove_sb" title="<?php echo _("Approve Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Please confirm your registration!"); ?></td>
							<td>
								<button  id="btnApproveSMBSubscriber_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Approve"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSMBDecline_sb" title="<?php echo _("Decline Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="declineSMBdesc_sb" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnDeclineSMBSubscriber_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Decline"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSMBSendBack_sb" title="<?php echo _("Send Back Merchant / Cashier"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="sendbackSMBdesc_sb" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnSendBackSMBSubscriber_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage1_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage1_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage2_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage2_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage3_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage3_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage4_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage4_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div id="dialogDelImage5_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage5_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage6_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage6_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage7_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage7_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage8_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage8_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage9_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage9_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogDelImage10_sb" class="_dialog-img-alert_sb" title="<?php echo _("Alert!"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet" >
						<tr>
							<td><?php echo _("This is action will permanently delete the current file. Are you sure you want to proceed?"); ?><br><br></td>
						</tr>
						<tr>
							
							<td>
								<button  id="btnDelImage10_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Delete File"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="dialogSMBSendBackApp_sb" title="<?php echo _("Send Back SMB Application"); ?>">
				<div class="dLock" align="center">
					<table class="text-start tablet">
						<tr>
							<td><?php echo _("Description Message"); ?><span class="text-danger">*</span> :</td>
							<td>
								<textarea rows="2" cols="30" id="sendbackSMBdescApp_sb" ></textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<button  id="btnSendBackSMBSubscriberApp_sb" type = "button" class="ui-button ui-state-default ui-corner-all"><?php echo _("Send Back"); ?></button>
								<div class="lockloading"></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.textchange.min.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
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
		
		$(document).ready(function() {

			$('.viewaccount-link_sb').on('click', function() {
				var id = $(this).data('id');
				var type = $(this).data('type');
				viewSMBAccount(id, type);
			});

			$('.numonly').on('keyup', function() {
                this.value = this.value.replace(/\D/g, '');
            });

			$('._ctids').on('keyup', function() {
                var i = this.id.split('_')[1];
                this.value = run(this.value);
                validateTID(i);
            });

			$('._smbctids').on('keyup', function() {
                this.value = run2(this.value);
			});

			$(document).on('click', '[id^="delA"]', function() {
				var parentDiv = $(this).closest('div[id^="delImage"]'); 
				var imageId = parentDiv.attr('id');
				var index = imageId.replace('delImage', '');
				delImage('Image' + index);
			});

			$(".buttonx").button();
			
		oTable = $('#sendback').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button",
				"aaSorting": [[0, "desc" ]],
				"bRetrieve": true
		});
				
		$('#photoimgSend1').hide();
		$('#photoimgSend2').hide();
		$('#photoimgSend3').hide();
		$("#fileclickx").click(function () {
			$("#photoimgSend1").trigger('click');
			
		});
		$("#fileclick2").click(function () {
			$("#photoimgSend2").trigger('click');
		});
		$("#fileclick3").click(function () {
			$("#photoimgSend3").trigger('click');
		});
				
		window.pho = "0";
		$("#photoimgSend1").click(function () {
			window.pho = "1";
		});
		$("#photoimgSend2").click(function () {
			window.pho = "1";
		});
		$("#photoimgSend3").click(function () {
			window.pho = "1";
		});
		
	// may 16 2018 added by onyx 

	$('#addFile2').click(function (){
		$('#file2div_sb').show();
		$('#addFile2').hide();
		$('#addFile3').show();
	});

	$('#addFile3').click(function (){
		$('#file3div_sb').show();
		$('#addFile3').hide();
		$('#addFile4').show();
	});
	$('#addFile4').click(function (){
		$('#file4div_sb').show();
		$('#addFile4').hide();
		$('#addFile5').show();
	});
	$('#addFile5').click(function (){
		$('#file5div_sb').show();
		$('#addFile5').hide();
		$('#addFile6').show();
	});
	$('#addFile6').click(function (){
		$('#file6div_sb').show();
		$('#addFile6').hide();
		$('#addFile7').show();
	});
	$('#addFile7').click(function (){
		$('#file7div_sb').show();
		$('#addFile7').hide();
		$('#addFile8').show();
	});
	$('#addFile8').click(function (){
		$('#file8div_sb').show();
		$('#addFile8').hide();
		$('#addFile9').show();
	});
	$('#addFile9').click(function (){
		$('#file9div_sb').show();
		$('#addFile9').hide();
		$('#addFile10').show();
	});
	$('#addFile10').click(function (){
		$('#file10div_sb').show();
		$('#addFile10').hide();
	});

	$('#photoimg_sb').hide();
	$("#fileclick_sb").click(function () {
		$("#photoimg_sb").trigger('click');
	});
	
	$("#fileclicknew1_sb").click(function () {
		$("#photoimgnew1_sb").trigger('click');
	});
	$("#fileclicknew2_sb").click(function () {
		$("#photoimgnew2_sb").trigger('click');
	});
	$("#fileclicknew3_sb").click(function () {
		$("#photoimgnew3_sb").trigger('click');
	});
	$("#fileclicknew4_sb").click(function () {
		$("#photoimgnew4_sb").trigger('click');
	});
	$("#fileclicknew5_sb").click(function () {
		$("#photoimgnew5_sb").trigger('click');
	});
	$("#fileclicknew6_sb").click(function () {
		$("#photoimgnew6_sb").trigger('click');
	});
	$("#fileclicknew7_sb").click(function () {
		$("#photoimgnew7_sb").trigger('click');
	});
	$("#fileclicknew8_sb").click(function () {
		$("#photoimgnew8_sb").trigger('click');
	});
	$("#fileclicknew9_sb").click(function () {
		$("#photoimgnew9_sb").trigger('click');
	});
	$("#fileclicknew10").click(function () {
		$("#photoimgnew10_sb").trigger('click');
	});
	
	

	
	window.pho = "0";
	$("#photoimg_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew1_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew2_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew3_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew4_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew5_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew6_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew7_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew8_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew9_sb").click(function () {
		window.pho = "1";
	});
	$("#photoimgnew10_sb").click(function () {
		window.pho = "1";
	});

	
	
	$(document).ready(function() { 

		$('#dialogREG').dialog({
			autoOpen: false
		});
		

		
		$('#photoimg_sb').on('change', function()			{ 
			$("#preview_sb").html('');
			$("#preview_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform_sb").ajaxForm({
				target: '#preview_sb'
			}).submit();
			window.pho = "0";
			var stat = $("#updateI1_sb").val();
			if(stat!="DEL"){
				$("#updateI1_sb").val("REP");
			}else if(stat!="DEL"){
				$("#updateI1_sb").val("DEL");
			}
			
			$("#delImage1").hide();
			$("#cancelImage1_sb").show();
			$("#x1").show();
		});
		
		$('#photoimgnew1_sb').on('change', function()			{ 
			$("#previewnew1_sb").html('');
			$("#previewnew1_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew1_sb").ajaxForm({
				target: '#previewnew1_sb'
			}).submit();
			window.pho = "0";
			$("#updateI2_sb").val("REP");
			$("#delImage2").hide();
			$("#cancelImage2_sb").show();
			$("#x2").show();
			
		});
		
		$('#photoimgnew2_sb').on('change', function()			{ 
			$("#previewnew2_sb").html('');
			$("#previewnew2_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew2_sb").ajaxForm({
				target: '#previewnew2_sb'
			}).submit();
			window.pho = "0";
			$("#updateI3_sb").val("REP");
			$("#delImage3").hide();
			$("#cancelImage3_sb").show();
			$("#x3").show();
		});

		$('#photoimgnew3_sb').on('change', function()			{ 
			$("#previewnew3_sb").html('');
			$("#previewnew3_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew3_sb").ajaxForm({
				target: '#previewnew3_sb'
			}).submit();
			window.pho = "0";
			$("#updateI4_sb").val("REP");
			$("#delImage4").hide();
			$("#cancelImage4_sb").show();
			$("#x4").show();
		});

		$('#photoimgnew4_sb').on('change', function()			{ 
			$("#previewnew4_sb").html('');
			$("#previewnew4_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew4_sb").ajaxForm({
				target: '#previewnew4_sb'
			}).submit();
			window.pho = "0";
			$("#updateI5_sb").val("REP");
			$("#delImage5").hide();
			$("#cancelImage5_sb").show();
			$("#x5").show();
		});

		$('#photoimgnew5_sb').on('change', function()			{ 
			$("#previewnew5_sb").html('');
			$("#previewnew5_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew5_sb").ajaxForm({
				target: '#previewnew5_sb'
			}).submit();
			window.pho = "0";
			$("#updateI6_sb").val("REP");
			$("#delImage6").hide();
			$("#cancelImage6_sb").show();
			$("#x6").show();
		});

		$('#photoimgnew6_sb').on('change', function()			{ 
			$("#previewnew6_sb").html('');
			$("#previewnew6_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew6_sb").ajaxForm({
				target: '#previewnew6_sb'
			}).submit();
			window.pho = "0";
			$("#updateI7_sb").val("REP");
			$("#delImage7").hide();
			$("#cancelImage7_sb").show();
			$("#x7").show();
		});

		$('#photoimgnew7_sb').on('change', function()			{ 
			$("#previewnew7_sb").html('');
			$("#previewnew7_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew7_sb").ajaxForm({
				target: '#previewnew7_sb'
			}).submit();
			window.pho = "0";
			$("#updateI8_sb").val("REP");
			$("#delImage8").hide();
			$("#cancelImage8_sb").show();
			$("#x8").show();
		});

		$('#photoimgnew8_sb').on('change', function()			{ 
			$("#previewnew8_sb").html('');
			$("#previewnew8_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew8_sb").ajaxForm({
				target: '#previewnew8_sb'
			}).submit();
			window.pho = "0";
			$("#updateI9_sb").val("REP");
			$("#delImage9").hide();
			$("#cancelImage9_sb").show();
			$("#x9").show();
		});

		$('#photoimgnew9_sb').on('change', function()			{ 
			$("#previewnew9_sb").html('');
			$("#previewnew9_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew9_sb").ajaxForm({
				target: '#previewnew9_sb'
			}).submit();
			window.pho = "0";
			
			$("#updateI10_sb").val("REP");
			$("#delImage10").hide();
			$("#cancelImage10_sb").show();
			$("#x10").show();
		});

		$('#photoimgnew10_sb').on('change', function()			{ 
			$("#previewnew10").html('');
			$("#previewnew10").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew10_sb").ajaxForm({
				target: '#previewnew10'
			}).submit();
			window.pho = "0";
			$("#x11").show();
		});

	
		$('#photoimg2').on('change', function()			{ 
			$("#preview2_sb").html('');
			$("#preview2_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform2").ajaxForm({
				target: '#preview2_sb'
			}).submit();

		});

		$('#photoimg3').on('change', function()			{ 
			$("#preview3_sb").html('');
			$("#preview3_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform3").ajaxForm({
				target: '#preview3_sb'
			}).submit();

		});
	}); 

//----.

	// replace
		
		$('#repphotoimg1_sb').on('change', function()			{ 
			$("#reppreview1").html('');
			$("#reppreview1").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform1_sb").ajaxForm({
				target: '#reppreview1'
			}).submit();
			window.pho = "0";
			$("#updateI1_sb").val("REP");
			$("#delImage1").hide();
			$("#cancelImage1_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg2_sb').on('change', function()			{ 
			$("#reppreview2").html('');
			$("#reppreview2").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform2_sb").ajaxForm({
				target: '#reppreview2'
			}).submit();
			window.pho = "0";
			$("#updateI2_sb").val("REP");
			$("#delImage2").hide();
			$("#cancelImage2_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg3_sb').on('change', function()			{ 
			$("#reppreview3").html('');
			$("#reppreview3").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform3_sb").ajaxForm({
				target: '#reppreview3'
			}).submit();
			window.pho = "0";
			$("#updateI3_sb").val("REP");
			$("#delImage3").hide();
			$("#cancelImage3_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg4_sb').on('change', function()			{ 
			$("#reppreview4").html('');
			$("#reppreview4").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform4_sb").ajaxForm({
				target: '#reppreview4'
			}).submit();
			window.pho = "0";
			$("#updateI4_sb").val("REP");
			$("#delImage4").hide();
			$("#cancelImage4_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg5_sb').on('change', function()			{ 
			$("#reppreview5").html('');
			$("#reppreview5").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform5_sb").ajaxForm({
				target: '#reppreview5'
			}).submit();
			window.pho = "0";
			$("#updateI5_sb").val("REP");
			$("#delImage5").hide();
			$("#cancelImage5_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg6_sb').on('change', function()			{ 
			$("#reppreview6").html('');
			$("#reppreview6").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform6_sb").ajaxForm({
				target: '#reppreview6'
			}).submit();
			window.pho = "0";
			$("#updateI6_sb").val("REP");
			$("#delImage6").hide();
			$("#cancelImage6_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg7_sb').on('change', function()			{ 
			$("#reppreview7").html('');
			$("#reppreview7").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform7_sb").ajaxForm({
				target: '#reppreview7'
			}).submit();
			window.pho = "0";
			$("#updateI7_sb").val("REP");
			$("#delImage7").hide();
			$("#cancelImage7_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg8_sb').on('change', function()			{ 
			$("#reppreview8").html('');
			$("#reppreview8").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform8_sb").ajaxForm({
				target: '#reppreview8'
			}).submit();
			window.pho = "0";
			$("#updateI8_sb").val("REP");
			$("#delImage8").hide();
			$("#cancelImage8_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg9_sb').on('change', function()			{ 
			$("#reppreview9").html('');
			$("#reppreview9").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform9_sb").ajaxForm({
				target: '#reppreview9'
			}).submit();
			window.pho = "0";
			$("#updateI9_sb").val("REP");
			$("#delImage9").hide();
			$("#cancelImage9_sb").show();
			$("#x1").show();
		});
		$('#repphotoimg10_sb').on('change', function()			{ 
			$("#reppreview10").html('');
			$("#reppreview10").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#repimageform10_sb").ajaxForm({
				target: '#reppreview10'
			}).submit();
			window.pho = "0";
			$("#updateI10_sb").val("REP");
			$("#delImage10").hide();
			$("#cancelImage10_sb").show();
			$("#x1").show();
		});
		//----
			
		
		
		$('#photoimgSend1').on('change', function()			{ 
			$("#pre1").show();
			$("#preview_sb").html('');
			$("#preview_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew").ajaxForm({
				target: '#preview_sb'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus1").val("REP");
			$("#delImage1").hide();
			$("#cancelImage1_sb").show();
			
			
		});
		
		$('#photoimgSend2').on('change', function()			{ 
			$("#pre2").show();
			$("#preview2_sb").html('');
			$("#preview2_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew2_sb").ajaxForm({
				target: '#preview2_sb'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus2").val("REP");
			$("#delImage2").hide();
			$("#cancelImage2_sb").show();
			
		});
		$('#photoimgSend3').on('change', function()			{ 
			$("#pre3").show();
			$("#preview3_sb").html('');
			$("#preview3_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew3_sb").ajaxForm({
				target: '#preview3_sb'
			}).submit();
			window.pho = "0";
			$("#sendImageStatus3").val("REP");
			$("#delImage3").hide();
			$("#cancelImage3_sb").show();
			
		}); 
	$("#cancelImage1_sb").click(function(){
			
			var stat = $("#updateI1_sb").val();
			if(stat!="DEL"){
				$("#delImage1").show();
				$("#updateI1_sb").val("NC");
			}else if(stat!="DEL"){
				$("#delImage1").hide();
				$("#updateI1_sb").val("DEL");
			}
			
			$("#preview_sb").html('');
			<?php
			unset($_SESSION['imageB2W']);
			unset($_SESSION['size1']);
			?>
			$(this).hide();
		});
		
	$("#cancelImage2_sb").click(function(){
			$("#updateI2_sb").val("NC");
			$("#delImage2").show();
			$("#previewnew1_sb").html('');
			<?php
			unset($_SESSION['imagenew1']);
			unset($_SESSION['size2']);
			?>
			$(this).hide();
		});
	$("#cancelImage3_sb").click(function(){
			$("#updateI3_sb").val("NC");
			$("#delImage3").show();
			$("#previewnew2_sb").html('');
			<?php
			unset($_SESSION['imagenew2']);
			unset($_SESSION['size3']);
			?>
			$(this).hide();
		});
		
	$("#cancelImage4_sb").click(function(){
			$("#updateI4_sb").val("NC");
			$("#delImage4").show();
			$("#previewnew3_sb").html('');
			<?php
			unset($_SESSION['imagenew3']);
			unset($_SESSION['size4']);
			?>
			$(this).hide();
		});
		
	$("#cancelImage5_sb").click(function(){
			$("#updateI5_sb").val("NC");
			$("#delImage5").show();
			$("#previewnew4_sb").html('');
			<?php
			unset($_SESSION['imagenew4']);
			unset($_SESSION['size5']);
			?>
			$(this).hide();
		});
	$("#cancelImage6_sb").click(function(){
			$("#updateI6_sb").val("NC");
			$("#delImage6").show();
			$("#previewnew5_sb").html('');
			<?php
			unset($_SESSION['imagenew5']);
			unset($_SESSION['size6']);
			?>
			$(this).hide();
		});
	$("#cancelImage7_sb").click(function(){
			$("#updateI7_sb").val("NC");
			$("#delImage7").show();
			$("#previewnew6_sb").html('');
			<?php
			unset($_SESSION['imagenew6']);
			unset($_SESSION['size7']);
			?>
			$(this).hide();
		});
	$("#cancelImage8_sb").click(function(){
			$("#updateI8_sb").val("NC");
			$("#delImage8").show();
			$("#previewnew7_sb").html('');
			<?php
			unset($_SESSION['imagenew7']);
			unset($_SESSION['size8']);
			?>
			$(this).hide();
		});
	$("#cancelImage9_sb").click(function(){
			$("#updateI9_sb").val("NC");
			$("#delImage9").show();
			$("#previewnew8_sb").html('');
			<?php
			unset($_SESSION['imagenew8']);
			unset($_SESSION['size9']);
			?>
			$(this).hide();
		});
	$("#cancelImage10_sb").click(function(){
			$("#updateI10_sb").val("NC");
			$("#delImage10").show();
			$("#previewnew9_sb").html('');
			<?php
			unset($_SESSION['imagenew9']);
			unset($_SESSION['size10']);
			?>
			$(this).hide();
		});
	
		
		

		$("#btnDelImage1_sb").click(function(){
			$("#updateI1_sb").val("DEL");
			$("#delImage1").hide();		
			
		$("#dialogDelImage1_sb").dialog('close');
		});
		$("#btnDelImage2_sb").click(function(){
			$("#updateI2_sb").val("DEL");
			$("#delImage2").hide();	

		$("#dialogDelImage2_sb").dialog('close');			
		});
		$("#btnDelImage3_sb").click(function(){
			$("#updateI3_sb").val("DEL");
			$("#delImage3").hide();	

		$("#dialogDelImage3_sb").dialog('close');			
		});
		$("#btnDelImage4_sb").click(function(){
			$("#updateI4_sb").val("DEL");
			$("#delImage4").hide();	

		$("#dialogDelImage4_sb").dialog('close');			
		});
		$("#btnDelImage5_sb").click(function(){
			$("#updateI5_sb").val("DEL");
			$("#delImage5").hide();	

		$("#dialogDelImage5_sb").dialog('close');			
		});
		$("#btnDelImage6_sb").click(function(){
			$("#updateI6_sb").val("DEL");
			$("#delImage6").hide();	

		$("#dialogDelImage6_sb").dialog('close');			
		});
		$("#btnDelImage7_sb").click(function(){
			$("#updateI7_sb").val("DEL");
			$("#delImage7").hide();	

		$("#dialogDelImage7_sb").dialog('close');			
		});
		$("#btnDelImage8_sb").click(function(){
			$("#updateI8_sb").val("DEL");
			$("#delImage8").hide();	

		$("#dialogDelImage8_sb").dialog('close');			
		});
		$("#btnDelImage9_sb").click(function(){
			$("#updateI9_sb").val("DEL");
			$("#delImage9").hide();	

		$("#dialogDelImage9_sb").dialog('close');			
		});
		$("#btnDelImage10_sb").click(function(){
			$("#updateI10_sb").val("DEL");
			$("#delImage10").hide();	

		$("#dialogDelImage10_sb").dialog('close');			
		});
	/*	$('#photoimgSend2').on('change', function()			{ 
			$("#preview2_sb").html('');
			$("#preview2_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew2_sb").ajaxForm({
				target: '#preview_sb'2
			}).submit();
			window.pho = "0";
		});
		$('#photoimgSend3').on('change', function()			{ 
			$("#preview3_sb").html('');
			$("#preview3_sb").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageformnew3_sb").ajaxForm({
				target: '#preview3_sb'
			}).submit();
			window.pho = "0";
		});*/






			$('#mid').keyup(function() { 
    	//alert($("#selectedType_sb").val());
    	str = $(this).val()
    	str = str.replace(/\s/g,'')
    	$(this).val(str)

    	if($("#selectedType_sb").val()=="MERCHANT"){
    		if(jQuery.trim($("#mid").val())==""){
    			$(".ctids").prop('disabled', true);
    			$("#tid").prop('disabled', true);
    		}else{
    			$(".ctids").prop('disabled', false);
    			$("#tid").prop('disabled', false);
    		}
    	}else{
    		//alert($("#selectedType_sb").val());
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


			$('#pending_acccount_view_sb').dialog({
				autoOpen: false,
				width: 1200,
				height: 600,
				draggable: true,
				resizable: false,
				modal:true,
				// position:'bottom'
			});

	// Dialog			
	$('#dialogDecline_sb, #dialogSendBack_sb, #dialogApprove_sb').dialog({
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
	$('#dialogSMBDecline_sb, #dialogSMBSendBack_sb, #dialogSMBApprove_sb, #dialogSMBSendBackApp_sb, #dialogDelImage1_sb, #dialogDelImage2_sb, #dialogDelImage3_sb, #dialogDelImage4_sb, #dialogDelImage5_sb, #dialogDelImage6_sb, #dialogDelImage7_sb, #dialogDelImage8_sb, #dialogDelImage9_sb, #dialogDelImage10_sb').dialog({
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

$("#pendingreg").fadeIn(700);

		function checkMID($accounttype,$mmsisdn, $accid){

			$("#mmsisdn").val($mmsisdn);
			$("#mmsisdn").prop('disabled', true);
			$("#mmsisdn2").val('');
			$("#mmsisdn2").prop('disabled', true);
			$("#authNumber2_sb").prop('disabled', true);

			if($mmsisdn == $accid){
				$("#mmsisdn").hide();
				$("#mmsisdn2").show();
				$("#authNumber_sb").hide();
				$("#authNumber2_sb").show();
			} else {
				$("#mmsisdn").show();
				$("#mmsisdn2").hide();
				$("#authNumber_sb").show();
				$("#authNumber2_sb").hide();
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
			txtSearch: id
		},success: function(json){
			if(json.Result.ResponseCode == 0){
				//alert(json.Result.Value.CASHIERS.length);
				$("#pending_acccount_view_sb").dialog('open');
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
				var option = "<option value='"+json.Result.AccountInformation.AccountType+"'>"+json.Result.AccountInformation.AccountType+"</option>";
				option = "<option value='"+AccountType+"'>"+AccountType+"</option>";
				$("#selectedType_sb").html(option);
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
				
				$("#corponboardedby_sb").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname_sb").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname_sb").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness_sb").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo_sb").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building_sb").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street_sb").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city_sb").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor_sb").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area_sb").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox_sb").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country_sb").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName_sb").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName_sb").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber_sb").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail_sb").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality_sb").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession_sb").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				
				$("#mercdiscountrate_sb").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp_sb").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee_sb").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate_sb").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee_sb").val(json.Result.AccountInformation.cashtransfee);
				
				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE_sb').html(listitem);
					$('#CASHTYPE_sb').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE_sb').html(listitem);
					$('#CASHTYPE_sb').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE_sb').html(listitem);
					$('#CASHTYPE_sb').click();
				}
				$("tr#add_data").remove();

				cashierLength = json.Result.Value.CASHIERS.length;
				
				if(json.Result.Value.CASHIERS.length > 0){
					//alert(json.Result.Value.CASHIERS[0].msisdn);
					//$("tr#add_data").remove();
					for(var i =0;i < json.Result.Value.CASHIERS.length;i++){

						$("#tblAccount").append("<tr id='add_data'><td>Merchant ID<span class='text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class='text-danger'>*</span>:</td><td><input class='cids' id='cid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].msisdn + "></td><td>Terminal ID<span class='text-danger'>*</span>:</td><td><input maxlength='8' minlength='8' class='ctids _ctids' id='ctid_" + i + "' type='text' disabled='disabled'></td></tr>");
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
				$("#checkIDx").attr("href", download_url + $("#authNumber_sb").val());
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}
	});
}
var accType;

$(document).ready(function(){
   			// replace
	
	$("#replaceImage1").click(function () {
		$("#repphotoimg1_sb").trigger('click');
		alert("dfghjk");
	});
	$("#replaceImage2").click(function () {
			$("#repphotoimg2_sb").trigger('click');
	});
	$("#replaceImage3").click(function () {
			$("#repphotoimg3_sb").trigger('click');
	});
	$("#replaceImage4").click(function () {
			$("#repphotoimg4_sb").trigger('click');
	});
	$("#replaceImage5").click(function () {
			$("#repphotoimg5_sb").trigger('click');
	});
	$("#replaceImage6").click(function () {
			$("#repphotoimg6_sb").trigger('click');
	});
	$("#replaceImage7").click(function () {
			$("#repphotoimg7_sb").trigger('click');
	});
	$("#replaceImage8").click(function () {
			$("#repphotoimg8_sb").trigger('click');
	});
	$("#replaceImage9").click(function () {
			$("#repphotoimg9_sb").trigger('click');
	});
	$("#replaceImage10").click(function () {
			$("#repphotoimg10_sb").trigger('click');
	});
	
	window.pho = "0";
	$("#repphotoimg1_sb").click(function () {
		window.pho = "1";
	});
	$("#repphotoimg2_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg3_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg4_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg5_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg6_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg7_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg8_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg9_sb").click(function () {
			window.pho = "1";
	});
	$("#repphotoimg10_sb").click(function () {
			window.pho = "1";
	});
	//--------
});
function delImage(image){
	switch(image){
		case "Image1":
		$("#dialogDelImage1_sb").dialog('open');
		break;
		
		case "Image2":
		$("#dialogDelImage2_sb").dialog('open');
		break;
		
		case "Image3":
		$("#dialogDelImage3_sb").dialog('open');
		break;
		
		case "Image4":
		$("#dialogDelImage4_sb").dialog('open');
		break;
		
		case "Image5":
		$("#dialogDelImage5_sb").dialog('open');
		break;
		
		case "Image6":
		$("#dialogDelImage6_sb").dialog('open');
		break;
		
		case "Image7":
		$("#dialogDelImage7_sb").dialog('open');
		break;
		
		case "Image8":
		$("#dialogDelImage8_sb").dialog('open');
		break;
		
		case "Image9":
		$("#dialogDelImage9_sb").dialog('open');
		break;
		
		case "Image10":
		$("#dialogDelImage10_sb").dialog('open');
		break;
		
	}
}

function viewSMBAccount(id, AccountType){
	$("#authNumber2_sb").prop('disabled', false);
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);
	
	$("#delImage1").show();
	$("#delImage2").show();
	$("#delImage3").show();
	
	$("#preview_sb").html('');
	$("#preview2_sb").html('');
	$("#preview3_sb").html('');
	
	$("#cancelImage1_sb").hide();
	$("#cancelImage2_sb").hide();
	$("#cancelImage3_sb").hide();
	$("#cancelImage4_sb").hide();
	$("#cancelImage5_sb").hide();
	$("#cancelImage6_sb").hide();
	$("#cancelImage7_sb").hide();
	$("#cancelImage8_sb").hide();
	$("#cancelImage9_sb").hide();
	$("#cancelImage10_sb").hide();
	

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
			if(json.Result.ResponseCode == 0){
				//alert(json.Result.Value.CASHIERS.length);
				$("#pending_acccount_view_sb").dialog('open');
				
				//$("#pending_acccount_view_sb").dialog('close');
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
				option = "<option value='"+AccountType+"'>"+AccountType+"</option>";
				$("#selectedType_sb").html(option);
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
				
				$("#corponboardedby_sb").val(json.Result.AccountInformation.CorpInformation.onboardedby);
				$("#corpreceiptname_sb").val(json.Result.AccountInformation.CorpInformation.receiptname);
				$("#corpbusinessname_sb").val(json.Result.AccountInformation.CorpInformation.businessname);
				$("#corptradelicensenumber").val(json.Result.AccountInformation.CorpInformation.tradelicensenumber);
				$("#corpdateofincorporation").val(json.Result.AccountInformation.CorpInformation.dateofincorporation);
				$("#corpregistredaddress").val(json.Result.AccountInformation.CorpInformation.registeredaddress);
				$("#corptypeofbusiness_sb").val(json.Result.AccountInformation.CorpInformation.typeofbusiness);
				$("#corpownershipinfo_sb").val(json.Result.AccountInformation.CorpInformation.ownershipinfo);
				
				$("#building_sb").val(json.Result.AccountInformation.CorpInformation.building);
				$("#street_sb").val(json.Result.AccountInformation.CorpInformation.street);
				$("#city_sb").val(json.Result.AccountInformation.CorpInformation.city);
				$("#floor_sb").val(json.Result.AccountInformation.CorpInformation.floor);
				$("#area_sb").val(json.Result.AccountInformation.CorpInformation.area);
				$("#pobox_sb").val(json.Result.AccountInformation.CorpInformation.pobox);
				$("#country_sb").val(json.Result.AccountInformation.PersonalInformation.CurrentAddress.CountryID);
				
				$("#pLName_sb").val(json.Result.AccountInformation.PersonalInformation.LastName);
				$("#pFName_sb").val(json.Result.AccountInformation.PersonalInformation.FirstName);
				$("#authNumber_sb").val(json.Result.AccountInformation.MobileNumber);
				$("#pEmail_sb").val(json.Result.AccountInformation.PersonalInformation.EmailAddress);
				$("#pIDNumber_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.IDNumber);
				$("#pIDDesc_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.Description);
				$("#pIDIssuance_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.Issuance);
				$("#pIDExpiry_sb").val(json.Result.AccountInformation.PersonalInformation.ValidID.Expiry);
				$("#pNationality_sb").val(json.Result.AccountInformation.PersonalInformation.Nationality);
				$("#pProfession_sb").val(json.Result.AccountInformation.PersonalInformation.EmploymentDetails.Profession);
				
				$("#mercdiscountrate_sb").val(json.Result.AccountInformation.mercdiscountrate);
				$("#mercdiscountratenonp_sb").val(json.Result.AccountInformation.nonpremium);
				$("#mcvisafee_sb").val(json.Result.AccountInformation.mcvisafee);
				$("#cashdiscountrate_sb").val(json.Result.AccountInformation.cashdiscountrate);
				$("#cashtransfee_sb").val(json.Result.AccountInformation.cashtransfee);
				//alert(json.Result.QuerySum);
				$('#listqwert_sb').append('');
				// for(var i =0;i < json.Result.QuerySum;i++){
						
				// 		$('#listqwert_sb').append('<div id="delImage'+(i+1)+'"><div align="right" class="_f-right_sb"><a id="checkID'+(i+1)+'">'+'<?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _(" View Application File " );}?>'+(i+1)+'</a> <a id="delA" title="Delete Application File"  href="'+"javascript:delImage('Image"+(i+1)+"')"+'"><img src="../../Views/images/icons/close_1-512.png" width="12px"></a></div> </div><br><br>');
						
				// 							//	$('#listqwert_sb').append('<div id="delImage'+(i+1)+'"><div align="right" style="float:right;"><a id="checkID'+(i+1)+'">'+'<?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _(" View Application File " );}?>'+(i+1)+'</a> <a id="delA" title="Delete Application File"  href="'+"javascript:delImage('Image"+(i+1)+"')"+'"><img src="../../Views/images/icons/close_1-512.png" width="12px"></a></div> </div><div><button style="float:right;" id="replaceImage'+(i+1)+'">replace</button> </div><div class="_preview_sb"id="reppreview'+(i+1)+'">	</div><br><br>');
				// }
				for (var i = 0; i < json.Result.QuerySum; i++) {
					$('#listqwert_sb').append(`
						<div id="delImage${i + 1}">
							<div align="right" class="_f-right_sb">
								<a id="checkID${i + 1}">
									<?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')) { echo _(" View Application File "); } ?>
									${i + 1}
								</a>
								<a id="delA${i + 1}" class="ms-3" title="Delete Application File" href="#">
								<i class="fa-solid fa-trash"></i>
								</a>
							</div>
						</div>
						<br><br>
					`);
				}
				$("#pAppID_sb").val(json.Result.AccountInformation.ApplicationID);
				if(json.Result.AccountInformation.cashtype == 'PERCENT'){
					var listitem = '<option "selected" >Cash Discount Rate (%)</option>';
					$('#CASHTYPE_sb').html(listitem);
					$('#CASHTYPE_sb').click();
				}
				if(json.Result.AccountInformation.cashtype == 'FIXED'){
					var listitem = '<option "selected" >Cash Transaction Fee</option>';
					$('#CASHTYPE_sb').html(listitem);
					$('#CASHTYPE_sb').click();
				}
				if(json.Result.AccountInformation.cashtype == 'MONTHLY'){
					var listitem = '<option "selected" >Cash Monthly Charges</option>';
					$('#CASHTYPE_sb').html(listitem);
					$('#CASHTYPE_sb').click();
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
						
						$("#tblAccount").append("<tr id='add_data'><td>Merchant ID<span class='text-danger'>*</span>:</td><td><input class = 'cmids' id='cmid_" + i + "' type='text' value = " + json.Result.Value.CASHIERS[i].merchantID + "></td><td>Cashier MSISDN<span class='text-danger'>*</span>:</td><td><input class='cids' id='cid_" + i + "' type='text' value = "+ json.Result.Value.CASHIERS[i].msisdn +"><input id ='ciddisplay' type='text' value='' disabled='disabled'></td><td>Terminal ID<span class='text-danger'>*</span>:</td><td><input maxlength='8' minlength='8' class='ctids _smbctids' id='ctid_" + i + "' type='text' disabled='disabled'></td></tr>");

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
				//$("#checkID").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true);
				
				$("#checkIDx").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"1");
				$("#checkID2x").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"2");
				$("#checkID3x").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"3");
			
				$("#checkID1").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"1"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID2").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"2"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID3").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"3"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID4").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"4"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID5").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"5"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID6").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"6"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID7").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"7"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID8").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"8"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID9").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"9"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
				$("#checkID10").attr("href", download_url + "msisdn=" + $("#authNumber_sb").val() + "&" + "smbBoolean=" + true+"&"+"image="+"10"+"&appID="+json.Result.AccountInformation.ApplicationID+"&ftype="+"QC");
			
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}
	});	
}



$(document).on('click', '.ui-dialog-titlebar-close', function() {
	$('#listqwert_sb').empty();
});
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
				$('#dialogSMBApprove_sb').dialog('open');				
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
				$('#dialogSMBApprove_sb').dialog('open');				
			}

			if(ccnt == 1){
				$("<p>Duplicate Terminal ID Fields!</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
	}
	}
	

	return false;
});

$("#btnApproveSMBSubscriber_sb").click(function(){
	$('#btnApproveSMBSubscriber_sb').prop("disabled", true);
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
				MSISDN: $("#authNumber_sb").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				cashierids: CIDs,
				cashiertids: CTIDs,
				serialnumber: 0
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$('#dialogSMBApprove_sb').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
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
				MSISDN: $("#authNumber_sb").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				serialnumber: 0
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$('#dialogSMBApprove_sb').dialog('close');

				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}
		});
	}
	$('#btnApproveSMBSubscriber_sb').prop("disabled", false);
});

$('#btnRejectSMBKYC').click(function(){
	$('#dialogSMBDecline_sb').dialog('open');
	return false;
});

$("#btnDeclineSMBSubscriber_sb").click(function(){
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
				MSISDN: $("#authNumber_sb").val(),
				cashierids: CIDs,
				reason: $("#declineSMBdesc_sb").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$("#dialogSMBDecline_sb").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
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
				MSISDN: $("#authNumber_sb").val(),
				reason: $("#declineSMBdesc_sb").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$("#dialogSMBDecline_sb").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}
		});
	}


});

$('#btnSendbackSMBKYC').click(function(){
	$('#dialogSMBSendBack_sb').dialog('open');
	return false;
});

// $('#btnSendbackToBank').click(function(){
	// alert(compname+" "+accType+corpboard+corparea+city+pobox+pFName+pLname+authNumber2+pEmail+mercdiscountrate+mercdiscountratenonp+cashdiscountrate+imgstat1+imgstat2+imgstat3+id);
	// return false;
// });


$("#btnSendbackToBank").click(function(){
	
	var compname= $("#corpbusinessname_sb").val();
	var accType= $("#selectedType_sb").val();
	var corpboard= $("#corponboardedby_sb").val();
	var corparea= $("#area_sb").val();
	var city= $("#city_sb").val();
	var pobox= $("#pobox_sb").val();

	var pFName= $("#pFName_sb").val();
	var pLname= $("#pLName_sb").val();
	var authNumber2= $("#authNumber2_sb").val();
	var pEmail= $("#pEmail_sb").val();

	var mercdiscountrate= $("#mercdiscountrate_sb").val();
	var mercdiscountratenonp= $("#mercdiscountratenonp_sb").val();
	var cashdiscountrate= $("#cashdiscountrate_sb").val();

	var imgstat1= $("#sendImageStatus1").val();
	var imgstat2= $("#sendImageStatus2").val();
	var imgstat3= $("#sendImageStatus3").val();
	var id= $("#authNumber_sb").val();
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackToBank',
			 compname: $("#corpbusinessname_sb").val(),
			 accType: $("#selectedType_sb").val(),
			 corpboard: $("#corponboardedby_sb").val(),
			 corparea: $("#area_sb").val(),
			 city: $("#city_sb").val(),
			 pobox: $("#pobox_sb").val(),
			 corpreceiptname: $("#corpreceiptname_sb").val(),

			 pFName: $("#pFName_sb").val(),
			 pLname: $("#pLName_sb").val(),
			 authNumber2: $("#authNumber2_sb").val(),
			 pEmail: $("#pEmail_sb").val(),

			 mercdiscountrate: $("#mercdiscountrate_sb").val(),
			 mercdiscountratenonp: $("#mercdiscountratenonp_sb").val(),
			 cashdiscountrate: $("#cashdiscountrate_sb").val(),

			 imgstat1: $("#updateI1_sb").val(),
			 imgstat2: $("#updateI2_sb").val(),
			 imgstat3: $("#updateI3_sb").val(),
			 imgstat4: $("#updateI4_sb").val(),
			 imgstat5: $("#updateI5_sb").val(),
			 imgstat6: $("#updateI6_sb").val(),
			 imgstat7: $("#updateI7_sb").val(),
			 imgstat8: $("#updateI8_sb").val(),
			 imgstat9: $("#updateI9_sb").val(),
			 imgstat10: $("#updateI10_sb").val(),
			 id: $("#authNumber_sb").val(),
			 appID:$("#pAppID_sb").val(),
			 FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
				$("#pending_acccount_view_sb").dialog('close');
				$("#dialogSMBSendBack_sb").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}
	});

});


$('#btnSendBackApplication').click(function(){

	$('#dialogSMBSendBackApp_sb').dialog('open');
	return false;
	
	 
});

$("#btnSendBackSMBSubscriber_sb").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackSMBKYC',
			MSISDN: $("#authNumber_sb").val(),
			reason: $("#sendbackSMBdesc_sb").val()
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
				$("#pending_acccount_view_sb").dialog('close');
				$("#dialogSMBSendBack_sb").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}
	});

});

$("#btnSendBackSMBSubscriberApp_sb").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackSMBKYCApp',
			MSISDN: $("#authNumber_sb").val(),
			reason: $("#sendbackSMBdescApp_sb").val()
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
				$("#pending_acccount_view_sb").dialog('close');
				$("#dialogSMBSendBackApp_sb").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}
	});

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
		$('#dialogApprove_sb').dialog('open');
	}
	return false;
});
$("#btnApproveSubscriber_sb").click(function(){
	$('#btnApproveSubscriber_sb').prop("disabled", true);
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
				Method: 'approveKYCCashier',
				MSISDN: $("#authNumber_sb").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				cashierids: CIDs,
				cashiertids: CTIDs,
				serialnumber: 0
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$('#dialogApprove_sb').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}
		});
	}else{
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveKYC',
				MSISDN: $("#authNumber_sb").val(),
				terminalid: $("#tid").val(),
				merchantid: $("#mid").val(),
				serialnumber: 0
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$('#dialogApprove_sb').dialog('close');
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}
		});
	}
	$('#btnApproveSubscriber_sb').prop("disabled", false);
});

$('#btnRejectKYC').click(function(){
	$('#dialogDecline_sb').dialog('open');
	return false;
});
$("#btnDeclineSubscriber_sb").click(function(){
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
				MSISDN: $("#authNumber_sb").val(),
				cashierids: CIDs,
				reason: $("#declinedesc_sb").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$("#dialogDecline_sb").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
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
				MSISDN: $("#authNumber_sb").val(),
				reason: $("#declinedesc_sb").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
					$("#pending_acccount_view_sb").dialog('close');
					$("#dialogDecline_sb").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}
		});
	}


});

$('#btnSendbackKYC').click(function(){
	$('#dialogSendBack_sb').dialog('open');
	return false;
});
$("#btnSendBackSubscriber_sb").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType: 'json',
		data: {
			Method: 'sendbackKYC',
			MSISDN: $("#authNumber_sb").val(),
			reason: $("#sendbackdesc_sb").val()
		},success: function(json){
			if(json.ResponseCode == 0){
				$("#accountPending_sb" + $("#authNumber_sb").val()).css({display:'none'});
				$("#pending_acccount_view_sb").dialog('close');
				$("#dialogSendBack_sb").dialog('close');
			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

			$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
			});
		}
	});

});

$("#btnEditPInfo").click(function(){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'inline'});
	$("#btnEditPInfo").css({display:'none'});
	$(".personalInfoDetails").attr('disabled',false);

	$("#pEmail_sb").attr('disabled',false);
});

$("#btnCancelPInfo").click(function(){
	$("#btnUpdatePInfo,#btnCancelPInfo").css({display:'none'});
	$("#btnEditPInfo").css({display:'inline'});
	$(".personalInfoDetails").attr('disabled',true);
});

$("#btnUpdatePInfo").click(function(){
	if($("#pLName_sb").val() == "" || $("#pFName_sb").val() == "" || $("#pIDNumber_sb").val() == "" || $("#pIDDesc_sb").val() == ""	|| $("#pIDExpiry_sb").val() == "" || $("#pNationality_sb").val() == "" || $("#selectedGender").val() == "" || $("#pDOB").val() == "" || $("#pPOB").val() == "" || $("#pCity").val() == ""	|| $("#pRegion").val() == "" || $("#pCountry").val() == ""  ){
		$("<p>All fields with * are required.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}else{
		if($('#corpdateofincorporation').val() == ''){$('#corpdateofincorporation').val('2012-08-17');}
		var params = {
			Method:'updateAccount',
			MSISDN:$("#authNumber_sb").val(),
			ALIAS:$('#aliasName').val(),
			GENDER:$('#selectedGender').val(),
			LASTNAME:$('#pLName_sb').val(),
			MIDDLENAME:$('#pSName').val(),
			FIRSTNAME:$('#pFName_sb').val(),
			EMAIL:$('#pEmail_sb').val(),
			DOB:$('#pDOB').val(),
			IDNUMBER:$('#pIDNumber_sb').val(),
			IDDESC:$('#pIDDesc_sb').val(),
			EXPIRY:$('#pIDExpiry_sb').val(),
			NATIONALITY:$('#pNationality_sb').val(),
			POB:$('#pPOB').val(),
			CITY:$('#pCity').val(),
			REGION:$('#pRegion').val(),
			COUNTRY:$('#pCountry').val(),
			TYPE:$('#selectedType_sb').val(),
			KYC:$('#subKYC').val(),
			ACCOUNTSTATUS:$('#pAccountStatus').val(),
			REFACCOUNT:$('#pRefAccount').val(),
			BUILDING:$('#pLocation').val(),
			STREET:$('#pStreet').val(),
			COMPANY:$('#pCompany').val(),
			PROFESSION:$('#pProfession_sb').val(),
			LOCKED:$('#pLocked').val(),
			ALTNUMBER:$('#pAltNumber').val(),
			CORPDATEOFINCORPORATION:$('#corpdateofincorporation').val(),
			CORPBUSINESSNAME:$('#corpbusinessname_sb').val(),
			CORPTRADELICENSENUMBER:$('#corptradelicensenumber').val(),
			CORPREGISTEREDADDRESS:$('#corpregistredaddress').val(),
			CORPTYPEOFBUSINESS:$('#corptypeofbusiness_sb').val(),
			CORPOWNERSHIPINFO:$('#corpownershipinfo_sb').val(),
			TINNUMBER:$('#pTIN').val()
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
			}
		});
	}
});




</script>