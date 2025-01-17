<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body>
	<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
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

		._d-none{
			display:none;
		}
		.txt-search {
			width:150px !important;
		}
		.result-list {
			margin-top:10px
		}
		.d-inline{
			display:inline;
		}
	</style>
	<div id="data_loading" class="d-inline">
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


<div id="searchArea" class="searchBox _d-none" align="left">
	<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.SMB.php" method="post">
		<input type="hidden" name="Method" value="SearchList" />
		<!--<input type="hidden" name="Method" value="Search" />-->
		<table class="searchradio" border="1">
			<tr>
				<td><input type="radio" name="rdoSearchOption" checked value="1" value="1" id="mobile_number" /><label for="mobile_number"><?php echo _("MSISDN"); ?></label></td>
				<td><input type="radio" name="rdoSearchOption" value="2" id="nickname" /><label for="nickname"><?php echo _("COMPANY NAME"); ?></label></td>
				<td><input type="radio" name="rdoSearchOption" value="3" id="nicknameMID" /><label for="nicknameMID"><?php echo _("MERCHANT ID"); ?></label></td>
				<td><input type="radio" name="rdoSearchOption" value="4" id="nicknameTID" /><label for="nicknameTID"><?php echo _("TERMINAL ID"); ?></label></td>
				<td><input type="radio" name="rdoSearchOption" value="5" id="contact_number" /><label for="contact_number"><?php echo _("CONTACT NUMBER"); ?></label></td>

				<td class="_d-none"><input type="radio" name="rdoSearchOption" value="3" id="account_id"/><label for="account_id"><?php echo _("ACCOUNT ID"); ?></label></td>
				<td>
					<input type="text" name="txtSearch" id="searchBox" value="" class="txt-search">
					<input type="submit" name="btnSearchSubscriber" id="btnSearchSubscriber" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
			</tr>
		</table>
	</form>


	<?php $searchListResult = $this->data("searchListResult"); ?>
	<?php if(isset($searchListResult->ResponseCode)){ ?>
	<?php if(is_array($searchListResult->Value)){?>
	<div class="result-list">Search Result List</div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="searchListResultTable" width="100%">
		<thead>
			<tr class="ui-widget-header">

				<th><?php echo _("MSISDN"); ?></th>
				<th><?php echo _("MERCHANT ID"); ?></th>
				<th><?php echo _("TERMINAL ID"); ?></th>
				<th><?php echo _("COMPANY NAME"); ?></th>
				<th><?php echo _("TYPE"); ?></th>			
				<th><?php echo _("View Account Details"); ?></th>						
			</tr>
		</thead>
		<tbody>
			<?php $ctr=0; foreach($searchListResult->Value as $t): $ctr++;?>
			<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_<?php echo $t->MSISDN; ?>">

				<td><?php echo $t->ID == $t->MSISDN ? "" : $t->MSISDN; ?></td>
				<td><?php echo $t->MERCHANTID != '0' ? $t->MERCHANTID : ""; ?></td>
				<td><?php echo $t->TERMINALID != '0' ? $t->TERMINALID : ""; ?></td>
				<!--<td><?php echo $t->FIRSTNAME; ?></td>-->
				<td><?php echo $t->NICK; ?></td>
				<td><?php echo $t->TYPE; ?></td>							
				<td>


				<?php if($t->REFERENCEACCOUNT == '0' && $t->MSISDN == $t->ID){ ?>
					<!-- <a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.SMB.php?Method=searchListSubs&txtSearch=<?php echo $t->ID;?>">View Sublist: <?php echo $t->MSISDN; ?></a> -->
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/user.subscriber.search.SMB.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->ID; ?></a>
					<?php } else if( ($t->REFERENCEACCOUNT != '0' && $t->MSISDN == $t->ID) ){ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/user.subscriber.search.SMB.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->ID; ?></a>
					<?php } else if($t->REFERENCEACCOUNT == '0' && $t->MSISDN != $t->ID){ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/user.subscriber.search.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->ID; ?></a>
					<?php } else if($t->REFERENCEACCOUNT != '0' && $t->MSISDN != $t->ID){ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/user.subscriber.search.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->ID; ?></a>
					<?php }else{ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/user.subscriber.search.SMB.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->ID; ?></a>
					<?php } ?>

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

<?php $searchListSubs = $this->data("searchListSubs"); ?>
<?php if(isset($searchListSubs->ResponseCode)){ ?>
<?php if(is_array($searchListSubs->Value)){?>
<div class="result-list">Master-Subs List</div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="searchListResultTable" width="100%">
	<thead>
		<tr class="ui-widget-header">
			<th><?php echo _("ID"); ?></th>
			<th><?php echo _("MSISDN"); ?></th>
			<th><?php echo _("COMPANY NAME"); ?></th>
			<th><?php echo _("TYPE"); ?></th>			
			<th><?php echo _("View Account Details"); ?></th>							
		</tr>
	</thead>
	<tbody>
		<?php $ctr=0; foreach($searchListSubs->Value as $t): $ctr++;?>
		<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_<?php echo $t->MSISDN; ?>">
			<td><?php echo $t->ID; ?></td>
			<td><?php echo $t->MSISDN; ?></td>
			<!--<td><?php echo $t->FIRSTNAME; ?></td>-->
			<td><?php echo $t->NICK; ?></td>
			<td><?php echo $t->TYPE; ?></td>							
			<td>
			<?php if($t->REFERENCEACCOUNT == '0' && $t->MSISDN == $t->ID){ ?>
					<!-- <a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.SMB.php?Method=searchListSubs&txtSearch=<?php echo $t->ID;?>">View Sublist: <?php echo $t->MSISDN; ?></a> -->
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.SMB.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->MSISDN; ?></a>
					<?php } else if( ($t->REFERENCEACCOUNT != '0' && $t->MSISDN == $t->ID) ){ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.SMB.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->MSISDN; ?></a>
					<?php } else if($t->REFERENCEACCOUNT == '0' && $t->MSISDN != $t->ID){ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->MSISDN; ?></a>
					<?php } else if($t->REFERENCEACCOUNT != '0' && $t->MSISDN != $t->ID){ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->MSISDN; ?></a>
					<?php }else{ ?>
					<a class="ahref" href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.search.SMB.php?Method=Search&rdoSearchOption=1&txtSearch=<?php echo $t->MSISDN;?>">View Account: <?php echo $t->MSISDN; ?></a>
					<?php } ?>
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
<?php } 
else {
	echo "<h3>No record found: ". $searchListSubs->Message ."</h3>";
}?>
<?php } ?>


<?php if(isset($account)){ ?>
<div id="SubscriberTab">
	<ul>

		<?php if($this->getRolesConfig('CORPORATE_ACCOUNT_VIEW')){ ?>
		<li id="corpinfoLink"><a href="#corpinfo" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.corptab.php"><?php echo _("Company Information"); ?></a></li>
		<?php } ?>
		<?php if($this->getRolesConfig('PERSONAL_DETAILS_VIEW')){ ?>
		<!--<li id="infoTabLink"><a href="#infoTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.personaltab.php"><?php echo _("Personal Details"); ?></a></li>-->
		<?php } ?>
		<?php if($this->getRolesConfig('ACCOUNT_INFORMATION')){ ?>
		<li id="accountTabLink"><a href="#accountTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.accounttab.php"><?php echo _("Account Information"); ?></a></li>
		<?php } ?>
		<?php if($this->getRolesConfig('STATEMENT_VIEW')){ ?>
		<li id="HistoryTabLink"><a href="#HistoryTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.historytab.php"><?php echo _("Statement");//_("Statement"); ?></a></li>
		<?php } ?>

	</ul>
	<div id="accountTab"></div>
	<div id="corpinfo"></div>
	<div id="infoTab"></div>
	<div id="HistoryTab"></div>

</div>
<?php } ?>
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
<script nonce="<?php echo $_SESSION['nonce'];?>">
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
<script nonce="<?php echo $_SESSION['nonce'];?>">
	$(document).ready(function(){
		oTable = $('#searchListResultTable').dataTable({
			"bJQueryUI": true,
			"bFilter": false,
			"sPaginationType": "two_button"
		});

		var ht = $("#searchArea").css('height');
		ht = ht.replace("px","");
		$("#ifsearch",window.parent.document).css('height',parseInt(ht)+150);
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

$("#searchBox").keydown(function(event) {
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
			type: "POST",
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
<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">   
	<?php if($responseMessage !=null):?>
	$(document).ready(function(){
		$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	});
<?php endif;?>			
</script>

<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">
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
			// $.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
			// 	type:"POST",
			// 	complete:function(res,status){
			// 		window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
		// 		}
		// 	});
		 }, 3000);
		<?php } ?>
	});
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>