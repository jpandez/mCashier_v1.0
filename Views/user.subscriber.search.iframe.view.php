<?php require_once("views.config.properties.php"); ?>
<iframe src="user.subscriber.search.php" class="w-100" id="ifsearch">
</iframe>
<script nonce="<?php echo $_SESSION['nonce'];?>">
var src = $("iframe").attr("src")+"?t=" + window.pagetoken;
$("iframe").attr("src",src);
</script>
<!--<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>-->