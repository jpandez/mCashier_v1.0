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
					case "sendImage4":
						$photoimg = "photoimgSend4";
						$_SESSION['sizeSend4'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName4'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					case "sendImage5":
						$photoimg = "photoimgSend5";
						$_SESSION['sizeSend5'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName5'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;

					case "sendImage6":
						$photoimg = "photoimgSend6";
						$_SESSION['sizeSend6'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName6'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					case "sendImage7":
						$photoimg = "photoimgSend7";
						$_SESSION['sizeSend7'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName7'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					case "sendImage8":
						$photoimg = "photoimgSend8";
						$_SESSION['sizeSend8'] = $_FILES[$photoimg]['size'];
						$_SESSION['sendImageName8'] = $_FILES[$photoimg]['name'];
						$valid = 'sen';
						//echo "333";
					break;
					
					
				}
				
				
			
			
				
			}else{
				$photoimg = "photoimg";
				
			}
			
	
			$size = $_FILES[$photoimg]['size'];
			
			//echo "a: ".$_SESSION['sizeSend1']." b:".$_SESSION['sizeSend2']." c:".$_SESSION['sizeSend3'];
			
			if($valid=='reg'){
			$totsize = $_SESSION['size4']+$_SESSION['size5'];}
			else if($valid=='sen'){
				
			$totsize = $_SESSION['sizeSend4']+$_SESSION['sizeSend5'];
			}
			
			//echo $totalsize;
			$name = $_FILES[$photoimg]['name'];
			$size = $_FILES[$photoimg]['size'];
		

			
			if(strlen($name) && $startsession==0)
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					/* var_dump($size); */
					
					if($size<=(8192000))
						{
							
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							
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
									
									if(isset($_REQUEST["Method"])){
										switch($_REQUEST["Method"]){
											case "Image1":
												$_SESSION['imageB2W'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name.pdf";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name.jpg</td>";
												}
											break;
											case "Image2":
												$_SESSION['image2'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview2'>";
											break;
											
											case "Imagenew1":
												$_SESSION['imagenew1'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew2":
												$_SESSION['imagenew2'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew4":
												$_SESSION['imagenew4'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Imagenew5":
												$_SESSION['imagenew5'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo " $name";}else{ 
												//echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview2'></td></tr><tr><td>$name</td></tr></table>";
												echo "<td>$name</td>";
												}
											break;
											case "Image3":
												$_SESSION['image3'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='preview3'>";
											break;
											case "Image4":
												$_SESSION['image4'] = $base64image;
												echo $name;
											break;
											case "Image5":
												$_SESSION['image5'] = $base64image;
												echo $name;
											break;
											case "ImageStore":
												$_SESSION['imageStore'] = $base64image;
												echo "<img src='uploads/".$actual_image_name."'  class='previewStore'>";
												break;
											case "sendImage1":
												$_SESSION['sendBackImage1'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";}
											break;
											case "sendImage2":
												$_SESSION['sendBackImage2'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";}
											break;
											case "sendImage3":
												$_SESSION['sendBackImage3'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td><img src='uploads/".$actual_image_name."'  class='preview'></td></tr><tr><td>$name</td></tr></table>";}
											break;
											
											case "sendImage4":
												$_SESSION['sendBackImage4'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td>$name</td></tr></table>";}
											break;
											
											case "sendImage5":
												$_SESSION['sendBackImage5'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td>$name</td></tr></table>";}
											break;

											case "sendImage6":
												$_SESSION['sendBackImage6'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td>$name</td></tr></table>";}
											break;

											case "sendImage7":
												$_SESSION['sendBackImage7'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td>$name</td></tr></table>";}
											break;

											case "sendImage8":
												$_SESSION['sendBackImage8'] = $base64image;
												if($ext == 'pdf' || $ext == 'PDF'){echo "$name";}else{ 
												echo "<table><tr><td>$name</td></tr></table>";}
											break;
										}
									}else{
										$_SESSION['imageB2W'] = $base64image;
										echo "<img src='uploads/".$actual_image_name."'  class='preview'>";
									}

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

	
?>