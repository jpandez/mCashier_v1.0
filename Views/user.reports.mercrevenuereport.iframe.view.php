<iframe src="user.reports.mercrevenuereport.php" class="w-100" id="if_reports_mercrevenuereport">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_mercrevenuereport").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_mercrevenuereports").attr("src",src);
</script>