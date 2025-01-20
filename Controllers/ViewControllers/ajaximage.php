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

$totalsize = 0;

//$path = "C:/xampp/htdocs/Projects/uploads/";
$path = "/var/www/html/Projects/uploads/"; 
	//$valid_formats = array("jpg", "png", "gif", "bmp", "pdf");
	$valid_formats = array("jpg", "pdf", "JPG", "PDF");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	//	if(isset($_POST))
		{
			$photoimg = "photoimg";
			if(isset($_REQUEST["Method"])){
				switch($_REQUEST["Method"]){
					case "Image1":
						$photoimg = "photoimg";
						$_SESSION['size1'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "111
						//echo $photoimg;
					break;
					case "Image2":
						$photoimg = "photoimg2";
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew1":
						$photoimg = "photoimgnew1";
						$_SESSION['size2'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew2":
						$photoimg = "photoimgnew2";
						$_SESSION['size3'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew3":
						$photoimg = "photoimgnew3";
						$_SESSION['size4'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew4":
						$photoimg = "photoimgnew4";
						$_SESSION['size5'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew5":
						$photoimg = "photoimgnew5";
						$_SESSION['size6'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew6":
						$photoimg = "photoimgnew6";
						$_SESSION['size7'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew7":
						$photoimg = "photoimgnew7";
						$_SESSION['size8'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew8":
						$photoimg = "photoimgnew8";
						$_SESSION['size9'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;
					case "Imagenew9":
						$photoimg = "photoimgnew9";
						$_SESSION['size10'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;


					case "Imagenew2":
						$photoimg = "photoimgnew2";
						$_SESSION['size3'] = $_FILES[$photoimg]['size'];
						$valid = 'reg';
						//echo "222";
						//echo $photoimg;
					break;


					case "Image3":
						$photoimg = "photoimg3";
						//echo "333";
					break;
					case "ImageStore":
						$photoimg = "photoimgStore";
						//echo "333";
					break;
					case "newImage1":
						$photoimg = "newphotoimg1";
						//echo "333";
					break;
					case "sendImage1":
						$photoimg = "photoimgSend1";
						$_SESSION['sizeSend1'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName1'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					case "sendImage2":
						$photoimg = "photoimgSend2";
						$_SESSION['sizeSend2'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName2'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					case "sendImage3":
						$photoimg = "photoimgSend3";
						$_SESSION['sizeSend3'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName3'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					
					case "delImageB2W":
						echo '<script language="javascript">';
						echo 'alert("session deleted");';
						echo '</script>';
						echo "<script>console.log( 'HELLO DELETE' );</script>";
						unset($_SESSION['imageB2W']);
						$photoimage="";
					break;
						
					
					
				}
				
				
			
			
				
			}else{
				$photoimg = "photoimg";
				
			}
			
	
			$size = $_FILES[$photoimg]['size'];
			
			//echo "a: ".$_SESSION['sizeSend1']." b:".$_SESSION['sizeSend2']." c:".$_SESSION['sizeSend3'];
			
			// Add size default if not isset
			if (!isset($_SESSION['size1'])) {
				$_SESSION['size1'] = 0;
			}
			
			if (!isset($_SESSION['size2'])) {
				$_SESSION['size2'] = 0;
			}
			
			if (!isset($_SESSION['size3'])) {
				$_SESSION['size3'] = 0;
			}

			if($valid=='reg'){
			$totsize = (int) $_SESSION['size1'] + (int) $_SESSION['size2'] + (int) $_SESSION['size3'];}
			else if($valid=='sen'){
				
			$totsize = (int) $_SESSION['sizeSend1'] + (int) $_SESSION['sizeSend2'] + (int)$_SESSION['sizeSend3'];
			}
			
			//echo $totalsize;
			$name = $_FILES[$photoimg]['name'];
			$size = $_FILES[$photoimg]['size'];
		
			/*if ($totalsize<=(8000*1024)){
				
				$startsession = "0";
				
			}else{
				echo "File exceeds to 8MB!";
				$startsession = "1";
			}
			
			//for send back
			if ($sendtotalsize<=(8000*1024)){
				$startsession = "0";
			}else{
				echo "File exceeds to 8MB!";
				$startsession = "1";
			}*/
			
			
			// if(strlen($name) && $startsession==0) 
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					/* var_dump($size); */
					
					//if($size<=(6144000) && $totsize<=(15360000))
					if($size<=(8192000))
						{
							
							//$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$actual_image_name = date("YmdHis")."_UPLOAD_BANK_".$txt.".".$ext;
							//$actual_image_name = $_REQUEST['filename'].".".$ext;
							$tmp = $_FILES[$photoimg]['tmp_name'];
							$tmp = $_FILES['files']["tmp_name"][0];
						
							//var_dump($tmp);
							$pdffile=$_FILES['files']["tmp_name"][0];
							$filecontent = file_get_contents($pdffile);
							if (preg_match('/JavaScript/', $filecontent)) {
								echo "Failed, pdf file has xss script!";
							} else
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
									
									$data = file_get_contents($path.$actual_image_name);
									$base64image = base64_encode($data);
									if(strlen($name)>=10){
									$name = substr($name,0,10)."...".$ext;
									}else{
										$name=$name;
									}
									if(isset($_REQUEST["Method"])){
										switch($_REQUEST["Method"]){
											case "Image1":
												$_SESSION['imageB2W'] = $base64image;
												$_SESSION['urlBfile1'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Image2":
												$_SESSION['image2'] = $base64image;

												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image3":
												$_SESSION['image3'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image4":
												$_SESSION['image4'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image5":
												$_SESSION['image5'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image6":
												$_SESSION['image6'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image7":
												$_SESSION['image7'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image8":
												$_SESSION['image8'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image9":
												$_SESSION['image9'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											case "Image10":
												$_SESSION['image10'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											
											case "Imagenew1":
												$_SESSION['imagenew1'] = $base64image;
												$_SESSION['urlBfile2'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew2":
												$_SESSION['imagenew2'] = $base64image;
												$_SESSION['urlBfile3'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew3":
												$_SESSION['imagenew3'] = $base64image;
												$_SESSION['urlBfile4'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew4":
												$_SESSION['imagenew4'] = $base64image;
												$_SESSION['urlBfile5'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew5":
												$_SESSION['imagenew5'] = $base64image;
												$_SESSION['urlBfile6'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew6":
												$_SESSION['imagenew6'] = $base64image;
												$_SESSION['urlBfile7'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew7":
												$_SESSION['imagenew7'] = $base64image;
												$_SESSION['urlBfile8'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew8":
												$_SESSION['imagenew8'] = $base64image;
												$_SESSION['urlBfile9'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew9":
												$_SESSION['imagenew9'] = $base64image;
												$_SESSION['urlBfile10'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew10":
												$_SESSION['imagenew10'] = $base64image;
												$_SESSION['urlBfile11'] = $path.$actual_image_name;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;

											case "Image3":
												$_SESSION['image3'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview3'>";
											break;
											case "ImageStore":
												$_SESSION['imageStore'] = $base64image;
												//echo "<img src='uploads/".$actual_image_name."'  class='previewStore'>";
												echo "<td>$name</td>";
												break;
											case "sendImage1":
												$_SESSION['sendBackImage1'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "<h1>PDF</h1> . $name";}else{ 
												echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";}
											break;
											case "sendImage2":
												$_SESSION['sendBackImage2'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "<h1>PDF</h1> . $name";}else{ 
												echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";}
											break;
											case "sendImage3":
												$_SESSION['sendBackImage3'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "<h1>PDF</h1> . $name";}else{ 
												echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";}
											break;
											
											case "delImageB2W":
												$_SESSION['sendBackImage3'] = "";
												echo "<script>console.log( 'HELLO DELETE' );</script>";
											break;
										}

									}else{
										$_SESSION['imageB2W'] = $base64image;
										echo "<img src='uploads/".$actual_image_name."'  class='preview'>";
									}
									//$_SESSION['imageB2W'] = $base64image;
									/* //$dAmn = new Model; 
									//$dAmn->uploadImage($base64image); */
									
									//echo "<img src='uploads/".$actual_image_name."'  class='preview'>";
									/* //var_dump($base64image);
									//unlink($path); */
								}
							else
								echo "failed";
						}
						else
						echo "Image file size max per file 8 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";

				
			exit;
		}
		else {
			echo '<script language="javascript">';
						//echo 'alert("KULANG");';
						echo '</script>';
						echo "<script>console.log( 'HELLO NOT DELETE' );</script>";
		}

	
?>