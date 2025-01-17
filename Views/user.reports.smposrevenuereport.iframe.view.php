<iframe src="user.reports.smposrevenuereport.php" class="w-100" id="if_reports_smposrevenue">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_smposrevenue").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_smposrevenue").attr("src",src);
</script>