<iframe src="user.reports.aramexeidreport.php" class="w-100" id="if_reports_aramexeid">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_aramexeid").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_aramexeid").attr("src",src);
</script>