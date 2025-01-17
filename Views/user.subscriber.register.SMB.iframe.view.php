<iframe src="user.subscriber.register.SMB.php" class="w-100" id="if">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#if").attr("src")+"?t=" + window.pagetoken;
$("#if").attr("src",src);
</script>