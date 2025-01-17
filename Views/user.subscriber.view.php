<?php require_once("views.config.properties.php"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>

<div class="SubscriberDetails mt-5">
	<div id="tabs">
		<ul >
			<?php if($this->getRolesConfig('SEARCH_ACCOUNT_&_VIEW')){ ?>
				<!-- <li id="searchAccountTabLink"><a href="#searchAccountTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.iframe.php"><?php echo _("Search account"); ?></a></li> -->
			<?php } ?>
			<?php if($this->getRolesConfig('GLOBAL_SEARCH_VIEW')){ ?>
				<li id="GlobalSearchTabLink"><a href="#GlobalSearchTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearchview.php"><?php echo _("Global search"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('REGISTER_ACCOUNT')){ ?>
				<!-- <li id="RegisterAccountTabLink"><a href="#RegisterAccountTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.register.iframe.php"><?php echo _("Register account"); ?></a></li> -->
				<li id="FormsTabLink"><a href="#FormsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.register.forms.php"><?php echo _("Forms"); ?></a></li>
			<?php } ?>
<!-- this is for smb registration -->
			<?php if($this->getRolesConfig('SEARCH_SMB_ACCOUNT_&_VIEW')){ ?>
				<li id="searchSMBAccountTabLink"><a href="#searchSMBAccountTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.SMB.iframe.php"><?php echo _("Search account"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('SMB_REGISTER_ACCOUNT')){ ?>
				<li id="RegisterSMBAccountTabLink"><a href="#RegisterSMBAccountTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.register.SMB.iframe.php"><?php echo _("SMB - Register account"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('CASH_REVERSAL_REQUEST')){ ?>
				<li id="ReversalTabLink"><a href="#ReversalTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.reversalsearch.php"><?php echo _("Cash Reversal"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('RFNDVOID_REQUEST')){ ?>
				<!-- <li id="RfndVoidTabLink"><a href="#RfndVoidTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.refundsearch.php"><?php echo _("Refund/Void"); ?></a></li> -->
			<?php } ?>
<!-- 			<?php if($this->getRolesConfig('')){ ?>
				<li id="BasketSearchTabLink"><a href="#BasketSearchTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.vmallsbasketsearch.php"><?php echo _("Vmalls basket search"); ?></a></li>
			<?php } ?> -->
		</ul>
		<div id="searchAccountTab"></div>
		<div id="RegisterAccountTab"></div>
<!-- for smb registration -->
		<div id="searchSMBAccountTab"></div>
		<div id="RegisterSMBAccountTab"></div>
		<div id="FormsTab"></div>
		<div id="GlobalSearchTab"></div>
		<div id="ReversalTab"></div>
		<div id="RfndVoidTab"></div>
		<div id="BasketSearchTab"></div>
	</div>
</div>

<!-- end ui-dialog lock -->

<script nonce="<?php echo $_SESSION['nonce'];?>">
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
	var global_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearch.php";
	var global_search_refid_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearchrefid.php";
	var reversal_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.reversalresult.php";
	var refund_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.refundresult.php";
	var vmallsbasket_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.vmallsbasketresult.php";
	
	window.authMobNumber = "<?php echo $account==null?"":$account->MobileNumber ?>";
	window.imgPath = "<?php echo $GLOBALS["VIEW_PATH"]?>";
	window.CurrentUser = "<?php echo $currentUser; ?>";
	window.AccountType = "<?php if($account==null) {                                 
                                 echo null;                                
                            }else{ 
                               echo $account->AccountType;
                            } ?>";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	
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

	
	<?php 
	    if(isset($_REQUEST['Method'])){
	        switch($_REQUEST["Method"]){
	        	case "Register":
					echo "$('#tabs').tabs({ selected: 1 });";
				break;
	        }
	} ?>
//$(document).ready(function(){$("#BasketSearchTabLink a").trigger('click')});
$(document).ready(function(){$("#searchSMBAccountTabLink a").trigger('click')});


</script>

