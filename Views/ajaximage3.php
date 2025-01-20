<?php session_start();
?>

<?php
/*ini_set('max_execution_time', 300);
ini_set("max_input_time",300); */
/*
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_execution_time', 300);*/
//require_once('model/usermodel.php');



//$path = "uploads/";
$path = "/var/www/html/Projects/uploads/"; 
//$path = "C:/xampp/htdocs/Projects/uploads/";
	$valid_formats = array("jpg", "pdf", "JPG", "PDF");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$photoimg = "photoimg";
		if(isset($_REQUEST["Method"])){
			switch($_REQUEST["Method"]){
				case "Image1":
					$photoimg = "photoimg";
					// $_SESSION['size1'] = $_FILES[$photoimg]['size']; uncomment if iupload sa server
					$valid = 'reg';
					//echo "111
					//echo $photoimg;
				break;	
			}	
		}else{
			$photoimg = "files";	
		}

	$size = $_FILES['files']['size'][0];

			
			//echo $totalsize;
			$name = $_FILES['files']['name'][0];
			$size = $_FILES['files']['size'][0];
			
			
		if(strlen($name) >0 ){
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats)){
				if($size<=(8192000)){	
					$addfilename = (int) $_SESSION['counterfile']+1;
					$actual_image_name = date("YmdHis")."_UPLOAD".$addfilename."_".$txt.".".$ext;
					$tmp = $_FILES['files']["tmp_name"][0];
						
					//var_dump($tmp);
					$pdffile=$_FILES['files']["tmp_name"][0];
					$filecontent = file_get_contents($pdffile);
					if (preg_match('/JavaScript/', $filecontent)) {
						echo "Failed, pdf file has xss script!";
					} else
				
					if (is_uploaded_file($_FILES['files']['tmp_name'][0])) {
					if(move_uploaded_file($tmp, $path.$actual_image_name)){
						$data = file_get_contents($path.$actual_image_name);
						$base64image = base64_encode($data);
						if(strlen($name)>=10){
							$name = $txt.".".$ext;
						}else{
							$name=$name;
						}
						if(isset($_REQUEST["Method"])){
							switch($_REQUEST["Method"]){
								case "Image1":
									if($_SESSION['counterfile']<10){
										$_SESSION['counterfile'] = (int) $_SESSION['counterfile'] +1;
										$imgname = "file".$_SESSION['counterfile'];
										$_SESSION['url'.$imgname] = $path.$actual_image_name;
										$_SESSION[$imgname] = $base64image;
							

										$pdf = preg_replace(
										  '%(<</S/Javascript/JS\()(.*;)(.*)%i',
										  '<</S/Javascript/JS(;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;\r)>>',
										  'not allowed'
										);
										file_put_contents($path.'text.txt',$pdf);
										echo "{\"files\": [{\"url\": \"\",\"thumbnailUrl\": \"\",\"name\": \""."SUCCESS - ".$name."\",\"type\": \"image/jpeg\",\"size\": ".$size.",\"deleteUrl\": \"\",\"deleteType\": \"DELETE\" }]}";
									}else{
										echo "{\"files\": [{\"url\": \"\",\"thumbnailUrl\": \"\",\"name\": \"MAX UPLOAD FILE REACHED - ".$name."\",\"type\": \"image/jpeg\",\"size\": \"".$size."\",\"deleteUrl\": \"\",\"deleteType\": \"\" }]}";	
									}
								break;
							}
						}else
								echo "{\"files\": [{\"url\": \"\",\"thumbnailUrl\": \"\",\"name\": \"UNKNOWN ERROR\",\"type\": \"image/jpeg\",\"size\": \"0\",\"deleteUrl\": \"\",\"deleteType\": \"\" }]}";
					}else
						//echo $path.$actual_image_name;
						echo $_FILES['files']['error'][0];
				}else
				echo "Uploading file/s not via https post are not allowed!";
			
				}else
					//echo "Image file size max per file 3 MB";	
					echo "{\"files\": [{\"url\": \"\",\"thumbnailUrl\": \"\",\"name\": \"EXCEEDS 8MB FILE SIZE\",\"type\": \"image/jpeg\",\"size\": \"0\",\"deleteUrl\": \"\",\"deleteType\": \"\" }]}";				
			}else
				echo "{\"files\": [{\"url\": \"\",\"thumbnailUrl\": \"\",\"name\": \"INVALID FILE FORMAT - ".$name."\",\"type\": \"image/jpeg\",\"size\": ".$size.",\"deleteUrl\": \"\",\"deleteType\": \"\" }]}";	
		}else
			echo "{\"files\": [{\"url\": \"\",\"thumbnailUrl\": \"\",\"name\": \"EXCEEDS 8MB FILE SIZE\",\"type\": \"image/jpeg\",\"size\": \"0\",\"deleteUrl\": \"\",\"deleteType\": \"\" }]}";
				exit;
	}else{
				echo '<script language="javascript">';
				//echo 'alert("KULANG");';
				echo '</script>';
				echo "<script>console.log( 'HELLO NOT DELETE' );</script>";
	}?>