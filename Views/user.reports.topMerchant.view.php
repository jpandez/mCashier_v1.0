<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $responseReport = $this->data("responseReport"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="reports_transactionhistoryBoxArea" class="reports_transactionhistoryBox"  style="display:none;">	
	<div id="reports_summary" style="float:left;">
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.topMerchant.php" method="post">
			<input type="hidden" name="Method" value="topmerchant" />
			<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
			<table class="tblRegisterUser" width="85%">
			 <tr>
				<td class="td3"><?php echo _("Filter"); ?><span style="color:red">*</span>:</td>
			   <td class="td3">
					<select id="reportType" name="reportType" onchange="filterchange()">
						<option value="MONTH" <?php echo ($_REQUEST['reportType']=="MONTH")?'selected':'';?>>Top 5 Merchants by Month</option>
						<option value="YEAR" <?php echo ($_REQUEST['reportType']=="YEAR")?'selected':'';?>>Top 5 Merchants by Year</option>
					</select>
			   </td>
			   
			   <td class="td3" id="monthfilter1" style="display:fixed;"><?php echo _("Month"); ?><span style="color:red">*</span>:</td>
			   <td class="td3" id="monthfilter2" style="display:fixed;">
			   <select id="lookUp" name="month">
					<option value="01" <?php echo ($_REQUEST['month'] == "01") ? 'selected' : ''; ?>>JANUARY</option>
					<option value="02" <?php echo ($_REQUEST['month'] == "02") ? 'selected' : ''; ?>>FEBRUARY</option>
					<option value="03" <?php echo ($_REQUEST['month'] == "03") ? 'selected' : ''; ?>>MARCH</option>
					<option value="04" <?php echo ($_REQUEST['month'] == "04") ? 'selected' : ''; ?>>APRIL</option>
					<option value="05" <?php echo ($_REQUEST['month'] == "05") ? 'selected' : ''; ?>>MAY</option>
					<option value="06" <?php echo ($_REQUEST['month'] == "06") ? 'selected' : ''; ?>>JUNE</option>
					<option value="07" <?php echo ($_REQUEST['month'] == "07") ? 'selected' : ''; ?>>JULY</option>
					<option value="08" <?php echo ($_REQUEST['month'] == "08") ? 'selected' : ''; ?>>AUGUST</option>
					<option value="09" <?php echo ($_REQUEST['month'] == "09") ? 'selected' : ''; ?>>SEPTEMBER</option>
					<option value="10" <?php echo ($_REQUEST['month'] == "10") ? 'selected' : ''; ?>>OCTOBER</option>
					<option value="11" <?php echo ($_REQUEST['month'] == "11") ? 'selected' : ''; ?>>NOVEMBER</option>
					<option value="12" <?php echo ($_REQUEST['month'] == "12") ? 'selected' : ''; ?>>DECEMBER</option>
				</select>
			</td>

			<td class="td3"><?php echo _("Year"); ?><span style="color:red">*</span>:</td>
			<td>
				<select id="lookUp" name="year">
					<?php 
					$currentYear = date("Y");
					for ($year = 2015; $year <= $currentYear; $year++) { 
						$selected = ($_REQUEST['year'] == $year) ? 'selected' : '';
						echo "<option value='$year' $selected>$year</option>";
					}
					?>
				</select>
			</td>
			   <td align="center">
					<input type="submit" id="btnTransH" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
			 </tr>
		   </table>
		  </form>
		</div>
		<div style="margin-top:15px";></div>
		<div id="aramexeidreportCARD" style="width:100%;font-size:10px;">
			<?php $topFiveReportCARDData = $this->data("topFiveReportCARDData"); ?>
				<?php if(isset($topFiveReportCARDData->ResponseCode)){ ?>
				</br></br></br></br>
				<h3>Card Transaction</h3>
				<div style="margin-top:15px";></div>
					<?php if(is_array($topFiveReportCARDData->Value)){?>
					<div>
					</div>
					<div class="demo_jui">
					<div style="margin-top:15px";></div>
					<table style="width: 100%; table-layout: fixed;" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_transactionHistoryCARD">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("MERCHANT NAME"); ?></th>
							<th><?php echo _("TRANSACTION DATE"); ?></th>
							<th><?php echo _("MERCHANT ID (MID)"); ?></th>
							<th><?php echo _("TOTAL SUCCESSFULL TRANSACTION"); ?></th>
							<th><?php echo _("TOTAL AMOUNT IN AED"); ?></th>
							
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($topFiveReportCARDData->Value as $t): $ctr++;?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
									<td><?php echo $t->MERCHANT_NAME; ?></td>
									<td><?php echo $t->TRANSACTION_FILTER; ?></td>
									<td><?php echo $t->MERCHANTID; ?></td>
									<td><?php echo $t->TRANSACTION_COUNT; ?></td>
									<td><?php echo $t->TRANSACTION_AMOUNT; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
					<div style="margin-top:-45px";></div>
				<?php } else {
					echo "<h2> No Records Found for CARD transaction : $topFiveReportCARDData->Message</h2>";
				}?>
			<?php } ?>
		</div>
		<div style="margin-top:15px";></div>
		<div id="aramexeidreportCASH" style="width:100%;font-size:10px;">
			<?php $topFiveReportCASHData = $this->data("topFiveReportCASHData"); ?>
				<?php if(isset($topFiveReportCASHData->ResponseCode)){ ?>
				</br>
				<h3>Cash Transaction</h3>
				<div style="margin-top:15px";></div>
					<?php if(is_array($topFiveReportCASHData->Value)){?>
					<div class="demo_jui">
					<div style="margin-top:15px";></div>
					<table style="width: 100%; table-layout: fixed;" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_transactionHistoryCASH">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("MERCHANT NAME"); ?></th>
							<th><?php echo _("TRANSACTION DATE"); ?></th>
							<th><?php echo _("MERCHANT ID (MID)"); ?></th>
							<th><?php echo _("TOTAL SUCCESSFULL TRANSACTION"); ?></th>
							<th><?php echo _("TOTAL AMOUNT IN AED"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($topFiveReportCASHData->Value as $t): $ctr++;?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
									<td><?php echo $t->MERCHANT_NAME; ?></td>
									<td><?php echo $t->TRANSACTION_FILTER; ?></td>
									<td><?php echo $t->MERCHANTID; ?></td>
									<td><?php echo $t->TRANSACTION_COUNT; ?></td>
									<td><?php echo $t->TRANSACTION_AMOUNT; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
					<div style="margin-top:-45px";></div>
				<?php } else {
					echo "<h2> No Records Found for CASH transaction : $topFiveReportCASHData->Message</h2>";
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
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>
<script type="text/javascript">
	$(function(){
		oTable = $('#reports_transactionHistoryCASH').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false,
			"aaSorting": [[ 3, "desc" ]]
		});
		
		oTable = $('#reports_transactionHistoryCARD').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false,
			"aaSorting": [[ 3, "desc" ]]
		});

		var ht = $("#reports_transactionhistoryBoxArea").css('height');
		ht = ht.replace("px","");
		//$("#if_reports_mposrevenue",window.parent.document).css('height',parseInt(ht)+200);
		$("#if_reports_topMerchant",window.parent.document).css('height',parseInt(ht)+200);
	});
	$(document).ready(function(){
		var main = $('#reportType').val();
			var val = '';
			if (main == 'YEAR'){
				$('#monthfilter1').hide();
				$('#monthfilter2').hide();
			}else {
				$('#monthfilter1').show();
				$('#monthfilter2').show();
			}
			
		});
	
		function filterchange() {
			var main = $('#reportType').val();
			var val = '';
			if (main == 'YEAR'){
				$('#monthfilter1').hide();
				$('#monthfilter2').hide();
			}else {
				$('#monthfilter1').show();
				$('#monthfilter2').show();
			}
		}
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

	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	}
	<?php endif;?>
	<?php if($responseReport !=null):?>
		$(document).ready(function(){
			var newwin = window.open("<?php echo $GLOBALS['LIB_PATH'] . $responseReport ; ?>",null,"fullscreen=no,scrollbars=yes,toolbar=no,location=no,menubar=no,resizeable=yes");
			newwin.focus();
		});
	<?php endif;?>
	
$(document).ready(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	setTimeout(function(){
		setTimeout($.unblockUI, 1000);
	}, 3000);
});
	
	$("#reports_transactionhistoryBoxArea").fadeIn(700);
</script>
