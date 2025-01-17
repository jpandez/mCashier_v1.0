<?php require_once("views.config.properties.php"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<?php ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.sloading, .graphloading {
	height:10px;
	width:32px;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.loading, .ploading, .rloading {
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
.lockloading, .allocloading, .deallocload {
	height:10px;
	width:32px;
	float:right;margin-right:50%;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.ui-button{margin-right:5px;}
</style>
<div class="systemsettings mt-5">
	<div id="tabs">
		<ul>
			<?php if($this->getRolesConfig('FLOUS_DAILY_SUMMARY')){ ?>
				<li id="summaryTabLink"><a href="#summaryTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.summary.iframe.php"><?php echo _("Summary"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('FLOUS_SUBSCRIBERS')){ ?>
				<li id="subscribersRTabLink"><a href="#subscribersRTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.subscribers.iframe.php"><?php echo _("Subscribers"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('CURRENT_ACCOUNT_SUMMARY')){ ?>
				<li id="accountSumTabLink"><a href="#accountSumTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.accountsummary.iframe.php"><?php echo _("Account Summary"); ?></a></li>
			<?php } ?>
			
			
			
			<?php if($this->getRolesConfig('REGISTERED_MERCHANTS_REPORT')){ ?>
				<li id="regMerchantsTabLink"><a href="#regMerchantsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.registeredmerchants.iframe.php"><?php echo _("Registered Merchants"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('REGISTERED_MERCHANTS_REPORT')){ ?>
				<li id="regMerchants30TabLink"><a href="#regMerchants30Tab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.registeredmerchants30.iframe.php"><?php echo _("30 Days Active"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('REGISTERED_MERCHANTS_REPORT')){ ?>
				<li id="regMerchants90TabLink"><a href="#regMerchants90Tab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.registeredmerchants90.iframe.php"><?php echo _("90 Days Active"); ?></a></li>
			<?php } ?>
			
			<!-- <?php if($this->getRolesConfig('REGISTERED_MERCHANTS_REPORT')){ ?>
				<li id="regInactive30TabLink"><a href="#regInactive30Tab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.inactivemerchants30.iframe.php"><?php echo _("30 Days Inactive"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('REGISTERED_MERCHANTS_REPORT')){ ?>
				<li id="regInactive90TabLink"><a href="#regInactive90Tab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.inactivemerchants90.iframe.php"><?php echo _("90 Days Inactive"); ?></a></li>
			<?php } ?> -->
			
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY')){ ?>
				<li id="transactionSummaryreportTabLink"><a href="#transactionSummaryreportTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.transactionsummaryreport.iframe.php"><?php echo _("Total Transactions"); ?></a></li>
			<?php } ?>
			
			
			
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY')){ ?>
				<li id="transHistoryTabLink"><a href="#transHistoryTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.transactionhistory.iframe.php"><?php echo _("Transaction History"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('TRANSACTION_REPORTS')){ ?>	
				<li id="transReportsTabLink"><a href="#transReportsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.transactionreports.iframe.php"><?php echo _("Sales Report"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('TRANSACTION_REPORTS1')){ ?>	
				<li id="graphicalReportsLink"><a href="#graphicalReports" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.graphicalreports.php"><?php echo _("Graphical Reports"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY1')){ ?>
				<li id="transFailedTabLink"><a href="#transFailedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.transactionfailed.iframe.php"><?php echo _("Transaction Failed"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY1')){ ?>
				<li id="transMposTabLink"><a href="#transMposTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.transactionmpos.iframe.php"><?php echo _("Transaction mCashier"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY')){ ?>
				<li id="mposRevenueTabLink"><a href="#mposRevenueTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.mposrevenuereport.iframe.php"><?php echo _("Detailed Revenue"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY')){ ?>
				<li id="smposRevenueTabLink"><a href="#smposRevenueTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.smposrevenuereport.iframe.php"><?php echo _("Summary Revenue"); ?></a></li>
			<?php } ?>
				
			<?php if($this->getRolesConfig('TRANSACTION_HISTORY')){ ?>
				<li id="mercRevenueTabLink"><a href="#mercRevenueTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.mercrevenuereport.iframe.php"><?php echo _("Merchant Revenue Report"); ?></a></li>
			<?php } ?>
			
			<?php if ($_SESSION["currentUserLevel"] == 'ADMIN') { ?>
				<li id="aramexEIDReportTabLink"><a href="#aramexEIDReportTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.aramexeidreport.iframe.php"><?php echo _("Aramex EID Report"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_TOP_MERCHANT_REPORT')){ ?>
				<li id="topMerchantTabLink"><a href="#topMerchantTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.topMerchant.iframe.php"><?php echo _("Top 5 Merchant"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_PENDING_SUMMARY_REPORT')){ ?>
				<li id="pendingSummaryTabLink"><a href="#pendingSummaryTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.pendingSummary.iframe.php"><?php echo _("Pending Account Summary"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_PACKAGES_SUMMARY_REPORT')){ ?>
				<li id="packagesSummaryTabLink"><a href="#packagesSummaryTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.packagesSummary.iframe.php"><?php echo _("Packages Summary"); ?></a></li>
			<?php } ?>
			
		</ul>
		<div id="summaryTab"  <?php echo ($this->getRolesConfig('FLOUS_DAILY_SUMMARY')) ? '' : 'class="d-none"'; ?> ></div>
		<div id="regMerchantsTab"></div>
		<div id="regMerchants30Tab"></div>
		<div id="regMerchants90Tab"></div>
		<!-- <div id="regInactive30Tab"></div>
		<div id="regInactive90Tab"></div> -->
		<div id="transactionSummaryreportTab"></div>
		
		<div id="subscribersRTab"></div>
		<div id="accountSumTab"></div>
		<div id="transHistoryTab"></div>
		<div id="transReportsTab"></div>
		<div id="graphicalReports"></div>
		<div id="transFailedTab"></div>
		<div id="transMposTab"></div>
		<div id="mposRevenueTab"></div>
		<div id="smposRevenueTab"></div>
		<div id="mercRevenueTab"></div>
		
		<div id="aramexEIDReportTab"></div>
		<div id="topMerchantTab"></div>
		<div id="pendingSummaryTab"></div>
		<div id="packagesSummaryTab"></div>
	</div>
</div>

<script nonce="<?php echo $_SESSION['nonce'];?>">
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
	var global_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearch.php";
	var trans_logs = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.reports.translogs.php";
	window.authMobNumber = "<?php echo $account==null?"":$account->MobileNumber ?>";
	window.imgPath = "<?php echo $GLOBALS["VIEW_PATH"]?>";
	window.CurrentUser = "<?php echo $currentUser; ?>";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">
  <?php 
        if(isset($_REQUEST['Method'])){
            switch($_REQUEST["Method"]){
            	case "SubscriberList":
					echo "$('#tabs').tabs({ selected: 1 });";
				break;
            	case "TransactionHistory":
					echo "$('#tabs').tabs({ selected: 3 });";
				break;
				case "TransactionReports":
					echo "$('#tabs').tabs({ selected: 4 });";
				break;
				case "TransactionFailed":
					echo "$('#tabs').tabs({ selected: 5 });";
				break;
            }
    } ?>
</script>
<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">
	
	$(function(){
		//$("#summaryTabLink").trigger('click');
	});
	
	$(document).ready(function(){$("#regMerchantsTabLink a").trigger('click')});
</script>


