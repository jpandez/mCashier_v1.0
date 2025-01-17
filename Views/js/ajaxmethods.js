//ETISALAT MOBILE COMMERCE
//TELCOM LIVE CONTENT, INC 2012
//Author: Kira /Jinryu
//March 19, 2012
//Ajax Webservices Methods

$(function(){
	//Start Token
	$(".ahref").click(function(){
		$(".ahref").attr("href",$(this).attr("href") + "&t=" + window.parent.pagetoken);
	});
	
		$.ajaxSetup({
			data: {
				t: window.parent.pagetoken
			},
			dataType: "jsonp"
		});
		
	setInterval(function(){
		$.ajaxSetup({
			data: {
				t: window.parent.pagetoken
			},
			dataType: "jsonp"
		});

	}, 1000);
	
	$( "form" ).submit(function( event ) {
		//alert(window.pho);
		if(window.pho != "1"){
			var action = $("form").attr("action")+"?t=" + window.parent.pagetoken;
			$("form").attr("action",action);
		}
	});
	//End Token
	
	$("#nickname").click(function(){
		//$('#searchBox').removeAttr('onkeyup');
             $("#searchBox").unbind('keydown');	
	});
	
	$("#mobile_number").click(function(){
		//$('#searchBox').attr("onkeyup","this.value=this.value.replace(/\\D/g,'');");
	$("#searchBox").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode == 86 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
	});
	});
	
	$("#account_id").click(function(){		
		//$('#searchBox').attr("onkeyup","this.value=this.value.replace(/\\D/g,'');");
		
	$("#searchBox").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode == 86 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	});
	
	
    $("#btnLogin").click(function(){
        $('.loading').fadeToggle(300);
        
        $.ajax({
           type: "POST",
           complete:function(res, status){
            
           },
           data:$('#submit').closest('form').serialize(),
           dataType: 'json' 
        });
        
    });
	
	$("#btnSearchSubscriber").click(function(){
		$('.sloading').fadeToggle(300);	
	});
	
	
		
        
        $("#btnUserSearch").click(function(){
            $('.sloading').fadeToggle(300);
        });
        
        
        $("#btnTransLog").click(function(){
        	
			var params = {
				fromdate:$("#TransLogsdatefrom").val(),
				todate:$("#TransLogsdateto").val()
			};
			if($("#TransLogsdatefrom").val() != '' && $("#TransLogsdateto").val() != ''){
				$('.transloading').show();
				$("#containerTL1").load(trans_logs,params,function(){
					$('.transloading').hide();
				});
			}else{
				$("<p>Please input search value(s).</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
			}
			
			
        });

});
function key_lists(list,selected){
		$.ajax({
			url:service_url,
			type:"POST", 
			dataType: 'json',
			data:{
				Method:'queryGlobal',
				query: 'j/lCjvDdVFOxYfpAXjvXuEZhAGCbMR2ZMTkxnpILJ3CwFTJPr11f53oI4mR/FfPj/RJYRBk7QZ2cuJ92f9yW7SmZ3rFIJ0q/11rR+cEadGsM3niboac/AzAt9HepzBDYzFSYqpeRZFW0ubSv3Qzo+3z1CuxYRqcnZmoOiFIjlIy3iaTE39HbSqOjzth8kObCDZjhANyqV2gARDEaOtkzaBSuiERRDJfgpisoC9DZ99fBHzWeraeGaxRJN9k0keZGqGIV7TZ/JivPiTS8XgG2+w=='
			},success:function(result){
				var listitem = "<option value=''>Select Key</option>";                                
				for(x in result.value){
					listitem += '<option value="'+ result.value[x].KEY +'">' + result.value[x].KEY + '</option>';
				}
				$(list).html(listitem);
				$(list+" option[value='"+selected+"']").attr('selected','selected');
			}
		});
	}

	function type_lists(list,selected){
		$.ajax({
			url:service_url,
			type:'post',
			dataType:'json',
			data:{
				Method:'getAccountType'
			},success: function(json){
				var listitem = "<option value=''>Select Type</option>";
				for(x in json.value){
					listitem += "<option value='"+json.value[x].ACCOUNTTYPE+"'>"+json.value[x].DESCRIPTION+"</option>";
				}
				$(list).html(listitem);
				$(list+" option[value='"+selected+"']").attr('selected','selected');
			}
		});
	}