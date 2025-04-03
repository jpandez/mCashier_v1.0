<?php require_once("views.config.properties.php"); ?>
<style nonce="<?php echo $_SESSION['nonce'];?>">
	._formsView{
		display:none;
	}
	._GlobalSearchContent{
		width:100%;border:1px solid lightgray;text-align:center;
	}
</style>
<div id="formsView" class="_formsView">
<table border="0" cellspacing="5" class="tablet">
	<tr>
		
		<td width="100px">
			<?php echo _("Forms"); ?>:
		</td>
		<td width="200px">
			<select id="docType" class="w-100">
				<option>Select Form</option>
				<!--<option value="FATCA">FATCA</option>
				<option value="W-8Ben">W-8Ben</option>
				<option value="W8-Ben EN">W8-Ben EN</option>
				<option value="W9">W9</option>-->
				<option value="Risk Matric">Risk Matrix</option>
				<option value="Check list">Check list</option>
			</select>
		</td>
		<td>
			<div id="FATCA">
				Windows:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/FATCA Test v1.doc" target="_blank" class="text-primary">FATCA Test v1.doc</a>
				|
				Mac OS X:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/__MACOSX/._FATCA Test v1.doc" target="_blank" class="text-primary">._FATCA Test v1.doc</a>
			</div>
			<div id="W-8Ben">
				Windows:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/W-8BEN - Confirm non US status - for Individuals.pdf" target="_blank" class="text-primary">W-8BEN - Confirm non US status - for Individuals.pdf</a>
				|
				Mac OS X:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/__MACOSX/._W-8BEN - Confirm non US status - for Individuals.pdf" target="_blank" class="text-primary">._W-8BEN - Confirm non US status - for Individuals.pdf</a>
			</div>
			<div id="W8-Ben-EN">
				Windows:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/W8 BEN-E -Confirm non US status - for Entities.pdf" target="_blank" class="text-primary">W8 BEN-E -Confirm non US status - for Entities.pdf</a>
				|
				Mac OS X:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/__MACOSX/._W8 BEN-E -Confirm non US status - for Entities.pdf" target="_blank" class="text-primary">._W8 BEN-E -Confirm non US status - for Entities.pdf</a>
			</div>
			<div id="W9">
				Windows:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/W9 form - To confirm US status.pdf" target="_blank" class="text-primary">W9 form - To confirm US status.pdf</a>
				|
				Mac OS X:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/__MACOSX/._W9 form - To confirm US status.pdf" target="_blank" class="text-primary">._W9 form - To confirm US status.pdf</a>
			</div>
			<div id="Risk-Matric">
				Windows:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/download.php?file=Risk Matrix for Merchants (Final Version Oct 2014) (5).xlsx" class="text-primary">
Risk Matrix for Merchants (Final Version Oct 2014) (5).xlsx</a>
				|
				Mac OS X:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/download.php?file=Risk Matrix for Merchants (Final Version Oct 2014) (5).xlsx" class="text-primary">
._Risk Matrix for Merchants (Final Version Oct 2014) (5).xlsx</a>
			</div>
			<div id="CheckList">
				Windows/Mac OS:<a href="<?php echo $GLOBALS['ROOT']; ?>Forms/Check list-NBAD-ETISALAT final.docx" target="_blank" class="text-primary">Check list-NBAD-ETISALAT final.docx</a>
			</div>
		</td>
	</tr>
</table>
</div>
<div id="GlobalSearchContent" class="_GlobalSearchContent"></div>

<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/functions.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/ajaxmethods.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['VIEW_PATH'];?>js/registerupdate.js" nonce="<?php echo $_SESSION['nonce'];?>"></script>
<script nonce="<?php echo $_SESSION['nonce'];?>">
	
$("#FATCA").hide();
$("#W-8Ben").hide();
$("#W8-Ben-EN").hide();
$("#W9").hide();
$("#Risk-Matric").hide();
$("#CheckList").hide();

	$("#docType").change(function(){

		$("#FATCA").hide();
		$("#W-8Ben").hide();
		$("#W8-Ben-EN").hide();
		$("#W9").hide();
		$("#Risk-Matric").hide();
		$("#CheckList").hide();
		
		if($("#docType").val() == 'FATCA'){
			$("#FATCA").show();
		}
		if($("#docType").val() == 'W-8Ben'){
			$("#W-8Ben").show();
		}
		if($("#docType").val() == 'W8-Ben EN'){
			$("#W8-Ben-EN").show();
		}
		if($("#docType").val() == 'W9'){
			$("#W9").show();
		}
		if($("#docType").val() == 'Risk Matric'){
			$("#Risk-Matric").show();
		}
		if($("#docType").val() == 'Check list'){
			$("#CheckList").show();
		}
		
    	
    });
	
	
	
	$("#formsView").fadeIn(700);
</script>