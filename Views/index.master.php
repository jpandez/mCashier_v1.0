<?php require_once("views.config.properties.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="refresh" content="605">
<head>
	<title>mCashier v1.0</title>
	<link rel="icon" type="image/ico" href="<?php echo $GLOBALS['VIEW_PATH'];?>images/etisalat.ico" />
	<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/css/login.css" rel="stylesheet" />

	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.3.7.1.min.js"></script>
	<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/bootstrap5.2.3/css/bootstrap.min.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/bootstrap5.2.3/js/bootstrap.bundle.min.js"></script>
	<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/all.min.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-crossslide.js"></script>
	<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">
		window.moveTo(0,0);
		window.resizeTo(screen.width,screen.height);
	</script>
	
	<?php 
		$_SESSION['logintoken'] = uniqid(mt_rand(), true); 
		$length = 32;
		$_SESSION['pagetoken'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
		$_SESSION['token-expire'] = time() + 600;
	?>
	

	</head>
<body>
	<div class="container">
      <div class="row mt-5">
		<div class="col-lg-4">
		</div>
        <div class="col-lg-4 bg-dark mt-5 py-5 px-5 border-5 border-primary border-start">
			<div class = "mcashlogo">
			<img src = '<?php echo $GLOBALS['VIEW_PATH'];?>images/splash_3.png' width = '132' height = '56'/>
			<img class = 'float-end' src = '<?php echo $GLOBALS['VIEW_PATH'];?>images/et-logo.png' width = '50' height = '55'/>
			</div>
			
			<form role="form" id="login" method = "POST" autocomplete="off" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/index.php">
			  <div class="my-3">
				<label for="exampleInputEmail1" class="form-label text-light"><?php echo _("Username"); ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="fa-solid fa-user"></i></span>
				  	<input id="username" name="username" type="text" class="form-control text-uppercase" placeholder="Enter username">
				</div>
			  </div>
			  <div class="mb-3">
				<label for="exampleInputPassword1" class="form-label text-light"><?php echo _("Password"); ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="fa-solid fa-lock"></i></i></span>
				  	<input id="password" name="password" type="password" autocomplete="false" class="form-control" placeholder="ENTER PASSWORD">
				</div>
			  </div>
			  <input type="hidden" value="userLogin" name="Method" />
			  <input type="hidden" name="csrf-token" value="<?=$_SESSION['pagetoken']?>"/>
			  	<select class="form-control-lang btn-login" id="lang" name="lang">
					<option value="en">English</option>
				</select>
			  <input type="submit" class="btn btn-primary float-end btn-login" id="btnLogin" value = "LOGIN">
			</form>
        </div>
		<div class="col-lg-4">
		</div>
      </div>

      <div class="footer">
        <small>&copy; Powered by Etisalat.</small>
      </div>

    </div> <!-- /container -->
	
	<!-- <div class="modal fade bs-example-modal-sm" id = 'myModal' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-sm">
		<div class="modal-content" >
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span></button>
			  <h5 id = 'modal-body' class="modal-title" id="mySmallModalLabel"></h5>
			</div>
		</div>
	  </div>
	</div> -->

	<!-- Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
	  	<h1 class="modal-title fs-6" id="staticBackdropLabel">Server Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <h6 id="modal-body" class="modal-title text-danger"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	

<!-- <div id="authenticateModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> -->

    <!-- Modal content-->
    <!-- <div class="modal-content">
      <div class="modal-header" style="background-color: #BED308;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #FFFFFF;">Login</h4>
      </div>
      <div class="modal-body">
      		<form class="form-inline pi-search-form-wide" role="form" autocomplete="off" style="margin-right: 1px;" id="userLoginOTPForm" method = "POST" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/index.php">
			<h5 id = 'authenticateModal-body' class="modal-title" id="mySmallModalLabel"></h5>	
      		<label style="color: #000000;">Enter Code:</label>&nbsp;&nbsp;
			<div class="pi-input-with-icon pi-input-inline">
				<div class="pi-input-icon"><i class="icon-mobile"></i></div>
				<input id="loginPin" name="pin" type="password" autocomplete="false" class="form-control pi-input-wide" placeholder="Enter Code">
				<input type="password" id="prevent_autofill" autocomplete="false" style="display:none" tabindex="-1" />	
				<input type="text" name="pagetoken" value="<?=$_SESSION['pagetoken']?>" style="display: none" />			
				<input type="text" value="userLoginOTP" name="Method" style="display: none" />
			</div>
			<div style="text-align:right">
				<input type="submit" class="btn btn-success btn-login" id="btnLoginAuth" value = "LOGIN">				  
			</div>
			</form>
      </div>
    </div>

  </div>
</div> -->

<div class="modal fade" id="authenticateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="authenticateModal-body" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h1 class="modal-title fs-5" id="authenticateModal-body">Please enter OTP</h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form class="form-inline pi-search-form-wide" role="form" autocomplete="off" id="userLoginOTPForm" method = "POST" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/index.php">
			<div class="modal-body">
				<label>Enter Code:</label>
				<div class="pi-input-with-icon pi-input-inline">
					<div class="pi-input-icon"><i class="icon-mobile"></i></div>
					<input id="loginPin" name="pin" type="password" autocomplete="false" class="form-control pi-input-wide" placeholder="Enter Code">
					<input type="text" class='d-none' name="csrf-token" value="<?=$_SESSION['pagetoken']?>" />			
					<input type="text" class='d-none' value="userLoginOTP" name="Method" />
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary btn-login" id="btnLoginAuth" value = "LOGIN">	
			</div>
		</form>
    </div>
  </div>
</div>

	<?php #if($this->data('responseData')) echo "<script>$('#modal-body').html('".$this->data('responseData')."'); 
#$('#myModal').modal('show');});</script>";?>

<?php 
if ($this->data('responseData') && $this->data('responseData') != 105)
    echo "<script nonce=".$_SESSION['nonce'].">
        $(document).ready(function() {
            $('#modal-body').html('".$this->data('responseData')."');
            $('#myModal').modal('show');
        });
    </script>";
?>


	
<script src="<?php echo $GLOBALS['VIEW_PATH'];?>js/sha256.js"></script>
<script src="<?php echo $GLOBALS['VIEW_PATH'];?>js/enc-base64-min.js"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

$('#form').attr('autocomplete', 'off');

$(document).ready(function() {
<?php if($this->data('responseData')==105) {?>
	$('#authenticateModal-body').html("<?php echo ($this->data('responseMessage')) ? $this->data('responseMessage') : "Please enter OTP"; ?>");
	$('#authenticateModal').modal('show');
<?php } ?>

$('#authenticateModal').on('shown.bs.modal', function () {
    $('#loginPin').val("");
    $('#loginPin').focus();
})  
});


</script>
</body>

</html>
