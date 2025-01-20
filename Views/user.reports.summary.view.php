<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="reports_summaryBoxArea" class="reports_summaryBox"  style="display:none;">
	<div id="reports_summary" >	
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.summary.php" method="post">
			<input type="hidden" name="Method" value="TransactionSummary" />
			<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />							
			<table class="tblRegisterUser" width="85%">
			   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="Sumdatefrom" name="Sumdatefrom" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['Sumdatefrom']);?>" readonly="true"/></td>
			   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="Sumdateto" name="Sumdateto" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['Sumdateto']);?>" readonly="true"/></td>
			   <td align="center">
					<input type="submit" id="btnSummary" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
		   </table>
	   </form>
	</div>
	<div id="subscriberList" style="width:100%;font-size:10px;">
		<?php $transactionsummary = $this->data("transactionsummary"); ?>
		<?php if(isset($transactionsummary->ResponseCode)){ ?>
			<?php if(is_array($transactionsummary->Value)){?>
				<div>
					<a href="<?php echo $GLOBALS['LIB_PATH']; ?>/tcpdf/examples/transactionsummary_csv.php" target="_blank">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
					</a>
					<a href="<?php echo $GLOBALS['LIB_PATH']; ?>/tcpdf/examples/transactionsummary.php" target="_blank">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_pdf.png" border="0" alt="logo" />PDF
					</a>
					<a href="<?php echo $GLOBALS['LIB_PATH']; ?>/tcpdf/examples/transactionsummary_xls.php" target="_blank">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_excel.png" border="0" alt="logo" />EXCEL
					</a>
				</div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="trans" >
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("DATE"); ?></th>
						<th><?php echo _("SUMMARY"); ?></th>				
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($transactionsummary->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<td><?php echo date('Y-m-d', strtotime($t->DATEREPORT)); ?></td>
								<td><?php echo "SUBS: ".$t->SUBS.", SUBSREG: ".$t->SUBSREG.", SUBSUSED: ".$t->SUBSUSED.", SVA: ".$t->SVA.", SUCCESSTRANS: ".$t->SUCCESSTRANS.", FAILEDTRANS: ".$t->FAILEDTRANS.", CASHINTRANS: ".$t->CASHINTRANS.", CASHINAMOUNT: ".$t->CASHINAMOUNT.", CASHOUTTRANS: ".$t->CASHOUTTRANS.", CASHOUTAMOUNT: ".$t->CASHOUTAMOUNT.", BANK2EWTRANS: ".$t->BANK2EWTRANS.", BANK2EWAMOUNT: ".$t->BANK2EWAMOUNT.", EW2BANKTRANS: ".$t->EW2BANKTRANS.", EW2BANKAMOUNT: ".$t->EW2BANKAMOUNT.", BILLTRANS: ".$t->BILLTRANS.", BILLAMOUNT: ".$t->BILLAMOUNT.", EW2EWTRANS: ".$t->EW2EWTRANS.", EW2EWAMOUNT: ".$t->EW2EWAMOUNT.", KEYCOSTTRANS: ".$t->KEYCOSTTRANS.", KEYCOSTAMOUNT: ".$t->KEYCOSTAMOUNT.", BONUSTRANS: ".$t->BONUSTRANS.", BONUSAMOUNT: ".$t->BONUSAMOUNT; ?></td>
								<!--<td><?php echo $t->SUBS; ?></td>
								<td><?php echo $t->SUBSREG; ?></td>
								<td><?php echo $t->SUBSUSED; ?></td>
								<td><?php echo $t->SVA; ?></td>
								<td><?php echo $t->SUCCESSTRANS; ?></td>
								<td><?php echo $t->FAILEDTRANS; ?></td>										
								<td><?php echo $t->CASHINTRANS; ?></td>
								<td><?php echo $t->CASHINAMOUNT; ?></td>
								<td><?php echo $t->CASHOUTTRANS; ?></td>
								<td><?php echo $t->CASHOUTAMOUNT; ?></td>
								<td><?php echo $t->BANK2EWTRANS; ?></td>
								<td><?php echo $t->BANK2EWAMOUNT; ?></td>
								<td><?php echo $t->EW2BANKTRANS; ?></td>
								<td><?php echo $t->EW2BANKAMOUNT; ?></td>
								<td><?php echo $t->BILLTRANS; ?></td>
								<td><?php echo $t->BILLAMOUNT; ?></td>
								<td><?php echo $t->EW2EWTRANS; ?></td>
								<td><?php echo $t->EW2EWAMOUNT; ?></td>-->										
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		<?php } else {
			echo "<h3> No Records Found : $transactionsummary->Message</h3>";
		}?>
	<?php } ?>
	</div>
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
$(document).ready(function() {
	oTable = $('#trans').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button"
	});
});

$(document).ready(function(){
	var ht = $("#reports_summaryBoxArea").css('height');
	ht = ht.replace("px","");
	$("#if_reports_summary",window.parent.document).css('height',parseInt(ht)+180);
});
	
// Prevent the backspace key from navigating back.
	$(document).unbind('keydown').bind('keydown', function (event) {
		var doPrevent = false;
		if (event.keyCode === 8) {
			var d = event.srcElement || event.target;
			if ((d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'TEXT') 
				 || d.tagName.toUpperCase() === 'TEXTAREA' || (d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'PASSWORD')) {
				doPrevent = d.readOnly || d.disabled;
			}
			else {
				doPrevent = true;
			}
		}
		if (doPrevent) {
			event.preventDefault();
		}
	});

		
</script>
<script type="text/javascript">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>

$("#reports_summaryBoxArea").fadeIn(700);	
</script>