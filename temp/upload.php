<?php
$file = "/var/www/html/Projects/mCashier_v1.0/temp/test/" . $_POST['filename'];
if(!file_exists($file)){
	move_uploaded_file($_FILES["fileupload"]["tmp_name"],$file);
	echo "File is successfully uploaded in AppServer.";
	var_dump($_FILES["fileupload"]);
}else{
	echo "File is already exists.";
}
?>