<?php $currentUser = $this->data("currentUser"); ?>
<?php $responseMessage = $this->data("responseMessage"); ?>
<?php $pageTitle = $this->data("pageTitle"); ?>

<?php require_once("views.config.properties.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="<?php echo $_SESSION['pagetoken']; ?>">
    <title>mCashier v1.0</title>
	
	<!-- <link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrapPILLS/css/bootstrap.css" rel="stylesheet" /> -->
	<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/bootstrap5.2.3/css/bootstrap.min.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/all.min.css" rel="stylesheet" />
    <link class="include" rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/jquery.jqplot.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/jquery.jqplot.css" />
   	<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <!--<script class="include" type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/jquery.min.js"></script>-->
	<!-- jqplot end -->
    <link rel="icon" type="image/ico" href="<?php echo $GLOBALS['VIEW_PATH'];?>images/etisalat.ico" />
    <link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/reset.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/datatables.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/buttons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $GLOBALS['VIEW_PATH'];?>css/errors.css" rel="stylesheet" type="text/css" />
	
	<!-- <link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" /> -->
	<link type="text/css" href="<?php echo $GLOBALS['VIEW_PATH'];?>css/smoothness/jquery-ui.css" rel="stylesheet" />
	<!-- <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrapPILLS/js/bootstrap.js"></script> -->
	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrap/bootstrap5.2.3/js/bootstrap.bundle.min.js"></script>

	<style type = "text/css" nonce="<?php echo $_SESSION['nonce'];?>">
    #loading-container {position: absolute; top:50%; left:50%;}
    #loading-content {width:800px; text-align:center; margin-left: -400px; height:50px; margin-top:-25px; line-height: 50px;}
    #loading-content {font-family: "Helvetica", "Arial", sans-serif; font-size: 18px; color: black; text-shadow: 0px 1px 0px white; }
    #loading-graphic {margin-right: 0.2em; margin-bottom:-2px;}
    #loading {background-color: #eeeeee; height:100%; width:100%; overflow:hidden; position: absolute; left: 0; top: 0; z-index: 99999;}
	.dropdown-item{
		font-size: 12px;
		right: 20px;
	}
	</style>
	
   	<!-- <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-1.7.1.min.js"></script> -->
	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.3.7.1.min.js"></script>
	<!-- <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-ui-1.8.18.custom.min.js"></script> -->
	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery-ui.js"></script>

	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.datatables.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.visualize.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/notes.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/custom.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.form-validation-and-hints.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.selectskin.js"></script>
    <style type="text/css" title="currentStyle" nonce="<?php echo $_SESSION['nonce'];?>">
		@import "<?php echo $GLOBALS['VIEW_PATH'];?>media/css/demo_page.css";
		@import "<?php echo $GLOBALS['VIEW_PATH'];?>media/css/demo_table.css";
		@import "<?php echo $GLOBALS['VIEW_PATH'];?>media/css/demo_table_jui.css";
	</style>
	<script type="text/javascript" language="javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">
		$(document).ready(function() {
			$('#transaction').dataTable();
			var bootstrapButton = $.fn.button.noConflict();
			$.fn.bootstrapBtn = bootstrapButton 
		} );
	</script>
	<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">
		$(document).ready(function() {
			oTable = $('#trans').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "two_button"
			});
		} );
		// Prevent the backspace key from navigating back.
		$(document).unbind('keydown').bind('keydown', function (event) {
		    var doPrevent = false;
		    if (event.keyCode === 8) {
		        var d = event.srcElement || event.target;
		        if ((d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'TEXT') 
		             || d.tagName.toUpperCase() === 'TEXTAREA' || (d.tagName.toUpperCase() === 'INPUT' && d.type.toUpperCase() === 'PASSWORD')) {
		            doPrevent = d.readOnly || d.disabled;
		        }
		        else {
		            doPrevent = true;
		        }
		    }
		    if (doPrevent) {
		        event.preventDefault();
		    }
		});
	</script>
	<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">
		window.sessionInterval = 30;
		
	</script>
	<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/checksession.js"></script>
	<script type="text/javascript" charset="utf-8" nonce="<?php echo $_SESSION['nonce'];?>">
	   var basePath = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/checkUser.php";
	   var indexPath = "<?php echo $GLOBALS['BASE_URL'];?>";
	   $(document).ready(function() {
	    $('#transaction').dataTable();
	   } );
	</script>

	<!-- <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>bootstrapPILLS/js/bootstrap.js"></script> -->
</head>
<body class="overflow-hidden">
<div id="loading">
    <script type = "text/javascript" nonce="<?php echo $_SESSION['nonce'];?>"> 
        document.write("<div id='loading-container'><p id='loading-content'>" +
                       "<img id='loading-graphic' width='16' height='16' src='<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader-big-000000.gif' /> " +
                       "Loading...</p></div>");
    </script> 
</div>
<!-- Start Container -->

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/index.php">
      <strong>
        <span class="eti-text-gray">m</span><span class="eti-text-green">Cashier</span>
      </strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item <?php if($_SESSION["ISFIRSTLOGON"] != 1){ echo ($this->getRolesConfig('SUBSCRIBER_MANAGEMENT')) ? '' : 'd-none'; }else{ echo ('d-none'); } ?>">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'user.subscriber.php'): ?> text-light active<?php endif; ?>" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.subscriber.php"><?php echo _("Subscribers"); ?></a>
        </li>
        <li class="nav-item <?php if($_SESSION["ISFIRSTLOGON"] != 1){ echo ($this->getRolesConfig('PENDINGS')) ? '' : 'd-none'; }else{ echo ('d-none'); } ?>">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'user.pendings.php'): ?> text-light active<?php endif; ?>" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.pendings.php"><?php echo _("Approvals"); ?></a>
        </li>
        <li class="nav-item <?php echo ($this->getRolesConfig('WEB_USER_MANAGEMENT')) ? '' : 'd-none'; ?>">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'user.management.php'): ?>text-light active<?php endif; ?>" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.management.php"><?php echo _("Web Users"); ?></a>
        </li>
        <li class="nav-item <?php if($_SESSION["ISFIRSTLOGON"] != 1){ echo ($this->getRolesConfig('REPORTS')) ? '' : 'd-none'; }else{ echo ('d-none'); } ?>">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'user.reports.php'): ?>text-light active<?php endif; ?>" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.reports.php"><?php echo _("Reports"); ?></a>
        </li>
        <li class="nav-item <?php if($_SESSION["ISFIRSTLOGON"] != 1){ echo ($this->getRolesConfig('SETTINGS')) ? '' : 'd-none'; }else{ echo ('d-none'); } ?>">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'user.systemsettings.php'): ?>text-light active<?php endif; ?>" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.systemsettings.php"><?php echo _("Audit Trails"); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'user.knowledgecenter.php'): ?>text-light active<?php endif; ?>" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.knowledgecenter.php"><?php echo _("Knowledge Center"); ?></a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo _("Welcome Back"); ?> <?php echo $currentUser; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item"><?php echo _("Last Login"); ?>: <?php echo date_format($_SESSION["LASTLOGIN"], 'M/d/Y h:i A'); ?></a></li>
            <li><a class="dropdown-item"><?php echo _("Profile"); ?>: <?php echo $_SESSION["currentUserLevel"]; ?></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item">Language:</a></li>
            <li><a class="dropdown-item" href="<?php echo $GLOBALS["CONTROLLER_PATH"]?>/ViewControllers/lang.php?lang=en&url=<?php echo basename($_SERVER['PHP_SELF']);?>">English</a></li>
            <!-- Uncomment for Arabic language option -->
            <!--<li><a class="dropdown-item" href="<?php echo $GLOBALS["CONTROLLER_PATH"]?>/ViewControllers/lang.php?lang=ar&url=<?php echo basename($_SERVER['PHP_SELF']);?>">Arabic</a></li>-->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo $GLOBALS["CONTROLLER_PATH"]?>/ViewControllers/user.management.php?Method=1">Change Password</a></li>
            <li><a class="dropdown-item" href="<?php echo $GLOBALS["CONTROLLER_PATH"]?>/ViewControllers/logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class = "content-container">
<?php $this->loadContent('main'); ?>
</div>
<div class = "content-footer">
<strong>
<div class = "pull-left links">
	<?php if ($this->getRolesConfig('SUBSCRIBER_MANAGEMENT') && $_SESSION["ISFIRSTLOGON"] == 0) { ?>
		<a class = "eti-text-green text-decoration-none" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.subscriber.php"><?php echo _("Subscribers"); ?></a> <span class = "eti-text-gray">| </span>
	<?php } ?>
	<?php if ($this->getRolesConfig('PENDINGS') && $_SESSION["ISFIRSTLOGON"] == 0) { ?>
		<a class = "eti-text-green text-decoration-none" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.pendings.php"><?php echo _("Pendings"); ?></a> <span class = "eti-text-gray">| </span>
	<?php } ?>
	<?php if ($this->getRolesConfig('WEB_USER_MANAGEMENT') && $_SESSION["ISFIRSTLOGON"] == 0) { ?>
		<a class = "eti-text-green text-decoration-none" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.management.php"><?php echo _("Web Users"); ?></a> <span class = "eti-text-gray">| </span>
	<?php } ?>
	<?php if ($this->getRolesConfig('REPORTS') && $_SESSION["ISFIRSTLOGON"] == 0) { ?>
		<a class = "eti-text-green text-decoration-none" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.reports.php"><?php echo _("Reports"); ?></a> <span class = "eti-text-gray">| </span>
	<?php } ?>
	<?php if ($this->getRolesConfig('SETTINGS') && $_SESSION["ISFIRSTLOGON"] == 0) { ?>
		<a class = "eti-text-green text-decoration-none" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.systemsettings.php"><?php echo _("Settings"); ?></a> <span class = "eti-text-gray">| </span>
	<?php } ?>
		<a class = "eti-text-green text-decoration-none" href="<?php echo $GLOBALS['CONTROLLER_PATH'];?>ViewControllers/user.knowledgecenter.php"><?php echo _("Knowledge Center"); ?></a>
	<br class="clear" />
</div>

<div class = "text-end copyright eti-text-gray">&copy; Powered by Etisalat.</div>
</strong>
</div>
<?php if($this->data('responseData')) echo '<script'. $_SESSION['nonce'].'>$("<p>' . $this->data('responseData') . '</p>").dialog({draggable: false,resizable: false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } }}); </script>' ;?>

<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">   
	<?php if($responseMessage !=null):?>
		$(document).ready(function(){
			$("<p><?php echo $responseMessage?></p>").dialog({resizable:false,modal:true, buttons: { "Ok": function() { $(this).dialog("close"); } } });
		});
	<?php endif;?>			
</script>
<!-- LOADING -->
<script nonce="<?php echo $_SESSION['nonce'];?>">
	// $(window).load(function(){
	//     $("#loading").fadeOut(function(){
	//         $(this).remove();
	//         $('body').removeAttr('style');
	//     });
	// });    
	$(document).ready(function() {
		$("#loading").fadeOut(function() {
			$(this).remove();
			$('body').removeAttr('style');
		});
	});

</script>
<!-- END LOADING -->
<!-- Don't touch this! -->
<!-- <script class="include" type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/jquery.jqplot.min.js"></script> -->
<!--<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/shCore.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/shBrushJScript.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/shBrushXml.min.js"></script>-->
<!-- End Don't touch this! -->
<!-- Additional plugins go here -->
<!-- <script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.logAxisRenderer.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.enhancedLegendRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.cursor.min.js"></script> 
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>  
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>jqplot/plugins/jqplot.pieRenderer.min.js"></script> -->
<!-- End additional plugins -->
<script type="text/javascript" nonce="<?php echo $_SESSION['nonce'];?>">
 $("#tabs ul li a").click(function(){
  var url = $(this).attr('url');
  url = url + "?t=" + window.pagetoken;
  var div = $(this).attr('href');
  $($(this).attr('href')).load(url);
  /* if( $(div).is(':empty') ){
	$($(this).attr('href')).load(url);
  } */
  
 });
 
$("#navbarNav ul li a").click(function(){
	var url_href = $(this).attr('href');
	if(url_href !== undefined){
		if(url_href.indexOf('?') === -1){
			url_href = url_href + "?t=" + window.pagetoken;
		}else{
			url_href = url_href + "&t=" + window.pagetoken;
		}
		
		$(this).attr('href',url_href);
	}
	
	//alert(url_href);
	
});

<?php //$_SESSION['pagetoken'] = uniqid(mt_rand(), true); ?>
window.pagetoken = "<?php echo $_SESSION['pagetoken']; ?>";

/* var tokenPath = "<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php";
setInterval(function(){
	$.ajax({url:tokenPath,
			type:"POST",
			complete:function(res,status){
				window.pagetoken = res.responseText;
			}
	});

}, 30000); */


// $(document).ready(function() { 
//     $.blockUI({css: {border: 'none', padding: '10px'}, message: '<h3><img src="<?php echo $GLOBALS['VIEW_PATH'];?>images/ajax-loader.gif" height = "120" /> Just a moment...</h3>' });
// 	setTimeout($.unblockUI, 1000);
// 	}); 

/*setTimeout(function(){
	$.ajax({url:"<?php echo $GLOBALS['CONTROLLER_PATH'];?>BusinessControllers/token.php",
			type:"POST",
			complete:function(res,status){
				window.parent.pagetoken = res.responseText;
				window.pagetoken = res.responseText;
				setTimeout($.unblockUI, 1000);
			}
	});
}, 3000);*/
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/jquery.blockUI.js" ></script>
</body>
</html>