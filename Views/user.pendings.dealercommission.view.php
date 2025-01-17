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
				<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission.php" method="post">
					<input type="hidden" name="Method" value="getDealerCommissionForConfirmation" />
					
					<input type="hidden" name="perpage" value="10" />
					<input type="hidden" name="pagenum" value="1" />
					<table class="tblRegisterUser" width="85%">
					 <tr>
					   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransRdatefrom" name="TransRdatefrom" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransRdatefrom']);?>" readonly="true"/></td>
					   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransRdateto" name="TransRdateto" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransRdateto']);?>" readonly="true"/></td>
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
				<div>
					<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission.php?Method=ExportConfirmationCSV&TransRdatefrom=<?php echo $_REQUEST['TransRdatefrom'];?>&TransRdateto=<?php echo $_REQUEST['TransRdateto'];?>&queryCount=<?php echo $getCommissionsPndgForConfirmation->QueryCount;?>">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
					</a>
				</div>
					<div style="margin-top:10px";></div>
					<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission.php" method="post">			
					<select id="lookUp" name="perpage" style="width:20%;" >
						<option value="10" <?php echo ($_REQUEST['perpage']==10)?'selected':'';?>>10 Per Page</option>
						<option value="15" <?php echo ($_REQUEST['perpage']==15)?'selected':'';?>>15 Per Page</option>
						<option value="25" <?php echo ($_REQUEST['perpage']==25)?'selected':'';?>>25 Per Page</option>
					</select>
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtdealercommissionC" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("ID"); ?></th>
							<th><?php echo _("REFERENCEID"); ?></th>
							<th><?php echo _("CREATED TIMESTAMP"); ?></th>
							<th><?php echo _("TYPE"); ?></th>
							<th><?php echo _("COMMISSION ACCOUNT"); ?></th>
							<th><?php echo _("DEALER ACCOUNT"); ?></th>													
							<th><?php echo _("NAME"); ?></th>
							<th><?php echo _("AMOUNT"); ?></th>
							<!--<th><?php echo _("Approve/Reject"); ?></th>-->
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getCommissionsPndgForConfirmation->Value as $t): $ctr++;?>
								
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="dcommi_<?php echo $t->ID; ?>">
									<td><?php echo $t->ID; ?></td>
									<td><?php echo $t->REFERENCETO; ?></td>
									<td><?php echo $t->TIMESTAMP; ?></td>
									<td><?php echo $t->TYPE; ?></td>
									<td><?php echo $t->FRMSISDN; ?></td>										
									<td><?php echo $t->TOMSISDN; ?></td>
									<td><?php echo $t->NAME; ?></td>
									<td><?php echo $t->AMOUNT; ?></td>
									<!--<td><a href="javascript:approveRejectCommissionsPending('APPROVED','<?php echo $t->ID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_DEALER_COMMISSION')) ? 'Approve' : ''; ?></a> |
										<a href="javascript:approveRejectCommissionsPending('REJECTED','<?php echo $t->ID; ?>');"><?php echo ($this->getRolesConfig('REJECT_DEALER_COMMISSION')) ? 'Reject' : ''; ?></a>
									</td>-->
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
						<div style="margin-top:-45px";></div>
						
							<input type="hidden" name="Method" value="getDealerCommissionForConfirmation" />
							<input type="hidden" name="TransRdatefrom" value="<?php echo sanitize_string($_REQUEST['TransRdatefrom']);?>" />
							<input type="hidden" name="TransRdateto" value="<?php echo sanitize_string($_REQUEST['TransRdateto']);?>" />
							<input type="hidden" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']);?>" />
							
							First <input type="submit" name="pagenum" value="1" class="ui-state-default ui-corner-all ui-button" <?php if(1 == $_REQUEST['pagenum']){ echo "disabled=true"; }?>><<
							
							<?php 
							$l = ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']) - $_REQUEST['pagenum'];
							$l = 9 - $l;
							if($l < 1){ 
								if($_REQUEST['pagenum'] != 1){ ?>
								<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])-1; ?>" class="ui-state-default ui-corner-all ui-button">
							<?php }
							}
							while($l > 0){ 
								if($_REQUEST['pagenum']-$l > 1){?>
								<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])-$l; ?>" class="ui-state-default ui-corner-all ui-button">
							<?php }
							$l--;} ?>
							
							<?php $i=0;	while($i < 10){
								if($_REQUEST['pagenum']+$i <= ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage'])){?>
							<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])+$i; ?>" class="ui-state-default ui-corner-all ui-button" <?php if(($_REQUEST['pagenum']+$i) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>>
							<?php } $i++;} ?>
							
							>><input type="submit" name="pagenum" value="<?php echo ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>> Last
						</form><br>
						
						<?php echo "Page " . ($_REQUEST['pagenum']) . " of ". ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']); ?>
						<?php echo " of total $getCommissionsPndgForConfirmation->QueryCount entries"; ?>					
						<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found</h3>";
				}?>
				
				<?php if(is_array($getCommissionsPndgForConfirmation->QuerySum)){?>
				
				<table width="50%" id="dtdcsummaryC">
				<thead>
					<tr>
						<th>NAME</th>
						<th>AMOUNT</th>
						<th>Confirm / Reject</th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr=0; $total=0; foreach($getCommissionsPndgForConfirmation->QuerySum as $t): $ctr++; $total=$total+$t->AMOUNT;?>
						<tr id="x_<?php echo $ctr; ?>">
						<td><?php echo $t->NAME; ?></td>
						<td><?php echo $t->AMOUNT; ?></td>
						<td><a href="javascript:approveRejectCommissionsPendingForConfirmation('CONFIRMED','<?php echo $t->NAME; ?>','<?php echo sanitize_string($_REQUEST['TransRdatefrom']); ?>','<?php echo sanitize_string($_REQUEST['TransRdateto']); ?>','<?php echo $ctr; ?>');"><?php echo ($this->getRolesConfig('CONFIRM_DEALER_COMMISSION')) ? 'Confirm' : ''; ?></a> | <a href="javascript:approveRejectCommissionsPendingForConfirmation('REJECTED','<?php echo $t->NAME; ?>','<?php echo sanitize_string($_REQUEST['TransRdatefrom']); ?>','<?php echo sanitize_string($_REQUEST['TransRdateto']); ?>','<?php echo $ctr; ?>');"><?php echo ($this->getRolesConfig('REJECT_CONFIRM_DEALER_COMMISSION')) ? 'Reject' : ''; ?></a></td>
						</tr>
					<?php endforeach; ?>
						<tr>
							<td>TOTAL AMOUNT</td>
							<td><?php echo $total; ?></td>
							<td>For Confirmation</td>
						</tr>
				</tbody>
				</table>
				<?php }?>
				
			<?php } ?>
		</div>
		
		<div id="dCommApprovalTab" style="margin-top:15px;">
			<div id="reports_summary">
				<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission.php" method="post">
					<input type="hidden" name="Method" value="getDealerCommission" />
					
					<input type="hidden" name="perpage" value="10" />
					<input type="hidden" name="pagenum" value="1" />
					<table class="tblRegisterUser" width="85%">
					 <tr>
					   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransHdatefrom" name="TransHdatefrom" style="width:50%;" value="<?php echo $_REQUEST['TransHdatefrom'];?>" readonly="true"/></td>
					   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
					   <td><input type="text" id="TransHdateto" name="TransHdateto" style="width:50%;" value="<?php echo $_REQUEST['TransHdateto'];?>" readonly="true"/></td>
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
				<div>
					<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission.php?Method=ExportApprovalCSV&TransHdatefrom=<?php echo sanitize_string($_REQUEST['TransHdatefrom']);?>&TransHdateto=<?php echo sanitize_string($_REQUEST['TransHdateto']);?>&queryCount=<?php echo $getCommissionsPndg->QueryCount;?>">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
					</a>
				</div>
					<div style="margin-top:10px";></div>
					<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission.php" method="post">			
					<select id="lookUp" name="perpage" style="width:20%;" >
						<option value="10" <?php echo ($_REQUEST['perpage']==10)?'selected':'';?>>10 Per Page</option>
						<option value="15" <?php echo ($_REQUEST['perpage']==15)?'selected':'';?>>15 Per Page</option>
						<option value="25" <?php echo ($_REQUEST['perpage']==25)?'selected':'';?>>25 Per Page</option>
					</select>
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtdealercommissionC" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("ID"); ?></th>
							<th><?php echo _("REFERENCEID"); ?></th>
							<th><?php echo _("CREATED TIMESTAMP"); ?></th>
							<th><?php echo _("TYPE"); ?></th>
							<th><?php echo _("COMMISSION ACCOUNT"); ?></th>
							<th><?php echo _("DEALER ACCOUNT"); ?></th>													
							<th><?php echo _("NAME"); ?></th>
							<th><?php echo _("AMOUNT"); ?></th>
							<!--<th><?php echo _("Approve/Reject"); ?></th>-->
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getCommissionsPndg->Value as $t): $ctr++;?>
								
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="dcommi_<?php echo $t->ID; ?>">
									<td><?php echo $t->ID; ?></td>
									<td><?php echo $t->REFERENCETO; ?></td>
									<td><?php echo $t->TIMESTAMP; ?></td>
									<td><?php echo $t->TYPE; ?></td>
									<td><?php echo $t->FRMSISDN; ?></td>										
									<td><?php echo $t->TOMSISDN; ?></td>
									<td><?php echo $t->NAME; ?></td>
									<td><?php echo $t->AMOUNT; ?></td>
									<!--<td><a href="javascript:approveRejectCommissionsPending('APPROVED','<?php echo $t->ID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_DEALER_COMMISSION')) ? 'Approve' : ''; ?></a> |
										<a href="javascript:approveRejectCommissionsPending('REJECTED','<?php echo $t->ID; ?>');"><?php echo ($this->getRolesConfig('REJECT_DEALER_COMMISSION')) ? 'Reject' : ''; ?></a>
									</td>-->
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
						<div style="margin-top:-45px";></div>
						
							<input type="hidden" name="Method" value="getDealerCommission" />
							<input type="hidden" name="TransHdatefrom" value="<?php echo sanitize_string($_REQUEST['TransHdatefrom']);?>" />
							<input type="hidden" name="TransHdateto" value="<?php echo sanitize_string($_REQUEST['TransHdateto']);?>" />
							<input type="hidden" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']);?>" />
							
							First <input type="submit" name="pagenum" value="1" class="ui-state-default ui-corner-all ui-button" <?php if(1 == $_REQUEST['pagenum']){ echo "disabled=true"; }?>><<
							
							<?php 
							$l = ceil($getCommissionsPndg->QueryCount/$_REQUEST['perpage']) - $_REQUEST['pagenum'];
							$l = 9 - $l;
							if($l < 1){ 
								if($_REQUEST['pagenum'] != 1){ ?>
								<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])-1; ?>" class="ui-state-default ui-corner-all ui-button">
							<?php }
							}
							while($l > 0){ 
								if($_REQUEST['pagenum']-$l > 1){?>
								<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])-$l; ?>" class="ui-state-default ui-corner-all ui-button">
							<?php }
							$l--;} ?>
							
							<?php $i=0;	while($i < 10){
								if($_REQUEST['pagenum']+$i <= ceil($getCommissionsPndg->QueryCount/$_REQUEST['perpage'])){?>
							<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])+$i; ?>" class="ui-state-default ui-corner-all ui-button" <?php if(($_REQUEST['pagenum']+$i) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>>
							<?php } $i++;} ?>
							
							>><input type="submit" name="pagenum" value="<?php echo ceil($getCommissionsPndg->QueryCount/$_REQUEST['perpage']); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(ceil($getCommissionsPndg->QueryCount/$_REQUEST['perpage']) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>> Last
						</form><br>
						
						<?php echo "Page " . ($_REQUEST['pagenum']) . " of ". ceil($getCommissionsPndg->QueryCount/$_REQUEST['perpage']); ?>
						<?php echo " of total $getCommissionsPndg->QueryCount entries"; ?>					
						<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found</h3>";
				}?>
				
				<?php if(is_array($getCommissionsPndg->QuerySum)){?>
				
				<table width="50%" id="dtdcsummaryC">
				<thead>
					<tr>
						<th>NAME</th>
						<th>AMOUNT</th>
						<th>Approve / Reject</th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr=0; $total=0; foreach($getCommissionsPndg->QuerySum as $t): $ctr++; $total=$total+$t->AMOUNT;?>
						<tr id="<?php echo $ctr; ?>">
						<td><?php echo $t->NAME; ?></td>
						<td><?php echo $t->AMOUNT; ?></td>
						<td><a href="javascript:approveRejectCommissionsPending('APPROVED','<?php echo $t->NAME; ?>','<?php echo sanitize_string($_REQUEST['TransHdatefrom']); ?>','<?php echo sanitize_string($_REQUEST['TransHdateto']); ?>','<?php echo $ctr; ?>');"><?php echo ($this->getRolesConfig('APPROVE_DEALER_COMMISSION')) ? 'Approve' : ''; ?></a> | <a href="javascript:approveRejectCommissionsPending('REJECTED','<?php echo $t->NAME; ?>','<?php echo sanitize_string($_REQUEST['TransHdatefrom']); ?>','<?php echo sanitize_string($_REQUEST['TransHdateto']); ?>','<?php echo $ctr; ?>');"><?php echo ($this->getRolesConfig('REJECT_DEALER_COMMISSION')) ? 'Reject' : ''; ?></a></td>
						</tr>
					<?php endforeach; ?>
						<tr>
							<td>TOTAL AMOUNT</td>
							<td><?php echo $total; ?></td>
							<td>For Approval</td>
						</tr>
				</tbody>
				</table>
				<?php }?>
				
			<?php } ?>
		</div>

		
</div><div class="dcommiloading"></div>
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
var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
$(document).ready(function() {
			oTable = $('#dtdealercommission, #dtdealercommissionC').dataTable({
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
			$("#if_pendings_dealercommission",window.parent.document).css('height',parseInt(ht)+200);
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
	
	function approveRejectCommissionsPendingForConfirmation(strremarks, strid, strfromdate, strtodate, strremove){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveRejectCommissionsPendingForConfirmation',
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