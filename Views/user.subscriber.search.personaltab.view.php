<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>

<div class ="ploading"></div>
	<div id="InfoTabHolderArea" class="InfoTabHolder" style="border:0px solid;width:1100px;display:none;">
		<div class="panelButtons" style="margin-bottom:10px;">
		<?php if($_SESSION["EditAccount"] && strtoupper(trim($account->KYC)) != 'APPROVED'){ ?>
			<a href="#" id="btnEditPInfo" class="ui-state-default ui-corner-all ui-button"><?php echo _("edit"); ?></a>
			<a href="#" id="btnUpdatePInfo" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("save"); ?></a>
			<a href="#" id="btnCancelPInfo" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("cancel"); ?></a>
			
			<a href="#" id="btnEditPImage" class="ui-state-default ui-corner-all ui-button"><?php echo _("edit id image"); ?></a>
			<a href="#" id="btnUpdatePImage" class="ui-state-default ui-corner-all ui-button" style="display:none;"><?php echo _("save id image"); ?></a>
		<?php } ?>
		<div align="right" id="btnEditPImageForm" style="display:none;">Image Upload
				<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
					 <input type="file" name="photoimg" id="photoimg" />
				</form>
				<div id='preview'>
				</div>
		</div>
		</div>
			<!--<div align="right"><a href="javascript:idImage();"><?php echo _("Check ID Image"); ?></a></div>-->
			<div align="right"><a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.download.file.php?msisdn=<?php echo isset($account)?$account->MobileNumber:""; ?>"><?php if($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE')){echo _("Check ID Image");} ?></a></div>
		<div class="info_details" style="border:0px solid red;width:350px;margin-top:5px;margin-right:15px;float:left;">
			<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
				<tr><td colspan="2"><?php echo _("Personal information"); ?></td></tr>
				<tr>
					<td colspan="2">
						
					</td>
				</tr>
				<tr><td><?php echo _("last name"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pLName" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->LastName; ?>"></td></tr>
				<tr><td><?php echo _("first name"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pFName" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->FirstName ?>"></td></tr>
				<tr><td><?php echo _("second name"); ?>:</td><td><input type="text" id="pSName" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->MiddleName ?>"></td></tr>
				<tr><td><?php echo _("id number"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pIDNumber" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->ValidID->IDNumber ?>"></td></tr>
				<tr><td><?php echo _("id description"); ?><span style="color:red">*</span> :</td>
				<td><select id="pIDDesc" style="width:100%;" disabled="disabled"></select></td>
				<!--<td><input type="text" id="pIDDesc" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->ValidID->Description ?>"></td>-->
				</tr>
				<tr><td><?php echo _("id expiry date"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pIDExpiry" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->ValidID->Expiry ?>" readonly="true"></td></tr>																														
			</table>
		</div>
		<div class="account_info_details2" style="border:0px solid red;width:350px;margin-top:5px;margin-right:15px;float:left;">
			<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
				<tr><td><?php echo _("nationality"); ?><span style="color:red">*</span> :</td>
				<td><select id="pNationality" style="width:100%;" disabled="disabled"></select></td>
				<!--<td><input type="text" id="pNationality" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->Nationality ?>"></td>-->
				</tr>
				<tr>
					<td><?php echo _("gender"); ?><span style="color:red">*</span> :</td>
					<td>
						<select id="selectedGender" disabled="disabled">
						   <option value="MALE" <?php echo $account==null?"":($account->PersonalInformation->Gender == "MALE"?"selected":"") ?>>MALE</option>
						   <option value="FEMALE" <?php echo $account==null?"":($account->PersonalInformation->Gender == "FEMALE"?"selected":"") ?>>FEMALE</option>
						</select>
					</td>
				</tr>
				<tr><td><?php echo _("date of birth"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pDOB" readonly="true" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->DateOfBirth ?>"></td></tr>
				<tr><td><?php echo _("place of birth"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pPOB" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->BirthPlace ?>"></td></tr>
				<tr><td><?php echo _("company"); ?> :</td><td><input type="text" id="pCompany" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->EmploymentDetails->Company ?>"></td></tr>
				<tr><td><?php echo _("title / position / profession"); ?> :</td>
					<td><select id="pProfession" style="width:100%;" disabled="disabled"></select></td>
					<!--<td><input type="text" id="pProfession" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->EmploymentDetails->Profession ?>"></td>-->
				</tr>
				<tr><td><?php echo _("tin number"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pTinNumber" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->TINNumber ?>"></td></tr>
			</table>
		</div>
		<div class="account_info_details2" style="border:0px solid red;width:350px;margin-top:5px;margin-right:10px;float:left;">
			<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
				<tr><td><?php echo _("building name / location"); ?>:</td><td><input type="text" id="pLocation" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->CurrentAddress->BuildingNumber ?>"></td></tr>
				<tr><td><?php echo _("city / village"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pCity" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->CurrentAddress->CityID ?>"></td></tr>
				<tr><td><?php echo _("street name"); ?><span style="color:red">*</span> :</td><td><input type="text" id="pStreet" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->CurrentAddress->StreetName ?>"></td></tr>
				<tr><td><?php echo _("region"); ?><span style="color:red">*</span> :</td>
				<td><select id="pRegion" style="width:100%;" disabled="disabled"></select></td>
				<!--<td><input type="text" id="pRegion" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->CurrentAddress->RegionID ?>"></td>--></tr>
				<tr><td><?php echo _("country"); ?><span style="color:red">*</span> :</td>
				<td><select id="pCountry" style="width:100%;" disabled="disabled"></select></td>
				<!--<td><input type="text" id="pCountry" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->CurrentAddress->CountryID ?>"></td>-->
				</tr>
				<tr><td><?php echo _("email address"); ?>:</td><td><input type="text" id="pEmail" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->EmailAddress ?>"></td></tr>
				<tr><td><?php echo _("alternate number"); ?>:</td><td><input type="text" id="pAltNumber" disabled="disabled" value="<?php echo $account==null?"":$account->PersonalInformation->AltNumber ?>"></td></tr>
			</table>
		</div>
	</div>
	
<div class="row-fluid" id="divPhotoReg" title="ID Image"></div>	

<!--
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
-->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<!-- start allocate -->
<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').on('change', function()			{ 
			           $("#preview").html('');
			    $("#preview").html('<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
			});
        }); 
</script>
<style>

body
{
font-family:arial;
}
.preview
{
width:100px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}

</style>
<script>
$('.ui-button').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
$(".ui-button").button();

	$("#btnEditPImage").click(function(){
		$(this).hide();
		$('#btnUpdatePImage').show();
		$('#btnEditPImageForm').show();
	});
	
	$("#btnUpdatePImage").click(function(){
		$(this).hide();
		$('#btnEditPImageForm').hide();
		$('#btnEditPImage').show();
	});


	$("#btnEditPInfo").click(function(){
		$('#tblAccount3 tr td input[type=text],select').removeAttr('disabled');
		$(this).hide();
		$('#btnUpdatePInfo').show();
		$('#btnCancelPInfo').show();
	});
		
	$("#btnUpdatePInfo").click(function(){
		$('#tblAccount3 tr td input[type=text],#tblAccount3 tr td select, #selectedType').attr('disabled','disabled');
		$(this).hide();
		$('#btnCancelPInfo').hide();
		$('#btnEditPInfo').show();
	});
	
	$("#btnCancelPInfo").click(function(){
		$('#tblAccount3 tr td input[type=text],#tblAccount3 tr td select, #selectedType').attr('disabled','disabled');
		$(this).hide();
		$('#btnUpdatePInfo').hide();
		$('#btnEditPInfo').show();
	});
	
	$("#btnUpdatePInfo").click(function(){
			var now = new Date();
			
			if($('#corpdateofincorporation').val() == ''){			
				$('#corpdateofincorporation').val('2012-08-17');
			}
			
			var params = {
					Method:'updateAccount',
					MSISDN:window.authMobNumber,
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
					USERID:window.CurrentUser,
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
					TINNUMBER:$('#pTinNumber').val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			
			$('.ploading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.ploading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#btnUpdatePImage").click(function(){
			var now = new Date();
			
			var params = {
					Method:'updateIdIMAGE',
					msisdn:window.authMobNumber,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};
			
			$('.ploading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.ploading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	
	region();
	function region(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR51+Sma/ekvy49dYDKIkPHILWqu2taEAYwJnsknXhb1JEeiRwPfSvQQB9/jSSdhK+s7g==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#pRegion').find('option').remove();
					for(x in result.value){
						var selected = "";
						if(result.value[x].DESCRIPTION == window.Region){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#pRegion').html(listitem);
					$('#pRegion').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	searchIdDescription();
	function searchIdDescription(){
		var params = {
				Method:'queryGlobal',
				query: '4AkaOJGv/zrVZBP0IcCju/qSv+PtvFkzXP0OF87YgPLcTXo/VFY9SCS3n2T3BsxHh1iauNqTqGImNWWz4X7YmsHsr1j4E8UjURsnlIDuhtY=',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#pIDDesc').find('option').remove();
					for(x in result.value){
						var selected = "";
						if(result.value[x].DESCRIPTION == window.IDDescription){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
						
					}
					$('#pIDDesc').html(listitem);
					$('#pIDDesc').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	SearchNationality();
	function SearchNationality(){
		var params = {
				Method:'queryGlobal',
				query: 'VAx6TD1cdLGY0gtdmqoy1Ww7qORzV+pK/njFL3qi3RnjueRPSi4wDCPTJnSJdezn1AS5RxRMK32Gj/IDS2EiRzftsFeC5PdooPdZcmXfcVA=',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem1 = "";
					var listitem2 = "";
					$('#pNationality').find('option').remove();
					$('#pCountry').find('option').remove();
					for(x in result.value){
						var selected1 = "";
						if(result.value[x].COUNTRY == window.nationality){
							selected1 = "selected";
						}
						var selected2 = "";
						if(result.value[x].COUNTRY == window.country){
							selected2 = "selected";
						}
						listitem1 += '<option ' + selected1 + '>' + result.value[x].COUNTRY + '</option>';
						listitem2 += '<option ' + selected2 + '>' + result.value[x].COUNTRY + '</option>';
						
					}
					$('#pNationality').html(listitem1);
					$('#pNationality').click();
					$('#pCountry').html(listitem2);
					$('#pCountry').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	searchProfession();
	function searchProfession(){
		var params = {
				Method:'queryGlobal',
				query: 'g2ESO1mTHOPEGjb6OSR51+8Y/cSaFpWOnMxaNuQn1WGIad0FzRV8oFVBVvO8RD1KxF9htfRKEiCys2WCVc49jg==',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#pProfession').find('option').remove();
					for(x in result.value){
						
						var selected = "";
						if(result.value[x].DESCRIPTION == window.profession){
							selected = "selected";
						}
						listitem += '<option ' + selected + '>' + result.value[x].DESCRIPTION + '</option>';
					}
					$('#pProfession').html(listitem);
					$('#pProfession').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
</script>

<script>
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";	
</script>
<script>
$(document).ready(function(){
	var ht = $("#InfoTabHolderArea").css('height');
	ht = ht.replace("px","");
	$("#ifsearch",window.parent.document).css('height',parseInt(ht)+420);
	
	$('#divPhotoReg').dialog({
			autoOpen: false,
			width: 1000,
			position: 'top',
			draggable: true,
			resizable: true,
			modal:true
		});	
});
// Prevent the backspace key from navigating back.
	$(document).unbind('keydown').bind('keydown', function (event) {
		var doPrevent = false;
		if (event.keyCode === 8) {
			var d = event.srcElement || event.target;
			if ((d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'TEXT') 
				 || d.tagName.toUpperCase() === 'TEXTAREA' || (d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'PASSWORD')) {
				doPrevent = d.readOnly || d.disabled;
			}
			else {
				doPrevent = true;
			}
		}
		if (doPrevent) {
			event.preventDefault();
		}
	});
	
function idImage(){

	var params = {
				Method:'getIdIMAGE',
				msisdn:$("#authNumber").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			};

	$.ajax({url:service_url,
			type:"post", 
			dataType:"html",
			data:params,
			success: function(html){
															
					$("#divPhotoReg").html(html);
					$('#divPhotoReg').dialog('open');
					
			}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
}

var download_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.download.file.php";
function idImage1(){
	var params = {
		Method:'getIdIMAGE',
		msisdn:$("#authNumber").val(),
		FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
	};
	
		$("#divPhotoReg").load(download_url,params,function(){
		});
	
};

</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){			
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>

$("#InfoTabHolderArea").fadeIn(700);	
</script>

