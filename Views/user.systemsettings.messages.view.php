<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
._d-none{
	display:none;
}
._m-top-40{
	margin-top:40px;
}
._m-top-10{
	margin-top:10px;
}
._v-hidden{
	visibility: hidden;
}
</style>
<div id="msg" class="_d-none">
<div class="_m-top-40"></div>
<?php $getMessages = $this->data("getMessages"); ?>
<?php if(isset($getMessages->ResponseCode)){ ?>
	<?php if(is_array($getMessages->Value)){?>
		<div class="_m-top-10"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtmsg" width="100%">
			<thead>
			<tr class="ui-widget-header">
				<th><?php echo _("ID"); ?></th>
				<th><?php echo _("LANGUAGE"); ?></th>
				<th><?php echo _("MESSAGE"); ?></th>														
				<th><?php echo _("TYPE"); ?></th>
				<th><?php echo _("DESCRIPTION"); ?></th>
				<th><?php echo _("EDIT REQUEST"); ?></th>							
			</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($getMessages->Value as $t): $ctr++;  if($t->LANGUAGE=="E"){$lang="English(E)";}elseif($t->LANGUAGE=="F"){$lang="French(F)";}elseif($t->LANGUAGE=="A"){$lang="Arabic(A)";}elseif($t->LANGUAGE=="Z"){$lang="English mPOS(Z)";}elseif($t->LANGUAGE=="Y"){$lang="Arabic mPOS(Y)";}?>

					<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
						<td><?php echo $t->ID; ?></td>
						<td><?php echo $lang; ?></td>
						<td width="100%" <?php if($t->LANGUAGE == "A" || $t->LANGUAGE == "U"){ ?>dir="rtl" lang="ar"<?php }?>><?php echo $t->MESSAGE; ?></td>
						<td><?php echo $t->TYPE; ?></td>
						<td><?php echo $t->DESCRIPTION; ?></td>
						<td>
							<!-- <a href="javascript:requestMessage('<?php echo $t->ID . "','" . str_replace("'","\'",$t->MESSAGE) . "','". $t->DESCRIPTION . "','" . $t->TYPE . "','" . $t->LANGUAGE; ?>');" <?php #echo ($this->getRolesConfig('EDIT_MESSAGES')) ? '' : 'class="d-none"'; ?>><?php echo _("Request"); ?></a> -->
							<?php if ($this->getRolesConfig('EDIT_MESSAGES')): ?>
							<button class="btn btn-sm btn-primary request-message" 
							data-id="<?php echo $t->ID; ?>" 
							data-message="<?php echo htmlspecialchars($t->MESSAGE, ENT_QUOTES); ?>" 
							data-description="<?php echo htmlspecialchars($t->DESCRIPTION, ENT_QUOTES); ?>" 
							data-type="<?php echo htmlspecialchars($t->TYPE, ENT_QUOTES); ?>" 
							data-language="<?php echo htmlspecialchars($t->LANGUAGE, ENT_QUOTES); ?>">
							<?php echo _("Request"); ?>
							</button>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table><div class="loading"></div><div class="sysloading"></div><div class="ulevelloading"></div>
	<?php } else {
	echo "<h3> No Records Found</h3>";
	}?>
<?php } ?>
<div id="dialogMsg" title="<?php echo _("Request Message"); ?>">
    <div id="app_sendingMsg" class="_d-none"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
    <div id="app_resultMsg"></div>
    <form>
    <input type="hidden" name="Method" value="RequestMsg" />
		<table class="tablet text-start">
			<tr>
				<td><?php echo _("ID"); ?>:</td><td><input type="text" name="msgID"  id="msgID" size="5" disabled="disabled"></td>
			</tr>
			<tr>
				<td><?php echo _("LANGUAGE"); ?>:</td><td><input type="text" name="msgLanguage" id="msgLanguage" ></td>
			</tr>
			<tr>
				<td><?php echo _("MESSAGE"); ?>:</td><td><input type="text" name="msgMsg" id="msgMsg" ></td>
			</tr>
			<tr>
				<td><?php echo _("TYPE"); ?>:</td><td><input type="text" name="msgType" id="msgType" size="5"></td>
			</tr>
			<tr>
				<td><?php echo _("DESCRIPTION"); ?>:</td><td><input type="text" name="msgDescription" id="msgDescription"></td>						
			</tr>					
		</table>
		 <div align="right">
        	<a id="btnMessageRequest" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text"><?php echo _("Request For Approval"); ?></span>
            </a>
            <a id="btnMessageCancel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
                <span class="ui-button-text"><?php echo _("cancel"); ?></span>
            </a>
            <input type="reset" id="buttonReset" class="_v-hidden" />
		</div><div class="msgrloading"></div>
	</form>
</div>

</div>
<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	<?php echo ($this->getRolesConfig('EDIT_MESSAGES')) ? '' : 'var _0xf9d4=["\x72\x65\x6D\x6F\x76\x65","\x23\x64\x69\x61\x6C\x6F\x67\x4D\x73\x67"];$(_0xf9d4[1])[_0xf9d4[0]]();'; ?>
	$("#btnMessageCancel").click(function(){
				 $('#dialogMsg').dialog('close');		
	});
	// Dialog
	$('#dialogMsg').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }

	});
	function requestMessage(strid, strmessage, strdescription, strtype, strlanguage){
	$('#dialogMsg').dialog('open');
	$("#msgID").val(strid);
	$("#msgMsg").val(strmessage);
	$("#msgDescription").val(strdescription);
	$("#msgType").val(strtype);
	$("#msgLanguage").val(strlanguage);                   
	}

	var service_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>WebServices/SubscriberWebServices.php";
	$("#btnMessageRequest").click(function(){
		var params = {
				Method:'requestMessages',
				id:$("#msgID").val(),
				message:$("#msgMsg").val(),
				description:$("#msgDescription").val(),
				type:$("#msgType").val(),
				language:$("#msgLanguage").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		};

		$('.msgrloading').fadeToggle(300);			
		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$('#dialogMsg').dialog('close');
					}
					$('.msgrloading').fadeToggle(300,'linear',function(){
							$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });

					});
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});
	
</script>
<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">
	$(document).ready(function() {
		$('.request-message').on('click', function() {
        const id = $(this).data('id');
        const message = $(this).data('message');
        const description = $(this).data('description');
        const type = $(this).data('type');
        const language = $(this).data('language');
        requestMessage(id, message, description, type, language);
    });

	loadTable();
});
	function loadTable(){
		oTable = $('#dtmsg').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button",
			"iDisplayLength": 15
		});
	}
	
	$("#msg").fadeIn(700);
</script>