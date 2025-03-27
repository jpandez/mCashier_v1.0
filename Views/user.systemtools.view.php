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
</style>
<div class="systemsettings mt-5">
	<div id="tabs">
		<ul>
			<?php if($this->getRolesConfig('GENERATE_KSN')){ ?>	
				<li id="generateKsnTabLink"><a href="#generateKsnTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemtools.generateksn.php"><?php echo _("Generate KSN"); ?></a></li>
			<?php } ?>
		</ul>
		<div id="generateKsnTab"></div>
	</div>
</div>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	var service_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>

<script nonce="<?php echo $_SESSION['nonce'];?>">	
	
	$(document).ready(function(){$("#generateKsnTabLink a").trigger('click')});
</script>