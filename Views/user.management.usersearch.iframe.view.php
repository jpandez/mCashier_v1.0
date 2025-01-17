<iframe src="user.management.usersearch.php" class="w-100" id="ifusersearch">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#ifusersearch").attr("src")+"?t=" + window.pagetoken;
$("#ifusersearch").attr("src",src);
</script>