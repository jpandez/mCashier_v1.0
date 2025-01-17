

<?php require_once("views.config.properties.php"); ?>

<!DOCTYPE html>
<html>
<head>
				<style type="text/css">
			.DivToScroll{   
		    background-color: #F5F5F5;
		    border: 1px solid #DDDDDD;
		    border-radius: 4px 0 4px 0;
		    color: #3B3C3E;
		    font-size: 12px;
		    font-weight: bold;
		    left: -1px;
		    padding: 10px 7px 5px;
		}
		
		.DivWithScroll{
		    height:140px;
		    overflow:scroll;
		    overflow-x:hidden;
		}	
		
		</style>
				<!-- Bootstrap styles -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
		<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/bootstrap5.2.3/css/bootstrap.min.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/all.min.css" rel="stylesheet" />
		<!-- blueimp Gallery styles -->
		<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
		<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
		<link rel="stylesheet" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/jquery.fileupload.css">
		<link rel="stylesheet" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/jquery.fileupload-ui.css">
		<!-- CSS adjustments for browsers with JavaScript disabled -->
		<noscript><link rel="stylesheet" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/jquery.fileupload-noscript.css"></noscript>
		<noscript><link rel="stylesheet" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/jquery.fileupload-ui-noscript.css"></noscript>
</head>
<body>
				<div>
			<form id="fileupload" action="ajaximage3.php" method="POST" enctype="multipart/form-data">
		        <!-- Redirect browsers with JavaScript disabled to the origin page -->
		        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
		        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		        <div class="row fileupload-buttonbar">
		            <div class="col-lg-7">
		            	<input type="hidden" name="Method" id="Method" value="Image1" />
		                <!-- The fileinput-button span is used to style the file input field as button -->
		                <button type="submit" class="btn btn-primary btn-sm start" id="regg1" style="display: none">
							<i class="fa-solid fa-arrow-up"></i>
		                    <span>REGISTER</span>
		                </button>
		                <button class="btn btn-primary btn-sm start" style="display: none" id="regg">
							<i class="fa-solid fa-arrow-up"></i>
		                    <span>REGISTER</span>
		                </button>
		                <span class="btn btn-success btn-sm fileinput-button" id="addButton">
		                	<i class="fa-solid fa-plus"></i>
		                    <span>Add files...</span>
		                    <input type="file" name="files[]" id="files" multiple>
		                </span>
		                <button type="reset" class="btn btn-warning btn-sm cancel text-light">
							<i class="fa-solid fa-ban"></i>
		                    <span>Cancel upload</span>
		                </button>
		                <span>Upload 10 files max with 8MB file size limit.</span>
		                <span class="fileupload-process"></span>
		            </div>
		            <!-- The global progress state -->
		            <div class="col-lg-5 fileupload-progress fade">
		                <!-- The global progress bar -->
		                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
		                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
		                </div>
		                <!-- The extended global progress state -->
		                <div class="progress-extended">&nbsp;</div>
		            </div>
		        </div>
		        <!-- The table listing the files available for upload/download -->
		        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
			</form>
		</div>
					
		
		<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-upload">
				<td>
					<p class="name">{%=file.name%}</p>
					<strong class="error text-danger"></strong>
				</td>
				<td>
					<p class="size">Processing...</p>
					<!-- <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width: 0%;">
						<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:0%;"></div>
					</div> -->
				</td>
				<td>
					{% if (!i && !o.options.autoUpload) { %}
						<button class="btn btn-primary btn-sm start" disabled hidden>
							Start
						</button>
					{% } %}
					{% if (!i) { %}
						<button class="btn btn-warning btn-sm cancel text-light">
							<i class="fa-solid fa-ban"></i>
							<span>Cancel</span>
						</button>
					{% } %}
				</td>
			</tr>
		{% } %}
		</script>
		
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-download">
				<td>
					<p class="name">
						{% if (file.url) { %}
							<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl ? 'data-gallery' : ''%}>{%=file.name%}</a>
						{% } else { %}
							<span>{%=file.name%}</span>
						{% } %}
					</p>
					{% if (file.error) { %}
						<div><span class="badge bg-danger">Error</span> {%=file.error%}</div>
					{% } %}
				</td>
				<td>
					<span class="size">{%=o.formatFileSize(file.size)%}</span>
				</td>
				<td>
					{% if (file.deleteType) { %}
						<button class="btn btn-danger btn-sm delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							<i class="fa-solid fa-trash"></i>
							<span>Delete</span>
						</button>
						<!-- <input type="checkbox" name="delete" value="1" class="toggle"> -->
					{% } else { %}
						<button class="btn btn-warning btn-sm cancel">
							<i class="fa-solid fa-circle-xmark"></i> <!-- Bootstrap Icons for cancel -->
							<span>Cancel</span>
						</button>
					{% } %}
				</td>
			</tr>
		{% } %}
		</script>	

		<!-- <script type="text/javascript">
			$('#fileupload').fileupload({
    			multipart: true,
    			limitMultiFileUploads: 3
			});

$('#fileupload').fileUpload({
    maxFileSize: 8192000, // Size in Bytes - 5 MB
    minFileSize: 100000, // Size in Bytes - 100 KB
    maxNumberOfFiles: 10,
    // Accept only image file types:
    acceptFileTypes: /(pdf)|(jpe?g)$/i
});

		</script> -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.3.7.1.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/bootstrap5.2.3/js/bootstrap.bundle.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/main.js"></script>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js"></script>


<script type="text/javascript">

$('#addButton').click(function(){
			$("#regg1").show();
		});


$('#fileupload').fileupload({
    }).bind('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
        if(progress == 100){
            //alert('DONE');
            $(parent.document).find('#tester').val('SUCCESS');
            $(parent.document).find('#btnRegister').trigger("click");
            $('#regg').show();
            $('#regg1').hide();
        }
    });


    $('#regg').click(function(){
   		 $(parent.document).find('#btnRegister').trigger("click");
	});
        </script>

   

</body>

</html>