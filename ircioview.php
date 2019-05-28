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
$ircio_view = new circio_view();
$Page =& $ircio_view;

// Page init
$ircio_view->Page_Init();

// Page main
$ircio_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($ircio->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var ircio_view = new ew_Page("ircio_view");

// page properties
ircio_view.PageID = "view"; // page ID
ircio_view.FormID = "fircioview"; // form ID
var EW_PAGE_ID = ircio_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
ircio_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
ircio_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ircio_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $ircio->TableCaption() ?>
<br><br>
<?php if ($ircio->Export == "") { ?>
<a href="<?php echo $ircio_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $ircio_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $ircio_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $ircio_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $ircio_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$ircio_view->ShowMessage();
?>
<p>
<?php if ($ircio->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ircio_view->Pager)) $ircio_view->Pager = new cPrevNextPager($ircio_view->lStartRec, $ircio_view->lDisplayRecs, $ircio_view->lTotalRecs) ?>
<?php if ($ircio_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($ircio_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_view->PageUrl() ?>start=<?php echo $ircio_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ircio_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_view->PageUrl() ?>start=<?php echo $ircio_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ircio_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ircio_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_view->PageUrl() ?>start=<?php echo $ircio_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ircio_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_view->PageUrl() ?>start=<?php echo $ircio_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ircio_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($ircio_view->sSrchWhere == "0=101") { ?>
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
<?php if ($ircio->cabecera->Visible) { // cabecera ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->cabecera->FldCaption() ?></td>
		<td<?php echo $ircio->cabecera->CellAttributes() ?>>
<div<?php echo $ircio->cabecera->ViewAttributes() ?>><?php echo $ircio->cabecera->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->orden->Visible) { // orden ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->orden->FldCaption() ?></td>
		<td<?php echo $ircio->orden->CellAttributes() ?>>
<div<?php echo $ircio->orden->ViewAttributes() ?>><?php echo $ircio->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->op->Visible) { // op ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->op->FldCaption() ?></td>
		<td<?php echo $ircio->op->CellAttributes() ?>>
<div<?php echo $ircio->op->ViewAttributes() ?>><?php echo $ircio->op->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->puesto->Visible) { // puesto ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->puesto->FldCaption() ?></td>
		<td<?php echo $ircio->puesto->CellAttributes() ?>>
<div<?php echo $ircio->puesto->ViewAttributes() ?>><?php echo $ircio->puesto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->contrato->Visible) { // contrato ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->contrato->FldCaption() ?></td>
		<td<?php echo $ircio->contrato->CellAttributes() ?>>
<div<?php echo $ircio->contrato->ViewAttributes() ?>><?php echo $ircio->contrato->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->fechacrea->Visible) { // fechacrea ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->fechacrea->FldCaption() ?></td>
		<td<?php echo $ircio->fechacrea->CellAttributes() ?>>
<div<?php echo $ircio->fechacrea->ViewAttributes() ?>><?php echo $ircio->fechacrea->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->horacrea->Visible) { // horacrea ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->horacrea->FldCaption() ?></td>
		<td<?php echo $ircio->horacrea->CellAttributes() ?>>
<div<?php echo $ircio->horacrea->ViewAttributes() ?>><?php echo $ircio->horacrea->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->fechafin->Visible) { // fechafin ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->fechafin->FldCaption() ?></td>
		<td<?php echo $ircio->fechafin->CellAttributes() ?>>
<div<?php echo $ircio->fechafin->ViewAttributes() ?>><?php echo $ircio->fechafin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->horafin->Visible) { // horafin ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->horafin->FldCaption() ?></td>
		<td<?php echo $ircio->horafin->CellAttributes() ?>>
<div<?php echo $ircio->horafin->ViewAttributes() ?>><?php echo $ircio->horafin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($ircio->material->Visible) { // material ?>
	<tr<?php echo $ircio->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ircio->material->FldCaption() ?></td>
		<td<?php echo $ircio->material->CellAttributes() ?>>
<div<?php echo $ircio->material->ViewAttributes() ?>><?php echo $ircio->material->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($ircio->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$ircio_view->Page_Terminate();
?>
<?php

//
// Page class
//
class circio_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'ircio';

	// Page object name
	var $PageObjName = 'ircio_view';

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
	function circio_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (ircio)
		$GLOBALS["ircio"] = new circio();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $Language, $ircio;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["orden"] <> "") {
				$ircio->orden->setQueryStringValue($_GET["orden"]);
				$this->arRecKey["orden"] = $ircio->orden->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}
			if (@$_GET["op"] <> "") {
				$ircio->op->setQueryStringValue($_GET["op"]);
				$this->arRecKey["op"] = $ircio->op->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$ircio->CurrentAction = "I"; // Display form
			switch ($ircio->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("irciolist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($ircio->orden->CurrentValue) == strval($rs->fields('orden')) AND strval($ircio->op->CurrentValue) == strval($rs->fields('op'))) {
								$ircio->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "irciolist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "irciolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$ircio->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $ircio;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$ircio->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$ircio->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $ircio->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$ircio->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$ircio->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$ircio->setStartRecordNumber($this->lStartRec);
		}
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "orden=" . urlencode($ircio->orden->CurrentValue) . "&op=" . urlencode($ircio->op->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "orden=" . urlencode($ircio->orden->CurrentValue) . "&op=" . urlencode($ircio->op->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "orden=" . urlencode($ircio->orden->CurrentValue) . "&op=" . urlencode($ircio->op->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "orden=" . urlencode($ircio->orden->CurrentValue) . "&op=" . urlencode($ircio->op->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "orden=" . urlencode($ircio->orden->CurrentValue) . "&op=" . urlencode($ircio->op->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "orden=" . urlencode($ircio->orden->CurrentValue) . "&op=" . urlencode($ircio->op->CurrentValue);
		$this->AddUrl = $ircio->AddUrl();
		$this->EditUrl = $ircio->EditUrl();
		$this->CopyUrl = $ircio->CopyUrl();
		$this->DeleteUrl = $ircio->DeleteUrl();
		$this->ListUrl = $ircio->ListUrl();

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
