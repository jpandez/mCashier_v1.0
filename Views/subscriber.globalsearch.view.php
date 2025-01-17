<?php require_once("views.config.properties.php"); ?>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
<style type="text/css" nonce="<?php echo $_SESSION['nonce'];?>">
.tblwrap {border-collapse:collapse; table-layout:fixed; width:100%;}
.tdwrap {width:100px; word-wrap:break-word;}
._globalsearch{
	width:100%;font-size:10px;
}
._globalsearch-table{
	width: 100%; table-layout: fixed;
}
</style>
<br>
<?php $reports = $this->data("reports"); ?>
<?php $reports1 = $this->data("reports1"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<div id="tabs">
<div class="_globalsearch">
	<div id="Transactions">
		<?php if(isset($reports)): ?>
			<?php if($reports->ResponseCode==0): $trans = $reports->Value;?>
				<?php if($reports->Value!="no records"): ?>
					<?php if($_SESSION['datatype'] == "HITS_PULL"){$repo=TRUE;} else {$repo=FALSE;} ?>
						<?php if(is_array($trans)): ?>
							<?php if($repo==TRUE): ?>
								<table cellpadding="0" cellspacing="0" border="0" class="display _globalsearch-table" id="global" width="100%">
									<thead>
										<tr >
											<th><?php echo _("ID"); ?></th>
											<th><?php echo _("TRANSACTION ID"); ?></th>
											<th><?php echo _("TYPE"); ?></th>
											<th><?php echo _("MSISDN"); ?></th>
											<th width="40%"><?php echo _("MESSAGE"); ?></th>
											<th><?php echo _("TRANSACTION DATE"); ?></th>
											<th><?php echo _("SMS Resend"); ?></th>
										</tr>
									</thead>
										<tbody>
											<?php $ctr=0; foreach($trans as $t): $ctr++;?>
												
												<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
													<td><?php echo $t->ID; ?></td>
													<td><?php echo $t->REFERENCEID; ?></td>
													<td><?php echo $t->TYPE; ?></td>
													<td><?php echo $t->MSISDN; ?></td>
													<td align="left" class="tdwrap"><?php echo $t->MESSAGE; ?></td>
													<td><?php echo $t->TIMESTAMP; ?></td>
													<!-- <td><a href="javascript:globalSearchSMS('<?php echo $t->REFERENCEID; ?>','<?php echo $t->MSISDN; ?>','<?php echo str_replace("'","\'",$t->MESSAGE); ?>');"><?php echo ($t->TYPE == 'SENT') ? 'Resend' : ''; ?></a></td> -->
													<td><?php if ($t->TYPE == 'SENT'): ?><button class="btn btn-sm btn-primary resend-link" data-referenceid="<?php echo $t->REFERENCEID; ?>" data-msisdn="<?php echo $t->MSISDN; ?>" data-message="<?php echo str_replace("'","\'",$t->MESSAGE); ?>">Resend</button><?php endif;?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
								</table>
							<?php endif;?>
							
							<?php if($repo==FALSE): ?>
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="global" width="100%">
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
												<?php if($_SESSION['datatype'] == "PANO" || $_SESSION['datatype'] == "ALL") { ?>
												<th><?php echo _("AUTH CODE"); ?></th>
												<th><?php echo _("RRN"); ?></th>
												<th><?php echo _("NOTE"); ?></th>
												<?php } ?>
												<?php if($_SESSION['datatype'] == "PANO") { ?>
												<th><?php echo _("CARD DETAILS"); ?></th>
												<th><?php echo _("CARD HOLDER"); ?></th>
												<?php } ?>
												<?php if($_SESSION['datatype'] == "PCSH") { ?>
												<th><?php echo _("CURRENCY"); ?></th>
												<th><?php echo _("AMOUNT GIVEN"); ?></th>
												<th><?php echo _("CHANGE"); ?></th>
												<?php } ?>
										</tr>
									</thead>
										<tbody>
											<?php $ctr=0; foreach($trans as $t): $ctr++;?>
												
												<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
													<td><?php echo $t->MID; ?></td>
													<td><?php echo $t->REFERENCEID; ?></td>
													<td><?php echo $t->TRANSACTION_DATE; ?></td>
													<td><?php echo $t->TYPE; ?></td>
													<td><?php echo $t->MERCHANT_MSISDN; ?></td>
													<td><?php echo $t->AMOUNT; ?></td>
													<td><?php echo $t->STATUS; ?></td>
													<td><?php echo $t->REASON; ?></td>
														<?php if($_SESSION['datatype'] == "PANO" || $_SESSION['datatype'] == "ALL") { ?>
														<td><?php echo $t->AUTH_CODE; ?></td>
														<td><?php echo $t->RRN; ?></td>
														<td><?php echo $t->NOTE; ?></td>
														<?php } ?>
														<?php if($_SESSION['datatype'] == "PANO") { ?>
														<td><?php echo $t->CARD_DETAILS; ?></td>
														<td><?php echo $t->CARD_HOLDER; ?></td>
														<?php } ?>
														<?php if($_SESSION['datatype'] == "PCSH") { ?>
														<td><?php echo $t->CURRENCY; ?></td>
														<td><?php echo $t->AMOUNT_GIVEN; ?></td>
														<td><?php echo $t->CHANGE; ?></td>
														<?php } ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
								</table>
							<?php endif;?>
						<?php endif;?>
					<?php endif;?>
		<?php endif;?>
		<?php if($reports->Value =="no records"): ?>
			<?php if($reports->ResponseCode!=0):?>
				<h3><?php echo $reports->Message; ?></h3>
			<?php elseif(!is_array($reports->Value)): ?>
				<h3><?php echo $reports->Value; ?></h3>
			<?php endif;?>
		<?php endif;?>	
		<?php endif;?>
	</div>
	<div id="HitsPull">
		<?php if(isset($reports1)): ?>
			<?php if($reports1->ResponseCode==0): $trans1 = $reports1->Value?>
				<?php if($reports1->Value!="no records"): ?>
					<?php if(is_array($trans1)): ?>					
						<table cellpadding="0" cellspacing="0" border="0" class="display _globalsearch-table" id="global1" width="100%">
							<thead>
								<tr>
									<th><?php echo _("ID"); ?></th>
									<th><?php echo _("TRANSACTION ID"); ?></th>
									<th><?php echo _("TYPE"); ?></th>
									<th><?php echo _("MSISDN"); ?></th>
									<th width="40%"><?php echo _("MESSAGE"); ?></th>
									<th><?php echo _("TRANSACTION DATE"); ?></th>
									<th><?php echo _("SMS Resend"); ?></th>
								</tr>
							</thead>
								<tbody>
									<?php $ctr=0; foreach($trans1 as $t): $ctr++;?>
										<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
											<td><?php echo $t->ID; ?></td>
											<td><?php echo $t->REFERENCEID; ?></td>
											<td><?php echo $t->TYPE; ?></td>
											<td><?php echo $t->MSISDN; ?></td>
											<td align="left" class="tdwrap"><?php echo $t->MESSAGE; ?></td>
											<td><?php echo $t->TIMESTAMP; ?></td>
											<!-- <td><a href="javascript:globalSearchSMS('<?php echo $t->REFERENCEID; ?>','<?php echo $t->MSISDN; ?>','<?php echo str_replace("'","\'",$t->MESSAGE); ?>');"><?php echo ($t->TYPE == 'SENT') ? 'Resend' : ''; ?></a></td> -->
											<td><?php if ($t->TYPE == 'SENT'): ?><button class="btn btn-sm btn-primary resend-link" data-referenceid="<?php echo $t->REFERENCEID; ?>" data-msisdn="<?php echo $t->MSISDN; ?>" data-message="<?php echo str_replace("'","\'",$t->MESSAGE); ?>">Resend</button><?php endif;?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
						</table>
					<?php endif;?>
				<?php endif;?>
			<?php endif;?>			
		<?php endif; ?>
	</div>
</div>
</div>
<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">
			loadTable();
			function loadTable(){
				oTable = $('#global').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "two_button",
					"aaSorting": [[ <?php if($_SESSION['datatype'] == "HITS_PULL") { echo "5"; }else{ echo "2"; } ?>, "desc" ]]
				});
				
				oTable = $('#global1').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "two_button",
					"aaSorting": [[ 5, "desc" ]]
				});
				
				$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
					type:"POST",
					complete:function(res,status){
						window.parent.pagetoken = res.responseText;
						setTimeout($.unblockUI, 1000);
					}
				});	
			} ;

			$(document).ready(function() {
				$('.resend-link').on('click', function() {
					var referenceid = $(this).data('referenceid');
					var msisdn = $(this).data('msisdn');
					var message = $(this).data('message');
					globalSearchSMS(referenceid, msisdn, message);
				});
			});
	
</script>
<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
</script>