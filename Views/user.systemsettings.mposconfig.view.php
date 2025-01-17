<?php require_once("views.config.properties.php"); ?>
<div id="searchBoxArea" class="searchBox" style="display:none;">
	
	
	<div class="panelButtons" style="margin-bottom:20px;">
		<div class="button-group">
			<?php if($this->getRolesConfig('UPDATE_MPOS_CONFIG')){ ?>
				<input type="submit" id="mposedit" class="ui-state-default ui-corner-all ui-button" value= "<?php echo _("Edit"); ?>">
				<input type="submit" id="mpossave" class="ui-state-default ui-corner-all ui-button" style="float:left;display:none" value = "<?php echo _("Save"); ?>">
				<input type="submit" id="mposcancel" class="ui-state-default ui-corner-all ui-button" style="float:left;display:none" value= "<?php echo _("cancel"); ?>">
			<?php } ?>
		</div>
		<div class="lockloading"></div>
		<div class="loading"></div>
	</div>

	<?php $mPosTBLNBECONFIG = $this->data("mPosTBLNBECONFIG");?>
	<?php $ctr=0; foreach($mPosTBLNBECONFIG->Value as $t): $ctr++;?>
	<div id="usermanagementinfo" >
		<div id="usermanagementinfo1">
			<table class="tableusermanagement1" >
			
				<tr>
					<td class="td1"><?php echo _("URL"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_userid" id="_url" value="<?php echo $t->URL; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("PORT"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_username" id="_port" value="<?php echo $t->PORT; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("HEADER"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_firstname" id="_header" value="<?php echo $t->HEADER; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("FORCE PIN"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_lastname" id="_forcepin" value="<?php echo $t->FORCEPIN; ?>" disabled="disabled" /></td>
				</tr>
				
			
			</table>
		</div>
		<div id="usermanagementinfo2">
			<table class="tableusermanagement2">
				<tr>
					<td class="td1"><?php echo _("CVM"); ?></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="_cvm" value="<?php echo $t->CVM; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
					<td class="td1"><?php echo _("UPDATE BY"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="_upby" value="<?php echo $t->UPDATEBY; ?>" disabled="disabled" /></td>					
				</tr>
				<tr>
					<td class="td1"><?php echo _("UPDATE DATE"); ?><span style="color:red">*</span></td>
					<td class="td2"><input type="text" name="usermanagementinfo_department" id="_updt" value="<?php echo $t->UPDATEDATE; ?>" disabled="disabled" /></td>					
				</tr>				
			</table>
		</div>
	</div>
	<?php endforeach; ?>

	
</div>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>


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
				validitycode:$("#_validitycode").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#dialogMposItemAdd").dialog('close');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
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
	
	$("#mposedit").click(function(){		
		$('#_url').removeAttr('disabled');
		$('#_port').removeAttr('disabled');
		$('#_header').removeAttr('disabled');
		$('#_forcepin').removeAttr('disabled');
		$('#_cvm').removeAttr('disabled');
		$('#mpossave').show();
		$('#mposcancel').show();
		$('#mposedit').hide();
	});
	
	$("#mposcancel").click(function(){
		$('#_url').removeAttr('disabled');
		$('#_port').removeAttr('disabled');
		$('#_header').removeAttr('disabled');
		$('#_forcepin').removeAttr('disabled');
		$('#_cvm').removeAttr('disabled');
		$('#mposedit').show();
		$('#mpossave').hide();
		$('#mposcancel').hide();
	});
	
	
		
	$("#mpossave").click(function(){
		var params = {
				Method:'mPosTBLNBECONFIGUpdate',
				url:$("#_url").val(),
				port:$("#_port").val(),
				header:$("#_header").val(),
				forcepin:$("#_forcepin").val(),
				cvm:$("#_cvm").val(),
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