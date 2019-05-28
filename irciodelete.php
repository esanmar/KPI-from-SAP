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
$ircio_delete = new circio_delete();
$Page =& $ircio_delete;

// Page init
$ircio_delete->Page_Init();

// Page main
$ircio_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ircio_delete = new ew_Page("ircio_delete");

// page properties
ircio_delete.PageID = "delete"; // page ID
ircio_delete.FormID = "firciodelete"; // form ID
var EW_PAGE_ID = ircio_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
ircio_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
ircio_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ircio_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $ircio_delete->LoadRecordset())
	$ircio_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($ircio_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$ircio_delete->Page_Terminate("irciolist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $ircio->TableCaption() ?><br><br>
<a href="<?php echo $ircio->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$ircio_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="ircio">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($ircio_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $ircio->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $ircio->cabecera->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->orden->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->op->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->puesto->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->contrato->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->fechacrea->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->horacrea->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->fechafin->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->horafin->FldCaption() ?></td>
		<td valign="top"><?php echo $ircio->material->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$ircio_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$ircio_delete->lRecCnt++;

	// Set row properties
	$ircio->CssClass = "";
	$ircio->CssStyle = "";
	$ircio->RowAttrs = array();
	$ircio->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$ircio_delete->LoadRowValues($rs);

	// Render row
	$ircio_delete->RenderRow();
?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td<?php echo $ircio->cabecera->CellAttributes() ?>>
<div<?php echo $ircio->cabecera->ViewAttributes() ?>><?php echo $ircio->cabecera->ListViewValue() ?></div></td>
		<td<?php echo $ircio->orden->CellAttributes() ?>>
<div<?php echo $ircio->orden->ViewAttributes() ?>><?php echo $ircio->orden->ListViewValue() ?></div></td>
		<td<?php echo $ircio->op->CellAttributes() ?>>
<div<?php echo $ircio->op->ViewAttributes() ?>><?php echo $ircio->op->ListViewValue() ?></div></td>
		<td<?php echo $ircio->puesto->CellAttributes() ?>>
<div<?php echo $ircio->puesto->ViewAttributes() ?>><?php echo $ircio->puesto->ListViewValue() ?></div></td>
		<td<?php echo $ircio->contrato->CellAttributes() ?>>
<div<?php echo $ircio->contrato->ViewAttributes() ?>><?php echo $ircio->contrato->ListViewValue() ?></div></td>
		<td<?php echo $ircio->fechacrea->CellAttributes() ?>>
<div<?php echo $ircio->fechacrea->ViewAttributes() ?>><?php echo $ircio->fechacrea->ListViewValue() ?></div></td>
		<td<?php echo $ircio->horacrea->CellAttributes() ?>>
<div<?php echo $ircio->horacrea->ViewAttributes() ?>><?php echo $ircio->horacrea->ListViewValue() ?></div></td>
		<td<?php echo $ircio->fechafin->CellAttributes() ?>>
<div<?php echo $ircio->fechafin->ViewAttributes() ?>><?php echo $ircio->fechafin->ListViewValue() ?></div></td>
		<td<?php echo $ircio->horafin->CellAttributes() ?>>
<div<?php echo $ircio->horafin->ViewAttributes() ?>><?php echo $ircio->horafin->ListViewValue() ?></div></td>
		<td<?php echo $ircio->material->CellAttributes() ?>>
<div<?php echo $ircio->material->ViewAttributes() ?>><?php echo $ircio->material->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$ircio_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class circio_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'ircio';

	// Page object name
	var $PageObjName = 'ircio_delete';

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
	function circio_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (ircio)
		$GLOBALS["ircio"] = new circio();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $ircio;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["orden"] <> "") {
			$ircio->orden->setQueryStringValue($_GET["orden"]);
			$sKey .= $ircio->orden->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["op"] <> "") {
			$ircio->op->setQueryStringValue($_GET["op"]);
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $ircio->op->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("irciolist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";
			$arKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, trim($sKey)); // Split key by separator
			if (count($arKeyFlds) <> 2)
				$this->Page_Terminate($ircio->getReturnUrl()); // Invalid key, exit

			// Set up key field
			$sKeyFld = $arKeyFlds[0];
			$sFilter .= "`orden`='" . ew_AdjustSql($sKeyFld) . "' AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[1];
			$sFilter .= "`op`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in ircio class, ircioinfo.php

		$ircio->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$ircio->CurrentAction = $_POST["a_delete"];
		} else {
			$ircio->CurrentAction = "I"; // Display record
		}
		switch ($ircio->CurrentAction) {
			case "D": // Delete
				$ircio->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($ircio->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $ircio;
		$DeleteRows = TRUE;
		$sWrkFilter = $ircio->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in ircio class, ircioinfo.php

		$ircio->CurrentFilter = $sWrkFilter;
		$sSql = $ircio->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $ircio->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['orden'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['op'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($ircio->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($ircio->CancelMessage <> "") {
				$this->setMessage($ircio->CancelMessage);
				$ircio->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$ircio->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $ircio;

		// Call Recordset Selecting event
		$ircio->Recordset_Selecting($ircio->CurrentFilter);

		// Load List page SQL
		$sSql = $ircio->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$ircio->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($ircio->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$ircio->Row_Rendered();
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
}
?>
