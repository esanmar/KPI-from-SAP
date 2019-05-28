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
$contadores_edit = new ccontadores_edit();
$Page =& $contadores_edit;

// Page init
$contadores_edit->Page_Init();

// Page main
$contadores_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contadores_edit = new ew_Page("contadores_edit");

// page properties
contadores_edit.PageID = "edit"; // page ID
contadores_edit.FormID = "fcontadoresedit"; // form ID
var EW_PAGE_ID = contadores_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
contadores_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
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
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
contadores_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contadores_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contadores_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contadores->TableCaption() ?><br><br>
<a href="<?php echo $contadores->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$contadores_edit->ShowMessage();
?>
<form name="fcontadoresedit" id="fcontadoresedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return contadores_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="contadores">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($contadores->id->Visible) { // id ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->id->FldCaption() ?></td>
		<td<?php echo $contadores->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $contadores->id->ViewAttributes() ?>><?php echo $contadores->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($contadores->id->CurrentValue) ?>">
</span><?php echo $contadores->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->op->Visible) { // op ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->op->FldCaption() ?></td>
		<td<?php echo $contadores->op->CellAttributes() ?>><span id="el_op">
<input type="text" name="x_op" id="x_op" title="<?php echo $contadores->op->FldTitle() ?>" size="30" value="<?php echo $contadores->op->EditValue ?>"<?php echo $contadores->op->EditAttributes() ?>>
</span><?php echo $contadores->op->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->zona->Visible) { // zona ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->zona->FldCaption() ?></td>
		<td<?php echo $contadores->zona->CellAttributes() ?>><span id="el_zona">
<input type="text" name="x_zona" id="x_zona" title="<?php echo $contadores->zona->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->zona->EditValue ?>"<?php echo $contadores->zona->EditAttributes() ?>>
</span><?php echo $contadores->zona->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->descripcion->Visible) { // descripcion ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->descripcion->FldCaption() ?></td>
		<td<?php echo $contadores->descripcion->CellAttributes() ?>><span id="el_descripcion">
<input type="text" name="x_descripcion" id="x_descripcion" title="<?php echo $contadores->descripcion->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $contadores->descripcion->EditValue ?>"<?php echo $contadores->descripcion->EditAttributes() ?>>
</span><?php echo $contadores->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->programa->Visible) { // programa ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->programa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $contadores->programa->CellAttributes() ?>><span id="el_programa">
<input type="text" name="x_programa" id="x_programa" title="<?php echo $contadores->programa->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->programa->EditValue ?>"<?php echo $contadores->programa->EditAttributes() ?>>
</span><?php echo $contadores->programa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->diahasta->Visible) { // diahasta ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->diahasta->FldCaption() ?></td>
		<td<?php echo $contadores->diahasta->CellAttributes() ?>><span id="el_diahasta">
<select id="x_diahasta" name="x_diahasta" title="<?php echo $contadores->diahasta->FldTitle() ?>"<?php echo $contadores->diahasta->EditAttributes() ?>>
<?php
if (is_array($contadores->diahasta->EditValue)) {
	$arwrk = $contadores->diahasta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contadores->diahasta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $contadores->diahasta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->objetivo->Visible) { // objetivo ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->objetivo->FldCaption() ?></td>
		<td<?php echo $contadores->objetivo->CellAttributes() ?>><span id="el_objetivo">
<input type="text" name="x_objetivo" id="x_objetivo" title="<?php echo $contadores->objetivo->FldTitle() ?>" size="30" value="<?php echo $contadores->objetivo->EditValue ?>"<?php echo $contadores->objetivo->EditAttributes() ?>>
</span><?php echo $contadores->objetivo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->op2->Visible) { // op2 ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->op2->FldCaption() ?></td>
		<td<?php echo $contadores->op2->CellAttributes() ?>><span id="el_op2">
<input type="text" name="x_op2" id="x_op2" title="<?php echo $contadores->op2->FldTitle() ?>" size="30" value="<?php echo $contadores->op2->EditValue ?>"<?php echo $contadores->op2->EditAttributes() ?>>
</span><?php echo $contadores->op2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->horahasta->Visible) { // horahasta ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->horahasta->FldCaption() ?></td>
		<td<?php echo $contadores->horahasta->CellAttributes() ?>><span id="el_horahasta">
<input type="text" name="x_horahasta" id="x_horahasta" title="<?php echo $contadores->horahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->horahasta->EditValue ?>"<?php echo $contadores->horahasta->EditAttributes() ?>>
</span><?php echo $contadores->horahasta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->material->Visible) { // material ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->material->FldCaption() ?></td>
		<td<?php echo $contadores->material->CellAttributes() ?>><span id="el_material">
<input type="text" name="x_material" id="x_material" title="<?php echo $contadores->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->material->EditValue ?>"<?php echo $contadores->material->EditAttributes() ?>>
</span><?php echo $contadores->material->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contadores->orden->Visible) { // orden ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->orden->FldCaption() ?></td>
		<td<?php echo $contadores->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" title="<?php echo $contadores->orden->FldTitle() ?>" size="30" value="<?php echo $contadores->orden->EditValue ?>"<?php echo $contadores->orden->EditAttributes() ?>>
</span><?php echo $contadores->orden->CustomMsg ?></td>
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
$contadores_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontadores_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'contadores';

	// Page object name
	var $PageObjName = 'contadores_edit';

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
	function ccontadores_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (contadores)
		$GLOBALS["contadores"] = new ccontadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $contadores;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$contadores->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$contadores->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$contadores->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$contadores->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$contadores->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($contadores->id->CurrentValue == "")
			$this->Page_Terminate("contadoreslist.php"); // Invalid key, return to list
		switch ($contadores->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("contadoreslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$contadores->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $contadores->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "contadoresview.php")
						$sReturnUrl = $contadores->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$contadores->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$contadores->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $contadores;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $contadores;
		$contadores->id->setFormValue($objForm->GetValue("x_id"));
		$contadores->op->setFormValue($objForm->GetValue("x_op"));
		$contadores->zona->setFormValue($objForm->GetValue("x_zona"));
		$contadores->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		$contadores->programa->setFormValue($objForm->GetValue("x_programa"));
		$contadores->diahasta->setFormValue($objForm->GetValue("x_diahasta"));
		$contadores->objetivo->setFormValue($objForm->GetValue("x_objetivo"));
		$contadores->op2->setFormValue($objForm->GetValue("x_op2"));
		$contadores->horahasta->setFormValue($objForm->GetValue("x_horahasta"));
		$contadores->material->setFormValue($objForm->GetValue("x_material"));
		$contadores->orden->setFormValue($objForm->GetValue("x_orden"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $contadores;
		$this->LoadRow();
		$contadores->id->CurrentValue = $contadores->id->FormValue;
		$contadores->op->CurrentValue = $contadores->op->FormValue;
		$contadores->zona->CurrentValue = $contadores->zona->FormValue;
		$contadores->descripcion->CurrentValue = $contadores->descripcion->FormValue;
		$contadores->programa->CurrentValue = $contadores->programa->FormValue;
		$contadores->diahasta->CurrentValue = $contadores->diahasta->FormValue;
		$contadores->objetivo->CurrentValue = $contadores->objetivo->FormValue;
		$contadores->op2->CurrentValue = $contadores->op2->FormValue;
		$contadores->horahasta->CurrentValue = $contadores->horahasta->FormValue;
		$contadores->material->CurrentValue = $contadores->material->FormValue;
		$contadores->orden->CurrentValue = $contadores->orden->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contadores;
		$sFilter = $contadores->KeyFilter();

		// Call Row Selecting event
		$contadores->Row_Selecting($sFilter);

		// Load SQL based on filter
		$contadores->CurrentFilter = $sFilter;
		$sSql = $contadores->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$contadores->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $contadores;
		$contadores->id->setDbValue($rs->fields('id'));
		$contadores->op->setDbValue($rs->fields('op'));
		$contadores->zona->setDbValue($rs->fields('zona'));
		$contadores->descripcion->setDbValue($rs->fields('descripcion'));
		$contadores->programa->setDbValue($rs->fields('programa'));
		$contadores->diahasta->setDbValue($rs->fields('diahasta'));
		$contadores->objetivo->setDbValue($rs->fields('objetivo'));
		$contadores->op2->setDbValue($rs->fields('op2'));
		$contadores->horahasta->setDbValue($rs->fields('horahasta'));
		$contadores->material->setDbValue($rs->fields('material'));
		$contadores->orden->setDbValue($rs->fields('orden'));
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
		} elseif ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$contadores->id->EditCustomAttributes = "";
			$contadores->id->EditValue = $contadores->id->CurrentValue;
			$contadores->id->CssStyle = "";
			$contadores->id->CssClass = "";
			$contadores->id->ViewCustomAttributes = "";

			// op
			$contadores->op->EditCustomAttributes = "";
			$contadores->op->EditValue = ew_HtmlEncode($contadores->op->CurrentValue);

			// zona
			$contadores->zona->EditCustomAttributes = "";
			$contadores->zona->EditValue = ew_HtmlEncode($contadores->zona->CurrentValue);

			// descripcion
			$contadores->descripcion->EditCustomAttributes = "";
			$contadores->descripcion->EditValue = ew_HtmlEncode($contadores->descripcion->CurrentValue);

			// programa
			$contadores->programa->EditCustomAttributes = "";
			$contadores->programa->EditValue = ew_HtmlEncode($contadores->programa->CurrentValue);

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

			// objetivo
			$contadores->objetivo->EditCustomAttributes = "";
			$contadores->objetivo->EditValue = ew_HtmlEncode($contadores->objetivo->CurrentValue);

			// op2
			$contadores->op2->EditCustomAttributes = "";
			$contadores->op2->EditValue = ew_HtmlEncode($contadores->op2->CurrentValue);

			// horahasta
			$contadores->horahasta->EditCustomAttributes = "";
			$contadores->horahasta->EditValue = ew_HtmlEncode($contadores->horahasta->CurrentValue);

			// material
			$contadores->material->EditCustomAttributes = "";
			$contadores->material->EditValue = ew_HtmlEncode($contadores->material->CurrentValue);

			// orden
			$contadores->orden->EditCustomAttributes = "";
			$contadores->orden->EditValue = ew_HtmlEncode($contadores->orden->CurrentValue);

			// Edit refer script
			// id

			$contadores->id->HrefValue = "";

			// op
			$contadores->op->HrefValue = "";

			// zona
			$contadores->zona->HrefValue = "";

			// descripcion
			$contadores->descripcion->HrefValue = "";

			// programa
			$contadores->programa->HrefValue = "";

			// diahasta
			$contadores->diahasta->HrefValue = "";

			// objetivo
			$contadores->objetivo->HrefValue = "";

			// op2
			$contadores->op2->HrefValue = "";

			// horahasta
			$contadores->horahasta->HrefValue = "";

			// material
			$contadores->material->HrefValue = "";

			// orden
			$contadores->orden->HrefValue = "";
		}

		// Call Row Rendered event
		if ($contadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contadores->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $contadores;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($contadores->op->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->op->FldErrMsg();
		}
		if (!ew_CheckNumber($contadores->objetivo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->objetivo->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->op2->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->op2->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->orden->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->orden->FldErrMsg();
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $contadores;
		$sFilter = $contadores->KeyFilter();
		$contadores->CurrentFilter = $sFilter;
		$sSql = $contadores->SQL();
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

			// op
			$contadores->op->SetDbValueDef($rsnew, $contadores->op->CurrentValue, NULL, FALSE);

			// zona
			$contadores->zona->SetDbValueDef($rsnew, $contadores->zona->CurrentValue, NULL, FALSE);

			// descripcion
			$contadores->descripcion->SetDbValueDef($rsnew, $contadores->descripcion->CurrentValue, NULL, FALSE);

			// programa
			$contadores->programa->SetDbValueDef($rsnew, $contadores->programa->CurrentValue, "", FALSE);

			// diahasta
			$contadores->diahasta->SetDbValueDef($rsnew, $contadores->diahasta->CurrentValue, NULL, FALSE);

			// objetivo
			$contadores->objetivo->SetDbValueDef($rsnew, $contadores->objetivo->CurrentValue, NULL, FALSE);

			// op2
			$contadores->op2->SetDbValueDef($rsnew, $contadores->op2->CurrentValue, NULL, FALSE);

			// horahasta
			$contadores->horahasta->SetDbValueDef($rsnew, $contadores->horahasta->CurrentValue, NULL, FALSE);

			// material
			$contadores->material->SetDbValueDef($rsnew, $contadores->material->CurrentValue, NULL, FALSE);

			// orden
			$contadores->orden->SetDbValueDef($rsnew, $contadores->orden->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $contadores->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($contadores->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($contadores->CancelMessage <> "") {
					$this->setMessage($contadores->CancelMessage);
					$contadores->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$contadores->Row_Updated($rsold, $rsnew);
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
