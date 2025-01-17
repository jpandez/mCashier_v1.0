<iframe src="user.reports.transactionhistory.php" class="w-100" id="if_reports_transactionhistory">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_transactionhistory").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_transactionhistory").attr("src",src);
</script>