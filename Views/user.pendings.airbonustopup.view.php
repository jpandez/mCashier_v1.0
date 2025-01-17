<div id="airbonustopuppndg" style="display:none;">
	<div id="accountsummary" style="width:100%;font-size:10px;">
		<?php $getAirBonusTopupPndg = $this->data("getAirbonusTopupPndg");?>
		<?php if(isset($getAirBonusTopupPndg->ResponseCode)){ ?>
				<?php if(is_array($getAirBonusTopupPndg->Value)){?>
				<div style="margin-top:10px"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtairbonustopuppndg" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ID"); ?></th>
						<th><?php echo _("CREATED TIMESTAMP"); ?></th>
						<th><?php echo _("CONFIGURATIONS"); ?></th>
						<th><?php echo _("CREATED BY"); ?></th>
						<th><?php echo _("EDIT REQUEST"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($getAirBonusTopupPndg->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="airbonus_<?php echo $t->PNDGID; ?>">
								<td><?php echo $t->PNDGID; ?></td>
								<td><?php echo $t->CREATEDDATE; ?></td>
								<td width="89%"><?php echo "ID : (" . $t->ID ."), PRODUCTID : (" . $t->PRODUCTID . "), MINRANGE : (". $t->MINRANGE . "), MAXRANGE : (". $t->MAXRANGE . "), SERVICECLASS : (". $t->SERVICECLASS . "), DEDICATEDACCOUNTID : (". $t->DEDICATEDACCOUNTID . "), FIXEDAMOUNT : (". $t->FIXEDAMOUNT . "), PERCENTAMOUNT : (". $t->PERCENTAMOUNT . "), EXPIRYDAYS : (". $t->EXPIRYDAYS . "), EXPIRYDATE : (". $t->EXPIRYDATE . "), NAME : (". $t->NAME . "), CELLIDMINRANGE : (". $t->CELLIDMINRANGE . "), CELLIDMAXRANGE : (" . $t->CELLIDMAXRANGE . ")"; ?></td>
								<td><?php echo $t->CREATEDUSER; ?></td>
								<td width="100%">
									<a href="javascript:approveAirBonusTopupPndg('APPROVE','<?php echo $t->PNDGID; ?>')"><?php echo _("Approve"); ?></a> | 
									<a href="javascript:approveAirBonusTopupPndg('REJECT','<?php echo $t->PNDGID; ?>')"><?php echo _("Reject"); ?></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php } else {
				echo "<h3> No Records Found : $getAirBonusTopupPndg->Message</h3>";
			}?>
		<?php } ?>
	</div>	
</div>

<script type="text/javascript" src="../../Views/js/functions.js"></script>
<script type="text/javascript" src="../../Views/js/ajaxmethods.js"></script>
<script type="text/javascript">
	$(function(){
		$('#dtairbonustopuppndg').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button"
		});
	});
	$("#airbonustopuppndg").fadeIn(700);

	function approveAirBonusTopupPndg(strremarks, strid){
		var r=confirm("Press OK if you are sure you want to "+strremarks);
		if (r==true)
			{
	        var params = {
					Method:'approveAirBonusTopupPndg',
					remarks:strremarks,
					id:strid,
					FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};
				//$('.scloading').fadeToggle(300);			
				$.ajax({url:service_url,
						type:"POST", 
						data:params,
						dataType:'json',
						success:function(json){
							if(json.ResponseCode == 0){
								$("#airbonus_" + strid).hide();		
							}							
							//$('.scloading').fadeToggle(300,'linear',function(){
									$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
							//});
						}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
				});
			}                    


	}

</script>