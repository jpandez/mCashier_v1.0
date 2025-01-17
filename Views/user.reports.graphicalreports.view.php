<?php require_once("views.config.properties.php"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $currentUser = $this->data("currentUser"); ?>
<?php $searchResult = $this->data("searchResult"); $account = $searchResult!=null?($searchResult->ResponseCode==0?$searchResult->AccountInformation:null):null;?>
<body style="background-color:white;background-image:none;">
<div id="reports_summary" style="width:60%;display:none;">								
	<table class="tblRegisterUser" width="85%">
	<tr>				  
	   <td class="td3"><?php echo _("From"); ?><span style="color:red">*</span>:</td>
	   <td><input type="text" id="TransLogsdatefrom" name="TransLogsdatefrom"  style="width:50%;" readonly="true"></td>
	   <td class="td3"><?php echo _("To"); ?><span style="color:red">*</span>:</td>
	   <td><input type="text" id="TransLogsdateto" name="TransLogsdateto"  style="width:50%;" readonly="true"></td>
	   <td align="center">
			<input type="submit" id="btnTransLog1" value="<?php echo _("View"); ?>" class="ui-state-default ui-corner-all ui-button">
			<div class="graphloading"></div>
		</td>
	 <tr>
   </table>
</div>
<div class="transloading"></div>
<div id="containerTL1"></div><div id="chart1"></div>
</body>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js"></script>
<script class="code" type="text/javascript">
	function a(cat, dat1, dat2, dat3){
	  var Labels = ['Total Transactions', 'Total Successful', 'Total Failed'];
	  var plot1 = $.jqplot('containerTL1', [dat1, dat2, dat3], {  			
	  			seriesDefaults: {pointLabels: { show:true }},
	            // Turns on animation for all series in this plot.
	            animate: true,
	            // Will animate plot on calls to plot1.replot({resetAxes:true})
	            animateReplot: true,
	            cursor: {
	                show: true,
	                zoom: false,
	                looseZoom: true,
	                showTooltip: false
	            },
				//seriesColors: ['#666666','#cccccc','#333333'],
				series:[
					{
						label:'Total Transactions',
	                    pointLabels: {
	                        show: true
	                    },
	                    renderer: $.jqplot.BarRenderer,
	                    showHighlight: false,
	                    yaxis: 'y2axis',
						rendererOptions: {
	                        // Default for bar series is 3000.  
	                        animation: {
	                            speed: 2000
	                        },
	                        barWidth: 50,
	                        barPadding: -15,
	                        barMargin: 0,
	                        highlightMouseOver: false
						}
	                },
					//{label:'Successful', color: 'rgb(0,153,0)'},
					//{label:'Failed', color: 'rgb(255,0,0)'},
					{
						rendererOptions: {
							//SUCCESS
	                        // Default for a line series is 2500 milli.
							animation: {
	                            speed: 2500
	                        }
							
						}
	                },
					{
						rendererOptions: {
							//FAILED
	                        // Default for a line series is 2500.
							animation: {
	                            speed: 2000
	                        }
						}
	                }
				],
				legend: {
	                show: true,
	                renderer: $.jqplot.EnhancedLegendRenderer,
	                rendererOptions: {
	                    numberRows: 1
	                },
	                placement: 'outsideGrid',
	                labels: Labels,
	                location: 's'
	            },
	            axesDefaults: {
	                pad: 0
	            },
	            axes: {
	                // These options will set up the x axis like a category axis.
	                xaxis: {
						renderer:$.jqplot.CategoryAxisRenderer,
						ticks:cat,
						tickRenderer: $.jqplot.CanvasAxisTickRenderer,
						tickOptions: {
							angle: -30,
							fontSize: '9pt',
							showMark: false,
							showGridline: true
							
						}
					},
	                yaxis: {
	                    tickOptions: {
	                        formatString: "%'d"
	                    },
	                    rendererOptions: {
	                        forceTickAt0: true
	                    }
					},
	                y2axis: {
	                    tickOptions: {
	                        formatString: "%'d"
	                    },
	                    rendererOptions: {
	                        // align the ticks on the y2 axis with the y axis.
	                        alignTicks: true,
	                        forceTickAt0: true
	                    }
					}
	            },
	            highlighter: {
				   tooltipOffset: 6, 
	               show: true, 
	               showLabel: true, 
	               tooltipAxes: 'y',
				   sizeAdjust: 7.5, tooltipLocation : 'ne'
	            }
			});
	};

	$("#btnTransLog1").click(function(){
		$("#containerTL1").empty();
		var cat;
		if($("#TransLogsdatefrom").val() != '' && $("#TransLogsdateto").val() != ''){
		var params = {Method:'transactionSummary',
	        			fromdate:$("#TransLogsdatefrom").val(),
						todate:$("#TransLogsdateto").val(),
						FToken:($('meta[name="csrf-token"]').attr('content')) ? $('meta[name="csrf-token"]').attr('content') : window.parent.$('meta[name="csrf-token"]').attr('content')
						};
	        $('.graphloading').fadeToggle(300);
	        $.ajax({
	           url:service_url,
	           success:function(result,status){
	           	$('.graphloading').fadeToggle(300,'linear',function(){
	           	if(status=="success"){
	           		if(result.value instanceof Array){
	           			var cat = new Array();
						var dat1 = new Array();
						var dat2 = new Array();
						var dat3 = new Array();
	           			for(var i = 0; i < result.value.length; i++){
	           				var str= result.value[i].DATEREPORT;
	           				cat[i] = str.replace(" 00:00:00.0","");
	           				dat1[i] = parseInt(result.value[i].TOTALTRANS);
	           				dat2[i] = parseInt(result.value[i].SUCCESSTRANS);
	           				dat3[i] = parseInt(result.value[i].FAILEDTRANS);
	           			}
	           			
	           			a(cat,dat1,dat2,dat3);
					}else{
						$("<p>No Record Found.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
					}
	           		
	           	}else{
	           		$("<p>Failed Report.</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
	           	}     	 
	           });
	           },
	           dataType:"JSON",
	           data: params , error: function(e){
			$("<p>"+e.responseText+"</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}
	        });
		}else{
			$("<p>Please input search value(s).</p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		}	
	});
	
	$("#reports_summary").fadeIn(700);
</script>