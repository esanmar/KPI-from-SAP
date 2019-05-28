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
$calculo_add = new ccalculo_add();
$Page =& $calculo_add;

// Page init
$calculo_add->Page_Init();

// Page main
$calculo_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var calculo_add = new ew_Page("calculo_add");

// page properties
calculo_add.PageID = "add"; // page ID
calculo_add.FormID = "fcalculoadd"; // form ID
var EW_PAGE_ID = calculo_add.PageID; // for backward compatibility

// extend page with ValidateForm function
calculo_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
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
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
calculo_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calculo_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calculo_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calculo->TableCaption() ?><br><br>
<a href="<?php echo $calculo->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$calculo_add->ShowMessage();
?>
<form name="fcalculoadd" id="fcalculoadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return calculo_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="calculo">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($calculo->fechahoy->Visible) { // fechahoy ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->fechahoy->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $calculo->fechahoy->CellAttributes() ?>><span id="el_fechahoy">
<select id="x_fechahoy" name="x_fechahoy" title="<?php echo $calculo->fechahoy->FldTitle() ?>"<?php echo $calculo->fechahoy->EditAttributes() ?>>
<?php
if (is_array($calculo->fechahoy->EditValue)) {
	$arwrk = $calculo->fechahoy->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($calculo->fechahoy->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $calculo->fechahoy->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calculo->fechahasta->Visible) { // fechahasta ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->fechahasta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $calculo->fechahasta->CellAttributes() ?>><span id="el_fechahasta">
<input type="text" name="x_fechahasta" id="x_fechahasta" title="<?php echo $calculo->fechahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $calculo->fechahasta->EditValue ?>"<?php echo $calculo->fechahasta->EditAttributes() ?>>
</span><?php echo $calculo->fechahasta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calculo->diasresta->Visible) { // diasresta ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diasresta->FldCaption() ?></td>
		<td<?php echo $calculo->diasresta->CellAttributes() ?>><span id="el_diasresta">
<input type="text" name="x_diasresta" id="x_diasresta" title="<?php echo $calculo->diasresta->FldTitle() ?>" size="30" value="<?php echo $calculo->diasresta->EditValue ?>"<?php echo $calculo->diasresta->EditAttributes() ?>>
</span><?php echo $calculo->diasresta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calculo->diaslleva->Visible) { // diaslleva ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diaslleva->FldCaption() ?></td>
		<td<?php echo $calculo->diaslleva->CellAttributes() ?>><span id="el_diaslleva">
<input type="text" name="x_diaslleva" id="x_diaslleva" title="<?php echo $calculo->diaslleva->FldTitle() ?>" size="30" value="<?php echo $calculo->diaslleva->EditValue ?>"<?php echo $calculo->diaslleva->EditAttributes() ?>>
</span><?php echo $calculo->diaslleva->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calculo->diasllevalab->Visible) { // diasllevalab ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diasllevalab->FldCaption() ?></td>
		<td<?php echo $calculo->diasllevalab->CellAttributes() ?>><span id="el_diasllevalab">
<input type="text" name="x_diasllevalab" id="x_diasllevalab" title="<?php echo $calculo->diasllevalab->FldTitle() ?>" size="30" value="<?php echo $calculo->diasllevalab->EditValue ?>"<?php echo $calculo->diasllevalab->EditAttributes() ?>>
</span><?php echo $calculo->diasllevalab->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$calculo_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalculo_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'calculo';

	// Page object name
	var $PageObjName = 'calculo_add';

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
	function ccalculo_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (calculo)
		$GLOBALS["calculo"] = new ccalculo();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $calculo;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["fechahoy"] != "") {
		  $calculo->fechahoy->setQueryStringValue($_GET["fechahoy"]);
		} else {
		  $bCopy = FALSE;
		}
		if (@$_GET["fechahasta"] != "") {
		  $calculo->fechahasta->setQueryStringValue($_GET["fechahasta"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $calculo->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$calculo->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $calculo->CurrentAction = "C"; // Copy record
		  } else {
		    $calculo->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($calculo->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("calculolist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$calculo->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $calculo->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "calculoview.php")
						$sReturnUrl = $calculo->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$calculo->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $calculo;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $calculo;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $calculo;
		$calculo->fechahoy->setFormValue($objForm->GetValue("x_fechahoy"));
		$calculo->fechahasta->setFormValue($objForm->GetValue("x_fechahasta"));
		$calculo->diasresta->setFormValue($objForm->GetValue("x_diasresta"));
		$calculo->diaslleva->setFormValue($objForm->GetValue("x_diaslleva"));
		$calculo->diasllevalab->setFormValue($objForm->GetValue("x_diasllevalab"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $calculo;
		$calculo->fechahoy->CurrentValue = $calculo->fechahoy->FormValue;
		$calculo->fechahasta->CurrentValue = $calculo->fechahasta->FormValue;
		$calculo->diasresta->CurrentValue = $calculo->diasresta->FormValue;
		$calculo->diaslleva->CurrentValue = $calculo->diaslleva->FormValue;
		$calculo->diasllevalab->CurrentValue = $calculo->diasllevalab->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $calculo;
		$sFilter = $calculo->KeyFilter();

		// Call Row Selecting event
		$calculo->Row_Selecting($sFilter);

		// Load SQL based on filter
		$calculo->CurrentFilter = $sFilter;
		$sSql = $calculo->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$calculo->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $calculo;
		$calculo->fechahoy->setDbValue($rs->fields('fechahoy'));
		$calculo->fechahasta->setDbValue($rs->fields('fechahasta'));
		$calculo->diasresta->setDbValue($rs->fields('diasresta'));
		$calculo->diaslleva->setDbValue($rs->fields('diaslleva'));
		$calculo->diasllevalab->setDbValue($rs->fields('diasllevalab'));
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
		} elseif ($calculo->RowType == EW_ROWTYPE_ADD) { // Add row

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

			// fechahasta
			$calculo->fechahasta->EditCustomAttributes = "";
			$calculo->fechahasta->EditValue = ew_HtmlEncode($calculo->fechahasta->CurrentValue);

			// diasresta
			$calculo->diasresta->EditCustomAttributes = "";
			$calculo->diasresta->EditValue = ew_HtmlEncode($calculo->diasresta->CurrentValue);

			// diaslleva
			$calculo->diaslleva->EditCustomAttributes = "";
			$calculo->diaslleva->EditValue = ew_HtmlEncode($calculo->diaslleva->CurrentValue);

			// diasllevalab
			$calculo->diasllevalab->EditCustomAttributes = "";
			$calculo->diasllevalab->EditValue = ew_HtmlEncode($calculo->diasllevalab->CurrentValue);
		}

		// Call Row Rendered event
		if ($calculo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calculo->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $calculo;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($calculo->diasresta->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $calculo->diasresta->FldErrMsg();
		}
		if (!ew_CheckInteger($calculo->diaslleva->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $calculo->diaslleva->FldErrMsg();
		}
		if (!ew_CheckInteger($calculo->diasllevalab->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $calculo->diasllevalab->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $calculo;

		// Check if key value entered
		if ($calculo->fechahoy->CurrentValue == "" && $calculo->fechahoy->getSessionValue() == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($calculo->fechahasta->CurrentValue == "" && $calculo->fechahasta->getSessionValue() == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $calculo->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $calculo->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// fechahoy
		$calculo->fechahoy->SetDbValueDef($rsnew, $calculo->fechahoy->CurrentValue, "", FALSE);

		// fechahasta
		$calculo->fechahasta->SetDbValueDef($rsnew, $calculo->fechahasta->CurrentValue, "", FALSE);

		// diasresta
		$calculo->diasresta->SetDbValueDef($rsnew, $calculo->diasresta->CurrentValue, NULL, FALSE);

		// diaslleva
		$calculo->diaslleva->SetDbValueDef($rsnew, $calculo->diaslleva->CurrentValue, NULL, FALSE);

		// diasllevalab
		$calculo->diasllevalab->SetDbValueDef($rsnew, $calculo->diasllevalab->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $calculo->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($calculo->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($calculo->CancelMessage <> "") {
				$this->setMessage($calculo->CancelMessage);
				$calculo->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$calculo->Row_Inserted($rsnew);
		}
		return $AddRow;
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
