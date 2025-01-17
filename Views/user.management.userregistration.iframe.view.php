<iframe src="user.management.userregistration.php" class="w-100" id="ifuserregistration">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#ifuserregistration").attr("src")+"?t=" + window.pagetoken;
$("#ifuserregistration").attr("src",src);
</script>