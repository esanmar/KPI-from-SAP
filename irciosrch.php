<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
define("EW_DEFAULT_LOCALE", "es_ES", TRUE);
@setlocale(LC_ALL, EW_DEFAULT_LOCALE);
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "ircioinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$ircio_search = new circio_search();
$Page =& $ircio_search;

// Page init
$ircio_search->Page_Init();

// Page main
$ircio_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ircio_search = new ew_Page("ircio_search");

// page properties
ircio_search.PageID = "search"; // page ID
ircio_search.FormID = "firciosearch"; // form ID
var EW_PAGE_ID = ircio_search.PageID; // for backward compatibility

// extend page with validate function for search
ircio_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
ircio_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
ircio_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ircio_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $ircio->TableCaption() ?><br><br>
<a href="<?php echo $ircio->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$ircio_search->ShowMessage();
?>
<form name="firciosearch" id="firciosearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ircio_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="ircio">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->cabecera->FldCaption() ?></td>
		<td<?php echo $ircio->cabecera->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_cabecera" id="z_cabecera" onchange="ew_SrchOprChanged('z_cabecera')"><option value="="<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->cabecera->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->cabecera->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_cabecera" id="x_cabecera" title="<?php echo $ircio->cabecera->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $ircio->cabecera->EditValue ?>"<?php echo $ircio->cabecera->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_cabecera" name="btw1_cabecera">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_cabecera" name="btw1_cabecera">
<input type="text" name="y_cabecera" id="y_cabecera" title="<?php echo $ircio->cabecera->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $ircio->cabecera->EditValue2 ?>"<?php echo $ircio->cabecera->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->orden->FldCaption() ?></td>
		<td<?php echo $ircio->orden->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_orden" id="z_orden" onchange="ew_SrchOprChanged('z_orden')"><option value="="<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->orden->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->orden->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_orden" id="x_orden" title="<?php echo $ircio->orden->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->orden->EditValue ?>"<?php echo $ircio->orden->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_orden" name="btw0_orden"><label><input type="radio" name="v_orden" id="v_orden" value="AND"<?php if ($ircio->orden->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_orden" id="v_orden" value="OR"<?php if ($ircio->orden->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_orden" name="btw1_orden">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_orden" name="btw0_orden" ><select name="w_orden" id="w_orden"><option value="="<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->orden->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_orden" id="y_orden" title="<?php echo $ircio->orden->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->orden->EditValue2 ?>"<?php echo $ircio->orden->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->op->FldCaption() ?></td>
		<td<?php echo $ircio->op->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_op" id="z_op" onchange="ew_SrchOprChanged('z_op')"><option value="="<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->op->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->op->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->op->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->op->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_op" id="x_op" title="<?php echo $ircio->op->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->op->EditValue ?>"<?php echo $ircio->op->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_op" name="btw0_op"><label><input type="radio" name="v_op" id="v_op" value="AND"<?php if ($ircio->op->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_op" id="v_op" value="OR"<?php if ($ircio->op->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_op" name="btw1_op">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_op" name="btw0_op" ><select name="w_op" id="w_op"><option value="="<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->op->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->op->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->op->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_op" id="y_op" title="<?php echo $ircio->op->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->op->EditValue2 ?>"<?php echo $ircio->op->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->puesto->FldCaption() ?></td>
		<td<?php echo $ircio->puesto->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_puesto" id="z_puesto" onchange="ew_SrchOprChanged('z_puesto')"><option value="="<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->puesto->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_puesto" id="x_puesto" title="<?php echo $ircio->puesto->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->puesto->EditValue ?>"<?php echo $ircio->puesto->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_puesto" name="btw0_puesto"><label><input type="radio" name="v_puesto" id="v_puesto" value="AND"<?php if ($ircio->puesto->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_puesto" id="v_puesto" value="OR"<?php if ($ircio->puesto->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_puesto" name="btw1_puesto">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_puesto" name="btw0_puesto" ><select name="w_puesto" id="w_puesto"><option value="="<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->puesto->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_puesto" id="y_puesto" title="<?php echo $ircio->puesto->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->puesto->EditValue2 ?>"<?php echo $ircio->puesto->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->contrato->FldCaption() ?></td>
		<td<?php echo $ircio->contrato->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_contrato" id="z_contrato" onchange="ew_SrchOprChanged('z_contrato')"><option value="="<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->contrato->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_contrato" id="x_contrato" title="<?php echo $ircio->contrato->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->contrato->EditValue ?>"<?php echo $ircio->contrato->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_contrato" name="btw0_contrato"><label><input type="radio" name="v_contrato" id="v_contrato" value="AND"<?php if ($ircio->contrato->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_contrato" id="v_contrato" value="OR"<?php if ($ircio->contrato->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_contrato" name="btw1_contrato">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_contrato" name="btw0_contrato" ><select name="w_contrato" id="w_contrato"><option value="="<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->contrato->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_contrato" id="y_contrato" title="<?php echo $ircio->contrato->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->contrato->EditValue2 ?>"<?php echo $ircio->contrato->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->fechacrea->FldCaption() ?></td>
		<td<?php echo $ircio->fechacrea->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_fechacrea" id="z_fechacrea" onchange="ew_SrchOprChanged('z_fechacrea')"><option value="="<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->fechacrea->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_fechacrea" id="x_fechacrea" title="<?php echo $ircio->fechacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechacrea->EditValue ?>"<?php echo $ircio->fechacrea->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_fechacrea" name="btw0_fechacrea"><label><input type="radio" name="v_fechacrea" id="v_fechacrea" value="AND"<?php if ($ircio->fechacrea->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_fechacrea" id="v_fechacrea" value="OR"<?php if ($ircio->fechacrea->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_fechacrea" name="btw1_fechacrea">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_fechacrea" name="btw0_fechacrea" ><select name="w_fechacrea" id="w_fechacrea"><option value="="<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->fechacrea->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_fechacrea" id="y_fechacrea" title="<?php echo $ircio->fechacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechacrea->EditValue2 ?>"<?php echo $ircio->fechacrea->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->horacrea->FldCaption() ?></td>
		<td<?php echo $ircio->horacrea->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_horacrea" id="z_horacrea" onchange="ew_SrchOprChanged('z_horacrea')"><option value="="<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->horacrea->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_horacrea" id="x_horacrea" title="<?php echo $ircio->horacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horacrea->EditValue ?>"<?php echo $ircio->horacrea->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_horacrea" name="btw0_horacrea"><label><input type="radio" name="v_horacrea" id="v_horacrea" value="AND"<?php if ($ircio->horacrea->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_horacrea" id="v_horacrea" value="OR"<?php if ($ircio->horacrea->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_horacrea" name="btw1_horacrea">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_horacrea" name="btw0_horacrea" ><select name="w_horacrea" id="w_horacrea"><option value="="<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->horacrea->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_horacrea" id="y_horacrea" title="<?php echo $ircio->horacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horacrea->EditValue2 ?>"<?php echo $ircio->horacrea->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->fechafin->FldCaption() ?></td>
		<td<?php echo $ircio->fechafin->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_fechafin" id="z_fechafin" onchange="ew_SrchOprChanged('z_fechafin')"><option value="="<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->fechafin->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_fechafin" id="x_fechafin" title="<?php echo $ircio->fechafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechafin->EditValue ?>"<?php echo $ircio->fechafin->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_fechafin" name="btw0_fechafin"><label><input type="radio" name="v_fechafin" id="v_fechafin" value="AND"<?php if ($ircio->fechafin->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_fechafin" id="v_fechafin" value="OR"<?php if ($ircio->fechafin->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_fechafin" name="btw1_fechafin">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_fechafin" name="btw0_fechafin" ><select name="w_fechafin" id="w_fechafin"><option value="="<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->fechafin->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_fechafin" id="y_fechafin" title="<?php echo $ircio->fechafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechafin->EditValue2 ?>"<?php echo $ircio->fechafin->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->horafin->FldCaption() ?></td>
		<td<?php echo $ircio->horafin->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_horafin" id="z_horafin" onchange="ew_SrchOprChanged('z_horafin')"><option value="="<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->horafin->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_horafin" id="x_horafin" title="<?php echo $ircio->horafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horafin->EditValue ?>"<?php echo $ircio->horafin->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_horafin" name="btw0_horafin"><label><input type="radio" name="v_horafin" id="v_horafin" value="AND"<?php if ($ircio->horafin->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_horafin" id="v_horafin" value="OR"<?php if ($ircio->horafin->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_horafin" name="btw1_horafin">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_horafin" name="btw0_horafin" ><select name="w_horafin" id="w_horafin"><option value="="<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->horafin->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_horafin" id="y_horafin" title="<?php echo $ircio->horafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horafin->EditValue2 ?>"<?php echo $ircio->horafin->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->material->FldCaption() ?></td>
		<td<?php echo $ircio->material->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_material" id="z_material" onchange="ew_SrchOprChanged('z_material')"><option value="="<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->material->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->material->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($ircio->material->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $ircio->material->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_material" id="x_material" title="<?php echo $ircio->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->material->EditValue ?>"<?php echo $ircio->material->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" id="btw0_material" name="btw0_material"><label><input type="radio" name="v_material" id="v_material" value="AND"<?php if ($ircio->material->AdvancedSearch->SearchCondition <> "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("AND") ?></label>&nbsp;<label><input type="radio" name="v_material" id="v_material" value="OR"<?php if ($ircio->material->AdvancedSearch->SearchCondition == "OR") echo " checked=\"checked\"" ?>><?php echo $Language->Phrase("OR") ?></label>&nbsp;</span>
				<span class="ewSearchOpr" id="btw1_material" name="btw1_material">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="ewSearchOpr" id="btw0_material" name="btw0_material" ><select name="w_material" id="w_material"><option value="="<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($ircio->material->AdvancedSearch->SearchOperator2==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($ircio->material->AdvancedSearch->SearchOperator2==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($ircio->material->AdvancedSearch->SearchOperator2=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option></select></span>
				<span class="phpmaker" style="float: left;">
<input type="text" name="y_material" id="y_material" title="<?php echo $ircio->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->material->EditValue2 ?>"<?php echo $ircio->material->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_SrchOprChanged('z_cabecera');
ew_SrchOprChanged('z_orden');
ew_SrchOprChanged('z_op');
ew_SrchOprChanged('z_puesto');
ew_SrchOprChanged('z_contrato');
ew_SrchOprChanged('z_fechacrea');
ew_SrchOprChanged('z_horacrea');
ew_SrchOprChanged('z_fechafin');
ew_SrchOprChanged('z_horafin');
ew_SrchOprChanged('z_material');

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$ircio_search->Page_Terminate();
?>
<?php

//
// Page class
//
class circio_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'ircio';

	// Page object name
	var $PageObjName = 'ircio_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ircio;
		if ($ircio->UseTokenInUrl) $PageUrl .= "t=" . $ircio->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $ircio;
		if ($ircio->UseTokenInUrl) {
			if ($objForm)
				return ($ircio->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ircio->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function circio_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (ircio)
		$GLOBALS["ircio"] = new circio();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ircio', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $ircio;

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $ircio;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$ircio->CurrentAction = $objForm->GetValue("a_search");
			switch ($ircio->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $ircio->UrlParm($sSrchStr);
						$this->Page_Terminate("irciolist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$ircio->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $ircio;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $ircio->cabecera); // cabecera
	$this->BuildSearchUrl($sSrchUrl, $ircio->orden); // orden
	$this->BuildSearchUrl($sSrchUrl, $ircio->op); // op
	$this->BuildSearchUrl($sSrchUrl, $ircio->puesto); // puesto
	$this->BuildSearchUrl($sSrchUrl, $ircio->contrato); // contrato
	$this->BuildSearchUrl($sSrchUrl, $ircio->fechacrea); // fechacrea
	$this->BuildSearchUrl($sSrchUrl, $ircio->horacrea); // horacrea
	$this->BuildSearchUrl($sSrchUrl, $ircio->fechafin); // fechafin
	$this->BuildSearchUrl($sSrchUrl, $ircio->horafin); // horafin
	$this->BuildSearchUrl($sSrchUrl, $ircio->material); // material
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $ircio;

		// Load search values
		// cabecera

		$ircio->cabecera->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_cabecera"));
		$ircio->cabecera->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cabecera");
		$ircio->cabecera->AdvancedSearch->SearchCondition = $objForm->GetValue("v_cabecera");
		$ircio->cabecera->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_cabecera"));
		$ircio->cabecera->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_cabecera");

		// orden
		$ircio->orden->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_orden"));
		$ircio->orden->AdvancedSearch->SearchOperator = $objForm->GetValue("z_orden");
		$ircio->orden->AdvancedSearch->SearchCondition = $objForm->GetValue("v_orden");
		$ircio->orden->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_orden"));
		$ircio->orden->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_orden");

		// op
		$ircio->op->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_op"));
		$ircio->op->AdvancedSearch->SearchOperator = $objForm->GetValue("z_op");
		$ircio->op->AdvancedSearch->SearchCondition = $objForm->GetValue("v_op");
		$ircio->op->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_op"));
		$ircio->op->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_op");

		// puesto
		$ircio->puesto->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_puesto"));
		$ircio->puesto->AdvancedSearch->SearchOperator = $objForm->GetValue("z_puesto");
		$ircio->puesto->AdvancedSearch->SearchCondition = $objForm->GetValue("v_puesto");
		$ircio->puesto->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_puesto"));
		$ircio->puesto->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_puesto");

		// contrato
		$ircio->contrato->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_contrato"));
		$ircio->contrato->AdvancedSearch->SearchOperator = $objForm->GetValue("z_contrato");
		$ircio->contrato->AdvancedSearch->SearchCondition = $objForm->GetValue("v_contrato");
		$ircio->contrato->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_contrato"));
		$ircio->contrato->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_contrato");

		// fechacrea
		$ircio->fechacrea->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fechacrea"));
		$ircio->fechacrea->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchCondition = $objForm->GetValue("v_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_fechacrea"));
		$ircio->fechacrea->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_fechacrea");

		// horacrea
		$ircio->horacrea->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_horacrea"));
		$ircio->horacrea->AdvancedSearch->SearchOperator = $objForm->GetValue("z_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchCondition = $objForm->GetValue("v_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_horacrea"));
		$ircio->horacrea->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_horacrea");

		// fechafin
		$ircio->fechafin->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fechafin"));
		$ircio->fechafin->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchCondition = $objForm->GetValue("v_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_fechafin"));
		$ircio->fechafin->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_fechafin");

		// horafin
		$ircio->horafin->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_horafin"));
		$ircio->horafin->AdvancedSearch->SearchOperator = $objForm->GetValue("z_horafin");
		$ircio->horafin->AdvancedSearch->SearchCondition = $objForm->GetValue("v_horafin");
		$ircio->horafin->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_horafin"));
		$ircio->horafin->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_horafin");

		// material
		$ircio->material->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_material"));
		$ircio->material->AdvancedSearch->SearchOperator = $objForm->GetValue("z_material");
		$ircio->material->AdvancedSearch->SearchCondition = $objForm->GetValue("v_material");
		$ircio->material->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_material"));
		$ircio->material->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_material");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $ircio;

		// Initialize URLs
		// Call Row_Rendering event

		$ircio->Row_Rendering();

		// Common render codes for all row types
		// cabecera

		$ircio->cabecera->CellCssStyle = ""; $ircio->cabecera->CellCssClass = "";
		$ircio->cabecera->CellAttrs = array(); $ircio->cabecera->ViewAttrs = array(); $ircio->cabecera->EditAttrs = array();

		// orden
		$ircio->orden->CellCssStyle = ""; $ircio->orden->CellCssClass = "";
		$ircio->orden->CellAttrs = array(); $ircio->orden->ViewAttrs = array(); $ircio->orden->EditAttrs = array();

		// op
		$ircio->op->CellCssStyle = ""; $ircio->op->CellCssClass = "";
		$ircio->op->CellAttrs = array(); $ircio->op->ViewAttrs = array(); $ircio->op->EditAttrs = array();

		// puesto
		$ircio->puesto->CellCssStyle = ""; $ircio->puesto->CellCssClass = "";
		$ircio->puesto->CellAttrs = array(); $ircio->puesto->ViewAttrs = array(); $ircio->puesto->EditAttrs = array();

		// contrato
		$ircio->contrato->CellCssStyle = ""; $ircio->contrato->CellCssClass = "";
		$ircio->contrato->CellAttrs = array(); $ircio->contrato->ViewAttrs = array(); $ircio->contrato->EditAttrs = array();

		// fechacrea
		$ircio->fechacrea->CellCssStyle = ""; $ircio->fechacrea->CellCssClass = "";
		$ircio->fechacrea->CellAttrs = array(); $ircio->fechacrea->ViewAttrs = array(); $ircio->fechacrea->EditAttrs = array();

		// horacrea
		$ircio->horacrea->CellCssStyle = ""; $ircio->horacrea->CellCssClass = "";
		$ircio->horacrea->CellAttrs = array(); $ircio->horacrea->ViewAttrs = array(); $ircio->horacrea->EditAttrs = array();

		// fechafin
		$ircio->fechafin->CellCssStyle = ""; $ircio->fechafin->CellCssClass = "";
		$ircio->fechafin->CellAttrs = array(); $ircio->fechafin->ViewAttrs = array(); $ircio->fechafin->EditAttrs = array();

		// horafin
		$ircio->horafin->CellCssStyle = ""; $ircio->horafin->CellCssClass = "";
		$ircio->horafin->CellAttrs = array(); $ircio->horafin->ViewAttrs = array(); $ircio->horafin->EditAttrs = array();

		// material
		$ircio->material->CellCssStyle = ""; $ircio->material->CellCssClass = "";
		$ircio->material->CellAttrs = array(); $ircio->material->ViewAttrs = array(); $ircio->material->EditAttrs = array();
		if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View row

			// cabecera
			$ircio->cabecera->ViewValue = $ircio->cabecera->CurrentValue;
			$ircio->cabecera->CssStyle = "";
			$ircio->cabecera->CssClass = "";
			$ircio->cabecera->ViewCustomAttributes = "";

			// orden
			$ircio->orden->ViewValue = $ircio->orden->CurrentValue;
			$ircio->orden->CssStyle = "";
			$ircio->orden->CssClass = "";
			$ircio->orden->ViewCustomAttributes = "";

			// op
			$ircio->op->ViewValue = $ircio->op->CurrentValue;
			$ircio->op->CssStyle = "";
			$ircio->op->CssClass = "";
			$ircio->op->ViewCustomAttributes = "";

			// puesto
			$ircio->puesto->ViewValue = $ircio->puesto->CurrentValue;
			$ircio->puesto->CssStyle = "";
			$ircio->puesto->CssClass = "";
			$ircio->puesto->ViewCustomAttributes = "";

			// contrato
			$ircio->contrato->ViewValue = $ircio->contrato->CurrentValue;
			$ircio->contrato->CssStyle = "";
			$ircio->contrato->CssClass = "";
			$ircio->contrato->ViewCustomAttributes = "";

			// fechacrea
			$ircio->fechacrea->ViewValue = $ircio->fechacrea->CurrentValue;
			$ircio->fechacrea->CssStyle = "";
			$ircio->fechacrea->CssClass = "";
			$ircio->fechacrea->ViewCustomAttributes = "";

			// horacrea
			$ircio->horacrea->ViewValue = $ircio->horacrea->CurrentValue;
			$ircio->horacrea->CssStyle = "";
			$ircio->horacrea->CssClass = "";
			$ircio->horacrea->ViewCustomAttributes = "";

			// fechafin
			$ircio->fechafin->ViewValue = $ircio->fechafin->CurrentValue;
			$ircio->fechafin->CssStyle = "";
			$ircio->fechafin->CssClass = "";
			$ircio->fechafin->ViewCustomAttributes = "";

			// horafin
			$ircio->horafin->ViewValue = $ircio->horafin->CurrentValue;
			$ircio->horafin->CssStyle = "";
			$ircio->horafin->CssClass = "";
			$ircio->horafin->ViewCustomAttributes = "";

			// material
			$ircio->material->ViewValue = $ircio->material->CurrentValue;
			$ircio->material->CssStyle = "";
			$ircio->material->CssClass = "";
			$ircio->material->ViewCustomAttributes = "";

			// cabecera
			$ircio->cabecera->HrefValue = "";
			$ircio->cabecera->TooltipValue = "";

			// orden
			$ircio->orden->HrefValue = "";
			$ircio->orden->TooltipValue = "";

			// op
			$ircio->op->HrefValue = "";
			$ircio->op->TooltipValue = "";

			// puesto
			$ircio->puesto->HrefValue = "";
			$ircio->puesto->TooltipValue = "";

			// contrato
			$ircio->contrato->HrefValue = "";
			$ircio->contrato->TooltipValue = "";

			// fechacrea
			$ircio->fechacrea->HrefValue = "";
			$ircio->fechacrea->TooltipValue = "";

			// horacrea
			$ircio->horacrea->HrefValue = "";
			$ircio->horacrea->TooltipValue = "";

			// fechafin
			$ircio->fechafin->HrefValue = "";
			$ircio->fechafin->TooltipValue = "";

			// horafin
			$ircio->horafin->HrefValue = "";
			$ircio->horafin->TooltipValue = "";

			// material
			$ircio->material->HrefValue = "";
			$ircio->material->TooltipValue = "";
		} elseif ($ircio->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// cabecera
			$ircio->cabecera->EditCustomAttributes = "";
			$ircio->cabecera->EditValue = ew_HtmlEncode($ircio->cabecera->AdvancedSearch->SearchValue);
			$ircio->cabecera->EditCustomAttributes = "";
			$ircio->cabecera->EditValue2 = ew_HtmlEncode($ircio->cabecera->AdvancedSearch->SearchValue2);

			// orden
			$ircio->orden->EditCustomAttributes = "";
			$ircio->orden->EditValue = ew_HtmlEncode($ircio->orden->AdvancedSearch->SearchValue);
			$ircio->orden->EditCustomAttributes = "";
			$ircio->orden->EditValue2 = ew_HtmlEncode($ircio->orden->AdvancedSearch->SearchValue2);

			// op
			$ircio->op->EditCustomAttributes = "";
			$ircio->op->EditValue = ew_HtmlEncode($ircio->op->AdvancedSearch->SearchValue);
			$ircio->op->EditCustomAttributes = "";
			$ircio->op->EditValue2 = ew_HtmlEncode($ircio->op->AdvancedSearch->SearchValue2);

			// puesto
			$ircio->puesto->EditCustomAttributes = "";
			$ircio->puesto->EditValue = ew_HtmlEncode($ircio->puesto->AdvancedSearch->SearchValue);
			$ircio->puesto->EditCustomAttributes = "";
			$ircio->puesto->EditValue2 = ew_HtmlEncode($ircio->puesto->AdvancedSearch->SearchValue2);

			// contrato
			$ircio->contrato->EditCustomAttributes = "";
			$ircio->contrato->EditValue = ew_HtmlEncode($ircio->contrato->AdvancedSearch->SearchValue);
			$ircio->contrato->EditCustomAttributes = "";
			$ircio->contrato->EditValue2 = ew_HtmlEncode($ircio->contrato->AdvancedSearch->SearchValue2);

			// fechacrea
			$ircio->fechacrea->EditCustomAttributes = "";
			$ircio->fechacrea->EditValue = ew_HtmlEncode($ircio->fechacrea->AdvancedSearch->SearchValue);
			$ircio->fechacrea->EditCustomAttributes = "";
			$ircio->fechacrea->EditValue2 = ew_HtmlEncode($ircio->fechacrea->AdvancedSearch->SearchValue2);

			// horacrea
			$ircio->horacrea->EditCustomAttributes = "";
			$ircio->horacrea->EditValue = ew_HtmlEncode($ircio->horacrea->AdvancedSearch->SearchValue);
			$ircio->horacrea->EditCustomAttributes = "";
			$ircio->horacrea->EditValue2 = ew_HtmlEncode($ircio->horacrea->AdvancedSearch->SearchValue2);

			// fechafin
			$ircio->fechafin->EditCustomAttributes = "";
			$ircio->fechafin->EditValue = ew_HtmlEncode($ircio->fechafin->AdvancedSearch->SearchValue);
			$ircio->fechafin->EditCustomAttributes = "";
			$ircio->fechafin->EditValue2 = ew_HtmlEncode($ircio->fechafin->AdvancedSearch->SearchValue2);

			// horafin
			$ircio->horafin->EditCustomAttributes = "";
			$ircio->horafin->EditValue = ew_HtmlEncode($ircio->horafin->AdvancedSearch->SearchValue);
			$ircio->horafin->EditCustomAttributes = "";
			$ircio->horafin->EditValue2 = ew_HtmlEncode($ircio->horafin->AdvancedSearch->SearchValue2);

			// material
			$ircio->material->EditCustomAttributes = "";
			$ircio->material->EditValue = ew_HtmlEncode($ircio->material->AdvancedSearch->SearchValue);
			$ircio->material->EditCustomAttributes = "";
			$ircio->material->EditValue2 = ew_HtmlEncode($ircio->material->AdvancedSearch->SearchValue2);
		}

		// Call Row Rendered event
		if ($ircio->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$ircio->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $ircio;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $ircio;
		$ircio->cabecera->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_cabecera");
		$ircio->cabecera->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_cabecera");
		$ircio->cabecera->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_cabecera");
		$ircio->orden->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_orden");
		$ircio->orden->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_orden");
		$ircio->orden->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_orden");
		$ircio->orden->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_orden");
		$ircio->orden->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_orden");
		$ircio->op->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_op");
		$ircio->op->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_op");
		$ircio->op->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_op");
		$ircio->op->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_op");
		$ircio->op->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_op");
		$ircio->puesto->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_puesto");
		$ircio->puesto->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_puesto");
		$ircio->puesto->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_puesto");
		$ircio->puesto->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_puesto");
		$ircio->puesto->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_puesto");
		$ircio->contrato->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_contrato");
		$ircio->contrato->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_contrato");
		$ircio->contrato->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_contrato");
		$ircio->contrato->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_contrato");
		$ircio->contrato->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_contrato");
		$ircio->fechacrea->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_fechacrea");
		$ircio->horacrea->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_horacrea");
		$ircio->fechafin->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_fechafin");
		$ircio->horafin->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_horafin");
		$ircio->horafin->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_horafin");
		$ircio->horafin->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_horafin");
		$ircio->horafin->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_horafin");
		$ircio->horafin->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_horafin");
		$ircio->material->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_material");
		$ircio->material->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_material");
		$ircio->material->AdvancedSearch->SearchCondition = $ircio->getAdvancedSearch("v_material");
		$ircio->material->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_material");
		$ircio->material->AdvancedSearch->SearchOperator2 = $ircio->getAdvancedSearch("w_material");
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
