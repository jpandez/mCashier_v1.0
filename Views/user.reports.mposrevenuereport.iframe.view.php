<iframe src="user.reports.mposrevenuereport.php" class="w-100" id="if_reports_mposrevenue">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_mposrevenue").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_mposrevenue").attr("src",src);
</script>