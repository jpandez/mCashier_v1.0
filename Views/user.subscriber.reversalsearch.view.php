<?php require_once("views.config.properties.php"); ?>
<div id="rev"  style="display:none;">
<table>				
	<tr>
		<td><?php echo _("Reference ID"); ?><span style="color:red">*</span>:</td>
		<td><input type="text" id="searchReversal"></td>
		<td>
			<input type="submit" id="btnSearchReversal" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
		</td>
		<td><div class="reversalloading"></div></td>
	</tr>
</table><br>
</div>
<div id="ReversalSearchContent"></div>
<script>
var reversal_search_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.subscriber.reversalresult.php";	
$("#btnSearchReversal").click(function(){
			var params = {
					referenceid:$("#searchReversal").val()
			};
			
				$('.reversalloading').show();
				$("#ReversalSearchContent").load(reversal_search_url,params,function(){
					$('.reversalloading').hide();
				});
			
        });
		
		$("#rev").fadeIn(700);
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>