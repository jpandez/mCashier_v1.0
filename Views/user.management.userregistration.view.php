<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $roles = $this->data("roles"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->Value:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="usermanagement_registerBoxArea"  style="display:none;">

	<div style="margin: 0px;text-align: center;width: 400px;">

		<form id="user_registration_form" AutoComplete = "off" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.management.userregistration.php" method="post">
		<input type="hidden" name="Method" value="RegisterUser" />
		<div id="usermanagement_registerBoxtitle"><span><?php echo _("Registration Details"); ?></span></div>
		<table class="tablet">
			<tr>
				<td class="td1"><?php echo _("Username"); ?><span style="color:red">*</span></td>
				<td>
				<div class="field required">
				<input style="text-transform:uppercase;" type="text" class="verifyText" name="username" id="regusername" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['username']) ;?>" />
				<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("First Name"); ?><span style="color:red">*</span></td>
				<td>
				<div class="field required">
				<input style="text-transform:uppercase;" type="text" class="verifyText" name="firstname" id="firstname" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['firstname']) ;?>" />
				<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("Last Name"); ?><span style="color:red">*</span></td>
				<td>
				<div class="field required">
				<input style="text-transform:uppercase;" type="text" class="verifyText" name="lastname" id="lastname" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['lastname']) ;?>" />
				<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("Mobile Number"); ?><span style="color:red">*</span></td>
				<td>
				<div class="field required">
				<input type="text" class="verifyText" name="msisdn" id="msisdn" autocomplete="off" onkeyup="this.value=this.value.replace(/\D/g,'');" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['msisdn']) ;?>" />
				<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("Email Address"); ?><span style="color:red">*</span></td>
				<td>
				<div class="field required">
				<input type="text" class="verifyText" name="email" id="email" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['email']) ;?>" />
				<span class="iferror"><?php echo _("Field required"); ?></span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("Department"); ?></td>
				<td><input type="text" name="department" id="department" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['department']) ;?>" /></td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("User Level"); ?><span style="color:red">*</span></td>
				<td>            
					<select name="userlevel" id="userlevel" style="width:200px;">
						
					 </select>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("Status"); ?><span style="color:red">*</span></td>
				<td>            
			  
					<select name="status" id="status" style="width:100px;">
					   <option value="ACTIVE">ACTIVE</option>
					   <option value="DEACTIVE">DEACTIVE</option>
					 </select>
				</td>
			</tr>
		</table>
		<input type="submit" value="<?php echo _("Save"); ?>" class="ui-state-default ui-corner-all ui-button">
			<div class="rloading"></div>
		</form>
		<div id="buttonregister">
			<div class="button-group">                      
			</div>
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
	loadUserRoles();
	
	function loadUserRoles(){
		var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	        var params = {Method:'userRolesList',t: window.parent.pagetoken,FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
	        $.ajax({
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
	var ht = $("#usermanagement_registerBoxArea").css('height');
	ht = ht.replace("px","");
	$("#ifuserregistration",window.parent.document).css('height',parseInt(ht)+50);
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
		$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
		});

	}, 3000);
});	
	
$("#usermanagement_registerBoxArea").fadeIn(700);	
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>