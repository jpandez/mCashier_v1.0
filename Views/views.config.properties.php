<?php
$GLOBALS["ROOT"] = "/Projects/mCashier_v1.0/";
$GLOBALS["CONTROLLER_PATH"] = $GLOBALS["ROOT"] . "Controllers/";
$GLOBALS["VIEW_PATH"] = $GLOBALS["ROOT"] . "Views/";
$GLOBALS["LIB_PATH"] = $GLOBALS["ROOT"] . "Libraries/";
$GLOBALS["MODEL_PATH"] = $GLOBALS["ROOT"] . "Models/";
$GLOBALS["DATE_FORMAT"] = "d/m/Y H:i:s";

function formatDate($datetime, $format='Y-m-d H:i:s'){
	$date = date_create($datetime);
	return date_format($date, $format);
}

function sanitize_string($str = ''){
	return htmlentities($str, ENT_QUOTES);
}
?>