<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
define("EW_DEFAULT_LOCALE", "es_ES", TRUE);
@setlocale(LC_ALL, EW_DEFAULT_LOCALE);
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "contadoresinfo.php" ?>
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
$contadores_search = new ccontadores_search();
$Page =& $contadores_search;

// Page init
$contadores_search->Page_Init();

// Page main
$contadores_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contadores_search = new ew_Page("contadores_search");

// page properties
contadores_search.PageID = "search"; // page ID
contadores_search.FormID = "fcontadoressearch"; // form ID
var EW_PAGE_ID = contadores_search.PageID; // for backward compatibility

// extend page with validate function for search
contadores_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_op"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->op->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_objetivo"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->objetivo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_op2"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->op2->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->orden->FldErrMsg()) ?>");

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
contadores_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contadores_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contadores_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contadores->TableCaption() ?><br><br>
<a href="<?php echo $contadores->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$contadores_search->ShowMessage();
?>
<form name="fcontadoressearch" id="fcontadoressearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return contadores_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="contadores">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->id->FldCaption() ?></td>
		<td<?php echo $contadores->id->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_id" id="z_id" onchange="ew_SrchOprChanged('z_id')"><option value="="<?php echo ($contadores->id->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->id->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->id->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->id->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->id->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->id->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($contadores->id->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $contadores->id->FldTitle() ?>" value="<?php echo $contadores->id->EditValue ?>"<?php echo $contadores->id->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_id" name="btw1_id">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_id" name="btw1_id">
<input type="text" name="y_id" id="y_id" title="<?php echo $contadores->id->FldTitle() ?>" value="<?php echo $contadores->id->EditValue2 ?>"<?php echo $contadores->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->op->FldCaption() ?></td>
		<td<?php echo $contadores->op->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_op" id="z_op" onchange="ew_SrchOprChanged('z_op')"><option value="="<?php echo ($contadores->op->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->op->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->op->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->op->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->op->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->op->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($contadores->op->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->op->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_op" id="x_op" title="<?php echo $contadores->op->FldTitle() ?>" size="30" value="<?php echo $contadores->op->EditValue ?>"<?php echo $contadores->op->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_op" name="btw1_op">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_op" name="btw1_op">
<input type="text" name="y_op" id="y_op" title="<?php echo $contadores->op->FldTitle() ?>" size="30" value="<?php echo $contadores->op->EditValue2 ?>"<?php echo $contadores->op->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->zona->FldCaption() ?></td>
		<td<?php echo $contadores->zona->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_zona" id="z_zona" onchange="ew_SrchOprChanged('z_zona')"><option value="="<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->zona->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($contadores->zona->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->zona->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_zona" id="x_zona" title="<?php echo $contadores->zona->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->zona->EditValue ?>"<?php echo $contadores->zona->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_zona" name="btw1_zona">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_zona" name="btw1_zona">
<input type="text" name="y_zona" id="y_zona" title="<?php echo $contadores->zona->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->zona->EditValue2 ?>"<?php echo $contadores->zona->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->descripcion->FldCaption() ?></td>
		<td<?php echo $contadores->descripcion->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_descripcion" id="z_descripcion" onchange="ew_SrchOprChanged('z_descripcion')"><option value="="<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($contadores->descripcion->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->descripcion->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_descripcion" id="x_descripcion" title="<?php echo $contadores->descripcion->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $contadores->descripcion->EditValue ?>"<?php echo $contadores->descripcion->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_descripcion" name="btw1_descripcion">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_descripcion" name="btw1_descripcion">
<input type="text" name="y_descripcion" id="y_descripcion" title="<?php echo $contadores->descripcion->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $contadores->descripcion->EditValue2 ?>"<?php echo $contadores->descripcion->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->programa->FldCaption() ?></td>
		<td<?php echo $contadores->programa->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_programa" id="z_programa" onchange="ew_SrchOprChanged('z_programa')"><option value="="<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->programa->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($contadores->programa->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->programa->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_programa" id="x_programa" title="<?php echo $contadores->programa->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->programa->EditValue ?>"<?php echo $contadores->programa->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_programa" name="btw1_programa">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_programa" name="btw1_programa">
<input type="text" name="y_programa" id="y_programa" title="<?php echo $contadores->programa->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->programa->EditValue2 ?>"<?php echo $contadores->programa->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->diahasta->FldCaption() ?></td>
		<td<?php echo $contadores->diahasta->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_diahasta" id="z_diahasta" onchange="ew_SrchOprChanged('z_diahasta')"><option value="="<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($contadores->diahasta->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->diahasta->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_diahasta" name="x_diahasta" title="<?php echo $contadores->diahasta->FldTitle() ?>"<?php echo $contadores->diahasta->EditAttributes() ?>>
<?php
if (is_array($contadores->diahasta->EditValue)) {
	$arwrk = $contadores->diahasta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contadores->diahasta->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_diahasta" name="btw1_diahasta">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_diahasta" name="btw1_diahasta">
<select id="y_diahasta" name="y_diahasta" title="<?php echo $contadores->diahasta->FldTitle() ?>"<?php echo $contadores->diahasta->EditAttributes() ?>>
<?php
if (is_array($contadores->diahasta->EditValue2)) {
	$arwrk = $contadores->diahasta->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contadores->diahasta->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->objetivo->FldCaption() ?></td>
		<td<?php echo $contadores->objetivo->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_objetivo" id="z_objetivo" value="="></span></td>
		<td<?php echo $contadores->objetivo->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_objetivo" id="x_objetivo" title="<?php echo $contadores->objetivo->FldTitle() ?>" size="30" value="<?php echo $contadores->objetivo->EditValue ?>"<?php echo $contadores->objetivo->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->op2->FldCaption() ?></td>
		<td<?php echo $contadores->op2->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_op2" id="z_op2" onchange="ew_SrchOprChanged('z_op2')"><option value="="<?php echo ($contadores->op2->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->op2->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->op2->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->op2->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->op2->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->op2->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($contadores->op2->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->op2->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_op2" id="x_op2" title="<?php echo $contadores->op2->FldTitle() ?>" size="30" value="<?php echo $contadores->op2->EditValue ?>"<?php echo $contadores->op2->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_op2" name="btw1_op2">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_op2" name="btw1_op2">
<input type="text" name="y_op2" id="y_op2" title="<?php echo $contadores->op2->FldTitle() ?>" size="30" value="<?php echo $contadores->op2->EditValue2 ?>"<?php echo $contadores->op2->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->horahasta->FldCaption() ?></td>
		<td<?php echo $contadores->horahasta->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_horahasta" id="z_horahasta" onchange="ew_SrchOprChanged('z_horahasta')"><option value="="<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($contadores->horahasta->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->horahasta->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_horahasta" id="x_horahasta" title="<?php echo $contadores->horahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->horahasta->EditValue ?>"<?php echo $contadores->horahasta->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_horahasta" name="btw1_horahasta">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_horahasta" name="btw1_horahasta">
<input type="text" name="y_horahasta" id="y_horahasta" title="<?php echo $contadores->horahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->horahasta->EditValue2 ?>"<?php echo $contadores->horahasta->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->material->FldCaption() ?></td>
		<td<?php echo $contadores->material->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_material" id="z_material" onchange="ew_SrchOprChanged('z_material')"><option value="="<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->material->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->material->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($contadores->material->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->material->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_material" id="x_material" title="<?php echo $contadores->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->material->EditValue ?>"<?php echo $contadores->material->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_material" name="btw1_material">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_material" name="btw1_material">
<input type="text" name="y_material" id="y_material" title="<?php echo $contadores->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->material->EditValue2 ?>"<?php echo $contadores->material->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->orden->FldCaption() ?></td>
		<td<?php echo $contadores->orden->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_orden" id="z_orden" onchange="ew_SrchOprChanged('z_orden')"><option value="="<?php echo ($contadores->orden->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($contadores->orden->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($contadores->orden->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($contadores->orden->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($contadores->orden->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($contadores->orden->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($contadores->orden->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $contadores->orden->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_orden" id="x_orden" title="<?php echo $contadores->orden->FldTitle() ?>" size="30" value="<?php echo $contadores->orden->EditValue ?>"<?php echo $contadores->orden->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_orden" name="btw1_orden">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_orden" name="btw1_orden">
<input type="text" name="y_orden" id="y_orden" title="<?php echo $contadores->orden->FldTitle() ?>" size="30" value="<?php echo $contadores->orden->EditValue2 ?>"<?php echo $contadores->orden->EditAttributes() ?>>
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
ew_SrchOprChanged('z_id');
ew_SrchOprChanged('z_op');
ew_SrchOprChanged('z_zona');
ew_SrchOprChanged('z_descripcion');
ew_SrchOprChanged('z_programa');
ew_SrchOprChanged('z_diahasta');
ew_SrchOprChanged('z_op2');
ew_SrchOprChanged('z_horahasta');
ew_SrchOprChanged('z_material');
ew_SrchOprChanged('z_orden');

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
$contadores_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontadores_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'contadores';

	// Page object name
	var $PageObjName = 'contadores_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contadores;
		if ($contadores->UseTokenInUrl) $PageUrl .= "t=" . $contadores->TableVar . "&"; // Add page token
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
		global $objForm, $contadores;
		if ($contadores->UseTokenInUrl) {
			if ($objForm)
				return ($contadores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contadores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccontadores_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (contadores)
		$GLOBALS["contadores"] = new ccontadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contadores', TRUE);

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
		global $contadores;

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
		global $objForm, $Language, $gsSearchError, $contadores;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$contadores->CurrentAction = $objForm->GetValue("a_search");
			switch ($contadores->CurrentAction) {
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
						$sSrchStr = $contadores->UrlParm($sSrchStr);
						$this->Page_Terminate("contadoreslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$contadores->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $contadores;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $contadores->id); // id
	$this->BuildSearchUrl($sSrchUrl, $contadores->op); // op
	$this->BuildSearchUrl($sSrchUrl, $contadores->zona); // zona
	$this->BuildSearchUrl($sSrchUrl, $contadores->descripcion); // descripcion
	$this->BuildSearchUrl($sSrchUrl, $contadores->programa); // programa
	$this->BuildSearchUrl($sSrchUrl, $contadores->diahasta); // diahasta
	$this->BuildSearchUrl($sSrchUrl, $contadores->objetivo); // objetivo
	$this->BuildSearchUrl($sSrchUrl, $contadores->op2); // op2
	$this->BuildSearchUrl($sSrchUrl, $contadores->horahasta); // horahasta
	$this->BuildSearchUrl($sSrchUrl, $contadores->material); // material
	$this->BuildSearchUrl($sSrchUrl, $contadores->orden); // orden
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
		global $objForm, $contadores;

		// Load search values
		// id

		$contadores->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$contadores->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");
		$contadores->id->AdvancedSearch->SearchCondition = $objForm->GetValue("v_id");
		$contadores->id->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_id"));
		$contadores->id->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_id");

		// op
		$contadores->op->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_op"));
		$contadores->op->AdvancedSearch->SearchOperator = $objForm->GetValue("z_op");
		$contadores->op->AdvancedSearch->SearchCondition = $objForm->GetValue("v_op");
		$contadores->op->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_op"));
		$contadores->op->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_op");

		// zona
		$contadores->zona->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_zona"));
		$contadores->zona->AdvancedSearch->SearchOperator = $objForm->GetValue("z_zona");
		$contadores->zona->AdvancedSearch->SearchCondition = $objForm->GetValue("v_zona");
		$contadores->zona->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_zona"));
		$contadores->zona->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_zona");

		// descripcion
		$contadores->descripcion->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_descripcion"));
		$contadores->descripcion->AdvancedSearch->SearchOperator = $objForm->GetValue("z_descripcion");
		$contadores->descripcion->AdvancedSearch->SearchCondition = $objForm->GetValue("v_descripcion");
		$contadores->descripcion->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_descripcion"));
		$contadores->descripcion->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_descripcion");

		// programa
		$contadores->programa->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programa"));
		$contadores->programa->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programa");
		$contadores->programa->AdvancedSearch->SearchCondition = $objForm->GetValue("v_programa");
		$contadores->programa->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_programa"));
		$contadores->programa->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_programa");

		// diahasta
		$contadores->diahasta->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diahasta"));
		$contadores->diahasta->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diahasta");
		$contadores->diahasta->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diahasta");
		$contadores->diahasta->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diahasta"));
		$contadores->diahasta->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diahasta");

		// objetivo
		$contadores->objetivo->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_objetivo"));
		$contadores->objetivo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_objetivo");

		// op2
		$contadores->op2->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_op2"));
		$contadores->op2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_op2");
		$contadores->op2->AdvancedSearch->SearchCondition = $objForm->GetValue("v_op2");
		$contadores->op2->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_op2"));
		$contadores->op2->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_op2");

		// horahasta
		$contadores->horahasta->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_horahasta"));
		$contadores->horahasta->AdvancedSearch->SearchOperator = $objForm->GetValue("z_horahasta");
		$contadores->horahasta->AdvancedSearch->SearchCondition = $objForm->GetValue("v_horahasta");
		$contadores->horahasta->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_horahasta"));
		$contadores->horahasta->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_horahasta");

		// material
		$contadores->material->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_material"));
		$contadores->material->AdvancedSearch->SearchOperator = $objForm->GetValue("z_material");
		$contadores->material->AdvancedSearch->SearchCondition = $objForm->GetValue("v_material");
		$contadores->material->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_material"));
		$contadores->material->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_material");

		// orden
		$contadores->orden->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_orden"));
		$contadores->orden->AdvancedSearch->SearchOperator = $objForm->GetValue("z_orden");
		$contadores->orden->AdvancedSearch->SearchCondition = $objForm->GetValue("v_orden");
		$contadores->orden->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_orden"));
		$contadores->orden->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_orden");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $contadores;

		// Initialize URLs
		// Call Row_Rendering event

		$contadores->Row_Rendering();

		// Common render codes for all row types
		// id

		$contadores->id->CellCssStyle = ""; $contadores->id->CellCssClass = "";
		$contadores->id->CellAttrs = array(); $contadores->id->ViewAttrs = array(); $contadores->id->EditAttrs = array();

		// op
		$contadores->op->CellCssStyle = ""; $contadores->op->CellCssClass = "";
		$contadores->op->CellAttrs = array(); $contadores->op->ViewAttrs = array(); $contadores->op->EditAttrs = array();

		// zona
		$contadores->zona->CellCssStyle = ""; $contadores->zona->CellCssClass = "";
		$contadores->zona->CellAttrs = array(); $contadores->zona->ViewAttrs = array(); $contadores->zona->EditAttrs = array();

		// descripcion
		$contadores->descripcion->CellCssStyle = ""; $contadores->descripcion->CellCssClass = "";
		$contadores->descripcion->CellAttrs = array(); $contadores->descripcion->ViewAttrs = array(); $contadores->descripcion->EditAttrs = array();

		// programa
		$contadores->programa->CellCssStyle = ""; $contadores->programa->CellCssClass = "";
		$contadores->programa->CellAttrs = array(); $contadores->programa->ViewAttrs = array(); $contadores->programa->EditAttrs = array();

		// diahasta
		$contadores->diahasta->CellCssStyle = ""; $contadores->diahasta->CellCssClass = "";
		$contadores->diahasta->CellAttrs = array(); $contadores->diahasta->ViewAttrs = array(); $contadores->diahasta->EditAttrs = array();

		// objetivo
		$contadores->objetivo->CellCssStyle = ""; $contadores->objetivo->CellCssClass = "";
		$contadores->objetivo->CellAttrs = array(); $contadores->objetivo->ViewAttrs = array(); $contadores->objetivo->EditAttrs = array();

		// op2
		$contadores->op2->CellCssStyle = ""; $contadores->op2->CellCssClass = "";
		$contadores->op2->CellAttrs = array(); $contadores->op2->ViewAttrs = array(); $contadores->op2->EditAttrs = array();

		// horahasta
		$contadores->horahasta->CellCssStyle = ""; $contadores->horahasta->CellCssClass = "";
		$contadores->horahasta->CellAttrs = array(); $contadores->horahasta->ViewAttrs = array(); $contadores->horahasta->EditAttrs = array();

		// material
		$contadores->material->CellCssStyle = ""; $contadores->material->CellCssClass = "";
		$contadores->material->CellAttrs = array(); $contadores->material->ViewAttrs = array(); $contadores->material->EditAttrs = array();

		// orden
		$contadores->orden->CellCssStyle = ""; $contadores->orden->CellCssClass = "";
		$contadores->orden->CellAttrs = array(); $contadores->orden->ViewAttrs = array(); $contadores->orden->EditAttrs = array();
		if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$contadores->id->ViewValue = $contadores->id->CurrentValue;
			$contadores->id->CssStyle = "";
			$contadores->id->CssClass = "";
			$contadores->id->ViewCustomAttributes = "";

			// op
			$contadores->op->ViewValue = $contadores->op->CurrentValue;
			$contadores->op->CssStyle = "";
			$contadores->op->CssClass = "";
			$contadores->op->ViewCustomAttributes = "";

			// zona
			$contadores->zona->ViewValue = $contadores->zona->CurrentValue;
			$contadores->zona->CssStyle = "";
			$contadores->zona->CssClass = "";
			$contadores->zona->ViewCustomAttributes = "";

			// descripcion
			$contadores->descripcion->ViewValue = $contadores->descripcion->CurrentValue;
			$contadores->descripcion->CssStyle = "";
			$contadores->descripcion->CssClass = "";
			$contadores->descripcion->ViewCustomAttributes = "";

			// programa
			$contadores->programa->ViewValue = $contadores->programa->CurrentValue;
			$contadores->programa->CssStyle = "";
			$contadores->programa->CssClass = "";
			$contadores->programa->ViewCustomAttributes = "";

			// diahasta
			if (strval($contadores->diahasta->CurrentValue) <> "") {
				switch ($contadores->diahasta->CurrentValue) {
					case "Lunes":
						$contadores->diahasta->ViewValue = "Lunes";
						break;
					case "Martes":
						$contadores->diahasta->ViewValue = "Martes";
						break;
					case "Miercoles":
						$contadores->diahasta->ViewValue = "Miercoles";
						break;
					case "Jueves":
						$contadores->diahasta->ViewValue = "Jueves";
						break;
					case "Viernes":
						$contadores->diahasta->ViewValue = "Viernes";
						break;
					case "Sabado":
						$contadores->diahasta->ViewValue = "Sabado";
						break;
					case "Domingo":
						$contadores->diahasta->ViewValue = "Domingo";
						break;
					default:
						$contadores->diahasta->ViewValue = $contadores->diahasta->CurrentValue;
				}
			} else {
				$contadores->diahasta->ViewValue = NULL;
			}
			$contadores->diahasta->CssStyle = "";
			$contadores->diahasta->CssClass = "";
			$contadores->diahasta->ViewCustomAttributes = "";

			// objetivo
			$contadores->objetivo->ViewValue = $contadores->objetivo->CurrentValue;
			$contadores->objetivo->CssStyle = "";
			$contadores->objetivo->CssClass = "";
			$contadores->objetivo->ViewCustomAttributes = "";

			// op2
			$contadores->op2->ViewValue = $contadores->op2->CurrentValue;
			$contadores->op2->CssStyle = "";
			$contadores->op2->CssClass = "";
			$contadores->op2->ViewCustomAttributes = "";

			// horahasta
			$contadores->horahasta->ViewValue = $contadores->horahasta->CurrentValue;
			$contadores->horahasta->CssStyle = "";
			$contadores->horahasta->CssClass = "";
			$contadores->horahasta->ViewCustomAttributes = "";

			// material
			$contadores->material->ViewValue = $contadores->material->CurrentValue;
			$contadores->material->CssStyle = "";
			$contadores->material->CssClass = "";
			$contadores->material->ViewCustomAttributes = "";

			// orden
			$contadores->orden->ViewValue = $contadores->orden->CurrentValue;
			$contadores->orden->CssStyle = "";
			$contadores->orden->CssClass = "";
			$contadores->orden->ViewCustomAttributes = "";

			// id
			$contadores->id->HrefValue = "";
			$contadores->id->TooltipValue = "";

			// op
			$contadores->op->HrefValue = "";
			$contadores->op->TooltipValue = "";

			// zona
			$contadores->zona->HrefValue = "";
			$contadores->zona->TooltipValue = "";

			// descripcion
			$contadores->descripcion->HrefValue = "";
			$contadores->descripcion->TooltipValue = "";

			// programa
			$contadores->programa->HrefValue = "";
			$contadores->programa->TooltipValue = "";

			// diahasta
			$contadores->diahasta->HrefValue = "";
			$contadores->diahasta->TooltipValue = "";

			// objetivo
			$contadores->objetivo->HrefValue = "";
			$contadores->objetivo->TooltipValue = "";

			// op2
			$contadores->op2->HrefValue = "";
			$contadores->op2->TooltipValue = "";

			// horahasta
			$contadores->horahasta->HrefValue = "";
			$contadores->horahasta->TooltipValue = "";

			// material
			$contadores->material->HrefValue = "";
			$contadores->material->TooltipValue = "";

			// orden
			$contadores->orden->HrefValue = "";
			$contadores->orden->TooltipValue = "";
		} elseif ($contadores->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$contadores->id->EditCustomAttributes = "";
			$contadores->id->EditValue = ew_HtmlEncode($contadores->id->AdvancedSearch->SearchValue);
			$contadores->id->EditCustomAttributes = "";
			$contadores->id->EditValue2 = ew_HtmlEncode($contadores->id->AdvancedSearch->SearchValue2);

			// op
			$contadores->op->EditCustomAttributes = "";
			$contadores->op->EditValue = ew_HtmlEncode($contadores->op->AdvancedSearch->SearchValue);
			$contadores->op->EditCustomAttributes = "";
			$contadores->op->EditValue2 = ew_HtmlEncode($contadores->op->AdvancedSearch->SearchValue2);

			// zona
			$contadores->zona->EditCustomAttributes = "";
			$contadores->zona->EditValue = ew_HtmlEncode($contadores->zona->AdvancedSearch->SearchValue);
			$contadores->zona->EditCustomAttributes = "";
			$contadores->zona->EditValue2 = ew_HtmlEncode($contadores->zona->AdvancedSearch->SearchValue2);

			// descripcion
			$contadores->descripcion->EditCustomAttributes = "";
			$contadores->descripcion->EditValue = ew_HtmlEncode($contadores->descripcion->AdvancedSearch->SearchValue);
			$contadores->descripcion->EditCustomAttributes = "";
			$contadores->descripcion->EditValue2 = ew_HtmlEncode($contadores->descripcion->AdvancedSearch->SearchValue2);

			// programa
			$contadores->programa->EditCustomAttributes = "";
			$contadores->programa->EditValue = ew_HtmlEncode($contadores->programa->AdvancedSearch->SearchValue);
			$contadores->programa->EditCustomAttributes = "";
			$contadores->programa->EditValue2 = ew_HtmlEncode($contadores->programa->AdvancedSearch->SearchValue2);

			// diahasta
			$contadores->diahasta->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Lunes", "Lunes");
			$arwrk[] = array("Martes", "Martes");
			$arwrk[] = array("Miercoles", "Miercoles");
			$arwrk[] = array("Jueves", "Jueves");
			$arwrk[] = array("Viernes", "Viernes");
			$arwrk[] = array("Sabado", "Sabado");
			$arwrk[] = array("Domingo", "Domingo");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contadores->diahasta->EditValue = $arwrk;
			$contadores->diahasta->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Lunes", "Lunes");
			$arwrk[] = array("Martes", "Martes");
			$arwrk[] = array("Miercoles", "Miercoles");
			$arwrk[] = array("Jueves", "Jueves");
			$arwrk[] = array("Viernes", "Viernes");
			$arwrk[] = array("Sabado", "Sabado");
			$arwrk[] = array("Domingo", "Domingo");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contadores->diahasta->EditValue2 = $arwrk;

			// objetivo
			$contadores->objetivo->EditCustomAttributes = "";
			$contadores->objetivo->EditValue = ew_HtmlEncode($contadores->objetivo->AdvancedSearch->SearchValue);

			// op2
			$contadores->op2->EditCustomAttributes = "";
			$contadores->op2->EditValue = ew_HtmlEncode($contadores->op2->AdvancedSearch->SearchValue);
			$contadores->op2->EditCustomAttributes = "";
			$contadores->op2->EditValue2 = ew_HtmlEncode($contadores->op2->AdvancedSearch->SearchValue2);

			// horahasta
			$contadores->horahasta->EditCustomAttributes = "";
			$contadores->horahasta->EditValue = ew_HtmlEncode($contadores->horahasta->AdvancedSearch->SearchValue);
			$contadores->horahasta->EditCustomAttributes = "";
			$contadores->horahasta->EditValue2 = ew_HtmlEncode($contadores->horahasta->AdvancedSearch->SearchValue2);

			// material
			$contadores->material->EditCustomAttributes = "";
			$contadores->material->EditValue = ew_HtmlEncode($contadores->material->AdvancedSearch->SearchValue);
			$contadores->material->EditCustomAttributes = "";
			$contadores->material->EditValue2 = ew_HtmlEncode($contadores->material->AdvancedSearch->SearchValue2);

			// orden
			$contadores->orden->EditCustomAttributes = "";
			$contadores->orden->EditValue = ew_HtmlEncode($contadores->orden->AdvancedSearch->SearchValue);
			$contadores->orden->EditCustomAttributes = "";
			$contadores->orden->EditValue2 = ew_HtmlEncode($contadores->orden->AdvancedSearch->SearchValue2);
		}

		// Call Row Rendered event
		if ($contadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contadores->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $contadores;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($contadores->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->id->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->id->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->id->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->op->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->op->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->op->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->op->FldErrMsg();
		}
		if (!ew_CheckNumber($contadores->objetivo->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->objetivo->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->op2->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->op2->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->op2->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->op2->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->orden->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->orden->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->orden->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $contadores->orden->FldErrMsg();
		}

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
		global $contadores;
		$contadores->id->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_id");
		$contadores->id->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_id");
		$contadores->id->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_id");
		$contadores->op->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_op");
		$contadores->op->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_op");
		$contadores->op->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_op");
		$contadores->zona->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_zona");
		$contadores->zona->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_zona");
		$contadores->zona->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_zona");
		$contadores->descripcion->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_descripcion");
		$contadores->descripcion->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_descripcion");
		$contadores->descripcion->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_descripcion");
		$contadores->programa->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_programa");
		$contadores->programa->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_programa");
		$contadores->programa->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_programa");
		$contadores->diahasta->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_diahasta");
		$contadores->diahasta->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_diahasta");
		$contadores->diahasta->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_diahasta");
		$contadores->objetivo->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_objetivo");
		$contadores->op2->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_op2");
		$contadores->op2->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_op2");
		$contadores->op2->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_op2");
		$contadores->horahasta->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_horahasta");
		$contadores->horahasta->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_horahasta");
		$contadores->horahasta->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_horahasta");
		$contadores->material->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_material");
		$contadores->material->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_material");
		$contadores->material->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_material");
		$contadores->orden->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_orden");
		$contadores->orden->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_orden");
		$contadores->orden->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_orden");
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
