<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
define("EW_DEFAULT_LOCALE", "es_ES", TRUE);
@setlocale(LC_ALL, EW_DEFAULT_LOCALE);
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "calculoinfo.php" ?>
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
$calculo_search = new ccalculo_search();
$Page =& $calculo_search;

// Page init
$calculo_search->Page_Init();

// Page main
$calculo_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var calculo_search = new ew_Page("calculo_search");

// page properties
calculo_search.PageID = "search"; // page ID
calculo_search.FormID = "fcalculosearch"; // form ID
var EW_PAGE_ID = calculo_search.PageID; // for backward compatibility

// extend page with validate function for search
calculo_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_diasresta"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($calculo->diasresta->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diaslleva"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($calculo->diaslleva->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diasllevalab"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($calculo->diasllevalab->FldErrMsg()) ?>");

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
calculo_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calculo_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calculo_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calculo->TableCaption() ?><br><br>
<a href="<?php echo $calculo->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$calculo_search->ShowMessage();
?>
<form name="fcalculosearch" id="fcalculosearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return calculo_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="calculo">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->fechahoy->FldCaption() ?></td>
		<td<?php echo $calculo->fechahoy->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_fechahoy" id="z_fechahoy" onchange="ew_SrchOprChanged('z_fechahoy')"><option value="="<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($calculo->fechahoy->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $calculo->fechahoy->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_fechahoy" name="x_fechahoy" title="<?php echo $calculo->fechahoy->FldTitle() ?>"<?php echo $calculo->fechahoy->EditAttributes() ?>>
<?php
if (is_array($calculo->fechahoy->EditValue)) {
	$arwrk = $calculo->fechahoy->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($calculo->fechahoy->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
				<span class="ewSearchOpr" style="display: none" id="btw1_fechahoy" name="btw1_fechahoy">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_fechahoy" name="btw1_fechahoy">
<select id="y_fechahoy" name="y_fechahoy" title="<?php echo $calculo->fechahoy->FldTitle() ?>"<?php echo $calculo->fechahoy->EditAttributes() ?>>
<?php
if (is_array($calculo->fechahoy->EditValue2)) {
	$arwrk = $calculo->fechahoy->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($calculo->fechahoy->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->fechahasta->FldCaption() ?></td>
		<td<?php echo $calculo->fechahasta->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_fechahasta" id="z_fechahasta" onchange="ew_SrchOprChanged('z_fechahasta')"><option value="="<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($calculo->fechahasta->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $calculo->fechahasta->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_fechahasta" id="x_fechahasta" title="<?php echo $calculo->fechahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $calculo->fechahasta->EditValue ?>"<?php echo $calculo->fechahasta->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_fechahasta" name="btw1_fechahasta">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_fechahasta" name="btw1_fechahasta">
<input type="text" name="y_fechahasta" id="y_fechahasta" title="<?php echo $calculo->fechahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $calculo->fechahasta->EditValue2 ?>"<?php echo $calculo->fechahasta->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diasresta->FldCaption() ?></td>
		<td<?php echo $calculo->diasresta->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_diasresta" id="z_diasresta" onchange="ew_SrchOprChanged('z_diasresta')"><option value="="<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($calculo->diasresta->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $calculo->diasresta->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_diasresta" id="x_diasresta" title="<?php echo $calculo->diasresta->FldTitle() ?>" size="30" value="<?php echo $calculo->diasresta->EditValue ?>"<?php echo $calculo->diasresta->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_diasresta" name="btw1_diasresta">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_diasresta" name="btw1_diasresta">
<input type="text" name="y_diasresta" id="y_diasresta" title="<?php echo $calculo->diasresta->FldTitle() ?>" size="30" value="<?php echo $calculo->diasresta->EditValue2 ?>"<?php echo $calculo->diasresta->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diaslleva->FldCaption() ?></td>
		<td<?php echo $calculo->diaslleva->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_diaslleva" id="z_diaslleva" value="="></span></td>
		<td<?php echo $calculo->diaslleva->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_diaslleva" id="x_diaslleva" title="<?php echo $calculo->diaslleva->FldTitle() ?>" size="30" value="<?php echo $calculo->diaslleva->EditValue ?>"<?php echo $calculo->diaslleva->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diasllevalab->FldCaption() ?></td>
		<td<?php echo $calculo->diasllevalab->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_diasllevalab" id="z_diasllevalab" value="="></span></td>
		<td<?php echo $calculo->diasllevalab->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_diasllevalab" id="x_diasllevalab" title="<?php echo $calculo->diasllevalab->FldTitle() ?>" size="30" value="<?php echo $calculo->diasllevalab->EditValue ?>"<?php echo $calculo->diasllevalab->EditAttributes() ?>>
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
ew_SrchOprChanged('z_fechahoy');
ew_SrchOprChanged('z_fechahasta');
ew_SrchOprChanged('z_diasresta');

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
$calculo_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalculo_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'calculo';

	// Page object name
	var $PageObjName = 'calculo_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $calculo;
		if ($calculo->UseTokenInUrl) $PageUrl .= "t=" . $calculo->TableVar . "&"; // Add page token
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
		global $objForm, $calculo;
		if ($calculo->UseTokenInUrl) {
			if ($objForm)
				return ($calculo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($calculo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccalculo_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (calculo)
		$GLOBALS["calculo"] = new ccalculo();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'calculo', TRUE);

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
		global $calculo;

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
		global $objForm, $Language, $gsSearchError, $calculo;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$calculo->CurrentAction = $objForm->GetValue("a_search");
			switch ($calculo->CurrentAction) {
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
						$sSrchStr = $calculo->UrlParm($sSrchStr);
						$this->Page_Terminate("calculolist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$calculo->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $calculo;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $calculo->fechahoy); // fechahoy
	$this->BuildSearchUrl($sSrchUrl, $calculo->fechahasta); // fechahasta
	$this->BuildSearchUrl($sSrchUrl, $calculo->diasresta); // diasresta
	$this->BuildSearchUrl($sSrchUrl, $calculo->diaslleva); // diaslleva
	$this->BuildSearchUrl($sSrchUrl, $calculo->diasllevalab); // diasllevalab
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
		global $objForm, $calculo;

		// Load search values
		// fechahoy

		$calculo->fechahoy->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fechahoy"));
		$calculo->fechahoy->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fechahoy");
		$calculo->fechahoy->AdvancedSearch->SearchCondition = $objForm->GetValue("v_fechahoy");
		$calculo->fechahoy->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_fechahoy"));
		$calculo->fechahoy->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_fechahoy");

		// fechahasta
		$calculo->fechahasta->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fechahasta"));
		$calculo->fechahasta->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fechahasta");
		$calculo->fechahasta->AdvancedSearch->SearchCondition = $objForm->GetValue("v_fechahasta");
		$calculo->fechahasta->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_fechahasta"));
		$calculo->fechahasta->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_fechahasta");

		// diasresta
		$calculo->diasresta->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diasresta"));
		$calculo->diasresta->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diasresta");
		$calculo->diasresta->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diasresta");
		$calculo->diasresta->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diasresta"));
		$calculo->diasresta->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diasresta");

		// diaslleva
		$calculo->diaslleva->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diaslleva"));
		$calculo->diaslleva->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diaslleva");

		// diasllevalab
		$calculo->diasllevalab->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diasllevalab"));
		$calculo->diasllevalab->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diasllevalab");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $calculo;

		// Initialize URLs
		// Call Row_Rendering event

		$calculo->Row_Rendering();

		// Common render codes for all row types
		// fechahoy

		$calculo->fechahoy->CellCssStyle = ""; $calculo->fechahoy->CellCssClass = "";
		$calculo->fechahoy->CellAttrs = array(); $calculo->fechahoy->ViewAttrs = array(); $calculo->fechahoy->EditAttrs = array();

		// fechahasta
		$calculo->fechahasta->CellCssStyle = ""; $calculo->fechahasta->CellCssClass = "";
		$calculo->fechahasta->CellAttrs = array(); $calculo->fechahasta->ViewAttrs = array(); $calculo->fechahasta->EditAttrs = array();

		// diasresta
		$calculo->diasresta->CellCssStyle = ""; $calculo->diasresta->CellCssClass = "";
		$calculo->diasresta->CellAttrs = array(); $calculo->diasresta->ViewAttrs = array(); $calculo->diasresta->EditAttrs = array();

		// diaslleva
		$calculo->diaslleva->CellCssStyle = ""; $calculo->diaslleva->CellCssClass = "";
		$calculo->diaslleva->CellAttrs = array(); $calculo->diaslleva->ViewAttrs = array(); $calculo->diaslleva->EditAttrs = array();

		// diasllevalab
		$calculo->diasllevalab->CellCssStyle = ""; $calculo->diasllevalab->CellCssClass = "";
		$calculo->diasllevalab->CellAttrs = array(); $calculo->diasllevalab->ViewAttrs = array(); $calculo->diasllevalab->EditAttrs = array();
		if ($calculo->RowType == EW_ROWTYPE_VIEW) { // View row

			// fechahoy
			if (strval($calculo->fechahoy->CurrentValue) <> "") {
				switch ($calculo->fechahoy->CurrentValue) {
					case "Lunes":
						$calculo->fechahoy->ViewValue = "Lunes";
						break;
					case "Martes":
						$calculo->fechahoy->ViewValue = "Martes";
						break;
					case "Miercoles":
						$calculo->fechahoy->ViewValue = "Miercoles";
						break;
					case "Jueves":
						$calculo->fechahoy->ViewValue = "Jueves";
						break;
					case "Viernes":
						$calculo->fechahoy->ViewValue = "Viernes";
						break;
					case "Sabado":
						$calculo->fechahoy->ViewValue = "Sabado";
						break;
					case "Domingo":
						$calculo->fechahoy->ViewValue = "Domingo";
						break;
					default:
						$calculo->fechahoy->ViewValue = $calculo->fechahoy->CurrentValue;
				}
			} else {
				$calculo->fechahoy->ViewValue = NULL;
			}
			$calculo->fechahoy->CssStyle = "";
			$calculo->fechahoy->CssClass = "";
			$calculo->fechahoy->ViewCustomAttributes = "";

			// fechahasta
			$calculo->fechahasta->ViewValue = $calculo->fechahasta->CurrentValue;
			$calculo->fechahasta->CssStyle = "";
			$calculo->fechahasta->CssClass = "";
			$calculo->fechahasta->ViewCustomAttributes = "";

			// diasresta
			$calculo->diasresta->ViewValue = $calculo->diasresta->CurrentValue;
			$calculo->diasresta->CssStyle = "";
			$calculo->diasresta->CssClass = "";
			$calculo->diasresta->ViewCustomAttributes = "";

			// diaslleva
			$calculo->diaslleva->ViewValue = $calculo->diaslleva->CurrentValue;
			$calculo->diaslleva->CssStyle = "";
			$calculo->diaslleva->CssClass = "";
			$calculo->diaslleva->ViewCustomAttributes = "";

			// diasllevalab
			$calculo->diasllevalab->ViewValue = $calculo->diasllevalab->CurrentValue;
			$calculo->diasllevalab->CssStyle = "";
			$calculo->diasllevalab->CssClass = "";
			$calculo->diasllevalab->ViewCustomAttributes = "";

			// fechahoy
			$calculo->fechahoy->HrefValue = "";
			$calculo->fechahoy->TooltipValue = "";

			// fechahasta
			$calculo->fechahasta->HrefValue = "";
			$calculo->fechahasta->TooltipValue = "";

			// diasresta
			$calculo->diasresta->HrefValue = "";
			$calculo->diasresta->TooltipValue = "";

			// diaslleva
			$calculo->diaslleva->HrefValue = "";
			$calculo->diaslleva->TooltipValue = "";

			// diasllevalab
			$calculo->diasllevalab->HrefValue = "";
			$calculo->diasllevalab->TooltipValue = "";
		} elseif ($calculo->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// fechahoy
			$calculo->fechahoy->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Lunes", "Lunes");
			$arwrk[] = array("Martes", "Martes");
			$arwrk[] = array("Miercoles", "Miercoles");
			$arwrk[] = array("Jueves", "Jueves");
			$arwrk[] = array("Viernes", "Viernes");
			$arwrk[] = array("Sabado", "Sabado");
			$arwrk[] = array("Domingo", "Domingo");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$calculo->fechahoy->EditValue = $arwrk;
			$calculo->fechahoy->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Lunes", "Lunes");
			$arwrk[] = array("Martes", "Martes");
			$arwrk[] = array("Miercoles", "Miercoles");
			$arwrk[] = array("Jueves", "Jueves");
			$arwrk[] = array("Viernes", "Viernes");
			$arwrk[] = array("Sabado", "Sabado");
			$arwrk[] = array("Domingo", "Domingo");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$calculo->fechahoy->EditValue2 = $arwrk;

			// fechahasta
			$calculo->fechahasta->EditCustomAttributes = "";
			$calculo->fechahasta->EditValue = ew_HtmlEncode($calculo->fechahasta->AdvancedSearch->SearchValue);
			$calculo->fechahasta->EditCustomAttributes = "";
			$calculo->fechahasta->EditValue2 = ew_HtmlEncode($calculo->fechahasta->AdvancedSearch->SearchValue2);

			// diasresta
			$calculo->diasresta->EditCustomAttributes = "";
			$calculo->diasresta->EditValue = ew_HtmlEncode($calculo->diasresta->AdvancedSearch->SearchValue);
			$calculo->diasresta->EditCustomAttributes = "";
			$calculo->diasresta->EditValue2 = ew_HtmlEncode($calculo->diasresta->AdvancedSearch->SearchValue2);

			// diaslleva
			$calculo->diaslleva->EditCustomAttributes = "";
			$calculo->diaslleva->EditValue = ew_HtmlEncode($calculo->diaslleva->AdvancedSearch->SearchValue);

			// diasllevalab
			$calculo->diasllevalab->EditCustomAttributes = "";
			$calculo->diasllevalab->EditValue = ew_HtmlEncode($calculo->diasllevalab->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($calculo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calculo->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $calculo;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($calculo->diasresta->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $calculo->diasresta->FldErrMsg();
		}
		if (!ew_CheckInteger($calculo->diasresta->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $calculo->diasresta->FldErrMsg();
		}
		if (!ew_CheckInteger($calculo->diaslleva->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $calculo->diaslleva->FldErrMsg();
		}
		if (!ew_CheckInteger($calculo->diasllevalab->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $calculo->diasllevalab->FldErrMsg();
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
		global $calculo;
		$calculo->fechahoy->AdvancedSearch->SearchValue = $calculo->getAdvancedSearch("x_fechahoy");
		$calculo->fechahoy->AdvancedSearch->SearchOperator = $calculo->getAdvancedSearch("z_fechahoy");
		$calculo->fechahoy->AdvancedSearch->SearchValue2 = $calculo->getAdvancedSearch("y_fechahoy");
		$calculo->fechahasta->AdvancedSearch->SearchValue = $calculo->getAdvancedSearch("x_fechahasta");
		$calculo->fechahasta->AdvancedSearch->SearchOperator = $calculo->getAdvancedSearch("z_fechahasta");
		$calculo->fechahasta->AdvancedSearch->SearchValue2 = $calculo->getAdvancedSearch("y_fechahasta");
		$calculo->diasresta->AdvancedSearch->SearchValue = $calculo->getAdvancedSearch("x_diasresta");
		$calculo->diasresta->AdvancedSearch->SearchOperator = $calculo->getAdvancedSearch("z_diasresta");
		$calculo->diasresta->AdvancedSearch->SearchValue2 = $calculo->getAdvancedSearch("y_diasresta");
		$calculo->diaslleva->AdvancedSearch->SearchValue = $calculo->getAdvancedSearch("x_diaslleva");
		$calculo->diasllevalab->AdvancedSearch->SearchValue = $calculo->getAdvancedSearch("x_diasllevalab");
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
