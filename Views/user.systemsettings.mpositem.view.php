<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $roles = $this->data("roles"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->Value:null):null;?>

<body style="background-color:white;background-image:none;">
<style type="text/css">
.sloading {
	height:10px;
	width:32px;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.loading, .ploading, .rloading, .auloading, .rsloading  {
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
.lockloading, .allocloading, .deallocload, .pwloading {
	height:10px;
	width:32px;
	float:right;margin-right:50%;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/loading.gif") no-repeat;
	display:none;
}
.ui-button{margin-right:5px;}
</style>
<div id="searchBoxArea" class="searchBox" style="display:none;">
	<div id="radiosearch">
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.systemsettings.mpositem.php" method="post">
			<input type="hidden" name="Method" value="SearchList" />
			<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
			<input type="submit" name="btnUserSearch" value="<?php echo _("View all mPOS items"); ?>" class="ui-state-default ui-corner-all ui-button" id="btnUserSearch">
			<input type="button" name="btnUserSearch" value="<?php echo _("Add mPOS items"); ?>" class="ui-state-default ui-corner-all ui-button" id="btnAddMpos">
				<div class="sloading"></div></td>
		
		</form>	
		
	</div>
	

	
	<?php $searchListResult = $this->data("searchListResult"); ?>
	<?php if(isset($searchListResult->ResponseCode)){ ?>
		<?php if(is_array($searchListResult->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="searchListResultTable" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("ID"); ?></th>
					<th><?php echo _("ITEM NAME"); ?></th>
					<th><?php echo _("ITEM CODE"); ?></th>
					<th><?php echo _("UNIT CODE"); ?></th>
					<th><?php echo _("UNIT"); ?></th>
					<th><?php echo _("PRICE PER UNIT"); ?></th>
					<th><?php echo _("SUBVENTION"); ?></th>					
					<th><?php echo _("BARCODE"); ?></th>	
					<th><?php echo _("UPDATE BY"); ?></th>	
					<th><?php echo _("UPDATE DATE"); ?></th>	
					<th><?php echo _("View Item Details"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($searchListResult->Value as $t): $ctr++;?>
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_<?php echo $t->MSISDN; ?>">
							<td><?php echo $t->ID; ?></td>
							<td><?php echo $t->ITEMNAME; ?></td>
							<td><?php echo $t->ITEMCODE; ?></td>
							<td><?php echo $t->UNITCODE; ?></td>
							<td><?php echo $t->UNIT; ?></td>
							<td><?php echo $t->PRICEPERUNIT; ?></td>										
							<td><?php echo $t->SUBVENTION; ?></td>
							<td><?php echo $t->BARCODE; ?></td>
							<td><?php echo $t->UPDATEBY; ?></td>
							<td><?php echo $t->UPDATEDATE; ?></td>
							<td><a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.systemsettings.mpositem.php?Method=Search&txtSearch=<?php echo $t->ITEMCODE;?>">View Item</a></td>
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
	<div class="panelButtons" style="margin-bottom:20px;">
		<div class="button-group">
			<?php if($this->getRolesConfig('UPDATE_MPOS_ITEM')){ ?>
				<a id="useredit" class="ui-state-default ui-corner-all ui-button" style="float:left;" ><?php echo _("Edit"); ?></a>
				<a id="usersave" class="ui-state-default ui-corner-all ui-button" style="float:left;display:none"><?php echo _("Save"); ?></a>
				<a id="usercancel" class="ui-state-default ui-corner-all ui-button" style="float:left;display:none"><?php echo _("cancel"); ?></a>
			<?php } ?>
		</div>
		<div class="lockloading"></div>
		<div class="loading"></div>
	</div>

	<?php $ctr=0; foreach($searchResult->Value as $t): $ctr++;?>
	<div id="usermanagementinfo" >
		<div id="usermanagementinfo1">
			<table class="tableusermanagement1" >
			
				<tr>
					<td class="td1"><?php echo _("ID"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_userid" id="user_id" value="<?php echo $t->ID; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("ITEM NAME"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_username" id="item_name" value="<?php echo $t->ITEMNAME; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("ITEM CODE"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_firstname" id="item_code" value="<?php echo $t->ITEMCODE; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("UNIT CODE"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_lastname" id="unit_code" value="<?php echo $t->UNITCODE; ?>" disabled="disabled" /></td>
				</tr>
				
			
			</table>
		</div>
		<div id="usermanagementinfo2">
			<table class="tableusermanagement2">
				<tr>
					<td class="td1"><?php echo _("UNIT"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="uunit" value="<?php echo $t->UNIT; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("PRICE PER UNIT"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="price_unit" value="<?php echo $t->PRICEPERUNIT; ?>" disabled="disabled" /></td>					
				</tr>
				<tr>
					<td class="td1"><?php echo _("SUBVENTION"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="sub_vention" value="<?php echo $t->SUBVENTION; ?>" disabled="disabled" /></td>					
				</tr>
				<tr>
					<td class="td1"><?php echo _("BARCODE"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="bar_code" value="<?php echo $t->BARCODE; ?>" disabled="disabled" /></td>					
				</tr>
			</table>
		</div>
	</div>
	<?php endforeach; ?>
	<?php } ?>

<div id="dialogMposItemAdd" title="<?php echo _("Add mPOS Item"); ?>">		                
	<table style="text-align:left;" class="tablet">					
		
		<tr>
			<td><?php echo _("Item Name"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAccount"  id="_itemname"></td>						
		</tr>
		<tr>
			<td><?php echo _("Item Code"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addFixed"  id="_itemcode" value="000"></td>
		</tr>
		<tr>
			<td><?php echo _("Unit Code"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addPercent" id="_unitcode" value="1"></td>
		</tr>
		<tr>
			<td><?php echo _("Unit"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountTo" id="_unit" value="KG"></td>
		</tr>
		<tr>
			<td><?php echo _("Price"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addPriority" id="_price" value="100"></td>
		</tr>					
		<tr>
			<td><?php echo _("Subvention"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountFr" id="_subvention" value="1"></td>						
		</tr>	
		<tr>
			<td><?php echo _("Barcode"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountTo" id="_barcode" value="10"></td>						
		</tr>
		<tr>
			<td><?php echo _("Validity Code"); ?><span style="color:red">*</span>:</td><td><input type="text" name="addAmountTo" id="_validitycode" value="000"></td>
		</tr>
	</table>
	<div align="right">
    	<a id="btnMposItemAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("Add"); ?></span>
        </a>
        <a id="btnKeyCostTypeCancelAdd" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
            <span class="ui-button-text"><?php echo _("cancel"); ?></span>
        </a>                    
	</div><div class="addloading"></div>
</div>
	
</div>
</body>

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

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>

<script>
	loadUserRoles();
	<?php echo ($this->getRolesConfig('EDIT_USERS_LEVEL')) ? '' : 'var _0x5acc=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x6D\x61\x6E\x61\x67\x65\x6D\x65\x6E\x74\x6C\x65\x76\x65\x6C\x65\x64\x69\x74\x5F\x73\x61\x76\x65\x2C\x20\x23\x75\x73\x65\x72\x6D\x61\x6E\x61\x67\x65\x6D\x65\x6E\x74\x5F\x75\x73\x65\x72\x6C\x65\x76\x65\x6C\x42\x6F\x78\x63\x6F\x6E\x74\x65\x6E\x74\x31"];$(_0x5acc[1])[_0x5acc[0]]();'; ?>
	<?php echo ($this->getRolesConfig('ADD_USERS_LEVEL')) ? '' : 'var _0xdb24=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x41\x64\x64\x55\x73\x65\x72\x4C\x65\x76\x65\x6C\x2C\x20\x23\x75\x73\x65\x72\x6D\x61\x6E\x61\x67\x65\x6D\x65\x6E\x74\x5F\x75\x73\x65\x72\x6C\x65\x76\x65\x6C\x42\x6F\x78\x63\x6F\x6E\x74\x65\x6E\x74\x32"];$(_0xdb24[1])[_0xdb24[0]]();'; ?>
	<?php echo ($this->getRolesConfig('EDIT_ROLES_CONFIGURATION')) ? '' : 'var _0x1eb9=["\x72\x65\x6D\x6F\x76\x65","\x23\x62\x74\x6E\x47\x65\x74\x52\x6F\x6C\x65\x73"];$(_0x1eb9[1])[_0x1eb9[0]]();'; ?>
	<?php echo ($this->getRolesConfig('SEARCH_WEB_USER')) ? '' : 'var _0xfbc9=["\x72\x65\x6D\x6F\x76\x65","\x23\x74\x61\x62\x73\x2D\x31\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x31"];$(_0xfbc9[1])[_0xfbc9[0]]();$(_0xfbc9[2])[_0xfbc9[0]]();'; ?>
	<?php echo ($this->getRolesConfig('CREATE_WEB_USER')) ? '' : 'var _0xa104=["\x72\x65\x6D\x6F\x76\x65","\x23\x74\x61\x62\x73\x2D\x32\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x32"];$(_0xa104[1])[_0xa104[0]]();$(_0xa104[2])[_0xa104[0]]();'; ?>
	<?php echo ($this->getRolesConfig('ROLES_CONFIGURATION')) ? '' : 'var _0xf9c8=["\x72\x65\x6D\x6F\x76\x65","\x23\x74\x61\x62\x73\x2D\x33\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x33"];$(_0xf9c8[1])[_0xf9c8[0]]();$(_0xf9c8[2])[_0xf9c8[0]]();'; ?>
	<?php echo ($this->getRolesConfig('VIEW_USERS_LEVEL')) ? '' : 'var _0x1547=["\x72\x65\x6D\x6F\x76\x65","\x23\x74\x61\x62\x73\x2D\x34\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x34"];$(_0x1547[1])[_0x1547[0]]();$(_0x1547[2])[_0x1547[0]]();' ?>
	<?php echo ($_SESSION["ISFIRSTLOGON"] == 1) ? 'var _0xd381=["\x72\x65\x6D\x6F\x76\x65","\x23\x74\x61\x62\x73\x2D\x31\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x31","\x23\x74\x61\x62\x73\x2D\x32\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x32","\x23\x74\x61\x62\x73\x2D\x33\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x33","\x23\x74\x61\x62\x73\x2D\x34\x4C\x69\x6E\x6B","\x23\x74\x61\x62\x73\x2D\x34"];$(_0xd381[1])[_0xd381[0]]();$(_0xd381[2])[_0xd381[0]]();$(_0xd381[3])[_0xd381[0]]();$(_0xd381[4])[_0xd381[0]]();$(_0xd381[5])[_0xd381[0]]();$(_0xd381[6])[_0xd381[0]]();$(_0xd381[7])[_0xd381[0]]();$(_0xd381[8])[_0xd381[0]]();' : ''; ?>
	<?php echo isset($account)?($this->getRolesConfig('EDIT_WEB_USER') ? '' : 'var _0x522f=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x65\x64\x69\x74\x2C\x20\x23\x75\x73\x65\x72\x73\x61\x76\x65\x2C\x20\x23\x75\x73\x65\x72\x63\x61\x6E\x63\x65\x6C"];$(_0x522f[1])[_0x522f[0]]();'):'var _0x522f=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x65\x64\x69\x74\x2C\x20\x23\x75\x73\x65\x72\x73\x61\x76\x65\x2C\x20\x23\x75\x73\x65\x72\x63\x61\x6E\x63\x65\x6C"];$(_0x522f[1])[_0x522f[0]]();' ?>
	<?php echo isset($account)?($this->getRolesConfig('LOCK_WEB_ACCOUNT') ? ($account->LOCKED=='true' ? 'var _0x2f42=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x6C\x6F\x63\x6B"];$(_0x2f42[1])[_0x2f42[0]]();' : '') : 'var _0x2f42=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x6C\x6F\x63\x6B"];$(_0x2f42[1])[_0x2f42[0]]();'):'var _0x2f42=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x6C\x6F\x63\x6B"];$(_0x2f42[1])[_0x2f42[0]]();' ?>
	<?php echo isset($account)?($this->getRolesConfig('UNLOCK_WEB_ACCOUNT') ? ($account->LOCKED=='true' ? '' : 'var _0xbc61=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x75\x6E\x6C\x6F\x63\x6B"];$(_0xbc61[1])[_0xbc61[0]]();') : 'var _0xbc61=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x75\x6E\x6C\x6F\x63\x6B"];$(_0xbc61[1])[_0xbc61[0]]();'):'var _0xbc61=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x75\x6E\x6C\x6F\x63\x6B"];$(_0xbc61[1])[_0xbc61[0]]();' ?>
	<?php echo isset($account)?($this->getRolesConfig('RESET_WEB_PASSWORD') ? '' : 'var _0xd43b=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x72\x65\x73\x65\x74"];$(_0xd43b[1])[_0xd43b[0]]();'):'var _0xd43b=["\x72\x65\x6D\x6F\x76\x65","\x23\x75\x73\x65\x72\x72\x65\x73\x65\x74"];$(_0xd43b[1])[_0xd43b[0]]();' ?>
</script>
<script type="text/javascript">
	// Dialog
	$('#dialogMposItemAdd').dialog({
		autoOpen: false,
		position: 'top',
		width: 450,
		draggable: true,
		resizable: false,
		modal:true
	});
	$("#btnAddMpos").click(function(){
		$('#dialogMposItemAdd').dialog('open');
		
	});
	$("#btnKeyCostTypeCancelAdd").click(function(){
				 $('#dialogMposItemAdd').dialog('close');	
	});
	
	$("#btnMposItemAdd").click(function(){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'mPosItemAdd',
				itemname:$("#_itemname").val(),
				itemcode:$("#_itemcode").val(),
				unitcode:$("#_unitcode").val(),
				unit:$("#_unit").val(),
				price:$("#_price").val(),
				subvention:$("#_subvention").val(),
				barcode:$("#_barcode").val(),
				validitycode:$("#_validitycode").val()
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogMposItemAdd").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		});
	});
</script>
<script>
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";	
	
	window.imgPath = "<?php echo $GLOBALS["VIEW_PATH"]?>";
	window.CurrentUser = "<?php echo $currentUser; ?>";
    window.userRole = 	"<?php if($account==null) { 
                                if (isset($_REQUEST['userlevelroles'])) {
                                    echo sanitize_string($_REQUEST['userlevelroles']) ;
                                }else{
                                    echo null;
                                } 
                            }else{ 
                               echo $account->USERLEVEL;
                         } ?>";
</script>

<script>
$(document).ready(function(){
	oTable = $('#searchListResultTable').dataTable({
			"bJQueryUI": true,
			"bFilter": false,
			"sPaginationType": "two_button"
		});

	var ht = $("#searchBoxArea").css('height');
	ht = ht.replace("px","");
	$("#ifusersearch",window.parent.document).css('height',parseInt(ht)+130);
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

	//USER MODULE
	//Ken / Reugie
	$("#btnUserRegSave").click(function(){
			var params = {
					Method:'userRegistration',
					username:$('#regusername').val(),
					firstname:$('#firstname').val(),
					lastname:$('#lastname').val(),
					department:$('#department').val(),
					userlevel:$('#userlevel').val(),
					status:$('#status').val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
			};
			
			$('.rloading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.rloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#useredit").click(function(){		
		$('#price_unit').removeAttr('disabled');
		$('#sub_vention').removeAttr('disabled');
		$('#bar_code').removeAttr('disabled');
		$('#searchdepartment').removeAttr('disabled');
		$('#searchstatus').removeAttr('disabled');
		$('#usersave').show();
		$('#usercancel').show();
		$('#useredit').hide();
	});
	
	$("#usercancel").click(function(){
		$('#price_unit').attr('disabled','disabled');
		$('#sub_vention').attr('disabled','disabled');
		$('#bar_code').attr('disabled','disabled');
		$('#searchdepartment').attr('disabled','disabled');
		$('#searchstatus').attr('disabled','disabled');
		$('#useredit').show();
		$('#usersave').hide();
		$('#usercancel').hide();
	});
	
	
	
	$("#userlock").click(function(){
			var params = {
					Method:'userLocked',
					user_id:$("#user_id").val(),
					username:$("#searchusername").val(),
					locked:true,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					//LockDescription:$("#lockdescu").val()
					
			};
			
			$('.loading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					complete:function(res,status){
						$('.loading').fadeToggle(300,'linear',function(){$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						if(status=="success"){
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$("#userlock").fadeToggle(10);
									$("#userunlock").fadeToggle(10);
									$("#searchLocked").val('YES');
								}
							}
						
						});
						
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#userunlock").click(function(){
			var params = {
					Method:'userLocked',
					user_id:$("#user_id").val(),
					username:$("#searchusername").val(),
					locked:false
					
					
			};
			$('.loading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					//async:false,
					complete:function(res,status){
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								if(status=="success"){
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$("#userlock").fadeToggle(10);
									$("#userunlock").fadeToggle(10);
									$("#searchLocked").val('NO');
								}
							}
						});
						//alert(res.responseText);
					}
			});
		
	});
	
	$("#userreset").click(function(){
	     var r=confirm("Are you sure you want to reset the password?");
	     if(r == true){
			var params = {
					Method:'userResetPassword',
					user_id:$("#user_id").val(),
					username:$("#searchusername").val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
					
			};

			$('.loading').fadeToggle(300);
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					//async:false,
					complete:function(res,status){
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		}
		
	});
	
	$("#usersave").click(function(){
		var params = {
				Method:'mPosItemUpdate',
				itemcode:$("#item_code").val(),
				itemname:$("#item_name").val(),
				unitcode:$("#unit_code").val(),
				priceperunit:$("#price_unit").val(),
				subvention:$("#sub_vention").val(),
				barcode:$("#bar_code").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.loading').fadeToggle(300);
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				//async:false,
				complete:function(res,status){
					$('.loading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	
	});	
</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
	
	$("#searchBoxArea").fadeIn(700);
</script>