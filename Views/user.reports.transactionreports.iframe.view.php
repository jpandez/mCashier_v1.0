<iframe src="user.reports.transactionreports.php" class="w-100" id="if_reports_transactionreports">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_transactionreports").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_transactionreports").attr("src",src);
</script>