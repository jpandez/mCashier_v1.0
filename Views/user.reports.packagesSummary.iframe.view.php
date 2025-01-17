<iframe src="user.reports.packagesSummary.php" class="w-100" id="if_reports_packagessummary">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_packagessummary").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_packagessummary").attr("src",src);
</script>