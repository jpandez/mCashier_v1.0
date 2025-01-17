<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<body style="background-color:white;background-image:none;">
<div id="dealercommi" style="display:none;">
<div class="uitabs" id="tabs">
		<ul>
			<?php if($this->getRolesConfig('VIEW_PENDING_DEALER_COMMISSION')){ ?>
			<li><a href="#dCommConfirmationTab"><?php echo _("Dealer Commission Confirmation"); ?></a></li><?php }?>
			<?php if($this->getRolesConfig('VIEW_PENDING_DEALER_COMMISSION')){ ?>
			<li><a href="#dCommApprovalTab"><?php echo _("Dealer Commission Approval"); ?></a></li><?php }?>
			
		</ul>
		<div id="dCommConfirmationTab" style="margin-top:15px;">		
			<div id="reports_summary">
				<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission1.php" method="post">
					<input type="hidden" name="Method" value="getDealerCommissionForConfirmation" />
					
					<input type="hidden" name="perpage" value="10" />
					<input type="hidden" name="pagenum" value="1" />
					<table class="tblRegisterUser" width="85%">
					 <tr>
					   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransDdatefrom" name="TransDdatefrom" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransDdatefrom']);?>" readonly="true"/></td>
					   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransDdateto" name="TransDdateto" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransDdateto']);?>" readonly="true"/></td>
					   <td align="center">
							<input type="submit" id="btnTransH" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
							<div class="sloading"></div>
						</td>
					 </tr>
				   </table>
				  </form>
			</div>

			<?php $getCommissionsPndgForConfirmation = $this->data("getCommissionsPndgForConfirmation");?>
			<?php if(isset($getCommissionsPndgForConfirmation->ResponseCode)){ ?>
				<?php if(is_array($getCommissionsPndgForConfirmation->Value)){?>
				
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="dt1" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("RUN ID"); ?></th>
							<th><?php echo _("RUN DATE"); ?></th>
							<th><?php echo _("FILE NAME"); ?></th>
							<th><?php echo _("FILE SUMMARY"); ?></th>
							<th><?php echo _("Request confirmation"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getCommissionsPndgForConfirmation->Value as $t): $ctr++; ?>
								
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="x_<?php echo $ctr; ?>">
									<td><?php echo $t->RUNID; ?></td>
									<td><?php echo $t->RUNDATE; ?></td>
									<td><?php echo $t->FILENAME; ?></td>
									<td>									
									<a href="javascript:viewFileSummary('<?php echo $t->RUNID ?>');">
										<?php echo 'View Summary'; ?>
									</a>									
									</td>
									<td>									
									<a href="javascript:approveRejectCommissionsForConfirmation('CONFIRMED','<?php echo $t->RUNID ?>','<?php echo $ctr; ?>');">
										<?php echo ($this->getRolesConfig('CONFIRM_DEALER_COMMISSION')) ? 'Confirm' : ''; ?>
									</a> | 
									<a href="javascript:approveRejectCommissionsForConfirmation('REJECTED','<?php echo $t->RUNID ?>','<?php echo $ctr; ?>');">
										<?php echo ($this->getRolesConfig('REJECT_CONFIRM_DEALER_COMMISSION')) ? 'Reject' : ''; ?>
									</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				
				<?php } else {
					echo "<h3> No Records Found</h3>";
				}?>
			
				
			<?php } ?>
		</div>
		
		<div id="dCommApprovalTab" style="margin-top:15px;">
			<div id="reports_summary2">
				<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission1.php" method="post">
					<input type="hidden" name="Method" value="getDealerCommission" />
					
					<input type="hidden" name="perpage" value="10" />
					<input type="hidden" name="pagenum" value="1" />
					<table class="tblRegisterUser" width="85%">
					 <tr>
					   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransHdatefrom" name="TransHdatefrom" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransHdatefrom']);?>" readonly="true"/></td>
					   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransHdateto" name="TransHdateto" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransHdateto']);?>" readonly="true"/></td>
					   <td align="center">
							<input type="submit" id="btnTransH" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
							<div class="sloading"></div>
						</td>
					 </tr>
				   </table>
				  </form>
			</div>

			<?php $getCommissionsPndg = $this->data("getCommissionsPndg");?>
			<?php if(isset($getCommissionsPndg->ResponseCode)){ ?>
				<?php if(is_array($getCommissionsPndg->Value)){?>
				
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="dt2" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("RUN ID"); ?></th>
							<th><?php echo _("RUN DATE"); ?></th>
							<th><?php echo _("FILE NAME"); ?></th>
							<th><?php echo _("FILE SUMMARY"); ?></th>
							<th><?php echo _("CONFIRMED BY"); ?></th>
							<th><?php echo _("CONFIRMED DATE"); ?></th>
							<th><?php echo _("For approval"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getCommissionsPndg->Value as $t): $ctr++; ?>
								<?php if ($t->CONFIRMBY != $_SESSION["currentUser"]){ ?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="y_<?php echo $ctr; ?>">
									<td><?php echo $t->RUNID; ?></td>
									<td><?php echo $t->RUNDATE; ?></td>
									<td><?php echo $t->FILENAME; ?></td>
									<td>									
									<a href="javascript:viewFileSummary('<?php echo $t->RUNID ?>');">
										<?php echo 'View Summary'; ?>
									</a>									
									</td>
									<td><?php echo $t->CONFIRMBY; ?></td>
									<td><?php echo $t->CONFIRMDATE; ?></td>
									<td>									
									<a href="javascript:approveRejectCommissionsForApproval('APPROVED','<?php echo $t->RUNID ?>','<?php echo $ctr; ?>');">
										<?php echo ($this->getRolesConfig('APPROVE_DEALER_COMMISSION')) ? 'Approve' : ''; ?>
									</a> | 
									<a href="javascript:approveRejectCommissionsForApproval('REJECTED','<?php echo $t->RUNID ?>','<?php echo $ctr; ?>');">
										<?php echo ($this->getRolesConfig('REJECT_DEALER_COMMISSION')) ? 'Reject' : ''; ?>
									</a>
									</td>
								</tr>
								<?php } ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					
				<?php } else {
					echo "<h3> No Records Found</h3>";
				}?>
				
			<?php } ?>
		</div>

<div id="dialogSummary" title="<?php echo _("Commission File Summary"); ?>">
    <div id="SummaryContent" style="width:100%;border:1px solid lightgray;text-align:center;"></div>
</div>
</div>

<div class="dcommiloading"></div>

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
$('#dialogSummary').dialog({
		autoOpen: false,
		width: 450,
		draggable: true,
		resizable: false,
		modal:true,
		position: 'top'
	});
$("#reports_summary").hide();
$("#reports_summary2").hide();
var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
$(document).ready(function() {
			oTable = $('#dtdealercommission, #dtdealercommissionC, #dt1, #dt2').dataTable({
				"bJQueryUI": true,
				"bPaginate": false,
				"bFilter": false,
				"bInfo": false,
				"aaSorting": [[ 2, "desc" ]]
			});
			oTable = $('#dtdcsummary, #dtdcsummaryC').dataTable({
				"bJQueryUI": true,
				"bPaginate": false,
				"bFilter": false,
				"bInfo": false
			});
			
			var ht = $("#dealercommi").css('height');
			ht = ht.replace("px","");
			$("#if_pendings_dealercommission1",window.parent.document).css('height',parseInt(ht)+200);
		} );
$("#dealercommi").fadeIn(700);
function approveRejectCommissionsPending(strremarks, strid, strfromdate, strtodate, strremove){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveRejectCommissionsPending',
					remarks:strremarks,
					id:strid,
					fromdate:strfromdate,
					todate:strtodate,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.dcommiloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#" + strremove).remove();		
							}							
							$('.dcommiloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	
	function approveRejectCommissions1PendingForConfirmation(strremarks, strfromdate, strtodate, strtype,strremove){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveRejectCommissions1PendingForConfirmation',
					remarks:strremarks,
					commissionType:strtype,
					fromdate:strfromdate,
					todate:strtodate,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.dcommiloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#x_" + strremove).remove();		
							}							
							$('.dcommiloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	
	function approveRejectCommissions1PendingForApproval(strremarks, strfromdate, strtodate, strtype,strremove){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveRejectCommissions1PendingForApproval',
					remarks:strremarks,
					commissionType:strtype,
					fromdate:strfromdate,
					todate:strtodate,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.dcommiloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#" + strremove).remove();		
							}							
							$('.dcommiloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	
	function approveRejectCommissionsForConfirmation(strremarks, strrunid,strremove){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveRejectCommissionsForConfirmation',
					remarks:strremarks,
					runid:strrunid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.dcommiloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#x_" + strremove).remove();		
							}							
							$('.dcommiloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	
	function approveRejectCommissionsForApproval(strremarks, strrunid,strremove){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveRejectCommissionsForApproval',
					remarks:strremarks,
					runid:strrunid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.dcommiloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#y_" + strremove).remove();		
							}							
							$('.dcommiloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	var selectedRunId = "0";
	function viewFileSummary(strrunid){
		selectedRunId = strrunid;
		var params = {
				runid:strrunid
			};
			var file_summary = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.dealercommission1sum.php";
				$('.dcommiloading').show();
				$("#SummaryContent").load(file_summary,params,function(){
					$('#dialogSummary').dialog('open');
					$('.dcommiloading').hide();
				});
	        
	}
	

	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
	<?php 
        if(isset($_REQUEST['Method'])){
            switch($_REQUEST["Method"]){
            	case "getDealerCommission":
					echo "$('#tabs').tabs({ selected: 1 });";
				break;
            }
    } ?>
</script>