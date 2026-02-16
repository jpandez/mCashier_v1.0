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

    </div>

	<!-- Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header position-relative">
			<h1 class="modal-title fs-5 mx-auto">Server Message</h1>
			<button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<span class="text-danger" id="responseData"></span>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
</div>
	
<div class="modal fade" id="authenticateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="authenticateModal-body" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header position-relative">
			<h1 class="modal-title fs-5 mx-auto">Authentication</h1>
			<button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form class="form-inline pi-search-form-wide" role="form" autocomplete="off" id="userLoginOTPForm" method = "POST" action="<?php echo $GLOBALS['CONTROLLER_PATH']; ?>ViewControllers/index.php">
		<div class="modal-body text-center">
			<h6 class="mb-3">Please enter <b>One-Time Password</b> </h6>
			<div class="d-flex justify-content-center gap-2">
				<input type="password" maxlength="1" id="loginPin" class="form-control otp-input text-center" />
				<input type="password" maxlength="1" class="form-control otp-input text-center" />
				<input type="password" maxlength="1" class="form-control otp-input text-center" />
				<input type="password" maxlength="1" class="form-control otp-input text-center" />
				<input type="password" maxlength="1" class="form-control otp-input text-center" />
				<input type="password" maxlength="1" class="form-control otp-input text-center" />
			</div>

			<input type="hidden" name="pin" id="combinedOtp" />

			<input type="text" class="d-none" name="csrf-token" value="<?=$_SESSION['pagetoken']?>" />
			<input type="text" class="d-none" value="userLoginOTP" name="Method" />
			<span class="text-danger" id="responseDataOTP"></span>
		</div>
		<div class="modal-footer justify-content-center">
			<button type="submit" class="btn btn-primary btn-login" id="btnLoginAuth">Submit</button>
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
		</div>
		</form>
    </div>
  </div>
</div>

<style nonce="<?php echo $_SESSION['nonce'];?>">
	.otp-input {
		width: 45px;
		height: 50px;
		font-size: 22px;
		font-weight: bold;
	}

	.otp-input.border-danger:focus {
		border-color: #dc3545 !important;
		box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
	}
</style>

<?php 
	if ($this->data('responseData') && $this->data('responseData') != 105)
		echo "<script nonce=".$_SESSION['nonce'].">
			$(document).ready(function() {
				$('#responseData').html('".$this->data('responseData')."');
				$('#myModal').modal('show');
			});
		</script>";

	if ($this->data('responseData') && $this->data('responseData') == 105)
		echo "<script nonce=".$_SESSION['nonce'].">
			$(document).ready(function() {
				$('#responseDataOTP').html('".$this->data('responseMessage')."');
				$('#authenticateModal').modal('show');
				$('#authenticateModal').on('shown.bs.modal', function () {
					$('#loginPin').focus();
				})
			});
		</script>";

	if ($this->data('responseMessage') != ""){
		echo "<script nonce=".$_SESSION['nonce'].">
			$(document).ready(function() {
				$('.otp-input').addClass('border-danger');
			});
		</script>";
	}
?>

<script src="<?php echo $GLOBALS['VIEW_PATH'];?>js/sha256.js"></script>
<script src="<?php echo $GLOBALS['VIEW_PATH'];?>js/enc-base64-min.js"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">

	$('#form').attr('autocomplete', 'off');

	$('.otp-input').on('input', function () {
        var value = $(this).val();

        $(this).val(value.replace(/[^0-9]/g, ''));

        if (value.length === 1) {
            $(this).next('.otp-input').focus();
        }

        updateOtp();
    });

    $('.otp-input').on('keydown', function (e) {
        if (e.key === "Backspace" && $(this).val() === "") {
            $(this).prev('.otp-input').focus();
        }
    });

    function updateOtp() {
        var otp = '';
        $('.otp-input').each(function () {
            otp += $(this).val();
        });
        $('#combinedOtp').val(otp);
		$('.otp-input').removeClass('border-danger');
		$('#responseDataOTP').text('');
    }

	$('.otp-input').on('paste', function (e) {
		e.preventDefault();

		var pasteData = (e.originalEvent.clipboardData || window.clipboardData).getData('text');
		pasteData = pasteData.replace(/[^0-9]/g, '');

		if (!pasteData) return;

		var inputs = $('.otp-input');

		for (var i = 0; i < inputs.length; i++) {
			$(inputs[i]).val(pasteData[i] || '');
		}

		updateOtp();

		var lastIndex = Math.min(pasteData.length, inputs.length) - 1;
		if (lastIndex >= 0) {
			$(inputs[lastIndex]).focus();
		}
	});

	$('#userLoginOTPForm').on('submit', function (e) {
		var otp = $('#combinedOtp').val();
		var isValid = true;

		if (!otp || otp.length !== 6) {
			isValid = false;
		}

		if (!isValid) {
			e.preventDefault();

			$('.otp-input').addClass('border-danger');

			$('#responseDataOTP').text('Please enter complete 6-digit OTP');
			$('#loginPin').focus();
			return false;
		}

		$('.otp-input').removeClass('border-danger');
	});

	$('.otp-input').on('input', function () {
		var value = $(this).val();
		$(this).val(value.replace(/[^0-9]/g, ''));

		$('.otp-input').removeClass('border-danger');
		$('#responseDataOTP').text('');

		if (value.length === 1) {
			$(this).next('.otp-input').focus();
		}

		updateOtp();
	});
</script>
</body>

</html>
