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
$calculo_list = new ccalculo_list();
$Page =& $calculo_list;

// Page init
$calculo_list->Page_Init();

// Page main
$calculo_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($calculo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var calculo_list = new ew_Page("calculo_list");

// page properties
calculo_list.PageID = "list"; // page ID
calculo_list.FormID = "fcalculolist"; // form ID
var EW_PAGE_ID = calculo_list.PageID; // for backward compatibility

// extend page with ValidateForm function
calculo_list.ValidateForm = function(fobj) {
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
calculo_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calculo_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calculo_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($calculo->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$calculo_list->lTotalRecs = $calculo->SelectRecordCount();
	} else {
		if ($rs = $calculo_list->LoadRecordset())
			$calculo_list->lTotalRecs = $rs->RecordCount();
	}
	$calculo_list->lStartRec = 1;
	if ($calculo_list->lDisplayRecs <= 0 || ($calculo->Export <> "" && $calculo->ExportAll)) // Display all records
		$calculo_list->lDisplayRecs = $calculo_list->lTotalRecs;
	if (!($calculo->Export <> "" && $calculo->ExportAll))
		$calculo_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $calculo_list->LoadRecordset($calculo_list->lStartRec-1, $calculo_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calculo->TableCaption() ?>
<?php if ($calculo->Export == "" && $calculo->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $calculo_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $calculo_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $calculo_list->ExportWordUrl ?>"><?php echo $Language->Phrase("ExportToWord") ?></a>
<?php } ?>
</span></p>
<?php if ($calculo->Export == "" && $calculo->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(calculo_list);" style="text-decoration: none;"><img id="calculo_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="calculo_list_SearchPanel">
<form name="fcalculolistsrch" id="fcalculolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="calculo">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $calculo_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="calculosrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$calculo_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($calculo->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($calculo->CurrentAction <> "gridadd" && $calculo->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($calculo_list->Pager)) $calculo_list->Pager = new cPrevNextPager($calculo_list->lStartRec, $calculo_list->lDisplayRecs, $calculo_list->lTotalRecs) ?>
<?php if ($calculo_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($calculo_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_list->PageUrl() ?>start=<?php echo $calculo_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($calculo_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_list->PageUrl() ?>start=<?php echo $calculo_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $calculo_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($calculo_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_list->PageUrl() ?>start=<?php echo $calculo_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($calculo_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $calculo_list->PageUrl() ?>start=<?php echo $calculo_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $calculo_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $calculo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $calculo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $calculo_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($calculo_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($calculo->CurrentAction <> "gridadd" && $calculo->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<a href="<?php echo $calculo_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($calculo_list->lTotalRecs > 0) { ?>
<a href="<?php echo $calculo_list->GridEditUrl ?>"><?php echo $Language->Phrase("GridEditLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($calculo->CurrentAction == "gridedit") { ?>
<a href="" onclick="f=document.fcalculolist;if(calculo_list.ValidateForm(f))f.submit();return false;"><?php echo $Language->Phrase("GridSaveLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $calculo_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fcalculolist" id="fcalculolist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="calculo">
<div id="gmp_calculo" class="ewGridMiddlePanel">
<?php if ($calculo_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $calculo->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$calculo_list->RenderListOptions();

// Render list options (header, left)
$calculo_list->ListOptions->Render("header", "left");
?>
<?php if ($calculo->fechahoy->Visible) { // fechahoy ?>
	<?php if ($calculo->SortUrl($calculo->fechahoy) == "") { ?>
		<td><?php echo $calculo->fechahoy->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calculo->SortUrl($calculo->fechahoy) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calculo->fechahoy->FldCaption() ?></td><td style="width: 10px;"><?php if ($calculo->fechahoy->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calculo->fechahoy->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calculo->fechahasta->Visible) { // fechahasta ?>
	<?php if ($calculo->SortUrl($calculo->fechahasta) == "") { ?>
		<td><?php echo $calculo->fechahasta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calculo->SortUrl($calculo->fechahasta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calculo->fechahasta->FldCaption() ?></td><td style="width: 10px;"><?php if ($calculo->fechahasta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calculo->fechahasta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calculo->diasresta->Visible) { // diasresta ?>
	<?php if ($calculo->SortUrl($calculo->diasresta) == "") { ?>
		<td><?php echo $calculo->diasresta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calculo->SortUrl($calculo->diasresta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calculo->diasresta->FldCaption() ?></td><td style="width: 10px;"><?php if ($calculo->diasresta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calculo->diasresta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calculo->diaslleva->Visible) { // diaslleva ?>
	<?php if ($calculo->SortUrl($calculo->diaslleva) == "") { ?>
		<td><?php echo $calculo->diaslleva->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calculo->SortUrl($calculo->diaslleva) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calculo->diaslleva->FldCaption() ?></td><td style="width: 10px;"><?php if ($calculo->diaslleva->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calculo->diaslleva->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calculo->diasllevalab->Visible) { // diasllevalab ?>
	<?php if ($calculo->SortUrl($calculo->diasllevalab) == "") { ?>
		<td><?php echo $calculo->diasllevalab->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calculo->SortUrl($calculo->diasllevalab) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calculo->diasllevalab->FldCaption() ?></td><td style="width: 10px;"><?php if ($calculo->diasllevalab->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calculo->diasllevalab->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$calculo_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($calculo->ExportAll && $calculo->Export <> "") {
	$calculo_list->lStopRec = $calculo_list->lTotalRecs;
} else {
	$calculo_list->lStopRec = $calculo_list->lStartRec + $calculo_list->lDisplayRecs - 1; // Set the last record to display
}
$calculo_list->lRecCount = $calculo_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $calculo_list->lStartRec > 1)
		$rs->Move($calculo_list->lStartRec - 1);
}

// Initialize aggregate
$calculo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$calculo_list->RenderRow();
$calculo_list->lRowCnt = 0;
$calculo_list->lEditRowCnt = 0;
if ($calculo->CurrentAction == "edit")
	$calculo_list->lRowIndex = 1;
if ($calculo->CurrentAction == "gridedit")
	$calculo_list->lRowIndex = 0;
while (($calculo->CurrentAction == "gridadd" || !$rs->EOF) &&
	$calculo_list->lRecCount < $calculo_list->lStopRec) {
	$calculo_list->lRecCount++;
	if (intval($calculo_list->lRecCount) >= intval($calculo_list->lStartRec)) {
		$calculo_list->lRowCnt++;
		if ($calculo->CurrentAction == "gridadd" || $calculo->CurrentAction == "gridedit")
			$calculo_list->lRowIndex++;

	// Init row class and style
	$calculo->CssClass = "";
	$calculo->CssStyle = "";
	$calculo->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($calculo->CurrentAction == "gridadd") {
		$calculo_list->LoadDefaultValues(); // Load default values
	} else {
		$calculo_list->LoadRowValues($rs); // Load row values
	}
	$calculo->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($calculo->CurrentAction == "edit") {
		if ($calculo_list->CheckInlineEditKey() && $calculo_list->lEditRowCnt == 0) { // Inline edit
			$calculo->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($calculo->CurrentAction == "gridedit") { // Grid edit
		$calculo->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($calculo->RowType == EW_ROWTYPE_EDIT && $calculo->EventCancelled) { // Update failed
		if ($calculo->CurrentAction == "edit")
			$calculo_list->RestoreFormValues(); // Restore form values
		if ($calculo->CurrentAction == "gridedit")
			$calculo_list->RestoreCurrentRowFormValues($calculo_list->lRowIndex); // Restore form values
	}
	if ($calculo->RowType == EW_ROWTYPE_EDIT) // Edit row
		$calculo_list->lEditRowCnt++;
	if ($calculo->RowType == EW_ROWTYPE_ADD || $calculo->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$calculo->RowAttrs = array_merge($calculo->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$calculo->CssClass = "ewTableEditRow";
	}

	// Render row
	$calculo_list->RenderRow();

	// Render list options
	$calculo_list->RenderListOptions();
?>
	<tr<?php echo $calculo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$calculo_list->ListOptions->Render("body", "left");
?>
	<?php if ($calculo->fechahoy->Visible) { // fechahoy ?>
		<td<?php echo $calculo->fechahoy->CellAttributes() ?>>
<?php if ($calculo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $calculo->fechahoy->ViewAttributes() ?>><?php echo $calculo->fechahoy->EditValue ?></div><input type="hidden" name="x<?php echo $calculo_list->lRowIndex ?>_fechahoy" id="x<?php echo $calculo_list->lRowIndex ?>_fechahoy" value="<?php echo ew_HtmlEncode($calculo->fechahoy->CurrentValue) ?>">
<?php } ?>
<?php if ($calculo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $calculo->fechahoy->ViewAttributes() ?>><?php echo $calculo->fechahoy->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($calculo->fechahasta->Visible) { // fechahasta ?>
		<td<?php echo $calculo->fechahasta->CellAttributes() ?>>
<?php if ($calculo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $calculo->fechahasta->ViewAttributes() ?>><?php echo $calculo->fechahasta->EditValue ?></div><input type="hidden" name="x<?php echo $calculo_list->lRowIndex ?>_fechahasta" id="x<?php echo $calculo_list->lRowIndex ?>_fechahasta" value="<?php echo ew_HtmlEncode($calculo->fechahasta->CurrentValue) ?>">
<?php } ?>
<?php if ($calculo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $calculo->fechahasta->ViewAttributes() ?>><?php echo $calculo->fechahasta->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($calculo->diasresta->Visible) { // diasresta ?>
		<td<?php echo $calculo->diasresta->CellAttributes() ?>>
<?php if ($calculo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $calculo_list->lRowIndex ?>_diasresta" id="x<?php echo $calculo_list->lRowIndex ?>_diasresta" title="<?php echo $calculo->diasresta->FldTitle() ?>" size="30" value="<?php echo $calculo->diasresta->EditValue ?>"<?php echo $calculo->diasresta->EditAttributes() ?>>
<?php } ?>
<?php if ($calculo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $calculo->diasresta->ViewAttributes() ?>><?php echo $calculo->diasresta->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($calculo->diaslleva->Visible) { // diaslleva ?>
		<td<?php echo $calculo->diaslleva->CellAttributes() ?>>
<?php if ($calculo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $calculo_list->lRowIndex ?>_diaslleva" id="x<?php echo $calculo_list->lRowIndex ?>_diaslleva" title="<?php echo $calculo->diaslleva->FldTitle() ?>" size="30" value="<?php echo $calculo->diaslleva->EditValue ?>"<?php echo $calculo->diaslleva->EditAttributes() ?>>
<?php } ?>
<?php if ($calculo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $calculo->diaslleva->ViewAttributes() ?>><?php echo $calculo->diaslleva->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($calculo->diasllevalab->Visible) { // diasllevalab ?>
		<td<?php echo $calculo->diasllevalab->CellAttributes() ?>>
<?php if ($calculo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $calculo_list->lRowIndex ?>_diasllevalab" id="x<?php echo $calculo_list->lRowIndex ?>_diasllevalab" title="<?php echo $calculo->diasllevalab->FldTitle() ?>" size="30" value="<?php echo $calculo->diasllevalab->EditValue ?>"<?php echo $calculo->diasllevalab->EditAttributes() ?>>
<?php } ?>
<?php if ($calculo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $calculo->diasllevalab->ViewAttributes() ?>><?php echo $calculo->diasllevalab->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$calculo_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($calculo->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($calculo->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($calculo->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $calculo_list->lRowIndex ?>">
<?php } ?>
<?php if ($calculo->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $calculo_list->lRowIndex ?>">
<?php echo $calculo_list->sMultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</td></tr></table>
<?php if ($calculo->Export == "" && $calculo->CurrentAction == "") { ?>
<?php } ?>
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
$calculo_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalculo_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'calculo';

	// Page object name
	var $PageObjName = 'calculo_list';

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
	function ccalculo_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (calculo)
		$GLOBALS["calculo"] = new ccalculo();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["calculo"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "calculodelete.php";
		$this->MultiUpdateUrl = "calculoupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'calculo', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $calculo;

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$calculo->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$calculo->Export = $_POST["exporttype"];
		} else {
			$calculo->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $calculo->Export; // Get export parameter, used in header
		$gsExportFile = $calculo->TableVar; // Get export file, used in header
		if (in_array($calculo->Export, array("html", "email", "excel", "word")))
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		if ($calculo->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel;charset=utf-8');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($calculo->Export == "word") {
			header('Content-Type: application/vnd.ms-word;charset=utf-8');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 50;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $calculo;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$calculo->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($calculo->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($calculo->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($calculo->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$calculo->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($calculo->CurrentAction == "gridupdate" || $calculo->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if (($calculo->CurrentAction == "update" || $calculo->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$calculo->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($calculo->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $calculo->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 50; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$calculo->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$calculo->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$calculo->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $calculo->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$calculo->setSessionWhere($sFilter);
		$calculo->CurrentFilter = "";

		// Export data only
		if (in_array($calculo->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($calculo->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $calculo;
		$calculo->setKey("fechahoy", ""); // Clear inline edit key
		$calculo->setKey("fechahasta", ""); // Clear inline edit key
		$calculo->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $calculo;
		$bInlineEdit = TRUE;
		if (@$_GET["fechahoy"] <> "") {
			$calculo->fechahoy->setQueryStringValue($_GET["fechahoy"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["fechahasta"] <> "") {
			$calculo->fechahasta->setQueryStringValue($_GET["fechahasta"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$calculo->setKey("fechahoy", $calculo->fechahoy->CurrentValue); // Set up inline edit key
				$calculo->setKey("fechahasta", $calculo->fechahasta->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $calculo;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$calculo->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$calculo->EventCancelled = TRUE; // Cancel event
			$calculo->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $calculo;

		//CheckInlineEditKey = True
		if (strval($calculo->getKey("fechahoy")) <> strval($calculo->fechahoy->CurrentValue))
			return FALSE;
		if (strval($calculo->getKey("fechahasta")) <> strval($calculo->fechahasta->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $calculo;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$calculo->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $calculo->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values and keys
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$calculo->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$calculo->EventCancelled = TRUE; // Set event cancelled
			$calculo->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $calculo;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $calculo->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $calculo;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 2) {
			$calculo->fechahoy->setFormValue($arrKeyFlds[0]);
			$calculo->fechahasta->setFormValue($arrKeyFlds[1]);
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $calculo;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($calculo->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($calculo->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 2) {
				if (strval($arrKeyFlds[0]) == strval($calculo->fechahoy->CurrentValue) && 
				strval($arrKeyFlds[1]) == strval($calculo->fechahasta->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $calculo;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $calculo->fechahoy, FALSE); // fechahoy
		$this->BuildSearchSql($sWhere, $calculo->fechahasta, FALSE); // fechahasta
		$this->BuildSearchSql($sWhere, $calculo->diasresta, FALSE); // diasresta
		$this->BuildSearchSql($sWhere, $calculo->diaslleva, FALSE); // diaslleva
		$this->BuildSearchSql($sWhere, $calculo->diasllevalab, FALSE); // diasllevalab

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($calculo->fechahoy); // fechahoy
			$this->SetSearchParm($calculo->fechahasta); // fechahasta
			$this->SetSearchParm($calculo->diasresta); // diasresta
			$this->SetSearchParm($calculo->diaslleva); // diaslleva
			$this->SetSearchParm($calculo->diasllevalab); // diasllevalab
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $calculo;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$calculo->setAdvancedSearch("x_$FldParm", $FldVal);
		$calculo->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$calculo->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$calculo->setAdvancedSearch("y_$FldParm", $FldVal2);
		$calculo->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $calculo;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $calculo->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $calculo->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $calculo->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $calculo->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $calculo->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $calculo;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$calculo->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $calculo;
		$calculo->setAdvancedSearch("x_fechahoy", "");
		$calculo->setAdvancedSearch("z_fechahoy", "");
		$calculo->setAdvancedSearch("y_fechahoy", "");
		$calculo->setAdvancedSearch("x_fechahasta", "");
		$calculo->setAdvancedSearch("z_fechahasta", "");
		$calculo->setAdvancedSearch("y_fechahasta", "");
		$calculo->setAdvancedSearch("x_diasresta", "");
		$calculo->setAdvancedSearch("z_diasresta", "");
		$calculo->setAdvancedSearch("y_diasresta", "");
		$calculo->setAdvancedSearch("x_diaslleva", "");
		$calculo->setAdvancedSearch("x_diasllevalab", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $calculo;
		$bRestore = TRUE;
		if (@$_GET["x_fechahoy"] <> "") $bRestore = FALSE;
		if (@$_GET["y_fechahoy"] <> "") $bRestore = FALSE;
		if (@$_GET["x_fechahasta"] <> "") $bRestore = FALSE;
		if (@$_GET["y_fechahasta"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diasresta"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diasresta"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diaslleva"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diasllevalab"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($calculo->fechahoy);
			$this->GetSearchParm($calculo->fechahasta);
			$this->GetSearchParm($calculo->diasresta);
			$this->GetSearchParm($calculo->diaslleva);
			$this->GetSearchParm($calculo->diasllevalab);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $calculo;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$calculo->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$calculo->CurrentOrderType = @$_GET["ordertype"];
			$calculo->UpdateSort($calculo->fechahoy); // fechahoy
			$calculo->UpdateSort($calculo->fechahasta); // fechahasta
			$calculo->UpdateSort($calculo->diasresta); // diasresta
			$calculo->UpdateSort($calculo->diaslleva); // diaslleva
			$calculo->UpdateSort($calculo->diasllevalab); // diasllevalab
			$calculo->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $calculo;
		$sOrderBy = $calculo->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($calculo->SqlOrderBy() <> "") {
				$sOrderBy = $calculo->SqlOrderBy();
				$calculo->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $calculo;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$calculo->setSessionOrderBy($sOrderBy);
				$calculo->fechahoy->setSort("");
				$calculo->fechahasta->setSort("");
				$calculo->diasresta->setSort("");
				$calculo->diaslleva->setSort("");
				$calculo->diasllevalab->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$calculo->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $calculo;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($calculo->Export <> "" ||
			$calculo->CurrentAction == "gridadd" ||
			$calculo->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $calculo;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($calculo->CurrentAction == "edit" && $calculo->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.fcalculolist;if(calculo_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			return;
		}

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<span class=\"ewSeparator\">&nbsp;|&nbsp;</span>";
			$oListOpt->Body .= "<a class=\"ewInlineLink\" href=\"" . $this->InlineEditUrl . "#" . $this->PageObjName . "_row_" . $this->lRowCnt . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		if ($calculo->CurrentAction == "gridedit")
			$this->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->lRowIndex . "_key\" id=\"k" . $this->lRowIndex . "_key\" value=\"" . $calculo->fechahoy->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $calculo->fechahasta->CurrentValue . "\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $calculo;
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

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $calculo;

		// Load search values
		// fechahoy

		$calculo->fechahoy->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fechahoy"]);
		$calculo->fechahoy->AdvancedSearch->SearchOperator = @$_GET["z_fechahoy"];
		$calculo->fechahoy->AdvancedSearch->SearchCondition = @$_GET["v_fechahoy"];
		$calculo->fechahoy->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_fechahoy"]);
		$calculo->fechahoy->AdvancedSearch->SearchOperator2 = @$_GET["w_fechahoy"];

		// fechahasta
		$calculo->fechahasta->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fechahasta"]);
		$calculo->fechahasta->AdvancedSearch->SearchOperator = @$_GET["z_fechahasta"];
		$calculo->fechahasta->AdvancedSearch->SearchCondition = @$_GET["v_fechahasta"];
		$calculo->fechahasta->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_fechahasta"]);
		$calculo->fechahasta->AdvancedSearch->SearchOperator2 = @$_GET["w_fechahasta"];

		// diasresta
		$calculo->diasresta->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diasresta"]);
		$calculo->diasresta->AdvancedSearch->SearchOperator = @$_GET["z_diasresta"];
		$calculo->diasresta->AdvancedSearch->SearchCondition = @$_GET["v_diasresta"];
		$calculo->diasresta->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diasresta"]);
		$calculo->diasresta->AdvancedSearch->SearchOperator2 = @$_GET["w_diasresta"];

		// diaslleva
		$calculo->diaslleva->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diaslleva"]);
		$calculo->diaslleva->AdvancedSearch->SearchOperator = @$_GET["z_diaslleva"];

		// diasllevalab
		$calculo->diasllevalab->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diasllevalab"]);
		$calculo->diasllevalab->AdvancedSearch->SearchOperator = @$_GET["z_diasllevalab"];
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
		$this->ViewUrl = $calculo->ViewUrl();
		$this->EditUrl = $calculo->EditUrl();
		$this->InlineEditUrl = $calculo->InlineEditUrl();
		$this->CopyUrl = $calculo->CopyUrl();
		$this->InlineCopyUrl = $calculo->InlineCopyUrl();
		$this->DeleteUrl = $calculo->DeleteUrl();

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
		} elseif ($calculo->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// fechahoy
			$calculo->fechahoy->EditCustomAttributes = "";
			if (strval($calculo->fechahoy->CurrentValue) <> "") {
				switch ($calculo->fechahoy->CurrentValue) {
					case "Lunes":
						$calculo->fechahoy->EditValue = "Lunes";
						break;
					case "Martes":
						$calculo->fechahoy->EditValue = "Martes";
						break;
					case "Miercoles":
						$calculo->fechahoy->EditValue = "Miercoles";
						break;
					case "Jueves":
						$calculo->fechahoy->EditValue = "Jueves";
						break;
					case "Viernes":
						$calculo->fechahoy->EditValue = "Viernes";
						break;
					case "Sabado":
						$calculo->fechahoy->EditValue = "Sabado";
						break;
					case "Domingo":
						$calculo->fechahoy->EditValue = "Domingo";
						break;
					default:
						$calculo->fechahoy->EditValue = $calculo->fechahoy->CurrentValue;
				}
			} else {
				$calculo->fechahoy->EditValue = NULL;
			}
			$calculo->fechahoy->CssStyle = "";
			$calculo->fechahoy->CssClass = "";
			$calculo->fechahoy->ViewCustomAttributes = "";

			// fechahasta
			$calculo->fechahasta->EditCustomAttributes = "";
			$calculo->fechahasta->EditValue = $calculo->fechahasta->CurrentValue;
			$calculo->fechahasta->CssStyle = "";
			$calculo->fechahasta->CssClass = "";
			$calculo->fechahasta->ViewCustomAttributes = "";

			// diasresta
			$calculo->diasresta->EditCustomAttributes = "";
			$calculo->diasresta->EditValue = ew_HtmlEncode($calculo->diasresta->CurrentValue);

			// diaslleva
			$calculo->diaslleva->EditCustomAttributes = "";
			$calculo->diaslleva->EditValue = ew_HtmlEncode($calculo->diaslleva->CurrentValue);

			// diasllevalab
			$calculo->diasllevalab->EditCustomAttributes = "";
			$calculo->diasllevalab->EditValue = ew_HtmlEncode($calculo->diasllevalab->CurrentValue);

			// Edit refer script
			// fechahoy

			$calculo->fechahoy->HrefValue = "";

			// fechahasta
			$calculo->fechahasta->HrefValue = "";

			// diasresta
			$calculo->diasresta->HrefValue = "";

			// diaslleva
			$calculo->diaslleva->HrefValue = "";

			// diasllevalab
			$calculo->diasllevalab->HrefValue = "";
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $calculo;
		$sFilter = $calculo->KeyFilter();
		$calculo->CurrentFilter = $sFilter;
		$sSql = $calculo->SQL();
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

			// fechahoy
			// fechahasta
			// diasresta

			$calculo->diasresta->SetDbValueDef($rsnew, $calculo->diasresta->CurrentValue, NULL, FALSE);

			// diaslleva
			$calculo->diaslleva->SetDbValueDef($rsnew, $calculo->diaslleva->CurrentValue, NULL, FALSE);

			// diasllevalab
			$calculo->diasllevalab->SetDbValueDef($rsnew, $calculo->diasllevalab->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $calculo->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($calculo->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($calculo->CancelMessage <> "") {
					$this->setMessage($calculo->CancelMessage);
					$calculo->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$calculo->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $calculo;
		$utf8 = TRUE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $calculo->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($calculo->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($calculo->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($calculo, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($calculo->fechahoy);
				$ExportDoc->ExportCaption($calculo->fechahasta);
				$ExportDoc->ExportCaption($calculo->diasresta);
				$ExportDoc->ExportCaption($calculo->diaslleva);
				$ExportDoc->ExportCaption($calculo->diasllevalab);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$calculo->CssClass = "";
				$calculo->CssStyle = "";
				$calculo->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($calculo->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('fechahoy', $calculo->fechahoy->ExportValue($calculo->Export, $calculo->ExportOriginalValue));
					$XmlDoc->AddField('fechahasta', $calculo->fechahasta->ExportValue($calculo->Export, $calculo->ExportOriginalValue));
					$XmlDoc->AddField('diasresta', $calculo->diasresta->ExportValue($calculo->Export, $calculo->ExportOriginalValue));
					$XmlDoc->AddField('diaslleva', $calculo->diaslleva->ExportValue($calculo->Export, $calculo->ExportOriginalValue));
					$XmlDoc->AddField('diasllevalab', $calculo->diasllevalab->ExportValue($calculo->Export, $calculo->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($calculo->fechahoy);
					$ExportDoc->ExportField($calculo->fechahasta);
					$ExportDoc->ExportField($calculo->diasresta);
					$ExportDoc->ExportField($calculo->diaslleva);
					$ExportDoc->ExportField($calculo->diasllevalab);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($calculo->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($calculo->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($calculo->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($calculo->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($calculo->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
