<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $roles = $this->data("roles"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->Value:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="usermanagement_applicationRolesArea" class="usermanagement_applicationRoles" align="center" style="display:none;">
   <form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.management.rolesconfiguration.php" method="post">
	    <input type="hidden" name="Method" value="Roles" />
		<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
        <table class="tablet">
            <tr>
                <td><select id="userlevelroles" name="userlevelroles" style="width:200px;">
                </select></td>
                <td><input id="btnGetRoles" type="submit" value="<?php echo _("Get Roles"); ?>" class="ui-state-default ui-corner-all ui-button" /></td>
            </tr>
        </table>
        <div style="margin-top:55px;"></div>
        <div id="rolesTable">
        <?php
        if(isset($roles["Value"])){ ?>
            <table style="width:100%;" class="tablet" id="trans" cellpadding="0" cellspacing="0" border="0" class="display"> 
				<thead>
					<tr class="ui-widget-header">
						<th>MODULE NAME</th>
						<th>DESCRIPTION</th>
						    <th>ACCESS</th>
                        <th></th>
					</tr>
				</thead>
                    <tfoot>
                	<tr>
                    	<td colspan="3">   
                        </td>
                    </tr>
                    </tfoot>
                <tbody>
                    <?php
                        foreach( $roles['Value'] as $row){                           
                    ?>
                        <tr class="row">
                            <td><?php echo $row['MODULE_NAME']?></td>
                            <td><?php echo $row['DESCRIPTION']?></td>
                            <td><?php echo $row['ACTIONSTATUS']?>                                 
                            </td>
                            <td>
                            <input type="hidden" class="actionstatus" value="<?php echo $row['ACTIONSTATUS']?>" />
                            <input type="hidden" class="modulename" value="<?php echo $row['MODULE_NAME']?>" />
						<?php if($this->getRolesConfig('EDIT_ROLES_CONFIGURATION')){ ?>
							<input type="button" name="btnModule" value="<?php echo _("Change Access"); ?>" class="ui-state-default ui-corner-all ui-button update_module" id="btnUpdateModule" onclick="updateModule(this);"/>
						<?php } ?>
							</td>
                        </tr>
                    <?php 
                        } ?>
            	</tbody>
        	</table>
        <?php }
        ?>              
        </div>      
    </form>
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
// $.ajaxSetup({
// 	data: {
// 		t: window.parent.pagetoken
// 	},
// 	dataType: "jsonp"
// });

	loadUserRoles();
		
	function loadUserRoles(){
		var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	        var params = {Method:'userRolesList',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
	        $.ajax({
	           url:service_url,
			   type: "POST",
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
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
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
	var ht = $("#usermanagement_applicationRolesArea").css('height');
	ht = ht.replace("px","");
	ht = 640
	$("#ifrolesconfiguration",window.parent.document).css('height',parseInt(ht)+50);
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

	$(document).ready(function() {
		oTable = $('#trans').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	} );
	
	function updateModule(obj){
	    var index = $('.update_module').index(obj);
	    var action_value = $(".actionstatus:eq("+ index +")").val();
	    var module_value = $(".modulename:eq("+ index +")").val();
        var params = {Method:'updateModule',module:module_value,action:action_value,FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
	        $.ajax({
				type: "POST",
				url:service_url,
				complete:function(result,status){
						
						$("tbody .row:eq(" + index + ") td:eq(2)").text("NO");
						$(".actionstatus:eq(" + index + ")").val("NO");
						
						if(action_value == "NO"){
								$("tbody .row:eq(" + index + ") td:eq(2)").text("YES");
								$(".actionstatus:eq("+ index +")").val("YES");
						}
						//$("<p>"+result.responseText+"</p>").dialog({modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				},
				data: params,
			error: function(e){
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

$(document).ready(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	setTimeout(function(){
		setTimeout($.unblockUI, 1000);
	}, 3000);
});
	
$("#usermanagement_applicationRolesArea").fadeIn(700);	
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>