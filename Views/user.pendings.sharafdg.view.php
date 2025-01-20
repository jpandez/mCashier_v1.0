<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
	.loading_sh, .ploading_sh, .rloading_sh, .revloading_sh {
		height:25px;
		width:81px;
		float:right;
		background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
		display:none;
	}
	._data_loading_sh{
		display:inline;
	}
	._pendingsharafdgapproval_sh{
		display:none;margin-top:15px;
	}
	._accountforsharafdgsummary_sh{
		width:100%;font-size:10px;
	}
	._m-top_sh{
		margin-top:10px;
	}
</style>
<div id="data_loading_sh" class="_data_loading_sh">
	<table width = "100%">
		<tr>
			<td align = "center">
				<img src = "<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" alt = "Loading"/>
			</td>
		</tr>
	</table>
</div>
<div id="pendingsharafdgapproval_sh" class="_pendingsharafdgapproval_sh">
	<div id="accountforsharafdgsummary_sh" class="_accountforsharafdgsummary_sh">
		<?php $sharafdgapprovesubscriber = $this->data("subscriberForSharafDG"); ?>
		<?php if(isset($sharafdgapprovesubscriber->ResponseCode)){ ?>
		<?php if(is_array($sharafdgapprovesubscriber->Value)){?>
		<div class="_m-top_sh"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="accountforsharafdg_sh" width="100%">
			<thead>
				<tr class="ui-widget-header">
					<!--<th><?php echo _("APPLICATION ID"); ?></th>-->
					<th><?php echo _("DATE REGISTERED"); ?></th>
					<th><?php echo _("COMPANY"); ?></th>
					<th><?php echo _("MSISDN"); ?></th>
				<!--<th><?php echo _("MERCHANT ID"); ?></th>
				<th><?php echo _("TERMINAL ID"); ?></th>-->
				<th><?php echo _("FIRST NAME"); ?></th>
				<th><?php echo _("LAST NAME"); ?></th>
				<th><?php echo _("ACCOUNT TYPE"); ?></th>																
				<th><?php echo _("STATUS"); ?></th>
				<th><?php echo _("IS VAT APP USER"); ?></th>
				<th><?php echo _("USER ID"); ?></th>
				<th><?php echo _("Activate"); ?></th>							
			</tr>
		</thead>
		<tbody>
			<?php $ctr=0; foreach($sharafdgapprovesubscriber->Value as $t): $ctr++;?>
			<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="processorPending_sh<?php echo $t->ID;?>">
				<input type="hidden" id="#authNumber_sh" value="<?php echo $t->MSISDN; ?>">
				<!--<td><?php echo $t->ID; ?></td>-->
				<td><?php echo $t->REGDATE; ?></td>
				<td><?php echo $t->COMPANY; ?></td>
				<td><?php echo $t->MSISDN;?></td>
				<!--<td><?php echo $t->MERCHANTID;?></td>-->
				<!--<td><?php echo $t->TERMINALID;?></td>-->
				<td><?php echo $t->FIRSTNAME; ?></td>
				<td><?php echo $t->LASTNAME; ?></td>
				<td><?php echo $t->TYPE; ?></td>										
				<td><?php echo $t->STATUS; ?></td>
				<td><?php if(($t->ISVATAPPUSER)==0){
								echo "NO";
							}else if(($t->ISVATAPPUSER)==1){
								echo "YES";
							} ?></td>
				<td><?php echo $t->USERID; ?></td>
				<!--<td><a href="javascript:activateAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">Activate</a></td>-->
				<!--<td><a href="javascript:activateAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')"><input type="checkbox" onchange="disablecheck(check_<?php echo $t->ID;?>)" id="check_<?php echo $t->ID;?>"></a></td>-->
				<td>
					<!-- <input type="checkbox" onclick="activateAccount('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>', 'check_<?php echo $t->ID;?>')" id="check_<?php echo $t->ID;?>"> -->
					<input type="checkbox" id="check_<?php echo $t->ID; ?>" 
					data-id="<?php echo $t->ID; ?>" 
					data-type="<?php echo $t->TYPE; ?>">
				</td>
				<!--<td><a href="javascript:viewSMBAccountforProcessor('<?php echo $t->ID; ?>','<?php echo $t->TYPE; ?>')">View</a></td>-->
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php } 
else {
	echo "<h3>". $sharafdgapprovesubscriber->Message ."</h3>";
}?>
<?php } ?>
</div>

<div class="ploading_sh"></div>

<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

$(document).ready(function() {
    $('input[type="checkbox"]').on('click', function() {
        var checkbox = $(this);
        var id = checkbox.data('id');
        var type = checkbox.data('type');
        activateAccount(id, type, checkbox.attr('id'));
    });
});

	function run(field) {
		var qwer = field.replace(/\s/g,'');
		return qwer;
	}

	var ht = $("#pendingsharafdgapproval_sh").css('height');
	ht = ht.replace("px","");

	$(document).ready(function() {
		$(".buttonx").button

		oTable = $('#accountforsharafdg_sh').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button",
			"aaSorting": [[0, "desc" ]],
			"bDestroy": true
		});
	});

	function disablecheck(checkrow){
		$("#check"+"#checkrow").attr('disabled',true);
	}
	
/*function activateAccount(id, type){
	//console.log('<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php');
	$.ajax({
		//url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		url: "/Projects/mCashier_v1.0/Controllers/WebServices/SubscriberWebServices.php",
		type: 'post',
		async: false,
		cache: false,
		//contentType: 'application/json',
		dataType: 'json',
		data: {
			Method: 'activateAccount',
			inputValue: id
		}, success: function(json){
			
				if(json.ResponseCode == 0){
					$("#processorPending_sh" + $("#authNumber_sh").val()).css({display:'none'});
					
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close");} } });
			
		setTimeout($.unblockUI, 1000);
	}, error: function(XMLHttpRequest, textStatus, errorThrown) {console.log('ERROR');}
	});
	
}*/
function activateAccount(id, type, checkrow){
	//console.log('<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php');
	if($('#' + checkrow).is(":checked")){
		$('#' + checkrow).prop('disabled',true);
	}
	
	$.ajax({
		//url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		url: '<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php',
		type: 'post',
		async: false,
		cache: false,
		dataType: 'json',
		data: {
			Method: 'activateAccount',
			inputValue: id,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		}, success: function(json){
			
			if(json.ResponseCode == 0){
				$("#processorPending_sh" + $("#authNumber_sh").val()).css({display:'none'});

			}
			$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close");
					$("#processorPending_sh" + id).css({display:'none'});
			} } });
			
			setTimeout($.unblockUI, 1000);
		}, error: function(e){
			setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		
		//, error: function(XMLHttpRequest, textStatus, errorThrown) {console.log('ERROR');}
	});
	
}


$("#data_loading_sh").css('display','none');
$("#pendingsharafdgapproval_sh").fadeIn(700);

</script>