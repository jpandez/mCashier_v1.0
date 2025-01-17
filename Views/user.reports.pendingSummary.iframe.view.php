<iframe src="user.reports.pendingSummary.php" class="w-100" id="if_reports_pendingsummary">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_pendingsummary").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_pendingsummary").attr("src",src);
</script>