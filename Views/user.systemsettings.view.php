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
			<?php if($this->getRolesConfig('VIEW_AUDIT_TRAILS')){ ?>	
				<li id="auditTrailsTabLink"><a href="#auditTrailsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.audittrailtab.php"><?php echo _("Audit Trails"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_AML_SETTINGS')){ ?>	
				<li id="amlSettingsTabLink"><a href="#amlSettingsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.amlsettings.php"><?php echo _("AML Settings"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_KEY_ALLOWED_MSISDN_TYPE_CONFIGURED')){ ?>	
				<li id="keyAllowedTabLink"><a href="#keyAllowedTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.keyallowed.php"><?php echo _("Key Allowed"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_AIR_BONUS_TOPUP_CONFIGURED')){ ?>	
				<li id="airBonusTopupTabLink"><a href="#airBonusTopupTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.airbonustopup.php"><?php echo _("Air Bonus"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_BONUS_MSISDN_TYPE_CONFIGURED')){ ?>	
				<li id="bonusTabLink"><a href="#bonusTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.bonus.php"><?php echo _("Bonus"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_BONUS_AIRTIME_MSISDN_TYPE_CONFIGURED')){ ?>	
				<li id="bonusTabLink"><a href="#bonusairtimeTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.bonusairtime.php"><?php echo _("Bonus Airtime"); ?></a></li>
			<?php } ?>
			
			<?php if($this->getRolesConfig('VIEW_COMMISSION_MSISDN_TYPE_CONFIGURED')){ ?>	
				<li id="commissionsTabLink"><a href="#commissionsTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.commissions.php"><?php echo _("Commissions"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_MESSAGES_CONFIGURED')){ ?>	
				<li id="messagesTabLink"><a href="#messagesTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.messages.php"><?php echo _("Messages"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_KEY_COST_CHARGES_CONFIGURED')){ ?>	
				<li id="keycosttypeTabLink"><a href="#keycosttypeTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.keycosttype.php"><?php echo _("Key Costs"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_MPOS_ITEM_LIST')){ ?>	
				<li id="mposTabLink"><a href="#mposTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.mpositem.iframe.php"><?php echo _("mPOS Items"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_MPOS_CONFIG')){ ?>	
				<li id="mposTabLink"><a href="#mposconfigTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.mposconfig.php"><?php echo _("mPOS Config"); ?></a></li>
			<?php } ?>
			<?php if($this->getRolesConfig('VIEW_SYSTEM_INFO_CONFIGURED')){ ?>
				<li id="transceiverTabLink"><a href="#transceiverTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.transceiver.php"><?php echo _("Transceiver"); ?></a></li>
				
				<!-- <li id="transmitterTabLink"><a href="#transmitterTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.transmitter.php"><?php echo _("Transmitter"); ?></a></li>
				<li id="receiverTabLink"><a href="#receiverTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.receiver.php"><?php echo _("Receiver"); ?></a></li> -->
				<li id="serverconfigTabLink"><a href="#serverconfigTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.serverconfig.php"><?php echo _("Server Config"); ?></a></li>
				<li id="airConfigTabLink"><a href="#airConfigTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.airconfig.php"><?php echo _("Air Config"); ?></a></li>
				<li id="systemInfoTabLink"><a href="#systemInfoTab" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.systeminfo.php"><?php echo _("System Info"); ?></a></li>
			<?php } ?>
		</ul>
		<div id="auditTrailsTab"></div>
		<div id="amlSettingsTab"></div>
		<div id="keyAllowedTab"></div>
		<div id="systemInfoTab"></div>
		<div id="airConfigTab"></div>
		<div id="airBonusTopupTab"></div>
		<div id="bonusTab"></div>
		<div id="bonusairtimeTab"></div>
		<div id="commissionsTab"></div>
		<div id="messagesTab"></div>
		<div id="keycosttypeTab"></div>
		<div id="mposTab"></div>
		<div id="mposconfigTab"></div>
		<div id="transceiverTab"></div>
		<div id="transmitterTab"></div>
		<div id="receiverTab"></div>
		<div id="serverconfigTab"></div>
	</div>
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