<?php require_once("views.config.properties.php"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $roles = $this->data("roles"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->Value:null):null;?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
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
<div class="usermanagementtab mt-5">
	<div id="tabs">
		<ul >
			<?php if($_SESSION["ISFIRSTLOGON"] != 1){ ?>
				<?php if($this->getRolesConfig('SEARCH_WEB_USER')){ ?>
					<li id="tabs-1Link"><a href="#tabs-1" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.management.usersearch.iframe.php"><?php echo _("User Search"); ?></a></li>
				<?php } ?>
				
				<?php if($this->getRolesConfig('CREATE_WEB_USER')){ ?>
					<li id="tabs-2Link"><a href="#tabs-2" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.management.userregistration.iframe.php"><?php echo _("User Registration"); ?></a></li>
				<?php } ?>
				
				<?php if($this->getRolesConfig('VIEW_USERS_LEVEL')){ ?>
					<li id="tabs-4Link"> <a href="#tabs-4" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.management.userlevel.php"><?php echo _("User Level"); ?></a></li>
				<?php } ?>
				
				<?php if($this->getRolesConfig('ROLES_CONFIGURATION')){ ?>	
					<li id="tabs-3Link"><a href="#tabs-3" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.management.rolesconfiguration.iframe.php"><?php echo _("Roles Configuration"); ?></a></li>
				<?php } ?>
								
			<?php } ?>
				<li id="tabs-5Link"> <a href="#tabs-5" url="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.management.changepassword.php"><?php echo _("Change Password"); ?></a></li>
		</ul>
		<div id="tabs-1"></div>
		<div id="tabs-2"></div>
		<div id="tabs-3"></div>
        <div id="tabs-4"></div>
		<div id="tabs-5"></div>
	</div>
</div>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
    
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
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	loadUserRoles();
	
	function loadUserRoles(){
	        var params = {Method:'userRolesList',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
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
	        <?php 
	        if(isset($_REQUEST['Method'])){
	            if($_REQUEST['Method'] == "Roles"){ ?>
	                $('#tabs').tabs({ selected: 2 });
	        <?php }
	    } ?>       
	}
	function updateModule(obj){
	    var index = $('.update_module').index(obj);
	    var action_value = $(".actionstatus:eq("+ index +")").val();
	    var module_value = $(".modulename:eq("+ index +")").val();
        var params = {Method:'updateModule',module:module_value,action:action_value,FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
	        $.ajax({
	           url:service_url,
	           complete:function(result,status){
	                   
	                   $("tbody .row:eq(" + index + ") td:eq(2)").text("NO");
	                   $(".actionstatus:eq(" + index + ")").val("NO");
	                   
	                   if(action_value == "NO"){
	                        $("tbody .row:eq(" + index + ") td:eq(2)").text("YES");
	                        $(".actionstatus:eq("+ index +")").val("YES");
	                   }
	                   $("<p>"+result.responseText+"</p>").dialog({modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	           },
	           data: params,
	           Type:"POST" , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	        });
	}
	function populateFields(obj){
		if($(".edituserlevel").val()=='SELECTUSERLEVEL'){
			$("<p>SELECT USER LEVEL</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}else{
			var userlevel_value = $(".edituserlevel").val();
			var params = {Method:'getUserlevelDetails',userlevel_value:userlevel_value,FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
		        $.ajax({
		           url:service_url,
		           success:function(result,status){
		                for(var i = 0; i < result.value.length; i++)
		                {
		                	$("#editsessiontimeout").val(result.value[i].SESSIONTIMEOUT);
		                	$("#editpasswordexpiry").val(result.value[i].PASSWORDEXPIRY);
		                	$("#editminimumpassword").val(result.value[i].MINPASSWORD);
		                	$("#editpasswordhistory").val(result.value[i].PASSWORDHISTORY);
		                	$("#editmaxallocation").val(result.value[i].MAXALLOCUSER);
		                	$("#editpasswordchange").val(result.value[i].PASSWORDCHANGE);
		                	$("#editsearchrange").val(result.value[i].SEARCHRANGE);
							$("#editnewpasswordexpiry").val(result.value[i].NEWPASSWORDEXPIRY);
		                	$("#editid").val(result.value[i].ID);
		                }
		           },
		           dataType:"JSON",
		           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		        });
		     }
	}
	$("#usermanagementleveledit_save").click(function(){
		var params = {
				Method:'userRolesUpdate',
				sessiontimeout:$("#editsessiontimeout").val(),
				minpassword:$("#editminimumpassword").val(),
				passwordhistory:$("#editpasswordhistory").val(),
				maxallocation:$("#editmaxallocation").val(),
				passwordchange:$("#editpasswordchange").val(),
				passwordexpiry:$("#editpasswordexpiry").val(),
				id : $("#editid").val(),
				searchrange : $("#editsearchrange").val(),
				newpasswordexpiry : $("#editnewpasswordexpiry").val(),
				userlevel : $(".edituserlevel").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				
		};
		$('.rsloading').fadeToggle(300);
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				async:false,
				complete:function(res,status){					
					$('.rsloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					});
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	function clearDiv(obj){
		audit('VIEW USER SEARCH');
	    $(obj).empty();
	}
<?php 
        if(isset($_REQUEST['Method'])){
            switch($_REQUEST["Method"]){
            	case "RegisterUser":
					echo "$('#tabs').tabs({ selected: 1 });";
				break;
            }
    } ?>
	<?php if($_SESSION["ISFIRSTLOGON"] == 1 || $_SESSION["ISCHANGEPASSWORD"] == 1 || $this->getRolesConfig('SEARCH_WEB_USER') == false){ ?>
		$(document).ready(function(){$("#tabs-5Link a").trigger('click')});
	<?php }else{ ?>
		$(document).ready(function(){$("#tabs-1Link a").trigger('click')});
	<?php } ?>
</script>
