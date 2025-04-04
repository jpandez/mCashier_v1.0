<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
._m-top{
	margin-top:10px;
}
._d-none{
	display:none;
}

._ksnContent{
	width:100%;border:1px solid lightgray;text-align:center;
}
.ksnCount{
    width: 100%;
    height: 25px;
}

.tablet{
    width: 32%;
    margin: 35px;
}
</style>
<div class="_m-top"></div>
<div id="" class="_ksnContent">
<div align="center" class="_d-none" id="ksn">			
	<table class="tablet">
	   <td align="center"><?php echo _("Enter KSN Count"); ?><span class="text-danger">*</span>:</td>
	   <td><input type="text" id="ksnCount" class="ksnCount"></td>
	   <td align="center">
			<input type="submit" id="btnGenerateKsn" value="<?php echo _("Generate"); ?>" class="ui-state-default ui-corner-all ui-button">
		</td>
	</table>
	</div>
</div>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>

<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">
var service_url = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>WebServices/SubscriberWebServices.php";

    $("#btnGenerateKsn").click(function(){
        $.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'generateKSN',
                ksnCount:$("#ksnCount").val(),
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
			},success: function(json){
				if(json.ResponseCode == 0){
					$("#ksnCount").val('');
				}
				$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
                setTimeout($.unblockUI, 1000);
			}
           
            ,error: function(e){
            setTimeout($.unblockUI, 1000);
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	});

    $('#ksnCount').on('keyup', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
    });

	$("#ksn").fadeIn(700);
</script>