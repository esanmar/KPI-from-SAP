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
$ircio_edit = new circio_edit();
$Page =& $ircio_edit;

// Page init
$ircio_edit->Page_Init();

// Page main
$ircio_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ircio_edit = new ew_Page("ircio_edit");

// page properties
ircio_edit.PageID = "edit"; // page ID
ircio_edit.FormID = "fircioedit"; // form ID
var EW_PAGE_ID = ircio_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
ircio_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
ircio_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
ircio_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ircio_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $ircio->TableCaption() ?><br><br>
<a href="<?php echo $ircio->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$ircio_edit->ShowMessage();
?>
<form name="fircioedit" id="fircioedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ircio_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="ircio">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($ircio->cabecera->Visible) { // cabecera ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->cabecera->FldCaption() ?></td>
		<td<?php echo $ircio->cabecera->CellAttributes() ?>><span id="el_cabecera">
<input type="text" name="x_cabecera" id="x_cabecera" title="<?php echo $ircio->cabecera->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $ircio->cabecera->EditValue ?>"<?php echo $ircio->cabecera->EditAttributes() ?>>
</span><?php echo $ircio->cabecera->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->orden->Visible) { // orden ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->orden->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $ircio->orden->CellAttributes() ?>><span id="el_orden">
<div<?php echo $ircio->orden->ViewAttributes() ?>><?php echo $ircio->orden->EditValue ?></div><input type="hidden" name="x_orden" id="x_orden" value="<?php echo ew_HtmlEncode($ircio->orden->CurrentValue) ?>">
</span><?php echo $ircio->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->op->Visible) { // op ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->op->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $ircio->op->CellAttributes() ?>><span id="el_op">
<div<?php echo $ircio->op->ViewAttributes() ?>><?php echo $ircio->op->EditValue ?></div><input type="hidden" name="x_op" id="x_op" value="<?php echo ew_HtmlEncode($ircio->op->CurrentValue) ?>">
</span><?php echo $ircio->op->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->puesto->Visible) { // puesto ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->puesto->FldCaption() ?></td>
		<td<?php echo $ircio->puesto->CellAttributes() ?>><span id="el_puesto">
<input type="text" name="x_puesto" id="x_puesto" title="<?php echo $ircio->puesto->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->puesto->EditValue ?>"<?php echo $ircio->puesto->EditAttributes() ?>>
</span><?php echo $ircio->puesto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->contrato->Visible) { // contrato ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->contrato->FldCaption() ?></td>
		<td<?php echo $ircio->contrato->CellAttributes() ?>><span id="el_contrato">
<input type="text" name="x_contrato" id="x_contrato" title="<?php echo $ircio->contrato->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->contrato->EditValue ?>"<?php echo $ircio->contrato->EditAttributes() ?>>
</span><?php echo $ircio->contrato->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->fechacrea->Visible) { // fechacrea ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->fechacrea->FldCaption() ?></td>
		<td<?php echo $ircio->fechacrea->CellAttributes() ?>><span id="el_fechacrea">
<input type="text" name="x_fechacrea" id="x_fechacrea" title="<?php echo $ircio->fechacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechacrea->EditValue ?>"<?php echo $ircio->fechacrea->EditAttributes() ?>>
</span><?php echo $ircio->fechacrea->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->horacrea->Visible) { // horacrea ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->horacrea->FldCaption() ?></td>
		<td<?php echo $ircio->horacrea->CellAttributes() ?>><span id="el_horacrea">
<input type="text" name="x_horacrea" id="x_horacrea" title="<?php echo $ircio->horacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horacrea->EditValue ?>"<?php echo $ircio->horacrea->EditAttributes() ?>>
</span><?php echo $ircio->horacrea->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->fechafin->Visible) { // fechafin ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->fechafin->FldCaption() ?></td>
		<td<?php echo $ircio->fechafin->CellAttributes() ?>><span id="el_fechafin">
<input type="text" name="x_fechafin" id="x_fechafin" title="<?php echo $ircio->fechafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechafin->EditValue ?>"<?php echo $ircio->fechafin->EditAttributes() ?>>
</span><?php echo $ircio->fechafin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->horafin->Visible) { // horafin ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->horafin->FldCaption() ?></td>
		<td<?php echo $ircio->horafin->CellAttributes() ?>><span id="el_horafin">
<input type="text" name="x_horafin" id="x_horafin" title="<?php echo $ircio->horafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horafin->EditValue ?>"<?php echo $ircio->horafin->EditAttributes() ?>>
</span><?php echo $ircio->horafin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ircio->material->Visible) { // material ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->material->FldCaption() ?></td>
		<td<?php echo $ircio->material->CellAttributes() ?>><span id="el_material">
<input type="text" name="x_material" id="x_material" title="<?php echo $ircio->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->material->EditValue ?>"<?php echo $ircio->material->EditAttributes() ?>>
</span><?php echo $ircio->material->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$ircio_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class circio_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'ircio';

	// Page object name
	var $PageObjName = 'ircio_edit';

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
	function circio_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (ircio)
		$GLOBALS["ircio"] = new circio();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $ircio;

		// Load key from QueryString
		if (@$_GET["orden"] <> "")
			$ircio->orden->setQueryStringValue($_GET["orden"]);
		if (@$_GET["op"] <> "")
			$ircio->op->setQueryStringValue($_GET["op"]);
		if (@$_POST["a_edit"] <> "") {
			$ircio->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$ircio->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$ircio->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$ircio->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($ircio->orden->CurrentValue == "")
			$this->Page_Terminate("irciolist.php"); // Invalid key, return to list
		if ($ircio->op->CurrentValue == "")
			$this->Page_Terminate("irciolist.php"); // Invalid key, return to list
		switch ($ircio->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("irciolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$ircio->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $ircio->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "ircioview.php")
						$sReturnUrl = $ircio->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$ircio->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$ircio->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $ircio;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ircio;
		$ircio->cabecera->setFormValue($objForm->GetValue("x_cabecera"));
		$ircio->orden->setFormValue($objForm->GetValue("x_orden"));
		$ircio->op->setFormValue($objForm->GetValue("x_op"));
		$ircio->puesto->setFormValue($objForm->GetValue("x_puesto"));
		$ircio->contrato->setFormValue($objForm->GetValue("x_contrato"));
		$ircio->fechacrea->setFormValue($objForm->GetValue("x_fechacrea"));
		$ircio->horacrea->setFormValue($objForm->GetValue("x_horacrea"));
		$ircio->fechafin->setFormValue($objForm->GetValue("x_fechafin"));
		$ircio->horafin->setFormValue($objForm->GetValue("x_horafin"));
		$ircio->material->setFormValue($objForm->GetValue("x_material"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $ircio;
		$this->LoadRow();
		$ircio->cabecera->CurrentValue = $ircio->cabecera->FormValue;
		$ircio->orden->CurrentValue = $ircio->orden->FormValue;
		$ircio->op->CurrentValue = $ircio->op->FormValue;
		$ircio->puesto->CurrentValue = $ircio->puesto->FormValue;
		$ircio->contrato->CurrentValue = $ircio->contrato->FormValue;
		$ircio->fechacrea->CurrentValue = $ircio->fechacrea->FormValue;
		$ircio->horacrea->CurrentValue = $ircio->horacrea->FormValue;
		$ircio->fechafin->CurrentValue = $ircio->fechafin->FormValue;
		$ircio->horafin->CurrentValue = $ircio->horafin->FormValue;
		$ircio->material->CurrentValue = $ircio->material->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ircio;
		$sFilter = $ircio->KeyFilter();

		// Call Row Selecting event
		$ircio->Row_Selecting($sFilter);

		// Load SQL based on filter
		$ircio->CurrentFilter = $sFilter;
		$sSql = $ircio->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$ircio->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $ircio;
		$ircio->cabecera->setDbValue($rs->fields('cabecera'));
		$ircio->orden->setDbValue($rs->fields('orden'));
		$ircio->op->setDbValue($rs->fields('op'));
		$ircio->puesto->setDbValue($rs->fields('puesto'));
		$ircio->contrato->setDbValue($rs->fields('contrato'));
		$ircio->fechacrea->setDbValue($rs->fields('fechacrea'));
		$ircio->horacrea->setDbValue($rs->fields('horacrea'));
		$ircio->fechafin->setDbValue($rs->fields('fechafin'));
		$ircio->horafin->setDbValue($rs->fields('horafin'));
		$ircio->material->setDbValue($rs->fields('material'));
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
		} elseif ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// cabecera
			$ircio->cabecera->EditCustomAttributes = "";
			$ircio->cabecera->EditValue = ew_HtmlEncode($ircio->cabecera->CurrentValue);

			// orden
			$ircio->orden->EditCustomAttributes = "";
			$ircio->orden->EditValue = $ircio->orden->CurrentValue;
			$ircio->orden->CssStyle = "";
			$ircio->orden->CssClass = "";
			$ircio->orden->ViewCustomAttributes = "";

			// op
			$ircio->op->EditCustomAttributes = "";
			$ircio->op->EditValue = $ircio->op->CurrentValue;
			$ircio->op->CssStyle = "";
			$ircio->op->CssClass = "";
			$ircio->op->ViewCustomAttributes = "";

			// puesto
			$ircio->puesto->EditCustomAttributes = "";
			$ircio->puesto->EditValue = ew_HtmlEncode($ircio->puesto->CurrentValue);

			// contrato
			$ircio->contrato->EditCustomAttributes = "";
			$ircio->contrato->EditValue = ew_HtmlEncode($ircio->contrato->CurrentValue);

			// fechacrea
			$ircio->fechacrea->EditCustomAttributes = "";
			$ircio->fechacrea->EditValue = ew_HtmlEncode($ircio->fechacrea->CurrentValue);

			// horacrea
			$ircio->horacrea->EditCustomAttributes = "";
			$ircio->horacrea->EditValue = ew_HtmlEncode($ircio->horacrea->CurrentValue);

			// fechafin
			$ircio->fechafin->EditCustomAttributes = "";
			$ircio->fechafin->EditValue = ew_HtmlEncode($ircio->fechafin->CurrentValue);

			// horafin
			$ircio->horafin->EditCustomAttributes = "";
			$ircio->horafin->EditValue = ew_HtmlEncode($ircio->horafin->CurrentValue);

			// material
			$ircio->material->EditCustomAttributes = "";
			$ircio->material->EditValue = ew_HtmlEncode($ircio->material->CurrentValue);

			// Edit refer script
			// cabecera

			$ircio->cabecera->HrefValue = "";

			// orden
			$ircio->orden->HrefValue = "";

			// op
			$ircio->op->HrefValue = "";

			// puesto
			$ircio->puesto->HrefValue = "";

			// contrato
			$ircio->contrato->HrefValue = "";

			// fechacrea
			$ircio->fechacrea->HrefValue = "";

			// horacrea
			$ircio->horacrea->HrefValue = "";

			// fechafin
			$ircio->fechafin->HrefValue = "";

			// horafin
			$ircio->horafin->HrefValue = "";

			// material
			$ircio->material->HrefValue = "";
		}

		// Call Row Rendered event
		if ($ircio->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$ircio->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $ircio;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $ircio;
		$sFilter = $ircio->KeyFilter();
		$ircio->CurrentFilter = $sFilter;
		$sSql = $ircio->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// cabecera
			$ircio->cabecera->SetDbValueDef($rsnew, $ircio->cabecera->CurrentValue, NULL, FALSE);

			// orden
			// op
			// puesto

			$ircio->puesto->SetDbValueDef($rsnew, $ircio->puesto->CurrentValue, NULL, FALSE);

			// contrato
			$ircio->contrato->SetDbValueDef($rsnew, $ircio->contrato->CurrentValue, NULL, FALSE);

			// fechacrea
			$ircio->fechacrea->SetDbValueDef($rsnew, $ircio->fechacrea->CurrentValue, NULL, FALSE);

			// horacrea
			$ircio->horacrea->SetDbValueDef($rsnew, $ircio->horacrea->CurrentValue, NULL, FALSE);

			// fechafin
			$ircio->fechafin->SetDbValueDef($rsnew, $ircio->fechafin->CurrentValue, NULL, FALSE);

			// horafin
			$ircio->horafin->SetDbValueDef($rsnew, $ircio->horafin->CurrentValue, NULL, FALSE);

			// material
			$ircio->material->SetDbValueDef($rsnew, $ircio->material->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $ircio->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($ircio->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($ircio->CancelMessage <> "") {
					$this->setMessage($ircio->CancelMessage);
					$ircio->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$ircio->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
