<div id="airconfig" style="width:100%;font-size:10px;display:none;">
	<?php $getAirConfigPndg = $this->data("getAirConfigPndg");?>
	<?php if(isset($getAirConfigPndg->ResponseCode)){ ?>
		<?php if(is_array($getAirConfigPndg->Value)){?>
			<div style="margin-top:10px";></div>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtairconfig" width="100%">
				<thead>
				<tr class="ui-widget-header">
					<th><?php echo _("PNDGID"); ?></th>
					<th><?php echo _("CREATED TIMESTAMP"); ?></th>
					<th><?php echo _("CONFIGURATIONS"); ?></th>														
					<th><?php echo _("CREATED BY"); ?></th>
					<th><?php echo _("Approve/Reject"); ?></th>							
				</tr>
				</thead>
				<tbody>
					<?php $ctr=0; foreach($getAirConfigPndg->Value as $t): $ctr++;?>
						
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="airt_<?php echo $t->PNDGID; ?>">
							<td><?php echo $t->PNDGID; ?></td>
							<td><?php echo $t->CREATEDDATE; ?></td>
							<td width="100%"><?php echo "TIMEOFFSET : (" . $t->TIMEOFFSET . "), FACTOR : (". $t->FACTOR . "), URL : (". $t->URL . "), CTYPE : (". $t->CTYPE . "), AGENT : (". $t->AGENT . "), IP : (". $t->IP . "), HOST : (". $t->HOST . "), PORT : (". $t->PORT . "), STATUS : (". $t->STATUS . "), CURRENCYTYPE : (". $t->CURRENCYTYPE . "), AUTHORIZATION : (". $t->AUTHORIZATION . "), REFILLID : (". $t->REFILLID . "), ACCEPTDECIMAL : (". $t->ACCEPTDECIMAL . "), TIMEOUT : (". $t->TIMEOUT . ")"; ?></td>									
							<td><?php echo $t->CREATEDBY; ?></td>
							<td><a href="javascript:approveAirConfigPndg('APPROVE','<?php echo $t->PNDGID; ?>');"><?php echo ($this->getRolesConfig('APPROVE_SYSTEM_INFO_EDIT')) ? 'Approve' : ''; ?></a> |
								<a href="javascript:approveAirConfigPndg('REJECT','<?php echo $t->PNDGID; ?>');"><?php echo ($this->getRolesConfig('REJECT_SYSTEM_INFO_EDIT')) ? 'Reject' : ''; ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php } else {
			echo "<h3> No Records Found : $getAirConfigPndg->Message</h3>";
		}?>
	<?php } ?>
</div>
<script>
	$(document).ready(function() {
			oTable = $('#dtairconfig').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		} );
	$("#airconfig").fadeIn(700);
	function approveAirConfigPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveTerminalIDPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				$('.scloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){

								$("#airt_" + strid).hide();		
							}							
							$('.scloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    
	}
	
</script>