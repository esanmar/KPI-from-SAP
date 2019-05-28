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
$calculo_view = new ccalculo_view();
$Page =& $calculo_view;

// Page init
$calculo_view->Page_Init();

// Page main
$calculo_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($calculo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var calculo_view = new ew_Page("calculo_view");

// page properties
calculo_view.PageID = "view"; // page ID
calculo_view.FormID = "fcalculoview"; // form ID
var EW_PAGE_ID = calculo_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
calculo_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calculo_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calculo_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calculo->TableCaption() ?>
<br><br>
<?php if ($calculo->Export == "") { ?>
<a href="<?php echo $calculo_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $calculo_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $calculo_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $calculo_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $calculo_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$calculo_view->ShowMessage();
?>
<p>
<?php if ($calculo->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($calculo_view->Pager)) $calculo_view->Pager = new cPrevNextPager($calculo_view->lStartRec, $calculo_view->lDisplayRecs, $calculo_view->lTotalRecs) ?>
<?php if ($calculo_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($calculo_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_view->PageUrl() ?>start=<?php echo $calculo_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($calculo_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_view->PageUrl() ?>start=<?php echo $calculo_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $calculo_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($calculo_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_view->PageUrl() ?>start=<?php echo $calculo_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($calculo_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_view->PageUrl() ?>start=<?php echo $calculo_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $calculo_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($calculo_view->sSrchWhere == "0=101") { ?>
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
<?php if ($calculo->fechahoy->Visible) { // fechahoy ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->fechahoy->FldCaption() ?></td>
		<td<?php echo $calculo->fechahoy->CellAttributes() ?>>
<div<?php echo $calculo->fechahoy->ViewAttributes() ?>><?php echo $calculo->fechahoy->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calculo->fechahasta->Visible) { // fechahasta ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->fechahasta->FldCaption() ?></td>
		<td<?php echo $calculo->fechahasta->CellAttributes() ?>>
<div<?php echo $calculo->fechahasta->ViewAttributes() ?>><?php echo $calculo->fechahasta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calculo->diasresta->Visible) { // diasresta ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diasresta->FldCaption() ?></td>
		<td<?php echo $calculo->diasresta->CellAttributes() ?>>
<div<?php echo $calculo->diasresta->ViewAttributes() ?>><?php echo $calculo->diasresta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calculo->diaslleva->Visible) { // diaslleva ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diaslleva->FldCaption() ?></td>
		<td<?php echo $calculo->diaslleva->CellAttributes() ?>>
<div<?php echo $calculo->diaslleva->ViewAttributes() ?>><?php echo $calculo->diaslleva->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calculo->diasllevalab->Visible) { // diasllevalab ?>
	<tr<?php echo $calculo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calculo->diasllevalab->FldCaption() ?></td>
		<td<?php echo $calculo->diasllevalab->CellAttributes() ?>>
<div<?php echo $calculo->diasllevalab->ViewAttributes() ?>><?php echo $calculo->diasllevalab->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($calculo->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$calculo_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalculo_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'calculo';

	// Page object name
	var $PageObjName = 'calculo_view';

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
	function ccalculo_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (calculo)
		$GLOBALS["calculo"] = new ccalculo();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $Language, $calculo;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["fechahoy"] <> "") {
				$calculo->fechahoy->setQueryStringValue($_GET["fechahoy"]);
				$this->arRecKey["fechahoy"] = $calculo->fechahoy->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}
			if (@$_GET["fechahasta"] <> "") {
				$calculo->fechahasta->setQueryStringValue($_GET["fechahasta"]);
				$this->arRecKey["fechahasta"] = $calculo->fechahasta->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$calculo->CurrentAction = "I"; // Display form
			switch ($calculo->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("calculolist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($calculo->fechahoy->CurrentValue) == strval($rs->fields('fechahoy')) AND strval($calculo->fechahasta->CurrentValue) == strval($rs->fields('fechahasta'))) {
								$calculo->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "calculolist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "calculolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$calculo->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $calculo;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$calculo->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$calculo->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $calculo->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$calculo->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$calculo->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$calculo->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $calculo;

		// Call Recordset Selecting event
		$calculo->Recordset_Selecting($calculo->CurrentFilter);

		// Load List page SQL
		$sSql = $calculo->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$calculo->Recordset_Selected($rs);
		return $rs;
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "fechahoy=" . urlencode($calculo->fechahoy->CurrentValue) . "&fechahasta=" . urlencode($calculo->fechahasta->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "fechahoy=" . urlencode($calculo->fechahoy->CurrentValue) . "&fechahasta=" . urlencode($calculo->fechahasta->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "fechahoy=" . urlencode($calculo->fechahoy->CurrentValue) . "&fechahasta=" . urlencode($calculo->fechahasta->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "fechahoy=" . urlencode($calculo->fechahoy->CurrentValue) . "&fechahasta=" . urlencode($calculo->fechahasta->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "fechahoy=" . urlencode($calculo->fechahoy->CurrentValue) . "&fechahasta=" . urlencode($calculo->fechahasta->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "fechahoy=" . urlencode($calculo->fechahoy->CurrentValue) . "&fechahasta=" . urlencode($calculo->fechahasta->CurrentValue);
		$this->AddUrl = $calculo->AddUrl();
		$this->EditUrl = $calculo->EditUrl();
		$this->CopyUrl = $calculo->CopyUrl();
		$this->DeleteUrl = $calculo->DeleteUrl();
		$this->ListUrl = $calculo->ListUrl();

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
		}

		// Call Row Rendered event
		if ($calculo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calculo->Row_Rendered();
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
