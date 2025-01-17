<iframe src="user.reports.registeredmerchants.php" class="w-100" id="if_reports_registeredmerchants">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if_reports_registeredmerchants").attr("src")+"?t=" + window.pagetoken;
$("#if_reports_registeredmerchants").attr("src",src);
</script>