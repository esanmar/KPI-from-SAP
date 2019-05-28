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
$contadores_delete = new ccontadores_delete();
$Page =& $contadores_delete;

// Page init
$contadores_delete->Page_Init();

// Page main
$contadores_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contadores_delete = new ew_Page("contadores_delete");

// page properties
contadores_delete.PageID = "delete"; // page ID
contadores_delete.FormID = "fcontadoresdelete"; // form ID
var EW_PAGE_ID = contadores_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contadores_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contadores_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contadores_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $contadores_delete->LoadRecordset())
	$contadores_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($contadores_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$contadores_delete->Page_Terminate("contadoreslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contadores->TableCaption() ?><br><br>
<a href="<?php echo $contadores->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$contadores_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="contadores">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($contadores_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $contadores->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $contadores->id->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->op->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->zona->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->descripcion->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->programa->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->diahasta->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->objetivo->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->op2->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->horahasta->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->material->FldCaption() ?></td>
		<td valign="top"><?php echo $contadores->orden->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$contadores_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$contadores_delete->lRecCnt++;

	// Set row properties
	$contadores->CssClass = "";
	$contadores->CssStyle = "";
	$contadores->RowAttrs = array();
	$contadores->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$contadores_delete->LoadRowValues($rs);

	// Render row
	$contadores_delete->RenderRow();
?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td<?php echo $contadores->id->CellAttributes() ?>>
<div<?php echo $contadores->id->ViewAttributes() ?>><?php echo $contadores->id->ListViewValue() ?></div></td>
		<td<?php echo $contadores->op->CellAttributes() ?>>
<div<?php echo $contadores->op->ViewAttributes() ?>><?php echo $contadores->op->ListViewValue() ?></div></td>
		<td<?php echo $contadores->zona->CellAttributes() ?>>
<div<?php echo $contadores->zona->ViewAttributes() ?>><?php echo $contadores->zona->ListViewValue() ?></div></td>
		<td<?php echo $contadores->descripcion->CellAttributes() ?>>
<div<?php echo $contadores->descripcion->ViewAttributes() ?>><?php echo $contadores->descripcion->ListViewValue() ?></div></td>
		<td<?php echo $contadores->programa->CellAttributes() ?>>
<div<?php echo $contadores->programa->ViewAttributes() ?>><?php echo $contadores->programa->ListViewValue() ?></div></td>
		<td<?php echo $contadores->diahasta->CellAttributes() ?>>
<div<?php echo $contadores->diahasta->ViewAttributes() ?>><?php echo $contadores->diahasta->ListViewValue() ?></div></td>
		<td<?php echo $contadores->objetivo->CellAttributes() ?>>
<div<?php echo $contadores->objetivo->ViewAttributes() ?>><?php echo $contadores->objetivo->ListViewValue() ?></div></td>
		<td<?php echo $contadores->op2->CellAttributes() ?>>
<div<?php echo $contadores->op2->ViewAttributes() ?>><?php echo $contadores->op2->ListViewValue() ?></div></td>
		<td<?php echo $contadores->horahasta->CellAttributes() ?>>
<div<?php echo $contadores->horahasta->ViewAttributes() ?>><?php echo $contadores->horahasta->ListViewValue() ?></div></td>
		<td<?php echo $contadores->material->CellAttributes() ?>>
<div<?php echo $contadores->material->ViewAttributes() ?>><?php echo $contadores->material->ListViewValue() ?></div></td>
		<td<?php echo $contadores->orden->CellAttributes() ?>>
<div<?php echo $contadores->orden->ViewAttributes() ?>><?php echo $contadores->orden->ListViewValue() ?></div></td>
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
$contadores_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontadores_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'contadores';

	// Page object name
	var $PageObjName = 'contadores_delete';

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
	function ccontadores_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (contadores)
		$GLOBALS["contadores"] = new ccontadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $contadores;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$contadores->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($contadores->id->QueryStringValue))
				$this->Page_Terminate("contadoreslist.php"); // Prevent SQL injection, exit
			$sKey .= $contadores->id->QueryStringValue;
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
			$this->Page_Terminate("contadoreslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("contadoreslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in contadores class, contadoresinfo.php

		$contadores->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$contadores->CurrentAction = $_POST["a_delete"];
		} else {
			$contadores->CurrentAction = "I"; // Display record
		}
		switch ($contadores->CurrentAction) {
			case "D": // Delete
				$contadores->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($contadores->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $contadores;
		$DeleteRows = TRUE;
		$sWrkFilter = $contadores->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in contadores class, contadoresinfo.php

		$contadores->CurrentFilter = $sWrkFilter;
		$sSql = $contadores->SQL();
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
				$DeleteRows = $contadores->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($contadores->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($contadores->CancelMessage <> "") {
				$this->setMessage($contadores->CancelMessage);
				$contadores->CancelMessage = "";
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
				$contadores->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $contadores;

		// Call Recordset Selecting event
		$contadores->Recordset_Selecting($contadores->CurrentFilter);

		// Load List page SQL
		$sSql = $contadores->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$contadores->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($contadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contadores->Row_Rendered();
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
