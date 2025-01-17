<iframe src="user.management.rolesconfiguration.php" class="w-100" id="ifrolesconfiguration">
</iframe>

<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("#ifrolesconfiguration").attr("src")+"?t=" + window.pagetoken;
$("#ifrolesconfiguration").attr("src",src);
</script>