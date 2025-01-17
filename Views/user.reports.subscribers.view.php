<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $responseReport = $this->data("responseReport"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="reports_subscribersBoxArea" class="reports_subscribersBox"  style="display:none;">	
	<div id="subscriber_count">									
		<table style="width:100%;" class="tablet">
				<tr class="ui-widget-header">
					<?php echo $this->data("subsCountheader"); ?>
				</tr>
				<tbody>	
					<tr>
						 <?php echo $this->data("subsCountdata"); ?>
					</tr>	
				</tbody>
		</table>	
	</div>
	<div id="reports_summary" style="width:40%">
		<form id="searchForm" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.subscribers.php" method="post">
		    <input type="hidden" name="Method" value="SubscriberList" />				
			<table class="tablet" width="85%">
			<tr>
			   <td class="td3"><?php echo _("Lookup Table"); ?>:</td>
			   <td>
			   		<select id="lookUp" name="accounttype" style="width:100%;">
						<?php echo $this->data("subsOptionvalue"); ?>
					</select>
			   </td>
			   <td align="center">
					<input type="submit" id="btnTransH" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
					<div class="sloading"></div>
				</td>
			 <tr>
		   </table>
	  </form>
	</div>
	<div id="subscriberList" style="width:100%;font-size:10px;">
		<?php $subscriberlist = $this->data("subscriberlist"); ?>
		<?php if(isset($subscriberlist->ResponseCode)){ ?>
			<?php if(is_array($subscriberlist->Value)){ if (!isset($_REQUEST['pagenum']) || !isset($_REQUEST['perpage'])){$_REQUEST['pagenum']=1; $_REQUEST['perpage']=15;} ?>
				<div>
					<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.subscribers.php?Method=ExportSubscriberCSV&accounttype=<?php echo sanitize_string($_REQUEST['accounttype']);?>&queryCount=<?php echo $subscriberlist->QueryCount;?>">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
					</a>
					<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.subscribers.php?Method=ExportSubscriberPDF&accounttype=<?php echo sanitize_string($_REQUEST['accounttype']);?>&queryCount=<?php echo $subscriberlist->QueryCount;?>">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_pdf.png" border="0" alt="logo" />PDF
					</a>
					<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.subscribers.php?Method=ExportSubscriberEXCEL&accounttype=<?php echo sanitize_string($_REQUEST['accounttype']);?>&queryCount=<?php echo $subscriberlist->QueryCount;?>">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_excel.png" border="0" alt="logo" />EXCEL
					</a>
				</div>
				<div style="margin-top:15px";></div>
				<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.reports.subscribers.php" method="post">
					<select id="lookUp" name="perpage" style="width:20%;" onchange="this.form.submit()">
						<option value="15" <?php echo ($_REQUEST['perpage']==15)?'selected':'';?>>15 Per Page</option>
						<option value="25" <?php echo ($_REQUEST['perpage']==25)?'selected':'';?>>25 Per Page</option>
						<option value="50" <?php echo ($_REQUEST['perpage']==50)?'selected':'';?>>50 Per Page</option>
					</select>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="trans" width="100%">
					<thead>
					<tr class="ui-widget-header">
						<th><?php echo _("ACCOUNT ID"); ?></th>
						<th><?php echo _("TYPE"); ?></th>
						<th><?php echo _("NICKNAME"); ?></th>
						<th><?php echo _("FIRST NAME"); ?></th>
						<th><?php echo _("SECOND NAME"); ?></th>
						<th><?php echo _("LAST NAME"); ?></th>
						<th><?php echo _("MSISDN"); ?></th>
						<th><?php echo _("STATUS"); ?></th>
						<th><?php echo _("REGDATE"); ?></th>
						<th><?php echo _("KYC"); ?></th>
						<th><?php echo _("BUSINESS TYPE"); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php $ctr=0; foreach($subscriberlist->Value as $t): $ctr++;?>
							<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
								<td><?php echo $t->ID; ?></td>
								<td><?php echo $t->TYPE; ?></td>
								<td><?php echo $t->NICKNAME; ?></td>
								<td><?php echo $t->FIRSTNAME; ?></td>
								<td><?php echo $t->SECONDNAME; ?></td>
								<td><?php echo $t->LASTNAME; ?></td>
								<td><?php echo $t->MSISDN; ?></td>
								<td><?php echo $t->STATUS; ?></td>
								<td><?php echo $t->REGDATE; ?></td>
								<td><?php echo $t->KYC; ?></td>
								<td><?php echo $t->CORPTYPEOFBUSINESS; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div style="margin-top:-45px";></div>
				<input type="hidden" name="Method" value="SubscriberList" />
				<input type="hidden" name="accounttype" value="<?php echo sanitize_string($_REQUEST['accounttype']);?>" />
				<input type="hidden" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']);?>" />
				
				First <input type="submit" name="pagenum" value="1" class="ui-state-default ui-corner-all ui-button" <?php if(1 == $_REQUEST['pagenum']){ echo "disabled=true"; }?>><<
									
				<?php 
				$l = ceil($subscriberlist->QueryCount/$_REQUEST['perpage']) - $_REQUEST['pagenum'];
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
					if($_REQUEST['pagenum']+$i <= ceil($subscriberlist->QueryCount/$_REQUEST['perpage'])){?>
				<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']+$i); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(($_REQUEST['pagenum']+$i) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>>
				<?php } $i++;} ?>
				>><input type="submit" name="pagenum" value="<?php echo ceil($subscriberlist->QueryCount/$_REQUEST['perpage']); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(ceil($subscriberlist->QueryCount/$_REQUEST['perpage']) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>> Last
				</form><br>
				<?php echo "Page " . sanitize_string(($_REQUEST['pagenum']) . " of ". ceil($subscriberlist->QueryCount/$_REQUEST['perpage'])); ?>
				<?php echo " of total $subscriberlist->QueryCount entries"; ?>
			<?php } else {
				echo "<h3> No Records Found : $subscriberlist->Value</h3>";
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
		oTable = $('#trans').dataTable({
			"bJQueryUI": true,
			"bPaginate": false,
			"bFilter": false,
			"bInfo": false
		});
		
		var ht = $("#reports_subscribersBoxArea").css('height');
		ht = ht.replace("px","");
		$("#if_reports_subscribers",window.parent.document).css('height',parseInt(ht)+50);
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

	$("#reports_subscribersBoxArea").fadeIn(700);	
</script>