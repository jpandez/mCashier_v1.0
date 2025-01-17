//ETISALAT MOBILE COMMERCE
//TELCOM LIVE CONTENT, INC 2012
//Author: Kira /Jinryu
//March 19, 2012
//Links,Buttons,Tabs,Dialogs

$(function(){
	// Tabs
	//$('#tabs').tabs({ selected: "2" });
	$(".uitabs").tabs();
	$('#tabs').tabs();
	$('#SubscriberTab').tabs();
	$('#dialogGSearch').tabs();
	
	$('form').attr('autocomplete','off');

	$(".settingsButton,.uibutton").button();
	$("#dateTO, #pDOB, #pIDExpiry, #regExpiryDate, #REGCORPDATEOFINCORPORATION, #ab_add_expiryDate, #ab_expiryDate, #EXPIRY").datepicker({
		//duration:''
		//showOn: 'button', buttonImage: window.imgPath + 'images/calendar.gif', buttonImageOnly: true, 
		changeMonth:true, changeYear:true,
		maxDate: '',
		yearRange: '-100:+20',
		dateFormat: 'yy-mm-dd'
	});
	
	$("#regDob").datepicker({
		//duration:''
		showOn: 'button', buttonImage: window.imgPath + 'images/calendar.gif', buttonImageOnly: true, 
		changeMonth:true, changeYear:true,
		maxDate: new Date(),
		yearRange: '-100:+20',
		dateFormat: 'yy-mm-dd'
	});
	$("#DOB").datepicker({
		//duration:''
		//showOn: 'button', buttonImage: window.imgPath + 'images/calendar.gif', buttonImageOnly: true, 
		changeMonth:true, changeYear:true,
		maxDate: new Date(),
		yearRange: '-100:+20',
		dateFormat: 'yy-mm-dd'
	});
	
	// Statement start
	$("#historyFrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#historyTO" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#historyTO" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#historyFrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Statement end
	
	// Transaction Failed start
	$("#TransFdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransFdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#TransFdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransFdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Transaction Failed end
	
	// Transaction Summary start
	$("#TransSdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransSdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#TransSdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransSdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Transaction Summary end
	
	// Transaction History start
	$("#TransHdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransHdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#TransHdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransHdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Transaction History end
	
	// Transaction Report start
	$("#TransRdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransRdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#TransRdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransRdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Transaction Report end
	
	
	// RRN/TransID start
	$("#RefIDdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#RefIDdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#RefIDdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#RefIDdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// RRN/TransID end
	
	// Audit Trails - Global Search start
	$("#datefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#dateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#dateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#datefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Audit Trails - Global Search end
	
	// Summary start
	$("#Sumdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#Sumdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#Sumdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#Sumdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Summary end
	
	// Graphical Report start
	$("#TransLogsdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransLogsdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#TransLogsdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransLogsdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Graphical Report end
	
	// Dialog			
	$('#dialog').dialog({
		autoOpen: false,
		width: 700,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}
		},
		draggable: false,
		resizable: false
	});

	// buttons/links
	
	$('.ui-button').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	$(".ui-button").button();
	
	// Transaction Dealer commission start
	$("#TransDdatefrom" ).datepicker({
		changeMonth: true, changeYear:true,
		dateFormat: 'yy-mm-dd',
		maxDate: -1,
		onSelect: function( selectedDate ) {
			$( "#TransDdateto" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$("#TransDdateto" ).datepicker({
		changeMonth: true, changeYear:true,
		maxDate: -1,
		dateFormat: 'yy-mm-dd',
		onSelect: function( selectedDate ) {
			$( "#TransDdatefrom" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	// Transaction Dealer commission end
});
