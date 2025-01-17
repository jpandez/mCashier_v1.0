<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $responseReport = $this->data("responseReport"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<style type="text/css">
.tblwrap {border-collapse:collapse; table-layout:fixed; width:100%;}
.tdwrap {width:100px; word-wrap:break-word;}
</style>
<body style="background-color:white;background-image:none;">
<div id="reports_transactionhistoryBoxArea" class="reports_transactionhistoryBox"  style="display:none;">	
	<div id="reports_summary" style="float:left;">
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionsummaryreport.php" method="post">
			<input type="hidden" name="Method" value="Transactions" />
			
			<input type="hidden" name="perpage" value="15" />
			<input type="hidden" name="pagenum" value="1" />
			<table class="tblRegisterUser" width="85%">
			 <tr>
			   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="TransSdatefrom" name="TransSdatefrom" style="width:50%;" value="<?php echo htmlentities($_REQUEST['TransSdatefrom'], ENT_QUOTES);?>" readonly="true"/></td>
			   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
			   <td><input type="text" id="TransSdateto" name="TransSdateto" style="width:50%;" value="<?php echo htmlentities($_REQUEST['TransSdateto'], ENT_QUOTES);?>" readonly="true"/></td>
			   <td align="center">
					<input type="submit" id="btnTransH" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
			 </tr>
		   </table>
		  </form>
		</div>
		<div id="transactionHistory" style="width:100%;font-size:10px;">
			<?php $transactionhistorydata = $this->data("transactionhistorydata"); ?>
				<?php if(isset($transactionhistorydata->ResponseCode)){ ?>
					<?php if(is_array($transactionhistorydata->Value)){?>
					
					<div class="demo_jui">
					<div style="margin-top:15px";></div>
					<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.transactionsummaryreport.php" method="post">
					
					<table style="width: 100%; table-layout: fixed;" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_transactionsummaryreport">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("DATE RANGE"); ?></th>
							<th><?php echo _("TOTAL VALUE"); ?></th>
							<th><?php echo _("TOTAL VOLUME"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($transactionhistorydata->Value as $t): $ctr++;?>
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
									<td><?php echo htmlentities($_REQUEST['TransSdatefrom'], ENT_QUOTES) . " - " . htmlentities($_REQUEST['TransSdateto'], ENT_QUOTES); ?></td>
									<td><?php echo $t->TOTAL_AMOUNT; ?></td>
									<td><?php echo $t->TOTAL_COUNT; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
					<div style="margin-top:-45px";></div>
					
				<?php } else {
					echo "<h3> No Records Found : $transactionhistorydata->Message</h3>";
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
		oTable = $('#reports_transactionsummaryreport').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false,
			"aaSorting": [[ <?php if($_REQUEST["type"] == "HITS_PULL") { echo "5"; }else{ echo "2"; } ?>, "desc" ]]
		});

		var ht = $("#reports_transactionhistoryBoxArea").css('height');
		ht = ht.replace("px","");
		$("#if_reports_transactionsummaryreport",window.parent.document).css('height',parseInt(ht)+200);
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
	
$(document).ready(function(){
	$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
	setTimeout(function(){
		$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
				type:"POST",
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