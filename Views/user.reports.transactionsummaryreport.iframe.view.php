<iframe src="user.reports.transactionsummaryreport.php" class="w-100" id="if_reports_transactionsummaryreport">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_transactionsummaryreport").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_transactionsummaryreport").attr("src",src);
</script>