<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
._m-top{
	margin-top:40px;
}
._container{
	width:100%;font-size:10px;
}
</style>
<div class="_m-top"></div>
<?php $reports = $this->data("reports"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<div class="_container">
	<?php if(isset($reports)): ?>
		<?php if($reports->ResponseCode==0): $trans = $reports->Value?>
			<?php if(is_array($trans)): ?>				
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="auditlog" width="100%">
					<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("USER NAME"); ?></th>
							<th><?php echo _("MODULE"); ?></th>
							<th><?php echo _("LOG"); ?></th>
							<th><?php echo _("IP"); ?></th>
							<th><?php echo _("TRANSACTION DATE"); ?></th>
						</tr>
						<tbody>
							<?php $ctr=0; foreach($trans as $t): $ctr++;?>
								
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
									<td><?php echo $t->USERNAME; ?></td>
									<td align="left"><?php echo $t->MODULE; ?></td>
									<td align="left"><?php echo $t->LOG; ?></td>
									<td><?php echo $t->IP; ?></td>
									<td><?php echo $t->TIMESTAMP; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					<thead>
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




<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">

	

	loadTable();
	function loadTable(){
		oTable = $('#auditlog').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "two_button",
			"iDisplayLength": 15
		});
		
		$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
			type:"POST",
			complete:function(res,status){
				window.parent.pagetoken = res.responseText;
				setTimeout($.unblockUI, 1000);
			}
		});
	} ;
</script>
<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
</script>