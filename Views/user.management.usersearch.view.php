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
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.management.usersearch.php" method="post">
			<input type="hidden" name="Method" value="SearchList" />
			<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
			<table class="searchradio">
				<td width="100px"><input type="radio" name="option" value="0" id="username" checked /><label for="username"><?php echo _("USER NAME"); ?></label></td>
				<!--<td><input type="radio" name="option" value="1" id="userid"/><label for="userid">USER ID</label></td>!-->						
				<td width="210px"><input type="text" name="txtSearch" id="searchBox" value="<?php echo sanitize_string($_REQUEST['txtSearch']); ?>" style="width:350px; text-transform: uppercase;"></td>
				<td width="50px"><input type="submit" name="btnUserSearch" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button" id="btnUserSearch">
				<div class="sloading"></div></td>
				<!--<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.management.usersearch.php?Method=ExportUsersListCSV">
					<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />Export Users List CSV
				</a>-->
			</table>
			<div id="usermanagementmaininfo">
				<?php if($account == -1) { ?>
				<span><?php echo _("USER NAME"); ?> : <?php echo $account->USERNAME; ?> </span> 
				<span>ROLE : <?php echo $account->USERLEVEL; ?> </span>
				<span>ACCOUNT ID : <?php echo $account->USERID; ?> </span>					
				<?php } ?>	
			</div>
		</form>	
	</div>
	

	
	<?php $searchListResult = $this->data("searchListResult"); ?>
	<?php if(isset($searchListResult->ResponseCode)){ ?>
		<?php if(is_array($searchListResult->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="searchListResultTable" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("USER ID"); ?></th>
					<th><?php echo _("USERNAME"); ?></th>
					<th><?php echo _("MSISDN"); ?></th>
					<th><?php echo _("FIRST NAME"); ?></th>
					<th><?php echo _("LAST NAME"); ?></th>
					<th><?php echo _("USERS LEVEL"); ?></th>
					<th><?php echo _("STATUS"); ?></th>					
					<th><?php echo _("View User Details"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($searchListResult->Value as $t): $ctr++;?>
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_<?php echo $t->MSISDN; ?>">
							<td><?php echo $t->USERID; ?></td>
							<td><?php echo $t->USERNAME; ?></td>
							<td><?php echo $t->MSISDN; ?></td>
							<td><?php echo $t->FIRSTNAME; ?></td>
							<td><?php echo $t->LASTNAME; ?></td>
							<td><?php echo $t->USERSLEVEL; ?></td>										
							<td><?php echo $t->STATUS; ?></td>
							<td>
							<form id="userSearchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.management.usersearch.php" method="POST" style="display:none;">
								<input type="hidden" name="Method" value="Search">
								<input type="hidden" name="txtSearch" value="<?php echo $t->USERNAME; ?>" id="txtSearch">
								<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken']); ?>">
							</form>
							<a href="#" class="view-user">View User: <?php echo $t->USERNAME; ?></a>
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
	
	
	<div class="panelButtons" style="margin-bottom:20px;">
		<div class="button-group">
		<?php if(isset($account)){ ?>
			<?php if($this->getRolesConfig('EDIT_WEB_USER')){ ?>
				<a id="useredit" class="ui-state-default ui-corner-all ui-button" style="float:left;" ><?php echo _("Edit"); ?></a>
				<a id="usersave" class="ui-state-default ui-corner-all ui-button" style="float:left;display:none"><?php echo _("Save"); ?></a>
				<a id="usercancel" class="ui-state-default ui-corner-all ui-button" style="float:left;display:none"><?php echo _("cancel"); ?></a>
			<?php } ?>
			<?php if($this->getRolesConfig('LOCK_WEB_ACCOUNT') && ($account->LOCKED=='false')){ ?>
				<a id="userlock" class="ui-state-default ui-corner-all ui-button" style="float:left;" ><?php echo _("Lock"); ?></a>
			<?php } ?>
			<?php if($this->getRolesConfig('UNLOCK_WEB_ACCOUNT') && ($account->LOCKED=='true')){ ?>
				<a id="userunlock" class="ui-state-default ui-corner-all ui-button" style="float:left;" ><?php echo _("Unlock"); ?></a>
			<?php } ?>
			<?php if($this->getRolesConfig('RESET_WEB_PASSWORD')){ ?>
				<a id="userreset" class="ui-state-default ui-corner-all ui-button" style="float:left;" ><?php echo _("Reset Password"); ?></a>
			<?php } ?>
		<?php } ?>
		</div>
		<div class="lockloading"></div>
		<div class="loading"></div>
	</div>

	<div id="usermanagementinfo" style="visibility:<?php echo isset($account)?'visible':'hidden' ?>;">
		<div id="usermanagementinfo1">
			<table class="tableusermanagement1" >
				<tr>
					<td class="td1"><?php echo _("User ID"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_userid" id="user_id" value="<?php echo $account==null?"":$account->USERID; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("User Name"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_username" id="searchusername" value="<?php echo $account==null?"":$account->USERNAME; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("First Name"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_firstname" id="searchfirstname" value="<?php echo $account==null?"":$account->FIRSTNAME; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Last Name"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_lastname" id="searchlastname" value="<?php echo $account==null?"":$account->LASTNAME; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Department"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="searchdepartment" value="<?php echo $account==null?"":$account->DEPARTMENT; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("User Level"); ?><span style="color:red">*</span></td>
					<td> 			
						<select id="edituserlevel" style="width:150px;" disabled="disabled">
						   <option><?php echo $account==null?"":$account->USERLEVEL; ?></option>
						   
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div id="usermanagementinfo2">
			<table class="tableusermanagement2">
				<tr>
					<td class="td1"><?php echo _("Status"); ?><span style="color:red">*</span></td>
					<td> 			
						<select id="searchstatus" style="width:100px;" disabled="disabled">
						   <!--<option value="ACTIVE">ACTIVE</option>-->									   
						   <option value="ACTIVE" <?php echo isset($account)?($account->STATUS=='ACTIVE'?"selected":""):"" ?>>ACTIVE</option>
						   <option value="DEACTIVE" <?php echo isset($account)?($account->STATUS=='DEACTIVE'?"selected":""):"" ?>>DEACTIVE</option>
						 </select>
					</td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Locked"); ?></td>
					<td><input type="text" id="searchLocked" name="usermanagementinfo_locked" value="<?php echo isset($account)?($account->LOCKED=='true'?"YES":"NO"):"" ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Date Created"); ?></td>
					<td><input type="text" name="usermanagementinfo_datecreated" value="<?php echo $account==null?"":$account->DATEREGISTERED; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Date Modified"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_datemodified" value="<?php echo $account==null?"":$account->DATEMODIFIED; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Mobile Number"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" id="searchMSISDN" name="usermanagementinfo_datemodified" value="<?php echo $account==null?"":$account->MSISDN; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("Email Address"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" id="searchEMail" name="usermanagementinfo_datemodified" value="<?php echo $account==null?"":$account->EMAIL; ?>" disabled="disabled" /></td>
				</tr>
			</table>
		</div>
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

	$(document).ready(function() {
		$('.view-user').on('click', function() {
			$('#userSearchForm').submit();
		});
	});

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
	
	
	function loadUserRoles(){
		var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	        var params = {Method:'userRolesList',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
	        $.ajax({
				type: "POST",
	           url:service_url,
	           success:function(result,status){
	               var listitem = "";
	                $('#userlevel').find('option').remove();
	                $('#usermanagementinfo_userlevel').find('option').remove();
	                $('#usermanagementlevel_userlevel').find('option').remove(); 
	                $('#userlevelroles').find('option').remove();
	                listitem += '<option value="SELECTUSERLEVEL">SELECT USER LEVEL</option>';
	                for(var i = 0; i < result.value.length; i++)
	                {
	                    var selected = "";
	                    if(result.value[i].USERSLEVEL == window.userRole){
	                        selected = "selected";
	                    }
	                    listitem += '<option value="'+ result.value[i].USERSLEVEL +'"' + selected + '>' + result.value[i].USERSLEVEL + '</option>';
	                }
	                $('#userlevel').html(listitem);
	                $('#usermanagementinfo_userlevel').html(listitem);
	                $('#usermanagementlevel_userlevel').html(listitem);
	                $('#userlevelroles').html(listitem);
	                $('#edituserlevel').html(listitem);
	                $('#userlevel').click();
	                $('#usermanagementinfo_userlevel').click();
	                $('#usermanagementlevel_userlevel').click();
	                $('#userlevelroles').click();
	                $('#edituserlevel').click();
	           },
	           dataType:"JSON",
	           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	        });
	           
	}
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
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		
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
							setTimeout($.unblockUI, 1000);
						});
					}, error: function(e){
						setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#useredit").click(function(){		
		$('#edituserlevel').removeAttr('disabled');
		$('#searchfirstname').removeAttr('disabled');
		$('#searchlastname').removeAttr('disabled');
		$('#searchdepartment').removeAttr('disabled');
		$('#searchstatus').removeAttr('disabled');
		$('#usersave').show();
		$('#usercancel').show();
		$('#useredit').hide();
	});
	
	$("#usercancel").click(function(){
		$('#edituserlevel').attr('disabled','disabled');
		$('#searchfirstname').attr('disabled','disabled');
		$('#searchlastname').attr('disabled','disabled');
		$('#searchdepartment').attr('disabled','disabled');
		$('#searchstatus').attr('disabled','disabled');
		$('#useredit').show();
		$('#usersave').hide();
		$('#usercancel').hide();
	});
	
	
	
	$("#userlock").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		
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
						
						setTimeout($.unblockUI, 1000);
						
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		
	});
	
	$("#userunlock").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			var params = {
					Method:'userLocked',
					user_id:$("#user_id").val(),
					username:$("#searchusername").val(),
					locked:false,
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
								if(status=="success"){
								if(res.responseText.toLowerCase().indexOf("success",0)>-1){
									$("#userlock").fadeToggle(10);
									$("#userunlock").fadeToggle(10);
									$("#searchLocked").val('NO');
								}
								
								
							}
						});
						
						setTimeout($.unblockUI, 1000);
						//alert(res.responseText);
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
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
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			$.ajax({url:service_url,
					type:"POST", 
					data:params,
					//async:false,
					complete:function(res,status){
						$('.loading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
								
								setTimeout($.unblockUI, 1000);
						});
					}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
			});
		}
		
	});
	
	$("#usersave").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		
		var params = {
				Method:'userUpdate',
				userid:$("#user_id").val(),
				username:$("#searchusername").val(),
				firstname:$("#searchfirstname").val(),
				lastname:$("#searchlastname").val(),
				department:$("#searchdepartment").val(),
				userlevel:$("#edituserlevel").val(),
				status:$("#searchstatus").val(),
				email:$("#searchEMail").val(),
				msisdn:$("#searchMSISDN").val(),
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
							
							setTimeout($.unblockUI, 1000);
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
	
$(document).ready(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	setTimeout(function(){
		setTimeout($.unblockUI, 1000);
	}, 3000);
});

	$("#searchBoxArea").fadeIn(700);
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>