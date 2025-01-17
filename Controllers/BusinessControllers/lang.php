<?php
if($_SESSION['lang'] != ""){
	if(isset($_REQUEST["lang"])){
		$_SESSION['lang'] = $_REQUEST["lang"];
	}{
		$_SESSION['lang'] = "en";
	}
}else{
	$_SESSION['lang'] = "en";
}
?>