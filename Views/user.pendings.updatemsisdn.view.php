<?php $responseMessage = $this->data("responseMessage"); ?>
<?php require_once("views.config.properties.php"); ?>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.loading_um, .ploading_um, .rloading_um, .revloading_um {
	height:25px;
	width:81px;
	float:right;
	background:url("<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif") no-repeat;
	display:none;
}
._updatemsisdn_um{
	display:none;margin-top:15px;
}
._accountsummary_um{
	width:100%;font-size:10px;
}
._m-top_um{
	margin-top:10px
}
</style>
<div id="updatemsisdn_um" class="_updatemsisdn_um">
	<div id="accountsummary_um" class="_accountsummary_um">
		<?php $pendingsubscriber = $this->data("updateMSISDNdata"); ?>
		<?php if(isset($pendingsubscriber->ResponseCode)){ ?>
		<?php if(is_array($pendingsubscriber->Value)){?>
		<div class="_m-top_um"></div>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="pendingmsisdn_um" width="100%">
			<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("ID"); ?></th>
							<th><?php echo _("OLD MSISDN"); ?></th>
							<th><?php echo _("MID"); ?></th>
							<th><?php echo _("TID"); ?></th>
							<th><?php echo _("NEW MSISDN"); ?></th>
							<th><?php echo _("REQUESTED BY"); ?></th>
							<th><?php echo _("TIMESTAMP"); ?></th>
							<th><?php echo _("STATUS"); ?></th>
							<th><?php echo _("ACTION"); ?></th>							
				</tr>
			</thead>
			<tbody>
				<?php $ctr=0; foreach($pendingsubscriber->Value as $t): $ctr++;?>
				<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="accountPending_um<?php echo $t->ID; ?>">
					<td><?php echo $t->ID; ?></td>
					<td><?php echo $t->OLDMSISDN; ?></td>
					<td><?php echo $t->MID; ?></td>
					<td><?php echo $t->TID; ?></td>
					<td><?php echo $t->NEWMSISDN; ?></td>
					<td><?php echo $t->USERID; ?></td>
					<td><?php echo $t->TIMESTAMP; ?></td>
					<td><?php echo $t->STATUS; ?></td>					
					<td>
						<!-- <a href="javascript:approverejectMSISDNUD('<?php echo $t->OLDMSISDN; ?>','<?php echo $t->NEWMSISDN; ?>','APPROVED','<?php echo $t->ID; ?>')">APPROVE</a> | <a href="javascript:approverejectMSISDNUD('<?php echo $t->OLDMSISDN; ?>','<?php echo $t->NEWMSISDN; ?>','REJECT','<?php echo $t->ID; ?>')">REJECT</a> -->
						<button class="btn btn-sm btn-primary approvereject-link_um" data-oldmsisdn="<?php echo $t->OLDMSISDN; ?>" data-newmsisdn="<?php echo $t->NEWMSISDN; ?>" data-action="APPROVED" data-id="<?php echo $t->ID; ?>">APPROVE</button> | <button class="btn btn-sm btn-primary approvereject-link_um" data-oldmsisdn="<?php echo $t->OLDMSISDN; ?>" data-newmsisdn="<?php echo $t->NEWMSISDN; ?>" data-action="REJECT" data-id="<?php echo $t->ID; ?>">REJECT</button>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php } else {
		echo "<h3>". $pendingsubscriber->Message ."</h3>";
	}?>
	<?php } ?>
</div>


<div id="dialogApprove_um" title="">
	<div class="dLock" align="center">
		<table class="text-start tablet">
			<tr>
				<td><?php echo _("Are you sure do you want to procceed?"); ?></td>
				<td>
					<button  id="btnApproveSubscriberUD" type = "button" class="ui-button ui-state-default ui-corner-all">Confirm</button>
					<div class="lockloading"></div>
					<input type='hidden' id='oldmsisdn' name='oldmsisdn'>
					<input type='hidden' id='newmsisdn' name='newmsisdn'>
					<input type='hidden' id='status' name='status'>
					<input type='hidden' id='ID' name='ID'>
				</td>
			</tr>
		</table>
	</div>
</div>

</div>		

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.textchange.min.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>


<script nonce="<?php echo $_SESSION['nonce'];?>">
	var ht = $("#updatemsisdn_um").css('height');
		ht = ht.replace("px","");
		
	$(document).ready(function() {
		$('.approvereject-link_um').on('click', function() {
			var oldmsisdn = $(this).data('oldmsisdn');
			var newmsisdn = $(this).data('newmsisdn');
			var action = $(this).data('action');
			var id = $(this).data('id');
			if (action =="REJECT"){
				var title = '<?php echo _("Reject MSISDN Update"); ?>'; 
			}else{
				var title = '<?php echo _("Approve MSISDN Update"); ?>';
			}
			$('#dialogApprove_um').dialog("option", "title", title);  
			approverejectMSISDNUD(oldmsisdn, newmsisdn, action, id);
		});

		oTable = $('#pendingmsisdn_um').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button",
		"aaSorting": [[0, "desc" ]],
		"bRetrieve": true
	});
	});
	$("#updatemsisdn_um").fadeIn(700);
	
	// Dialog			
	$('#dialogApprove_um').dialog({
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
	
function approverejectMSISDNUD(oldMSISDN, newMSISDN, status, ID){
	$("#oldmsisdn").val(oldMSISDN);
	$("#newmsisdn").val(newMSISDN);
	$("#status").val(status);
	$("#ID").val(ID);
	$("#dialogApprove_um").dialog('open');
}


$("#btnApproveSubscriberUD").click(function(){
	$("#btnApproveSubscriberUD").attr("disabled", true);
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
			type: 'post',
			dataType: 'json',
			data: {
				Method: 'approveUpdateMSISDN',
				oldMSISDN: $("#oldmsisdn").val(),
				newMSISDN: $("#newmsisdn").val(),
				status: $("#status").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				$("#btnApproveSubscriberUD").attr("disabled", false);
				if(json.ResponseCode == 0){
					$("#pending_acccount_view").dialog('close');
					$('#dialogApprove_um').dialog('close');
					$("#accountPending_um" + $("#ID").val()).css({display:'none'});
				} 
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});
			}, error: function(e){
				setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	$('#btnApproveSubscriberUD').prop("disabled", false);
});

$("#data_loading").css('display','none');
$("#pendingreg").fadeIn(700);



</script>