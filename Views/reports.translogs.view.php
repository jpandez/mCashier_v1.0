<br>
<?php $transactionlogs = $this->data("transactionlogs");?>
<?php if(isset($transactionlogs->ResponseCode)){ ?>
<?php if(is_array($transactionlogs->Value)){?>
<button onclick="graph_daily()">Try it</button>
<?php print_r(json_encode($transactionlogs)); ?>
<div id="containerTL" style="margin: 0 auto">
</div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="global" width="100%">
	<thead>
		<tr class="ui-widget-header">
			<th>DATE</th>
			<th>SUMMARY</th>
		</tr>
	</thead>
	<tbody>
		<?php $ctr=0; foreach($transactionlogs->Value as $t): $ctr++;?>
			<tr class="<?php echo $ctr%2==1?'odd gradeA':'even gradeA'; ?>">
				<td><?php echo date('Y-m-d', strtotime($t->TIMESTAMP)); ?></td>
				<td><?php echo "SUBS: ".$t->SUBS.", SUBSREG: ".$t->SUBSREG.", SUBSUSED: ".$t->SUBSUSED.", SVA: ".$t->SVA.", SUCCESSTRANS: ".$t->SUCCESSTRANS.", FAILEDTRANS: ".$t->FAILEDTRANS.", CASHINTRANS: ".$t->CASHINTRANS.", CASHINAMOUNT: ".$t->CASHINAMOUNT.", CASHOUTTRANS: ".$t->CASHOUTTRANS.", CASHOUTAMOUNT: ".$t->CASHOUTAMOUNT.", BANK2EWTRANS: ".$t->BANK2EWTRANS.", BANK2EWAMOUNT: ".$t->BANK2EWAMOUNT.", EW2BANKTRANS: ".$t->EW2BANKTRANS.", EW2BANKAMOUNT: ".$t->EW2BANKAMOUNT.", BILLTRANS: ".$t->BILLTRANS.", BILLAMOUNT: ".$t->BILLAMOUNT.", EW2EWTRANS: ".$t->EW2EWTRANS.", EW2EWAMOUNT: ".$t->EW2EWAMOUNT; ?></td>
			</tr>									
		<?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
function graph_daily(){
	alert("test0");
}
function graph_daily1(){
	alert("test");
    var chart;
    var json;
    var cat = new Array();
	var dat = new Array();
   for(x in json.Result.DataRows)
	{	
			console.log(json.Result.DataRows[x].Columns);
			data = json.Result.DataRows[x].Columns;
			cat[x] = data[0];
			dat[x] = data[1];		
	}
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerTL',
                type: 'line'
            },
            title: {
                text: 'Transactions'
            },
            subtitle: {
                text: 'Total'
            },
            xAxis: {
                categories: cat
            },
            yAxis: {
                title: {
                    text: 'Totals'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Total Transactions',
                data: dat
            }]
        });
    });
    
});
</script>
<?php } else {echo "<h3> No Records Found : $transactionlogs->Message</h3>";}?>
<?php } ?>




