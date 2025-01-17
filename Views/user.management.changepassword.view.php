<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
._d-none{
	display:none;
}
._usermanagement_registerBoxtitle{
	margin: 0px;text-align: center;
}
._cpass{
	margin: 0px;text-align: center;width: 350px;
}
</style>
<div class="usermanagement_changePasswordBox _d-none" id="changePasswordBox">
	<div class="w-100" align="center">
		<div id="usermanagement_registerBoxtitle" class="_usermanagement_registerBoxtitle"><span><?php echo _("Change Password"); ?></span></div>
		
		<table class="tablet _cpass" id="cpass">
			<tr>
				<td colspan="2" align="left"><span><?php echo _("New Password should be minimum 7 characters long with at least 1 numeric and mixed case characters"); ?></span></td>						    	
			</tr>						    
			<tr>
				<td class="td2" align="left"><?php echo _("Current Password"); ?><span class="text-danger">*</span></td>
				<td><input type="password" name="oldpassword" id="oldpassword" class="cPass"/></td>
			</tr>
			<tr>
				<td class="td2" align="left"><?php echo _("New Password"); ?><span class="text-danger">*</span></td>
				<td><input type="password" name="newpassword" id="newpassword" class="cPass"/></td>
			</tr>
			<tr>
				<td class="td2" align="left"><?php echo _("Confirm New Password"); ?><span class="text-danger">*</span></td>
				<td><input type="password" name="confirmpassword" id="confirmpassword" class="cPass"/></td>
			</tr>							
		</table>
	</br>
		<div id="buttonregister">
			<div class="button-group">
				<input type="submit" value="<?php echo _("Save"); ?>" class="ui-state-default ui-corner-all ui-button" id="btnSavePassword" />
				<input type="reset" value="<?php echo _("reset"); ?>" class="ui-state-default ui-corner-all ui-button _d-none" id="btnReset"/>
				<div class="pwloading">
				</div>
			</div>
		</div>
		
	</div>
</div>
			
<script nonce="<?php echo $_SESSION['nonce'];?>">
$("#btnSavePassword").click(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		var params = {
				Method:'userChangePassword',
				oldpassword:$("#oldpassword").val(),
				newpassword:$("#newpassword").val(),
				confirmpassword:$("#confirmpassword").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.pwloading').fadeToggle(300);
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				//async:false,
				complete:function(res,status){
					$('.pwloading').fadeToggle(300,'linear',function(){
							$("<p>"+res.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); location.reload(); } } });
					});
					

					$(".cPass").val('');
					
					// $.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					// 	type:"POST",
					// 	complete:function(res,status){
					// 		window.parent.pagetoken = res.responseText;
							setTimeout($.unblockUI, 1000);
					// 	}
					// });

				}, error: function(e){
					setTimeout($.unblockUI, 1000);
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
			
		return false;
	});
	
	$("#changePasswordBox").fadeIn(700);
</script>