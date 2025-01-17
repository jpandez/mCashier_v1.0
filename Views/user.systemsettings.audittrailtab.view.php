<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
._m-top{
	margin-top:10px;
}
._d-none{
	display:none;
}
._selectuser{
	width:200px;
}
._auditTrailContent{
	width:100%;border:1px solid lightgray;text-align:center;
}
</style>
<div class="_m-top"></div>
<div align="center" class="_d-none" id="audit">			
	<table class="tablet">
	   <td class="td3"><?php echo _("Select User"); ?>:</td>
	   <td>
			<select id="selectUser" class="_selectuser" >
				<option value="">ALL</option>
			</select>
	   </td>
	   <td class="td3"><?php echo _("From"); ?><span class="text-danger">*</span>:</td>
	   <td><input type="text" id="datefrom" readonly="true"></td>
	   <td class="td3"><?php echo _("To"); ?><span class="text-danger">*</span>:</td>
	   <td><input type="text" id="dateto" readonly="true"></td>
	   <td align="center">
			<input type="submit" id="btnViewAudit" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
			<div class="sloading"></div>
		</td>
	</table>
	<div id="auditTrailContent" class="_auditTrailContent"></div>
</div>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>

<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">
var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";
var audit_trail_url = "<?php echo str_replace(' ','%20',$GLOBALS['CONTROLLER_PATH']);?>ViewControllers/user.systemsettings.audittrail.php";


		$("#btnViewAudit").click(function(){
		
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			var params = {
				userid:$("#selectUser").val(),
				username:$("#selectUser").val(),
				fromdate:$("#datefrom").val(),
				todate:$("#dateto").val(),
				t:window.parent.pagetoken
			};
			
				$('.sloading').fadeToggle(300);
				$("#auditTrailContent").load(audit_trail_url,params,function(){
				$('.sloading').hide();
				});
				
				
			
        });
		loadUsers();
		function loadUsers(){
	        var params = {Method:'getAllUsers',FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};
	        $.ajax({
	           url:service_url,
	           success:function(result,status){
	               var listitem = ""
	               listitem += '<option value="">ALL</option>';                         
	                for(var i = 0; i < result.value.length; i++)
	                {                    
	                    listitem += '<option value="'+ result.value[i].USERNAME +'">' + result.value[i].USERNAME + '</option>';
	                }
	                
	                $('#selectUser').html(listitem);
	                $('#selectUser').click();                
	              
	           },
	           dataType:"JSON",
	           data: params , error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	        });                     
		}
		
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>
	
	$("#audit").fadeIn(700);
</script>