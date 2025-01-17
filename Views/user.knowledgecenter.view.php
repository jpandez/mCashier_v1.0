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
.loading, .ploading, .rloading, .msgloading, .msgrloading, .rxloading, .sdloading, .kctloading, .addloading, .trxloading, .txloading, .rxrloading, .scloading, .trxaloading, .txaloading, .rxaloading, .scaloading, .airbonusaloading, .airbonusloading, .btypeloading, .btypealoaading, .bmsisdnloading, .bmsisdnaloading, .ctypealoaading, .cmsisdnaloading, .ctypeloading, .cmsisdnloading {
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
._d-none{
	display:none;
}
._container{
	width:100%;font-size:20px;
	margin-top: 65px !important;
}
</style>
<div class="_container my-5 mx-2" >
<!--<div align="center">coming soon...</div>-->
<a href="<?php echo $GLOBALS['ROOT']; ?>kc/MCashier card reader compatible list Android.xlsx" target="_blank" class="text-primary">mCashier card reader compatible list Android</a>
<br><a href="<?php echo $GLOBALS['ROOT']; ?>kc/mCashier Error description .xlsx" target="_blank" class="text-primary">mCashier Error description</a>
<br><a href="<?php echo $GLOBALS['ROOT']; ?>kc/190415 mCashier troubleshooting guide.docx" target="_blank" class="text-primary">190415 mCashier troubleshooting guide</a>
<br><a href="<?php echo $GLOBALS['ROOT']; ?>kc/210115 mCashier MERCHANT WEB PORTAL.pdf" target="_blank" class="text-primary">210115 mCashier MERCHANT WEB PORTAL</a>
<br><a href="<?php echo $GLOBALS['ROOT']; ?>kc/210115 mCashier CC WEB PORTAL.pdf" target="_blank" class="text-primary">210115 mCashier CC WEB PORTAL</a>
<table class="_d-none">
	<tr>
		<td>Knowledge Center Topics</td>
		<td align="center">FAQs</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="70%">
			<ol class = "eti-text-green">
				<li>Get Started with mCashier</li>
				<li>mCashier Guide</li>
				<li>Payments, Receipts, and Refunds</li>
				<li>Bank Account and Deposits</li>
				<li>Hardware</li>
				<li>Sales History and Reporting</li>
				<li>Account Settings</li>
				<li>Customer Purchases and Receipts</li>
				<li>Tips and Troubleshooting</li>
				<li>Privacy, Security, and Policy</li>
				<li>Merchant Protection</li>
			</ol>
		</td>
	
		<td border="1px solid black">
			<ol >
				<li>How to sign for the mCashier service</li>
				<li>Fees and Pricing Plans </li>
				<li>Navigate the Sales Statistics</li>
				<li>Deposit Schedule </li>
				<li>Accept Payment Cards Safely</li>
				<li>mCashier Register Guide </li>
				<li>Devices Compatible with Wisepad</li>
				<li>Sign up for mCashier Register </li>
				<li>Self service functionality</li>
				<li>Tips and troubleshooting</li>
			</ol>
		</td>	
	</tr>
</table>
</div>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	var service_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>

<script nonce="<?php echo $_SESSION['nonce'];?>">	
	
	$(document).ready(function(){$("#auditTrailsTabLink a").trigger('click')});
</script>