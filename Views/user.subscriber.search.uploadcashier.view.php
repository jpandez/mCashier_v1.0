<?php require_once("views.config.properties.php"); ?>
<?php $uploadCashier = $this->data("uploadCashier"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $accountType = $this->data("accountType"); ?>
<?php $newStore = $this->data("newStore"); ?>
<!--<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>-->
<style type="text/css">
#uploadForm {
	text-align: justify;
    width: 400px;
    height: 25px;
    background-color: white;
    box-shadow: 1px 2px 3px #ededed;
    position:relative;
    border: 1px solid #d8d8d8;
	overflow: hidden;
}
 #inpCSV{
    width:400px;
    height:25px;
    opacity:0
}
#val {
    width: 400px;
    height:25px;
    position: absolute;
    top: 0;
    left: 0;
    font-size:13px;
    line-height: 25px;
    text-indent: 10px;
    pointer-events: none;
}
#button {
    cursor: pointer;
    display: block;
    width: 90px;
    background-color: #719E19;
    height:25px;
    color: white;
    position: absolute;
    right:0;
    top: 0;
    font-size: 11px;
    line-height:25px;
    text-align: center;
    -webkit-transition: 500ms all;
    -moz-transition: 500ms all;
    transition: 500ms all;
}

#button:hover {
    background-color: #212121;
	color: #BED30B;
}

.uploadBtnDisa {
	cursor: not-allowed;
	width: 90px;
	background-color: #878881;
	color: white;
	border:none;
	padding: 4px;
	font-size: 11px;
	-webkit-transition: 500ms all;
    -moz-transition: 500ms all;
    transition: 500ms all;
	box-shadow: 1px 2px 3px #ededed;
}

.uploadBtnEna {
	cursor: pointer;
	width: 90px;
	background-color: #719E19;
	color: white;
	border:none;
	padding: 4px;
	font-size: 11px;
	-webkit-transition: 500ms all;
    -moz-transition: 500ms all;
    transition: 500ms all;
	box-shadow: 1px 2px 3px #ededed;
}

.uploadBtnEna:hover {
	background-color: #212121;
	color: #BED30B;
}
td {
	vertical-align: middle !important;
}
</style>
<body style="background-color:white;background-image:none;">
<form method="post" enctype="multipart/form-data" action="<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.search.uploadcashier.php">
<center>
	<table>
		<input type="hidden" name="t" value="<?php echo htmlspecialchars($_SESSION['pagetoken'])?>" />
		<tr><td colspan="2" align="center"><h3>Upload File</h3></td></tr>
		<tr><td colspan="2"><div id="uploadForm">		
			<input type="file" id="inpCSV" name="inpCSV" accept=".csv"><span id="val"></span>
			<span id="button">Select CSV File</span>	
		</div></td></tr><tr><td><br /></td></tr>
		<tr><td>
		<input type="submit" class="uploadBtnDisa" id="uploadBtn" value="<?php echo _('Upload'); ?>" disabled />
		</td><td align="right">
		<img id="uploadGif" style="display: none;" src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loading.gif" alt="Uploading.." />
		<span id="err" style="display:none;color:red;"></span>
		</td></tr>
		
		<tr><td>&nbsp;</td></tr>
		<tr><td colspan="2" align="center" style="font-style:italic">Please create an CVS file in the following format (fields marked * are mandatory)</td></tr>
		<tr><td colspan="2" align="center" style="font-style:italic">Phone number*,First name,Last name,email,merchant ID,terminal ID</td></tr>
		<tr><td colspan="2" align="center" style="font-style:italic">Example: 971000011002,Ken,Laude,ken.laude@email.com,123456,1122</td></tr>
	</table>
</center>
</form>
</body>

<!-- end ui-dialog lock -->


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

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form.js"></script>
<script>
	var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
	var trans_report_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.transactions.php";
	var global_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearch.php";
	var global_search_refid_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.globalsearchrefid.php";
	var reversal_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.reversalresult.php";
	var wisepad_serial_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.wisepadserial.php";
	window.authMobNumber = "<?php echo $account==null?"":$account->MobileNumber ?>";
	window.CurrentUser = "<?php echo $currentUser; ?>";		
	window.AccountType = "<?php echo $accountType; ?>";
	window.NewStore = "<?php echo $newStore; ?>";
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script>

<?php if($uploadCashier->Message != null):?>
$(document).ready(function(){	
	$("<p><?php echo $uploadCashier->Message; ?></p>").dialog({
		resizable:false,
		modal:true,
		buttons: { 
			"Ok": function() { 
				$(this).dialog("close");
			} 
		} 
	});						
});
<?php endif; ?>

$("#inpCSV").click(function() {
	// alert(window.AccountType);
});
$("#inpCSV").change(function() {
	var type = $("#inpCSV").val().split('.').pop().toLowerCase();
	if(type == "csv"){
		$("#uploadBtn").attr('disabled',false);
		$("#uploadBtn").removeClass('uploadBtnDisa');
		$("#uploadBtn").addClass('uploadBtnEna');
		$("#err").hide();
	}else{
		$("#uploadBtn").attr('disabled',true);
		$("#uploadBtn").removeClass('uploadBtnEna');
		$("#uploadBtn").addClass('uploadBtnDisa');
		$("#err").html('Invalid filetype, please choose CSV file.');
		$("#err").show();
	}
});
$("#uploadBtn").click(function() {
	$("#uploadGif").show();
});
$('#button').click(function () {
    $("#inpCSV").trigger('click');
});
$("#inpCSV").change(function () {
    $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
});
</script>