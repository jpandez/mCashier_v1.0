<?php $reports = $this->data("reports"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php require_once("views.config.properties.php"); ?>
<div id="statementresult" style="display:block;overflow:auto;">
	<?php if(isset($reports)): ?>
		<?php if($reports->ResponseCode==0): $trans = $reports->Value;?>
			<?php if(is_array($reports->Value)){?>
				<div <?php echo ($this->getRolesConfig('STATEMENT_SEND')) ? '' : 'style="display:none;"'; ?>>
								<!--<a href="<?php echo $GLOBALS['LIB_PATH']; ?>tcpdf/examples/statement_xls.php" target="_blank">
									<img src="<?php echo $GLOBALS['VIEW_PATH']; ?>images/export_excel.png" border="0" alt="logo" />EXCEL
								</a>--><br>
								<input type="button" id="btnEmail" value="<?php echo _("Email"); ?>" class="ui-state-default ui-corner-all ui-button" style="float:left;">
								<input type="button" id="btnDownload" value="<?php echo _("Download"); ?>" class="ui-state-default ui-corner-all ui-button" style="float:left;"><br>
				</div>
			<?php } ?>			
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="transH" width="100%">
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
						<th><?php echo _("DOWNLOAD RECEIPT"); ?></th>
					</tr>
				<thead>
				<tbody>
					<?php $ctr=0; foreach($trans as $t): $ctr++;?>
						<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
							<td><?php echo $t->MID; ?></td>
							<td><?php echo $t->REFERENCEID; ?></td>
							<td><?php echo $t->TRANSACTION_DATE; ?></td>
							<td><?php echo $t->TYPE; ?></td>
							<td><?php echo $t->MERCHANT_MSISDN; ?></td>
							<td><?php echo $t->AMOUNT; ?></td>
							<td><?php echo $t->STATUS==0?"SUCCESS":"FAILED"; ?></td>
							<td><?php echo $t->REASON; ?></td>
							<td><?php echo $t->AUTH_CODE; ?></td>
							<td><?php echo $t->RRN; ?></td>
							<td><a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.subscriber.transactions.php?Method=ExportPDF&referenceid=<?php echo $t->REFERENCEID;?>" target="_blank">Download PDF</a></td>
						</tr>
					<?php endforeach; ?>
					
					
				</tbody>
			</table>
		<?php endif;?>
		
		<?php if($reports->ResponseCode!=0):?>
			<h3><?php echo $reports->Message; ?></h3>
		<?php endif;?>
	<?php endif; ?>
</div>
<div id="dialogEmail" title="<?php echo _("Email Statement"); ?>">
	<div id="app_sending" style="display:none;"><center><img border="0" src="<?php echo $GLOBALS["VIEW_PATH"]; ?>images/ajax-loading.gif" /><br>Loading...</center></div>
    <div id="app_result"></div>
    <form>
    	<input type="hidden" name="is_mail" value="RequestSystemInfo" />
		<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
		<div class="dLock" align="center">
			<table style="text-align:left;" class="tablet">
				<tr>
					<td><?php echo _("Email Address"); ?> :</td>
					<td>
						<input type="text" name="tomail" id="emailAdd" size="35" readonly="readonly" value="<?php echo $_SESSION['currentSearch']->AccountInformation->PersonalInformation->EmailAddress; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" name="rdoReportOption" checked value="1" id="excel" /><label for="excel">EXCEL</label>
						<!--<input type="radio" name="rdoReportOption" value="2" id="pdf" /><label for="pdf">PDF</label>-->
					</td>
					<td>
						<input type="button" id="btnEmailCancel" value="<?php echo _("Cancel"); ?>" class="ui-state-default ui-corner-all ui-button" style="float:right;">
						<input type="button" id="btnEmailSend" value="<?php echo _("Send"); ?>" class="ui-state-default ui-corner-all ui-button" style="float:right;">
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>
<div id="dialogDownload" title="<?php echo _("Download"); ?>">
	<div <?php echo ($this->getRolesConfig('STATEMENT_SEND')) ? '' : 'style="display:none;"'; ?>>
		<a href="<?php echo $GLOBALS['LIB_PATH']; ?>tcpdf/examples/statement_xls.php" target="_blank">
			<img src="<?php echo $GLOBALS['VIEW_PATH']; ?>images/export_excel.png" border="0" alt="logo" />EXCEL
		</a>
		<a href="<?php echo $GLOBALS['LIB_PATH']; ?>tcpdf/examples/statement.php" target="_blank">
			<img src="<?php echo $GLOBALS['VIEW_PATH']; ?>images/export_pdf.png" border="0" alt="logo" />PDF
		</a>
	</div>
</div>


<script type="text/javascript" charset="utf-8">
		loadTable();
		function loadTable(){
			oTable = $('#transH').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button",
				"aaSorting": [[ 2, "desc" ]]
			});			
			$('#dialogEmail').dialog({
				autoOpen: false,
				width: 450,
				draggable: true,
				resizable: false,
				modal:true
			});
			$('#dialogDownload').dialog({
				autoOpen: false,
				draggable: true,
				resizable: false,
				modal:true
			});
			
			setTimeout($.unblockUI, 1000);

		}
		$("#btnDownload").click(function(){
					 $('#dialogDownload').dialog('open');			 	
		});
		$("#btnEmail").click(function(){
					 $('#dialogEmail').dialog('open');			 	
					 /*$('#dialogEmail').dialog({
						open: function(){
							$('div.ui-widget-overlay').hide();
							$("div.ui-dialog").not(':first').remove();
					}
					 });**/
		});
		$("#btnEmailCancel").click(function(){
					 $('#dialogEmail').dialog('close');		
		});
		$("#btnEmailSend").click(function() {
			if ($("#emailAdd").val() !=''){
					var $selected = $('input[name=rdoReportOption]:checked', 'form').val();
			                   $("#btnEmailSend").attr('disabled','disabled');
			                   $("#btnEmailSend").hide();
			                   $("#btnEmailCancel").hide();
			                    if($selected != 1){
				                    $.ajax({
				                        beforeSend:function (XMLHttpRequest) {
				                            $("#app_sending").fadeIn();
				                        }, 
				                        data:$("#btnEmailSend").closest("form").serialize(), 
				                        dataType:"html", 
				                        complete:function (data, textStatus) {
				                                $("#app_sending").fadeOut();
				                                $("<p>"+data.responseText+"</p>").dialog({modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				                                $("#btnEmailSend").removeAttr('disabled');
				                                $("#btnEmailSend").show();
				                                $("#btnEmailCancel").show();
												$('#dialogEmail').dialog('close');
				                        }, 
				                        type:"post", 
				                        url:  "<?php echo $GLOBALS["BASE_URL"] ?>Libraries/tcpdf/examples/statement.php"
				                            }
				                        );
			                    }else{
				                    $.ajax({
				                        beforeSend:function (XMLHttpRequest) {
				                            $("#app_sending").fadeIn();
				                        }, 
				                        data:$("#btnEmailSend").closest("form").serialize(), 
				                        dataType:"html", 
				                        complete:function (data, textStatus) {
				                                $("#app_sending").fadeOut();
				                                $("<p>"+data.responseText+"</p>").dialog({modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
				                                $("#btnEmailSend").removeAttr('disabled');
				                                $("#btnEmailSend").show();
				                                $("#btnEmailCancel").show();
				                                $('#dialogEmail').dialog('close');
				                        }, 
				                        type:"post", 
				                        url: "<?php echo $GLOBALS["BASE_URL"] ?>Libraries/tcpdf/examples/statement_xls.php"
				                            }
				                        );
			                    }
			}
			else{
				$("<p><?php echo _("Email Address is required"); ?>.</p>").dialog({modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
	return false;});
</script>
 
 <script type="text/javascript">
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
 </script>
