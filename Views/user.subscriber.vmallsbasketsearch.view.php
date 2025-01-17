<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<style type="text/css">
.sloading {
	height:10px;
	width:32px;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.loading, .ploading, .rloading, .revloading {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
.transloading, .reversalloading {
	height:25px;
	width:81px;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
.lockloading, .allocloading, .deallocload, .allocloadingEVD, .deallocloadEVD, .allocloadingB2W {
	height:10px;
	width:32px;
	float:right;margin-right:50%;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.ui-button{margin-right:5px;}
</style>
<div id="data_loading" style="display:inline;">
	<table width = "100%">
		<tr>
			<td align = "center">
				<img src = "<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" alt = "Loading"/>
			</td>
		</tr>
	</table>
</div>

<div  class="floating-menu"><h3>
	<?php if($account != null) { ?>
	<span>Company Name : <?php echo $account==null?"":$account->CorpInformation->businessname ?>  NAME : <?php echo $account->PersonalInformation->LastName . " , " . $account->PersonalInformation->FirstName; ?>  </span> 
	<span><?php echo _("MSISDN"); ?> :  <?php echo $account->MobileNumber; ?>  </span>
	<!--<span><?php echo _("account type"); ?>: [<?php echo $account->AccountTypeDescription; ?>]  </span>
	<span><?php echo _("current amount"); ?> : [<?php echo $account->CurrentStock; ?>]  </span>
	-->
	<?php } ?></h3>
</div>

		
	<div id="searchArea" class="searchBox" align="left"  style="display:none;">
	<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.vmallsbasketsearch.php" method="post">
		<input type="hidden" name="Method" value="SearchTransList" />
		<table cellspacing="5" class="tablet" border="0">
		   <td style="width:150px">
				<select id="type" style="width:100%;font-size:1.2em;" name="type" onchange="typeOnChange()">
					<option selected disabled >-----Please select-----</option>
					<option value="ALL" <?php if($_POST['type']=='ALL'){ echo 'selected="selected"';} ?>>ALL</option>
					<option value="MSISDN" <?php if($_POST['type']=='MSISDN'){ echo 'selected="selected"';} ?>>Mobile Number</option>
					<option value="VMID" <?php if($_POST['type']=='VMID'){ echo 'selected="selected"';} ?>>VMID</option>
					<option value="BASKETID" <?php if($_POST['type']=='BASKETID'){ echo 'selected="selected"';} ?>>Basket ID</option>
				</select>
			</td>

			<td style="width:150px">
				<input type="text" name="txtSearch" id="searchBox" value="<?php echo htmlentities($_REQUEST['txtSearch'], ENT_QUOTES);?>" style="width:150px;" onchange="typeOnChange()">
			</td> 

			
		   <td style="width:50px"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
		   <td style="width:120px;"><input type="text" id="TransHdatefrom" name="TransHdatefrom" style="width:100%;" value="<?php echo htmlentities($_REQUEST['TransHdatefrom'], ENT_QUOTES);?>" readonly="true"/></td>
		   <td style="width:30px"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
		   <td style="width:120px"><input type="text" id="TransHdateto" name="TransHdateto" style="width:100%;" value="<?php echo htmlentities($_REQUEST['TransHdateto'], ENT_QUOTES);?>" readonly="true"/></td>
		   <td>
				<input type="submit" name="btnSearchSubscriber" id="btnSearchSubscriber" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
				<div class="sloading"></div>
			</td>
	   </table>
   </form>
   
   
   <?php $searchListResult = $this->data("searchListResult"); ?>
	<?php if(isset($searchListResult->ResponseCode)){ ?>
		<?php if(is_array($searchListResult->Value)){?>
			<div style="margin-top:10px";>Search Result List</div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="searchListResultTable" width="100%">
				<thead>
				<tr class="ui-widget-header">
					
					<th><?php echo _("TRANSACTION NO"); ?></th>
					<th><?php echo _("MSISDN"); ?></th>
					<th><?php echo _("SHOPPED ITEMS"); ?></th>			
					<th><?php echo _("TIMESTAMP"); ?></th>	
					<th><?php echo _("PAYMENT METHOD"); ?></th>			
					<th><?php echo _("VMID"); ?></th>	
					<th><?php echo _("NET PRICE"); ?></th>			
					<th><?php echo _("GROSS PRICE"); ?></th>
					<th><?php echo _("View Details"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($searchListResult->Value as $t): $ctr++;?>
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_<?php echo $t->MSISDN; ?>">
							
							<td><?php echo $t->TRANSACTIONNO; ?></td>
							<td><?php echo $t->MSISDN; ?></td>
							<td><?php echo $t->SHOPPEDITEMSNUMBER; ?></td>
							<td><?php echo $t->TIMESTAMP; ?></td>
							<td><?php echo $t->PAYMENTMETHOD; ?></td>
							<td><?php echo $t->VMID; ?></td>
							<td><?php echo $t->NETPRICE; ?></td>
							<td><?php echo $t->GROSSPRICE; ?></td>							
							<td>
								<?php ?>
									<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.vmallsbasketsearch.php?Method=Search&txtSearch=<?php echo $t->TRANSACTIONNO;?>">View Details</a>
								<?php  ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php } 
			else {
				echo "<h3>No record found: ". $searchListResult->Message ."</h3>";
			}?>
	<?php } ?>
	
	
	<?php if(isset($searchResult->ResponseCode)){ ?>
		<div style="width:100%;">
		<?php if($searchResult->ResponseCode !=  0){ echo "<h3>No record found: ". $searchResult->Message ."</h3>"; }
			else{
		  ?>

		  <div>        
			<table cellpadding="0" cellspacing="0" border="0" class="tablet" id="tblReversal" width="100%">
			  <tr>
				<td><?php echo _('Transaction Date'); ?></td>
				<td><input style="width:80%" type="text" id="TIMESTAMP" value="<?php echo $searchResult->Value->timestamp; ?>" disabled="disabled" /></td>
				<td><?php echo _('Basket ID'); ?></td>
				<td><input style="width:80%" type="text" id="BASKETID" value="<?php echo $searchResult->Value->basketID; ?>" disabled="disabled" /></td>
				 <td><?php echo _('Delivery Date'); ?></td>
				<td><input style="width:80%" type="text" id="DELIVERYTIMESTAMP" value="<?php echo $searchResult->Value->deliveryTimestamp; ?>" disabled="disabled" /></td>
			  </tr>
			  <tr>
				<td><?php echo _('Phone Number'); ?></td>
				<td><input style="width:80%" type="text" id="MSISDN" value="<?php echo $searchResult->Value->msisdn; ?>" disabled="disabled" /></td>
				<td><?php echo _('Delivery Address'); ?></td>
				<td><input style="width:80%" type="text" id="DELIVERYADDRESS" value="<?php echo $searchResult->Value->deliveryAddress ?>" disabled="disabled" /></td>
				<td><?php echo _('Special Instructions'); ?></td>
				<td><input style="width:80%" type="text" id="SPECIALINSTRUCTIONS" value="<?php echo $searchResult->Value->specialInstructions; ?>" disabled="disabled" /></td>                              
			  </tr>
			  <tr>
			  <td><?php echo _('Gross Amount'); ?></td>
				<td><input style="width:80%" type="text" id="GROSSAMOUNT" value="<?php echo $searchResult->Value->grossPrice; ?>" disabled="disabled" /></td>  
				<td><?php echo _('Net Amount'); ?></td>
				<td><input style="width:80%" type="text" id="NETAMOUNT" value="<?php echo $searchResult->Value->netPrice; ?>" disabled="disabled" /></td>
				<td><?php echo _('Payment Method'); ?></td>
				<td><input style="width:80%" type="text" id="PAYMENT" value="<?php echo $searchResult->Value->paymentMethod; ?>" disabled="disabled" /></td>                                    
			  </tr>
			</table>
			
			
			<?php if(is_array($searchResult->Value->shoppedItems)){?>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="searchListResultTable" width="100%">
				<thead>
					<tr>    							
						<th><?php echo _('PRODUCT CODE');?></th>
						<th><?php echo _('PRODUCT NAME');?></th>
						<th><?php echo _('QUANTITY');?></th>
						<th><?php echo _('PRICE');?></th>	
						<th><?php echo _('PRODUCT OWNER');?></th>
						<th><?php echo _('DELIVERY STATUS');?></th>							
					</tr>
				</thead>
				<tbody>
					<?php foreach($searchResult->Value->shoppedItems as $t){ ?>    
					<tr class="odd gradeX">
						<td><?php echo $t->ProductCode; ?></td>
						<td><?php echo $t->ProductName; ?></td>
						<td><?php echo $t->Quantity; ?></td>
						<td><?php echo $t->Price; ?></td>
						<td><?php echo $t->ProductOwner; ?></td>
						<td><?php echo $t->DeliveryStatus; ?></td>
					</tr>						
					<?php } ?>
				</tbody>
				</table>
		  
			<?php } ?>
		  </div>
		  <?php } ?>
		</div>
	<?php }?>
 
	</div>
</body>

<!-- end ui-dialog lock -->


<link rel="icon" type="image/ico" href="<?php echo $GLOBALS['VIEW_PATH'];?>images/etisalat.ico" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/datatables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/buttons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/errors.css" rel="stylesheet" type="text/css" />
<!-- <link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
	
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-ui-1.8.18.custom.min.js"></script> -->

<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/smoothness/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.3.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.datatables.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.visualize.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/notes.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form-validation-and-hints.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.selectskin.js"></script>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form.js"></script>
<script>
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
	var global_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearch.php";
	var global_search_refid_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearchrefid.php";
	var reversal_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.reversalresult.php";
	window.authMobNumber = "<?php echo $account==null?"":$account->MobileNumber ?>";
	window.imgPath = "<?php echo $GLOBALS["VIEW_PATH"]?>";
	window.CurrentUser = "<?php echo $currentUser; ?>";
	window.AccountType = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->AccountType;
                            } ?>";
	window.Region = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->PersonalInformation->CurrentAddress->RegionID;
                            } ?>";
	window.IDDescription = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->PersonalInformation->ValidID->Description;
                            } ?>";
	window.nationality = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->PersonalInformation->Nationality;
                            } ?>";
	window.country = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->PersonalInformation->CurrentAddress->CountryID;
                            } ?>";
	window.profession = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->PersonalInformation->EmploymentDetails->Profession;
                            } ?>";
	window.businesstype = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->CorpInformation->typeofbusiness;
                            } ?>";
	window.onboardedby = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->CorpInformation->onboardedby;
                            } ?>";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script>
$(document).ready(function(){
	oTable = $('#searchListResultTable').dataTable({
			"bJQueryUI": true,
			"bFilter": false,
			"sPaginationType": "two_button"
		});

	var ht = $("#searchArea").css('height');
	ht = ht.replace("px","");
	$("#ifsearch2",window.parent.document).css('height',parseInt(ht)+200);
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
	
	//disables text field when selected All
	function typeOnChange(){
		var selectedType = $('#type').val();
			
		if ((selectedType == 'ALL')||(selectedType == 'DEFAULT')){
			$("#searchBox").attr('disabled','disabled');
			$("#searchBox").val('');
		} else if((selectedType == 'MSISDN')||(selectedType == 'BASKETID')){
			$("#searchBox").removeAttr('disabled');
		} else {
			$("#searchBox").removeAttr('disabled');
		}
	} 
	


	
	
/*	$("#searchBox").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode == 86 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
	}); */
	
	$("#allocAMNT").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode == 86 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
	});
	//loadAccountType();
	function loadAccountType(){
        var params = {Method:'getAccountType',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
        $.ajax({
           url:service_url,
           success:function(result,status){
               var listitem = ""
               $('#selectedType').find('option').remove();                                      
                for(var i = 0; i < result.value.length; i++)
                {            
                	var selected = "";
                    if(result.value[i].ACCOUNTTYPE == window.AccountType){
                        selected = "selected";
                    }
                   
                    listitem += '<option value="'+ result.value[i].ACCOUNTTYPE +'"' + selected +'>' + result.value[i].DESCRIPTION + '</option>';
                                                
                }
                
                $('#selectedType').html(listitem);               
                $('#selectedType').click();
              
           },
           dataType:"JSON",
           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
        });       
	}

		
</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>			
</script>

<script type="text/javascript">
$(document).ready(function(){
 $("#SubscriberTab ul li a").click(function(){
  
  var url = $(this).attr('url');
  var div = $(this).attr('href');
  $($(this).attr('href')).load(url);
  /* if( $(div).is(':empty') ){
	$($(this).attr('href')).load(url);
  } */
  
 });
});

$("#data_loading").css('display','none');
$("#searchArea").fadeIn(700);

<?php if($account != null) { ?>
$(document).ready(function(){$("#corpinfoLink a").trigger('click')});
<?php } ?>

//window.pagetoken = "<?php echo $_SESSION['pagetoken']; ?>";
$(document).ready(function(){
	$("#btnSearchSubscriber").click(function(){
		
	});
	<?php if(isset($searchListResult->ResponseCode)){ ?>
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	setTimeout(function(){
		$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
		});
	}, 3000);
	<?php } ?>
});
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>