<?php
$GLOBALS["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/Projects/mCashier_v1.0/";
$GLOBALS["CONTROLLER_PATH"] = $GLOBALS["ROOT"] . "Controllers/";
$GLOBALS["VIEW_PATH"] = $GLOBALS["ROOT"] . "Views/";
$GLOBALS["LIB_PATH"] = $GLOBALS["ROOT"] . "Libraries/";
$GLOBALS["MODEL_PATH"] = $GLOBALS["ROOT"] . "Models/";

//configure error reporting
error_reporting(E_ALL ^ E_STRICT);

?>