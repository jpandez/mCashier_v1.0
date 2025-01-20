<?php
    session_start();
    ob_start();
    require_once("viewcontrollers.config.properties.php");
    require_once($GLOBALS["CONTROLLER_PATH"] . "BusinessControllers/bc.config.properties.php");
    require_once("ViewController.php");

    class SubscriberTransactionsController extends ViewController {
        public function __construct() {
            parent::__construct();
            $serv = new SubscriberServices();
            
            if ($this->getRolesConfig('DOWNLOAD_APPLICATION_FILE') && $_REQUEST["msisdn"] == $_SESSION["downloadmsisdn"]) {
                
                if ($_REQUEST["smbBoolean"]) {
					//$ret = $serv->getIdIMAGESMB($_SESSION["currentUser"], $_REQUEST["msisdn"]);
                    if ($_REQUEST["ftype"] == "QC") {
                        $ret = $serv->getIdIMAGESMB($_SESSION["currentUser"], $_REQUEST["image"], $_REQUEST["appID"]);
                    } else {
                        $ret = $serv->getIdIMAGEBNK($_SESSION["currentUser"], $_REQUEST["image"], $_REQUEST["appID"]);
                    }
                } else {
                    $ret = $serv->getIdIMAGE($_SESSION["currentUser"], $_REQUEST["appID"], $_REQUEST["image"]);
                }
                
                $imagePath = $ret->Value[0]->IMAGE; // Edited by Val Dela Cruz - 01/20/2025
                
                if (!empty($imagePath) && file_exists($imagePath)) {
                    $data = file_get_contents($imagePath);
                } else {
                    die('File path is invalid or file does not exist.');
                }

				// ----- Enhanced by Val
                $imageType = [
                    1 => "_A", 2 => "_B", 3 => "_C", 4 => "_D",
                    5 => "_E", 6 => "_F", 7 => "_G", 8 => "_H",
                    9 => "_I", 10 => "_J"
                ][$_REQUEST["image"]] ?? '';

                ob_end_clean();
                ob_start();
				//$binary = base64_decode($ret->Value[0]->IMAGE);
                $binary = $data;
                $finfo = new finfo(FILEINFO_MIME);
                $mime_type = $finfo->buffer($binary);
				//echo $mime_type;
                $mimeToExt = [
                    "image/jpeg; charset=binary" => ".jpg",
                    "application/pdf; charset=binary" => ".pdf"
                ];
                $ext = $mimeToExt[$mime_type] ?? ".NOFILEFOUND";

                if ($ext === ".NOFILEFOUND") {
                    die('No File Found.');
                }

				//-------------- Added by Alyanna & Val 01/17/2025 START ----------------
                // Sanitize and validate user input
                function sanitizeInput($input) {
                    return preg_replace('/[^A-Za-z0-9_\-]/', '', $input);
                } 

				// Get user input and sanitize it
                $msisdn = isset($_REQUEST['msisdn']) ? sanitizeInput($_REQUEST['msisdn']) : '';
                $type = isset($_REQUEST['type']) ? sanitizeInput($_REQUEST['type']) : '';

				// Encode filename
                $filename = rawurlencode("ApplicationFile_{$msisdn}{$imageType}{$ext}");

				// Set headers for file download
                header("Cache-Control: public;");
                header("Content-Description: File Transfer;");
                header("Content-Disposition: attachment; filename={$filename}");
                header("Content-Type: application/octet-stream");
                header("Content-Transfer-Encoding: binary");

                echo $binary;

				//-------------- Added by Alyanna & Val 01/17/2025 END ----------------


				// header("Cache-Control: public");
				// header("Content-Description: File Transfer");
				// header("Content-Disposition: attachment; filename=ApplicationFile_" . $_REQUEST["msisdn"].$type. $ext);
				//  //header("Content-Disposition: attachment; filename=ApplicationFile_" .date("YmdHis") . $ext);
				// header("Content-Type: application/octet-stream");
				// header("Content-Transfer-Encoding: binary");			
				// echo $binary;

                ob_end_flush();
                exit;
                
                $this->setMaster("user.reports.transactionreports.view.php");
                $this->render();
                
            } else {
                echo _("Unauthorized Access!");
				//echo $_REQUEST["msisdn"];
				//echo $_SESSION["downloadmsisdn"];
				//echo "image here".$_REQUEST["image"];
            }
        }
    }
    $i = new SubscriberTransactionsController();
?>