<?php require_once("views.config.properties.php"); ?>
<style type="text/css">
.tblwrap {border-collapse:collapse; table-layout:fixed; width:100%;}
.tdwrap {width:100px; word-wrap:break-word;}
</style>
<?php $reports = $this->data("reports"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<div style="width:100%;font-size:10px;">
	<?php if(isset($reports)): ?>
		<?php if($reports->ResponseCode==0): $trans = $reports->Value?>
			<?php if(is_array($trans)): ?>
					<div style="margin-top:20px;margin-bottom:50px;position: relative;display: inline-block;vertical-align: middle;">
						<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.globalsearchrefid.php?Method=ExportToCSV&referenceid=<?php echo $trans[0]->SEARCHPARAM; ?>&refiddatefrom=<?php echo $trans[0]->FROMDATE; ?>&refiddateto=<?php echo $trans[0]->TODATE; ?>&selecttype=<?php echo $trans[0]->SELECTTYPE; ?>" >
							<div style="float:left">
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
							</div>
						</a>
						<a style="display:inline"  href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.globalsearchrefid.php?Method=ExportToExcel&referenceid=<?php echo $trans[0]->SEARCHPARAM; ?>&refiddatefrom=<?php echo $trans[0]->FROMDATE; ?>&refiddateto=<?php echo $trans[0]->TODATE; ?>&selecttype=<?php echo $trans[0]->SELECTTYPE; ?>" >
							<div style="float:left">
								<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_excel.png" border="0" alt="logo"/> EXCEL
							</div>
						</a>
						<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.globalsearchrefid.php?Method=ExportPDF&referenceid=<?php echo $trans[0]->REFERENCEID;?>" target="_blank">
							<div style="float:left">
								<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_pdf.png" border="0" alt="logo"/> RECEIPT
							</div>
						</a>
						</center>
					</div>
					<table style="width:100%;table-layout: fixed;" id="globalrefid1">
						<thead>
							<tr class="ui-widget-header">
								<th><?php echo _('TRANSACTION ID'); ?></th>
								<th><?php echo _('TRANSACTION DATE'); ?></th>
								<th><?php echo _('TYPE'); ?></th>
								<th><?php echo _('MERCHANT PHONE'); ?></th>								
								<th width="50%"><?php echo _('MESSAGE'); ?></th>
							</tr>
						<thead>
							<tbody>
								<?php $ctr=0; foreach($trans as $t): $ctr++;?>
								<?php if($t->TYPE == "SENT" || $t->TYPE == "RECV") { ?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->REFERENCEID; ?></td>
										<td><?php echo $t->TRANSACTION_DATE; ?></td>             
										<td><?php echo $t->TYPE; ?></td>
										<td><?php echo $t->MERCHANT_MSISDN; ?></td>
										<td class="tdwrap"><?php echo $t->MESSAGE; ?></td>
									</tr>
								<?php } ?>
								<?php endforeach; ?>
							</tbody>
					</table>
					
					<table style="width:100%;" id="globalrefid">
						<thead>
							<tr class="ui-widget-header">
								<th><?php echo _("MERCHANT ID"); ?></th>
								<th><?php echo _("TRANSACTION ID"); ?></th>
								<th><?php echo _("TRANSACTION DATE"); ?></th>
								<th><?php echo _("TYPE"); ?></th>
								<th><?php echo _("MERCHANT MSISDN"); ?></th>
								<th><?php echo _("AMOUNT"); ?></th>
								<th><?php echo _("STATUS"); ?></th>
								<th><?php echo _("REASON"); ?></th>
								<th><?php echo _("AUTH CODE"); ?></th>
								<th><?php echo _("RRN"); ?></th>
							</tr>
						<thead>
							<tbody>
								<?php $ctr=0; foreach($trans as $t): $ctr++;?>
								<?php if($t->TYPE != "SENT" && $t->TYPE != "RECV") { ?>
									<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
										<td><?php echo $t->MID; ?></td>
										<td><?php echo $t->REFERENCEID; ?></td>
										<td><?php echo $t->TRANSACTION_DATE; ?></td>
										<td><?php echo $t->TYPE; ?></td>
										<td><?php echo $t->MERCHANT_MSISDN; ?></td>
										<td><?php echo $t->AMOUNT; ?></td>
										<td><?php echo $t->STATUS; ?></td>
										<td><?php echo $t->REASON; ?></td>
										<td><?php echo $t->AUTH_CODE; ?></td>
										<td><?php echo $t->RRN; ?></td>
									</tr>
								<?php } ?>
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
<script type="text/javascript" charset="utf-8">
			loadTable1();
			function loadTable1(){
				oTable = $('#globalrefid').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "two_button",
					"aaSorting": [[2, "desc" ]]
				});
				oTable = $('#globalrefid1').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "two_button",
					"aaSorting": [[1, "desc" ]]
				});
				
				setTimeout($.unblockUI, 1000);
				
			} ;
	
</script>
<script type="text/javascript">
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
</script>