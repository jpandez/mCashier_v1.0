<?php
/*
 * Created on Apr 14, 2012
 *
 * Redirect to proper index.php
 */
  //header( 'Location:/Controllers/ViewControllers/index.php') ;
?>
<script>
	//var newwin = window.open("Controllers/ViewControllers/index.php",null,"fullscreen=no,scrollbar=yes,toolbar=no,location=no,menubar=no,resizeable=yes");
	var newwin = window.open("Controllers/ViewControllers/index.php",null,"fullscreen=no,scrollbars=yes,toolbar=no,location=no,menubar=no,resizeable=yes");
	newwin.focus();
	this.focus();
	self.opener = this;
	self.close();
</script>

