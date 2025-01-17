<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.loading, .ploading, .rloading, .revloading {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
._approvalexception{
	display:none;margin-top:15px;
}
._accountsummary{
	width:100%;font-size:10px;
}
._m-top{
	margin-top:10px;
}
</style>
<!--<div id="data_loading" style="display:inline;">
<table width = "100%">
<tr>
<td align = "center">
<img src = "<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" alt = "Loading"/>
</td>
</tr>
</table>
</div>-->
<div id="approvalexception" class="_approvalexception">
<div id="accountsummary" class="_accountsummary">
<?php $rejectedsubscriber = $this->data("subscriberPending"); ?>
<?php if(isset($rejectedsubscriber->ResponseCode)){ ?>
	<?php if(is_array($rejectedsubscriber->Value)){?>
		<div class="_m-top"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="rejectedaccount" width="100%">
			<thead>
			<tr class="ui-widget-header">
				<th><?php echo _("DATE REGISTERED"); ?></th>
							<th><?php echo _("COMPANY"); ?></th>
							<th><?php echo _("MSISDN"); ?></th>
							<th><?php echo _("FIRST NAME"); ?></th>
							<th><?php echo _("LASTNAME"); ?></th>
							<th><?php echo _("ACCOUNT TYPE"); ?></th>
							<th><?php echo _("STATUS"); ?></th>
							<th><?php echo _("REASON"); ?></th>
							<th><?php echo _("USER ID"); ?></th>						
			</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($rejectedsubscriber->Value as $t): $ctr++;?>
					<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" ><!-- id="accountPending_<?php echo $t->MSISDN; ?>"> -->
									<td><?php echo $t->REGDATE; ?></td>
									<td><?php echo $t->COMPANY; ?></td>
									<!--<td><?php echo $t->MSISDN; ?></td>-->
									<td></td>
									<td><?php echo $t->FIRSTNAME; ?></td>
									<td><?php echo $t->LASTNAME; ?></td>
									<td><?php echo $t->TYPE; ?></td>
									<td><?php echo $t->KYC; ?></td>
									<td><?php echo $t->KYCREASON; ?></td>
									<td><?php echo $t->USERID; ?></td>
								
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php } 
		else {
			echo "<h3>". $rejectedsubscriber->Message ."</h3>";
		}?>
<?php } ?>
</div>


</div>

<div class="ploading"></div>

<script type="text/javascript" src="../../Views/js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="../../Views/js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

function run(field) {
    var qwer = field.replace(/\s/g,'');
    return qwer;
}

		var ht = $("#approvalexception").css('height');
		ht = ht.replace("px","");
		//$("#pendingreg",window.parent.document).css('height',parseInt(ht)+200);
$(document).ready(function() {
	$(".buttonx").button();

	oTable = $('#rejectedaccount').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button",
		"aaSorting": [[0, "desc" ]]
	});




	

    $('#mid').keyup(function() { 
    	//alert($("#selectedType").val());
		str = $(this).val()
	    str = str.replace(/\s/g,'')
	    $(this).val(str)
	    
    	if($("#selectedType").val()=="MERCHANT"){
    		if(jQuery.trim($("#mid").val())==""){
	           $(".ctids").prop('disabled', true);
	           $("#tid").prop('disabled', true);
	        }else{
	           $(".ctids").prop('disabled', false);
	           $("#tid").prop('disabled', false);
	        }
    	}else{
    		//alert($("#selectedType").val());
    		if(jQuery.trim($("#mid").val())==""){
	           $(".ctids").prop('disabled', true);
	        }else{
	           $(".ctids").prop('disabled', false);
	        }
    	}
        $("input.cmids").val($("#mid").val());
    });

    $('#tid').keyup(function() { 
    	str = $(this).val()
	    str = str.replace(/\s/g,'')
	    $(this).val(str)
    });
     

	$('#pending_acccount_view').dialog({
		autoOpen: false,
		width: 1200,
		height: 600,
		draggable: true,
		resizable: false,
		modal:true,
		// position:'bottom'
	});
	// Dialog			
	$('#dialogDecline, #dialogSendBack, #dialogApprove').dialog({
		autoOpen: false,
		width: 700,
		buttons: {
			"Cancel": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: true,
		resizable: false,
		modal: true,
		// position: 'center',
		show: { effect: 'drop', direction: "up" },
		hide: { effect: 'drop', direction: "up", duration:700 }
	});

	
});

$("#data_loading").css('display','none');
$("#approvalexception").fadeIn(700);

</script>