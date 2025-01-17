<?php require_once("views.config.properties.php"); ?>
<iframe src="user.subscriber.vmallsbasketsearch.php" style="width:100%;" id="ifsearch2">
</iframe>
<script>
var src = $("ifsearch2").attr("src")+"?t=" + window.pagetoken;
$("ifsearch2").attr("src",src);
</script>
<!--<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js"></script>-->