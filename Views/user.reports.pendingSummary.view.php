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
<div id="reports_pendingSummaryBoxArea" class="reports_pendingSummaryBox"  style="display:none;">	

		<div id="pendingSummary" style="width:100%;font-size:10px;">
		
			<?php $getPendingRegReport = $this->data("getPendingRegReport"); ?>
				<?php if(isset($getPendingRegReport->ResponseCode)){ ?>
					<?php if(is_array($getPendingRegReport->Value)){?>
					<div class="demo_jui">
					<div style="margin-top:15px";></div>
					<table style="width: 100%; table-layout: fixed;" cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="reports_registeredMerchants">
						<thead>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<?php $ctr=0; foreach($getPendingRegReport->Value as $t): $ctr++;?>
								<th><?php echo $t->KYC; ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<?php $ctr=0; foreach($getPendingRegReport->Value as $t): $ctr++;?>
								<td><?php echo $t->PENDING_COUNT; ?></td>
								<?php endforeach; ?>
							</tr>
						</tbody>
					</table>
					</div>
					<div style="margin-top:-45px";></div>				
					<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found : $getPendingRegReport->Message</h3>";
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
		oTable = $('#reports_registeredMerchants').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false,
			"aaSorting": [[ "5", "asc" ]]
		});

		var ht = $("#reports_registeredmerchantsBoxArea").css('height');
		ht = ht.replace("px","");
		$("#if_reports_registeredmerchants",window.parent.document).css('height',parseInt(ht)+200);
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
	
	$("#reports_pendingSummaryBoxArea").fadeIn(700);
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>