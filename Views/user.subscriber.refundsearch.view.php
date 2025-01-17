<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
	._d-none{
		display:none;
	}
</style>
<div id="refund" class="_d-none">
<table>				
	<tr>
		<td><?php echo _("Reference ID"); ?><span class="text-danger">*</span>:</td>
		<td><input type="text" id="searchRefund"></td>
		<td>
			<input type="submit" id="btnSearchRefund" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
		</td>
		<td><div class="reversalloading"></div></td>
	</tr>
</table><br>
</div>
<div id="RefundSearchContent"></div>
<script nonce="<?php echo $_SESSION['nonce'];?>">
var refund_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.refundresult.php";	
$("#btnSearchRefund").click(function(){
			var params = {
					referenceid:$("#searchRefund").val()
			};
			
				$('.reversalloading').show();
				$("#RefundSearchContent").load(refund_search_url,params,function(){
					$('.reversalloading').hide();
				});
			
        });
		
		$("#refund").fadeIn(700);
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>