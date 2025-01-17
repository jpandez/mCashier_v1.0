<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $roles = $this->data("roles"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->Value:null):null;?>

<style nonce="<?php echo $_SESSION['nonce'];?>">
._d-none{
	display:none;
}
._edituserlevel{
	width:200px;
}
</style>
<div class="usermanagement_userlevelBox _d-none" id="userlevelBox">
<div class="usermanagement_userlevelBoxcontent">
	<div id="usermanagement_userlevelBoxcontent1">
		<div id="usermanagement_userlevelBoxtitle"><span><?php echo _("Edit User Level"); ?></span></div>
		<table class="tablet">
			<tr>
				<td class="td1"><?php echo _("USER LEVEL"); ?><span class="text-danger">*</span></td>
				<td>
				<select id="usermanagementlevel_userlevel" class="edituserlevel _edituserlevel">
				</select>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("SESSION TIMEOUT"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editsessiontimeout" name="editsessiontimeout" value="0" />
					<input type="hidden" id="editid" name="editid" /> <?php echo _("(second/s)"); ?>
				</td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("PASSWORD CHANGE"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editpasswordchange" name="editpasswordchange" value="0" /></td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("PASSWORD EXPIRY"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editpasswordexpiry" name="editpasswordexpiry" value="0" /> <?php echo _("(day/s)"); ?></td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("MINIMUM PASSWORD"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editminimumpassword" name="editminimumpassword" value="0" /></td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("PASSWORD HISTORY"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editpasswordhistory" name="editpasswordhistory" value="0" /></td>
			</tr>
			<tr class="_d-none">
				<td class="td1"><?php echo _("MAX ALLOCATION"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editmaxallocation" name="editmaxallocation" value="0" /></td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("SEARCH RANGE"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editsearchrange" name="editsearchrange" value="7" /> <?php echo _("(day/s)"); ?></td>
			</tr>
			<tr>
				<td class="td1"><?php echo _("NEW USER PASSWORD EXPIRY"); ?><span class="text-danger">*</span></td>
				<td><input type="text" id="editnewpasswordexpiry" name="editnewpasswordexpiry" value="1" /> <?php echo _("(day/s)"); ?></td>
			</tr>
		</table>
		<div id="usermanagementlevel_buttonlevel">
			<div class="button-group">
				<?php if($this->getRolesConfig('EDIT_USERS_LEVEL')){ ?>
					<input type="submit" value="<?php echo _("Request"); ?>" class="ui-state-default ui-corner-all ui-button" id="usermanagementleveledit_save" >
				<?php } ?>
				<div class="rsloading"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="usermanagement_userlevelBoxcontent2">
		<div id="usermanagement_userlevelBoxtitle"><span><?php echo _("Add New User Level"); ?></span></div>
			<table class="tablet">
				<tr>
					<td class="td1"><?php echo _("NEW USER LEVEL"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="userlevel" id="newuserlevel" class="text-uppercase"/></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("SESSION TIMEOUT"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="sessiontimeout" id="sessiontimeout" value="0" /> <?php echo _("(second/s)"); ?></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("PASSWORD CHANGE"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="passwordchange" id="passwordchange" value="0" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("PASSWORD EXPIRY"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="passwordexpiry" id="passwordexpiry" value="0" /> <?php echo _("(day/s)"); ?></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("MINIMUM PASSWORD"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="minpassword" id="minpassword" value="0" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("PASSWORD HISTORY"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="passwordhistory" id="passwordhistory" value="0" /></td>
				</tr>
				<tr class="_d-none">
					<td class="td1"><?php echo _("MAX ALLOCATION"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="maxallocation" id="maxallocation" value="0" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("SEARCH RANGE"); ?><span class="text-danger">*</span></td>
					<td><input type="text" name="searchrange" id="searchrange" value="7" /> <?php echo _("(day/s)"); ?></td>
				</tr>
			</table>
		<div id="usermanagementlevel_buttonlevel">
			<div class="button-group">
				<?php if($this->getRolesConfig('ADD_USERS_LEVEL')){ ?>
					<input type="submit" value="<?php echo _("Add"); ?>" class="ui-state-default ui-corner-all ui-button" id="btnAddUserLevel" >
				<?php } ?>
				<div class="auloading">
				</div>
			</div>
		</div>
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
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

$(document).ready(function() {
	$('#usermanagementlevel_userlevel').on('change', function() {
		populateFields(this);
	});
});

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
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		        });
		     }
	}
	$("#usermanagementleveledit_save").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		
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
							
							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
					});
				}, error: function(e){
					setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
	$("#btnAddUserLevel").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		
			//alert("add new user level");
			var params = {
					Method:'userRolesAddnew',
					userlevel:$('#newuserlevel').val(),
					sessiontimeout:$('#sessiontimeout').val(),
					passwordchange:$('#passwordchange').val(),
					passwordexpiry:$('#passwordexpiry').val(),
					minpassword:$('#minpassword').val(),
					passwordhistory:$('#passwordhistory').val(),
					searchrange:$('#searchrange').val(),
					maxallocation:$('#maxallocation').val(),
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
					
			};

				$('.auloading').fadeToggle(300);
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						complete:function(res,status){
							$('.auloading').fadeToggle(300,'linear',function(){
								$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
							$('#tblAddUserLevel tr td input[type=text]').attr('value','');
							//alert($res);
							$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
								type:"POST",
								complete:function(res,status){
									window.parent.pagetoken = res.responseText;
									setTimeout($.unblockUI, 1000);
								}
							});
						}, error: function(e){
							setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
		
	});
	
	function clearDiv(obj){
	    $(obj).empty();
	}
	
	$("#userlevelBox").fadeIn(700);	
</script>