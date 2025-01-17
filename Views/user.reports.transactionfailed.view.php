<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $responseReport = $this->data("responseReport"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="reports_transactionfailedBoxArea" class="reports_transactionfailedBox"  style="display:none;">	
	<div id="reports_summary">
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionfailed.php" method="post">
			<input type="hidden" name="Method" value="TransactionFailed" />
			
			<input type="hidden" name="perpage" value="15" />
			<input type="hidden" name="pagenum" value="1" />
			<table class="tblRegisterUser" width="85%">
			 <tr>
			   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="TransFdatefrom" name="TransFdatefrom" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransFdatefrom']);?>" readonly="true"/></td>
			   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="TransFdateto" name="TransFdateto" style="width:50%;" value="<?php echo sanitize_string($_REQUEST['TransFdateto']);?>" readonly="true"/></td>
			   <td align="center">
					<input type="submit" id="btnTransF" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
			 </tr>
		   </table>
		  </form>
		</div>
		<div id="transactionFailed" style="width:100%;font-size:10px;">
			<?php $transactionfaileddata = $this->data("transactionfaileddata"); ?>
				<?php if(isset($transactionfaileddata->ResponseCode)){ ?>
					<?php if(is_array($transactionfaileddata->Value)){?>
					<div>
						<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionfailed.php?Method=ExportTransactionFailedCSV&TransFdatefrom=<?php echo sanitize_string($_REQUEST['TransFdatefrom']);?>&TransFdateto=<?php echo sanitize_string($_REQUEST['TransFdateto']);?>&queryCount=<?php echo $transactionfaileddata->QueryCount;?>">
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
						</a>
						<!--<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionfailed.php?Method=ExportTransactionFailedPDF&TransFdatefrom=<?php echo sanitize_string($_REQUEST['TransFdatefrom']);?>&TransFdateto=<?php echo sanitize_string($_REQUEST['TransFdateto']);?>&queryCount=<?php echo $transactionfaileddata->QueryCount;?>" >
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_pdf.png" border="0" alt="logo" />PDF
						</a>-->
						<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionfailed.php?Method=ExportTransactionFailedEXCEL&TransFdatefrom=<?php echo sanitize_string($_REQUEST['TransFdatefrom']);?>&TransFdateto=<?php echo sanitize_string($_REQUEST['TransFdateto']);?>&queryCount=<?php echo $transactionfaileddata->QueryCount;?>">
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_excel.png" border="0" alt="logo" />EXCEL
						</a>
					</div>
					<div class="demo_jui">
					<div style="margin-top:15px";></div>
					<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionfailed.php" method="post">
					<select id="lookUp" name="perpage" style="width:20%;" onchange="this.form.submit()">
						<option value="15" <?php echo ($_REQUEST['perpage']==15)?'selected':'';?>>15 Per Page</option>
						<option value="25" <?php echo ($_REQUEST['perpage']==25)?'selected':'';?>>25 Per Page</option>
						<option value="50" <?php echo ($_REQUEST['perpage']==50)?'selected':'';?>>50 Per Page</option>
					</select>
					<table cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_transactionFailed">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("REFERENCE ID"); ?></th>
							<th><?php echo _("TRANSACTION DATE"); ?></th>
							<th><?php echo _("TRANSACTION TYPE"); ?></th>
							<th><?php echo _("SOURCE MSISDN"); ?></th>
							<th><?php echo _("FIRST NAME"); ?></th>
							<th><?php echo _("LAST NAME"); ?></th>
							<th><?php echo _("ACCOUNT TYPE"); ?></th>
							<th><?php echo _("STATUS"); ?></th>
							<th><?php echo _("MESSAGE HITS"); ?></th>
							<th><?php echo _("MESSAGE PULL"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($transactionfaileddata->Value as $t): $ctr++;?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
									<td><?php echo $t->REFERENCEID; ?></td>
									<td><?php echo $t->TRANSACTIONDATE; ?></td>
									<td><?php echo $t->TRANSTYPE; ?></td>
									<td><?php echo $t->MSISDN; ?></td>
									<td><?php echo $t->FIRSTNAME; ?></td>
									<td><?php echo $t->LASTNAME; ?></td>
									<td><?php echo $t->ACCOUNTTYPE; ?></td>
									<td><?php echo $t->STATUS; ?></td>
									<td><?php echo $t->MSGHITS; ?></td>
									<td><?php echo $t->MSGPULL; ?></td>
								</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
					</div>
					<div style="margin-top:-45px";></div>
					<input type="hidden" name="Method" value="TransactionFailed" />
					<input type="hidden" name="TransFdatefrom" value="<?php echo sanitize_string($_REQUEST['TransFdatefrom']);?>" />
					<input type="hidden" name="TransFdateto" value="<?php echo sanitize_string($_REQUEST['TransFdateto']);?>" />
					<input type="hidden" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']);?>" />
					
					First <input type="submit" name="pagenum" value="1" class="ui-state-default ui-corner-all ui-button" <?php if(1 == $_REQUEST['pagenum'] || $_REQUEST['pagenum'] == 'null'){ echo "disabled=true"; }?>><<
										
					<?php 
					$l = ceil($transactionfaileddata->QueryCount/$_REQUEST['perpage']) - $_REQUEST['pagenum'];
					$l = 9 - $l;
					if($l < 1){ 
						if($_REQUEST['pagenum'] != 1){ ?>
						<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']-1); ?>" class="ui-state-default ui-corner-all ui-button">
					<?php }
					}
					while($l > 0){ 
						if($_REQUEST['pagenum']-$l > 1){?>
						<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']-$l); ?>" class="ui-state-default ui-corner-all ui-button">
					<?php }
					$l--;} ?>
					
					<?php $i=0;	while($i < 10){
						if($_REQUEST['pagenum']+$i <= ceil($transactionfaileddata->QueryCount/$_REQUEST['perpage'])){?>
					<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']+$i); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(($_REQUEST['pagenum']+$i) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>>
					<?php } $i++;} ?>
					>><input type="submit" name="pagenum" value="<?php echo ceil($transactionfaileddata->QueryCount/$_REQUEST['perpage']); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(ceil($transactionfaileddata->QueryCount/$_REQUEST['perpage']) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>> Last
					</form><br>
					
					<?php echo "Page " . sanitize_string($_REQUEST['pagenum']) . " of ". ceil($transactionfaileddata->QueryCount/$_REQUEST['perpage']); ?>
					<?php echo " of total $transactionfaileddata->QueryCount entries"; ?>					
					<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found : $transactionfaileddata->Message</h3>";
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
<script type="text/javascript">
	$(function(){
		oTable = $('#reports_transactionFailed').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false,
			"aaSorting": [[ 1, "asc" ]]
		});

		var ht = $("#reports_transactionfailedBoxArea").css('height');
		ht = ht.replace("px","");
		$("#if_reports_transactionfailed",window.parent.document).css('height',parseInt(ht)+200);
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

	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
	<?php if($responseReport !=null):?>
		$(document).ready(function(){
			var newwin = window.open("<?php echo $GLOBALS['LIB_PATH'] . $responseReport ; ?>",null,"fullscreen=no,scrollbars=yes,toolbar=no,location=no,menubar=no,resizeable=yes");
			newwin.focus();
		});
	<?php endif;?>
	
	$("#reports_transactionfailedBoxArea").fadeIn(700);
</script>