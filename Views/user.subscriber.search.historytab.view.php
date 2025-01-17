<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>

<div id ="statementtab" style="display:none;">
	<table style="width:100%;" class="tablet">
		<tr>
			<td><?php echo _("Transaction Period"); ?>:</td>
			<td><?php echo _("From"); ?><span style="color:red">*</span>:</td>
			<td><input type="text" id="historyFrom" readonly="true"></td>
			<td><?php echo _("To"); ?><span style="color:red">*</span>:</td>
			<td colspan="2">
				<input type="text" id="historyTO"  readonly="true">
				<input type="button" id="btnHistory" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
			</td>
			<td Style="display: none;">
				<select id="selKey">
					<option value="MAIN">Main Transactions</option>
					<option value="KEYCOST">Fees</option>
					<option value="BONUS">Commissions</option>
				</select>
			</td>
			<td style="width:82px;">
				<div class="transloading"></div>
			</td>
		</tr>
	</table>
	<div id="historyContent" style="width:100%;border:1px solid lightgray;text-align:center;">
		<br/>
		&nbsp;
	</div>
</div>		

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<!-- start allocate -->
<script>
var today = new Date();
today = today.getFullYear() + "-" + (today.getMonth()+1) + "-" + today.getDate();
$("#historyFrom").val(today);
$("#historyTO").val(today);

$('.ui-button').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
$(".ui-button").button();

	$("#btnHistory").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		
		$("#historyContent").empty();
		$("#dialogEmail").remove();
		if($("#selKey").val() == "MAIN"){
			var params = {
					MSISDN:window.authMobNumber,
					DateFrom:$("#historyFrom").val(),
					DateTo:$("#historyTO").val(),
					t:window.parent.pagetoken
				};
				$('.transloading').show();
				$("#historyContent").html('');
				$("#historyContent").load(trans_report_url,params,function(){
					$('.transloading').hide();
				});
		}else{
			var params = {
					MSISDN:window.authMobNumber,
					DateFrom:$("#historyFrom").val(),
					DateTo:$("#historyTO").val(),
					Key:$("#selKey").val(),
					t:window.parent.pagetoken
				};
				$('.transloading').show();
				$("#historyContent").load(trans_report_url,params,function(){
					$('.transloading').hide();
				});
		}
		
	});
</script>

<script>
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";	
</script>
<script>
$(document).ready(function(){
	var ht = $("#statementtab").css('height');
	ht = ht.replace("px","");
	$("#ifsearch",window.parent.document).css('height',parseInt(ht)+700);
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

$("#statementtab").fadeIn(700);	
</script>

