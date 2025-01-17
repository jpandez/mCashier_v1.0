<?php require_once("views.config.properties.php"); ?>
<?php $reports = $this->data("reports"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<div style="width:100%;font-size:10px;">
	<?php if(isset($reports)): ?>
		<?php if($reports->ResponseCode==0): $trans = $reports->Value?>
			<?php if(is_array($trans)): ?>				
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="commSum">
						<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("COMMISSION TYPE"); ?></th>
								<th><?php echo _("AMOUNT"); ?></th>
							</tr>
						<thead>
							<tbody>
								<?php $ctr=0; foreach($trans as $t): $ctr++;?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->TITLE; ?></td>
										<td>
										<?php if($t->TITLE != 'TOTAL'){ ?>
											<a href="javascript:viewFileSummaryDetails('<?php echo $t->TITLE ?>','<?php echo $t->RUNID ?>');">
												<?php echo $t->AMOUNT; ?>
											</a>
										<?php }else{ echo $t->AMOUNT; } ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
					</table>
			<?php endif;?>
		<?php endif;?>
		<?php if($reports->ResponseCode!=0):?>
			<h3><?php echo $reports->Message; ?></h3>
		<?php elseif(!is_array($reports->Value)): ?>
			<h3><?php echo $reports->Value; ?></h3>
		<?php endif;?>
	<?php endif; ?>
</div>
<div id="dialogDetails" title="<?php echo _("Commission File Summary Details"); ?>">
    <div id="DetailsContent" style="width:100%;border:1px solid lightgray;text-align:center;"></div>
</div>
<script type="text/javascript" charset="utf-8">

$('#dialogDetails').dialog({
		autoOpen: false,
		width: 900,
		draggable: true,
		resizable: false,
		modal:true,
		position: 'top'
	});

			loadTable1();
			function loadTable1(){
				oTable = $('#commSum').dataTable({
					"bJQueryUI": true,
					"bPaginate": false,
					"bFilter": false,
					"bInfo": false,
					"bSort": false
				});
				
			} ;
	
	function viewFileSummaryDetails(strtitle,strrunid){
		var params = {
				runid:strrunid,
				title:strtitle
			};
			var file_summary_details = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.pendings.dealercommission1sumdetails.iframe.php";
				
				$("#DetailsContent").load(file_summary_details,params,function(){
					$('#dialogDetails').dialog('open');
					
				});
	        
	}
	
</script>
<script type="text/javascript">
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
</script>