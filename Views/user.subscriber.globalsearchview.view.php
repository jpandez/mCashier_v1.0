<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
	._d-none{
		display:none;
	}
	._GlobalSearchContent{
		width:100%;border:1px solid lightgray;text-align:center;
	}
</style>
<div id="globalsearchview" class="_d-none">
<table border="0" cellspacing="5" class="tablet">
	<tr>
		<td colspan="7"><?php echo _("Global Search Options"); ?></td>
	</tr>
	<tr>
		<td class="_d-none">
			<?php echo _("Subscriber"); ?>:
		</td>
		<td class="_d-none">
			<select id="subscriber" class="w-100">
				<!--<option>SENDER</option>-->
				<option>DESTINATION</option>
			</select>
		</td>
		<td>
			<?php echo _("Search Type"); ?>:
		</td>
		<td>
			<select id="searchType" class="w-100">
				<option value="MSISDN">MSISDN</option>
				<option value="MEN">MERCHANT NAME</option>
				<option value="MID">MERCHANT ID</option>
				<option value="TID">TERMINAL ID</option>
				<option value="TRANSID" <?php if($_POST['selecttype']=='TRANSID'){ echo 'selected="selected"';} ?>>TRANSACTION ID</option>                   
                <option value="RRN" <?php if($_POST['selecttype']=='RRN'){ echo 'selected="selected"';} ?>>RRN</option>
				<!--<option>NICKNAME</option>-->
			</select>
		</td>
		<td><input type="text" id="searchValue"><input type="text" id="searchValueValidity" disabled="disabled" size="6"></td>
		<td>
		<?php echo _("Lookup Table"); ?>:
		</td>
		<td>
			<select id="lookUp" class="w-100">
				
			</select>
		</td>
	</tr>
	 <tr>
		<tr>
			<td colspan="7"><?php echo _("Transaction Period"); ?></td>
		</tr>
		<td><?php echo _("From"); ?><span class="text-danger">*</span>:</td>
		<td><input type="text" id="datefrom"></td>
		<td><?php echo _("To"); ?><span class="text-danger">*</span>:</td>
		<td><input type="text" id="dateto"></td>
		<td colspan="3">
			<input type="submit" id="btnGlobalView" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
		</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
	<!--<tr>
		<td colspan="7"><?php echo _("Search by Transaction ID/RRN"); ?></td>
	</tr>
	<tr>
		<td>
			<select name="selecttype" id="selecttype" style="width:11em;margin-right:10px">
				<option value="TRANSID" <?php if($_POST['selecttype']=='TRANSID'){ echo 'selected="selected"';} ?>>Transaction ID</option>                   
                <option value="RRN" <?php if($_POST['selecttype']=='RRN'){ echo 'selected="selected"';} ?>>RRN</option>
			</select>
		</td>
		<td><input type="text" id="searchRefID"></td>
	</tr>
	<tr>
		<tr>
			<td colspan="7"><?php echo _("Transaction Period"); ?></td>
		</tr>
		<td><?php echo _("From"); ?><span class="text-danger">*</span>:</td>
		<td><input type="text" id="RefIDdatefrom"></td>
		<td><?php echo _("To"); ?><span class="text-danger">*</span>:</td>
		<td><input type="text" id="RefIDdateto"></td>
		<td colspan="3">
			<input type="submit" id="btnSearchRefID" value="<?php echo _("search"); ?>" class="ui-state-default ui-corner-all ui-button">
		</td>
	</tr> -->
</table>
</div>
<div id="GlobalSearchContent" class="_GlobalSearchContent"></div>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	$("#btnGlobalView").click(function(){
		if($("#searchType").val()=="MID" && $("#searchValueValidity").val()=="Invalid!"){
			$("<p>Invalid Merchant ID. Please check search parameter.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}else if ($("#searchType").val()=="TID" && $("#searchValueValidity").val()=="Invalid!"){
			$("<p>Invalid Terminal ID. Please check search parameter.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}else if($("#searchType").val()=="MSISDN" && $("#searchValueValidity").val()=="Invalid!"){
			$("<p>Invalid MSISDN. Please check search parameter.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}else if($("#searchType").val()=="MEN" && $("#searchValueValidity").val()=="Invalid!"){
			$("<p>Invalid Merchant Name. Please check search parameter.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}else if($("#searchType").val()=="TRANSID" || $("#searchType").val()=="RRN"){
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			var params = {
				referenceid:$("#searchValue").val(),
				refiddatefrom:$("#datefrom").val(),
				refiddateto:$("#dateto").val(),
				selecttype:$("#searchType").val(),
				t:window.parent.pagetoken
			};
			$('.transloading').show();
			$("#GlobalSearchContent").load(global_search_refid_url,params,function(){
				$('.transloading').hide();
			});
		}else{
			$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
			
			var params = {
				subscriber:$("#subscriber").val(),
				skey:$("#searchType").val(),
				value:$("#searchValue").val(),
				transtype:$("#lookUp").val(),
				fromdate:$("#datefrom").val(),
				todate:$("#dateto").val(),
				t:window.parent.pagetoken
			};
			
			$('.transloading').show();
			$("#GlobalSearchContent").load(global_search_url,params,function(){
				$('.transloading').hide();
			});
		}	
	});
	
	$("#btnSearchRefID").click(function(){
		$.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "20" /> Just a moment...</h3>' });
		var params = {
			referenceid:$("#searchRefID").val(),
			refiddatefrom:$("#RefIDdatefrom").val(),
			refiddateto:$("#RefIDdateto").val(),
			selecttype:$("#selecttype").val(),
			t:window.parent.pagetoken
		};
		$('.transloading').show();
		$("#GlobalSearchContent").load(global_search_refid_url,params,function(){
			$('.transloading').hide();
		});
	});
			
	$("#btnGlobalView").show();
	$("#searchValue, #searchType").change(function(){
		var mtod = '';
		if($("#searchType").val() == 'MSISDN'){
			mtod = 'validateMSISDN';
		}else if($("#searchType").val() == 'TID'){
			mtod = 'validateTID';
		}else if($("#searchType").val() == 'MID'){
			mtod = 'validateMID';
		}else if($("#searchType").val() == 'MEN'){
			mtod = 'validateNickname';
		}else if($("#searchType").val() == 'RRN'){
			$("#searchValueValidity").val('Valid!');
			$("#searchValueValidity").css("background-color", "#008000");
		}else if($("#searchType").val() == 'TRANSID'){
			$("#searchValueValidity").val('Valid!');
			$("#searchValueValidity").css("background-color", "#008000");
		}
    	
    	var params = {Method:mtod,inp:$("#searchValue").val(),FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')};			
		$.ajax({
			url:service_url,
			type:"POST", 
			data:params,
			complete:function(result,status){												
					if(status=="success" && $("#searchType").val() == 'MSISDN'){													
						$("#searchValueValidity").css("color", "#ffffff");
						if(result.responseText != 1){
							$("#searchValueValidity").val('Valid!');																							
							//$("#btnGlobalView").show();
							$("#searchValueValidity").css("background-color", "#008000");															
						}else{
							$("#searchValueValidity").val('Invalid!');															
							//$("#btnGlobalView").hide();
							$("#searchValueValidity").css("background-color", "#ff0000");
						}							
					}else if($("#searchType").val() == 'RRN' || $("#searchType").val() == 'TRANSID'){
						$("#searchValueValidity").val('Valid!');
						$("#searchValueValidity").css("background-color", "#008000");
					}else{
						$("#searchValueValidity").css("color", "#ffffff");
						if(result.responseText == 4){
							$("#searchValueValidity").val('Valid!');
							//$("#btnGlobalView").show();
							$("#searchValueValidity").css("background-color", "#008000");															
						}else{
							$("#searchValueValidity").val('Invalid!');
							//$("#btnGlobalView").hide();
							$("#searchValueValidity").css("background-color", "#ff0000");
						}
					}
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
    });
	
	lookUpTable();
	function lookUpTable(){
		var params = {
				Method:'queryGlobal',
				query: 'CIQP6QUMnHojdHkA0/GqpdyxdN6n3Wnc+UMDJgafL/HlP/GYnOUCEVDis7Njg1hTgYYq0VTdT7EdCetCNRx/TOwC+lBldySRzyvQDJnreFw=',
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(result){
					var listitem = "";                                
					$('#lookUp').find('option').remove();
					listitem +='<option value="ALL">ALL</option>';
					for(x in result.value){
						
						listitem += '<option value="'+ result.value[x].KEY +'">' + result.value[x].DESCRIPTION + '</option>';
						
					} 
					$('#lookUp').html(listitem);
					$('#lookUp').click();
				}, error: function(e){
			//$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	function globalSearchSMS(vRefID, vMSISDN, vMessage){
		var params = {
				Method:'globalSearchSMS',
				referenceid: vRefID,
				msisdn: vMSISDN,
				message: vMessage,
				FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
				};

		$.ajax({url:service_url,
				type:"POST", 
				data:params,
				dataType: 'json',
				success:function(json){
					if(json.ResponseCode == 0){
						$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					}else{
						$("<p>"+json.Message+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					}
				}, error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
		});
	}
	
	$("#globalsearchview").fadeIn(700);
</script>