<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<body style="background-color:white;background-image:none;">
<div id="dealercommi" style="display:none;">
<div class="uitabs" id="tabs">
		
		<div id="dCommConfirmationTab" style="margin-top:15px;">
			

			<?php $getCommissionsPndgForConfirmation = $this->data("getCommissionsPndgForConfirmation");?>
			<?php if(isset($getCommissionsPndgForConfirmation->ResponseCode)){ ?>
				<?php if(is_array($getCommissionsPndgForConfirmation->Value)){?>
				<div>
					<a href="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission1sumdetails.php?Method=ExportDetailsCSV&queryCount=<?php echo $getCommissionsPndgForConfirmation->QueryCount;?>">
						<img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/export_csv.png" border="0" alt="logo" />CSV
					</a>
				</div>
					<div style="margin-top:10px";></div>
					<form id="searchPagination" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>/ViewControllers/user.pendings.dealercommission1sumdetails.php" method="post">			
					<select id="lookUp" name="perpage" style="width:20%;" onchange="this.form.submit()">
						<option value="10" <?php echo ($_REQUEST['perpage']==10)?'selected':'';?>>10 Per Page</option>
						<option value="15" <?php echo ($_REQUEST['perpage']==15)?'selected':'';?>>15 Per Page</option>
						<option value="25" <?php echo ($_REQUEST['perpage']==25)?'selected':'';?>>25 Per Page</option>
					</select>
					<table cellpadding="0" cellspacing="0" border="0" class="display" id="dtdealercommissionC" width="100%">
						<thead>
						<tr class="ui-widget-header">
							<th><?php echo _("RUNID"); ?></th>
							<th><?php echo _("REFERENCEID"); ?></th>
							<th><?php echo _("CREATED TIMESTAMP"); ?></th>
							<th><?php echo _("TYPE"); ?></th>
							<th><?php echo _("MSISDN"); ?></th>
							<th><?php echo _("REMARKS"); ?></th>
							<th><?php echo _("AMOUNT"); ?></th>
						</tr>
						</thead>
						<tbody>
							<?php $ctr=0; foreach($getCommissionsPndgForConfirmation->Value as $t): $ctr++;?>
								
								<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>" id="dcommi_<?php echo $t->ID; ?>">
									<td><?php echo $t->RUNID; ?></td>
									<td><?php echo $t->REFERENCEID; ?></td>
									<td><?php echo $t->TIMESTAMP; ?></td>
									<td><?php echo $t->TYPE; ?></td>
									<td><?php echo $t->MSISDN; ?></td>										
									<td><?php echo $t->REMARKS; ?></td>
									<td><?php echo $t->CREDIT; ?></td>									
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
						<div style="margin-top:-45px";></div>
						
							<input type="hidden" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum']);?>" />
							
							First <input type="submit" name="pagenum" value="1" class="ui-state-default ui-corner-all ui-button" <?php if(1 == $_REQUEST['pagenum']){ echo "disabled=true"; }?>><<
							
							<?php 
							$l = ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']) - $_REQUEST['pagenum'];
							$l = 9 - $l;
							if($l < 1){ 
								if($_REQUEST['pagenum'] != 1){ ?>
								<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])-1; ?>" class="ui-state-default ui-corner-all ui-button">
							<?php }
							}
							while($l > 0){ 
								if($_REQUEST['pagenum']-$l > 1){?>
								<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])-$l; ?>" class="ui-state-default ui-corner-all ui-button">
							<?php }
							$l--;} ?>
							
							<?php $i=0;	while($i < 10){
								if($_REQUEST['pagenum']+$i <= ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage'])){?>
							<input type="submit" name="pagenum" value="<?php echo sanitize_string($_REQUEST['pagenum'])+$i; ?>" class="ui-state-default ui-corner-all ui-button" <?php if(($_REQUEST['pagenum']+$i) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>>
							<?php } $i++;} ?>
							
							>><input type="submit" name="pagenum" value="<?php echo ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']); ?>" class="ui-state-default ui-corner-all ui-button" <?php if(ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']) == $_REQUEST['pagenum']){ echo "disabled=true"; }?>> Last
						</form><br>
						
						<?php echo "Page " . ($_REQUEST['pagenum']) . " of ". ceil($getCommissionsPndgForConfirmation->QueryCount/$_REQUEST['perpage']); ?>
						<?php echo " of total $getCommissionsPndgForConfirmation->QueryCount entries"; ?>					
						<div class="spacer"></div>
				<?php } else {
					echo "<h3> No Records Found</h3>";
				}?>
				
				
			<?php } ?>
		</div>
		

		
</div><div class="dcommiloading"></div>
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
var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
$(document).ready(function() {
			oTable = $('#dtdealercommission, #dtdealercommissionC').dataTable({
				"bJQueryUI": true,
				"bPaginate": false,
				"bFilter": false,
				"bInfo": false,
				"aaSorting": [[ 2, "desc" ]]
			});
			oTable = $('#dtdcsummary, #dtdcsummaryC').dataTable({
				"bJQueryUI": true,
				"bPaginate": false,
				"bFilter": false,
				"bInfo": false
			});
			
			var ht = $("#dealercommi").css('height');
			ht = ht.replace("px","");
			$("#if_pendings_dealercommission",window.parent.document).css('height',parseInt(ht)+0);
		} );
$("#dealercommi").fadeIn(700);
	

	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
	<?php 
        if(isset($_REQUEST['Method'])){
            switch($_REQUEST["Method"]){
            	case "getDealerCommission":
					echo "$('#tabs').tabs({ selected: 1 });";
				break;
            }
    } ?>
</script>