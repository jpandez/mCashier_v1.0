<iframe src="user.reports.topMerchant.php" class="w-100" id="if_reports_topMerchant">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_topmerchant").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_topmerchant").attr("src",src);
</script>