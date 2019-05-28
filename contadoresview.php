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
$contadores_view = new ccontadores_view();
$Page =& $contadores_view;

// Page init
$contadores_view->Page_Init();

// Page main
$contadores_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($contadores->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var contadores_view = new ew_Page("contadores_view");

// page properties
contadores_view.PageID = "view"; // page ID
contadores_view.FormID = "fcontadoresview"; // form ID
var EW_PAGE_ID = contadores_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contadores_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contadores_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contadores_view.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contadores->TableCaption() ?>
<br><br>
<?php if ($contadores->Export == "") { ?>
<a href="<?php echo $contadores_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $contadores_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $contadores_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $contadores_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $contadores_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$contadores_view->ShowMessage();
?>
<p>
<?php if ($contadores->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($contadores_view->Pager)) $contadores_view->Pager = new cPrevNextPager($contadores_view->lStartRec, $contadores_view->lDisplayRecs, $contadores_view->lTotalRecs) ?>
<?php if ($contadores_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($contadores_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_view->PageUrl() ?>start=<?php echo $contadores_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($contadores_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_view->PageUrl() ?>start=<?php echo $contadores_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $contadores_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($contadores_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_view->PageUrl() ?>start=<?php echo $contadores_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($contadores_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_view->PageUrl() ?>start=<?php echo $contadores_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contadores_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($contadores_view->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($contadores->id->Visible) { // id ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->id->FldCaption() ?></td>
		<td<?php echo $contadores->id->CellAttributes() ?>>
<div<?php echo $contadores->id->ViewAttributes() ?>><?php echo $contadores->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->op->Visible) { // op ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->op->FldCaption() ?></td>
		<td<?php echo $contadores->op->CellAttributes() ?>>
<div<?php echo $contadores->op->ViewAttributes() ?>><?php echo $contadores->op->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->zona->Visible) { // zona ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->zona->FldCaption() ?></td>
		<td<?php echo $contadores->zona->CellAttributes() ?>>
<div<?php echo $contadores->zona->ViewAttributes() ?>><?php echo $contadores->zona->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->descripcion->Visible) { // descripcion ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->descripcion->FldCaption() ?></td>
		<td<?php echo $contadores->descripcion->CellAttributes() ?>>
<div<?php echo $contadores->descripcion->ViewAttributes() ?>><?php echo $contadores->descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->programa->Visible) { // programa ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->programa->FldCaption() ?></td>
		<td<?php echo $contadores->programa->CellAttributes() ?>>
<div<?php echo $contadores->programa->ViewAttributes() ?>><?php echo $contadores->programa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->diahasta->Visible) { // diahasta ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->diahasta->FldCaption() ?></td>
		<td<?php echo $contadores->diahasta->CellAttributes() ?>>
<div<?php echo $contadores->diahasta->ViewAttributes() ?>><?php echo $contadores->diahasta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->objetivo->Visible) { // objetivo ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->objetivo->FldCaption() ?></td>
		<td<?php echo $contadores->objetivo->CellAttributes() ?>>
<div<?php echo $contadores->objetivo->ViewAttributes() ?>><?php echo $contadores->objetivo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->op2->Visible) { // op2 ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->op2->FldCaption() ?></td>
		<td<?php echo $contadores->op2->CellAttributes() ?>>
<div<?php echo $contadores->op2->ViewAttributes() ?>><?php echo $contadores->op2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->horahasta->Visible) { // horahasta ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->horahasta->FldCaption() ?></td>
		<td<?php echo $contadores->horahasta->CellAttributes() ?>>
<div<?php echo $contadores->horahasta->ViewAttributes() ?>><?php echo $contadores->horahasta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->material->Visible) { // material ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->material->FldCaption() ?></td>
		<td<?php echo $contadores->material->CellAttributes() ?>>
<div<?php echo $contadores->material->ViewAttributes() ?>><?php echo $contadores->material->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contadores->orden->Visible) { // orden ?>
	<tr<?php echo $contadores->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contadores->orden->FldCaption() ?></td>
		<td<?php echo $contadores->orden->CellAttributes() ?>>
<div<?php echo $contadores->orden->ViewAttributes() ?>><?php echo $contadores->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($contadores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$contadores_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontadores_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'contadores';

	// Page object name
	var $PageObjName = 'contadores_view';

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
	function ccontadores_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (contadores)
		$GLOBALS["contadores"] = new ccontadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $contadores;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$contadores->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $contadores->id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$contadores->CurrentAction = "I"; // Display form
			switch ($contadores->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("contadoreslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($contadores->id->CurrentValue) == strval($rs->fields('id'))) {
								$contadores->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "contadoreslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "contadoreslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$contadores->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $contadores;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$contadores->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$contadores->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $contadores->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$contadores->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$contadores->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$contadores->setStartRecordNumber($this->lStartRec);
		}
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($contadores->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($contadores->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($contadores->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($contadores->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($contadores->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($contadores->id->CurrentValue);
		$this->AddUrl = $contadores->AddUrl();
		$this->EditUrl = $contadores->EditUrl();
		$this->CopyUrl = $contadores->CopyUrl();
		$this->DeleteUrl = $contadores->DeleteUrl();
		$this->ListUrl = $contadores->ListUrl();

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
