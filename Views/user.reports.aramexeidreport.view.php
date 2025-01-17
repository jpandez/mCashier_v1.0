<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $responseReport = $this->data("responseReport"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="reports_transactionhistoryBoxArea" class="reports_transactionhistoryBox"  style="display:none;">	
	<div id="reports_summary" style="float:left;">
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.aramexeidreport.php" method="post">
			<input type="hidden" name="Method" value="AramexEidReport" />
			
			<input type="hidden" name="perpage" value="15" />
			<input type="hidden" name="pagenum" value="1" />
			<table class="tblRegisterUser" width="85%">
			 <tr>
			 <td><?php echo _("AWB"); ?>:  </td>
			<td>
				<div class="field required">
					<input type="text" class="verifyText" id="AWB" name="AWB" value="<?php echo ($this->data("response") == 0) ? '' : sanitize_string($_REQUEST['AWB']) ;?>">
				</div>
			</td>
			
			   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="TransHdatefrom" name="TransHdatefrom" style="width:50%;" value="<?php echo htmlentities($_REQUEST['TransHdatefrom'], ENT_QUOTES);?>" readonly="true"/></td>
			   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="TransHdateto" name="TransHdateto" style="width:50%;" value="<?php echo htmlentities($_REQUEST['TransHdateto'], ENT_QUOTES);?>" readonly="true"/></td>
			   <td align="center">
					<input type="submit" id="btnTransH" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
			 </tr>
		   </table>
		  </form>
		</div>
		<div id="aramexeidreport" style="width:100%;font-size:10px;">
			<?php $transactionhistorydata = $this->data("transactionhistorydata"); ?>
				<?php if(isset($transactionhistorydata->ResponseCode)){ ?>
					<?php if(is_array($transactionhistorydata->Value)){?>
					<div>
						<!--<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.mposrevenuereport.php?Method=ExportMposRevenueReportCSV&TransHdatefrom=<?php echo $_REQUEST['TransHdatefrom'];?>&TransHdateto=<?php echo $_REQUEST['TransHdateto'];?>&queryCount=<?php echo $transactionhistorydata->QueryCount;?>">
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
						</a>
						<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.mposrevenuereport.php?Method=ExportMposRevenueReportPDF&TransHdatefrom=<?php echo $_REQUEST['TransHdatefrom'];?>&TransHdateto=<?php echo $_REQUEST['TransHdateto'];?>&queryCount=<?php echo $transactionhistorydata->QueryCount;?>" >
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_pdf.png" border="0" alt="logo" />PDF
						</a>-->
						<!--<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.aramexeidreport.php?Method=ExportMposRevenueReportEXCEL&TransHdatefrom=<?php echo $_REQUEST['TransHdatefrom'];?>&TransHdateto=<?php echo $_REQUEST['TransHdateto'];?>&queryCount=<?php echo $transactionhistorydata->QueryCount;?>">
							<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_excel.png" border="0" alt="logo" />EXCEL
						</a>-->
					</div>
					<div class="demo_jui">
					<div style="margin-top:15px";></div>
					<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.aramexeidreport.php" method="post">
					<select id="lookUp" name="perpage" style="width:20%;" onchange="this.form.submit()">
						<option value="15" <?php echo ($_REQUEST['perpage']==15)?'selected':'';?>>15 Per Page</option>
						<option value="25" <?php echo ($_REQUEST['perpage']==25)?'selected':'';?>>25 Per Page</option>
						<option value="50" <?php echo ($_REQUEST['perpage']==50)?'selected':'';?>>50 Per Page</option>
					</select>
					<table cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_transactionHistory">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("AWB"); ?></th>
							<th><?php echo _("NAME AS PER EID"); ?></th>
							<th><?php echo _("EID NUMBER"); ?></th>
							<th><?php echo _("DATE"); ?></th>
							<th><?php echo _("MSISDN"); ?></th>
							<th><?php echo _("EID EXPIRY DATE"); ?></th>
							<th><?php echo _("NATIONALITY"); ?></th>
							<th><?php echo _("LOGS"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($transactionhistorydata->Value as $t): $ctr++;?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
									<td><?php echo $t->AWB; ?></td>
									<td><?php echo $t->NAMEASPEREID; ?></td>
									<td><?php echo $t->EIDNUMBER; ?></td>
									<td><?php echo $t->TIMESTAMP; ?></td>
									<td><?php echo $t->MSISDN; ?></td>
									<td><?php echo $t->EIDEXPIRYDATE; ?></td>
									<td><?php echo $t->NATIONALITY; ?></td>
									<td>
										<a href="javascript:viewAramexLog('<?php echo $t->REFID; ?>')">View error Logs</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
					<div style="margin-top:-45px";></div>
					<input type="hidden" name="Method" value="AramexEidReport" />
					<input type="hidden" name="TransHdatefrom" value="<?php echo $_REQUEST['TransHdatefrom'];?>" />
					<input type="hidden" name="AWB" value="<?php echo $_REQUEST['AWB'];?>" />
					<input type="hidden" name="TransHdateto" value="<?php echo $_REQUEST['TransHdateto'];?>" />
					<input type="hidden" name="pagenum" value="<?php echo $_REQUEST['pagenum'];?>" />
					
					First <input type="submit" name="pagenum" value="1" class="ui-state-default ui-corner-all ui-button" <?php if(1 == $_REQUEST['pagenum'] || $_REQUEST['pagenum'] == 'null'){ echo "disabled=true"; }?>><<
										
					<?php 
					$l = ceil($transactionhistorydata->QueryCount/$_REQUEST['perpage']) - $_REQUEST['pagenum'];
					$l = 9 - $l;
					if($l < 1){ 
						if($_REQUEST['pagenum'] != 1){ ?>
						<input type="submit" name="pagenum" value="<?php echo $_REQUEST['pagenum']-1; ?>" class="ui-state-default ui-corner-all ui-button">
					<?php }
					}
					while($l > 0){ 
						if($_REQUEST['pagenum']-$l > 1){?>
						<input type="submit" name="pagenum" value="<?php echo $_REQUEST['pagenum']-$l; ?>" class="ui-state-default ui-corner-all ui-button">
					<?php }
					$l--;} ?>
					
					<?php $i=0;	while($i < 10){
						if($_REQUEST['pagenum']+$i <= ceil($transactionhistorydata->QueryCount/$_REQUEST['perpage'])){?>
					<input type="submit" name="pagenum" value="<?php echo $_REQUEST['pagenum']+$i; ?>" class="ui-state-default ui-corner-all ui-button" <?php if(($_REQUEST['pagenum']+$i) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>>
					<?php } $i++;} ?>
					>><input type="submit" name="pagenum" value="<?php echo ceil($transactionhistorydata->QueryCount/$_REQUEST['perpage']); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(ceil($transactionhistorydata->QueryCount/$_REQUEST['perpage']) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>> Last
					</form><br>
					
					<?php echo "Page " . ($_REQUEST['pagenum']) . " of ". ceil($transactionhistorydata->QueryCount/$_REQUEST['perpage']); ?>
					<?php echo " of total $transactionhistorydata->QueryCount entries"; ?>					
					<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found : $transactionhistorydata->Message</h3>";
				}?>
			<?php } ?>
		</div>
</div>

<div id="failed_aramex_view" style="display:none;" title="View Error Log">
	<div class="panelButtons" style="margin-bottom:10px;">
		<div id="divKYC" style="border:0px solid gray;">
			<button id="btnExportLog" class="buttonx"><?php echo _("Export Logs to CSV"); ?></button>
		</div>								
	</div>

		
	<div class="error_log_details" style="border:0px solid red;width:350px;margin-top:5px;margin-right:30px;float:left;">
		<table border="0" id="tblAccount3" cellspacing="5" class="tablet">
			<tr>
				<td><?php echo _("AWB"); ?>:</td>
				<td><input type="text" id="logawb" readonly ></td>
				<td><?php echo _("Logs"); ?>:</td>
			</tr>
			<tr>
				<td><?php echo _("Name as per EID"); ?>:</td>
				<td><input type="text" id="lognameeid" readonly ></td>
				<!--td rowspan="6"><input type="text" id="logdata" readonly ></td-->
				<td rowspan="6"><textarea rows="7" cols="50" id="logdata" wrap="hard"></textarea></td>
			</tr>
			<tr>
				<td><?php echo _("EID Number"); ?>:</td>
				<td><input type="text" id="logeidnumber" readonly ></td>
			</tr>
			<tr><td><?php echo _("Date"); ?>:</td><td><input type="text" id="logdate" readonly ></td></tr>
			<tr><td><?php echo _("MSISDN"); ?>:</td><td><input type="text" id="logmsisdn" readonly ></td></tr>
			<tr><td><?php echo _("EID Expiry Date"); ?>:</td><td><input type="text" id="logeidexpiry" readonly ></td></tr>
			<tr><td><?php echo _("Nationality"); ?>:</td><td><input type="text" id="lognationality" readonly ></td></tr>
		</table>
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
		oTable = $('#reports_transactionHistory').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false,
			"aaSorting": [[ 0, "desc" ]]
		});

		var ht = $("#reports_transactionhistoryBoxArea").css('height');
		ht = ht.replace("px","");
		//$("#if_reports_mposrevenue",window.parent.document).css('height',parseInt(ht)+200);
		$("#if_reports_aramexeid",window.parent.document).css('height',parseInt(ht)+200);
	});
	
	$('#failed_aramex_view').dialog({
				autoOpen: false,
				width: 1200,
				height: 400,
				//height:1000,
				draggable: true,
				resizable: false,
				modal:true,
				// position:'bottom'
			});

function viewAramexLog(refid){
	//$("#failed_aramex_view").dialog('open');
	$.ajax({
		url: "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php",
		type: 'post',
		dataType:  'json',
		data: {
			Method: 'errorAramexView',
			refid: refid,
			FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
		},success: function(json){
			if(json.ResponseCode == 0){

				$("#logawb").val(json.Value.AWB);
				$("#lognameeid").val(json.Value.NAMEASPEREID);
				$("#logeidnumber").val(json.Value.EIDNUMBER);
				$("#logdate").val(json.Value.TIMESTAMP);
				$("#logmsisdn").val(json.Value.MSISDN);
				$("#logeidexpiry").val(json.Value.EIDEXPIRYDATE);
				$("#lognationality").val(json.Value.NATIONALITY);
				$("#logdata").val(JSON.stringify(json.Value.EIDPODRES));
				$("#failed_aramex_view").dialog('open');
				
			}else{
				$("<p>"+json.Result.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
		}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	});
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
		});
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
		$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
				dataType: "text",
				complete:function(res,status){
					window.parent.pagetoken = res.responseText;
					setTimeout($.unblockUI, 1000);
				}
		});

	}, 3000);
});
	
	$("#reports_transactionhistoryBoxArea").fadeIn(700);
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>