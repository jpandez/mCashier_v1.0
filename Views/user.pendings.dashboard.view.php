<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.loading, .ploading, .rloading, .revloading {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
._dashboard{
	display:none;margin-top:15px;
}
._accountsummary{
	width:100%;font-size:10px;
}
._tablet{
	text-align:left;
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
<div id="dashboard" class="_dashboard">
<div id="accountsummary" class="_accountsummary">
<?php $subscriberDashboard = $this->data("subscriberDashboard"); ?>
<?php if(isset($subscriberDashboard->ResponseCode)){ ?>
	<?php if(is_array($subscriberDashboard->Value)){?>
		<div class="_m-top"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="dashboard_table" width="100%">
			<thead>
			<tr class="ui-widget-header">
			
							<th><?php echo _("DATE REGISTERED"); ?></th>
							<th><?php echo _("REGISTRATION NUMBER"); ?></th>
							<th><?php echo _("COMPANY"); ?></th>
							<th><?php echo _("MSISDN"); ?></th>
							<th><?php echo _("FIRST NAME"); ?></th>
							<th><?php echo _("LASTNAME"); ?></th>
							<th><?php echo _("ACCOUNT TYPE"); ?></th>
							<th><?php echo _("STATUS"); ?></th>
							<th><?php echo _("HOLDING APPLICATION"); ?></th>
							<th><?php echo _("ACTION"); ?></th>
			</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($subscriberDashboard->Value as $t): $ctr++;?>
					<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" ><!-- id="accountPending_<?php echo $t->MSISDN; ?>"> -->
									<td><?php echo $t->REGDATE; ?></td>
									<td><?php echo $t->APPLICATIONID; ?></td>
									<td><?php echo $t->COMPANY; ?></td>
									<td><?php if ($t->MSISDN == $t->ID){
										echo '';
									} else {
										echo $t->MSISDN;
									} ?></td>
									<!--<td></td>-->
									<td><?php echo $t->FIRSTNAME; ?></td>
									<td><?php echo $t->LASTNAME; ?></td>
									<td><?php echo $t->TYPE; ?></td>
									<td><?php echo $t->BANKSTATUS; ?></td>
									<td><?php echo $t->USERPROFILE; ?></td>
									
									<td> <?php if(($t->KYC) != 'REJECTED' &&($t->KYC) != 'FOR SHARAFDG APPROVAL' && ($t->KYC) != 'CANCELLED') { ?>
										<button class="btn btn-sm btn-primary cancel-link" data-application-id="<?php echo $t->APPLICATIONID; ?>" data-action="CANCEL">CANCEL</button>
										<!-- <a href="javascript:cancelRestorePNDG('<?php echo $t->APPLICATIONID; ?>','CANCEL')">CANCEL</a> -->
									<?php } else if(($t->KYC) == 'CANCELLED'){ ?>
										<button class="btn btn-sm btn-primary cancel-link" data-application-id="<?php echo $t->APPLICATIONID; ?>" data-action="RESTORE">RESTORE</button>
										<!-- <a href="javascript:cancelRestorePNDG('<?php echo $t->APPLICATIONID; ?>','RESTORE')">RESTORE</a> -->
									<?php } ?>
									</td>
									
						
								
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php } 
		else {
			echo "<h3>". $subscriberDashboard->Message ."</h3>";
		}?>
<?php } ?>
</div>

<div id="dialogCancellpndg" title="">
	<div class="dLock" align="center">
		<table class="tablet _tablet">
			<tr>
				<td><?php echo _("Are you sure do you want to procceed?"); ?></td>
				<td>
					<button  id="btnApproveSubscriber" type = "button" class="ui-button ui-state-default ui-corner-all"></button>
					<div class="lockloading"></div>
					<input type='hidden' id='status' name='status'>
					<input type='hidden' id='pndgID' name='pndgID'>
				</td>
			</tr>
		</table>
	</div>
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



		var ht = $("#dashboard").css('height');
		ht = ht.replace("px","");
		//$("#pendingreg",window.parent.document).css('height',parseInt(ht)+200);
$(document).ready(function() {

	$('.cancel-link').on('click', function() {
        var applicationId = $(this).data('application-id');
        var action = $(this).data('action');
		if (action =="CANCEL"){
				var title = '<?php echo _("CANCEL MSISDN Update") ?>'; 
			}else{
				var title = '<?php echo _("RESTORE MSISDN Update") ?>';
			}
			$('#dialogCancellpndg').dialog("option", "title", title);  
        cancelRestorePNDG(applicationId, action);
    });
	
	$(".buttonx").button();

	oTable = $('#dashboard_table').dataTable({
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

$('#dialogCancellpndg').dialog({
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

function cancelRestorePNDG(pngID,status){
	$("#status").val(status);
	$("#pndgID").val(pngID);
	$("#btnApproveSubscriber").html(status);;
	$("#dialogCancellpndg").dialog('open');
}

$("#btnApproveSubscriber").click(function(){
	$("#btnApproveSubscriber").attr("disabled", true);
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'cancelRestorePNDGRegistration',
				pndgID: $("#pndgID").val(),
				status: $("#status").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				$("#btnApproveSubscriber").attr("disabled", false);
				if(json.ResponseCode == 0){
					$('#dialogCancellpndg').dialog('close');
					$("#accountPending_" + $("#ID").val()).css({display:'none'});
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); location.reload(); } } , close: function() { location.reload(); } });
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); location.reload(); } } , close: function() { location.reload(); }});
		}
		});
	$('#btnApproveSubscriber').prop("disabled", false);
});

$("#data_loading").css('display','none');
$("#dashboard").fadeIn(700);

</script>
